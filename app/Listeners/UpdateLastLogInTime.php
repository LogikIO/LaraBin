<?php

namespace App\Listeners;

use App\Events\UserHasLoggedIn;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Carbon\Carbon;

class UpdateLastLogInTime
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserHasLoggedIn  $event
     * @return void
     */
    public function handle(UserHasLoggedIn $event)
    {
        $user = $event->user;
        $user->last_login = Carbon::now();
        $user->save();
    }
}
