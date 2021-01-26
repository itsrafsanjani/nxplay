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
