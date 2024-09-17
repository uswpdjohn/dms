@extends('layouts.master')
@section('content')
    <!-- Main Body Start -->
    <div class="main-body">
        <!-- <div class="alert alert-success create">
            <img class="alert-img" src="../../assets/icons/success-alert-icon.png" alt="">
            <p class="alert-text"> User created successfully.</p>
        </div> -->
{{--        <div class="alert alert-success failed">--}}
{{--            <img class="alert-img" src="{{asset('assets/icons/close.png')}}" alt="">--}}
{{--            <p class="alert-text"> Error: File size limit: 5 MB. Exceeded.</p>--}}
{{--        </div>--}}
        @if(session()->has('errors'))
            <div class="alert alert-success failed login-alert-error">
                <img class="alert-img" src="{{asset('assets/icons/mailbody-!.png')}}" alt="">
                <p class="alert-text">{{session('errors')}}</p>
            </div>
        @endif
{{--        @if($errors->any())--}}
{{--            {!! implode('', $errors->all('<div>:message</div>')) !!}--}}
{{--        @endif--}}

{{--        @if(session()->has('success'))--}}
{{--            <script>--}}
{{--                document.getElementById("submitSuccessModal").modal('show')--}}
{{--                // $('#submitSuccessModal').modal('show')--}}
{{--            </script>--}}
{{--        @endif--}}

        <div class="row customer-customer-support-body g-0">
            <div class="col-12 col-md-2 card customer-customer-support-button-card">
                <div class="card-body customer-customer-support-button-body">
                    <div class="tab-buttons">
                        @foreach($categories as $category)
                        <button class="tablinks customerCustomerSupportTabLinks" id="tab-btn-{{ $category->id }}" onclick="customerCustomerSupportTab(event, {{ $category->slug }} )">{{ $category->name }}</button>
                        @endforeach
{{--                        <button class="tablinks customerCustomerSupportTabLinks" id="" onclick="customerCustomerSupportTab(event, 'mailbox')">Mailbox</button>--}}
{{--                        <button class="tablinks customerCustomerSupportTabLinks" id="" onclick="customerCustomerSupportTab(event, 'cs')">Corporate Secretary</button>--}}
{{--                        <button class="tablinks customerCustomerSupportTabLinks" id="" onclick="customerCustomerSupportTab(event, 'gst')">GST Report</button>--}}
{{--                        <button class="tablinks customerCustomerSupportTabLinks" id="" onclick="customerCustomerSupportTab(event, 'acc')">Accounting</button>--}}
{{--                        <button class="tablinks customerCustomerSupportTabLinks" id="" onclick="customerCustomerSupportTab(event, 'hr')">Human Resources</button>--}}
{{--                        <button class="tablinks customerCustomerSupportTabLinks" id="" onclick="customerCustomerSupportTab(event, 'cap')">CAP Table</button>--}}
{{--                        <button class="tablinks customerCustomerSupportTabLinks" id="" onclick="customerCustomerSupportTab(event, 'esop')">ESOP</button>--}}
{{--                        <button class="tablinks customerCustomerSupportTabLinks" id="" onclick="customerCustomerSupportTab(event, 'billing')">Billing</button>--}}
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-10 ">
                <div class="card customer-customer-support-card">
                    <h6 class="customer-support-header fw-bold">Top Frequently Asked Questions</h6>
                    <div class="accordion accordion-flush" id="accordionFlushExample">
{{--                        @dd(count($categories))--}}

                        @foreach($categories as $category)
                        <div class="customer-customer-support-accordion accordion accordion-flush cs col-12" id="{{ $category->slug }}"></div>
                        @endforeach

                    </div>
                </div>
            </div>

            <div class="customer-customer-support-footer card  col-12">
                <div class="footer-inner row">
                    <p id="" name="" class="footer-text col-12 col-md-8 col-lg-7">Not what you’re looking for? Submit your own question</p>
                    <div class="button-part col-12 col-md-4 col-lg-5">
                        <a href="{{route('ticket.index')}}" type="button" class="btn view-btn action-buttons ">View Ticket</a>

                        <button id="ticket_submit_modal" type="button" class="btn submit-btn action-buttons active ticket_submit_modal" data-bs-toggle="modal" data-bs-target="#ticketAddModal">Submit</button>
                    </div>
                </div>

            </div>


            <!-- Ticket Add Modal Start -->
            <div class="modal fade" id="ticketAddModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="ticketAddModalLabel" aria-hidden="true">
                <div class="modal-dialog ticket-add-modal">
                    <div class="modal-content">
                        <div class="ticket-add-modal-body">
                            <div class="ticket-add-modal-header row">
                                <h5 class="modal-title col-10 col-sm-11 col-md-11" id="ticketAddModalLabel">Submit Task</h5>
                                <button type="button" class="btn btn-close btn-sm ticket-add-modal-close-btn col-2 col-sm-1 col-md-1" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="ticket-add-modal-data row">
                                <form action="" enctype="multipart/form-data" id="ticket_store">
                                    <meta name="csrf-token" content="{{ csrf_token() }}" />
{{--                                    <input type="hidden" id="support-ticket-key" name="support_ticket_key">--}}
                                    <div class="data-body row">
                                        <div class="data-row col-6">
                                            <label for="category_id"> <span class="required-sign">*</span>Category</label>
                                            <select class="form-control form-select nav-select select-data " name="category_id" id="category_id" required>
                                                <option hidden>Select Category</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach

                                            </select>
                                            <span class="text-danger ticket-category_id"></span>
                                        </div>
                                        <div class="data-row col-6">
                                            <label for="file">File<span class="file-header">(Optional)</span></label>
                                            <div class="upload-container">
                                                <input id="file-name" class="file-name form-control" type="text" placeholder="No File Chosen" readonly />
                                                <input id="file-upload" class="document-upload" type="file" name="file" accept=".doc, .docx, .pdf, .zip, .rar" placeholder="No File Chosen" />
                                                <label for="file-upload" class="custom-file-upload-icon"><i class="fa-sharp fa-light fa-arrow-up-from-bracket"></i>
                                                </label>
                                            </div>
                                            <span class="text-danger ticket-file"></span>
                                        </div>
                                        <div class="data-row col-12">
                                            <label for="message"><span class="required-sign">*</span>Message</label>
                                            <textarea  name="message" class="form-control" id="message" placeholder="Textarea placeholder" required></textarea>
                                            <span class="text-danger ticket-message"></span>
                                        </div>

{{--                                        <div class="data-row col-12">--}}
{{--                                            <div class="search-results">--}}
{{--                                                <ul class="list-group" id="search-results-list"></ul>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
                                        <div class="data-row col-12 text-end">
                                            <button type="button" class="create-user-btn btn" id="add-ticket"
{{--                                                    data-bs-toggle="modal" data-bs-target="#submitFailModal"--}}
                                            >Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Ticket Add Modal End -->
            <!-- Success Modal Start -->
            <div class="modal fade" id="submitSuccessModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="submitSuccessModalLabel" aria-hidden="true">
                <div class="modal-dialog submit-ticket-Modal">
                    <div class="modal-content">
                        <div class="submit-ticket-Modal-body">
                            <div class="modal-heading">
                                <img class="alert-img" src="{{asset('assets/icons/success-icon.png')}}" alt="">
                                <p class="alert-text">Submission Successful</p>
                            </div>

                            <p class="modal-body-text" id="submitSuccessModalMessage"></p>
                            <div class="text-center">
                                <button type="button" class="btn btn-sm submit-ticket-Modal-close-btn"  data-bs-dismiss="modal" aria-label="No">Close</button>
                                <button type="button" class="btn btn-sm yes-btn ticket_submit_modal" id="submit-another" >Submit a Ticket</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Success Modal End -->


            <!-- Failed Modal Start -->
            <div class="modal fade" id="submitFailModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="submitFailModalLabel" aria-hidden="true">
                <div class="modal-dialog submit-ticket-Modal">
                    <div class="modal-content">
                        <div class="submit-ticket-Modal-body">
                            <div class="modal-heading">
                                <img class="alert-img" src="{{asset('assets/icons/failed.png')}}" alt="">
                                <p class="alert-text">Submission Failed</p>
                            </div>

                            <p class=" modal-body-text">Please Try Again</p>
                            <div class="text-center">
                                <button type="button" class="btn btn-sm submit-ticket-Modal-close-btn"  data-bs-dismiss="modal" aria-label="No">Close</button>
                                <button type="button" class="btn btn-sm yes-btn ticket_submit_modal" data-bs-dismiss="modal" aria-label="No">Submit Again</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Failed Modal End -->
        </div>
    </div>
    <!-- Main Body End -->

@endsection
@push('customScripts')
    <script>
        $('.ticket_submit_modal').on('click', function (e) {
            e.preventDefault()
            $('#category_id').val("");
            $('#file-upload').val('');
            $('#file-name').val('');
            $('#message').val('');

            $('.ticket-category_id').text('');
            $('.ticket-message').text('');
            $('.ticket-file').text('');
            $('#add-ticket').prop('disabled', false);
            $('#ticketAddModal').modal('show');
            $('#submitSuccessModal').modal('hide');
        });

        ///for showing file name function starts
        const fileUpload = document.getElementById('file-upload');
        const fileNameInput = document.getElementById('file-name');

        fileUpload.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                fileNameInput.value = file.name;
            } else {
                fileNameInput.value = 'No File Chosen';
            }
        });
        ///for showing file name function ends

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#add-ticket').on('click', function (e) {
            $(this).prop('disabled', true);

            let form = $("#ticket_store")[0];
            let formData = new FormData(form);
            e.preventDefault();

            $.ajax({
                type: "POST",
                url: "{{route('ticket.from.faq')}}",
                data: formData,
                processData: false,
                contentType: false,
                dataType:'json',
                // beforeSend: function() {
                //     $("#loadingDiv").show();
                // },
                success: function(data) {
                    // $("#loadingDiv").hide();
                    if (data.success == 1){
                        // $("html, body").animate({ scrollTop: 0 });

                        $('#submitSuccessModalMessage').text(data.message);
                        $('#submitSuccessModal').modal('show');
                        $('#ticketAddModal').modal('hide');

                        {{--$('#flashMessages').html(--}}
                        {{--    `<div class="alert alert-success">--}}
                        {{--    <img class="alert-img" src="{{asset('assets/icons/success-alert-icon.png')}}" alt="">--}}
                        {{--    <p class="alert-text">${data.message}</p></div>`--}}
                        {{--)--}}
                        // setTimeout(function(){
                        //     window.location.reload();
                        // }, 2000);
                        // $(".alert-text").html(response.message);
                    }
                    else{
                        $('#submitFailModal').modal('show');
                        $('#ticketAddModal').modal('hide');
                    }
                },
                error: function(xhr){
                    // console.log($(this))
                    $('#add-ticket').prop('disabled', false);
                    // $("#loadingDiv").hide();
                    $.each(xhr.responseJSON.errors, function (key, value) {
                        $('.ticket-' + key).text(value);
                    });
                    // alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
                }
            });

        });

        function loadData(eventName){
            let url = '{{route('customer-support.show', ':slug')}}';
            url= url.replace(':slug', eventName);
            console.log(url)

            $.ajax({
                url: url,
                dataType: 'json',
                success: function(response) {
                    console.log('res',response);
                    var html='';
                    if (response.data.length > 0){
                        for(data of response.data){
                            console.log(data);
                                html+=
                                    '<div class="accordion-item">' +
                                    '<h2 class="accordion-header" id="faqheader'+data.id+'">' +
                                    '<button class="accordion-button collapsed form-control" type="button" data-bs-toggle="collapse" data-bs-target="#faqbody'+data.id+'" aria-expanded="false" aria-controls="faqbody'+data.id+'">' +
                                    '<span>'+ data.question +'</span>' +
                                    '</button>' +
                                    '</h2>' +
                                    '<div id="faqbody'+data.id+'" class="accordion-collapse collapse" aria-labelledby="faqheader'+data.id+'" data-bs-parent="#'+data.category.slug+'">' +
                                    '<div class="accordion-body">' +
                                    '<div class="accordion-ans-div">' +
                                    '<p id="" class="ans-content">'+ data.answer +'</p>' +
                                    '</div>' +
                                    '</div>' +
                                    '</div>' +
                                    '</div>';
                        }
                    }else {
                        html+='<div class="accordion-item">' +
                            '<h2 class="accordion-header" id="faqheader">' +
                            '<button class="accordion-button collapsed form-control" disabled type="button" data-bs-toggle="collapse" data-bs-target="#faqbody" aria-expanded="false" aria-controls="faqbody">' +
                            '<span>No Data Available!</span>' +
                            '</button>' +
                            '</h2>' +
                            '<div id="faqbody" class="accordion-collapse collapse" aria-labelledby="faqheader" data-bs-parent="#">' +
                            '<div class="accordion-body">' +
                            '<div class="accordion-ans-div">' +
                            '<p id="" class="ans-content"></p>' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '</div>';
                    }

                    $('#'+eventName).empty().append(html);
                }

                // }
            });
        }


        $(document).ready(function(){
            // Get the element with id="defaultOpen" and click on it
            document.getElementById("tab-btn-1").click();
            // loadData('mailbox');


            // $('.admin-mail-create-send-btn').click(function(){
            //     $('.admin-mail-create-submit-btn').click();
            // })
        });


        function customerCustomerSupportTab(evt, eventName) {
            var name = $(eventName).attr('id').toString();
            console.log(name)
            loadData(name);

            var i, tabcontent, tablinks,elements;
            tabcontent = document.getElementsByClassName("customer-customer-support-accordion");
            for (i = 0; i < tabcontent.length; i++) {
                if(tabcontent[i].id !== name) {
                    tabcontent[i].style.display = "none";
                }
                else{
                    $('#'+name).removeAttr('style')
                }
            }
            tablinks = document.getElementsByClassName("customerCustomerSupportTabLinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }

            // document.getElementById(enevtName).style.display = "block";

            elements = document.getElementsByClassName(eventName);
            for (i = 0; i < elements.length; i++) {
                elements[i].style.display = "block";
            }
            evt.currentTarget.className += " active";
        }


    </script>


@endpush()
