<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Video;

class VideoController extends Controller
{
    public function index()
    {
        $data['videos'] = Video::where('status', 1)
            ->select(['id', 'slug', 'title', 'imdb_rating', 'type', 'genres', 'poster'])
            ->latest()
            ->paginate(18);
        return view('frontend.video.index', $data);
    }

    public function show($slug)
    {
        $data['video'] = Video::where('slug', $slug)
            ->where('status', 1)
            ->with([
                'comments:id,user_id,video_id,comment_text,parent_id,created_at',
                'comments.replies:id,user_id,video_id,comment_text,parent_id,created_at',
                'reviews:id,user_id,video_id,title,body,rating,created_at',
                'comments.user:id,name,avatar',
                'comments.replies.user:id,name,avatar',
                'reviews.user:id,name,avatar',
                'comments.commentLikes:id,comment_id,user_id,status',
                'comments.replies.commentLikes:id,comment_id,user_id,status',
                'comments.commentDislikes:id,comment_id,user_id,status',
                'comments.replies.commentDislikes:id,comment_id,user_id,status'
            ])
            ->first();

        if ($data['video'] === null) {
            abort(404);
        }

        if (isset($data['video'])) {
            $data['video']->increment('views');
        }

        //Collection in php is maybe flexible for push, pop or similar operation.
        $data['similarVideos'] = collect();

        //Pulling 20 videos from the database.
        $videos = Video::select(['id', 'slug', 'title', 'imdb_rating', 'type', 'genres', 'poster', 'views'])
            ->take(20)
            ->get();

        //decoding genres for removing extra backslash.
        $genres = json_decode($data['video']['genres']);

        //Traversing video list then compare all genres
        foreach ($videos as $video) {
            $videoGenres = json_decode($video['genres']);

            /*
            The best method for compare two array elements.
            It return matching element by comparing two or more arrays.
            In our methode the main problem is with the array value.
            * They maybe Lower or upper case.
            * They may contain extra space.
            That's why your previous tried method gone failed.

            $result = array_intersect($videoGenres, $genres);
            if (count($result) > 0) {
                $similarVideos->push($video);
            }
            */

            //This is the temporary solution for this problem given bellow.
            $isPushed = false;
            foreach ($genres as $i) {
                foreach ($videoGenres as $j) {
                    if (strcmp(trim(strtolower($i)), trim(strtolower($j))) == 0 && $video['id'] != $data['video']['id']) {
                        $data['similarVideos']->push($video);
                        $isPushed = true;
                        break;
                    }
                    if ($isPushed) {
                        break;
                    }
                }
                if ($isPushed) {
                    break;
                }
            }
        }

        return view('frontend.video.show', $data);
//        return $data;
    }
}
