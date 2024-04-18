<?php

namespace App\Listeners;

use App\Events\VideoProcessedEvent;
use App\Models\Video;
use App\Models\WorkflowProgress;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class WorkflowCompletedListener
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
        $workflowId = $event->workflowId;

        // find the workflow progress record by workflowId
        $workflowProgress = WorkflowProgress::where('workflow_id', $workflowId)->firstOrFail();

        // update the status to started
        $workflowProgress->update([
            'status' => 'completed',
        ]);

        // dispatch video processed event
        // check if progressable is a instance of Video
        if ($workflowProgress->progressable instanceof Video) {
            /* @var Video $video */
            $video = $workflowProgress->progressable;
            VideoProcessedEvent::dispatch($video);
        } else {
            info("Workflow completed for a {$workflowProgress->progressable_type} progressable");
        }
    }
}
