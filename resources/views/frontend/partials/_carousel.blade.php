<!-- home -->
<section class="home">
    <!-- home bg -->
    <div class="owl-carousel home__bg">
        <div class="item home__cover" data-bg="{{ asset('img/home/home__bg.jpg') }}"></div>
        <div class="item home__cover" data-bg="{{ asset('img/home/home__bg2.jpg') }}"></div>
        <div class="item home__cover" data-bg="{{ asset('img/home/home__bg3.jpg') }}"></div>
        <div class="item home__cover" data-bg="{{ asset('img/home/home__bg4.jpg') }}"></div>
        <div class="item home__cover" data-bg="{{ asset('img/home/home__bg5.jpg') }}"></div>
    </div>
    <!-- end home bg -->

    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="home__title"><b>NEW MOVIE/SERIES</b> OF THIS SEASON</h1>

                <button class="home__nav home__nav--prev" type="button">
                    <i class="icon ion-ios-arrow-round-back"></i>
                </button>
                <button class="home__nav home__nav--next" type="button">
                    <i class="icon ion-ios-arrow-round-forward"></i>
                </button>
            </div>

            <div class="col-12">
                <div class="owl-carousel home__carousel">
                @foreach($newVideos as $newVideo)
                    <!-- card -->
                    <div class="card card--big">
                        <div class="card__cover">
                            <img src="{{ $newVideo->poster_url }}" alt="{{ $newVideo->title }}"/>
                            <a href="{{ route('frontend.videos.show', $newVideo->slug) }}" class="card__play">
                                <i class="icon ion-ios-play"></i>
                            </a>
                            <span class="card__rate @if($newVideo->imdb_rating>=7)card__rate--green @else card__rate--red @endif">{{ $newVideo->imdb_rating }}</span>
                        </div>
                        <div class="card__content">
                            <h3 class="card__title">
                                <a href="{{ route('frontend.videos.show', $newVideo->slug) }}">{{ $newVideo->title }}</a>
                            </h3>
                            <span class="card__category">
                                @php($i = 0)
                                @foreach(json_decode($newVideo->genres) as $genre)
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
                    <!-- end card -->
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end home -->
