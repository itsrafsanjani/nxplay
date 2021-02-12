@extends('backend.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- main title -->
            <div class="col-12">
                <div class="main__title">
                    <h2>Edit review</h2>
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
                <form action="{{ route('reviews.update', $review->id) }}" class="form" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="col-12 col-md-7 form__content">
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <label for="rating" class="profile__label">Review Rating</label>
                                    <select type="number" name="rating" class="js-example-basic-single" id="rating" required>
                                        <option value="{{ $review->rating }}">{{ $review->rating }}</option>
                                        <option value="1.0"> 1.0</option>
                                        <option value="2.0"> 2.0</option>
                                        <option value="3.0"> 3.0</option>
                                        <option value="4.0"> 4.0</option>
                                        <option value="5.0"> 5.0</option>
                                        <option value="6.0"> 6.0</option>
                                        <option value="7.0"> 7.0</option>
                                        <option value="8.0"> 8.0</option>
                                        <option value="9.0"> 9.0</option>
                                        <option value="10.0"> 10.0</option>
                                    </select>

                                </div>
                                <div class="col-12">
                                    <label for="title" class="profile__label">Review Title</label>
                                    <input id="title" name="title" class="form__input" placeholder="Review Title"
                                           value="{{ $review->title }}">
                                </div>
                                <div class="col-12">
                                    <label for="body" class="profile__label">Review Body</label>
                                    <textarea id="body" name="body" class="form__textarea"
                                              placeholder="Review Body">{{ $review->body }}</textarea>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="form__btn">Update</button>
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
