<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('q');

        $data['query'] = $query;

        $data['results'] = Video::where('status', 1)
            ->where('title', 'LIKE', '%' . $query . '%')
            ->orWhere('genres', 'LIKE', '%' . $query . '%')
            ->orWhere('country', 'LIKE', '%' . $query . '%')
            ->orWhere('directors', 'LIKE', '%' . $query . '%')
            ->orWhere('actors', 'LIKE', '%' . $query . '%')
            ->select('id', 'slug', 'title', 'views', 'runtime', 'year', 'imdb_rating', 'type', 'genres', 'country', 'directors', 'actors', 'poster', 'runtime', 'age_rating')
            ->orderByDesc('views', 'DESC')
            ->paginate(18)
            ->withQueryString();

        return view('frontend.search.index', $data);
//        return $data;
    }
}
