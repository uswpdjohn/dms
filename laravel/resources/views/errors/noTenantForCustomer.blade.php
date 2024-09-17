<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{asset('assets/images/goasquare.jpg')}}">
    <title>Not Found</title>
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
            <p class="top-message">Congratulation! Your payment has been received. </p>
        </div>
        <div class="bottom-message-portion">
            <p class="bottom-message">Sorry! We are unable to find any tenant. Please make sure you are connected to Xero</p>
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
    function connectToXero() {
        console.log('in')
        let authorizeUrl = '{{route('authorize')}}'
        window.open(authorizeUrl, '_self')
    }

</script>
</body>
</html>
