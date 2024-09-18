@php use App\Helpers\Helper; @endphp
@extends('layouts.master')
@section('content')
    <!-- Main Body Start -->
    <div class="row main-body g-0">

        <input type="text" value="{{explode('/', \Illuminate\Support\Facades\URL::current())[5]}}" id="serviceId"
               hidden="hidden" readonly>
        <!-- Start of New Mail/Document Portion -->
        <div class="customer-document-management-new-mail-doc-portion col-12" id="newMailDocument">
            <div class="accordion-item">
                <h2 class="accordion-header" id="newMailDocumentHeader">
                    <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse"
                            data-bs-target="#newMailDocumentBody" aria-expanded="false"
                            aria-controls="newMailDocumentBody">
                        Latest Document <span class="badge">{{count($latestFour)}}</span>
                    </button>
                </h2>
                <div id="newMailDocumentBody" class="accordion-collapse collapse"
                     aria-labelledby="newMailDocumentHeader" data-bs-parent="#newMailDocument">
                    <div class="accordion-body">
                        <div class="row">
                            @foreach($latestFour as $item)
                                <div class="col-sm-6 col-md-4 col-lg-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="image-portion">
                                                <img class="document-image"
                                                     src="{{url('/images/thumbnail/'.$item['document_id'].'.png')}}"
                                                     alt="">
                                            </div>
                                        </div>
                                        <div class="text-btn-portion">
                                            <span>{{$item['name']}}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of New Mail/Document Portion -->

        <!-- Start of Search Button Portion -->
        <div class="customer-document-management-search-btn-portion col-12">
            <div class="card">
                <div class="card-body d-flex">
{{--                    <div class="left-side-portion d-flex">--}}
{{--                        <button type="button" id="topDownloadBtn" class="btn download-btn active">Download</button>--}}
{{--                        <span class="text-danger ms-3" id="download-btn-error-text"></span>--}}
{{--                    </div>--}}
                    <div class="right-side-portion">
                        <div class="sb-part search-box-part">

                            <form
                                action="{{route('documentManagement.customer',explode('/',\Illuminate\Support\Facades\URL::current())[5])}}"
                                method="GET">
                                <div class="d-flex form-inputs search-data">
                                    <input class="form-control" type="text" name="search" placeholder="Search"
                                           value="{{request()->has('search') ? request()->get('search') : ''}}">
                                    <button type="submit" class="search-btn btn"><i class="fa-solid fa-search"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="btn-group">
                            <a href="#" id="list" class="btn btn-default btn-sm">
                                <i class="fa-solid list-btn fa-list"></i>
                            </a>
                            <a href="#" id="grid" class="btn btn-default btn-sm active">
                                <i class="fa-solid grid-btn fa-table-cells-large active"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of Search Button Portion -->
        <form action="" method="GET" id="customer-doc-form">
            <input type="text" id="documentId" name="document_id[]" value="" hidden>

            <!-- Start of Yearly Basis Document Portion -->
            <div class="accordion accordion-flush" id="accordionFlushExample">
                <div class="customer-document-management-yearly-accordion accordion accordion-flush col-12"
                     id="documentAccordion">

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="documentHeader-2021">
                            <!-- Dynamic "Id" will be generated here by concatenating the file year -->
                            <button class="accordion-button collapsed fw-bold form-control" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#documentBody2021" aria-expanded="false"
                                    aria-controls="documentBody2021">
                                <!-- Dynamic "data-bs-target" & "area-controls" will be generated here by concatenating the file year -->
                                <span>E-Document</span>
                            </button>
                        </h2>
                        <div id="documentBody2021" class="accordion-collapse collapse"
                             aria-labelledby="documentHeader2021" data-bs-parent="#documentAccordion">
                            <!-- Dynamic "Id" , "aria-labelledby", "data-bs-parent" will be generated here by concatenating the file year -->
                            <div class="accordion-body">
                                <!-- <div class="select-all-portion">
                                    <a href="#" class="select-all-link">Select All</a>
                                </div> -->
                                <!-- Tabs navs -->
                                <div class="tab-content" id="pills-tabContent">
                                    <!--For all "tab-pane" buttons dynamic "Id","aria-labelledby" will be generated here by concatenating the file year -->
                                    {{--                                    @foreach($document['document'] as $gitem)--}}
                                    <div class="tab-pane fade show active" id="pills-jan-2021" role="tabpanel"
                                         aria-labelledby="pills-jan-2021-tab">
                                        <div class="row grid-view">
                                            <!-- Start of the main Card -->
                                            @foreach($document['document'] as $gitem)
                                                <div class="col-sm-6 col-md-4 col-lg-3">
                                                    <div class="card">
{{--                                                        <div class="checkbox-area">--}}
{{--                                                            <input class="document-checkbox grid-input"--}}
{{--                                                                   type="checkbox" name="document_id[]"--}}
{{--                                                                   value="{{$gitem['document_id']}}">--}}
{{--                                                        </div>--}}
                                                        <div class="text-btn-portion">
                                                            <div class="text-portion">
                                                                <p class="doc-name">{{$gitem['name']}}</p>
                                                                <p class="update-time">Last Updated
                                                                    On: {{$gitem['updated_at']}}</p>
                                                            </div>
                                                            <div class="btn-portion">
                                                                <button type="submit" id="{{$gitem['document_id']}}"
                                                                        onclick="individualDownload(this)"
                                                                        class="btn download-bth">
                                                                    <img
                                                                        src="{{asset('assets/icons/download-silver-icon.png')}}"
                                                                        alt="">
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach

                                            <!-- End of the main Card -->

                                        </div>

                                        <!-- responsive task : get the list view in side table responsive div -->
                                        <!-- Start List View -->
                                        <div class="table-responsive">
                                            <div class="row list-view d-none">
                                                <div class="document-table">
                                                    <div class="thead">
                                                        <div class="tr row">
                                                            <div class="name-header th col-5 col-md-5 col-lg-7">
                                                                Document Name
                                                            </div>
                                                            <div
                                                                class="update-date-header th col-3 col-md-3 col-lg-4">
                                                                Last Updated On
                                                            </div>
                                                            <div
                                                                class="action-header th col-2 col-md-2 col-lg-1">
                                                                Action
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tbody">
                                                        <!-- Main row start -->
                                                        @foreach($document['document'] as $gitem)
                                                            <div class="tr row">
{{--                                                                <div class="name-data td col-5 col-md-5 col-lg-7">--}}
{{--                                                                    <input class="document-checkbox"--}}
{{--                                                                           type="checkbox" name="document_id[]"--}}
{{--                                                                           value="{{$gitem['document_id']}}">--}}
{{--                                                                    {{$gitem['name']}}--}}
{{--                                                                </div>--}}
                                                                <div
                                                                    class="update-date-data td col-3 col-md-3 col-lg-4">{{$gitem['updated_at']}}</div>
                                                                <div class="action-data td col-2 col-md-2 col-lg-1">
                                                                    <button type="submit"
                                                                            class="btn download-btn list-{{$gitem['document_id']}}"
                                                                            id="{{$gitem['document_id']}}"
                                                                            onclick="individualDownload(this)">Download
                                                                    </button>
                                                                    {{--                                                                <a href="#" class="btn download-btn" type="submit" id="{{$item['document_id']}}" onclick="individualDownload(this)">{{item['downloaded_at'] != null ? 'Downloaded' : 'Download'}}</a>--}}
                                                                </div>
                                                            </div>
                                                        @endforeach

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End List View -->
                                    </div>
                                    {{--                                    @endforeach--}}
                                </div>
                                <!-- Tabs content -->
                            </div>
                        </div>
                    </div>
                    @foreach($document['mailbox'] as $year=>$mailbox)
                        {{--                        @dd($document['mailbox'])--}}
                        {{--                    @foreach($document as $key=>$value)--}}

                        <!-- Start of the Main Accordion -->
                        {{--                    for e-document(Document Management)--}}

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="documentHeader-{{str_replace(' ', '', $year)}}">
                                <!-- Dynamic "Id" will be generated here by concatenating the file year -->
                                <button class="accordion-button collapsed fw-bold form-control" type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#documentBody{{str_replace(' ', '', $year)}}"
                                        aria-expanded="false"
                                        aria-controls="documentBody{{str_replace(' ', '', $year)}}">
                                    <!-- Dynamic "data-bs-target" & "area-controls" will be generated here by concatenating the file year -->
                                    <span>{{ucwords($year)}}</span>
                                </button>
                            </h2>
                            <div id="documentBody{{str_replace(' ', '', $year)}}" class="accordion-collapse collapse"
                                 aria-labelledby="documentHeader{{str_replace(' ', '', $year)}}"
                                 data-bs-parent="#documentAccordion">
                                <!-- Dynamic "Id" , "aria-labelledby", "data-bs-parent" will be generated here by concatenating the file year -->
                                <div class="accordion-body">
                                    <!-- Tabs navs -->
                                    <div class="tab-content" id="pills-tabContent-{{str_replace(' ', '', $year)}}">
                                        <div class="tab-pane fade show active"
                                             id="pills-{{str_replace(' ', '', $year)}}"
                                             role="tabpanel"
                                             aria-labelledby="pills-{{str_replace(' ', '', $year)}}-tab">
                                            <div class="row grid-view">
                                                @foreach($mailbox as $key=>$gitem)

                                                    <!-- Start of the main Card -->
                                                    <div class="col-sm-6 col-md-4 col-lg-3">
                                                        <div class="card">
{{--                                                            <div class="checkbox-area">--}}
{{--                                                                <input class="document-checkbox grid-input"--}}
{{--                                                                       type="checkbox" name="files[]"--}}
{{--                                                                       --}}{{--                                                                                   value="{{$gitem['file']}}">--}}
{{--                                                                       value="{{'company_'.$gitem['company_id'].'/'.Helper::convertToTitleCase($gitem['category']).'/'.$gitem['directory'].'/'.$gitem['file']}}">--}}
{{--                                                            </div>--}}
                                                            <div class="text-btn-portion">
                                                                <div class="text-portion">
                                                                    <p class="doc-name">{{$gitem['title']}}</p>
                                                                    <p class="update-time">Last Updated
                                                                        On: {{\Carbon\Carbon::parse($gitem['updated_at'])->timezone('Asia/Singapore')->format('d M Y H:i')}}</p>
                                                                </div>
                                                                <div class="btn-portion">
                                                                    <button type="submit" id="{{$gitem['id']}}"
                                                                            onclick="downloadIndividual(this,{{$gitem['id']}})"
                                                                            class="btn download-bth {{$gitem['file'] == null ? 'disabled' : ''}}" {{$gitem['file'] == null ? 'disabled' : ''}} >
                                                                        <img
                                                                            src="{{asset('assets/icons/download-silver-icon.png')}}"
                                                                            alt="">
                                                                    </button>
                                                                </div>

                                                            </div>
                                                            {{--                                                                    @endif--}}
                                                        </div>
                                                    </div>
                                                    {{--                                                            @endif--}}

                                                    <!-- End of the main Card -->
                                                @endforeach
                                                <!-- Just take the "btn-portion" from next two cards for the warning-time's and remaining-time's btn and texts and time -->
                                            </div>
                                            {{--                                                    <!-- Start List View -->--}}
                                            <div class="table-responsive">
                                                <div class="row list-view d-none">
                                                    <div class="document-table">
                                                        <div class="thead">
                                                            <div class="tr row">
                                                                <div class="name-header th col-5 col-md-5 col-lg-7">
                                                                    Document Name
                                                                </div>
                                                                <div
                                                                    class="update-date-header th col-3 col-md-3 col-lg-4">
                                                                    Last Updated On
                                                                </div>
                                                                <div
                                                                    class="action-header th col-2 col-md-2 col-lg-1">
                                                                    Action
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="tbody">
                                                            @foreach($mailbox as $litem)
                                                                <!-- Main row start -->

                                                                <div class="tr row">
{{--                                                                    <div class="name-data td col-5 col-md-5 col-lg-7">--}}
{{--                                                                        <input class="document-checkbox"--}}
{{--                                                                               type="checkbox" name="files[]"--}}
{{--                                                                               --}}{{--                                                                                       value="{{$litem['file']}}">--}}
{{--                                                                               value="{{'company_'.$litem['company_id'].'/'.Helper::convertToTitleCase($gitem['category']).'/'.$litem['directory'].'/'.$litem['file']}}">--}}
{{--                                                                        {{$litem['title']}}--}}
{{--                                                                    </div>--}}
{{--                                                                    <div--}}
                                                                        class="update-date-data td col-3 col-md-3 col-lg-4">{{\Carbon\Carbon::parse($litem['updated_at'])->timezone('Asia/Singapore')->format('d M Y H:i')}}</div>
                                                                    <div
                                                                        class="action-data td col-2 col-md-2 col-lg-1">
                                                                        <button type="submit"
                                                                                class="btn download-btn list-{{$litem['id']}} {{$litem['file'] == null ? 'disabled' : ''}}"
                                                                                id="{{$litem['id']}}"
                                                                                onclick="downloadIndividual(this,{{$litem['id']}})" {{$litem['file'] == null ? 'disabled' : ''}}>
                                                                            Download
                                                                        </button>
                                                                        {{--                                                                                                                                                            <a href="#" class="btn download-btn" type="submit" id="{{$item['document_id']}}" onclick="individualDownload(this)">{{item['downloaded_at'] != null ? 'Downloaded' : 'Download'}}</a>--}}
                                                                    </div>
                                                                </div>
                                                                {{--                                                                    @endif--}}

                                                                <!-- Main row end -->
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                                {{--                                                    <!-- End List View -->--}}
                                            </div>
                                        </div>
                                        {{--                                            @endforeach--}}

                                    </div>
                                    <!-- Tabs content -->
                                </div>
                            </div>
                        </div>
                        <!-- End of the Main Accordion -->
                    @endforeach
                </div>
                <!-- End of Yearly Basis Document Portion -->
            </div>
            <!-- Main Body End -->
            <button type="submit" id="bulkDownload" hidden></button>
        </form>
    </div>
