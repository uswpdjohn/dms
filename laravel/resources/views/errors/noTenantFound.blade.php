<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{asset('assets/images/project-logo.jpeg')}}">
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
            <img class="logo" src="{{asset('assets/images/project-logo.jpeg')}}" style="  height: 13rem !important;background-size: 48% 100%;margin: 0px 99px !important;">
        </div>
        <div class="top-message-portion">
            <p class="top-message">Xero Api Error  - No Tenant Found!</p>
        </div>
        <div class="bottom-message-portion">
            <p class="bottom-message">Sorry! We are unable to find any tenant. Please make sure you are connected to Xero</p>
        </div>
        <div class="button-portion">
            <button class="btn back-btn" type="submit"> Go Back </button>
            <button style="width: 7.5rem;height: 2rem;padding: 3px 6px;border: 1px solid #3E4153;border-radius: 2px;background-color: #3E4153;color: #FFFFFF;font-size: 14px !important;" id="connect-to-xero-btn" onclick="connectToXero()" class="btn btn-outline-dark connect-to-xero-btn" type="button">
                Connect to
                <svg class="logo-xero-blue" viewBox="0 0 45 46" width="25" height="25" xmlns="http://www.w3.org/2000/svg"><title>Xero</title><path class="logo-xero-blue__circle" fill="#13B5EA" d="M22.457 45.49c12.402 0 22.456-10.072 22.456-22.495C44.913 10.57 34.86.5 22.457.5 10.054.5 0 10.57 0 22.995 0 35.418 10.054 45.49 22.457 45.49"/><path class="logo-xero-blue__text" fill="#fff" d="M10.75 22.935l3.832-3.85a.688.688 0 0 0-.977-.965l-3.83 3.833-3.845-3.84a.687.687 0 0 0-.966.979l3.832 3.837-3.83 3.84a.688.688 0 1 0 .964.981l3.84-3.842 3.825 3.827a.685.685 0 0 0 1.184-.473.68.68 0 0 0-.2-.485l-3.83-3.846m22.782.003c0 .69.56 1.25 1.25 1.25a1.25 1.25 0 0 0-.001-2.5c-.687 0-1.246.56-1.246 1.25m-2.368 0c0-1.995 1.62-3.62 3.614-3.62 1.99 0 3.613 1.625 3.613 3.62s-1.622 3.62-3.613 3.62a3.62 3.62 0 0 1-3.614-3.62m-1.422 0c0 2.78 2.26 5.044 5.036 5.044s5.036-2.262 5.036-5.043c0-2.78-2.26-5.044-5.036-5.044a5.046 5.046 0 0 0-5.036 5.044m-.357-4.958h-.21c-.635 0-1.247.2-1.758.595a.696.696 0 0 0-.674-.54.68.68 0 0 0-.68.684l.002 8.495a.687.687 0 0 0 1.372-.002v-5.224c0-1.74.16-2.444 1.648-2.63.14-.017.288-.014.29-.014.406-.015.696-.296.696-.675a.69.69 0 0 0-.69-.688m-13.182 4.127c0-.02.002-.04.003-.058a3.637 3.637 0 0 1 7.065.055H16.2zm8.473-.13c-.296-1.403-1.063-2.556-2.23-3.296a5.064 5.064 0 0 0-5.61.15 5.098 5.098 0 0 0-1.973 5.357 5.08 5.08 0 0 0 4.274 3.767c.608.074 1.2.04 1.81-.12a4.965 4.965 0 0 0 1.506-.644c.487-.313.894-.727 1.29-1.222.006-.01.014-.017.022-.027.274-.34.223-.826-.077-1.056-.254-.195-.68-.274-1.014.156-.072.104-.153.21-.24.315-.267.295-.598.58-.994.802-.506.27-1.08.423-1.69.427-1.998-.023-3.066-1.42-3.447-2.416a3.716 3.716 0 0 1-.153-.58l-.01-.105h7.17c.982-.022 1.51-.717 1.364-1.51z"/></svg>
            </button>
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
        let authorizeUrl = '{{route('authorize')}}'
        window.open(authorizeUrl, '_self')
    }

</script>
</body>
</html>
