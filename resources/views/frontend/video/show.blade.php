@extends('frontend.layouts.app')

@section('content')
    <!-- details -->
    <section class="section section--details section--bg" data-bg="{{ asset('img/section/details.jpg') }}">
        <!-- details content -->
        <div class="container">
            <div class="row">
                <!-- title -->
                <div class="col-12">
                    <h1 class="section__title">{{ $video->title }}</h1>
                </div>
                <!-- end title -->

                <!-- content -->
                <div class="col-12 col-lg-6">
                    <div class="card card--details">
                        <div class="row">
                            <!-- card cover -->
                            <div class="col-12 col-sm-5 col-lg-6 col-xl-5">
                                <div class="card__cover">
                                    <img src="{{ $video->poster }}" alt="">
                                    <span class="card__rate @if($video->imdb_rating>=7)card__rate--green @else card__rate--red @endif">{{ $video->imdb_rating }}</span>
                                </div>
                            </div>
                            <!-- end card cover -->

                            <!-- card content -->
                            <div class="col-12 col-sm-7 col-lg-6 col-xl-7">
                                <div class="card__content">
                                    <ul class="card__meta">
                                        <li><span>Director:</span>
                                            @foreach(json_decode($video->directors) as $director)
                                                <a href="#">{{ ucfirst($director) }}</a>
                                            @endforeach
                                        </li>
                                        <li><span>Cast:</span>
                                            @foreach(json_decode($video->actors) as $actor)
                                                <a href="#">{{ ucfirst($actor) }}</a>
                                            @endforeach
                                        </li>
                                        <li><span>Genre:</span>
                                            @foreach(json_decode($video->genres) as $genre)
                                                <a href="#">{{ ucfirst($genre) }}</a>
                                            @endforeach
                                        </li>
                                        <li><span>Release year:</span> {{ $video->year }}</li>
                                        <li><span>Running time:</span> {{ $video->runtime }}</li>
                                        <li><span>Country:</span>
                                            @foreach(json_decode($video->country) as $country)
                                                <a href="#">{{ ucfirst($country) }}</a>
                                            @endforeach
                                        </li>
                                        <li><span>IMDb rating:</span>{{ $video->imdb_rating }} <a href="{{ $video->imdb_id }}">
                                                <img src="https://ia.media-imdb.com/images/M/MV5BMTk3ODA4Mjc0NF5BMl5BcG5nXkFtZTgwNDc1MzQ2OTE@._V1_.png" alt="imdb logo" style="width: auto; height: 18px; margin-left: 10px"> </a></li>
                                    </ul>
                                    <div class="card__description">{{ $video->description }}</div>
                                </div>
                            </div>
                            <!-- end card content -->
                        </div>
                    </div>
                </div>
                <!-- end content -->

                <!-- player -->
                <div class="col-12 col-lg-6">
                    <video controls crossorigin playsinline poster="{{ $video->poster }}" id="player">
                        <!-- Video files -->
{{--                        <source src="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-576p.mp4" type="video/mp4" size="576">--}}
{{--                        <source src="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-720p.mp4" type="video/mp4" size="720">--}}
                        <source src="{{ asset('storage/videos/'.$video->video) }}" type="video/mp4" size="1080">
                        <source src="{{ asset('storage/videos/'.$video->video) }}" type="video/mp4" size="720">
                        <source src="{{ asset('storage/videos/'.$video->video) }}" type="video/mp4" size="480">
                        <source src="{{ asset('storage/videos/'.$video->video) }}" type="video/mp4" size="360">

                        <!-- Caption files -->
                        <track kind="captions" label="English" srclang="en" src="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-HD.en.vtt"
                               default>
                        <track kind="captions" label="Français" srclang="fr" src="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-HD.fr.vtt">

                        <!-- Fallback for browsers that don't support the <video> element -->
                        <a href="{{ asset('storage/videos/'.$video->video) }}" download>Download</a>
                    </video>
                </div>
                <!-- end player -->
            </div>
        </div>
        <!-- end details content -->
    </section>
    <!-- end details -->
@endsection
