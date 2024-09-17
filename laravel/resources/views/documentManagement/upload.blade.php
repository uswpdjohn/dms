@extends('layouts.master')
@section('content')
    <div class="main-body">
        @if(session('success'))
            <div class="alert alert-success">
                <img class="alert-img" src="{{asset('assets/icons/success-alert-icon.png')}}" alt="">
                <p class="alert-text">{{session('success')}}</p>
            </div>
        @endif
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                    <p class="alert-text">{{session('error')}}</p>
            @endforeach
        @endif

        <div class="row admin-mailbox-body g-0">
            <div class="col-4 col-md-2 card admin-mailbox-button-card">
                <div class="card-body admin-mailbox-button-body">
                    <div class="tab-buttons">
                        <button class="tablinks adminMailboxTabLinks" onclick="adminMailBoxTab(event, 'create-mail')" id="defaultOpen">Create Mail</button>
                        <button class="tablinks adminMailboxTabLinks" onclick="adminMailBoxTab(event, 'outbox')" id="outbox">Outbox</button>
                    </div>
                </div>
            </div>
            <div class="col-8 col-md-10">
                <div class="card admin-mailbox-card">
{{--                <div class="card tabcontent adminMailboxTabContent outbox admin-mailbox-outbox-upper-part">--}}
{{--                    <div class="card-body d-flex">--}}
{{--                        <button class="btn switch-btn" type="button" id="switch-btn">Switch View</button>--}}
{{--                        <span class="view-name" id="view-name">Admin View</span>--}}
{{--                        <fieldset class="form-group input-group company-list">--}}
{{--                            <select class="form-control form-select nav-select" id="company_id" onchange="getMail()">--}}
{{--                                <option hidden class="first-option" value="">All Companies</option>--}}
{{--                                @foreach($company as $item)--}}
{{--                                    <option class=""  value="{{$item->id}}">{{$item->name}}</option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                        </fieldset>--}}
{{--                    </div>--}}
{{--                </div>--}}
                    <div class="card-body admin-mailbox-content-body">
                        <div id="create-mail" class="tabcontent adminMailboxTabContent create-mail">
                            <form action="{{route('upload.document')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row ">
{{--                                    <div class="col-sm-12 col-md-6">--}}
{{--                                        <div class="form-group">--}}
{{--                                            <label for="from"  class="mb-2 mt-3"><span class="required-sign">*</span>From</label>--}}
{{--                                            <input type="text" class="form-control" name="from" id="from">--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-sm-12 col-md-6">--}}
{{--                                        <div class="form-group">--}}
{{--                                            <label for="title"  class="mb-2 mt-3">Title</label>--}}
{{--                                            <input type="text" class="form-control" name="title" id="title">--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-sm-12 col-md-6">--}}
{{--                                        <fieldset class="form-group">--}}
{{--                                            <label for="company_id"  class="mb-2 mt-3"><span class="required-sign">*</span>Company</label>--}}
{{--                                            <select class="form-control select form-select" name="company_id" id="companyId" required>--}}
{{--                                                <option hidden class="first-option" value=""></option>--}}
{{--                                                @foreach($company as $item)--}}
{{--                                                    <option class=""  value="{{$item->id}}">{{$item->name}}</option>--}}
{{--                                                @endforeach--}}
{{--                                            </select>--}}
{{--                                        </fieldset>--}}
{{--                                    </div>--}}
{{--                                    <br>--}}
{{--                                    <div class="col-sm-12 col-md-6">--}}
{{--                                        <fieldset class="form-group">--}}
{{--                                            <label for="category"  class="mb-2 mt-3"><span class="required-sign">*</span>Category</label>--}}
{{--                                            <select class="form-control form-select nav-select select-data" name="category" required>--}}
{{--                                                <option hidden class="first-option" value="">Select</option>--}}
{{--                                                <option value="all">All</option>--}}
{{--                                                <option value="mailbox" selected>Mailbox</option>--}}
{{--                                                <option value="corporate_secretary">Corporate Secretary</option>--}}
{{--                                                <option value="gst_report">GST Report</option>--}}
{{--                                                <option value="accounting">Accounting</option>--}}
{{--                                                <option value="human_resource">Human Resource</option>--}}
{{--                                            </select>--}}
{{--                                        </fieldset>--}}
{{--                                    </div>--}}
                                    <div class="col-sm-12 col-md-6 mt-4">
                                        <input type="file" class="form-control upload-file"  name="file" id="file">
{{--                                        <p class="required-msg mt-2">For multiple files, it is required to zip the files.</p>--}}
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="title"  class="mb-2 mt-3">Title</label>
                                            <input type="text" class="form-control" name="name" id="name">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <fieldset class="form-group">
                                            <label for="company_id"  class="mb-2 mt-3"><span class="required-sign">*</span>Company</label>
                                            <select class="form-control select form-select" name="company_id" id="companyId" required>
                                                <option hidden class="first-option" value=""></option>
                                                @foreach($companies as $item)
                                                    <option class=""  value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                        </fieldset>
                                    </div>
                                    <input type="text" name="service_id" value="1">
                                    <input type="text" name="invite_emails[]" id="invite_emails" value="">
{{--                                    <div class="col-sm-12 col-md-6 mt-4">--}}
{{--                                        <input type="checkbox" class="urgent-checkbox mt-2 me-1" value="urgent" name="priority" >--}}
{{--                                        <span class="mt-2">Urgent Attention Needed</span>--}}
{{--                                    </div>--}}

                                    <div class="col-sm-12 col-md-6 mt-2">
                                        <button type="submit" class="btn admin-mail-create-submit-btn" hidden>Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
{{--                        director--}}
                            <div id="directors"></div>
                            <div id="shareholders"></div>
{{--                        <div class="admin-company-management-view-right-card-portion col-12 col-lg-6">--}}
{{--                            <div class="card">--}}
{{--                                <div class="card-body">--}}
{{--                                    <h6 class="director-header">Directors</h6>--}}
{{--                                    @forelse ($response->directors as $user)--}}
{{--                                        <div class="directors">--}}
{{--                                            <p>{{$user->full_name.' ('. $user->email.')'}}</p>--}}
{{--                                            @foreach($user->ccs as $cc)--}}
{{--                                                <p>cc: {{$cc}}</p>--}}
{{--                                            @endforeach--}}
{{--                                        </div>--}}
{{--                                    @empty--}}
{{--                                        <div class="directors col-9 col-md-7">--}}
{{--                                            <p>No Director Found</p>--}}
{{--                                        </div>--}}
{{--                                    @endforelse--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                        <div id="outbox" class="tabcontent adminMailboxTabContent outbox">--}}
{{--                            <div class="admin-view" id="admin-view">--}}
{{--                                <div class="select-pagination-portion table-top-portion row g-0">--}}
{{--                                    <div class="select-part col-4 col-md-3 col-lg-2">--}}
{{--                                        <input type="checkbox" class="select-all-checkbox">--}}
{{--                                        <label for="" class="selected-checkbox-number">Select All</label>--}}
{{--                                    </div>--}}
{{--                                    <div class="sb-part search-box-part col-8 col-md-4 offset-lg-1 col-lg-5">--}}
{{--                                        <div class="d-flex form-inputs search-data">--}}
{{--                                            <input class="form-control admin-search-field" name="search" type="text" placeholder="Search Mail/Company">--}}
{{--                                            <button class="search-btn btn" onclick="searchMail()"><i class="fa-solid fa-search"></i></button>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="sb-part priority-category-select col-6 offset-md-0 col-md-2 col-lg-2">--}}
{{--                                        <select class="form-control form-select nav-select select-data" onchange="filterByPriority()" name="priority" id="priority">--}}
{{--                                            <option value="all">All</option>--}}
{{--                                            <option value="urgent">Urgent</option>--}}
{{--                                            <option value="new">New</option>--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                    <div class="sb-part category-select col-6 col-md-3 col-lg-2">--}}
{{--                                        <select class="form-control form-select nav-select select-data" onchange="filterByCategory()" name="category" id="category">--}}
{{--                                            <option value="all">All</option>--}}
{{--                                            <option value="mailbox">Mailbox</option>--}}
{{--                                            <option value="corporate_secretary">Corporate Secretary</option>--}}
{{--                                            <option value="gst_report">GST Report</option>--}}
{{--                                            <option value="accounting">Accounting</option>--}}
{{--                                            <option value="human_resource">Human Resource</option>--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                    <div class="button-part col-4 col-md-5 col-lg-7">--}}
{{--                                        <button type="button" id="downloadAttachmentCloneBtn" class="btn download-btn action-buttons active">Download</button>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <!--FROM START-->--}}
{{--                                <form action="" method="GET" id="form-1">--}}
{{--                                    <div class="mailbox-body" id="admin">--}}
{{--                                        @foreach($mails as $mail)--}}
{{--                                        <div class="mails row g-0">--}}
{{--                                            <div class="col-4 col-md-3 checkbox-div">--}}
{{--                                                <input type="checkbox" class="select-checkbox" value="{{$mail->id}}" name="mail-id[]">--}}
{{--                                                @if($mail->priority == 'urgent')--}}
{{--                                                    <img src="{{asset('assets/icons/mailbody-!.png')}}" alt="">--}}
{{--                                                @else--}}
{{--                                                    <img src="{{asset('assets/icons/mailbody-!-white.png')}}" alt="">--}}
{{--                                                @endif--}}
{{--                                                @if($mail->read_at != null)--}}
{{--                                                    <span class="">{{$mail->companies->name}}</span>--}}
{{--                                                @else--}}
{{--                                                    <span class=" fw-bold">{{$mail->companies->name}}</span>--}}
{{--                                                @endif--}}
{{--                                            </div>--}}
{{--                                            <div class="col-5 col-md-6 message-div">--}}
{{--                                                @if($mail->read_at != null)--}}
{{--                                                    <p class="" >{{$mail->title}}</p>--}}
{{--                                                @else--}}
{{--                                                    <p class="text-dark fw-bold" >{{$mail->title}}</p>--}}
{{--                                                @endif--}}
{{--                                            </div>--}}
{{--                                            <div class="col-3 col-md-3 time-div">--}}
{{--                                                @if($mail->read_at != null)--}}
{{--                                                    <span>{{ \Carbon\Carbon::parse($mail->created_at)->format('d M y')}}</span>--}}
{{--                                                @else--}}
{{--                                                    <span class="text-dark fw-bold">{{ \Carbon\Carbon::parse($mail->created_at)->format('d M y')}}</span>--}}
{{--                                                @endif--}}
{{--                                                @if($mail->file != null)--}}
{{--                                                    @if($mail->downloaded_at != null)--}}
{{--                                                        <button type="submit" onclick="downloadIndividual(this,{{$mail->id}})" class="btn download-btn {{$mail->downloaded_at != null ? '' : 'active'}}">{{$mail->downloaded_at != null ? 'Downloaded' : 'Download'}}</button>--}}
{{--                                                    @else--}}

{{--                                                        <button type="submit" onclick="downloadIndividual({{$mail->id}})" class="btn download-btn active">Download</button>--}}
{{--                                                    @endif--}}
{{--                                                @endif--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        @endforeach--}}
{{--                                    </div>--}}

{{--                                    <div class="select-pagination-portion table-bottom-portion row g-0">--}}
{{--                                        <div class="select-part col-4 col-md-3 col-lg-2">--}}
{{--                                            <input type="checkbox" class="select-all-checkbox">--}}
{{--                                            <label for="" class="selected-checkbox-number">Select All</label>--}}
{{--                                        </div>--}}
{{--                                        <div class="search-box-part sb-part col-4 col-md-4 offset-lg-1 col-lg-5">--}}
{{--                                            <div class="d-flex form-inputs search-data">--}}
{{--                                                <input class="form-control admin-search-field" name="search" type="text" placeholder="Search Mail/Company">--}}
{{--                                                <button type="button" class="search-btn btn" onclick="searchMail()"><i class="fa-solid fa-search"></i></button>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="button-part col-8 col-md-4 col-lg-5">--}}
{{--                                            <button type="submit" onclick="downloadAttachment()" id="downloadAttachmentBtn" class="btn download-btn action-buttons active">Download</button>--}}
{{--                                        </div>--}}
{{--                                        <!--FORM END-->--}}
{{--                                        <!--PAGINATION-->--}}
{{--                                        @if($mails->hasPages())--}}
{{--                                            <input type="text" id="last_page" value="{{$mails->hasPages()}}" hidden="hidden">--}}
{{--                                            <div class="pagination-part col-4 col-md-4 col-lg-2">--}}
{{--                                                <a data-href="{{$mails->previousPageUrl()}}" class="btn d-none left-arrow"><i class="fa-solid fa-chevron-left"></i></a>--}}
{{--                                                <span class="pagination-number pagination-left-number">{{$mails->currentPage()}}</span>--}}
{{--                                                <span class="pagination-divider">/</span>--}}
{{--                                                <span class="pagination-number pagination-right-number">{{$mails->lastPage()}}</span>--}}
{{--                                                <a data-href="{{$mails->nextPageUrl()}}" class="btn right-arrow"><i class="fa-solid fa-chevron-right"></i></a>--}}
{{--                                            </div>--}}
{{--                                        @endif--}}
{{--                                    </div>--}}
{{--                                </form>--}}
{{--                            </div>--}}

{{--                            <div class="company-view d-none" id="company-view">--}}
{{--                                <div class="select-pagination-portion top-select-pagination-portion row g-0">--}}
{{--                                    <div class="select-part col-4 col-md-3 col-lg-3">--}}
{{--                                        <input type="checkbox" class="select-all-checkbox">--}}
{{--                                        <label for="" class="selected-checkbox-number">Select All</label>--}}
{{--                                    </div>--}}
{{--                                    <div class="search-select-box-part sb-part col-4 col-md-5 col-lg-7">--}}
{{--                                        <div  class="d-flex">--}}
{{--                                            <div class="d-flex form-inputs search-data">--}}
{{--                                                <input class="form-control company-search-field" name="search" type="text" placeholder="Search Mail/Company">--}}
{{--                                                <button class="search-btn btn" onclick="searchMail()"><i class="fa-solid fa-search"></i></button>--}}
{{--                                            </div>--}}
{{--                                            <select class="form-control form-select nav-select select-data priority" name="priority" id="priority-up">--}}
{{--                                                <option hidden class="first-option" value="">Filter</option>--}}
{{--                                                <option value="all">All</option>--}}
{{--                                                <option value="urgent">Urgent</option>--}}
{{--                                                <option value="new">New</option>--}}
{{--                                            </select>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="button-part col-4 col-md-5 col-lg-7">--}}
{{--                                        <button type="button" id="downloadAttachmentCloneBtn-2" class="btn download-btn action-buttons active">Download</button>--}}
{{--                                    </div>--}}
{{--                                    <!--PAGINATION-->--}}
{{--                                    @if($mails->hasPages())--}}
{{--                                        <div class="pagination-part col-4 col-md-4 col-lg-2">--}}
{{--                                            <a data-href="{{$mails->previousPageUrl()}}" class="btn d-none left-arrow"><i class="fa-solid fa-chevron-left"></i></a>--}}
{{--                                            <span class="pagination-number pagination-left-number">{{$mails->currentPage()}}</span>--}}
{{--                                            <span class="pagination-divider">/</span>--}}
{{--                                            <span class="pagination-number pagination-right-number">{{$mails->lastPage()}}</span>--}}
{{--                                            <a data-href="{{$mails->nextPageUrl()}}" class="btn right-arrow"><i class="fa-solid fa-chevron-right"></i></a>--}}

{{--                                        </div>--}}
{{--                                    @endif--}}
{{--                                </div>--}}
{{--                                <!--FROM START-->--}}
{{--                                <form action="" method="GET" id="form-2" >--}}
{{--                                    <div class="mailbox-body" id="company">--}}
{{--                                        @foreach($mails as $mail)--}}
{{--                                            <div class="mails row g-0">--}}
{{--                                                <div class="col-4 col-md-3 checkbox-div">--}}
{{--                                                    <input type="checkbox" class="select-checkbox" value="{{$mail->id}}" name="mail-id[]">--}}
{{--                                                    <img src="{{asset('assets/icons/mailbody-!-white.png')}}" alt="">--}}
{{--                                                    <span>{{$mail->from}}</span>--}}
{{--                                                </div>--}}
{{--                                                <div class="col-5 col-md-6 message-div">--}}
{{--                                                    <p class=""  style="color:#000000; font-weight: 400;">{{$mail->title}}</p>--}}
{{--                                                </div>--}}
{{--                                                <div class="col-3 col-md-3 time-div">--}}
{{--                                                    <span  style="color:#000000; font-weight: 400;">{{ \Carbon\Carbon::parse($mail->created_at)->format('d M y')}}</span>--}}
{{--                                                    @if($mail->file != null)--}}
{{--                                                        <button type="submit" onclick="downloadIndividualFromCompanyView({{$mail->id}})" class="btn download-btn active">Download</button>--}}
{{--                                                    @endif--}}
{{--                                                </div>--}}
{{--                                                <div class="col-sm-12 col-md-6 mt-2">--}}
{{--                                                    <button type="submit" onclick="downloadAttachmentFromCompanyView()" class="btn download-bulk-mail-submit-btn" hidden>Submit</button>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        @endforeach--}}
{{--                                    </div>--}}
{{--                                    <div class="col-sm-12 col-md-6 mt-2">--}}
{{--                                        <button type="submit" onclick="downloadAttachmentFromCompanyView()" class="btn download-bulk-mail-submit-btn" hidden>Submit</button>--}}
{{--                                    </div>--}}
{{--                                </form>--}}

{{--                                <div class="select-pagination-portion top-select-pagination-portion row g-0">--}}
{{--                                    <div class="select-part col-4 col-md-3 col-lg-3">--}}
{{--                                        <input type="checkbox" class="select-all-checkbox">--}}
{{--                                        <label for="" class="selected-checkbox-number">Select All</label>--}}
{{--                                    </div>--}}
{{--                                    <div class="search-select-box-part sb-part col-4 col-md-5 col-lg-7">--}}
{{--                                        <div class="d-flex">--}}
{{--                                            <div class="d-flex form-inputs search-data">--}}
{{--                                                <input class="form-control search-field" name="search" type="text" placeholder="Search Mail/Company">--}}
{{--                                                <button type="submit" onclick="searchMail()" class="search-btn btn"><i class="fa-solid fa-search"></i></button>--}}
{{--                                            </div>--}}
{{--                                            <select class="form-control form-select nav-select select-data priority" name="priority" id="priority-down">--}}
{{--                                                <option hidden class="first-option" value="">Filter</option>--}}
{{--                                                <option value="all">All</option>--}}
{{--                                                <option value="urgent">Urgent</option>--}}
{{--                                                <option value="new">New</option>--}}
{{--                                            </select>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="button-part col-4 col-md-5 col-lg-7">--}}
{{--                                        <button type="button" id="downloadAttachmentBtn2" class="btn download-btn action-buttons download-bulk-mail-send-btn active">Download</button>--}}
{{--                                        <button type="button" class="btn archive-btn action-buttons">Archive</button>--}}
{{--                                    </div>--}}
{{--                                    <!--FORM END-->--}}
{{--                                    <!--PAGINATION-->--}}
{{--                                    @if($mails->hasPages())--}}
{{--                                        <div class="pagination-part col-4 col-md-4 col-lg-2">--}}
{{--                                            <a data-href="{{$mails->previousPageUrl()}}" class="btn d-none left-arrow"><i class="fa-solid fa-chevron-left"></i></a>--}}
{{--                                            <span class="pagination-number pagination-left-number">{{$mails->currentPage()}}</span>--}}
{{--                                            <span class="pagination-divider">/</span>--}}
{{--                                            <span class="pagination-number pagination-right-number">{{$mails->lastPage()}}</span>--}}
{{--                                            <a data-href="{{$mails->nextPageUrl()}}" class="btn right-arrow"><i class="fa-solid fa-chevron-right"></i></a>--}}

{{--                                        </div>--}}
{{--                                    @endif--}}
{{--                                </div>--}}
{{--                                </form>--}}
{{--                            </div>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="admin-mail-create-btn-area tabcontent adminMailboxTabContent create-mail">
            <button type="button" class="btn admin-mail-create-send-btn mt-3">Send</button>
        </div>
    </div>
@endsection
@push('customScripts')

    <script>
        let inviteEmailIds=[]
        $('.admin-mail-create-send-btn').click(function(){
            $("#invite_emails").attr('value',inviteEmailIds)
            $('.admin-mail-create-submit-btn').click();
        })




        $('#companyId').on('change', function (d) {
            // console.log(d.target.value)
            let company_id = d.target.value;
            console.log(d.target.value)

                fetch(`fetchSigners/${company_id}`)
                    // console.log(response)
                    .then(res => res.json())
                    .then(res => {
                        $.each(res.shareholders, function(key,value) {
                            inviteEmailIds.push(value.id)
                        });
                        $.each(res.directors, function(key,value) {
                            inviteEmailIds.push(value.id)
                        });


                        (res.shareholders.length != 0 ?  $("#shareholders").html(res.shareholders.map((item) => domloadShareholders(item) ).join(' ')) :  $("#shareholders").html(` <div class="directors col-9 col-md-7"><p>No Shareholder Found</p></div></div></div>`))
                        (res.directors.length != 0 ?  $("#directors").html(res.directors.map((item) => domloadDirectors(item) ).join(' ')) :  $("#directors").html(` <div class="directors col-9 col-md-7"><p>No Director Found</p></div></div></div>`))

                    })
                    .catch(err => {
                        console.log(err)
                    })
            // $('#invite_emails').attr('value', inviteEmailIds)
        })

        function domloadShareholders(item){
            console.log(item)
            return `<div class="admin-company-management-view-right-card-portion col-12 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="director-header">Shareholders</h6>
            <div class="directors">
    <p>${item.first_name+' '+item.last_name +'('+ item.email+')'}</p>` + (item.ccs.length != 0 ? item.ccs.map((cc)=> loadCC(cc)).join(' ') : '') + `</div> <button type="button" onclick="remove(this)" id="${item.id}" name="company_user" class="btn p-0 ps-3 ms-auto cancel-btn">x</button>`

        }

        function domloadDirectors(item){
            console.log(item)
            return `<div class="admin-company-management-view-right-card-portion col-12 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="director-header">Directors</h6>
            <div class="directors">
    <p>${item.first_name+' '+item.last_name +'('+ item.email+')'}</p>` + (item.ccs.length != 0 ? item.ccs.map((cc)=> loadCC(cc)).join(' ') : '') + `</div><button type="button" onclick="remove(this)" id="${item.id}" name="company_user" class="btn p-0 ps-3 ms-auto cancel-btn">x</button>`

        }



        function loadCC(cc){
            return `<p>cc: ${cc}</p>`

        }
        function remove(e){
            let removedItem=e.id
            var result = inviteEmailIds.filter(function(elem){
                return elem != removedItem;
            });//result -> [1,2,3,4]
            inviteEmailIds.length = 0;                  // Clear contents
            inviteEmailIds.push.apply(inviteEmailIds, result);  // Append new contents
            console.log(result)

        }

    </script>
@endpush
