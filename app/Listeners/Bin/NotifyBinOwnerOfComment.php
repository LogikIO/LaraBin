<?php

namespace App\Listeners\Bin;

use App\Events\Bin\UserCommentedOnBin;
use App\LaraBin\Mail\AppMailer;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyBinOwnerOfComment
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(AppMailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * Handle the event.
     *
     * @param  UserCommentedOnBin  $event
     * @return void
     */
    public function handle(UserCommentedOnBin $event)
    {
        $comment = $event->comment;

        $this->mailer->sendCommentNotificationTo($comment);

    }
}
