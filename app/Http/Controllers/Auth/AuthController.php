<?php

namespace App\Http\Controllers\Auth;

use App\LaraBin\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

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
                '<b><a href="#" class="alert-link">Click here</a></b> for the option to resend.');

            return redirect()->route('home');

        }

        auth()->login($user, $remember);

        return redirect()->intended(route('home'));
    }

    public function logout()
    {
        auth()->logout();
        session()->flash('success', 'See ya later!');

        return redirect()->route('home');
    }
}
