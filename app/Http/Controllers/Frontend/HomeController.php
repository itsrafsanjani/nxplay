<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        /**
         * check if data is available in cache
         * if not then run query from database
         */
        $data['videos'] = cache('videos', function () {
            return Video::where('status', 1)
                ->select('id', 'slug', 'title', 'imdb_rating', 'type', 'genres', 'poster')
                ->take(18)
                ->get();
        });

        $data['newVideos'] = cache('newVideos', function () {
            return Video::where('status', 1)
                ->select('id', 'slug', 'title', 'imdb_rating', 'type', 'genres', 'poster')
                ->latest()
                ->take(5)
                ->get();
        });

        $data['popularVideos'] = cache('popularVideos', function () {
            return Video::where('status', 1)
                ->orderBy('views', 'desc')
                ->select('id', 'slug', 'title', 'imdb_rating', 'type', 'genres', 'poster')
                ->take(10)
                ->get();
        });

        return view('frontend.frontend', $data);
    }

    public function aboutUs()
    {
        return view('frontend.static-pages.about-us');
    }
}
