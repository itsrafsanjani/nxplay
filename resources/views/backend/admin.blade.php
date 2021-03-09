@extends('backend.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- main title -->
            <div class="col-12">
                <div class="main__title">
                    <h2>Dashboard</h2>

                    <a href="{{ route('videos.create') }}" class="main__title-link">add item</a>
                </div>
            </div>
            <!-- end main title -->

            <!-- stats -->
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="stats">
                    <span>Views this month</span>
                    <p>{{ $viewsThisMonth }}</p>
                    <i class="icon ion-ios-stats"></i>
                </div>
            </div>
            <!-- end stats -->

            <!-- stats -->
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="stats">
                    <span>Items added this month</span>
                    <p>{{ $itemsAddedThisMonth }}</p>
                    <i class="icon ion-ios-film"></i>
                </div>
            </div>
            <!-- end stats -->

            <!-- stats -->
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="stats">
                    <span>New comments</span>
                    <p>{{ $newComments }}</p>
                    <i class="icon ion-ios-chatbubbles"></i>
                </div>
            </div>
            <!-- end stats -->

            <!-- stats -->
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="stats">
                    <span>New reviews</span>
                    <p>{{ $newReviews }}</p>
                    <i class="icon ion-ios-star-half"></i>
                </div>
            </div>
            <!-- end stats -->

            <!-- dashbox -->
            <div class="col-12 col-xl-6">
                <div class="dashbox">
                    <div class="dashbox__title">
                        <h3><i class="icon ion-ios-trophy"></i> Top items</h3>

                        <div class="dashbox__wrap">
                            <a class="dashbox__refresh" href="#"><i class="icon ion-ios-refresh"></i></a>
                            <a class="dashbox__more" href="{{ route('videos.index') }}">View All</a>
                        </div>
                    </div>

                    <div class="dashbox__table-wrap">
                        <table class="main__table main__table--dash">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>TITLE</th>
                                <th>CATEGORY</th>
                                <th>RATING</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($topVideos as $topVideo)
                            <tr>
                                <td>
                                    <div class="main__table-text">{{ $topVideo->id }}</div>
                                </td>
                                <td>
                                    <div class="main__table-text">{{ $topVideo->title }}</div>
                                </td>
                                <td>
                                    <div class="main__table-text">{{ ucfirst($topVideo->type) }}</div>
                                </td>
                                <td>
                                    <div class="main__table-text main__table-text--rate"><i class="icon ion-ios-star"></i>
                                        {{ $topVideo->imdb_rating }}</div>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- end dashbox -->

            <!-- dashbox -->
            <div class="col-12 col-xl-6">
                <div class="dashbox">
                    <div class="dashbox__title">
                        <h3><i class="icon ion-ios-film"></i> Latest items</h3>

                        <div class="dashbox__wrap">
                            <a class="dashbox__refresh" href="#"><i class="icon ion-ios-refresh"></i></a>
                            <a class="dashbox__more" href="{{ route('videos.index') }}">View All</a>
                        </div>
                    </div>

                    <div class="dashbox__table-wrap">
                        <table class="main__table main__table--dash">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>TITLE</th>
                                <th>CATEGORY</th>
                                <th>STATUS</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($latestVideos as $latestVideo)
                            <tr>
                                <td>
                                    <div class="main__table-text">{{ $latestVideo->id }}</div>
                                </td>
                                <td>
                                    <div class="main__table-text">{{ $latestVideo->title }}</div>
                                </td>
                                <td>
                                    <div class="main__table-text">{{ ucfirst($latestVideo->type) }}</div>
                                </td>
                                <td>
                                    <div class="main__table-text @if($latestVideo->status == 1) main__table-text--green"> Published @else main__table-text--red"> Unpublished @endif</div>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- end dashbox -->

            <!-- dashbox -->
            <div class="col-12 col-xl-6">
                <div class="dashbox">
                    <div class="dashbox__title">
                        <h3><i class="icon ion-ios-contacts"></i> Latest users</h3>

                        <div class="dashbox__wrap">
                            <a class="dashbox__refresh" href="#"><i class="icon ion-ios-refresh"></i></a>
                            <a class="dashbox__more" href="{{ route('users.index') }}">View All</a>
                        </div>
                    </div>

                    <div class="dashbox__table-wrap">
                        <table class="main__table main__table--dash">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>FULL NAME</th>
                                <th>EMAIL</th>
                                <th>Last Login At</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($latestUsers as $latestUser)
                            <tr>
                                <td>
                                    <div class="main__table-text">{{ $latestUser->id }}</div>
                                </td>
                                <td>
                                    <div class="main__table-text">{{ $latestUser->name }}</div>
                                </td>
                                <td>
                                    <div class="main__table-text main__table-text--grey">{{ $latestUser->email }}</div>
                                </td>
                                <td>
                                    <div class="main__table-text">{{ $latestUser->last_login_at->diffForHumans() }}</div>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- end dashbox -->

            <!-- dashbox -->
            <div class="col-12 col-xl-6">
                <div class="dashbox">
                    <div class="dashbox__title">
                        <h3><i class="icon ion-ios-star-half"></i> Latest reviews</h3>

                        <div class="dashbox__wrap">
                            <a class="dashbox__refresh" href="#"><i class="icon ion-ios-refresh"></i></a>
                            <a class="dashbox__more" href="{{ route('reviews.index') }}">View All</a>
                        </div>
                    </div>

                    <div class="dashbox__table-wrap">
                        <table class="main__table main__table--dash">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>ITEM</th>
                                <th>AUTHOR</th>
                                <th>RATING</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($latestReviews as $latestReview)
                            <tr>
                                <td>
                                    <div class="main__table-text">{{ $latestReview->id }}</div>
                                </td>
                                <td>
                                    <div class="main__table-text">{{ $latestReview->title }}</div>
                                </td>
                                <td>
                                    <div class="main__table-text">{{ $latestReview->user->name }}</div>
                                </td>
                                <td>
                                    <div class="main__table-text main__table-text--rate"><i class="icon ion-ios-star"></i>
                                        {{ $latestReview->rating }}</div>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- end dashbox -->
        </div>
    </div>
@endsection
