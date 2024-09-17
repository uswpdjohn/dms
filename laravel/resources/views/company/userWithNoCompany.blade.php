<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{asset('assets/images/goasquare.jpg')}}">
    <title>Opps!</title>
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
            <div class="logo"></div>
            <div class="slogan"></div>
        </div>
        <div class="top-message-portion">
            <p class="top-message">YOU HAVE BEEN REMOVED!</p>
        </div>
        <div class="bottom-message-portion">
            @if(session()->has('error'))
                <p class="bottom-message">Hi {{auth()->guard('web')->user()->getFullNameAttribute()}}, {{session('error')}}<br> Thank you! </p>
            @endif
        </div>
        <div class="button-portion">
            <a class="btn back-btn" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
{{--            <a href="{{route('logout')}}" class="btn back-btn"> Logout </a>--}}
        </div>
    </div>
</div>

<script src="{{asset('assets/fontawesome/js/all.min.js')}}"></script>
<script src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>
<script>
    // const backButton = document.querySelector('.back-btn');
    // backButton.addEventListener('click', function() {
    //     history.back();
    // });
</script>
</body>
</html>
