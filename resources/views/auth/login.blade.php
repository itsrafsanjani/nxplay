@extends('backend.layouts.app')

@section('content')
<div class="sign section--bg" data-bg="{{ asset('img/section/section.jpg') }}">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="sign__content">
                    <!-- authorization form -->
                    <form action="{{ route('login') }}" class="sign__form" method="post">
                        @csrf

                        <a href="/" class="sign__logo">
                            <img src="{{ asset('img/logo.svg') }}" alt="logo">
                        </a>

                        <div class="sign__group">
                            <a href="{{ route('login.google') }}" class="btn btn-danger btn-block"><i class="icon ion-logo-google" style="font-size: 18px; margin-right: 3px;"></i> Sign in with Google</a>
                            <a href="{{ route('login.facebook') }}" class="btn btn-primary btn-block"><i class="icon ion-logo-facebook" style="font-size: 18px; margin-right: 3px;"></i> Sign in with Facebook</a>
                            <a href="{{ route('login.github') }}" class="btn btn-dark btn-block"><i class="icon ion-logo-github" style="font-size: 18px; margin-right: 3px;"></i> Sign in with Github</a>
                        </div>

                        <p class="text-center" style="color: white">OR</p>

                        <div class="sign__group">
                            <input id="email" type="email" class="sign__input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="sign__group">
                            <input id="password" type="password" class="sign__input @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="sign__group sign__group--checkbox">
                            <input id="remember" name="remember" type="checkbox" {{ old('remember') ? 'checked' : '' }}>
                            <label for="remember">Remember Me</label>
                        </div>

                        <button class="sign__btn" type="submit">Sign in</button>

                        @if (Route::has('register'))
                        <span class="sign__text">Don't have an account? <a href="{{ route('register') }}">Sign up!</a></span>
                        @endif

                        @if (Route::has('password.request'))
                            <span class="sign__text"><a href="{{ route('password.request') }}">Forgot password?</a></span>
                        @endif
                    </form>
                    <!-- end authorization form -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
