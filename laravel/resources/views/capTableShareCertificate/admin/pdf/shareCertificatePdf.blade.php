<!DOCTYPE html>
<html>
<head>
{{--    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap" rel="stylesheet">--}}
    <meta charset="utf-8">
    <style>
        .custom-font-arial {
            font-family: "arial";
        }

    </style>
</head>
<body>
{{--<div class="invoice-box" style="border: 3px solid #000000;max-width: 95%; height: 100%; margin: 20px; padding: 20px 30px;" >--}}

<div class="invoice-box" style="border: 3px solid #000000;max-width: 100%; height: 100%; padding: 20px 30px;" >
    <table class="custom-font-arial" style="width: 100%; text-align: center">
        <thead></thead>
        <tbody >
        <tr style="margin-bottom: 8px;"><td><div style="letter-spacing:1px;font-size: 18px;font-weight: bold">{{strtoupper($validatedData['company_name'])}}</div></td></tr>
        <tr style="margin: 3px;"><td style="font-size: 14px;">Co.Reg. No.: {{$validatedData['company_reg_no']}}</td></tr>
        <tr style="margin-top: 3px; margin-bottom: 10px"><td style="font-size: 14px;">Incorporated in Singapore on {{\Carbon\Carbon::parse($validatedData['incorporation_date'])->format('d M Y')}} under the Companies Act 1967 of Singapore</td></tr>
        </tbody>
    </table>
    <table class="custom-font-arial" style="width:100%;" >
        <tbody>
        <tr>
            <td style="width:50%; ">
                <table>
                    <tbody>
                    <tr>
                        <td>
                            <div style="margin: 3px; font-size: 14px;">Registered Office:</div>
{{--                            <p style="font-size: 14px;">{{$validatedData['company_address_line']}}</p>--}}
                            <p style="font-size: 14px;">{{$addressLine_1}}</p>
{{--                            <p style="font-size: 14px;margin: 3px;max-width: 20%">{{ucfirst($validatedData['company_country'])}} {{$validatedData['company_postal_code']}}</p>--}}
                            <p style="font-size: 14px;margin: 3px;max-width: 20%">{{$addressLine_2}}</p>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </td>
            <td style="width: 50%; text-align: right">
                <table>
                    <tbody>
                    <tr style="vertical-align: baseline;">
                        <td style="width: 50%;">
                            <p style="margin: 3px;font-size: 14px;">Certificate Number:</p>
                            <p style="margin: 3px;font-size: 14px;">No. of Shares:</p>
                        </td>
                        <td style="margin-left: 3px;">
                            <p style="font-size: 14px;">{{$validatedData['share_certificate_id']}}</p>
                            <p style="font-size: 14px;">{{$validatedData['share_number']}}</p>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        </tbody>
    </table>
    <table class="custom-font-arial" style="width: 100%; margin-bottom: 10px">
        <thead></thead>
        <tbody >
        <tr>
            <td style="text-align: center;">
                <div style="margin-top: 0px; margin-bottom: 8px; font-size: 26px;font-weight: bold;letter-spacing: 1px;">Share Certificate</div>
            </td>
        </tr>
        </tbody>
    </table>
    <table class="custom-font-arial" style="width: 100%;">
        <tbody>
        <tr>
            <td style="width: 50%;vertical-align: baseline;text-align: right;">
                <table>
                    <tbody>
                    <tr><td><div style="letter-spacing: 1px;font-size: 16px; font-weight: bold">This is to certify that</div></td></tr>
                    </tbody>
                </table>

            </td>
            <td style="width: 50%;margin-bottom: 1px">
                <table style="margin-left: 10px; border: 1px solid black; width: 100%;padding: 10px;">
                    <tbody>
                        <tr><td style="font-size: 13px;">{{$certify_to['name']}}</td></tr>
                        <tr><td style="margin: 3px;font-size: 13px;">{{$validatedData['member_address_line'][0]}}</td></tr>
                        @if(key_exists('1', $validatedData['member_address_line']))
                            <tr><td style="margin: 3px;font-size: 13px;">{{$validatedData['member_address_line'][1]}}</td></tr>
                        @endif
                        <tr><td style="margin: 3px;font-size: 13px;">{{ucfirst($validatedData['member_country'])}} {{$validatedData['member_postal_code']}}</td></tr>
                        </tbody>
                </table>
            </td>
        </tr>
        </tbody>
    </table>
    <table class="custom-font-arial" style="width: 100%; margin-top: 5px;">
        <thead></thead>
        <tbody>
        <tr>
            <td>
                <p style="margin: 3px;font-size: 13px;">is the registered holder of <span style="letter-spacing: 1px; font-weight: bold"> {{strtoupper($validatedData['description'])}}</span> FULLY PAID in the above-named company subject to its Constitution.</p>
            </td>
        </tr>
        </tbody>
    </table>
    <table class="custom-font-arial" style="width: 100%;">
        <tbody>
        <tr>
            <td style="vertical-align: baseline; width: 50%;">
                <table style="margin-top: 20px;">
                    <tbody>
                    <tr>
                        <td style="font-size: 13px;">Given under the Common Seal of the company on</td>
                    </tr>
                    </tbody>
                </table>
            </td>
            <td style="width: 50%;">
                <table style=" margin-top: 80px;">
                    <tbody>
                    <tr ><td style="font-size: 13px;width: 450px; padding-top: 5px; border-top: 1px solid #000000;">DIRECTOR</td></tr>
                    </tbody>
                </table>
                <table style="margin-top: 60px;">
                    <tbody>
                    <tr><td style="font-size: 13px;width: 450px; padding-top: 4px; border-top: 1px solid #000000;">DIRECTOR/SECRETARY</td></tr>
                    </tbody>
                </table>
                <table style="margin-top: 50px;">
                    <tbody>
                    <tr><td><div style="font-size: 10px;">Note: No transfer of any portion of the shares comprised in this Certificate will be registered unless accompanied by the Certificate.</div></td></tr>
                    </tbody>
                </table>
            </td>
        </tr>
        </tbody>
    </table>
</div>
</body>



