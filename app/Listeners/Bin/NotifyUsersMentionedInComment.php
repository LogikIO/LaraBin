<?php

namespace App\Listeners\Bin;

use App\Events\Bin\UserCommentedOnBin;
use App\LaraBin\Mail\AppMailer;
use App\LaraBin\Models\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyUsersMentionedInComment
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

        // Grab all mentioned users - @username
        preg_match_all("/@([A-Za-z0-9_]+)/", $comment->message, $output_array);
        // Get users without the @ sign - send once per user
        // in case a user is mentioned twice
        $foundUsers = array_unique($output_array[1]);

        if (!empty($foundUsers)) {
            $users = User::whereIn('username', $foundUsers)->get();
            if ($users->count()) {
                foreach ($users as $user) {
                    // We don't want to notify the user who made the comment if
                    // they decide to mention themselves
                    if ($user->username !== auth()->user()->username) {
                        $this->mailer->sendMentionNotificationTo($comment, $user);
                    }
                }
            }
        }

    }
}
