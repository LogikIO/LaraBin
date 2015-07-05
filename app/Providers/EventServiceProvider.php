<?php

namespace App\Providers;

use App\Events\UserHasLoggedIn;
use App\Events\Bin\UserCommentedOnBin;
use App\Listeners\UpdateLastLogInTime;
use App\Listeners\Bin\NotifyBinOwnerOfComment;
use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        UserHasLoggedIn::class => [
            UpdateLastLogInTime::class
        ],
        UserCommentedOnBin::class => [
            NotifyBinOwnerOfComment::class
        ]
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        //
    }
}
