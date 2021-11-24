<div class="col-12">
    <div class="reviews">
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
        <ul class="reviews__list">
            @foreach($video->reviews as $review)
                @if(auth()->user()->id == $review->user_id)
                    <li class="reviews__item" style="border: 1px solid #ffd80e; border-radius: 6px; padding: 20px;">
                        <div class="reviews__autor">
                            <img class="reviews__avatar"
                                 src="{{ $review->user->avatar? $review->user->avatar : 'https://ui-avatars.com/api/?name='.$review->user->name }}"
                                 alt="{{ $review->user->name }}">
                            <span class="reviews__name">{{ $review->title }}</span>
                            <span class="reviews__time" title="{{ $review->created_at }}">
                                {{ $review->created_at->diffForHumans() }} by {{ $review->user->name }}
                            </span>
                            <span class="reviews__rating reviews__rating--green">{{ $review->rating }}</span>
                        </div>
                        <p class="reviews__text">{{ $review->body }}</p>
                        @if(auth()->user()->id == $review->user_id)
                            <div class="comments__actions">
                                <form action="{{ route('frontend.reviews.destroy', $review->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"><i class="icon ion-ios-trash"></i>Delete</button>
                                </form>
                            </div>
                        @endif
                    </li>
                @else
                    <li class="reviews__item">
                        <div class="reviews__autor">
                            <img class="reviews__avatar"
                                 src="{{ $review->user->avatar? $review->user->avatar : 'https://ui-avatars.com/api/?name='.$review->user->name }}"
                                 alt="">
                            <span class="reviews__name">{{ $review->title }}</span>
                            <span class="reviews__time"><span title="{{ $review->created_at }}">{{ $review->created_at->diffForHumans() }}</span> by
                                <a href="{{ route('frontend.users.show', $review->user->id) }}">{{ $review->user->name }}</a>
                        </span>

                            <span class="reviews__rating @if($review->rating>=7)reviews__rating--green @else reviews__rating--red @endif">{{ $review->rating }}</span>
                        </div>
                        <p class="reviews__text">{{ $review->body }}</p>
                        @if(auth()->user()->id == $review->user_id)
                            <div class="comments__actions">
                                <form action="{{ route('frontend.reviews.destroy', $review->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"><i class="icon ion-ios-trash"></i>Delete</button>
                                </form>
                            </div>
                        @endif
                    </li>
                @endif
            @endforeach
        </ul>

        <form action="{{ route('frontend.reviews.store') }}" class="form" method="POST">
            @csrf
            <input type="hidden" name="video_id" value="{{ $video->id }}" required>
            <input type="text" name="title" class="form__input" placeholder="Title" required>
            <textarea name="body" class="form__textarea" placeholder="Review" style="margin-bottom: 8px;"
                      required></textarea>
            <select type="number" name="rating" class="js-example-basic-single" id="rating" required>
                <option value=""> Select your rating here...</option>
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
            <button type="submit" class="form__btn">Send</button>
        </form>
    </div>
</div>
