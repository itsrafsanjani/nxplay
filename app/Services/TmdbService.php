<?php

namespace App\Services;

use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TmdbService
{
    const TMDB_BASE_URL = 'https://api.themoviedb.org/3';

    public function getMovie($tmdbId)
    {
        return $this->get("movie/{$tmdbId}", ['append_to_response' => 'credits'])->json();
    }

    public function getMovieImages($tmdbId)
    {
        return $this->get("movie/{$tmdbId}/images")->json();
    }

    public function get(string $endpoint, array $queryParams = []): Response
    {
        return $this->request('get', $endpoint, $queryParams);
    }

    protected function request(string $method, string $endpoint, array $data = []): Response
    {
        $url = self::TMDB_BASE_URL . '/' . $endpoint;

        return Http::asJson()
            ->acceptJson()
            ->withToken(config('services.tmdb.token'))
            ->{strtolower($method)}($url, $data);
    }
}
