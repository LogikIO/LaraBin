<?php

namespace App\Http\Controllers;

use App\LaraBin\Models\Bins\Bin;
use App\LaraBin\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function show($username)
    {
        $user = User::where('username', $username)->first();

        if (!$user) {
            session()->flash('error', 'We cannot find a user with the username of [ <b>' . $username . '</b> ] Sorry.');

            return redirect()->route('home');
        }

        $bins = Bin::publicOnly()->where('user_id', $user->id)->orderBy('updated_at', 'DESC')->paginate(8);

        return view('user.show', compact('user', 'bins'));
    }
}
