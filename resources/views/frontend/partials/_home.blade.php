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
                <h1 class="home__title"><b>NEW ITEMS</b> OF THIS SEASON</h1>

                <button class="home__nav home__nav--prev" type="button">
                    <i class="icon ion-ios-arrow-round-back"></i>
                </button>
                <button class="home__nav home__nav--next" type="button">
                    <i class="icon ion-ios-arrow-round-forward"></i>
                </button>
            </div>

            <div class="col-12">
                <div class="owl-carousel home__carousel">
                    <!-- card -->
                    <div class="card card--big">
                        <div class="card__cover">
                            <img src="{{ asset('img/covers/cover.jpg') }}" alt="" />
                            <a href="#" class="card__play">
                                <i class="icon ion-ios-play"></i>
                            </a>
                            <span class="card__rate card__rate--green">8.4</span>
                        </div>
                        <div class="card__content">
                            <h3 class="card__title">
                                <a href="#">I Dream in Another Language</a>
                            </h3>
                            <span class="card__category">
                    <a href="#">Action</a>
                    <a href="#">Triler</a>
                  </span>
                        </div>
                    </div>
                    <!-- end card -->

                    <!-- card -->
                    <div class="card card--big">
                        <div class="card__cover">
                            <img src="{{ asset('img/covers/cover2.jpg') }}" alt="" />
                            <a href="#" class="card__play">
                                <i class="icon ion-ios-play"></i>
                            </a>
                            <span class="card__rate card__rate--green">7.1</span>
                        </div>
                        <div class="card__content">
                            <h3 class="card__title"><a href="#">Benched</a></h3>
                            <span class="card__category">
                    <a href="#">Comedy</a>
                  </span>
                        </div>
                    </div>
                    <!-- end card -->

                    <!-- card -->
                    <div class="card card--big">
                        <div class="card__cover">
                            <img src="{{ asset('img/covers/cover3.jpg') }}" alt="" />
                            <a href="#" class="card__play">
                                <i class="icon ion-ios-play"></i>
                            </a>
                            <span class="card__rate card__rate--red">6.3</span>
                        </div>
                        <div class="card__content">
                            <h3 class="card__title"><a href="#">Whitney</a></h3>
                            <span class="card__category">
                    <a href="#">Romance</a>
                    <a href="#">Drama</a>
                  </span>
                        </div>
                    </div>
                    <!-- end card -->

                    <!-- card -->
                    <div class="card card--big">
                        <div class="card__cover">
                            <img src="{{ asset('img/covers/cover4.jpg') }}" alt="" />
                            <a href="#" class="card__play">
                                <i class="icon ion-ios-play"></i>
                            </a>
                            <span class="card__rate card__rate--green">7.9</span>
                        </div>
                        <div class="card__content">
                            <h3 class="card__title"><a href="#">Blindspotting</a></h3>
                            <span class="card__category">
                    <a href="#">Comedy</a>
                    <a href="#">Drama</a>
                  </span>
                        </div>
                    </div>
                    <!-- end card -->

                    <!-- card -->
                    <div class="card card--big">
                        <div class="card__cover">
                            <img src="{{ asset('img/covers/cover5.jpg') }}" alt="" />
                            <a href="#" class="card__play">
                                <i class="icon ion-ios-play"></i>
                            </a>
                            <span class="card__rate card__rate--green">7.9</span>
                        </div>
                        <div class="card__content">
                            <h3 class="card__title"><a href="#">Blindspotting</a></h3>
                            <span class="card__category">
                    <a href="#">Comedy</a>
                    <a href="#">Drama</a>
                  </span>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end home -->
