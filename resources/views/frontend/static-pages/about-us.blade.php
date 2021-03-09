@extends('frontend.layouts.app')

@section('content')
    <!-- page title -->
    <section class="section section--first section--bg" data-bg="{{ asset('img/section/section.jpg') }}" style="background: url({{ asset('img/section/section.jpg') }}) center center / cover no-repeat;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section__wrap">
                        <!-- section title -->
                        <h2 class="section__title">About Us</h2>
                        <!-- end section title -->

                        <!-- breadcrumb -->
                        <ul class="breadcrumb">
                            <li class="breadcrumb__item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb__item breadcrumb__item--active">About Us</li>
                        </ul>
                        <!-- end breadcrumb -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end page title -->

    <!-- about -->
    <section class="section section--grid">
        <div class="container">
            <div class="row">
                <!-- section title -->
                <div class="col-12">
                    <h2 class="section__title"><b>{{ config('app.name') }}</b> – Best Place for Movies</h2>
                </div>
                <!-- end section title -->

                <!-- section text -->
                <div class="col-12">
                    <p class="section__text">It is a long <b>established</b> fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using.</p>

                    <p class="section__text section__text--last-with-margin">'Content here, content here', making it look like <a href="#">readable</a> English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>
                </div>
                <!-- end section text -->

                <!-- feature -->
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="feature">
                        <i class="icon ion-ios-tv feature__icon"></i>
                        <h3 class="feature__title">Ultra HD</h3>
                        <p class="feature__text">If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text.</p>
                    </div>
                </div>
                <!-- end feature -->

                <!-- feature -->
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="feature">
                        <i class="icon ion-ios-film feature__icon"></i>
                        <h3 class="feature__title">Film</h3>
                        <p class="feature__text">All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first.</p>
                    </div>
                </div>
                <!-- end feature -->

                <!-- feature -->
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="feature">
                        <i class="icon ion-ios-notifications feature__icon"></i>
                        <h3 class="feature__title">Notifications</h3>
                        <p class="feature__text">Various versions have evolved over the years, sometimes by accident, sometimes on purpose.</p>
                    </div>
                </div>
                <!-- end feature -->
            </div>
        </div>
    </section>
    <!-- end about -->

    <!-- how it works -->
    <section class="section section--grid section--border">
        <div class="container">
            <div class="row">
                <!-- section title -->
                <div class="col-12">
                    <h2 class="section__title section__title--no-margin">How it works?</h2>
                </div>
                <!-- end section title -->

                <!-- how box -->
                <div class="col-12 col-md-6">
                    <div class="how">
                        <span class="how__number">01</span>
                        <h3 class="how__title">Create an account</h3>
                        <p class="how__text">It has never been an issue to find an old movie or TV show on the internet. However, this is not the case with the new releases.</p>
                    </div>
                </div>
                <!-- end how box -->

                <!-- how box -->
                <div class="col-12 col-md-6">
                    <div class="how">
                        <span class="how__number">03</span>
                        <h3 class="how__title">Enjoy NXPlay!</h3>
                        <p class="how__text">It has never been an issue to find an old movie or TV show on the internet. However, this is not the case with the new releases.</p>
                    </div>
                </div>
                <!-- end how box -->
            </div>
        </div>
    </section>
    <!-- end how it works -->

    <!-- partners -->
    <section class="section section--grid section--border">
        <div class="container">
            <div class="row">
                <!-- section title -->
                <div class="col-12">
                    <h2 class="section__title section__title--no-margin">Our Partners</h2>
                </div>
                <!-- end section title -->

                <!-- section text -->
                <div class="col-12">
                    <p class="section__text section__text--last-with-margin">It is a long <b>established</b> fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using.</p>
                </div>
                <!-- end section text -->

                <!-- partner -->
                <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                    <a href="#" class="partner">
                        <img src="img/partners/themeforest-light-background.png" alt="" class="partner__img">
                    </a>
                </div>
                <!-- end partner -->

                <!-- partner -->
                <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                    <a href="#" class="partner">
                        <img src="img/partners/audiojungle-light-background.png" alt="" class="partner__img">
                    </a>
                </div>
                <!-- end partner -->

                <!-- partner -->
                <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                    <a href="#" class="partner">
                        <img src="img/partners/codecanyon-light-background.png" alt="" class="partner__img">
                    </a>
                </div>
                <!-- end partner -->

                <!-- partner -->
                <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                    <a href="#" class="partner">
                        <img src="img/partners/photodune-light-background.png" alt="" class="partner__img">
                    </a>
                </div>
                <!-- end partner -->

                <!-- partner -->
                <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                    <a href="#" class="partner">
                        <img src="img/partners/activeden-light-background.png" alt="" class="partner__img">
                    </a>
                </div>
                <!-- end partner -->

                <!-- partner -->
                <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                    <a href="#" class="partner">
                        <img src="img/partners/3docean-light-background.png" alt="" class="partner__img">
                    </a>
                </div>
                <!-- end partner -->
            </div>
        </div>
    </section>
    <!-- end partners -->
@endsection
