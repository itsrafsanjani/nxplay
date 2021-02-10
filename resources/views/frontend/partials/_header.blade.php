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
                        <!-- dropdown -->
                        <li class="header__nav-item">
                            <a class="dropdown-toggle header__nav-link" href="#" role="button" id="dropdownMenuHome"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Home</a>

                            <ul class="dropdown-menu header__dropdown-menu" aria-labelledby="dropdownMenuHome">
                                <li><a href="/">Home slideshow bg</a></li>
                                <li><a href="#">Home static bg</a></li>
                            </ul>
                        </li>
                        <!-- end dropdown -->

                        <!-- dropdown -->
                        <li class="header__nav-item">
                            <a class="dropdown-toggle header__nav-link" href="#" role="button" id="dropdownMenuCatalog"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Catalog</a>

                            <ul class="dropdown-menu header__dropdown-menu" aria-labelledby="dropdownMenuCatalog">
                                <li><a href="#">Catalog</a></li>
                                <li><a href="#">Movie Detail</a></li>
                            </ul>
                        </li>
                        <!-- end dropdown -->

                        <li class="header__nav-item">
                            <a href="#" class="header__nav-link">Pricing Plan</a>
                        </li>

                        <li class="header__nav-item">
                            <a href="#" class="header__nav-link">Help</a>
                        </li>

                        <!-- dropdown -->
                        <li class="dropdown header__nav-item">
                            <a class="dropdown-toggle header__nav-link" href="#" role="button" id="dropdownMenuMore"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">More</a>

                            <ul class="dropdown-menu header__dropdown-menu" aria-labelledby="dropdownMenuMore" style="">
                                <li><a href="#">About</a></li>
                                <li><a href="#">Profile</a></li>
                                <li><a href="#">Sign In</a></li>
                                <li><a href="#">Sign Up</a></li>
                                <li><a href="#">Forgot password</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                                <li><a href="#">Contacts</a></li>
                                <li><a href="#">404 Page</a></li>
                            </ul>
                        </li>
                        <!-- end dropdown -->
                    </ul>
                    <!-- end header nav -->

                    <!-- header auth -->
                    <div class="header__auth">
                        <form action="#" class="header__search">
                            <input class="header__search-input" type="text" placeholder="Search...">
                            <button class="header__search-button" type="button">
                                <i class="icon ion-ios-search"></i>
                            </button>
                            <button class="header__search-close" type="button">
                                <i class="icon ion-md-close"></i>
                            </button>
                        </form>

                        <button class="header__search-btn" type="button">
                            <i class="icon ion-ios-search"></i>
                        </button>

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
                                        {{ Auth::user()->name }}
                                    </a>
                                    @if(auth()->user()->role == 1)
                                        <a class="dropdown-item" href="{{ route('admin') }}">
                                            Dashboard
                                        </a>
                                    @endif

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
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
