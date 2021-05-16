@forelse($comment->replies as $reply)
<li class="comments__item comments__item--answer" id="reply{{ $reply->id }}">
    <div class="comments__autor">
        <img class="comments__avatar" src="{{ $reply->user->avatar? $reply->user->avatar : 'https://ui-avatars.com/api/?name='.$reply->user->name }}" alt="">
        <a href="{{ route('frontend.users.show', $reply->user->id) }}" class="comments__name">{{ $reply->user->name }}</a>
        <span class="comments__time" title="{{ $reply->created_at }}">{{ $reply->created_at->diffForHumans() }}</span>
    </div>
    <p class="comments__text">{{ $reply->comment_text }}</p>
    <div class="comments__actions">
        <div class="comments__rate">
            <!-- Reply Like / Dislike Form -->
            <form action="{{ route('frontend.comment_like_or_dislike') }}" method="post" id="commentLikeForm{{ $reply->id }}" style="display: inline-flex">
                @csrf
                <input type="hidden" name="comment_id" value="{{ $reply->id }}">
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                <input type="hidden" name="status" id="commentLikeBtn{{ $reply->id }}" value="{{ auth()->user()->id }}">
                <!-- Reply Like Button -->
                <button type="button"
                        onclick="document.getElementById('commentLikeBtn{{ $reply->id }}').value='1';
                            document.getElementById('commentLikeForm{{ $reply->id }}').submit();">
                    <i class="icon ion-md-thumbs-up" style="{{ $reply->isLikedBy(auth()->user()) ? 'color: #00ff70;' : 'color: #fff' }}"></i> {{ $reply->commentLikes->count() }}
                </button>

                <!-- Reply Dislike Button -->
                <button type="button"
                        onclick="document.getElementById('commentLikeBtn{{ $reply->id }}').value='0';
                            document.getElementById('commentLikeForm{{ $reply->id }}').submit();">
                    <i class="icon ion-md-thumbs-down" style="{{ $reply->isDislikedBy(auth()->user()) ? 'color: #fd6060;' : 'color: #fff' }}"></i> {{ $reply->commentDislikes->count() }}
                </button>
            </form>
            <!-- End Reply Like / Dislike Form -->
        </div>
        <button type="button" onclick="
            document.getElementById('discover').scrollIntoView({ behavior: 'smooth' });
            document.getElementById('commentId').value={{ $comment->id }};
            document.getElementById('repliedToId').value={{ $reply->id }};
            document.getElementById('commentText').value={{ "'@".$reply->user->name." '"}};
            document.getElementById('commentText').focus();
            ">
            <i class="icon ion-ios-share-alt"></i>
            Reply
        </button>
        @if(auth()->user()->id == $reply->user_id)
            <form action="{{ route('frontend.comments.destroy', $reply->id) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit"><i class="icon ion-ios-trash"></i>Delete</button>
            </form>
        @endif
    </div>
</li>
@empty
@endforelse
