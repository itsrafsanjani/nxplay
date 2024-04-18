<?php

namespace App\Workflows;

use App\Models\Video;
use FFMpeg\Format\Video\X264;
use Illuminate\Support\Facades\Storage;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;
use Workflow\Activity;

class ConvertTo360Activity extends Activity
{
    public $timeout = 5;

    public function execute(Video $video)
    {
        $low = (new X264('aac'))->setKiloBitrate(500);

        FFMpeg::fromDisk('local')
            ->open($video->video)
            ->exportForHLS()
            ->addFormat($low)
            ->onProgress(fn() => $this->heartbeat())
            ->toDisk('public')
            ->save("videos/{$video->id}/{$video->id}.m3u8");
    }
}
