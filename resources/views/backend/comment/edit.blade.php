@extends('backend.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- main title -->
            <div class="col-12">
                <div class="main__title">
                    <h2>Edit comment</h2>
                </div>
            </div>
            <!-- end main title -->

            <!-- form -->
            <div class="col-12">
                <form action="{{ route('comments.update', $comment->id) }}" class="form" method="post">
                    @method('PATCH')
                    @csrf
                    <div class="row">
                        <div class="col-12 col-md-7 form__content">
                            <div class="row">
                                <div class="col-12">
                                    <label for="commentText" class="profile__label">Comment Text</label>
                                    <textarea id="commentText" name="comment_text" class="form__textarea"
                                              placeholder="Comment Text">{{ $comment->comment_text }}</textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="form__btn">Update</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- end form -->
        </div>
    </div>
@endsection
