<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="icon" type="image/x-icon" href="{{asset('assets/images/project-logo.jpeg')}}">
    <link rel="stylesheet" href="{{asset('assets/fontawesome/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/scss/auth.css')}}">
</head>

<body>
<div class="main-body">
{{--    @if($errors->any())--}}
{{--        @dd($errors)--}}
{{--    @endif--}}
    @if($login_bg_image != null)
        <img class="background-image" src="{{url('/assets/images/'.$login_bg_image)}}" alt="">
    @else
        <img class="background-image" src="{{url('/assets/images/Company.jpg')}}" alt="">
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

        <div class="form-body signUp-form-body mx-auto" id="formBody"> <!-- Newly Added Id and class here -->
        <img class="logo" src="{{asset('assets/images/project-logo.jpeg')}}" style="  height: 13rem;background-size: 48% 100%; margin: 0 0;">
{{--        <div class="slogan"></div>--}}
        <hr>
        <form method="POST" action="{{ route('request.signUp') }}">
            @csrf
            @honeypot
            <input type="text" name="role" value="General User" readonly hidden="hidden">

            <span class="">Please Select</span>
            <div class="row mb-2 @error('registered_as') is-invalid @enderror" style="padding: 15px;">
                <div class="col-md-6"><label for="individual"><input type="radio" name="registered_as" value="individual" id="individual"> Individual</label></div>
                <div class="col-md-6"><label for="company"><input type="radio" name="registered_as" value="company" id="company"> Company</label></div>
            </div>
            @error('registered_as')
            <span class="invalid-feedback input-error" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <div class="input-group  @error('first_name') is-invalid @enderror">
                <svg class="input-icon" width="35" height="35" viewBox="0 0 12 12" fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M6 6C6.79565 6 7.55871 5.68393 8.12132 5.12132C8.68393 4.55871 9 3.79565 9 3C9 2.20435 8.68393 1.44129 8.12132 0.87868C7.55871 0.316071 6.79565 0 6 0C5.20435 0 4.44129 0.316071 3.87868 0.87868C3.31607 1.44129 3 2.20435 3 3C3 3.79565 3.31607 4.55871 3.87868 5.12132C4.44129 5.68393 5.20435 6 6 6V6ZM8 3C8 3.53043 7.78929 4.03914 7.41421 4.41421C7.03914 4.78929 6.53043 5 6 5C5.46957 5 4.96086 4.78929 4.58579 4.41421C4.21071 4.03914 4 3.53043 4 3C4 2.46957 4.21071 1.96086 4.58579 1.58579C4.96086 1.21071 5.46957 1 6 1C6.53043 1 7.03914 1.21071 7.41421 1.58579C7.78929 1.96086 8 2.46957 8 3V3ZM12 11C12 12 11 12 11 12H1C1 12 0 12 0 11C0 10 1 7 6 7C11 7 12 10 12 11ZM11 10.996C10.999 10.75 10.846 10.01 10.168 9.332C9.516 8.68 8.289 8 6 8C3.71 8 2.484 8.68 1.832 9.332C1.154 10.01 1.002 10.75 1 10.996H11Z"
                        fill="black" />
                </svg>
                <input id="first_name" name="first_name" value="{{ old('first_name') }}"
                       class="input-field form-control" type="text"
                       placeholder="First Name"  autofocus>
            </div>
            @error('first_name')
            <span class="invalid-feedback input-error" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <div class="input-group  @error('last_name') is-invalid @enderror">
                <svg class="input-icon" width="35" height="35" viewBox="0 0 12 12" fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M6 6C6.79565 6 7.55871 5.68393 8.12132 5.12132C8.68393 4.55871 9 3.79565 9 3C9 2.20435 8.68393 1.44129 8.12132 0.87868C7.55871 0.316071 6.79565 0 6 0C5.20435 0 4.44129 0.316071 3.87868 0.87868C3.31607 1.44129 3 2.20435 3 3C3 3.79565 3.31607 4.55871 3.87868 5.12132C4.44129 5.68393 5.20435 6 6 6V6ZM8 3C8 3.53043 7.78929 4.03914 7.41421 4.41421C7.03914 4.78929 6.53043 5 6 5C5.46957 5 4.96086 4.78929 4.58579 4.41421C4.21071 4.03914 4 3.53043 4 3C4 2.46957 4.21071 1.96086 4.58579 1.58579C4.96086 1.21071 5.46957 1 6 1C6.53043 1 7.03914 1.21071 7.41421 1.58579C7.78929 1.96086 8 2.46957 8 3V3ZM12 11C12 12 11 12 11 12H1C1 12 0 12 0 11C0 10 1 7 6 7C11 7 12 10 12 11ZM11 10.996C10.999 10.75 10.846 10.01 10.168 9.332C9.516 8.68 8.289 8 6 8C3.71 8 2.484 8.68 1.832 9.332C1.154 10.01 1.002 10.75 1 10.996H11Z"
                        fill="black" />
                </svg>
                <input id="last_name" name="last_name" value="{{ old('last_name') }}"
                       class="input-field form-control" type="text"
                       placeholder="Last Name" >
            </div>
            @error('last_name')
            <span class="invalid-feedback input-error" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <div class="input-group  @error('email') is-invalid @enderror">
                <i class="fa-regular fa-envelope input-icon"></i>
                <input id="email" name="email" value="{{ old('email') }}"
                       class="input-field form-control" type="email"
                       placeholder="E-mail" >
            </div>
            @error('email')
            <span class="invalid-feedback input-error" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
{{--            <div class="input-group  @error('company') is-invalid @enderror">--}}
{{--                <svg class="input-icon" width="36" height="36" viewBox="0 0 16 16" fill="none"--}}
{{--                     xmlns="http://www.w3.org/2000/svg">--}}
{{--                    <path fill-rule="evenodd" clip-rule="evenodd"--}}
{{--                          d="M14.763 0.0748824C14.8354 0.119677 14.8952 0.182228 14.9367 0.256606C14.9782 0.330983 15 0.414722 15 0.499882V15.4999C15 15.6325 14.9473 15.7597 14.8536 15.8534C14.7598 15.9472 14.6326 15.9999 14.5 15.9999H11.5C11.3674 15.9999 11.2402 15.9472 11.1464 15.8534C11.0527 15.7597 11 15.6325 11 15.4999V13.9999H10V15.4999C10 15.6325 9.94732 15.7597 9.85355 15.8534C9.75979 15.9472 9.63261 15.9999 9.5 15.9999H0.5C0.367392 15.9999 0.240215 15.9472 0.146447 15.8534C0.0526784 15.7597 0 15.6325 0 15.4999V9.99988C7.96467e-05 9.89499 0.0331481 9.79277 0.0945249 9.7077C0.155902 9.62264 0.242478 9.55903 0.342 9.52588L6 7.63988V4.49988C6 4.4071 6.02582 4.31616 6.07456 4.23721C6.12331 4.15827 6.19305 4.09445 6.276 4.05288L14.276 0.0528824C14.3523 0.0146883 14.4371 -0.00334141 14.5224 0.00050948C14.6076 0.00436037 14.6904 0.0299637 14.763 0.0748824ZM6 8.69388L1 10.3599V14.9999H6V8.69388ZM7 14.9999H9V13.4999C9 13.3673 9.05268 13.2401 9.14645 13.1463C9.24021 13.0526 9.36739 12.9999 9.5 12.9999H11.5C11.6326 12.9999 11.7598 13.0526 11.8536 13.1463C11.9473 13.2401 12 13.3673 12 13.4999V14.9999H14V1.30888L7 4.80888V14.9999Z"--}}
{{--                          fill="black" />--}}
{{--                    <path--}}
{{--                        d="M2 11.333H3V12.333H2V11.333ZM4 11.333H5V12.333H4V11.333ZM2 13.333H3V14.333H2V13.333ZM4 13.333H5V14.333H4V13.333ZM8 9.33301H9V10.333H8V9.33301ZM10 9.33301H11V10.333H10V9.33301ZM8 11.333H9V12.333H8V11.333ZM10 11.333H11V12.333H10V11.333ZM12 9.33301H13V10.333H12V9.33301ZM12 11.333H13V12.333H12V11.333ZM8 7.33301H9V8.33301H8V7.33301ZM10 7.33301H11V8.33301H10V7.33301ZM12 7.33301H13V8.33301H12V7.33301ZM8 5.33301H9V6.33301H8V5.33301ZM10 5.33301H11V6.33301H10V5.33301ZM12 5.33301H13V6.33301H12V5.33301ZM12 3.33301H13V4.33301H12V3.33301Z"--}}
{{--                        fill="black" />--}}
{{--                </svg>--}}
{{--                <input id="company" name="company" value="{{ old('company') }}"--}}
{{--                       class="input-field form-control" type="text"--}}
{{--                       placeholder="Company Name" >--}}
{{--            </div>--}}
{{--            <div class="input-group  @error('notes') is-invalid @enderror">--}}
{{--                <svg class="input-icon-textarea" width="35" height="35" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                    <g clip-path="url(#clip0_2375_46084)">--}}
{{--                        <path--}}
{{--                            d="M14.5 3C14.6326 3 14.7598 3.05268 14.8536 3.14645C14.9473 3.24021 15 3.36739 15 3.5V12.5C15 12.6326 14.9473 12.7598 14.8536 12.8536C14.7598 12.9473 14.6326 13 14.5 13H1.5C1.36739 13 1.24021 12.9473 1.14645 12.8536C1.05268 12.7598 1 12.6326 1 12.5V3.5C1 3.36739 1.05268 3.24021 1.14645 3.14645C1.24021 3.05268 1.36739 3 1.5 3H14.5ZM1.5 2C1.10218 2 0.720644 2.15804 0.43934 2.43934C0.158035 2.72064 0 3.10218 0 3.5L0 12.5C0 12.8978 0.158035 13.2794 0.43934 13.5607C0.720644 13.842 1.10218 14 1.5 14H14.5C14.8978 14 15.2794 13.842 15.5607 13.5607C15.842 13.2794 16 12.8978 16 12.5V3.5C16 3.10218 15.842 2.72064 15.5607 2.43934C15.2794 2.15804 14.8978 2 14.5 2H1.5Z"--}}
{{--                            fill="black" />--}}
{{--                        <path--}}
{{--                            d="M3.33301 5.83301C3.33301 5.7004 3.38569 5.57322 3.47945 5.47945C3.57322 5.38569 3.7004 5.33301 3.83301 5.33301H12.833C12.9656 5.33301 13.0928 5.38569 13.1866 5.47945C13.2803 5.57322 13.333 5.7004 13.333 5.83301C13.333 5.96562 13.2803 6.09279 13.1866 6.18656C13.0928 6.28033 12.9656 6.33301 12.833 6.33301H3.83301C3.7004 6.33301 3.57322 6.28033 3.47945 6.18656C3.38569 6.09279 3.33301 5.96562 3.33301 5.83301ZM3.33301 8.33301C3.33301 8.2004 3.38569 8.07322 3.47945 7.97945C3.57322 7.88569 3.7004 7.83301 3.83301 7.83301H12.833C12.9656 7.83301 13.0928 7.88569 13.1866 7.97945C13.2803 8.07322 13.333 8.2004 13.333 8.33301C13.333 8.46562 13.2803 8.59279 13.1866 8.68656C13.0928 8.78033 12.9656 8.83301 12.833 8.83301H3.83301C3.7004 8.83301 3.57322 8.78033 3.47945 8.68656C3.38569 8.59279 3.33301 8.46562 3.33301 8.33301ZM3.33301 10.833C3.33301 10.7004 3.38569 10.5732 3.47945 10.4795C3.57322 10.3857 3.7004 10.333 3.83301 10.333H9.83301C9.96562 10.333 10.0928 10.3857 10.1866 10.4795C10.2803 10.5732 10.333 10.7004 10.333 10.833C10.333 10.9656 10.2803 11.0928 10.1866 11.1866C10.0928 11.2803 9.96562 11.333 9.83301 11.333H3.83301C3.7004 11.333 3.57322 11.2803 3.47945 11.1866C3.38569 11.0928 3.33301 10.9656 3.33301 10.833Z"--}}
{{--                            fill="black" />--}}
{{--                    </g>--}}
{{--                    <defs>--}}
{{--                        <clipPath id="clip0_2375_46084">--}}
{{--                            <rect width="16" height="16" fill="white" />--}}
{{--                        </clipPath>--}}
{{--                    </defs>--}}
{{--                </svg>--}}
{{--                <textarea id="notes" name="notes" class="input-field form-control" type="text" placeholder="Notes"></textarea>--}}
{{--            </div>--}}
{{--            @error('notes')--}}
{{--            <span class="invalid-feedback input-error" role="alert">--}}
{{--                    <strong>{{ $message }}</strong>--}}
{{--                </span>--}}
{{--            @enderror--}}

            <div class="submit-portion">
                <a href="{{route('login')}}">Back to Login</a>
                <button class="btn submit-btn" type="submit">Submit</button>
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
{{--<div class="main-body">--}}
{{--    @if($login_bg_image != null)--}}
{{--        <img class="background-image" src="{{url('/assets/images/'.$login_bg_image)}}" alt="">--}}
{{--    @else--}}
{{--        <img class="background-image" src="{{url('/assets/images/background.jpg')}}" alt="">--}}
{{--    @endif--}}
{{--    <div class="form-body signUp-form-body">--}}
{{--        <div class="logo"></div>--}}
{{--        <div class="slogan"></div>--}}
{{--        <hr>--}}
{{--        <form method="POST" action="{{ route('request.signUp') }}">--}}
{{--            @csrf--}}

