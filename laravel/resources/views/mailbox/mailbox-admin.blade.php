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
        <div id="ajax-alert"></div>

        <div class="row admin-mailbox-body g-0">
            <div class="col-12 col-md-2 card admin-mailbox-button-card">
                <div class="card-body admin-mailbox-button-body">
                    <div class="tab-buttons">
                        <button class="tablinks adminMailboxTabLinks {{auth()->guard('web')->user()->can('create.mailbox') ? '' : 'd-none'}}" onclick="adminMailBoxTab(event, 'create-mail')" id="defaultOpen">Create Mail</button>
                        <button class="tablinks adminMailboxTabLinks" onclick="adminMailBoxTab(event, 'outbox')" id="outbox">Outbox</button>
                        <!-- New Fix -->
                        <button class="tablinks adminMailboxTabLinks" onclick="adminMailBoxTab(event, 'folder')">Folder</button>
                        <!-- New Fix -->
                    </div>
                    <!-- New Fix -->
                    <div class="company-search" id="company-search-portion">
                        <p class="mt-3">Company</p>
                        <select class="form-control form-select select-data " name="company" id="select_company">
                            <option hidden class="first-option" value="">Please select a company</option>
                            @foreach($company as $item)
                                <option class=""  value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                        <button id="get_directories" type="button" class="btn search-btn">Search <span id="searchLoadingDiv" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></button>
                    </div>
                    <!-- New Fix -->
                </div>
            </div>
            <div class="col-12 col-md-10">
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
                            <form action="{{route('mail.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @honeypot
                                <div class="row ">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="from"  class="mb-2 mt-3"><span class="required-sign">*</span>From</label>
                                            <input type="text" class="form-control" name="from" id="from" value="{{old('from')}}">
                                        </div>
                                        @error('from')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="title"  class="mb-2 mt-3"><span class="required-sign">*</span>Title</label>
                                            <input type="text" class="form-control" name="title" id="title" value="{{old('title')}}">
                                        </div>
                                        @error('title')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <fieldset class="form-group">
                                            <label for="company_id"  class="mb-2 mt-3"><span class="required-sign">*</span>Company</label>
                                            <select class="form-control select form-select" name="company_id" id="companyId">
                                                <option hidden class="first-option" value="">Select Company</option>
                                                @foreach($company as $item)
                                                    <option class=""  value="{{$item->id}}" {{$item->id == old('company_id') ? 'selected' : ''}}>{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                        </fieldset>
                                        @error('company_id')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <br>
                                    <div class="col-sm-12 col-md-6">
                                        <fieldset class="form-group">
                                            <label for="category"  class="mb-2 mt-3"><span class="required-sign">*</span>Category <span class="required-msg">(please select company first)</span></label>
                                            <select class="form-control form-select nav-select select-data" name="category" id="mail_category" disabled>
                                                <option hidden class="first-option" value="">Select Category</option>
                                                <option value="mailbox">Mailbox</option>
                                                <option value="corporate_secretary">Corporate Secretary</option>
                                                <option value="tax">Tax</option>
                                                <option value="accounting">Accounting</option>
                                                <option value="human_resource">Human Resource</option>
                                            </select>
                                        </fieldset>
                                        @error('category')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <label for="title"  class="mb-2 mt-3"><span class="required-sign">*</span>File</label>
                                        <input type="file" class="form-control upload-file"  name="file" id="file">
                                        <p class="required-msg mt-2">For multiple files, it is required to zip the files.</p>
                                        @error('file')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>

                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="title"  class="mb-2 mt-3"><span class="required-sign">*</span>Folder Name <span class="required-msg">(please select category first)</span></label>
                                            <input type="text" class="form-control" name="directory" id="path" value="" disabled>
                                            <div class="append d-none"></div>
                                            @error('directory')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                            <p class="required-msg mt-2">Start typing with folder name. </p>
                                        </div>

                                    </div>
                                    <div class="col-sm-12 col-md-6 mt-4">
                                        <input type="checkbox" class="urgent-checkbox mt-2 me-1" value="urgent" name="priority" >
                                        <span class="mt-2">Urgent Attention Needed</span>
                                    </div>
                                    <div class="col-sm-12 col-md-6 mt-2">
                                        <button type="submit" class="btn admin-mail-create-submit-btn" hidden>Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div id="outbox" class="tabcontent adminMailboxTabContent outbox">
                            <div class="admin-view" id="admin-view">
                                <div class="select-pagination-portion table-top-portion row g-0">
                                    <div class="select-part col-6 col-md-3 col-lg-2">
                                        <input type="checkbox" class="select-all-checkbox">
                                        <label for="" class="selected-checkbox-number">Select All</label>
                                    </div>
                                    <div class="sb-part search-box-part col-6 col-md-4 offset-lg-1 col-lg-5">
                                        <div class="d-flex form-inputs search-data">
                                            <input class="form-control admin-search-field up-search" name="search" type="text" placeholder="Search Mail/Company">
                                            <button class="search-btn btn" onclick="searchMail()"><i class="fa-solid fa-search"></i></button>
                                        </div>
                                    </div>
                                    <div class="sb-part priority-category-select col-6 offset-md-0 col-md-2 col-lg-2">
                                        <select class="form-control form-select nav-select select-data" onchange="filterByPriority()" name="priority" id="priority">
{{--                                            <option disabled class="first-option" value="">Select Priority</option>--}}
                                            <option value="all">All</option>
                                            <option value="urgent">Urgent</option>
                                            <option value="new">New</option>
                                        </select>
                                    </div>
                                    <div class="sb-part category-select col-6 col-md-3 col-lg-2">
                                        <select class="form-control form-select nav-select select-data" onchange="filterByCategory()" name="category" id="category">
{{--                                            <option disabled class="first-option" value="">Select Category</option>--}}
                                            <option value="all">All</option>
                                            <option value="mailbox">Mailbox</option>
                                            <option value="corporate_secretary">Corporate Secretary</option>
                                            <option value="tax">Tax</option>
                                            <option value="accounting">Accounting</option>
                                            <option value="human_resource">Human Resource</option>
                                        </select>
                                    </div>
                                    <div class="button-part col-8 col-md-9 col-lg-10">
                                        <button type="button" id="downloadAttachmentCloneBtn" class="btn download-btn action-buttons active">Download</button>
                                        <button type="button" class="btn outbox-delete-btn action-buttons" data-bs-toggle="modal" data-bs-target="#mailboxDeleteModal">Delete</button>
                                    </div>
                                </div>
                                <!--FROM START-->
                                <form action="" method="GET" id="form-1">
                                    <div class="table-responsive">
                                        <div class="mailbox-body" id="admin">
                                            @if(count($mails) > 0 )
                                                @foreach($mails as $mail)
                                                    <div class="mails row g-0">
                                                        <div class="col-4 col-md-3 checkbox-div">
                                                            <input type="checkbox" class="select-checkbox" value="{{$mail->id}}" name="mail-id[]">
                                                            @if($mail->priority == 'urgent')
                                                                <img src="{{asset('assets/icons/mailbody-!.png')}}" alt="">
                                                            @else
                                                                <img src="{{asset('assets/icons/mailbody-!-white.png')}}" alt="">
                                                            @endif
                                                            @if($mail->read_at != null)
                                                                <span class="">{{$mail->companies->name}}</span>
                                                            @else
                                                                <span class=" fw-bold">{{$mail->companies->name}}</span>
                                                            @endif
                                                        </div>
                                                        <div class="col-4 col-md-5 message-div">
                                                            @if($mail->read_at != null)
                                                                <p class="" >{{$mail->title}}</p>
                                                            @else
                                                                <p class="text-dark fw-bold" >{{$mail->title}}</p>
                                                            @endif
                                                        </div>
                                                        <div class="col-2 col-md-2 folder-div">
                                                            <p class="fw-bold text-black">{{$mail->directory}}</p>
                                                        </div>
                                                        <div class="col-2 col-md-2 time-div">
                                                            @if($mail->read_at != null)
                                                                <span>{{ \Carbon\Carbon::parse($mail->created_at)->format('d M y')}}</span>
                                                            @else
                                                                <span class="text-dark fw-bold">{{ \Carbon\Carbon::parse($mail->created_at)->format('d M y')}}</span>
                                                            @endif
                                                            @if($mail->file != null)
                                                                <button type="submit" onclick="downloadIndividual(this,{{$mail->id}})" class="btn download-btn {{$mail->downloaded_at != null ? '' : 'active'}}"  ><i class="fa-solid fa-download"></i></button>
                                                            @endif
                                                            <button type="button" class="btn delete-btn" data-bs-toggle="modal" data-bs-target="#deleteModal-{{$mail->id}}"  ><i class="fa-solid fa-trash-can"></i></button>
                                                                <!-- Mailbox Individual Delete Modal Start -->
                                                                <div class="modal fade" id="deleteModal-{{$mail->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="mailboxDeleteModal" aria-hidden="true">
                                                                    <div class="modal-dialog delete-modal">
                                                                        <div class="modal-content">
                                                                            <div class="delete-modal-body">
                                                                                <p class="text-center">Confirm Delete</p>
                                                                                <div class="text-center">
                                                                                    <button type="button" class="btn btn-sm delete-modal-close-btn" data-bs-dismiss="modal" aria-label="No">No</button>
                                                                                    <button type="button" onclick="individualMailboxDelete(this)" data-mail="{{$mail->id}}" class="btn btn-sm yes-btn">Yes</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- Mailbox Individual Delete Modal End -->
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="mails row g-0">
                                                    <div class="col-12 col-md-12 col-lg-12 message-div text-center"><span>No Data Available</span></div>
                                                </div>
                                            @endif
                                    </div>
                                    </div>

                                    <div class="select-pagination-portion table-bottom-portion row g-0">
                                        <!-- Select All button-->
{{--                                        <div class="select-part col-6 col-md-3 col-lg-2">--}}
{{--                                            <input type="checkbox" class="select-all-checkbox">--}}
{{--                                            <label for="" class="selected-checkbox-number">Select All</label>--}}
{{--                                        </div>--}}
                                        <!-- Search-->
{{--                                        <div class="search-box-part sb-part col-6 col-md-4 offset-lg-1 col-lg-5">--}}
{{--                                            <div class="d-flex form-inputs search-data">--}}
{{--                                                <input class="form-control admin-search-field down-search" name="search" type="text" placeholder="Search Mail/Company">--}}
{{--                                                <button type="button" class="search-btn btn" onclick="searchMail()"><i class="fa-solid fa-search"></i></button>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
                                        <!-- Download-->
                                        <div class="button-part col-12 col-md-4 col-lg-5">
                                            <button hidden="hidden" type="submit" onclick="downloadAttachment()" id="downloadAttachmentBtn" class="btn download-btn action-buttons active">Download</button>
                                            <button hidden="hidden" type="submit" id="groupMailboxDelete" class="">Delete</button>
                                        </div>
                                        <!--FORM END-->
                                        <!--PAGINATION-->
{{--                                        @if($mails->hasPages())--}}
                                            <input type="text" id="last_page" value="{{$mails->hasPages()}}" hidden="hidden">
                                            <div class="pagination-part col-12 col-md-5 col-lg-4">
                                                <a data-href="{{$mails->previousPageUrl()}}" class="btn d-none left-arrow"><i class="fa-solid fa-chevron-left"></i></a>
                                                <span class="pagination-number pagination-left-number">{{$mails->currentPage()}}</span>
                                                <span class="pagination-divider">/</span>
                                                <span class="pagination-number pagination-right-number">{{$mails->lastPage()}}</span>
                                                <a data-href="{{$mails->nextPageUrl()}}" class="btn right-arrow"><i class="fa-solid fa-chevron-right"></i></a>
                                            </div>
{{--                                        @endif--}}
                                    </div>
                                </form>
                            </div>

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
                        <!-- New Fix -->

                        <div id="folder" class="tabcontent adminMailboxTabContent folder">
                            <span>Current Selection: </span><span id="current_selection" class="fw-bold">None</span>
                            <div class="table-responsive">
                                <div id="company_directories" class="folder-body"></div>
                            </div>
{{--                            <div class="select-pagination-portion table-bottom-portion row g-0">--}}
{{--                                <div class="pagination-part bottom-pagination-part col-12 col-md-5 col-lg-4">--}}
{{--                                    <a href="#" class="btn"><i class="fa-solid fa-chevron-left"></i></a>--}}
{{--                                    <span class="pagination-number pagination-left-number">5</span>--}}
{{--                                    <span class="pagination-divider">/</span>--}}
{{--                                    <span class="pagination-number pagination-right-number">10</span>--}}
{{--                                    <a href="#" class="btn"><i class="fa-solid fa-chevron-right"></i></a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                        </div>
                        <!-- New Fix -->
                        <!-- New Fix 1.2 -->
                        <!-- Folder Edit Modal Start -->
                        <div class="modal fade" id="folderEditModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="folderEditModalLabel" aria-hidden="true">
                            <div class="modal-dialog folder-edit-modal">
                                <div class="modal-content">
                                    <div class="folder-edit-modal-body">
                                        <div class="folder-edit-modal-header row">
                                            <h5 class="modal-title col-11" id="folderEditModalLabel">Edit Folder Name</h5>
                                            <button type="button" class="btn btn-close btn-sm folder-edit-modal-close-btn col-1" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="folder-edit-modal-data row">
                                            <form id="rename_folder">
                                                @csrf
                                                <div class="data-body row">
                                                    <div class="data-row col-12">
                                                        <input type="hidden" name="prev_directory"  id="prev_directory">
                                                        <input type="hidden" name="company_root_directory"  id="company_root_directory">
                                                        <input type="hidden" name="company_category_directory"  id="company_category_directory">
                                                        <label for=""><span class="required-sign">*</span>Folder Name</label>
                                                        <input type="text" class="form-control" name="directory" placeholder="Folder Name" id="directory_name">
                                                        <span class="error_directory text-danger"></span>
                                                    </div>
                                                    <div class="data-row col-12 text-end">
                                                        <button type="submit" class="update-folder-btn btn" id="update_directory_name">Update</button><span id="renameLoadingDiv" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Folder Edit Modal End -->
                        <!-- Mailbox Group Delete Modal Start -->
                        <div class="modal fade" id="mailboxDeleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="mailboxDeleteModal" aria-hidden="true">
                            <div class="modal-dialog delete-modal">
                                <div class="modal-content">
                                    <div class="delete-modal-body">
                                        <p class="text-center">Confirm Delete</p>
                                        <div class="text-center">
                                            <button type="button" class="btn btn-sm delete-modal-close-btn" data-bs-dismiss="modal" aria-label="No">No</button>
                                            <button type="button" onclick="groupMailboxDelete()" class="btn btn-sm yes-btn">Yes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Mailbox Group Delete Modal End -->

                    </div>
                </div>
            </div>
        </div>
        <div class="admin-mail-create-btn-area tabcontent adminMailboxTabContent create-mail">
            <button type="button" class="btn admin-mail-create-send-btn mt-3">Send</button> <span id="sendLoadingDiv" class="d-none spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
        </div>

    </div>


@endsection
@push('customScripts')
    <script>
        function filterByPriority() {
            removeClassFromPaginationArrow('searchMail')
            removeClassFromPaginationArrow('getMailByCategory')
            let priority= $('#priority').find(":selected").val()
            let category= $('#category').find(":selected").val()
            let url = "{{ route('mail.admin.priority', ':priority') }}"
            url=url.replace(':priority', priority)
            $.ajax({
                url: url,
                data: {category: category},
                success: function(res) {
                    determinePaginationArrow(res)
                    //
                    $('.pagination-left-number').text(res.current_page)
                    $('.pagination-right-number').text(res.last_page)
                    injectClass('getMailByPriority')
                    $(".pagination-part .left-arrow").attr('data-href', res.prev_page_url)
                    $(".pagination-part .right-arrow").attr('data-href', res.next_page_url)
                    if(res.data.length > 0){
                        $('#admin').html(res.data.map((item) =>
                            domLoad(item)
                        ).join(' '))
                    }else {
                        $('#admin').empty().append(`<div class="mails row g-0">
                                    <div class="col-12 col-md-12 col-lg-12 message-div text-center"><span>No Data Available</span></div>
                                </div>`)
                    }
                }
            });
        }
        function filterByCategory() {
            removeClassFromPaginationArrow('searchMail')
            removeClassFromPaginationArrow('getMailByPriority')

            let category= $('#category').find(":selected").val()
            let priority =$('#priority').find(":selected").val()
            let url = "{{ route('mail.admin.category', ':category') }}"
            url=url.replace(':category', category)

            $.ajax({
                url: url,
                data: {priority: priority},
                success: function(res) {
                    determinePaginationArrow(res)
                    //
                    $('.pagination-left-number').text(res.current_page)
                    $('.pagination-right-number').text(res.last_page)
                    injectClass('getMailByCategory')
                    $(".pagination-part .left-arrow").attr('data-href', res.prev_page_url)
                    $(".pagination-part .right-arrow").attr('data-href', res.next_page_url)
                    if(res.data.length > 0){
                        $('#admin').html(res.data.map((item) =>
                            domLoad(item)
                        ).join(' '))
                    }else {
                        $('#admin').empty().append(`<div class="mails row g-0">
                                    <div class="col-12 col-md-12 col-lg-12 message-div text-center"><span>No Data Available</span></div>
                                </div>`)
                    }
                }
            });
        }
        $('.pagination-part .left-arrow').on('click', function (){
           if ($(this).attr('data-href') != ''){
               let url= "index?page="
               var page = $(this).attr('data-href').split('page=')[1];
               if($('.pagination-part .left-arrow').hasClass('getMailByCategory') == true){
                   let category=$(this).attr('data-href').split('?')[0].split('/')[5]
                   url="get-admin-mail-by-category/"+category+"?page="
               }
               if($('.pagination-part .left-arrow').hasClass('getMailByPriority') == true){
                   let priority=$(this).attr('data-href').split('?')[0].split('/')[5]
                   url="get-admin-mail-by-priority/"+priority+"?page="
               }
               if($('.pagination-part .left-arrow').hasClass('searchMail') == true){
                   let search=$(this).attr('data-href').split('?')[0].split('/')[5]
                   url="search-mail/"+search+"?page="
               }
               fetch_data(url,page);
           }
        })
        $('.pagination-part .right-arrow').on('click', function (){
            if ($(this).attr('data-href') != ''){
                let url= "index?page="
                var page = $(this).attr('data-href').split('page=')[1];
                if($('.pagination-part .right-arrow').hasClass('getMailByCategory') == true){
                    let category=$(this).attr('data-href').split('?')[0].split('/')[5]
                    url="get-admin-mail-by-category/"+category+"?page="
                }
                if($('.pagination-part .right-arrow').hasClass('getMailByPriority') == true){
                    let priority=$(this).attr('data-href').split('?')[0].split('/')[5]
                    url="get-admin-mail-by-priority/"+priority+"?page="
                }
                if($('.pagination-part .right-arrow').hasClass('searchMail') == true){
                    let search=$(this).attr('data-href').split('?')[0].split('/')[5]
                    url="search-mail/"+search+"?page="
                }
                fetch_data(url,page);
            }

        })

        function fetch_data(url,page) {
            let wrapper = "#admin"
            // if ($("#view-name").text() == 'Admin View') {
            //     wrapper = "#admin"
            // } else {
            //     wrapper = "#company"
            // }
            let search = '0'
            // if($('.up-search').val().length == 0 && $('.up-search').val().length === 0){
            //     search = '0'
            // }

            let category=$('#category').find(":selected").val()
            let priority =$('#priority').find(":selected").val()

            $.ajax({
                url: url + page,
                data: {search:search,category: category, priority:priority},
                dataType:"json",
                success: function(res) {

                    determinePaginationArrow(res)

                    $('.pagination-left-number').text(res.current_page)
                    $('.pagination-right-number').text(res.last_page)
                    $(".pagination-part .left-arrow").attr('data-href', res.prev_page_url)
                    $(".pagination-part .right-arrow").attr('data-href', res.next_page_url)
                    if (res.data.length > 0) {
                        $(wrapper).html(res.data.map((item) =>
                            domLoad(item)
                        ))
                    }else {
                        $(wrapper).empty().append(`<div class="mails row g-0">
                                    <div class="col-12 col-md-12 col-lg-12 message-div text-center"><span>No Data Available</span></div>
                                </div>`)
                    }
                }
            });
        }
        //admin-view
        $(document).on('click', '#downloadAttachmentCloneBtn', function(event) {
            event.preventDefault();
            $("#downloadAttachmentBtn").click()
        });
        //company-view
        $(document).on('click', '#downloadAttachmentCloneBtn-2', function(event) {
            event.preventDefault();
            $('.download-bulk-mail-submit-btn').click();
        });
        $(document).on('click', '#downloadAttachmentBtn2', function(event) {
            event.preventDefault();
            $('.download-bulk-mail-submit-btn').click();
        });

        var $checkboxes = $('.mailbox-body .mails  input[type="checkbox"]');
        $(document).ready(function(){
            $('#renameLoadingDiv').hide()
            $('#searchLoadingDiv').hide()
            //pagination
            let page=$('#last_page').val()
            if (page != ""){
                $('.pagination-part .right-arrow').removeClass('d-none')
            }else {

                $('.pagination-part .right-arrow').addClass('d-none')
                // $('.pagination-part').addClass('d-none')
            }

            // start remove previously injected class
            removeClassFromPaginationArrow('getMailByCompany')
            removeClassFromPaginationArrow('getMailByPriority')
            removeClassFromPaginationArrow('searchMail')
            // end remove previously injected class
            // Get the element with id="defaultOpen" and click on it
            document.getElementById("defaultOpen").click();
            $('.button-part').hide();


            $checkboxes.change(function(e){
                // console.log(e.target.parentElement.parentElement.classList.toggle("selected"))
                checkbox();
            });


        })
        function checkbox(){
            var countCheckedCheckboxes = $checkboxes.filter(':checked').length;
            console.log(countCheckedCheckboxes)
            if(countCheckedCheckboxes > 0){
                $('.selected-checkbox-number').text(countCheckedCheckboxes + " selected");
                $('.sb-part').hide();
                $('.button-part').show();
                $('.bottom-pagination-part').hide();
            }
            else{
                $('.selected-checkbox-number').text("Select All");
                $('.sb-part').show();
                $('.button-part').hide();
                $('.bottom-pagination-part').show();
            }
        }
        $('.admin-mail-create-send-btn').click(function(){
            $('.admin-mail-create-send-btn').hide()
            $('#sendLoadingDiv').removeClass('d-none')
            $('.admin-mail-create-submit-btn').click();
        })
        $('.download-bulk-mail-send-btn').click(function(){
            $('.download-bulk-mail-submit-btn').click();
        })
        $(".select-all-checkbox").click(function () {

            $('input:checkbox').not(this).prop('checked', this.checked);
            checkbox();
            var checkboxes2 = $('.mailbox-body .mails input[type="checkbox"]');
            var countCheckedCheckboxes = checkboxes2.filter(':checked').length;
            if(countCheckedCheckboxes > 0){
                $('.selected-checkbox-number').text(countCheckedCheckboxes + " selected");
                $('.sb-part').hide();
                $('.button-part').show();
            }
            else{
                $('.selected-checkbox-number').text("Select All");
                $('.sb-part').show();
                $('.button-part').hide();
            }

        });

        // $('.action-buttons').click(function(e){
        //     const actionBtns = document.querySelectorAll(".action-buttons");
        //     actionBtns.forEach((btn) => {
        //         actionBtns.forEach(f => f.classList.remove('active'));
        //         e.target.classList.toggle("active");
        //     });
        // });
        $('#switch-btn').click(function() {
            $('input:checkbox').not(this).prop('checked', '');
            checkbox();
            if (($("#admin-view").hasClass("d-none")) == true) {
                $("#admin-view").removeClass("d-none");
                $("#company-view").addClass("d-none");
                $("#view-name").text("Admin View");
            } else {
                $("#admin-view").addClass("d-none");
                $("#company-view").removeClass("d-none");
                $("#view-name").text("Company View");
            }
            if($('#company_id').find(":selected").val() != ''){
                getMail()
            }
            // console.log($('.admin-search-field').val())
            if($('.admin-search-field').val() != ''){
                searchMail()
            }else if($('.company-search-field').val() != ''){
                searchMail()
            }
        })


        function adminMailBoxTab(evt, enevtName) {
            //////// New Fix

            if(enevtName === "folder"){
                document.getElementById("company-search-portion").style.display = "block";
            }else{
                document.getElementById("company-search-portion").style.display = "none";
            }
            ///////// New Fix
            var i, tabcontent, tablinks,elements;
            tabcontent = document.getElementsByClassName("adminMailboxTabContent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("adminMailboxTabLinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }

            // document.getElementById(enevtName).style.display = "block";

            elements = document.getElementsByClassName(enevtName);
            for (i = 0; i < elements.length; i++) {
                elements[i].style.display = "block";
            }
            evt.currentTarget.className += " active";
        }

        function downloadAttachment(){
            // let button;
            let action = "{{route('mail.downloadAttachment')}}"
            $("#form-1").attr('action', action)


            $('input:checked').map(function(){
                let button = $(this).parent().siblings().find('button');
                // console.log(button.hasClass('active'))
                if(button.hasClass('active')){
                    button.removeClass('active');
                    // button.text("Downloaded");
                }
            });
        }
        function downloadAttachmentFromCompanyView(){
            let action = "{{route('mail.downloadAttachment')}}"
            $("#form-2").attr('action', action)
        }

        function downloadIndividual(el,id){
            var url = "{{ route('mail.individual.download', ':id') }}";
            url = url.replace(':id', id);
            $("#form-1").attr('action', url);

            if (el.classList.contains('active') == true){
                el.classList.remove('active')
                // el.innerHTML = 'Downloaded'
                // console.log()
            }
        }

        function downloadIndividualFromCompanyView(id){
            var url = "{{ route('mail.individual.download', ':id') }}";
            url = url.replace(':id', id);
            $("#form-2").attr('action', url)
        }

        {{--Search Mail--}}

        $('.up-search').on('keyup',function () {
            let wrapper = "#admin"
            if (this.value.length == 0){
                loadIndex(wrapper)
            }
        })
        $('.down-search').on('keyup',function () {
            let wrapper = "#admin"
            if (this.value.length == 0){
                loadIndex(wrapper)
            }
        })
        function loadIndex(wrapper) {
            removeClassFromPaginationArrow('searchMail')
            removeClassFromPaginationArrow('getMailByPriority')
            removeClassFromPaginationArrow('getMailByCategory')
            let url = "{{ route('mail.admin.index')}}"
            let category=$('#category').find(":selected").val()
            let priority =$('#priority').find(":selected").val()
            $.ajax({
                url: url,
                data: {search:0,category:category,priority:priority },

                success: function(res) {
                    console.log(res)
                    determinePaginationArrow(res)
                    //
                    $('.pagination-left-number').text(res.current_page)
                    $('.pagination-right-number').text(res.last_page)
                    $(".pagination-part .left-arrow").attr('data-href', res.prev_page_url)
                    $(".pagination-part .right-arrow").attr('data-href', res.next_page_url)
                    if (res.data.length > 0){
                        $(wrapper).html(res.data.map((item) =>
                            domLoad(item)
                        ))
                    }else {
                        $(wrapper).empty().append(`<div class="mails row g-0">
                                    <div class="col-12 col-md-12 col-lg-12 message-div text-center"><span>No Data Available</span></div>
                                </div>`)

                    }
                }
            });

        }
        function searchMail(){
            removeClassFromPaginationArrow('getMailByPriority')
            removeClassFromPaginationArrow('getMailByCategory')
            let category=$('#category').find(":selected").val()
            let priority =$('#priority').find(":selected").val()
            let value=""
            let wrapper = "#admin"
            $("input[name='search']").each(function() {
                if (this.value != ''){
                    value=this.value;
                }
            });


            let url = "{{ route('mail.search', ':search') }}"
            url=url.replace(':search', value)
            $.ajax({
                url: url,
                data: {category: category, priority:priority},
                success: function(res) {
                    console.log(res)
                    determinePaginationArrow(res)
                    //
                    $('.pagination-left-number').text(res.current_page)
                    $('.pagination-right-number').text(res.last_page)
                    injectClass('searchMail')
                    $(".pagination-part .left-arrow").attr('data-href', res.prev_page_url)
                    $(".pagination-part .right-arrow").attr('data-href', res.next_page_url)
                    if (res.data.length > 0){
                        $(wrapper).html(res.data.map((item) =>
                            domLoad(item)
                        ))
                    }else {
                        $(wrapper).empty().append(`<div class="mails row g-0">
                                    <div class="col-12 col-md-12 col-lg-12 message-div text-center"><span>No Data Available</span></div>
                                </div>`)

                    }
                }
            });

        }

        function checkboxSelectAfterAppend(){
            var checkboxes2 = $('.mailbox-body .mails input[type="checkbox"]');
            var countCheckedCheckboxes = checkboxes2.filter(':checked').length;
            if(countCheckedCheckboxes > 0){
                $('.selected-checkbox-number').text(countCheckedCheckboxes + " selected");
                $('.sb-part').hide();
                $('.button-part').show();
            }
            else{
                $('.selected-checkbox-number').text("Select All");
                $('.sb-part').show();
                $('.button-part').hide();
            }
        }

        {{--Universal DOM Load--}}

        function domLoad(item){

            let download_button_class="btn download-btn"
            if (item.downloaded_at != null){
                download_button_class= download_button_class + ''

            }else {
                download_button_class= download_button_class + ' active'
            }


            return `<div class="mails row g-0">
                        <div class="col-4 col-md-3 checkbox-div">
                            <input type="checkbox" class="select-checkbox" onchange="checkboxSelectAfterAppend()" name="mail-id[]" value="${item.id}">` +
                            (item.priority == 'urgent' ? `<img src="{{asset('assets/icons/mailbody-!.png')}}" alt="" style="margin-right: 5px">` : `<img style="margin-right: 5px" src="{{asset('assets/icons/mailbody-!-white.png')}}" alt="">`)+
                                `<span class="fw-bold">${item.companies.name}</span>
                        </div>
                        <div class="col-4 col-md-5 message-div">`+
                            (item.read_at !=null ? `<p class="" >${item.title}</p>` : `<p class="text-dark fw-bold" >${item.title}</p>`)+
                        `</div><div class="col-2 col-md-2 folder-div">
                                    <p class="fw-bold text-black">${item.directory}</p>
                                </div>
                        <div class="col-2 col-md-2 time-div">
                            <span class="text-dark fw-bold">${$.date(item.created_at)}</span>` +
                (item.file != null ? `<button type="submit" onclick="downloadIndividual(this,${item.id})" class="${download_button_class}" title="Download"><i class="fa-solid fa-download"></i></button>` : '')+
                        `<button type="button" class="btn delete-btn" data-bs-toggle="modal" data-bs-target="#deleteModal-${item.id}" title="Delete"><i class="fa-solid fa-trash-can"></i></button>
                        <div class="modal fade" id="deleteModal-${item.id}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="mailboxDeleteModal" aria-hidden="true">
                            <div class="modal-dialog delete-modal">
                                <div class="modal-content">
                                    <div class="delete-modal-body">
                                        <p class="text-center">Confirm Delete</p>
                                        <div class="text-center">
                                            <button type="button" class="btn btn-sm delete-modal-close-btn" data-bs-dismiss="modal" aria-label="No">No</button>
                                            <button type="button" onclick="individualMailboxDelete(this)" data-mail="${item.id}" class="btn btn-sm yes-btn">Yes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>`
        }
        // previous download button
        // <button type="submit" onclick="downloadIndividual(this,${item.id})" class="${download_button_class}">`+(item.downloaded_at != null ? "Downloaded" : "Download")+`</button>
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

        function removeClassFromPaginationArrow(className){
            if ( $(".pagination-part .right-arrow").hasClass(className)){
                $(".pagination-part .right-arrow").removeClass(className)
            }
            if (  $(".pagination-part .left-arrow").hasClass(className)){
                $(".pagination-part .left-arrow").removeClass(className)
            }
        }

        function determinePaginationArrow(res){
            if (res.current_page > 1){
                if ($(".pagination-part .left-arrow").hasClass("d-none") == true) {
                    $(".pagination-part .left-arrow").removeClass('d-none')
                }
            }else {
                $(".pagination-part .left-arrow").addClass('d-none')
            }
            if(res.current_page == res.last_page){
                $(".pagination-part .right-arrow").addClass('d-none')
            }else {
                $(".pagination-part .right-arrow").removeClass('d-none')
            }
        }

        function injectClass(className){
            $(".pagination-part .right-arrow").addClass(className)
            $(".pagination-part .left-arrow").addClass(className)
        }
        let allDirectories = []
        $('#companyId').on('change', function () {
            $('#mail_category').prop('disabled', false)
        })
        $('#mail_category').on('change', function () {
            allDirectories = []
            let url= "{{route('mail.getDirectories', [':company_id', ':category'])}}"
            url = url.replace(':company_id', $('#companyId').val())
                url = url.replace(':category', $('#mail_category :selected').text())
            var removeValFrom = [0, 1, 2];
            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                success: function(res) {
                    $('#path').prop('disabled', false)
                    for(var x = 0; x < res.length; x++){
                        // res[x].toLowerCase().split('/').filter(function(value, index) {
                        res[x].split('/').filter(function(value, index) {
                            // return removeValFrom.indexOf(index) == -1;
                            if( removeValFrom.indexOf(index) == -1){
                                allDirectories.push(value)
                            }
                        })
                    }
                }
            });
        })
        $("#path").on('keyup', function () {
            let dir=''

            // let input = $("#path").val().toLowerCase()
            let input = $("#path").val()
            $(".append").empty();
            if($("#path").val() != ""){
                for(var x = 0; x < allDirectories.length; x++){
                    if(allDirectories[x].indexOf(input) > -1){
                        $(".append").removeClass('d-none');
                       dir+= `<span class="dir">${allDirectories[x]}</span>`
                    }
                }

                $(".append").append(dir);
            }else{
                $(".append").addClass('d-none');
            }
        })
        $('body').on('click', '.dir', function(){
            $('#path').val($(this).text())
            $(".append").addClass('d-none');
        })


        $('#get_directories').on('click', function () {
            let directories = []
            let categoryDirectories = []
            let url= "{{route('mail.getCompanyDirectories', ':company_id')}}"
            url = url.replace(':company_id', $('#select_company :selected').val())
            var removeValFrom = [0, 1, 2];
            var removeValForCategory = [0, 1, 3];
            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                beforeSend: function () {
                    $("#searchLoadingDiv").show();
                },
                success: function(res) {
                    console.log(res)
                    $('#current_selection').text($('#select_company :selected').text())
                    $("#searchLoadingDiv").hide();
                    for(var x = 0; x < res.length; x++){
                        for(var y=0; y<res[x].length; y++){
                            // res[x][y].toLowerCase().split('/').filter(function(value, index) {
                            res[x][y].split('/').filter(function(value, index) {
                                // Gathering the end directory;
                                if( removeValFrom.indexOf(index) == -1){
                                    directories.push(value)
                                }
                                // Gathering the category directory according to end directory;
                                if( removeValForCategory.indexOf(index) == -1){
                                    categoryDirectories.push(value)
                                }
                            })
                        }
                    }
                    let html=''

                    $.map(directories, function (value,index) {
                            // <p class="">${value.substr(0,1).toUpperCase()+value.substr(1)}</p> Uppercase first letter
                            html += `<div class="row g-0 folder d-flex">
                            <div class="col-8 col-md-8 folder-name-div">
                                <p class="">${value}</p>
                            </div>
                            <div class="col-4 col-md-4 button-div text-end">
                                <button onclick="showModal(this)" id="directory-${index}" data-category="${categoryDirectories[index]}" data-directory="${value}" data-company="company_${$('#select_company :selected').val()}" class="btn folder-edit-btn me-3" type="button" data-bs-toggle="modal" data-bs-target="#folderEditModal">Edit</button>
                                 <button type="button" class="btn folder-delete-btn" data-bs-toggle="modal" data-bs-target="#folderDeleteModal-${index}">Delete</button>

                                        <div class="modal fade" id="folderDeleteModal-${index}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="folderDeleteModalLabel" aria-hidden="true">
                                            <div class="modal-dialog delete-modal">
                                                <div class="modal-content">
                                                    <div class="delete-modal-body">
                                                        <p class="text-center">Confirm Delete</p>
                                                        <div class="text-center">
                                                            <button type="button" class="btn btn-sm delete-modal-close-btn" data-bs-dismiss="modal" aria-label="No">No</button>
                                                            <button type="button" data-index="${index}" data-category="${categoryDirectories[index]}" data-directory="${value}" data-company="company_${$('#select_company :selected').val()}" onclick="deleteDirectory(this)" class="btn btn-sm yes-btn">Yes</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                            </div>
                        </div>`
                    })

                    $('#company_directories').empty().append(html)

                }, error: function (err) {
                    $("#searchLoadingDiv").hide();
                    $('#ajax-alert').append(`<div class="alert alert-success">
                                                <img class="alert-img" src="{{asset('assets/icons/mailbody-!.png')}}" alt="">
                                                <p class="alert-text">Something went wrong!</p>
                                            </div>`)
                }
            });

        })
        // const titleCase = (s) => s.replace(/\b\w/g, c => c.toUpperCase());

        function showModal(e) {
            $('#exampleModal').modal('show')
            $('#directory_name').val(e.getAttribute('data-directory'))
            $('#prev_directory').val(e.getAttribute('data-directory'))
            $('#company_root_directory').val(e.getAttribute('data-company'))
            $('#company_category_directory').val(e.getAttribute('data-category'))
        }

        $('#rename_folder').submit(function (e) {
            e.preventDefault()
            $('.error-directory').text('')
            let url = "{{route('rename.folder')}}"
            let formData = $('#rename_folder').serialize()
            $.ajax({
                url: url,
                // dataType:'json',
                type: "POST",
                data: formData,

                beforeSend: function () {
                    $("#update_directory_name").hide();
                    $("#renameLoadingDiv").show();
                },
                success: function(res) {
                    $("html, body").animate({scrollTop: 0});
                    $('#folderEditModal').modal('hide')
                    $('#get_directories').click()
                    $("#update_directory_name").show();
                    $("#renameLoadingDiv").hide();
                    $('#ajax-alert').append(`<div class="alert alert-success">
                        <img class="alert-img" src="{{asset('assets/icons/success-alert-icon.png')}}" alt="">
                        <p class="alert-text">${res.msg}</p></div>`)


                }, error: function (xhr) {
                    $("#update_directory_name").show();
                    $("#renameLoadingDiv").hide();
                    if (xhr.responseJSON.hasOwnProperty('errors') == true) {
                        $.each(xhr.responseJSON.errors, function (key, value) {
                            $('.error_'+key).append(`<i class="fa-solid fa-circle-info"></i> `+value)
                        })
                    }else{
                        $('#folderEditModal').modal('hide')
                        $('#ajax-alert').append(`<div class="alert alert-success">
                                                <img class="alert-img" src="{{asset('assets/icons/mailbody-!.png')}}" alt="">
                                                <p class="alert-text">Something went wrong!</p>
                                            </div>`)
                    }

                }
            })
        })
        function deleteDirectory(e) {
            let modal ='folderDeleteModal-'+ e.getAttribute('data-index')
            let company_root_directory = e.getAttribute('data-company')
            let directory = e.getAttribute('data-directory')
            let category = e.getAttribute('data-category')
            let url = "{{route('mail.delete.directory', [':company_root_directory', ':category', ':directory'])}}"
            url = url.replace(':company_root_directory', company_root_directory).replace(':category',category).replace(':directory',directory)
           $.ajax({
               url:url,
               type:"GET",
               success: function (res) {
                   $('#'+modal).modal('hide')
                   $('#get_directories').click()
                  if(res.status){
                      $("html, body").animate({scrollTop: 0});
                      $('#ajax-alert').append(`<div class="alert alert-success">
                        <img class="alert-img" src="{{asset('assets/icons/success-alert-icon.png')}}" alt="">
                        <p class="alert-text">${res.msg}</p></div>`)
                  }else{
                      $('#ajax-alert').append(`<div class="alert alert-success">
                                                <img class="alert-img" src="{{asset('assets/icons/mailbody-!.png')}}" alt="">
                                                <p class="alert-text">${res.msg}</p>
                                            </div>`)
                  }

               }
           })

        }
        function groupMailboxDelete(){

            let action = "{{route('mail.delete')}}"
            $("#form-1").attr('action', action)

            $('#groupMailboxDelete').click()
            // $('input:checked').map(function(){
            //     let button = $(this).parent().siblings().find('button');
            //     console.log(button.hasClass('active'))
            //     if(button.hasClass('active')){
            //         button.removeClass('active');
            //         button.text("Downloaded");
            //     }
            // });
        }

        function individualMailboxDelete(e) {
            let mail= e.getAttribute('data-mail')
            let url = "{{route('mail.delete.individual', ':mail')}}"
            url = url.replace(':mail', mail)
            $.ajax({
                url: url,
                type: "GET",
                success: function (res) {
                    $("html, body").animate({scrollTop: 0});
                    $('#deleteModal-'+mail).modal('hide')
                    $('#ajax-alert').append(`<div class="alert alert-success">
                        <img class="alert-img" src="{{asset('assets/icons/success-alert-icon.png')}}" alt="">
                        <p class="alert-text">${res.msg}</p></div>`)
                    setTimeout(function () {
                        window.location.reload()
                    }, 2000);
                },error: function (xhr) {
                    $('#deleteModal-'+mail).modal('hide')
                    $('#ajax-alert').append(`<div class="alert alert-success">
                                                <img class="alert-img" src="{{asset('assets/icons/mailbody-!.png')}}" alt="">
                                                <p class="alert-text">Something went wrong!</p>
                                            </div>`)
                }
            })

        }


    </script>
@endpush
