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
                        <ul class="list-group">
                            @forelse($user->notifications as $notification)
                                <div
                                   class="list-group-item list-group-item-action" aria-current="true">
                                    <div style="display: flex; align-items: center;">
                                        <img src="{{ $notification->data['user']['avatar'] }}" alt="{{ $notification->data['user']['name'] }}"
                                        style="height: 40px; width: auto;">
                                        <p class="my-css-notifications" style="padding: 10px">
                                            {{ $notification->data['user']['name'] }}
                                        </p>
                                        <p class="my-css-notifications" style="margin-right: 10px">
                                            Replied to your
                                            comment {{ str_replace('@'.auth()->user()->name, "", $notification->data['reply']['comment_text']) }}
                                            {{ $notification->markAsRead() }} On
                                        </p>
                                        <a href="{{ route('frontend.videos.show', $notification->data['video']['slug']) }}">
                                            {{ $notification->data['video']['title'] }}
                                        </a>
                                    </div>

                                </div>
                            @empty
                                <li class="list-group-item">
                                    No notifications here!
                                </li>
                            @endforelse
{{--                            @forelse($user->unreadNotifications as $notification)--}}
{{--                                <li class="list-group-item" style="color:  #333">--}}
{{--                                    {{ $notification->data['user']['name'] }} Replied to your--}}
{{--                                    comment {{ $notification->data['reply']['comment_text'] }}--}}
{{--                                </li>--}}
{{--                            @empty--}}
{{--                                <li class="list-group-item">--}}
{{--                                    No unread notifications here!--}}
{{--                                </li>--}}
{{--                            @endforelse--}}
                        </ul>
                    </div>
                </div>
                <!-- end section list -->
            </div>
        </div>
    </section>
    <!-- end privacy -->
@endsection