{{--            <div class="input-group">--}}
{{--                <svg class="input-icon" width="35" height="35" viewBox="0 0 12 12" fill="none"--}}
{{--                     xmlns="http://www.w3.org/2000/svg">--}}
{{--                    <path--}}
{{--                        d="M6 6C6.79565 6 7.55871 5.68393 8.12132 5.12132C8.68393 4.55871 9 3.79565 9 3C9 2.20435 8.68393 1.44129 8.12132 0.87868C7.55871 0.316071 6.79565 0 6 0C5.20435 0 4.44129 0.316071 3.87868 0.87868C3.31607 1.44129 3 2.20435 3 3C3 3.79565 3.31607 4.55871 3.87868 5.12132C4.44129 5.68393 5.20435 6 6 6V6ZM8 3C8 3.53043 7.78929 4.03914 7.41421 4.41421C7.03914 4.78929 6.53043 5 6 5C5.46957 5 4.96086 4.78929 4.58579 4.41421C4.21071 4.03914 4 3.53043 4 3C4 2.46957 4.21071 1.96086 4.58579 1.58579C4.96086 1.21071 5.46957 1 6 1C6.53043 1 7.03914 1.21071 7.41421 1.58579C7.78929 1.96086 8 2.46957 8 3V3ZM12 11C12 12 11 12 11 12H1C1 12 0 12 0 11C0 10 1 7 6 7C11 7 12 10 12 11ZM11 10.996C10.999 10.75 10.846 10.01 10.168 9.332C9.516 8.68 8.289 8 6 8C3.71 8 2.484 8.68 1.832 9.332C1.154 10.01 1.002 10.75 1 10.996H11Z"--}}
{{--                        fill="black" />--}}
{{--                </svg>--}}
{{--                <input name="first_name" class="input-field form-control @error('first_name') is-invalid @enderror" type="text" placeholder="First Name">--}}
{{--                @error('first_name')--}}
{{--                <span class="invalid-feedback" role="alert">--}}
{{--                        <strong>{{ $message }}</strong>--}}
{{--                    </span>--}}
{{--                @enderror--}}
{{--            </div>--}}
{{--            <div class="input-group">--}}
{{--                <svg class="input-icon" width="35" height="35" viewBox="0 0 12 12" fill="none"--}}
{{--                     xmlns="http://www.w3.org/2000/svg">--}}
{{--                    <path--}}
{{--                        d="M6 6C6.79565 6 7.55871 5.68393 8.12132 5.12132C8.68393 4.55871 9 3.79565 9 3C9 2.20435 8.68393 1.44129 8.12132 0.87868C7.55871 0.316071 6.79565 0 6 0C5.20435 0 4.44129 0.316071 3.87868 0.87868C3.31607 1.44129 3 2.20435 3 3C3 3.79565 3.31607 4.55871 3.87868 5.12132C4.44129 5.68393 5.20435 6 6 6V6ZM8 3C8 3.53043 7.78929 4.03914 7.41421 4.41421C7.03914 4.78929 6.53043 5 6 5C5.46957 5 4.96086 4.78929 4.58579 4.41421C4.21071 4.03914 4 3.53043 4 3C4 2.46957 4.21071 1.96086 4.58579 1.58579C4.96086 1.21071 5.46957 1 6 1C6.53043 1 7.03914 1.21071 7.41421 1.58579C7.78929 1.96086 8 2.46957 8 3V3ZM12 11C12 12 11 12 11 12H1C1 12 0 12 0 11C0 10 1 7 6 7C11 7 12 10 12 11ZM11 10.996C10.999 10.75 10.846 10.01 10.168 9.332C9.516 8.68 8.289 8 6 8C3.71 8 2.484 8.68 1.832 9.332C1.154 10.01 1.002 10.75 1 10.996H11Z"--}}
{{--                        fill="black" />--}}
{{--                </svg>--}}
{{--                <input name="last_name" class="input-field form-control @error('last_name') is-invalid @enderror" type="text" placeholder="Last Name">--}}
{{--                @error('last_name')--}}
{{--                <span class="invalid-feedback" role="alert">--}}
{{--                        <strong>{{ $message }}</strong>--}}
{{--                    </span>--}}
{{--                @enderror--}}
{{--            </div>--}}
{{--            <div class="input-group">--}}
{{--                <i class="fa-regular fa-envelope input-icon"></i>--}}
{{--                <input name="email" class="input-field form-control @error('email') is-invalid @enderror" type="text" placeholder="Email">--}}
{{--                @error('email')--}}
{{--                <span class="invalid-feedback" role="alert">--}}
{{--                        <strong>{{ $message }}</strong>--}}
{{--                    </span>--}}
{{--                @enderror--}}
{{--            </div>--}}
{{--            <div class="input-group">--}}
{{--                <svg class="input-icon" width="36" height="36" viewBox="0 0 16 16" fill="none"--}}
{{--                     xmlns="http://www.w3.org/2000/svg">--}}
{{--                    <path fill-rule="evenodd" clip-rule="evenodd"--}}
{{--                          d="M14.763 0.0748824C14.8354 0.119677 14.8952 0.182228 14.9367 0.256606C14.9782 0.330983 15 0.414722 15 0.499882V15.4999C15 15.6325 14.9473 15.7597 14.8536 15.8534C14.7598 15.9472 14.6326 15.9999 14.5 15.9999H11.5C11.3674 15.9999 11.2402 15.9472 11.1464 15.8534C11.0527 15.7597 11 15.6325 11 15.4999V13.9999H10V15.4999C10 15.6325 9.94732 15.7597 9.85355 15.8534C9.75979 15.9472 9.63261 15.9999 9.5 15.9999H0.5C0.367392 15.9999 0.240215 15.9472 0.146447 15.8534C0.0526784 15.7597 0 15.6325 0 15.4999V9.99988C7.96467e-05 9.89499 0.0331481 9.79277 0.0945249 9.7077C0.155902 9.62264 0.242478 9.55903 0.342 9.52588L6 7.63988V4.49988C6 4.4071 6.02582 4.31616 6.07456 4.23721C6.12331 4.15827 6.19305 4.09445 6.276 4.05288L14.276 0.0528824C14.3523 0.0146883 14.4371 -0.00334141 14.5224 0.00050948C14.6076 0.00436037 14.6904 0.0299637 14.763 0.0748824ZM6 8.69388L1 10.3599V14.9999H6V8.69388ZM7 14.9999H9V13.4999C9 13.3673 9.05268 13.2401 9.14645 13.1463C9.24021 13.0526 9.36739 12.9999 9.5 12.9999H11.5C11.6326 12.9999 11.7598 13.0526 11.8536 13.1463C11.9473 13.2401 12 13.3673 12 13.4999V14.9999H14V1.30888L7 4.80888V14.9999Z"--}}
{{--                          fill="black" />--}}
{{--                    <path--}}
{{--                        d="M2 11.333H3V12.333H2V11.333ZM4 11.333H5V12.333H4V11.333ZM2 13.333H3V14.333H2V13.333ZM4 13.333H5V14.333H4V13.333ZM8 9.33301H9V10.333H8V9.33301ZM10 9.33301H11V10.333H10V9.33301ZM8 11.333H9V12.333H8V11.333ZM10 11.333H11V12.333H10V11.333ZM12 9.33301H13V10.333H12V9.33301ZM12 11.333H13V12.333H12V11.333ZM8 7.33301H9V8.33301H8V7.33301ZM10 7.33301H11V8.33301H10V7.33301ZM12 7.33301H13V8.33301H12V7.33301ZM8 5.33301H9V6.33301H8V5.33301ZM10 5.33301H11V6.33301H10V5.33301ZM12 5.33301H13V6.33301H12V5.33301ZM12 3.33301H13V4.33301H12V3.33301Z"--}}
{{--                        fill="black" />--}}
{{--                </svg>--}}

