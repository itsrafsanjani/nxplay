<!-- sidebar -->
<div class="sidebar">
    <!-- sidebar logo -->
    <a href="{{ route('admin') }}" class="sidebar__logo">
        <img src="{{ asset('img/logo.svg') }}" alt="">
    </a>
    <!-- end sidebar logo -->

    <!-- sidebar user -->
    <div class="sidebar__user">
        <div class="sidebar__user-img">
            <img src="{{ asset('img/user.svg') }}" alt="">
        </div>

        <div class="sidebar__user-title">
            <span>Admin</span>
            <p>John Doe</p>
        </div>

        <a href="{{ route('logout') }}" class="sidebar__user-btn" type="button" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="icon ion-ios-log-out"></i>
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
    <!-- end sidebar user -->

    <!-- sidebar nav -->
    <ul class="sidebar__nav">
        <li class="sidebar__nav-item">
            <a href="{{ route('admin') }}" class="sidebar__nav-link {{ request()->routeIs('admin') ? 'sidebar__nav-link--active' : '' }}"><i class="icon ion-ios-keypad"></i> Dashboard</a>
        </li>

        <li class="sidebar__nav-item">
            <a href="{{ route('videos.index') }}" class="sidebar__nav-link {{ request()->routeIs('videos.index') ? 'sidebar__nav-link--active' : '' }}"><i class="icon ion-ios-film"></i> Catalog</a>
        </li>

        <li class="sidebar__nav-item">
            <a href="{{ route('users.index') }}" class="sidebar__nav-link"><i class="icon ion-ios-contacts"></i> Users</a>
        </li>

        <li class="sidebar__nav-item">
            <a href="#" class="sidebar__nav-link"><i class="icon ion-ios-chatbubbles"></i> Comments</a>
        </li>

        <li class="sidebar__nav-item">
            <a href="#" class="sidebar__nav-link"><i class="icon ion-ios-star-half"></i> Reviews</a>
        </li>

        <!-- dropdown -->
        <li class="dropdown sidebar__nav-item">
            <a class="dropdown-toggle sidebar__nav-link" href="#" role="button" id="dropdownMenuMore" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icon ion-ios-copy"></i> Pages</a>

            <ul class="dropdown-menu sidebar__dropdown-menu scrollbar-dropdown" aria-labelledby="dropdownMenuMore">
                <li><a href="#">Add item</a></li>
                <li><a href="#">Edit user</a></li>
                <li><a href="#">Sign In</a></li>
                <li><a href="#">Sign Up</a></li>
                <li><a href="#">Forgot password</a></li>
                <li><a href="#">404 Page</a></li>
            </ul>
        </li>
        <!-- end dropdown -->
    </ul>
    <!-- end sidebar nav -->

    <!-- sidebar copyright -->
    <div class="sidebar__copyright">© 2020 {{ config('app.name') }}. <br>Create by <a href="#" target="_blank">Md Rafsan Jani Rafin</a></div>
    <!-- end sidebar copyright -->
</div>
<!-- end sidebar -->
