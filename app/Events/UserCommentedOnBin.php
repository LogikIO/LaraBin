<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UserCommentedOnBin extends Event
{
    use SerializesModels;

    /**
     * User that made the comment
     *
     * @var
     */
    public $user;

    /**
     * Bin that comment was made on
     *
     * @var
     */
    public $bin;

    public function __construct($user, $bin)
    {
        $this->user = $user;
        $this->bin = $bin;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
