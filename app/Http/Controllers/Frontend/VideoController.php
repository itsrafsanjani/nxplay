<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index()
    {
        $data['videos'] = Video::where('status', 1)->select('id', 'slug', 'title', 'imdb_rating', 'type', 'genres', 'poster')->latest()->paginate(18);
        return view('frontend.video.index', $data);
    }

    public function show($slug)
    {
        $data['video'] = Video::where('slug', $slug)->where('status', 1)->first();

        if($data['video'] === null){
            return redirect()->route('home');
        }

        return view('frontend.video.show', $data);
    }
}
