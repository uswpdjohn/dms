@extends('layouts.master')
@section('content')
    <!-- Main Body Start -->
    <div class="row main-body g-0">
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
        <div class="card admin-dashboard-overview-card col-12 col-md-10 col-lg-9">
            <div class="card-body header-card-body">

                <div class="col-12 col-md-12 col-lg-12">
                    <div class="pie-chart-container">
                        <div id="customerPieChart" class="customer-pie-chart"></div>
                    </div>

                </div>
            </div>
        </div>

    </div>

    <!-- Main Body End -->

@endsection
@push('customScripts')

    <script>
        // $(".select2").select2({
        //     allowClear: true,
        //     theme: 'bootstrap-5'
        // })


    </script>
@endpush
