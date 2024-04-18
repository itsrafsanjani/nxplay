<?php

namespace App\Console\Commands;

use App\Jobs\ConvertForStreamingJob;
use App\Models\Video;
use App\Workflows\ProcessVideoWorkflow;
use FFMpeg\Format\Video\X264;
use Illuminate\Console\Command;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;
use Workflow\WorkflowStub;

class TestVideoProcess extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test-video-process';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test: dispatch ConvertForStreamingJob for the first video in the database.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if (app()->environment('production')) {
            $this->error('This command can only be run in local environment');
            return;
        }

        $video = Video::first();

        $this->info($video);

        ConvertForStreamingJob::dispatch($video);
    }
}
