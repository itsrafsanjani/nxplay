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
                            @forelse($notifications as $notification)
                                <div class="d-md-flex align-items-center list-group-item list-group-item-action"
                                     aria-current="true">
                                    <img src="{{ $notification->data['user_avatar'] }}"
                                         alt="{{ $notification->data['user_name'] }}"
                                         style="height: 40px; width: auto;">
                                    <h4 class="notifications ml-md-2">{{ $notification->data['user_name'] }}</h4>
                                    <h4 class="notifications ml-md-2">
                                        Replied to your
                                        comment {{ str_replace('@'.auth()->user()->name, "", $notification->data['comment_comment_text']) }}
                                        {{ $notification->markAsRead() }} On
                                    </h4>
                                    <h4>
                                        <a
                                            href="{{ route('frontend.videos.show', $notification->data['video_slug']).'#reply'.$notification->data['comment_id'] }}"
                                            class="notifications ml-md-2">
                                            "{{ $notification->data['video_title'] }}"
                                        </a>
                                    </h4>
                                </div>
                            @empty
                                <li class="list-group-item">
                                    No notifications here!
                                </li>
                            @endforelse
                        </ul>
                    </div>
                </div>
                <!-- end section list -->
                <!-- paginator -->
                <div class="col-12">
                    <div class="paginator-wrap">
                        @if($notifications->total() > 20)
                            <span>20 from {{ $notifications->total() }}</span>
                        @else
                            <span>{{ $notifications->total() }} from {{ $notifications->total() }}</span>
                        @endif
                        {{ $notifications->links('backend.bulma') }}
                    </div>
                </div>
                <!-- end paginator -->
            </div>
        </div>
    </section>
    <!-- end privacy -->
@endsection
