@extends('layouts.master')
@section('content')
    <!-- Main Body Start -->
    <div class="row main-body g-0">
        <div class="admin-company-management-view-top-portion row g-0">
            <div class="card">
                <div class="card-body row">
                    <div class="col-12 col-md-3 col-lg-3 col-xl-2 col-xxl-1 company-img">
                        @if($response->image != null )
                            <img class="b-info-img" src="{{url('/assets/images/'.$response->image)}}" alt="">
                        @else
                            <img class="b-info-img" src="{{asset('assets/images/company.jpg')}}" alt="">
                        @endif
                    </div>
                    <div class="col-12 col-md-9 col-lg-9 col-xl-10 col-xxl-11 ps-0 company-data-container">
                        <div class="d-flex company-data-inner">
                            <h5 class="company-name">{{$response->name}}</h5>
                            <div class="d-flex ms-auto company-data-btns">
                                @if (auth()->guard('web')->user()->can('edit.company_management'))
                                    <a href="{{route('company.edit',$response->slug)}}" type="button" class="btn edit-btn">Edit</a>
                                @endif
{{--                                @if (auth()->guard('web')->user()->can('index.billing_admin') || auth()->guard('web')->user()->can('create.billing_admin') || auth()->guard('web')->user()->can('edit.billing_admin') || auth()->guard('web')->user()->can('delete.billing_admin'))--}}
{{--                                    <a href="{{route('billing.index')}}" type="button" class="btn billing-btn ">Billing</a>--}}
{{--                                @endif--}}
                                <!-- Back button add starts-->
                                <a href="#" type="button" data-bs-toggle="modal" data-bs-target="#companyExitModal" class="btn edit-btn">Back</a>
                                <!-- Delete Modal Start -->
                                <div class="modal fade" id="companyExitModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="companyExitModalLabel" aria-hidden="true">
                                    <div class="modal-dialog company-exit-modal">
                                        <div class="modal-content">
                                            <div class="company-exit-modal-body">
                                                <p class="text-center">Confirm Exit</p>
                                                <div class="text-center">
                                                    <button type="button" class="btn btn-sm company-exit-modal-close-btn" data-bs-dismiss="modal" aria-label="No">No</button>
                                                    <a href="{{route('company.index')}}"  class="btn btn-sm yes-btn">Yes</a>
{{--                                                    <button onclick="back()" type="button" class="btn btn-sm yes-btn">Yes</button>--}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Delete Modal End -->

                                <!-- Back button add ends-->
                            </div>
                        </div>
                        <div class="d-flex company-dates">
                            <!-- TT97 changes starts -->
                            <div class="d-flex company-info-sec">
                                <label for="" class="company-info-label uen-label">UEN:</label>
                                <div class="d-flex">
                                    <p class="company-info-data">{{$response->uen}}</p>
                                </div>
                            </div>
                            <!-- TT97 changes ends -->
                            <div class="d-flex company-dates-inner">
                                <div class="company-date-box">
                                    <label for="" class="company-info-label">Date Joined</label>
                                    <div class="d-flex">
                                        <p class="company-info-data mt-2">{{\Carbon\Carbon::parse($response->created_at)->format('d M Y')}}</p>
                                    </div>
                                </div>

                                <div class="company-date-box">
                                    <label for="" class="company-info-label">Renewal Date</label>
                                    <div class="d-flex row">
{{--                                        @if(count($response->invoices) > 0)--}}
{{--                                            <p class="company-info-data mt-2">{{\Carbon\Carbon::parse($response->invoices[0]->subscription_end)->format('d M Y')}}</p>--}}
                                            <p class="company-info-data mt-2">--</p>
{{--                                        @else--}}
{{--                                            <div class="text-center"><p class="company-info-data mt-2">--</p></div>--}}
{{--                                        @endif--}}
                                    </div>

                                </div>
                            </div>

{{--                        <label for="" class="company-info-label">UEN</label>--}}
{{--                        <div class="d-flex">--}}
{{--                            <p class="company-info-data mt-2">{{$response->uen}}</p>--}}
{{--                        </div>--}}
                    </div>
                </div>
            </div>
        </div>
        <div class="admin-company-management-view-left-card-portion col-12 col-lg-6">
            <div class="company-info card">
                <div class="card-body row">
                    <div class="col-12">
                        <label for="" class="company-info-label">Business Activity 1</label>
                        <p class="company-info-data">{{$response->primary_industry_service_ssic->code. ' - '.$response->primary_industry_service_ssic->title}}</p>
                    </div>
                    @if($response->secondary_industry_service_ssic != null)
                    <div class="col-12">
                        <label for="" class="company-info-label">Business Activity 2</label>
                        <p class="company-info-data">{{$response->secondary_industry_service_ssic->code. ' - '.$response->secondary_industry_service_ssic->title}}</p>
                    </div>
                    @endif

                    <div class="col-12">
                        <label for="" class="company-info-label">Address</label>
                        <p class="company-info-data company-info-last-data">{{$response->address_line}}</p>
                    </div>

                </div>
            </div>
            <div class="company-info card">
                <div class="card-body row">
                    @if($response->fye != null)
                        <div class="col-6">
                            <label for="" class="company-info-label">FYE</label>
                            <p class="company-info-data company-info-last-data">{{\Carbon\Carbon::parse($response->fye)->format('d M')}}</p>
                        </div>
                    @endif
                    <div class="col-6">
                        <label for="" class="company-info-label">Incorporation Date</label>
                        <p class="company-info-data company-info-last-data">{{\Carbon\Carbon::parse($response->incorporation_date)->format('d M Y')}}</p>
                    </div>
                    @if($response->last_ar_filed != null)
                        <div class="col-6">
                            <label for="" class="company-info-label">Last AR Filed</label>
                            <p class="company-info-data company-info-last-data">{{\Carbon\Carbon::parse($response->last_ar_filed)->format('d M')}}</p>
                        </div>
                    @endif
                    @if($response->last_agm_filed != null)
                        <div class="col-6">
                            <label for="" class="company-info-label">Last AGM Filed</label>
                            <p class="company-info-data company-info-last-data">{{\Carbon\Carbon::parse($response->last_agm_filed)->format('d M Y')}}</p>
                        </div>
                    @endif

                </div>
            </div>
            <div class="user-card card">
                <div class="card-body">
                    <h6 class="users-header">Users</h6>
                    @forelse ($response->users as $user)
                        <div class="users">
                            <p>{{$user->full_name.' ('. $user->email.')'}}</p>
{{--                            @foreach($user->ccs as $cc)--}}
{{--                                <p>cc: {{$cc}}</p>--}}
{{--                            @endforeach--}}
                        </div>
                    @empty
                        <div class="users">
                            <p>No User Found</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
        <div class="admin-company-management-view-right-card-portion col-12 col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h6 class="director-header">Directors</h6>
                    @forelse ($response->directors as $user)
                        <div class="directors">
                            <p>{{$user->full_name.' ('. $user->email.')'}}</p>
                            @foreach($user->ccs as $cc)
                                @if($cc != Null)
                                <p>cc: {{$cc}}</p>
                                @endif
                            @endforeach
                        </div>
                    @empty
                        <div class="directors col-9 col-md-7">
                            <p>No Director Found</p>
                        </div>
                    @endforelse
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h6 class="shareholder-header">Shareholders</h6>
                    @forelse ($response->shareholders as $user)
                        <div class="shareholders">
                            <p>{{$user->full_name.' ('. $user->email.')'}}</p>
                            @foreach($user->ccs as $cc)
                                @if($cc != Null)
                                <p>cc: {{$cc}}</p>
                                @endif
                            @endforeach
                        </div>
                    @empty
                        <div class="directors col-9 col-md-7">
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
        function back() {
            window.history.go(-1);
        }
    </script>
@endpush
