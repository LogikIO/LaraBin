<?php

namespace App\Http\Controllers\Auth;

use App\LaraBin\Mail\AppMailer;
use App\LaraBin\Models\Auth\PasswordReset;
use App\LaraBin\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function loginPost(Request $request)
    {
        $useremail = $request->input('useremail');
        $password = $request->input('password');
        $remember = $request->input('remember');

        // Check if user is using email or username
        $field = filter_var($useremail, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $credentials = [
            $field => $useremail,
            'password' => $password,
        ];

        // check if user is authentic
        $valid = auth()->validate($credentials);

        if (!$valid) {
            session()->flash('error', 'Your [Username/Email] and/or Password is incorrect!');

            return redirect()->back()->withInput();
        }

        // user is valid, lets check a few things
        $user = User::where($field, '=', $useremail)->first();

        // check if email has been verified
        if (!$user->verified()) {

            session()->flash('error', 'You must verify your email before you can access the site. ' .
                '<br>If you have not received the confirmation email check your spam folder. ' .
                '<b><a class="alert-link" href="' . route('resend.email') . '" class="alert-link">Click here</a></b> for the option to resend.');

            return redirect()->route('home');

        }

        auth()->login($user, $remember);
        session()->flash('success', 'Successfully logged in!');

        return redirect()->intended(route('home'));
    }

    public function logout()
    {
        auth()->logout();
        session()->flash('success', 'See ya later!');

        return redirect()->route('home');
    }

    public function reset()
    {
        return view('auth.reset-password');
    }

    public function resetPost(Requests\Auth\ResetPassword $request, AppMailer $mailer)
    {
        $email = $request->input('email');
        $user = User::where('email', $email)->first();

        if (!$user) {
            session()->flash('error', 'No account found with that email!');

            return redirect()->back()->withInput();
        }

        if (!$user->verified()) {
            session()->flash('error', 'You must confirm your email before resetting your password!');

            return redirect()->route('home');
        }

        if (!$user->passwordReset) {
            $reset = $user->passwordReset()->create([
                'token' => str_random(30),
                'created_at' => Carbon::now()
            ]);

            $mailer->sendPasswordResetTo($reset->user);

            session()->flash('success', 'Password reset email has been sent!');

            return redirect()->route('home');
        }

        if ($user->passwordReset->created_at > Carbon::now()->subMinutes(15)) {
            session()->flash('error', 'You must wait ' . $user->passwordReset->created_at->addMinutes(15)->diffForHumans() . ' before requesting a new reset email!');

            return redirect()->back()->withInput();
        }

        $user->passwordReset()->update([
            'token' => str_random(30),
            'created_at' => Carbon::now()
        ]);

        $mailer->sendPasswordResetTo($user);

        session()->flash('success', 'Password reset email has been resent!');

        return redirect()->route('home');
    }

    public function confirm($token)
    {
        $token = PasswordReset::where('token', $token)->first();
        if (!$token || $token->expired()) {
            session()->flash('error', 'Token does not exist or has expired!');

            return redirect()->route('reset');
        }

        return view('auth.reset-password-new', compact('token'));
    }

    public function confirmPost($token, Requests\Auth\ResetPasswordNew $request)
    {
        $password = bcrypt($request->input('new_password'));
        $token = PasswordReset::where('token', $token)->first();
        if (!$token || $token->expired()) {
            session()->flash('error', 'Token does not exist or has expired!');

            return redirect()->route('reset');
        }

        $token->user()->update([
            'password' => $password
        ]);

        $token->delete();
        session()->flash('success', 'Your password has been reset. You may now login.');

        return redirect()->route('login');
    }
}
