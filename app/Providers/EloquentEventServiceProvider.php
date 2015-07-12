<?php

namespace App\Providers;

use App\LaraBin\Models\User;
use Illuminate\Support\ServiceProvider;
use App\LaraBin\Helpers\UserCache;

class EloquentEventServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // User model
        $userCache = app('App\Larabin\Helpers\UserCache');
        User::created(function ($user) use ($userCache) {
            $userCache->update($user);
        });

        User::updated(function ($user) use ($userCache) {
            $userCache->update($user);
        });

        User::saved(function ($user) use ($userCache) {
            $userCache->update($user);
        });

        User::deleted(function ($user) use ($userCache) {
            $userCache->delete($user);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
