<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Video;

class HomeController extends Controller
{
    public function index()
    {
        $data['newVideos'] = Video::where('status', 1)->select('id', 'slug', 'title', 'imdb_rating', 'type', 'genres', 'poster')->latest()->take(5)->get();
        $data['popularVideos'] = Video::where('status', 1)->orderBy('views', 'desc')->select('id', 'slug', 'title', 'imdb_rating', 'views', 'type', 'genres', 'poster')->latest()->take(5)->get();
        $data['videos'] = Video::where('status', 1)->select('id', 'slug', 'title', 'imdb_rating', 'type', 'genres', 'poster')->take(10)->get();

        return response()->json($data, 200);
    }
}
