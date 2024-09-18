

    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" type="image/x-icon" href="{{asset('assets/images/project-logo.jpeg')}}">
    <link rel="stylesheet" href="{{asset('assets/fontawesome/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/scss/auth.css')}}">
</head>
<body>
<div class="main-body">
    @if($login_bg_image != null)
        <img class="background-image" src="{{url('/assets/images/'.$login_bg_image->value)}}" alt="">
    @else
        <img class="background-image" src="{{url('/assets/images/background.jpg')}}" alt="">
    @endif
    @if(session()->has('success'))
        <div class="alert alert-success">
            <img class="alert-img" src="{{asset('assets/icons/success-alert-icon.png')}}" alt="">
            <p class="alert-text">{{session('success')}}</p>
        </div>
    @endif
    @if(session()->has('error'))
        <div class="alert alert-success login-alert-error">
            <img class="alert-img" src="{{asset('assets/icons/mailbody-!.png')}}" alt="">
            <p class="alert-text">{{session('error')}}</p>
        </div>
    @endif
    <div class="top-button-portion">
        <a href="{{ route('signup') }}" class="sign-up-btn btn">Sign up for a new account</a>
    </div>

    <div class="form-body mx-auto" id="formBody"> <!-- Newly Added Id and class here -->
        <img class="logo" src="{{asset('assets/images/project-logo.jpeg')}}" style="  height: 13rem;background-size: 48% 100%; margin: 0 0;">
{{--        <div class="slogan"></div>--}}
        <hr>
        <form method="POST" action="{{ route('login') }}">
            @csrf
{{--            @honeypot--}}
            <div class="input-group  @error('email') is-invalid @enderror">
                <i class="fa-regular fa-envelope input-icon"></i>
                <input id="email" name="email" value="{{ old('email') }}"
                       class="input-field form-control" type="text"
                       placeholder="Email" required autocomplete="email" autofocus>
            </div>
            {{--            @error('email')--}}
            {{--            <span class="invalid-feedback input-error" role="alert">--}}
            {{--                    <strong>{{ $message }}</strong>--}}
            {{--                </span>--}}
            {{--            @enderror--}}
            <div class="input-group  @error('password') is-invalid @enderror">
                <i class="fa-solid fa-lock input-icon"></i>
                <input id="password" type="password" placeholder="Password"
                       class="input-field form-control " name="password" required
                       autocomplete="current-password">
            </div>
            @error('email')
            <span class="invalid-feedback input-error" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <input type="checkbox" class="remember-select" name="remember" value="true"><label for="remember" class="remember-text">Remember Me</label>

            <div class="submit-portion">
                <a href="{{route('password.request')}}">Forget Password</a>
                <button class="btn submit-btn" type="submit">Login</button>
            </div>
        </form>
        <div class="terms-policy-portion text-center">
            <span>By continuing, you agree to our </span>
            <a href="{{route('terms.use')}}">Terms of Use </a>
            <span>and </span>
            <a href=" {{route('privacy.policy')}}">Privacy Policy</a><span>.</span>
        </div>
    </div>
    <div class="bottom-link-portion">
        <a href="{{route('terms.use')}}">Terms of Use</a>
        <span> | </span>
        <a href="{{route('privacy.policy')}}">Privacy Policy</a>
    </div>
</div>

<script src="{{asset('assets/fontawesome/js/all.min.js')}}"></script>
<script src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>
<!-- Newly Added -->
<script src="{{asset('assets/jQuery/jquery.js')}}"></script>
<script>
    // document.body.style.backgroundImage = "url('https://www.shutterstock.com/image-photo/communication-technology-internet-business-global-600w-2183648381.jpg')";
    $(document).ready(function(){       //Error happens here, $ is not defined.
        var windowHeight = $(window).height();
        var formHeight = $('#formBody').height();
        var margin = ((windowHeight-formHeight)/2)-20;
        $('#formBody').css('margin-top',margin+'px');
        // console.log(windowHeight);
        // console.log(margin+'px');
    });
    $(window).resize(function() {
        var windowHeight = $(window).height();
        var formHeight = $('#formBody').height();
        var margin = ((windowHeight-formHeight)/2)-20;
        $('#formBody').css('margin-top',margin+'px');
    });
</script>
</body>
</html>


{{--@extends('layouts.app')--}}

{{--@section('content')--}}
{{--<div class="container">--}}
{{--    <div class="row justify-content-center">--}}
{{--        <div class="col-md-8">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">{{ __('Login') }}</div>--}}

{{--                <div class="card-body">--}}
{{--                    <form method="POST" action="{{ route('login') }}">--}}
{{--                        @csrf--}}

{{--                        <div class="row mb-3">--}}
{{--                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>--}}

{{--                                @error('email')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="row mb-3">--}}
{{--                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">--}}

{{--                                @error('password')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="row mb-3">--}}
{{--                            <div class="col-md-6 offset-md-4">--}}
{{--                                <div class="form-check">--}}
{{--                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>--}}

{{--                                    <label class="form-check-label" for="remember">--}}
{{--                                        {{ __('Remember Me') }}--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="row mb-0">--}}
{{--                            <div class="col-md-8 offset-md-4">--}}
{{--                                <button type="submit" class="btn btn-primary">--}}
{{--                                    {{ __('Login') }}--}}
{{--                                </button>--}}

{{--                                @if (Route::has('password.request'))--}}
{{--                                    <a class="btn btn-link" href="{{ route('password.request') }}">--}}
{{--                                        {{ __('Forgot Your Password?') }}--}}
{{--                                    </a>--}}
{{--                                @endif--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
{{--@endsection--}}
