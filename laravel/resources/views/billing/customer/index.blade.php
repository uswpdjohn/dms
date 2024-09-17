@extends('layouts.master')
@section('content')
    <!-- Main Body Start -->
        <div class="main-body">
            @if(session()->has('success'))
                <div class="alert alert-success create">
                    <img class="alert-img" src={{asset('assets/icons/success-alert-icon.png')}} alt="">
                    <p class="alert-text">{{session('success')}}</p>
                </div>
            @endif
            <div id="flashMessages"></div>
            <div class="row customer-billing-body g-0">
                <div class="col-12 col-md-12 ">
                    <div class="card customer-billing-card">
                        <!--View Invoice Portion Starts -->
                        <div id="view-bill" class="d-none card-body customerBillingTabContent cstomer-billing-view-container view-bill">
                            <div class="top-part-div ">
                                <button class="back-btn btn" onclick="goBack(event,'billing')"><i class="fa-solid fa-arrow-left"></i></button>
                            </div>
                            <div  class="tabcontent invoice-part-div row g-0">
                                <div class="col-12 col-md-6 invoice-container">
                                    <div class=" invoice-content-div">
                                        <h5 class="summary-header">Order Summary</h5>
                                        <div class="invoice-no-div">
                                            <p class="invoice-text" name="" id="">Invoice Number:</p>
                                            <p class="invoice-number" name="" id="view_invoice_no"></p>
                                        </div>
                                        <div class="invoice-no-div">
                                            <p class="invoice-text"  id="">Subscription Start:</p>
                                            <p class="invoice-number"  id="view_start_date"></p>
                                        </div>
                                        <div class="invoice-no-div">
                                            <p class="invoice-text"  id="">Subscription End:</p>
                                            <p class="invoice-number"  id="view_end_date"></p>
                                        </div>
                                        <div class="invoice-table table-responsive">
                                            <div class="invoice-table-header row g-0">
                                                <div class="col-8 col-md-8"><p class="header-text"  id="">Name of Services</p></div>
                                                <div class="col-4 col-md-4"><p class="header-text text-end"  id="">Cost of Service</p></div>
                                            </div>
                                            <div class="invoice-table-data row g-0">
                                                <div class="col-8 col-md-8"><p class="content-text" id="view_description"></p></div>
                                                <div class="col-4 col-md-4 text-end"><p class="content-text" id="view_table_sub_total"></p></div>
                                            </div>
                                        </div>
                                        <div class="total-div-container">
                                            <div class="total-div">
                                                <p class="total-text" name="" id="">Subtotal:</p>
                                                <p class="total-number" name="" id="view_sub_total"></p>
                                            </div>
                                            <div class="total-div">
                                                <p class="total-text"  id="">Discount:</p>
                                                <p class="total-number" id="view_discount"></p>
                                            </div>
                                            <div class="total-div">
                                                <p class="total-text" name="" id="">GST:</p>
                                                <p class="total-number" name="" id="view_gst"></p>
                                            </div>
                                            <div class="total-div">
                                                <p class="total-text total" name="" id="">Total:</p>
                                                <p class="total-number total" name="" id="view_grand_total"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 pay-button-div">
                                    <form action="{{route('hitpay.payment')}}" method="POST" id="pay_form">
                                        @csrf
                                        <input type="text" id="payable_grand_total" name="amount" readonly hidden>
                                        <input type="text" id="name" name="name" readonly hidden>
                                        <input type="text" id="email" name="email" readonly hidden>
                                        <input type="text" id="reference_number" name="reference_number" readonly hidden>
                                        <button type="submit" class="btn download-btn action-buttons active" id="pay-invoice">Pay</button>
                                    </form>
                                    <!-- Success Modal Starts -->
{{--                                    <div class="modal fade" id="paySuccessModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="paySuccessModalLabel" aria-hidden="true">--}}
{{--                                        <div class="modal-dialog payment-Modal">--}}
{{--                                            <div class="modal-content">--}}
{{--                                                <div class="payment-Modal-body row">--}}
{{--                                                    <div class="modal-heading col-10 col-sm-11 col-md-11">--}}
{{--                                                        <img class="alert-img" src="{{asset('assets/icons/success-icon.png')}}" alt="">--}}
{{--                                                        <p class="alert-text">Payment Successfull!</p>--}}
{{--                                                    </div>--}}
{{--                                                    <button type="button" class="btn btn-close btn-sm pay-modal-close-btn col-2 col-sm-1 col-md-1" data-bs-dismiss="modal" aria-label="Close"></button>--}}

{{--                                                    <p class=" modal-body-text col-12 col-sm-12 col-md-12">The payment of $150.50 has successfully been paid.</p>--}}
{{--                                                    <div class="text-end col-12 col-sm-12 col-md-12">--}}
{{--                                                        <button type="button" class="btn btn-sm payment-Modal-close-btn modal-btn"  data-bs-dismiss="modal" aria-label="No">Close</button>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                    <!-- Success Modal End -->


                                    <!-- Failed Modal Start -->
{{--                                    <div class="modal fade" id="payFailModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="payFailModalLabel" aria-hidden="true">--}}
{{--                                        <div class="modal-dialog payment-Modal">--}}
{{--                                            <div class="modal-content">--}}
{{--                                                <div class="payment-Modal-body row">--}}
{{--                                                    <div class="modal-heading col-10 col-sm-11 col-md-11">--}}
{{--                                                        <img class="alert-img" src="{{asset('assets/icons/failed.png')}}" alt="">--}}
{{--                                                        <p class="alert-text">Payment Failed!</p>--}}
{{--                                                    </div>--}}
{{--                                                    <button type="button" class="btn btn-close btn-sm pay-modal-close-btn col-2 col-sm-1 col-md-1" data-bs-dismiss="modal" aria-label="Close"></button>--}}
{{--                                                    <p class=" modal-body-text col-12 col-sm-12 col-md-12">We aren’t able to process your payment. Please try again.</p>--}}
{{--                                                    <div class="text-end col-12 col-sm-12 col-md-12">--}}

{{--                                                        <button type="submit" class="btn btn-sm yes-btn modal-btn" >Try Again</button>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                    <!-- Failed Modal End -->
                                </div>
                            </div>

                        </div>
                        <!--  View Invoice Portion Ends -->

                        <!--  Bill index Portion starts -->
                        <div id="billing" class="card-body customerBillingTabContent customer-billing-content-body billing">
                            <div  class="tabcontent ">
                                <div class="table-responsive">
                                    <div class="billing-body">
                                        <div class="bills bills-header row g-0">
                                            <div class="col-2 col-md-3 col-lg-3 description-header  header-div">
                                                <p class="" name="" id="">Description</p>
                                            </div>
                                            <div class="col-2 col-md-2 col-lg-2 header-div">
                                                <p class="" name="" id="">Cost of Service</p>
                                            </div>
                                            <div class="col-2 col-md-2 col-lg-2 header-div">
                                                <p class="" name="" id="">Service Date</p>
                                            </div>
                                            <div class="col-2 col-md-2 col-lg-2 header-div status-header">
                                                <p class="" name="" id="">Payment Status</p>
                                            </div>
                                            <div class="col-2 col-md-1 col-lg-1 header-div">
                                                <p class="" name="" id="">Paid on</p>
                                            </div>
                                            <div class="col-1 col-md-1 col-lg-1 header-div">
                                                <p class="" name="" id="">Due Date</p>
                                            </div>
                                            <div class="col-1 col-md-1 col-lg-1 action-header header-div">
                                                <p class="" name="" id="">Action</p>
                                            </div>
                                        </div>
                                        @if(count($invoices)>0)
                                            @foreach($invoices as $invoice )
                                                <div class="bills row g-0">
                                                    <div class="col-2 col-md-3 col-lg-3 description-div">
                                                        <span>{{$invoice->description}}</span>
                                                    </div>
                                                    <div class="col-2 col-md-2 col-lg-2 data-div">
                                                        <p class="">{{number_format($invoice->grand_total,2,'.', ',')}}</p>
                                                    </div>
                                                    <div class="col-2 col-md-2 col-lg-2 desc-div">
                                                        <p class="">{{\Carbon\Carbon::parse($invoice->subscription_start)->format('M Y')}} - {{\Carbon\Carbon::parse($invoice->subscription_end)->format('M Y')}} </p>
                                                    </div>
                                                    <div class="col-2 col-md-2 col-lg-2 status-div">
                                                        @if($invoice->status == 'invoiced')
                                                            <p name="doc-status" class="doc-status">Unpaid</p>
                                                        @else
                                                            <p name="doc-status" class="doc-status">{{ucfirst($invoice->status)}}</p>
                                                        @endif
                                                    </div>
                                                    <div class="col-2 col-md-1 col-lg-1 time-div">
                                                        @if($invoice->payment_date != null)
                                                            <span>{{\Carbon\Carbon::parse($invoice->payment_date)->format('d M y')}}</span>
                                                        @else
                                                            <span>-</span>
                                                        @endif
                                                    </div>
                                                    <div class="col-1 col-md-1 col-lg-1 data-div">
                                                        <p class="">{{\Carbon\Carbon::parse($invoice->due_date)->format('d M y')}}</p>
                                                    </div>
                                                    <div class="col-1 col-md-1 col-lg-1 action-div">
                                                        <button href="#" class="action-buttons pay-btn {{$invoice->status == 'paid' ? 'disabled': ''}}" data-id="{{$invoice->id}}" onclick="adminBillCreateTab(event, 'view-bill', this)" {{$invoice->status == 'paid' ? 'disabled': ''}}>
                                                            <img class="pay-img" src="{{asset('assets/icons/dollar-coin-circle-with-symbol.png')}}">
                                                        </button>
{{--                                                        <button class="action-buttons" id="invoice-download-{{$invoice->id}}" data-id="{{$invoice->id}}" onclick="downloadInvoice(this)"><img class="download-img" src="{{asset('assets/icons/downloads.png')}}"></button>--}}
                                                        <a href="{{route('invoice.pdf', $invoice->id)}}" class="action-buttons" id="invoice-download-{{$invoice->id}}" data-id="{{$invoice->id}}"><img class="download-img" src="{{asset('assets/icons/downloads.png')}}"></a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="bills row g-0">
                                                <span class="text-danger text-center">No Data Available</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--  Bill index Portion Ends -->

                    </div>

                </div>
            </div>
        </div>
    <!-- Main Body End -->
@endsection
@push('customScripts')
    <script>
        $('#pay_form').on('submit', function () {
            $('#pay-invoice').attr('disabled', true)
        })


        $(document).ready(function(){

            // var viewBills = document.querySelectorAll(".view-bill");
            // for (var i = 0; i < viewBills.length; i++) {
            //     viewBills[i].style.display = "none";
            // }
            // Get the element with id="defaultOpen" and click on it
            var billing = document.querySelector(".billing");
            billing.style.display = "block";

            var createBills = document.querySelectorAll(".create-bill");
            for (var i = 0; i < createBills.length; i++) {
                createBills[i].style.display = "none";
            }


            var editBills = document.querySelectorAll(".edit-bill");
            for (var i = 0; i < editBills.length; i++) {
                editBills[i].style.display = "none";
            }

            $('.admin-bill-create-send-btn').click(function(){
                $('.admin-bill-create-submit-btn').click();
            })

            var docStatus = document.getElementsByName("doc-status");
            var countTickets = docStatus.length;
            for (var i = 0; i < countTickets; i++){
                if(docStatus[i].innerHTML == "Paid"){
                    docStatus[i].style.color = "#52C41A";
                    docStatus[i].style.border = "1px solid #52C41A";
                    docStatus[i].style.backgroundColor = "#F4FFE3";
                }
                else if(docStatus[i].innerHTML == "Overdue"){
                    docStatus[i].style.color = "#EB2F96";
                    docStatus[i].style.border = "1px solid #FFADD2";
                    docStatus[i].style.backgroundColor = "#FFF0F6";
                }
                    // else if(docStatus[i].innerHTML == "Void"){
                    //     docStatus[i].style.color = "#EB2F96";
                    //     docStatus[i].style.border = "1px solid #FFADD2";
                    //     docStatus[i].style.backgroundColor = "#FFF0F6";
                    // }
                    // else if(docStatus[i].innerHTML == "Draft"){
                    //     docStatus[i].style.color = "#A7A7A7";
                    //     docStatus[i].style.border = "1px solid #A7A7A7";
                    //     docStatus[i].style.backgroundColor = "#F4F4F4";
                // }
                else if(docStatus[i].innerHTML == "Unpaid"){
                    docStatus[i].style.color = "#FF9C14";
                    docStatus[i].style.border = "1px solid #FF9C14";
                    docStatus[i].style.backgroundColor = "#FFEDC8";
                }
            }
        })
        $(document).on('click', ".cancel-btn", function() {
            $(this).parent('div').remove();
            // $('#element').show("slow");
        });

        function goBack (event, eventName) {
            var i;
            var tabcontent = document.getElementsByClassName("customerBillingTabContent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }

            var elements = document.getElementsByClassName(eventName);
            for (i = 0; i < elements.length; i++) {
                elements[i].style.display = "block";
            }
            event.currentTarget.className += " active";
        }

        function adminBillCreateTab(evt, eventName,e) {
            // console.log('evt',evt)
            console.log('eventName',eventName)
            var i, tabcontent, tablinks,elements;
            tabcontent = document.getElementsByClassName("customerBillingTabContent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }

            elements = document.getElementsByClassName(eventName);
            $('#'+eventName).removeClass('d-none')
            for (i = 0; i < elements.length; i++) {
                elements[i].style.display = "block";
            }
            evt.currentTarget.className += " active";

            if(eventName=='view-bill'){
                fetchViewData(e)
            }

        }
        function fetchViewData(e){
            let id=e.getAttribute('data-id')
            let url='{{route('billing.show', ':id')}}'
            url= url.replace(':id', id)
            $.ajax({
                url: url,
                success: function (res) {
                    // console.log(res)
                    let subTotal=res[0].sub_total.toFixed(2)
                    let grandTotal=res[0].grand_total.toFixed(2)
                    let discount=0.00
                    if(res[0].discount != null){
                        discount = res[0].discount
                    }


                    $("#view_description").text(res[0].description)
                    $('#view_invoice_no').text(res[0].invoice_no)
                    $('#view_start_date').text($.date(res[0].subscription_start))
                    $('#view_end_date').text($.date(res[0].subscription_end))
                    $('#view_table_sub_total').text(addCommas(subTotal))
                    $('#view_discount').text('$'+addCommas(discount.toFixed(2)))
                    $('#view_sub_total').text('$'+addCommas(subTotal))
                    $("#view_grand_total").text('$'+addCommas(grandTotal))
                    $("#payable_grand_total").val(grandTotal)
                    $("#name").val(res[2].first_name+ ' '+res[2].last_name)
                    $("#email").val(res[2].email)
                    $("#reference_number").val(res[0].reference_number)

                    gstValueCalculationForView(res[0].gst,(res[0].sub_total - discount))
                },
                error: function(xhr){
                    // console.log($(this))
                    // $('#create-send').prop('disabled', false);
                    // // $("#loadingDiv").hide();
                    // $.each(xhr.responseJSON.errors, function (key, value) {
                    //     $('.invoice-' + key).text(value);
                    // });
                    alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
                }
            })

        }
        const fullMonth = ["Jan","Feb","Mar","Apr","May","June","Jul","Aug","Sept","Oct","Nov","Dec"];
        $.date = function(dateObject) {
            var d = new Date(dateObject);
            var day = d.getDate();
            var month = fullMonth[d.getMonth()];
            var year = d.getFullYear();
            if (day < 10) {
                day = "0" + day;
            }
            if (month < 10) {
                month = "0" + month;
            }
            var date = day + " " + month + " " + year.toString().substring(2);

            return date;
        };
        function gstValueCalculationForView(gst,subTotal) {
            let calculatedGst= (subTotal*gst)/100
            $('#view_gst').text('$'+addCommas(calculatedGst.toFixed(2)))
        }
        function addCommas(nStr) {
            nStr += '';
            x = nStr.split('.');
            x1 = x[0];
            x2 = x.length > 1 ? '.' + x[1] : '';
            var rgx = /(\d+)(\d{3})/;
            while (rgx.test(x1)) {
                x1 = x1.replace(rgx, '$1' + ',' + '$2');
            }
            return x1 + x2;
        }
        //Will be used for dynamic blade
        {{--function downloadInvoice(e) {--}}
        {{--    let id= e.getAttribute('data-id');--}}
        {{--    let url = '{{route('invoice.pdf', ':id')}}'--}}
        {{--    url=url.replace(':id', id)--}}
        {{--    $.ajax({--}}
        {{--        url:url,--}}
        {{--        success: function (res) {--}}

        {{--            console.log(res)--}}
        {{--            $('#flashMessages').html(--}}
        {{--                `<div class="alert alert-success">--}}
        {{--                    <img class="alert-img" src="{{asset('assets/icons/success-alert-icon.png')}}" alt="">--}}
        {{--                    <p class="alert-text">Invoice Downloaded Successfully</p></div>`--}}
        {{--            )--}}
        {{--        }--}}
        {{--    })--}}
        {{--}--}}


    </script>
@endpush
