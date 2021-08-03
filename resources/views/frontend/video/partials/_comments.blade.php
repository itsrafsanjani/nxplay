<div class="col-12">
    <div class="comments">
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
        <form action="{{ route('frontend.comments.store') }}" class="form" method="post" id="commentForm" style="margin-bottom: 20px;">
            @csrf
            <input type="hidden" name="user_id" id="userId"
                   value="{{ auth()->user()->id }}">
            <input type="hidden" name="video_id" id="videoId" value="{{ $video->id }}">
            <input type="hidden" name="comment_id" id="commentId">
            <input type="hidden" name="replied_to_id" id="repliedToId">
            <textarea id="commentText" name="comment_text" class="form__textarea"
                      placeholder="Add comment"></textarea>
            <button type="submit" class="form__btn">Send</button>
        </form>
        <ul class="comments__list">
            @foreach($video->comments as $comment)
                <li class="comments__item">
                    <div class="comments__autor">
                        <img class="comments__avatar"
                             src="{{ $comment->user->avatar? $comment->user->avatar : 'https://ui-avatars.com/api/?name='.$comment->user->name }}"
                             alt="">
                        <a href="{{ route('frontend.users.show', $comment->user->id) }}" class="comments__name">{{ $comment->user->name }}</a>
                        <span class="comments__time"
                              title="{{ $comment->created_at }}">{{ $comment->created_at->diffForHumans() }}</span>
                    </div>
                    <p class="comments__text">{{ $comment->comment_text }}</p>
                    <div class="comments__actions">
                        <div class="comments__rate">
                            <!-- Comment Like / Dislike Form-->
                            <form action="{{ route('frontend.comments.like_or_dislike') }}" method="post" id="commentLikeForm{{ $comment->id }}" style="display: inline-flex">
                                @csrf
                                <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                <input type="hidden" name="status" id="commentLikeBtn{{ $comment->id }}" value="{{ auth()->user()->id }}">
                                <!-- Comment Like Button -->
                                <button type="button"
                                        onclick="document.getElementById('commentLikeBtn{{ $comment->id }}').value='1';
                                            document.getElementById('commentLikeForm{{ $comment->id }}').submit();">
                                    <i class="icon ion-md-thumbs-up" style="{{ $comment->isLikedBy(auth()->user()) ? 'color: #00ff70;' : 'color: #fff' }}"></i> {{ $comment->commentLikes->count() }}
                                </button>

                                <!-- Comment Dislike Button -->
                                <button type="button"
                                        onclick="document.getElementById('commentLikeBtn{{ $comment->id }}').value='0';
                                            document.getElementById('commentLikeForm{{ $comment->id }}').submit();">
                                    <i class="icon ion-md-thumbs-down" style="{{ $comment->isDislikedBy(auth()->user()) ? 'color: #fd6060;' : 'color: #ffffff' }}"></i> {{ $comment->commentDislikes->count() }}
                                </button>
                            </form>
                            <!-- End Comment Like / Dislike Form-->
                        </div>


                        <button type="button" onclick="
                            document.getElementById('discover').scrollIntoView({ behavior: 'smooth' });
                            document.getElementById('commentId').value={{ $comment->id }};
                            document.getElementById('repliedToId').value={{ $comment->id }};
                            document.getElementById('commentText').value={{ "'@".$comment->user->name." '"}};
                            document.getElementById('commentText').focus();
                            ">
                            <i class="icon ion-ios-share-alt"></i>
                            Reply
                        </button>
                        @if(auth()->user()->id == $comment->user_id)
                            <form action="{{ route('frontend.comments.destroy', $comment->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit"><i class="icon ion-ios-trash"></i>Delete</button>
                            </form>
                        @endif
                    </div>
                </li>

                <!-- Replies -->
                @include('frontend.video.partials._replies')
                <!-- End Replies -->

            @endforeach
        </ul>
    </div>
</div>

@push('javascripts')
    <script type="text/javascript">

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("#likebtn").click(function(e){

            let video_id = $("input[name=video_id]").val();
            let status = 1;
            let user_id = $("input[name=user_id]").val();

            $.ajax({
                type:'POST',
                url:"{{ route('frontend.comments.like_or_dislike') }}",
                data:{video_id:video_id, status:status, user_id:user_id},
                // success:function(data){
                //     alert(data.success);
                // }
            });

            $(document).ajaxStop(function(){
                window.location.reload();
            });

        });

        $("#dislikebtn").click(function(e){

            let video_id = $("input[name=video_id]").val();
            let status = 0;
            let user_id = $("input[name=user_id]").val();

            $.ajax({
                type:'POST',
                url:"{{ route('frontend.comments.like_or_dislike') }}",
                data:{video_id:video_id, status:status, user_id:user_id},
                // success:function(data){
                //     alert(data.success);
                // }
            });

            $(document).ajaxStop(function(){
                window.location.reload();
            });

        });
    </script>
@endpush
