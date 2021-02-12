@extends('backend.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- main title -->
            <div class="col-12">
                <div class="main__title">
                    <h2>View comment</h2>
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
                                    <label for="commentId" class="profile__label">Comment ID</label>
                                    <input id="commentId" name="id" class="form__input" placeholder="Comment ID"
                                           value="{{ $comment->id }}" disabled>
                                </div>

                                <div class="col-12">
                                    <label for="commentText" class="profile__label">Comment Text</label>
                                    <textarea id="commentText" name="comment_text" class="form__textarea"
                                              placeholder="Comment Text"
                                              disabled>{{ $comment->comment_text }}</textarea>
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
