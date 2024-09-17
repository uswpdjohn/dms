<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Sent</title>
    <link rel="icon" type="image/x-icon" href="{{asset('assets/images/project-logo.jpeg')}}">
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
        <div class="form-body pb-5 forget-sent-body mx-auto" id="formBody"> <!-- Newly Added Id and class here -->
            <div class="logo"></div>
{{--            <div class="slogan"></div>--}}
            <hr>
            <strong><h5 style="font-weight: 600;">Request Sent Successfully</h5></strong>
            <p class="pb-3" >Your sign up request has been sent successfully. Our administrator will be reviewing your application shortly and may contact you for more information.</p>
            <div class="submit-portion">
                <a href="{{route('login')}}">Back to Login</a>
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
            var margin = ((windowHeight-formHeight)/2)-40;
            $('#formBody').css('margin-top',margin+'px');
            // console.log(windowHeight);
            // console.log(margin+'px');
        });
        $(window).resize(function() {
            var windowHeight = $(window).height();
            var formHeight = $('#formBody').height();
            var margin = ((windowHeight-formHeight)/2)-35;
            $('#formBody').css('margin-top',margin+'px');
        });
    </script>
</body>
</html>
