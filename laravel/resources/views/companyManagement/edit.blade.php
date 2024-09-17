@extends('layouts.master')
@section('content')
    <!-- Main Body Start -->
    <div class="row main-body g-0">
        <div class="customer-business-info-edit-top-portion row g-0">
            <div class="col-12">
                <div class="top-btns">
                    <a href="#" class="btn cancel-btn">Cancel</a>
                    <button type="button" class="btn edit-btn active">Request Change</button>
                </div>
            </div>
        </div>
        <div class="customer-business-info-edit-left-card-portion col-12 col-lg-6">
            <div class="company-info card">
                <form action="#">
                    <div class="card-body row">
                        <div class="row justify-content-center image-part">
                            <div class="col-6  col-md-4 text-center">
                                <img class="b-info-img" src="../../assets/images/Company.jpg" alt="">
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="" class="company-info-label">Company Name</label>
                            <input class="form-control" type="text" name="">
                        </div>
                        <div class="col-4">
                            <label for="" class="company-info-label">UEN</label>
                        </div>
                        <div class="col-4">
                            <label for="" class="company-info-label">GST Registrated</label>
                        </div>
                        <div class="col-4">
                            <label for="" class="company-info-label">Headquarters</label>
                        </div>
                        <div class="col-4">
                            <input class="form-control" type="text" name="">
                        </div>
                        <div class="col-4">
                            <input class="form-control" type="text" name="">
                        </div>
                        <div class="col-4">
                            <input class="form-control" type="text" name="">
                        </div>
                        <div class="col-12">
                            <label for="" class="company-info-label">Address</label>
                            <input class="form-control" type="text" name="">
                        </div>
                        <div class="col-6">
                            <label for="" class="company-info-label">Company Age</label>
                            <input class="form-control" type="text" name="">
                        </div>
                        <div class="col-6">
                            <label for="" class="company-info-label">Incorparation Date</label>
                            <input class="form-control" type="text" name="">
                        </div>
                        <div class="col-6">
                            <label for="" class="company-info-label">No. of Office</label>
                            <input class="form-control" type="text" name="">
                        </div>
                        <div class="col-6">
                            <label for="" class="company-info-label">No. of Employees</label>
                            <input class="form-control" type="text" name="">
                        </div>
                        <button class="d-none submit-btn" type="submit" ></button>
                    </div>
                </form>
            </div>
        </div>
        <div class="customer-business-info-edit-right-card-portion col-12 col-lg-6">
            <div class="card">
                <div class="card-body row">
                    <h6 class="director-header">Directors</h6>
                    <div class="directors col-9 col-md-7">
                        <p>Derek Timothy (derektimothy@trilliongroup.com)</p>
                        <p>cc: samantha@trilliongroup.com</p>
                        <p>cc: yingtze@trilliongroup.com</p>
                        <p>cc: aaron@trilliongroup.com</p>
                    </div>
                    <div class="directors col-9 col-md-7">
                        <p>Wayne Rooney (waynerooney@trilliongroup.com)</p>
                        <p>cc: samantha@trilliongroup.com</p>
                        <p>cc: yingtze@trilliongroup.com</p>
                        <p>cc: aaron@trilliongroup.com</p>
                    </div>
                    <h6 class="shareholder-header">Shareholders</h6>
                    <div class="shareholders col-9 col-md-7">
                        <p>Derek Timothy (derektimothy@trilliongroup.com)</p>
                        <p>cc: samantha@trilliongroup.com</p>
                        <p>cc: yingtze@trilliongroup.com</p>
                        <p>cc: aaron@trilliongroup.com</p>
                    </div>
                    <div class="shareholders col-9 col-md-7">
                        <p>Wayne Rooney (waynerooney@trilliongroup.com)</p>
                        <p>cc: samantha@trilliongroup.com</p>
                        <p>cc: yingtze@trilliongroup.com</p>
                        <p>cc: aaron@trilliongroup.com</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- Main Body End -->
@endsection
@push('customScripts')
    <script>
        $(document).ready(function(){
            $('.edit-btn').click(function(){
                console.log('clicked')
                $('.submit-btn').click();
            });
        });
    </script>
@endpush
