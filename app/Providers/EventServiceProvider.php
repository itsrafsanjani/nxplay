<?php

namespace App\Providers;

use App\Events\VideoCreatedEvent;
use App\Events\VideoDeletedEvent;
use App\Events\VideoProcessedEvent;
use App\Events\VideoUpdatedEvent;
use App\Jobs\ConvertForStreamingJob;
use App\Listeners\NotifyEveryoneListener;
use App\Listeners\VideoCacheListener;
use App\Listeners\VideoCreatedListener;
use App\Listeners\WorkflowCompletedListener;
use App\Listeners\WorkflowFailedListener;
use App\Listeners\WorkflowStartedListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use Workflow\Events\WorkflowCompleted;
use Workflow\Events\WorkflowFailed;
use Workflow\Events\WorkflowStarted;

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
        VideoCreatedEvent::class => [
            VideoCreatedListener::class,
        ],
        VideoProcessedEvent::class => [
            NotifyEveryoneListener::class,
            VideoCacheListener::class,
        ],
        VideoUpdatedEvent::class => [
            VideoCacheListener::class,
        ],
        VideoDeletedEvent::class => [
            VideoCacheListener::class,
        ],

        WorkflowStarted::class => [
            WorkflowStartedListener::class,
        ],
        WorkflowCompleted::class => [
            WorkflowCompletedListener::class,
        ],
        WorkflowFailed::class => [
            WorkflowFailedListener::class,
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
