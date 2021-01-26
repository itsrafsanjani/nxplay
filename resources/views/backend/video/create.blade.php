@extends('backend.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- main title -->
            <div class="col-12">
                <div class="main__title">
                    <h2>Add new item</h2>
                </div>
            </div>
            <!-- end main title -->

            @if ($errors->any())
                <div class="col-12">
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
                </div>
            @endif

            @if(session()->has('message'))
                <div class="col-12">
                    <div class="alert alert-{{ session('type')}}">
                        {{ session('message') }}
                    </div>
                </div>
            @endif

            <!-- form -->
            <div class="col-12">
                <form action="{{ route('videos.store') }}" class="form" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-md-7 form__content">
                            <div class="row">
                                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                                <div class="col-12 col-sm-6">
                                    <input type="text" name="imdb_id" class="form__input" placeholder="IMDb Id" value="{{ old('imdb_id') }}">
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="row">
                                <div class="col-lg-6">
                                    <ul class="form__radio">
                                        <li>
                                            <span>Status:</span>
                                        </li>
                                        <li>
                                            <input id="type3" type="radio" name="status" value="1" checked>
                                            <label for="type3">Published</label>
                                        </li>
                                        <li>
                                            <input id="type4" type="radio" name="status" value="0">
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
                                        <input data-name="#movie1" id="form__video-upload" name="video" class="form__video-upload" type="file" accept="video/mp4,video/x-m4v,video/*">
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
