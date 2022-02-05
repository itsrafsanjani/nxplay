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
                                    <img src="https://imdb-api.com/posters/w300/{{ $video->poster }}"
                                         alt="{{ $video->title }}">
                                    <span
                                        class="card__rate @if($video->imdb_rating>=7)card__rate--green @else card__rate--red @endif"
                                    >{{ $video->imdb_rating }}</span>
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
                                        <li><span>IMDb rating:</span>{{ $video->imdb_rating }} <a
                                                href="https://www.imdb.com/title/{{ $video->imdb_id }}" target="_blank">
                                                <img
                                                    src="https://ia.media-imdb.com/images/M/MV5BMTk3ODA4Mjc0NF5BMl5BcG5nXkFtZTgwNDc1MzQ2OTE@._V1_.png"
                                                    alt="imdb logo"
                                                    style="width: auto; height: 18px; margin-left: 10px"> </a></li>
                                        <li>
                                            <div class="comments__rate"
                                                 style="position: relative; left: 0; top: 0; margin-top: 5px; border: 2px solid rgba(26,25,31,.7); border-radius: 3px; padding: 5px 30px; background: rgba(26,25,31,.7);">
                                                <form id="videoLikeDislikeForm" style="display: inline-flex">
                                                    <input type="hidden" name="status" id="likeStatus">
                                                    <button type="submit" title="I Like this" id="likeBtn"
                                                            onclick="document.getElementById('likeStatus').value='1';">
                                                        <i class="icon ion-md-thumbs-up"
                                                           style="font-size: 20px; margin-right: 6px; {{ $video->islikedBy(auth()->user()) ? 'color: #00ff70;' : 'color: #fff' }}"></i>
                                                        {{ $video->videoLikes->count() }}</button>
                                                    <button type="submit" title="I Don't Like this" id="dislikeBtn"
                                                            onclick="document.getElementById('likeStatus').value='0';">
                                                        <i class="icon ion-md-thumbs-down"
                                                           style="font-size: 20px; margin-left: 6px; margin-right: 6px; {{ $video->isDislikedBy(auth()->user()) ? 'color: #fd6060;' : 'color: #ffffff' }}"></i> {{ $video->videoDislikes->count() }}
                                                    </button>
                                                </form>
                                            </div>
                                        </li>
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
                    {{--<video controls crossorigin playsinline
                           poster="https://imdb-api.com/posters/w300/{{ $video->poster }}" id="player">
                        <!-- Video files -->
                        --}}{{-- <source src="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-576p.mp4" type="video/mp4" size="576">--}}{{--
                        --}}{{-- <source src="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-720p.mp4" type="video/mp4" size="720">--}}{{--

                        --}}{{--
                            If 'http' found in the url string at postion 0 it will load that directly. Else it will add 'storage/videos/' before the url.
                        --}}{{--

                        --}}{{--<source
                            src="@if(strpos($video->video, 'http') == 0) {{ $video->video }} @else {{ asset('storage/videos/'.$video->video) }} @endif"
                            type="video/mp4" size="1080">--}}{{--

                        <source
                            src="{{ asset('videos/'.$video->id . '/' . $video->id . '.m3u8') }}" type="application/x-mpegURL">
                        <!-- Caption files -->
                        <track kind="captions" label="English" srclang="en"
                               src="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-HD.en.vtt"
                               default>
                        <track kind="captions" label="Français" srclang="fr"
                               src="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-HD.fr.vtt">
                        <!-- Fallback for browsers that don't support the <video> element -->
                        <a href="{{ asset($video->video) }}" download>Download</a>
                    </video>--}}
                    <video-js id="video" class="video-js" controls preload="auto">
                        <source src="{{ asset('storage/videos/'.$video->id . '/' . $video->id . '.m3u8') }}" type="application/x-mpegURL">
                    </video-js>
                </div>
                <!-- end player -->
            </div>
        </div>
        <!-- end details content -->
    </section>
    <!-- end details -->
    {{--@include('frontend.video.discover')--}}
@endsection

@section('styles')
    <link href="https://vjs.zencdn.net/7.4.1/video-js.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/tube.css') }}">
@endsection

@push('javascripts')
    <script src='https://vjs.zencdn.net/7.5.4/video.js'></script>
    <script>
        videojs('video')
    </script>

    <script>

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("#videoLikeDislikeForm").submit(function (e) {
            e.preventDefault();

            let status = $("#likeStatus").val();

            $.ajax({
                type: 'POST',
                url: "{{ route('frontend.videos.like_or_dislike', $video) }}",
                data: {status: status},
                success: function (data) {
                    $("#likeBtn").html(`<i class="icon ion-md-thumbs-up" style="font-size: 20px; margin-right: 6px; ${data.status === 1 ? 'color: #00ff70;' : 'color: #fff'} + "></i>` + data.likes);
                    $("#dislikeBtn").html(`<i class="icon ion-md-thumbs-down" style="font-size: 20px; margin-left: 6px; margin-right: 6px; ${data.status === 0 ? 'color: #fd6060;' : 'color: #ffffff'}"></i>` + data.dislikes)
                }
            });
        });
    </script>
@endpush
