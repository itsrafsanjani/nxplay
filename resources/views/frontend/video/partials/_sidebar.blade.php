<div class="col-12 col-lg-4 col-xl-4">
    <div class="row">
        <!-- section title -->
        <div class="col-12">
            <h2 class="section__title">You may also like...</h2>
        </div>
        <!-- end section title -->

        @foreach($similarVideos as $similarVideo)
            <!-- card -->
            <div class="col-6 col-sm-4 col-lg-6">
                <div class="card">
                    <div class="card__cover">
                        <img src="{{ $similarVideo->poster_url }}" alt="{{ $similarVideo->title }}">
                        <a href="{{ route('frontend.videos.show', $similarVideo->slug) }}" class="card__play">
                            <i class="icon ion-ios-play"></i>
                        </a>
                        <span class="card__rate @if($similarVideo->imdb_rating>=7)card__rate--green @else card__rate--red @endif">{{ $similarVideo->imdb_rating }}</span>
                    </div>
                    <div class="card__content">
                        <h3 class="card__title"><a href="{{ route('frontend.videos.show', $similarVideo->slug) }}">{{ $similarVideo->title }}</a></h3>
                        <span class="card__category">
                             @php($i = 0)
                            @foreach(json_decode($similarVideo->genres) as $genre)
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
        @endforeach
    </div>
</div>
