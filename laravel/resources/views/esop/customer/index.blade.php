@extends('layouts.master')

@section('content')
    <!-- Main Body Start -->
    <div class="main-body">
        @include('partials.successAlert')
        <div class="row customer-esop-body g-0">
            <div class="col-12 col-md-2 col-sm-12 card customer-esop-button-card">
                <div class="card-body customer-esop-button-body">
                    <div class="tab-buttons">
{{--                        <button class="tablinks customerESOPTabLinks" onclick="customerESOPTab(event,'overview')" id="defaultOpen" >Overview</button>--}}
                        <button class="tablinks customerESOPTabLinks" onclick="customerESOPTab(event,'overview')" id="esop-overview-btn" >Overview</button>
                        <button class="tablinks customerESOPTabLinks" onclick="customerESOPTab(event,   'esop-entries')" id="esop-esop-entries-btn">ESOP Entries</button>
                        <button class="tablinks customerESOPTabLinks"  onclick="customerESOPTab(event,  'documents')"  id="esop-documents-btn">Documents</button>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-10 col-sm-12">
                <div class="card customer-esop-card">
                    <div class="card-body customer-esop-content-body">

                        <!-- ESOP Overview Portion Starts -->

                        <div id="overview" class="overview customerESOPTabContent tabcontent overview-manage-body">

                            <div class="card esop-overview-card col-12 col-md-12 col-lg-12">
                                <div class="card-body overview-card-body">
                                    <div class="overview-card-header">
                                        <h6 class="header-text">ESOP Overview</h6>
                                    </div>
                                    <div class="date-div">
                                        <label for="asOnDate">As On:</label>
                                        <input type="date" id="asOnDate" name="asOnDate" value="{{ date('Y-m-d') }}">
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
{{--                                                <td class="description-data"> <a href="#" class="action-buttons" data-bs-toggle="modal" data-bs-target="#entryViewModal">View</a> </td>--}}
{{--                                            </tr>--}}
                                            <!-- Main row end -->
{{--                                            <tr>--}}
{{--                                                <td class="description-data">28 Feb 2024</td>--}}
{{--                                                <td class="description-data">John Neo</td>--}}
{{--                                                <td class="description-data">1800</td>--}}
{{--                                                <td class="description-data"> <a href="#" class="action-buttons" data-bs-toggle="modal" data-bs-target="#entryViewModal">View</a></td>--}}
{{--                                            </tr>--}}
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <dev id="pagination-wrapper"></dev>
{{--                                <div class="select-pagination-portion table-bottom-portion row g-0">--}}
{{--                                    <!-- responsive task: change col class in this row -->--}}
{{--                                    <div class="pagination-part bottom-pagination-part col-12 col-md-5 col-lg-4">--}}
{{--                                        <a href="#" class="btn"><i class="fa-solid fa-chevron-left"></i></a>--}}
{{--                                        <span class="pagination-number pagination-left-number">5</span>--}}
{{--                                        <span class="pagination-divider">/</span>--}}
{{--                                        <span class="pagination-number pagination-right-number">10</span>--}}
{{--                                        <a href="#" class="btn"><i class="fa-solid fa-chevron-right"></i></a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                            </div>
                        </div>

                        <!-- ESOP Overview Portion Ends -->

                        <!-- ESOP Entries Portion Starts -->

                        <!-- ESOP Entries Table starts -->
                        <div id="esop-entries" class="tabcontent customerESOPTabContent esop-entries">
                            <div class="select-pagination-portion table-top-portion row g-0">
                                <div class="sb-part search-box-part col-12 col-md-4 offset-lg-1 col-lg-5">
                                    <div class="d-flex form-inputs search-data">
                                        <input id="esop-entries-search" class="form-control" type="text" placeholder=" Search">
                                        <button id="esop-entries-search-btn" class="search-btn btn"><i class="fa-solid fa-search"></i></button>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <div id="esop-entries-table" class="entries-manage-body">
                                    <div class="entries row g-0">
                                        <div class="col-2 col-md-2 col-lg-2 header-div">
                                            <span>Issue Date</span>
                                        </div>
                                        <div class="col-2 col-md-2 col-lg-2 header-div">
                                            <span>Date of Granted</span>
                                        </div>
                                        <div class="col-2 col-md-2 col-lg-2 header-div">
                                            <span>Name</span>
                                        </div>
                                        <div class="col-2 col-md-2 col-lg-2 header-div ">
                                            <span>Status</span>
                                        </div>
                                        <div class="col-2 col-md-2 col-lg-2 header-div">
                                            <span>Number of Share</span>
                                        </div>
                                        <div class="col-2 col-md-2 col-lg-2 header-div action-div">
                                            <span>Action</span>
                                        </div>
                                    </div>
                                    <div class="entries row g-0">
                                        <div class="col-2 col-md-2 col-lg-2 document-div">
                                            <span>28 Dec 2023</span>
                                        </div>
                                        <div class="col-2 col-md-2 col-lg-2 document-div">
                                            <p>28 Dec 2024</p>
                                        </div>
                                        <div class="col-2 col-md-2 col-lg-2 document-div">
                                            <p>Anderson Goh</p>
                                        </div>
                                        <div class="col-2 col-md-2 col-lg-2 document-div">
                                            <p name="entry-status" class="entry-status">Issued</p>
                                        </div>
                                        <div class="col-2 col-md-2 col-lg-2 document-div">
                                            <p>160</p>
                                        </div>
                                        <div class="col-2 col-md-2 col-lg-2 action-div">
                                            <a href="#" class="action-buttons" data-bs-toggle="modal" data-bs-target="#entryViewModal">View</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="esop-entry-pagination-wrapper"></div>
{{--                            <div class="select-pagination-portion table-bottom-portion row g-0">--}}
{{--                                <!-- responsive task: change col class in this row -->--}}
{{--                                <div class="pagination-part bottom-pagination-part col-12 col-md-5 col-lg-4">--}}
{{--                                    <a href="#" class="btn"><i class="fa-solid fa-chevron-left"></i></a>--}}
{{--                                    <span class="pagination-number pagination-left-number">5</span>--}}
{{--                                    <span class="pagination-divider">/</span>--}}
{{--                                    <span class="pagination-number pagination-right-number">10</span>--}}
{{--                                    <a href="#" class="btn"><i class="fa-solid fa-chevron-right"></i></a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                        </div>
                        <!--ESOP Entries Table ends -->

                        <!-- View Entry Modal Start -->
                        <div class="modal fade" id="entryViewModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="entryViewModalLabel" aria-hidden="true">
                            <div class="modal-dialog entry-view-modal">
                                <div class="modal-content">
                                    <div class="entry-view-modal-body">
                                        <div class="entry-view-modal-header row">
                                            <h5 class="modal-title col-11" id="entryViewModalLabel">View Entry</h5>
                                            <button type="button" class="btn btn-close btn-sm entry-view-modal-close-btn col-1" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="entry-view-modal-data row">
                                            <form action="#">
                                                <div class="data-body row">
                                                    <div class="data-row col-6">
                                                        <label for="member"><span class="required-sign">*</span>Member</label>
                                                        <p class="entry-data" id="esop-entries-view-member"></p>
                                                    </div>
                                                    <div class="data-row col-6 col-md-6">
                                                        <label for="status"><span class="required-sign">*</span>Status</label>
                                                        <p class="entry-data" id="esop-entries-view-status"></p>
                                                    </div>
                                                    <div class="data-row fye-row col-6 col-md-6">
                                                        <label for=""><span class="required-sign">*</span>Issue Date</label>
                                                        <p class="entry-data" id="esop-entries-view-issue-date"></p>
{{--                                                        <input type="date" class="entry-data" value="2023-07-28">--}}
                                                    </div>
                                                    <div class="data-row col-6 col-md-6">
                                                        <label for=""><span class="required-sign">*</span>Vesting Period(Months)</label>
                                                        <p class="entry-data" id="esop-entries-view-vesting-period"></p>
                                                    </div>
                                                    <div class="data-row fye-row col-6">
                                                        <label for=""><span class="required-sign">*</span>Date of Granted</label>
                                                        <p class="entry-data" id="esop-entries-view-date-of-granted"></p>
{{--                                                        <input type="date" class="entry-data" value="2023-07-28" disabled>--}}
                                                    </div>
                                                    <div class="data-row col-6">
                                                        <label for=""><span class="required-sign">*</span>Number of Share</label>
                                                        <p class="entry-data" id="esop-entries-view-no-of-share"></p>
                                                    </div>
                                                    <div class="data-row fye-row col-6">
                                                        <label for=""><span class="required-sign">*</span>Reminder Date</label>
                                                        <p class="entry-data" id="esop-entries-view-reminder-date"></p>
{{--                                                        <input type="date" class="entry-data" value="2023-07-01">--}}
                                                    </div>
                                                    <div class="data-row col-6">
                                                        <label for=""><span class="required-sign">*</span>1st Email for Reminder</label>
                                                        <p class="entry-data" id="esop-entries-view-first-reminder-email"></p>
                                                    </div>
                                                    <div class="data-row col-6">
                                                        <label for=""><span class="required-sign">*</span>2nd Email for Reminder</label>
                                                        <p class="entry-data" id="esop-entries-view-second-reminder-email"></p>
                                                    </div>
                                                    <div class="data-row col-6">
                                                        <label for=""><span class="required-sign">*</span>3rd Email for Reminder</label>
                                                        <p class="entry-data" id="esop-entries-view-third-reminder-email"></p>
                                                    </div>
                                                    <div class="data-row col-6">
                                                        <label for=""><span class="required-sign">*</span>4th Email for Reminder</label>
                                                        <p class="entry-data" id="esop-entries-view-forth-reminder-email"></p>
                                                    </div>
                                                    <div class="data-row col-6">
                                                        <label for=""><span class="required-sign">*</span>5th Email for Reminder</label>
                                                        <p class="entry-data" id="esop-entries-view-fifth-reminder-email"></p>
                                                    </div>
                                                    <div class="data-row col-12">
                                                        <label for="" >Note</label>
                                                        <p class="entry-data desc-data" id="esop-entries-view-note"></p>
                                                    </div>
                                                    <div class="data-row col-12 text-end">
                                                        <button type="button" class="close-view-btn btn mt-4" data-bs-dismiss="modal" aria-label="Close">Close</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- View Entry Modal End -->

                        <!-- ESOP Entries Portion Ends -->

                        <!-- ESOP Documents Portion Starts -->

                        <div id="documents" class="tabcontent customerESOPTabContent documents" >
                           @include('esopDocuments.customer.partials.index')
                        </div>
                        <!-- ESOP Documents Portion Starts -->
                    </div>
                </div>
            </div>

        </div>
        <!-- Main Body End -->
    </div>
    <!-- Main Body End -->
@endsection

@push('customScripts')
    @yield('EsopCustomerIndexJs')
    <script>

        var chartDom = document.getElementById('overviewBarChart');
        var myChart = echarts.init(chartDom);
        // Upcoming Execrise
        var ESOPUpcomingExerciseUrl = "{{ route('esop.overview.index','per_page=5') }}"
        // ESOP Entries
        var ESOPEntriesUrl = "{{ route('esop-entry.index') }}";

        $(document).ready(function(){
            // Get the element with id="defaultOpen" and click on it
            // document.getElementById("defaultOpen").click();
            $(".select2").select2();
            $(".select2").select2({
                allowClear: true
            });
            var activeEvent = localStorage.getItem('customerESOPActiveEvent');
            // console.log(activeEvent)
            if (activeEvent == null) {
                // $('#activity-overview-btn').click();
                // $('#defaultOpen').click();
                document.getElementById("esop-overview-btn").click();
            }
            //
            if (activeEvent) {
                // $('#company').val(company)

                $('#esop-' + activeEvent + '-btn').click()
            }

        })

        function customerESOPTab(evt, eventName) {
            var i, tabcontent, tablinks,elements;
            tabcontent = document.getElementsByClassName("customerESOPTabContent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("customerESOPTabLinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }

            if(eventName === 'overview'){
                fetchESOPUpcomingExerciseData(ESOPUpcomingExerciseUrl);
                fetchESOPOverviewData();
            }
            if(eventName === 'esop-entries') {
                fetchESOPEntriesData(ESOPEntriesUrl);
            }

            elements = document.getElementsByClassName(eventName);
            for (i = 0; i < elements.length; i++) {
                elements[i].style.display = "block";
            }
            $('#esop-' + eventName + '-btn').addClass("active")
            switch (eventName) {
                case "overview":
                    headerText = "ESOP - Overview";
                    break;
                case "esop-entries":
                    headerText = "ESOP - Entries";

                    break;
                case "documents":
                    headerText = "ESOP - Documents";
                    break;
            }

            localStorage.setItem('customerESOPActiveEvent', eventName);
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
        }
/*
        document.addEventListener("DOMContentLoaded", function() {
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
        var docStatus = document.getElementsByName("entry-status");
        var countTickets = docStatus.length;
        for (var i = 0; i < countTickets; i++){
            if(docStatus[i].innerHTML == "Issued"){
                docStatus[i].style.color = "#FF9C14";
            }
            if(docStatus[i].innerHTML == "Reserved"){
                docStatus[i].style.color = "#000000";
            }
            else if(docStatus[i].innerHTML == "Excercised"){
                docStatus[i].style.color = "#979797";
            }
        }
        $(document).on('click', ".cancel-btn", function() {
            $(this).parent('div').remove();
        });

        // $(document).ready(function() {
            // $(".select2").select2();
            // $(".select2").select2({
            //     allowClear: true
            // });
            // var activeEvent = localStorage.getItem('customerESOPActiveEvent');
            // // console.log(activeEvent)
            // if (activeEvent == null) {
            //     // $('#activity-overview-btn').click();
            //     $('#defaultOpen').click();
            // }
            // //
            // if (activeEvent) {
            //     // $('#company').val(company)
            //
            //     $('#esop-' + activeEvent + '-btn').click()
            // }

        // });
        $(document).on("change", ".grid-input", function () {
            $(this).parent().parent()[this.checked ? "addClass" : "removeClass"]("checkedCard");
            $(this).parent().parent().children('.text-btn-portion')[this.checked ? "addClass" : "removeClass"]("checked");
        });
        $('#list').click(function(e){
            // const gridview = document.querySelectorAll(".grid-view");
            if($(".list-view").hasClass("d-none") == true){
                $(".list-view").removeClass("d-none")
                $(".grid-view").addClass("d-none")
            }
            if($(".list-btn").hasClass("active") == false){
                $(".list-btn").addClass("active");
                $(".grid-btn").removeClass("active");
            }
        });
        $('#grid').click(function(e){
            if($(".grid-view").hasClass("d-none") == true){
                $(".grid-view").removeClass("d-none")
                $(".list-view").addClass("d-none")
            }
            if($(".grid-btn").hasClass("active") == false){
                $(".grid-btn").addClass("active");
                $(".list-btn").removeClass("active");
            }
        });

        var $checkboxes = $('.tab-pane .document-checkbox');

        function checkbox() {
            var countCheckedCheckboxes = $checkboxes.filter(':checked').length;
            if (countCheckedCheckboxes > 0) {
                $('.select-all-link').text('Deselect All');
            } else {
                $('.select-all-link').text('Select All');
            }
        }

        function selectAll() {
            $checkboxes.prop('checked', true);
            checkbox();
        }

        function deselectAll() {
            $checkboxes.prop('checked', false);
            checkbox();
        }

        $('.select-all-link').click(function(e) {
            e.preventDefault();
            var countCheckedCheckboxes = $checkboxes.filter(':checked').length;
            if (countCheckedCheckboxes == $checkboxes.length) {
                deselectAll();
            } else {
                selectAll();
            }
            checkbox();
        });

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
            var reserved_share_obj = overview_data.find((item)=> item.name === 'Reserved')
            console.log(reserved_share_obj)
            // var overview_data = overview_data.filter((item) => item.name !=='Reserved')
            var initialData = overview_data.filter((item) => item.name !=='Reserved');
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
                                <td class="description-data"> <a href="#" class="action-buttons upcoming-exercise-view-modal" data-id="${item.id}"  >View</a> </td>
                            </tr>`
                })
            }
            $(wrapper).empty().append(html)

            buildESOPUpcomingExerciseTablePagination(object)
        }


        function buildESOPUpcomingExerciseTablePagination(object) {
            console.log('buildESOPUpcomingExerciseTablePagination()')
            let pagination_wrapper= "#pagination-wrapper"
            $(pagination_wrapper).html(appendPaginator)
            determinePaginationArrow(object)
            $('#left-number').text(object.current_page)
            $('#right-number').text(object.last_page)

            $("#left-arrow").removeAttr('href')
            $("#right-arrow").removeAttr('href')

            $("#left-arrow").attr('data-href', object.prev_page_url)
            $("#right-arrow").attr('data-href', object.next_page_url)
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
        function determinePaginationArrow(obj) {
            console.log('determinePaginationArrow()');
            let left_arrow = ""
            let right_arrow = ""
            left_arrow = "#left-arrow"
            right_arrow = "#right-arrow"

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
        $(document).on('click', '.pagination-part .left-arrow', function () {
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
        $(document).on('click', '.pagination-part .right-arrow', function () {
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

        $(document).on('click', '.upcoming-exercise-view-modal', function(){
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

        // ESOP Entries
        function fetchESOPEntriesData(ESOPEntriesUrl) {
            console.log('fetchESOPEntriesData');
            console.log('ESOPEntriesUrl : ', ESOPEntriesUrl);
            $.ajax({
                url: ESOPEntriesUrl,
                success: function (res) {
                    console.log('fetchESOPEntriesData res: ',res);
                    ESOPEntriesTableBuild(res);
                }
            });
        }
        function ESOPEntriesTableBuild(object) {
            console.log('ESOPUpcomingExerciseTableBuild()', object)
            let wrapper = '#esop-entries-table';
            let html = `<div class="entries row g-0">
                            <div class="col-2 col-md-2 col-lg-2 header-div">
                                <span>Issue Date</span>
                            </div>
                            <div class="col-2 col-md-2 col-lg-2 header-div">
                                <span>Date of Granted</span>
                            </div>
                            <div class="col-2 col-md-2 col-lg-2 header-div">
                                <span>Name</span>
                            </div>
                            <div class="col-2 col-md-2 col-lg-2 header-div ">
                                <span>Status</span>
                            </div>
                            <div class="col-2 col-md-2 col-lg-2 header-div">
                                <span>Number of Share</span>
                            </div>
                            <div class="col-2 col-md-2 col-lg-2 header-div action-div">
                                <span>Action</span>
                            </div>
                        </div>`;

            console.log('condition checking')
            if(object.data.length === 0) {
                console.log('data length 0')
                html += `<div class="entries row g-0"><div class="col-12 data-div text-center">NO Data Available</div></div>`;
            }
            else {
                console.log('data length not 0')
                $.map(object.data, function(item){
                    // console.log(item)
                    html += `<div class="entries row g-0">
                                <div class="col-2 col-md-2 col-lg-2 document-div">
                                    <span>${item.issue_date}</span>
                                </div>
                                <div class="col-2 col-md-2 col-lg-2 document-div">
                                    <p>${item.granted_date}</p>
                                </div>
                                <div class="col-2 col-md-2 col-lg-2 document-div">
                                    <p>${item.member.name}</p>
                                </div>
                                <div class="col-2 col-md-2 col-lg-2 document-div">
                                    <p name="entry-status" class="entry-status">${item.status}</p>
                                </div>
                                <div class="col-2 col-md-2 col-lg-2 document-div">
                                    <p>${item.no_of_share}</p>
                                </div>
                                <div class="col-2 col-md-2 col-lg-2 action-div">
                                    <a href="#" class="action-buttons esop-entry-view-modal" data-id="${item.id}">View</a>
                                </div>
                            </div>`;
                })
            }

            $(wrapper).empty().append(html)

            buildESOPEntriesTablePagination(object)
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
        })
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
        })

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
