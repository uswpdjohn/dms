@extends('layouts.master')
@section('content')
    <!-- Main Body Start -->
    <div class="main-body">
        @if(session()->has('success'))
            <div class="alert alert-success alert-redirect">
                <img class="alert-img"
                     src="{{asset('assets/icons/success-alert-icon.png')}}"
                     alt="">
                <p class="alert-text"> {{session('success')}}</p>
            </div>
        @endif
        <div id="flashMessages"></div>
        <div class="row admin-setup-body g-0">
            <div class="col-12 col-md-2 col-sm-12 card admin-setup-button-card">
                <div class="card-body admin-setup-button-body">
                    <div class="tab-buttons">
                        <button class="tablinks adminSetupTabLinks" onclick="adminSetupTab(event,'login')"
                                id="tab-login">Login
                        </button>
                        <button class="tablinks adminSetupTabLinks" onclick="adminSetupTab(event,'faq')" id="tab-faq">
                            FAQ
                        </button>
{{--                        <button class="tablinks adminSetupTabLinks" onclick="adminSetupTab(event,'support-ticket')"--}}
{{--                                id="tab-support">Support Ticket--}}
{{--                        </button>--}}
                        <button class="tablinks adminSetupTabLinks" onclick="adminSetupTab(event,   'terms-use')"
                                id="tab-terms">Terms of Use
                        </button>
                        <button class="tablinks adminSetupTabLinks" onclick="adminSetupTab(event,  'pri-policy')"
                                id="tab-policy">Privacy Policy
                        </button>
                        <!-- <button class="tablinks adminSetupTabLinks" onclick="adminSetupTab(event, 'esop')">ESOP</button> -->
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-10 col-sm-12">
                <div class="card admin-doc-manage-card">
                    <div class="card-body admin-doc-manage-content-body">

                        <!--Login Portion Starts -->

                        <div id="login" class="tabcontent adminSetupTabContent login">
                            <div class="admin-setup-login-card-portion col-12 col-lg-12">
                                <form action="{{route('setup.change','login_bg_image')}}" method="POST"
                                      enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf
                                    <div class="card setup-login-card">
                                        <div class="card-body">
                                            <div class="d-flex">
                                                <h6 class="director-header">Change your Login Background Image</h6>
                                                <button type="submit" class="btn save-btn ms-auto">Save</button>
                                            </div>

                                            <!-- file uploader -->
                                            <div class="upload-inner d-flex">
                                                <div class="login-upload-container">
                                                    <div class="upload-icon">
                                                        <i class="fa-thin fa-plus"></i>
                                                        <span>Upload</span>
                                                    </div>
                                                    <input type="file" accept="image/*" id="upload-file"
                                                           name="login_bg_image" class="upload-input" required/>
                                                </div>
                                                <div class="img-preview-container"></div>
                                            </div>
                                            @error('login_bg_image')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- Login Portion Ends -->

                        <!-- FAQ portion starts -->
                        <div id="faq" class="tabcontent adminSetupTabContent faq">
                            <div class="select-pagination-portion table-top-portion row g-0">
                                <div class="sb-part search-box-part col-12 col-md-4 col-lg-4">
                                    <div class="d-flex form-inputs search-data">
                                        <input class="form-control up-search" id="faq-search" type="text" placeholder="Search">
                                        <button class="search-btn btn" onclick="fetch_data(1)"><i
                                                class="fa-solid fa-search"></i></button>
                                    </div>
                                </div>
                                <div class="sb-part faq-category-select col-6 offset-md-0 col-md-3 col-lg-3">
                                    <select class="form-control form-select nav-select select-data " name="category_id"
                                            id="category_id" required>
                                        <option hidden value>Filter</option>
                                        <option value="0">All</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="create-btn-part col-6 col-md-5 col-lg-5">
                                    <button type="button" id="create-faq-modal-btn"
                                            class="btn download-btn action-buttons active"
                                            data-bs-toggle="modal" data-bs-target="#faqCreateModal">Create
                                    </button>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <div class="faq-table">
                                    <div class="faqs faq-header row g-0">
                                        <div class="col-2 col-md-2 header-div">
                                            <p class="">Category</p>
                                        </div>
                                        <div class="col-4 col-md-4 header-div">
                                            <p class="">Question</p>
                                        </div>
                                        <div class="col-4 col-md-4 header-div">
                                            <p class="">Answer</p>
                                        </div>
                                        <div class="col-2 col-md-2 header-div">
                                            <p class="">Action</p>
                                        </div>
                                    </div>
                                    <div id="faq_table">
                                        {{--                                        @foreach($faqs as $faq)--}}
                                        {{--                                            <div class="faqs row g-0">--}}
                                        {{--                                                <div class="col-2 col-md-2 checkbox-div">--}}
                                        {{--                                                    <span>{{ $faq->category->name }}</span>--}}
                                        {{--                                                </div>--}}
                                        {{--                                                <div class="col-4 col-md-4 data-div">--}}
                                        {{--                                                    <p class="">{{ $faq->question }}</p>--}}
                                        {{--                                                </div>--}}
                                        {{--                                                <div class="col-4 col-md-4 data-div">--}}
                                        {{--                                                    <p class="">{{ $faq->answer }}</p>--}}
                                        {{--                                                </div>--}}
                                        {{--                                                <div class="col-2 col-md-2 action-div">--}}
                                        {{--                                                    <a href="#" class="action-buttons edit-faq-button"--}}
                                        {{--                                                       data-id="{{ $faq->id }}" data-bs-toggle="modal"--}}
                                        {{--                                                        --}}{{--                                               data-bs-target="#faqEditModal"--}}
                                        {{--                                                    >Edit</a>--}}
                                        {{--                                                    <a href="" class="action-buttons delete-btn" data-bs-toggle="modal"--}}
                                        {{--                                                       data-bs-target="#faqDeleteModal{{ $faq->id }}"--}}
                                        {{--                                                        --}}{{--                                               onclick="delURL(this)" id="{{route('setup.faq.delete', $faq->id)}} "--}}
                                        {{--                                                    >Delete</a>--}}
                                        {{--                                                    <!-- Delete Modal Start -->--}}
                                        {{--                                                    <div class="modal fade" id="faqDeleteModal{{ $faq->id }}"--}}
                                        {{--                                                         data-bs-backdrop="static"--}}
                                        {{--                                                         data-bs-keyboard="false" tabindex="-1"--}}
                                        {{--                                                         aria-labelledby="faqDeleteModalLabel" aria-hidden="true">--}}
                                        {{--                                                        <div class="modal-dialog faq-delete-modal">--}}
                                        {{--                                                            <div class="modal-content">--}}
                                        {{--                                                                <div class="faq-delete-modal-body">--}}
                                        {{--                                                                    <p class="text-center">Confirm Delete</p>--}}
                                        {{--                                                                    <div class="text-center">--}}
                                        {{--                                                                        <button type="button"--}}
                                        {{--                                                                                class="btn btn-sm faq-delete-modal-close-btn"--}}
                                        {{--                                                                                data-bs-dismiss="modal" aria-label="No">--}}
                                        {{--                                                                            No--}}
                                        {{--                                                                        </button>--}}
                                        {{--                                                                        <button type="button"--}}
                                        {{--                                                                                class="btn btn-sm yes-btn"--}}
                                        {{--                                                                                data-id="{{ $faq->id }}"--}}
                                        {{--                                                                                data-url="{{ route('setup.faq.delete', $faq->id) }}"--}}
                                        {{--                                                                                onclick="deleteYes(this)">Yes--}}
                                        {{--                                                                        </button>--}}
                                        {{--                                                                        --}}{{--                                                                <a class="btn btn-sm yes-btn" href="{{ route('setup.faq.delete', $faq->id) }}"--}}
                                        {{--                                                                        --}}{{--                                                                   onclick="event.preventDefault(); document.getElementById('faq-delete-form-{{$faq->id}}').submit();">--}}
                                        {{--                                                                        --}}{{--                                                                    Yes--}}
                                        {{--                                                                        --}}{{--                                                                </a>--}}
                                        {{--                                                                        --}}{{--                                                                <form id="faq-delete-form-{{$faq->id}}" action="{{ route('setup.faq.delete', $faq->id) }}" method="POST" class="d-none">--}}
                                        {{--                                                                        --}}{{--                                                                    @csrf--}}
                                        {{--                                                                        --}}{{--                                                                    @method('DELETE')--}}
                                        {{--                                                                        --}}{{--                                                                </form>--}}
                                        {{--                                                                    </div>--}}
                                        {{--                                                                </div>--}}
                                        {{--                                                            </div>--}}
                                        {{--                                                        </div>--}}
                                        {{--                                                        --}}{{--                                                <div class="modal-dialog user-delete-modal">--}}
                                        {{--                                                        --}}{{--                                                    <form id="delForm" method="POST">--}}
                                        {{--                                                        --}}{{--                                                        <meta name="csrf-token" content="{{ csrf_token() }}" />--}}
                                        {{--                                                        --}}{{--                                                        {{csrf_field()}}--}}
                                        {{--                                                        --}}{{--                                                        {{ method_field('DELETE') }}--}}
                                        {{--                                                        --}}{{--                                                        <div class="modal-content">--}}
                                        {{--                                                        --}}{{--                                                            <div class="user-delete-modal-body">--}}
                                        {{--                                                        --}}{{--                                                                <p class="text-center">Confirm Delete</p>--}}
                                        {{--                                                        --}}{{--                                                                <div class="text-center">--}}
                                        {{--                                                        --}}{{--                                                                    <button type="button" class="btn btn-sm user-delete-modal-close-btn"  data-bs-dismiss="modal" aria-label="No">No</button>--}}
                                        {{--                                                        --}}{{--                                                                    <button type="button" class="btn btn-sm yes-btn" onclick="deleteYes()">Yes</button>--}}
                                        {{--                                                        --}}{{--                                                                </div>--}}
                                        {{--                                                        --}}{{--                                                            </div>--}}
                                        {{--                                                        --}}{{--                                                        </div>--}}
                                        {{--                                                        --}}{{--                                                    </form>--}}
                                        {{--                                                        --}}{{--                                                </div>--}}
                                        {{--                                                    </div>--}}
                                        {{--                                                    <!-- Delete Modal End -->--}}
                                        {{--                                                </div>--}}
                                        {{--                                            </div>--}}
                                        {{--                                        @endforeach--}}
                                    </div>
                                </div>
                            </div>
                            <div class="select-pagination-portion table-bottom-portion row g-0">
                                <div class="pagination-part bottom-pagination-part col-12 col-md-12 col-lg-12">
                                    <input type="text" id="last_page" value="{{$faqs->hasPages()}}" hidden="hidden">
                                    <a data-href="{{$faqs->previousPageUrl()}}" class="btn left-arrow d-none"><i
                                            class="fa-solid fa-chevron-left"></i></a>
                                    <span
                                        class="pagination-number pagination-left-number">{{$faqs->currentPage()}}</span>
                                    <span class="pagination-divider">/</span>
                                    <span class="pagination-number pagination-right-number">{{$faqs->lastPage()}}</span>
                                    <a data-href="{{$faqs->nextPageUrl()}}" class="btn right-arrow d-none"><i
                                            class="fa-solid fa-chevron-right"></i></a>
                                </div>
                            </div>

                            <!-- FAQ Add Modal Start -->
                            <div class="modal fade" id="faqCreateModal" data-bs-backdrop="static"
                                 data-bs-keyboard="false" tabindex="-1" aria-labelledby="faqCreateModalLabel"
                                 aria-hidden="true">
                                <div class="modal-dialog faq-create-modal">
                                    <div class="modal-content">
                                        <div class="faq-create-modal-body">
                                            <div class="faq-create-modal-header row">
                                                <h5 class="modal-title col-10 col-sm-11" id="faqCreateModalLabel">Create
                                                    New FAQ</h5>
                                                <button type="button"
                                                        class="btn btn-close btn-sm faq-create-modal-close-btn col-2"
                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="faq-create-modal-data row">
                                                <form action="{{ route('setup.faq.store') }}" method="POST" id="create-faq-form">
                                                    @csrf
                                                    <input type="hidden" id="support-ticket-key"
                                                           name="support_ticket_key">
                                                    <div class="data-body row">
                                                        <div class="data-row col-7">
                                                            <label for="category_id"><span class="required-sign">*</span>Category</label>
                                                            <select
                                                                class="form-control form-select nav-select select-data "
                                                                name="category_id" id="create_category_id">
                                                                <option hidden>Select Your Category</option>
                                                                @foreach($categories as $category)
                                                                    <option
                                                                        value="{{$category->id}}">{{$category->name}}</option>
                                                                @endforeach
                                                            </select>
                                                            <span class="text-danger create_category_id"></span>
                                                        </div>
                                                        <div class="data-row col-12">
                                                            <label for="question"><span class="required-sign">*</span>Question</label>
                                                            <textarea type="text" name="question"
                                                                      class="form-control ques-area"
                                                                      id="create_question"
                                                                      placeholder="Key in your question here ..."
                                                                      ></textarea>
                                                            <span class="text-danger create_question"></span>
                                                        </div>
                                                        <div class="data-row col-12">
                                                            <label for="answer"><span class="required-sign">*</span>Answer</label>
                                                            <textarea type="text" name="answer"
                                                                      class="form-control ans-area" id="create_answer"
                                                                      placeholder="Key in your answer here ..."
                                                                      ></textarea>
                                                            <span class="text-danger create_answer"></span>
                                                        </div>
                                                        <div class="data-row col-12 text-end">
                                                            <button type="button" class="create-faq-btn btn"
                                                                    id="add-faq"><div id="create_faq_spinner"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></div>Create
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- FAQ Add Modal End -->


                            <!-- FAQ Edit Modal Start -->
                            <div class="modal fade" id="faqEditModal" data-bs-backdrop="static" data-bs-keyboard="false"
                                 tabindex="-1" aria-labelledby="faqEditModalLabel" aria-hidden="true">
                                <div class="modal-dialog faq-create-modal">
                                    <div class="modal-content">
                                        <div class="faq-create-modal-body">
                                            <div class="faq-create-modal-header row">
                                                <h5 class="modal-title col-10 col-sm-11" id="faqCreateModalLabel">Edit
                                                    FAQ</h5>
                                                <button type="button"
                                                        class="btn btn-close btn-sm faq-create-modal-close-btn col-2"
                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="faq-create-modal-data row">
                                                <form action="#" method="POST" id="edit-faq-form">
                                                    @method('PUT')
                                                    @csrf
                                                    <input type="hidden" id="support-ticket-key"
                                                           name="support_ticket_key">
                                                    <div class="data-body row">
                                                        <div class="data-row col-7">
                                                            <label for="category_id"><span class="required-sign">*</span>Category</label>
                                                            <select
                                                                class="form-control form-select nav-select select-data "
                                                                name="category_id" id="edit_category_id" required>
                                                                <option hidden>Select Your Category</option>
                                                                @foreach($categories as $category)
                                                                    <option
                                                                        value="{{$category->id}}">{{$category->name}}</option>
                                                                @endforeach
                                                            </select>
                                                            <span class="text-danger edit_category_id"></span>
                                                        </div>
                                                        <div class="data-row col-12">
                                                            <label for="question"><span class="required-sign">*</span>Question</label>
                                                            <textarea type="text" name="question"
                                                                      class="form-control ques-area" id="edit_question"
                                                                      placeholder="Key in your question here ..."
                                                                      required></textarea>
                                                            <span class="text-danger edit_question"></span>
                                                        </div>
                                                        <div class="data-row col-12">
                                                            <label for="answer"><span class="required-sign">*</span>Answer</label>
                                                            <textarea type="text" name="answer"
                                                                      class="form-control ans-area" id="edit_answer"
                                                                      placeholder="Key in your answer here ..."
                                                                      required></textarea>
                                                            <span class="text-danger edit_answer"></span>
                                                        </div>
                                                        <div class="data-row col-12 text-end">
                                                            <button type="button" class="create-faq-btn btn"
                                                                    id="update-faq"><div id="update_faq_spinner"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></div>Update
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- FAQ Edit Modal End -->

                        </div>
                        <!-- FAQ portion ends -->

                        <!-- Support Ticket Portion Starts -->
                        <div id="support-ticket" class="tabcontent adminSetupTabContent support-ticket table-responsive">
                            <div class="support-ticket-body">
                                <div class="tickets row g-0">
                                    <div class="col-4 col-md-4 header-div">
                                        <span>Category</span>
                                    </div>
                                    <div class="col-2 col-md-6 header-div">
                                        <span>Recipient(s)</span>
                                    </div>
                                    <div class="col-2 col-md-2 header-div">
                                        <!-- <span>Action</span> -->
                                    </div>
                                </div>

                                <!-- Recipient Add Modal Start -->
                                <div class="modal fade" id="recipientAddModal" data-bs-backdrop="static"
                                     data-bs-keyboard="false" tabindex="-1" aria-labelledby="recipientAddModalLabel"
                                     aria-hidden="true">
                                    <div class="modal-dialog user-create-modal">
                                        <div class="modal-content">
                                            <div class="user-create-modal-body">
                                                <div class="user-create-modal-header row">
                                                    <h5 class="modal-title col-11" id="userCreateModalLabel">Add
                                                        Recipient</h5>
                                                    <button type="button"
                                                            class="btn btn-close btn-sm user-create-modal-close-btn col-1"
                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="user-create-modal-data row">
                                                    <form action="#">
                                                        <meta name="csrf-token" content="{{ csrf_token() }}">
                                                        <input type="hidden" id="support-ticket-key"
                                                               name="support_ticket_key">
                                                        <input type="hidden" id="support-ticket-category-id"
                                                               name="support_ticket_category_id">
                                                        <div class="data-body row">
                                                            <div class="data-row col-6">
                                                                <label for="first-name"><span class="required-sign">*</span>First Name</label>
                                                                <input type="text" name="first_name"
                                                                       class="form-control" id="first-name"
                                                                       placeholder="First Name" required>
                                                                <span class="text-danger" id="user-first_name"></span>
                                                            </div>
                                                            <div class="data-row col-6">
                                                                <label for="last-name"><span class="required-sign">*</span>Last Name</label>
                                                                <input type="text" name="last_name" class="form-control"
                                                                       id="last-name" placeholder="Last Name" required>
                                                                <span class="text-danger" id="user-last_name"></span>
                                                            </div>
                                                            <div class="data-row col-12">
                                                                <label for="email-adrs"><span class="required-sign">*</span>Email Address</label>
                                                                <input type="email" name="email" class="form-control"
                                                                       id="email-adrs" placeholder="Email Address"
                                                                       required>
                                                                <span class="text-danger" id="user-email"></span>
                                                            </div>
                                                            {{--                                                            <div class="data-row col-12">--}}
                                                            {{--                                                                <div class="search-results">--}}
                                                            {{--                                                                    <ul class="list-group" id="search-results-list"></ul>--}}
                                                            {{--                                                                </div>--}}
                                                            {{--                                                            </div>--}}
                                                            <div
                                                                class="data-row col-12 text-end">
                                                                <button type="button" class="create-user-btn btn"
                                                                        id="add-recipient"><div id="add_recipient_spinner"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></div>Add
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Recipient Add Modal End -->
                                <!-- Business info part Starts  -->
                                @foreach($categories as $category)
                                    <div class="tickets row g-0">
                                        <div class="col-4 col-md-4 data-div">
                                            {{--                                        <div class="category-name" data-key="business_information">Business Information</div>--}}
                                            <div class="category-name" data-key="{{\Str::snake($category->name)}}"
                                                 data-id="{{$category->id}}">{{$category->name}}</div>
                                        </div>
                                        <div class="col-6 col-md-6 data-div data-list"
                                             id="{{\Str::snake($category->name)}}_list">
                                            @forelse($category->recipients as $recipient)
                                                {{--                                                    @dd($recipient)--}}
                                                <div>
                                                    {{--                                                        @if($recipient->category_id == $category->id)--}}
                                                    <div class="users-email d-flex">
                                                        <p class="">{{$recipient->first_name.' '.$recipient->last_name.' ('.$recipient->email.')'}}</p>
                                                        <button type="button" id="{{$recipient->id}}"
                                                                onclick="deleteRecipient(this)"
                                                                class="btn p-0 ps-3 ms-auto cancel-btn">x
                                                        </button>
                                                    </div>
                                                    {{--                                                        @endif--}}
                                                </div>
                                            @empty
                                                <div class="users-email no-email d-flex"><p class="">No Email
                                                        Entered</p></div>
                                            @endforelse
                                        </div>
                                        <div class="col-2 col-md-2 data-div">
                                            <div><a href="#" class="recipient-add-modal-btn" data-bs-toggle="modal"
                                                    data-bs-target="#recipientAddModal">
                                                    <img src="{{asset('assets/icons/add-button-icon.png')}}"
                                                         alt=""/></a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                <!-- Business info part Ends -->
                            </div>
                        </div>
                        <!-- Support Ticket Portion Ends -->

                        <!--Terms of use Portion Starts -->
                        <div id="terms-use" class="tabcontent adminSetupTabContent terms-use">
                            <div class="admin-setup-terms-card-portion col-12 col-lg-12">
                                <div class="card setup-terms-card">
                                    <form action="{{route('setup.change','terms_of_use')}}" method="POST">
                                        @method('PUT')
                                        @csrf
                                        <div class="card-body">
                                            <div class="d-flex">
                                                <h6 class="setup-header">Description</h6>
                                            </div>

                                            <div class="terms-container">
                                                <textarea class="terms-textarea"
                                                          name="terms_of_use">{{$terms_of_use['value']}}</textarea>
                                            </div>

                                            <div class="d-flex">
                                                <button href="#" type="submit" class="btn save-btn ms-auto">Save
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Terms of use Portion Ends -->

                        <!--Privacy Portion Starts -->
                        <div id="pri-policy"
                             class="tabcontent adminSetupTabContent pri-policy">
                            <div class="admin-setup-policy-card-portion col-12 col-lg-12">
                                <div class="card setup-policy-card">
                                    <form action="{{route('setup.change','privacy_policy')}}" method="POST">
                                        @method('PUT')
                                        @csrf
                                        <div class="card-body">
                                            <div class="d-flex">
                                                <h6 class="setup-header">Description</h6>
                                            </div>
                                            <div class="terms-container">
                                                <textarea class="terms-textarea"
                                                          name="privacy_policy">{{$privacy_policy['value']}}</textarea>
                                            </div>

                                            <div class="d-flex">
                                                <button type="submit" class="btn save-btn ms-auto">Save</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!--Privacy Policy Portion Ends -->

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Main Body End -->
@endsection
@push('customScripts')
    <script>
        // For Setup Page starts
        var uploadContainer = document.querySelector('.login-upload-container');
        var uploadInput = document.querySelector('.upload-input');
        var previewContainer = document.querySelector('.img-preview-container');

        uploadContainer.addEventListener('dragover', (e) => {
            e.preventDefault();
            uploadContainer.classList.add('dragover');
        });

        uploadContainer.addEventListener('dragleave', () => {
            uploadContainer.classList.remove('dragover');
        });

        uploadContainer.addEventListener('drop', (e) => {
            e.preventDefault();
            uploadContainer.classList.remove('dragover');
            var files = e.dataTransfer.files;
            if (files.length) {
                handleFiles(files);
            }
        });

        uploadInput.addEventListener('change', () => {
            handleFiles(uploadInput.files);
        });

        function handleFiles(files) {
            previewContainer.innerHTML = '';
            for (let i = 0; i < files.length; i++) {
                var file = files[i];
                var reader = new FileReader();
                reader.onload = function (e) {
                    var previewImage = document.createElement('img');
                    previewImage.classList.add('preview-img');
                    previewImage.src = e.target.result;
                    var previewName = document.createElement('div');
                    previewName.classList.add('preview-name');
                    previewName.textContent = file.name;
                    var previewItem = document.createElement('div');
                    previewItem.classList.add('preview-item');
                    previewItem.appendChild(previewImage);
                    previewItem.appendChild(previewName);
                    previewContainer.appendChild(previewItem);
                };
                reader.readAsDataURL(file);
            }
        }


        function adminSetupTab(evt, eventName) {
            var i, tabcontent, tablinks, elements;
            tabcontent = document.getElementsByClassName("adminSetupTabContent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("adminSetupTabLinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }

            elements = document.getElementsByClassName(eventName);
            for (i = 0; i < elements.length; i++) {
                elements[i].style.display = "block";
            }
            evt.currentTarget.className += " active";

            // Save active tab to local storage
            localStorage.setItem("activeTab", evt.currentTarget.id);

            // Header Text change starts
            var headerText;

            if (eventName === "login") {
                headerText = "Login Screen";
            } else if (eventName === "faq") {
                headerText = "FAQ";
                fetch_data(1)
            } else if (eventName === "support-ticket") {
                headerText = "Support Ticket Allocation";
            } else if (eventName === "terms-use") {
                headerText = "Terms of Use";
            } else if (eventName === "pri-policy") {
                headerText = "Privacy Policy";
            } else {
                headerText = "Login Screen";
            }

            var pageHeaderChange = document.getElementById("page-header");
            pageHeaderChange.innerHTML = headerText;

            // header text change ends
        }


        $(document).ready(function () {
            $('#add_recipient_spinner').hide();
            $('#create_faq_spinner').hide();
            $('#update_faq_spinner').hide();


            // localStorage.setItem("activeTab", "tab-login");
            var activeTab = localStorage.getItem("activeTab");
            if ($('#' + activeTab).length) {
                document.getElementById(activeTab).click();
            } else {
                localStorage.setItem("activeTab", "tab-login");
                document.getElementById("tab-login").click();
            }

            $('.admin-doc-create-send-btn').click(function () {
                $('.admin-doc-create-submit-btn').click();
            });

            let page = $('#last_page').val()
            if (page != "") {
                $('.pagination-part .right-arrow').removeClass('d-none')
            } else {
                $('.pagination-part .right-arrow').addClass('d-none')
            }

            // console.log($('#category_recipients_list_4').children('div').length)
            // fetch_data();
        });


        $(document).on('click', ".cancel-btn", function () {
            let parent_div = $(this).parent().parent('div');
            let previous_parent_div = $(this).parent().parent().parent('div');
            parent_div.remove();

            if (previous_parent_div.children().length == 0) {
                let html = '<div><div class="users-email d-flex">\
                                <p class="">No Email Entered</p>\
                            </div></div>';
                previous_parent_div.append(html);
            }
        });
        // add recipient
        $('#add-recipient').on('click', function () {

            // add the recipient info to the list
            let first_name = $("input[name='first_name']").val();
            let last_name = $("input[name='last_name']").val();
            let email = $("input[name='email']").val();
            let support_ticket_key = $("input[name='support_ticket_key']").val();
            let support_ticket_category_id = $("input[name='support_ticket_category_id']").val();
            let requestBody = {
                'first_name': first_name,
                'last_name': last_name,
                'email': email,
                'category_id': support_ticket_category_id,
            }
            // console.log($('div').find(`[data-key='${support_ticket_key}']`))

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{route('setup.updateRecipient')}}",
                method: "PUT",
                data: requestBody,
                beforeSend: function () {
                    $('#add_recipient_spinner').show();
                },
                success: function (res) {
                    $('#add_recipient_spinner').hide();
                    let findNoEmailClass = $('div').find(`[data-key='${support_ticket_key}']`).parent().siblings('.data-list')
                    if (findNoEmailClass.children('.no-email').length > 0) {
                        findNoEmailClass.empty()
                    }

                    let html = '<div>\
                            <div class="users-email d-flex">\
                                <p class="">' + res.data.first_name + ' ' + res.data.last_name + ' (' + res.data.email + ')</p>\
                                <button type="button" class="btn p-0 ps-3 ms-auto cancel-btn">x</button>\
                            </div>\
                        </div>';

                    $('#' + support_ticket_key + '_list').append(html);
                    $('#flashMessages').html(
                        `<div class="alert alert-success">
                            <img class="alert-img" src="{{asset('assets/icons/success-alert-icon.png')}}" alt="">
                            <p class="alert-text">${res.message}</p></div>`
                    )
                    $("input[name='first_name']").val('');
                    $("input[name='last_name']").val('');
                    $("input[name='email']").val('');

                    $('#recipientAddModal').modal('hide');

                    setTimeout(function () {
                        window.location.reload();
                    }, 2000);


                },
                error: function (xhr) {
                    // console.log($(this))
                    // $('#recipientAddModal').modal('show');
                    // $('#add-recipient').prop('disabled', false);
                    $.each(xhr.responseJSON.errors, function (key, value) {
                        $('#user-' + key).text(value);
                    });
                    // alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
                }
            });

            // $('#recipientAddModal').modal('hide');
        });

        $(document).on('click', '.recipient-add-modal-btn', function () {
            // console.log($(this).parent().parent().siblings('.data-div').children('.category-name').data('key'));
            console.log($(this).parent().parent().siblings('.data-div').children('.category-id').data('key'));
            let support_ticket_key = $(this).parent().parent().siblings('.data-div').children('.category-name').data('key');
            let support_ticket_category_id = $(this).parent().parent().siblings('.data-div').children('.category-name').data('id');

            $("input[name='support_ticket_key']").val(support_ticket_key);
            $("input[name='support_ticket_category_id']").val(support_ticket_category_id);
        });

        function deleteRecipient(e) {
            let url = 'setup/' + e.id + '/remove-recipient'
            $.ajax({
                url: url,
                success: function (res) {
                    $('#flashMessages').html(
                        `<div class="alert alert-success">
                            <img class="alert-img" src="{{asset('assets/icons/success-alert-icon.png')}}" alt="">
                            <p class="alert-text">${res.message}</p></div>`
                    )
                    setTimeout(function () {
                        window.location.reload();
                    }, 2000);
                }
            });


        }


        // FAQ TAV
        $('#create-faq-modal-btn').on('click', function (e) {
            $('.create_category_id').text('');
            $('#create_category_id').removeClass('is-invalid');
            $('.create_question').text('');
            $('#create_question').removeClass('is-invalid');
            $('.create_answer').text('');
            $('#create_answer').removeClass('is-invalid');
        });
        $('#add-faq').on('click', function (e) {
            $('.create_category_id').text('');
            $('#create_category_id').removeClass('is-invalid');
            $('.create_question').text('');
            $('#create_question').removeClass('is-invalid');
            $('.create_answer').text('');
            $('#create_answer').removeClass('is-invalid');
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "{{route('setup.faq.store')}}",
                data: $('#create-faq-form').serialize(),
                dataType: 'json',
                beforeSend: function () {
                    $('#add-faq').prop('disabled', true);
                    $('#create_faq_spinner').show();
                },
                success: function (data) {
                    $('#create_faq_spinner').hide();
                    $("#faqCreateModal").modal('hide');
                    $('#flashMessages').html(
                        `<div class="alert alert-success">
                            <img class="alert-img" src="{{asset('assets/icons/success-alert-icon.png')}}" alt="">
                            <p class="alert-text">${data.success}</p></div>`
                    );
                    setTimeout(function () {
                        window.location.reload();
                    }, 2000);
                },
                error: function (error) {
                    // console.log($(this))
                    $('#add-faq').prop('disabled', false);
                    // $("#loadingDiv").hide();
                    $.each(error.responseJSON.errors, function (key, value) {
                        $('.create_' + key).text(value);
                        $('#create_' + key).addClass('is-invalid');
                    });
                    // alert('Request Status: ' + error.status + ' Status Text: ' + error.statusText + ' ' + error.responseText);
                }
            });
        });
        $('body').on('click', '.edit-faq-button', function (e) {
            e.preventDefault();
            let id = $(this).data('id');
            let url = '{{route('setup.faq.show', ':id')}}';
            url = url.replace(':id', id);

            let action = '{{route('setup.faq.update', ':id')}}';
            action = action.replace(':id', id);


            $.ajax({
                url: url,
                dataType: 'json',
                success: function (response) {
                    console.log(response)
                    $('#edit_question').empty().val(response.data.question).removeClass('is-invalid');
                    $('#edit_answer').empty().val(response.data.answer).removeClass('is-invalid');
                    $("#edit_category_id").val(response.data.category_id).change().removeClass('is-invalid');

                    $('.edit_category_id').text('');
                    $('.edit_question').text('');
                    $('.edit_answer').text('');

                    $('#edit-faq-form').attr('action', action);
                    $('#faqEditModal').modal('show')

                }
            });

        });

        $('#update-faq').on('click', function (e) {
            e.preventDefault();

            $.ajax({
                type: "PUT",
                url: $('#edit-faq-form').attr('action'),
                data: $('#edit-faq-form').serialize(),
                dataType: 'json',
                beforeSend: function () {
                    $('#edit-faq').prop('disabled', true);
                    $('#update_faq_spinner').show();

                },
                success: function (data) {
                    $('#update_faq_spinner').hide();
                    $("#faqEditModal").modal('hide');
                    $('#flashMessages').html(
                        `<div class="alert alert-success">
                            <img class="alert-img" src="{{asset('assets/icons/success-alert-icon.png')}}" alt="">
                            <p class="alert-text">${data.message}</p></div>`
                    );
                    setTimeout(function () {
                        window.location.reload();
                    }, 2000);
                },
                error: function (error) {
                    // console.log($(this))
                    $('#edit-faq').prop('disabled', false);
                    // $("#loadingDiv").hide();
                    $.each(error.responseJSON.errors, function (key, value) {
                        $('.edit_' + key).text(value);
                        $('#edit_' + key).addClass('is-invalid');
                    });
                    // alert('Request Status: ' + error.status + ' Status Text: ' + error.statusText + ' ' + error.responseText);
                }
            });
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function deleteYes(data) {
            // console.log('delete URL');console.log($(data).data('url'));return;

            $.ajax({
                url: $(data).data('url'),
                method: 'DELETE',
                dataType: 'json',
                success: function (res) {
                    console.log('success');
                    console.log(res)
                    let modal = "#faqDeleteModal" + $(data).data('id')
                    $(modal).modal('hide');
                    $("html, body").animate({scrollTop: 0});
                    if (res.success == '1') {
                        $('#flashMessages').html(
                            `<div class="alert alert-success">
                            <img class="alert-img" src="{{asset('assets/icons/success-alert-icon.png')}}" alt="">
                            <p class="alert-text">${res.message}</p></div>`
                        )
                        setTimeout(function () {
                            window.location.reload();
                        }, 2000);
                    } else {
                        $('#flashMessages').html(
                            `<div class="alert alert-success">
                            <img class="alert-img" src="{{asset('assets/icons/mailbody-!.png')}}" alt="">
                            <p class="alert-text">${res.message}</p></div>`
                        )
                    }
                    $('#userDeleteModal').modal('hide')
                }
            });
        }


        function domLoad(item) {
            // console.log(item)
            let wrapper = "#faq_table";
            let faqTable = '';
            if(item.data.length > 0){
                $.map(item.data, function (value, i) {
                    // console.log(value.category)

                    let deleteUrl = "{{ route('setup.faq.delete', ':id') }}"
                    deleteUrl = deleteUrl.replace(':id', value.id)

                    faqTable += `<div class="faqs row g-0">
                    <div class="col-2 col-md-2 checkbox-div">
                        <span>${value.category.name}</span>
                    </div>
                    <div class="col-4 col-md-4 data-div">
                        <p class="">${value.question}</p>
                    </div>
                    <div class="col-4 col-md-4 data-div">
                        <p class="">${value.answer}</p>
                    </div>
                    <div class="col-2 col-md-2 action-div">
                        <a href="#" class="action-buttons edit-faq-button" data-id="${value.id}" data-bs-toggle="modal">Edit</a>
                        <a href="" class="action-buttons delete-btn" data-bs-toggle="modal"
                           data-bs-target="#faqDeleteModal${value.id}">Delete</a>
                        <div class="modal fade" id="faqDeleteModal${value.id}" data-bs-backdrop="static"
                             data-bs-keyboard="false" tabindex="-1"
                             aria-labelledby="faqDeleteModalLabel" aria-hidden="true">
                            <div class="modal-dialog faq-delete-modal">
                                <div class="modal-content">
                                    <div class="faq-delete-modal-body">
                                        <p class="text-center">Confirm Delete</p>
                                        <div class="text-center">
                                            <button type="button"
                                                    class="btn btn-sm faq-delete-modal-close-btn"
                                                    data-bs-dismiss="modal" aria-label="No">No
                                            </button>
                                            <button type="button"
                                                    class="btn btn-sm yes-btn" data-id="${value.id}"
                                                    data-url=${deleteUrl}  onclick="deleteYes(this)">Yes
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>`
                });
            }else{
                faqTable += `<div class="faqs row g-0">
                    <div class="col-12 col-md-12 text-center checkbox-div">
                        <span class="text-danger">No Data Available</span>
                    </div>`
            }
            $(wrapper).empty();
            $(wrapper).append(faqTable)
        }

        let faqURL = "setup/faq";

        function fetch_data(page) {
            console.log($('#category_id').find(":selected").val())
            let searchURI ='';
            let catURI ='';
            if ($("#faq-search").val().length > 0) {
                searchURI = '&search=' + encodeURIComponent($("#faq-search").val())
            }
            if ($('#category_id').val() !== '') {
                catURI = '&category_id=' + $('#category_id').find(":selected").val()
            }
            let faqURLPage = faqURL +'?'+'page=' + page + catURI +searchURI;
            // let faqURLPage = faqURL + '?page=' + page;
            // let wrapper = "#faq_table";
            console.log(faqURLPage)
            $.ajax({
                url: faqURLPage,
                dataType: 'json',
                success: function (res) {
                    console.log(res);
                    determinePaginationArrow(res)

                    $('.pagination-left-number').text(res.current_page);
                    $('.pagination-right-number').text(res.last_page);
                    $(".pagination-part .left-arrow").attr('data-href', res.prev_page_url);
                    $(".pagination-part .right-arrow").attr('data-href', res.next_page_url);
                    domLoad(res);
                    // ticketStatus()
                },
                error: function (request) {
                    alert(request.responseText);
                }
            });
        }

        $('.pagination-part .left-arrow').on('click', function () {
            if ($(this).attr('data-href') != '') {
                var page = $(this).attr('data-href').split('page=')[1];
                if ($('.pagination-part .right-arrow').hasClass('searchFaq') == true) {
                    var page = $(this).attr('data-href').split('page=')[1];
                    console.log(page)

                }
                if ($('.pagination-part .right-arrow').hasClass('filterFaq') == true) {
                    var page = $(this).attr('data-href').split('page=')[1];
                    console.log(page)

                }



                // if($('.pagination-part .left-arrow').hasClass('getMailByCategory') == true){
                //     let category=$(this).attr('data-href').split('?')[0].split('/')[5]
                //     url="mail/get-mail-by-category/"+category+"?page="
                // }
                // if($('.pagination-part .left-arrow').hasClass('getMailByPriority') == true){
                //     let priority=$(this).attr('data-href').split('?')[0].split('/')[5]
                //     url="mail/get-mail-by-priority/"+priority+"?page="
                // }
                // if($('.pagination-part .left-arrow').hasClass('searchMail') == true){
                //     let search=$(this).attr('data-href').split('?')[0].split('/')[5]
                //     url="mail/search-mail/"+search+"?page="
                // }
                fetch_data(page);
            }
        })
        $('.pagination-part .right-arrow').on('click', function () {
            if ($(this).attr('data-href') != '') {
                var page = $(this).attr('data-href').split('page=')[1];
                if ($('.pagination-part .right-arrow').hasClass('searchFaq') == true) {
                    // let search=$(this).attr('data-href').split()
                    // console.log(search)
                    // url="setup/faq?search=&page=2"
                    var page = $(this).attr('data-href').split('page=')[1];
                    console.log(page)

                }
                if ($('.pagination-part .right-arrow').hasClass('filterFaq') == true) {
                    // let search=$(this).attr('data-href').split()
                    // console.log(search)
                    // url="setup/faq?search=&page=2"
                    var page = $(this).attr('data-href').split('page=')[1];
                    console.log(page)

                }


                // if($('.pagination-part .right-arrow').hasClass('getMailByPriority') == true){
                //     let priority=$(this).attr('data-href').split('?')[0].split('/')[5]
                //     url="mail/get-mail-by-priority/"+priority+"?page="
                // }
                // if($('.pagination-part .right-arrow').hasClass('searchMail') == true){
                //     let search=$(this).attr('data-href').split('?')[0].split('/')[5]
                //     url="mail/search-mail/"+search+"?page="
                // }
                fetch_data(page);
            }

        })


        function determinePaginationArrow(res) {
            if (res.current_page > 1) {
                if ($(".pagination-part .left-arrow").hasClass("d-none") == true) {
                    $(".pagination-part .left-arrow").removeClass('d-none')
                }
            } else {
                $(".pagination-part .left-arrow").addClass('d-none')
            }
            if (res.current_page == res.last_page) {
                $(".pagination-part .right-arrow").addClass('d-none')
            } else {
                $(".pagination-part .right-arrow").removeClass('d-none')
            }
        }

        function injectClass(className) {
            $(".pagination-part .right-arrow").addClass(className)
            $(".pagination-part .left-arrow").addClass(className)
        }
        $('.up-search').on('keyup',function () {
            // let wrapper = "#faq_table";
            if (this.value.length == 0){
                loadIndex()
            }
        })
        function loadIndex() {
            // removeClassFromPaginationArrow('searchMail')
            let url = "{{route('setup.faq.index')}}"
            let category_id=$('#category_id').find(":selected").val()
            $.ajax({
                url: url,
                data:{category_id:category_id},
                dataType: 'json',
                success: function(res) {
                    console.log(res)
                    determinePaginationArrow(res)
                    //
                    $('.pagination-left-number').text(res.current_page)
                    $('.pagination-right-number').text(res.last_page)
                    $(".pagination-part .left-arrow").attr('data-href', res.prev_page_url)
                    $(".pagination-part .right-arrow").attr('data-href', res.next_page_url)
                    domLoad(res)
                }
            });

        }


        function search() {
            //call the function in onclick search icon
            //make a url first
            //call the domLoad() in ajax success
            // let search = $('#faq-search').val();
            let faqURLSearch = faqURL + '?search=' + $('#faq-search').val();
            {{--let faqURLSearch = '{{route('faq.search', ':search')}}';--}}
            // faqURLSearch= faqURLSearch.replace(':search', search)
            // console.log(faqURLSearch)
            $.ajax({
                url: faqURLSearch,
                dataType: 'json',
                success: function (res) {
                    console.log(res)
                    determinePaginationArrow(res) //don't remove
                    injectClass('searchFaq')
                    $('.pagination-left-number').text(res.current_page) //don't remove
                    $('.pagination-right-number').text(res.last_page) //don't remove
                    $(".pagination-part .left-arrow").attr('data-href', res.prev_page_url) //don't remove
                    $(".pagination-part .right-arrow").attr('data-href', res.next_page_url) //don't remove
                    domLoad(res)
                },
                error: function (request) {
                    alert(request.responseText);
                }
            });
        }

        $('#category_id').on('change', function () {
            // removeClassFromPaginationArrow('filterByDesignation')
            // removeClassFromPaginationArrow('searchFaq')
            // let category= $('#category_id').find(":selected").val()
            injectClass('filterFaq')
            let page=1
           fetch_data(page)
        })

        $('#create-faq-modal-btn').on('click', function () {
            $('#create_category_id').val('')
            $('#create_question').val('')
            $('#create_answer').val('')
        })


    </script>
@endpush
