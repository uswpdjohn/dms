@extends('layouts.master')
@section('content')

    <!-- Main Body Start -->
    <div class="row main-body g-0" id="main">
        @if(session()->has('success'))
            <div class="alert alert-success">
                <img class="alert-img" src="{{asset('assets/icons/success-alert-icon.png')}}" alt="">
                <p class="alert-text">{{session('success')}}</p>
            </div>
        @endif
        @if(session()->has('error'))
            <div class="alert alert-success">
                <img class="alert-img" src="{{asset('assets/icons/mailbody-!.png')}}" alt="">
                <p class="alert-text">{{session('error')}}</p>
            </div>
        @endif
        <div id="flashMessages"></div>

            <div class="admin-company-management-edit-top-portion row g-0">

                <form action="{{route('company.update', $response->slug)}}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
{{--                    @if($errors->any())--}}
{{--                        {{ implode('', $errors->all('<div>:message</div>')) }}--}}

{{--                    @endif--}}
                    <div class="card">
                    <div class="card-body row">

                        <div class="col-12 col-md-3 col-lg-3 col-xl-2 col-xxl-1">
                            <!-- file uploader -->
                            <div class="upload-inner">
                                <div class="company-upload-container">
                                    <div class="upload-icon">
                                        <i class="fa-thin fa-plus"></i>
                                        <span>Upload</span>
                                    </div>
                                    <input type="file" name="image" accept=".jpg, .png, .jpeg, .jfif, .svg" id="upload-file" class="upload-input" />
                                    <div class="img-preview-container"></div>
                                </div>
                            </div>
    {{--                        <span class="text-danger" id="file_type_error"></span>--}}
                            <!-- file uploader -->
                        </div>

                        <div class="col-12 col-md-9 col-lg-9 col-xl-10 col-xxl-11 ps-0 company-data-container">
                            <div class="d-flex company-data-inner">
                                <h5 class="company-name">{{$response->name}}</h5>
                              <input type="text" value="{{$response->id}}" id="company_id" hidden="hidden">
                                <div class="d-flex ms-auto company-data-btns">
                                    <span class="spinner-border spinner-border-sm" id="statusLoadingDiv" role="status" aria-hidden="true" style="margin-top: 8px;margin-right: -24px;"></span>
                                    <button type="button" name="status-btn" class="btn status-btn" data-bs-toggle="modal" data-bs-target="#statusModal">{{ucfirst($response->status)}}</button>
                                    <!-- Status Modal Start -->
                                    <div class="modal fade" id="statusModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true">
                                        <div class="modal-dialog company-exit-modal">
                                            <div class="modal-content">
                                                <div class="company-exit-modal-body">
                                                    <p class="text-center">Confirm Change of status</p>
                                                    <div class="text-center">
                                                        <button type="button" class="btn btn-sm company-exit-modal-close-btn"  data-bs-dismiss="modal" aria-label="No">No</button>
                                                        <button type="button" class="btn btn-sm yes-btn" onclick="changeStatus()">Yes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn save-btn edit-btn">Save</button>
{{--                                @if (auth()->guard('web')->user()->can('index.billing_admin') || auth()->guard('web')->user()->can('create.billing_admin') || auth()->guard('web')->user()->can('edit.billing_admin') || auth()->guard('web')->user()->can('delete.billing_admin'))--}}
{{--                                    <a href="{{route('billing.index')}}" type="button" class="btn billing-btn">Billing</a>--}}
{{--                                @endif--}}
                                <!-- Back button add starts-->
                                <a href="#" type="button" data-bs-toggle="modal" data-bs-target="#companyExitModal" class="btn save-btn">Back</a>
                                <!-- confirm Back Modal Start -->
                                <div class="modal fade" id="companyExitModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="companyExitModalLabel" aria-hidden="true">
                                    <div class="modal-dialog company-exit-modal">
                                        <div class="modal-content">
                                            <div class="company-exit-modal-body">
                                                <p class="text-center">Confirm Exit</p>
                                                <div class="text-center">
                                                    <button type="button" class="btn btn-sm company-exit-modal-close-btn" data-bs-dismiss="modal" aria-label="No">No</button>
                                                    <a href="{{route('company.index')}}"  class="btn btn-sm yes-btn">Yes</a>
{{--                                                        <button onclick="back()" type="button" class="btn btn-sm yes-btn">Yes</button>--}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- confirm Back Modal End -->
                                <!-- Back button add starts-->
{{--                                </div>--}}
                            </div>
                            <label for="" class="company-info-label">UEN</label>
                            <div class="d-flex">
                                <p class="company-info-data mt-2">{{$response->uen}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="admin-company-management-edit-left-card-portion col-12 col-lg-6">
{{--            <form action="{{route('company.update', $response->slug)}}" method="POST">--}}
{{--                @method('PUT')--}}
{{--                @csrf--}}
            <div class="company-info card">
                <div class="card-body row">
                    <div class="col-12">
                        <label for="" class="company-info-label">Business Activity 1</label>
                        <select class="form-control company-info-data select form-select select2" name="primary_industry_service_ssic_id" id="primary_industry_service_ssic_id" required>
                            <option hidden class="first-option" value="">-- Please Select --</option>
                            @foreach($ssics as $ssic)
                                <option value="{{$ssic->id}}" {{$ssic->id == $response->primary_industry_service_ssic_id ? 'selected' : ''}}>{{$ssic->code.' - '.$ssic->title}}</option>
                            @endforeach
                        </select>
                        @error('primary_industry_service_ssic_id')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label for="" class="company-info-label">Business Activity 2</label>
                        <select class="form-control company-info-data select form-select select2" name="secondary_industry_service_ssic_id" id="secondary_industry_service_ssic_id">
                            <option hidden class="first-option" value="">-- Please Select --</option>
                            @foreach($ssics as $ssic)
                                <option value="{{$ssic->id}}" {{$ssic->id == $response->secondary_industry_service_ssic_id ? 'selected' : ''}}>{{$ssic->code.' - '.$ssic->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="" class="company-info-label">Address</label>
                        <input class="form-control company-info-data company-info-last-data" name="address_line" type="text" value="{{$response->address_line}}">
                        @error('address_line')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                </div>
            </div>
            <div class="company-info card">
                <div class="card-body row">
                    @if($response->fye != null)
                        <div class="col-6 col-sm-6 col-md-6 col-lg-6">
                            <label for="" class="company-info-label">FYE</label>
{{--                            <input id="dateInput" class="form-control company-info-data " name="fye" type="date" value="{{\Carbon\Carbon::parse($response->fye)->format('d M')}}">--}}
                            <input id="dateInput" class="form-control company-info-data date-input noTyping" name="fye" type="date" value="{{$response->fye}}">
                            @error('fye')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                    @endif
                    <div class="col-6 col-sm-6 col-md-6 col-lg-6">
                        <label for="" class="company-info-label">Incorporation Date</label>
                        <input class="form-control company-info-data company-info-last-data noTyping" name="incorporation_date" type="date" value="{{$response->incorporation_date}}">
                        @error('incorporation_date')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-6 col-sm-6 col-md-6 col-lg-6">
                        <label for="" class="company-info-label">Last AR Filed</label>
                        <input name="last_ar_filed" class="form-control company-info-data company-info-last-data noTyping" type="date" value="{{$response->last_ar_filed != null ? $response->last_ar_filed : ''}}">
                    </div>
                    <div class="col-6 col-sm-6 col-md-6 col-lg-6">
                        <label for="" class="company-info-label">Last AGM Filed</label>
{{--                        <input name="last_agm_filed" class="date-input form-control company-info-data noTyping" type="date" value="{{$response->last_agm_filed != null ? $response->last_agm_filed : ''}}">--}}
                        <input name="last_agm_filed" class="form-control company-info-data noTyping" type="date" value="{{$response->last_agm_filed != null ? $response->last_agm_filed : ''}}">

                    </div>

                </div>
            </div>
            <button type="submit" class="btn edit-company" hidden="hidden">Send</button>
            </form>
        <div class="user-card card">
            <div class="card-body">
                <div class="d-flex">
                    <h6 class="users-header">Users</h6>
                    <a href="#" class="user-create-modal-btn"  data-bs-toggle="modal" data-bs-target="#userCreateModal"><img src="{{asset('assets/icons/add-button-icon.png')}}" alt=""></a>
                </div>
                <!-- User Create Modal Start -->
                <div class="modal fade" id="userCreateModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="userCreateModalLabel" aria-hidden="true">
                    <div class="modal-dialog user-create-modal">
                        <div class="modal-content">
                            <div class="user-create-modal-body">
                                <div class="user-create-modal-header row">
                                    <h5 class="modal-title col-11" id="userCreateModalLabel">Create New User</h5>
                                    <button type="button" class="btn btn-close btn-sm user-create-modal-close-btn col-1"  data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="user-create-modal-data row">
                                    <form action="" method="POST" id="user_create">
                                        <meta name="csrf-token" content="{{ csrf_token() }}" />
                                        <input type="text" name="role" value="Company User" readonly hidden="hidden">
                                        {{--new--}}
                                        <input type="text" value="" name="user_type" id="user_type" readonly hidden="hidden">
                                        <input type="text" id="company_id" name="company_id" value="{{$response->id}}" readonly hidden="hidden">
                                        <div class="data-body row">
{{--                                            <div class="data-row col-12 col-md-6">--}}
                                            <div class="data-row col-12 col-md-12">
                                                <label for=""><span class="required-sign">*</span>Name</label>
                                                <input type="text" class="form-control first_name" name="first_name" id="firstName" placeholder="Name" required>
                                                <span class="text-danger company-user-first_name"></span>
                                            </div>

{{--                                            <div class="data-row col-12 col-md-6">--}}
{{--                                                <label for=""><span class="required-sign">*</span>Last Name</label>--}}
{{--                                                <input type="text" class="form-control last_name" name="last_name" id="name" placeholder="Last Name" required>--}}
{{--                                                <span class="text-danger company-user-last_name"></span>--}}
{{--                                            </div>--}}
                                            <div class="data-row col-12">
                                                <label for=""><span class="required-sign">*</span>Email Address</label>
                                                <input type="email" class="form-control email" name="email" id="address" placeholder="Email Address" required>
                                                <span class="text-danger company-user-email"></span>
                                            </div>

                                            <div class="data-row col-12 text-end">
                                                <button type="button" onclick="determineButtonId(this.id)" id="user_submit" class="create-user-btn btn"><div id="userLoadingDiv"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></div>Create</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- User Create Modal End -->
                @forelse ($response->users as $user)
                    <form action="">
                        <div class="users d-flex">
                            <p class="">{{$user->full_name.' ('. $user->email.')'}}</p>
                                <meta name="csrf-token" content="{{ csrf_token() }}">
                                <button type="button" onclick="userDelete(this)" id="{{$user->id}}" name="user" data-id="user"  class="btn p-0 ps-3 ms-auto cancel-btn">x</button>
                        </div>
                    </form>
                @empty
                    <div class="users d-flex">
                        <p>No User Found</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

{{--        </form>--}}
        <div class="admin-company-management-edit-right-card-portion col-12 col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <h6 class="director-header">Directors</h6>
                        <a href="#" class="director-create-modal-btn"  data-bs-toggle="modal" data-bs-target="#directorCreateModal"><img src="{{asset('assets/icons/add-button-icon.png')}}" alt=""></a>
                    </div>
                    <!-- Director Create Modal Start -->
                    <div class="modal fade" id="directorCreateModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="directorCreateModalLabel" aria-hidden="true">
                        <div class="modal-dialog ds-create-modal">
                            <div class="modal-content">
                                <div class="ds-create-modal-body">
                                    <div class="ds-create-modal-header row">
                                        <h5 class="modal-title col-11" id="directorCreateModalLabel">Create New Director</h5>
                                        <button type="button" class="btn btn-close btn-sm ds-create-modal-close-btn col-1"  data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="ds-create-modal-data row">
                                        <form action="#" method="POST" id="director_create">
                                            <meta name="csrf-token" content="{{ csrf_token() }}" />
                                            <input type="text" name="role" value="" readonly hidden="hidden">
                                            <input type="text" value="" name="user_type" id="user_type_director" readonly hidden="hidden">
                                            <input type="text" id="company_id" name="company_id" value="{{$response->id}}" readonly hidden="hidden">
{{--                                            <input type="text" name="user_type" value="director" readonly hidden="hidden">--}}
                                            <div class="data-body row">
{{--                                                <div class="data-row col-12 col-md-6">--}}
                                                <div class="data-row col-12 col-md-12">
{{--                                                    <label for=""><span class="required-sign">*</span>First Name</label>--}}
                                                    <label for=""><span class="required-sign">*</span>Name</label>
                                                    <input type="text" class="form-control first_name" name="first_name"  placeholder="Name" required>
                                                    <span class="text-danger company-director-first_name"></span>
                                                </div>
{{--                                                <div class="data-row col-12 col-md-6">--}}
{{--                                                    <label for=""><span class="required-sign">*</span>Last Name</label>--}}
{{--                                                    <input type="text" class="form-control last_name" name="last_name"  placeholder="Last Name" required>--}}
{{--                                                    <span class="text-danger company-director-last_name"></span>--}}
{{--                                                </div>--}}
                                                <div class="data-row col-12">
                                                    <label for=""><span class="required-sign">*</span>Email Address</label>
                                                    <input type="email" class="form-control email" name="email"  placeholder="Email Address" required>
                                                    <span class="text-danger company-director-email"></span>
                                                </div>
                                                <div class="data-row col-12">
                                                    <label for="">CC #1</label>
                                                    <input type="email" class="form-control ccs" name="ccs[]" placeholder="CC Email Address #1" required>
                                                </div>
                                                <div class="data-row col-12">
                                                    <label for="">CC #2</label>
                                                    <input type="email" class="form-control ccs" name="ccs[]" placeholder="CC Email Address #2" required>
                                                </div>
                                                <div class="data-row col-12">
                                                    <label for="">CC #3</label>
                                                    <input type="email" class="form-control ccs" name="ccs[]" placeholder="CC Email Address #3" required>
                                                    <span class="text-danger company-director-ccs"></span>
                                                </div>

                                                <div class="data-row col-12 text-end">
                                                    <button type="button" onclick="determineButtonId(this.id)" id="director_submit" class="create-ds-btn btn"><div id="directorLoadingDiv"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></div>Create</button>
                                                </div>

                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Director Create Modal End -->
                    @forelse ($response->directors as $key=>$user)
                        <form action="">
                            <meta name="csrf-token" content="{{ csrf_token() }}">
                            <div class="directors d-flex">
                                <div>
                                    <p>{{$user->full_name.' ('. $user->email.')'}}</p>
                                    @foreach($user->ccs as $cc)
                                        @if($cc != null)
                                        <p>cc: {{$cc}}</p>
                                        @endif
                                    @endforeach
                                </div>
                                <div class="button-sec">
                                    <button type="button" onclick="userDelete(this)" id="{{$user->id}}" name="company_user" data-id="director"  class="btn p-0 ps-3 ms-auto cancel-btn">x</button>
                                    <button type="button" class="btn p-0 ps-3 ms-auto dir-shr-edit-btn" onclick="fetchDirectorEditData(this)" data-key="{{$key}}" data-company="{{$response->slug}}" id="{{$user->id}}"  data-bs-toggle="modal" data-bs-target="#directorEditModal-{{$user->id}}"><i class="fa-regular fa-pen-to-square"></i></button>
                                </div>
                                {{-- edit new--}}
                            </div>
                        </form>
                        <!-- Director Edit Modal Start -->
                        <div class="modal fade" id="directorEditModal-{{$user->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="directorCreateModalLabel" aria-hidden="true">
                            <div class="modal-dialog ds-create-modal">
                                <div class="modal-content">
                                    <div class="ds-create-modal-body">
                                        <div class="ds-create-modal-header row">
                                            <h5 class="modal-title col-11" id="directorEditModalLabel">Edit Director</h5>
                                            <button type="button" class="btn btn-close btn-sm ds-create-modal-close-btn col-1" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="ds-create-modal-data row">
                                            <form action="#" method="POST" id="director_edit_submit_form_{{$user->slug}}">
                                                @method('PUT')
                                                @csrf
                                                <input type="text" name="company_slug" value="{{$response->slug}}" hidden="hidden">
                                                <input type="text" name="user_type" value="director" hidden="hidden">

                                                <div class="data-body row">
{{--                                                    <div class="data-row col-12 col-md-6">--}}
                                                    <div class="data-row col-12 col-md-12">
{{--                                                        <label for=""><span class="required-sign">*</span>First Name</label>--}}
                                                        <label for=""><span class="required-sign">*</span>Name</label>
                                                        <input type="text" class="form-control first_name" value="" name="first_name"  placeholder="First Name" id="edit_director_first_name_{{$user->id}}" required>
                                                        <span class="text-danger director-edit-first_name"></span>
                                                    </div>
{{--                                                    <div class="data-row col-12 col-md-6">--}}
{{--                                                        <label for=""><span class="required-sign">*</span>Last Name</label>--}}
{{--                                                        <input type="text" class="form-control last_name" value="" name="last_name" id="edit_director_last_name_{{$user->id}}"  placeholder="Last Name" required>--}}
{{--                                                        <span class="text-danger director-edit-last_name"></span>--}}
{{--                                                    </div>--}}
                                                    <div class="data-row col-12">
                                                        <label for=""><span class="required-sign">*</span>Email Address</label>
                                                        <input type="email" class="form-control email" value="" name="email" id="edit_director_email_{{$user->id}}"  placeholder="Email Address" required>
                                                        <span class="text-danger director-edit-email"></span>
                                                    </div>
                                                    <div class="data-row col-12">
                                                        <label for="">CC #1</label>
                                                        <input type="email" class="form-control ccs" value="" name="ccs[]" id="edit_director_cc1_{{$user->id}}" placeholder="CC Email Address #1" >
                                                    </div>
                                                    <div class="data-row col-12">
                                                        <label for="">CC #2</label>
                                                        <input type="email" class="form-control ccs" value="" name="ccs[]"  id="edit_director_cc2_{{$user->id}}" placeholder="CC Email Address #2" >
                                                    </div>
                                                    <div class="data-row col-12">
                                                        <label for="">CC #3</label>
                                                        <input type="email" class="form-control ccs" value="" name="ccs[]" id="edit_director_cc3_{{$user->id}}" placeholder="CC Email Address #3" >
                                                        <span class="text-danger company-director-ccs"></span>
                                                    </div>
                                                    <div class="data-row col-12 text-end">
                                                        <button type="submit" onclick="updateCCEmails(this)" data-userType="director" data-slug="{{$user->slug}}" id="edit_director_submit_{{$user->slug}}" class="create-ds-btn btn">Update</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Director Edit Modal End -->
                    @empty
                        <div class="directors d-flex">
                            <p>No Director Found</p>
                        </div>
                    @endforelse
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <h6 class="shareholder-header">Shareholders</h6>
                        <a href="#" class="shareholder-create-modal-btn"  data-bs-toggle="modal" data-bs-target="#shareholderCreateModal"><img src="{{asset('assets/icons/add-button-icon.png')}}" alt=""></a>
                    </div>
                    <!-- Shareholder Create Modal Start -->
                    <div class="modal fade" id="shareholderCreateModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="shareholderCreateModalLabel" aria-hidden="true">
                        <div class="modal-dialog ds-create-modal">
                            <div class="modal-content">
                                <div class="ds-create-modal-body">
                                    <div class="ds-create-modal-header row">
                                        <h5 class="modal-title col-11" id="shareholderCreateModalLabel">Create New Shareholder</h5>
                                        <button type="button" class="btn btn-close btn-sm ds-create-modal-close-btn col-1"  data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="ds-create-modal-data row">
                                        <form action="" method="POST" id="shareholder_create">
                                            <meta name="csrf-token" content="{{ csrf_token() }}" />
                                            <input type="text" name="role" value="" readonly hidden="hidden">
                                            <input type="text" value="" name="user_type" id="user_type_shareholder" readonly hidden="hidden">
                                            <input type="text" id="company_id" name="company_id" value="{{$response->id}}" readonly hidden="hidden">
{{--                                            <input type="text" name="user_type" value="shareholder" readonly hidden="hidden">--}}
                                            <div class="data-body row">
{{--                                                <div class="data-row col-12 col-md-6">--}}
                                                <div class="data-row col-12 col-md-12">
{{--                                                    <label for=""><span class="required-sign">*</span>First Name</label>--}}
                                                    <label for=""><span class="required-sign">*</span>Name</label>
                                                    <input type="text" class="form-control first_name" name="first_name" placeholder="Name" >
                                                    <span class="text-danger company-shareholder-first_name"></span>
                                                </div>
{{--                                                <div class="data-row col-12 col-md-6">--}}
{{--                                                    <label for=""><span class="required-sign">*</span>Last Name</label>--}}
{{--                                                    <input type="text" class="form-control last_name" name="last_name"  placeholder="Last Name" required>--}}
{{--                                                    <span class="text-danger company-shareholder-last_name"></span>--}}
{{--                                                </div>--}}
                                                <div class="data-row col-12">
                                                    <label for=""><span class="required-sign">*</span>Email Address</label>
                                                    <input type="email" class="form-control email" name="email" placeholder="Email Address" >
                                                    <span class="text-danger company-shareholder-email"></span>
                                                </div>
                                                <div class="data-row col-12">
                                                    <label for="">CC #1</label>
                                                    <input type="email" class="form-control ccs" name="ccs[]" placeholder="CC Email Address #1" >
                                                </div>
                                                <div class="data-row col-12">
                                                    <label for="">CC #2</label>
                                                    <input type="email" class="form-control ccs" name="ccs[]" placeholder="CC Email Address #2" >
                                                </div>
                                                <div class="data-row col-12">
                                                    <label for="">CC #3</label>
                                                    <input type="email" class="form-control ccs" name="ccs[]" placeholder="CC Email Address #3" >
                                                    <span class="text-danger company-shareholder-ccs"></span>
                                                </div>

                                                <div class="data-row col-12 text-end">
                                                    <button type="button" onclick="determineButtonId(this.id)" id="shareholder_submit" class="create-ds-btn btn"><div id="shareholderLoadingDiv"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></div>Create</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- Shareholder Create Modal End -->
                    @forelse ($response->shareholders as $key=>$user)
                        <form action="">
                            <meta name="csrf-token" content="{{ csrf_token() }}">
                            <div class="shareholders d-flex">
                                <div>
                                    <p>{{$user->full_name.' ('. $user->email.')'}}</p>
                                    @foreach($user->ccs as $cc)
                                        @if($cc != Null)
                                        <p>cc: {{$cc}}</p>
                                        @endif
                                    @endforeach
                                </div>
                                <div class="button-sec">
                                    <button type="button" onclick="userDelete(this)" id="{{$user->id}}" name="company_user" data-id="shareholder" class="btn p-0 ps-3 ms-auto cancel-btn">x</button>
                                    <button type="button" class="btn p-0 ps-3 ms-auto dir-shr-edit-btn" onclick="fetchShareholderEditData(this)" data-key="{{$key}}" data-company="{{$response->slug}}" id="{{$user->id}}"  data-bs-toggle="modal" data-bs-target="#shareholderEditModal-{{$user->id}}"><i class="fa-regular fa-pen-to-square"></i></button>
                                </div>
                            </div>
                        </form>
                        <!-- Shareholder Edit Modal Start -->
                        <div class="modal fade" id="shareholderEditModal-{{$user->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="shareholderCreateModalLabel" aria-hidden="true">
                            <div class="modal-dialog ds-create-modal">
                                <div class="modal-content">
                                    <div class="ds-create-modal-body">
                                        <div class="ds-create-modal-header row">
                                            <h5 class="modal-title col-11" id="shareholderEditModalLabel">Edit Shareholder</h5>
                                            <button type="button" class="btn btn-close btn-sm ds-create-modal-close-btn col-1" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="ds-create-modal-data row">
                                            <form action="#" method="POST" id="shareholder_edit_submit_form_{{$user->slug}}">
                                                @method('PUT')
                                                @csrf
                                                <input type="text" name="company_slug" value="{{$response->slug}}" hidden="hidden">
                                                <input type="text" name="user_type" value="shareholder" hidden="hidden">
                                                <div class="data-body row">
{{--                                                    <div class="data-row col-12 col-md-6">--}}
                                                    <div class="data-row col-12 col-md-12">
{{--                                                        <label for=""><span class="required-sign">*</span>First Name</label>--}}
                                                        <label for=""><span class="required-sign">*</span>Name</label>
                                                        <input type="text" class="form-control first_name" value="" name="first_name"  placeholder="First Name" id="edit_shareholder_first_name_{{$user->id}}" required>
                                                        <span class="text-danger shareholder-edit-first_name"></span>
                                                    </div>
{{--                                                    <div class="data-row col-12 col-md-6">--}}
{{--                                                        <label for=""><span class="required-sign">*</span>Last Name</label>--}}
{{--                                                        <input type="text" class="form-control last_name" value="" name="last_name" id="edit_shareholder_last_name_{{$user->id}}"  placeholder="Last Name" required>--}}
{{--                                                        <span class="text-danger shareholder-edit-last_name"></span>--}}
{{--                                                    </div>--}}
                                                    <div class="data-row col-12">
                                                        <label for=""><span class="required-sign">*</span>Email Address</label>
                                                        <input type="email" class="form-control email" value="" name="email" id="edit_shareholder_email_{{$user->id}}"  placeholder="Email Address" required>
                                                        <span class="text-danger shareholder-edit-email"></span>
                                                    </div>
                                                    <div class="data-row col-12">
                                                        <label for="">CC #1</label>
                                                        <input type="email" class="form-control ccs" value="" name="ccs[]" id="edit_shareholder_cc1_{{$user->id}}" placeholder="CC Email Address #1" >
                                                    </div>
                                                    <div class="data-row col-12">
                                                        <label for="">CC #2</label>
                                                        <input type="email" class="form-control ccs" value="" name="ccs[]"  id="edit_shareholder_cc2_{{$user->id}}" placeholder="CC Email Address #2" >
                                                    </div>
                                                    <div class="data-row col-12">
                                                        <label for="">CC #3</label>
                                                        <input type="email" class="form-control ccs" value="" name="ccs[]" id="edit_shareholder_cc3_{{$user->id}}" placeholder="CC Email Address #3" >
                                                        <span class="text-danger company-director-ccs"></span>
                                                    </div>
                                                    <div class="data-row col-12 text-end">
                                                        <button type="submit" onclick="updateCCEmails(this)" data-userType="shareholder" data-slug="{{$user->slug}}" id="edit_shareholder_submit_{{$user->slug}}" class="create-ds-btn btn">Update</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Director Edit Modal End -->
                    @empty
                        <div class="shareholders d-flex">
                            <p>No Shareholder Found</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    <!-- Main Body End -->
@endsection
@push('customScripts')
    <script>
        //Restricting users from typing in date field
        document.querySelectorAll(".noTyping").forEach(el=>{
            el.addEventListener("keydown", function(e){
                e.preventDefault()
            })
        })

        let key=''

        function fetchDirectorEditData(e){
            let fullName=''
            let companySlug=e.getAttribute('data-company')
            let directorId = e.getAttribute('id')
            key = e.getAttribute('data-key')

            let url= '{{route('company.getDirectorForEdit', ':slug')}}'
            url = url.replace(':slug', companySlug)
            $.ajax({
                type: "GET",
                url: url,
                success: function(data) {
                    $.map(data.directors, function (item) {
                        if(item.id == directorId){
                            fullName=item.first_name+' '+ (item.last_name != null ? item.last_name : '')
                            // $('#edit_director_first_name_'+item.id).attr('value',item.first_name)
                            $('#edit_director_first_name_'+item.id).attr('value',fullName)
                            $('#edit_director_first_name_'+item.id).attr('disabled','disabled')
                            $('#edit_director_last_name_'+item.id).attr('value',item.last_name)
                            $('#edit_director_last_name_'+item.id).attr('disabled','disabled')
                            $('#edit_director_email_'+item.id).val(item.email)
                            $('#edit_director_email_'+item.id).attr('disabled','disabled')
                            $('#edit_director_cc1_'+item.id).attr('value',item.ccs[0])
                            $('#edit_director_cc2_'+item.id).attr('value',item.ccs[1])
                            $('#edit_director_cc3_'+item.id).attr('value',item.ccs[2])
                        }

                    });
                },
                error: function(xhr){
                    $('#flashMessages').html(
                        `<div class="alert alert-success alert-access">
                            <img class="alert-img" src="{{asset('assets/icons/mailbody-!.png')}}" alt="">
                            <p class="alert-text">Something went wrong!</p></div>`
                    )
                    // alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
                }
            });
        }
        function fetchShareholderEditData(e){
            let fullName=''
            let companySlug=e.getAttribute('data-company')
            let shareholderId = e.getAttribute('id')
            console.log(shareholderId)
            key = e.getAttribute('data-key')
            // $("#editDirectorLoadingDiv"+key).hide()

            let url= '{{route('company.getShareholderForEdit', ':slug')}}'
            url = url.replace(':slug', companySlug)
            console.log(url)
            $.ajax({
                type: "GET",
                url: url,
                success: function(data) {
                    $.map(data.shareholders, function (item) {
                        fullName=item.first_name+' '+ (item.last_name != null ? item.last_name : '')
                        if(item.id == shareholderId){
                            // $('#edit_shareholder_first_name_'+item.id).attr('value',item.first_name)
                            $('#edit_shareholder_first_name_'+item.id).attr('value',fullName)
                            $('#edit_shareholder_first_name_'+item.id).attr('readonly',true)
                            $('#edit_shareholder_last_name_'+item.id).attr('value',item.last_name)
                            $('#edit_shareholder_last_name_'+item.id).attr('disabled','disabled')
                            $('#edit_shareholder_email_'+item.id).val(item.email)
                            $('#edit_shareholder_email_'+item.id).attr('disabled','disabled')
                            $('#edit_shareholder_cc1_'+item.id).attr('value',item.ccs[0])
                            $('#edit_shareholder_cc2_'+item.id).attr('value',item.ccs[1])
                            $('#edit_shareholder_cc3_'+item.id).attr('value',item.ccs[2])
                        }

                    });
                },
                error: function(xhr){
                    $('#flashMessages').html(
                        `<div class="alert alert-success alert-access">
                            <img class="alert-img" src="{{asset('assets/icons/mailbody-!.png')}}" alt="">
                            <p class="alert-text">Something went wrong!</p></div>`
                    )
                    // alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
                }
            });
        }
        function updateCCEmails(e) {
            // let buttonId= e.getAttribute('id')
            let userType=e.getAttribute('data-userType')
            let slug= e.getAttribute('data-slug')
            let directorFormId = '#director_edit_submit_form_'+slug
            let shareholderFormId = '#shareholder_edit_submit_form_'+slug
            // console.log($(formId).getAttribute('data-test'))

            let url= '{{route('company-management.update', ':slug')}}'
            url= url.replace(':slug', slug)
            if(userType == 'director'){
                $(directorFormId).attr('action', url)
            }else if(userType == 'shareholder'){
                $(shareholderFormId).attr('action', url)
            }
            // $('#'+buttonId).getAttribute('action')

            // var formData = new FormData(form)
            // let form = $(formId)[0];
            // var formData = new FormData(form);
            // var formData = $('#'+formId).serialize();
            // e.preventDefault()
            // console.log(formData)
            {{--$.ajaxSetup({--}}
            {{--    headers: {--}}
            {{--        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
            {{--    },--}}
            {{--});--}}
            {{--$.ajax({--}}
            {{--    url: url,--}}
            {{--    method: "PUT",--}}
            {{--    // data: $('#corp-sec-doc-upload').serialize(),--}}
            {{--    data: $(formId).serialize(),--}}
            {{--    dataType:'json',--}}
            {{--    processData: false,--}}
            {{--    contentType: false,--}}
            {{--    beforeSend: function () {--}}
            {{--        // $("#CorpSecEditLoadingDiv").show();--}}
            {{--    },--}}
            {{--    success: function (data) {--}}
            {{--        console.log(data)--}}
            {{--    },--}}
            {{--    error: function (xhr) {--}}
            {{--        --}}{{--$('#corp-sec-edit-send').prop('disabled', false)--}}
            {{--        --}}{{--$("#CorpSecEditLoadingDiv").hide();--}}
            {{--        // if (xhr.responseJSON.hasOwnProperty('errors') == true) {--}}
            {{--        //     $.each(xhr.responseJSON.errors, function (key, value) {--}}
            {{--        //         $('.director-edit-' + key).text(value);--}}
            {{--        //     });--}}
            {{--        // }--}}
            {{--        // else {--}}
            {{--        --}}{{--    $("html, body").animate({scrollTop: 0});--}}
            {{--        --}}{{--    $('#flashMessages').html(--}}
            {{--        --}}{{--        `<div class="alert alert-success alert-access">--}}
            {{--        --}}{{--            <img class="alert-img" src="{{asset('assets/icons/mailbody-!.png')}}" alt="">--}}
            {{--        --}}{{--            <p class="alert-text">${xhr.responseJSON.message}</p>--}}
            {{--        --}}{{--        </div>`--}}
            {{--        --}}{{--    )--}}
            {{--        --}}{{--}--}}
            {{--        alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);--}}
            {{--    }--}}
            // });
        }



        // $('.director-create-modal-btn').on('click', function () {
        //
        // })
        function back() {
            window.history.go(-1);
            // console.log();
        }


        function clearInputFields() {
            $('.first_name').val(' ')
            $('.last_name').val(' ')
            $('.email').val(' ')
            $('.ccs').val(' ')
            $('.company-user-first_name').text(' ')
            $('.company-user-last_name').text(' ')
            $('.company-user-email').text(' ')
            $('.company-director-first_name').text(' ')
            $('.company-director-last_name').text(' ')
            $('.company-director-email').text(' ')
            $('.company-director-ccs').text(' ')
            $('.company-shareholder-first_name').text(' ')
            $('.company-shareholder-last_name').text(' ')
            $('.company-shareholder-email').text(' ')
            $('.company-shareholder-ccs').text(' ')

        }
        // For Company Image Upload and Preview
        var uploadContainer = document.querySelector('.company-upload-container');
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
        $(document).ready(function() {
            statusCss()
            $(".select2").select2();
            $("#userLoadingDiv").hide()
            $("#directorLoadingDiv").hide()
            $("#shareholderLoadingDiv").hide()
            $("#statusLoadingDiv").hide()
            $("#editDirectorLoadingDiv"+key).hide()

            // $(".select2").select2({
            //     dropdownParent: $('#companyCreateModal'),
            //     // placeholder: "Select",
            //     allowClear: true
            // });
        })
        function handleFiles(files) {
            if(files.length != 0){
                let image = files[0].name
                var fileExtension = ['jpeg', 'jpg', 'png', 'jfif', 'svg'];
                if ($.inArray(image.split('.').pop().toLowerCase(), fileExtension) == -1) {
                    alert("Only formats are allowed : "+fileExtension.join(', '));
                    // $('#file_type_error').text("Only formats are allowed : "+fileExtension.join(', '));
                }
                // else {
                //     $('#image').val(image);
                //     $('#image').attr('disabled', false);
                // }
            }

            previewContainer.innerHTML = '';
            for (let i = 0; i < files.length; i++) {
                var file = files[i];
                var reader = new FileReader();
                reader.onload = function (e) {
                    var previewImage = document.createElement('img');
                    previewImage.classList.add('preview-img');
                    previewImage.src = e.target.result;
                    // var previewName = document.createElement('div');
                    // previewName.classList.add('preview-name');
                    // previewName.textContent = file.name;
                    var previewItem = document.createElement('div');
                    previewItem.classList.add('preview-item');
                    previewItem.appendChild(previewImage);
                    // previewItem.appendChild(previewName);
                    previewContainer.appendChild(previewItem);
                };
                reader.readAsDataURL(file);
            }
        }

        function userDelete(e){
            let company_id = $('#company_id').val();
            let user_type = e.getAttribute('data-id');
            let url = ""
            url='{{route('company.removeUser')}}';
            // url= url.replace(':id', e.id).replace(':company_id',company_id).replace(':user_type',user_type)


            let token =  $("meta[name='csrf-token']").attr("content");
            $.ajax({
                type: "POST",
                url: url,
                data: {
                    'slug':e.id,
                    'company_id':company_id,
                    'user_type':user_type,
                    "_token": token,
                },
                success: function(data) {
                    if (data.success == 1){
                        $("html, body").animate({ scrollTop: 0 });
                        $('#flashMessages').html(
                            `<div class="alert alert-success">
                            <img class="alert-img" src="{{asset('assets/icons/success-alert-icon.png')}}" alt="">
                            <p class="alert-text">${data.message}</p></div>`
                        )
                        setTimeout(function(){
                            window.location.reload();
                        }, 2000);
                    }
                },
                error: function(xhr){
                    $('#flashMessages').html(
                        `<div class="alert alert-success alert-access">
                            <img class="alert-img" src="{{asset('assets/icons/mailbody-!.png')}}" alt="">
                            <p class="alert-text">Something went wrong!</p></div>`
                    )
                    // alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
                }
            });

        }




        let buttonId = ""
        let formId=""
        let user_type=""
        let url=""
        let errorFor=""
        let slug=""

        function determineButtonId(id){
            buttonId = "#"+id
            // console.log()
            // var testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
            // if (testEmail.test($('.ccs').val())){
            //
            //
            //     // alert('passed');
            // } else {
            //     return false;
            //     // alert('failed')
            // }
            if (buttonId == '#user_submit'){
                formId= "#user_create"
                // user_type = 'user'
                user_type = $('#user_type').attr('value', 'user')
                url= "{{route('user.store')}}"
                errorFor='.company-user-'
            }else if(buttonId == '#director_submit'){
                formId= "#director_create"
                // user_type = 'director'
                user_type = $('#user_type_director').attr('value', 'director')
                url= "{{route('company-management.store')}}"
                errorFor='.company-director-'
            }else if(buttonId == '#shareholder_submit'){
                formId= "#shareholder_create"
                // user_type = 'shareholder'
                user_type =  $('#user_type_shareholder').attr('value', 'shareholder')
                url= "{{route('company-management.store')}}"
                errorFor='.company-shareholder-'
            }
            console.log(formId)

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(buttonId).prop('disabled', true);

            $.ajax({
                type: "POST",
                {{--url: "{{route('user.store')}}",--}}
                url: url,
                data: $(formId).serialize(),
                dataType: "json",
                beforeSend: function() {
                    if (buttonId == '#user_submit'){
                        $("#userLoadingDiv").show()
                    }else if(buttonId == '#director_submit'){
                        $("#directorLoadingDiv").show()
                    }else if(buttonId == '#shareholder_submit'){
                        $("#shareholderLoadingDiv").show()
                    }
                },
                success: function(data) {
                    // console.log('user create success ',data);
                    if (buttonId == '#user_submit'){
                        $("#userLoadingDiv").hide()
                    }else if(buttonId == '#director_submit'){
                        $("#directorLoadingDiv").hide()
                    }else if(buttonId == '#shareholder_submit'){
                        $("#shareholderLoadingDiv").hide()
                    }
                    if (data.success == 1){
                        //console.log("data.success ", data.success);
                        $('.user-create-modal-close-btn').click()
                        $('.ds-create-modal-close-btn').click()
                        $("html, body").animate({ scrollTop: 0 });
                        if(data.message == 'User already exists'){
                            $('#flashMessages').html(
                                `<div class="alert alert-success">
                            <img class="alert-img" src="{{asset('assets/icons/mailbody-!.png')}}" alt="">
                            <p class="alert-text">${data.message}</p></div>`
                            )
                        }else{
                            $('#flashMessages').html(
                                `<div class="alert alert-success">
                            <img class="alert-img" src="{{asset('assets/icons/success-alert-icon.png')}}" alt="">
                            <p class="alert-text">${data.message}</p></div>`
                            )
                        }
                        setTimeout(function(){
                            window.location.reload();
                        }, 2000);
                    }
                },
                error: function(xhr){
                    console.log('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
                    $(buttonId).prop('disabled', false);
                    if (buttonId == '#user_submit'){
                        $("#userLoadingDiv").hide()
                    }else if(buttonId == '#director_submit'){
                        $("#directorLoadingDiv").hide()
                    }else if(buttonId == '#shareholder_submit'){
                        $("#shareholderLoadingDiv").hide()
                    }

                    $.each(xhr.responseJSON.errors, function (key, value) {
                        $(errorFor + key).text(value);
                    });
                    // alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
                }
            });

        }
        $('.edit-btn').click(function(){
            $('.edit-company').click();
        })

        //status css
        function statusCss(){
            var docStatus = document.getElementsByName("status-btn");
            var countTickets = docStatus.length;
            for (var i = 0; i < countTickets; i++){
                if(docStatus[i].innerHTML == "Active"){
                    docStatus[i].style.color = "#52C41A";
                    docStatus[i].style.border = "1px solid #52C41A";
                    docStatus[i].style.backgroundColor = "#F4FFE3";
                }

                else if(docStatus[i].innerHTML == "Inactive"){
                    docStatus[i].style.color = "#EB2F96";
                    docStatus[i].style.border = "1px solid #FFADD2";
                    docStatus[i].style.backgroundColor = "#FFF0F6";
                }

            }
        }


        function changeStatus(){
            $('#statusModal').modal('hide')
            let companyId = $('#company_id').val()
            let url = "{{route('company.changeStatus', ':company_id')}}"
                url = url.replace(':company_id', companyId)
            $.ajax({
                type: "GET",
                url: url,
                beforeSend: function() {
                    $("#statusLoadingDiv").show()
                },
                success: function(data) {
                    $("#statusLoadingDiv").hide()
                    $('.status-btn').text(data.charAt(0).toUpperCase() + data.slice(1))
                    statusCss()
                    // setTimeout(function(){
                    //     window.location.reload();
                    // }, 1000);
                },
                error: function(xhr){

                    // alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
                }
            });
        }
    </script>
@endpush
