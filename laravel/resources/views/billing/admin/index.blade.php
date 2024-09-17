@extends('layouts.master')
@section('content')
    <!-- Main Body Start -->
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
        <div id="flashMessages"></div>
{{--        <div class="alert alert-success create">--}}
{{--            <img class="alert-img" src="{{asset('assets/icons/success-alert-icon.png')}}" alt="">--}}
{{--            <p class="alert-text"> Invoice created successfully.</p>--}}
{{--        </div>--}}
{{--        <div class="alert alert-success update">--}}
{{--            <img class="alert-img" src="{{asset('assets/icons/success-alert-icon.png')}}" alt="">--}}
{{--            <p class="alert-text"> Invoice updated successfully.</p>--}}
{{--        </div>--}}
{{--        <div class="alert alert-success void">--}}
{{--            <img class="alert-img" src="{{asset('assets/icons/success-alert-icon.png')}}" alt="">--}}
{{--            <p class="alert-text"> Invoice voided successfully.</p>--}}
{{--        </div>--}}
        <div class="row admin-billing-body g-0">
            <div class="col-12 col-md-12 ">
                <div class="card admin-billing-card">
                    <!--Create Bill Portion Starts -->
                    <div id="create-bill" class="d-none card-body adminBillingTabContent admin-billing-create-container create-bill">

                        <div class="top-part-div ">
                            <button class="back-btn btn" onclick="goBack(event,'billing')"><i class="fa-solid fa-arrow-left"></i></button>
                            <h5 class="top-header">Create an Invoice</h5>
                        </div>

                       <div>
                           <form action="#" method="POST" id="invoice_create">
                               <meta name="csrf-token" content="{{ csrf_token() }}" />
                               <div  class="tabcontent middle-part-div">
                                       <div class="row ">
                                           {{--                                    <input name="category-name" value="" type="text" hidden />--}}
                                           <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                               <fieldset class="form-group">
                                                   <label for="company_id" class="mb-2 mt-3"><span class="required-sign">*</span>Company Name</label>
                                                   <select class="form-control select form-select select2" name="company_id" id="company_id">
                                                       <option hidden class="first-option" value="">Select</option>
                                                       @foreach($companies as $company)
                                                           <option value="{{$company->id}}">{{$company->name}}</option>
                                                       @endforeach
                                                   </select>
                                               </fieldset>
                                               <span class="text-danger invoice-company_id"></span>
                                           </div>
                                           <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                               <fieldset class="form-group">
                                                   <label for="cust_name" class="mb-2 mt-3"><span class="required-sign">*</span>Customer Name</label>
                                                   <select class="form-control select form-select" name="user_id" id="user_id" disabled>
                                                       <option hidden class="first-option" value="">Please select company first</option>
                                                   </select>
                                               </fieldset>
                                               <span class="text-danger invoice-user_id"></span>
                                           </div>
                                           <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                               <div class="form-group">
                                                   <label for="cust_mail" class="mb-2 mt-3"><span class="required-sign">*</span>Customer Email</label>
                                                   <input type="text" class="form-control" name="cust_mail" id="cust_mail" readonly>
                                               </div>
                                           </div>
                                           <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-4 col-xxl-4">
                                               <div class="form-group">
                                                   <label for="adrs" class="mb-2 mt-3"><span class="required-sign">*</span>Billing Address Line</label>
                                                   <textarea type="text" placeholder="Address Line" class="form-control" name="billing_address" id="billing_address"></textarea>
                                               </div>
                                               <span class="text-danger invoice-billing_address"></span>
                                           </div>
                                           <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-2 col-xxl-2">
                                               <div class="form-group">
                                                   <label for="terms" class="mb-2 mt-3"><span class="required-sign">*</span>Terms (Days)</label>
                                                   <input type="number" class="form-control" name="terms" min="0" id="terms">
                                               </div>
                                               <span class="text-danger invoice-terms"></span>
                                           </div>
                                           <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-2 col-xxl-2">
                                               <div class="form-group">
                                                   <label for="invoice_date" class="mb-2 mt-3"><span class="required-sign">*</span>Invoice Date</label>
                                                   <input type="date" class="form-control" name="invoice_date" id="invoice_date"  value="{{\Carbon\Carbon::today()->toDateString()}}">
                                               </div>
                                               <span class="text-danger invoice-invoice_date"></span>
                                           </div>
                                           <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-2 col-xxl-2">
                                               <div class="form-group">
                                                   <label for="due_date" class="mb-2 mt-3"><span class="required-sign">*</span>Due Date</label>
                                                   <input type="date" class="form-control" name="due_date" id="due_date" readonly>
                                               </div>
                                               <span class="text-danger invoice-due_date"></span>
                                           </div>
                                           <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-2 col-xxl-2">
                                               <div class="form-group">
                                                   <label for="created_by" class="mb-2 mt-3"><span class="required-sign">*</span>Created By</label>
                                                   <input type="text" class="form-control" name="created_by" id="created_by" value="{{auth()->guard('web')->user()->getFullNameAttribute()}}" readonly>
                                                   <input type="text" class="form-control" name="admin_user_id" id="admin_user_id" value="{{auth()->guard('web')->user()->id}}" readonly hidden="hidden">
                                               </div>
                                               <span class="text-danger invoice-created_by"></span>
                                           </div>
                                           <br>
                                           {{--                                    <div class="col-sm-12 col-md-6 mt-2">--}}
                                           {{--                                        <button type="submit" class="btn admin-bill-create-submit-btn" hidden >Submit</button>--}}
                                           {{--                                    </div>--}}
                                       </div>
                                   {{--                            </form>--}}
                               </div>
                               <div class="table-responsive">
                               <div class="tabcontent bottom-header-div">
                                   <div class="bottom-header row ">
                                       <div class="col-6 col-md-6 col-lg-6 header-div">
                                           <p class=""># &nbsp;&nbsp;&nbsp; Subscription & Description</p>
                                       </div>
                                       <div class="col-2 col-md-2 col-lg-2 header-div">
                                           <p><span class="required-sign">*</span>Date Start/End</p>
                                       </div>
                                       <div class="col-2 col-md-2 col-lg-2 header-div">
                                           <p>Discount</p>
                                       </div>
                                       <div class="col-2 col-md-2 col-lg-2 header-div">
                                           <p><span class="required-sign">*</span>Subtotal</p>
                                       </div>
                                   </div>
                               </div>
                               <div class="tabcontent bottom-part-div">
                                   {{--                                <form action="gone">--}}
                                   <div class="bottom-first row">
                                       <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                                           <div class="form-group">
                                               <label for="description" class="mb-2 mt-1"><span class="required-sign">*</span>Description</label>
                                               <textarea rows="4" type="text" class="form-control" placeholder="Description" name="description" id="description"></textarea>
                                           </div>
                                           <span class="text-danger invoice-description"></span>
                                       </div>
                                       <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2 col-xxl-2">
                                           <div class="form-group">
                                               <label for="subscription_start" class="mb-2 mt-1">&nbsp;&nbsp;&nbsp;</label>
                                               <input type="date"  class="form-control take_past_date" name="subscription_start" id="subscription_start" placeholder="Start Date">
                                               <span class="text-danger invoice-subscription_start"></span>
                                               <label for="subscription_end" class="mb-2 mt-1"></label>
                                               <input type="date"  class="form-control take_future_date" name="subscription_end" id="subscription_end" placeholder="End Date">
                                               <span class="text-danger invoice-subscription_end"></span>
                                           </div>
                                       </div>
                                       <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2 col-xxl-2">
                                           <div class="form-group">
                                               <label for="discount" class="mb-2 mt-1">&nbsp;&nbsp;&nbsp;</label>
                                               <input type="number" min="0.00" max="10000.00" step="0.01" class="form-control" placeholder="0" name="discount" id="discount">
                                           </div>
                                       </div>
                                       <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2 col-xxl-2">
                                           <div class="form-group">
                                               <label for="sub_total" class="mb-2 mt-1">&nbsp;&nbsp;&nbsp;</label>
                                               <input type="number" min="0.00" step="0.01" class="form-control" placeholder="0" id="init_sub_total">
                                           </div>
                                           <span class="text-danger invoice-sub_total"></span>
                                       </div>
                                   </div>
                                   <div class="bottom-second row">
                                       <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                                           <div class="form-group">
                                               <label for="notes" class="mb-2 mt-3">Notes</label>
                                               <textarea type="text" placeholder="Notes for Customer" class="form-control" rows="7" name="notes" id="notes"></textarea>
                                           </div>
                                       </div>
                                       <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6 total-div">
                                           <div class="invoice-summary">
                                               <div class="invoice subtotal row">
                                                   <p class="col-6 title">Subtotal:</p>
                                                   <p class="col-6" id="create_sub_total_text">S$0.00</p>
                                                   <input type="text" name="sub_total" value="" id="sub_total" hidden="hidden" readonly>
                                               </div>
                                               <div class="invoice discount row">
                                                   <p class="col-6 title">Discount:</p>
                                                   <p class="col-6" id="create_discount_text">S$0.00</p>
                                               </div>
                                               <div class="invoice gst row">
                                                   <div class="gst-inner col-6 title">
                                                       <label for="gst" class="">GST</label>
                                                       <select class="gst-select" name="gst" id="gst">
                                                           <option value="8">8%</option>
                                                           <option value="9">9%</option>
                                                           <option value="10">10%</option>
                                                       </select>
                                                   </div>
                                                   <p class="col-6 " id="create_gst_text">S$0.00</p>
                                               </div>
                                               <span class="text-danger invoice-gst"></span>
                                               <div class="invoice net-total row">
                                                   <p class="col-6 title">Net Total:</p>
                                                   <p class="col-6" id="create_grand_total_text">S$0.00</p><span class="text-danger invoice-grand_total"></span>

                                                   <input type="text" name="grand_total" value="" id="grand_total" readonly hidden="hidden">
                                               </div>
                                           </div>
                                       </div>

                                   </div>
                                   <div class="col-sm-12 col-md-6 mt-2">
                                       <button type="button" class="btn admin-bill-create-submit-btn" id="create-submit" hidden >Submit</button>
                                   </div>
{{--                                   </form>--}}
                               </div>
                           </div>
                           </form>
                       </div>
                        <div class="admin-bill-create-btn-section tabcontent ">
                            <button type="button" class="btn admin-bill-create-send-btn mt-3" id="create-send">Create</button>
                        </div>
                    </div>
                    <!--  Create Bill Portion Ends -->


                    <!--Edit Bill Portion Starts -->
                    <div id="edit-bill" class="d-none card-body adminBillingTabContent admin-billing-create-container edit-bill">
                        <div class="top-part-div ">
                            <button class="back-btn btn" onclick="goBack(event,'billing')"><i class="fa-solid fa-arrow-left"></i></button>
                            <h5 class="top-header">Edit Invoice</h5>
                        </div>
                        <div>
                            <form action="" id="update_invoice">
                                <meta name="csrf-token" content="{{ csrf_token() }}" />
                                <input type="text" id="invoice_id" value="" readonly hidden="hidden">
                                <div  class="tabcontent middle-part-div">
                                    <div class="row ">
                                        <input name="category-name" value="" type="text" hidden />
                                        <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                            <fieldset class="form-group">
                                                <label for="company_name" class="mb-2 mt-3"><span class="required-sign">*</span>Company Name</label>
                                                <select class="form-control select form-select select2" name="company_id" id="edit_company_id">
                                                </select>
                                            </fieldset>
                                            <span class="text-danger edit-invoice-company_id"></span>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                            <fieldset class="form-group">
                                                <label for="cust_name" class="mb-2 mt-3"><span class="required-sign">*</span>Customer Name</label>
                                                <select class="form-control select form-select" name="user_id" id="edit_cust_name">
                                                    <option hidden class="first-option" value="">Select</option>
                                                </select>
                                            </fieldset>
                                            <span class="text-danger edit-invoice-user_id"></span>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                            <div class="form-group">
                                                <label for="cust_mail" class="mb-2 mt-3"><span class="required-sign">*</span>Customer Email</label>
                                                <input type="text" class="form-control" name="cust_mail" id="edit_cust_mail" readonly>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-4 col-xxl-4">
                                            <div class="form-group">
                                                <label for="adrs" class="mb-2 mt-3"><span class="required-sign">*</span>Billing Address Line</label>
                                                <textarea type="text" placeholder="Address Line" class="form-control" name="billing_address" id="edit_billing_address"></textarea>
                                            </div>
                                            <span class="text-danger edit-invoice-billing_address"></span>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-2 col-xxl-2">
                                            <div class="form-group">
                                                <label for="terms" class="mb-2 mt-3"><span class="required-sign">*</span>Terms (Days)</label>
                                                <input type="number" class="form-control" name="terms" id="edit_terms">
                                            </div>
                                            <span class="text-danger edit-invoice-terms"></span>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-2 col-xxl-2">
                                            <div class="form-group">
                                                <label for="inv_date" class="mb-2 mt-3"><span class="required-sign">*</span>Invoice Date</label>
                                                <input type="date" class="form-control" name="invoice_date" id="edit_invoice_date">
                                            </div>
                                            <span class="text-danger edit-invoice-invoice_date"></span>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-2 col-xxl-2">
                                            <div class="form-group">
                                                <label for="due_date" class="mb-2 mt-3"><span class="required-sign">*</span>Due Date</label>
                                                <input type="date" class="form-control" name="due_date" id="edit_due_date" readonly>
                                            </div>
                                            <span class="text-danger edit-invoice-due_date"></span>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-2 col-xxl-2">
                                            <div class="form-group">
                                                <label for="created_by" class="mb-2 mt-3"><span class="required-sign">*</span>Created By</label>
                                                <input type="text" class="form-control" name="created_by" id="edit_created_by" readonly>
                                                <input type="text" class="form-control" name="admin_user_id" id="edit_admin_user_id" value="{{auth()->guard('web')->user()->id}}" readonly hidden="hidden">
                                            </div>
                                            <span class="text-danger edit-invoice-created_by"></span>
                                        </div>
{{--                                        <br>--}}
{{--                                        <div class="col-sm-12 col-md-6 mt-2">--}}
{{--                                            <button type="submit" class="btn admin-bill-create-submit-btn" hidden >Submit</button>--}}
{{--                                        </div>--}}
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <div class="tabcontent bottom-header-div">
                                        <div class="bottom-header row ">
                                            <div class="col-6 col-md-6 col-lg-6 header-div">
                                                <p class=""># &nbsp;&nbsp;&nbsp; Subscription & Description</p>
                                            </div>
                                            <div class="col-2 col-md-2 col-lg-2 header-div">
                                                <p><span class="required-sign">*</span>Date Start/End</p>
                                            </div>
                                            <div class="col-2 col-md-2 col-lg-2 header-div">
                                                <p>Discount</p>
                                            </div>
                                            <div class="col-2 col-md-2 col-lg-2 header-div">
                                                <p><span class="required-sign">*</span>Subtotal</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tabcontent bottom-part-div">
                                    <div class="bottom-first row">
                                        <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                                            <div class="form-group">
                                                <label for="description" class="mb-2 mt-1"><span class="required-sign">*</span>Description</label>
                                                <textarea rows="4" type="text" class="form-control body-contents" placeholder="Description" name="description" id="edit_description"></textarea>
                                            </div>
                                            <span class="text-danger edit-invoice-description"></span>
                                        </div>
                                        <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2 col-xxl-2">
                                            <div class="form-group">
                                                <label for="s_date" class="mb-2 mt-1">&nbsp;&nbsp;&nbsp;</label>
                                                <input type="date"  class="form-control take_past_date" name="subscription_start" id="edit_subscription_start" placeholder="Start Date">
                                                <span class="text-danger edit-invoice-subscription_start"></span>
                                                <label for="e_date" class="mb-2 mt-1"></label>
                                                <input type="date"  class="form-control take_future_date" name="subscription_end" id="edit_subscription_end" placeholder="End Date">
                                                <span class="text-danger edit-invoice-subscription_end"></span>
                                            </div>
                                        </div>
                                        <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2 col-xxl-2">
                                            <div class="form-group">
                                                <label for="discount" class="mb-2 mt-1">&nbsp;&nbsp;&nbsp;</label>
                                                <input type="number" min="0.00" step="0.01" class="form-control" placeholder="0" name="discount" id="edit_discount">
                                            </div>
                                        </div>
                                        <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2 col-xxl-2">
                                            <div class="form-group">
                                                <label for="subtotal" class="mb-2 mt-1">&nbsp;&nbsp;&nbsp;</label>
                                                <input type="number" min="0.00" step="0.01" class="form-control" name="sub_total" placeholder="0" id="edit_sub_total">
                                            </div>
                                            <span class="text-danger edit-invoice-sub_total"></span>
                                        </div>
                                    </div>
                                    <div class="bottom-second row">
                                        <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                                            <div class="form-group">
                                                <label for="notes" class="mb-2 mt-3">Notes</label>
                                                <textarea type="text" placeholder="Notes for Customer" class="form-control" rows="7" name="notes" id="edit_notes"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6 total-div">
                                            <div class="invoice-summary">
                                                <div class="invoice subtotal row">
                                                    <p class="col-6 title">Subtotal:</p>
                                                    <p class="col-6" id="edit_sub_total_text">S$0.00</p>
                                                </div>
                                                <div class="invoice discount row">
                                                    <p class="col-6 title">Discount:</p>
                                                    <p class="col-6" id="edit_discount_text">S$0.00</p>
                                                </div>
                                                <div class="invoice gst row">
                                                    <div class="gst-inner col-6 title">
                                                        <label for="gst" class="">GST</label>
                                                        <select class="gst-select" name="gst" id="edit_gst">
                                                        </select>
                                                    </div>

                                                    <p class="col-6" id="edit_gst_text">S$0.00</p>
                                                </div>
                                                <div class="invoice net-total row">
                                                    <p class="col-6 title">Net Total:</p>
                                                    <p class="col-6" id="edit_grand_total_text">S$0.00</p>
                                                    <span class="text-danger edit-invoice-grand_total"></span>
                                                    <input type="text" name="grand_total" value="" id="edit_grand_total" readonly hidden="hidden">

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-sm-12 col-md-6 mt-2">
                                        <button type="button" id="edit-submit" class="btn admin-bill-create-submit-btn" hidden >Submit</button>
                                    </div>
                                </div>
                                </div>
                            </form>
                        </div>

                        <div class="admin-bill-create-btn-section tabcontent ">
                            <button type="button" class="btn admin-bill-create-send-btn mt-3" id="edit-send">Save</button>
                        </div>
                    </div>
                    <!--  Edit Bill Portion Ends -->

                    <!--View Bill Portion Starts -->
                    <div id="view-bill" class="d-none card-body adminBillingTabContent admin-billing-create-container view-bill">

                        <div class="top-part-div ">
                            <button class="back-btn btn" onclick="goBack(event,'billing')"><i class="fa-solid fa-arrow-left"></i></button>
                            <h5 class="top-header">View Invoice</h5>
                        </div>
                        <div  class="tabcontent middle-part-div">
                            <form action="gone">
                                <div class="row ">
{{--                                    <input name="category-name" value="" type="text" hidden />--}}
                                    <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <fieldset class="form-group">
                                            <label for="company_name" class="mb-2 mt-3">Company Name</label>
                                            <p class="form-output" id="view_company_id"></p>
                                        </fieldset>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <fieldset class="form-group">
                                            <label for="cust_name" class="mb-2 mt-3">Customer Name</label>
                                            <p class="form-output" id="view_cust_name"></p>
                                        </fieldset>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <div class="form-group">
                                            <label for="cust_mail" class="mb-2 mt-3">Customer Email</label>
                                            <p class="form-output" id="view_cust_mail"></p>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-4 col-xxl-4">
                                        <div class="form-group">
                                            <label for="adrs" class="mb-2 mt-3">Billing Address Line</label>
                                            <p class="form-output" id="view_billing_address"></p>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-2 col-xxl-2">
                                        <div class="form-group">
                                            <label for="terms" class="mb-2 mt-3">Terms (Days)</label>
                                            <p class="form-output" id="view_terms"></p>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-2 col-xxl-2">
                                        <div class="form-group">
                                            <label for="inv_date" class="mb-2 mt-3">Invoice Date</label>
                                            <p class="form-output" id="view_invoice_date"></p>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-2 col-xxl-2">
                                        <div class="form-group">
                                            <label for="due_date" class="mb-2 mt-3">Due Date</label>
                                            <p class="form-output" id="view_due_date"></p>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-2 col-xxl-2">
                                        <div class="form-group">
                                            <label for="created_by" class="mb-2 mt-3">Created By</label>
                                            <p class="form-output" id="view_created_by"></p>
                                        </div>
                                    </div>

                                </div>
                            </form>

                        </div>
                        <div class="table-responsive">
                            <div class="tabcontent bottom-header-div">
                                <div class="bottom-header row ">
                                    <div class="col-6 col-md-6 col-lg-6 header-div">
                                        <p class=""># &nbsp;&nbsp;&nbsp; Subscription & Description</p>
                                    </div>
                                    <div class="col-2 col-md-2 col-lg-2 header-div">
                                        <p>Date Start/End</p>
                                    </div>
                                    <div class="col-2 col-md-2 col-lg-2 header-div">
                                        <p>Discount</p>
                                    </div>
                                    <div class="col-2 col-md-2 col-lg-2 header-div">
                                        <p>Subtotal</p>
                                    </div>
                                </div>
                            </div>
                            <div class="tabcontent bottom-part-div">
                                <form action="gone">
                                    <div class="bottom-first row">
                                        <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                                            <div class="form-group">
                                                <label for="description" class="mb-2 mt-1">Description</label>
                                                <p class="form-output  body-contents" name="description" id="view_description"></p>
                                            </div>
                                        </div>
                                        <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2 col-xxl-2">
                                            <div class="form-group">
                                                <label for="s_date" class="mb-2 mt-1">&nbsp;&nbsp;&nbsp;</label>
                                                <p class="form-output" name="s_date" id="view_subscription_start"></p>
                                                <label for="e_date" class="mb-2 mt-1"></label>
                                                <p class="form-output" name="e_date" id="view_subscription_end"></p>
                                            </div>
                                        </div>
                                        <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2 col-xxl-2">
                                            <div class="form-group">
                                                <label for="discount" class="mb-2 mt-1">&nbsp;&nbsp;&nbsp;</label>
                                                <p class="form-output" name="discount" id="view_discount">S$0.00</p>
                                            </div>
                                        </div>
                                        <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2 col-xxl-2">
                                            <div class="form-group">
                                                <label for="subtotal" class="mb-2 mt-1">&nbsp;&nbsp;&nbsp;</label>
                                                <p class="form-output" name="subtotal" id="view_sub_total">S$0.00</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bottom-second row">
                                        <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                                            <div class="form-group">
                                                <label for="notes" class="mb-2 mt-3">Notes</label>
                                                <p class="form-output" name="notes" id="view_notes"></p>
                                            </div>
                                        </div>
                                        <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6 total-div">
                                            <div class="invoice-summary">
                                                <div class="invoice subtotal row">
                                                    <p class="col-6 title">Subtotal:</p>
                                                    <p class="col-6" id="view_sub_total_text">S$0.00</p>
                                                </div>
                                                <div class="invoice discount row">
                                                    <p class="col-6 title">Discount:</p>
                                                    <p class="col-6" id="view_discount_text">S$0.00</p>
                                                </div>
                                                <div class="invoice gst row">
                                                    <div class="gst-inner col-6 title">
                                                        <label for="gst" class="">GST</label>
                                                        <select class="gst-select" name="gst" id="view_gst" disabled>
                                                        </select>
                                                    </div>

                                                    <p class="col-6" id="view_gst_text">S$0.00</p>
                                                </div>
                                                <div class="invoice net-total row">
                                                    <p class="col-6 title">Net Total:</p>
                                                    <p class="col-6" id="view_grand_total_text">S$0.00</p>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
{{--                                    <div class="col-sm-12 col-md-6 mt-2">--}}
{{--                                        <button type="submit" class="btn admin-bill-create-submit-btn" hidden >Submit</button>--}}
{{--                                    </div>--}}
                                </form>
                            </div>
                        </div>
                        <div class="admin-bill-create-btn-section tabcontent ">
{{--                            <button type="button" class="btn view-invoice-btn admin-bill-create-view-btn mt-3" data-bs-toggle="modal" data-bs-target="#invoiceViewModal" >Download Invoice</button>--}}
{{--                            <button type="button" class="btn view-invoice-btn admin-bill-create-view-btn mt-3" id="download-invoice-btn" data-id="" onclick="invoicePdf(this)">Download Invoice</button>--}}
                            <a href="" class="btn view-invoice-btn admin-bill-create-view-btn mt-3" id="download-invoice-btn">Download Invoice</a>
                            <button type="button" id="void-btn" data-id="" onclick="voidInvoice(this)" class="btn void-btn admin-bill-create-view-btn mt-3" data-bs-toggle="modal" data-bs-target="#invoiceVoidModal">Void</button>
                            <!-- Void Modal Start -->
                            <div class="modal fade" id="invoiceVoidModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="invoiceVoidModalLabel" aria-hidden="true">
                                <div class="modal-dialog invoice-void-modal">
                                    <div class="modal-content">
                                        <div class="invoice-void-modal-body">
                                            <p class="text-center">Confirm Void</p>
                                            <div class="text-center">
                                                <button type="button" class="btn btn-sm invoice-void-modal-close-btn"  data-bs-dismiss="modal" aria-label="No">No</button>
                                                <button type="button" id="confirm-void" onclick="makeVoid(this)" data-id="" class="btn btn-sm yes-btn">Yes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Void Modal End -->
                        </div>

                        <!-- Invoice View Modal Start -->

                        <div class="modal fade" id="invoiceViewModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="invoiceViewModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg invoice-view-modal">
                                <div class="modal-content ">
                                    <div class="invoice-view-modal-body">
                                        <div class="invoice-view-modal-header row">
                                            <img class="logo-img col-12 col-sm-4 col-lg-4" src="{{asset('assets/images/goa-logo.jpg')}}" alt="Logo">
                                            <div class="modal-title col-12 col-sm-7 col-lg-7" id="invoiceViewModalLabel">
                                                <h6 class="invoice-logo-header">Gateway of Asia</h6>
                                                <p class="invoice-logo-dtls">Company Registration No. 20150238Z</p>
                                                <p class="invoice-logo-adrs">
                                                    114 LAVENDER STREET <br>
                                                    #11-83 <br>
                                                    CT HUB 2 <br>
                                                    SINGAPORE (338729)</p>
                                            </div>
                                            <button type="button" class="btn btn-close btn-sm invoice-view-modal-close-btn col-12 col-sm-1 col-lg-1" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="invoice-view-modal-sub-header row">
                                            <div class="modal-sub-header-left col-12 col-sm-6 col-lg-6" id="invoiceViewModalLabel">
                                                <p class="invoice-left-title">Invoice</p>
                                                <p class="invoice-left-name">  David SwavousZ</p>
                                                <p class="invoice-left-mail">davidswavous@email.com</p>
                                                <span>Bill to</span>
                                            </div>
                                            <div class="modal-sub-header-right col-12 col-sm-6 col-lg-6" id="invoiceViewModalLabel">
                                                <div class="invoice-right-div">
                                                    <label for="invoice_no" class="invoice-right-label">Invoice No.</label>
                                                    <p name="" id="invoice_no" class="invoice-right-data">Super Long Inv #001</p>
                                                </div>
                                                <div class="invoice-right-div">
                                                    <label for="invoice_date" class="invoice-right-label">Date</label>
                                                    <p name="" id="invoice_date" class="invoice-right-data"> 20/11/2022</p>
                                                </div>
                                                <div class="invoice-right-div">
                                                    <label for="invoice_terms" class="invoice-right-label">Terms</label>
                                                    <p name="" id="invoice_terms" class="invoice-right-data">NET15</p>
                                                </div>
                                                <div class="invoice-right-div">
                                                    <label for="invoice_due_date" class="invoice-right-label">Due Date</label>
                                                    <p name="" id="invoice_due_date" class="invoice-right-data"> 20/11/2022</p>
                                                </div>
                                                <div class="invoice-right-div">
                                                    <label for="invoice_created_by" class="invoice-right-label">Created by</label>
                                                    <p name="" id="invoice_created_by" class="invoice-right-data">Christina Macy</p>
                                                </div>

                                                <!-- <span>Bill to</span> -->
                                            </div>

                                        </div>
                                        <div class="invoice-view-modal-data row">
                                            <form action="#">
                                                <input type="hidden" id="invoive_key" name="invoive_key">
                                                <div class="data-body row">
                                                    <div class="data-row col-12">
                                                        <div class="table-responsive">
                                                            <div class="modal-table-header row g-0">
                                                                <div class="col-1 col-md-1 number-col">
                                                                    <p></p>
                                                                </div>
                                                                <div class="col-5 col-md-5 table-header-first-col">
                                                                    <p>Service/Subscription & Description</p>
                                                                </div>
                                                                <div  class="col-2 col-md-2 table-header-col">
                                                                    <p>Date Start</p>
                                                                </div>
                                                                <div  class="col-2 col-md-2 table-header-col">
                                                                    <p>Date End</p>
                                                                </div>
                                                                <div  class="col-2 col-md-2 table-header-col">
                                                                    <p>Subtotal</p>
                                                                </div>

                                                            </div>
                                                            <div class="modal-table-data row g-0">
                                                                <div class="col-1 col-md-1 number-col">
                                                                    <p>1</p>
                                                                </div>
                                                                <div class="col-5 col-md-5 table-header-first-col">
                                                                    <p class="service-title">Taxation Method 1137 ( 1 Year Subscription )</p>
                                                                    <p class="service-desc">Includes the follows:<br> <br>
                                                                        &#x2022;  Tax Lesson 101<br>
                                                                        &#x2022; Tax Evaluation Checklist<br>
                                                                        &#x2022;  Tax Consultation<br>
                                                                        &#x2022;  Monthly Update on Tax Liabilities</p>
                                                                </div>
                                                                <div  class="col-2 col-md-2 table-header-col">
                                                                    <p class="date-start">10/10/2022</p>
                                                                </div>
                                                                <div  class="col-2 col-md-2 table-header-col">
                                                                    <p class="date-end">09/10/2023</p>
                                                                </div>
                                                                <div  class="col-2 col-md-2 table-header-col">
                                                                    <p class="sub-total">$3,000.00</p>
                                                                </div>

                                                            </div>
                                                            <div class="modal-table-data row g-0">
                                                                <div class="col-1 col-md-1 number-col">
                                                                    <p>2</p>
                                                                </div>
                                                                <div class="col-5 col-md-5 table-header-first-col">
                                                                    <p class="service-title">Accounting Package ( 3 Years Subscription )</p>
                                                                    <p class="service-desc">Includes the follows:<br> <br>
                                                                        &#x2022;  Monthly Review<br>
                                                                        &#x2022;  Monthly Dashboard </p>
                                                                </div>
                                                                <div  class="col-2 col-md-2 table-header-col">
                                                                    <p class="date-start">10/10/2022</p>
                                                                </div>
                                                                <div  class="col-2 col-md-2 table-header-col">
                                                                    <p class="date-end">09/10/2025</p>
                                                                </div>
                                                                <div  class="col-2 col-md-2 table-header-col">
                                                                    <p class="sub-total">$3,000.00</p>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="modal-table-footer row g-0">
                                                            <div class="total-bill col-12">
                                                                <div class="total-bill-inner">
                                                                    <div class="total-div-inner">
                                                                        <label for="subtotal" class="total-left-label">SUB TOTAL</label>
                                                                        <p name="" id="subtotal" class="total-right-data">$6000.00</p>
                                                                    </div>
                                                                    <div class="total-div-inner">
                                                                        <label for="discount" class="total-left-label">DISCOUNT</label>
                                                                        <p name="" id="discount" class="total-right-data">$1000.00</p>
                                                                    </div>
                                                                    <div class="total-div-inner">
                                                                        <label for="total" class="total-left-label">TOTAL</label>
                                                                        <p name="" id="total" class="total-right-data totals">$5000.00</p>
                                                                    </div>
                                                                </div>
                                                                <div class="total-bill-inner grand-total">
                                                                    <div class="grand-total-div-inner">
                                                                        <label for="grand_total" class="grand-total-left-label">Grand Total:</label>
                                                                        <p name="" id="grand_total" class="grand-total-right-data">$5000.00</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="invoice-footer col-12"><p class="footer-text">This is a sample footer and what is typed here will be shown at the bottom of the invoice</p></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- User View Modal End -->
                    </div>
                    <!--  View Bill Portion Ends -->

                    <!--  Bill index Portion starts -->
                    <div id="billing" class="card-body adminBillingTabContent admin-billing-content-body billing">
                        <div  class="tabcontent ">
                            <div class="select-pagination-portion table-top-portion row g-0">
                                <div class="sb-part search-box-part col-12 col-md-3 col-lg-4">
                                    <div class="d-flex form-inputs search-data">
                                        <input class="form-control" name="search" id="search" type="text" placeholder="Search Invoice">
                                        <button class="search-btn btn"><i class="fa-solid fa-search"></i></button>
                                    </div>
                                </div>
                                <div class="sb-part billing-category-select col-6 offset-md-0 col-md-3 col-lg-2">
                                    <select class="form-control form-select nav-select select-data" id="invoice_status">
                                        <option value="all">All</option>
                                        <option value="invoiced">Invoiced</option>
                                        <option value="paid">Paid</option>
                                        <option value="overdue">Overdue</option>
                                        <option value="void">void</option>
                                    </select>
                                </div>
                                <!-- <div class="button-part col-6 col-md-3 col-lg-3">
                                    <button type="button" class="btn delete-btn action-buttons " data-bs-toggle="modal" data-bs-target="#userDeleteModal">Delete</button>
                                </div> -->
                                @if(auth()->guard('web')->user()->can('create.billing'))
                                    <div class="create-btn-part col-6 col-md-6 col-lg-6">
                                            {{--button for disconnect from xero--}}
{{--                                        <a href="{{route('xero.disconnect')}}" class="disconnect-btn"  data-toggle="tooltip" title="Disconnect Your Organization From Xero">--}}
{{--                                            <svg fill="#fc0303" width="25px" height="25px" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" class="icon" stroke="#fc0303">--}}

{{--                                                <g id="SVGRepo_bgCarrier" stroke-width="0"/>--}}

{{--                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"/>--}}

{{--                                                <g id="SVGRepo_iconCarrier"> <path d="M917.7 148.8l-42.4-42.4c-1.6-1.6-3.6-2.3-5.7-2.3s-4.1.8-5.7 2.3l-76.1 76.1a199.27 199.27 0 0 0-112.1-34.3c-51.2 0-102.4 19.5-141.5 58.6L432.3 308.7a8.03 8.03 0 0 0 0 11.3L704 591.7c1.6 1.6 3.6 2.3 5.7 2.3 2 0 4.1-.8 5.7-2.3l101.9-101.9c68.9-69 77-175.7 24.3-253.5l76.1-76.1c3.1-3.2 3.1-8.3 0-11.4zM769.1 441.7l-59.4 59.4-186.8-186.8 59.4-59.4c24.9-24.9 58.1-38.7 93.4-38.7 35.3 0 68.4 13.7 93.4 38.7 24.9 24.9 38.7 58.1 38.7 93.4 0 35.3-13.8 68.4-38.7 93.4zm-190.2 105a8.03 8.03 0 0 0-11.3 0L501 613.3 410.7 523l66.7-66.7c3.1-3.1 3.1-8.2 0-11.3L441 408.6a8.03 8.03 0 0 0-11.3 0L363 475.3l-43-43a7.85 7.85 0 0 0-5.7-2.3c-2 0-4.1.8-5.7 2.3L206.8 534.2c-68.9 69-77 175.7-24.3 253.5l-76.1 76.1a8.03 8.03 0 0 0 0 11.3l42.4 42.4c1.6 1.6 3.6 2.3 5.7 2.3s4.1-.8 5.7-2.3l76.1-76.1c33.7 22.9 72.9 34.3 112.1 34.3 51.2 0 102.4-19.5 141.5-58.6l101.9-101.9c3.1-3.1 3.1-8.2 0-11.3l-43-43 66.7-66.7c3.1-3.1 3.1-8.2 0-11.3l-36.6-36.2zM441.7 769.1a131.32 131.32 0 0 1-93.4 38.7c-35.3 0-68.4-13.7-93.4-38.7a131.32 131.32 0 0 1-38.7-93.4c0-35.3 13.7-68.4 38.7-93.4l59.4-59.4 186.8 186.8-59.4 59.4z"/> </g>--}}

{{--                                            </svg>--}}
{{--                                        </a>--}}
                                        <button type="button" class="btn download-btn action-buttons active"  onclick="adminBillCreateTab(event, 'create-bill')">Create</button>
                                    </div>
                                @endif
                            </div>
                            <div class="table-responsive">
                                <div class="billing-body">
                                    <div class="bills bills-header row g-0">
                                        <div class="col-2 col-md-2 col-lg-2 invoice-header  header-div">
                                            <p>Invoice No.</p> <button onclick="filterByInvoiceNo()" class="filter-btn"><span id="order" hidden="hidden">DESC</span><img class="filter-icon" src="{{asset('assets/icons/filter-icon.png')}}" alt="Filter Icon">
                                        </div>
                                        <div class="col-2 col-md-2 col-lg-2 header-div">
                                            <p class="">Company Name</p>
                                        </div>
                                        <div class="col-2 col-md-2 col-lg-2 header-div">
                                            <p class="">Description</p>
                                        </div>
                                        <div class="col-2 col-md-2 col-lg-2 header-div">
                                            <p>Billing Date</p>
                                        </div>
                                        <div class="col-1 col-md-1 col-lg-1 header-div">
                                            <p>Total</p>
                                        </div>
                                        <div class="col-2 col-md-2 col-lg-2 header-div status-header">
                                            <p>Status</p>
                                        </div>
                                        <div class="col-1 col-md-1 col-lg-1 action-header header-div">
                                            <p class="">Action</p>
                                        </div>
                                    </div>
                                    <div id="invoice_table">
                                        @if(count($response)>0)
                                            @foreach($response as $item)
                                                <div class="bills row g-0">
                                                    <div class="col-2 col-md-2 col-lg-2 checkbox-div">
                                                        <span>#{{$item->invoice_no}}</span>
                                                    </div>
                                                    <div class="col-2 col-md-2 col-lg-2 data-div">
                                                        <p class="">{{$item->company->name}}</p>
                                                    </div>
                                                    <div class="col-2 col-md-2 col-lg-2 desc-div">
                                                        <p class="">{{$item->description}} </p>
                                                    </div>
                                                    <div class="col-2 col-md-2 col-lg-2 time-div">
                                                        <span>{{\Carbon\Carbon::parse($item->due_date)->format('d M y')}}</span>
                                                    </div>
                                                    <div class="col-1 col-md-1 col-lg-1 data-div">
                                                        <p class="">${{number_format((float)$item->grand_total, 2, '.', '')}}</p>
                                                    </div>
                                                    <div class="col-2 col-md-2 col-lg-2 status-div">
                                                        <p name="doc-status" class="doc-status">{{ucfirst($item->status)}}</p>
                                                    </div>
                                                    <div class="col-1 col-md-1 col-lg-1 action-div">
                                                        <a href="#" class="action-buttons" onclick="adminBillCreateTab(event, 'view-bill',this)" data-id="{{$item->id}}">View</a>
                                                        <a href="#" class="action-buttons {{$item->status == 'paid' ? 'd-none' : ''}} {{$item->status == 'void' ? 'd-none' : ''}}" onclick="adminBillCreateTab(event, 'edit-bill',this)" data-id="{{$item->id}}">Edit</a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="bills row g-0">
                                                <span class="text-danger text-center">No Data Available</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="select-pagination-portion table-bottom-portion row g-0">
                                <input type="text" id="last_page" value="{{$response->hasPages()}}" hidden="hidden">
                                <div class="pagination-part bottom-pagination-part col-12 col-md-12 col-lg-12">
                                    <a data-href="{{$response->previousPageUrl()}}" class="btn d-none left-arrow"><i class="fa-solid fa-chevron-left"></i></a>
                                    <span class="pagination-number pagination-left-number">{{$response->currentPage()}}</span>
                                    <span class="pagination-divider">/</span>
                                    <span class="pagination-number pagination-right-number">{{$response->lastPage()}}</span>
                                    <a data-href="{{$response->nextPageUrl()}}" class="btn d-none right-arrow"><i class="fa-solid fa-chevron-right"></i></a>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!--  Bill index Portion Ends -->
                </div>
            </div>
        </div>
    </div>
    <!-- Main Body End -->
@endsection
@push('customScripts')
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip({
                placement: 'left'
            });
        });

        let order = ''
        let url= "billing?page="
        $('.pagination-part .left-arrow').on('click', function (){
            if ($(this).attr('data-href') != ''){
                var page = $(this).attr('data-href').split('page=')[1];

                if($('.pagination-part .left-arrow').hasClass('searchInvoice') == true){
                    let search=$(this).attr('data-href').split('?')[0].split('/')[4]
                    url="/search-invoice/"+search+"?page="
                }
                if($('.pagination-part .left-arrow').hasClass('filterByInvoiceNo') == true){
                    let order=$(this).attr('data-href').split('?')[0].split('/')[4]
                    url="/filter-invoice-by-order/"+order+"?page="
                }
                if($('.pagination-part .left-arrow').hasClass('filterByStatus') == true){
                    let status=$(this).attr('data-href').split('?')[0].split('/')[4]
                    url="/filter-invoice-by-status/"+status+"?page="
                }
                fetch_data(page);
            }
        })
        $('.pagination-part .right-arrow').on('click', function (){

            if ($(this).attr('data-href') != ''){
                var page = $(this).attr('data-href').split('page=')[1];

                if($('.pagination-part .right-arrow').hasClass('searchInvoice') == true){
                    let search=$(this).attr('data-href').split('?')[0].split('/')[4]
                    url="/search-invoice/"+search+"?page="
                    // console.log(url)
                }
                if($('.pagination-part .right-arrow').hasClass('filterByInvoiceNo') == true){
                    let order=$(this).attr('data-href').split('?')[0].split('/')[4]
                    url="/filter-invoice-by-order/"+order+"?page="
                }
                if($('.pagination-part .right-arrow').hasClass('filterByStatus') == true){
                    let status=$(this).attr('data-href').split('?')[0].split('/')[4]
                    url="/filter-invoice-by-status/"+status+"?page="
                }
                fetch_data(page);
            }

        })

        function fetch_data(page) {
            // let wrapper = "#invoice_table"
            let value=''
            $("input[name='search']").each(function() {
                if (this.value.length != 0){
                    value=this.value;
                }else {
                    value=0;
                }
            });
            // $("input[name='search']").val()

            let status=$('#invoice_status').find(":selected").val()
            $.ajax({
                url: url + page,
                data:{search:value,status:status},
                dataType:"json",
                success: function(res) {
                    // console.log(res)
                    determinePaginationArrow(res)

                    $('.pagination-left-number').text(res.current_page)
                    $('.pagination-right-number').text(res.last_page)
                    $(".pagination-part .left-arrow").attr('data-href', res.prev_page_url)
                    $(".pagination-part .right-arrow").attr('data-href', res.next_page_url)
                    domLoad(res)
                    invoiceStatus()
                },
                error: function (request) {
                    alert(request.responseText);
                }
            });
        }
        function domLoad(item){
            let wrapper="#invoice_table"
            let invoiceTable=''

            if (item.data.length > 0){
                $.map(item.data, function(value,i){

                    {{--let fileDownloadUrl="{{route('ticket.download', ':id')}}"--}}
                        {{--fileDownloadUrl= fileDownloadUrl.replace(':id', value.id)--}}

                        {{--let manageUrl="{{route('ticket.edit', ':slug')}}"--}}
                        {{--manageUrl= manageUrl.replace(':slug', value.slug)--}}

                        invoiceTable += `<div class="bills row g-0">
                                                <div class="col-2 col-md-2 col-lg-2 checkbox-div">
                                                    <span>#${value.invoice_no}</span>
                                                </div>
                                                <div class="col-2 col-md-2 col-lg-2 data-div">
                                                    <p class="">${value.company.name}</p>
                                                </div>
                                                <div class="col-2 col-md-2 col-lg-2 desc-div">
                                                    <p class="">${value.description} </p>
                                                </div>
                                                <div class="col-2 col-md-2 col-lg-2 time-div">
                                                    <span>${$.date(value.due_date)}</span>
                                                </div>
                                                <div class="col-1 col-md-1 col-lg-1 data-div">
                                                    <p class="">$${value.grand_total.toFixed(2)}</p>
                                                </div>
                                                <div class="col-2 col-md-2 col-lg-2 status-div">
                                                    <p name="doc-status" class="doc-status">${value.status[0].toUpperCase() + value.status.slice(1)}</p>
                                                </div>
                                                <div class="col-1 col-md-1 col-lg-1 action-div">
                                                    <a href="#" class="action-buttons" onclick="adminBillCreateTab(event, 'view-bill',this)" data-id="${value.id}">View</a>
                                                    <a href="#" class="action-buttons ${value.status == 'paid'  ? 'd-none' : ''} ${value.status == 'void'  ? 'd-none' : ''} " onclick="adminBillCreateTab(event, 'edit-bill',this)" data-id="${value.id}">Edit</a>
                                                </div>
                                            </div>`
                })
            }else{
                invoiceTable += `<div class="bills row g-0 ">
                                  <span class="text-danger text-center">No Data Available</span>
                                </div>`
            }



            $(wrapper).empty().append(invoiceTable)


        }
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

        //start helpers
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
        function removeClassFromPaginationArrow(className){
            if ( $(".pagination-part .right-arrow").hasClass(className)){
                $(".pagination-part .right-arrow").removeClass(className)
            }
            if (  $(".pagination-part .left-arrow").hasClass(className)){
                $(".pagination-part .left-arrow").removeClass(className)
            }
        }
        function injectClass(className){
            $(".pagination-part .right-arrow").addClass(className)
            $(".pagination-part .left-arrow").addClass(className)
        }
        function addDays(n,mode){
            // console.log('in')
            // var t = new Date();
            if(mode=='edit'){
                var t = new Date($('#edit_invoice_date').val());
            }else {
                var t = new Date($('#invoice_date').val());
            }

            t.setDate(t.getDate() + n);
            var month = "0"+(t.getMonth()+1);
            var date = "0"+t.getDate();
            month = month.slice(-2);
            date = date.slice(-2);
            var dueDate = month +"/"+date +"/"+t.getFullYear();
            if(mode == 'edit'){
                $('#edit_due_date').val(moment(new Date(dueDate)).format('YYYY-MM-DD'))
            }else {
                $('#due_date').val(moment(new Date(dueDate)).format('YYYY-MM-DD'))
            }
            // $('#due_date').val(moment(new Date(dueDate)).format('YYYY-MM-DD'))
        }
        function addCommas(nStr) {
            nStr += '';
            x = nStr.split('.');
            x1 = x[0];
            x2 = x.length > 1 ? '.' + x[1] : '';
            var rgx = /(\d+)(\d{3})/;
            while (rgx.test(x1)) {
                x1 = x1.replace(rgx, '$1' + ',' + '$2');
            }
            return x1 + x2;
        }
        //end helpers

        $(document).ready(function(){
            let page=$('#last_page').val()
            if (page != ""){
                $('.pagination-part .right-arrow').removeClass('d-none')
            }else {
                $('.pagination-part .right-arrow').addClass('d-none')
                // $('.pagination-part').addClass('d-none')
            }
            // Get the element with id="defaultOpen" and click on it
            var billing = document.querySelector(".billing");
            billing.style.display = "block";

            var createBills = document.querySelectorAll(".create-bill");
            for (var i = 0; i < createBills.length; i++) {
                createBills[i].style.display = "none";
            }

            var viewBills = document.querySelectorAll(".view-bill");
            for (var i = 0; i < viewBills.length; i++) {
                viewBills[i].style.display = "none";
            }

            var editBills = document.querySelectorAll(".edit-bill");
            for (var i = 0; i < editBills.length; i++) {
                editBills[i].style.display = "none";
            }
            invoiceStatus()
            // $('.admin-bill-create-send-btn').click(function(){
            //     $('.admin-bill-create-submit-btn').click();
            // })


            $(".select2").select2();
            // $(".select2").select2({
            //     dropdownParent: $('#companyCreateModal'),
            //     // placeholder: "Select",
            //     allowClear: true
            // });
            order=$('#order').text()
        })
        // $(document).on('click', ".cancel-btn", function() {
        //     $(this).parent('div').remove();
        //     // $('#element').show("slow");
        // });
        function invoiceStatus(){
            var docStatus = document.getElementsByName("doc-status");
            console.log(docStatus);
            var countTickets = docStatus.length;
            for (var i = 0; i < countTickets; i++){
                if(docStatus[i].innerHTML == "Paid"){
                    docStatus[i].style.color = "#52C41A";
                    docStatus[i].style.border = "1px solid #52C41A";
                    docStatus[i].style.backgroundColor = "#F4FFE3";
                }
                else if(docStatus[i].innerHTML == "Overdue"){
                    docStatus[i].style.color = "#EB2F96";
                    docStatus[i].style.border = "1px solid #FFADD2";
                    docStatus[i].style.backgroundColor = "#FFF0F6";
                }
                else if(docStatus[i].innerHTML == "Void"){
                    docStatus[i].style.color = "#EB2F96";
                    docStatus[i].style.border = "1px solid #FFADD2";
                    docStatus[i].style.backgroundColor = "#FFF0F6";
                }
                else if(docStatus[i].innerHTML == "Draft"){
                    docStatus[i].style.color = "#A7A7A7";
                    docStatus[i].style.border = "1px solid #A7A7A7";
                    docStatus[i].style.backgroundColor = "#F4F4F4";
                }
                else if(docStatus[i].innerHTML == "Invoiced"){
                    docStatus[i].style.color = "#FF9C14";
                    docStatus[i].style.border = "1px solid #FF9C14";
                    docStatus[i].style.backgroundColor = "#FFEDC8";
                }
            }

        }
        function goBack (event, eventName) {
            var i;
            var tabcontent = document.getElementsByClassName("adminBillingTabContent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }

            var elements = document.getElementsByClassName(eventName);
            for (i = 0; i < elements.length; i++) {
                elements[i].style.display = "block";
            }
            event.currentTarget.className += " active";
            window.location.reload()
        }
        function adminBillCreateTab(evt, eventName,e) {
            if ($('#'+eventName).hasClass('d-none')){
                $('#'+eventName).removeClass('d-none')
            }
            var i, tabcontent, tablinks,elements;
            tabcontent = document.getElementsByClassName("adminBillingTabContent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }

            elements = document.getElementsByClassName(eventName);
            for (i = 0; i < elements.length; i++) {
                elements[i].style.display = "block";
            }
            evt.currentTarget.className += " active";

            if (eventName=='edit-bill'){
                fetchEditData(e.getAttribute('data-id'))
            }else if(eventName=='view-bill'){
                fetchViewData(e.getAttribute('data-id'))
            }
        }

        $('#company_id').on('change', function (e) {
            // console.log(e.target.value)
            let company_id = e.target.value;
            document.getElementById("user_id").disabled = false;
                fetch(`/get-company-directors/${company_id}`)
            //         // console.log(response)
                    .then(res => res.json())
                    .then(res => {
                        console.log(res)
                        let html = '<option hidden></option>'
                        if (res[0].length !=0) {
                            res[0].forEach(user => {
                                html += `<option value="${user.id}">${user.first_name + ' ' + user.last_name}</option>`
                                // console.log(html)
                            })
                        }else {
                            html += `<option disabled>No Director Found</option>`
                        }
                        $('#user_id').html(html)
                        $('#billing_address').val(res[1].address_line)
                    })
                    .catch(err => {
                        console.log(err)
                    })
        })


        $('#user_id').on('change', function (e) {
            let ccEmail = ''
            console.log(e.target.value)
            let user_id = e.target.value;
            // document.getElementById("user_id").disabled = false;
            fetch(`/get-directors-email/${user_id}`)

                .then(res => res.json())
                .then(res => {
                    ccEmail+=res.email+'; '
                    $.each(res.ccs, function(index, cc) {
                        if(cc != null){
                            ccEmail+= cc +'; '
                        }
                    });
                    let customerEmail = ccEmail.substring(0, ccEmail.length-1)
                    $('#cust_mail').val(customerEmail)
                })
                .catch(err => {
                    console.log(err)
                })
        })

        $("#terms").on("input", function(){
            let terms = $('#terms').val()
           addDays(parseInt(terms,10))
        });
        $('#invoice_date').change(function() {
            let terms = $('#terms').val()
            addDays(parseInt(terms,10))
        });


        let subTotal=0;
        let netTotal=0;
        let subTotalAfterDiscount=0;
        //start calculation for create

        $('#init_sub_total').on('keyup', function (e) {
            let value=parseFloat($(this).val())
            if(!isNaN(value)){
                subTotal=parseFloat(value)
                $('#create_sub_total_text').text('S$'+ addCommas(subTotal))
                calculateDiscount()
                calculateGst()
            }else {
                subTotal=0
                calculateDiscount()
                calculateGst()
                $('#create_sub_total_text').text('S$0.00')
                $('#create_gst_text').text('S$0.00')
                $('#create_grand_total_text').text('S$0.00')
            }
        })
        function calculateGst(){
            let gst=parseFloat($('#gst').val())
            // let calculatedGst= (subTotal*gst)/100
            let calculatedGst= (subTotalAfterDiscount*gst)/100 //new2
            // netTotal=parseFloat(subTotal)+calculatedGst
            netTotal=parseFloat(subTotalAfterDiscount)+calculatedGst
            // $('#create_sub_total_text').text('S$'+addCommas(subTotal.toFixed(2)))
            $('#create_sub_total_text').text('S$'+addCommas(subTotalAfterDiscount.toFixed(2)))
            $('#create_gst_text').text('S$'+addCommas(calculatedGst.toFixed(2)))
            $('#create_grand_total_text').text('S$'+addCommas(netTotal.toFixed(2)))

            $('#grand_total').val(netTotal.toFixed(2))
            $('#sub_total').val(subTotal.toFixed(2))
        }
        function calculateDiscount(){
            subTotal = parseFloat($('#init_sub_total').val())
            if(isNaN(subTotal)){
                subTotal =0.00
            }
            let discount=parseFloat($('#discount').val())

            if(isNaN(discount)){
                discount=0
                // $('#discount').val(0.00)
            }
            // netTotal= netTotal-discount //old
            if(subTotal != 0){ //new
                if(discount != 0){
                    // subTotal= subTotal-discount //new
                    subTotalAfterDiscount= subTotal-discount //new
                }else {
                    // subTotal = parseFloat($('#init_sub_total').val())
                    subTotalAfterDiscount = parseFloat($('#init_sub_total').val())
                }
            }
            $('#create_discount_text').text('S$'+addCommas(discount.toFixed(2)))
            // $('#create_grand_total_text').text('S$'+addCommas(netTotal.toFixed(2)))
            $('#create_grand_total_text').text('S$'+addCommas(subTotalAfterDiscount.toFixed(2))) //new
            // $('#grand_total').val(netTotal.toFixed(2))
            // $('#grand_total').val(subTotal.toFixed(2)) //new
            $('#grand_total').val(subTotalAfterDiscount.toFixed(2)) //new

        }
        $('#discount').on('keyup', function (e) {
            // calculateGst() //old
            let value = $(this).val()

            if(!isNaN(value)){
               calculateDiscount()

                // $('#grand_total').val(netTotal.toFixed(2))
                // $('#sub_total').val(subTotal)
            }else {
                $('#create_discount_text').text('S$0.00')
            }
            calculateGst() //new
        })
        $('#gst').on('change', function (e) {
            calculateGst()
            // calculateDiscount()
        })

        //end calculation for create
        // create post
        $('#create-send').on('click', function () {
            $('#create-submit').click()
        })
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#create-submit').on('click', function (e) {
            {{--let xeroAuthorize = "{{route('authorize')}}"--}}
            let xeroAuthorize = "{{route('authorization.resource')}}"
            $('#create-send').prop('disabled', true);
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "{{route('billing.store')}}",
                data: $('#invoice_create').serialize(),
                // beforeSend: function() {
                //     $("#loadingDiv").show();
                // },
                success: function(data) {
                    // $("#loadingDiv").hide();
                    if (data.success == 1){
                        $("html, body").animate({ scrollTop: 0 });
                        $('#flashMessages').html(
                            `<div class="alert alert-success">
                            <img class="alert-img" src="{{asset('assets/icons/success-alert-icon.png')}}" alt="">
                            <p class="alert-text">${data.message}</p></div>`
                        )
                        window.open(xeroAuthorize, "_self")
                        // setTimeout(function(){
                        //     window.location.reload();
                        // }, 2000);
                        // $(".alert-text").html(response.message);
                    }
                },
                error: function(xhr){
                    // console.log($(this))
                    $('#create-send').prop('disabled', false);
                    // $("#loadingDiv").hide();
                    $.each(xhr.responseJSON.errors, function (key, value) {
                        $('.invoice-' + key).text(value);
                    });
                    // alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
                }
            });
        })

        //start search and filtering
        $('#search').on('keyup', function () {
            removeClassFromPaginationArrow('filterByStatus')
            let value=""
            $("input[name='search']").each(function() {
                if (this.value.length != 0){
                    value=this.value;
                }else {
                    value=0;
                }
            });
            let status=$('#invoice_status').find(":selected").val()
            let url = "{{ route('invoice.search', ':search') }}"
            url=url.replace(':search', value)
            $.ajax({
                url: url,
                data:{search:value,status:status},
                success: function(res) {
                    console.log(res)
                    determinePaginationArrow(res)
                    //
                    $('.pagination-left-number').text(res.current_page)
                    $('.pagination-right-number').text(res.last_page)
                    injectClass('searchInvoice')
                    $(".pagination-part .left-arrow").attr('data-href', res.prev_page_url)
                    $(".pagination-part .right-arrow").attr('data-href', res.next_page_url)
                    domLoad(res)
                    invoiceStatus()
                }
            });
        })
        function filterByInvoiceNo(){
            removeClassFromPaginationArrow('searchInvoice')
            if (order =='DESC'){
                order='ASC'
                $('#order').text('ASC')
            }else {
                order='DESC'
                $('#order').text('DESC')

            }
            let url = "{{ route('invoice.filter', ':order') }}"
            url=url.replace(':order', order)
            // let wrapper = "#t-body"
            $.ajax({
                url: url,
                success: function(res) {
                    console.log(res)
                    determinePaginationArrow(res)
                    $('.pagination-left-number').text(res.current_page)
                    $('.pagination-right-number').text(res.last_page)
                    injectClass('filterByInvoiceNo')
                    $(".pagination-part .left-arrow").attr('data-href', res.prev_page_url)
                    $(".pagination-part .right-arrow").attr('data-href', res.next_page_url)
                    domLoad(res)
                    invoiceStatus()
                }
            });
        }
        $('#invoice_status').on('change', function () {
            // removeClassFromPaginationArrow('filterByDesignation')
            removeClassFromPaginationArrow('searchInvoice')
            removeClassFromPaginationArrow('filterByInvoiceNo')
            let status= $('#invoice_status').find(":selected").val()
            let url = '{{route('invoice.filter.status', ':status')}}'
            url= url.replace(':status', status)
            $.ajax({
                url: url,
                success: function(res) {
                    // console.log('res',res.data.length)
                    determinePaginationArrow(res)
                    injectClass('filterByStatus')

                    $('.pagination-left-number').text(res.current_page)
                    $('.pagination-right-number').text(res.last_page)
                    $(".pagination-part .left-arrow").attr('data-href', res.prev_page_url)
                    $(".pagination-part .right-arrow").attr('data-href', res.next_page_url)
                    domLoad(res)
                    invoiceStatus()
                }
            });
        })
        //end search and filtering



        let editSubTotalValue=0;
        let editGrandTotalValue=0;
        let editsubTotalValueAfterDiscount=0;
        function fetchEditData(id) {
            let url='{{route('billing.edit', ':id')}}'
            url= url.replace(':id', id)
            $.ajax({
                url: url,
                success: function (res) {
                    console.log()
                    if (res.abort == 403){
                        $('#edit-bill').addClass('d-none')
                        $("html, body").animate({ scrollTop: 0 });
                        $('#flashMessages').html(
                            `<div class="alert alert-success alert-access">
                            <img class="alert-img" src="{{asset('assets/icons/mailbody-!.png')}}" alt="">
                            <p class="alert-text">${res.message}</p></div>`
                        )
                        setTimeout(function(){
                            window.location.reload();
                        }, 4000);
                    }else {
                        let options = ''
                        let gstOptions=''
                        let directorEmail=''
                        let subTotal=res[0].sub_total.toFixed(2)
                        let grandTotal=res[0].grand_total.toFixed(2)
                        let discount=0.00
                        let subTotalValueAfterDiscount=0.00

                        $.each(res[1], function (index, value) {
                            options += `<option value="${value.id}"  ${res[0].company_id == value.id ? 'selected' : " "}>${value.name}</option>`
                            // $("#tax_edit_company_id").append(`<option value="${value.id}"  ${res[0].company_id == value.id ? 'selected': ' ' }>${value.name}</option>`);
                        });

                        let custNameOption= `<option value="${res[0].user.id}"  ${'selected'}>${res[0].user.first_name+ ' '+res[0].user.last_name }</option>`
                        directorEmail+=res[0].user.email+'; '
                        $.each(res[0].user.ccs, function(index, cc) {
                            if (cc != null){
                                directorEmail+= cc +'; '
                            }
                        });
                        let customerEmail = directorEmail.substring(0, directorEmail.length-1)
                        gstOptions+=`<option value="8" ${(res[0].gst== 8 ? 'selected' : '')}>8%</option>
                                 <option value="9" ${(res[0].gst== 9 ? 'selected' : '')}>9%</option>
                                 <option value="10" ${(res[0].gst== 10 ? 'selected' : '')}>10%</option>`

                        $('#invoice_id').val(res[0].id)
                        $('#edit_cust_mail').val(customerEmail)
                        $("#edit_company_id").empty().append(options)
                        $("#edit_cust_name").empty().append(custNameOption)
                        $("#edit_gst").empty().append(gstOptions)

                        $("#edit_billing_address").val(res[0].billing_address)
                        $("#edit_terms").val(res[0].terms)
                        $("#edit_invoice_date").val(res[0].invoice_date)
                        $("#edit_due_date").val(res[0].due_date)
                        $("#edit_created_by").val(res[0].admin_user.first_name + ' '+res[0].admin_user.last_name)
                        $("#edit_description").val(res[0].description)
                        $("#edit_notes").val(res[0].notes)
                        $("#edit_subscription_start").val(res[0].subscription_start)
                        $("#edit_subscription_end").val(res[0].subscription_end)
                        $("#edit_subscription_end").val(res[0].subscription_end)
                        $("#edit_sub_total").val(subTotal)
                        if (res[0].discount !=null){
                            discount=res[0].discount.toFixed(2)
                        }
                        subTotalValueAfterDiscount = Number(subTotal) - Number(discount)

                        $("#edit_discount").val(discount)
                        $("#edit_sub_total_text").text('S$'+addCommas(parseFloat(subTotalValueAfterDiscount).toFixed(2)))
                        $("#edit_grand_total").val(grandTotal)
                        $("#edit_grand_total_text").text('S$'+addCommas(grandTotal))

                        $("#edit_discount_text").text('S$'+discount)
                        gstValueCalculationForEdit(res[0].gst,subTotalValueAfterDiscount)
                        editSubTotalValue=parseFloat(subTotal)
                        editGrandTotalValue=parseFloat(grandTotal)
                    }


                },
                error: function(xhr){
                    // console.log($(this))
                    // $('#create-send').prop('disabled', false);
                    // // $("#loadingDiv").hide();
                    $.each(xhr.responseJSON.errors, function (key, value) {
                        $('.edit-invoice-' + key).text(value);
                    });
                    // alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
                }
            })

        }
        function gstValueCalculationForEdit(gst,subTotal) {
            let calculatedGst= (subTotal*gst)/100
            $('#edit_gst_text').text('S$'+addCommas(calculatedGst.toFixed(2)))
        }
        function gstValueCalculationForView(gst,subTotal) {
            let calculatedGst= (subTotal*gst)/100
            $('#view_gst_text').text('S$'+addCommas(calculatedGst.toFixed(2)))
        }
        //start calculation for edit

        $('#edit_sub_total').on('keyup', function (e) {
            let value=parseFloat($(this).val())
            if(!isNaN(value)){
                editSubTotalValue=parseFloat(value)
                $('#edit_sub_total_text').text('S$'+ addCommas(editSubTotalValue.toFixed(2)))
                calculateEditDiscount()
                calculateEditGst()
            }else {
                editSubTotalValue=0
                calculateEditDiscount()
                calculateEditGst()
                $('#create_sub_total_text').text('S$0.00')
                $('#create_gst_text').text('S$0.00')
                $('#create_grand_total_text').text('S$0.00')
            }
        })
        function calculateEditGst(){
            let gst=parseFloat($('#edit_gst').val())
            // let calculatedGst= (editSubTotalValue*gst)/100
            let calculatedGst= (editsubTotalValueAfterDiscount*gst)/100

            // editGrandTotalValue=parseFloat(editSubTotalValue)+calculatedGst

            editGrandTotalValue=parseFloat(editsubTotalValueAfterDiscount)+calculatedGst
            $('#edit_sub_total_text').text('S$'+addCommas(editsubTotalValueAfterDiscount.toFixed(2)))
            $('#edit_gst_text').text('S$'+addCommas(calculatedGst.toFixed(2)))
            $('#edit_grand_total_text').text('S$'+addCommas(editGrandTotalValue.toFixed(2)))

            $('#edit_grand_total').val(editGrandTotalValue.toFixed(2))
            // $('#sub_total').val(subTotal.toFixed(2))
        }
        function calculateEditDiscount(){
            editSubTotalValue =  parseFloat($('#edit_sub_total').val())
            let discount=parseFloat($('#edit_discount').val())
            if(isNaN(discount)){
                discount=0
                $('#edit_discount').val(0.00)
            }

            if(!isNaN(editSubTotalValue)){
                editsubTotalValueAfterDiscount= editSubTotalValue-discount
            }else{
                editsubTotalValueAfterDiscount = 0.00
            }

            // editGrandTotalValue= editGrandTotalValue-discount
            // editsubTotalValueAfterDiscount= editSubTotalValue-discount
            $('#edit_discount_text').text('S$'+addCommas(discount.toFixed(2)))
            // $('#edit_grand_total_text').text('S$'+addCommas(editGrandTotalValue.toFixed(2)))
            $('#edit_grand_total_text').text('S$'+addCommas(editsubTotalValueAfterDiscount.toFixed(2)))
            // $('#edit_grand_total').val(editGrandTotalValue.toFixed(2))
            $('#edit_grand_total').val(editsubTotalValueAfterDiscount.toFixed(2))
        }

        $('#edit_discount').on('keyup', function (e) {
            // calculateEditGst()
            let value = $(this).val()
            if(!isNaN(value)){
                calculateEditDiscount()

                // $('#grand_total').val(netTotal.toFixed(2))
                // $('#sub_total').val(subTotal)
            }else {
                $('#create_discount_text').text('S$0.00')
            }
            calculateEditGst()
        })
        $('#edit_gst').on('change', function (e) {
            // let value = $(this).val()
            calculateEditDiscount()
            calculateEditGst()
        })

        //end calculation for edit


        $('#edit_company_id').on('change', function (e) {
            // console.log(e.target.value)
            let company_id = e.target.value;
            // document.getElementById("user_id").disabled = false;
            fetch(`/get-company-directors/${company_id}`)
                //         // console.log(response)
                .then(res => res.json())
                .then(res => {
                    console.log(res)
                    let html = '<option hidden></option>'
                    if (res[0].length !=0) {
                        res[0].forEach(user => {
                            html += `<option value="${user.id}">${user.first_name + ' ' + user.last_name}</option>`
                            // console.log(html)
                        })
                    }else {
                        html += `<option disabled>No Director Found</option>`
                    }
                    $('#edit_cust_name').html(html)
                    $('#edit_billing_address').val(res[1].address_line)
                })
                .catch(err => {
                    console.log(err)
                })
        })
        $('#edit_cust_name').on('change', function (e) {
            let ccEditEmail = ''
            console.log(e.target.value)
            let user_id = e.target.value;
            // document.getElementById("user_id").disabled = false;
            fetch(`/get-directors-email/${user_id}`)

                .then(res => res.json())
                .then(res => {
                    ccEditEmail+=res.email+'; '
                    $.each(res.ccs, function(index, cc) {
                        ccEditEmail+= cc +'; '
                    });
                    let customerEmail = ccEditEmail.substring(0, ccEditEmail.length-1)
                    console.log(customerEmail)
                    $('#edit_cust_mail').val(customerEmail)
                })
                .catch(err => {
                    console.log(err)
                })
        })
        $("#edit_terms").on("input", function(){
            let terms = $('#edit_terms').val()
            addDays(parseInt(terms,10),'edit')
            // $('#edit_due_date').val(moment(new Date(dueDate)).format('YYYY-MM-DD'))
        });
        $('#edit-send').on('click', function () {
            $('#edit-submit').click()
        })
        $('#edit-submit').on('click', function (e) {
            {{--let xeroAuthorize = "{{route('authorize')}}"--}}
            let xeroAuthorize = "{{route('authorization.resource')}}"
            $('#edit-send').prop('disabled', true);
            e.preventDefault();
            let invoiceId=$('#invoice_id').val()
            let url =  "{{route('billing.update',':id')}}";
            url=url.replace(':id',invoiceId)
            $.ajax({
                type: "PUT",
                url:url,
                data: $('#update_invoice').serialize(),
                // beforeSend: function() {
                //     $("#loadingDiv").show();
                // },
                success: function(data) {
                    // $("#loadingDiv").hide();
                    if (data.success == 1){
                        $("html, body").animate({ scrollTop: 0 });
                        $('#flashMessages').html(
                            `<div class="alert alert-success">
                            <img class="alert-img" src="{{asset('assets/icons/success-alert-icon.png')}}" alt="">
                            <p class="alert-text">${data.message}</p></div>`
                        )
                        window.open(xeroAuthorize, "_self")
                        // setTimeout(function(){
                        //     window.location.reload();
                        // }, 2000);
                        // $(".alert-text").html(response.message);
                    }
                },
                error: function(xhr){
                    // console.log($(this))
                    $('#edit-send').prop('disabled', false);
                    // $("#loadingDiv").hide();
                    $.each(xhr.responseJSON.errors, function (key, value) {
                        $('.edit-invoice-' + key).text(value);
                    });
                    // alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
                }
            });
        })

        function fetchViewData(id) {
            let url='{{route('billing.show', ':id')}}'
            url= url.replace(':id', id)
            $.ajax({
                url: url,
                success: function (res) {
                    if (res.abort == 403){
                        $('#view-bill').addClass('d-none')
                        $("html, body").animate({ scrollTop: 0 });
                        $('#flashMessages').html(
                            `<div class="alert alert-success alert-access">
                            <img class="alert-img" src="{{asset('assets/icons/mailbody-!.png')}}" alt="">
                            <p class="alert-text">${res.message}</p></div>`
                        )
                        setTimeout(function(){
                            window.location.reload();
                        }, 4000);
                    }else{
                        // console.log(res)
                        let gstOptions=''
                        let directorEmail=''
                        let subTotal=res[0].sub_total.toFixed(2)
                        let grandTotal=res[0].grand_total.toFixed(2)
                        let discount=0.00
                        let viewSubTotalValueAfterDiscount=0.00
                        directorEmail+=res[0].user.email+'; '
                        $.each(res[0].user.ccs, function(index, cc) {
                            if(cc!=null){

                                directorEmail+= cc +'; '
                            }
                        });
                        let customerEmail = directorEmail.substring(0, directorEmail.length-1)
                        gstOptions+=`<option value="8" ${(res[0].gst== 8 ? 'selected' : '')}>8%</option>
                                 <option value="9" ${(res[0].gst== 9 ? 'selected' : '')}>9%</option>
                                 <option value="10" ${(res[0].gst== 10 ? 'selected' : '')}>10%</option>`

                        // $('#invoice_id').val(res[0].id)
                        $('#view_cust_mail').text(customerEmail)
                        $("#view_company_id").text(res[0].company.name)
                        $("#view_cust_name").text(res[0].user.first_name+' '+res[0].user.last_name)
                        $("#view_gst").empty().append(gstOptions)

                        $("#view_billing_address").text(res[0].billing_address)
                        $("#view_terms").text(res[0].terms)
                        $("#view_invoice_date").text(res[0].invoice_date)
                        $("#view_due_date").text(res[0].due_date)
                        $("#view_created_by").text(res[0].admin_user.first_name + ' '+res[0].admin_user.last_name)
                        $("#view_description").text(res[0].description)
                        if (res[0].notes!=null){
                            $("#view_notes").text(res[0].notes)
                        }else {
                            $("#view_notes").text('--')
                        }

                        $("#view_subscription_start").text(res[0].subscription_start)
                        $("#view_subscription_end").text(res[0].subscription_end)
                        $("#view_sub_total").text(subTotal)
                        if (res[0].discount !=null){
                            discount=res[0].discount.toFixed(2)
                        }
                        viewSubTotalValueAfterDiscount = Number(subTotal) - Number(discount)
                        $("#view_discount").text(discount)
                        $("#view_sub_total_text").text('S$'+addCommas(parseFloat(viewSubTotalValueAfterDiscount).toFixed(2)))
                        // $("#edit_grand_total").val(grandTotal)
                        $("#view_grand_total_text").text('S$'+addCommas(grandTotal))
                        $("#view_discount_text").text('S$'+discount)
                        gstValueCalculationForView(res[0].gst,viewSubTotalValueAfterDiscount)

                        $('#void-btn').attr('data-id', res[0].id)

                        let invoicePdfUrl='{{route('invoice.pdf', ':id')}}'
                        invoicePdfUrl=invoicePdfUrl.replace(':id',  res[0].id)
                        $('#download-invoice-btn').attr('href',invoicePdfUrl)
                        // editSubTotalValue=parseFloat(subTotal)
                        // editGrandTotalValue=parseFloat(grandTotal)
                    }


                },
                error: function(xhr){
                    // console.log($(this))
                    // $('#create-send').prop('disabled', false);
                    // // $("#loadingDiv").hide();
                    // $.each(xhr.responseJSON.errors, function (key, value) {
                    //     $('.invoice-' + key).text(value);
                    // });
                    alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
                }
            })
        }

        function voidInvoice(e) {
            let id = e.getAttribute('data-id')
            $('#confirm-void').attr('data-id', id)
        }
        function makeVoid(e) {
            {{--let xeroAuthorize = "{{route('authorize')}}"--}}
            let xeroAuthorize = "{{route('authorization.resource')}}"
            $('#invoiceVoidModal').modal('hide')
            let id= e.getAttribute('data-id')

            let url='{{route('void.invoice', ':id')}}'
            url= url.replace(':id', id)
            $.ajax({
                url: url,
                success: function (res) {
                    // console.log(res)
                    if (res.success == 1){
                        $("html, body").animate({ scrollTop: 0 });
                        $('#flashMessages').html(
                            `<div class="alert alert-success">
                            <img class="alert-img" src="{{asset('assets/icons/success-alert-icon.png')}}" alt="">
                            <p class="alert-text">${res.message}</p></div>`
                        )
                        window.open(xeroAuthorize, "_self")
                        // setTimeout(function(){
                        //     window.location.reload();
                        // }, 2000);
                        // $(".alert-text").html(response.message);
                    }

                },
                error: function(xhr){
                    // console.log($(this))
                    // $('#create-send').prop('disabled', false);
                    // // $("#loadingDiv").hide();
                    // $.each(xhr.responseJSON.errors, function (key, value) {
                    //     $('.invoice-' + key).text(value);
                    // });
                    alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
                }
            })
        }

        // Validation For Restrict Taking Date
        var dtToday = new Date();

        var month = dtToday.getMonth() + 1;
        var day = dtToday.getDate();
        var year = dtToday.getFullYear();
        if (month < 10)
            month = '0' + month.toString();
        if (day < 10)
            day = '0' + day.toString();

        var prepareDate = year + '-' + month + '-' + day;
        // console.log(prepareDate)
        // Validation For Restrict Taking Past Date Only Take Future Date
        $('.take_future_date').attr('min', prepareDate);
        // Validation For Restrict Taking Past Date Only Take Future Date Ends

        // Validation For Restrict Taking Future Date Only Take Past Date
        $('.take_past_date').attr('max', prepareDate);
        // Validation For Restrict Taking Future Date Only Take Past Date Ends


        {{--function invoicePdf(e) {--}}
        {{--    let id=e.getAttribute('data-id')--}}
        {{--    let url='{{route('invoice.pdf', ':id')}}'--}}
        {{--    url=url.replace(':id', id)--}}
        {{--    $.ajax({--}}
        {{--        url: url,--}}
        {{--        --}}{{--success: function (res) {--}}
        {{--        --}}{{--    console.log(res)--}}
        {{--        --}}{{--    if (res.success == 1){--}}
        {{--        --}}{{--        $("html, body").animate({ scrollTop: 0 });--}}
        {{--        --}}{{--        $('#flashMessages').html(--}}
        {{--        --}}{{--            `<div class="alert alert-success">--}}
        {{--        --}}{{--            <img class="alert-img" src="{{asset('assets/icons/success-alert-icon.png')}}" alt="">--}}
        {{--        --}}{{--            <p class="alert-text">${res.message}</p></div>`--}}
        {{--        --}}{{--        )--}}
        {{--        --}}{{--        // $(".alert-text").html(response.message);--}}
        {{--        --}}{{--    }--}}

        {{--        --}}{{--},--}}
        {{--        --}}{{--error: function(xhr){--}}
        {{--        --}}{{--    // console.log($(this))--}}
        {{--        --}}{{--    // $('#create-send').prop('disabled', false);--}}
        {{--        --}}{{--    // // $("#loadingDiv").hide();--}}
        {{--        --}}{{--    // $.each(xhr.responseJSON.errors, function (key, value) {--}}
        {{--        --}}{{--    //     $('.invoice-' + key).text(value);--}}
        {{--        --}}{{--    // });--}}
        {{--        --}}{{--    alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);--}}
        {{--        --}}{{--}--}}
        {{--    })--}}

        {{--}--}}

    </script>



@endpush
