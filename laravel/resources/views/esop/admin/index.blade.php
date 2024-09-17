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

        <div class="row admin-esop-body g-0">
            <div class="col-12 col-md-2 col-sm-12 card admin-esop-button-card">
                <div
                    class="card-body admin-esop-button-body">
                    <div class="tab-buttons"
                         id="tab-buttons">
                        <button
                            class="tablinks adminEsopTabLinks active"
                            onclick="adminEsopTab(event,'defaultTab')"
                            id="activity-defaultOpen" hidden>Select
                            Company First</button>
                        <button
                            class="tablinks adminEsopTabLinks"
                            onclick="adminEsopTab(event,'overview')"
                            id="activity-overview-btn">Overview</button>
                        <button
                            class="tablinks adminEsopTabLinks"
                            onclick="adminEsopTab(event,'entries')"
                            id="activity-entries-btn">Entries</button>
                        <button
                            class="tablinks adminEsopTabLinks"
                            onclick="adminEsopTab(event,'documents')"
                            id="activity-documents-btn">Documents</button>
                    </div>
                    <form method="GET" action="" id="select_company">
                        <p class="mt-3">Company</p>
                        <select class="form-control form-select select-data " name="" id="esop-company" onchange="esopCompanySelect()" required>
                            {{-- do not change Ist option--}}
                            <option hidden value="">Please Select</option>
                            @foreach($companies as $company)
                                <option value="{{$company->id}}" data-name="{{$company->name}}" {{$company->id == \App\Helpers\EsopCompanyHelper::get() ? 'selected' : ''}}>{{$company->name}}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn search-btn">Search</button>
                    </form>
                </div>

            </div>
            <div class="col-12 col-md-10 col-sm-12">
                <div class="card admin-esop-card">
                    <div class="card-body admin-esop-content-body">

                        <!-- Select Company Portion Starts -->

                        <div id="defaultTab" class="tabcontent adminEsopTabContent defaultTab text-center">
                            <h1>Please Select A Company First</h1>
                        </div>
                        <!-- Select Company Portion Ends -->




                        <!-- ESOP Overview Portion Starts -->

                        <div id="overview" class="overview adminEsopTabContent tabcontent overview-manage-body">
                            <div class="mb-2">Current Selection: <b class="esop-current-company-selection"></b></div>
                            <div class="card esop-overview-card col-12 col-md-12 col-lg-12">
                                <div class="card-body overview-card-body">
                                    <div class="overview-card-header">
                                        <h6 class="header-text">ESOP Overview</h6>
                                    </div>
                                    <div class="date-div">
                                        <label for="asOnDate">As On:</label>
                                        <input type="date" id="asOnDate" name="asOnDate" value="{{ date('Y-m-d') }}" class="form-control-sm my-1">
                                    </div>
                                    <div class="col-12 col-md-12 col-lg-12">
                                        <div class="bar-chart-container">
                                            <div id="overviewBarChart" class="overview-bar-chart"></div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="card esop-overview-table-card">
                                <div class="card-body overview-card-body">
                                    <div class="overview-card-header">
                                        <h6 class="header-text">Upcoming Exercise</h6>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="esop-overview-table">
                                            <thead>
                                            <tr>
                                                <th class="description-header">Date of Granted</th>
                                                <th class="description-header">Name</th>
                                                <th class="description-header">Number of Shares</th>
                                                <th class="description-header">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody id="esop-overview-table-body">
                                            <!-- Main row start -->
{{--                                            <tr>--}}
{{--                                                <td class="description-data">28 Jan 2024</td>--}}
{{--                                                <td class="description-data">Anderson Goh</td>--}}
{{--                                                <td class="description-data">160</td>--}}
{{--                                                <td class="description-data">--}}
{{--                                                    <a href="#" class="action-buttons" data-bs-toggle="modal" data-bs-target="#entriesEditModal">Edit</a>--}}
{{--                                                    <a href="#" class="action-buttons delete-btn" data-bs-toggle="modal" data-bs-target="#entriesDeleteModal">Delete</a>--}}
{{--                                                </td>--}}
{{--                                            </tr>--}}
                                            <!-- Main row end -->
{{--                                            <tr>--}}
{{--                                                <td class="description-data">28 Feb 2024</td>--}}
{{--                                                <td class="description-data">John Neo</td>--}}
{{--                                                <td class="description-data">1800</td>--}}
{{--                                                <td class="description-data">--}}
{{--                                                    <a href="#" class="action-buttons" data-bs-toggle="modal" data-bs-target="#entriesEditModal">Edit</a>--}}
{{--                                                    <a href="#" class="action-buttons delete-btn" data-bs-toggle="modal" data-bs-target="#entriesDeleteModal">Delete</a></td>--}}
{{--                                            </tr>--}}
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div id="pagination-wrapper"></div>
{{--                                <div class="select-pagination-portion table-bottom-portion row g-0">--}}
{{--                                    <!-- responsive task: change col class in this row -->--}}
{{--                                    <div class="pagination-part bottom-pagination-part col-12 col-md-5 col-lg-4">--}}
{{--                                        <a href="#" class="btn"> <i class="fa-solid fa-chevron-left"></i></a>--}}
{{--                                        <span class="pagination-number pagination-left-number">5</span>--}}
{{--                                        <span class="pagination-divider">/</span>--}}
{{--                                        <span class="pagination-number pagination-right-number">10</span>--}}
{{--                                        <a href="#" class="btn">--}}
{{--                                            <i class="fa-solid fa-chevron-right"></i></a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                            </div>
                        </div>

                        <!-- ESOP Overview Portion Ends -->



                        <!-- Entries Portion Starts -->

                        <!-- Entries Table starts -->
                        <div id="entries" class="tabcontent adminEsopTabContent entries">
                            <div class="select-pagination-portion table-top-portion row g-0">
                                <div class="sb-part search-box-part col-12 col-md-4 offset-lg-1 col-lg-5">
                                    <div class="d-flex form-inputs search-data">
                                        <input id="esop-entries-search" class="form-control" type="text" placeholder=" Name / Company Name">
                                        <button id="esop-entries-search-btn" class="search-btn btn"><i class="fa-solid fa-search"></i></button>
                                    </div>
                                </div>

                                <div class="button-part col-12 col-md-8 col-lg-7">
                                    <button type="button" class="btn create-btn action-buttons active" data-bs-toggle="modal" data-bs-target="#entriesCreateModal">Add Entry</button>
                                </div>
                            </div>
                            <div class="mb-2">Current Selection: <b class="esop-current-company-selection"></b></div>
                            <div class="table-responsive">
                                <div id="esop-entries-table" class="esop-table-manage-body">
                                    <div class="table-rows row g-0">
                                        <div class="col-2 header-div">
                                            <span>Issue Date</span>
                                        </div>
                                        <div class="col-2 header-div">
                                            <span>Date of Granted</span>
                                        </div>
                                        <div class="col-2 header-div">
                                            <span>Name</span>
                                        </div>
                                        <div class="col-2 header-div">
                                            <span>Status</span>
                                        </div>
                                        <div class="col-2 header-div">
                                            <span>Number of Shares</span>
                                        </div>
                                        <div class="col-2 header-div">
                                            <span>Action</span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div id="esop-entry-pagination-wrapper"></div>
                            {{--<div class="select-pagination-portion table-bottom-portion row g-0">
                                <div id="esop-entry-pagination-part" class="pagination-part bottom-pagination-part col-12 col-md-5 col-lg-4">
                                    <a href="#" class="btn"><i class="fa-solid fa-chevron-left"></i></a>
                                    <span class="pagination-number pagination-left-number">1</span>
                                    <span class="pagination-divider">/</span>
                                    <span class="pagination-number pagination-right-number">10</span>
                                    <a href="#" class="btn"><i class="fa-solid fa-chevron-right"></i></a>
                                </div>
                            </div>--}}
                        </div>
                        <!-- Entries Table ends -->

                        <!--Entries Create Modal Starts -->
                        <div class="modal fade" id="entriesCreateModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="entriesCreateModalLabel" aria-hidden="true">
                            @include('esopEntries.admin.partials.create_entries', array('companies' =>$companies,'members' => $members))
                        </div>
                        <!-- Entries Create Modal Ends -->

                        <!--Entries Edit Modal Starts -->
                        <div class="modal fade" id="entriesEditModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="entriesEditModalLabel" aria-hidden="true">
                            @include('esopEntries.admin.partials.edit_entries')
                        </div>
                        <!-- Entries Edit Modal Ends -->

                        <!--Entries View Modal Starts -->
                        <div class="modal fade" id="entryViewModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="entriesViewModalLabel" aria-hidden="true">
                            <div class="modal-dialog entries-modal">
                                <div class="modal-content">
                                    <div class="entries-modal-body">
                                        <div class="entries-modal-header row">
                                            <h5 class="modal-title col-sm-11 col-11" id="entriesViewModalLabel">View Entry</h5>
                                            <button type="button" class="btn btn-close btn-sm entries-modal-close-btn col-sm-1 col-1" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="entries-modal-data row">
                                            <form action="#">
                                                <div class="data-body row">
                                                    <div class="data-row col-6">
                                                        <label for="member"><span class="required-sign">*</span>Member</label>
                                                        <p class="entry-data" id="esop-entries-view-member">Jessica Wu</p>
                                                    </div>
                                                    <div class="data-row col-6 col-md-6">
                                                        <label for="status"><span class="required-sign">*</span>Status</label>
                                                        <p class="entry-data" id="esop-entries-view-status">Issued</p>
                                                    </div>
                                                    <div class="data-row fye-row col-6 col-md-6">
                                                        <label for=""><span class="required-sign">*</span>Issue Date</label>
                                                        <p class="entry-data" id="esop-entries-view-issue-date">2023-07-28</p>
                                                        {{--                                                        <input type="date" class="entry-data" value="2023-07-28">--}}
                                                    </div>
                                                    <div class="data-row col-6 col-md-6">
                                                        <label for=""><span class="required-sign">*</span>Vesting Period(Months)</label>
                                                        <p class="entry-data" id="esop-entries-view-vesting-period">12</p>
                                                    </div>
                                                    <div class="data-row fye-row col-6">
                                                        <label for=""><span class="required-sign">*</span>Date of Granted</label>
                                                        <p class="entry-data" id="esop-entries-view-date-of-granted">2023-07-08</p>
                                                        {{--                                                        <input type="date" class="entry-data" value="2023-07-28" disabled>--}}
                                                    </div>
                                                    <div class="data-row col-6">
                                                        <label for=""><span class="required-sign">*</span>Number of Share</label>
                                                        <p class="entry-data" id="esop-entries-view-no-of-share">5000</p>
                                                    </div>
                                                    <div class="data-row fye-row col-6">
                                                        <label for=""><span class="required-sign">*</span>Reminder Date</label>
                                                        <p class="entry-data" id="esop-entries-view-reminder-date">2023-07-01</p>
                                                        {{--                                                        <input type="date" class="entry-data" value="2023-07-01">--}}
                                                    </div>
                                                    <div class="data-row col-6">
                                                        <label for=""><span class="required-sign">*</span>1st Email for Reminder</label>
                                                        <p class="entry-data" id="esop-entries-view-first-reminder-email">aaron@techzu.co</p>
                                                    </div>
                                                    <div class="data-row col-6">
                                                        <label for=""><span class="required-sign">*</span>2nd Email for Reminder</label>
                                                        <p class="entry-data" id="esop-entries-view-second-reminder-email">aaron@techzu.co</p>
                                                    </div>
                                                    <div class="data-row col-6">
                                                        <label for=""><span class="required-sign">*</span>3rd Email for Reminder</label>
                                                        <p class="entry-data" id="esop-entries-view-third-reminder-email">aaron@techzu.co4</p>
                                                    </div>
                                                    <div class="data-row col-6">
                                                        <label for=""><span class="required-sign">*</span>4th Email for Reminder</label>
                                                        <p class="entry-data" id="esop-entries-view-forth-reminder-email">aaron@techzu.co</p>
                                                    </div>
                                                    <div class="data-row col-6">
                                                        <label for=""><span class="required-sign">*</span>5th Email for Reminder</label>
                                                        <p class="entry-data" id="esop-entries-view-fifth-reminder-email">aaron@techzu.co</p>
                                                    </div>
                                                    <div class="data-row col-12">
                                                        <label for="" >Note</label>
                                                        <p class="entry-data" id="esop-entries-view-note">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eum neque hic, repellat modi fugiat ut, aspernatur iure dignissimos reiciendis excepturi nostrum, assumenda dolorum vel! Incidunt accusamus accusantium nobis iusto qui.</p>
                                                    </div>
                                                    <div class="data-row col-12 text-end">
                                                        <button type="button" class="close-view-btn btn" data-bs-dismiss="modal" aria-label="Close">Close</button>
                                                    </div>
                                                </div>
                                                {{--<div class="data-body row">
                                                    <div class="data-row col-6">
                                                        <label for="member"><span class="required-sign">*</span>Member</label>
                                                        <select class="form-control form-select col-10" name="member" id="member" required disabled>
                                                            <option value hidden></option>
                                                            <option value selected>Anderson</option>
                                                            <option value>Jennifer</option>
                                                            <option value>Alibaba Sin</option>
                                                            <option value>Jess Lim</option>
                                                        </select>
                                                    </div>
                                                    <div class="data-row col-6">
                                                        <label for="status"><span class="required-sign">*</span>Status</label>
                                                        <select class="form-control form-select col-10" name="status" id="status" required disabled>
                                                            <option value hidden></option>
                                                            <option value>Reserved</option>
                                                            <option value selected>Issued</option>
                                                            <option value>Exercised</option>
                                                        </select>
                                                    </div>
                                                    <div class="data-row col-6">
                                                        <label for="issue-date"><span class="required-sign">*</span>Issue Date</label>
                                                        <input type="date" name="issue_date" class="form-control" id="issue-date" value="2023-06-01" required disabled>
                                                    </div>
                                                    <div class="data-row col-6">
                                                        <label for="vesting-period"><span class="required-sign">*</span>Vesting Period (Month)</label>
                                                        <input type="number" name="vesting_period" class="form-control" id="vesting-period" value="12" required disabled>
                                                    </div>
                                                    <div class="data-row col-6">
                                                        <label for="granted-date"><span class="required-sign">*</span>Date of Granted</label>
                                                        <input type="date" name="granted_date" class="form-control" id="granted-date" value="2023-06-01" required disabled>
                                                    </div>
                                                    <div class="data-row col-6">
                                                        <label for="number-of-share"><span class="required-sign">*</span>Number of Share</label>
                                                        <input type="number" name="number_of_share" class="form-control" id="number-of-share" value="5000" required disabled>
                                                    </div>
                                                    <div class="data-row col-6">
                                                        <label for="reminder-date">Reminder Date</label>
                                                        <input type="date" name="reminder_date" class="form-control" id="reminder-date" value="2023-08-01" disabled>
                                                    </div>
                                                    <div class="data-row col-6">
                                                        <label for="reminder-email-1">1st Email for Reminder</label>
                                                        <input type="email" name="reminder_email_1" class="form-control" id="reminder-email-1" value="example1@gmail.com" required disabled>
                                                    </div>
                                                    <div class="data-row col-6">
                                                        <label for="reminder-email-2">2nd Email for Reminder</label>
                                                        <input type="email" name="reminder_email_2" class="form-control" id="reminder-email-2" value="example2@gmail.com" required disabled>
                                                    </div>
                                                    <div class="data-row col-6">
                                                        <label for="reminder-email-3">3rd Email for Reminder</label>
                                                        <input type="email" name="reminder_email_3" class="form-control" id="reminder-email-3"  value="example3@gmail.com" required disabled>
                                                    </div>
                                                    <div class="data-row col-6">
                                                        <label for="reminder-email-4">4th Email for Reminder</label>
                                                        <input type="email" name="reminder_email_4" class="form-control" id="reminder-email-4"  value="example4@gmail.com" required disabled>
                                                    </div>
                                                    <div class="data-row col-6">
                                                        <label for="reminder-email-5">5th Email for Reminder</label>
                                                        <input type="email" name="reminder_email_5" class="form-control" id="reminder-email-5"  value="example5@gmail.com" required disabled>
                                                    </div>
                                                    <div class="data-row col-12">
                                                        <label for="amount-raised">Note</label>
                                                        <textarea name class="form-control" id cols="30" rows="3" disabled></textarea>
                                                    </div>
                                                    <div class="data-row col-12 text-end">
                                                        <button type="submit" class="create-user-btn btn" id="add-user" data-bs-dismiss="modal" aria-label="Close">Close</button>
                                                    </div>
                                                </div>--}}
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Entries View Modal Ends -->

                        <!-- Entries Delete Modal Starts -->
                        <div class="modal fade" id="entriesDeleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="entriesDeleteModalLabel" aria-hidden="true">
                            <div class="modal-dialog delete-modal">
                                <form action="" id="entriesDeleteForm" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <div class="modal-content">
                                        <div class="delete-modal-body">
                                            <p class="text-center">Comfirm Delete</p>
                                            <div class="text-center">
                                                <button type="button" class="btn btn-sm delete-modal-close-btn" data-bs-dismiss="modal" aria-label="No">No</button>
                                                <button type="submit" class="btn btn-sm yes-btn">Yes</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- Entries Delete Modal Ends -->

                        <!-- Entries Portion Ends -->

                        <!--Member Create Modal Starts -->
                        <div class="modal fade" id="memberCreateModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="memberCreateModalLabel" aria-hidden="true">
                            @include('esopEntries.admin.partials.create_member')
                        </div>
                        <!-- Member Create Modal Ends -->


                        <!-- Documents Portion Starts -->
                        <!-- Create Documents Portion Starts -->
                        @include('esopDocuments.admin.partials.create')
                        <!-- Create Documents Portion Ends -->
                        <!--View Documents Portion Starts -->
                        <div class="back-btn-div tabcontent adminEsopTabContent esop-view-doc">
                            <button class="back-btn btn" onclick="goBack(event, 'documents')"><i class="fa-solid fa-arrow-left"></i>
                            </button>
                        </div>
                        @include('esopDocuments.admin.partials.view')
                        <!--View Documents Portion Ends -->
                        <!-- Documents Table starts -->
                        @include('esopDocuments.admin.partials.index')
                        <!-- Documents  Table ends -->
                        <!-- Documents Portion Ends -->
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- Main Body End -->
@endsection

@push('customScripts')
    @yield('createEntryJs')
    @yield('editEntryJs')
    @yield('addMemberJs')
    @yield('esopDocumentTableJs')
    @yield('esopDocumentCreateJs')
    @yield('esopViewDataJs')
    <script>
        // Overview Graph
        var overview_data = [];
        var chartDom = document.getElementById('overviewBarChart');
        var myChart = echarts.init(chartDom);
        // Upcoming Execrise

        var ESOPUpcomingExerciseUrl = "{{ route('esop.overview.index','per_page=5') }}";
        // ESOP Entries
        var ESOPEntriesUrl = "{{ route('esop-entry.index') }}";


        $(document).ready(function(){
            // console.log($('option:selected',this).data("name"))
            $('.esop-current-company-selection').text($('#esop-company').find(':selected').data("name"))
            // ESOP DOCUMENT
            $('#EsopLoadingDiv').hide();

            $("#addMemberLoadingDiv").hide();
            $("#createEsopEntriesLoadingDiv").hide();
            $("#editEsopEntriesLoadingDiv").hide();
            $(".select2").select2();
            $(".select2").select2({
                allowClear: true
            });
            $('.refresh-btn').click(function(){
                location.reload();
            })
            $('.admin-doc-create-send-btn').click(function(){
                $('.admin-doc-create-submit-btn').click();
            })
            var esopActiveEvent = localStorage.getItem('esopActiveEvent');
            console.log('esopActiveEvent :', esopActiveEvent);
            var company = localStorage.getItem('esopCompany');
            console.log('company :', company);
            var selectCompany = $('#esop-company').val()
            if(selectCompany === ''){
                $('#activity-defaultOpen').click();
            }
            else if(selectCompany !== '' && esopActiveEvent === null) {
                $('#activity-overview-btn').click();
            }
            else if(esopActiveEvent && company){
                // $('#esop-company').val(company)
                $('#activity-'+esopActiveEvent+'-btn').click()
            }else{
                tabcontent = document.getElementsByClassName("adminEsopTabContent");
                for (i = 0; i < tabcontent.length; i++) {
                    tabcontent[i].style.display = "none";
                }
                document.getElementById('defaultTab').style.display = "block";
            }

            var entryStatus = document.getElementsByName("entry-status");
            var countDocuments = entryStatus.length;
            for (var i = 0; i < countDocuments; i++){
                console.log(entryStatus[i].innerHTML)
                if(entryStatus[i].innerHTML == "Exercised"){
                    entryStatus[i].style.color = "#979797";
                }else if(entryStatus[i].innerHTML == "Issued"){
                    entryStatus[i].style.color = "#FF9C14";
                }else{
                    entryStatus[i].style.color = "#000000";
                }
            }
            styleDocStatus()



        })
        function styleDocStatus() {
            var docStatus = document.getElementsByName("doc-status");
            var countTickets = docStatus.length;
            for (var i = 0; i < countTickets; i++){
                if(docStatus[i].innerHTML == "Active"){
                    docStatus[i].style.color = "#52C41A";
                    docStatus[i].style.border = "1px solid #52C41A";
                    docStatus[i].style.backgroundColor = "#F4FFE3";
                }
                if(docStatus[i].innerHTML == "Completed"){
                    docStatus[i].style.color = "#52C41A";
                    docStatus[i].style.border = "1px solid #52C41A";
                    docStatus[i].style.backgroundColor = "#F4FFE3";
                }
                else if(docStatus[i].innerHTML == "Cancelled"){
                    docStatus[i].style.color = "#EB2F96";
                    docStatus[i].style.border = "1px solid #FFADD2";
                    docStatus[i].style.backgroundColor = "#FFF0F6";
                }
                else if(docStatus[i].innerHTML == "Draft"){
                    docStatus[i].style.color = "#A7A7A7";
                    docStatus[i].style.border = "1px solid #A7A7A7";
                    docStatus[i].style.backgroundColor = "#F4F4F4";
                }
                else if(docStatus[i].innerHTML == "Pending"){
                    docStatus[i].style.color = "#FF9C14";
                    docStatus[i].style.border = "1px solid #FF9C14";
                    docStatus[i].style.backgroundColor = "#FFEDC8";
                }
            }
        }

        function esopCompanySelect() {
            let companyId = $("select option:selected").val()
            var url = "<?php echo e(route('esop.set-company-esop', ':companyId')); ?>";
            url = url.replace(':companyId', companyId);
            $('#select_company').attr('action', url);
        }



        // var tabHistory = [];
        function adminEsopTab(evt, eventName) {
            if($('#esop-company').val() !== ""){
                var i, tabcontent, tablinks,elements;
                tabcontent = document.getElementsByClassName("adminEsopTabContent");
                for (i = 0; i < tabcontent.length; i++) {
                    tabcontent[i].style.display = "none";
                }
                tablinks = document.getElementsByClassName("adminEsopTabLinks");
                for (i = 0; i < tablinks.length; i++) {
                    tablinks[i].className = tablinks[i].className.replace(" active", "");
                }

                // document.getElementById(eventName).style.display = "block";

                elements = document.getElementsByClassName(eventName);
                for (i = 0; i < elements.length; i++) {
                    elements[i].style.display = "block";
                }
                $('#activity-'+eventName+'-btn').addClass("active")
                switch (eventName) {
                    case "entries":
                        headerText = "ESOP - Entries";
                        fetchESOPEntriesData(ESOPEntriesUrl)
                        break;
                    case "documents":
                        headerText = "ESOP - Documents";
                        fetchEsopData()
                        break;
                    case "overview":
                        headerText = "ESOP - Overview";
                        fetchESOPOverviewData();
                        fetchESOPUpcomingExerciseData(ESOPUpcomingExerciseUrl);
                        break;
                    case "defaultTab":
                        headerText = "ESOP";
                        break;
                    default:
                        headerText = "ESOP";
                }
                localStorage.setItem('esopActiveEvent', eventName);
                localStorage.setItem('esopCompany', $('#esop-company').val());
                console.log('esopCompany', localStorage.getItem('esopCompany'))
                var pageHeaderChange = document.getElementById("page-header")
                pageHeaderChange.innerHTML = headerText

                let pageHeaderText = document.getElementById("page-header").innerHTML;
                let pageHeaderTextShort = pageHeaderText.slice( 22, 50);
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
            }else{
                var i, tabcontent, tablinks,elements;
                tabcontent = document.getElementsByClassName("adminEsopTabContent");
                for (i = 0; i < tabcontent.length; i++) {
                    tabcontent[i].style.display = "none";
                }

                elements = document.getElementsByClassName('defaultTab');
                for (i = 0; i < elements.length; i++) {
                    elements[i].style.display = "block";
                }
            }
        }

        function goBack (event, eventName) {
            var i;
            var tabcontent = document.getElementsByClassName("adminEsopTabContent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }

            var elements = document.getElementsByClassName(eventName);
            for (i = 0; i < elements.length; i++) {
                elements[i].style.display = "block";
            }
            event.currentTarget.className += " active";
            console.log('Tab:'.tabcontent)
            console.log('Element:'.elements)
            // console.log('Class:'.className)
        }

        function adminDocCreateTab(evt, eventName,e) {
            var i, tabcontent, tablinks,elements;
            tabcontent = document.getElementsByClassName("adminEsopTabContent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }

            elements = document.getElementsByClassName(eventName);
            for (i = 0; i < elements.length; i++) {
                elements[i].style.display = "block";
            }
            evt.currentTarget.className += " active";
            if (eventName == 'esop-view-doc') {
                fetchEsopViewData(e.id)
            }

        }

       /* document.addEventListener("DOMContentLoaded", function() {
            var chartDom = document.getElementById('overviewBarChart');
            var myChart = echarts.init(chartDom);

            var initialData = [
                { value: 63.36, name: "Available", shares: 6970 },
                { value: 28.73, name: "Issued", shares: 3160 },
                { value: 7.91, name: "Excercised", shares: 870},
            ];

            var colors = ["#355FCB", "#93AFFD", "#979797"];

            var totalPercentage = initialData.reduce((total, item) => total + item.value, 0).toFixed(2);
            var totalShares = initialData.reduce((total, item) => total + item.shares, 0);

            var option = {
                tooltip: {
                    show: false
                },
                legend: {
                    left: '5%',
                    bottom: '5%',
                    itemWidth: 14,
                    itemHeight: 14,
                    itemGap: 80,
                    textStyle: {
                        fontSize: 13,
                        color: '#262626',
                        fontWeight: 700,
                    },
                    data: initialData.map(item => item.name),

                    formatter: function (name) {
                        var dataIndex = initialData.findIndex(item => item.name === name);
                        var percentage = initialData[dataIndex].value.toFixed(2);
                        var shares = initialData[dataIndex].shares;

                        // Add extra spaces for bold effect
                        // var boldSharesText = shares.toString().split('').join(' ');

                        return name + '\n' + shares + '|' + percentage + '%';
                    }

                },
                graphic: [
                    {
                        type: 'group',
                        right: '5%',
                        bottom: '5%',
                        children: [
                            {
                                type: 'text',
                                z: 100,
                                left: 'center',
                                top: 'bottom',
                                style: {
                                    text: 'Reserved',
                                    fill: '#000',
                                    fontSize: 14,
                                    fontWeight: 700
                                }
                            },
                            {
                                type: 'text',
                                z: 100,
                                left: 'center',
                                top: 'top',
                                style: {
                                    text: totalShares + ' |' + totalPercentage + '%',
                                    fill: '#262626',
                                    fontSize: 14,
                                    fontWeight: 700
                                }
                            }
                        ]
                    }
                ],
                grid: {
                    left: '0%',
                    right: '5%',
                    height: '80%',
                    bottom: '40%',
                    containLabel: true
                },
                xAxis: {
                    type: 'value',
                    show: false
                },
                yAxis: {
                    type: 'category',
                    data: initialData.map(item => item.name),
                    show: false,
                },
                series: initialData.map((item, index) => ({
                    name: item.name,
                    type: 'bar',
                    stack: 'total',
                    label: {
                        show: false,
                        position: 'inside'
                    },
                    emphasis: {
                        focus: 'series'
                    },
                    data: [item.value],
                    itemStyle: {
                        color: colors[index]
                    }
                }))
            };

            option && myChart.setOption(option);
        });*/
/*
        $(window).resize(function() {
            var chartDom = document.getElementById('overviewBarChart');
            var myChart = echarts.init(chartDom);

            var initialData = [
                { value: 63.36, name: "Available", shares: 6970 },
                { value: 28.73, name: "Issued", shares: 3160 },
                { value: 7.91, name: "Excercised", shares: 870},
            ];

            var colors = ["#355FCB", "#93AFFD", "#979797"];

            var totalPercentage = initialData.reduce((total, item) => total + item.value, 0).toFixed(2);
            var totalShares = initialData.reduce((total, item) => total + item.shares, 0);

            var option = {
                tooltip: {
                    show: false
                },
                legend: {
                    left: '5%',
                    bottom: '5%',
                    itemWidth: 14,
                    itemHeight: 14,
                    itemGap: 80,
                    textStyle: {
                        fontSize: 13,
                        color: '#262626',
                        fontWeight: 700,
                    },
                    data: initialData.map(item => item.name),

                    formatter: function (name) {
                        var dataIndex = initialData.findIndex(item => item.name === name);
                        var percentage = initialData[dataIndex].value.toFixed(2);
                        var shares = initialData[dataIndex].shares;

                        // Add extra spaces for bold effect
                        // var boldSharesText = shares.toString().split('').join(' ');

                        return name + '\n' + shares + '|' + percentage + '%';
                    }

                },
                graphic: [
                    {
                        type: 'group',
                        right: '5%',
                        bottom: '5%',
                        children: [
                            {
                                type: 'text',
                                z: 100,
                                left: 'center',
                                top: 'bottom',
                                style: {
                                    text: 'Reserved',
                                    fill: '#000',
                                    fontSize: 14,
                                    fontWeight: 700
                                }
                            },
                            {
                                type: 'text',
                                z: 100,
                                left: 'center',
                                top: 'top',
                                style: {
                                    text: totalShares + ' |' + totalPercentage + '%',
                                    fill: '#262626',
                                    fontSize: 14,
                                    fontWeight: 700
                                }
                            }
                        ]
                    }
                ],
                grid: {
                    left: '0%',
                    right: '5%',
                    height: '80%',
                    bottom: '40%',
                    containLabel: true
                },
                xAxis: {
                    type: 'value',
                    show: false
                },
                yAxis: {
                    type: 'category',
                    data: initialData.map(item => item.name),
                    show: false,
                },
                series: initialData.map((item, index) => ({
                    name: item.name,
                    type: 'bar',
                    stack: 'total',
                    label: {
                        show: false,
                        position: 'inside'
                    },
                    emphasis: {
                        focus: 'series'
                    },
                    data: [item.value],
                    itemStyle: {
                        color: colors[index]
                    }
                }))
            };

            option && myChart.setOption(option);
        });
*/

        $(document).on('click', ".cancel-btn", function() {
            $(this).parent('div').remove();
        });

        function disableTransfer(checkbox) {
            if(checkbox.checked == true){
                document.getElementById("transfer").removeAttribute("disabled");
            }else{
                document.getElementById("transfer").setAttribute("disabled", "disabled");
            }
        }


/*
========================================================================================================================
                    Overview
========================================================================================================================
*/
        // Overview graph
        $('#asOnDate').on('change', function () {
            fetchESOPOverviewData()
        });

        function fetchESOPOverviewData() {
            let date = $('#asOnDate').val();
            let url = "{{ route('esop.overview.graph',"date=") }}" + date
            $.ajax({
                url: url,
                success: function (res) {
                    console.log('res: ',res)
                    overview_data = calculateData(res);
                    console.log('overview_share_types',overview_data)

                    showGraphOverview(overview_data);
                    // showTableData(overview_share_types);
                }
            });
        }

        function showGraphOverview(overview_data) {
            if (overview_data.length > 0) {
                console.log('overview_data.length', overview_data.length)
                var reserved_share_obj = overview_data.find((item) => item.name === 'Reserved')
                // var overview_data = overview_data.filter((item) => item.name !=='Reserved')
                var initialData = overview_data.filter((item) => item.name !== 'Reserved');
                // [
                //     { value: 63.36, name: "Available", shares: 6970 },
                //     { value: 28.73, name: "Issued", shares: 3160 },
                //     { value: 7.91, name: "Excercised", shares: 870},
                // ];

                var colors = ["#355FCB", "#93AFFD", "#979797"];

                // var totalPercentage = initialData.reduce((total, item) => total + item.value, 0).toFixed(2);
                // var totalShares = initialData.reduce((total, item) => total + item.shares, 0);
                var totalPercentage = reserved_share_obj.value;
                var totalShares = reserved_share_obj.shares;

                var option = {
                    tooltip: {
                        show: false
                    },
                    legend: {
                        left: '5%',
                        bottom: '5%',
                        itemWidth: 14,
                        itemHeight: 14,
                        itemGap: 80,
                        textStyle: {
                            fontSize: 13,
                            color: '#262626',
                            fontWeight: 700,
                        },
                        data: initialData.map(item => item.name),

                        formatter: function (name) {
                            var dataIndex = initialData.findIndex(item => item.name === name);
                            var percentage = initialData[dataIndex].value.toFixed(2);
                            var shares = initialData[dataIndex].shares;

                            // Add extra spaces for bold effect
                            // var boldSharesText = shares.toString().split('').join(' ');

                            return name + '\n' + shares + '|' + percentage + '%';
                        }

                    },
                    graphic: [
                        {
                            type: 'group',
                            right: '5%',
                            bottom: '5%',
                            children: [
                                {
                                    type: 'text',
                                    z: 100,
                                    left: 'center',
                                    top: 'bottom',
                                    style: {
                                        text: 'Reserved',
                                        fill: '#000',
                                        fontSize: 14,
                                        fontWeight: 700
                                    }
                                },
                                {
                                    type: 'text',
                                    z: 100,
                                    left: 'center',
                                    top: 'top',
                                    style: {
                                        text: totalShares + ' |' + totalPercentage + '%',
                                        fill: '#262626',
                                        fontSize: 14,
                                        fontWeight: 700
                                    }
                                }
                            ]
                        }
                    ],
                    grid: {
                        left: '0%',
                        right: '5%',
                        height: '80%',
                        bottom: '40%',
                        containLabel: true
                    },
                    xAxis: {
                        type: 'value',
                        show: false
                    },
                    yAxis: {
                        type: 'category',
                        data: initialData.map(item => item.name),
                        show: false,
                    },
                    series: initialData.map((item, index) => ({
                        name: item.name,
                        type: 'bar',
                        stack: 'total',
                        label: {
                            show: false,
                            position: 'inside'
                        },
                        emphasis: {
                            focus: 'series'
                        },
                        data: [item.value],
                        itemStyle: {
                            color: colors[index]
                        }
                    }))
                };

                option && myChart.setOption(option);
            }
            else {
                console.log('overview_data.length is 0')
                $('#overviewBarChart').empty().html('<p class="text-center">No Data available</p>')
            }
        }

        function calculateData(data) {
            let reserved_share_obj = data.find((item)=> item.status === 'Reserved')
            let filtered_data = data.filter((param) => param.status !== 'Reserved');
            // console.log('reserved_share_obj', reserved_share_obj);
            // console.log('filtered_data', filtered_data);
            var result = [];
            if (reserved_share_obj) {
                let filter_total_share = filtered_data.reduce((total_share_number, obj) => parseInt(obj.total_sum) + total_share_number, 0)
                // console.log('filter_total_share', filter_total_share);
                let available_share_number = parseInt(reserved_share_obj.total_sum) - filter_total_share;
                result = [
                    {
                        value: parseFloat((100).toFixed(2)),
                        name: "Reserved",
                        shares: parseInt(reserved_share_obj.total_sum)
                    },
                    {
                        value: (parseFloat(((available_share_number / parseInt(reserved_share_obj.total_sum)) * 100).toFixed(2))),
                        name: "Available",
                        shares: available_share_number
                    }
                ];
                for (let i of filtered_data) {
                    let obj = {};
                    obj["value"] = parseFloat(((parseInt(i.total_sum) / parseInt(reserved_share_obj.total_sum)) * 100).toFixed(2));
                    obj["name"] = i.status[0].toUpperCase() + i.status.slice(1);
                    obj["shares"] = parseInt(i.total_sum);

                    result.push(obj);
                }
            }
            /*else {
                result = [
                    {
                        value: 0.00,
                        name: "Reserved",
                        shares: 0
                    },
                    {
                        value: 0.00,
                        name: "Available",
                        shares: 0
                    },
                    {
                        value: 0.00,
                        name: "Issued",
                        shares: 0
                    },
                    {
                        value: 0.00,
                        name: "Exercised",
                        shares: 0
                    }
                ];
            }*/
            return result;
        }

//======================================================================================================================

        // Upcoming Exercise
        function fetchESOPUpcomingExerciseData(ESOPUpcomingExerciseUrl) {
            console.log('fetchESOPUpcomingExerciseData');
            console.log('ESOPUpcomingExerciseUrl : ', ESOPUpcomingExerciseUrl);
            $.ajax({
                url: ESOPUpcomingExerciseUrl,
                success: function (res) {
                    console.log('fetchESOPUpcomingExerciseData res: ',res)
                    ESOPUpcomingExerciseTableBuild(res)

                }
            });
        }

        function ESOPUpcomingExerciseTableBuild(object) {
            console.log('ESOPUpcomingExerciseTableBuild()')
            let wrapper = '#esop-overview-table-body';
            let html = '';

            if(object.data.length === 0) {
                html += '<tr><td class="text-center" colspan="4">No Data Available</td></tr>';
            }
            else {
                $.map(object.data, function(item){
                    html += `<tr>
                                <td class="description-data">${item.granted_date}</td>
                                <td class="description-data">${item.member.name}</td>
                                <td class="description-data">${item.no_of_share}</td>
                                <td class="description-data">
                                    <a href="#" class="action-buttons" data-id="${item.id}" onclick="fetchEditData(this)" data-bs-toggle="modal" data-bs-target="#entriesEditModal">Edit</a>
                                    <a href="#" class="action-buttons delete-btn" data-id="${item.id}" onclick="onEsopDelete(this)" data-bs-toggle="modal" data-bs-target="#entriesDeleteModal">Delete</a>
                                </td>
                            </tr>`
                })
            }
            console.log(html);
            $(wrapper).empty().append(html)

            buildESOPUpcomingExerciseTablePagination(object)
        }


        function buildESOPUpcomingExerciseTablePagination(object) {
            console.log('buildESOPUpcomingExerciseTablePagination()')
            let pagination_wrapper= "#pagination-wrapper"
            $(pagination_wrapper).html(appendPaginator)
            determinePaginationArrow(object)
            $('#esop-upcoming-exercise-left-number').text(object.current_page)
            $('#esop-upcoming-exercise-right-number').text(object.last_page)

            $("#esop-upcoming-exercise-left-arrow").removeAttr('href')
            $("#esop-upcoming-exercise-right-arrow").removeAttr('href')

            $("#esop-upcoming-exercise-left-arrow").attr('data-href', object.prev_page_url)
            $("#esop-upcoming-exercise-right-arrow").attr('data-href', object.next_page_url)
        }
        function appendPaginator() {
            return `<div class="select-pagination-portion table-bottom-portion row g-0">
                    <div class="pagination-part bottom-pagination-part col-12 col-md-5 col-lg-4">
                        <a href="" data-href="" class="btn left-arrow" id="esop-upcoming-exercise-left-arrow"><i class="fa-solid fa-chevron-left"></i></a>
                        <span class="pagination-number pagination-left-number" id="esop-upcoming-exercise-left-number"></span>
                        <span class="pagination-divider">/</span>
                        <span class="pagination-number pagination-right-number" id="esop-upcoming-exercise-right-number"></span>
                        <a href="" data-href="" class="btn right-arrow" id="esop-upcoming-exercise-right-arrow"><i class="fa-solid fa-chevron-right"></i></a>
                        </div>
                    </div>`
        }
        function determinePaginationArrow(obj) {
            console.log('determinePaginationArrow()');
            let left_arrow = ""
            let right_arrow = ""
            left_arrow = "#esop-upcoming-exercise-left-arrow"
            right_arrow = "#esop-upcoming-exercise-right-arrow"

            if (obj.current_page > 1) {
                if ($(left_arrow).hasClass("d-none") == true) {
                    $(left_arrow).removeClass('d-none')
                }
            } else {
                $(left_arrow).addClass('d-none')
            }
            if (obj.current_page == obj.last_page) {
                $(right_arrow).addClass('d-none')
            } else {
                $(right_arrow).removeClass('d-none')
            }
        }


        $(document).on('click', '#esop-upcoming-exercise-left-arrow', function () {
            var page = $(this).attr('data-href').split('page=')[1];
            if ($(this).attr('data-href') != '') {
                ESOPUpcomingExerciseUrl = "/esop/overview?per_page=5&page="+page
                // if ($(this).hasClass('member-base')){
                //
                // }
                // else if($(this).hasClass('as-on-filter')){
                //     var filterParam = $(this).attr('data-href').split('?')[0].split('/')[4]
                //     url = "cap-table-members-as-on-filter/" + filterParam + "?page="+page
                // }else if($(this).hasClass('member-search')){
                //     var searchParam = $(this).attr('data-href').split('?')[0].split('/')[4]
                //     url = "cap-table-members-search/" + searchParam + "?search="+searchParam+"&page="+page
                // }
                fetchESOPUpcomingExerciseData(ESOPUpcomingExerciseUrl);
            }
        })

        $(document).on('click', '#esop-upcoming-exercise-right-arrow', function () {
            var page = $(this).attr('data-href').split('page=')[1];
            if ($(this).attr('data-href') != '') {
                ESOPUpcomingExerciseUrl = "/esop/overview?per_page=5&page="+page
                // if ($(this).hasClass('member-base')){
                // }
                // else if($(this).hasClass('as-on-filter')){
                //     var filterParam = $(this).attr('data-href').split('?')[0].split('/')[4]
                //     url = "cap-table-members-as-on-filter/" + filterParam + "?page="+page
                // }else if($(this).hasClass('member-search')){
                //     var searchParam = $(this).attr('data-href').split('?')[0].split('/')[4]
                //     url = "cap-table-members-search/" + searchParam + "?search="+searchParam+"&page="+page
                // }
                fetchESOPUpcomingExerciseData(ESOPUpcomingExerciseUrl);
            }
        })
//======================================================================================================================

        // ESOP Entries
        function fetchESOPEntriesData(ESOPEntriesUrl) {
            console.log('fetchESOPEntriesData');
            console.log('ESOPEntriesUrl : ', ESOPEntriesUrl);
            $.ajax({
                url: ESOPEntriesUrl,
                success: function (res) {
                    console.log('fetchESOPEntriesData res: ',res)

                    ESOPEntriesTableBuild(res)
                }
            });
        }

        function ESOPEntriesTableBuild(object) {
            // console.log('ESOPUpcomingExerciseTableBuild()', object)
            let wrapper = '#esop-entries-table';
            let html = `<div class="table-rows row g-0">
            <div class="col-2 header-div">
                <span>Issue Date</span>
            </div>
            <div class="col-2 header-div">
                <span>Date of Granted</span>
            </div>
            <div class="col-2 header-div">
                <span>Name</span>
            </div>
            <div class="col-2 header-div">
                <span>Status</span>
            </div>
            <div class="col-2 header-div">
                <span>Number of Shares</span>
            </div>
            <div class="col-2 header-div">
                <span>Action</span>
            </div>
        </div>`;

            console.log('condition checking')
            if(object.data.length === 0) {
                console.log('data length 0')
                html += `<div class="table-rows row g-0"><div class="col-12 data-div text-center">NO Data Available</div></div>`;
            }
            else {
                $.map(object.data, function(item){
                    html += `<div class="table-rows row g-0">
                                <div class="col-2 data-div">
                                    <span>${item.issue_date}</span>
                                </div>
                                <div class="col-2 data-div">
                                    <span>${item.granted_date}</span>
                                </div>
                                <div class="col-2 data-div">
                                    <span>${item.member.name}</span>
                                </div>
                                <div class="col-2 data-div">
                                    <span name="entry-status">${item.status}</span>
                                </div>
                                <div class="col-2 data-div">
                                    <span>${item.no_of_share}</span>
                                </div>
                                <div class="col-2 action-div">
                                    <button type="button" class="btn esop-entry-view-modal" data-id="${item.id}">View</button>
                                    <button type="button" data-id="${item.id}" onclick="fetchEditData(this)" class="btn" data-bs-toggle="modal" data-bs-target="#entriesEditModal">Edit</button>
                                    <button type="button" class="btn delete-btn" data-bs-toggle="modal" data-bs-target="#entriesDeleteModal" data-id="${item.id}" onclick="onEsopDelete(this)">Delete</button>
                                </div>
                            </div>`
                })
            }
            // console.log('esop-entries-table: ', html)
            $(wrapper).empty().append(html)

            buildESOPEntriesTablePagination(object)
        }

        function onEsopDelete(e) {
            // document.getElementById('entriesDeleteForm').setAttribute('action', '')
            const formId = e.getAttribute('data-id')
            url = "{{route('esop-entry.delete',':id')}}"
            url=url.replace(':id', formId)
            console.log(formId)
            console.log(url)

            document.getElementById('entriesDeleteForm').setAttribute('action',url )
        }

        function buildESOPEntriesTablePagination(object) {
            console.log('buildESOPEntriesTablePagination()')
            let pagination_wrapper= "#esop-entry-pagination-wrapper"
            $(pagination_wrapper).html(appendESOPEntriesPaginator)
            determineESOPEntriesPaginationArrow(object)
            $('#esop-entries-left-number').text(object.current_page)
            $('#esop-entries-right-number').text(object.last_page)

            $("#esop-entries-left-arrow").removeAttr('href').attr('data-href', object.prev_page_url)
            $("#esop-entries-right-arrow").removeAttr('href').attr('data-href', object.next_page_url)

            // $("#esop-entries-left-arrow")
            // $("#esop-entries-right-arrow")
        }
        function appendESOPEntriesPaginator() {
            return `<div class="select-pagination-portion table-bottom-portion row g-0">
                    <div id="esop-entry-pagination-part" class="pagination-part bottom-pagination-part col-12 col-md-5 col-lg-4">
                        <a href="" data-href="" class="btn left-arrow" id="esop-entries-left-arrow"><i class="fa-solid fa-chevron-left"></i></a>
                        <span class="pagination-number pagination-left-number" id="esop-entries-left-number"></span>
                        <span class="pagination-divider">/</span>
                        <span class="pagination-number pagination-right-number" id="esop-entries-right-number"></span>
                        <a href="" data-href="" class="btn right-arrow" id="esop-entries-right-arrow"><i class="fa-solid fa-chevron-right"></i></a>
                        </div>
                    </div>`
        }
        function determineESOPEntriesPaginationArrow(obj) {
            console.log('determineESOPEntriesPaginationArrow()');
            let left_arrow = ""
            let right_arrow = ""
            left_arrow = "#esop-entries-left-arrow"
            right_arrow = "#esop-entries-right-arrow"

            if (obj.current_page > 1) {
                if ($(left_arrow).hasClass("d-none") == true) {
                    $(left_arrow).removeClass('d-none')
                }
            } else {
                $(left_arrow).addClass('d-none')
            }
            if (obj.current_page == obj.last_page) {
                $(right_arrow).addClass('d-none')
            } else {
                $(right_arrow).removeClass('d-none')
            }
        }
        $(document).on('click', '#esop-entries-left-arrow', function () {
            console.log($(this));
            var page = $(this).attr('data-href').split('page=')[1];
            if ($(this).attr('data-href') != '') {
                ESOPEntriesUrl = "/esop-entry?page="+page

                let search_value = $('#esop-entries-search').val();
                if(search_value !== '' || search_value !== ' ') {
                    ESOPEntriesUrl = "/esop-entry?search="+search_value+"&page="+page
                }

                // if ($(this).hasClass('member-base')){
                //
                // }
                // else if($(this).hasClass('as-on-filter')){
                //     var filterParam = $(this).attr('data-href').split('?')[0].split('/')[4]
                //     url = "cap-table-members-as-on-filter/" + filterParam + "?page="+page
                // }else if($(this).hasClass('member-search')){
                //     var searchParam = $(this).attr('data-href').split('?')[0].split('/')[4]
                //     url = "cap-table-members-search/" + searchParam + "?search="+searchParam+"&page="+page
                // }
                fetchESOPEntriesData(ESOPEntriesUrl);
            }
        });
        $(document).on('click', '#esop-entries-right-arrow', function () {
            console.log($(this));
            var page = $(this).attr('data-href').split('page=')[1];
            if ($(this).attr('data-href') != '') {
                ESOPEntriesUrl = "/esop-entry?per_page=5&page="+page

                let search_value = $('#esop-entries-search').val();
                if(search_value !== '' || search_value !== ' ') {
                    ESOPEntriesUrl = "/esop-entry?search="+search_value+"&page="+page
                }
                // if ($(this).hasClass('member-base')){
                // }
                // else if($(this).hasClass('as-on-filter')){
                //     var filterParam = $(this).attr('data-href').split('?')[0].split('/')[4]
                //     url = "cap-table-members-as-on-filter/" + filterParam + "?page="+page
                // }else if($(this).hasClass('member-search')){
                //     var searchParam = $(this).attr('data-href').split('?')[0].split('/')[4]
                //     url = "cap-table-members-search/" + searchParam + "?search="+searchParam+"&page="+page
                // }
                fetchESOPEntriesData(ESOPEntriesUrl);
            }
        });

        // Search ESOP Entries
        $('#esop-entries-search-btn').on('click', function(){
            let search_value = $('#esop-entries-search').val();
            if(search_value !== '' || search_value !== ' '){
                ESOPEntriesUrl = "/esop-entry?search="+search_value

                // fetchESOPEntriesData(ESOPEntriesUrl);
            }
            fetchESOPEntriesData(ESOPEntriesUrl);
        });

        $(document).on('click', '.esop-entry-view-modal', function(){
            console.log(this);
            console.log( $(this).data('id') );

            let url = "{{ route('esop.overview.show', ':id') }}";
            url=url.replace(':id', $(this).data('id'));

            $.ajax({
                url: url,
                success: function (res) {
                    console.log('overview show res: ',res);
                    // ESOPUpcomingExerciseTableBuild(res)

                    $('#esop-entries-view-member').empty().html(res.member.name);
                    $('#esop-entries-view-status').empty().html(res.status);
                    $('#esop-entries-view-issue-date').empty().html(res.issue_date);
                    $('#esop-entries-view-vesting-period').empty().html(res.vesting_period);
                    $('#esop-entries-view-date-of-granted').empty().html(res.granted_date);
                    $('#esop-entries-view-no-of-share').empty().html(res.no_of_share);
                    $('#esop-entries-view-reminder-date').empty().html(res.reminder_date);
                    $('#esop-entries-view-first-reminder-email').empty().html(res.first_reminder_email);
                    $('#esop-entries-view-second-reminder-email').empty().html(res.second_reminder_email);
                    $('#esop-entries-view-third-reminder-email').empty().html(res.third_reminder_email);
                    $('#esop-entries-view-forth-reminder-email').empty().html(res.forth_reminder_email);
                    $('#esop-entries-view-fifth-reminder-email').empty().html(res.fifth_reminder_email);
                    $('#esop-entries-view-note').empty().html(res.note);

                    $('#entryViewModal').modal('show');



                }
            });
        });
//======================================================================================================================
    </script>
@endpush
