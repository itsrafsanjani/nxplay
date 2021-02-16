<?php

namespace App\Listeners;

use App\Models\Video;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class VideoCacheListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param object $event
     * @return void
     * @throws \Exception
     */
    public function handle($event)
    {
        cache()->forget('videos');
        cache()->forget('newVideos');
        cache()->forget('popularVideos');

        $newVideos = Video::where('status', 1)
                ->select('id', 'slug', 'title', 'imdb_rating', 'type', 'genres', 'poster')
                ->latest()
                ->take(5)
                ->get();

        $popularVideos = Video::where('status', 1)
                ->orderBy('views', 'desc')
                ->select('id', 'slug', 'title', 'imdb_rating', 'type', 'genres', 'poster')
                ->take(10)
                ->get();

        $videos = Video::where('status', 1)
            ->select('id', 'slug', 'title', 'imdb_rating', 'type', 'genres', 'poster')
            ->take(18)
            ->get();

        cache()->forever('videos', $videos);
        cache()->forever('newVideos', $newVideos);
        cache()->forever('popularVideos', $popularVideos);
    }
}
