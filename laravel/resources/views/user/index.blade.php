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
        @if(session()->has('error'))
            <div class="alert alert-success create">
                <img class="alert-img" src={{asset('assets/icons/mailbody-!.png')}} alt="">
                <p class="alert-text error-text">{{session('error')}}</p>
            </div>
        @endif
        <div id="flashMessages"></div>

        <div class="row admin-user-manage-body g-0">
            <div class="col-12 col-md-2 card admin-user-manage-button-card">
                <div class="card-body admin-user-manage-button-body">
                    <div class="tab-buttons">
                        <button class="tablinks adminUserManageTabLinks" id="defaultOpen" onclick="adminUserManageTab(event, 'user')">User</button>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-10 ">
                <div class="card admin-user-manage-card">
                    <div class="card-body admin-user-manage-content-body">

                        <div id="user" class="tabcontent adminUserManageTabContent user">
                            <div class="select-pagination-portion table-top-portion row g-0">
                                <div class="select-part col-6 col-md-3 col-lg-2">
                                    <input type="checkbox" class="select-all-checkbox">
                                    <label for="" class="selected-checkbox-number">Select All</label>
                                </div>
                                <div class="sb-part search-box-part col-6 col-md-3 offset-lg-1 col-lg-4">
{{--                                    <form action="{{route('user.index')}}" method="GET">--}}
                                        <div class="d-flex form-inputs search-data">
                                            <input class="form-control up-search" type="text" id="search-query" name="search" placeholder="example@gmail.com">
                                            <button type="button" class="search-btn btn" id="search-button"><i class="fa-solid fa-search"></i></button>
                                        </div>
{{--                                    </form>--}}
                                </div>
                                <div class="sb-part user-category-select col-6 offset-md-0 col-md-3 col-lg-2">
                                    <select class="form-control form-select nav-select select-data " name="user-designation" id="user-designation">
{{--                                        <option value="">Filter</option>--}}
                                        <option value="all">All</option>
                                        @foreach($designations as $designation)
                                            <option value="{{$designation}}">{{ucwords($designation)}}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="button-part col-6 col-md-3 col-lg-3">
{{--                                    <button type="button" class="btn delete-btn action-buttons " data-bs-toggle="modal" data-bs-target="#userDeleteModal" onclick="deleteBulkUser()">Delete</button>--}}
                                    <button type="button" class="btn delete-btn action-buttons" onclick="deleteBulkUser()" id="user_bulk_delete_send">Delete</button>
                                </div>
                                @if(auth()->guard('web')->user()->can('create.user_management'))
                                    <div class="create-btn-part col-6 col-md-3 col-lg-3">
                                        <button type="button" class="btn download-btn action-buttons active" data-bs-toggle="modal" data-bs-target="#userCreateModal" id="user_create_btn">Create</button>
                                    </div>
                                @endif
                            </div>
                            <form action="" method="GET" id="user-form">

                                <input type="text" value="{{auth()->guard('web')->user()->roles[0]->name}}" id="logged_in_user_role" readonly hidden="hidden">
                                <div class="table-responsive">
                                    <div class="user-manage-body">
                                    <div class="users users-header row g-0">
                                        <div class="col-3 col-md-3 col-lg-2  header-div">
                                            <p>Name</p> <button class="filter-btn" onclick="filterByName()" type="button"><span id="order" hidden="hidden">DESC</span><img class="filter-icon" src="{{asset('assets/icons/filter-icon.png')}}" alt="Filter Icon">
                                        </div>
                                        <div class="col-3 col-md-3 col-lg-3 header-div">
                                            <p class="">Email</p>
                                        </div>
                                        <div class="col-2 col-md-2 col-lg-2 header-div">
                                            <p class="">Designation </p>
                                        </div>
                                        <div class="col-2 col-md-2 col-lg-2 header-div">
                                            <p>Created Date</p>
                                        </div>
                                        <div class="col-2 col-md-2 col-lg-3 header-div">
                                            <p class="">Action</p>
                                        </div>
                                    </div>
                                    <div id="users-list">
                                    @foreach($users as $user)

                                        <div class="users row g-0">
                                            <div class="col-3 col-md-3 col-lg-2 checkbox-div">
                                                <input type="checkbox" class="select-checkbox" name="user_checkbox[]" value="{{$user->id}}">
                                                <span>{{$user->first_name. ' '. $user->last_name}}</span>
                                            </div>
                                            <div class="col-3 col-md-3 col-lg-3 data-div">
                                                <p class="">{{$user->email}}</p>
                                            </div>
                                            <div class="col-2 col-md-2 col-lg-2 data-div">
                                                <p class="">{{$user->designation}}</p>
{{--                                                <p class="">{{$user->roles[0]->name}}</p>--}}
                                            </div>
                                            <div class="col-2 col-md-2 col-lg-2 time-div">
                                                <span>{{\Carbon\Carbon::parse($user->created_at)->format('d M Y')}}</span>
                                            </div>
                                            <div class="col-2 col-md-2 col-lg-3 action-div">
                                                <a href="#" class="action-buttons view-button {{auth()->guard('web')->user()->can('view.user_management') ? '' : 'd-none'}}" data-bs-toggle="modal" data-slug="{{$user->slug}}">View</a>
    {{--                                            <a href="#" class="action-buttons" data-bs-toggle="modal" data-bs-target="#userEditModal">Edit</a>--}}
                                                <a href="#" class="action-buttons edit-button {{auth()->guard('web')->user()->can('edit.user_management') ? '' : 'd-none'}}" data-bs-toggle="modal" data-role="{{$user->roles[0]->name}}" data-slug="{{$user->slug}}">Edit</a>
                                                <a href="#" class="action-buttons delete-btn {{auth()->guard('web')->user()->can('delete.user_management') ? '' : 'd-none'}}" data-bs-toggle="modal" onclick="delUser(this)" data-role="{{$user->roles[0]->name}}" id="{{$user->slug}} " data-bs-target="#userDeleteModal-{{$user->uuid}}">Delete</a>
{{--                                                <a href="#" class="action-buttons delete-btn" data-bs-toggle="modal" onclick="delUser(this)" data-role="{{$user->roles[0]->name}}" id="{{route('user.destroy', $user->slug)}} " data-bs-target="#userDeleteModal">Delete</a>--}}

                                                <!-- Delete Modal Start -->
                                                <div class="modal fade" id="userDeleteModal-{{$user->uuid}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="userDeleteModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog user-delete-modal">
                                                        <form id="delForm" method="POST">
                                                            <meta name="csrf-token" content="{{ csrf_token() }}" />
                                                            {{csrf_field()}}
                                                            {{ method_field('DELETE') }}
                                                            <div class="modal-content">
                                                                <div class="user-delete-modal-body">
                                                                    <p class="text-center">Confirm Delete</p>
                                                                    <div class="text-center">
                                                                        <button type="button" class="btn btn-sm user-delete-modal-close-btn"  data-bs-dismiss="modal" aria-label="No">No</button>
                                                                        <button type="button" class="btn btn-sm yes-btn" onclick="deleteYes()">Yes</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <!-- Delete Modal End -->
                                            </div>
                                        </div>
                                    @endforeach
                                    </div>
                                    <button id="user_bulk_delete_submit" type="submit" hidden></button>
                                </div>
                                </div>
                            </form>

                            <div class="select-pagination-portion table-bottom-portion row g-0">
                                <div class="count-part col-6 col-md-3 col-lg-2">
                                    <p class="" id="showNoOfUser">{{count($users)}} out of {{$users->total()}}</p>
                                </div>
{{--                                @if($users->hasPages())--}}
                                    <div class="pagination-part col-6 col-md-5 col-lg-4">
                                        <input type="text" id="last_page" value="{{$users->hasPages()}}" hidden="hidden">
                                        <a data-href="{{$users->previousPageUrl()}}" class="btn d-none left-arrow"><i class="fa-solid fa-chevron-left"></i></a>
                                        <span class="pagination-number pagination-left-number">{{$users->currentPage()}}</span>
                                        <span class="pagination-divider">/</span>
                                        <span class="pagination-number pagination-right-number">{{$users->lastPage()}}</span>
                                        <a data-href="{{$users->nextPageUrl()}}" class="btn right-arrow d-none"><i class="fa-solid fa-chevron-right"></i></a>
                                    </div>
{{--                                @endif--}}
                            </div>

                            <!-- User Add Modal Start -->
                            <div class="modal fade" id="userCreateModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="userCreateModalLabel" aria-hidden="true">
                                <div class="modal-dialog user-create-modal">
                                    <div class="modal-content">
                                        <div class="user-create-modal-body">
                                            <div class="user-create-modal-header row">
                                                <h5 class="modal-title col-11" id="userCreateModalLabel">Create New User</h5>
                                                <button type="button" class="btn btn-close btn-sm user-create-modal-close-btn col-1" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="user-create-modal-data row">
                                                <form action="#" id="user-create">
                                                    <meta name="csrf-token" content="{{ csrf_token() }}"/>
                                                    <input type="hidden" id="role" name="role" value="{{auth()->guard('web')->user()->hasRole('Company Owner') || auth()->guard('web')->user()->hasRole('Employee') ? 'Employee' : 'Admin'}}">
                                                    <div class="data-body row">
                                                        <div class="data-row col-12">
{{--                                                            <label for="first-name"><span class="required-sign">*</span>First Name</label>--}}
                                                            <label for="first-name"><span class="required-sign">*</span>Name</label>
                                                            <input type="text" name="first_name" class="form-control" id="first-name" placeholder="Name">
                                                            <span class="text-danger user_create_first_name"></span>
                                                        </div>
{{--                                                        <div class="data-row col-6">--}}
{{--                                                            <label for="last-name"><span class="required-sign">*</span>Last Name</label>--}}
{{--                                                            <input type="text" name="last_name" class="form-control" id="last-name" placeholder="Last Name">--}}

