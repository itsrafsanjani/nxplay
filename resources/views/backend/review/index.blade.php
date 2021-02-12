@extends('backend.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- main title -->
            <div class="col-12">
                <div class="main__title">
                    <h2>Reviews</h2>

                    <span class="main__title-stat">{{ $reviews->total() }} Total</span>

                    <div class="main__title-wrap">
                        <!-- filter sort -->
                        <div class="filter" id="filter__sort">
                            <span class="filter__item-label">Sort by:</span>

                            <div class="filter__item-btn dropdown-toggle"
                                 role="navigation" id="filter-sort" data-toggle="dropdown"
                                 aria-haspopup="true" aria-expanded="false">
                                <input type="button" value="Date created">
                                <span></span>
                            </div>

                            <ul class="filter__item-menu dropdown-menu scrollbar-dropdown"
                                aria-labelledby="filter-sort">
                                <li>Date created</li>
                                <li>Pricing plan</li>
                                <li>Status</li>
                            </ul>
                        </div>
                        <!-- end filter sort -->

                        <!-- search -->
                        <form action="#" class="main__title-form">
                            <input type="text" placeholder="Find user..">
                            <button type="button">
                                <i class="icon ion-ios-search"></i>
                            </button>
                        </form>
                        <!-- end search -->
                    </div>
                </div>

                @if(session()->has('message'))
                    <div class="alert alert-{{ session('type')}}">
                        {{ session('message') }}
                    </div>
                @endif

            </div>
            <!-- end main title -->

            <!-- users -->
            <div class="col-12">
                <div class="main__table-wrap">
                    <table class="main__table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>VIDEO TITLE</th>
                            <th>USER NAME</th>
                            <th>REVIEW TITLE</th>
                            <th>REVIEW BODY</th>
                            <th>RATING</th>
                            <th>CREATED AT</th>
                            <th>ACTIONS</th>
                        </tr>
                        </thead>

                        <tbody>

                        @foreach($reviews as $review)

                            <tr>
                                <td>
                                    <div class="main__table-text">{{ $review->id }}</div>
                                </td>
                                <td>
                                    <div class="main__table-text">
                                        <a href="{{ route('frontend.videos.show', $review->video->slug) }}">
                                            {{ $review->video->title }}
                                        </a>
                                    </div>
                                </td>
                                <td>
                                    <div class="main__table-text">
                                        <a href="{{ route('frontend.users.show', $review->user->id) }}">
                                            {{ $review->user->name }}
                                        </a>
                                    </div>
                                </td>
                                <td>
                                    <div
                                        class="main__table-text">{{ \Illuminate\Support\Str::limit($review->title, 20) }}
                                    </div>
                                </td>
                                <td>
                                    <div
                                        class="main__table-text">{{ \Illuminate\Support\Str::limit($review->body, 20) }}
                                    </div>
                                </td>
                                <td>
                                    <div
                                        class="main__table-text"><i class="icon ion-ios-star"></i> {{ $review->rating }}
                                    </div>
                                </td>
                                <td>
                                    <div class="main__table-text" title="{{ $review->created_at }}">
                                        {{ $review->created_at->diffForHumans() }}
                                    </div>
                                </td>
                                <td>
                                    <div class="main__table-btns">
                                        <a href="{{ route('reviews.show', $review->id) }}" class="main__table-btn main__table-btn--banned">
                                            <i class="icon ion-ios-eye"></i>
                                        </a>
                                        <a href="{{ route('reviews.edit', $review->id) }}"
                                           class="main__table-btn main__table-btn--edit">
                                            <i class="icon ion-ios-create"></i>
                                        </a>

                                        <form action="{{ route('reviews.destroy', $review->id) }}" method="POST"
                                              onsubmit="return confirm('Are you sure to delete data?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="main__table-btn main__table-btn--delete">
                                                <i class="icon ion-ios-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
            <!-- end users -->

            <!-- paginator -->
            <div class="col-12">
                <div class="paginator-wrap">
                    @if($reviews->total() > 20)
                        <span>20 from {{ $reviews->total() }}</span>
                    @else
                        <span>{{ $reviews->total() }} from {{ $reviews->total() }}</span>
                    @endif
                    {{ $reviews->links('backend.bulma') }}
                </div>
            </div>
            <!-- end paginator -->
        </div>
    </div>
@endsection
