@extends('layouts.master')
@section('content')

    <!-- Main Body Start -->
    <div class="main-body">
        @if(session()->has('success'))
            <div class="alert alert-success">
                <img class="alert-img" src="{{asset('assets/icons/success-alert-icon.png')}}" alt="">
                <p class="alert-text">{{session('success')}}</p>
            </div>
        @endif
        <div class="row customer-captable-body g-0">
            <div class="col-12 col-md-2 col-sm-12 card customer-captable-button-card">
                <div class="card-body customer-captable-button-body">
                    <div class="tab-buttons">
{{--                        <button class="tablinks customerCapTableTabLinks" id="defaultOpen" onclick="customerCapTableTab(event,'overview')">Overview</button>--}}
                        <button class="tablinks customerCapTableTabLinks" id="activity-overview-btn" onclick="customerCapTableTab(event,'overview')">Overview</button>
                        <button class="tablinks customerCapTableTabLinks" id="activity-members-btn" onclick="customerCapTableTab(event,'members')">Members</button>
                        <button class="tablinks customerCapTableTabLinks" id="activity-activity-entries-btn" onclick="customerCapTableTab(event,'activity-entries')">Activity Entries</button>
                        <button class="tablinks customerCapTableTabLinks" id="activity-certificates-btn" onclick="customerCapTableTab(event,'certificates')">Certificates</button>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-10 col-sm-12">
                <div class="card customer-captable-card">
                    <div class="card-body customer-captable-content-body">
                        <!-- Overview Portion Starts -->
                        <div id="overview" class="tabcontent customerCapTableTabContent overview overview-manage-body">
                            <div class="card captable-overview-card col-12 col-md-12 col-lg-12">
                                <div class="card-body overview-card-body">
                                    <div class="overview-card-header">
                                        <h6 class="header-text">Cap Table Overview</h6>
                                    </div>
                                    <div class="date-div">
                                        <label for="asOnDate">As On:</label>
                                        <input type="date" id="asOnDate" name="asOnDate" value="{{ date('Y-m-d') }}" class="form-control-sm my-1">
                                    </div>
                                    <div class="col-12 col-md-12 col-lg-12">
                                        <div class="pie-chart-container">
                                            <div id="overviewPieChart" class="overview-pie-chart"></div>

                                        </div>

                                    </div>
                                    <div class="overview-card-footer">
                                        <div class="">
                                            <input type="checkbox" class="urgent-checkbox mt-2 me-1" name="" id="convertibleSelect" checked>
                                            <span class="mt-0">Include Convertible Note</span>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="card captable-overview-table-card">
                                <div class="card-body overview-card-body">
                                    <div class="table-responsive">
                                        <table class="captable-overview-table">
                                            <thead>
                                            <tr>
                                                <th class="description-header">Type of Shares</th>
                                                <th class="description-header">Number of Shares</th>
                                                <th class="description-header">Ownership</th>
                                                <th class="description-header">Amount Raised</th>
                                            </tr>
                                            </thead>
                                            <tbody id="overview-table-body">
                                            <!-- Main row start -->
                                            <tr>
                                                <td class="description-data">Ordinary</td>
                                                <td class="description-data">60,870</td>
                                                <td class="description-data">60.87%</td>
                                                <td class="description-data">$100,000.00</td>
                                            </tr>
                                            <tr>
                                                <td class="description-data">Preference</td>
                                                <td class="description-data">60,870</td>
                                                <td class="description-data">60.87%</td>
                                                <td class="description-data">$100,000.00</td>
                                            </tr>
                                            <tr>
                                                <td class="description-data">ESOP</td>
                                                <td class="description-data">60,870</td>
                                                <td class="description-data">60.87%</td>
                                                <td class="description-data">$100,000.00</td>
                                            </tr>
                                            <tr id="convertible">
                                                <td class="description-data">Convertible</td>
                                                <td class="description-data">60,870</td>
                                                <td class="description-data">60.87%</td>
                                                <td class="description-data">$100,000.00</td>
                                            </tr>
                                            <tr>
                                                <td class="description-data">Total</td>
                                                <td class="description-data">60,870</td>
                                                <td class="description-data">60.87%</td>
                                                <td class="description-data">$100,000.00</td>
                                            </tr>
                                            <!-- Main row end -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Overview Portion Ends -->

                        <!--DEBJIT UPDATED CODE START--><!--DEBJIT UPDATED CODE START--><!--DEBJIT UPDATED CODE START-->

                        <!-- Member Portion Starts -->
                        <!-- Member  Table starts -->
                        <div id="members" class="tabcontent customerCapTableTabContent members">
                            <!--Member js added in this index page -->
                            @include('capTableMembers.partials.customer.memberCustomerTable')
                        </div>
                        <!--Member Table ends -->
                        <!-- Member Portion Ends -->
                        <!-- Activity Entries Portion Starts -->
                        <!-- Activity Entries Table starts -->
                        <div id="activity-entries" class="tabcontent customerCapTableTabContent activity-entries">
                            <div class="select-pagination-portion table-top-portion row g-0">
                                <!-- responsive task: change col class in this row -->

                                <div class="sb-part search-box-part col-12 col-md-4 offset-lg-1 col-lg-5">
                                    <form action="" method="GET" id="search_form">
                                        @csrf
                                        <div class="d-flex form-inputs search-data">
                                            <input class="form-control" type="text" name="search" id="search" value="{{request()->has('search') ? request()->get('search') : ''}}" placeholder=" Member">
                                            <button type="submit" onclick="searchActivity()" class="search-btn btn"><i class="fa-solid fa-search"></i></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- responsive task: get table inside div  -->
                            <div class="table-responsive">
                                <div class="activity-manage-body">
                                    <div
                                        class="activities row g-0">
                                        <div class="col-2 col-md-2 col-lg-2 header-div">
                                            <span>Transaction Date</span>
                                        </div>
                                        <div class="col-1 col-md-1 col-lg-1 header-div">
                                            <span>Funding Round</span>
                                        </div>
                                        <div class="col-2 col-md-2 col-lg-2 header-div">
                                            <span>Shared Certificate ID</span>
                                        </div>
                                        <div
                                            class="col-2 col-md-2 col-lg-2 header-div member-div">
                                            <span>Member</span>
                                        </div>
                                        <div class="col-1 col-md-1 col-lg-1 header-div">
                                            <span>Type of Share</span>
                                        </div>
                                        <div class="col-1 col-md-1 col-lg-1 header-div">
                                            <span>Number of Share</span>
                                        </div>
                                        <div class="col-2 col-md-2 col-lg-2 header-div amount-div">
                                            <span>Amount</span>
                                        </div>
                                        <div class="col-1 col-md-1 col-lg-1 header-div action-div">
                                            <span>Action</span>
                                        </div>
                                    </div>
                                    @forelse($contentData as $item)
                                    <div class="activities row g-0">
                                        <div class="col-2 col-md-2 col-lg-2 document-div">
                                            <span>{{\Carbon\Carbon::parse($item->transaction_date)->format('d M Y') }}</span>
                                        </div>
                                        <div class="col-1 col-md-1 col-lg-1 document-div">
                                            <p>{{ ucfirst($item->funding_round) }}</p>
                                        </div>
                                        <div class="col-2 col-md-2 col-lg-2 document-div">
                                            <p>{{ $item->share_certificate_id }}</p>
                                        </div>
                                        <div class="col-2 col-md-2 col-lg-2 document-div member-div">
                                            <div class="col-2 data-div">
                                                <span>{{$item->member->name ?? ''}}</span>
                                            </div>
                                        </div>
                                        <div class="col-1 col-md-1 col-lg-1 document-div">
                                            <p>{{ ucfirst( $item->share_type )}}</p>
                                        </div>
                                        <div class="col-1 col-md-1 col-lg-1 document-div">
                                            @if($item->share_type === 'ordinary' && $item->is_transfer_share)
                                            <p class="text-danger">({{ abs((int)$item->share_number) }})</p>
                                            @elseif($item->share_type === 'ordinary' && !$item->is_transfer_share)
                                            <p class="text-success">{{ $item->share_number }}</p>
                                            @else
                                            <p>{{ $item->share_number }}</p>
                                            @endif
                                        </div>
                                        <div class="col-2 col-md-2 col-lg-2 document-div amount-div">
                                            <p>{{number_format($item->amount, 2, '.', ',')}}</p>
                                        </div>
                                        <div class="col-1 col-md-1 col-lg-1 action-div">
                                            <a href="#" class="action-buttons" data-bs-toggle="modal" data-bs-target="#activityViewModal{{ $item->id }}">View</a>
                                            <!-- Company Create Modal Start -->
                                            <div class="modal fade" id="activityViewModal{{ $item->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="activityViewModalLabel" aria-hidden="true">
                                                <div class="modal-dialog activity-view-modal">
                                                    <div class="modal-content">
                                                        <div class="activity-view-modal-body">
                                                            <div class="activity-view-modal-header row">
                                                                <h5 class="modal-title col-11" id="activityViewModalLabel">View Entry</h5>
                                                                <button type="button" class="btn btn-close btn-sm activity-view-modal-close-btn col-1" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="activity-view-modal-data row">
                                                                <form action="#">
                                                                    <div class="data-body row">
                                                                        <div class="data-row col-6">
                                                                            <label for=""><span class="required-sign">*</span>Share Certificate ID</label>
                                                                            <p class="entry-data">{{ $item->share_certificate_id }}</p>
                                                                        </div>
                                                                        <div class="data-row col-6 col-md-6">
                                                                            <label for=""><span class="required-sign">*</span>Founding Round</label>
                                                                            <p class="entry-data">{{ucfirst($item->funding_round) }}</p>
                                                                        </div>
                                                                        <div class="data-row fye-row col-6 col-md-6">
                                                                            <label for=""><span class="required-sign">*</span>Transaction Date</label>
                                                                            <p class="entry-data">{{\Carbon\Carbon::parse($item->transaction_date)->format('d M Y') }}</p>
                                                                        </div>
                                                                        <div class="data-row col-6 col-md-6">
                                                                            <label for=""><span class="required-sign">*</span>Type of Share</label>
                                                                            <p class="entry-data">{{ ucfirst($item->share_type) }}</p>
                                                                        </div>
                                                                        <div class="data-row col-6">
                                                                            <label for=""><span class="required-sign">*</span>Member</label>
                                                                            <p class="entry-data">{{ $item->member->name ?? ''}}</p>
                                                                        </div>
                                                                        <div class="data-row col-6">
                                                                            <label for=""><span class="required-sign">*</span>Amount Raised</label>
                                                                            <p class="entry-data">{{ $item->amount }}</p>
                                                                        </div>
                                                                        <div class="data-row col-6">
                                                                            <label for=""><span class="required-sign">*</span>Number of Share</label>
                                                                            <p class="entry-data">{{ $item->share_number }}</p>
                                                                        </div>
                                                                        @if($item->transferMember()->exists())
                                                                        <div class="data-row col-6">
                                                                            <label for=""><span class="required-sign">*</span>Transfer To</label>
                                                                            <p class="entry-data">{{ $item->transferMember->name }}</p>
                                                                        </div>
                                                                        @endif
                                                                        <div class="data-row col-12">
                                                                            <label for="" class="entry-data">Note</label>
                                                                            <p class="entry-data">{{ $item->note }}</p>
                                                                        </div>
                                                                        <div class="data-row col-12 text-end">
                                                                            <button type="button" class="close-view-btn btn" data-bs-dismiss="modal" aria-label="Close">Close</button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- View Entry Modal End -->
                                        </div>
                                    </div>
                                    @empty
                                        <div class="activities row g-0">
                                            <div class="col-12 col-md-12 col-lg-12 document-div text-center">
                                                <span class="text-danger">No Data Available</span>
                                            </div>
                                        </div>
                                    @endforelse


                                </div>
                            </div>
                            <div
                                class="select-pagination-portion table-bottom-portion row g-0">
                                <!-- responsive task: change col class in this row -->
                                <div class="pagination-part bottom-pagination-part col-12 col-md-5 col-lg-4">
                                    @if($contentData->currentPage() > 1)
                                        <a href="{{$contentData->previousPageUrl()}}" class="btn"><i class="fa-solid fa-chevron-left"></i></a>
                                    @endif
                                    <span class="pagination-number pagination-left-number">{{$contentData->currentPage()}}</span>
                                    <span class="pagination-divider">/</span>
                                    <span class="pagination-number pagination-right-number">{{$contentData->lastPage()}}</span>
                                    @if($contentData->currentPage() != $contentData->lastPage())
                                        <a href="{{$contentData->nextPageUrl()}}" class="btn"><i class="fa-solid fa-chevron-right"></i></a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!--Activity Entries Table ends -->
                        <!-- Share Certificate Portion Starts -->
                        <div id="certificates" class="tabcontent customerCapTableTabContent certificates">
                            @include('capTableShareCertificate.customer.partials.certificateCustomerTable')
                        </div>
                        <!-- Share Certificate Portion Ends -->

                        <!--DEBJIT UPDATED CODE END--><!--DEBJIT UPDATED CODE END--><!--DEBJIT UPDATED CODE END-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Main Body End -->
