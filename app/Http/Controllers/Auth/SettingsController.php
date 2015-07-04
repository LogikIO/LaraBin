<?php

namespace App\Http\Controllers\Auth;

use App\LaraBin\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Hash;

class SettingsController extends Controller
{
    public function index()
    {
        return view('user.settings');
    }

    public function update(Requests\Auth\UpdateUser $request)
    {
        // Update Password
        if ($request->has('new_password')) {
            // Check if user has an existing password - GitHub users will not
            if (auth()->user()->getAuthPassword() && !$request->has('current_password')) {
                session()->flash('error', 'You must supply your current password!');

                return redirect()->back()->withInput();
            }
            // Check if existing password is correct
            if (auth()->user()->getAuthPassword() && !Hash::check($request->input('current_password'), auth()->user()->getAuthPassword())) {
                session()->flash('error', 'Your current password is incorrect!');

                return redirect()->back()->withInput();
            }
        }

        $website = ($request->has('website') && trim($request->input('website')) != '') ? $request->input('website') : null;
        $github_username = ($request->has('github_username') && trim($request->input('github_username')) != '') ? $request->input('github_username') : null;

        $user = User::find(auth()->user()->getAuthIdentifier());
        $user->name = $request->input('name');
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->website = $website;
        $user->github_username = $github_username;
        if ($request->has('new_password')) {
            $user->password = bcrypt($request->input('new_password'));
        }
        $user->save();
        session()->flash('success', 'Account updated successfully!');

        return redirect()->back();
    }

    public function delete()
    {
        return view('user.delete');
    }

    public function deletePost(Requests\Auth\DeleteUser $request)
    {
        User::destroy(auth()->user()->getAuthIdentifier());
        session()->flash('success', 'Account deleted successfully. We hope you will come back!');

        return redirect()->route('home');
    }
}
