<?php

namespace App\Services;

use App\Jobs\ConvertForStreamingJob;
use App\Models\Video;
use App\Notifications\NewVideoReleased;
use Illuminate\Support\Carbon;

class VideoService
{
    public function store(array $movie, array $images, array $data)
    {
        $video = Video::create([
            'user_id' => auth()->id(),
            'title' => $movie['title'],
            'description' => $movie['overview'],
            'runtime' => $movie['runtime'],
            'year' => Carbon::parse($movie['release_date'])->format('Y'),
            'imdb_id' => $movie['imdb_id'],
            'tmdb_id' => $data['tmdb_id'],
            'imdb_rating' => $movie['vote_average'],
            'genres' => json_encode(collect($movie['genres'])->pluck('name')->take(5)->toArray()),
            'country' => json_encode(collect($movie['production_countries'])->pluck('name')->take(5)->toArray()),
            'directors' => json_encode(collect($movie['credits']['crew'])->pluck('name')->take(3)->toArray()),
            'actors' => json_encode(collect($movie['credits']['cast'])->pluck('name')->take(5)->toArray()),
            'box_office' => $movie['revenue'] ?? null,
            'poster' => $movie['poster_path'],
            'type' => 'Movie',
            'video' => $data['video'],
            'photos' => json_encode(collect($images['backdrops'])->pluck('file_path')->toArray()),
            'age_rating' => $movie['adult'] ? 'Rated' : 'Not Rated',
            'status' => $data['status'],
        ]);

        return $video;
    }
}
