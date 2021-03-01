<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        $query = $request->search_key;
        $result = Video::where('status', 1)
            ->where('title', 'LIKE', '%' . $query . '%')
            ->orWhere('genres', 'LIKE', '%' . $query . '%')
            ->orWhere('country', 'LIKE', '%' . $query . '%')
            ->orWhere('directors', 'LIKE', '%' . $query . '%')
            ->orWhere('actors', 'LIKE', '%' . $query . '%')
            ->select('id', 'slug', 'description', 'title', 'views', 'runtime', 'year', 'imdb_rating', 'type', 'genres', 'country', 'directors', 'actors', 'poster', 'runtime', 'age_rating')
            ->orderBy('views', 'DESC')
            ->paginate(20);

        return response()->json($result, 200);
    }
}
