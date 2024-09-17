<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You</title>
    <link rel="stylesheet" href="{{asset('assets/fontawesome/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/scss/frame.css')}}">
    <link rel="stylesheet" href="{{asset('assets/scss/main-body.css')}}">
</head>
<body>
<div class="main-body payment-main-body">
    <div class="body-container">
        <div class="logo-portion">
            <div class="logo"></div>
            <div class="slogan"></div>
        </div>
        <div class="top-message-portion">
            <p class="top-message">Your payment has been received! </p>
        </div>
        <div class="bottom-message-portion">
            <p class="bottom-message">Thank you for choosing Gateway of Asia as your trusted partner</p>
        </div>
        <div class="button-portion">
            <a href="{{route('billing.index')}}"  class="btn back-btn">Back to Billings</a>
        </div>
    </div>
</div>

<script src="{{asset('assets/fontawesome/js/all.min.js')}}"></script>
<script src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>
</body>
</html>
