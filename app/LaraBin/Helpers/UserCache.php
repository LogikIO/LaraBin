<?php

namespace App\LaraBin\Helpers;

use App\LaraBin\Models\User;
use Cache;

class UserCache
{
    protected $users = [];

    public function __construct()
    {
        $this->buildUsers();
    }

    public function users()
    {
        return $this->users;
    }

    public function usernames()
    {
        $usernames = [];
        $users = $this->users;
        foreach($users as $user) {
            $usernames[] = $user['username'];
        }

        return $usernames;
    }

    public function update(User $user)
    {
        $this->processUpdate($user);
    }

    public function delete(User $user)
    {
        $updatedUsers = $this->deleteFromArray($user);
        $this->setCache($updatedUsers);
    }


    // Private Methods

    private function buildUsers()
    {
        if(!Cache::has('users') || empty($this->users)) {
            $users = [];
            $allUsers = User::all();
            foreach($allUsers as $user) {
                $users[$user->id] = [
                    'username' => $user->username,
                    'url' => $user->url()
                ];
            }
            $this->setCache($users);
        }
        $this->users = Cache::get('users');
    }

    private function processUpdate(User $user)
    {
        $value = array_get($this->users, $user->id, null);
        if ($value) {
            array_forget($this->users, $user->id);
        }
        $newUsers = $this->addToArray($user);
        $this->setCache($newUsers);
    }

    private function addToArray(User $user)
    {
        $users = $this->users;
        $users[$user->id] = [
            'username' => $user->username,
            'url' => $user->url()
        ];

        return $users;
    }

    private function deleteFromArray(User $user)
    {
        $users = $this->users;
        array_forget($users, $user->id);

        return $users;
    }

    private function destroy()
    {
        Cache::forget('users');
    }

    private function setCache(array $users)
    {
        $this->destroy();
        $this->users = Cache::rememberForever('users', function() use ($users) {
            return $users;
        });
    }
}