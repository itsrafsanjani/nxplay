<?php

namespace App\Workflows;

use App\Models\Video;
use FFMpeg\Format\Video\X264;
use Illuminate\Support\Facades\Storage;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;
use Workflow\Activity;

class ConvertTo720Activity extends Activity
{
    public $timeout = 5;

    public function execute(Video $video)
    {
        $mid = (new X264('aac'))->setKiloBitrate(2 * 1024);

        FFMpeg::fromDisk('local')
            ->open($video->video)
            ->exportForHLS()
            ->addFormat($mid)
            ->onProgress(fn() => $this->heartbeat())
            ->toDisk('public')
            ->save("videos/{$video->id}/{$video->id}.m3u8");
    }
}
