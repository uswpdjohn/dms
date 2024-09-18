@extends('layouts.master')
@section('content')
    <!-- Main Body Start -->
    <div class="main-body">
        <div id="flashMessages"></div>
        @if(session('success'))
            <div class="alert alert-success alert-redirect">
                <img class="alert-img" src="{{asset('assets/icons/success-alert-icon.png')}}" alt="">
                <p class="alert-text"> {{session('success')}}</p>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-success">
                <img class="alert-img" src="{{asset('assets/icons/mailbody-!.png')}}" alt="">
                <p class="alert-text">{{session('error')}}</p>
            </div>
        @endif
        <div class="row admin-doc-manage-body g-0">
            <div class="col-12 col-md-2 col-sm-12 card admin-doc-manage-button-card">
                <div class="card-body admin-doc-manage-button-body">
                    <div class="tab-buttons">
                        <button class="tablinks adminDocManageTabLinks"
                                onclick="adminDocManageTab(event, 'corp-secretary')" id="tabCorpSec">Corp Secretary
                        </button>
                        <button class="tablinks adminDocManageTabLinks" id="tabTax"
                                onclick="adminDocManageTab(event, 'tax')">Tax
                        </button>
                        <button class="tablinks adminDocManageTabLinks"
                                onclick="adminDocManageTab(event, 'accounting')" id="tabAcc">Accounting
                        </button>
                        <button class="tablinks adminDocManageTabLinks"
                                onclick="adminDocManageTab(event, 'human-resource')" id="tabHr">Human Resource
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-10 col-sm-12">
                <div class="card admin-doc-manage-card">
                    <div class="card-body admin-doc-manage-content-body">

                        <!-- All View Portion starts -->

                        <!--Corporate Secretary  View Doc Portion Starts -->
                        <div class="back-btn-div adminDocManageTabContent view-doc">
                            <button class="back-btn btn" onclick="goBack(event,'corp-secretary')">
                                <i class="fa-solid fa-arrow-left"></i>
                            </button>
                        </div>
                        <div id="view-doc" class="tabcontent adminDocManageTabContent view-doc">
                            <form action="" id="corp-sec-view-form">
                                <div id="corp-sec-view">
                                    <div class="row">
                                        <input name="category-name" value="Corporate Secretary" type="text" hidden/>
                                        <input name="document_hashed_id" id="corpSecHashedDocId" value="" type="text"
                                               hidden/>
                                        <input name="document_id" id="corpSecDocId" value="" type="text" hidden/>
                                        <input name="director" id="corpSecViewDirector" value="" type="text" hidden/>
                                        <input name="shareholder" id="corpSecViewShareholder" value="" type="text"
                                               hidden/>
                                        <div class="col-sm-12 col-md-6">
                                            <fieldset class="form-group">
                                                <label for="company_id" class="mb-2 mt-3">Company Name</label>
                                                <p id="corp_sec_company_name"></p>
                                            </fieldset>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="title" class="mb-2 mt-3">Document Name</label>
                                                <p id="corp_sec_document_name" class=""></p>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="col-sm-12 col-md-6">
                                            <label for="document-upload" class="custom-file-uploaded">
                                                Your Document
                                            </label>
                                            <div class="d-flex doc-div">
                                                <p id="corp_sec_file_name" class="doc-title"></p>
                                                <div class="btn-portion">
                                                    <a href="" class="btn download-bth" id="corpSec-doc-download-btn"
                                                       data-id="">
                                                        <img src="{{asset('assets/icons/download-silver-icon.png')}}"
                                                             alt="">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div style="margin-top:18px;"> <a href="#" style="text-decoration:none;" class="d-none" onclick="generateTempUrl(this)" data-service="corp-sec" id="corp-temp-url" data-id="">Generate Temporary URL</a></div>

                                            <span class="d-none" id="corp-sec-temp-url"></span><span class="d-none" style="cursor:pointer;font-size:18px;color:blue;" title="copy" onclick="copyToClipboard(this)" data-service="corp-sec" id="corp-copy-temp-url"><span style="font-size: 14px; color: green; cursor: text;" class="">Link has been generated successfully.Click the icon to copy the link </span><i class="fa-regular fa-clipboard"></i></span>
                                            <span style="background-color: white; padding: 3px; margin-left: 10px; display: inline-flex; border-radius: 3px; font-size: 12px; align-items: center;"></span>
                                        </div>
                                        <div class="admin-doc-manage-create-down-card-portion col-12 col-lg-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="d-flex">
                                                        <h6 class="director-header">Directors</h6>
                                                    </div>
                                                    <div id="corp-sec-view-director">
                                                        {{--                                                        <div class="directors d-flex">--}}
                                                        {{--                                                            <div>--}}
                                                        {{--                                                                <p>Wayne Rooney (waynerooney@trilliongroup.com)</p>--}}
                                                        {{--                                                                <p>cc: samantha@trilliongroup.com</p>--}}
                                                        {{--                                                                <p>cc: yingtze@trilliongroup.com</p>--}}
                                                        {{--                                                                <p>cc: aaron@trilliongroup.com</p>--}}
                                                        {{--                                                            </div>--}}
                                                        {{--                                                            <!-- <button type="button" class="btn p-0 ps-3 ms-auto cancel-btn">x</button> -->--}}
                                                        {{--                                                        </div>--}}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="d-flex">
                                                        <h6 class="shareholder-header">Shareholders</h6>
                                                    </div>
                                                    <div id="corp-sec-view-shareholder">
                                                        {{--                                                        <div class="shareholders d-flex">--}}
                                                        {{--                                                            <div>--}}
                                                        {{--                                                                <p>Derek Timothy (derektimothy@trilliongroup.com)</p>--}}
                                                        {{--                                                                <p>cc: samantha@trilliongroup.com</p>--}}
                                                        {{--                                                                <p>cc: yingtze@trilliongroup.com</p>--}}
                                                        {{--                                                                <p>cc: aaron@trilliongroup.com</p>--}}
                                                        {{--                                                            </div>--}}
                                                        {{--                                                            <!-- <button type="button" class="btn p-0 ps-3 ms-auto cancel-btn">x</button> -->--}}
                                                        {{--                                                        </div>--}}
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6 mt-2">
                                            <button type="button" id="corp-sec-submit-mail"
                                                    class="btn admin-doc-create-submit-btn" hidden>Submit
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="admin-doc-create-btn-section tabcontent ">
                                <button type="button" id="corp-sec-go-edit"
                                        onclick="adminDocCreateTab(event, 'edit-doc',this)"
                                        class="btn  admin-doc-create-edit-btn mt-3">Edit
                                </button>
                                <button type="button" id="corp-sec-send-mail"
                                        class="btn admin-doc-create-send-btn mt-3">
                                    <div id="CorpSecSendMailLoadingDiv"><span class="spinner-border spinner-border-sm"
                                                                              role="status" aria-hidden="true"></span>
                                    </div>
                                    Send mail
                                </button>
                            </div>
                        </div>
                        <!-- Corporate Secretary view Doc Portion Ends -->

                        <!--tax  View Doc Portion Starts -->
                        <div class="back-btn-div adminDocManageTabContent tax-view-doc">
                            <button class="back-btn btn" onclick="goBack(event,'tax')">
                                <i class="fa-solid fa-arrow-left"></i>
                            </button>
                        </div>
                        <div id="tax-view-doc" class="tabcontent adminDocManageTabContent tax-view-doc">
                            <form action="" id="tax-view-form">
                                <div class="row ">
                                    <input name="document_hashed_id" id="taxHashedDocId" value="" type="text" hidden/>
                                    <input name="document_id" id="taxDocId" value="" type="text" hidden/>
                                    <input name="director" id="taxViewDirector" value="" type="text" hidden/>
                                    <input name="shareholder" id="taxViewShareholder" value="" type="text" hidden/>
                                    <input name="category-name" value="Tax" type="text" hidden/>
                                    <div class="col-sm-12 col-md-6">
                                        <fieldset class="form-group">
                                            <label for="company_id" class="mb-2 mt-3">Company Name</label>
                                            <p id="tax_company_name"></p>
                                        </fieldset>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="title" class="mb-2 mt-3">Document Name</label>
                                            <p id="tax_document_name" class=""></p>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="col-sm-12 col-md-6">
                                        <label for="document-upload" class="custom-file-uploaded">
                                            Your Document
                                        </label>
                                        <div class="d-flex doc-div">
                                            <p id="tax_file_name" class="doc-title"></p>
                                            <div class="btn-portion">
                                                <a href="" class="btn download-bth" id="tax-doc-download-btn"
                                                   data-id="">
                                                    <img src="{{asset('assets/icons/download-silver-icon.png')}}"
                                                         alt="">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div style="margin-top:18px;"> <a href="#" style="text-decoration:none;" class="d-none" onclick="generateTempUrl(this)" data-service="tax" id="tax-temp-url" data-id="">Generate Temporary URL</a></div>

                                        <span id="tax-temp" class="d-none"></span><span class="d-none" style="cursor:pointer;font-size:18px;color:blue;" title="copy" onclick="copyToClipboard(this)" data-service="tax" id="tax-copy-temp-url">
                                        <span style="font-size: 14px; color: green; cursor: text;" class="">Link has been generated successfully.Click the icon to copy the link </span><i class="fa-regular fa-clipboard"></i></span>
                                        <span style="background-color: white; padding: 3px; margin-left: 10px; display: inline-flex; border-radius: 3px; font-size: 12px; align-items: center;"></span>
                                    </div>
                                    <div class="admin-doc-manage-create-down-card-portion col-12 col-lg-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <h6 class="director-header">Directors</h6>
                                                </div>
                                                <div id="tax-view-director">
                                                    {{--                                                    <div class="directors d-flex" >--}}
                                                    {{--                                                        <div>--}}
                                                    {{--                                                            <p>Wayne Rooney (waynerooney@trilliongroup.com)</p>--}}
                                                    {{--                                                            <p>cc: samantha@trilliongroup.com</p>--}}
                                                    {{--                                                            <p>cc: yingtze@trilliongroup.com</p>--}}
                                                    {{--                                                            <p>cc: aaron@trilliongroup.com</p>--}}
                                                    {{--                                                        </div>--}}
                                                    {{--                                                        <!-- <button type="button" class="btn p-0 ps-3 ms-auto cancel-btn">x</button> -->--}}
                                                    {{--                                                    </div>--}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <h6 class="shareholder-header">Shareholders</h6>
                                                </div>
                                                <div id="tax-view-shareholder">
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 mt-2">
                                        <button type="button" id="tax-submit-mail"
                                                class="btn admin-doc-create-submit-btn" hidden>Submit
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <div class="admin-doc-create-btn-section tabcontent ">
                                <button type="button" id="tax-go-edit"
                                        onclick="adminDocCreateTab(event, 'tax-edit-doc',this)"
                                        class="btn  admin-doc-create-edit-btn mt-3">Edit
                                </button>
                                <button type="button" id="tax-send-mail" class="btn admin-doc-create-send-btn mt-3">
                                    <div id="TaxSendMailLoadingDiv"><span class="spinner-border spinner-border-sm"
                                                                          role="status" aria-hidden="true"></span></div>
                                    Send mail
                                </button>
                            </div>
                        </div>
                        <!-- tax view Doc Portion Ends -->

                        <!--Accounting  View Doc Portion Starts -->
                        <div class="back-btn-div adminDocManageTabContent acc-view-doc">
                            <button class="back-btn btn" onclick="goBack(event,'accounting')"><i
                                    class="fa-solid fa-arrow-left"></i></button>
                        </div>
                        <div id="acc-view-doc" class="tabcontent adminDocManageTabContent acc-view-doc">
                            <form action="" id="acc-view-form">
                                <div class="row ">
                                    <input name="document_hashed_id" id="accHashedDocId" value="" type="text" hidden/>
                                    <input name="document_id" id="accDocId" value="" type="text" hidden/>
                                    <input name="director" id="accViewDirector" value="" type="text" hidden/>
                                    <input name="shareholder" id="accViewShareholder" value="" type="text" hidden/>
                                    <input name="category-name" value="Accounting" type="text" hidden/>
                                    <div class="col-sm-12 col-md-6">
                                        <fieldset class="form-group">
                                            <label for="company_id" class="mb-2 mt-3">Company Name</label>
                                            <p id="acc_company_name"></p>
                                        </fieldset>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="title" class="mb-2 mt-3">Document Name</label>
                                            <p id="acc_document_name" class=""></p>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="col-sm-12 col-md-6">
                                        <label for="document-upload" class="custom-file-uploaded">
                                            Your Document
                                        </label>
                                        <div class="d-flex doc-div">
                                            <p id="acc_file_name" class="doc-title"></p>
                                            <div class="btn-portion">
                                                <a href="" class="btn download-bth" id="acc-doc-download-btn"
                                                   data-id="">
                                                    <img src="{{asset('assets/icons/download-silver-icon.png')}}"
                                                         alt="">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div style="margin-top:18px;"> <a href="#" style="text-decoration:none;" class="d-none" onclick="generateTempUrl(this)" data-service="acc" id="acc-temp-url" data-id="">Generate Temporary URL</a></div>

                                        <span class="d-none" id="acc-temp"></span><span class="d-none" style="cursor:pointer;font-size:18px;color:blue;" title="copy" onclick="copyToClipboard(this)" data-service="acc" id="acc-copy-temp-url">
                                            <span style="font-size: 14px; color: green; cursor: text;" class="">Link has been generated successfully.Click the icon to copy the link </span><i class="fa-regular fa-clipboard"></i></span>
                                        <span style="background-color: white; padding: 3px; margin-left: 10px; display: inline-flex; border-radius: 3px; font-size: 12px; align-items: center;"></span>
                                    </div>
                                    <div class="admin-doc-manage-create-down-card-portion col-12 col-lg-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <h6 class="director-header">Directors</h6>
                                                </div>
                                                <div id="acc-view-director"></div>

                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <h6 class="shareholder-header">Shareholders</h6>
                                                </div>
                                                <div id="acc-view-shareholder"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 mt-2">
                                        <button type="button" id="acc-submit-mail"
                                                class="btn admin-doc-create-submit-btn" hidden>Submit
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <div class="admin-doc-create-btn-section tabcontent ">
                                <button type="button" id="acc-go-edit"
                                        onclick="adminDocCreateTab(event, 'acc-edit-doc',this)"
                                        class="btn  admin-doc-create-edit-btn mt-3">Edit
                                </button>
                                <button type="button" id="acc-send-mail" class="btn admin-doc-create-send-btn mt-3">
                                    <div id="AccSendMailLoadingDiv"><span class="spinner-border spinner-border-sm"
                                                                          role="status" aria-hidden="true"></span></div>
                                    Send mail
                                </button>
                            </div>
                        </div>
                        <!-- Accounting view Doc Portion Ends -->

                        <!--Human Resource  View Doc Portion Starts -->
                        <div class="back-btn-div adminDocManageTabContent hr-view-doc">
                            <button class="back-btn btn" onclick="goBack(event, 'human-resource')"><i
                                    class="fa-solid fa-arrow-left"></i>
                            </button>
                        </div>
                        <div id="hr-view-doc" class="tabcontent adminDocManageTabContent hr-view-doc">
                            <form action="" id="hr-view-form">
                                <div class="row ">
                                    <input name="document_hashed_id" id="hrHashedDocId" value="" type="text" hidden/>
                                    <input name="document_id" id="hrDocId" value="" type="text" hidden/>
                                    <input name="director" id="hrViewDirector" value="" type="text" hidden/>
                                    <input name="shareholder" id="hrViewShareholder" value="" type="text" hidden/>
                                    <input name="category-name" value="Human Resource" type="text" hidden/>
                                    <div class="col-sm-12 col-md-6">
                                        <fieldset class="form-group">
                                            <label for="company_id" class="mb-2 mt-3">Company Name</label>
                                            <p id="hr_company_name"></p>
                                        </fieldset>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="title" class="mb-2 mt-3">Document Name</label>
                                            <p id="hr_document_name" class=""></p>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="col-sm-12 col-md-6">
                                        <label for="document-upload" class="custom-file-uploaded">
                                            Your Document
                                        </label>
                                        <div class="d-flex doc-div">
                                            <p id="hr_file_name" class="doc-title"></p>
                                            <div class="btn-portion">
                                                <a href="" class="btn download-bth" id="hr-doc-download-btn" data-id="">
                                                    <img src="{{asset('assets/icons/download-silver-icon.png')}}"
                                                         alt="">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div style="margin-top:18px;"> <a href="#" style="text-decoration:none;" class="d-none" onclick="generateTempUrl(this)" data-service="hr" id="hr-temp-url" data-id="">Generate Temporary URL</a></div>

                                        <span class="d-none" id="hr-temp"></span><span class="d-none" style="cursor:pointer;font-size:18px;color:blue;" title="copy" onclick="copyToClipboard(this)" data-service="hr" id="hr-copy-temp-url">
                                            <span style="font-size: 14px; color: green; cursor: text;" class="">Link has been generated successfully.Click the icon to copy the link </span><i class="fa-regular fa-clipboard"></i></span>
                                        <span style="background-color: white; padding: 3px; margin-left: 10px; display: inline-flex; border-radius: 3px; font-size: 12px; align-items: center;"></span>
                                    </div>
                                    <div class="admin-doc-manage-create-down-card-portion col-12 col-lg-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <h6 class="director-header">Directors</h6>
                                                </div>
                                                <div id="hr-view-director"></div>

                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <h6 class="shareholder-header">Shareholders</h6>
                                                </div>
                                                <div id="hr-view-shareholder"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 mt-2">
                                        <button type="button" id="hr-submit-mail"
                                                class="btn admin-doc-create-submit-btn" hidden>Submit
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <div class="admin-doc-create-btn-section tabcontent ">
                                <button type="button" id="hr-go-edit"
                                        onclick="adminDocCreateTab(event, 'hr-edit-doc', this)"
                                        class="btn  admin-doc-create-edit-btn mt-3">Edit
                                </button>
                                <button type="button" id="hr-send-mail" class="btn admin-doc-create-send-btn mt-3">
                                    <div id="HrSendMailLoadingDiv"><span class="spinner-border spinner-border-sm"
                                                                         role="status" aria-hidden="true"></span></div>
                                    Send mail
                                </button>
                            </div>
                        </div>
                        <!--Human Resource view Doc Portion Ends -->
                        <!-- All View Portion ends -->

                        <!-- Corporate Secretary Portion Starts -->

                        <!--Corporate Secretary  Create Doc Portion Starts -->
                        <div class="back-btn-div adminDocManageTabContent create-doc">
                            <button class="back-btn btn" onclick="goBack(event,'corp-secretary')"><i
                                    class="fa-solid fa-arrow-left"></i></button>
                        </div>
                        <div id="create-doc" class="tabcontent adminDocManageTabContent create-doc">
                            <form action="" id="corp-sec-doc-upload">
                                <meta name="csrf-token" content="{{ csrf_token() }}"/>
                                <div class="row ">
                                    {{--                                    <input name="category-name" value="Corporate Secretary" type="text" hidden />--}}
                                    <input name="shareholder[]" id="shareholdersId" value="" type="text" hidden
                                           readonly/>
                                    <input name="director[]" id="directorsId" value="" type="text" hidden readonly/>
                                    <input name="service_id" id="" value="1" type="text" hidden readonly/>
                                    <div class="col-sm-12 col-md-6">
                                        <fieldset class="form-group">
                                            <label for="company_id" class="mb-2 mt-3">
                                                <span class="required-sign">*</span>Company</label>
                                            <select class="form-control select form-select" name="company_id"
                                                    id="corp_sec_company_id" required>
                                                <option hidden class="first-option" value="">Select</option>

                                                @foreach($companies as $company)
                                                    <option
                                                        value="{{$company->id}}">{{ucfirst($company->name)}}</option>
                                                @endforeach
                                            </select>
                                        </fieldset>
                                        <span class="text-danger corpSec-company_id"></span>
                                    </div>


                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="title" class="mb-2 mt-3"><span class="required-sign">*</span>Document
                                                Name</label>
                                            <input type="text" class="form-control" name="name" id="corp-sec-name">
                                        </div>
                                        <span class="text-danger corpSec-name"></span>
                                    </div>
                                    <br>
                                    <div class="col-sm-12 col-md-6">
                                        <label for="document-upload" class="custom-file-uploaded"><span
                                                class="required-sign">*</span>Upload Your Document
                                        </label>
                                        <div class="upload-container">
                                            <label for="document-upload-cs" class="custom-file-upload">
                                                <i class="fa fa-paperclip" aria-hidden="true"></i>
                                            </label>
                                            <input id="file-name-cs" class="file-name form-control" type="text"
                                                   readonly/>
                                            <input id="document-upload-cs" class="document-upload" name="file"
                                                   type="file" accept=".doc, .docx, .pdf, .zip, .rar"
                                                   onchange="displayFileName('file-name-cs', 'document-upload-cs')"/>
                                            <button class="upload-button">Upload</button>
                                        </div>
                                        <span class="text-danger corpSec-file"></span>
                                    </div>
                                    <div class="admin-doc-manage-create-down-card-portion col-12 col-lg-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <h6 class="director-header">Directors</h6>
                                                    <a href="#" class="director-select-modal-btn" data-bs-toggle="modal"
                                                       data-bs-target="#directorSelectModal">
                                                        <img src="{{asset('assets/icons/add-button-icon.png')}}"
                                                             alt=""/></a>
                                                </div>
                                                <!-- Director select Modal Start -->
                                                <div class="modal fade" id="directorSelectModal"
                                                     data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                                     aria-labelledby="directorSelectModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog ds-select-modal">
                                                        <div class="modal-content">
                                                            <div class="ds-select-modal-body">
                                                                <div class="ds-select-modal-header row">
                                                                    <h5 class="modal-title col-11"
                                                                        id="directorSelectModalLabel">Select New
                                                                        Director</h5>
                                                                    <button type="button"
                                                                            class="btn btn-close btn-sm ds-select-modal-close-btn col-1"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                </div>
                                                                <div class="ds-select-modal-data row">
                                                                    <form action="#">
                                                                        <div class="data-body row">
                                                                            <div class="data-row col-12 col-md-12"
                                                                                 id="corp-sec-director-modal">
                                                                            </div>
                                                                            <div class="data-row col-12 text-end">
                                                                                <button type="button" id="add-director"
                                                                                        class="create-ds-btn btn">Add
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Director select Modal End -->
                                                <div id="append-corp-sec-director">
                                                    {{--                                                                                                        <div id="director-list">--}}
                                                    {{--                                                        <div--}}
                                                    {{--                                                            class="directors d-flex">--}}
                                                    {{--                                                            <div>--}}
                                                    {{--                                                                <p>Wayne Rooney (waynerooney@trilliongroup.com)</p>--}}
                                                    {{--                                                                <p>cc: samantha@trilliongroup.com</p>--}}
                                                    {{--                                                                <p>cc: yingtze@trilliongroup.com</p>--}}
                                                    {{--                                                                <p>cc: aaron@trilliongroup.com</p>--}}
                                                    {{--                                                            </div>--}}
                                                    {{--                                                            <button type="button" class="btn p-0 ps-3 ms-auto cancel-btn">x</button>--}}
                                                    {{--                                                        </div>--}}
                                                    {{--                                                                                                        </div>--}}
                                                </div>

                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <h6 class="shareholder-header">Shareholders</h6>
                                                    <a href="#" class="shareholder-select-modal-btn"
                                                       data-bs-toggle="modal" data-bs-target="#shareholderSelectModal">
                                                        <img src="{{asset('assets/icons/add-button-icon.png')}}"
                                                             alt=""/></a>
                                                </div>
                                                <!-- Shareholder select Modal Start -->
                                                <div class="modal fade" id="shareholderSelectModal"
                                                     data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                                     aria-labelledby="shareholderSelectModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog ds-select-modal">
                                                        <div class="modal-content">
                                                            <div class="ds-select-modal-body">
                                                                <div class="ds-select-modal-header row">
                                                                    <h5 class="modal-title col-11"
                                                                        id="shareholderSelectModalLabel">Select New
                                                                        Shareholders</h5>
                                                                    <button type="button"
                                                                            class="btn btn-close btn-sm ds-select-modal-close-btn col-1"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                </div>
                                                                <div class="ds-select-modal-data row">
                                                                    <form action="#">
                                                                        <div class="data-body row">
                                                                            <div class="data-row col-12 col-md-12"
                                                                                 id="corp-sec-shareholder-modal">
                                                                                {{--                                                                                <div class="shareholders d-flex">--}}
                                                                                {{--                                                                                    <div class="col-md-2 col-sm-1 col-1">--}}
                                                                                {{--                                                                                        <input type="checkbox"class="select-checkbox" name="shareholders[]" value="d1"/>--}}
                                                                                {{--                                                                                    </div>--}}
                                                                                {{--                                                                                    <div class="col-md-10 col-sm-11 col-11">--}}
                                                                                {{--                                                                                        <p class="shareholder-name">Wayne Rooney 3(waynerooney@trilliongroup.com)</p>--}}
                                                                                {{--                                                                                        <p class="cc1">cc: samantha@trilliongroup.com</p>--}}
                                                                                {{--                                                                                        <p class="cc2">cc: yingtze@trilliongroup.com</p>--}}
                                                                                {{--                                                                                        <p class="cc3">cc: aaron@trilliongroup.com</p>--}}
                                                                                {{--                                                                                    </div>--}}
                                                                                {{--                                                                                </div>--}}
                                                                            </div>
                                                                            <div class="data-row col-12 text-end">
                                                                                <button type="button"
                                                                                        id="add-shareholder"
                                                                                        class="create-ds-btn btn">Add
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Shareholder select Modal End -->
                                                <div id="append-corp-sec-shareholder">
                                                    {{--                                                    <div id="shareholder-list">--}}
                                                    {{--                                                        <div--}}
                                                    {{--                                                            class="shareholders d-flex">--}}
                                                    {{--                                                            <div>--}}
                                                    {{--                                                                <p>Wayne Rooney (waynerooney@trilliongroup.com)</p>--}}
                                                    {{--                                                                <p>cc: samantha@trilliongroup.com</p>--}}
                                                    {{--                                                                <p>cc: yingtze@trilliongroup.com</p>--}}
                                                    {{--                                                                <p>cc: aaron@trilliongroup.com</p>--}}
                                                    {{--                                                            </div>--}}
                                                    {{--                                                            <button type="button" class="btn p-0 ps-3 ms-auto cancel-btn">x</button>--}}
                                                    {{--                                                        </div>--}}
                                                    {{--                                                    </div>--}}
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                    <p class="text-danger" id="corpSecNoSignerAlert"></p>
                                    <div class="col-sm-12 col-md-6 mt-2">
                                        <button type="button" id="corp-sec-submit"
                                                class="btn admin-doc-create-submit-btn" hidden>Submit
                                        </button>
                                    </div>
                                </div>
                            </form>

                            <div class="admin-doc-create-btn-section tabcontent">
                                <button type="button" id="corp-sec-send" class="btn admin-doc-create-send-btn mt-3">
                                    <div id="CorpSecLoadingDiv"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></div>
                                    Submit
                                </button>

                            </div>
                        </div>
                        <!-- Corporate Secretary Create Doc Portion Ends -->
                        <!--Corporate Secretary  Edit Doc Portion Starts -->
                        <div class="back-btn-div adminDocManageTabContent edit-doc">
                            <button class="back-btn btn" onclick="goBack(event,'corp-secretary')"><i
                                    class="fa-solid fa-arrow-left"></i></button>
                        </div>
                        <div id="edit-doc" class="tabcontent adminDocManageTabContent edit-doc">
                            <form action="" id="corp-sec-edit-doc">
                                <meta name="csrf-token" content="{{ csrf_token() }}"/>
                                <div class="row ">
                                    <input name="shareholder[]" id="corpSecEditShareholdersId" value="" type="text"
                                           hidden readonly/>
                                    <input name="director[]" id="corpSecEditDirectorsId" value="" type="text" hidden
                                           readonly/>
                                    <input name="current_document_id" id="corpSecDocumentId" value="" type="text" hidden
                                           readonly/>
                                    <input name="document_hashed" id="corpSecHashedDocumentId" value="" type="text"
                                           hidden readonly/>
                                    <input name="service_id" id="" value="1" type="text" hidden/>
                                    {{--                                    <input name="category-name" value="Corporate Secretary" type="text" hidden />--}}
                                    <div id="corp-sec-edit"></div>
                                    <div class="col-sm-12 col-md-6">
                                        <fieldset class="form-group">
                                            <label for="company_id" class="mb-2 mt-3">
                                                <span class="required-sign">*</span>Company</label>
                                            <select class="form-control select form-select" name="company_id"
                                                    id="corp-sec-edit-company_id" required>
                                            </select>
                                        </fieldset>
                                        <span class="text-danger corpSec-edit-company_id"></span>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="title" class="mb-2 mt-3"><span class="required-sign">*</span>Document
                                                Name</label>
                                            <input type="text" class="form-control" name="name" value=""
                                                   id="corp-sec-edit-name">
                                        </div>
                                        <span class="text-danger corpSec-edit-name"></span>
                                    </div>
                                    <br>
                                    <div class="col-sm-12 col-md-6">
                                        <label for="document-upload" class="custom-file-uploaded"><span
                                                class="required-sign">*</span>Upload Your Document
                                        </label>
                                        <div class="upload-container">
                                            <label for="document-edit-cs" class="custom-file-upload">
                                                <i class="fa fa-paperclip" aria-hidden="true"></i>
                                            </label>
                                            <input id="file-edit-cs" class="file-name form-control" type="text"
                                                   readonly/>
                                            <input id="document-edit-cs" class="document-upload" type="file" name="file"
                                                   value="" accept=".doc, .docx, .pdf, .zip, .rar"
                                                   onchange="displayFileName('file-edit-cs', 'document-edit-cs')"/>
                                            <button class="upload-button" type="button">Upload</button>
                                        </div>
                                        <span class="text-danger corpSec-edit-file"></span>
                                    </div>
                                    <div class="admin-doc-manage-create-down-card-portion col-12 col-lg-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <h6 class="director-header">Directors</h6>
                                                    <a href="#" class="director-select-modal-btn" data-bs-toggle="modal"
                                                       data-bs-target="#directorEditModal">
                                                        <img src="{{asset('assets/icons/add-button-icon.png')}}"
                                                             alt=""/></a>
                                                </div>
                                                <!-- Director edit Modal Start -->
                                                <div class="modal fade" id="directorEditModal" data-bs-backdrop="static"
                                                     data-bs-keyboard="false" tabindex="-1"
                                                     aria-labelledby="directorEditModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog ds-select-modal">
                                                        <div class="modal-content">
                                                            <div class="ds-select-modal-body">
                                                                <div class="ds-select-modal-header row">
                                                                    <h5 class="modal-title col-11"
                                                                        id="directorEditModalLabel">Select New
                                                                        Director</h5>
                                                                    <button type="button"
                                                                            class="btn btn-close btn-sm ds-select-modal-close-btn col-1"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                </div>
                                                                <div class="ds-select-modal-data row">
                                                                    <form action="#">
                                                                        <div class="data-body row">
                                                                            <div class="data-row col-12 col-md-12"
                                                                                 id="corp-sec-edit-director-modal">

                                                                            </div>
                                                                            <div class="data-row col-12 text-end">
                                                                                <button type="button" id="edit-director"
                                                                                        class="create-ds-btn btn">Add
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Director edit Modal End -->
                                                <div id="director-edit-list">
                                                    {{--                                                    <div class="directors d-flex">--}}
                                                    {{--                                                        <div>--}}
                                                    {{--                                                            <p>Wayne Rooney (waynerooney@trilliongroup.com)</p>--}}
                                                    {{--                                                            <p>cc: samantha@trilliongroup.com</p>--}}
                                                    {{--                                                            <p>cc: yingtze@trilliongroup.com</p>--}}
                                                    {{--                                                            <p>cc: aaron@trilliongroup.com</p>--}}
                                                    {{--                                                        </div>--}}
                                                    {{--                                                        <button type="button" class="btn p-0 ps-3 ms-auto cancel-btn">x</button>--}}
                                                    {{--                                                    </div>--}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <h6 class="shareholder-header">Shareholders</h6>
                                                    <a href="#" class="shareholder-select-modal-btn"
                                                       data-bs-toggle="modal" data-bs-target="#shareholderEditModal">
                                                        <img src="{{asset('assets/icons/add-button-icon.png')}}"
                                                             alt=""/></a>
                                                </div>
                                                <!-- Shareholder edit Modal Start -->
                                                <div class="modal fade" id="shareholderEditModal"
                                                     data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                                     aria-labelledby="shareholderEditModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog ds-select-modal">
                                                        <div class="modal-content">
                                                            <div class="ds-select-modal-body">
                                                                <div class="ds-select-modal-header row">
                                                                    <h5 class="modal-title col-11"
                                                                        id="shareholderEditModalLabel">Select New
                                                                        Shareholders</h5>
                                                                    <button type="button"
                                                                            class="btn btn-close btn-sm ds-select-modal-close-btn col-1"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                </div>
                                                                <div class="ds-select-modal-data row">
                                                                    <form action="#">
                                                                        <div class="data-body row">
                                                                            <div class="data-row col-12 col-md-12"
                                                                                 id="corp-sec-edit-shareholder-modal">

                                                                            </div>
                                                                            <div class="data-row col-12 text-end">
                                                                                <button type="button"
                                                                                        id="edit-shareholder"
                                                                                        class="create-ds-btn btn">Add
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Shareholder edit Modal End -->
                                                <div id="shareholder-edit-list">
                                                    {{--                                                    <div--}}
                                                    {{--                                                        class="shareholders d-flex">--}}
                                                    {{--                                                        <div>--}}
                                                    {{--                                                            <p>Wayne Rooney (waynerooney@trilliongroup.com)</p>--}}
                                                    {{--                                                            <p>cc: samantha@trilliongroup.com</p>--}}
                                                    {{--                                                            <p>cc: yingtze@trilliongroup.com</p>--}}
                                                    {{--                                                            <p>cc: aaron@trilliongroup.com</p>--}}
                                                    {{--                                                        </div>--}}
                                                    {{--                                                        <button type="button" class="btn p-0 ps-3 ms-auto cancel-btn">x</button>--}}
                                                    {{--                                                    </div>--}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="text-danger" id="corpSecEditNoSignerAlert"></p>
                                    <div class="col-sm-12 col-md-6 mt-2">
                                        <button type="submit" id="corp-sec-edit-submit"
                                                class="btn admin-doc-create-submit-btn" hidden>Submit
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <div class="admin-doc-create-btn-section tabcontent ">
                                <button type="button" id="corp-sec-edit-send"
                                        class="btn admin-doc-create-send-btn mt-3">
                                    <div id="CorpSecEditLoadingDiv"><span class="spinner-border spinner-border-sm"
                                                                          role="status" aria-hidden="true"></span></div>
                                    Save Changes
                                </button>
                            </div>
                        </div>
                        <!-- Corporate Secretary Edit Doc Portion Ends -->

                        <!-- Corporate Secretary Table starts -->
                        <div id="corp-secretary" class="tabcontent adminDocManageTabContent corp-secretary">

                            <div class="select-pagination-portion table-top-portion row g-0">

                                <div class="sb-part search-box-part col-12 col-md-4 offset-lg-1 col-lg-5">
                                    <div class="d-flex form-inputs search-data">
                                        <input class="form-control" id="corp-sec-search" name="corp-sec-search"
                                               type="text" placeholder="Search">
                                        <input class="form-control" name="service_id" id="corp-sec-service-id" value="1"
                                               type="text" hidden>
                                        <button type="button" onclick="corpSecSearchDocument()" class="search-btn btn">
                                            <i class="fa-solid fa-search"></i></button>
                                    </div>
                                </div>
                                <div class="sb-part company-category-select col-6 offset-md-0 col-md-2 col-lg-2">
                                    {{--                                        <select class="form-control form-select nav-select select-data " name="priority" id="priority">--}}
                                    {{--                                            <option value="">Filter</option>--}}
                                    {{--                                            <option val$invoice->discountue="">All</option>--}}
                                    {{--                                            <option value="">Urgent</option>--}}
                                    {{--                                            <option value="">New</option>--}}
                                    {{--                                        </select>--}}
                                </div>
                                <div class="button-part col-6 col-md-6 col-lg-5">
                                    @if(auth()->guard('web')->user()->can('create.document_management'))
                                        <button type="button" class="btn download-btn action-buttons active"
                                                onclick="adminDocCreateTab(event, 'create-doc')">Create
                                        </button>
                                    @endif
                                </div>
                            </div>

                            <div class="table-responsive">
                                <div class="doc-manage-body">
                                    <!-- New update V3.1 Starts ........ Changed the table col -->
                                    <div class="docs row g-0">
                                        <div class="col-3 col-md-3 col-lg-3 header-div">
                                            <span>Company Name</span>
                                        </div>
                                        <div class="col-4 col-md-4 col-lg-4 header-div">
                                            <span>Document Title</span>
                                        </div>
{{--                                        <div class="col-2 col-md-2 col-lg-2 header-div status-header">--}}
{{--                                            <span>Status</span>--}}
{{--                                        </div>--}}
                                        <div class="col-2 col-md-2 col-lg-2 header-div">
                                            <span>Action</span>
                                        </div>
                                    </div>
                                    <!-- New update V3.1 Ends -->
                                    <div id="corp">
                                        <div class="docs row g-0">
                                            <div class="col-4 col-md-4 name-div">
                                                <span></span>
                                            </div>
                                            <div class="col-4 col-md-4 document-div">
                                                <p class=""></p>
                                            </div>
                                            <div class="col-2 col-md-2 status-div">
                                                <p name="doc-status" class="doc-status"></p>
                                            </div>
                                            <div class="col-2 col-md-2 action-div">
                                                <a href="#" onclick="adminDocCreateTab(event, 'view-doc')"
                                                   class="action-buttons">View</a>
                                                {{--                                            <a href="#" onclick="adminDocCreateTab(event,'edit-doc')" class="action-buttons">Edit</a>--}}
                                                <a href="#" class="action-buttons delete-btn" data-bs-toggle="modal"
                                                   data-bs-target="#corpDeleteModal">Delete</a>
                                                <!-- Delete Modal Start -->
                                                <div class="modal fade" id="corpDeleteModal" data-bs-backdrop="static"
                                                     data-bs-keyboard="false" tabindex="-1"
                                                     aria-labelledby="corpDeleteModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog company-delete-modal">
                                                        <div class="modal-content">
                                                            <div class="company-delete-modal-body">
                                                                <p class="text-center">Confirm Delete</p>
                                                                <div class="text-center">
                                                                    <button type="button"
                                                                            class="btn btn-sm company-delete-modal-close-btn"
                                                                            data-bs-dismiss="modal" aria-label="No">No
                                                                    </button>
                                                                    <button type="submit" class="btn btn-sm yes-btn">Yes
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Delete Modal End -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{--                            @if($documents->hasPages())--}}

                            <div class="select-pagination-portion table-bottom-portion row g-0">
                                <div class="pagination-part bottom-pagination-part col-4 col-md-5 col-lg-4">
                                    <a data-href="" class="btn left-arrow corp-sec" id="corp-sec-left-arrow"><i
                                            class="fa-solid fa-chevron-left"></i></a>
                                    <span class="pagination-number pagination-left-number"
                                          id="corp-sec-left-number"></span>
                                    <span class="pagination-divider">/</span>
                                    <span class="pagination-number pagination-right-number"
                                          id="corp-sec-right-number"></span>
                                    <a data-href="" class="btn right-arrow corp-sec" id="corp-sec-right-arrow"><i
                                            class="fa-solid fa-chevron-right"></i></a>
                                </div>
                            </div>
                            {{--                            @endif--}}
                        </div>
                        <!-- Corporate Secretary Table ends -->

                        <!-- Corporate Secretary Portion Ends -->

                        <!-- Tax Portion Starts -->

                        <!--Tax Create Doc Portion Starts -->
                        <div class="back-btn-div adminDocManageTabContent  tax-create-doc">
                            <button class="back-btn btn" onclick="goBack(event, 'tax')"><i
                                    class="fa-solid fa-arrow-left"></i></button>
                        </div>
                        <div id="tax-create-doc" class="tabcontent adminDocManageTabContent tax-create-doc">
                            <form action="" id="tax-doc-upload">
                                <meta name="csrf-token" content="{{ csrf_token() }}"/>
                                <div class="row ">
                                    <input name="shareholder[]" id="taxShareholdersId" value="" type="text" readonly
                                           hidden/>
                                    <input name="director[]" id="taxDirectorsId" value="" type="text" readonly hidden/>
                                    <input name="service_id" id="" value="2" type="text" readonly hidden/>
                                    {{--                                    <input  name="category-name" value="Tax" type="text" hidden />--}}
                                    <div class="col-sm-12 col-md-6">
                                        <fieldset class="form-group">
                                            <label for="company_id" class="mb-2 mt-3"><span
                                                    class="required-sign">*</span>Company</label>
                                            <select class="form-control select form-select" name="company_id"
                                                    id="tax_company_id" required>
                                                <option hidden class="first-option" value="">Select</option>
                                                @foreach($companies as $company)
                                                    <option
                                                        value="{{$company->id}}">{{ucfirst($company->name)}}</option>
                                                @endforeach
                                            </select>
                                        </fieldset>
                                        <span class="text-danger tax-company_id"></span>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="title" class="mb-2 mt-3"><span class="required-sign">*</span>Document
                                                Name</label>
                                            <input type="text" class="form-control" name="name" id="title">
                                        </div>
                                        <span class="text-danger tax-name"></span>
                                    </div>
                                    <br>
                                    <div class="col-sm-12 col-md-6">
                                        <label for="document-upload" class="custom-file-uploaded"><span
                                                class="required-sign">*</span>
                                            Upload Your Document
                                        </label>
                                        <div class="upload-container">
                                            <label for="document-upload-tax" class="custom-file-upload">
                                                <i class="fa fa-paperclip" aria-hidden="true"></i>
                                            </label>
                                            <input id="file-name-tax" class="file-name form-control" type="text"
                                                   readonly/>
                                            <input id="document-upload-tax" class="document-upload" name="file"
                                                   type="file" accept=".doc, .docx, .pdf, .zip, .rar"
                                                   onchange="displayFileName('file-name-tax','document-upload-tax')"/>

                                            <button class="upload-button" type="button">Upload</button>
                                        </div>
                                        <span class="text-danger tax-file"></span>
                                        <!-- <input type="file" class="form-control upload-file"  name="" id="file"> -->
                                    </div>
                                    <div class="admin-doc-manage-create-down-card-portion col-12 col-lg-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <h6 class="director-header">Directors</h6>
                                                    <a href="#" class="director-select-modal-btn" data-bs-toggle="modal"
                                                       data-bs-target="#taxDirectorSelectModal">
                                                        <img src="{{asset('assets/icons/add-button-icon.png')}}"
                                                             alt=""/></a>
                                                </div>
                                                <!-- Director select Modal Start -->
                                                <div class="modal fade" id="taxDirectorSelectModal"
                                                     data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                                     aria-labelledby="directorSelectModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog ds-select-modal">
                                                        <div class="modal-content">
                                                            <div class="ds-select-modal-body">
                                                                <div class="ds-select-modal-header row">
                                                                    <h5 class="modal-title col-11"
                                                                        id="directorSelectModalLabel">Select New
                                                                        Director</h5>
                                                                    <button type="button"
                                                                            class="btn btn-close btn-sm ds-select-modal-close-btn col-1"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                </div>
                                                                <div class="ds-select-modal-data row">
                                                                    <form action="#">
                                                                        <div class="data-body row">
                                                                            <div class="data-row col-12 col-md-12"
                                                                                 id="tax-director-modal"></div>
                                                                            <div class="data-row col-12 text-end">
                                                                                <button type="button"
                                                                                        id="add-tax-director"
                                                                                        class="create-ds-btn btn">Add
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Director select Modal End -->
                                                <div id="append-tax-director">
                                                    {{--                                                                                                        <div id="director-list">--}}
                                                    {{--                                                        <div--}}
                                                    {{--                                                            class="directors d-flex">--}}
                                                    {{--                                                            <div>--}}
                                                    {{--                                                                <p>Wayne Rooney (waynerooney@trilliongroup.com)</p>--}}
                                                    {{--                                                                <p>cc: samantha@trilliongroup.com</p>--}}
                                                    {{--                                                                <p>cc: yingtze@trilliongroup.com</p>--}}
                                                    {{--                                                                <p>cc: aaron@trilliongroup.com</p>--}}
                                                    {{--                                                            </div>--}}
                                                    {{--                                                            <button type="button" class="btn p-0 ps-3 ms-auto cancel-btn">x</button>--}}
                                                    {{--                                                        </div>--}}
                                                    {{--                                                                                                        </div>--}}
                                                </div>

                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <h6 class="shareholder-header">Shareholders</h6>
                                                    <a href="#" class="shareholder-select-modal-btn"
                                                       data-bs-toggle="modal"
                                                       data-bs-target="#taxShareholderSelectModal">
                                                        <img src="{{asset('assets/icons/add-button-icon.png')}}"
                                                             alt=""/></a>
                                                </div>
                                                <!-- Shareholder select Modal Start -->
                                                <div class="modal fade" id="taxShareholderSelectModal"
                                                     data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                                     aria-labelledby="shareholderSelectModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog ds-select-modal">
                                                        <div class="modal-content">
                                                            <div class="ds-select-modal-body">
                                                                <div class="ds-select-modal-header row">
                                                                    <h5 class="modal-title col-11"
                                                                        id="shareholderSelectModalLabel">Select New
                                                                        Shareholders</h5>
                                                                    <button type="button"
                                                                            class="btn btn-close btn-sm ds-select-modal-close-btn col-1"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                </div>
                                                                <div class="ds-select-modal-data row">
                                                                    <form action="#">
                                                                        <div class="data-body row">
                                                                            <div class="data-row col-12 col-md-12"
                                                                                 id="tax-shareholder-modal"></div>
                                                                            <div class="data-row col-12 text-end">
                                                                                <button type="button"
                                                                                        id="add-tax-shareholder"
                                                                                        class="create-ds-btn btn">Add
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Shareholder select Modal End -->
                                                <div id="append-tax-shareholder"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="text-danger" id="taxNoSignerAlert"></p>
                                    <div class="col-sm-12 col-md-6 mt-2">
                                        <button type="button" id="tax-submit" class="btn admin-doc-create-submit-btn"
                                                hidden>Submit
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <div class="admin-doc-create-btn-section tabcontent  ">
                                <button type="button" id="tax-send" class="btn admin-doc-create-send-btn mt-3">
                                    <div id="TaxLoadingDiv"><span class="spinner-border spinner-border-sm" role="status"
                                                                  aria-hidden="true"></span></div>
                                    Submit
                                </button>
                            </div>
                        </div>
                        <!-- Tax Create Doc Portion Ends -->

                        <!--Tax Edit Doc Portion Starts -->
                        <div class="back-btn-div adminDocManageTabContent tax-edit-doc">
                            <button class="back-btn btn" onclick="goBack(event, 'tax')"><i
                                    class="fa-solid  fa-arrow-left"></i></button>
                        </div>
                        <div id="tax-edit-doc" class="tabcontent adminDocManageTabContent tax-edit-doc">
                            <form action="" id="tax-edit-doc-upload">
                                <div class="row ">
                                    {{--                                    <input name="category-name" value="Tax" type="text" hidden />--}}
                                    <input name="shareholder[]" id="taxEditShareholdersId" value="" type="text" readonly
                                           hidden/>
                                    <input name="director[]" id="taxEditDirectorsId" value="" type="text" readonly
                                           hidden/>
                                    <input name="current_document_id" id="taxDocumentId" value="" type="text" readonly
                                           hidden/>
                                    <input name="document_hashed" id="taxHashedDocumentId" value="" type="text" hidden
                                           readonly/>
                                    <input name="service_id" id="" value="2" type="text" readonly hidden/>

                                    <div class="col-sm-12 col-md-6">
                                        <fieldset class="form-group">
                                            <label for="company_id" class="mb-2 mt-3">
                                                <span class="required-sign">*</span>Company</label>
                                            <select class="form-control select form-select" name="company_id"
                                                    id="tax_edit_company_id" required>
                                            </select>
                                        </fieldset>
                                        <span class="text-danger tax-edit-company_id"></span>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="title" class="mb-2 mt-3"><span class="required-sign">*</span>Document
                                                Name</label>
                                            <input type="text" class="form-control" name="name" id="tax-edit-name">
                                        </div>
                                        <span class="text-danger tax-edit-name"></span>
                                    </div>
                                    <br>
                                    <div class="col-sm-12 col-md-6">
                                        <label for="document-upload" class="custom-file-uploaded"><span
                                                class="required-sign">*</span> Upload Your Document
                                        </label>
                                        <div class="upload-container">
                                            <label for="document-edit-tax" class="custom-file-upload">
                                                <i class="fa fa-paperclip" aria-hidden="true"></i>
                                            </label>
                                            <input id="file-edit-tax" class="file-name form-control" type="text"
                                                   readonly/>
                                            <input id="document-edit-tax" class="document-upload" type="file"
                                                   name="file" accept=".doc, .docx, .pdf, .zip, .rar"
                                                   onchange="displayFileName('file-edit-tax','document-edit-tax')"/>
                                            <button class="upload-button" type="button">Upload</button>
                                        </div>
                                        <span class="text-danger tax-edit-file"></span>
                                    </div>
                                    <div class="admin-doc-manage-create-down-card-portion col-12 col-lg-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <h6 class="director-header">Directors</h6>
                                                    <a href="#" class="director-select-modal-btn" data-bs-toggle="modal"
                                                       data-bs-target="#taxDirectorEditModal">
                                                        <img src="{{asset('assets/icons/add-button-icon.png')}}"
                                                             alt=""/></a>
                                                </div>
                                                <!-- Director select Modal Start -->
                                                <div class="modal fade" id="taxDirectorEditModal"
                                                     data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                                     aria-labelledby="taxDirectorEditModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog ds-select-modal">
                                                        <div class="modal-content">
                                                            <div class="ds-select-modal-body">
                                                                <div class="ds-select-modal-header row">
                                                                    <h5 class="modal-title col-11"
                                                                        id="taxDirectorEditModalLabel">Select New
                                                                        Director</h5>
                                                                    <button type="button"
                                                                            class="btn btn-close btn-sm ds-select-modal-close-btn col-1"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                </div>
                                                                <div class="ds-select-modal-data row">
                                                                    <form action="#">
                                                                        <div class="data-body row">
                                                                            <div class="data-row col-12 col-md-12"
                                                                                 id="tax-edit-director-modal">
                                                                                {{--                                                                                <div class="directors d-flex">--}}
                                                                                {{--                                                                                    <div class="col-md-2 col-sm-1 col-1">--}}
                                                                                {{--                                                                                        <input type="checkbox"class="select-checkbox" name="directors[]" value="d1"/>--}}
                                                                                {{--                                                                                    </div>--}}
                                                                                {{--                                                                                    <div class="col-md-10 col-sm-11 col-11">--}}
                                                                                {{--                                                                                        <p class="director-name">Wayne Rooney 1(waynerooney@trilliongroup.com)</p>--}}
                                                                                {{--                                                                                        <p class="cc1">cc: samantha@trilliongroup.com</p>--}}
                                                                                {{--                                                                                        <p class="cc2">cc: yingtze@trilliongroup.com</p>--}}
                                                                                {{--                                                                                        <p class="cc3">cc: aaron@trilliongroup.com</p>--}}
                                                                                {{--                                                                                    </div>--}}
                                                                                {{--                                                                                </div>--}}

                                                                            </div>
                                                                            <div class="data-row col-12 text-end">
                                                                                <button type="button"
                                                                                        id="edit-tax-director"
                                                                                        class="create-ds-btn btn">Add
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Director select Modal End -->
                                                <div id="tax-director-edit-list">
                                                    {{--                                                    <div class="directors d-flex">--}}
                                                    {{--                                                        <div>--}}
                                                    {{--                                                            <p>Wayne Rooney (waynerooney@trilliongroup.com)</p>--}}
                                                    {{--                                                            <p>cc: samantha@trilliongroup.com</p>--}}
                                                    {{--                                                            <p>cc: yingtze@trilliongroup.com</p>--}}
                                                    {{--                                                            <p>cc: aaron@trilliongroup.com</p>--}}
                                                    {{--                                                        </div>--}}
                                                    {{--                                                        <button type="button" class="btn p-0 ps-3 ms-auto cancel-btn">x</button>--}}
                                                    {{--                                                    </div>--}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <h6 class="shareholder-header">Shareholders</h6>
                                                    <a href="#" class="shareholder-select-modal-btn"
                                                       data-bs-toggle="modal" data-bs-target="#taxShareholderEditModal">
                                                        <img src="{{asset('assets/icons/add-button-icon.png')}}"
                                                             alt=""/></a>
                                                </div>
                                                <!-- Shareholder select Modal Start -->
                                                <div class="modal fade" id="taxShareholderEditModal"
                                                     data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                                     aria-labelledby="taxShareholderEditModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog ds-select-modal">
                                                        <div class="modal-content">
                                                            <div class="ds-select-modal-body">
                                                                <div class="ds-select-modal-header row">
                                                                    <h5 class="modal-title col-11"
                                                                        id="taxShareholderEditModalLabel">Select New
                                                                        Shareholders</h5>
                                                                    <button type="button"
                                                                            class="btn btn-close btn-sm ds-select-modal-close-btn col-1"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                </div>
                                                                <div class="ds-select-modal-data row">
                                                                    <form action="#">
                                                                        <div class="data-body row">
                                                                            <div class="data-row col-12 col-md-12"
                                                                                 id="tax-edit-shareholder-modal">
                                                                                <div class="shareholders d-flex">
                                                                                    <div
                                                                                        class="col-md-2 col-sm-1 col-1">
                                                                                        <input type="checkbox"
                                                                                               class="select-checkbox"
                                                                                               name="shareholders[]"
                                                                                               value=""/>
                                                                                    </div>
                                                                                    <div
                                                                                        class="col-md-10 col-sm-11 col-11">
                                                                                        <p class="shareholder-name">
                                                                                            Wayne Rooney
                                                                                            3(waynerooney@trilliongroup.com)</p>
                                                                                        <p class="cc1">cc:
                                                                                            samantha@trilliongroup.com</p>
                                                                                        <p class="cc2">cc:
                                                                                            yingtze@trilliongroup.com</p>
                                                                                        <p class="cc3">cc:
                                                                                            aaron@trilliongroup.com</p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="data-row col-12 text-end">
                                                                                <button type="button"
                                                                                        id="edit-tax-shareholder"
                                                                                        class="create-ds-btn btn">Add
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Shareholder select Modal End -->
                                                <div id="tax-shareholder-edit-list">
                                                    {{--                                                    <div--}}
                                                    {{--                                                        class="shareholders d-flex">--}}
                                                    {{--                                                        <div>--}}
                                                    {{--                                                            <p>Wayne Rooney (waynerooney@trilliongroup.com)</p>--}}
                                                    {{--                                                            <p>cc: samantha@trilliongroup.com</p>--}}
                                                    {{--                                                            <p>cc: yingtze@trilliongroup.com</p>--}}
                                                    {{--                                                            <p>cc: aaron@trilliongroup.com</p>--}}
                                                    {{--                                                        </div>--}}
                                                    {{--                                                        <button type="button" class="btn p-0 ps-3 ms-auto cancel-btn">x</button>--}}
                                                    {{--                                                    </div>--}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="text-danger" id="taxEditNoSignerAlert"></p>
                                    <div class="col-sm-12 col-md-6 mt-2">
                                        <button type="button" id="tax-edit-submit"
                                                class="btn admin-doc-create-submit-btn" hidden>Submit
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <div class="admin-doc-create-btn-section tabcontent ">
                                <button type="button" id="tax-edit-send" class="btn admin-doc-create-send-btn mt-3">
                                    <div id="TaxEditLoadingDiv"><span class="spinner-border spinner-border-sm"
                                                                      role="status" aria-hidden="true"></span></div>
                                    Submit
                                </button>
                            </div>
                        </div>
                        <!-- Tax Edit Doc Portion Ends -->

                        <!-- Tax Table starts -->
                        <div id="tax" class="tabcontent adminDocManageTabContent tax">
                            <div class="select-pagination-portion table-top-portion row g-0">
                                <div class="sb-part search-box-part col-12 col-md-4 offset-lg-1 col-lg-5">
                                    <div class="d-flex form-inputs search-data">
                                        <input class="form-control" id="tax-search-value" name="tax-search-value"
                                               type="text" placeholder=" Search">
                                        <input class="form-control" name="service_id" id="tax-service-id" value="1"
                                               type="text" hidden>
                                        <button type="button" class="search-btn btn" onclick="taxSearchDocument()"><i
                                                class="fa-solid fa-search"></i></button>
                                    </div>
                                </div>
                                <div class="sb-part company-category-select col-6 offset-md-0 col-md-2 col-lg-2">
                                    {{--                                    <select class="form-control form-select nav-select select-data " name="priority" id="priority" required>--}}
                                    {{--                                        <option value="">Filter</option>--}}
                                    {{--                                        <option value="">All</option>--}}
                                    {{--                                        <option value="">Urgent</option>--}}
                                    {{--                                        <option value="">New</option>--}}
                                    {{--                                    </select>--}}
                                </div>
                                <div class="button-part col-6 col-md-6 col-lg-5">
                                    @if(auth()->guard('web')->user()->can('create.document_management'))
                                        <button type="button" class="btn download-btn action-buttons active"
                                                onclick="adminDocCreateTab(event, 'tax-create-doc')">Create
                                        </button>
                                    @endif
                                </div>
                            </div>
                            <div class="table-responsive">
                                <div class="doc-manage-body">
                                    <!-- New update V3.1 Starts ........ Changed the table col -->
                                    <div class="docs row g-0">
                                        <div class="col-3 col-md-3 col-lg-3 header-div">
                                            <span>Company Name</span>
                                        </div>
                                        <div class="col-4 col-md-4 col-lg-4 header-div">
                                            <span>Document Title</span>
                                        </div>
{{--                                        <div class="col-2 col-md-2 col-lg-2 header-div status-header">--}}
{{--                                            <span>Status</span>--}}
{{--                                        </div>--}}
                                        <div class="col-2 col-md-2 col-lg-2 header-div">
                                            <span>Action</span>
                                        </div>
                                    </div>
                                    <!-- New update V3.1 Ends -->
                                    <div id="tax-table">
                                        <div class="docs row g-0">
                                            <div class="col-4 col-md-4 name-div">
                                                <span></span>
                                            </div>
                                            <div class="col-4 col-md-4 document-div">
                                                <p class=""></p>
                                            </div>
                                            <div class="col-2 col-md-2 status-div">
                                                <p name="doc-status" class="doc-status"></p>
                                            </div>
                                            <div class="col-2 col-md-2 action-div">
                                                <a href="#" onclick="adminDocCreateTab(event, 'tax-view-doc')"
                                                   class="action-buttons">View</a>
                                                <a href="#" class="action-buttons delete-btn" data-bs-toggle="modal"
                                                   data-bs-target="#taxDeleteModal">Delete</a>
                                                <!-- Delete Modal Start -->
                                                <div class="modal fade" id="taxDeleteModal" data-bs-backdrop="static"
                                                     data-bs-keyboard="false" tabindex="-1"
                                                     aria-labelledby="taxDeleteModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog company-delete-modal">
                                                        <div class="modal-content">
                                                            <div class="company-delete-modal-body">
                                                                <p class="text-center">Confirm Delete</p>
                                                                <div class="text-center">
                                                                    <button type="button"
                                                                            class="btn btn-sm company-delete-modal-close-btn"
                                                                            data-bs-dismiss="modal" aria-label="No">No
                                                                    </button>
                                                                    <button type="submit" class="btn btn-sm yes-btn">Yes
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Delete Modal End -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="select-pagination-portion table-bottom-portion row g-0">
                                <div class="pagination-part bottom-pagination-part col-12 col-md-5 col-lg-4">
                                    <a data-href="" class="btn left-arrow tax-data" id="tax-left-arrow"><i
                                            class="fa-solid fa-chevron-left"></i></a>
                                    <span class="pagination-number pagination-left-number" id="tax-left-number"></span>
                                    <span class="pagination-divider">/</span>
                                    <span class="pagination-number pagination-right-number"
                                          id="tax-right-number"></span>
                                    <a data-href="" class="btn right-arrow tax-data" id="tax-right-arrow"><i
                                            class="fa-solid fa-chevron-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <!-- Tax Table ends -->

                        <!-- Tax Portion Ends -->

                        <!-- Accounting Portion Starts  -->

                        <!--Accounting Create Doc Portion Starts -->
                        <div class="back-btn-div adminDocManageTabContent  acc-create-doc">
                            <button class="back-btn btn" onclick="goBack(event, 'accounting')"><i
                                    class="fa-solid fa-arrow-left"></i></button>
                        </div>
                        <div id="acc-create-doc" class="tabcontent adminDocManageTabContent acc-create-doc">
                            <form action="" id="acc-doc-upload">
                                <meta name="csrf-token" content="{{ csrf_token() }}"/>
                                <div class="row ">
                                    <input name="shareholder[]" id="accShareholdersId" value="" type="text" readonly
                                           hidden/>
                                    <input name="director[]" id="accDirectorsId" value="" type="text" readonly hidden/>
                                    <input name="service_id" id="" value="3" type="text" readonly hidden/>
                                    <div class="col-sm-12 col-md-6">
                                        <fieldset class="form-group">
                                            <label for="company_id" class="mb-2 mt-3"><span
                                                    class="required-sign">*</span>Company</label>
                                            <select class="form-control select form-select" name="company_id"
                                                    id="acc_company_id" required>
                                                <option hidden class="first-option" value="">Select</option>
                                                @foreach($companies as $company)
                                                    <option
                                                        value="{{$company->id}}">{{ucfirst($company->name)}}</option>
                                                @endforeach
                                            </select>
                                        </fieldset>
                                        <span class="text-danger acc-company_id"></span>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="title" class="mb-2 mt-3"><span class="required-sign">*</span>Document
                                                Name</label>
                                            <input type="text" class="form-control" name="name" id="">
                                        </div>
                                        <span class="text-danger acc-name"></span>
                                    </div>
                                    <br>
                                    <div class="col-sm-12 col-md-6">
                                        <label for="document-upload" class="custom-file-uploaded"><span
                                                class="required-sign">*</span>Upload Your
                                            Document</label>
                                        <div class="upload-container">
                                            <label for="document-upload-acc" class="custom-file-upload"><i
                                                    class="fa fa-paperclip" aria-hidden="true"></i></label>
                                            <input id="file-name-acc" class="file-name form-control" type="text"
                                                   readonly/><input id="document-upload-acc" class="document-upload"
                                                                    name="file" type="file"
                                                                    accept=".doc, .docx, .pdf, .zip, .rar"
                                                                    onchange="displayFileName('file-name-acc','document-upload-acc')"/>
                                            <button class="upload-button" type="button">Upload</button>
                                        </div>
                                        <span class="text-danger acc-file"></span>
                                    </div>
                                    <div class="admin-doc-manage-create-down-card-portion col-12 col-lg-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <h6 class="director-header">Directors</h6>
                                                    <a href="#" class="director-select-modal-btn" data-bs-toggle="modal"
                                                       data-bs-target="#accDirectorSelectModal">
                                                        <img src="{{asset('assets/icons/add-button-icon.png')}}"
                                                             alt=""/></a>
                                                </div>
                                                <!-- Director select Modal Start -->
                                                <div class="modal fade" id="accDirectorSelectModal"
                                                     data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                                     aria-labelledby="directorSelectModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog ds-select-modal">
                                                        <div class="modal-content">
                                                            <div class="ds-select-modal-body">
                                                                <div class="ds-select-modal-header row">
                                                                    <h5 class="modal-title col-11"
                                                                        id="directorSelectModalLabel">Select New
                                                                        Director</h5>
                                                                    <button type="button"
                                                                            class="btn btn-close btn-sm ds-select-modal-close-btn col-1"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                </div>
                                                                <div class="ds-select-modal-data row">
                                                                    <form action="#">
                                                                        <div class="data-body row">
                                                                            <div class="data-row col-12 col-md-12"
                                                                                 id="acc-director-modal"></div>
                                                                            <div class="data-row col-12 text-end">
                                                                                <button type="button"
                                                                                        id="add-acc-director"
                                                                                        class="create-ds-btn btn">Add
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Director select Modal End -->
                                                <div id="append-acc-director"></div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <h6 class="shareholder-header">Shareholders</h6>
                                                    <a href="#" class="shareholder-select-modal-btn"
                                                       data-bs-toggle="modal"
                                                       data-bs-target="#accShareholderSelectModal">
                                                        <img src="{{asset('assets/icons/add-button-icon.png')}}"
                                                             alt=""/></a>
                                                </div>
                                                <!-- Shareholder select Modal Start -->
                                                <div class="modal fade" id="accShareholderSelectModal"
                                                     data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                                     aria-labelledby="shareholderSelectModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog ds-select-modal">
                                                        <div class="modal-content">
                                                            <div class="ds-select-modal-body">
                                                                <div class="ds-select-modal-header row">
                                                                    <h5 class="modal-title col-11"
                                                                        id="shareholderSelectModalLabel">Select New
                                                                        Shareholders</h5>
                                                                    <button type="button"
                                                                            class="btn btn-close btn-sm ds-select-modal-close-btn col-1"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                </div>
                                                                <div class="ds-select-modal-data row">
                                                                    <form action="#">
                                                                        <div class="data-body row">
                                                                            <div class="data-row col-12 col-md-12"
                                                                                 id="acc-shareholder-modal"></div>
                                                                            <div class="data-row col-12 text-end">
                                                                                <button type="button"
                                                                                        id="add-acc-shareholder"
                                                                                        class="create-ds-btn btn">Add
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Shareholder select Modal End -->
                                                <div id="append-acc-shareholder"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="text-danger" id="accNoSignerAlert"></p>
                                    <div class="col-sm-12 col-md-6 mt-2">
                                        <button type="submit" id="acc-submit" class="btn admin-doc-create-submit-btn"
                                                hidden>Submit
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <div class="admin-doc-create-btn-section tabcontent">
                                <button type="button" id="acc-send" class="btn admin-doc-create-send-btn mt-3">
                                    <div id="AccLoadingDiv"><span class="spinner-border spinner-border-sm" role="status"
                                                                  aria-hidden="true"></span></div>
                                    Submit
                                </button>
                            </div>
                        </div>
                        <!-- Accounting Create Doc Portion Ends -->
                        <!--Accounting Edit Doc Portion Starts -->
                        <div class="back-btn-div adminDocManageTabContent acc-edit-doc">
                            <button class="back-btn btn" onclick="goBack(event, 'accounting')"><i
                                    class="fa-solid  fa-arrow-left"></i></button>
                        </div>
                        <div id="acc-edit-doc" class="tabcontent adminDocManageTabContent acc-edit-doc">
                            <form action="" id="acc-edit-doc-upload">
                                <div class="row ">
                                    <input name="shareholder[]" id="accEditShareholdersId" value="" type="text" readonly
                                           hidden/>
                                    <input name="director[]" id="accEditDirectorsId" value="" type="text" readonly
                                           hidden/>
                                    <input name="current_document_id" id="accDocumentId" value="" type="text" readonly
                                           hidden/>
                                    <input name="document_hashed" id="accHashedDocumentId" value="" type="text" readonly
                                           hidden/>
                                    <input name="service_id" id="" value="3" type="text" readonly hidden/>
                                    <input name="category-name" value="Accounting" type="text" readonly hidden/>
                                    <div class="col-sm-12 col-md-6">
                                        <fieldset class="form-group">
                                            <label for="company_id" class="mb-2 mt-3">
                                                <span class="required-sign">*</span>Company</label>
                                            <select class="form-control select form-select" name="company_id"
                                                    id="acc_edit_company_id" required>
                                            </select>
                                        </fieldset>
                                        <span class="text-danger acc-edit-company_id"></span>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="title" class="mb-2 mt-3"><span class="required-sign">*</span>Document
                                                Name</label>
                                            <input type="text" class="form-control" name="name" id="acc-edit-name"
                                                   value="">
                                        </div>
                                        <span class="text-danger acc-edit-name"></span>
                                    </div>
                                    <br>
                                    <div class="col-sm-12 col-md-6">
                                        <label for="document-upload" class="custom-file-uploaded"><span
                                                class="required-sign">*</span> Upload Your Document
                                        </label>
                                        <div class="upload-container">
                                            <label for="document-edit-acc" class="custom-file-upload">
                                                <i class="fa fa-paperclip" aria-hidden="true"></i>
                                            </label>
                                            <input id="file-edit-acc" class="file-name form-control" type="text"
                                                   readonly/>
                                            <input id="document-edit-acc" class="document-upload" type="file"
                                                   name="file" accept=".doc, .docx, .pdf, .zip, .rar"
                                                   onchange="displayFileName('file-edit-acc','document-edit-acc')"/>
                                            <button class="upload-button" type="button">Upload</button>
                                        </div>
                                        <span class="text-danger acc-edit-file"></span>
                                    </div>
                                    <div class="admin-doc-manage-create-down-card-portion col-12 col-lg-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <h6 class="director-header">Directors</h6>
                                                    <a href="#" class="director-select-modal-btn" data-bs-toggle="modal"
                                                       data-bs-target="#accDirectorEditModal">
                                                        <img src="{{asset('assets/icons/add-button-icon.png')}}"
                                                             alt=""/></a>
                                                </div>
                                                <!-- Director select Modal Start -->
                                                <div class="modal fade" id="accDirectorEditModal"
                                                     data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                                     aria-labelledby="accDirectorEditModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog ds-select-modal">
                                                        <div class="modal-content">
                                                            <div class="ds-select-modal-body">
                                                                <div class="ds-select-modal-header row">
                                                                    <h5 class="modal-title col-11"
                                                                        id="accDirectorEditModalLabel">Select New
                                                                        Director</h5>
                                                                    <button type="button"
                                                                            class="btn btn-close btn-sm ds-select-modal-close-btn col-1"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                </div>
                                                                <div class="ds-select-modal-data row">
                                                                    <form action="#">
                                                                        <div class="data-body row">
                                                                            <div class="data-row col-12 col-md-12"
                                                                                 id="acc-edit-director-modal">
                                                                                {{--                                                                                <div class="directors d-flex">--}}
                                                                                {{--                                                                                    <div class="col-md-2 col-sm-1 col-1">--}}
                                                                                {{--                                                                                        <input type="checkbox"class="select-checkbox" name="directors[]" value="d1"/>--}}
                                                                                {{--                                                                                    </div>--}}
                                                                                {{--                                                                                    <div class="col-md-10 col-sm-11 col-11">--}}
                                                                                {{--                                                                                        <p class="director-name">Wayne Rooney 1(waynerooney@trilliongroup.com)</p>--}}
                                                                                {{--                                                                                        <p class="cc1">cc: samantha@trilliongroup.com</p>--}}
                                                                                {{--                                                                                        <p class="cc2">cc: yingtze@trilliongroup.com</p>--}}
                                                                                {{--                                                                                        <p class="cc3">cc: aaron@trilliongroup.com</p>--}}
                                                                                {{--                                                                                    </div>--}}
                                                                                {{--                                                                                </div>--}}

                                                                            </div>
                                                                            <div class="data-row col-12 text-end">
                                                                                <button type="button"
                                                                                        id="edit-acc-director"
                                                                                        class="create-ds-btn btn">Add
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Director select Modal End -->
                                                <div id="acc-director-edit-list">
                                                    <div class="directors d-flex">
                                                        <div>
                                                            <p>Wayne Rooney (waynerooney@trilliongroup.com)</p>
                                                            <p>cc: samantha@trilliongroup.com</p>
                                                            <p>cc: yingtze@trilliongroup.com</p>
                                                            <p>cc: aaron@trilliongroup.com</p>
                                                        </div>
                                                        <button type="button" class="btn p-0 ps-3 ms-auto cancel-btn">
                                                            x
                                                        </button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <h6 class="shareholder-header">Shareholders</h6>
                                                    <a href="#" class="shareholder-select-modal-btn"
                                                       data-bs-toggle="modal" data-bs-target="#accShareholderEditModal">
                                                        <img src="{{asset('assets/icons/add-button-icon.png')}}"
                                                             alt=""/></a>
                                                </div>
                                                <!-- Shareholder select Modal Start -->
                                                <div class="modal fade" id="accShareholderEditModal"
                                                     data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                                     aria-labelledby="accShareholderEditModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog ds-select-modal">
                                                        <div class="modal-content">
                                                            <div class="ds-select-modal-body">
                                                                <div class="ds-select-modal-header row">
                                                                    <h5 class="modal-title col-11"
                                                                        id="accShareholderEditModalLabel">Select New
                                                                        Shareholders</h5>
                                                                    <button type="button"
                                                                            class="btn btn-close btn-sm ds-select-modal-close-btn col-1"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                </div>
                                                                <div class="ds-select-modal-data row">
                                                                    <form action="#">
                                                                        <div class="data-body row">
                                                                            <div class="data-row col-12 col-md-12"
                                                                                 id="acc-edit-shareholder-modal">
                                                                                {{--                                                                                <div class="shareholders d-flex">--}}
                                                                                {{--                                                                                    <div class="col-md-2 col-sm-1 col-1">--}}
                                                                                {{--                                                                                        <input type="checkbox"class="select-checkbox" name="shareholders[]" value="d1"/>--}}
                                                                                {{--                                                                                    </div>--}}
                                                                                {{--                                                                                    <div class="col-md-10 col-sm-11 col-11">--}}
                                                                                {{--                                                                                        <p class="shareholder-name">Wayne Rooney 3(waynerooney@trilliongroup.com)</p>--}}
                                                                                {{--                                                                                        <p class="cc1">cc: samantha@trilliongroup.com</p>--}}
                                                                                {{--                                                                                        <p class="cc2">cc: yingtze@trilliongroup.com</p>--}}
                                                                                {{--                                                                                        <p class="cc3">cc: aaron@trilliongroup.com</p>--}}
                                                                                {{--                                                                                    </div>--}}
                                                                                {{--                                                                                </div>--}}

                                                                            </div>
                                                                            <div class="data-row col-12 text-end">
                                                                                <button type="button"
                                                                                        id="edit-acc-shareholder"
                                                                                        class="create-ds-btn btn">Add
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Shareholder select Modal End -->
                                                <div id="acc-shareholder-edit-list">
                                                    {{--                                                    <div--}}
                                                    {{--                                                        class="shareholders d-flex">--}}
                                                    {{--                                                        <div>--}}
                                                    {{--                                                            <p>Wayne Rooney (waynerooney@trilliongroup.com)</p>--}}
                                                    {{--                                                            <p>cc: samantha@trilliongroup.com</p>--}}
                                                    {{--                                                            <p>cc: yingtze@trilliongroup.com</p>--}}
                                                    {{--                                                            <p>cc: aaron@trilliongroup.com</p>--}}
                                                    {{--                                                        </div>--}}
                                                    {{--                                                        <button type="button" class="btn p-0 ps-3 ms-auto cancel-btn">x</button>--}}
                                                    {{--                                                    </div>--}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="text-danger" id="accEditNoSignerAlert"></p>
                                    <div class="col-sm-12 col-md-6 mt-2">
                                        <button type="submit" id="acc-edit-submit"
                                                class="btn admin-doc-create-submit-btn" hidden>Submit
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <div class="admin-doc-create-btn-section tabcontent ">
                                <button type="button" id="acc-edit-send" class="btn admin-doc-create-send-btn mt-3">
                                    <div id="AccEditLoadingDiv"><span class="spinner-border spinner-border-sm"
                                                                      role="status" aria-hidden="true"></span></div>
                                    Submit
                                </button>
                            </div>
                        </div>
                        <!-- Accounting Edit Doc Portion Ends -->


                        <!-- Accounting Table starts -->
                        <div id="accounting" class="tabcontent adminDocManageTabContent accounting">
                            <div class="select-pagination-portion table-top-portion row g-0">
                                <div class="sb-part search-box-part col-12  col-md-4 offset-lg-1 col-lg-5">
                                    <div class="d-flex form-inputs search-data">
                                        <input class="form-control" id="acc-search-value" name="acc-search-value"
                                               type="text" placeholder=" Search">
                                        <button type="button" class="search-btn btn" onclick="accSearchDocument()"><i
                                                class="fa-solid fa-search"></i></button>
                                    </div>
                                </div>
                                <div class="sb-part company-category-select col-6 offset-md-0 col-md-2 col-lg-2">
                                </div>
                                <div class="button-part col-6 col-md-6 col-lg-5">
                                    @if(auth()->guard('web')->user()->can('create.document_management'))
                                        <button type="button" class="btn download-btn action-buttons active"
                                                onclick="adminDocCreateTab(event, 'acc-create-doc')">Create
                                        </button>
                                    @endif
                                </div>
                            </div>
                            <div class="table-responsive">
                                <div class="doc-manage-body">
                                    <!-- New update V3.1 Starts ........ Changed the table col -->
                                    <div class="docs row g-0">
                                        <div class="col-3 col-md-3 col-lg-3 header-div">
                                            <span>Company Name</span>
                                        </div>
                                        <div class="col-4 col-md-4 col-lg-4 header-div">
                                            <span>Document Title</span>
                                        </div>
{{--                                        <div class="col-2 col-md-2 col-lg-2 header-div status-header">--}}
{{--                                            <span>Status</span>--}}
{{--                                        </div>--}}
                                        <div class="col-2 col-md-2 col-lg-2 header-div">
                                            <span>Action</span>
                                        </div>
                                    </div>
                                    <!-- New update V3.1 Ends -->

                                    <div id="accounting-table">
                                        <div class="docs row g-0">
                                            <div class="col-4 col-md-4 name-div">
                                                <span></span>
                                            </div>
                                            <div class="col-4 col-md-4 document-div">
                                                <p class=""></p>
                                            </div>
                                            <div class="col-2 col-md-2 status-div">
                                                <p name="doc-status" class="doc-status"></p>
                                            </div>
                                            <div class="col-2 col-md-2 action-div">
                                                <a href="#" onclick="adminDocCreateTab(event, 'acc-view-doc')"
                                                   class="action-buttons">View</a>
                                                <a href="#" class="action-buttons delete-btn" data-bs-toggle="modal"
                                                   data-bs-target="#accDeleteModal">Delete</a>
                                                <!-- Delete Modal Start -->
                                                <div class="modal fade" id="accDeleteModal" data-bs-backdrop="static"
                                                     data-bs-keyboard="false" tabindex="-1"
                                                     aria-labelledby="accDeleteModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog company-delete-modal">
                                                        <div class="modal-content">
                                                            <div class="company-delete-modal-body">
                                                                <p class="text-center">Confirm Delete</p>
                                                                <div class="text-center">
                                                                    <button type="button"
                                                                            class="btn btn-sm company-delete-modal-close-btn"
                                                                            data-bs-dismiss="modal" aria-label="No">No
                                                                    </button>
                                                                    <button type="submit" class="btn btn-sm yes-btn">Yes
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Delete Modal End -->
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="select-pagination-portion table-bottom-portion row g-0">
                                <div class="pagination-part bottom-pagination-part col-12 col-md-5 col-lg-4">
                                    <a data-href="" class="btn left-arrow accounting-data" id="accounting-left-arrow"><i
                                            class="fa-solid fa-chevron-left"></i></a>
                                    <span class="pagination-number pagination-left-number"
                                          id="accounting-left-number"></span>
                                    <span class="pagination-divider">/</span>
                                    <span class="pagination-number pagination-right-number"
                                          id="accounting-right-number"></span>
                                    <a data-href="" class="btn right-arrow accounting-data" id="accounting-right-arrow"><i
                                            class="fa-solid fa-chevron-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <!-- Accounting Table ends -->

                        <!-- Accounting Portion Ends -->

                        <!-- Human Resource Portion Starts -->

                        <!--Human Resource Create Doc Portion Starts -->
                        <div class="back-btn-div adminDocManageTabContent  hr-create-doc">
                            <button class="back-btn btn" onclick="goBack(event, 'human-resource')"><i
                                    class="fa-solid fa-arrow-left"></i></button>
                        </div>
                        <div id="hr-create-doc" class="tabcontent adminDocManageTabContent hr-create-doc">
                            <form action="" id="hr-doc-upload">
                                <meta name="csrf-token" content="{{ csrf_token() }}"/>
                                <div class="row">
                                    <input name="shareholder[]" id="hrShareholdersId" value="" type="text" readonly
                                           hidden/>
                                    <input name="director[]" id="hrDirectorsId" value="" type="text" readonly hidden/>
                                    <input name="service_id" id="" value="4" type="text" readonly hidden/>
                                    <input name="category-name" value="Human Resource" type="text" readonly hidden/>
                                    <div class="col-sm-12 col-md-6">
                                        <fieldset class="form-group">
                                            <label for="company_id" class="mb-2 mt-3"><span
                                                    class="required-sign">*</span>Company</label>
                                            <select class="form-control select form-select" name="company_id"
                                                    id="hr_company_id" required>
                                                <option hidden class="first-option" value="">Select</option>
                                                @foreach($companies as $company)
                                                    <option
                                                        value="{{$company->id}}">{{ucfirst($company->name)}}</option>
                                                @endforeach
                                            </select>
                                        </fieldset>
                                        <span class="text-danger hr-company_id"></span>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="title" class="mb-2 mt-3"><span class="required-sign">*</span>Document
                                                Name</label>
                                            <input type="text" class="form-control" name="name" id="title">
                                        </div>
                                        <span class="text-danger hr-name"></span>
                                    </div>
                                    <br>
                                    <div class="col-sm-12 col-md-6">
                                        <label for="document-upload" class="custom-file-uploaded"><span
                                                class="required-sign">*</span>
                                            Upload Your Document
                                        </label>
                                        <div class="upload-container">
                                            <label for="document-upload-hr" class="custom-file-upload">
                                                <i class="fa fa-paperclip" aria-hidden="true"></i>
                                            </label>
                                            <input id="file-name-hr" class="file-name form-control" type="text"
                                                   readonly/>
                                            <input id="document-upload-hr" class="document-upload" name="file"
                                                   type="file" accept=".doc, .docx, .pdf, .zip, .rar"
                                                   onchange="displayFileName('file-name-hr', 'document-upload-hr')"/>

                                            <button class="upload-button" type="button">Upload</button>
                                        </div>
                                        <span class="text-danger hr-file"></span>
                                    </div>
                                    <div class="admin-doc-manage-create-down-card-portion col-12 col-lg-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <h6 class="director-header">Directors</h6>
                                                    <a href="#" class="director-select-modal-btn" data-bs-toggle="modal"
                                                       data-bs-target="#hrDirectorSelectModal">
                                                        <img src="{{asset('assets/icons/add-button-icon.png')}}"
                                                             alt=""/></a>
                                                </div>
                                                <!-- Director select Modal Start -->
                                                <div class="modal fade" id="hrDirectorSelectModal"
                                                     data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                                     aria-labelledby="directorSelectModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog ds-select-modal">
                                                        <div class="modal-content">
                                                            <div class="ds-select-modal-body">
                                                                <div class="ds-select-modal-header row">
                                                                    <h5 class="modal-title col-11"
                                                                        id="directorSelectModalLabel">Select New
                                                                        Director</h5>
                                                                    <button type="button"
                                                                            class="btn btn-close btn-sm ds-select-modal-close-btn col-1"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                </div>
                                                                <div class="ds-select-modal-data row">
                                                                    <form action="#">
                                                                        <div class="data-body row">
                                                                            <div class="data-row col-12 col-md-12"
                                                                                 id="hr-director-modal"></div>
                                                                            <div class="data-row col-12 text-end">
                                                                                <button type="button"
                                                                                        id="add-hr-director"
                                                                                        class="create-ds-btn btn">Add
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Director select Modal End -->
                                                <div id="append-hr-director"></div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <h6 class="shareholder-header">Shareholders</h6>
                                                    <a href="#" class="shareholder-select-modal-btn"
                                                       data-bs-toggle="modal"
                                                       data-bs-target="#hrShareholderSelectModal">
                                                        <img src="{{asset('assets/icons/add-button-icon.png')}}"
                                                             alt=""/></a>
                                                </div>
                                                <!-- Shareholder select Modal Start -->
                                                <div class="modal fade" id="hrShareholderSelectModal"
                                                     data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                                     aria-labelledby="shareholderSelectModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog ds-select-modal">
                                                        <div class="modal-content">
                                                            <div class="ds-select-modal-body">
                                                                <div class="ds-select-modal-header row">
                                                                    <h5 class="modal-title col-11"
                                                                        id="shareholderSelectModalLabel">Select New
                                                                        Shareholders</h5>
                                                                    <button type="button"
                                                                            class="btn btn-close btn-sm ds-select-modal-close-btn col-1"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                </div>
                                                                <div class="ds-select-modal-data row">
                                                                    <form action="#">
                                                                        <div class="data-body row">
                                                                            <div class="data-row col-12 col-md-12"
                                                                                 id="hr-shareholder-modal"></div>
                                                                            <div class="data-row col-12 text-end">
                                                                                <button type="button"
                                                                                        id="add-hr-shareholder"
                                                                                        class="create-ds-btn btn">Add
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Shareholder select Modal End -->
                                                <div id="append-hr-shareholder"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="text-danger" id="hrNoSignerAlert"></p>
                                    <div class="col-sm-12 col-md-6 mt-2">
                                        <button type="submit" id="hr-submit" class="btn admin-doc-create-submit-btn"
                                                hidden>Submit
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <div class="admin-doc-create-btn-section tabcontent ">
                                <button type="button" id="hr-send" class="btn admin-doc-create-send-btn mt-3">
                                    <div id="HrLoadingDiv"><span class="spinner-border spinner-border-sm" role="status"
                                                                 aria-hidden="true"></span></div>
                                    Submit
                                </button>
                            </div>
                        </div>
                        <!-- Human Resource Create Doc Portion Ends -->

                        <!--Human Resources Edit Doc Portion Starts -->
                        <div class="back-btn-div adminDocManageTabContent hr-edit-doc">
                            <button class="back-btn btn" onclick="goBack(event, 'human-resource')"><i
                                    class="fa-solid  fa-arrow-left"></i></button>
                        </div>
                        <div id="hr-edit-doc" class="tabcontent adminDocManageTabContent hr-edit-doc">
                            <form action="" id="hr-edit-doc-upload">
                                <div class="row ">
                                    <input name="shareholder[]" id="hrEditShareholdersId" value="" type="text" readonly
                                           hidden/>
                                    <input name="director[]" id="hrEditDirectorsId" value="" type="text" readonly
                                           hidden/>
                                    <input name="current_document_id" id="hrDocumentId" value="" type="text" readonly
                                           hidden/>
                                    <input name="document_hashed" id="hrHashedDocumentId" value="" type="text" readonly
                                           hidden/>
                                    <input name="service_id" id="" value="4" type="text" readonly hidden/>
                                    <input name="category-name" value="Human Resource" type="text" readonly hidden/>
                                    <div class="col-sm-12 col-md-6">
                                        <fieldset class="form-group">
                                            <label for="company_id" class="mb-2 mt-3">
                                                <span class="required-sign">*</span>Company</label>
                                            <select class="form-control select form-select" name="company_id"
                                                    id="hr_edit_company_id" required></select>
                                        </fieldset>
                                        <span class="text-danger hr-edit-company_id"></span>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="title" class="mb-2 mt-3"><span class="required-sign">*</span>Document
                                                Name</label>
                                            <input type="text" class="form-control" name="name" id="hr-edit-name"
                                                   value="">
                                        </div>
                                        <span class="text-danger hr-edit-name"></span>
                                    </div>
                                    <br>
                                    <div class="col-sm-12 col-md-6">
                                        <label for="document-upload" class="custom-file-uploaded"><span
                                                class="required-sign">*</span> Upload Your Document
                                        </label>
                                        <div class="upload-container">
                                            <label for="document-edit-hr" class="custom-file-upload">
                                                <i class="fa fa-paperclip" aria-hidden="true"></i>
                                            </label>
                                            <input id="file-edit-hr" class="file-name form-control" type="text"
                                                   readonly/>
                                            <input id="document-edit-hr" class="document-upload" type="file" name="file"
                                                   accept=".doc, .docx, .pdf, .zip, .rar"
                                                   onchange="displayFileName('file-edit-hr','document-edit-hr')"/>
                                            <button class="upload-button" type="button">Upload</button>
                                        </div>
                                        <span class="text-danger hr-edit-file"></span>
                                    </div>
                                    <div class="admin-doc-manage-create-down-card-portion col-12 col-lg-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <h6 class="director-header">Directors</h6>
                                                    <a href="#" class="director-select-modal-btn" data-bs-toggle="modal"
                                                       data-bs-target="#hrDirectorEditModal">
                                                        <img src="{{asset('assets/icons/add-button-icon.png')}}"
                                                             alt=""/></a>
                                                </div>
                                                <!-- Director edit Modal Start -->
                                                <div class="modal fade" id="hrDirectorEditModal"
                                                     data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                                     aria-labelledby="hrDirectorEditModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog ds-select-modal">
                                                        <div class="modal-content">
                                                            <div class="ds-select-modal-body">
                                                                <div class="ds-select-modal-header row">
                                                                    <h5 class="modal-title col-11"
                                                                        id="hrDirectorEditModalLabel">Select New
                                                                        Director</h5>
                                                                    <button type="button"
                                                                            class="btn btn-close btn-sm ds-select-modal-close-btn col-1"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                </div>
                                                                <div class="ds-select-modal-data row">
                                                                    <form action="#">
                                                                        <div class="data-body row">
                                                                            <div class="data-row col-12 col-md-12"
                                                                                 id="hr-edit-director-modal"></div>
                                                                            <div class="data-row col-12 text-end">
                                                                                <button type="button"
                                                                                        id="edit-hr-director"
                                                                                        class="create-ds-btn btn">Add
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Director edit Modal End -->
                                                <div id="hr-director-edit-list"></div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <h6 class="shareholder-header">Shareholders</h6>
                                                    <a href="#" class="shareholder-select-modal-btn"
                                                       data-bs-toggle="modal" data-bs-target="#hrShareholderEditModal">
                                                        <img src="{{asset('assets/icons/add-button-icon.png')}}"
                                                             alt=""/></a>
                                                </div>
                                                <!-- Shareholder edit Modal Start -->
                                                <div class="modal fade" id="hrShareholderEditModal"
                                                     data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                                     aria-labelledby="hrShareholderEditModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog ds-select-modal">
                                                        <div class="modal-content">
                                                            <div class="ds-select-modal-body">
                                                                <div class="ds-select-modal-header row">
                                                                    <h5 class="modal-title col-11"
                                                                        id="hrShareholderEditModalLabel">Select New
                                                                        Shareholders</h5>
                                                                    <button type="button"
                                                                            class="btn btn-close btn-sm ds-select-modal-close-btn col-1"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                </div>
                                                                <div class="ds-select-modal-data row">
                                                                    <form action="#">
                                                                        <div class="data-body row">
                                                                            <div class="data-row col-12 col-md-12"
                                                                                 id="hr-edit-shareholder-modal"></div>
                                                                            <div class="data-row col-12 text-end">
                                                                                <button type="button"
                                                                                        id="edit-hr-shareholder"
                                                                                        class="create-ds-btn btn">Add
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Shareholder edit Modal End -->
                                                <div id="hr-shareholder-edit-list"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="text-danger" id="hrEditNoSignerAlert"></p>
                                    <div class="col-sm-12 col-md-6 mt-2">
                                        <button type="submit" id="hr-edit-submit"
                                                class="btn admin-doc-create-submit-btn" hidden>Submit
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <div class="admin-doc-create-btn-section tabcontent ">
                                <button type="button" id="hr-edit-send" class="btn admin-doc-create-send-btn mt-3">
                                    <div id="HrEditLoadingDiv"><span class="spinner-border spinner-border-sm"
                                                                     role="status" aria-hidden="true"></span></div>
                                    Submit
                                </button>
                            </div>
                        </div>
                        <!-- Human Resources Edit Doc Portion Ends -->

                        <!-- Human Resource Table starts -->
                        <div id="human-resource" class="tabcontent adminDocManageTabContent human-resource">
                            <div class="select-pagination-portion table-top-portion row g-0">
                                <div class="sb-part search-box-part col-12 col-md-4 offset-lg-1 col-lg-5">
                                    <div class="d-flex form-inputs search-data">
                                        <input class="form-control" name="hr-search-value" id="hr-search-value"
                                               type="text" placeholder=" Search">
                                        <button class="search-btn btn" onclick="hrSearchDocument()"><i
                                                class="fa-solid fa-search"></i></button>
                                    </div>
                                </div>
                                <div class="sb-part company-category-select col-6 offset-md-0 col-md-2 col-lg-2">
                                    {{--                                    <select class="form-control form-select nav-select select-data " name="priority" id="priority" required>--}}
                                    {{--                                        <option value="">Filter</option>--}}
                                    {{--                                        <option value="">All</option>--}}
                                    {{--                                        <option value="">Urgent</option>--}}
                                    {{--                                        <option value="">New</option>--}}
                                    {{--                                    </select>--}}
                                </div>
                                <div class="button-part  col-6 col-md-6 col-lg-5">
                                    @if(auth()->guard('web')->user()->can('create.document_management'))
                                        <button type="button" class="btn download-btn action-buttons active"
                                                onclick="adminDocCreateTab(event, 'hr-create-doc')">Create
                                        </button>
                                    @endif
                                </div>
                            </div>
                            <div class="table-responsive">
                                <div class="doc-manage-body">
                                    <!-- New update V3.1 Starts ........ Changed the table col -->
                                    <div class="docs row g-0">
                                        <div class="col-3 col-md-3 col-lg-3 header-div">
                                            <span>Company Name</span>
                                        </div>
                                        <div class="col-4 col-md-4 col-lg-4 header-div">
                                            <span>Document Title</span>
                                        </div>
{{--                                        <div class="col-2 col-md-2 col-lg-2 header-div status-header">--}}
{{--                                            <span>Status</span>--}}
{{--                                        </div>--}}
                                        <div class="col-2 col-md-2 col-lg-2 header-div">
                                            <span>Action</span>
                                        </div>
                                    </div>
                                    <!-- New update V3.1 Ends -->
                                    <div id="human-resource-table">
                                    </div>
                                </div>
                            </div>

                            <div class="select-pagination-portion table-bottom-portion row g-0">
                                <div class="pagination-part bottom-pagination-part col-12 col-md-5 col-lg-4">
                                    <a data-href="" class="btn left-arrow human-resource-data"
                                       id="human-resource-left-arrow"><i class="fa-solid fa-chevron-left"></i></a>
                                    <span class="pagination-number pagination-left-number"
                                          id="human-resource-left-number"></span>
                                    <span class="pagination-divider">/</span>
                                    <span class="pagination-number pagination-right-number"
                                          id="human-resource-right-number"></span>
                                    <a data-href="" class="btn right-arrow human-resource-data"
                                       id="human-resource-right-arrow"><i class="fa-solid fa-chevron-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <!-- Human Resource Table ends -->

                        <!-- Human Resource Portion ends -->
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Main Body End -->
@endsection
@push('customScripts')
    <script>
        function generateTempUrl(e) {
            let docId= e.getAttribute('data-id')
            let service= e.getAttribute('data-service')
            let url = "{{route('generate.temp.url', ':id')}}"
                url = url.replace(':id', docId)
            $.ajax({
                type: 'GET',
                url: url,
                success: function (res) {
                    if(service=="corp-sec"){
                        $('#corp-sec-temp-url').text('')
                        $('#corp-sec-temp-url').append(res)
                        $('#corp-copy-temp-url').removeClass('d-none')
                    }else if(service=="tax"){
                        $('#tax-temp').text('')
                        $('#tax-temp').append(res)
                        $('#tax-copy-temp-url').removeClass('d-none')
                    } else if(service=="acc"){
                        $('#acc-temp').text('')
                        $('#acc-temp').append(res)
                        $('#acc-copy-temp-url').removeClass('d-none')
                    }else if(service=="hr"){
                        $('#hr-temp').text('')
                        $('#hr-temp').append(res)
                        $('#hr-copy-temp-url').removeClass('d-none')
                    }
                }
            })

        }
        function copyToClipboard(e){
            let urlWrapper=''
            let service= e.getAttribute('data-service')
            if(service == 'corp-sec'){
                urlWrapper = 'corp-sec-temp-url'
            }else if(service == 'tax'){
                urlWrapper = 'tax-temp'
            } else if(service == 'acc'){
                urlWrapper = 'acc-temp'
            }else if(service == 'hr'){
                urlWrapper = 'hr-temp'
            }
            var textToCopy = $('#'+urlWrapper).text();
            navigator.clipboard.writeText(textToCopy).then(function() {
                $('#'+urlWrapper).next('span').next('span').text('')
                $('#'+urlWrapper).next('span').next('span').append(`<code> copied</code`)

            }).catch(function(err) {
                $('#'+urlWrapper).next('span').next('span').append(`<code>something went wrong!</code`)
            });
            setTimeout(function () {
                $('#'+urlWrapper).next('span').next('span').text('')
            }, 4000);
        }





        $('#corpSec-doc-download-btn').on('click', function () {
            let documentId = $(this).attr('data-id')
            {{--let url = '{{route('download.individual.document', ':document_id')}}'--}}
            let url = '{{route('download.local.document', ':document_id')}}'
            url = url.replace(':document_id', documentId)
            $(this).attr('href', url)
        })
        $('#tax-doc-download-btn').on('click', function () {
            let documentId = $(this).attr('data-id')
            {{--let url = '{{route('download.individual.document', ':document_id')}}'--}}
            let url = '{{route('download.local.document', ':document_id')}}'
            url = url.replace(':document_id', documentId)
            $(this).attr('href', url)
        })
        $('#acc-doc-download-btn').on('click', function () {
            let documentId = $(this).attr('data-id')
            {{--let url = '{{route('download.individual.document', ':document_id')}}'--}}
            let url = '{{route('download.local.document', ':document_id')}}'
            url = url.replace(':document_id', documentId)
            $(this).attr('href', url)
        })
        $('#hr-doc-download-btn').on('click', function () {
            let documentId = $(this).attr('data-id')
            {{--let url = '{{route('download.individual.document', ':document_id')}}'--}}
            let url = '{{route('download.local.document', ':document_id')}}'
            url = url.replace(':document_id', documentId)
            $(this).attr('href', url)
        })




        $(document).ready(function () {
            var activeTab = localStorage.getItem("activeTab");
            if ($('#' + activeTab).length) {
                document.getElementById(activeTab).click();
            } else {
                localStorage.setItem("activeTab", "tabCorpSec");
                document.getElementById("tabCorpSec").click();
            }


            //Loading Spinner hide start
            $('#CorpSecLoadingDiv').hide();
            $('#CorpSecEditLoadingDiv').hide();
            $('#CorpSecSendMailLoadingDiv').hide();

            $('#TaxLoadingDiv').hide();
            $('#TaxEditLoadingDiv').hide();
            $('#TaxSendMailLoadingDiv').hide();

            $('#AccLoadingDiv').hide();
            $('#AccEditLoadingDiv').hide();
            $('#AccSendMailLoadingDiv').hide();

            $('#HrLoadingDiv').hide();
            $('#HrEditLoadingDiv').hide();
            $('#HrSendMailLoadingDiv').hide();


            // $('#HrEditLoadingDiv').hide();
            // $('#HrSendMailLoadingDiv').hide();
            //Loading Spinner hide End

            // Get the element with id="defaultOpen" and click on it
            // document.getElementById("defaultOpen").click();
            //corp-sec-submit click
            $('#corp-sec-send').click(function () {
                $("#shareholdersId").attr('value', shareholdersEmailIds)
                $("#directorsId").attr('value', directorsEmailIds)
                $('#corp-sec-submit').click();
            })
            $('#corp-sec-edit-send').click(function () {
                $("#corpSecEditShareholdersId").attr('value', shareholdersEditEmailIds)
                $("#corpSecEditDirectorsId").attr('value', directorsEditEmailIds)
                $('#corp-sec-edit-submit').click();
            })
            $('#corp-sec-send-mail').click(function () {
                $("#corpSecViewDirector").attr('value', directorsViewEmailIds)
                $("#corpSecViewShareholder").attr('value', shareholdersViewEmailIds)
                $('#corp-sec-submit-mail').click();
            })
            //tax-submit click
            $('#tax-send').click(function () {
                $("#taxShareholdersId").attr('value', shareholdersEmailIds)
                $("#taxDirectorsId").attr('value', directorsEmailIds)
                $('#tax-submit').click();

            })
            $('#tax-edit-send').click(function () {
                $("#taxEditShareholdersId").attr('value', shareholdersEditEmailIds)
                $("#taxEditDirectorsId").attr('value', directorsEditEmailIds)
                $('#tax-edit-submit').click();

            })
            $('#tax-send-mail').click(function () {
                $("#taxViewDirector").attr('value', directorsViewEmailIds)
                $("#taxViewShareholder").attr('value', shareholdersViewEmailIds)
                $('#tax-submit-mail').click();
            })
            //acc-submit click
            $('#acc-send').click(function () {
                $("#accShareholdersId").attr('value', shareholdersEmailIds)
                $("#accDirectorsId").attr('value', directorsEmailIds)
                $('#acc-submit').click();
            })
            $('#acc-edit-send').click(function () {
                $("#accEditShareholdersId").attr('value', shareholdersEditEmailIds)
                $("#accEditDirectorsId").attr('value', directorsEditEmailIds)
                $('#acc-edit-submit').click();

            })
            $('#acc-send-mail').click(function () {
                $("#accViewDirector").attr('value', directorsViewEmailIds)
                $("#accViewShareholder").attr('value', shareholdersViewEmailIds)
                $('#acc-submit-mail').click();
            })
            //hr-submit click
            $('#hr-send').click(function () {
                $("#hrShareholdersId").attr('value', shareholdersEmailIds)
                $("#hrDirectorsId").attr('value', directorsEmailIds)
                $('#hr-submit').click();

            })
            $('#hr-edit-send').click(function () {
                $("#hrEditShareholdersId").attr('value', shareholdersEditEmailIds)
                $("#hrEditDirectorsId").attr('value', directorsEditEmailIds)
                $('#hr-edit-submit').click();

            })
            $('#hr-send-mail').click(function () {
                $("#hrViewDirector").attr('value', directorsViewEmailIds)
                $("#hrViewShareholder").attr('value', shareholdersViewEmailIds)
                $('#hr-submit-mail').click();
            })



            docStatus()
            fetchCorpSecData()
            fetchTaxData()
            fetchAccountingData()
            fetchHumanResourceData()


            // adminDocManageTab()
        })

        let url = "fetch-document?page="
        let wrapper = ""
        let dom = ""

        let shareholdersEmailIds = []
        let directorsEmailIds = []
        let shareholdersEditEmailIds = []
        let directorsEditEmailIds = []
        let shareholdersViewEmailIds = []
        let directorsViewEmailIds = []
        let submitButtonId = ""
        let submitForm = ""
        $('.pagination-part .left-arrow').on('click', function () {
            let tab = ""
            //to determine where to append data after pagination arrow click
            if ($(this).hasClass('corp-sec') == true || $(this).hasClass('corp-sec-search') == true) {
                wrapper = "#corp"
                tab = "corp-sec"
            } else if ($(this).hasClass('tax-data') == true || $(this).hasClass('tax-search') == true) {
                wrapper = "#tax-table"
                tab = "tax"
            } else if ($(this).hasClass('accounting-data') == true || $(this).hasClass('acc-search') == true) {
                wrapper = "#accounting-table"
                tab = "accounting"
            } else if ($(this).hasClass('human-resource-data') == true || $(this).hasClass('hr-search') == true) {
                wrapper = "#human-resource-table"
                tab = "human-resource"
            }

            if ($(this).attr('data-href') != '') {

                var page = $(this).attr('data-href').split('page=')[1];
                var searchParam = $(this).attr('data-href').split('?')[0].split('/')[5]
                var filterParam = $(this).attr('data-href').split('?')[0].split('/')[6]

                if ($(this).hasClass('corp-sec') == true) {
                    // let category=$(this).attr('data-href').split('?')[0].split('/')[5]
                    url = "fetch-document/" + 1 + "?page="
                } else if ($(this).hasClass('tax-data') == true) {
                    // let category=$(this).attr('data-href').split('?')[0].split('/')[5]
                    url = "fetch-document/" + 2 + "?page="
                } else if ($(this).hasClass('accounting-data') == true) {
                    // let category=$(this).attr('data-href').split('?')[0].split('/')[5]
                    url = "fetch-document/" + 3 + "?page="
                } else if ($(this).hasClass('human-resource-data') == true) {
                    // let category=$(this).attr('data-href').split('?')[0].split('/')[5]
                    url = "fetch-document/" + 4 + "?page="
                } else if ($(this).hasClass('corp-sec-search') == true) {
                    // let category=$(this).attr('data-href').split('?')[0].split('/')[5]
                    url = "search/" + 1 + "/" + searchParam + "?page="
                } else if ($(this).hasClass('tax-search') == true) {
                    // let category=$(this).attr('data-href').split('?')[0].split('/')[5]
                    url = "search/" + 2 + "/" + searchParam + "?page="
                } else if ($(this).hasClass('acc-search') == true) {
                    // let category=$(this).attr('data-href').split('?')[0].split('/')[5]
                    url = "search/" + 3 + "/" + searchParam + "?page="
                } else if ($(this).hasClass('hr-search') == true) {
                    url = "search/" + 4 + "/" + searchParam + "?page="
                }

                fetch_data(page, tab);
            }
        })
        $('.pagination-part .right-arrow').on('click', function () {
            let tab = ""
            //to determine where to append data after pagination arrow click
            if ($(this).hasClass('corp-sec') == true || $(this).hasClass('corp-sec-search') == true) {
                wrapper = "#corp"
                tab = 'corp-sec'
            } else if ($(this).hasClass('tax-data') == true || $(this).hasClass('tax-search') == true) {
                wrapper = "#tax-table"
                tab = "tax"
            } else if ($(this).hasClass('accounting-data') == true || $(this).hasClass('acc-search') == true) {
                wrapper = "#accounting-table"
                tab = "accounting"
            } else if ($(this).hasClass('human-resource-data') == true || $(this).hasClass('hr-search') == true) {
                wrapper = "#human-resource-table"
                tab = "human-resource"
            }

            if ($(this).attr('data-href') != '') {
                var page = $(this).attr('data-href').split('page=')[1];
                var searchParam = $(this).attr('data-href').split('?')[0].split('/')[5]
                var filterParam = $(this).attr('data-href').split('?')[0].split('/')[6]

                if ($(this).hasClass('corp-sec') == true) {
                    // let category=$(this).attr('data-href').split('?')[0].split('/')[5]
                    url = "fetch-document/" + 1 + "?page="
                } else if ($(this).hasClass('tax-data') == true) {
                    // let category=$(this).attr('data-href').split('?')[0].split('/')[5]
                    url = "fetch-document/" + 2 + "?page="
                } else if ($(this).hasClass('accounting-data') == true) {
                    // let category=$(this).attr('data-href').split('?')[0].split('/')[5]
                    url = "fetch-document/" + 3 + "?page="
                } else if ($(this).hasClass('human-resource-data') == true) {
                    // let category=$(this).attr('data-href').split('?')[0].split('/')[5]
                    url = "fetch-document/" + 4 + "?page="
                }  else if ($(this).hasClass('corp-sec-search') == true) {
                    url = "search/" + 1 + "/" + searchParam + "?page="
                } else if ($(this).hasClass('tax-search') == true) {
                    url = "search/" + 2 + "/" + searchParam + "?page="
                } else if ($(this).hasClass('acc-search') == true) {
                    url = "search/" + 3 + "/" + searchParam + "?page="
                } else if ($(this).hasClass('hr-search') == true) {
                    url = "search/" + 4 + "/" + searchParam + "?page="
                }

                fetch_data(page, tab);
            }

        })

        function fetch_data(page, tab) {
            let left_number = ""
            let right_number = ""
            let left_arrow = ""
            let right_arrow = ""

            $.ajax({
                url: url + page,
                success: function (res) {

                    // console.log(tab)
                    determinePaginationArrow(res, tab)
                    if (tab == "corp-sec") {
                        left_number = "#corp-sec-left-number"
                        right_number = "#corp-sec-right-number"
                        left_arrow = "#corp-sec-left-arrow"
                        right_arrow = "#corp-sec-right-arrow"
                        dom = "corpSecDomLoad(item)"
                    } else if (tab == "tax") {
                        left_number = "#tax-left-number"
                        right_number = "#tax-right-number"
                        left_arrow = "#tax-left-arrow"
                        right_arrow = "#tax-right-arrow"
                        dom = "taxDomLoad(item)"
                    } else if (tab == "accounting") {

                        left_number = "#accounting-left-number"
                        right_number = "#accounting-right-number"
                        left_arrow = "#accounting-left-arrow"
                        right_arrow = "#accounting-right-arrow"
                        dom = "accDomLoad(item)"
                    } else if (tab == "human-resource") {

                        left_number = "#human-resource-left-number"
                        right_number = "#human-resource-right-number"
                        left_arrow = "#human-resource-left-arrow"
                        right_arrow = "#human-resource-right-arrow"
                        dom = "hrDomLoad(item)"
                    }

                    $(left_number).text(res.current_page)
                    $(right_number).text(res.last_page)

                    $(left_arrow).attr('data-href', res.prev_page_url)
                    $(right_arrow).attr('data-href', res.next_page_url)
                    if (tab == "corp-sec") {

                        $(wrapper).html(res.data.map((item) =>
                            corpSecDomLoad(item)
                        ))

                    } else if (tab == "tax") {
                        $(wrapper).html(res.data.map((item) =>
                            taxDomLoad(item)
                        ))
                    } else if (tab == "accounting") {
                        $(wrapper).html(res.data.map((item) =>
                            accDomLoad(item)
                        ))

                    } else if (tab == "human-resource") {
                        $(wrapper).html(res.data.map((item) =>
                            hrDomLoad(item)
                        ))
                    }

                    docStatus()
                }
            });
        }

        function determinePaginationArrow(res, tab) {

            let left_arrow = ""
            let right_arrow = ""
            if (tab == 'corp-sec') {
                left_arrow = "#corp-sec-left-arrow"
                right_arrow = "#corp-sec-right-arrow"
            } else if (tab == 'tax') {
                left_arrow = "#tax-left-arrow"
                right_arrow = "#tax-right-arrow"
            } else if (tab == 'accounting') {
                left_arrow = "#accounting-left-arrow"
                right_arrow = "#accounting-right-arrow"
            } else if (tab == 'human-resource') {
                left_arrow = "#human-resource-left-arrow"
                right_arrow = "#human-resource-right-arrow"
            }

            if (res.current_page > 1) {
                if ($(left_arrow).hasClass("d-none") == true) {
                    $(left_arrow).removeClass('d-none')
                }
            } else {
                $(left_arrow).addClass('d-none')
            }
            if (res.current_page == res.last_page) {
                $(right_arrow).addClass('d-none')
            } else {
                $(right_arrow).removeClass('d-none')
            }
        }


        function corpSecDomLoad(item) {

            let delRoute = '{{route('document.del', ':document_id')}}'
            delRoute = delRoute.replace(':document_id', item.id)

            return `<div class="docs row g-0">
                        <input type="text" value="${item.id}" id="doc_id" hidden>
                        <div class="col-3 col-md-3 col-lg-3 name-div">
                            <span>${item.companies.name}</span>
                        </div>
                        <div class="col-4 col-md-4 col-lg-4 document-div">
                            <p class="">${item.name}</p>
                        </div>

                        <div class="col-3 col-md-3 col-lg-3 action-div">

                            <a href="#" id="corpsec-${item.id}" onclick="adminDocCreateTab(event, 'view-doc',this)" class="action-buttons view">View</a>
                            <a href="#" id="${item.id}" onclick="adminDocCreateTab(event,'edit-doc', this)" class="action-buttons ${item.status == 'completed' ? 'd-none' : ''}">Edit</a>
                            <a href="#" id="${delRoute}" onclick="corpSecDel(this)" class="action-buttons delete-btn ${item.status == 'completed' ? 'd-none' : ''}"  data-bs-toggle="modal" data-bs-target="#corpDeleteModal-${item.id}">Delete</a>
                            <!-- Delete Modal Start -->
            <form id="corpSecForm-${item.id}" method="POST">
            <div class="modal fade" id="corpDeleteModal-${item.id}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="corpDeleteModalLabel" aria-hidden="true">

            {{csrf_field()}}
            {{ method_field('DELETE') }}
            <div class="modal-dialog company-delete-modal">
            <div class="modal-content">
            <div class="company-delete-modal-body">
            <p class="text-center">Confirm Delete</p>
            <div class="text-center">
            <button type="button" class="btn btn-sm company-delete-modal-close-btn" data-bs-dismiss="modal" aria-label="No">No</button>
            <button type="submit" class="btn btn-sm yes-btn" onclick="hideModal(this,'corpDeleteModal-${item.id}')">Yes</button>
            </div>
            </div>
            </div>
            </div>
            </div>
            </form>

                <!-- Delete Modal End -->
            </div>
            </div>
            `


        }

        function taxDomLoad(item) {
            let delRoute = '{{route('document.del', ':document_id')}}'
            delRoute = delRoute.replace(':document_id', item.id)

            return `<div class="docs row g-0">
                        <input type="text" value="${item.id}" id="doc_id" hidden>
                        <div class="col-3 col-md-3 col-lg-3 name-div">
                        <span>${item.companies.name}</span>
                        </div>
                        <div class="col-4 col-md-4 col-lg-4 document-div">
                        <p class="">${item.name}</p>
                        </div>

                        <div class="col-3 col-md-3 col-lg-3 action-div">

                        <a href="#" id="tax-${item.id}" onclick="adminDocCreateTab(event, 'tax-view-doc',this)" class="action-buttons view">View</a>
                        <a href="#" id="${item.id}" onclick="adminDocCreateTab(event,'tax-edit-doc', this)" class="action-buttons ${item.status == 'completed' ? 'd-none' : ''}">Edit</a>
                        <a href="#" id="${delRoute}" onclick="taxDel(this)" class="action-buttons delete-btn ${item.status == 'completed' ? 'd-none' : ''}"  data-bs-toggle="modal" data-bs-target="#corpDeleteModal-${item.id}">Delete</a>
                            <!-- Delete Modal Start -->
                        <form id="taxForm-${item.id}" method="POST">
                        {{csrf_field()}}
                        {{ method_field('DELETE') }}
                        <div class="modal fade" id="corpDeleteModal-${item.id}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="corpDeleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog company-delete-modal">
                        <div class="modal-content">
                        <div class="company-delete-modal-body">
                        <p class="text-center">Confirm Delete</p>
                        <div class="text-center">
                        <button type="button" class="btn btn-sm company-delete-modal-close-btn" data-bs-dismiss="modal" aria-label="No">No</button>
                        <button type="submit" class="btn btn-sm yes-btn" onclick="hideModal(this,'corpDeleteModal-${item.id}')">Yes</button>
                        </div>
                        </div>
                        </div>
                        </div>
                        </div>
                        </form>
                            <!-- Delete Modal End -->
                        </div>
                        </div>`


        }

        function accDomLoad(item) {
            let delRoute = '{{route('document.del', ':document_id')}}'
            delRoute = delRoute.replace(':document_id', item.id)

            return `<div class="docs row g-0">
                        <input type="text" value="${item.id}" id="doc_id" hidden>
                        <div class="col-3 col-md-3 col-lg-3 name-div">
                        <span>${item.companies.name}</span>
                        </div>
                        <div class="col-4 col-md-4 col-lg-4 document-div">
                        <p class="">${item.name}</p>
                        </div>

                        <div class="col-3 col-md-3 col-lg-3 action-div">

                        <a href="#" id="acc-${item.id}" onclick="adminDocCreateTab(event, 'acc-view-doc',this)" class="action-buttons view">View</a>
                        <a href="#" id="${item.id}" onclick="adminDocCreateTab(event,'acc-edit-doc', this)" class="action-buttons ${item.status == 'completed' ? 'd-none' : ''}">Edit</a>
                        <a href="#" id="${delRoute}" onclick="accDel(this)" class="action-buttons delete-btn ${item.status == 'completed' ? 'd-none' : ''}"  data-bs-toggle="modal" data-bs-target="#corpDeleteModal-${item.id}">Delete</a>
                            <!-- Delete Modal Start -->
                        <form id="accForm-${item.id}" method="POST">
                        {{csrf_field()}}
                        {{ method_field('DELETE') }}
                        <div class="modal fade" id="corpDeleteModal-${item.id}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="corpDeleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog company-delete-modal">
                        <div class="modal-content">
                        <div class="company-delete-modal-body">
                        <p class="text-center">Confirm Delete</p>
                        <div class="text-center">
                        <button type="button" class="btn btn-sm company-delete-modal-close-btn" data-bs-dismiss="modal" aria-label="No">No</button>
                        <button type="submit" class="btn btn-sm yes-btn" onclick="hideModal(this,'corpDeleteModal-${item.id}')">Yes</button>
                        </div>
                        </div>
                        </div>
                        </div>
                        </div>
                        </form>
                            <!-- Delete Modal End -->
                        </div>
                        </div>
                        `


        }

        function hrDomLoad(item) {
            let delRoute = '{{route('document.del', ':document_id')}}'
            delRoute = delRoute.replace(':document_id', item.id)

            return `<div class="docs row g-0">
            <input type="text" value="${item.id}" id="doc_id" hidden>
            <div class="col-3 col-md-3 col-lg-3 name-div">
            <span>${item.companies.name}</span>
            </div>
            <div class="col-4 col-md-4 col-lg-4 document-div">
            <p class="">${item.name}</p>
            </div>

            <div class="col-3 col-md-3 col-lg-3 action-div">

            <a href="#" id="hr-${item.id}" onclick="adminDocCreateTab(event, 'hr-view-doc',this)" class="action-buttons view">View</a>
            <a href="#" id="${item.id}" onclick="adminDocCreateTab(event,'hr-edit-doc', this)" class="action-buttons ${item.status == 'completed' ? 'd-none' : ''}">Edit</a>
            <a href="#" id="${delRoute}" onclick="hrDel(this)" class="action-buttons delete-btn ${item.status == 'completed' ? 'd-none' : ''}"  data-bs-toggle="modal" data-bs-target="#corpDeleteModal-${item.id}">Delete</a>
                <!-- Delete Modal Start -->
            <form id="hrForm-${item.id}" method="POST">
            {{csrf_field()}}
            {{ method_field('DELETE') }}
            <div class="modal fade" id="corpDeleteModal-${item.id}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="corpDeleteModalLabel" aria-hidden="true">
            <div class="modal-dialog company-delete-modal">
            <div class="modal-content">
            <div class="company-delete-modal-body">
            <p class="text-center">Confirm Delete</p>
            <div class="text-center">
            <button type="button" class="btn btn-sm company-delete-modal-close-btn" data-bs-dismiss="modal" aria-label="No">No</button>
            <button type="submit" class="btn btn-sm yes-btn" data-id="corpDeleteModal-${item.id}" onclick="hideModal(this,'corpDeleteModal-${item.id}')">Yes</button>
            </div>
            </div>
            </div>
            </div>
            </div>
            </form>
                <!-- Delete Modal End -->
            </div>
            </div>`


        }


        //Delete Start
        function corpSecDel(e) {
            let buttonId = e.id
            let delFormId = buttonId.split('/')[4]
            document.getElementById('corpSecForm-' + delFormId).setAttribute('action', e.id)
        }

        function taxDel(e) {
            let buttonId = e.id
            let delFormId = buttonId.split('/')[4]
            document.getElementById('taxForm-' + delFormId).setAttribute('action', e.id)
        }

        function accDel(e) {
            let buttonId = e.id
            let delFormId = buttonId.split('/')[4]
            document.getElementById('accForm-' + delFormId).setAttribute('action', e.id)
        }

        function hrDel(e) {
            let buttonId = e.id
            let delFormId = buttonId.split('/')[4]
            document.getElementById('hrForm-' + delFormId).setAttribute('action', e.id)
        }


        //Delete End


        // company dropdown onclick start
        $('#corp_sec_company_id').on('change', function (d) {
            let directorWrapper = "#append-corp-sec-director"
            let shareholderWrapper = "#append-corp-sec-shareholder"
            let company_id = d.target.value;
            // console.log(d.target.value)
            let url = '{{route('fetch', ':company_id')}}'
            url = url.replace(':company_id', company_id)
            $.ajax({
                url: url,
                success: function (res) {
                    console.log(res)
                    directorsEmailIds = []
                    shareholdersEmailIds = []
                    $.each(res.shareholders, function (key, value) {
                        // console.log(value)
                        shareholdersEmailIds.push(value.id)
                        // shareholdersEmailIds.push(value.id)
                    });
                    // console.log(value)
                    $.each(res.directors, function (key, value) {
                        directorsEmailIds.push(value.id)
                        // directorsEmailIds.push(value.id)
                        // inviteEmailIds.push(value.id)
                    });
                    let functionName = 'remove(this)'
                    $(directorWrapper).html(res.directors.map((item) =>
                        directorDomLoad(item, 'corpsec', functionName)
                    ))
                    $(shareholderWrapper).html(res.shareholders.map((item) =>
                        shareholderDomLoad(item, 'corpsec', functionName)
                    ))
                    $("#corp-sec-director-modal").html(res.directors.map((item) =>
                        directorModalDomLoad(item)
                    ))
                    $("#corp-sec-shareholder-modal").html(res.shareholders.map((item) =>
                        shareholderModalDomLoad(item)
                    ))

                    // //for edit
                    // $("#corp-sec-edit-director-modal").html(res.directors.map((item) =>
                    //     directorModalDomLoad(item)
                    // ))
                    // $("#corp-sec-edit-shareholder-modal").html(res.shareholders.map((item) =>
                    //     shareholderModalDomLoad(item)
                    // ))
                }
            });
        })
        $('#corp-sec-edit-company_id').on('change', function (d) {
            let directorWrapper = "#director-edit-list"
            let shareholderWrapper = "#shareholder-edit-list"
            let company_id = d.target.value;

            let url = '{{route('fetch', ':company_id')}}'
            url = url.replace(':company_id', company_id)
            $.ajax({
                url: url,
                success: function (res) {
                    directorsEditEmailIds = []
                    shareholdersEditEmailIds = []
                    $.each(res.shareholders, function (key, value) {
                        shareholdersEditEmailIds.push(value.id)
                    });
                    $.each(res.directors, function (key, value) {
                        directorsEditEmailIds.push(value.id)
                    });
                    let functionName = 'editremove(this)'
                    $(directorWrapper).html(res.directors.map((item) =>
                        directorDomLoad(item, 'corpsec', functionName)
                    ))
                    $(shareholderWrapper).html(res.shareholders.map((item) =>
                        shareholderDomLoad(item, 'corpsec', functionName)
                    ))
                    $("#corp-sec-edit-director-modal").html(res.directors.map((item) =>
                        directorModalDomLoad(item)
                    ))
                    $("#corp-sec-edit-shareholder-modal").html(res.shareholders.map((item) =>
                        shareholderModalDomLoad(item)
                    ))
                    // console.log(directorsEmailIds)
                    // console.log(shareholdersEmailIds)
                }
            });
        })

        $('#tax_company_id').on('change', function (d) {
            let directorWrapper = "#append-tax-director"
            let shareholderWrapper = "#append-tax-shareholder"
            let company_id = d.target.value;
            let url = '{{route('fetch', ':company_id')}}'
            url = url.replace(':company_id', company_id)
            $.ajax({
                url: url,
                success: function (res) {
                    directorsEmailIds = []
                    shareholdersEmailIds = []
                    $.each(res.shareholders, function (key, value) {
                        shareholdersEmailIds.push(value.id)
                        // shareholdersEmailIds.push(value.id)
                    });
                    $.each(res.directors, function (key, value) {
                        directorsEmailIds.push(value.id)
                        // directorsEmailIds.push(value.id)
                        // inviteEmailIds.push(value.id)
                    });
                    let functionName = 'remove(this)'
                    $(directorWrapper).html(res.directors.map((item) =>
                        directorDomLoad(item, 'tax', functionName)
                    ))
                    $(shareholderWrapper).html(res.shareholders.map((item) =>
                        shareholderDomLoad(item, 'tax', functionName)
                    ))
                    $("#tax-director-modal").html(res.directors.map((item) =>
                        directorModalDomLoad(item)
                    ))
                    $("#tax-shareholder-modal").html(res.shareholders.map((item) =>
                        shareholderModalDomLoad(item)
                    ))
                }
            });
        })
        $('#tax_edit_company_id').on('change', function (d) {
            let directorWrapper = "#tax-director-edit-list"
            let shareholderWrapper = "#tax-shareholder-edit-list"
            let company_id = d.target.value;
            let url = '{{route('fetch', ':company_id')}}'
            url = url.replace(':company_id', company_id)
            $.ajax({
                url: url,
                success: function (res) {
                    directorsEditEmailIds = []
                    shareholdersEditEmailIds = []
                    $.each(res.shareholders, function (key, value) {
                        shareholdersEditEmailIds.push(value.id)
                        // shareholdersEmailIds.push(value.id)
                    });
                    $.each(res.directors, function (key, value) {
                        directorsEditEmailIds.push(value.id)
                        // directorsEmailIds.push(value.id)
                        // inviteEmailIds.push(value.id)
                    });
                    let functionName = 'editremove(this)'
                    $(directorWrapper).html(res.directors.map((item) =>
                        directorDomLoad(item, 'tax', functionName)
                    ))
                    $(shareholderWrapper).html(res.shareholders.map((item) =>
                        shareholderDomLoad(item, 'tax', functionName)
                    ))
                    $("#tax-edit-director-modal").html(res.directors.map((item) =>
                        directorModalDomLoad(item)
                    ))
                    $("#tax-edit-shareholder-modal").html(res.shareholders.map((item) =>
                        shareholderModalDomLoad(item)
                    ))
                }
            });
        })

        $('#acc_company_id').on('change', function (d) {
            let directorWrapper = "#append-acc-director"
            let shareholderWrapper = "#append-acc-shareholder"
            let company_id = d.target.value;
            let url = '{{route('fetch', ':company_id')}}'
            url = url.replace(':company_id', company_id)
            $.ajax({
                url: url,
                success: function (res) {
                    directorsEmailIds = []
                    shareholdersEmailIds = []
                    $.each(res.shareholders, function (key, value) {
                        shareholdersEmailIds.push(value.id)
                        // shareholdersEmailIds.push(value.id)
                    });
                    $.each(res.directors, function (key, value) {
                        directorsEmailIds.push(value.id)
                        // directorsEmailIds.push(value.id)
                        // inviteEmailIds.push(value.id)
                    });
                    let functionName = 'remove(this)'
                    $(directorWrapper).html(res.directors.map((item) =>
                        directorDomLoad(item, 'acc', functionName)
                    ))
                    $(shareholderWrapper).html(res.shareholders.map((item) =>
                        shareholderDomLoad(item, 'acc', functionName)
                    ))
                    $("#acc-director-modal").html(res.directors.map((item) =>
                        directorModalDomLoad(item)
                    ))
                    $("#acc-shareholder-modal").html(res.shareholders.map((item) =>
                        shareholderModalDomLoad(item)
                    ))
                }
            });
        })
        $('#acc_edit_company_id').on('change', function (d) {
            let directorWrapper = "#acc-director-edit-list"
            let shareholderWrapper = "#acc-shareholder-edit-list"
            let company_id = d.target.value;
            let url = '{{route('fetch', ':company_id')}}'
            url = url.replace(':company_id', company_id)
            $.ajax({
                url: url,
                success: function (res) {
                    directorsEditEmailIds = []
                    shareholdersEditEmailIds = []
                    $.each(res.shareholders, function (key, value) {
                        shareholdersEditEmailIds.push(value.id)
                        // shareholdersEmailIds.push(value.id)
                    });
                    $.each(res.directors, function (key, value) {
                        directorsEditEmailIds.push(value.id)
                        // directorsEmailIds.push(value.id)
                        // inviteEmailIds.push(value.id)
                    });
                    let functionName = 'editremove(this)'
                    $(directorWrapper).html(res.directors.map((item) =>
                        directorDomLoad(item, 'acc', functionName)
                    ))
                    $(shareholderWrapper).html(res.shareholders.map((item) =>
                        shareholderDomLoad(item, 'acc', functionName)
                    ))
                    $("#acc-edit-director-modal").html(res.directors.map((item) =>
                        directorModalDomLoad(item)
                    ))
                    $("#acc-edit-shareholder-modal").html(res.shareholders.map((item) =>
                        shareholderModalDomLoad(item)
                    ))
                }
            });
        })

        $('#hr_company_id').on('change', function (d) {
            let directorWrapper = "#append-hr-director"
            let shareholderWrapper = "#append-hr-shareholder"
            let company_id = d.target.value;
            let url = '{{route('fetch', ':company_id')}}'
            url = url.replace(':company_id', company_id)
            $.ajax({
                url: url,
                success: function (res) {
                    directorsEmailIds = []
                    shareholdersEmailIds = []
                    $.each(res.shareholders, function (key, value) {
                        shareholdersEmailIds.push(value.id)
                    });
                    $.each(res.directors, function (key, value) {
                        directorsEmailIds.push(value.id)
                    });
                    let functionName = 'remove(this)'
                    $(directorWrapper).html(res.directors.map((item) =>
                        directorDomLoad(item, 'hr', functionName)
                    ))
                    $(shareholderWrapper).html(res.shareholders.map((item) =>
                        shareholderDomLoad(item, 'hr', functionName)
                    ))
                    $("#hr-director-modal").html(res.directors.map((item) =>
                        directorModalDomLoad(item)
                    ))
                    $("#hr-shareholder-modal").html(res.shareholders.map((item) =>
                        shareholderModalDomLoad(item)
                    ))
                }
            });
        })
        $('#hr_edit_company_id').on('change', function (d) {
            let directorWrapper = "#hr-director-edit-list"
            let shareholderWrapper = "#hr-shareholder-edit-list"
            let company_id = d.target.value;
            let url = '{{route('fetch', ':company_id')}}'
            url = url.replace(':company_id', company_id)
            $.ajax({
                url: url,
                success: function (res) {
                    directorsEditEmailIds = []
                    shareholdersEditEmailIds = []
                    $.each(res.shareholders, function (key, value) {
                        shareholdersEditEmailIds.push(value.id)
                        // shareholdersEmailIds.push(value.id)
                    });
                    $.each(res.directors, function (key, value) {
                        directorsEditEmailIds.push(value.id)
                        // directorsEmailIds.push(value.id)
                        // inviteEmailIds.push(value.id)
                    });
                    let functionName = 'editremove(this)'
                    $(directorWrapper).html(res.directors.map((item) =>
                        directorDomLoad(item, 'hr', functionName)
                    ))
                    $(shareholderWrapper).html(res.shareholders.map((item) =>
                        shareholderDomLoad(item, 'hr', functionName)
                    ))
                    $("#hr-edit-director-modal").html(res.directors.map((item) =>
                        directorModalDomLoad(item)
                    ))
                    $("#hr-edit-shareholder-modal").html(res.shareholders.map((item) =>
                        shareholderModalDomLoad(item)
                    ))
                }
            });
        })
        // company dropdown onclick end


        //DOM rendering start
        function directorDomLoad(director, service, functionName) {
            return `<div id="director-list">
            <div class="directors d-flex">
            <div>
            <p>${director.first_name + " " + (director.last_name!=null?director.last_name:'') + " (" + director.email + ")"}</p>` +
            (director.ccs.map((cc) => (cc != null ? `<p>cc: ${cc}</p>` : '')).join(" ")) +
            `</div>
                <button type="button" id="${service}-director-${director.id}" onclick="${functionName}" class="btn p-0 ps-3 ms-auto cancel-btn">x</button>
            </div>
        </div>`
        }

        function shareholderDomLoad(shareholder, service, functionName) {
            return `<div id="shareholder-list">
                        <div class="shareholders d-flex">
                            <div>
                                <p>${shareholder.first_name + " " + (shareholder.last_name!=null?shareholder.last_name:'') + " (" + shareholder.email + ")"}</p>` +
                (shareholder.ccs.length != 0 ? (shareholder.ccs.map((cc) => (cc != null ? ` <p>cc: ${cc}</p>` : '')).join(" ")) : ' ') +
                `</div>
                            <button type="button" id="${service}-shareholder-${shareholder.id}" onclick="${functionName}" class="btn p-0 ps-3 ms-auto cancel-btn">x</button>
                        </div>
                    </div>`
        }

        function directorModalDomLoad(director) {
            return `<div class="directors d-flex">
                        <div class="col-md-2 col-sm-1 col-1">
                            <input type="checkbox" class="select-checkbox" name="directors[]" value="${director.id}" checked/>
                        </div>
                        <div class="col-md-10 col-sm-11 col-11">
                            <p>${director.first_name + " " + (director.last_name!=null?director.last_name:'') + " (" + director.email + ")"}</p>` +
                (director.ccs.map((cc) => (cc != null ? `<p>cc: ${cc}</p>` : '')).join(" ")) +
                `</div>
                    </div>`
        }

        // function directorEditModalDomLoad(director){
        //     return `<div class="directors d-flex">
        //                 <div class="col-md-2 col-sm-1 col-1">
        //                     <input type="checkbox" class="select-checkbox" name="directors[]" value="${director.id}"/>
        //                 </div>
        //                 <div class="col-md-10 col-sm-11 col-11">
        //                     <p>${director.first_name+" "+ director.last_name+ " ("+ director.email +")"}</p>`+
        //                         (director.ccs.map((cc)=>(cc != null ? `<p>cc: ${cc}</p>` : '')).join(" "))+
        //                 `</div>
        //             </div>`
        // }
        function shareholderModalDomLoad(shareholder) {
            return `<div class="shareholders d-flex">
                            <div class="col-md-2 col-sm-1 col-1">
                                <input type="checkbox"class="select-checkbox" name="shareholders[]" value="${shareholder.id}" checked/>
                            </div>
                            <div class="col-md-10 col-sm-11 col-11">
                                <p>${shareholder.first_name + " " + (shareholder.last_name!=null?shareholder.last_name:'') + " (" + shareholder.email + ")"}</p>` +
                (shareholder.ccs.map((cc) => (cc != null ? `<p>cc: ${cc}</p>` : '')).join(" ")) +
                `</div>
                        </div>`
        }

        function managementCCDomLoad(ccs) {
            let html = '';
            $.map(ccs, function (cc, j) {
                if (cc != null) {
                    html += '<p>cc: ' + cc + '</p>';
                }

            });
            return html;
        }

        //DOM rendering end

        //when corp-sec search input is empty
        $('#corp-sec-search').on('keyup', function () {
            if (this.value.length == 0) {
                corpSecSearchDocument()
            }
        })

        //search
        function corpSecSearchDocument() {

            let wrapper = "#corp"
            let search = $('#corp-sec-search').val()
            let url = ''
            if (search != '') {
                url = 'search/1/' + search
            } else {
                url = 'search/1/' + 0
            }

            {{--let url = '{{route('document.search', 1, ':search')}}'--}}
            // url=url.replace(':search',search)


            $.ajax({
                url: url,
                success: function (res) {
                    determinePaginationArrow(res, 'corp-sec')

                    $('#corp-sec-left-number').text(res.current_page)
                    $('#corp-sec-right-number').text(res.last_page)
                    $("#corp-sec-left-arrow").attr('data-href', res.prev_page_url)
                    $("#corp-sec-right-arrow").attr('data-href', res.next_page_url)
                    $('#corp-sec-left-arrow').addClass('corp-sec-search')
                    $('#corp-sec-right-arrow').addClass('corp-sec-search')

                    $('#corp-sec-left-arrow').removeClass('corp-sec')
                    $('#corp-sec-right-arrow').removeClass('corp-sec')
                    if (res.data.length > 0) {
                        $(wrapper).html(res.data.map((item) =>
                            corpSecDomLoad(item)
                        ))
                    } else {
                        $(wrapper).html(`<div class="docs row g-0">
                        <div class="col-12 col-md-12 col-lg-12 name-div text-center">
                            <span>No Data Available</span>
                        </div>`)
                    }
                    docStatus()
                }
            });

        }

        //when tax search input is empty
        $('#tax-search-value').on('keyup', function () {
            if (this.value.length == 0) {
                taxSearchDocument()
            }
        })

        function taxSearchDocument() {
            let wrapper = "#tax-table"
            let search = $('#tax-search-value').val()
            let url = ''
            if (search != '') {
                url = 'search/2/' + search
            } else {
                url = 'search/2/' + 0
            }
            {{--let url = '{{route('document.search', 1, ':search')}}'--}}
            // url=url.replace(':search',search)


            $.ajax({
                url: url,
                success: function (res) {
                    determinePaginationArrow(res, 'tax')

                    $('#tax-left-number').text(res.current_page)
                    $('#tax-right-number').text(res.last_page)
                    $("#tax-left-arrow").attr('data-href', res.prev_page_url)
                    $("#tax-right-arrow").attr('data-href', res.next_page_url)

                    $('#tax-left-arrow').addClass('tax-search')
                    $('#tax-right-arrow').addClass('tax-search')

                    $('#tax-left-arrow').removeClass('tax-data')
                    $('#tax-right-arrow').removeClass('tax-data')
                    if (res.data.length > 0) {
                        $(wrapper).html(res.data.map((item) =>
                            taxDomLoad(item)
                        ))
                    } else {
                        $(wrapper).html(`<div class="docs row g-0">
                        <div class="col-12 col-md-12 col-lg-12 name-div text-center">
                            <span>No Data Available</span>
                        </div>`)
                    }
                    docStatus()
                }
            });

        }

        //when acc search input is empty
        $('#acc-search-value').on('keyup', function () {
            if (this.value.length == 0) {
                accSearchDocument()
            }
        })

        function accSearchDocument() {
            let wrapper = "#accounting-table"
            let search = $('#acc-search-value').val()
            let url = ''
            if (search != '') {
                url = 'search/3/' + search
            } else {
                url = 'search/3/' + 0
            }

            $.ajax({
                url: url,
                success: function (res) {
                    determinePaginationArrow(res, 'accounting')

                    $('#accounting-left-number').text(res.current_page)
                    $('#accounting-right-number').text(res.last_page)
                    $("#accounting-left-arrow").attr('data-href', res.prev_page_url)
                    $("#accounting-right-arrow").attr('data-href', res.next_page_url)

                    $('#accounting-left-arrow').addClass('acc-search')
                    $('#accounting-right-arrow').addClass('acc-search')

                    $('#accounting-left-arrow').removeClass('accounting-data')
                    $('#accounting-right-arrow').removeClass('accounting-data')
                    if (res.data.length > 0) {
                        $(wrapper).html(res.data.map((item) =>
                            accDomLoad(item, res)
                        ))
                    } else {
                        $(wrapper).html(`<div class="docs row g-0">
                        <div class="col-12 col-md-12 col-lg-12 name-div text-center">
                            <span>No Data Available</span>
                        </div>`)
                    }
                    docStatus()
                }
            });

        }


        //when hr search input is empty
        $('#hr-search-value').on('keyup', function () {
            if (this.value.length == 0) {
                hrSearchDocument()
            }
        })

        function hrSearchDocument() {
            let wrapper = "#human-resource-table"
            let search = $('#hr-search-value').val()
            let url = ''
            if (search != '') {
                url = 'search/4/' + search
            } else {
                url = 'search/4/' + 0
            }

            $.ajax({
                url: url,
                success: function (res) {
                    determinePaginationArrow(res, 'human-resource')

                    $('#human-resource-left-number').text(res.current_page)
                    $('#human-resource-right-number').text(res.last_page)
                    $("#human-resource-left-arrow").attr('data-href', res.prev_page_url)
                    $("#human-resource-right-arrow").attr('data-href', res.next_page_url)

                    $('#human-resource-left-arrow').addClass('hr-search')
                    $('#human-resource-right-arrow').addClass('hr-search')

                    $('#human-resource-left-arrow').removeClass('human-resource-data')
                    $('#human-resource-right-arrow').removeClass('human-resource-data')
                    if (res.data.length > 0) {
                        $(wrapper).html(res.data.map((item) =>
                            hrDomLoad(item, res)
                        ))
                    } else {
                        $(wrapper).html(`<div class="docs row g-0">
                        <div class="col-12 col-md-12 col-lg-12 name-div text-center">
                            <span>No Data Available</span>
                        </div>`)
                    }
                    docStatus()
                }
            });

        }



        // function injectClass(className){
        //     $(".pagination-part .right-arrow").addClass(className)
        //     $(".pagination-part .left-arrow").addClass(className)
        // }
        // function removeClassFromPaginationArrow(className){
        //     if ( $(".pagination-part .right-arrow").hasClass(className)){
        //         $(".pagination-part .right-arrow").removeClass(className)
        //     }
        //     if (  $(".pagination-part .left-arrow").hasClass(className)){
        //         $(".pagination-part .left-arrow").removeClass(className)
        //     }
        // }


        //fetch data
        function fetchCorpSecData() {
            let wrapper = "#corp"
            let url = '{{route('document.fetch', 1)}}'
            $.ajax({
                url: url,
                success: function (res) {
                    determinePaginationArrow(res, 'corp-sec')

                    $('#corp-sec-left-number').text(res.current_page)
                    $('#corp-sec-right-number').text(res.last_page)
                    $("#corp-sec-left-arrow").attr('data-href', res.prev_page_url)
                    $("#corp-sec-right-arrow").attr('data-href', res.next_page_url)
                    $('#corp-sec-left-arrow').removeClass('corp-sec-search')
                    $('#corp-sec-right-arrow').removeClass('corp-sec-search')
                    // removeClassFromPaginationArrow('corp-sec-search')
                    if (res.data.length > 0) {
                        $(wrapper).html(res.data.map((item) =>
                            corpSecDomLoad(item)
                        ))
                    } else {
                        $(wrapper).html(`<div class="docs row g-0">
                        <div class="col-12 col-md-12 col-lg-12 name-div text-center">
                            <span>No Data Available</span>
                        </div>`)
                    }
                    docStatus()
                }
            });
        }

        function fetchTaxData() {
            let wrapper = "#tax-table"
            let url = '{{route('document.fetch', 2)}}'

            $.ajax({
                url: url,
                success: function (res) {
                    // console.log(res)
                    determinePaginationArrow(res, 'tax')

                    $('#tax-left-number').text(res.current_page)
                    $('#tax-right-number').text(res.last_page)
                    $("#tax-left-arrow").attr('data-href', res.prev_page_url)
                    $("#tax-right-arrow").attr('data-href', res.next_page_url)
                    if (res.data.length > 0) {
                        $(wrapper).html(res.data.map((item) =>
                            taxDomLoad(item, res)
                        ))
                    } else {
                        $(wrapper).html(`<div class="docs row g-0">
                        <div class="col-12 col-md-12 col-lg-12 name-div text-center">
                            <span>No Data Available</span>
                        </div>`)
                    }
                    docStatus()
                }
            });
        }

        function fetchAccountingData() {
            let wrapper = "#accounting-table"
            let url = '{{route('document.fetch', 3)}}'

            $.ajax({
                url: url,
                success: function (res) {
                    // console.log(res)
                    determinePaginationArrow(res, 'accounting')

                    $('#accounting-left-number').text(res.current_page)
                    $('#accounting-right-number').text(res.last_page)
                    $("#accounting-left-arrow").attr('data-href', res.prev_page_url)
                    $("#accounting-right-arrow").attr('data-href', res.next_page_url)
                    if (res.data.length > 0) {
                        $(wrapper).html(res.data.map((item) =>
                            accDomLoad(item, res)
                        ))
                    } else {
                        $(wrapper).html(`<div class="docs row g-0">
                        <div class="col-12 col-md-12 col-lg-12 name-div text-center">
                            <span>No Data Available</span>
                        </div>`)
                    }
                    docStatus()
                }
            });
        }

        function fetchHumanResourceData() {
            let wrapper = "#human-resource-table"
            let url = '{{route('document.fetch', 4)}}'

            $.ajax({
                url: url,
                success: function (res) {
                    // console.log(res)
                    determinePaginationArrow(res, 'human-resource')

                    $('#human-resource-left-number').text(res.current_page)
                    $('#human-resource-right-number').text(res.last_page)
                    $("#human-resource-left-arrow").attr('data-href', res.prev_page_url)
                    $("#human-resource-right-arrow").attr('data-href', res.next_page_url)
                    if (res.data.length > 0) {
                        $(wrapper).html(res.data.map((item) =>
                            hrDomLoad(item, res)
                        ))
                    } else {
                        $(wrapper).html(`<div class="docs row g-0">
                        <div class="col-12 col-md-12 col-lg-12 name-div text-center">
                            <span>No Data Available</span>
                        </div>`)
                    }
                    docStatus()
                }
            });
        }



        function fetchCorpSecEditData(e) {
            let directorWrapper = "#director-edit-list"
            let shareholderWrapper = "#shareholder-edit-list"

            let document_id = e
            let url = '{{route('document.edit', ':document_id')}}'
            url = url.replace(':document_id', document_id)

            $.ajax({
                url: url,
                success: function (res) {
                    if (res.abort == 403) {
                        $('#edit-doc').addClass('d-none')
                        $("html, body").animate({scrollTop: 0});
                        $('#flashMessages').html(
                            `<div class="alert alert-success alert-access">
                            <img class="alert-img" src="{{asset('assets/icons/mailbody-!.png')}}" alt="">
                            <p class="alert-text">${res.message}</p></div>`
                        )
                    } else {
                        directorsEditEmailIds = []
                        shareholdersEditEmailIds = []
                        // console.log('response:', res)
                        let options = ''
                        $.each(res[1], function (index, value) {
                            options += `<option value="${value.id}"  ${res[0].company_id == value.id ? 'selected' : " "}>${value.name}</option>`
                        });
                        $("#corp-sec-edit-company_id").empty().append(options)
                        $('#corp-sec-edit-name').attr('value', res[0].name)
                        $('#corpSecDocumentId').attr('value', res[0].id)
                        $('#corpSecHashedDocumentId').attr('value', res[0].document_id)
                        $('#file-edit-cs').attr('value', res[0].file)
                        let directors = ""
                        let shareholders = ""
                        $.map(res[0].signers, function (value, i) {
                            if (value.pivot.user_type == 'director') {
                                directorsEditEmailIds.push(value.id)
                                // console.log(value)
                                directors += ` <div class="directors d-flex">
                                                 <div>
                                                    <p>${value.first_name + " " + (value.last_name!=null?value.last_name:'') + " (" + value.email + ")"}</p>
                                                    <div class="corp-sec-edit-director-cc">
                                                        ${managementCCDomLoad(value.ccs)}
                                                    </div>
                                                </div>
                                                <button type="button" id="corpsec-director-${value.id}" onclick="editremove(this)" class="btn p-0 ps-3 ms-auto cancel-btn">x</button>
                                               </div>`

                            } else if (value.pivot.user_type == 'shareholder') {
                                shareholdersEditEmailIds.push(value.id)
                                shareholders += ` <div class="shareholders d-flex">
                                                     <div>
                                                     <p>${value.first_name + " " + (value.last_name!=null?value.last_name:'') + " (" + value.email + ")"}</p>
                                                        <div class="corp-sec-edit-shareholder-cc">
                                                            ${managementCCDomLoad(value.ccs)}
                                                        </div>
                                                    </div>
                                                    <button type="button" id="corpsec-shareholder-${value.id}" onclick="editremove(this)" class="btn p-0 ps-3 ms-auto cancel-btn">x</button>
                                                  </div>`

                            }
                        });
                        $(directorWrapper).empty().append(directors);
                        $(shareholderWrapper).empty().append(shareholders);
                        // getCorpSecShareholderAndDirector(res[0].company_id, res[0].signers)
                        getCorpSecEditShareholderAndDirector(res[0].company_id, res[0].signers)
                    }
                },
                error: function () {

                }
            });


        }

        function fetchTaxEditData(e) {
            // console.log('in edit:', $('input[name="shareholders[]"]').val())
            let directorWrapper = "#tax-director-edit-list"
            let shareholderWrapper = "#tax-shareholder-edit-list"

            let document_id = e
            let url = '{{route('document.edit', ':document_id')}}'
            url = url.replace(':document_id', document_id)

            $.ajax({
                url: url,
                success: function (res) {
                    if (res.abort == 403) {
                        $('#tax-edit-doc').addClass('d-none')
                        $("html, body").animate({scrollTop: 0});
                        $('#flashMessages').html(
                            `<div class="alert alert-success alert-access">
                                <img class="alert-img" src="{{asset('assets/icons/mailbody-!.png')}}" alt="">
                                <p class="alert-text">${res.message}</p>
                            </div>`
                        )
                    } else {
                        directorsEditEmailIds = []
                        shareholdersEditEmailIds = []

                        // console.log('response-document-edit:', res)
                        let options = ''
                        $.each(res[1], function (index, value) {
                            options += `<option value="${value.id}"  ${res[0].company_id == value.id ? 'selected' : " "}>${value.name}</option>`
                        });
                        $("#tax_edit_company_id").empty().append(options)
                        $('#tax-edit-name').attr('value', res[0].name)
                        $('#taxDocumentId').attr('value', res[0].id)
                        $('#taxHashedDocumentId').attr('value', res[0].document_id)
                        $('#file-edit-tax').attr('value', res[0].file)
                        let directors = ""
                        let shareholders = ""
                        $.map(res[0].signers, function (value, i) {

                            // $(".corp-sec-edit-director-cc").append(directorEditCCDomLoad(cc))
                            if (value.pivot.user_type == 'director') {
                                directorsEditEmailIds.push(value.id)
                                // console.log(value)
                                directors += ` <div class="directors d-flex">
                                                 <div>
                                                    <p>${value.first_name + " " + (value.last_name!=null?value.last_name:'') + " (" + value.email + ")"}</p>
                                                    <div class="corp-sec-edit-director-cc">
                                                       ${managementCCDomLoad(value.ccs)}
                                                    </div>
                                                </div>
                                                <button type="button" id="tax-director-${value.id}" onclick="editremove(this)" class="btn p-0 ps-3 ms-auto cancel-btn">x</button>
                                               </div>`
                            } else if (value.pivot.user_type == 'shareholder') {
                                shareholdersEditEmailIds.push(value.id)
                                shareholders += ` <div class="shareholders d-flex">
                                                     <div>
                                                        <p>${value.first_name + " " + (value.last_name!=null?value.last_name:'') + " (" + value.email + ")"}</p>
                                                        <div class="corp-sec-edit-shareholder-cc">
                                                            ${managementCCDomLoad(value.ccs)}
                                                        </div>
                                                    </div>
                                                    <button type="button" id="tax-shareholder-${value.id}" onclick="editremove(this)" class="btn p-0 ps-3 ms-auto cancel-btn">x</button>
                                                  </div>`
                            }
                        });
                        $(directorWrapper).empty().append(directors);
                        $(shareholderWrapper).empty().append(shareholders);
                        getTaxEditShareholderAndDirector(res[0].company_id, res[0].signers)
                    }
                }
            });
        }

        function fetchAccEditData(e) {
            let directorWrapper = "#acc-director-edit-list"
            let shareholderWrapper = "#acc-shareholder-edit-list"

            let document_id = e
            let url = '{{route('document.edit', ':document_id')}}'
            url = url.replace(':document_id', document_id)

            $.ajax({
                url: url,
                success: function (res) {
                    if (res.abort == 403) {
                        $('#acc-edit-doc').addClass('d-none')
                        $("html, body").animate({scrollTop: 0});
                        $('#flashMessages').html(
                            `<div class="alert alert-success alert-access">
                                <img class="alert-img" src="{{asset('assets/icons/mailbody-!.png')}}" alt="">
                                <p class="alert-text">${res.message}</p>
                            </div>`
                        )
                    } else {
                        directorsEditEmailIds = []
                        shareholdersEditEmailIds = []
                        // console.log('response-document-edit:', res)
                        let options = ''
                        $.each(res[1], function (index, value) {
                            options += `<option value="${value.id}"  ${res[0].company_id == value.id ? 'selected' : " "}>${value.name}</option>`
                        });
                        $("#acc_edit_company_id").empty().append(options)
                        $('#acc-edit-name').attr('value', res[0].name)
                        $('#accDocumentId').attr('value', res[0].id)
                        $('#accHashedDocumentId').attr('value', res[0].document_id)
                        $('#file-edit-acc').attr('value', res[0].file)
                        let directors = ""
                        let shareholders = ""
                        $.map(res[0].signers, function (value, i) {
                            // $(".corp-sec-edit-director-cc").append(directorEditCCDomLoad(cc))
                            if (value.pivot.user_type == 'director') {
                                directorsEditEmailIds.push(value.id)
                                // console.log(value)
                                directors += ` <div class="directors d-flex">
                                                 <div>
                                                 <p>${value.first_name + " " + (value.last_name!=null?value.last_name:'') + " (" + value.email + ")"}</p>
                                                    <div class="corp-sec-edit-director-cc">
                                                    ${managementCCDomLoad(value.ccs)}
                                                    </div>
                                                </div>
                                                <button type="button" id="acc-director-${value.id}" onclick="editremove(this)" class="btn p-0 ps-3 ms-auto cancel-btn">x</button>
                                              </div>`
                            } else if (value.pivot.user_type == 'shareholder') {
                                shareholdersEditEmailIds.push(value.id)
                                shareholders += ` <div class="shareholders d-flex">
                                                     <div>
                                                     <p>${value.first_name + " " + (value.last_name!=null?value.last_name:'') + " (" + value.email + ")"}</p>
                                                        <div class="corp-sec-edit-shareholder-cc">
                                                            ${managementCCDomLoad(value.ccs)}
                                                        </div>
                                                    </div>
                                                    <button type="button" id="acc-shareholder-${value.id}" onclick="editremove(this)" class="btn p-0 ps-3 ms-auto cancel-btn">x</button>
                                                  </div>`
                            }
                        });
                        $(directorWrapper).empty().append(directors);
                        $(shareholderWrapper).empty().append(shareholders);
                        getAccEditShareholderAndDirector(res[0].company_id, res[0].signers)
                    }
                }
            });
        }

        function fetchHrEditData(e) {
            let directorWrapper = "#hr-director-edit-list"
            let shareholderWrapper = "#hr-shareholder-edit-list"

            let document_id = e
            let url = '{{route('document.edit', ':document_id')}}'
            url = url.replace(':document_id', document_id)

            $.ajax({
                url: url,
                success: function (res) {
                    if (res.abort == 403) {
                        $('#hr-edit-doc').addClass('d-none')
                        $("html, body").animate({scrollTop: 0});
                        $('#flashMessages').html(
                            `<div class="alert alert-success alert-access">
                                <img class="alert-img" src="{{asset('assets/icons/mailbody-!.png')}}" alt="">
                                <p class="alert-text">${res.message}</p>
                            </div>`
                        )
                    } else {
                        directorsEditEmailIds = []
                        shareholdersEditEmailIds = []
                        // console.log('response-document-edit:', res)
                        let options = ''
                        $.each(res[1], function (index, value) {
                            options += `<option value="${value.id}"  ${res[0].company_id == value.id ? 'selected' : " "}>${value.name}</option>`
                            // $("#tax_edit_company_id").append(`<option value="${value.id}"  ${res[0].company_id == value.id ? 'selected': ' ' }>${value.name}</option>`);
                        });
                        $("#hr_edit_company_id").empty().append(options)
                        $('#hr-edit-name').attr('value', res[0].name)
                        $('#hrDocumentId').attr('value', res[0].id)
                        $('#hrHashedDocumentId').attr('value', res[0].document_id)
                        $('#file-edit-hr').attr('value', res[0].file)
                        let directors = ""
                        let shareholders = ""
                        $.map(res[0].signers, function (value, i) {

                            // $(".corp-sec-edit-director-cc").append(directorEditCCDomLoad(cc))
                            if (value.pivot.user_type == 'director') {

                                directorsEditEmailIds.push(value.id)
                                // console.log(value)
                                directors += ` <div class="directors d-flex">
                                                 <div>
                                                    <p>${value.first_name + " " + (value.last_name!=null?value.last_name:'') + " (" + value.email + ")"}</p>
                                                    <div class="corp-sec-edit-director-cc">
                                                        ${managementCCDomLoad(value.ccs)}
                                                    </div>
                                                </div>
                                                <button type="button" id="hr-director-${value.id}" onclick="editremove(this)" class="btn p-0 ps-3 ms-auto cancel-btn">x</button>
                                              </div>`
                            } else if (value.pivot.user_type == 'shareholder') {
                                // console.log(value.id)
                                shareholdersEditEmailIds.push(value.id)
                                shareholders += ` <div class="shareholders d-flex">
                                                     <div>
                                                        <p>${value.first_name + " " + (value.last_name!=null?value.last_name:'') + " (" + value.email + ")"}</p>
                                                        <div class="corp-sec-edit-shareholder-cc">
                                                            ${managementCCDomLoad(value.ccs)}
                                                        </div>
                                                    </div>
                                                    <button type="button" id="hr-shareholder-${value.id}" onclick="editremove(this)" class="btn p-0 ps-3 ms-auto cancel-btn">x</button>
                                                  </div>`
                            }
                            // console.log('shareholder id:', shareholdersEditEmailIds)
                        });
                        $(directorWrapper).empty().append(directors);
                        $(shareholderWrapper).empty().append(shareholders);
                        getHrEditShareholderAndDirector(res[0].company_id, res[0].signers)
                    }
                }
            });
        }

        function fetchCorpSecViewData(e) {
            let rawId = e
            let id = rawId.split('-')[1]

            let directorWrapper = "#corp-sec-view-director"
            let shareholderWrapper = "#corp-sec-view-shareholder"

            let document_id = id
            let url = '{{route('document.edit', ':document_id')}}'
            url = url.replace(':document_id', document_id)

            $.ajax({
                url: url,
                success: function (res) {
                    if (res.abort == 403) {
                        $('#view-doc').addClass('d-none')
                        $("html, body").animate({scrollTop: 0});
                        $('#flashMessages').html(
                            `<div class="alert alert-success alert-access">
                            <img class="alert-img" src="{{asset('assets/icons/mailbody-!.png')}}" alt="">
                            <p class="alert-text">You do not have access to view the document!</p></div>`
                        )
                        // setTimeout(function () {
                        //     // window.location.href=data.url;
                        //
                        //     window.location.reload()
                        // }, 4000);
                    }
                    //check if document status is completed then hide the edit button from view page
                    if(res[0].status == 'completed'){
                        $('#corp-sec-go-edit').addClass('d-none')
                    }
                    shareholdersViewEmailIds = []
                    directorsViewEmailIds = []
                    //     console.log('response-document-edit:',res)
                    $('#corp_sec_company_name').text(res[0].companies.name)
                    $('#corp_sec_document_name').text(res[0].name)
                    $('#corp_sec_file_name').text(res[0].file)
                    $('#corp-sec-go-edit').attr('id', res[0].id)
                    $('#corpSec-doc-download-btn').attr('data-id', res[0].document_id)
                    $('#corp-temp-url').attr('data-id', res[0].document_id)
                    $('#corp-temp-url').removeClass('d-none')

                    $('#corpSecDocId').attr('value', res[0].id)
                    $('#corpSecHashedDocId').attr('value', res[0].document_id)

                    let directors = ""
                    let shareholders = ""
                    $.map(res[0].signers, function (value, i) {

                        // $(".corp-sec-edit-director-cc").append(directorEditCCDomLoad(cc))
                        if (value.pivot.user_type == 'director') {

                            directorsViewEmailIds.push(value.id)
                            // console.log(value)
                            directors += ` <div class="directors d-flex">
                                             <div>
                                                <p>${value.first_name + " " + (value.last_name!=null?value.last_name:'') + " (" + value.email + ")"}</p>
                                                <div class="corp-sec-edit-director-cc">
                                                    ${managementCCDomLoad(value.ccs)}
                                                </div>
                                            </div>
                                           </div>`
                        } else if (value.pivot.user_type == 'shareholder') {
                            // console.log(value.id)
                            shareholdersViewEmailIds.push(value.id)
                            shareholders += ` <div class="shareholders d-flex">
                                                 <div>
                                                    <p>${value.first_name + " " + (value.last_name!=null?value.last_name:'') + " (" + value.email + ")"}</p>
                                                    <div class="corp-sec-edit-shareholder-cc">
                                                        ${managementCCDomLoad(value.ccs)}
                                                    </div>
                                                </div>
                                              </div>`
                        }
                        // console.log('shareholder id:', shareholdersEditEmailIds)
                    });
                    $(directorWrapper).empty().append(directors);
                    $(shareholderWrapper).empty().append(shareholders);
                }
            });
        }

        function fetchTaxViewData(e) {
            let rawId = e
            let id = rawId.split('-')[1]

            let directorWrapper = "#tax-view-director"
            let shareholderWrapper = "#tax-view-shareholder"

            let document_id = id
            let url = '{{route('document.edit', ':document_id')}}'
            url = url.replace(':document_id', document_id)

            $.ajax({
                url: url,
                success: function (res) {
                    // console.log(res[0])
                    if (res.abort == 403) {
                        $('#tax-view-doc').addClass('d-none')
                        $("html, body").animate({scrollTop: 0});
                        $('#flashMessages').html(
                            `<div class="alert alert-success alert-access">
                                <img class="alert-img" src="{{asset('assets/icons/mailbody-!.png')}}" alt="">
                                <p class="alert-text">Oops! You do not have access to view the document.</p>
                            </div>`
                        )
                        // setTimeout(function () {
                        //     // window.location.href=data.url;
                        //
                        //     window.location.reload()
                        // }, 4000);
                    } else {
                        //check if document status is completed then hide the edit button from view page
                        if(res[0].status == 'completed'){
                            $('#tax-go-edit').addClass('d-none')
                        }
                        shareholdersViewEmailIds = []
                        directorsViewEmailIds = []
                        //     console.log('response-document-edit:',res)
                        //     let options= ''
                        //     $.each(res[1], function(index, value){
                        //         options += `<option value="${value.id}"  ${res[0].company_id == value.id ? 'selected' : " " }>${value.name}</option>`
                        //         // $("#tax_edit_company_id").append(`<option value="${value.id}"  ${res[0].company_id == value.id ? 'selected': ' ' }>${value.name}</option>`);
                        //     });
                        //     $("#hr_edit_company_id").empty().append(options)
                        $('#tax_company_name').text(res[0].companies.name)
                        $('#tax_document_name').text(res[0].name)
                        $('#tax_file_name').text(res[0].file)
                        $('#tax-go-edit').attr('id', res[0].id)
                        $('#tax-temp-url').attr('data-id', res[0].document_id)
                        $('#tax-temp-url').removeClass('d-none')

                        $('#taxDocId').attr('value', res[0].id)
                        $('#taxHashedDocId').attr('value', res[0].document_id)
                        $('#tax-doc-download-btn').attr('data-id', res[0].document_id)

                        let directors = ""
                        let shareholders = ""
                        $.map(res[0].signers, function (value, i) {
                            // $(".corp-sec-edit-director-cc").append(directorEditCCDomLoad(cc))
                            if (value.pivot.user_type == 'director') {
                                directorsViewEmailIds.push(value.id)
                                // console.log(value)
                                directors += ` <div class="directors d-flex">
                                                 <div>
                                                    <p>${value.first_name + " " + (value.last_name!=null?value.last_name:'') + " (" + value.email + ")"}</p>
                                                    <div class="corp-sec-edit-director-cc">
                                                        ${managementCCDomLoad(value.ccs)}
                                                    </div>
                                                </div>
                                               </div>`
                            } else if (value.pivot.user_type == 'shareholder') {
                                // console.log(value.id)
                                shareholdersViewEmailIds.push(value.id)
                                shareholders += ` <div class="shareholders d-flex">
                                                     <div>
                                                        <p>${value.first_name + " " + (value.last_name!=null?value.last_name:'') + " (" + value.email + ")"}</p>
                                                        <div class="corp-sec-edit-shareholder-cc">
                                                            ${managementCCDomLoad(value.ccs)}
                                                        </div>
                                                    </div>
                                                  </div>`
                            }
                            // console.log('shareholder id:', shareholdersEditEmailIds)
                        });
                        $(directorWrapper).empty().append(directors);
                        $(shareholderWrapper).empty().append(shareholders);
                        // getHrShareholderAndDirector(res[0].company_id)
                    }
                }
            })
        }

        function fetchAccViewData(e) {
            let rawId = e
            let id = rawId.split('-')[1]

            let directorWrapper = "#acc-view-director"
            let shareholderWrapper = "#acc-view-shareholder"

            let document_id = id
            let url = '{{route('document.edit', ':document_id')}}'
            url = url.replace(':document_id', document_id)

            $.ajax({
                url: url,
                success: function (res) {
                    if (res.abort == 403) {
                        $('#acc-view-doc').addClass('d-none')
                        $("html, body").animate({scrollTop: 0});
                        $('#flashMessages').html(
                            `<div class="alert alert-success alert-access">
                                <img class="alert-img" src="{{asset('assets/icons/mailbody-!.png')}}" alt="">
                                <p class="alert-text">Oops! You do not have access to view the document!</p>
                            </div>`
                        )
                        // setTimeout(function () {
                        //     // window.location.href=data.url;
                        //
                        //     window.location.reload()
                        // }, 4000);
                    } else {
                        //check if document status is completed then hide the edit button from view page
                        if(res[0].status == 'completed'){
                            $('#acc-go-edit').addClass('d-none')
                        }
                        shareholdersViewEmailIds = []
                        directorsViewEmailIds = []
                        //     console.log('response-document-edit:',res)
                        //     let options= ''
                        //     $.each(res[1], function(index, value){
                        //         options += `<option value="${value.id}"  ${res[0].company_id == value.id ? 'selected' : " " }>${value.name}</option>`
                        //         // $("#tax_edit_company_id").append(`<option value="${value.id}"  ${res[0].company_id == value.id ? 'selected': ' ' }>${value.name}</option>`);
                        //     });
                        //     $("#hr_edit_company_id").empty().append(options)
                        $('#acc_company_name').text(res[0].companies.name)
                        $('#acc_document_name').text(res[0].name)
                        $('#acc_file_name').text(res[0].file)
                        $('#acc-go-edit').attr('id', res[0].id)
                        $('#acc-temp-url').attr('data-id', res[0].document_id)
                        $('#acc-temp-url').removeClass('d-none')

                        $('#accDocId').attr('value', res[0].id)
                        $('#accHashedDocId').attr('value', res[0].document_id)
                        $('#acc-doc-download-btn').attr('data-id', res[0].document_id)

                        let directors = ""
                        let shareholders = ""
                        $.map(res[0].signers, function (value, i) {

                            // $(".corp-sec-edit-director-cc").append(directorEditCCDomLoad(cc))
                            if (value.pivot.user_type == 'director') {
                                directorsViewEmailIds.push(value.id)
                                // console.log(value)
                                directors += ` <div class="directors d-flex">
                                                 <div>
                                                    <p>${value.first_name + " " + (value.last_name!=null?value.last_name:'') + " (" + value.email + ")"}</p>
                                                    <div class="corp-sec-edit-director-cc">
                                                        ${managementCCDomLoad(value.ccs)}
                                                    </div>
                                                </div>
                                              </div>`
                            } else if (value.pivot.user_type == 'shareholder') {
                                // console.log(value.id)
                                shareholdersViewEmailIds.push(value.id)
                                shareholders += ` <div class="shareholders d-flex">
                                                     <div>
                                                        <p>${value.first_name + " " + (value.last_name!=null?value.last_name:'') + " (" + value.email + ")"}</p>
                                                        <div class="corp-sec-edit-shareholder-cc">
                                                            ${managementCCDomLoad(value.ccs)}
                                                        </div>
                                                    </div>
                                                  </div>`
                            }
                            // console.log('shareholder id:', shareholdersEditEmailIds)
                        });
                        $(directorWrapper).empty().append(directors);
                        $(shareholderWrapper).empty().append(shareholders);
                        // getHrShareholderAndDirector(res[0].company_id)
                    }
                }
            });
        }

        function fetchHrViewData(e) {
            let rawId = e
            let id = rawId.split('-')[1]

            let directorWrapper = "#hr-view-director"
            let shareholderWrapper = "#hr-view-shareholder"

            let document_id = id
            let url = '{{route('document.edit', ':document_id')}}'
            url = url.replace(':document_id', document_id)

            $.ajax({
                url: url,
                success: function (res) {
                    if (res.abort == 403) {
                        $('#hr-view-doc').addClass('d-none')
                        $("html, body").animate({scrollTop: 0});
                        $('#flashMessages').html(
                            `<div class="alert alert-success alert-access">
                                <img class="alert-img" src="{{asset('assets/icons/mailbody-!.png')}}" alt="">
                                <p class="alert-text">Oops! You do not have access to view the document.</p>
                            </div>`
                        )
                        // setTimeout(function () {
                        //     // window.location.href=data.url;
                        //
                        //     window.location.reload()
                        // }, 4000);
                    } else {
                        //check if document status is completed then hide the edit button from view page
                        if(res[0].status == 'completed'){
                            $('#hr-go-edit').addClass('d-none')
                        }
                        shareholdersViewEmailIds = []
                        directorsViewEmailIds = []
                        //     console.log('response-document-edit:',res)
                        //     let options= ''
                        //     $.each(res[1], function(index, value){
                        //         options += `<option value="${value.id}"  ${res[0].company_id == value.id ? 'selected' : " " }>${value.name}</option>`
                        //         // $("#tax_edit_company_id").append(`<option value="${value.id}"  ${res[0].company_id == value.id ? 'selected': ' ' }>${value.name}</option>`);
                        //     });
                        //     $("#hr_edit_company_id").empty().append(options)
                        $('#hr_company_name').text(res[0].companies.name)
                        $('#hr_document_name').text(res[0].name)
                        $('#hr_file_name').text(res[0].file)
                        $('#hr-go-edit').attr('id', res[0].id)
                        $('#hr-temp-url').attr('data-id', res[0].document_id)
                        $('#hr-temp-url').removeClass('d-none')
                        $('#hrDocId').attr('value', res[0].id)
                        $('#hrHashedDocId').attr('value', res[0].document_id)
                        $('#hr-doc-download-btn').attr('data-id', res[0].document_id)

                        let directors = ""
                        let shareholders = ""
                        $.map(res[0].signers, function (value, i) {
                            // $(".corp-sec-edit-director-cc").append(directorEditCCDomLoad(cc))
                            if (value.pivot.user_type == 'director') {
                                directorsViewEmailIds.push(value.id)
                                // console.log(value)
                                directors += ` <div class="directors d-flex">
                                                 <div>
                                                    <p>${value.first_name + " " + (value.last_name!=null?value.last_name:'') + " (" + value.email + ")"}</p>
                                                    <div class="corp-sec-edit-director-cc">
                                                        ${managementCCDomLoad(value.ccs)}
                                                    </div>
                                                </div>
                                               </div>`
                            } else if (value.pivot.user_type == 'shareholder') {
                                // console.log(value.id)
                                shareholdersViewEmailIds.push(value.id)
                                shareholders += ` <div class="shareholders d-flex">
                                                     <div>
                                                        <p>${value.first_name + " " + (value.last_name!=null?value.last_name:'') + " (" + value.email + ")"}</p>
                                                        <div class="corp-sec-edit-shareholder-cc">
                                                            ${managementCCDomLoad(value.ccs)}
                                                        </div>
                                                    </div>
                                                  </div>`
                            }
                            // console.log('shareholder id:', shareholdersEditEmailIds)
                        });
                        $(directorWrapper).empty().append(directors);
                        $(shareholderWrapper).empty().append(shareholders);
                    }
                }
            });
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



        function getCorpSecShareholderAndDirector(company_id) {
            let url = '{{route('fetch', ':company_id')}}'
            url = url.replace(':company_id', company_id)
            $.ajax({
                url: url,
                success: function (res) {
                    // console.log('response:', res)
                    $("#corp-sec-edit-director-modal").html(res.directors.map((item) =>
                        directorModalDomLoad(item)
                    ))
                    $("#corp-sec-edit-shareholder-modal").html(res.shareholders.map((item) =>
                        shareholderModalDomLoad(item)
                    ))
                }
            });
        }

        function getCorpSecEditShareholderAndDirector(company_id, signers) {
            let url = '{{route('fetch', ':company_id')}}'
            url = url.replace(':company_id', company_id)
            $.ajax({
                url: url,
                success: function (res) {
                    // console.log('signers:', signers)
                    let directorsArr = []
                    let shareholdersArr = []
                    $.map(signers, function (value, i) {
                        if (value.pivot.user_type == 'director') {
                            directorsArr.push(value)
                        } else {
                            shareholdersArr.push(value)
                        }
                    })
                    // $("#corp-sec-edit-director-modal").html(res.directors.map((item) =>
                    //     directorModalDomLoad(item)
                    // ))
                    let directors = ""
                    let shareholders = ""
                    $.map(res.directors, function (value, i) {
                        // console.log(directorsArr.findIndex(y =>  y.id===value.id))
                        //     directorsEditEmailIds.push(value.id)
                        // console.log(signer)
                        let disableCheckbox = ' onclick="this.checked=!this.checked;"'
                        directors += `<div class="directors d-flex">
                                        <div class="col-md-2 col-sm-1 col-1">
                                            <input type="checkbox" class="select-checkbox" name="directors[]" value="${value.id}" ${directorsArr.findIndex(x => x.id === value.id) >= 0 ? 'checked' + disableCheckbox : ''}/>
                                        </div>
                                        <div class="col-md-10 col-sm-11 col-11">
                                            <p>${value.first_name + " " + (value.last_name!=null?value.last_name:'') + " (" + value.email + ")"}</p>` +
                                                managementCCDomLoad(value.ccs) +
                                        `</div>
                                       </div>`
                    })
                    $.map(res.shareholders, function (shareholder, i) {

                        // console.log(shareholder)
                        //     shareholdersEditEmailIds.push(shareholder.id)
                        // signers.findIndex(y =>  console.log(y.id==shareholder.id))
                        let disableCheckbox = ' onclick="this.checked=!this.checked;"'
                        shareholders += `<div class="shareholders d-flex">
                                            <div class="col-md-2 col-sm-1 col-1">
                                                <input type="checkbox" class="select-checkbox" name="shareholders[]" value="${shareholder.id}" ${shareholdersArr.findIndex(y => y.id === shareholder.id) >= 0 ? 'checked' + disableCheckbox : ''}/>
                                            </div>
                                            <div class="col-md-10 col-sm-11 col-11">
                                                <p>${shareholder.first_name + " " + (shareholder.last_name!=null?shareholder.last_name:'') + " (" + shareholder.email + ")"}</p>` +
                                                    managementCCDomLoad(shareholder.ccs) +
                                            `</div>
                                         </div>`
                    })
                    $("#corp-sec-edit-director-modal").empty().append(directors)
                    $("#corp-sec-edit-shareholder-modal").empty().append(shareholders)
                    // $("#corp-sec-edit-shareholder-modal").html(res.shareholders.map((item) =>
                    //     shareholderModalDomLoad(item)
                    // ))
                }
            });
        }


        function getTaxShareholderAndDirector(company_id) {
            let url = '{{route('fetch', ':company_id')}}'
            url = url.replace(':company_id', company_id)
            $.ajax({
                url: url,
                success: function (res) {
                    // console.log('response:', res)
                    $("#tax-edit-director-modal").html(res.directors.map((item) =>
                        directorModalDomLoad(item)
                    ))
                    $("#tax-edit-shareholder-modal").html(res.shareholders.map((item) =>
                        shareholderModalDomLoad(item)
                    ))
                }
            });
        }

        function getTaxEditShareholderAndDirector(company_id, signers) {
            let url = '{{route('fetch', ':company_id')}}'
            url = url.replace(':company_id', company_id)
            $.ajax({
                url: url,
                success: function (res) {
                    // console.log('signers:', signers)
                    let directorsArr = []
                    let shareholdersArr = []
                    $.map(signers, function (value, i) {
                        if (value.pivot.user_type == 'director') {
                            directorsArr.push(value)
                        } else {
                            shareholdersArr.push(value)
                        }
                    })
                    // $("#corp-sec-edit-director-modal").html(res.directors.map((item) =>
                    //     directorModalDomLoad(item)
                    // ))
                    let directors = ""
                    let shareholders = ""
                    $.map(res.directors, function (value, i) {
                        let disableCheckbox = ' onclick="this.checked=!this.checked;"'
                        directors += `<div class="directors d-flex">
                                        <div class="col-md-2 col-sm-1 col-1">
                                            <input type="checkbox" class="select-checkbox" name="directors[]" value="${value.id}" ${directorsArr.findIndex(x => x.id === value.id) >= 0 ? 'checked' + disableCheckbox : ''}/>
                                        </div>
                                        <div class="col-md-10 col-sm-11 col-11">
                                            <p>${value.first_name + " " + (value.last_name!=null?value.last_name:'') + " (" + value.email + ")"}</p>` +
                                        managementCCDomLoad(value.ccs) +
                                        `</div>
                                       </div>`
                    })
                    $.map(res.shareholders, function (shareholder, i) {
                        // console.log(shareholder)
                        //     shareholdersEditEmailIds.push(shareholder.id)
                        // signers.findIndex(y =>  console.log(y.id==shareholder.id))
                        let disableCheckbox = ' onclick="this.checked=!this.checked;"'
                        shareholders += `<div class="shareholders d-flex">
                                            <div class="col-md-2 col-sm-1 col-1">
                                                <input type="checkbox" class="select-checkbox" name="shareholders[]" value="${shareholder.id}" ${shareholdersArr.findIndex(y => y.id === shareholder.id) >= 0 ? 'checked' + disableCheckbox : ''}/>
                                            </div>
                                            <div class="col-md-10 col-sm-11 col-11">
                                                <p>${shareholder.first_name + " " + (shareholder.last_name!=null?shareholder.last_name:'') + " (" + shareholder.email + ")"}</p>` +
                                                    managementCCDomLoad(shareholder.ccs) +
                                            `</div>
                                          </div>`
                    })
                    $("#tax-edit-director-modal").empty().append(directors)
                    $("#tax-edit-shareholder-modal").empty().append(shareholders)
                    // $("#corp-sec-edit-shareholder-modal").html(res.shareholders.map((item) =>
                    //     shareholderModalDomLoad(item)
                    // ))
                }

            });
        }

        function getAccShareholderAndDirector(company_id) {
            let url = '{{route('fetch', ':company_id')}}'
            url = url.replace(':company_id', company_id)
            $.ajax({
                url: url,
                success: function (res) {
                    // console.log('response:', res)
                    $("#acc-edit-director-modal").html(res.directors.map((item) =>
                        directorModalDomLoad(item)
                    ))
                    $("#acc-edit-shareholder-modal").html(res.shareholders.map((item) =>
                        shareholderModalDomLoad(item)
                    ))
                }
            });
        }

        function getAccEditShareholderAndDirector(company_id, signers) {
            let url = '{{route('fetch', ':company_id')}}'
            url = url.replace(':company_id', company_id)
            $.ajax({
                url: url,
                success: function (res) {
                    // console.log('signers:', signers)
                    let directorsArr = []
                    let shareholdersArr = []
                    $.map(signers, function (value, i) {
                        if (value.pivot.user_type == 'director') {
                            directorsArr.push(value)
                        } else {
                            shareholdersArr.push(value)
                        }
                    })
                    // $("#corp-sec-edit-director-modal").html(res.directors.map((item) =>
                    //     directorModalDomLoad(item)
                    // ))
                    let directors = ""
                    let shareholders = ""
                    $.map(res.directors, function (value, i) {
                        let disableCheckbox = ' onclick="this.checked=!this.checked;"'
                        // console.log(directorsArr.findIndex(y =>  y.id===value.id))
                        //     directorsEditEmailIds.push(value.id)
                        // console.log(signer)
                        directors += `<div class="directors d-flex">
                                        <div class="col-md-2 col-sm-1 col-1">
                                            <input type="checkbox" class="select-checkbox" name="directors[]" value="${value.id}" ${directorsArr.findIndex(x => x.id === value.id) >= 0 ? 'checked' + disableCheckbox : ''}/>
                                        </div>
                                        <div class="col-md-10 col-sm-11 col-11">
                                            <p>${value.first_name + " " + (value.last_name!=null?value.last_name:'') + " (" + value.email + ")"}</p>` +
                                                managementCCDomLoad(value.ccs) +
                                        `</div>
                                       </div>`
                    })
                    $.map(res.shareholders, function (shareholder, i) {
                        // console.log(shareholder)
                        //     shareholdersEditEmailIds.push(shareholder.id)
                        // signers.findIndex(y =>  console.log(y.id==shareholder.id))
                        let disableCheckbox = ' onclick="this.checked=!this.checked;"'
                        shareholders += `<div class="shareholders d-flex">
                                            <div class="col-md-2 col-sm-1 col-1">
                                                <input type="checkbox" class="select-checkbox" name="shareholders[]" value="${shareholder.id}" ${shareholdersArr.findIndex(y => y.id === shareholder.id) >= 0 ? 'checked' + disableCheckbox : ''}/>
                                            </div>
                                            <div class="col-md-10 col-sm-11 col-11">
                                                <p>${shareholder.first_name + " " + (shareholder.last_name!=null?shareholder.last_name:'') + " (" + shareholder.email + ")"}</p>` +
                                                managementCCDomLoad(shareholder.ccs) +
                                            `</div>
                                         </div>`
                    })
                    $("#acc-edit-director-modal").empty().append(directors)
                    $("#acc-edit-shareholder-modal").empty().append(shareholders)
                    // $("#corp-sec-edit-shareholder-modal").html(res.shareholders.map((item) =>
                    //     shareholderModalDomLoad(item)
                    // ))
                }
            });
        }

        function getHrShareholderAndDirector(company_id) {
            let url = '{{route('fetch', ':company_id')}}'
            url = url.replace(':company_id', company_id)
            $.ajax({
                url: url,
                success: function (res) {
                    // console.log('response:', res)
                    $("#hr-edit-director-modal").html(res.directors.map((item) =>
                        directorModalDomLoad(item)
                    ))
                    $("#hr-edit-shareholder-modal").html(res.shareholders.map((item) =>
                        shareholderModalDomLoad(item)
                    ))
                }
            });
        }

        function getHrEditShareholderAndDirector(company_id, signers) {
            let url = '{{route('fetch', ':company_id')}}'
            url = url.replace(':company_id', company_id)
            $.ajax({
                url: url,
                success: function (res) {
                    // console.log('signers:', signers)
                    let directorsArr = []
                    let shareholdersArr = []
                    $.map(signers, function (value, i) {
                        if (value.pivot.user_type == 'director') {
                            directorsArr.push(value)
                        } else {
                            shareholdersArr.push(value)
                        }
                    })
                    // $("#corp-sec-edit-director-modal").html(res.directors.map((item) =>
                    //     directorModalDomLoad(item)
                    // ))
                    let directors = ""
                    let shareholders = ""
                    $.map(res.directors, function (value, i) {
                        let disableCheckbox = ' onclick="this.checked=!this.checked;"'
                        // console.log(directorsArr.findIndex(y =>  y.id===value.id))
                        //     directorsEditEmailIds.push(value.id)
                        // console.log(signer)
                        directors += `<div class="directors d-flex">
                                        <div class="col-md-2 col-sm-1 col-1">
                                            <input type="checkbox" class="select-checkbox" name="directors[]" value="${value.id}" ${directorsArr.findIndex(x => x.id === value.id) >= 0 ? 'checked' + disableCheckbox : ''}/>
                                        </div>
                                        <div class="col-md-10 col-sm-11 col-11">
                                            <p>${value.first_name + " " + (value.last_name!=null?value.last_name:'') + " (" + value.email + ")"}</p>` +
                                            managementCCDomLoad(value.ccs) +
                                        `</div>
                                     </div>`
                    })
                    $.map(res.shareholders, function (shareholder, i) {
                        // console.log(shareholder)
                        //     shareholdersEditEmailIds.push(shareholder.id)
                        // signers.findIndex(y =>  console.log(y.id==shareholder.id))
                        let disableCheckbox = ' onclick="this.checked=!this.checked;"'
                        shareholders += `<div class="shareholders d-flex">
                                            <div class="col-md-2 col-sm-1 col-1">
                                                <input type="checkbox" class="select-checkbox" name="shareholders[]" value="${shareholder.id}" ${shareholdersArr.findIndex(y => y.id === shareholder.id) >= 0 ? 'checked' + disableCheckbox : ''}/>
                                            </div>
                                            <div class="col-md-10 col-sm-11 col-11">
                                                <p>${shareholder.first_name + " " + (shareholder.last_name != null ? shareholder.last_name : '') + " (" + shareholder.email + ")"}</p>` +
                                                managementCCDomLoad(shareholder.ccs) +
                                            `</div>
                                         </div>`
                    })
                    $("#hr-edit-director-modal").empty().append(directors)
                    $("#hr-edit-shareholder-modal").empty().append(shareholders)
                    // $("#corp-sec-edit-shareholder-modal").html(res.shareholders.map((item) =>
                    //     shareholderModalDomLoad(item)
                    // ))
                }
            });
        }


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        });
        //form submit start
        $("#corp-sec-submit").on('click', function (e) {
            $('#corp-sec-send').prop('disabled', true);

            $('.corpSec-company_id').text('')
            $('.corpSec-name').text('')
            $('.corpSec-file').text('')
            $('#corpSecNoSignerAlert').text('')
            // alert($('input[name="shareholder[]"]').val().length); return;
            let shareholder = $('#shareholdersId').val().length;
            let director = $('#directorsId').val().length;
            // console.log(shareholder)
            // console.log(director)
            if (director < 1 && shareholder < 1) {
                $('#corpSecNoSignerAlert').text('* Minimum One Director Or Shareholder Is Required')
                $('#corp-sec-send').prop('disabled', false)
                return false;
            }
            let form = $("#corp-sec-doc-upload")[0];
            var formData = new FormData(form);
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "{{route('upload.document')}}",
                // data: $('#corp-sec-doc-upload').serialize(),
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function () {
                    $("#CorpSecLoadingDiv").show();
                },
                success: function (data) {
                    $("#CorpSecLoadingDiv").hide();
                    if (data.success == 1) {
                        $("html, body").animate({scrollTop: 0});
                        $('#flashMessages').html(
                            `<div class="alert alert-success">
                                <img class="alert-img" src="{{asset('assets/icons/success-alert-icon.png')}}" alt="">
                                <p class="alert-text">${data.message}</p>
                            </div>`
                        )
                        // openInNewTab(data.url);
                        // window.open(data.url)
                        setTimeout(function () {
                            // window.location.href=data.url;
                            window.location.reload()
                        }, 4000);
                        // $(".alert-text").html(response.message);
                    } else if (data.abort == 403) {
                        $("#corp-sec-send").prop('disabled', false);
                        $("html, body").animate({scrollTop: 0});
                        $('#flashMessages').html(
                            `<div class="alert alert-success login-alert-error">
                            <img class="alert-img" src="{{asset('assets/icons/mailbody-!.png')}}" alt="">
                            <p class="alert-text">${data.message}</p></div>`
                        )
                        // setTimeout(function () {
                        //     // window.location.href=data.url;
                        //
                        //     window.location.reload()
                        // }, 4000);
                    }
                },
                error: function (xhr) {
                    // console.log(xhr.responseJSON.hasOwnProperty('errors'))
                    $("#CorpSecLoadingDiv").hide();
                    $("#corp-sec-send").prop('disabled', false);
                    // alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
                    // alert(xhr.responseText);
                    if (xhr.responseJSON.hasOwnProperty('errors') == true) {
                        $.each(xhr.responseJSON.errors, function (key, value) {
                            // console.log('key:', key)
                            // console.log('value:', value)
                            $('.corpSec-' + key).text(value);
                        });
                    } else {
                        $("html, body").animate({scrollTop: 0});
                        $('#flashMessages').html(
                            `<div class="alert alert-success alert-access">
                                <img class="alert-img" src="{{asset('assets/icons/mailbody-!.png')}}" alt="">
                                <p class="alert-text">${xhr.responseJSON.message}</p>
                            </div>`
                        )
                    }
                }
            });
            // console.log($('#corp-sec-doc-upload').serialize())
        })

        $("#corp-sec-edit-submit").on('click', function (e) {
            $('#corp-sec-edit-send').prop('disabled', true)

            $('.corpSec-edit-company_id').text('')
            $('.corpSec-edit-name').text('')
            $('.corpSec-edit-file').text('')
            $('#corpSecEditNoSignerAlert').text('')
            let shareholder = $('#corpSecEditShareholdersId').val().length;
            let director = $('#corpSecEditDirectorsId').val().length;
            if (director < 1 && shareholder < 1) {
                $('#corpSecEditNoSignerAlert').text('* Minimum One Director Or Shareholder Is Required')
                $('#corp-sec-edit-send').prop('disabled', false)
                return false;
            }
            let form = $("#corp-sec-edit-doc")[0];
            var formData = new FormData(form);
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "{{route('edit.document')}}",
                // data: $('#corp-sec-doc-upload').serialize(),
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function () {
                    $("#CorpSecEditLoadingDiv").show();
                },
                success: function (data) {
                    $("#CorpSecEditLoadingDiv").hide();
                    if (data.success == 1) {
                        $("html, body").animate({scrollTop: 0});
                        $('#flashMessages').html(
                            `<div class="alert alert-success">
                                <img class="alert-img" src="{{asset('assets/icons/success-alert-icon.png')}}" alt="">
                                <p class="alert-text">Document Uploaded Successfully</p>
                            </div>`
                        )
                        // window.open(data.url)
                        setTimeout(function () {
                            window.location.reload()
                        }, 4000);
                    } else if (data.abort == 403) {
                        $("html, body").animate({scrollTop: 0});
                        $('#flashMessages').html(
                            `<div class="alert alert-success alert-access">
                                <img class="alert-img" src="{{asset('assets/icons/mailbody-!.png')}}" alt="">
                                <p class="alert-text">${data.message}</p>
                            </div>`
                        )
                        $('#corp-sec-edit-send').prop('disabled', false)
                    }else if (data.uneditable == true) {
                        $("html, body").animate({scrollTop: 0});
                        $('#flashMessages').html(
                            `<div class="alert alert-success alert-access">
                                <img class="alert-img" src="{{asset('assets/icons/mailbody-!.png')}}" alt="">
                                <p class="alert-text">${data.message}</p>
                            </div>`
                        )
                        $('#corp-sec-edit-send').prop('disabled', false)
                    }
                },
                error: function (xhr) {
                    $('#corp-sec-edit-send').prop('disabled', false)
                    $("#CorpSecEditLoadingDiv").hide();
                    if (xhr.responseJSON.hasOwnProperty('errors') == true) {
                        $.each(xhr.responseJSON.errors, function (key, value) {
                            $('.corpSec-edit-' + key).text(value);
                        });
                    } else {
                        $("html, body").animate({scrollTop: 0});
                        $('#flashMessages').html(
                            `<div class="alert alert-success alert-access">
                                <img class="alert-img" src="{{asset('assets/icons/mailbody-!.png')}}" alt="">
                                <p class="alert-text">${xhr.responseJSON.message}</p>
                            </div>`
                        )
                    }
                    // alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
                }
            });
            // console.log($('#corp-sec-doc-upload').serialize())
        })
        $('#corp-sec-submit-mail').on('click', function (e) {
            $('#corp-sec-send-mail').prop('disabled', true)
            let url = "{{route('invite', ':document_id')}}"
            let document_id = $('#corpSecHashedDocId').val()
            url = url.replace(':document_id', document_id)

            let form = $("#corp-sec-view-form")[0];
            var formData = new FormData(form);
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: url,
                // data: $('#corp-sec-doc-upload').serialize(),
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function () {
                    $("#CorpSecSendMailLoadingDiv").show();
                },
                success: function (data) {
                    // console.log(data.abort)
                    $("#CorpSecSendMailLoadingDiv").hide();
                    if (data.success == 1) {
                        $("html, body").animate({scrollTop: 0});
                        $('#flashMessages').html(
                            `<div class="alert alert-success">
                                <img class="alert-img" src="{{asset('assets/icons/success-alert-icon.png')}}" alt="">
                                <p class="alert-text">Email invitations send successfully</p>
                            </div>`
                        )
                        setTimeout(function () {
                            window.location.reload();
                        }, 2000);
                        // $(".alert-text").html(response.message);
                    } else if (data.abort == 403) {
                        $('#corp-sec-send-mail').prop('disabled', false)
                        $("html, body").animate({scrollTop: 0});
                        $('#flashMessages').html(
                            `<div class="alert alert-success alert-access">
                                <img class="alert-img" src="{{asset('assets/icons/mailbody-!.png')}}" alt="">
                                <p class="alert-text">${data.message}</p>
                            </div>`
                        )
                    }else{
                        $('#corp-sec-send-mail').prop('disabled', false)
                        $("html, body").animate({scrollTop: 0});
                        $('#flashMessages').html(
                            `<div class="alert alert-success alert-access">
                                <img class="alert-img" src="{{asset('assets/icons/mailbody-!.png')}}" alt="">
                                <p class="alert-text">${data.message}</p>
                            </div>`
                        )
                    }
                },
                error: function (xhr, res) {
                    $('#corp-sec-send-mail').prop('disabled', false)
                    $("#CorpSecSendMailLoadingDiv").hide();
                    if (xhr.status == 500) {
                        $('#corp-sec-send-mail').prop('disabled', false)
                        $("html, body").animate({scrollTop: 0});
                        $('#flashMessages').html(
                            `<div class="alert alert-success alert-access">
                                <img class="alert-img" src="{{asset('assets/icons/close.png')}}" alt="">
                                <p class="alert-text">Something went wrong! Please try again later.</p>
                            </div>`
                        )
                    }
                    // alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
                }
            });

        })

        $("#tax-submit").on('click', function (e) {
            $('#tax-send').prop('disabled', true)
            let shareholder = $('#taxShareholdersId').val().length;
            let director = $('#taxDirectorsId').val().length;
            if (director < 1 && shareholder < 1) {
                $('#taxNoSignerAlert').text('* Minimum One Director Or Shareholder Is Required')
                $('#tax-send').prop('disabled', false)
                return false;
            }
            let form = $("#tax-doc-upload")[0];
            var formData = new FormData(form);
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "{{route('upload.document')}}",
                // data: $('#corp-sec-doc-upload').serialize(),
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function () {
                    $("#TaxLoadingDiv").show();
                },
                success: function (data) {
                    $("#TaxLoadingDiv").hide();
                    if (data.success == 1) {
                        $("html, body").animate({scrollTop: 0});
                        $('#flashMessages').html(
                            `<div class="alert alert-success">
                                <img class="alert-img" src="{{asset('assets/icons/success-alert-icon.png')}}" alt="">
                                <p class="alert-text">Document Uploaded Successfully</p>
                            </div>`
                        )
                        // window.open(data.url)
                        setTimeout(function () {
                            window.location.reload()
                        }, 4000);
                        // $(".alert-text").html(response.message);
                    } else if (data.abort == 403) {
                        $('#tax-send').prop('disabled', false)
                        $("html, body").animate({scrollTop: 0});
                        $('#flashMessages').html(
                            `<div class="alert alert-success alert-access">
                                <img class="alert-img" src="{{asset('assets/icons/mailbody-!.png')}}" alt="">
                                <p class="alert-text">${data.message}</p>
                            </div>`
                        )
                        // setTimeout(function () {
                        //     // window.location.href=data.url;
                        //
                        //     window.location.reload()
                        // }, 4000);
                    }
                },
                error: function (xhr) {
                    $('#tax-send').prop('disabled', false)
                    $("#TaxLoadingDiv").hide();
                    if (xhr.responseJSON.hasOwnProperty('errors') == true) {
                        $.each(xhr.responseJSON.errors, function (key, value) {
                            // console.log('key:', key)
                            // console.log('value:', value)
                            $('.tax-' + key).text(value);
                        });
                    } else {
                        $("html, body").animate({scrollTop: 0});
                        $('#flashMessages').html(
                            `<div class="alert alert-success alert-access">
                                <img class="alert-img" src="{{asset('assets/icons/mailbody-!.png')}}" alt="">
                                <p class="alert-text">${xhr.responseJSON.message}</p>
                            </div>`
                        )
                    }

                    // alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
                }
            });
        })
        $("#tax-edit-submit").on('click', function (e) {
            $('#tax-edit-send').prop('disabled', true)
            let shareholder = $('#taxEditShareholdersId').val().length;
            let director = $('#taxEditDirectorsId').val().length;
            if (director < 1 && shareholder < 1) {
                $('#taxEditNoSignerAlert').text('* Minimum One Director Or Shareholder Is Required')
                $('#tax-edit-send').prop('disabled', false)
                return false;
            }
            let form = $("#tax-edit-doc-upload")[0];
            var formData = new FormData(form);

            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "{{route('edit.document')}}",
                // data: $('#corp-sec-doc-upload').serialize(),
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function () {
                    $("#TaxEditLoadingDiv").show();
                },
                success: function (data) {
                    $("#TaxEditLoadingDiv").hide();
                    if (data.success == 1) {
                        $("html, body").animate({scrollTop: 0});
                        $('#flashMessages').html(
                            `<div class="alert alert-success">
                                <img class="alert-img" src="{{asset('assets/icons/success-alert-icon.png')}}" alt="">
                                <p class="alert-text">Document Uploaded Successfully</p>
                            </div>`
                        )
                        // window.open(data.url)
                        setTimeout(function () {
                            // window.location.href=data.url;
                            // if(data.response.document_id != $('#taxHashedDocumentId').val()){

                            // }
                            window.location.reload()
                        }, 4000);
                        // $(".alert-text").html(response.message);
                    } else if (data.abort == 403) {
                        $('#tax-edit-send').prop('disabled', false)
                        $("html, body").animate({scrollTop: 0});
                        $('#flashMessages').html(
                            `<div class="alert alert-success alert-access">
                                <img class="alert-img" src="{{asset('assets/icons/mailbody-!.png')}}" alt="">
                                <p class="alert-text">${data.message}</p>
                            </div>`
                        )
                        // setTimeout(function () {
                        //     window.location.reload()
                        // }, 4000);
                    }
                },
                error: function (xhr) {
                    $("#TaxEditLoadingDiv").hide();
                    $('#tax-edit-send').prop('disabled', false)
                    if (xhr.responseJSON.hasOwnProperty('errors') == true) {
                        $.each(xhr.responseJSON.errors, function (key, value) {
                            $('.tax-edit-' + key).text(value);
                        });
                    } else {
                        $("html, body").animate({scrollTop: 0});
                        $('#flashMessages').html(
                            `<div class="alert alert-success alert-access">
                                <img class="alert-img" src="{{asset('assets/icons/mailbody-!.png')}}" alt="">
                                <p class="alert-text">${xhr.responseJSON.message}</p>
                            </div>`
                        )
                    }

                    // alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
                }
            });
        })
        $('#tax-submit-mail').on('click', function (e) {
            $('#tax-send-mail').prop('disabled', true)
            let url = "{{route('invite', ':document_id')}}"
            let document_id = $('#taxHashedDocId').val()
            url = url.replace(':document_id', document_id)

            let form = $("#tax-view-form")[0];
            var formData = new FormData(form);
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: url,
                // data: $('#corp-sec-doc-upload').serialize(),
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function () {
                    $("#TaxSendMailLoadingDiv").show();
                },
                success: function (data) {
                    $("#TaxSendMailLoadingDiv").hide();
                    if (data.success == 1) {
                        $("html, body").animate({scrollTop: 0});
                        $('#flashMessages').html(
                            `<div class="alert alert-success">
                                <img class="alert-img" src="{{asset('assets/icons/success-alert-icon.png')}}" alt="">
                                <p class="alert-text">Email invitations send successfully</p>
                            </div>`
                        )
                        setTimeout(function () {
                            window.location.reload();
                        }, 2000);
                        // $(".alert-text").html(response.message);
                    } else if (data.abort == 403) {
                        $('#tax-send-mail').prop('disabled', false)
                        $("html, body").animate({scrollTop: 0});
                        $('#flashMessages').html(
                            `<div class="alert alert-success alert-access">
                                <img class="alert-img" src="{{asset('assets/icons/mailbody-!.png')}}" alt="">
                                <p class="alert-text">${data.message}</p>
                            </div>`
                        )
                        // setTimeout(function () {
                        //     window.location.reload()
                        // }, 4000);
                    }else{
                        $('#corp-sec-send-mail').prop('disabled', false)
                        $("html, body").animate({scrollTop: 0});
                        $('#flashMessages').html(
                            `<div class="alert alert-success alert-access">
                                <img class="alert-img" src="{{asset('assets/icons/mailbody-!.png')}}" alt="">
                                <p class="alert-text">${data.message}</p>
                            </div>`
                        )
                    }
                },
                error: function (xhr) {
                    $("#TaxSendMailLoadingDiv").hide();
                    $('#tax-send-mail').prop('disabled', false)
                    // alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
                }
            });

        })

        $("#acc-submit").on('click', function (e) {
            $('#acc-send').prop('disabled', true)
            let shareholder = $('#accShareholdersId').val().length;
            let director = $('#accDirectorsId').val().length;
            if (director < 1 && shareholder < 1) {
                $('#accNoSignerAlert').text('* Minimum One Director Or Shareholder Is Required')
                $('#acc-send').prop('disabled', false)
                return false;
            }
            let form = $("#acc-doc-upload")[0];
            var formData = new FormData(form);
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "{{route('upload.document')}}",
                // data: $('#corp-sec-doc-upload').serialize(),
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function () {
                    $("#AccLoadingDiv").show();
                },
                success: function (data) {
                    $("#AccLoadingDiv").hide();
                    if (data.success == 1) {
                        $("html, body").animate({scrollTop: 0});
                        $('#flashMessages').html(
                            `<div class="alert alert-success">
                                <img class="alert-img" src="{{asset('assets/icons/success-alert-icon.png')}}" alt="">
                                <p class="alert-text">Document Uploaded Successfully</p>
                            </div>`
                        )
                        // window.open(data.url)
                        setTimeout(function () {
                            // window.location.href=data.url;

                            window.location.reload()
                        }, 4000);
                        // $(".alert-text").html(response.message);
                    } else if (data.abort == 403) {
                        $('#acc-send').prop('disabled', false)
                        $("html, body").animate({scrollTop: 0});
                        $('#flashMessages').html(
                            `<div class="alert alert-success alert-access">
                                <img class="alert-img" src="{{asset('assets/icons/mailbody-!.png')}}" alt="">
                                <p class="alert-text">${data.message}</p>
                            </div>`
                        )
                        // setTimeout(function () {
                        //     // window.location.href=data.url;
                        //
                        //     window.location.reload()
                        // }, 4000);
                    }
                },
                error: function (xhr) {
                    $('#acc-send').prop('disabled', false)
                    $("#AccLoadingDiv").hide();
                    if (xhr.responseJSON.hasOwnProperty('errors') == true) {
                        $.each(xhr.responseJSON.errors, function (key, value) {
                            $('.acc-' + key).text(value);
                        });
                    } else {
                        $("html, body").animate({scrollTop: 0});
                        $('#flashMessages').html(
                            `<div class="alert alert-success alert-access">
                                <img class="alert-img" src="{{asset('assets/icons/mailbody-!.png')}}" alt="">
                                <p class="alert-text">${xhr.responseJSON.message}</p>
                            </div>`

                        )
                    }

                    // alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
                }
            });

        })
        $("#acc-edit-submit").on('click', function (e) {
            $('#acc-edit-send').prop('disabled', true)
            let shareholder = $('#accEditShareholdersId').val().length;
            let director = $('#accEditDirectorsId').val().length;
            if (director < 1 || shareholder < 1) {
                $('#accEditNoSignerAlert').text('* Minimum One Director Or Shareholder Is Required')
                $('#acc-edit-send').prop('disabled', false)
                return false;
            }
            let form = $("#acc-edit-doc-upload")[0];
            var formData = new FormData(form);

            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "{{route('edit.document')}}",
                // data: $('#corp-sec-doc-upload').serialize(),
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function () {
                    $("#AccEditLoadingDiv").show();
                },
                success: function (data) {
                    $("#AccEditLoadingDiv").hide();
                    if (data.success == 1) {
                        $("html, body").animate({scrollTop: 0});
                        $('#flashMessages').html(
                            `<div class="alert alert-success">
                            <img class="alert-img" src="{{asset('assets/icons/success-alert-icon.png')}}" alt="">
                            <p class="alert-text">Document Uploaded Successfully</p></div>`
                        )
                        // window.open(data.url)
                        setTimeout(function () {
                            // window.location.href=data.url;
                            // if(data.response.document_id != $('#accHashedDocumentId').val()){

                            // }
                            window.location.reload()
                        }, 4000);
                        // $(".alert-text").html(response.message);
                    } else if (data.abort == 403) {
                        $('#acc-edit-send').prop('disabled', false)
                        $("html, body").animate({scrollTop: 0});
                        $('#flashMessages').html(
                            `<div class="alert alert-success alert-access">
                            <img class="alert-img" src="{{asset('assets/icons/mailbody-!.png')}}" alt="">
                            <p class="alert-text">${data.message}</p></div>`
                        )
                        // setTimeout(function () {
                        //     window.location.reload()
                        // }, 4000);
                    }
                },
                error: function (xhr) {
                    $("#AccEditLoadingDiv").hide();
                    $('#acc-edit-send').prop('disabled', false)
                    if (xhr.responseJSON.hasOwnProperty('errors') == true) {
                        $.each(xhr.responseJSON.errors, function (key, value) {
                            $('.acc-edit-' + key).text(value);
                        });
                    } else {
                        $("html, body").animate({scrollTop: 0});
                        $('#flashMessages').html(
                            `<div class="alert alert-success alert-access">
                            <img class="alert-img" src="{{asset('assets/icons/mailbody-!.png')}}" alt="">
                            <p class="alert-text">${xhr.responseJSON.message}</p></div>`
                        )
                    }

                    // alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
                }
            });
        })
        $('#acc-submit-mail').on('click', function (e) {
            $('#acc-send-mail').prop('disabled', true)
            let url = "{{route('invite', ':document_id')}}"
            let document_id = $('#accHashedDocId').val()
            url = url.replace(':document_id', document_id)

            let form = $("#acc-view-form")[0];
            var formData = new FormData(form);
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: url,
                // data: $('#corp-sec-doc-upload').serialize(),
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function () {
                    $("#AccSendMailLoadingDiv").show();
                },
                success: function (data) {
                    $("#AccSendMailLoadingDiv").hide();
                    if (data.success == 1) {
                        $("html, body").animate({scrollTop: 0});
                        $('#flashMessages').html(
                            `<div class="alert alert-success">
                            <img class="alert-img" src="{{asset('assets/icons/success-alert-icon.png')}}" alt="">
                            <p class="alert-text">Email invitations send successfully</p></div>`
                        )
                        setTimeout(function () {
                            window.location.reload();
                        }, 2000);
                        // $(".alert-text").html(response.message);
                    } else if (data.abort == 403) {
                        $('#acc-send-mail').prop('disabled', false)
                        $("html, body").animate({scrollTop: 0});
                        $('#flashMessages').html(
                            `<div class="alert alert-success alert-access">
                            <img class="alert-img" src="{{asset('assets/icons/mailbody-!.png')}}" alt="">
                            <p class="alert-text">${data.message}</p></div>`
                        )
                        // setTimeout(function () {
                        //     window.location.reload()
                        // }, 4000);
                    }else{
                        $('#corp-sec-send-mail').prop('disabled', false)
                        $("html, body").animate({scrollTop: 0});
                        $('#flashMessages').html(
                            `<div class="alert alert-success alert-access">
                                <img class="alert-img" src="{{asset('assets/icons/mailbody-!.png')}}" alt="">
                                <p class="alert-text">${data.message}</p>
                            </div>`
                        )
                    }
                },
                error: function (xhr) {
                    $("#AccSendMailLoadingDiv").hide();
                    $('#acc-send-mail').prop('disabled', false)
                    alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
                }
            });

        })

        $("#hr-submit").on('click', function (e) {
            $('#hr-send').prop('disabled', true)
            let shareholder = $('#hrShareholdersId').val().length;
            let director = $('#hrDirectorsId').val().length;
            if (director < 1 && shareholder < 1) {
                $('#hrNoSignerAlert').text('* Minimum One Director Or Shareholder Is Required')
                $('#hr-send').prop('disabled', false)
                return false;
            }
            let form = $("#hr-doc-upload")[0];
            var formData = new FormData(form);
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "{{route('upload.document')}}",
                // data: $('#corp-sec-doc-upload').serialize(),
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function () {
                    $("#HrLoadingDiv").show();
                },

                success: function (data, xhr) {
                    $("#HrLoadingDiv").hide();
                    if (data.success == 1) {
                        $("html, body").animate({scrollTop: 0});
                        $('#flashMessages').html(
                            `<div class="alert alert-success">
                            <img class="alert-img" src="{{asset('assets/icons/success-alert-icon.png')}}" alt="">
                            <p class="alert-text">Document Uploaded Successfully</p></div>`
                        )
                        // window.open(data.url)
                        setTimeout(function () {
                            // window.location.href=data.url;

                            window.location.reload()
                        }, 4000);
                        // $(".alert-text").html(response.message);
                    } else if (data.abort == 403) {
                        $('#hr-send').prop('disabled', false)
                        $("html, body").animate({scrollTop: 0});
                        $('#flashMessages').html(
                            `<div class="alert alert-success alert-access">
                            <img class="alert-img" src="{{asset('assets/icons/mailbody-!.png')}}" alt="">
                            <p class="alert-text">${data.message}</p></div>`
                        )
                        // setTimeout(function () {
                        //     // window.location.href=data.url;
                        //
                        //     window.location.reload()
                        // }, 4000);
                    }
                },
                error: function (xhr) {
                    $("#HrLoadingDiv").hide();
                    $('#hr-send').prop('disabled', false)
                    if (xhr.responseJSON.hasOwnProperty('errors') == true) {
                        $.each(xhr.responseJSON.errors, function (key, value) {
                            $('.hr-' + key).text(value);
                        });
                    } else {
                        $("html, body").animate({scrollTop: 0});
                        $('#flashMessages').html(
                            `<div class="alert alert-success alert-access">
                            <img class="alert-img" src="{{asset('assets/icons/mailbody-!.png')}}" alt="">
                            <p class="alert-text">${xhr.responseJSON.message}</p></div>`
                        )
                    }

                    // alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
                }
            });

        })
        $("#hr-edit-submit").on('click', function (e) {
            $('#hr-edit-send').prop('disabled', true)
            let shareholder = $('#hrEditShareholdersId').val().length;
            let director = $('#hrEditDirectorsId').val().length;
            if (director < 1 && shareholder < 1) {
                $('#hrEditNoSignerAlert').text('* Minimum One Director Or Shareholder Is Required')
                $('#hr-edit-send').prop('disabled', false)
                return false;
            }
            let form = $("#hr-edit-doc-upload")[0];
            var formData = new FormData(form);

            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "{{route('edit.document')}}",
                // data: $('#corp-sec-doc-upload').serialize(),
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function () {
                    $("#HrEditLoadingDiv").show();
                },
                success: function (data) {
                    $("#HrEditLoadingDiv").hide();
                    if (data.success == 1) {
                        $("html, body").animate({scrollTop: 0});
                        $('#flashMessages').html(
                            `<div class="alert alert-success">
                            <img class="alert-img" src="{{asset('assets/icons/success-alert-icon.png')}}" alt="">
                            <p class="alert-text">Document Uploaded Successfully</p></div>`
                        )
                        // window.open(data.url)
                        setTimeout(function () {
                            // window.location.href=data.url;
                            // if(data.response.document_id != $('#hrHashedDocumentId').val()){

                            // }
                            window.location.reload()
                        }, 4000);
                        // $(".alert-text").html(response.message);
                    } else if (data.abort == 403) {
                        $('#hr-edit-send').prop('disabled', false)
                        $("html, body").animate({scrollTop: 0});
                        $('#flashMessages').html(
                            `<div class="alert alert-success alert-access">
                            <img class="alert-img" src="{{asset('assets/icons/mailbody-!.png')}}" alt="">
                            <p class="alert-text">${data.message}</p></div>`
                        )
                        // setTimeout(function () {
                        //     window.location.reload()
                        // }, 4000);
                    }
                },
                error: function (xhr) {
                    $("#HrEditLoadingDiv").hide();
                    $('#hr-edit-send').prop('disabled', false)
                    if (xhr.responseJSON.hasOwnProperty('errors') == true) {
                        $.each(xhr.responseJSON.errors, function (key, value) {
                            $('.hr-edit-' + key).text(value);
                        });
                    } else {
                        $("html, body").animate({scrollTop: 0});
                        $('#flashMessages').html(
                            `<div class="alert alert-success alert-access">
                            <img class="alert-img" src="{{asset('assets/icons/mailbody-!.png')}}" alt="">
                            <p class="alert-text">${xhr.responseJSON.message}</p></div>`
                        )
                    }

                    // alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
                }
            });
        })
        $('#hr-submit-mail').on('click', function (e) {
            $('#hr-send-mail').prop('disabled', true)
            let url = "{{route('invite', ':document_id')}}"
            let document_id = $('#hrHashedDocId').val()
            url = url.replace(':document_id', document_id)

            let form = $("#hr-view-form")[0];
            var formData = new FormData(form);
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: url,
                // data: $('#corp-sec-doc-upload').serialize(),
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function () {
                    $("#HrSendMailLoadingDiv").show();
                },
                success: function (data) {
                    $("#HrSendMailLoadingDiv").hide();
                    if (data.success == 1) {
                        $("html, body").animate({scrollTop: 0});
                        $('#flashMessages').html(
                            `<div class="alert alert-success">
                            <img class="alert-img" src="{{asset('assets/icons/success-alert-icon.png')}}" alt="">
                            <p class="alert-text">Email invitations send successfully</p></div>`
                        )
                        setTimeout(function () {
                            window.location.reload();
                        }, 2000);
                        // $(".alert-text").html(response.message);
                    } else if (data.abort == 403) {
                        $('#hr-send-mail').prop('disabled', false);
                        $("html, body").animate({scrollTop: 0});
                        $('#flashMessages').html(
                            `<div class="alert alert-success alert-access">
                            <img class="alert-img" src="{{asset('assets/icons/mailbody-!.png')}}" alt="">
                            <p class="alert-text">${data.message}</p></div>`
                        )
                        // setTimeout(function () {
                        //     window.location.reload()
                        // }, 4000);
                    }else{
                        $('#corp-sec-send-mail').prop('disabled', false)
                        $("html, body").animate({scrollTop: 0});
                        $('#flashMessages').html(
                            `<div class="alert alert-success alert-access">
                                <img class="alert-img" src="{{asset('assets/icons/mailbody-!.png')}}" alt="">
                                <p class="alert-text">${data.message}</p>
                            </div>`
                        )
                    }
                },
                error: function (xhr) {
                    $('#hr-send-mail').prop('disabled', false);
                    $("#HrSendMailLoadingDiv").hide();

                    alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
                }
            });

        })


        //form submit end


        //frontend functions
        function displayFileName(fileId, inputId) {
            var fileInput = document.getElementById(inputId);
            $("#" + fileId).val(fileInput.files[0].name);

        }

        function docStatus() {
            var docStatus = document.getElementsByName("doc-status");
            var countTickets = docStatus.length;
            for (var i = 0; i < countTickets; i++) {
                if (docStatus[i].innerHTML == "Active") {
                    docStatus[i].style.color = "#52C41A";
                    docStatus[i].style.border = "1px solid #52C41A";
                    docStatus[i].style.backgroundColor = "#F4FFE3";
                }
                if (docStatus[i].innerHTML == "Completed") {
                    docStatus[i].style.color = "#52C41A";
                    docStatus[i].style.border = "1px solid #52C41A";
                    docStatus[i].style.backgroundColor = "#F4FFE3";
                } else if (docStatus[i].innerHTML == "Cancelled") {
                    docStatus[i].style.color = "#EB2F96";
                    docStatus[i].style.border = "1px solid #FFADD2";
                    docStatus[i].style.backgroundColor = "#FFF0F6";
                } else if (docStatus[i].innerHTML == "Draft") {
                    docStatus[i].style.color = "#A7A7A7";
                    docStatus[i].style.border = "1px solid #A7A7A7";
                    docStatus[i].style.backgroundColor = "#F4F4F4";
                } else if (docStatus[i].innerHTML == "Pending") {
                    docStatus[i].style.color = "#FF9C14";
                    docStatus[i].style.border = "1px solid #FF9C14";
                    docStatus[i].style.backgroundColor = "#FFEDC8";
                }
            }
        }

        function adminDocManageTab(evt, eventName) {
            // console.log(eventName)
            var i, tabcontent, tablinks, elements;
            tabcontent = document.getElementsByClassName("adminDocManageTabContent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("adminDocManageTabLinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }

            // document.getElementById(eventName).style.display = "block";

            elements = document.getElementsByClassName(eventName);
            for (i = 0; i < elements.length; i++) {
                elements[i].style.display = "block";
            }
            evt.currentTarget.className += " active";

            // Save active tab to local storage
            localStorage.setItem("activeTab", evt.currentTarget.id);

            switch (eventName) {
                case "tax":
                    headerText = "Document Management - Tax";
                    break;
                case "accounting":
                    headerText = "Document Management - Accounting";
                    break;
                case "human-resource":
                    headerText = "Document Management - Human Resource";
                    break;
                case "corp-secretary":
                    headerText = "Document Management - Corporate Secretary";
                    break;
                default:
                    headerText = "Document Management - Corporate Secretary";
            }
            var pageHeaderChange = document.getElementById("page-header")
            pageHeaderChange.innerHTML = headerText

            // if (tabHistory.length > 0 && tabHistory[tabHistory.length - 1] !== eventName) {
            //     tabHistory.push(eventName);
            // }
            // else if (tabHistory.length === 0) {
            //     tabHistory.push(eventName);
            // }

            let pageHeaderText = document.getElementById("page-header").innerHTML;
            let pageHeaderTextShort = pageHeaderText.slice(22, 50);
            console.log(pageHeaderText)

            function headerTrimer(width) {
                if (width.matches) { // If media query matches
                    document.getElementById("page-header").innerHTML = pageHeaderTextShort;
                } else {
                    document.getElementById("page-header").innerHTML = pageHeaderText;
                }
            }

            var width = window.matchMedia("(max-width: 991px)")
            headerTrimer(width)
            width.addListener(headerTrimer);


        }

        function goBack(event, eventName) {
            var i;
            var tabcontent = document.getElementsByClassName("adminDocManageTabContent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }

            var elements = document.getElementsByClassName(eventName);
            for (i = 0; i < elements.length; i++) {
                elements[i].style.display = "block";
            }
            event.currentTarget.className += " active";
            window.location.reload()

            // if(eventName == 'corp-secretary'){
            //     $('#corp-sec-name').val('')
            //     $('#file-name-cs').val('')
            //     $('#corp_sec_company_id').val(null).trigger('change')
            // }
        }

        function adminDocCreateTab(evt, eventName, e) {
            var i, tabcontent, tablinks, elements;
            tabcontent = document.getElementsByClassName("adminDocManageTabContent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }

            elements = document.getElementsByClassName(eventName);
            for (i = 0; i < elements.length; i++) {
                elements[i].style.display = "block";
            }
            evt.currentTarget.className += " active";
            console.log(eventName)

            // show(e);
            if (eventName == 'edit-doc') {
                fetchCorpSecEditData(e.id)
            } else if (eventName == 'tax-edit-doc') {
                fetchTaxEditData(e.id)
            } else if (eventName == 'acc-edit-doc') {
                fetchAccEditData(e.id)
            } else if (eventName == 'hr-edit-doc') {
                fetchHrEditData(e.id)
            }

            if (eventName == 'view-doc') {
                fetchCorpSecViewData(e.id)
            } else if (eventName == 'tax-view-doc') {
                fetchTaxViewData(e.id)
            } else if (eventName == 'acc-view-doc') {
                fetchAccViewData(e.id)
            } else if (eventName == 'hr-view-doc') {
                fetchHrViewData(e.id)
            }


        }

    </script>

    <script>
        // add and edit ds for corp sec starts
        $('#add-director').on('click', function () {
            // console.log($('input[name="directors[]"]:checked').val());
            directorsEmailIds = []
            var director_ids = new Array();
            $('#append-corp-sec-director').children().children().remove() //new
            $("#corp-sec-director-modal input[name='directors[]']:checked").each(function (e) {
                // console.log('checkbox',$(this).attr('checked','checked'))
                $(this).prop('checked', true)

                let id = "addcorpsec-director-" + $(this).val()
                director_ids.push($(this).val());
                directorsEmailIds.push($(this).val())
                var closeBtn = '<button type="button" id="' + id + '" onclick="remove(this)" class="btn p-0 ps-3 ms-auto cancel-btn">x</button>'
                var directorBox = $(this).closest(".directors");
                console.log(directorBox)

                directorBox.append(closeBtn);

                // console.log("directorBox", directorBox);
                directorBox.clone().appendTo('#director-list');

                directorBox.find($('#' + id)).remove()


                // $('#director-list').append(directorBox);
                // $(this).closest(".directors").remove();
            });

            $("#append-corp-sec-director").find('.col-md-2').addClass('d-none')

            // console.log("director_ids", director_ids);
            $('#directorSelectModal').modal('hide');

        })
        $('#add-shareholder').on('click', function () {
            // console.log($('input[name="directors[]"]:checked').val());
            shareholdersEmailIds = []
            var shareholder_ids = new Array();

            $('#append-corp-sec-shareholder').children().children().remove() //new
            $("#corp-sec-shareholder-modal input[name='shareholders[]']:checked").each(function () {
                let id = "addcorpsec-shareholder-" + $(this).val()
                $(this).prop('checked', true)
                shareholder_ids.push($(this).val());
                shareholdersEmailIds.push($(this).val())
                var closeBtn = '<button type="button" id="' + id + '" onclick="remove(this)" class="btn p-0 ps-3 ms-auto cancel-btn">x</button>'
                var shareholderBox = $(this).closest(".shareholders");
                // shareholderBox.find(".col-md-2").addClass('d-none');
                shareholderBox.append(closeBtn);
                console.log("shareholderBox", shareholderBox);
                shareholderBox.clone().appendTo('#shareholder-list');
                shareholderBox.find($('#' + id)).remove()
                // $('#director-list').append(directorBox);
                // $(this).closest(".shareholders").remove();
                // console.log()
                // .find(".col-md-10"));


            });
            $("#append-corp-sec-shareholder").find('.col-md-2').addClass('d-none')
            console.log("shareholder_ids", shareholder_ids);
            $('#shareholderSelectModal').modal('hide');

        })

        $('#edit-director').on('click', function (e) {
            directorsEditEmailIds = []

            // console.log($('input[name="directors[]"]:checked').val());

            var director_ids = new Array();
            $('#director-edit-list').children().remove()

            $("#corp-sec-edit-director-modal input[name='directors[]']:checked").each(function () {
                $(this).prop('checked', true)
                let id = "editcorpsec-director-" + $(this).val()

                directorsEditEmailIds.push($(this).val())

                var closeBtn = '<button type="button" id="' + id + '" onclick="editremove(this)" class="btn p-0 ps-3 ms-auto cancel-btn">x</button>'
                director_ids.push($(this).val());

                var directorBox = $(this).closest(".directors");
                // directorBox.find(".col-md-2").addClass('d-none');
                directorBox.append(closeBtn);
                console.log("directorBox", directorBox);
                directorBox.clone().appendTo('#director-edit-list');
                directorBox.find($('#' + id)).remove()

                // $(this).closest(".directors").remove();

            });
            $("#director-edit-list").find('.col-md-2').addClass('d-none')

            // console.log("director_ids_x",x);
            console.log("director_ids", directorsEditEmailIds);
            $('#directorEditModal').modal('hide');

        })

        $('#edit-shareholder').on('click', function () {
            shareholdersEditEmailIds = []

            // console.log($('input[name="directors[]"]:checked').val());

            var shareholder_ids = new Array();
            $('#shareholder-edit-list').children().remove()

            $("#corp-sec-edit-shareholder-modal input[name='shareholders[]']:checked").each(function () {
                $(this).prop('checked', true)
                let id = "editcorpsec-shareholder-" + $(this).val()
                shareholdersEditEmailIds.push($(this).val())
                var closeBtn = '<button type="button" id="' + id + '" onclick="editremove(this)" class="btn p-0 ps-3 ms-auto cancel-btn">x</button>'
                shareholder_ids.push($(this).val());

                var shareholderBox = $(this).closest(".shareholders");
                // shareholderBox.find(".col-md-2").addClass('d-none');
                shareholderBox.append(closeBtn);
                console.log("shareholderBox", shareholderBox);
                shareholderBox.clone().appendTo('#shareholder-edit-list');
                shareholderBox.find($('#' + id)).remove()
                // $(this).closest(".shareholders").remove();

            });
            $("#shareholder-edit-list").find('.col-md-2').addClass('d-none')
            console.log("shareholder_ids", shareholder_ids);
            $('#shareholderEditModal').modal('hide');

        })
        //  add and edit ds for corp sec ends

        //  add and edit ds for tax starts

        $('#add-tax-director').on('click', function () {
            // console.log($('input[name="directors[]"]:checked').val());
            directorsEmailIds = []
            var director_ids = new Array();


            $('#append-tax-director').children().remove() //new

            $("#tax-director-modal input[name='directors[]']:checked").each(function () {
                $(this).prop('checked', true)
                let id = "addtax-director-" + $(this).val()
                directorsEmailIds.push($(this).val())
                var closeBtn = '<button type="button" id="' + id + '" onclick="remove(this)" class="btn p-0 ps-3 ms-auto cancel-btn">x</button>'
                director_ids.push($(this).val());

                var directorBox = $(this).closest(".directors");
                // directorBox.find(".col-md-2").addClass('d-none');
                directorBox.append(closeBtn);
                directorBox.clone().appendTo('#append-tax-director');
                directorBox.find($('#' + id)).remove()
                // $('#director-list').append(directorBox);
                // $(this).closest(".directors").remove();


            });
            $("#append-tax-director").find('.col-md-2').addClass('d-none')
            console.log("director_ids", director_ids);
            $('#taxDirectorSelectModal').modal('hide');

        })

        $('#add-tax-shareholder').on('click', function () {
            // console.log($('input[name="directors[]"]:checked').val());
            shareholdersEmailIds = []
            var shareholder_ids = new Array();
            $('#append-tax-shareholder').children().remove() //new
            $("#tax-shareholder-modal input[name='shareholders[]']:checked").each(function () {
                $(this).prop('checked', true)
                let id = "addtax-shareholder-" + $(this).val()
                shareholdersEmailIds.push($(this).val())
                var closeBtn = '<button type="button" id="' + id + '" onclick="remove(this)" class="btn p-0 ps-3 ms-auto cancel-btn">x</button>'
                shareholder_ids.push($(this).val());

                var shareholderBox = $(this).closest(".shareholders");
                // shareholderBox.find(".col-md-2").addClass('d-none');
                shareholderBox.append(closeBtn);
                console.log("shareholderBox", shareholderBox);
                shareholderBox.clone().appendTo('#append-tax-shareholder');
                shareholderBox.find($('#' + id)).remove()
                // $('#director-list').append(directorBox);
                // $(this).closest(".shareholders").remove();
                // console.log()
                // .find(".col-md-10"));


            });
            $("#append-tax-shareholder").find('.col-md-2').addClass('d-none')

            console.log("shareholder_ids", shareholder_ids);
            $('#taxShareholderSelectModal').modal('hide');

        })

        $('#edit-tax-director').on('click', function () {
            directorsEditEmailIds = []
            // var closeBtn= ''
            // console.log($('input[name="directors[]"]:checked').val());

            var director_ids = new Array();
            $('#tax-director-edit-list').children().remove()


            $("#tax-edit-director-modal input[name='directors[]']:checked").each(function () {
                $(this).prop('checked', true)
                directorsEditEmailIds.push($(this).val())
                let id = "edittax-director-" + $(this).val()
                var closeBtn = '<button type="button" id="' + id + '" onclick="editremove(this)" class="btn p-0 ps-3 ms-auto cancel-btn">x</button>'
                director_ids.push($(this).val());

                var directorBox = $(this).closest(".directors");
                // directorBox.find(".col-md-2").addClass('d-none');
                directorBox.append(closeBtn);
                console.log("directorBox", directorBox);
                directorBox.clone().appendTo('#tax-director-edit-list');
                directorBox.find($('#' + id)).remove()
                // $('#director-list').append(directorBox);
                // $(this).closest(".directors").remove();
                // console.log()
                // .find(".col-md-10"));


            });
            $("#tax-director-edit-list").find('.col-md-2').addClass('d-none')
            console.log("director_ids", director_ids);
            $('#taxDirectorEditModal').modal('hide');

        })

        $('#edit-tax-shareholder').on('click', function () {
            // var closeBtn= ''
            shareholdersEditEmailIds = []
            // console.log($('input[name="directors[]"]:checked').val());

            var shareholder_ids = new Array();
            // console.log($('#tax-shareholder-edit-list').children())
            $('#tax-shareholder-edit-list').children().remove()

            $("#tax-edit-shareholder-modal input[name='shareholders[]']:checked").each(function (e) {
                $(this).prop('checked', true)
                let id = "edittax-shareholder-" + $(this).val()
                shareholdersEditEmailIds.push($(this).val())
                var closeBtn = '<button type="button" id="' + id + '" onclick="editremove(this)" class="btn p-0 ps-3 ms-auto cancel-btn">x</button>'
                shareholder_ids.push($(this).val());

                var shareholderBox = $(this).closest(".shareholders");
                // shareholderBox.find(".col-md-2").addClass('d-none');
                shareholderBox.append(closeBtn);
                console.log("shareholderBox", shareholderBox);
                shareholderBox.clone().appendTo('#tax-shareholder-edit-list');
                shareholderBox.find($('#' + id)).remove()
                // $('#director-list').append(directorBox);
                // $(this).closest(".shareholders").remove();
                // console.log()
                // .find(".col-md-10"));


            });
            $("#tax-shareholder-edit-list").find('.col-md-2').addClass('d-none')

            console.log("shareholder_ids", shareholder_ids);
            $('#taxShareholderEditModal').modal('hide');

        })
        //  add and edit ds for tax ends

        //  add and edit ds for accounting starts

        $('#add-acc-director').on('click', function () {
            // console.log($('input[name="directors[]"]:checked').val());
            directorsEmailIds = []
            var director_ids = new Array();
            $('#append-acc-director').children().remove() //new
            $("#acc-director-modal input[name='directors[]']:checked").each(function () {
                $(this).prop('checked', true)
                let id = "addacc-director-" + $(this).val()
                directorsEmailIds.push($(this).val())
                var closeBtn = '<button type="button" id="' + id + '" onclick="remove(this)" class="btn p-0 ps-3 ms-auto cancel-btn">x</button>'
                director_ids.push($(this).val());

                var directorBox = $(this).closest(".directors");
                // directorBox.find(".col-md-2").addClass('d-none');
                directorBox.append(closeBtn);
                directorBox.clone().appendTo('#append-acc-director');
                directorBox.find($('#' + id)).remove()
                // $('#director-list').append(directorBox);
                // $(this).closest(".directors").remove();


            });
            $("#append-acc-director").find('.col-md-2').addClass('d-none')
            console.log("director_ids", director_ids);
            $('#accDirectorSelectModal').modal('hide');

        })

        $('#add-acc-shareholder').on('click', function () {
            // console.log($('input[name="directors[]"]:checked').val());
            shareholdersEmailIds = []
            var shareholder_ids = new Array();
            $('#append-acc-shareholder').children().remove() //new
            $("#acc-shareholder-modal input[name='shareholders[]']:checked").each(function () {
                $(this).prop('checked', true)
                let id = "addacc-shareholder-" + $(this).val()
                shareholdersEmailIds.push($(this).val())
                var closeBtn = '<button type="button" id="' + id + '" onclick="remove(this)" class="btn p-0 ps-3 ms-auto cancel-btn">x</button>'
                shareholder_ids.push($(this).val());

                var shareholderBox = $(this).closest(".shareholders");
                // shareholderBox.find(".col-md-2").addClass('d-none');
                shareholderBox.append(closeBtn);
                console.log("shareholderBox", shareholderBox);
                shareholderBox.clone().appendTo('#append-acc-shareholder');
                shareholderBox.find($('#' + id)).remove()
                // $('#director-list').append(directorBox);
                // $(this).closest(".shareholders").remove();
                // console.log()
                // .find(".col-md-10"));


            });
            $("#append-acc-shareholder").find('.col-md-2').addClass('d-none')
            console.log("shareholder_ids", shareholder_ids);
            $('#accShareholderSelectModal').modal('hide');

        })

        $('#edit-acc-director').on('click', function () {
            directorsEditEmailIds = []
            // console.log($('input[name="directors[]"]:checked').val());

            var director_ids = new Array();
            $('#acc-director-edit-list').children().remove()

            $("#acc-edit-director-modal input[name='directors[]']:checked").each(function () {
                $(this).prop('checked', true)
                let id = "editacc-director-" + $(this).val()
                directorsEditEmailIds.push($(this).val())
                var closeBtn = '<button type="button" id="' + id + '" onclick="editremove(this)" class="btn p-0 ps-3 ms-auto cancel-btn">x</button>'
                director_ids.push($(this).val());

                var directorBox = $(this).closest(".directors");
                // directorBox.find(".col-md-2").addClass('d-none');
                directorBox.append(closeBtn);
                console.log("directorBox", directorBox);
                directorBox.clone().appendTo('#acc-director-edit-list');
                directorBox.find($('#' + id)).remove()
                // $('#director-list').append(directorBox);
                // $(this).closest(".directors").remove();
                // console.log()
                // .find(".col-md-10"));


            });
            $("#acc-director-edit-list").find('.col-md-2').addClass('d-none')
            console.log("director_ids", director_ids);
            $('#accDirectorEditModal').modal('hide');

        })

        $('#edit-acc-shareholder').on('click', function () {
            shareholdersEditEmailIds = []
            // console.log($('input[name="directors[]"]:checked').val());

            var shareholder_ids = new Array();
            $('#acc-shareholder-edit-list').children().remove()

            $("#acc-edit-shareholder-modal input[name='shareholders[]']:checked").each(function () {
                $(this).prop('checked', true)
                let id = "editacc-shareholder-" + $(this).val()
                shareholdersEditEmailIds.push($(this).val())
                var closeBtn = '<button type="button" id="' + id + '" onclick="editremove(this)" class="btn p-0 ps-3 ms-auto cancel-btn">x</button>'
                shareholder_ids.push($(this).val());

                var shareholderBox = $(this).closest(".shareholders");
                // shareholderBox.find(".col-md-2").addClass('d-none');
                shareholderBox.append(closeBtn);
                console.log("shareholderBox", shareholderBox);
                shareholderBox.clone().appendTo('#acc-shareholder-edit-list');
                shareholderBox.find($('#' + id)).remove()
                // $('#director-list').append(directorBox);
                // $(this).closest(".shareholders").remove();
                // console.log()
                // .find(".col-md-10"));


            });
            $("#acc-shareholder-edit-list").find('.col-md-2').addClass('d-none')

            console.log("shareholder_ids", shareholder_ids);
            $('#accShareholderEditModal').modal('hide');

        })

        //  add and edit for accounting ends

        //  add and edit ds for human resource starts

        $('#add-hr-director').on('click', function () {
            // console.log($('input[name="directors[]"]:checked').val());
            directorsEmailIds = []
            var director_ids = new Array();
            $('#append-hr-director').children().remove() //new
            $("#hr-director-modal input[name='directors[]']:checked").each(function () {
                $(this).prop('checked', true)
                let id = "addhr-director-" + $(this).val()
                directorsEmailIds.push($(this).val())
                var closeBtn = '<button type="button" id="' + id + '" onclick="remove(this)" class="btn p-0 ps-3 ms-auto cancel-btn">x</button>'
                director_ids.push($(this).val());

                var directorBox = $(this).closest(".directors");
                // directorBox.find(".col-md-2").addClass('d-none');
                directorBox.append(closeBtn);
                directorBox.clone().appendTo('#append-hr-director');
                directorBox.find($('#' + id)).remove()
                // $('#director-list').append(directorBox);
                // $(this).closest(".directors").remove();


            });
            $("#append-hr-director").find('.col-md-2').addClass('d-none')
            console.log("director_ids", director_ids);
            $('#hrDirectorSelectModal').modal('hide');

        })

        $('#add-hr-shareholder').on('click', function () {
            // console.log($('input[name="directors[]"]:checked').val());
            shareholdersEmailIds = []
            var shareholder_ids = new Array();
            // var closeBtn = '<button type="button" class="btn p-0 ps-3 ms-auto cancel-btn">x</button>'
            $('#append-hr-shareholder').children().remove() //new
            $("#hr-shareholder-modal input[name='shareholders[]']:checked").each(function () {
                $(this).prop('checked', true)
                let id = "addhr-shareholder-" + $(this).val()
                shareholdersEmailIds.push($(this).val())
                var closeBtn = '<button type="button" id="' + id + '" onclick="remove(this)" class="btn p-0 ps-3 ms-auto cancel-btn">x</button>'
                shareholder_ids.push($(this).val());

                var shareholderBox = $(this).closest(".shareholders");
                // shareholderBox.find(".col-md-2").addClass('d-none');
                shareholderBox.append(closeBtn);
                console.log("shareholderBox", shareholderBox);
                shareholderBox.clone().appendTo('#append-hr-shareholder');
                shareholderBox.find($('#' + id)).remove()
                // $('#director-list').append(directorBox);
                // $(this).closest(".shareholders").remove();
                // console.log()
                // .find(".col-md-10"));


            });
            $("#append-hr-shareholder").find('.col-md-2').addClass('d-none')

            console.log("shareholder_ids", shareholder_ids);
            $('#hrShareholderSelectModal').modal('hide');

        })

        $('#edit-hr-director').on('click', function () {
            directorsEditEmailIds = []
            // console.log($('input[name="directors[]"]:checked').val());

            var director_ids = new Array();
            $('#hr-director-edit-list').children().remove()

            $("#hr-edit-director-modal input[name='directors[]']:checked").each(function () {
                $(this).prop('checked', true)
                let id = "edithr-director-" + $(this).val()
                directorsEditEmailIds.push($(this).val())
                var closeBtn = '<button type="button" id="' + id + '" onclick="editremove(this)" class="btn p-0 ps-3 ms-auto cancel-btn">x</button>'
                director_ids.push($(this).val());

                var directorBox = $(this).closest(".directors");
                // directorBox.find(".col-md-2").addClass('d-none');
                directorBox.append(closeBtn);
                console.log("directorBox", directorBox);
                directorBox.clone().appendTo('#hr-director-edit-list');
                directorBox.find($('#' + id)).remove()
                // $('#director-list').append(directorBox);
                // $(this).closest(".directors").remove();
                // console.log()
                // .find(".col-md-10"));


            });
            $("#hr-director-edit-list").find('.col-md-2').addClass('d-none')
            console.log("director_ids", director_ids);
            $('#hrDirectorEditModal').modal('hide');

        })

        $('#edit-hr-shareholder').on('click', function () {
            shareholdersEditEmailIds = []
            // console.log($('input[name="directors[]"]:checked').val());

            var shareholder_ids = new Array();
            $('#hr-shareholder-edit-list').children().remove()


            $("#hr-edit-shareholder-modal input[name='shareholders[]']:checked").each(function () {
                $(this).prop('checked', true)
                let id = "edithr-shareholder-" + $(this).val()
                shareholdersEditEmailIds.push($(this).val())
                var closeBtn = '<button type="button" id="' + id + '" onclick="editremove(this)" class="btn p-0 ps-3 ms-auto cancel-btn">x</button>'
                shareholder_ids.push($(this).val());

                var shareholderBox = $(this).closest(".shareholders");
                // shareholderBox.find(".col-md-2").addClass('d-none');
                shareholderBox.append(closeBtn);
                console.log("shareholderBox", shareholderBox);
                shareholderBox.clone().appendTo('#hr-shareholder-edit-list');
                shareholderBox.find($('#' + id)).remove()
                // $('#director-list').append(directorBox);
                // $(this).closest(".shareholders").remove();
                // console.log()
                // .find(".col-md-10"));


            });
            $("#hr-shareholder-edit-list").find('.col-md-2').addClass('d-none')
            console.log("shareholder_ids", shareholder_ids);
            $('#hrShareholderEditModal').modal('hide');

        })

        //remove block cross onclick start
        function remove(e) {

            console.log(directorsEmailIds)
            console.log(shareholdersEmailIds)
            let id = e.id
            let btnid = "#" + id
            let removedItem = id.split('-')[2]
            let service = id.split('-')[0]

            if (id.split('-')[1] == 'director') {
                let directorModalId = ''
                if (service == 'corpsec' || service == 'addcorpsec') {
                    console.log('in1')
                    directorModalId = '#corp-sec-director-modal'
                } else if (service == 'tax' || service == 'addtax') {
                    console.log('in2')
                    directorModalId = '#tax-director-modal'
                } else if (service == 'acc' || service == 'addacc') {
                    console.log('in13')
                    directorModalId = '#acc-director-modal'
                } else if (service == 'hr' || service == 'addhr') {
                    console.log('in4')
                    directorModalId = '#hr-director-modal'
                }
                // console.log($(directorModalId).children())
                $(directorModalId).children().find('input[type=checkbox]').each(function () {
                    console.log(removedItem)
                    console.log($(this))
                    if ($(this).val() == removedItem) {
                        // $(this).removeAttr('checked')
                        $(this).prop('checked', false);
                        // $(this).removeAttr('onclick')
                    }
                })


                // delete directorsEmailIds.removedItem;
                var result = directorsEmailIds.filter(function (elem) {
                    // console.log(elem)
                    return elem != removedItem;
                });

                directorsEmailIds.length = 0;                  // Clear contents
                directorsEmailIds.push.apply(directorsEmailIds, result);  // Append new contents
            }
            if (id.split('-')[1] == 'shareholder') {
                let directorModalId = ''
                if (service == 'corpsec' || service == 'addcorpsec') {
                    console.log('in1')
                    directorModalId = '#corp-sec-shareholder-modal'
                } else if (service == 'tax' || service == 'addtax') {
                    console.log('in2')
                    directorModalId = '#tax-shareholder-modal'
                } else if (service == 'acc' || service == 'addacc') {
                    console.log('in13')
                    directorModalId = '#acc-shareholder-modal'
                } else if (service == 'hr' || service == 'addhr') {
                    console.log('in4')
                    directorModalId = '#hr-shareholder-modal'
                }
                console.log($(directorModalId).children())
                $(directorModalId).children().find('input[type=checkbox]').each(function () {
                    console.log(removedItem)
                    if ($(this).val() == removedItem) {
                        // $(this).removeAttr('checked')
                        $(this).prop('checked', false);
                    }
                })

                // delete directorsEmailIds.removedItem;
                var result = shareholdersEmailIds.filter(function (elem) {
                    return elem != removedItem;
                });
                shareholdersEmailIds.length = 0;                  // Clear contents
                shareholdersEmailIds.push.apply(shareholdersEmailIds, result);  // Append new contents

            }

            // $(this).parent('div').remove();


            // $(btnid).closest('.cancel-btn').addClass('d-none')

            $(btnid).parent('div').remove()
            // console.log(btnid)


            console.log(directorsEmailIds)
            console.log(shareholdersEmailIds)


        }

        function editremove(e) {
            console.log(directorsEditEmailIds)
            console.log(shareholdersEditEmailIds)
            let id = e.id
            let removedItem = id.split('-')[2]
            let service = id.split('-')[0] //weather it is corp sec||tax||acc||hr
            if (id.split('-')[1] == 'director') {
                let directorModalId = ''
                if (service == 'corpsec' || service == 'editcorpsec') {
                    console.log('in1')
                    directorModalId = '#corp-sec-edit-director-modal'
                } else if (service == 'tax' || service == 'edittax') {
                    console.log('in2')
                    directorModalId = '#tax-edit-director-modal'
                } else if (service == 'acc' || service == 'editacc') {
                    console.log('in13')
                    directorModalId = '#acc-edit-director-modal'
                } else if (service == 'hr' || service == 'edithr') {
                    console.log('in4')
                    directorModalId = '#hr-edit-director-modal'
                }
                $(directorModalId).children().find('input[type=checkbox]').each(function () {
                    console.log('in6')
                    if ($(this).val() == removedItem) {

                        $(this).prop('checked', false);
                        $(this).removeAttr('onclick')
                    }
                })

                var result = directorsEditEmailIds.filter(function (elem) {
                    // console.log(elem)
                    return elem != removedItem;
                });

                directorsEditEmailIds.length = 0;                  // Clear contents
                directorsEditEmailIds.push.apply(directorsEditEmailIds, result);  // Append new contents

            }
            if (id.split('-')[1] == 'shareholder') {
                console.log(service)
                let modalId = ''
                if (service == 'corpsec' || service == 'editcorpsec') {
                    modalId = '#corp-sec-edit-shareholder-modal'
                } else if (service == 'tax' || service == 'edittax') {
                    modalId = '#tax-edit-shareholder-modal'
                } else if (service == 'acc' || service == 'editacc') {
                    modalId = '#acc-edit-shareholder-modal'
                } else if (service == 'hr' || service == 'edithr') {
                    modalId = '#hr-edit-shareholder-modal'
                }

                $(modalId).children().find('input[type=checkbox]').each(function () {
                    console.log('in7')
                    if ($(this).val() == removedItem) {
                        $(this).prop('checked', false);
                        $(this).removeAttr('onclick')
                    }
                })
                var result = shareholdersEditEmailIds.filter(function (elem) {
                    console.log('in8')
                    return elem != removedItem;
                });
                shareholdersEditEmailIds.length = 0;                  // Clear contents
                shareholdersEditEmailIds.push.apply(shareholdersEditEmailIds, result);  // Append new contents

            }
            $("#" + id).parent('div').remove() //good

            // $(this).parent('div').remove();

            console.log(directorsEditEmailIds)
            console.log(shareholdersEditEmailIds)
        }

        //remove block cross onclick end

        function refreshStatus(e, document_id) {
            let spinnerId = e.getAttribute('data-id')
            console.log(spinnerId)
            let url = '{{route('document.refresh.status', ':document_id')}}'
            url = url.replace(':document_id', document_id)
            $.ajax({
                type: "GET",
                url: url,
                // data: $('#corp-sec-doc-upload').serialize(),
                processData: false,
                contentType: false,
                beforeSend: function () {
                    $("#" + spinnerId).removeClass('d-none');
                },
                success: function (data) {
                    $("#" + spinnerId).addClass('d-none');
                    // console.log(data.status == 'completed')
                    if (data.status == 'completed') {
                        let wrapper = $(e).parent().siblings(".status-div")
                        wrapper.children("p").remove()

                        let completeBtn = '<p name="doc-status" class="doc-status">Completed</p>'; // completed btn
                        wrapper.append(completeBtn);
                        docStatus();
                    }
                    setTimeout(function () {
                        // window.location.href=data.url;
                        window.location.reload()
                    }, 1000);
                },
                error: function (xhr) {
                    $("#" + spinnerId).addClass('d-none');
                    alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
                }
            });


            // when ajax response is successfull and $documentManagement->status is completeded

        }

        function hideModal(e, modalId) {
            $('#' + modalId).modal('hide')
            // .parent().parent().parent().parent().parent('div')
        }

        function openInNewTab(href) {
            Object.assign(document.createElement('a'), {
                target: '_blank',
                rel: 'noopener noreferrer',
                href: href,
            }).click();
        }
    </script>
@endpush
