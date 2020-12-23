@extends('backend.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- main title -->
            <div class="col-12">
                <div class="main__title">
                    <h2>Catalog</h2>

                    <span class="main__title-stat">{{ $videos->total() }} Total</span>

                    <div class="main__title-wrap">
                        <!-- filter sort -->
                        <div class="filter" id="filter__sort">
                            <span class="filter__item-label">Sort by:</span>

                            <div class="filter__item-btn dropdown-toggle" role="navigation" id="filter-sort" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <input type="button" value="Date created">
                                <span></span>
                            </div>

                            <ul class="filter__item-menu dropdown-menu scrollbar-dropdown" aria-labelledby="filter-sort">
                                <li>Date created</li>
                                <li>Rating</li>
                                <li>Views</li>
                            </ul>
                        </div>
                        <!-- end filter sort -->

                        <!-- search -->
                        <form action="#" class="main__title-form">
                            <input type="text" placeholder="Find movie / tv series..">
                            <button type="button">
                                <i class="icon ion-ios-search"></i>
                            </button>
                        </form>
                        <!-- end search -->
                    </div>
                    <a href="{{ route('videos.create') }}" class="main__title-link">add item</a>
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
                            <th>TITLE</th>
                            <th>RATING</th>
                            <th>TYPE</th>
                            <th>VIEWS</th>
                            <th>STATUS</th>
                            <th>Uploaded By</th>
                            <th>CREATED DATE</th>
                            <th>UPDATED DATE</th>
                            <th>ACTIONS</th>
                        </tr>
                        </thead>

                        <tbody>

                        @foreach($videos as $video)
                        <tr>
                            <td>
                                <div class="main__table-text">{{ $video->id }}</div>
                            </td>
                            <td>
                                <div class="main__table-text">{{ $video->title }}</div>
                            </td>
                            <td>
                                <div class="main__table-text main__table-text--rate"><i class="icon ion-ios-star"></i> {{ $video->imdb_rating }}</div>
                            </td>
                            <td>
                                <div class="main__table-text">@if($video->type == 0) Movie @else TV Series @endif</div>
                            </td>
                            <td>
                                <div class="main__table-text">{{ $video->views }}</div>
                            </td>
                            <td>
                                <div class="main__table-text main__table-text--green">{{ $video->status }}</div>
                            </td>
                            <td>
                                <div class="main__table-text">{{ $video->user->name }}</div>
                            </td>
                            <td>
                                <div class="main__table-text">{{ $video->created_at->diffForHumans() }}</div>
                            </td>
                            <td>
                                <div class="main__table-text">{{ $video->updated_at->diffForHumans() }}</div>
                            </td>
                            <td>
                                <div class="main__table-btns">
                                    <a href="#" class="main__table-btn main__table-btn--banned">
                                        <i class="icon ion-ios-lock"></i>
                                    </a>
                                    <a href="#" class="main__table-btn main__table-btn--view">
                                        <i class="icon ion-ios-eye"></i>
                                    </a>
                                    <a href="{{ route('videos.edit', $video->id) }}" class="main__table-btn main__table-btn--edit">
                                        <i class="icon ion-ios-create"></i>
                                    </a>

                                    <form action="{{ route('videos.destroy', $video->id) }}" method="POST" onsubmit="return confirm('Are you sure to delete data?')">
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
                    @if($videos->total() > 20)
                        <span>20 from {{ $videos->total() }}</span>
                    @else
                        <span>{{ $videos->total() }} from {{ $videos->total() }}</span>
                    @endif
                    {{ $videos->links('backend.bulma') }}
                </div>
            </div>
            <!-- end paginator -->
        </div>
    </div>
@endsection

@section('modal')

@endsection
