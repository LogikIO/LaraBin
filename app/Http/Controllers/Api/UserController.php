<?php

namespace App\Http\Controllers\Api;

use App\LaraBin\Helpers\UserCache;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function __construct(UserCache $userCache)
    {
        $this->userCache = $userCache;
    }

    public function search(Request $request)
    {
        $query = $request->input('q');
        $users = $this->userCache->usernames();
        $found = array_filter($users, function($users) use ($query) {
            return ( strpos($users, $query) !== false );
        });
        $usernames = array_values($found);

        return response()->json($usernames, 200);
    }
}
