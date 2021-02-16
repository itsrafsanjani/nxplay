<?php

namespace App\Providers;

use App\Events\VideoCreated;
use App\Events\VideoDeleted;
use App\Events\VideoUpdated;
use App\Listeners\VideoCacheListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        VideoCreated::class => [
            VideoCacheListener::class
        ],
        VideoUpdated::class => [
            VideoCacheListener::class
        ],
        VideoDeleted::class => [
            VideoCacheListener::class
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
