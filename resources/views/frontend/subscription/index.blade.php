@extends('frontend.layouts.app')

@section('content')
    <!-- page title -->
    <section class="section section--first section--bg" data-bg="img/section/section.jpg">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section__wrap">
                        <!-- section title -->
                        <h2 class="section__title">Pricing plan</h2>
                        <!-- end section title -->

                        <!-- breadcrumb -->
                        <ul class="breadcrumb">
                            <li class="breadcrumb__item"><a href="#">Home</a></li>
                            <li class="breadcrumb__item breadcrumb__item--active">Pricing plan</li>
                        </ul>
                        <!-- end breadcrumb -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end page title -->

    <!-- pricing -->
    <div class="section">
        <div class="container">
            <div class="row">
                <!-- plan features -->
                <div class="col-12">
                    <ul class="row plan-features">
                        <li class="col-12 col-md-6 col-lg-4">7 days unlimited access!</li>
                        <li class="col-12 col-md-6 col-lg-4">Stream on your phone, laptop, tablet or TV.</li>
                        <li class="col-12 col-md-6 col-lg-4">Awesome UI.</li>
                        <li class="col-12 col-md-6 col-lg-4">Thousands of TV shows, movies & more.</li>
                        <li class="col-12 col-md-6 col-lg-4">You can even Download & watch offline.</li>
                        <li class="col-12 col-md-6 col-lg-4">Fast servers.</li>
                    </ul>
                </div>
                <!-- end plan features -->

                <form action="{{ route('frontend.subscriptions.store') }}" method="post" style="display: none"
                      id="planValueForm">
                    @csrf
                    <input type="text" name="plan" id="planValue">
                </form>

                <!-- price -->
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="price">
                        <div class="price__item price__item--first"><span>Basic: Monthly BDT 100</span></div>
                        <div class="price__item"><span>480p Resolution</span></div>
                        <div class="price__item"><span>Good Video Quality</span></div>
                        <div class="price__item"><span>Watch from anywhere</span></div>
                        <button type="button" class="price__btn"
                                onclick="document.getElementById('planValue').value='1';
                                document.getElementById('planValueForm').submit();">Choose Plan
                        </button>
                    </div>
                </div>
                <!-- end price -->

                <!-- price -->
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="price price--premium">
                        <div class="price__item price__item--first"><span>Standard: Monthly BDT 150</span></div>
                        <div class="price__item"><span>720p Resolution</span></div>
                        <div class="price__item"><span>Good Video Quality</span></div>
                        <div class="price__item"><span>Watch from anywhere</span></div>
                        <button type="button" class="price__btn"
                                onclick="document.getElementById('planValue').value='2';
                                document.getElementById('planValueForm').submit();">Choose Plan
                        </button>
                    </div>
                </div>
                <!-- end price -->

                <!-- price -->
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="price">
                        <div class="price__item price__item--first"><span>Premium: Monthly BDT 200</span></div>
                        <div class="price__item"><span>1080p+4K Resolution</span></div>
                        <div class="price__item"><span>Good Video Quality</span></div>
                        <div class="price__item"><span>Watch from anywhere</span></div>
                        <button type="button" class="price__btn"
                                onclick="document.getElementById('planValue').value='3';
                                document.getElementById('planValueForm').submit();">Choose Plan
                        </button>
                    </div>
                </div>
                <!-- end price -->
            </div>
        </div>
    </div>
    <!-- end pricing -->
@endsection
