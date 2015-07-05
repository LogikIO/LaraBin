<?php

namespace App\Http\Controllers\Auth\Socialite;

use App\Events\UserHasLoggedIn;
use App\LaraBin\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Socialite;

class GithubController extends Controller
{
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('github')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('github')->user();

        if (auth()->guest()) {
            $exists = User::where('github_token', $user->token)->first();

            if (!$exists) {
                $username = static::usernameCheck($user->getNickname());

                $checkEmail = User::where('email', $user->getEmail())->first();

                $email = ($checkEmail) ? null : $user->getEmail();

                $name = (trim($user->getName()) != '') ? $user->getName() : $username;

                $newUser = User::create([
                    'github_token' => $user->token,
                    'name' => $name,
                    'username' => $username,
                    'email' => $email,
                    'verified' => true,
                    'settings' => []
                ]);

                auth()->login($newUser);
                session()->flash('success', 'Successfully logged in!');

                return redirect()->route('home');
            }

            auth()->login($exists);

            event(new UserHasLoggedIn($exists));

            session()->flash('success', 'Successfully logged in!');

            return redirect()->route('home');
        }

        $current = User::find(auth()->user()->getAuthIdentifier());
        $current->github_token = $user->token;
        $current->save();

        session()->flash('success', 'GitHub details updated successfully!');

        return redirect()->route('settings');
    }

    private static function usernameCheck($nickname)
    {
        $found = true;
        $count = 1;

        $cleanName = $nickname;

        while ($found == true) {
            $addName = ($count == 1) ? $nickname : $nickname . $count;
            $data = User::where('username', $addName)->first();
            $count++;
            if (!$data) {
                $cleanName = $addName;
                $found = false;
            }
        }

        return $cleanName;
    }
}
