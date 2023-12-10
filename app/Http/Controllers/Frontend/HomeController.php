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

//        $data['newVideos'] = VideoRule::where('status', 1)->select('id', 'slug', 'title', 'imdb_rating', 'type', 'genres', 'poster')->latest()->take(5)->get();
//        $data['popularVideos'] = VideoRule::where('status', 1)->orderBy('views', 'desc')->select('id', 'slug', 'title', 'imdb_rating', 'type', 'genres', 'poster')->take(10)->get();
//        $data['videos'] = VideoRule::where('status', 1)->select('id', 'slug', 'title', 'imdb_rating', 'type', 'genres', 'poster')->paginate(18);
        return view('frontend.frontend', $data);
//        return $data;
    }

    public function aboutUs()
    {
        return view('frontend.static-pages.about-us');
    }
}
