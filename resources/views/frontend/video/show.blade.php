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
                                    <img src="https://imdb-api.com/posters/w300/{{ $video->poster }}" alt="{{ $video->title }}">
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
                                                <form action="{{ route('frontend.video_like_or_dislike') }}"
                                                      method="post" id="likeDislikeForm" style="display: inline-flex">
                                                    @csrf
                                                    <input type="hidden" name="video_id" value="{{ $video->id }}">
                                                    <input type="hidden" name="user_id"
                                                           value="{{ auth()->user()->id }}">
                                                    <input type="hidden" name="status" id="status">
                                                    <button type="button" title="I Like this" id="likebtn"
                                                            onclick="document.getElementById('status').value='1';
                                                            document.getElementById('likeDislikeForm').submit();">
                                                        <i class="icon ion-md-thumbs-up"
                                                           style="font-size: 20px; margin-right: 6px; {{ $video->islikedBy(auth()->user()) ? 'color: #00ff70;' : 'color: #fff' }}"></i>
                                                        {{ $video->videoLikes->count() }}</button>
                                                    <button type="button" title="I Don't Like this" id="dislikebtn"
                                                            onclick="document.getElementById('status').value='0';
                                                            document.getElementById('likeDislikeForm').submit();">
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
                    <video controls crossorigin playsinline
                           poster="https://imdb-api.com/posters/w300/{{ $video->poster }}" id="player">
                        <!-- Video files -->
{{--                        <source src="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-576p.mp4" type="video/mp4" size="576">--}}
{{--                        <source src="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-720p.mp4" type="video/mp4" size="720">--}}
                        <source src="{{ asset($video->video) }}" type="video/mp4" size="1080">
                        <!-- Caption files -->
                        <track kind="captions" label="English" srclang="en"
                               src="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-HD.en.vtt"
                               default>
                        <track kind="captions" label="Français" srclang="fr"
                               src="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-HD.fr.vtt">
                        <!-- Fallback for browsers that don't support the <video> element -->
                        <a href="{{ asset($video->video) }}" download>Download</a>
                    </video>
                </div>
                <!-- end player -->
            </div>
        </div>
        <!-- end details content -->
    </section>
    <!-- end details -->
    @include('frontend.video.discover')
@endsection

{{--@push('javascripts')--}}
{{--    <script type="text/javascript">--}}

{{--        $.ajaxSetup({--}}
{{--            headers: {--}}
{{--                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
{{--            }--}}
{{--        });--}}

{{--        $("#likebtn").click(function(e){--}}

{{--            let video_id = $("input[name=video_id]").val();--}}
{{--            let status = 1;--}}
{{--            let user_id = $("input[name=user_id]").val();--}}

{{--            $.ajax({--}}
{{--                type:'POST',--}}
{{--                url:"{{ route('frontend.video_like_or_dislike') }}",--}}
{{--                data:{video_id:video_id, status:status, user_id:user_id},--}}
{{--                // success:function(data){--}}
{{--                //     alert(data.success);--}}
{{--                // }--}}
{{--            });--}}

{{--            $(document).ajaxStop(function(){--}}
{{--                window.location.reload();--}}
{{--            });--}}

{{--        });--}}

{{--        $("#dislikebtn").click(function(e){--}}

{{--            let video_id = $("input[name=video_id]").val();--}}
{{--            let status = 0;--}}
{{--            let user_id = $("input[name=user_id]").val();--}}

{{--            $.ajax({--}}
{{--                type:'POST',--}}
{{--                url:"{{ route('frontend.video_like_or_dislike') }}",--}}
{{--                data:{video_id:video_id, status:status, user_id:user_id},--}}
{{--                // success:function(data){--}}
{{--                //     alert(data.success);--}}
{{--                // }--}}
{{--            });--}}

{{--            $(document).ajaxStop(function(){--}}
{{--                window.location.reload();--}}
{{--            });--}}

{{--        });--}}
{{--    </script>--}}
{{--@endpush--}}
