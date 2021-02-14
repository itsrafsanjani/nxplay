@extends('frontend.layouts.app')

@section('content')
    <!-- page title -->
    <section class="section section--first section--bg" data-bg="img/section/section.jpg"
             style="margin-bottom: 30px; @media (min-width: 768px) { margin-bottom: 40px; }">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section__wrap">
                        <!-- section title -->
                        <h2 class="section__title">Search result for "{{ $query }}"</h2>
                        <!-- end section title -->

                        <!-- breadcrumb -->
                        <ul class="breadcrumb">
                            <li class="breadcrumb__item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb__item breadcrumb__item--active">Search</li>
                        </ul>
                        <!-- end breadcrumb -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end page title -->

    <!-- catalog -->
    <div class="catalog">
        <div class="container">
            <div class="row">
            @forelse($results as $result)
                <!-- card -->
                    <div class="col-6 col-sm-4 col-md-3 col-xl-2">
                        <div class="card">
                            <div class="card__cover">
                                <img src="https://imdb-api.com/posters/w300/{{ $result->poster }}"
                                     alt="{{ $result->title }}"/>
                                <a href="{{ route('frontend.videos.show', $result->slug) }}" class="card__play">
                                    <i class="icon ion-ios-play"></i>
                                </a>
                                <span
                                    class="card__rate @if($result->imdb_rating>=7)card__rate--green @else card__rate--red @endif">{{ $result->imdb_rating }}</span>
                            </div>
                            <div class="card__content">
                                <h3 class="card__title">
                                    <a href="{{ route('frontend.videos.show', $result->slug) }}">{{ $result->title }}</a>
                                </h3>
                                <span class="card__category">
                                    @php($i = 0)
                                    @foreach(json_decode($result->genres) as $genre)
                                        @if($i >= 3)
                                            @break
                                        @else
                                            <a href="#">{{ ucfirst($genre) }}</a>
                                            @php($i++)
                                        @endif
                                    @endforeach
                                </span>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->
                @empty
                    <div class="col">
                        <h2 style="color: #ffd80e; text-align: center; margin: 20px 0; background: #212529; padding: 20px 8px; border-radius: 5px;">
                            No matches for your search. Sorry!
                        </h2>
                    </div>
                @endforelse
            </div>

            <!-- end content -->
            <!-- paginator -->
            <div class="col-12">
                <div class="paginator-wrap">
                    @if($results->total() > 20)
                        <span>20 from {{ $results->total() }}</span>
                    @else
                        <span>{{ $results->total() }} from {{ $results->total() }}</span>
                    @endif
                    {{ $results->withQueryString()->links('backend.bulma') }}
                </div>
            </div>
            <!-- end paginator -->
        </div>
    </div>
    </div>
    <!-- end catalog -->
@endsection
