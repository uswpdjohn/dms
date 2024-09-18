<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1"/>

    <style type="text/css">
        .table-outer-background{
            background-color: #f6f6f6;
            padding-top: 20px;
            padding-bottom: 20px;
        }
        .table-inner-background {
            background-color: #FFFFFF;
            /*margin-top: 10px;*/
            margin-bottom: 20px;
            padding-left: 30px;
            padding-right: 30px;
        }
        body {
            font-family: "Lato", sans-serif;
            margin: 0;
        }
        .justified_text {
            text-align: justify;
        }
        .margin-bottom-custom {
            margin-bottom: 25px;
        }
        .note{
            border-bottom: 1px solid #e8e5ef;
        }
    </style>
</head>
<body>
{{--<div class="container">--}}
    <table class="table-outer-background" width="100%">
        <tbody>
        <tr>
            <td align="center">
{{--                <img src="{{$message->embed(public_path('images/project-logo.jpeg'))}}"--}}
{{--                     alt="goasquare">--}}
            </td>
        </tr>
        <tr>
            <td>
                <table class="table-inner-background" width="65%" align="center">
{{--                    <table align="center" class="tpadding"--}}
{{--                       style="background-color: white;max-width: 50%; margin-top: 20px; margin-bottom: 20px;">--}}
                    <tbody>
{{--                    <tr>--}}
{{--                        <td align="center">--}}
{{--                            <img src="{{$message->embed(public_path('images/GOA_logo_fixed_email_template.png'))}}"--}}
{{--                                 alt="goasquare">--}}
{{--                        </td>--}}
{{--                    </tr>--}}
                    @if(key_exists('name',$details))
                        <tr style="padding-top: 30px;">
                            <td><h3>Hello!</h3></td>
                        </tr>
                    @elseif(key_exists('purpose',$details) && $details['purpose'] == 'request for signup' || key_exists('purpose', $details) && $details['purpose'] == 'ticket submitted')
                        <tr style="padding-top: 30px;">
                            <td><h3>Hello!</h3></td>
                        </tr>
                    @elseif(key_exists('purpose',$details) && $details['purpose'] == 'send reminder mail on Esop Entries')
                        <tr style="padding-top: 30px;">
                            <td><h3>Dear Sir/Madam,</h3></td>
                        </tr>
                    @else
                        <tr style="padding-top: 30px;">
                            <td><h3>Dear Customer!</h3></td>
                        </tr>
                    @endif

                    @if(key_exists('body',$details))
                        <tr style="margin-top: 20px;">
                            <td class="justified_text"><span style="color: #718096;">{{$details['body']}}</span></td>
                        </tr>
                    @endif
                    @if(key_exists('purpose', $details) && $details['purpose'] == 'ticket submitted')
                        <tr class="justified_text" style="line-height: 2;margin-top: 20px;" >
                            <td><span style="color: #718096;">{{'A new ticket has been submitted by '.$details['issuer']}}</span></td>
                        </tr>
                        <tr class="justified_text">
                            <td><span style="color: #718096;">Ticket Category: {{$details['category']}}</span></td>
                        </tr>
                        <tr class="justified_text">
                            <td style="color: #718096;">Message: {{$details['message']}}</td>
                        </tr>
                        <tr>
                            <td>
                                <table style="margin-top: 20px; margin-bottom: 20px; width: 100%">
                                    <tr style="text-align: center">
                                        <td>
                                            <a href="{{ route("login")}}" style="text-decoration: none"><img
                                                    src="{{$message->embed(public_path('images/check_now_fixed_email_template.png'))}}"
                                                    alt=""></a>
                                        </td>
                                    </tr>
                                </table>

                            </td>
                        </tr>
                    @elseif(key_exists('purpose',$details) && $details['purpose'] == 'send mail on mailbox create')
                        <tr class="justified_text" style="margin-top: 20px;">
                            <td><span style="color: #718096;">We have received the following mail from {{$details['from']}}:</span>
                            </td>
                        </tr>
                        <tr class="justified_text">
                            <td><b style="color: #718096;">{{$details['title']}}</b></td>
                        </tr>
                        <tr class="justified_text">
                            <td><span style="color: #718096;">We have sent it to your {{$details['folder']}} folder for your perusal and handling.</span><br>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table style="margin-top: 20px; margin-bottom: 20px; width: 100%">
                                    <tr style="text-align: center">
                                        <td>
                                            <a href="{{ route("login")}}" style="text-decoration: none"><img
                                                    src="{{$message->embed(public_path('images/check_now_fixed_email_template.png'))}}"
                                                    alt=""></a>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    @elseif(key_exists('purpose',$details) && $details['purpose'] == 'request for signup')
                        <tr class="justified_text" style="margin-top: 20px;">
                            <td><span
                                    style="color: #718096;">You are receiving this email because {{$details['first_name']}} {{$details['last_name']}} is requested for an account opening in USW-MSC.</span>
                            </td>
                        </tr>
                        <tr class="justified_text">
                            <td>
                                <table class="note" width="100%" style="margin-top: 5px;">
                                    <tr>
                                        <td style="color: #718096;">
                                            <span><b>First Name: </b> </span>{{$details['first_name']}}</td>
                                    </tr>
                                    <tr>
                                        <td style="color: #718096;">
                                            <span><b>Last Name: </b></span>{{$details['last_name']}}</td>
                                    </tr>
                                    <tr>
                                        <td style="color: #718096; text-decoration: none">
                                            <span><b>Email: </b></span>{{$details['email']}}</td>
                                    </tr>
                                    <tr>
                                        <td style="color: #718096; margin-bottom: 10px;"><span><b>Notes: </b></span>{{$details['notes']}}</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    @elseif(key_exists('purpose',$details) && $details['purpose'] == 'send reminder mail on Esop Entries')
                        <tr class="justified_text" style="margin-top: 20px;">
                            <td>
                                <span style="color: #718096;">This email serves as a reminder that {{$details['recipient']}}'s ESOP is due soon on {{\Carbon\Carbon::parse($details['date_of_granted'])->format('d M Y')}}. Please <a
                                        href="{{route("login")}}">Click here</a>  to view the ESOP details.</span>
                            </td>
                        </tr>
                        <br>
                    @elseif(key_exists('purpose',$details) && $details['purpose'] =='temporary download link send')
                        <tr class="justified_text" style="margin-top: 20px;">
                            <td><span style="color: #718096;">{{$details['body']}}</span>
                            </td>
                        </tr>
                    @endif
                    @if(key_exists('remember_token',$details))
                        <tr>
                            <td>
                                <table style="margin-top: 20px; margin-bottom: 20px; width: 100%">
                                    <tr style="text-align: center;">
                                        <td><a href="{{ url("set-password/{$details['remember_token']}")}}"
                                               style="text-decoration: none">
                                                <img
                                                    src="{{$message->embed(public_path('images/update_password_button_fixed_email_template.png'))}}"
                                                    alt="">
                                            </a></td>
                                    </tr>

                                </table>

                            </td>
                        </tr>
                    @endif

                    @if(key_exists('remember_token',$details))
                        <tr style="padding-bottom: 30px;">
                            <td>
                                <table
                                    style="text-align: justify; width: 100%; border-top: 1px solid #e8e5ef; margin-top: 25px;">
                                    <tr>
                                        <td style="color: #718096;word-break: break-all">If you're having trouble
                                            clicking the "Update Password" button, copy and paste the URL below into
                                            your web browser: <a
                                                href="{{ url("set-password/{$details['remember_token']}")}}">{{ url("set-password/{$details['remember_token']}")}}</a>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                    @elseif(key_exists('purpose',$details) && $details['purpose'] == 'send mail on mailbox create' || key_exists('purpose', $details) && $details['purpose'] == 'ticket submitted')
                        <tr style="padding-bottom: 30px;">
                            <td>
                                <table
                                    style="width: 100%; text-align: justify; border-top: 1px solid #e8e5ef;margin-top: 25px;">
                                    <tr>
                                        <td style="color: #718096; word-break: break-all">If you're having trouble
                                            clicking the "Check Now" button, copy and paste the URL below into your web
                                            browser:
                                            <a href="{{ route("login")}}">{{ route("login")}}</a></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                    @endif
                    </tbody>
                </table>
                <p style="text-align: center;box-sizing: border-box;line-height: 1.5em;color: #b0adc5;font-size: 12px;">
                    © {{ date('Y') }} {{ config('app.name') }}. @lang('All rights reserved.')</p>
            </td>
        </tr>
        </tbody>
    </table>
{{--</div>--}}
</body>
</html>



