{{--                                                            <span class="text-danger user_create_last_name"></span>--}}
{{--                                                        </div>--}}
                                                        <div class="data-row col-12">
                                                            <label for="email-adrs"><span class="required-sign">*</span>Email Address</label>
                                                            <input type="email" name="email" class="form-control" id="email-adrs" placeholder="Email Address">

                                                            <span class="text-danger user_create_email"></span>
                                                        </div>
                                                        <div class="data-row col-12">
                                                            <label for="designation"><span class="required-sign">*</span>Designation</label>
                                                            <input type="text" name="designation" class="form-control" id="designation" placeholder="Designation" required>
                                                            <span class="text-danger user_create_designation"></span>
                                                        </div>
                                                        <div class="data-row col-12">
                                                            <p class="check-sec-label" id="">Manage Actions</p>
                                                            <span class="check-sec-sub">Gives the user specific module related permissions</span>
                                                            <div class="checkboxes-header row g-0">
                                                                <div class="col-4 col-md-4 checkbox-module-col">
                                                                    <span>Module</span>
                                                                </div>
                                                                <div  class="col-2 col-md-2 checkbox-col">
                                                                    <span>View</span>
                                                                </div>
                                                                <div  class="col-2 col-md-2 checkbox-col">
                                                                    <span>Create</span>
                                                                </div>
                                                                <div  class="col-2 col-md-2 checkbox-col">
                                                                    <span>Edit</span>
                                                                </div>
                                                                <div  class="col-2 col-md-2 checkbox-col">
                                                                    <span>Delete</span>
                                                                </div>
                                                            </div>
                                                            <div id="manage_action_table"></div>
                                                        </div>
                                                        <div class="data-row col-12">
                                                            <div class="search-results">
                                                                <ul class="list-group" id="search-results-list"></ul>
                                                            </div>
                                                        </div>
                                                        <div class="data-row col-12 text-end">
                                                            <button type="button" class="create-user-btn btn" id="add-user"><div id="userCreateLoader"><span class="spinner-border spinner-border-sm"
                                                                                                                                                              role="status" aria-hidden="true"></span></div>Create</button>
{{--                                                            <button type="submit" class="create-user-btn btn" id="add-user">Create</button>--}}
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- User Add Modal End -->

                            <!-- User Edit Modal Start -->
                            <div class="modal fade" id="userEditModal"  data-bs-keyboard="false" tabindex="-1" aria-labelledby="userEditModalLabel" aria-hidden="true">
                                <div class="modal-dialog user-create-modal">
                                <div class="modal-content">
                                    <div class="user-create-modal-body">
                                        <div class="user-create-modal-header row">
                                            <h5 class="modal-title col-11" id="userEditModalLabel">Edit User</h5>
                                            <button type="button" class="btn btn-close btn-sm user-create-modal-close-btn col-1" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="user-create-modal-data row">
                                            <form action="" method="POST" id="edit-form">
                                                @method('PUT')
                                                @csrf
{{--                                                <meta name="csrf-token" content="{{ csrf_token() }}"/>--}}
{{--                                                    <input type="hidden" id="support-ticket-key" name="support_ticket_key">--}}
{{--                                                <input type="hidden" id="role" name="role" value="Admin">--}}
                                                <input type="hidden" id="user_role" name="role" value="">
                                                <div class="data-body row">
                                                    <div class="data-row col-12">
                                                        <label for="edit-first-name"><span class="required-sign">*</span>First Name</label>
                                                        <input type="text" name="first_name" class="form-control" id="edit-first-name" value="" placeholder="First Name">
                                                        @error('first_name')
                                                        <span class="text-danger user_edit_first_name">{{$message}}</span>
                                                        @enderror
                                                    </div>
{{--                                                    <div class="data-row col-6">--}}
{{--                                                        <label for="edit-last-name"><span class="required-sign">*</span>Last Name</label>--}}
{{--                                                        <input type="text" name="last_name" class="form-control" id="edit-last-name" value="" placeholder="Last Name" >--}}
{{--                                                        @error('last_name')--}}
{{--                                                        <span class="text-danger user_edit_last_name">{{$message}}</span>--}}
{{--                                                        @enderror--}}
{{--                                                    </div>--}}
                                                    <div class="data-row col-12">
                                                        <label for="edit-email-adrs"><span class="required-sign">*</span>Email Address</label>
                                                        <input type="email" name="email" class="form-control" id="edit-email-adrs" value="" placeholder="Email Address">
                                                        @error('email')
                                                        <span class="text-danger user_edit_email">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="data-row col-12">
                                                        <label for="edit-designation">Designation</label>
                                                        <input type="text" name="designation" class="form-control" id="edit-designation" value="" placeholder="Designation" required>
                                                    </div>
                                                    <div class="data-row col-12" id="hide_actions_for_customer">
                                                        <p class="check-sec-label">Manage Actions</p>
                                                        <span class="check-sec-sub">Gives the user specific module related permissions</span>
                                                        <div class="checkboxes-header row g-0">
                                                            <div class="col-4 col-md-4 checkbox-module-col">
                                                                <span>Module</span>
                                                            </div>
                                                            <div  class="col-2 col-md-2 checkbox-col">
                                                                <span>View</span>
                                                            </div>
                                                            <div  class="col-2 col-md-2 checkbox-col">
                                                                <span>Create</span>
                                                            </div>
                                                            <div  class="col-2 col-md-2 checkbox-col">
                                                                <span>Edit</span>
                                                            </div>
                                                            <div  class="col-2 col-md-2 checkbox-col">
                                                                <span>Delete</span>
                                                            </div>
                                                        </div>
                                                        <div id="permission-list"></div>
                                                    </div>
                                                    <div class="data-row col-12">
                                                        <div class="search-results">
                                                            <ul class="list-group" id="search-results-list"></ul>
                                                        </div>
                                                    </div>
                                                    <div class="data-row col-12 text-end">
                                                        <button type="submit" class="create-user-btn btn" id="edit-user">Save Changes</button>
{{--                                                        <button type="button" class="create-user-btn btn" id="edit-user"><div id="userEditLoader"><span class="spinner-border spinner-border-sm"--}}
{{--                                                                                                                                                          role="status" aria-hidden="true"></span></div>Save Changes</button>--}}
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <!-- User Edit Modal End -->

                            <!-- User View Modal Start -->
                            <div class="modal fade view-modal" id="userViewModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="userViewModalLabel" aria-hidden="true">
                                <div class="modal-dialog user-create-modal">
                                    <div class="modal-content">
                                        <div class="user-create-modal-body">
                                            <div class="user-create-modal-header row">
                                                <h5 class="modal-title col-11" id="userViewModalLabel">View User</h5>
                                                <button type="button" class="btn btn-close btn-sm user-create-modal-close-btn col-1" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="user-create-modal-data row">
                                                <form action="#">
                                                    <input type="hidden" id="support-ticket-key" name="support_ticket_key">
                                                    <div class="data-body row">
                                                        <div class="data-row col-12">
                                                            <label for="view-first-name"> First Name</label>
                                                            <p name="first_name" class="form-control" id="view-first-name"></p>
                                                        </div>
{{--                                                        <div class="data-row col-6">--}}
{{--                                                            <label for="view-last-name">Last Name</label>--}}
{{--                                                            <p name="last_name" class="form-control" id="view-last-name"> </p>--}}
{{--                                                        </div>--}}
                                                        <div class="data-row col-12">
                                                            <label for="view-email-adrs">Email Address</label>
                                                            <p name="email" class="form-control" id="view-email-adrs"></p>
                                                        </div>
                                                        <div class="data-row col-12">
                                                            <label for="view-designation">Designation</label>
                                                            <p name="designation" class="form-control" id="view-designation"></p>
                                                        </div>
                                                        <div class="data-row col-12" id="hide_actions_view_for_customer">
                                                            <p class="check-sec-label" id="">Manage Actions</p>
                                                            <span class="check-sec-sub">Gives the user specific module related permissions</span>
                                                            <div class="checkboxes-header row g-0">
                                                                <div class="col-4 col-md-4 checkbox-module-col">
                                                                    <span>Module</span>
                                                                </div>
                                                                <div  class="col-2 col-md-2 checkbox-col">
                                                                    <span>View</span>
                                                                </div>
                                                                <div  class="col-2 col-md-2 checkbox-col">
                                                                    <span>Create</span>
                                                                </div>
                                                                <div  class="col-2 col-md-2 checkbox-col">
                                                                    <span>Edit</span>
                                                                </div>
                                                                <div  class="col-2 col-md-2 checkbox-col">
                                                                    <span>Delete</span>
                                                                </div>
                                                            </div>
                                                            <div id="view-permission-list"></div>

