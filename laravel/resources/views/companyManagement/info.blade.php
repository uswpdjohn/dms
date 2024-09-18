@extends('layouts.master')
@section('content')
    <div class="row main-body g-0">
{{--        @if($response!=null)--}}
        <div class="customer-dashboard-top-portion row g-0">
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
            <div class="card">
                <div class="card-body row">

                    <!-- TT97 changes starts -->
                    <div class="col-8 col-md-9 col-lg-10 ps-0 company-info-part d-flex" style="margin-left: 60px;">
                        <h5 class="company-name">{{$response->name}}</h5>
                        <div class="company-info-sec d-flex">
                            <label for="" class="company-info-label">UEN:</label>
                            <p class="company-info-data">{{$response->uen}}</p>
                        </div>
                    </div>
                    <!-- TT97 changes ends -->
                </div>
            </div>
        </div>
        <div class="customer-dashboard-left-card-portion col-12 col-lg-6">
            <div class="company-info card">
                <div class="card-body row">
                    <div class="col-12">
                        <label for="" class="company-info-label">Business Activity 1</label>
                        <p class="company-info-data">{{$response->primary_industry_service_ssic->title}}</p>
                    </div>
                    @if($response->secondary_industry_service_ssic != null)
                        <div class="col-12">
                            <label for="" class="company-info-label">Business Activity 2</label>
                            <p class="company-info-data">{{$response->secondary_industry_service_ssic->title ?? ''}}</p>
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
                            <p class="company-info-data company-info-last-data">{{\Carbon\Carbon::parse($response->fye)->format('d M y')}}</p>
                        </div>
                    @endif
                    <div class="col-6">
                        <label for="" class="company-info-label">Incorporation Date</label>
                        <p class="company-info-data company-info-last-data">{{\Carbon\Carbon::parse($response->incorporation_date)->format('d M y')}}</p>
                    </div>
                </div>
            </div>
            <div>
                <p class="section-title">Tickets</p>
            </div>
            <div class="card create-ticket-card">
                <form action="{{route('ticket.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @honeypot
                    <div class="card-body row">
                        <a href="{{route('ticket.index')}}" class="see-all-ticket-btn">See All</a>
                        <div class="col-12 col-sm-6 col-md-6">
                            <label for=""><span class="required-sign">*</span>Category</label>
                            <select class="form-control select form-select select2" name="category_id" id="category_id" >
                                <option hidden class="first-option" value="" readonly="readonly">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                            <span class="text-danger">@error('category_id'){{ $message }}@enderror</span>
                        </div>

                        <div class="col-12 col-sm-6 col-md-6">
                            <label for="">File <span class="optional-text">(Optional)</span></label>
                            <input type="file" class="form-control upload-file"  name="file" id="file">
                        </div>
                        <div class="col-12 col-sm-9 col-md-9">
                            <label for="" class="mt-3"><span class="required-sign">*</span> Message</label>
                            <textarea class="form-control mb-1" name="message" id="message" rows="2" placeholder="Textarea placeholder"></textarea>
                            <span class="text-danger">@error('message'){{ $message }}@enderror</span>
                        </div>

                        <div class="col-12 col-sm-3 col-md-3">
                            <button type="submit" class="create-ticket-btn submit-btn btn">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="customer-dashboard-right-card-portion col-12 col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h6 class="director-header">Directors</h6>
                    @forelse ($response->directors as $user)
                        <div class="directors">
                            <p>{{$user->full_name.' ('. $user->email.')'}}</p>
                            @foreach($user->ccs as $cc)
                                @if($cc != NULL)
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
                                @if($cc != NULL)
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
{{--        @endif--}}
    </div>
{{--    <!-- Main Body Start -->--}}
{{--    <div class="row main-body g-0">--}}
{{--            <div class="customer-business-info-top-portion row g-0">--}}
{{--                <div class="col-2 col-md-2">--}}
{{--                    <img class="b-info-img" src="{{asset('assets/images/company.jpg')}}" alt="">--}}
{{--                </div>--}}
{{--                <div class="col-8 col-md-9">--}}
{{--                    <h5>{{$response->name}}</h5>--}}
{{--                </div>--}}
{{--                --}}{{--TODO--}}
{{--                place @can for Edit button --}}
{{--                <div class="col-2 col-md-1">--}}
{{--                    <a href="#" class="btn edit-btn btn-sm">Edit</a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="customer-business-info-left-card-portion col-12 col-lg-6">--}}
{{--                <div class="company-info card">--}}
{{--                    <div class="card-body row">--}}
{{--                        <div class="col-4">--}}
{{--                            <label for="" class="company-info-label">UEN</label>--}}
{{--                            <p class="company-info-data">{{$response->uen}}</p>--}}
{{--                        </div>--}}
{{--                        <div class="col-4">--}}
{{--                            <label for="" class="company-info-label">GST Registered</label>--}}
{{--                            <p class="company-info-data">{{$response->gst_reg_no}}</p>--}}
{{--                        </div>--}}
{{--                        <div class="col-4">--}}
{{--                            <label for="" class="company-info-label">Headquarters</label>--}}
{{--                            <p class="company-info-data">{{$response->location->headquaters}}</p>--}}
{{--                        </div>--}}
{{--                        <div class="col-12">--}}
{{--                            <label for="" class="company-info-label">Address</label>--}}
{{--                            <p class="company-info-data">{{$response->location->address_line}}</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="company-info card">--}}
{{--                    <div class="card-body row">--}}
{{--                        <div class="col-6">--}}
{{--                            <label for="" class="company-info-label">Company Age</label>--}}
{{--                            <p class="company-info-data">{{$response->company_age}}</p>--}}
{{--                        </div>--}}
{{--                        <div class="col-6">--}}
{{--                            <label for="" class="company-info-label">Incorporation Date</label>--}}
{{--                            <p class="company-info-data">{{\Carbon\Carbon::parse($response->incorporation_date)->format('d M y')}}</p>--}}
{{--                        </div>--}}
{{--                        <div class="col-6">--}}
{{--                            <label for="" class="company-info-label">Additional 1</label>--}}
{{--                            <p class="company-info-data">Additional 1</p>--}}
{{--                        </div>--}}
{{--                        <div class="col-6">--}}
{{--                            <label for="" class="company-info-label">Additional 2</label>--}}
{{--                            <p class="company-info-data">Additional 2</p>--}}
{{--                        </div>--}}
{{--                        <div class="col-6">--}}
{{--                            <label for="" class="company-info-label">No. of Office</label>--}}
{{--                            <p class="company-info-data">{{$response->no_of_offices}}</p>--}}
{{--                        </div>--}}
{{--                        <div class="col-6">--}}
{{--                            <label for="" class="company-info-label">No. of Employees</label>--}}
{{--                            <p class="company-info-data">{{$response->no_of_employees}}</p>--}}
{{--                        </div>--}}
{{--                        <div class="col-6">--}}
{{--                            <label for="" class="company-info-label">Additional 3</label>--}}
{{--                            <p class="company-info-data">Additional 3</p>--}}
{{--                        </div>--}}
{{--                        <div class="col-6">--}}
{{--                            <label for="" class="company-info-label">Additional </label>--}}
{{--                            <p class="company-info-data">Additional 4</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="customer-business-info-right-card-portion col-12 col-lg-6">--}}
{{--            <div class="card">--}}
{{--                <div class="card-body row">--}}
{{--                    <h6 class="director-header">Directors</h6>--}}
{{--                    @forelse ($response->directors as $user)--}}
{{--                        <div class="directors col-9 col-md-7">--}}
{{--                            <p>{{$user->full_name.' ('. $user->email.')'}}</p>--}}
{{--                            @foreach($user->ccs as $cc)--}}
{{--                                <p>cc: {{$cc}}</p>--}}
{{--                            @endforeach--}}
{{--                        </div>--}}
{{--                    @empty--}}
{{--                        <div class="directors col-9 col-md-7">--}}
{{--                            <p>No Director Found</p>--}}
{{--                        </div>--}}
{{--                    @endforelse--}}
{{--                    <h6 class="shareholder-header">Shareholders</h6>--}}
{{--                    @forelse ($response->shareholders as $user)--}}
{{--                        <div class="shareholders col-9 col-md-7">--}}
{{--                            <p>{{$user->full_name.' ('. $user->email.')'}}</p>--}}
{{--                            @foreach($user->ccs as $cc)--}}
{{--                                <p>cc: {{$cc}}</p>--}}
{{--                            @endforeach--}}
{{--                        </div>--}}
{{--                    @empty--}}
{{--                        <div class="directors col-9 col-md-7">--}}
{{--                            <p>No Shareholder Found</p>--}}
{{--                        </div>--}}
{{--                    @endforelse--}}
{{--                    @forelse ($response->users as $user)--}}
{{--                        <div class="shareholders col-9 col-md-7">--}}
{{--                            <p>{{$user->full_name.'('. $user->email.')'}}</p>--}}
{{--                        </div>--}}
{{--                    @empty--}}
{{--                        <div class="directors col-9 col-md-7">--}}
{{--                            <p>No Shareholder Found</p>--}}
{{--                        </div>--}}
{{--                    @endforelse--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <!-- Main Body End -->--}}
@endsection
@push('customScripts')
    <script>
        $(document).ready(function() {
            $(".select2").select2();
            $(".select2").select2({
                allowClear: true
            });
        });
    </script>
@endpush
