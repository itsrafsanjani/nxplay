<div class="gallery" itemscope>
    <div class="row">
    @foreach(json_decode($video->photos) as $photo)
        <!-- gallery item -->
            <figure class="col-12 col-sm-6 col-xl-4" itemprop="associatedMedia" itemscope>
                <a href="https://imdb-api.com/images/1920x1280/{{ $photo }}"
                   itemprop="contentUrl" data-size="1920x1280">
                    <img src="https://imdb-api.com/images/480x360/{{ $photo }}"
                         itemprop="thumbnail"
                         alt="Image description"/>
                </a>
                {{--                                    <figcaption itemprop="caption description">Some image caption 1</figcaption>--}}
            </figure>
    @endforeach
    <!-- end gallery item -->
    </div>
</div>
