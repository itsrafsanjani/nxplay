<?php

namespace App\Jobs;

use App\Events\VideoProcessedEvent;
use App\Models\Video;
use FFMpeg\Format\Video\X264;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

class ConvertForStreamingJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public Video $video;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Video $video)
    {
        $this->video = $video;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $low = (new X264('aac'))->setKiloBitrate(500);
        $mid = (new X264('aac'))->setKiloBitrate(2 * 1024);
        $high = (new X264('aac'))->setKiloBitrate(5 * 1024);

        FFMpeg::fromDisk('local')
            ->open($this->video->video)
            ->exportForHLS()
            ->addFormat($low)
            ->addFormat($mid)
            ->addFormat($high)
            ->toDisk('public')
            ->save("videos/{$this->video->id}/{$this->video->id}.m3u8");

        VideoProcessedEvent::dispatch($this->video);
    }
}
