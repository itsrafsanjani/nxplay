<!-- header -->
<header class="header">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="header__content">
                    <!-- header logo -->
                    <a href="/" class="header__logo">
                        <img src="{{ asset('img/logo.svg') }}" alt="nxplay logo">
                    </a>
                    <!-- end header logo -->

                    <!-- header nav -->
                    <ul class="header__nav">
                        <li class="header__nav-item">
                            <a href="{{ route('home') }}" class="header__nav-link">Home</a>
                        </li>

                        <li class="header__nav-item">
                            <a href="{{ route('frontend.videos.index') }}" class="header__nav-link">Catalog</a>
                        </li>

{{--                        <li class="header__nav-item">--}}
{{--                            <a href="#" class="header__nav-link">Pricing Plan</a>--}}
{{--                        </li>--}}

                        <li class="header__nav-item">
                            <a href="{{ route('about_us') }}" class="header__nav-link">About Us</a>
                        </li>

                        <li class="header__nav-item">
                            <a href="{{ route('subscriptions.index') }}" class="header__nav-link">Subscription</a>
                        </li>
                    </ul>
                    <!-- end header nav -->

                    <!-- header auth -->
                    <div class="header__auth">
                        <form action="{{ route('frontend.search.index') }}" class="header__search">
                            <input class="header__search-input" type="text" name="q"
                                   placeholder="Search..." value="@if(! empty($query)) {{ $query }} @endif">
                            <button class="header__search-button" type="submit">
                                <i class="icon ion-ios-search"></i>
                            </button>
                            <button class="header__search-close" type="button">
                                <i class="icon ion-md-close"></i>
                            </button>
                        </form>

                        <button class="header__search-btn" type="button">
                            <i class="icon ion-ios-search"></i>
                        </button>

{{--                        <a href="{{ route('frontend.notifications.index') }}" style="font-size: 32px; margin: 0 10px 0 18px;"><i class="icon ion-ios-notifications"></i><span class="badge badge-light">@auth {{ auth()->user()->unreadNotifications->count() }} @endauth</span></a>--}}
                        @auth
                            <button type="button" class="btn btn-primary btn-sm d-none d-md-block" onclick="window.location.href='{{ route('frontend.notifications.index') }}'">
                            <i class="icon ion-ios-notifications" style="font-size: 20px;"></i>  @if(auth()->user()->unreadNotifications->count() > 0)<span class="badge badge-light">{{ auth()->user()->unreadNotifications->count() }} </span>@endif
                        </button>
                        @endauth

                        @guest
                            <a href="{{ route('login') }}" class="header__sign-in">
                                <i class="icon ion-ios-log-in"></i>
                                <span>sign in</span>
                            </a>

                        @else
                            <div class="dropdown" style="margin-left: 10px">
                                <button type="button"
                                        id="dropdownMenuButton"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    @if(auth()->user()->avatar)
                                        <img src="{{ auth()->user()->avatar }}" alt="{{ auth()->user()->name }}"
                                             style="border: 2px solid #1eff0e; border-radius: 50%; width: 39px; height: auto; float: left; margin-right: 7px;">
                                    @else
                                        <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}" alt="{{ auth()->user()->name }}"
                                             style="border: 2px solid #1eff0e; border-radius: 50%; width: 39px; height: auto; float: left; margin-right: 7px;">
                                    @endif
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="{{ route('frontend.users.show', auth()->user()->id) }}">
                                        <i class="icon ion-ios-person" style="margin-right: 5px"></i> {{ Auth::user()->name }}
                                    </a>
                                    @if(auth()->user()->role == 1)
                                        <a class="dropdown-item" href="{{ route('admin') }}">
                                            <i class="icon ion-ios-home" style="margin-right: 5px"></i>Dashboard
                                        </a>
                                    @endif
                                    <a class="dropdown-item" href="{{ route('frontend.notifications.index') }}" style="display: flex; align-items: center">
                                        <i class="icon ion-ios-notifications" style="margin-right: 5px"></i> Notifications @if(auth()->user()->unreadNotifications->count() > 0)<span class="badge badge-dark ml-2">{{ auth()->user()->unreadNotifications->count() }} </span>@endif
                                    </a>
                                    <a class="dropdown-item" href="{{ route('frontend.users.show', auth()->user()->id) }}" style="display: flex; align-items: center">
                                        <i class="icon ion-ios-settings" style="margin-right: 5px"></i> Settings
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="icon ion-ios-log-out" style="margin-right: 5px"></i> {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                            <!-- end header auth -->
                        @endguest

                            <!-- header menu btn -->
                            <button class="header__btn" type="button">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <!-- end header menu btn -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- end header -->
