<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Workflow\Models\StoredWorkflow;

class WorkflowProgress extends Model
{
    use HasFactory;

    protected $fillable = [
        'workflow_id',
        'status',
    ];

    /**
     * Get the parent progressable model.
     */
    public function progressable(): MorphTo
    {
        return $this->morphTo();
    }

    public function workflow()
    {
        return $this->belongsTo(config('workflows.stored_workflow_model'), 'workflow_id');
    }
}
