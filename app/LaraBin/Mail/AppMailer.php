<?php

namespace App\LaraBin\Mail;

use App\LaraBin\Models\Bins\Bin;
use App\LaraBin\Models\Bins\Comments\Comment;
use App\LaraBin\Models\User;
use Illuminate\Contracts\Mail\Mailer;

class AppMailer
{
    protected $mailer;

    protected $from = 'no-reply@larabin.com';

    protected $to;

    protected $subject;

    protected $view;

    protected $data = [];

    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendEmailConfirmationTo(User $user)
    {
        $this->to = $user->email;
        $this->view = 'emails.auth.confirm';
        $this->subject = 'LaraBin.com - Confirm your email!';
        $this->data = ['token' => $user->emailVerification->token];

        $this->deliver();
    }

    public function sendPasswordResetTo(User $user)
    {
        $this->to = $user->email;
        $this->view = 'emails.auth.password';
        $this->subject = 'LaraBin.com - Reset Account Password';
        $this->data = ['token' => $user->passwordReset->token];

        $this->deliver();
    }

    public function sendManualActivationEmailTo(User $user)
    {
        $this->to = $user->email;
        $this->view = 'emails.auth.confirm-manual';
        $this->subject = 'LaraBin.com - Account manually activated!';
        $this->data = ['name' => $user->name];

        $this->deliver();
    }

    public function sendCommentNotificationTo(Comment $comment)
    {
        $this->to = $comment->bin->user->email;
        $this->view = 'emails.bin.new-comment';
        $this->subject = 'LaraBin.com - New comment on your bin!';
        $this->data = ['comment' => $comment];

        $this->deliver();
    }

    /**
     * Send email notification to let user know they have been mentioned in comment
     *
     * @param Comment $comment - The comment in question
     * @param User $user - The user who has been mentioned
     */
    public function sendMentionNotificationTo(Comment $comment, User $user)
    {
        $this->to = $user->email;
        $this->view = 'emails.bin.new-mention';
        $this->subject = 'LaraBin.com - You have been mentioned in a comment!';
        $this->data = ['comment' => $comment];

        $this->deliver();
    }

    public function deliver()
    {
        $this->mailer->send($this->view, $this->data, function($message) {
            $message->from($this->from, 'LaraBin No-Reply')
                    ->to($this->to)
                    ->subject($this->subject);
        });
    }
}