<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forget Password</title>
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
        <div class="top-button-portion">
            <a href="{{ route('signup') }}" class="sign-up-btn btn">Sign up for a new account</a>
        </div>
        <div class="form-body pb-5 forget-sent-body mx-auto" id="formBody"> <!-- Newly Added Id and class here -->
            <img class="logo" src="{{asset('assets/images/project-logo.jpeg')}}" style="  height: 13rem;background-size: 48% 100%; margin: 0 0;">
{{--            <div class="slogan"></div>--}}
            <hr>
            <p class="">Please enter your email below to receive an email to reset your password.</p>
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                @honeypot
                <div class="input-group @error('email') is-invalid @enderror">
                    <i class="fa-regular fa-envelope input-icon"></i>
                    <input class="input-field form-control " id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                </div>
                @error('email')
                <span class="invalid-feedback input-error" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <div class="submit-portion">
                    <a href="{{route('login')}}">Back to Login</a>
                    <button class="btn submit-btn" type="submit">Send</button>
                </div>
            </form>
        </div>
        <div class="bottom-link-portion">
            <a href="{{route('terms.use')}}">Terms of Use</a>
            <span> | </span>
            <a href="{{route('privacy.policy')}}">Privacy Policy</a>
        </div>
    </div>
    <script src="{{asset('assets/fontawesome/js/all.min.js')}}"></script>
    <script src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/jQuery/jquery.js')}}"></script>
    <script>
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
