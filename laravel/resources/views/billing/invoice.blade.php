<!DOCTYPE html>
<html>
<head>
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap" rel="stylesheet">
    <meta charset="utf-8">
</head>
<body>
<div class="invoice-box" style="margin-left:10%;margin-top:30px;width:80%">
    <table style="margin-bottom: 40px; width:100%">
        <tr>
            <td style="width: 70%;padding-top:10px">
                <h1 class="invoice-logo-header" style="font-size:30px;">Tax Invoice</h1>
                <br>
                <h5 class="invoice-logo-dtls">Gateway of Asia Pte. Ltd.</h5>
            </td>
            <td style="width: 30%;padding-top:35px">
                <label for="invoice_date" style="font-style: bold;padding-bottom: 5rem!important" class="invoice-right-label"><b>Invoice Date</b></label>
                <p name="" id="invoice_date" class="invoice-right-data" style="margin-bottom: 10px">{{\Carbon\Carbon::parse($invoice->invoice_date)->format('d/m/Y')}}</p>
                <br>
                <label for="invoice_no" class="invoice-right-label" style="font-style: bold;margin-bottom:5px"><b>Invoice Number</b></label>
                <p name="" id="invoice_no" class="invoice-right-data">{{$invoice->invoice_no}}</p>
            </td>
        </tr>
    </table>
    <table style="width: 100%;border-bottom: 2px solid #000000; padding-bottom:10px ">
        <thead>
        <tr>
            <td style="width: 40%;font-weight: bold;font-size:14px">Service/Subscription & Description</td>
            <td style="width: 12%;font-weight: bold;font-size:14px;text-align: center">Quantity</td>
            <td style="width: 13%;font-weight: bold;font-size:14px;text-align: center">Unit Price</td>
            <td style="width: 10%;font-weight: bold;font-size:14px;text-align: center">Discount</td>
            <td style="width: 10%;font-weight: bold;font-size:14px;text-align: center">Tax</td>
            <td style="width: 15%;font-weight: bold;font-size:14px;text-align: center">Amount SGD</td>
        </tr>
        </thead>
    </table>

    <table id="description" style="width: 100%;border-bottom: 1px solid #8C8C8C; padding-bottom:10px">
        <tbody>
            <tr>
                <td style="width: 40%;white-space: pre-line;">{{$invoice->description}}</td>
                <td style="width: 12%;text-align: center">1.00</td>
                <td style="width: 13%;text-align: center">{{number_format((float)$invoice->sub_total,2, '.', ',')}}</td>
                <td style="width: 10%;text-align: center">{{number_format((float)$invoice->discount,2, '.', ',')}}</td>
                <td style="width: 10%;text-align: center">{{$invoice->gst}}%</td>
                <td style="width: 15%;text-align: right;">${{number_format((float)$invoice->grand_total,2, '.', ',')}}</td>
            </tr>
        </tbody>

    </table>
    <table style="width: 100%;margin-left: 40%;border-bottom: 2px solid #8C8C8C;float:right">
        <tbody>
            <tr>
                <td style="min-width:60%;text-align: right; ">Subtotal</td>
                <td style="min-width:40%;text-align: right;">${{number_format((float)$invoice->sub_total,2, '.', ',')}}</td>
            </tr>
            <tr>
                <td style="min-width:60%;text-align: right; ">Discount</td>
                <td style="min-width:40%;text-align: right;">${{number_format((float)$invoice->discount,2, '.', ',')}}</td>
            </tr>
            <tr>
                <td style="min-width:60%;text-align: right;">Total {{$invoice->gst}}%</td>
                @if($invoice->discount != null)
                    <td style="min-width:40%;text-align: right;">${{number_format((float)(($invoice->sub_total -$invoice->discount)*$invoice->gst)/100, 2, '.', ',')}}</td>
                @else
                    <td style="min-width:40%;text-align: right;">${{number_format((float)($invoice->sub_total*$invoice->gst)/100, 2, '.', ',')}}</td>
                @endif
            </tr>
        </tbody>
    </table>
    <table style="width: 100%;margin-left: 34%">
        <tbody>
            <tr>
                <td style="min-width:60%;text-align: right;">Invoice Total SGD</td>
                <td style="min-width:40%;text-align: right;">${{number_format((float)$invoice->grand_total,2, '.', ',')}}</td>
            </tr>
        </tbody>
    </table>
    <table style="width: 100%;padding-top:30px">
        <tbody>
            <tr>
                <td style="padding-bottom:10px">
                    <h6 class="terms-header" style="font-size: 19px">Terms and Conditions</h6>
                </td>
            </tr>
            <tr>
                <td>
                    <ul class="footer-text" style="list-style-type:disc;">
                        <li>All invoices are due and payable upon presentation.</li>
                        <li>Any modification of fees will be agreed in writing in advance.</li>
                        <li>All bank charges are to be borne by the remitter.</li>
                    </ul>
                </td>
            </tr>
        </tbody>
    </table>
    <table style="width: 100%;padding-top:25px">
        <tbody>
            <tr>
                <td style="padding-bottom:10px">
                    <h6 class="terms-header" style="font-size: 19px">Remittance Details</h6>
                </td>
            </tr>
            <tr>
                <td>
                    <ul class="footer-text" style="list-style-type:disc;">
                        <li>Name of account: &nbsp;&nbsp;&nbsp; XXXXXXXXXX Pte. Ltd.</li>
                        <li>Account number: &nbsp;&nbsp;&nbsp; SGD XXXXXXXXXX</li>
                        <li>Name of bank: &nbsp;&nbsp;&nbsp; XXX Bank </li>
                        <li>Swift Code: &nbsp;&nbsp;&nbsp; XXXXXX </li>
                    </ul>
                </td>
            </tr>
        </tbody>
    </table>

    <table style="width: 100%;padding-top:150px">
        <tbody>
            <tr>
                <td>
                    <h6 class="terms-header" style="font-size:13px">Remark :</h6>
                </td>
            </tr>
            <tr>
                <td>
                    <ol class="footer-text" style="list-style-type:disc;align-self: flex-end;position:fixed;font-size:12px">
                        <li>This is a computer generated invoice and no signature is required</li>
                        <li>Interest of 1% per month is chargeable on all outstanding due and additional 20% charge as handling fee for the bad debt collection.</li>
                    </ol>
                </td>
            </tr>
        </tbody>
    </table>


</div>
</body>



