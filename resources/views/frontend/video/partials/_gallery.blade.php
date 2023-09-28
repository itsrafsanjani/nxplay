<div class="gallery" itemscope>
    <div class="row">
    @foreach($video->photoUrls as $photoUrl)
        <!-- gallery item -->
            <figure class="col-12 col-sm-6 col-xl-4" itemprop="associatedMedia" itemscope>
                <a href="{{ $photoUrl }}"
                   itemprop="contentUrl" data-size="1920x1280">
                    <img src="{{ $photoUrl }}"
                         itemprop="thumbnail"
                         alt="Image description"/>
                </a>
                {{--                                    <figcaption itemprop="caption description">Some image caption 1</figcaption>--}}
            </figure>
    @endforeach
    <!-- end gallery item -->
    </div>
</div>
