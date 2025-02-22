<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{asset('assets/images/goasquare.jpg')}}">
    <title>Access Denied!</title>
    <link rel="stylesheet" href="{{asset('assets/fontawesome/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/scss/frame.css')}}">
    <link rel="stylesheet" href="{{asset('assets/scss/main-body.css')}}">
    <link rel="stylesheet" href="{{asset('assets/scss/forbiddenError.css')}}">
</head>
<body>
<div class="main-body forbidden-error-main-body">
    <div class="body-container">
        <div class="logo-portion">
            <img class="logo" src="{{asset('assets/images/project-logo.jpeg')}}" style="  height: 13rem !important;background-size: 48% 100%;margin: 0px 99px !important;">
{{--            <div class="slogan"></div>--}}
        </div>
        <div class="top-message-portion">
            <p class="top-message">Error 403 - Access Denied!</p>
        </div>
        <div class="bottom-message-portion">
{{--            <p class="bottom-message">Oops! You do not have sufficient permission to perform this action.</p>--}}
            <p class="bottom-message">{{$exception->getMessage()}}</p>
        </div>
        <div class="button-portion">
            <button class="btn back-btn" type="submit"> Go Back </button>
        </div>
    </div>
</div>

<script src="{{asset('assets/fontawesome/js/all.min.js')}}"></script>
<script src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>
<script>
    const backButton = document.querySelector('.back-btn');
    backButton.addEventListener('click', function() {
        history.back();
    });
</script>
</body>
</html>
