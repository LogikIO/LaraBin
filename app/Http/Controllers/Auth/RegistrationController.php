<?php

namespace App\Http\Controllers\Auth;

use App\LaraBin\Mail\AppMailer;
use App\LaraBin\Models\Auth\EmailVerification;
use App\LaraBin\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class RegistrationController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function create(Requests\Auth\RegisterUser $request, AppMailer $mailer)
    {
        $user = User::create([
            'username' => $request->input('username'),
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'settings' => []
        ]);

        $user->emailVerification()->create([
            'token' => str_random(30),
            'created_at' => Carbon::now()
        ]);

        $mailer->sendEmailConfirmationTo($user);

        session()->flash('success', 'Account created successfully! You must verify your email!<br>May take up to 15 minutes. Be sure to check SPAM folder!');

        return redirect()->route('home');
    }

    public function confirm($token)
    {
        $token = EmailVerification::where('token', $token)->first();
        if (!$token || $token->expired()) {
            session()->flash('error', 'Token does not exist or has expired!');

            return redirect()->route('resend.email');
        }

        $token->user()->update([
            'verified' => true
        ]);

        $token->delete();

        session()->flash('success', 'Email verified! You may now login!');
        return redirect()->route('login');
    }

    public function resend()
    {
        return view('auth.resend-email');
    }

    public function resendPost(Requests\Auth\ResendEmailConfirmation $request, AppMailer $mailer)
    {
        $email = $request->input('email');
        $user = User::where('email', $email)->first();

        if (!$user) {
            session()->flash('error', 'No account found with that email!');

            return redirect()->back()->withInput();
        }

        if ($user->verified()) {
            session()->flash('error', 'Your account is already confirmed! No need for confirmation.');

            return redirect()->route('login');
        }

        if ($user->emailVerification->created_at > Carbon::now()->subSeconds(2)) {
            session()->flash('error', 'You must wait ' . $user->emailVerification->created_at->addMinutes(15)->diffForHumans() . ' before requesting a new confirmation!');

            return redirect()->back()->withInput();
        }

        $user->emailVerification->delete();

        $confirmation = $user->emailVerification()->create([
            'token' => str_random(30),
            'created_at' => Carbon::now()
        ]);

        $mailer->sendEmailConfirmationTo($confirmation->user);

        session()->flash('success', 'Email confirmation has been resent!<br>May take up to 15 minutes. Be sure to check SPAM folder!');

        return redirect()->route('home');
    }
}
