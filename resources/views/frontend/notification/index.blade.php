@extends('frontend.layouts.app')

@section('content')
    <!-- page title -->
    <section class="section section--first section--bg" data-bg="{{ asset('img/section/section.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section__wrap">
                        <!-- section title -->
                        <h2 class="section__title">Notifications</h2>
                        <!-- end section title -->

                        <!-- breadcrumb -->
                        <ul class="breadcrumb">
                            <li class="breadcrumb__item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb__item breadcrumb__item--active">Notifications</li>
                        </ul>
                        <!-- end breadcrumb -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end page title -->

    <!-- privacy -->
    <section class="section">
        <div class="container">
            <div class="row">
                <!-- section list -->
                <div class="col-12">
                    <div class="section__list">
                        <ol>
                        @forelse($user->notifications as $notification)
                                <li>
                                    <h4>{{ $notification->data['user']['name'] }} Replied to your
                                        comment {{ $notification->data['reply']['comment_text'] }}</h4>
                                </li>
                        @empty
                                <li>
                                    <h4> No notifications here!</h4>
                                </li>
                        @endforelse
                        </ol>
                    </div>
                </div>
                <!-- end section list -->
            </div>
        </div>
    </section>
    <!-- end privacy -->
@endsection