{{--                                                            <div class="checkboxes row g-0">--}}
{{--                                                                @foreach($uniqueModuleName as $moduleName)--}}
{{--                                                                    @if($moduleName=='mailbox')--}}
{{--                                                                        <div class="col-4 col-md-4 checkbox-module-col">--}}
{{--                                                                            <span>Mailbox</span>--}}
{{--                                                                        </div>--}}
{{--                                                                        @foreach($permissions as $permission)--}}
{{--                                                                            @if(explode('.',$permission['permission'])[1] == $moduleName )--}}
{{--                                                                                <div  class="col-2 col-md-2 checkbox-col">--}}
{{--                                                                                    <input type="checkbox" class="select-checkbox" name="permission[]" value="{{$permission['id']}}" {{$user->hasDirectPermission($permission['id'])  ? 'checked' : ''}} onclick="this.checked=!this.checked;">--}}
{{--                                                                                </div>--}}
{{--                                                                            @endif--}}
{{--                                                                        @endforeach--}}
{{--                                                                    @elseif($moduleName=='ticket')--}}
{{--                                                                        <div class="col-4 col-md-4 checkbox-module-col">--}}
{{--                                                                            <span>Support Tickets</span>--}}
{{--                                                                        </div>--}}
{{--                                                                        @foreach($permissions as $permission)--}}
{{--                                                                            @if(explode('.', $permission['permission'])[1] == $moduleName )--}}
{{--                                                                                <div  class="col-2 col-md-2 checkbox-col">--}}
{{--                                                                                    <input type="checkbox" class="select-checkbox"--}}
{{--                                                                                           name="permission[]" value="{{$permission['id']}}" {{$user->hasDirectPermission($permission['id'])  ? 'checked' : ''}}--}}
{{--                                                                                           onclick="this.checked=!this.checked;">--}}
{{--                                                                                </div>--}}
{{--                                                                            @endif--}}
{{--                                                                        @endforeach--}}
{{--                                                                    @elseif($moduleName=='user')--}}
{{--                                                                        <div class="col-4 col-md-4 checkbox-module-col">--}}
{{--                                                                            <span>User</span>--}}
{{--                                                                        </div>--}}
{{--                                                                        @foreach($permissions as $permission)--}}
{{--                                                                            @if(explode('.', $permission['permission'])[1] == $moduleName )--}}
{{--                                                                                <div  class="col-2 col-md-2 checkbox-col">--}}
{{--                                                                                    <input type="checkbox" class="select-checkbox"--}}
{{--                                                                                           name="permission[]" value="{{$permission['id']}}" {{$user->hasDirectPermission($permission['id'])  ? 'checked' : ''}}--}}
{{--                                                                                           onclick="this.checked=!this.checked;">--}}
{{--                                                                                </div>--}}
{{--                                                                            @endif--}}
{{--                                                                        @endforeach--}}
{{--                                                                    @elseif($moduleName=='company')--}}
{{--                                                                        <div class="col-4 col-md-4 checkbox-module-col">--}}
{{--                                                                            <span>Company</span>--}}
{{--                                                                        </div>--}}
{{--                                                                        @foreach($permissions as $permission)--}}
{{--                                                                            @if(explode('.', $permission['permission'])[1] == $moduleName )--}}
{{--                                                                                <div  class="col-2 col-md-2 checkbox-col">--}}
{{--                                                                                    <input type="checkbox" class="select-checkbox" name="permission[]" value="{{$permission['id']}}" {{$user->hasDirectPermission($permission['id'])  ? 'checked' : ''}} onclick="this.checked=!this.checked;">--}}
{{--                                                                                </div>--}}
{{--                                                                            @endif--}}
{{--                                                                        @endforeach--}}
{{--                                                                    @endif--}}
{{--                                                                @endforeach--}}
{{--                                                            </div>--}}
                                                        </div>
                                                        <div class="data-row col-12">
                                                            <div class="search-results">
                                                                <ul class="list-group" id="search-results-list"></ul>
                                                            </div>
                                                        </div>
                                                        <!-- <div class="data-row col-12 text-end">
                                                            <button type="button" class="create-user-btn btn"
                                                            data-bs-toggle="modal" data-bs-target="#userEditModal" id="edit-user">Edit</button>
                                                        </div> -->
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- User View Modal End -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Main Body End -->
@endsection
@push('customScripts')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        });
        $('#add-user').on('click', function () {
            $('.user_create_first_name').text('');
            $('.user_create_last_name').text('');
            $('.user_create_email').text('');
            $('.user_create_designation').text('');
            $("#add-user").prop('disabled', true);
            let form = $('#user-create')[0];
            var formData = new FormData(form);
            $.ajax({
                type: "POST",
                url: "{{route('user.store')}}",
                data: formData,
                dataType: "json",
                processData: false,
                contentType: false,
                beforeSend: function () {
                    $("#userCreateLoader").show();
                },
                success: function (data) {

                    $("#userCreateLoader").hide();
                    if (data.success == 1) {
                        $('#userCreateModal').modal('hide')
                        $("html, body").animate({scrollTop: 0});
                        if(data.message=='User already exists'){
                            $('#flashMessages').html(
                                `<div class="alert alert-success">
                            <img class="alert-img" src="{{asset('assets/icons/mailbody-!.png')}}" alt="">
                            <p class="alert-text">${data.message}</p></div>`
                            )
                        }else {
                            $('#flashMessages').html(
                                `<div class="alert alert-success">
                            <img class="alert-img" src="{{asset('assets/icons/success-alert-icon.png')}}" alt="">
                            <p class="alert-text">${data.message}</p></div>`
                            )
                        }

                        setTimeout(function () {
                            window.location.reload()
                        }, 2000);
                    }else if(data.abort == 403){
                        $("#add-user").prop('disabled', false);
                        $("html, body").animate({scrollTop: 0});
                        $('#flashMessages').html(
                            `<div class="alert alert-success alert-access">
                            <img class="alert-img" src="{{asset('assets/icons/mailbody-!.png')}}" alt="">
                            <p class="alert-text">${data.message}</p></div>`
                        )
                    }else if(data.error == 0){
                        $('#userCreateModal').modal('hide')
                        $("#add-user").prop('disabled', false);
                        $("html, body").animate({scrollTop: 0});
                        $('#flashMessages').html(
                            `<div class="alert alert-success alert-access">
                            <img class="alert-img" src="{{asset('assets/icons/mailbody-!.png')}}" alt="">
                            <p class="alert-text">${data.message}</p></div>`
                        )
                    }
                },
                error: function (xhr) {
                    $("#userCreateLoader").hide();
                    $("#add-user").prop('disabled', false);
                    $.each(xhr.responseJSON.errors, function (key, value) {
                        $('.user_create_' + key).text(value);
                    });
                    // alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
                }
            });
        })
        {{--$('#edit-user').on('click', function () {--}}
        {{--    $('.user_edit_first_name').text('');--}}
        {{--    $('.user_edit_last_name').text('');--}}
        {{--    $('.user_edit_email').text('');--}}
        {{--    $("#edit-user").prop('disabled', true);--}}
        {{--    let form = $('#edit-form')[0];--}}
        {{--    var formData = new FormData(form);--}}
        {{--    console.log(formData)--}}
        {{--    let url = $('#edit-form').attr('action')--}}
        {{--    console.log(url)--}}
        {{--    $.ajax({--}}
        {{--        type: "PUT",--}}
        {{--        url: url,--}}
        {{--        data: $('#edit-form').serialize(),--}}
        {{--        processData: false,--}}
        {{--        contentType: false,--}}
        {{--        beforeSend: function () {--}}
        {{--            $("#userEditLoader").show();--}}
        {{--        },--}}
        {{--        success: function (data) {--}}
        {{--            $("#userEditLoader").hide();--}}
        {{--            if (data.success == 1) {--}}
        {{--                $('#userEditModal').modal('hide')--}}
        {{--                $("html, body").animate({scrollTop: 0});--}}
        {{--                $('#flashMessages').html(--}}
        {{--                    `<div class="alert alert-success">--}}
        {{--                    <img class="alert-img" src="{{asset('assets/icons/success-alert-icon.png')}}" alt="">--}}
        {{--                    <p class="alert-text">${data.message}</p></div>`--}}
        {{--                )--}}
        {{--                setTimeout(function () {--}}
        {{--                    window.location.reload()--}}
        {{--                }, 2000);--}}
        {{--            }else if(data.abort == 403){--}}
        {{--                $("#add-user").prop('disabled', false);--}}
        {{--                $("html, body").animate({scrollTop: 0});--}}
        {{--                $('#flashMessages').html(--}}
        {{--                    `<div class="alert alert-success alert-access">--}}
        {{--                    <img class="alert-img" src="{{asset('assets/icons/mailbody-!.png')}}" alt="">--}}
        {{--                    <p class="alert-text">${data.message}</p></div>`--}}
        {{--                )--}}
        {{--            }--}}
        {{--        },--}}
        {{--        error: function (xhr) {--}}
        {{--            $("#userEditLoader").hide();--}}
        {{--            $("#edit-user").prop('disabled', false);--}}
        {{--            $.each(xhr.responseJSON.errors, function (key, value) {--}}
        {{--                $('.user_edit_' + key).text(value);--}}
        {{--            });--}}
        {{--            // alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);--}}
        {{--        }--}}
        {{--    });--}}


        {{--})--}}





        let deleteUrl=''
        let modalId=''
        function delUser(e) {
            deleteUrl=e.id
            modalId=e.getAttribute('data-bs-target')
            deleteUrl="{{route('user.destroy', ':slug')}}"
            deleteUrl=deleteUrl.replace(':slug',e.id)
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        function deleteYes() {
            $(modalId).modal('hide')
            $.ajax({
                url: deleteUrl,
                method:'DELETE',
                dataType: "json",

                success: function(res) {
                    // console.log(res)
                    $("html, body").animate({ scrollTop: 0 });
                    if (res.success == '1'){
                        $('#flashMessages').html(
                            `<div class="alert alert-success">
                            <img class="alert-img" src="{{asset('assets/icons/success-alert-icon.png')}}" alt="">
                            <p class="alert-text">${res.message}</p></div>`
                        )
                        setTimeout(function(){
                            window.location.reload();
                        }, 2000);
                    }else if(res.abort==403) {
                        $(modalId).modal('hide')
                        $('#flashMessages').html(
                            `<div class="alert alert-success alert-access">
                            <img class="alert-img" src="{{asset('assets/icons/mailbody-!.png')}}" alt="">
                            <p class="alert-text">${res.message}</p></div>`
                        )

                    }else if(res.success==0) {
                        $(modalId).modal('hide')
                        $('#flashMessages').html(
                            `<div class="alert alert-success alert-access">
                            <img class="alert-img" src="{{asset('assets/icons/mailbody-!.png')}}" alt="">
                            <p class="alert-text">${res.message}</p></div>`
                        )

                    }
                },
                error: function (xhr) {
                    $.each(xhr.responseJSON.errors, function (key, value) {
                        // console.log('key:', key)
                        // console.log('value:', value)
                        // $('.corpSec-' + key).text(value);
                    });
                }
            });
        }
        var order=""
        $(document).ready(function(){
            $("#userCreateLoader").hide();
            $("#userEditLoader").hide();
            removeClassFromPaginationArrow('searchUser')
            removeClassFromPaginationArrow('filterByDesignation')
            // Get the element with id="defaultOpen" and click on it
            document.getElementById("defaultOpen").click();

            var $checkboxes = $('.user-manage-body .users  input[type="checkbox"]');
            $('.button-part').hide();
            function checkbox(){
                var countCheckedCheckboxes = $checkboxes.filter(':checked').length;
                if(countCheckedCheckboxes > 0){
                    $('.selected-checkbox-number').text(countCheckedCheckboxes + " selected");
                    $('.sb-part').hide();
                    $('.button-part').show();
                    $('.create-btn-part').hide();
                }
                else{
                    $('.selected-checkbox-number').text("Select All");
                    $('.sb-part').show();
                    $('.button-part').hide();
                    $('.create-btn-part').show();
                }
            }
            $checkboxes.change(function(e){
                $('.user-manage-body .users  input[type="checkbox"]:checked').each(function() {
                    $(this).parent().parent().addClass('checked-row');
                });
                $('.user-manage-body .users  input[type="checkbox"]:not(:checked)').each(function() {
                    $(this).parent().parent().removeClass('checked-row');
                });

                checkbox();
            });
            $(".select-all-checkbox").click(function () {
                $('input:checkbox').not(this).prop('checked', this.checked);
                checkbox();
            });

            let page=$('#last_page').val()
            if (page != ""){
                $('.pagination-part .right-arrow').removeClass('d-none')
            }else {

                $('.pagination-part .right-arrow').addClass('d-none')
                // $('.pagination-part').addClass('d-none')
            }
        })
        function removeClassFromPaginationArrow(className){
            if ( $(".pagination-part .right-arrow").hasClass(className)){
                $(".pagination-part .right-arrow").removeClass(className)
            }
            if (  $(".pagination-part .left-arrow").hasClass(className)){
                $(".pagination-part .left-arrow").removeClass(className)
            }
        }
        function selectCheckboxes(){
            var $checkboxes = $('.user-manage-body .users  input[type="checkbox"]');
            // console.log($checkboxes)
            $('.button-part').hide();
            function checkbox(){
                var countCheckedCheckboxes = $checkboxes.filter(':checked').length;
                if(countCheckedCheckboxes > 0){
                    $('.selected-checkbox-number').text(countCheckedCheckboxes + " selected");
                    $('.sb-part').hide();
                    $('.button-part').show();
                    $('.create-btn-part').hide();
                }
                else{
                    $('.selected-checkbox-number').text("Select All");
                    $('.sb-part').show();
                    $('.button-part').hide();
                    $('.create-btn-part').show();
                }
            }
            $checkboxes.change(function(e){
                $('.user-manage-body .users  input[type="checkbox"]:checked').each(function() {
                    $(this).parent().parent().addClass('checked-row');
                });
                $('.user-manage-body .users  input[type="checkbox"]:not(:checked)').each(function() {
                    $(this).parent().parent().removeClass('checked-row');
                });

                checkbox();
            });
            $(".select-all-checkbox").click(function () {
                $('input:checkbox').not(this).prop('checked', this.checked);
                checkbox();
            });
        }


        function adminUserManageTab(evt, enevtName) {
            var i, tabcontent, tablinks,elements;
            tabcontent = document.getElementsByClassName("adminUserManageTabContent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("adminUserManageTabLinks");
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



        // let url= "user?page="
        $('.pagination-part .left-arrow').on('click', function (){
            if ($(this).attr('data-href') != ''){
                let url= "user?page="
                var page = $(this).attr('data-href').split('page=')[1];
                if($('.pagination-part .left-arrow').hasClass('filterByName') == true){
                    let order=$(this).attr('data-href').split('?')[0].split('/')[5]
                    url="user/filter-by-name/"+order+"?page="
                }
                if($('.pagination-part .left-arrow').hasClass('filterByDesignation') == true){
                    let designation=$(this).attr('data-href').split('?')[0].split('/')[4]
                    url="user/"+designation+"/filter?page="
                }
                if($('.pagination-part .left-arrow').hasClass('searchUser') == true){
                    let search=$(this).attr('data-href').split('?')[0].split('/')[4]
                    url="user/"+search+"/search?page="
                }
                fetch_data(url,page);
            }
        })
        $('.pagination-part .right-arrow').on('click', function (){
            if ($(this).attr('data-href') != ''){
                let url= "user?page="
                var page = $(this).attr('data-href').split('page=')[1];
                if($('.pagination-part .right-arrow').hasClass('filterByDesignation') == true){
                    let designation=$(this).attr('data-href').split('?')[0].split('/')[4]
                    url="user/"+designation+"/filter?page="
                }
                if($('.pagination-part .right-arrow').hasClass('filterByName') == true){
                    let order=$(this).attr('data-href').split('?')[0].split('/')[5]
                    url="user/filter-by-name/"+order+"?page="
                }

                if($('.pagination-part .right-arrow').hasClass('searchUser') == true){
                    let search=$(this).attr('data-href').split('?')[0].split('/')[4]
                    url="user/"+search+"/search?page="
                }
                fetch_data(url,page);
            }

        })

        function fetch_data(url,page) {
            let wrapper = "#users-list"
            let designation=$('#user-designation').find(":selected").val()
            // console.log(url)
            $.ajax({
                url: url + page,
                data: {search:0,designation: designation},
                dataType:"json",
                success: function(res) {
                    // console.log(res)

                    determinePaginationArrow(res)

                    $('.pagination-left-number').text(res.current_page)
                    $('.pagination-right-number').text(res.last_page)
                    $(".pagination-part .left-arrow").attr('data-href', res.prev_page_url)
                    $(".pagination-part .right-arrow").attr('data-href', res.next_page_url)
                    $('#showNoOfUser').text(res.data.length + ' out of '+ res.total)
                    domLoad(res.data)
                    selectCheckboxes()

                    // $(wrapper).html(res.users.data.map((item) =>
                    //
                    // ))

                }
            });
        }

        $('#user_bulk_delete_send').on('click', function () {
            $('#user_bulk_delete_submit').click()
        })

        function deleteBulkUser() {
            let userIds=[];
            $("input[name='user_checkbox']").each(function() {
                if (this.value != ''){
                    value=this.value;
                    userIds.push(value)
                }
            });

            let action = "{{route('user.delete.bulk')}}"
            $('#user-form').attr('action', action)
        }

        function domLoad(item){
            // ${value.roles[0].name}
            let wrapper="#users-list"
            let userRow=''


            $.map(item, function(value,i){
                {{--let userId="{{route('user.destroy', ':slug')}}"--}}
                // userId= userId.replace(':slug', value.slug)

                userRow+= `<div class="users row g-0">
                                        <div class="col-3 col-md-3 col-lg-2 checkbox-div">
                                            <input type="checkbox" class="select-checkbox" name="user_checkbox[]" value="${value.id}">
                                            <span>${value.first_name}</span>
                                        </div>
                                        <div class="col-3 col-md-3 col-lg-3 data-div">
                                            <p class="">${value.email}</p>
                                        </div>
                                        <div class="col-2 col-md-2 col-lg-2 data-div">
                                            <p class="">${value.designation}</p>
                                        </div>
                                        <div class="col-2 col-md-2 col-lg-2 time-div">
                                            <span>${$.date(value.created_at)}</span>
                                        </div>
                                        <div class="col-2 col-md-2 col-lg-3 action-div">
                                            <a href="#" class="action-buttons view-button {{auth()->guard('web')->user()->can('view.user_management') ? '' : 'd-none'}}" data-bs-toggle="modal" data-slug="${value.slug}">View</a>
                                            <a href="#" class="action-buttons edit-button {{auth()->guard('web')->user()->can('edit.user_management') ? '' : 'd-none'}}" data-bs-toggle="modal" data-role="${value.roles[0].name}" data-slug="${value.slug}">Edit</a>`+
                                            // <a href="#" class="action-buttons delete-btn" data-bs-toggle="modal" data-bs-target="#userDeleteModal" data-role="${value.roles[0].name}" onclick="onDelete(this)" id=${userId}>Delete</a>

                                            `<a href="#" class="action-buttons delete-btn {{auth()->guard('web')->user()->can('delete.user_management') ? '' : 'd-none'}}" data-bs-toggle="modal" data-bs-target="#userDeleteModal-${value.uuid}" data-role="${value.roles[0].name}" onclick="delUser(this)" id=${value.slug}>Delete</a>


                                            <!-- Delete Modal Start -->
                                            <div class="modal fade" id="userDeleteModal-${value.uuid}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="userDeleteModalLabel" aria-hidden="true">
                                                <div class="modal-dialog user-delete-modal">
                                                    <form id="delForm" method="POST">
                                                        {{csrf_field()}}
                                                        {{ method_field('DELETE') }}
                                                    <div class="modal-content">
                                                        <div class="user-delete-modal-body">
                                                            <p class="text-center">Confirm Delete</p>
                                                            <div class="text-center">
                                                                <button type="button" class="btn btn-sm user-delete-modal-close-btn"  data-bs-dismiss="modal" aria-label="No">No</button>`+
                                                                // <button type="submit" class="btn btn-sm yes-btn">Yes</button>
                                                               `<button type="button" class="btn btn-sm yes-btn" onclick="deleteYes()">Yes</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <!-- Delete Modal End -->
                                        </div>
                                    </div><button id="user_bulk_delete_submit" type="submit" hidden></button>`
            })


            $(wrapper).empty().append(userRow)

        }

        $('#user_create_btn').on('click',function () {
            $('#first-name').val('')
            $('.user_create_first_name').text('')
            $('#last-name').val('')
            $('.user_create_last_name').text('')
            $('#email-adrs').val('')
            $('#designation').val('')
            $('.user_create_email').text('')
            let url = '{{route('user.manage.action')}}'

            $.ajax({
                url: url,
                success: function(res) {
                    // console.log('res',res.uniqueModuleName)
                    let html=''
                    let crud=['view', 'create', 'edit', 'delete'];
                    $.map(res.uniqueModuleName, function(value,i){
                        let checkbox='';
                        $.map(crud, function(item,i){
                            if(m=res.permissions.find(o=>o.permission == item+'.'+value)){
                                checkbox+= `<div  class="col-2 col-md-2 checkbox-col">
                                            <input type="checkbox" class="select-checkbox" name="permission[]" data-name="${m.permission}" value="${m.id+'-'+m.permission}">
                                         </div>`
                            }
                        })

                        html+= `<div class="checkboxes row g-0">
                                <div class="col-4 col-md-4 checkbox-module-col">
                                    <span>${snake2Pascal(value)}</span>
                                </div>`+
                            checkbox
                            +`</div>`
                    })
                    $('#manage_action_table').empty().append(html)
                }
            });

        })

        $('body').on('click', '.edit-button', function (e) {

            let role = $('#logged_in_user_role').val()
            if (role!='Super Admin'){
                if (this.getAttribute('data-role') == 'Super Admin'){
                    $("html, body").animate({scrollTop: 0});
                    $('#flashMessages').html(
                        `<div class="alert alert-success alert-access">
                            <img class="alert-img" src="{{asset('assets/icons/mailbody-!.png')}}" alt="">
                            <p class="alert-text">You are not allowed to perform this action!</p></div>`
                    )
                    $('#userEditModal').modal('hide')
                }else{
                    e.preventDefault()
                    let slug =$(this).data('slug')
                    let url = '{{route('user.edit', ':slug')}}'
                    url= url.replace(':slug', slug)

                    let action  =  '{{route('user.update', ':slug')}}'
                    action= action.replace(':slug',slug )


                    $.ajax({
                        url: url,
                        success: function(res) {
                            console.log(res)


                            if(res.abort==403){
                                $("html, body").animate({scrollTop: 0});
                                $('#flashMessages').html(
                                    `<div class="alert alert-success alert-access">
                            <img class="alert-img" src="{{asset('assets/icons/mailbody-!.png')}}" alt="">
                            <p class="alert-text">${res.message}</p></div>`
                                )
                                $('#userEditModal').modal('hide')
                            }else{

                                console.log(res.user.roles[0].name)
                                if(res.user.roles[0].name == 'Company User'){
                                    $('#hide_actions_for_customer').addClass('d-none')
                                }else {
                                    $('#hide_actions_for_customer').removeClass('d-none')
                                }
                                let html=''
                                $('#user_role').val(res.user.roles[0].name)
                                $('#edit-first-name').val(res.user.first_name)
                                $('#edit-last-name').val(res.user.last_name)
                                $('#edit-email-adrs').val(res.user.email)
                                $('#edit-designation').val(res.user.designation)
                                let crud=['view', 'create', 'edit', 'delete'];
                                $.map(res.uniqueModuleName, function(value,i){
                                    let checkbox='';
                                    $.map(crud, function(item,i){

                                        if(m=res.permissions.find(o=>o.permission == item+'.'+value)){
                                            console.log(m)
                                            console.log(res.user.permissions.findIndex(x => x.id === m.id))
                                            checkbox+= `<div  class="col-2 col-md-2 checkbox-col">
                                            <input type="checkbox" class="select-checkbox" name="permission[]" data-name="${m.permission}" value="${m.id+'-'+m.permission}" ${res.user.permissions.findIndex(x => x.id === m.id) >=  0 ? 'checked' : ''}>
                                         </div>`
                                        }
                                    })

                                    html+= `<div class="checkboxes row g-0">
                                <div class="col-4 col-md-4 checkbox-module-col">
                                    <span>${snake2Pascal(value)}</span>
                                </div>`+
                                        checkbox
                                        +`</div>`
                                })
                                $('#permission-list').empty().append(html)


                                $('#edit-form').attr('action', action)
                                $('#userEditModal').modal('show')
                            }
                        },
                        error: function (xhr) {
                            $.each(xhr.responseJSON.errors, function (key, value) {
                                // console.log('key:', key)
                                console.log('value:', value)
                                // $('.corpSec-' + key).text(value);
                            });
                        }
                    });
                }
            }else{

                e.preventDefault()
                let slug =$(this).data('slug')
                let url = '{{route('user.edit', ':slug')}}'
                url= url.replace(':slug', slug)

                let action  =  '{{route('user.update', ':slug')}}'
                action= action.replace(':slug',slug )


                $.ajax({
                    url: url,
                    success: function(res) {
                        if(res.abort==403){
                            $("html, body").animate({scrollTop: 0});
                            $('#flashMessages').html(
                                `<div class="alert alert-success alert-access">
                            <img class="alert-img" src="{{asset('assets/icons/mailbody-!.png')}}" alt="">
                            <p class="alert-text">${res.message}</p></div>`
                            )
                            $('#userEditModal').modal('hide')
                        }else{

                            // console.log(res)
                            if(res.user.roles[0].name == 'Company User'){
                                $('#hide_actions_for_customer').addClass('d-none')
                            }else {
                                $('#hide_actions_for_customer').removeClass('d-none')
                            }
                            let html=''
                            $('#user_role').val(res.user.roles[0].name)
                            $('#edit-first-name').val(res.user.first_name)
                            $('#edit-last-name').val(res.user.last_name)
                            $('#edit-email-adrs').val(res.user.email)
                            $('#edit-designation').val(res.user.designation)
                            let crud=['view', 'create', 'edit', 'delete'];
                            $.map(res.uniqueModuleName, function(value,i){
                                let checkbox='';
                                $.map(crud, function(item,i){
                                    if(m=res.permissions.find(o=>o.permission == item+'.'+value)){
                                        checkbox+= `<div  class="col-2 col-md-2 checkbox-col">
                                            <input type="checkbox" class="select-checkbox" name="permission[]" data-name="${m.permission}" value="${m.id+'-'+m.permission}" ${res.user.permissions.findIndex(x => x.id === m.id) >  0 ? 'checked' : ''}>
                                         </div>`
                                    }
                                })

                                html+= `<div class="checkboxes row g-0">
                                <div class="col-4 col-md-4 checkbox-module-col">
                                    <span>${snake2Pascal(value)}</span>
                                </div>`+
                                    checkbox
                                    +`</div>`
                            })
                            $('#permission-list').empty().append(html)


                            $('#edit-form').attr('action', action)
                            $('#userEditModal').modal('show')
                        }


                    },
                    error: function (xhr) {
                        $.each(xhr.responseJSON.errors, function (key, value) {
                            // console.log('key:', key)
                            console.log('value:', value)
                            // $('.corpSec-' + key).text(value);
                        });
                    }
                });
            }



        })
        $('body').on('click', '.view-button', function (e) {
            e.preventDefault()
           let slug =$(this).data('slug')
            let url = '{{route('user.show', ':slug')}}'
            url= url.replace(':slug', slug)
            $.ajax({
                url: url,
                success: function(res) {
                    if(res.abort==403){
                        $("html, body").animate({scrollTop: 0});
                        $('#flashMessages').html(
                            `<div class="alert alert-success alert-access">
                            <img class="alert-img" src="{{asset('assets/icons/mailbody-!.png')}}" alt="">
                            <p class="alert-text">You do not have access to view details!</p></div>`
                        )
                        $('#userViewModal').modal('hide')
                    }else{
                        if(res.user.roles[0].name == 'Company User'){
                            console.log('in')
                            $('#hide_actions_view_for_customer').addClass('d-none')
                        }else {
                            $('#hide_actions_view_for_customer').removeClass('d-none')
                        }
                        let html=''

                        $('#view-first-name').text(res.user.first_name)
                        $('#view-last-name').text(res.user.last_name)
                        $('#view-email-adrs').text(res.user.email)
                        $('#view-designation').text(res.user.designation)
                        let crud=['view', 'create', 'edit', 'delete'];
                        $.map(res.uniqueModuleName, function(value,i){
                            let checkbox='';
                            $.map(crud, function(item,i){
                                if(m=res.permissions.find(o=>o.permission == item+'.'+value)){
                                    checkbox+= `<div  class="col-2 col-md-2 checkbox-col">

                                            <input type="checkbox" class="select-checkbox" name="permission[]" data-name="${m.permission}" value="${m.id}" ${res.user.permissions.findIndex(x => x.id === m.id) >=  0 ? 'checked' : ''} onclick="this.checked=!this.checked;">
                                         </div>`
                                }
                            })

                            html+= `<div class="checkboxes row g-0">
                                <div class="col-4 col-md-4 checkbox-module-col">
                                    <span>${snake2Pascal(value)}</span>
                                </div>`+
                                checkbox
                                +`</div>`
                        })
                        $('#view-permission-list').empty().append(html)


                        // $('#edit-form').attr('action', action)
                        $('#userViewModal').modal('show')
                    }
                    // console.log('res',res)


                }
            });

        })
        $('.up-search').on('keyup',function () {
            let wrapper="#users-list"
            if (this.value.length == 0){
                // loadIndex(wrapper)
                let uri = "{{ route('user.index')}}"
                let designation=$('#user-designation').find(":selected").val()
                $.ajax({
                    url: uri,
                    data: {search:0,designation: designation},
                    success: function(res) {
                        // console.log('length',res.data.length)
                        removeClassFromPaginationArrow('searchUser')
                        $('#showNoOfUser').text(res.data.length + ' out of '+ res.total)
                        determinePaginationArrow(res)
                        //
                        $('.pagination-left-number').text(res.current_page)
                        $('.pagination-right-number').text(res.last_page)
                        $(".pagination-part .left-arrow").attr('data-href', res.prev_page_url)
                        $(".pagination-part .right-arrow").attr('data-href', res.next_page_url)
                        if (res.data.length > 0){
                            domLoad(res.data)
                        }else {
                            $(wrapper).empty().append(`<div class="users row g-0">
                                    <div class="col-12 col-md-12 col-lg-12 message-div text-center"><span>No Data Available</span></div>
                                </div>`)

                        }
                    }
                });
            }
        })
        $('#search-button').on('click', function (e) {
            e.preventDefault()
            // removeClassFromPaginationArrow('searchUser')
            removeClassFromPaginationArrow('filterByDesignation')
            removeClassFromPaginationArrow('filterByName')
           let search =$('#search-query').val()
            let designation=$('#user-designation').find(":selected").val()
            let url = '{{route('user.search', ':search')}}'
            url= url.replace(':search', search)
            $.ajax({
                url: url,
                data: {search:search,designation: designation},
                // data:{'search': search},
                success: function(res) {
                    console.log(res)
                    // if(res.user.roles[0].name == 'Company User'){
                    //     $('#hide_actions_for_customer').addClass('d-none')
                    // }else {
                    //     $('#hide_actions_for_customer').removeClass('d-none')
                    // }
                    $('#showNoOfUser').text(res.data.length + ' out of '+ res.total)
                    // console.log('res',res)
                    determinePaginationArrow(res)
                    injectClass('searchUser')

                    $('.pagination-left-number').text(res.current_page)
                    $('.pagination-right-number').text(res.last_page)
                    $(".pagination-part .left-arrow").attr('data-href', res.prev_page_url)
                    $(".pagination-part .right-arrow").attr('data-href', res.next_page_url)
                    if (res.data.length > 0){
                        domLoad(res.data)
                    }else {
                        $('#users-list').empty().append(`<div class="users row g-0">
                                    <div class="col-12 col-md-12 col-lg-12 text-center"><span>No Data Available</span></div>
                                </div>`)

                    }
                    selectCheckboxes()
                }
            });

        })
        $('#user-designation').on('change', function () {
            // removeClassFromPaginationArrow('filterByDesignation')
            removeClassFromPaginationArrow('searchUser')
            removeClassFromPaginationArrow('filterByName')
            let designation= $('#user-designation').find(":selected").val()
            let url = '{{route('user.filter.designation', ':designation')}}'
            url= url.replace(':designation', designation)
            $.ajax({
                url: url,
                success: function(res) {
                    console.log(res)
                    $('#showNoOfUser').text(res.data.length + ' out of '+ res.total)
                    console.log('res',res.data.length)
                    determinePaginationArrow(res)
                    injectClass('filterByDesignation')

                    $('.pagination-left-number').text(res.current_page)
                    $('.pagination-right-number').text(res.last_page)
                    $(".pagination-part .left-arrow").attr('data-href', res.prev_page_url)
                    $(".pagination-part .right-arrow").attr('data-href', res.next_page_url)
                    if (res.data.length > 0){
                        domLoad(res.data)
                    }else {
                        $('#users-list').empty().append(`<div class="users row g-0">
                                    <div class="col-12 col-md-12 col-lg-12 text-center"><span>No Data Available</span></div>
                                </div>`)

                    }
                    selectCheckboxes()
                }
            });
        })
        function injectClass(className){
            $(".pagination-part .right-arrow").addClass(className)
            $(".pagination-part .left-arrow").addClass(className)
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

        function filterByName(){
            removeClassFromPaginationArrow('searchUser')
            removeClassFromPaginationArrow('filterByDesignation')
            if (order =='DESC'){
                order='ASC'
                $('#order').text('ASC')

            }else {
                order='DESC'
                $('#order').text('DESC')

            }
            let url = "{{ route('user.filter.name', ':order') }}"
            url=url.replace(':order', order)
            // let wrapper = "#t-body"
            $.ajax({
                url: url,
                success: function(res) {
                    $('#showNoOfUser').text(res.data.length + ' out of '+ res.total)
                    determinePaginationArrow(res)
                    $('.pagination-left-number').text(res.current_page)
                    $('.pagination-right-number').text(res.last_page)
                    injectClass('filterByName')
                    $(".pagination-part .left-arrow").attr('data-href', res.prev_page_url)
                    $(".pagination-part .right-arrow").attr('data-href', res.next_page_url)
                    domLoad(res.data)
                    selectCheckboxes()
                }
            });


        }



    </script>
    <script>
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
    </script>


@endpush
