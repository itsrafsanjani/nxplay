<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Comment;
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
        $data['video'] = Video::
        with('comments:id,user_id,video_id,comment_text,parent_id,created_at',
            'comments.replies:id,user_id,video_id,comment_text,parent_id,created_at',
            'reviews:id,user_id,video_id,title,body,rating,created_at',
            'comments.user:id,name,avatar', 'comments.replies.user:id,name,avatar', 'reviews.user:id,name,avatar',
            'comments.commentLikes:id,comment_id,user_id,status', 'comments.replies.commentLikes:id,comment_id,user_id,status',
            'comments.commentDislikes:id,comment_id,user_id,status', 'comments.replies.commentDislikes:id,comment_id,user_id,status')
            ->where('slug', $slug)
            ->where('status', 1)
            ->first();

        if ($data['video'] === null) {
            return redirect()->route('home');
        }

        return view('frontend.video.show', $data);
//        return $data;
    }
}
