@extends('backend.layouts.app')

@section('content')
<div class="sign section--bg" data-bg="{{ asset('img/section/section.jpg') }}">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="sign__content">
                    <!-- registration form -->
                    <form action="{{ route('register') }}" class="sign__form" method="post">
                        @csrf

                        <a href="/" class="sign__logo">
                            <img src="{{ asset('img/logo.svg') }}" alt="">
                        </a>

                        <div class="sign__group">
                                <input id="name" type="text" class="sign__input @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Name">

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="sign__group">
                            <input id="email" type="email" class="sign__input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="sign__group">
                            <input id="password" type="password" class="sign__input @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="sign__group">
                            <input id="password-confirm" type="password" class="sign__input" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
                        </div>

                        <div class="sign__group sign__group--checkbox">
                            <input id="policy" name="policy" type="checkbox" class="@error('password') is-invalid @enderror" >
                            <label for="policy">I agree to the <a href="#">Privacy Policy</a></label>

                            @error('policy')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <button class="sign__btn" type="submit">Sign up</button>

                        <p class="text-center" style="color: white">OR</p>

                        <div class="sign__group">
                            <a href="{{ route('login.google') }}" class="btn btn-danger btn-block"><i class="icon ion-logo-google" style="font-size: 18px; margin-right: 3px;"></i> Sign in with Google</a>
                            <a href="{{ route('login.facebook') }}" class="btn btn-primary btn-block"><i class="icon ion-logo-google" style="font-size: 18px; margin-right: 3px;"></i> Sign in with Facebook</a>
                            <a href="{{ route('login.github') }}" class="btn btn-dark btn-block"><i class="icon ion-logo-google" style="font-size: 18px; margin-right: 3px;"></i> Sign in with Github</a>
                        </div>

                        <span class="sign__text">Already have an account? <a href="{{ route('login') }}">Sign in!</a></span>
                    </form>
                    <!-- registration form -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
