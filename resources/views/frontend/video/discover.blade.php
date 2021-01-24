<section class="content">
    <div class="content__head">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- content title -->
                    <h2 class="content__title" id="discover">Discover</h2>
                    <!-- end content title -->

                    <!-- content tabs nav -->
                    <ul class="nav nav-tabs content__tabs" id="content__tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tab-1" role="tab" aria-controls="tab-1"
                               aria-selected="true">Comments</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tab-2" role="tab" aria-controls="tab-2"
                               aria-selected="false">Reviews</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tab-3" role="tab" aria-controls="tab-3"
                               aria-selected="false">Photos</a>
                        </li>
                    </ul>
                    <!-- end content tabs nav -->

                    <!-- content mobile tabs nav -->
                    <div class="content__mobile-tabs" id="content__mobile-tabs">
                        <div class="content__mobile-tabs-btn dropdown-toggle" role="navigation" id="mobile-tabs"
                             data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <input type="button" value="Comments">
                            <span></span>
                        </div>

                        <div class="content__mobile-tabs-menu dropdown-menu" aria-labelledby="mobile-tabs">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item"><a class="nav-link active" id="1-tab" data-toggle="tab"
                                                        href="#tab-1" role="tab" aria-controls="tab-1"
                                                        aria-selected="true">Comments</a></li>

                                <li class="nav-item"><a class="nav-link" id="2-tab" data-toggle="tab" href="#tab-2"
                                                        role="tab" aria-controls="tab-2"
                                                        aria-selected="false">Reviews</a></li>

                                <li class="nav-item"><a class="nav-link" id="3-tab" data-toggle="tab" href="#tab-3"
                                                        role="tab" aria-controls="tab-3"
                                                        aria-selected="false">Photos</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- end content mobile tabs nav -->
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-8 col-xl-8">
                <!-- content tabs -->
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab-1" role="tabpanel" aria-labelledby="1-tab">
                        <div class="row">
                            <!-- comments -->
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
                                    <form action="{{ route('comments.store') }}" class="form" method="post" id="commentForm" style="margin-bottom: 20px;">
                                        @csrf
                                        <input type="hidden" name="user_id" id="userId"
                                               value="{{ auth()->user()->id }}">
                                        <input type="hidden" name="video_id" id="videoId" value="{{ $video->id }}">
                                        <input type="hidden" name="comment_id" id="commentId">
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
                                                    <span class="comments__name">{{ $comment->user->name }}</span>
                                                    <span class="comments__time"
                                                          title="{{ $comment->created_at }}">{{ $comment->created_at->diffForHumans() }}</span>
                                                </div>
                                                <p class="comments__text">{{ $comment->comment_text }}</p>
                                                <div class="comments__actions">
                                                    <div class="comments__rate">
                                                        <button type="button"><i class="icon ion-md-thumbs-up"></i>
                                                        </button>

                                                        <button type="button"><i class="icon ion-md-thumbs-down"></i>
                                                        </button>
                                                    </div>

                                                    <button type="button" onclick="
                                                        document.getElementById('discover').scrollIntoView({ behavior: 'smooth' });
                                                        document.getElementById('commentId').value={{ $comment->id }};
                                                        document.getElementById('commentText').value={{ "'@".$comment->user->name." '"}};
                                                        document.getElementById('commentText').focus();
                                                    ">
                                                    <i class="icon ion-ios-share-alt"></i>
                                                    Reply
                                                    </button>
                                                </div>
                                            </li>

                                            @forelse($comment->replies as $reply)
                                            <li class="comments__item comments__item--answer">
                                                <div class="comments__autor">
                                                    <img class="comments__avatar" src="{{ $reply->user->avatar? $reply->user->avatar : 'https://ui-avatars.com/api/?name='.$reply->user->name }}" alt="">
                                                    <span class="comments__name">{{ $reply->user->name }}</span>
                                                    <span class="comments__time" title="{{ $reply->created_at }}">{{ $reply->created_at->diffForHumans() }}</span>
                                                </div>
                                                <p class="comments__text">{{ $reply->comment_text }}</p>
                                                <div class="comments__actions">
                                                    <div class="comments__rate">
                                                        <button type="button"><i class="icon ion-md-thumbs-up"></i></button>

                                                        <button type="button"><i class="icon ion-md-thumbs-down"></i></button>
                                                    </div>
                                                    <button type="button" onclick="
                                                        document.getElementById('discover').scrollIntoView({ behavior: 'smooth' });
                                                        document.getElementById('commentId').value={{ $comment->id }};
                                                        document.getElementById('commentText').value={{ "'@".$reply->user->name." '"}};
                                                        document.getElementById('commentText').focus();
                                                        ">
                                                        <i class="icon ion-ios-share-alt"></i>
                                                        Reply
                                                    </button>
                                                </div>
                                            </li>
                                                @empty
                                            @endforelse
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <!-- end comments -->
                        </div>
                    </div>

                    <div class="tab-pane fade" id="tab-2" role="tabpanel" aria-labelledby="2-tab">
                        <div class="row">
                            <!-- reviews -->
                            <div class="col-12">
                                <div class="reviews">
                                    <ul class="reviews__list">
                                        <li class="reviews__item">
                                            <div class="reviews__autor">
                                                <img class="reviews__avatar" src="{{ asset('img/user.svg') }}" alt="">
                                                <span class="reviews__name">Best Marvel movie in my opinion</span>
                                                <span class="reviews__time">24.08.2018, 17:53 by John Doe</span>

                                                <span class="reviews__rating reviews__rating--green">8.4</span>
                                            </div>
                                            <p class="reviews__text">There are many variations of passages of Lorem
                                                Ipsum available, but the majority have suffered alteration in some form,
                                                by injected humour, or randomised words which don't look even slightly
                                                believable. If you are going to use a passage of Lorem Ipsum, you need
                                                to be sure there isn't anything embarrassing hidden in the middle of
                                                text.</p>
                                        </li>

                                        <li class="reviews__item">
                                            <div class="reviews__autor">
                                                <img class="reviews__avatar" src="{{ asset('img/user.svg') }}" alt="">
                                                <span class="reviews__name">Best Marvel movie in my opinion</span>
                                                <span class="reviews__time">24.08.2018, 17:53 by John Doe</span>

                                                <span class="reviews__rating reviews__rating--green">9.0</span>
                                            </div>
                                            <p class="reviews__text">There are many variations of passages of Lorem
                                                Ipsum available, but the majority have suffered alteration in some form,
                                                by injected humour, or randomised words which don't look even slightly
                                                believable. If you are going to use a passage of Lorem Ipsum, you need
                                                to be sure there isn't anything embarrassing hidden in the middle of
                                                text.</p>
                                        </li>

                                        <li class="reviews__item">
                                            <div class="reviews__autor">
                                                <img class="reviews__avatar" src="{{ asset('img/user.svg') }}" alt="">
                                                <span class="reviews__name">Best Marvel movie in my opinion</span>
                                                <span class="reviews__time">24.08.2018, 17:53 by John Doe</span>

                                                <span class="reviews__rating reviews__rating--red">5.5</span>
                                            </div>
                                            <p class="reviews__text">There are many variations of passages of Lorem
                                                Ipsum available, but the majority have suffered alteration in some form,
                                                by injected humour, or randomised words which don't look even slightly
                                                believable. If you are going to use a passage of Lorem Ipsum, you need
                                                to be sure there isn't anything embarrassing hidden in the middle of
                                                text.</p>
                                        </li>
                                    </ul>

                                    <form action="#" class="form">
                                        <input type="text" class="form__input" placeholder="Title">
                                        <textarea class="form__textarea" placeholder="Review"></textarea>
                                        <div class="form__slider">
                                            <div class="form__slider-rating" id="slider__rating"></div>
                                            <div class="form__slider-value" id="form__slider-value"></div>
                                        </div>
                                        <button type="button" class="form__btn">Send</button>
                                    </form>
                                </div>
                            </div>
                            <!-- end reviews -->
                        </div>
                    </div>

                    <div class="tab-pane fade" id="tab-3" role="tabpanel" aria-labelledby="3-tab">
                        <!-- project gallery -->
                        <div class="gallery" itemscope>
                            <div class="row">
                            @foreach(json_decode($video->photos) as $photo)
                                <!-- gallery item -->
                                    <figure class="col-12 col-sm-6 col-xl-4" itemprop="associatedMedia" itemscope>
                                        <a href="https://imdb-api.com/images/1920x1280/{{ $photo }}"
                                           itemprop="contentUrl" data-size="1920x1280">
                                            <img src="https://imdb-api.com/images/480x360/{{ $photo }}"
                                                 itemprop="thumbnail"
                                                 alt="Image description"/>
                                        </a>
                                        {{--                                    <figcaption itemprop="caption description">Some image caption 1</figcaption>--}}
                                    </figure>
                            @endforeach
                            <!-- end gallery item -->
                            </div>
                        </div>
                        <!-- end project gallery -->
                    </div>
                </div>
                <!-- end content tabs -->
            </div>

            <!-- sidebar -->
            <div class="col-12 col-lg-4 col-xl-4">
                <div class="row">
                    <!-- section title -->
                    <div class="col-12">
                        <h2 class="section__title">You may also like...</h2>
                    </div>
                    <!-- end section title -->

                    <!-- card -->
                    <div class="col-6 col-sm-4 col-lg-6">
                        <div class="card">
                            <div class="card__cover">
                                <img src="{{ asset('img/covers/cover.jpg') }}" alt="">
                                <a href="#" class="card__play">
                                    <i class="icon ion-ios-play"></i>
                                </a>
                                <span class="card__rate card__rate--green">8.4</span>
                            </div>
                            <div class="card__content">
                                <h3 class="card__title"><a href="#">I Dream in Another Language</a></h3>
                                <span class="card__category">
										<a href="#">Action</a>
										<a href="#">Triler</a>
									</span>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->

                    <!-- card -->
                    <div class="col-6 col-sm-4 col-lg-6">
                        <div class="card">
                            <div class="card__cover">
                                <img src="{{ asset('img/covers/cover2.jpg') }}" alt="">
                                <a href="#" class="card__play">
                                    <i class="icon ion-ios-play"></i>
                                </a>
                                <span class="card__rate card__rate--green">7.1</span>
                            </div>
                            <div class="card__content">
                                <h3 class="card__title"><a href="#">Benched</a></h3>
                                <span class="card__category">
										<a href="#">Comedy</a>
									</span>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->

                    <!-- card -->
                    <div class="col-6 col-sm-4 col-lg-6">
                        <div class="card">
                            <div class="card__cover">
                                <img src="{{ asset('img/covers/cover3.jpg') }}" alt="">
                                <a href="#" class="card__play">
                                    <i class="icon ion-ios-play"></i>
                                </a>
                                <span class="card__rate card__rate--red">6.3</span>
                            </div>
                            <div class="card__content">
                                <h3 class="card__title"><a href="#">Whitney</a></h3>
                                <span class="card__category">
										<a href="#">Romance</a>
										<a href="#">Drama</a>
										<a href="#">Music</a>
									</span>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->

                    <!-- card -->
                    <div class="col-6 col-sm-4 col-lg-6">
                        <div class="card">
                            <div class="card__cover">
                                <img src="{{ asset('img/covers/cover4.jpg') }}" alt="">
                                <a href="#" class="card__play">
                                    <i class="icon ion-ios-play"></i>
                                </a>
                                <span class="card__rate card__rate--green">7.9</span>
                            </div>
                            <div class="card__content">
                                <h3 class="card__title"><a href="#">Blindspotting</a></h3>
                                <span class="card__category">
										<a href="#">Comedy</a>
										<a href="#">Drama</a>
									</span>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->

                    <!-- card -->
                    <div class="col-6 col-sm-4 col-lg-6">
                        <div class="card">
                            <div class="card__cover">
                                <img src="{{ asset('img/covers/cover5.jpg') }}" alt="">
                                <a href="#" class="card__play">
                                    <i class="icon ion-ios-play"></i>
                                </a>
                                <span class="card__rate card__rate--green">8.4</span>
                            </div>
                            <div class="card__content">
                                <h3 class="card__title"><a href="#">I Dream in Another Language</a></h3>
                                <span class="card__category">
										<a href="#">Action</a>
										<a href="#">Triler</a>
									</span>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->

                    <!-- card -->
                    <div class="col-6 col-sm-4 col-lg-6">
                        <div class="card">
                            <div class="card__cover">
                                <img src="{{ asset('img/covers/cover6.jpg') }}" alt="">
                                <a href="#" class="card__play">
                                    <i class="icon ion-ios-play"></i>
                                </a>
                                <span class="card__rate card__rate--green">7.1</span>
                            </div>
                            <div class="card__content">
                                <h3 class="card__title"><a href="#">Benched</a></h3>
                                <span class="card__category">
										<a href="#">Comedy</a>
									</span>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
            </div>
            <!-- end sidebar -->
        </div>
    </div>
</section>

<!-- Root element of PhotoSwipe. Must have class pswp. -->
<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">

    <!-- Background of PhotoSwipe.
    It's a separate element, as animating opacity is faster than rgba(). -->
    <div class="pswp__bg"></div>

    <!-- Slides wrapper with overflow:hidden. -->
    <div class="pswp__scroll-wrap">

        <!-- Container that holds slides. PhotoSwipe keeps only 3 slides in DOM to save memory. -->
        <!-- don't modify these 3 pswp__item elements, data is added later on. -->
        <div class="pswp__container">
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
        </div>

        <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
        <div class="pswp__ui pswp__ui--hidden">

            <div class="pswp__top-bar">

                <!--  Controls are self-explanatory. Order can be changed. -->

                <div class="pswp__counter"></div>

                <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>

                <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>

                <!-- Preloader -->
                <div class="pswp__preloader">
                    <div class="pswp__preloader__icn">
                        <div class="pswp__preloader__cut">
                            <div class="pswp__preloader__donut"></div>
                        </div>
                    </div>
                </div>
            </div>

            <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)"></button>

            <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)"></button>

            <div class="pswp__caption">
                <div class="pswp__caption__center"></div>
            </div>
        </div>
    </div>
</div>
