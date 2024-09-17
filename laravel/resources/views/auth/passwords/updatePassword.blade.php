<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="icon" type="image/x-icon" href="{{asset('assets/images/goasquare.jpg')}}">
    <link rel="stylesheet" href="{{asset('assets/fontawesome/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/scss/auth.css')}}">
</head>
<body>
<div class="main-body">

    @if($login_bg_image != null)
        <img class="background-image" src="{{url('/assets/images/'.$login_bg_image)}}" alt="">
    @else
        <img class="background-image" src="{{url('/assets/images/background.jpg')}}" alt="">
    @endif
    @if(session()->has('success'))
    <div class="alert alert-success">
        <img class="alert-img" src="{{asset('assets/icons/success-alert-icon.png')}}" alt="">
        <p class="alert-text">Password has been reseted successfully.</p>
    </div>
    @endif
    @if(session()->has('errors'))
        <div class="alert alert-success">
            <img class="alert-img" src="{{asset('assets/icons/success-alert-icon.png')}}" alt="">
            <p class="alert-text">{{session('errors')}}</p>
        </div>
    @endif
        <div class="form-body signUp-form-body mx-auto" id="formBody"> <!-- Newly Added Id and class here -->
            <img class="logo" src="{{asset('assets/images/project-logo.jpeg')}}" style="  height: 13rem;background-size: 48% 100%; margin: 0 0;">
{{--        <div class="slogan"></div>--}}
        <hr>
        <form method="POST" action="{{ route('update.password') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <!-- Password Mismatched Warning Start -->
            <p class="text-danger d-none error-msg">Please provide same value for both fields.</p>
            <!-- Password Mismatched Warning End -->

            <div class="input-group">
                <i class="fa-solid fa-lock input-icon"></i>
                <input class="input-field form-control @error('password') is-invalid @enderror" type="password" name="password"
                       placeholder="Password" required>
            </div>
            <div class="input-group @error('password') is-invalid @enderror">
                <i class="fa-solid fa-lock input-icon"></i>
                <input class="input-field form-control " type="password" name="password_confirmation"
                       placeholder="Confirm Password" required>

            </div>
            @error('password')
            <span class="invalid-feedback input-error" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <div class="submit-portion">
                <a href="{{route('login')}}">Back to login</a>
                <button class="btn submit-btn" type="submit">Reset</button>
            </div>
        </form>
    </div>
    <div class="bottom-link-portion">
        <a href="{{route('terms.use')}}">Terms of Use</a>
        <span> | </span>
        <a href="{{route('privacy.policy')}}">Privacy Policy</a>
    </div>
</div>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/js/fontawesome.min.js"></script> -->
<script src="{{asset('assets/fontawesome/js/all.min.js')}}"></script>
<script src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/jQuery/jquery.js')}}"></script>
<script>
    // document.body.style.backgroundImage = "url('https://www.shutterstock.com/image-photo/communication-technology-internet-business-global-600w-2183648381.jpg')";
    $(document).ready(function(){       //Error happens here, $ is not defined.
        var windowHeight = $(window).height();
        var formHeight = $('#formBody').height();
        var margin = ((windowHeight-formHeight)/2)-23;
        $('#formBody').css('margin-top',margin+'px');
        // console.log(windowHeight);
        // console.log(margin+'px');
    });
    $(window).resize(function() {
        var windowHeight = $(window).height();
        var formHeight = $('#formBody').height();
        var margin = ((windowHeight-formHeight)/2)-15;
        $('#formBody').css('margin-top',margin+'px');
    });
</script>
</body>
</html>


{{--
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Reset Password') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('update.password') }}">
                            @csrf

                            <input type="hidden" name="token" value="{{ $token }}">

                            --}}
{{--                        <div class="row mb-3">--}}{{--

                            --}}
{{--                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>--}}{{--


                            --}}
{{--                            <div class="col-md-6">--}}{{--

                            --}}
{{--                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>--}}{{--


                            --}}
{{--                                @error('email')--}}{{--

                            --}}
{{--                                    <span class="invalid-feedback" role="alert">--}}{{--

                            --}}
{{--                                        <strong>{{ $message }}</strong>--}}{{--

                            --}}
{{--                                    </span>--}}{{--

                            --}}
{{--                                @enderror--}}{{--

                            --}}
{{--                            </div>--}}{{--

                            --}}
{{--                        </div>--}}{{--


                            <div class="row mb-3">
                                <label for="password"
                                       class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                           class="form-control @error('password') is-invalid @enderror" name="password"
                                           required autocomplete="new-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password-confirm"
                                       class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Reset Password') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
--}}
