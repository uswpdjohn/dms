@extends('layouts.master')
@section('content')
    <div class="main-body">
        @if(session('success'))
            <div class="alert alert-success">
                <img class="alert-img" src="{{asset('assets/icons/success-alert-icon.png')}}" alt="">
                <p class="alert-text">{{session('success')}}</p>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-success">
                <img class="alert-img" src="{{asset('assets/icons/mailbody-!.png')}}" alt="">
                <p class="alert-text">{{session('error')}}</p>
            </div>
        @endif

        <div class="row settings-body g-0">
            <div class="col-12 col-md-12 ">
                <div class="card settings-card">
                    <div class="card-body settings-content-body">
                        <div  class="tabcontent">
                            <form action="{{route('settings.update', $response->slug)}}" method="POST" id="settings_update_form">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="first_name" class="mb-2 mt-3">First Name</label>
                                            <input type="text" class="form-control" value="{{$response->first_name}}" name="first_name" id="first_name">
                                        </div>
{{--                                        @error('first_name')--}}
{{--                                        <span class="text-danger">{{$message}}</span>--}}
{{--                                        @enderror--}}
                                    </div>

                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="last_name"  class="mb-2 mt-3">last Name</label>
                                            <input type="text" class="form-control" value="{{$response->last_name}}" name="last_name" id="last_name">
                                        </div>
{{--                                        @error('last_name')--}}
{{--                                        <span class="text-danger">{{$message}}</span>--}}
{{--                                        @enderror--}}
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="Password" class="mb-2 mt-3">Password</label>
                                            <input type="password" class="form-control" name="password" id="password">
                                        </div>
{{--                                        @error('password')--}}
{{--                                        <span class="text-danger">{{$message}}</span>--}}
{{--                                        @enderror--}}
                                        <span class="text-danger" id="password-alert-text"></span>
                                    </div>

                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="confirm_password" class="mb-2 mt-3">Confirm Password</label>
                                            <input type="password" class="form-control" name="password_confirmation" id="confirm_password" onkeyup="validate_password()">
                                        </div>
{{--                                        @error('password')--}}
{{--                                        <span class="text-danger">{{$message}}</span>--}}
{{--                                        @enderror--}}
                                        <span class="text-danger" id="password-confirm-alert-text"></span>
                                        <span id="wrong_pass_alert" class="text-danger"></span>
                                    </div>
                                    <br>
                                    <div class="col-sm-12 col-md-6 mt-2">
                                        <button type="submit" class="btn settings-create-submit-btn" hidden>Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="settings-create-btn-area tabcontent ">
            <button type="button" id="settings-create-send-btn" class="btn settings-create-send-btn mt-3" onclick="wrong_pass_alert()">Update</button>
        </div>
    </div>
@endsection
@push('customScripts')
    <script>
        // $('.settings-create-send-btn').click(function(){
        //     $('.settings-create-submit-btn').click();
        // })

        function validate_password() {
            document.getElementById('password-confirm-alert-text').innerHTML = ''
            document.getElementById('password-alert-text').innerHTML = ''

            var pass = document.getElementById('password').value;
            var confirm_pass = document.getElementById('confirm_password').value;
            if (pass != confirm_pass) {
                document.getElementById('wrong_pass_alert').style.color = 'red';
                document.getElementById('wrong_pass_alert').innerHTML
                    = '☒ Use same password';
                document.getElementById('settings-create-send-btn').disabled = true;
                document.getElementById('settings-create-send-btn').style.opacity = (0.4);
            } else {
                document.getElementById('wrong_pass_alert').style.color = 'green';
                document.getElementById('wrong_pass_alert').innerHTML =
                    '🗹 Password Matched';
                document.getElementById('settings-create-send-btn').disabled = false;
                document.getElementById('settings-create-send-btn').style.opacity = (1);
            }
        }

        function wrong_pass_alert() {

            if (document.getElementById('password').value != "" && document.getElementById('confirm_password').value != "") {
                alert("Your response is submitted");
            } else if (document.getElementById('password').value == "") {
                document.getElementById('password-alert-text').innerHTML = 'Password must not be empty'
                // alert("Please fill all the fields");
            }else if (document.getElementById('password').value != "" && document.getElementById('password').value.length < 6) {
                document.getElementById('password-alert-text').innerHTML = 'Password must be greater than 6 character'
                // alert("Please fill all the fields");
            }
            if (document.getElementById('confirm_password').value == "") {
                document.getElementById('password-confirm-alert-text').innerHTML = 'Password Confirmation must not be empty'
                // alert("Please fill all the fields");
            }
        }
    </script>
@endpush
