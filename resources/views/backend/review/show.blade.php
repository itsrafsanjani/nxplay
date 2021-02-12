@extends('backend.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- main title -->
            <div class="col-12">
                <div class="main__title">
                    <h2>View review</h2>
                </div>
            </div>
            <!-- end main title -->

            <!-- form -->
            <div class="col-12">
                <form class="form">
                    <div class="row">
                        <div class="col-12 col-md-7 form__content">
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <label for="reviewId" class="profile__label">Review ID</label>
                                    <input id="reviewId" name="id" class="form__input" placeholder="Review ID"
                                           value="{{ $review->id }}" disabled>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <label for="rating" class="profile__label">Review Rating</label>
                                    <input id="rating" name="rating" class="form__input" placeholder="Review Rating"
                                           value="{{ $review->rating }}" disabled>
                                </div>
                                <div class="col-12">
                                    <label for="title" class="profile__label">Review Title</label>
                                    <input id="title" name="title" class="form__input" placeholder="Review Title"
                                           value="{{ $review->title }}" disabled>
                                </div>
                                <div class="col-12">
                                    <label for="body" class="profile__label">Review Body</label>
                                    <textarea id="body" name="body" class="form__textarea"
                                              placeholder="Review Body"
                                              disabled>{{ $review->body }}</textarea>
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
