<?php

namespace App\Notifications;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SomeoneReplied extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * @var User
     */
    private User $user;
    /**
     * @var Comment
     */
    private Comment $comment;

    /**
     * Create a new notification instance.
     * @param User $fromUser
     * @param Comment $comment
     */
    public function __construct(User $fromUser, Comment $comment)
    {
        $this->user = $fromUser;
        $this->comment = $comment;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'user' => $this->user,
            'reply' => $this->comment
        ];
    }
}
