<?php

namespace App\Workflows;

use App\Models\Video;
use Illuminate\Support\Facades\Storage;
use Workflow\ActivityStub;
use Workflow\Workflow;

class ProcessVideoWorkflow extends Workflow
{
    public function execute(Video $video)
    {
        // create a directory for the video
        Storage::disk('public')->makeDirectory("videos/{$video->id}");

        yield ActivityStub::make(ConvertTo1080Activity::class, $video);
        yield ActivityStub::make(ConvertTo720Activity::class, $video);
        yield ActivityStub::make(ConvertTo360Activity::class, $video);
    }

    public function compensate()
    {
    }


}
