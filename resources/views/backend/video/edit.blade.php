@extends('backend.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- main title -->
            <div class="col-12">
                <div class="main__title">
                    <h2>Edit item</h2>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        @if($errors->count() === 1)
                            <li>{{ $errors->first() }}</li>
                        @else
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                @endif

                @if(session()->has('message'))
                    <div class="alert alert-{{ session('type')}}">
                        {{ session('message') }}
                    </div>
                @endif

            </div>
            <!-- end main title -->

            <!-- form -->
            <div class="col-12">
                <form action="{{ route('videos.update', $video->id) }}" class="form" method="post" enctype="multipart/form-data">
                    @method('PATCH')
                    @csrf
                    <div class="row">
                        <div class="col-12 col-md-7 form__content">
                            <div class="row">
                                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                <div class="col-12">
                                    <input type="text" class="form__input" name="title" placeholder="Title" value="{{ $video->title }}">
                                </div>

                                <div class="col-12">
                                    <textarea id="text" name="description" class="form__textarea" placeholder="Description">{{ $video->description }}</textarea>
                                </div>

                                <div class="col-12 col-sm-6">
                                    <input type="text" name="year" class="form__input" placeholder="Release year" value="{{ $video->year }}">
                                </div>

                                <div class="col-12 col-sm-6">
                                    <input type="text" name="runtime" class="form__input" placeholder="Running timed in minutes" value="{{ $video->runtime }}">
                                </div>

                                <div class="col-12 col-sm-6">
                                    <input type="text" name="imdb_rating" class="form__input" placeholder="IMDb Rating" value="{{ $video->imdb_rating }}">
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="row">
                                <div class="col-lg-6">
                                    <ul class="form__radio">
                                        <li>
                                            <span>Item type:</span>
                                        </li>
                                        <li>
                                            <input id="type1" type="radio" name="type" value="movie" @if($video->type == 'movie') checked @endif>
                                            <label for="type1">Movie</label>
                                        </li>
                                        <li>
                                            <input id="type2" type="radio" name="type" value="series" @if($video->type == 'series') checked @endif>
                                            <label for="type2">TV Series</label>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-lg-6">
                                    <ul class="form__radio">
                                        <li>
                                            <span>Status:</span>
                                        </li>
                                        <li>
                                            <input id="type3" type="radio" name="status" value="1" @if($video->status == 1) checked @endif>
                                            <label for="type3">Published</label>
                                        </li>
                                        <li>
                                            <input id="type4" type="radio" name="status" value="0" @if($video->status == 0) checked @endif>
                                            <label for="type4">Unpublished</label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form__video">
                                        <label id="movie1" for="form__video-upload">Upload video</label>

                                    </div>
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="form__btn">publish</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- end form -->
        </div>
    </div>
@endsection
