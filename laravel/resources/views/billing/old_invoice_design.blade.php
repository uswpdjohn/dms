<!DOCTYPE html>
<html>
<head>
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap" rel="stylesheet">
    <meta charset="utf-8">
</head>
<body>
<div class="invoice-box">
    <table style="margin-bottom: 40px;">
        <tr>
            <td style="width: 20%"><img src="{{public_path('assets/images/goa-logo.jpg')}}" alt="" style="width: 154px;height: 83px;"></td>
            <td style="width: 80%; text-align: left;">
                <table style="margin-left: 10px;">
                    <tr><td class="invoice-logo-header">Gateway of Asia</td></tr>
                    <tr style="height: 20px"><td class="invoice-logo-dtls">Company Registration No. {{$invoice->company->uen}}</td></tr>
                    <table style="width: 30%;margin-top: 17px;">
                        <tr style="margin-top: 100px;"><td class="invoice-logo-adrs">{{$invoice->company->address_line}}</td></tr>
                    </table>

                </table>
            </td>
        </tr>
    </table>
    <table style="width: 100%;padding: 25px;">
        <tr>
{{--            <td class="invoice-text" style="width: 45%">Invoice</td>--}}
{{--            <td style="width: 27.5%; text-align: left;" class="invoice-attr">INVOICE NO.</td>--}}
{{--            <td style="width: 27.5%; text-align: right;">{{$invoice->invoice_no}}</td>--}}

            <td class="invoice-text" style="width: 80%">Invoice</td>
            <td style="width: 10%; text-align: left;font-size: 18px;" class="invoice-attr">INVOICE NO.</td>
            <td style="width: 10%; text-align: right;font-size: 18px;">{{$invoice->invoice_no}}</td>
        </tr>
        <tr>
            <td style="width: 70%;font-size: 20px" class="invoice-to">{{$invoice->user->first_name. ' '.$invoice->user->last_name }}</td>
            <td style="width: 15%;font-size: 18px;" class="invoice-attr">DATE</td>
            <td style="width: 15%;font-size: 18px; text-align: right;">{{\Carbon\Carbon::parse($invoice->invoice_date)->format('d/m/Y')}}</td>
        </tr>
        <tr>
            <td style="width: 70%;font-size: 20px;" class="invoice-to">{{$invoice->user->email}}</td>
            <td style="width: 15%;font-size: 18px; text-align: left;" class="invoice-attr">TERMS</td>
            <td style="width: 15%;font-size: 18px; text-align: right;">NET {{$invoice->terms}}</td>
        </tr>
        <tr>
            <td style="width: 70%"></td>
            <td style="width: 15%;font-size: 18px;text-align: left;" class="invoice-attr">DUE DATE</td>
            <td style="width: 15%;font-size: 18px; text-align: right;">{{\Carbon\Carbon::parse($invoice->due_date)->format('d/m/Y')}}</td>
        </tr>
        <tr>
            <td style="width: 45%;font-size: 14px;color: #929090;">BILL TO</td>
            <td style="width: 27.5%;font-size: 18px;text-align: left;" class="invoice-attr">CREATED BY</td>
            <td style="width: 27.5%;font-size: 18px; text-align: right;">{{ucfirst($invoice->adminUser->first_name. ' '.  $invoice->adminUser->last_name)}}</td>
        </tr>
    </table>
    <table style="margin-top: 20px;width: 100%; padding: 5px; background-color: #A07C7C">
        <thead>
        <tr>
            <td style="width: 55%;font-weight: bold;color: #FFFFFF;">Service/Subscription & Description</td>
            <td style="width: 15%; text-align: right;font-weight: bold;color: #FFFFFF;">Date Start</td>
            <td style="width: 15%;text-align: center;font-weight: bold;color: #FFFFFF;">Date End</td>
            <td style="width: 15%;text-align: right;font-weight: bold;color: #FFFFFF;">Subtotal</td>
        </tr>
        </thead>
    </table>

    <table id="description" style="margin-top: 10px;width: 100%;padding: 15px;margin-left: 10px;">
        <tbody>
            <tr>
                <td style="width: 55%;white-space: pre-line;">{{$invoice->description}}</td>
                <td style="width: 15%;text-align: right">{{\Carbon\Carbon::parse($invoice->subscription_start)->format('d/m/Y')}}</td>
                <td style="width: 15%;text-align: center">{{\Carbon\Carbon::parse($invoice->subscription_end)->format('d/m/Y')}}</td>
                <td style="width: 15%;text-align: right;font-weight: bold">${{number_format((float)$invoice->sub_total,2, '.', ',')}}</td>
            </tr>
        </tbody>

    </table>
    <hr style="width: 100%; border: 0.5px solid #DBDBDB">
    <table style="width: 100%; padding: 15px;margin-left: 10px;">
        <tbody>
            <tr><td style="font-weight: bold;width: 100%;">Notes</td></tr>
            <tr><td style="font-weight: 600;width: 100%;">{{$invoice->notes}}</td></tr>
        </tbody>
    </table>
    <hr style="width: 100%; border: 1px solid #DBDBDB">

    <table style="width: 100%;margin-top: 20px;margin-right: 10px;">
        <tr>
            <td style="width: 60%"></td>
            <td style="width: 40%;background: #E4E3E3;">
                <table style="width: 100%;padding: 15px;border-radius: 2em 1em 4em / 0.5em 3em;">
                    <tr>
                        <td style="text-align: left;width: 50%;color: #A69E9E;font-weight: 600">SUB TOTAL</td>
                        <td style="text-align: right;width: 50%;color: #717171;">${{number_format((float)$invoice->sub_total, 2, '.', ',')}}</td>
                    </tr>
                    <tr >
                        <td style="text-align: left;width: 50%;color: #A69E9E;font-weight: 600">DISCOUNT</td>
                        <td style="text-align: right;width: 50%;color: #717171;">- ${{number_format((float)$invoice->discount, 2, '.', ',')}}</td>
                    </tr>
                    <tr >
                        <td style="text-align: left;width: 50%;color: #A69E9E;font-weight: 600">TOTAL</td>
                        <td style="text-align: right;width: 50%;color: #000000;">${{number_format((float)$invoice->grand_total,2, '.', ',')}}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <table style="width: 100%;margin-right: 10px;">
        <tr>
            <td style="width: 60%"></td>
            <td style="width: 40%">
                <table style="width: 100%;margin-top: 10px;" >
                    <tr>
                        <td style="text-align: left;font-weight: bold;font-size: 20px">Grand Total:</td>
                        <td style="text-align: right;text-decoration: underline; font-weight: bold;font-size: 20px;">${{number_format($invoice->grand_total, 2, '.', ',')}}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <table style="width: 100%;margin-top:25px;">
        <tr><td style="text-align: center;font-size: 14px;color: #8C8C8C">This is a sample footer and what is typed here will be shown at the bottom of the invoice</td></tr>
    </table>


</div>
</body>



