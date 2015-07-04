<?php

namespace App\Http\Controllers\Admin;

use App\LaraBin\Mail\AppMailer;
use App\LaraBin\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(20);

        return view('admin.users.index', compact('users'));
    }

    public function edit($id)
    {
        $user = User::find($id);

        return view('admin.users.edit', compact('user'));
    }

    public function editPost($id, Requests\Admin\UpdateUser $request)
    {
        $user = User::find($id);
        $user->name = $request->input('name');
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->save();

        $website = ($request->has('website') && trim($request->input('website')) != '') ? $request->input('website') : null;
        $github_username = ($request->has('github_username') && trim($request->input('github_username')) != '') ? $request->input('github_username') : null;
        $twitter_username = ($request->has('twitter_username') && trim($request->input('twitter_username')) != '') ? $request->input('twitter_username') : null;

        $user->settings()->setMany([
            'website' => $website,
            'github_username' => $github_username,
            'twitter_username' => $twitter_username
        ]);

        session()->flash('success', 'Account updated successfully!');

        return redirect()->route('admin.users');
    }

    public function activate(Request $request, AppMailer $mailer)
    {
        $user = User::find($request->input('id'));
        $user->verified = 1;
        $user->save();
        $mailer->sendManualActivationEmailTo($user);
        session()->flash('success', 'User <strong>' . $user->username . '</strong> successfully activated!');

        return redirect()->route('admin.users');
    }
}
