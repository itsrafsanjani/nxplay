<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Video;
use App\Models\VideoLike;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request) : \Illuminate\Http\JsonResponse
    {
        $query = Video::where('status', 1)->select('id', 'title', 'imdb_rating', 'type', 'genres', 'poster');

        if ($request->has('sort')) {
            {
                if ($request->has('by')) {
                    $query->orderBy($request->input('by'), $request->input('sort'));
                }
            }
            $query->orderBy('id', $request->input('sort'));
        }

        if ($request->has('type')) {
            $query->where('type', $request->input('type'));
        }

        if ($request->has('take')) {
            $query->take($request->input('take'));
            return response()->json($query->paginate($request->input('take')), 200);
        }

        return response()->json($query->paginate(20), 200);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id) : \Illuminate\Http\JsonResponse
    {
        $video = Video::findOrFail($id);
        $user_id = auth()->user()->id;
        $video['likes'] = VideoLike::where('video_id', $id)->where('status', 1)->count();
        $video['dislikes'] = VideoLike::where('video_id', $id)->where('status', 0)->count();
        $likeStatus = VideoLike::where('video_id', $id)->where('user_id', $user_id)->get('status');
        $video['likeStatus'] = count($likeStatus) == 1 ? $likeStatus[0]['status'] : null;

        if (isset($video)) {
            $video->increment('views');
        }

        //Collection in php is maybe flexible for push, pop or similar operation.
        $similarVideos = collect();

        //Pulling 20 videos from the database.
        $videos = Video::select('id', 'slug', 'title', 'imdb_rating', 'type', 'genres', 'poster', 'views')->take(20)->get();

        //decoding genres for removing extra backslash.
        $gen = json_decode($video['genres']);

        //Traversing video list then compare all genres
        foreach ($videos as $vid) {
            $vidGen = json_decode($vid['genres']);

            /*
            The best method for compare two array elements.
            It return matching element by comparing two or more arrays.
            In our methode the main problem is with the array value.
            *They maybe Lower or upper case.
            *They may contain extra space.
            That's why your previous tried method gone failed.

            $result = array_intersect($vidGen, $gen);
            if (count($result) > 0) {
                $similarVideos->push($vid);
            }
            */

            //This is the temporary solution for this problem given bellow.
            $isPushed = false;
            foreach ($gen as $i) {
                foreach ($vidGen as $j) {
                    if (strcmp(trim(strtolower($i)), trim(strtolower($j))) == 0 && $vid['id'] != $video['id']) {
                        $similarVideos->push($vid);
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

        //It will generate a map. So polishing this collection take extra time. Ignore it.
        //$similarVideos = collect($similarVideos)->unique('id');

        $video['similarVideos'] = $similarVideos;

        return response()->json($video, 200);
    }
}