@endsection
@push('customScripts')
    <script>
        $(document).ready(function () {
            // if ($('#documentAccordion').children('div').length > 0) {
            //     let documentHeader = $('#documentAccordion').children('div').children('h2').attr('id')
            //     console.log($('#documentAccordion').children('div'))
            //     $('#documentAccordion').children('div').children('h2').children().attr('aria-expanded', true)
            //     $('#documentAccordion').children('div').children('h2').children().removeClass('collapsed')
            //     // console.log()
            //     let year = documentHeader.split('-')[1]
            //     $('#documentBody' + year).addClass('show')
            // }

            // let search = $("input[name=search]").val()
            // if (search.length != 0) {
            //     if ($('#documentAccordion').children('div').length > 0) {
            //         let documentHeader = $('#documentAccordion').children('div').children('h2').attr('id')
            //         $('#documentAccordion').children('div').children('h2').children().attr('aria-expanded', true)
            //         $('#documentAccordion').children('div').children('h2').children().removeClass('collapsed')
            //         let year = documentHeader.split('-')[1]
            //         $('#documentBody' + year).addClass('show')
            //     }
            // }

            $(".select2").select2();
            $(".select2").select2({
                allowClear: true
            });
            let serviceId = $('#serviceId').val()
            console.log(serviceId)
            if (serviceId == 1) {
                $('#page-header').text('Corporate Secretary')
            } else if (serviceId == 2) {
                $('#page-header').text('Tax')
            } else if (serviceId == 3) {
                $('#page-header').text('Accounting')
            } else if (serviceId == 4) {
                $('#page-header').text('Human Resource')
            }


        });

        $(document).on("change", ".grid-input", function () {
            let selectedDocumentId = $(this).parent().parent().children('.text-btn-portion').children().children()[2].getAttribute('id')
            if ($(this).is(':checked')) {
                $('#' + selectedDocumentId).attr('disabled', true)
            } else {
                $('#' + selectedDocumentId).attr('disabled', false)
            }
            if ($('#' + selectedDocumentId).hasClass('disabled')) {
                $('#' + selectedDocumentId).attr('disabled', false)
            }

            $(this).parent().parent()[this.checked ? "addClass" : "removeClass"]("checkedCard");
            $(this).parent().parent().children('.text-btn-portion')[this.checked ? "addClass" : "removeClass"]("checked");
        });
        $('#list').click(function (e) {
            // const gridview = document.querySelectorAll(".grid-view");
            if ($(".list-view").hasClass("d-none") == true) {
                $(".list-view").removeClass("d-none")
                $(".grid-view").addClass("d-none")
            }
            if ($(".list-btn").hasClass("active") == false) {
                $(".list-btn").addClass("active");
                $(".grid-btn").removeClass("active");
            }
        });
        $('#grid').click(function (e) {
            if ($(".grid-view").hasClass("d-none") == true) {
                $(".grid-view").removeClass("d-none")
                $(".list-view").addClass("d-none")
            }
            if ($(".grid-btn").hasClass("active") == false) {
                $(".grid-btn").addClass("active");
                $(".list-btn").removeClass("active");
            }
        });

        $('#topDownloadBtn').on('click', function () {
            var numberOfChecked = $('input:checkbox:checked').length;
            if (numberOfChecked > 0) {
                $('#download-btn-error-text').text(' ')
                let action = "{{route('download.document')}}"
                $("#customer-doc-form").attr('action', action)
                $('#bulkDownload').click()
            } else {
                $('#download-btn-error-text').text('* Please select at least one document to download')
            }
        })

        function individualDownload(e) {
            // let docId=[]
            {{--let url = '{{route('download.individual.document', ':document_id')}}'--}}
            {{--let url = '{{route('download.document')}}'--}}
            let url = '{{route('download.local.document', ':document_id')}}'
            url = url.replace(':document_id', e.id)
            // docId.push(e.id)
            // $('#documentId').attr('value', e.id)

            $("#customer-doc-form").attr('action', url)
            // $.ajax({
            //     url: url,
            //     success: function(res) {
            //
            //     }
            // });

            console.log(url)
        }

        // $('.search-btn').on('click', function () {
        //     let search = $("input[name=search]").val()
        //     console.log(search)
        // })

        var $checkboxes = $('.tab-pane .document-checkbox');
        $checkboxes.on('click', function () {
            let selectedDocumentIdList = $(this).parent().parent().children('.action-data').children()[0].getAttribute('id')
            console.log('.list-' + selectedDocumentIdList)
            if ($(this).is(':checked')) {
                $('.list-' + selectedDocumentIdList).attr('disabled', true)
            } else {
                $('.list-' + selectedDocumentIdList).attr('disabled', false)
            }

        })

        function checkbox() {

            var countCheckedCheckboxes = $checkboxes.filter(':checked').length;
            if (countCheckedCheckboxes > 0) {
                $('.select-all-link').text('Deselect All');
            } else {
                $('.select-all-link').text('Select All');
            }
        }

        function selectAll() {
            $checkboxes.prop('checked', true);
            checkbox();
        }

        function deselectAll() {
            $checkboxes.prop('checked', false);
            checkbox();
        }

        $('.select-all-link').click(function (e) {
            e.preventDefault();
            var countCheckedCheckboxes = $checkboxes.filter(':checked').length;
            if (countCheckedCheckboxes == $checkboxes.length) {
                deselectAll();
            } else {
                selectAll();
            }
            checkbox();
        });

        //mailbox doc download
        function downloadIndividual(el, id) {
            var url = "{{ route('mail.individual.download', ':id') }}";
            url = url.replace(':id', id);
            $("#customer-doc-form").attr('action', url);

        }
    </script>
@endpush
