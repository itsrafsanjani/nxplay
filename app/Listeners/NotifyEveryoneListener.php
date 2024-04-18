<?php

namespace App\Listeners;

use App\Models\User;
use App\Models\Video;
use App\Notifications\NewVideoReleased;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class NotifyEveryoneListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        /**
         * Send email notification
         */
        User::where('id', '!=', $event->video->user_id)
            ->chunk(200, function ($users) use ($event) {
                Notification::send($users, new NewVideoReleased($event->video));
            });

        /**
         * FCM Push Notification using Firebase to nxPlay channel
         */
        $user = User::findOrFail($event->video->user_id);
        $user->topicPushNotification(
            'nxPlay',
            "New {$event->video->type} {$event->video->title} released",
            'Watch it here now!', $event->video->id,
            'https://image.tmdb.org/t/p/w45/'.$event->video->posterÏ
        );
    }
}
