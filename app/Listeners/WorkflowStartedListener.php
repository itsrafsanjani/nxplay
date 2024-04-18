<?php

namespace App\Listeners;

use App\Models\Video;
use App\Models\WorkflowProgress;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class WorkflowStartedListener
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
        // workflowId: Unique identifier for the workflow.
        // class: Class name of the workflow.
        // arguments: Arguments passed to the workflow.
        // timestamp: Timestamp of when the workflow started.

        $workflowId = $event->workflowId;
        if ($event->class === 'App\Workflows\ProcessVideoWorkflow') {
            $firstArg = json_decode($event->arguments)[0];
            $video = Video::find($firstArg->id);

            $video->progress()->firstOrCreate([
                'workflow_id' => $workflowId,
                'status' => 'started',
            ]);
        }
    }
}
