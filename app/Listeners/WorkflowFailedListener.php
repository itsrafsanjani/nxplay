<?php

namespace App\Listeners;

use App\Models\WorkflowProgress;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class WorkflowFailedListener
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
            'status' => 'failed',
        ]);
    }
}
