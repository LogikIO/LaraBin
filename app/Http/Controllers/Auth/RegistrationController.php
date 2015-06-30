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
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password'))
        ]);

        $user->emailVerification()->create([
            'token' => str_random(30),
            'created_at' => Carbon::now()
        ]);

        $mailer->sendEmailConfirmationTo($user);

        session()->flash('success', 'Account created successfully! You must verify your email!');

        return redirect()->route('home');
    }

    public function confirm($token)
    {
        $token = EmailVerification::where('token', $token)->first();
        if (!$token || $token->expired()) {
            session()->flash('error', 'Token does not exist or has expired!');

            return redirect()->route('home');
        }

        $token->user()->update([
            'verified' => true
        ]);

        $token->delete();

        session()->flash('success', 'Email verified! You may now login!');
        return redirect()->route('login');
    }
}
