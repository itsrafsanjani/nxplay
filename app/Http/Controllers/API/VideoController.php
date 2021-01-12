<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        $query = Video::where('status', 1)->select('id', 'title', 'imdb_rating', 'type', 'genres', 'poster');

        if ($request->has('sort')) {
            {
                if ($request->has('by'))
                    $query->orderBy($request->input('by'), $request->input('sort'));
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
    public function show($id): \Illuminate\Http\JsonResponse
    {
        $video = Video::find($id);
        return response()->json($video, 200);
    }
}
