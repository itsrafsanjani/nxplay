@extends('backend.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- main title -->
            <div class="col-12">
                <div class="main__title">
                    <h2>Users</h2>

                    <span class="main__title-stat">{{ $users->total() }} Total</span>

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
                            <th>BASIC INFO</th>
                            <th>STATUS</th>
                            <th>ROLE</th>
                            <th>CREATED DATE</th>
                            <th>ACTIONS</th>
                        </tr>
                        </thead>

                        <tbody>

                        @foreach($users as $user)

                        <tr>
                            <td>
                                <div class="main__table-text">{{ $user->id }}</div>
                            </td>
                            <td>
                                <div class="main__user">
                                    <div class="main__avatar">
                                        <img src="{{ asset('img/user.svg') }}" alt="">
                                    </div>
                                    <div class="main__meta">
                                        <h3>{{ $user->name }}</h3>
                                        <span>{{ $user->email }}</span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="main__table-text main__table-text--green">Approved</div>
                            </td>
                            <td>
                                <div class="main__table-text">@if($user->role == 1) Admin @else User @endif</div>
                            </td>
                            <td>
                                <div class="main__table-text" title="{{ $user->created_at }}">{{ $user->created_at->diffForHumans() }}</div>
                            </td>
                            <td>
                                <div class="main__table-btns">
                                    <a href="#" class="main__table-btn main__table-btn--banned">
                                        <i class="icon ion-ios-lock"></i>
                                    </a>
                                    <a href="{{ route('users.edit', $user->id) }}" class="main__table-btn main__table-btn--edit">
                                        <i class="icon ion-ios-create"></i>
                                    </a>

                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure to delete data?')">
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
                    @if($users->total() > 20)
                        <span>20 from {{ $users->total() }}</span>
                    @else
                        <span>{{ $users->total() }} from {{ $users->total() }}</span>
                    @endif
                    {{ $users->links('backend.bulma') }}
                </div>
            </div>
            <!-- end paginator -->
        </div>
    </div>
@endsection