{{--                <input name="company" class="input-field form-control @error('company') is-invalid @enderror" type="text" placeholder="Company">--}}
{{--                @error('company')--}}
{{--                <span class="invalid-feedback" role="alert">--}}
{{--                        <strong>{{ $message }}</strong>--}}
{{--                    </span>--}}
{{--                @enderror--}}
{{--            </div>--}}
{{--            <div class="input-group">--}}
{{--                <svg class="input-icon-textarea" width="35" height="35" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                    <g clip-path="url(#clip0_2375_46084)">--}}
{{--                        <path--}}
{{--                            d="M14.5 3C14.6326 3 14.7598 3.05268 14.8536 3.14645C14.9473 3.24021 15 3.36739 15 3.5V12.5C15 12.6326 14.9473 12.7598 14.8536 12.8536C14.7598 12.9473 14.6326 13 14.5 13H1.5C1.36739 13 1.24021 12.9473 1.14645 12.8536C1.05268 12.7598 1 12.6326 1 12.5V3.5C1 3.36739 1.05268 3.24021 1.14645 3.14645C1.24021 3.05268 1.36739 3 1.5 3H14.5ZM1.5 2C1.10218 2 0.720644 2.15804 0.43934 2.43934C0.158035 2.72064 0 3.10218 0 3.5L0 12.5C0 12.8978 0.158035 13.2794 0.43934 13.5607C0.720644 13.842 1.10218 14 1.5 14H14.5C14.8978 14 15.2794 13.842 15.5607 13.5607C15.842 13.2794 16 12.8978 16 12.5V3.5C16 3.10218 15.842 2.72064 15.5607 2.43934C15.2794 2.15804 14.8978 2 14.5 2H1.5Z"--}}
{{--                            fill="black" />--}}
{{--                        <path--}}
{{--                            d="M3.33301 5.83301C3.33301 5.7004 3.38569 5.57322 3.47945 5.47945C3.57322 5.38569 3.7004 5.33301 3.83301 5.33301H12.833C12.9656 5.33301 13.0928 5.38569 13.1866 5.47945C13.2803 5.57322 13.333 5.7004 13.333 5.83301C13.333 5.96562 13.2803 6.09279 13.1866 6.18656C13.0928 6.28033 12.9656 6.33301 12.833 6.33301H3.83301C3.7004 6.33301 3.57322 6.28033 3.47945 6.18656C3.38569 6.09279 3.33301 5.96562 3.33301 5.83301ZM3.33301 8.33301C3.33301 8.2004 3.38569 8.07322 3.47945 7.97945C3.57322 7.88569 3.7004 7.83301 3.83301 7.83301H12.833C12.9656 7.83301 13.0928 7.88569 13.1866 7.97945C13.2803 8.07322 13.333 8.2004 13.333 8.33301C13.333 8.46562 13.2803 8.59279 13.1866 8.68656C13.0928 8.78033 12.9656 8.83301 12.833 8.83301H3.83301C3.7004 8.83301 3.57322 8.78033 3.47945 8.68656C3.38569 8.59279 3.33301 8.46562 3.33301 8.33301ZM3.33301 10.833C3.33301 10.7004 3.38569 10.5732 3.47945 10.4795C3.57322 10.3857 3.7004 10.333 3.83301 10.333H9.83301C9.96562 10.333 10.0928 10.3857 10.1866 10.4795C10.2803 10.5732 10.333 10.7004 10.333 10.833C10.333 10.9656 10.2803 11.0928 10.1866 11.1866C10.0928 11.2803 9.96562 11.333 9.83301 11.333H3.83301C3.7004 11.333 3.57322 11.2803 3.47945 11.1866C3.38569 11.0928 3.33301 10.9656 3.33301 10.833Z"--}}
{{--                            fill="black" />--}}
{{--                    </g>--}}
{{--                    <defs>--}}
{{--                        <clipPath id="clip0_2375_46084">--}}
{{--                            <rect width="16" height="16" fill="white" />--}}
{{--                        </clipPath>--}}
{{--                    </defs>--}}
{{--                </svg>--}}


{{--                <textarea name="notes" class="input-field form-control @error('notes') is-invalid @enderror" rows="3"--}}
{{--                          placeholder="Sign Up Request Description"></textarea>--}}
{{--                @error('notes')--}}
{{--                <span class="invalid-feedback" role="alert">--}}
{{--                        <strong>{{ $message }}</strong>--}}
{{--                    </span>--}}
{{--                @enderror--}}
{{--            </div>--}}
{{--            <div class="submit-portion">--}}
{{--                <a href="{{route('login')}}">Back to Login</a>--}}
{{--                <button class="btn submit-btn" type="submit">Submit</button>--}}
{{--            </div>--}}
{{--        </form>--}}
{{--    </div>--}}
{{--    <div class="bottom-link-portion">--}}
{{--        <a href="{{route('terms.use')}}">Terms of Use</a>--}}
{{--        <span> | </span>--}}
{{--        <a href="{{route('privacy.policy')}}">Privacy Policy</a>--}}
{{--    </div>--}}
{{--</div>--}}
