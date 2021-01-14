<!-- section -->
<section class="section section--bg" data-bg="img/section/section.jpg">
    <div class="container">
        <div class="row">
            <!-- section title -->
            <div class="col-12">
                <div class="section__title-wrap">
                    <h2 class="section__title section__title--carousel">
                        Popular Movie/Series
                    </h2>

                    <div class="section__nav-wrap">
                        <a href="#" class="section__view">View All</a>

                        <button class="section__nav section__nav--prev" type="button" data-nav="#carousel1">
                            <i class="icon ion-ios-arrow-back"></i>
                        </button>

                        <button class="section__nav section__nav--next" type="button" data-nav="#carousel1">
                            <i class="icon ion-ios-arrow-forward"></i>
                        </button>
                    </div>
                </div>
            </div>
            <!-- end section title -->

            <!-- carousel -->
            <div class="col-12">
                <div class="owl-carousel section__carousel" id="carousel1">
                    <!-- card -->
                    @foreach($popularVideos as $popularVideo)
                        <div class="card">
                            <div class="card__cover">
                                <img src="{{ $popularVideo->poster }}" alt="{{ $popularVideo->title }}"/>
                                <a href="{{ route('frontend.videos.show', $popularVideo->slug) }}" class="card__play">
                                    <i class="icon ion-ios-play"></i>
                                </a>
                                <span
                                    class="card__rate @if($popularVideo->imdb_rating>=7)card__rate--green @else card__rate--red @endif">{{ $popularVideo->imdb_rating }}</span>
                            </div>
                            <div class="card__content">
                                <h3 class="card__title">
                                    <a href="{{ route('frontend.videos.show', $popularVideo->slug) }}">{{ $popularVideo->title }}</a>
                                </h3>
                                <span class="card__category">
                                @php($i = 0)
                                    @foreach(json_decode($popularVideo->genres) as $genre)
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
            <!-- carousel -->
        </div>
    </div>
</section>
<!-- end section -->
