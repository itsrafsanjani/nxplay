<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function show($slug)
    {
        $data['video'] = Video::where('slug', $slug)->where('status', 1)->first();

        if($data['video'] === null){
            return redirect()->route('home');
        }

        return view('frontend.video.show', $data);
    }
}
