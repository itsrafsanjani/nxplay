@extends('frontend.layouts.app')

@section('content')
    <!-- page title -->
    <section class="section section--first section--bg" data-bg="{{ asset('img/section/section.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section__wrap">
                        <!-- section title -->
                        <h2 class="section__title">My NXPlay</h2>
                        <!-- end section title -->

                        <!-- breadcrumb -->
                        <ul class="breadcrumb">
                            <li class="breadcrumb__item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb__item breadcrumb__item--active">Profile</li>
                        </ul>
                        <!-- end breadcrumb -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end page title -->

    <!-- content -->
    <div class="content">
        <!-- profile -->
        <div class="profile">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="profile__content">
                            <div class="profile__user">
                                <div class="profile__avatar">
                                    <img src="{{ $user->avatar }}" alt="{{ $user->name }}">
                                </div>
                                <div class="profile__meta">
                                    <h3>{{ $user->name }}</h3>
                                    <span>NXPlay ID: {{ $user->id }}</span>
                                </div>
                            </div>

                            <!-- content tabs nav -->
                            <ul class="nav nav-tabs content__tabs content__tabs--profile" id="content__tabs"
                                role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#tab-1" role="tab"
                                       aria-controls="tab-1" aria-selected="true">
                                        Profile
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab"
                                       href="#tab-2" role="tab"
                                       aria-controls="tab-2" aria-selected="false">
                                        Subscription
                                    </a>
                                </li>
                            </ul>
                            <!-- end content tabs nav -->

                            <!-- content mobile tabs nav -->
                            <div class="content__mobile-tabs content__mobile-tabs--profile" id="content__mobile-tabs">
                                <div class="content__mobile-tabs-btn dropdown-toggle"
                                     role="navigation" id="mobile-tabs" data-toggle="dropdown"
                                     aria-haspopup="true" aria-expanded="false">
                                    <input type="button" value="Profile">
                                    <span></span>
                                </div>

                                <div class="content__mobile-tabs-menu dropdown-menu" aria-labelledby="mobile-tabs">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="1-tab"
                                               data-toggle="tab" href="#tab-1"
                                               role="tab" aria-controls="tab-1"
                                               aria-selected="true">
                                                Profile
                                            </a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link" id="2-tab" data-toggle="tab"
                                               href="#tab-2" role="tab" aria-controls="tab-2"
                                               aria-selected="false">
                                                Subscription
                                            </a></li>
                                    </ul>
                                </div>
                            </div>
                            <!-- end content mobile tabs nav -->

                            <button class="profile__logout" type="button"
                                    onclick="document.getElementById('logout-form').submit();">
                                <i class="icon ion-ios-log-out"></i>
                                <span>Logout</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end profile -->

        <div class="container">
            <!-- content tabs -->
            <div class="tab-content">
                <div class="tab-pane fade show active" id="tab-1" role="tabpanel" aria-labelledby="1-tab">
                    <div class="row">
                        <div class="col-12">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    @if($errors->count() === 1)
                                        <li>{{ $errors->first() }}</li>
                                    @else
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            @endif

                            @if(session()->has('message'))
                                <div class="alert alert-{{ session('type')}}">
                                    {{ session('message') }}
                                </div>
                            @endif
                        </div>
                        <!-- details form -->
                        <div class="col-12 col-lg-6">
                            <form action="{{ route('frontend.users.update', auth()->user()->id) }}" class="profile__form" method="POST">
                                @csrf
                                @method('PATCH')
                                <div class="row">
                                    <div class="col-12">
                                        <h4 class="profile__title">Profile details</h4>
                                    </div>

                                    <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                        <div class="profile__group">
                                            <label class="profile__label" for="name">Name</label>
                                            <input id="name" type="text" name="name" class="profile__input"
                                                   value="{{ $user->name }}">
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                        <div class="profile__group">
                                            <label class="profile__label" for="email">Email</label>
                                            <input id="email" type="text" name="email" class="profile__input"
                                                   value="{{ $user->email }}">
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="profile__group">
                                            <label class="profile__label">Provider ID</label>
                                            <input type="text" class="profile__input" placeholder="If you logged in with any social account then it will appear here."
                                                   value="{{ $user->provider_id }}" disabled>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <button class="profile__btn" type="submit">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- end details form -->

                        <!-- password form -->
                        <div class="col-12 col-lg-6">
                            <form action="{{ route('frontend.users.update', auth()->user()->id) }}" class="profile__form" method="POST">
                                @csrf
                                @method('PATCH')
                                <div class="row">
                                    <div class="col-12">
                                        <h4 class="profile__title">Change password</h4>
                                    </div>

                                    <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                        <div class="profile__group">
                                            <label class="profile__label" for="oldPassword">Old Password</label>
                                            <input id="oldPassword" type="password" name="old_password" class="profile__input">
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                        <div class="profile__group">
                                            <label class="profile__label" for="password">New Password</label>
                                            <input id="password" type="password" name="password" class="profile__input">
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                        <div class="profile__group">
                                            <label class="profile__label" for="confirmPassword">Confirm New Password</label>
                                            <input id="confirmPassword" type="password" name="password_confirmation"
                                                   class="profile__input">
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <button class="profile__btn" type="submit">Change</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- end password form -->
                    </div>
                </div>

                <div class="tab-pane fade" id="tab-2" role="tabpanel" aria-labelledby="2-tab">
                    <div class="row">
                        <!-- price -->
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="price price--profile">
                                <div class="price__item price__item--first"><span>Basic</span> <span>Free</span></div>
                                <div class="price__item"><span>7 days</span></div>
                                <div class="price__item"><span>720p Resolution</span></div>
                                <div class="price__item"><span>Limited Availability</span></div>
                                <div class="price__item"><span>Desktop Only</span></div>
                                <div class="price__item"><span>Limited Support</span></div>
                                <a href="#" class="price__btn">Choose Plan</a>
                            </div>
                        </div>
                        <!-- end price -->

                        <!-- price -->
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="price price--profile price--premium">
                                <div class="price__item price__item--first"><span>Premium</span> <span>$19.99</span>
                                </div>
                                <div class="price__item"><span>1 Month</span></div>
                                <div class="price__item"><span>Full HD</span></div>
                                <div class="price__item"><span>Lifetime Availability</span></div>
                                <div class="price__item"><span>TV & Desktop</span></div>
                                <div class="price__item"><span>24/7 Support</span></div>
                                <a href="#" class="price__btn">Choose Plan</a>
                            </div>
                        </div>
                        <!-- end price -->

                        <!-- price -->
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="price price--profile">
                                <div class="price__item price__item--first"><span>Cinematic</span> <span>$39.99</span>
                                </div>
                                <div class="price__item"><span>2 Months</span></div>
                                <div class="price__item"><span>Ultra HD</span></div>
                                <div class="price__item"><span>Lifetime Availability</span></div>
                                <div class="price__item"><span>Any Device</span></div>
                                <div class="price__item"><span>24/7 Support</span></div>
                                <a href="#" class="price__btn">Choose Plan</a>
                            </div>
                        </div>
                        <!-- end price -->
                    </div>
                </div>
            </div>
            <!-- end content tabs -->
        </div>
    </div>
    <!-- end content -->
@endsection
