<?php

namespace App\Listeners;

use App\Jobs\ConvertForStreamingJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class VideoCreatedListener
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
        ConvertForStreamingJob::dispatch($event->video);
    }
}