@endsection
@push('customScripts')
    @yield('certificateCustomerTableJs')
    <script>

        var overview_share_types = [];
        // var convertable_object = {};
        $(document).ready(function(){
            // Get the element with id="defaultOpen" and click on it
            //
            // call overview data from backend
            fetchOverviewData();
            var activeEvent = localStorage.getItem('customerActiveEvent');
            // console.log(activeEvent)
            if (activeEvent == null) {
                // $('#activity-overview-btn').click();
                document.getElementById("activity-overview-btn").click();
            }
            //
            if (activeEvent) {
                // $('#company').val(company)

                $('#activity-' + activeEvent + '-btn').click()
            }

            //prepare the data for graph and dom load the table in the success response

        })

        function displayFileName(fileId , inputId) {
            var fileInput = document.getElementById(inputId);
            $("#" + fileId).val(fileInput.files[0].name);
        }

        function goBack (event, eventName) {
            var i;
            var tabcontent = document.getElementsByClassName("customerCapTableTabContent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }

            var elements = document.getElementsByClassName(eventName);
            for (i = 0; i < elements.length; i++) {
                elements[i].style.display = "block";
            }
            event.currentTarget.className += " active";
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

        function domLoad(res){
            let wrapper='#t-body'
            let table=''

            $.map(res, function(value,i){
                console.log('AR',value.last_ar_filed)
                let editUrl = "{{ route('company.edit', ':slug') }}"
                editUrl=editUrl.replace(':slug', value.slug)

                let showUrl = "{{ route('company.show', ':slug') }}"
                showUrl=showUrl.replace(':slug', value.slug)

                let deleteUrl= "{{route('company.destroy', ':slug')}}"
                deleteUrl=deleteUrl.replace(':slug', value.slug)

                table+=`<tr class="row g-0">
                            <td class="name-data col-3 col-md-3 col-lg-3 col-xl-3">${value.name}</td>
                            <td class="status-data col-1 col-md-1 col-lg-1 col-xl-1"><span class="company-status">${ucfirst(value.status)}</span></td><td class="fye-data col-2 col-md-2 col-lg-2 col-xl-1">${$.date(value.fye, 'fye')}</td>` +
                    `<td class="startDate-data col-2 col-md-2 col-lg-2 col-xl-1">${$.date(value.incorporation_date)}</td>`
                    + (value.last_ar_filed != null ? `<td class="renewal-data col-2 col-md-1 col-lg-2 col-xl-1">${$.date(value.last_ar_filed)}</td>` : `<td class="renewal-data text-center col-2 col-md-1 col-lg-2 col-xl-1">--</td>`)+
                    (value.last_agm_filed != null ? `<td class="renewal-data col-2 col-md-1 col-lg-2 col-xl-1">${$.date(value.last_agm_filed)}</td>` : `<td class="renewal-data text-center col-2 col-md-1 col-lg-2 col-xl-1">--</td>`)+

                    (value.invoices.length > 0 ? `<td class="renewal-data col-2 col-md-2 col-lg-2 col-xl-1">${$.date(value.invoices[0].subscription_end)}</td>` : `<td class="renewal-data text-center col-2 col-md-2 col-lg-2 col-xl-1">--</td>`)+


                    `<td class="action-data col-2 col-md-2 col-lg-2 col-xl-2">
                <a href="${showUrl}" class="action-buttons view">View</a>
                <a href="${editUrl}" class="edit action-buttons edit-btn">Edit</a>
                <a href="#" class="del action-buttons delete-btn"  data-bs-toggle="modal" onclick="onDelete(this)" id="${deleteUrl}" data-bs-target="#companyDeleteModalCopy-${value.slug}">Delete</a>
                <div class="modal fade" id="companyDeleteModalCopy-${value.slug}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="companyDeleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog company-delete-modal">
                     <form id="delForm" method="POST">
                            {{csrf_field()}}
                    {{ method_field('DELETE') }}
                    <div class="modal-content">
                        <div class="company-delete-modal-body">
                            <p class="text-center">Confirm Delete</p>
                            <div class="text-center">
                                <button type="button" class="btn btn-sm company-delete-modal-close-btn" data-bs-dismiss="modal" aria-label="No">No</button>
                                <button type="submit" class="btn btn-sm yes-btn">Yes</button>
                            </div>
                        </div>
                    </div>
                </form
            </div>
        </div>
    </td>
</tr>`
            })
            $(wrapper).empty().append(table)

        }

        function searchActivity() {
            let search = $('#search').val()
            var url = "<?php echo e(route('activity_entry.search', ':search')); ?>";
            url = url.replace(':search', search);
            $('#search_form').attr('action', url)
        }

        // $('.cancel-btn').on('click', function() {
        //     $(this).parent('div').remove();
        //     console.log("testing","hihi");
        // });
        $(document).on('click', ".cancel-btn", function() {
            $(this).parent('div').remove();
            // $('#element').show("slow");
        });

        {{--$('#search').on('keyup', function () {--}}
        {{--    removeClassFromPaginationArrow('filterByName')--}}
        {{--    removeClassFromPaginationArrow('sortCompany')--}}
        {{--    let value=""--}}
        {{--    // let wrapper = "#t-body"--}}
        {{--    $("input[name='search']").each(function() {--}}
        {{--        if (this.value.length != 0){--}}
        {{--            value=this.value;--}}
        {{--        }else {--}}
        {{--            value=0;--}}
        {{--        }--}}
        {{--    });--}}
        {{--    let url = "{{ route('cap-table.index', ':search') }}"--}}
        {{--    url=url.replace(':search', value)--}}
        {{--    $.ajax({--}}
        {{--        url: url,--}}
        {{--        success: function(res) {--}}
        {{--            // console.log('when search is empty:',res)--}}
        {{--            determinePaginationArrow(res)--}}
        {{--            //--}}
        {{--            $('.pagination-left-number').text(res.current_page)--}}
        {{--            $('.pagination-right-number').text(res.last_page)--}}
        {{--            injectClass('searchCompany')--}}
        {{--            $(".pagination-part .left-arrow").attr('data-href', res.prev_page_url)--}}
        {{--            $(".pagination-part .right-arrow").attr('data-href', res.next_page_url)--}}
        {{--            domLoad(res.data)--}}
        {{--            styleCompanyStatus("company-status")--}}
        {{--        }--}}
        {{--    });--}}
        {{--})--}}
        function customerCapTableTab(evt, eventName) {
            var i, tabcontent, tablinks,elements;
            tabcontent = document.getElementsByClassName("customerCapTableTabContent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("customerCapTableTabLinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }

            // document.getElementById(eventName).style.display = "block";

            elements = document.getElementsByClassName(eventName);
            for (i = 0; i < elements.length; i++) {
                elements[i].style.display = "block";
            }
            $('#activity-' + eventName + '-btn').addClass("active")
            // evt.currentTarget.className += " active";

            if(eventName=='members'){
                fetchMembersData()
            }else if(eventName=='certificates'){
                fetchShareCertificateCustomerData()
            }

            // console.log(eventName)
            localStorage.setItem('customerActiveEvent', eventName);
            console.log(localStorage.getItem('customerActiveEvent'))

        }



        /*
        * ==============================================================================================================
        *       Overview
        * ==============================================================================================================
        * */


        var chart = echarts.init(document.getElementById('overviewPieChart'));
        document.addEventListener("DOMContentLoaded", function () {
            // Get the table row
            var convertibleRow = document.getElementById('convertible');

            // Toggle visibility on checkbox click
            var checkbox = document.getElementById('convertibleSelect');
            checkbox.addEventListener('change', function () {
                var initialData = overview_share_types;

                if (checkbox.checked) {
                    convertibleRow.style.display = 'table-row';
                }
                else {
                    // Hide the "Convertible Note" from the data array
                    filterData = initialData.filter(item => item.name !== 'Convertible');
                    initialData=[];
                    initialData = calculateData(filterData)
                    // Hide the table row
                    convertibleRow.style.display = 'none';
                }
                console.log('chart initialData', initialData)
                // Update the chart with the new data
                showGraphOverview(initialData);
                showTableData(initialData);
            });
        });

        $(window).resize(function () {
            var initialData = overview_share_types;

            var colors = ["#56BB6C", "#4D7CFE", "#FBDE70", "#777777"];

            var chartOptions = {
                grid: {
                    left: '10%',  // Adjust the left margin
                    right: '50%', // Adjust the right margin
                },
                series: [{
                    type: 'pie',
                    radius: '70%',
                    center: ['35%', '40%'], // Adjust the center of the pie chart
                    data: initialData,
                    label: {
                        show: true,
                        position: 'outside',
                        formatter: function (params) {
                            var dataIndex = params.dataIndex;
                            var percentage = ((initialData[dataIndex].value / initialData.reduce((a, b) => a + b.value, 0)) * 100).toFixed(2);
                            return '{b|' + params.name + '}\n{d|' + percentage + '%}\n{c|' + initialData[dataIndex].shares + ' shares}';
                        },
                        rich: {
                            b: {
                                fontWeight: 'bold',
                                lineHeight: 18,
                            },
                            d: {
                                lineHeight: 18,
                            },
                            c: {
                                lineHeight: 18,
                            }
                        }
                    }
                }],
                color: colors,
                tooltip: {
                    show: false
                },
                legend: {
                    orient: 'vertical',
                    right: '2%', // Adjust the right position
                    top: '15%',
                    textStyle: {
                        fontSize: 14
                    },
                    formatter: function (name) {
                        var dataIndex = 0;
                        for (var i = 0; i < initialData.length; i++) {
                            if (initialData[i].name === name) {
                                dataIndex = i;
                                break;
                            }
                        }
                        var percentage = ((initialData[dataIndex].value / initialData.reduce((a, b) => a + b.value, 0)) * 100).toFixed(2);
                        return name + " Share ";
                    }
                },
                labelLine: {
                    show: false
                }
            };

            var chart = echarts.init(document.getElementById('overviewPieChart'));
            chart.setOption(chartOptions);

            // Get the table row
            var convertibleRow = document.getElementById('convertible');

            // Toggle visibility on checkbox click
            var checkbox = document.getElementById('convertibleSelect');
            checkbox.addEventListener('change', function () {
                var initialData = overview_share_types;

                if (checkbox.checked) {
                    console.log('checked')
                    convertibleRow.style.display = 'table-row';
                }
                else {
                    console.log('uncheck')
                    // Hide the "Convertible Note" from the data array
                    filterData = initialData.filter(item => item.name !== 'Convertible');
                    initialData = calculateData(filterData)
                    // Hide the table row
                    convertibleRow.style.display = 'none';
                }
                // Update the chart with the new data
                showGraphOverview(initialData);
                showTableData(initialData);
            });
        });


        function fetchOverviewData() {
            let date = $('#asOnDate').val();
            let url = "{{ route('cap-table-overview.index',"date=") }}"+date
            $.ajax({
                url: url,
                success: function(res) {
                    // console.log('res: ',res)
                    overview_share_types = calculateData(res)
                    // console.log('overview_share_types',overview_share_types)

                    showGraphOverview(overview_share_types);
                    showTableData(overview_share_types);
                }
            });
        }

        function showTableData(data_rows) {
            console.log("showTableData")
            var table_row = '';
            var total_shares = 0;
            var total_ownership = 0.00;
            var total_amount = 0.00;

            for (let value of data_rows) {
                total_shares = total_shares + parseInt(value.shares)
                total_ownership = total_ownership + parseFloat(value.value)
                total_amount = total_amount + parseFloat(value.total_amount)
                table_row += `<tr id="${value.name[0].toLowerCase() + value.name.slice(1)}">
                                <td class="description-data">${value.name}</td>
                                <td class="description-data">${numberWithCommas( value.shares )}</td>
                                <td class="description-data">${value.value}%</td>
                                <td class="description-data">$${numberWithCommas( parseFloat(value.total_amount).toFixed(2) )}</td>
                            </tr>`;
            }
            table_row += `<tr id="total">
                                <td class="description-data">Total</td>
                                <td class="description-data">${numberWithCommas( total_shares )}</td>
                                <td class="description-data">${total_ownership}%</td>
                                <td class="description-data">$${numberWithCommas( parseFloat(total_amount).toFixed(2) )}</td>
                            </tr>`;


            $('#overview-table-body').empty().append(table_row);
        }

        function showGraphOverview(overview_share_types) {
            var initialData = overview_share_types;
            var colors = ["#56BB6C", "#4D7CFE", "#FBDE70", "#777777"];
            var chartOptions = {
                grid: {
                    left: '10%',  // Adjust the left margin
                    right: '50%', // Adjust the right margin
                },
                series: [{
                    type: 'pie',
                    radius: '70%',
                    center: ['35%', '40%'], // Adjust the center of the pie chart
                    data: initialData,
                    label: {
                        show: true,
                        position: 'outside',
                        formatter: function (params) {
                            var dataIndex = params.dataIndex;
                            // console.log("initialData : ",initialData)
                            var percentage = ((initialData[dataIndex].value / initialData.reduce((a, b) => a + b.value, 0)) * 100).toFixed(2);
                            return '{b|' + params.name + '}\n{d|' + percentage + '%}\n{c|' + initialData[dataIndex].shares + ' shares}';
                        },
                        rich: {
                            b: {
                                fontWeight: 'bold',
                                lineHeight: 18,
                            },
                            d: {
                                lineHeight: 18,
                            },
                            c: {
                                lineHeight: 18,
                            }
                        }
                    }
                }],
                color: colors,
                tooltip: {
                    show: false
                },
                legend: {
                    orient: 'vertical',
                    right: '2%', // Adjust the right position
                    top: '15%',
                    textStyle: {
                        fontSize: 14
                    },
                    formatter: function (name) {
                        var dataIndex = 0;
                        for (var i = 0; i < initialData.length; i++) {
                            if (initialData[i].name === name) {
                                dataIndex = i;
                                break;
                            }
                        }
                        var percentage = ((initialData[dataIndex].value / initialData.reduce((a, b) => a + b.value, 0)) * 100).toFixed(2);
                        return name + " Share ";
                    }
                },
                labelLine: {
                    show: false
                }
            };
            chart.setOption(chartOptions);
        }

        function calculateData(data) {
            let total_share_number = data.reduce((total_share_number, obj) => parseInt(obj.shares) + total_share_number,0)
            let total_amount = data.reduce((total_amount, obj) => obj.total_amount + total_amount , 0.00)
            console.log('total',[total_share_number,total_amount])
            result = []
            for (let i of data){
                let obj = {}
                obj["value"] = parseFloat( ( (parseInt(i.shares) / total_share_number) * 100 ).toFixed(2) );
                obj["name"] = i.name[0].toUpperCase() + i.name.slice(1);
                obj["shares"] = parseInt(i.shares);
                obj["total_amount"] = parseFloat(i.total_amount);
                result.push(obj)
            }
            console.log('calculateData result:', result)
            return result
        }

        $('#asOnDate').on('change', function() {
            fetchOverviewData()
        });


        // CAP TABLE MEMBER JS START
        let url=''
        $(document).on('click', '.pagination-part .left-arrow', function () {
            var page = $(this).attr('data-href').split('page=')[1];
            if ($(this).attr('data-href') != '') {
                if ($(this).hasClass('member-base')){
                    url = "/cap-table-members?page="+page
                }else if($(this).hasClass('as-on-filter')){
                    var filterParam = $(this).attr('data-href').split('?')[0].split('/')[4]
                    url = "cap-table-members-as-on-filter/" + filterParam + "?page="+page
                }else if($(this).hasClass('member-search')){
                    var searchParam = $(this).attr('data-href').split('?')[0].split('/')[4]
                    url = "cap-table-members-search/" + searchParam + "?search="+searchParam+"&page="+page
                }
                fetch_data(url);
            }
        })
        $(document).on('click', '.pagination-part .right-arrow', function () {
            var page = $(this).attr('data-href').split('page=')[1];
            if ($(this).attr('data-href') != '') {
                if ($(this).hasClass('member-base')){
                    url = "/cap-table-members?page="+page
                }else if($(this).hasClass('as-on-filter')){
                    var filterParam = $(this).attr('data-href').split('?')[0].split('/')[4]
                    url = "cap-table-members-as-on-filter/" + filterParam + "?page="+page
                }else if($(this).hasClass('member-search')){
                    var searchParam = $(this).attr('data-href').split('?')[0].split('/')[4]
                    url = "cap-table-members-search/" + searchParam + "?search="+searchParam+"&page="+page
                }
                fetch_data(url);
            }
        })
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
        function fetch_data(url) {
            $.ajax({
                type: "GET",
                url: url,
                success: function (obj) {
                    determinePaginationArrow(obj)
                    // $('#left-arrow').addClass('as-on-filter')
                    // $('#right-arrow').addClass('as-on-filter')

                    $('#left-number').text(obj.data.current_page)
                    $('#right-number').text(obj.data.last_page)

                    // $("#left-arrow").removeAttr('href')
                    // $("#right-arrow").removeAttr('href')

                    $("#left-arrow").attr('data-href', obj.data.prev_page_url)
                    $("#right-arrow").attr('data-href', obj.data.next_page_url)


                    memberTableDomLoad(obj)

                    // window.location.reload()
                }
            })
        }
        function fetchMembersData() {

            let pagination_wrapper= "#pagination-wrapper"
            let indexUrl="{{route('capTableMembers.index')}}"
            $.ajax({
                type: "GET",
                url: indexUrl,
                success: function (obj) {
                    $(pagination_wrapper).html(appendPaginator)
                    determinePaginationArrow(obj)
                    removeClassFromPaginationArrow('as-on-filter')
                    removeClassFromPaginationArrow('member-search')
                    addClassInPaginationArrow('member-base')

                    $('#left-number').text(obj.data.current_page)
                    $('#right-number').text(obj.data.last_page)

                    $("#left-arrow").removeAttr('href')
                    $("#right-arrow").removeAttr('href')

                    $("#left-arrow").attr('data-href', obj.data.prev_page_url)
                    $("#right-arrow").attr('data-href', obj.data.next_page_url)


                    memberTableDomLoad(obj)

                    // window.location.reload()
                }
            })
        }
        function getAsOnDateData(e) {
            let pagination_wrapper= "#pagination-wrapper"
            let url="{{route('members.asOn', ':asOn')}}"
            url=url.replace(':asOn', e)
            $.ajax({
                type: "GET",
                url: url,
                success: function (obj) {
                    $(pagination_wrapper).html(appendPaginator)
                    determinePaginationArrow(obj)
                    addClassInPaginationArrow('as-on-filter')
                    removeClassFromPaginationArrow('member-base')
                    removeClassFromPaginationArrow('member-search')
                    $('#left-number').text(obj.data.current_page)
                    $('#right-number').text(obj.data.last_page)

                    $("#left-arrow").removeAttr('href')
                    $("#right-arrow").removeAttr('href')

                    $("#left-arrow").attr('data-href', obj.data.prev_page_url)
                    $("#right-arrow").attr('data-href', obj.data.next_page_url)


                    memberTableDomLoad(obj)

                    // window.location.reload()
                }
            })
        }
        function determinePaginationArrow(obj) {
            let left_arrow = ""
            let right_arrow = ""
            left_arrow = "#left-arrow"
            right_arrow = "#right-arrow"

            if (obj.data.current_page > 1) {
                if ($(left_arrow).hasClass("d-none") == true) {
                    $(left_arrow).removeClass('d-none')
                }
            } else {
                $(left_arrow).addClass('d-none')
            }
            if (obj.data.current_page == obj.data.last_page) {
                $(right_arrow).addClass('d-none')
            } else {
                $(right_arrow).removeClass('d-none')
            }
        }
        function memberTableDomLoad(obj){
            let wrapper = '#customer-member-list'
            let html = ''
            let total=obj.total
            if(obj.data.data.length > 0 ){
                $.map(obj, function(item,i){
                    $.map(item.data, function (value) {
                        var individual_member_total_share_number = 0;
                        var individual_member_total_amount = 0;
                        for (var i = 0; i < value.cap_table_activity.length; i++) {
                            individual_member_total_share_number += value.cap_table_activity[i].share_number;
                            individual_member_total_amount += value.cap_table_activity[i].amount;
                        }
                        html+= ` <div class="member row g-0">
                                    <div class="col-2 col-md-2 col-lg-2 document-div">
                                    <a href="#" class="action-buttons" data-bs-toggle="modal" data-id="${value.id}" data-bs-target="#memberViewModal-${value.id}">${value.name}</a>

                                    <div class="modal fade " id="memberViewModal-${value.id}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="memberViewModalLabel" aria-hidden="true">
                                        <div class="modal-dialog member-view-modal">
                                            <div class="modal-content">
                                                <div class="member-view-modal-body">
                                                    <div class="member-view-modal-header row">
                                                        <h6 class="modal-title col-11" id="memberViewModalLabel">${value.name}</h6>
                                                        <button type="button" class="btn btn-close btn-sm member-view-modal-close-btn col-1" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="member-view-modal-data row">
                                                        <form action="#">
                                                            <div class="data-body row">
                                                                <div class="table-responsive">
                                                                    <div class="member-manage-body">
                                                                        <div class="member-body row g-0 header-row">
                                                                            <div class="col-2 col-md-2 col-lg-2 header-div">
                                                                                <span>Transaction Date</span>
                                                                            </div>
                                                                            <div class="col-2 col-md-2 col-lg-2 header-div">
                                                                                <span>Funding Round</span>
                                                                            </div>
                                                                            <div class="col-2 col-md-2 col-lg-2 header-div">
                                                                                <span>Type of Share</span>
                                                                            </div>
                                                                            <div class="col-3 col-md-3 col-lg-3 header-div">
                                                                                <span>Number of Shares</span>
                                                                            </div>
                                                                            <div class="col-3 col-md-3 col-lg-3 header-div">
                                                                                <span>Amount Raised</span>
                                                                            </div>

                                                                        </div>`+
                                                                        (value.cap_table_activity.length > 0 ? (value.cap_table_activity.map((activity) => `<div class="member row g-0">
                                                                        <div class="col-2 col-md-2 col-lg-2 entry-data">
                                                                            <span>${activity.transaction_date}</span>
                                                                            </div>
                                                                            <div class="col-2 col-md-2 col-lg-2 entry-data">
                                                                                <p>${activity.funding_round}</p></div>
                                                                            <div class="col-2 col-md-2 col-lg-2 entry-data">
                                                                                <p>${activity.share_type}</p>
                                                                            </div> <div class="col-3 col-md-3 col-lg-3 entry-data">
                                                                                <p>${activity.share_number}</p>
                                                                            </div> <div class="col-3 col-md-3 col-lg-3 entry-data">
                                                                                <p>$${addCommas(activity.amount)}</p>
                                                                            </div></div>`).join("")) :
                                                                            `<div class="member-body row g-0">
                                                                               <div class="text-center col-12 entry-data">
                                                                                   <span>No Data Available</span>
                                                                               </div>
                                                                             </div>`)+
                                                                        `<div class="member row g-0 footer-row">
                                                                           <div class="col-2 col-md-2 col-lg-2 footer-div">
                                                                               <span>Total</span>
                                                                           </div>
                                                                           <div class="col-2 col-md-2 col-lg-2 footer-div">
                                                                               <p> </p>
                                                                           </div>
                                                                           <div class="col-2 col-md-2 col-lg-2 footer-div">
                                                                               <p> </p>
                                                                           </div>
                                                                           <div class="col-3 col-md-3 col-lg-3 footer-div">
                                                                              <p>${individual_member_total_share_number}</p>
                                                                           </div>
                                                                            <div class="col-3 col-md-3 col-lg-3 footer-div">
                                                                                <p>$${addCommas(individual_member_total_amount)}</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="data-row col-12 text-end">
                                                                    <button type="button" class="close-view-btn btn" data-bs-dismiss="modal" aria-label="Close">Close</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                </div>
                <div class="col-2 col-md-2 col-lg-2 document-div">`+
                            (value.cap_table_sum.length > 0 ? value.cap_table_sum.map((data) => (data.share_type == 'ordinary' ? `<p>${data.sum_of_share_number}</p>` : null)).join("")  : `<p>0</p>`)+
                            `</div>
               <div class="col-2 col-md-2 col-lg-2 document-div">`+
                            (value.cap_table_sum.length > 0 ? value.cap_table_sum.map((data) => (data.share_type == 'preference' ? `<p>${data.sum_of_share_number}</p>` : '')).join("")  : `<p>0</p>`)+

                            `</div>
               <div class="col-2 col-md-2 col-lg-2 document-div member-div">`+
                            (value.cap_table_sum.length > 0 ? value.cap_table_sum.map((data) => (data.share_type == 'esop' ? `<p>${data.sum_of_share_number}</p>` : '')).join("")  : `<p>0</p>`)+

                            `</div>
               <div class="col-1 col-md-1 col-lg-1 document-div">`+
                            (value.cap_table_sum.length > 0 ? value.cap_table_sum.map((data) => (data.share_type == 'convertible' ? `<p>${data.sum_of_share_number}</p>` : '')).join("")  : `<p>0</p>`)+
                            `</div>
               <div class="col-2 col-md-2 col-lg-2 document-div">`+
                            (value.cap_table_total_share_sum.length > 0 ? value.cap_table_total_share_sum.map((data) => `<p>${addCommas(data.sum_of_total_share_number)}</p>`).join("")  : `<p>0</p>`)+
                            `</div>
               <div class="col-1 col-md-1 col-lg-1 document-div">`+
                            (value.cap_table_total_share_sum.length > 0 ? value.cap_table_total_share_sum.map((data) => `<p>${((data.sum_of_total_share_number/total) * 100).toFixed(2)}%</p>`).join("")  : `<p>0</p>`)+
                            `</div>
               </div>`
                    }).join("")
                }).join("")
            }else {
                html+=`<div class="member row g-0">
                           <div class="text-center col-12 document-div">
                               <span>No Data Available</span>
                           </div>
                       </div>`
            }
            $(wrapper).empty().append(html)

        }
        function membersSearchActivity() {
            let pagination_wrapper= "#pagination-wrapper"
            let search = $('#member_search').val()
            var url = "<?php echo e(route('members.search', ':search')); ?>";
            url = url.replace(':search', search);
            $.ajax({
                type: "GET",
                url: url,
                success: function (obj) {
                    $(pagination_wrapper).html(appendPaginator)
                    determinePaginationArrow(obj)
                    addClassInPaginationArrow('member-search')
                    removeClassFromPaginationArrow('member-base')
                    removeClassFromPaginationArrow('as-ob-filter')

                    $('#left-number').text(obj.data.current_page)
                    $('#right-number').text(obj.data.last_page)

                    $("#left-arrow").removeAttr('href')
                    $("#right-arrow").removeAttr('href')

                    $("#left-arrow").attr('data-href', obj.data.prev_page_url)
                    $("#right-arrow").attr('data-href', obj.data.next_page_url)

                    memberTableDomLoad(obj)
                }
            })
        }
        function appendPaginator() {
            return `<div class="select-pagination-portion table-bottom-portion row g-0">
                    <div class="pagination-part bottom-pagination-part col-12 col-md-5 col-lg-4">
                        <a href="" data-href="" class="btn left-arrow" id="left-arrow"><i class="fa-solid fa-chevron-left"></i></a>
                        <span class="pagination-number pagination-left-number" id="left-number"></span>
                        <span class="pagination-divider">/</span>
                        <span class="pagination-number pagination-right-number" id="right-number"></span>
                        <a href="" data-href="" class="btn right-arrow" id="right-arrow"><i class="fa-solid fa-chevron-right"></i></a>
                        </div>
                    </div>`
        }
        function removeClassFromPaginationArrow(className) {
            $('#left-arrow').removeClass(className)
            $('#right-arrow').removeClass(className)
        }
        function addClassInPaginationArrow(className) {
            $('#left-arrow').addClass(className)
            $('#right-arrow').addClass(className)
        }
        $('#member_search').on('keyup', function () {
            if (this.value.length == 0) {
                fetchMembersData()
            }
        })
        //CAP TABLE MEMBER JS END

        //DEBJIT JS END// //DEBJIT JS END// //DEBJIT JS END// //DEBJIT JS END//
    </script>

@endpush
