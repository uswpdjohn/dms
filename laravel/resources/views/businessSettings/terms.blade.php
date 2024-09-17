<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms Of Use</title>
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
        <div class="terms-policy-body mx-auto" id="formBody"> <!-- Newly Added Id and class here -->
        <div class="header-part">
            <h4 class="d-inline-block body-header">Terms of Use</h4>
            <a href="{{route('login')}}" class="btn close-btn float-end d-inline-block">Close</a>
        </div>
        <div class="body-part">
            <p class="body-contents">{{$terms_of_use['value']}}</p>
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
