{{--@php use App\Helpers\CapTableCompanyHelper; @endphp--}}
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
        <div class="row admin-cap-table-body g-0">
            <div class="col-12 col-md-2 col-sm-12 card admin-cap-table-button-card">
                <div class="card-body admin-cap-table-button-body">
                    <div class="tab-buttons" id="tab-buttons">
                        <button class="tablinks adminCapTableTabLinks active" onclick="adminCapTableTab(event,'defaultTab')" id="activity-defaultOpen" hidden>Select Company First</button>
                        <button class="tablinks adminCapTableTabLinks" onclick="adminCapTableTab(event,'overview')" id="activity-overview-btn">Overview</button>
                        <button class="tablinks adminCapTableTabLinks" onclick="adminCapTableTab(event,'members')" id="activity-members-btn">Members</button>
                        <button class="tablinks adminCapTableTabLinks" onclick="adminCapTableTab(event,'activity-entries')" id="activity-activity-entries-btn">Activity Entries</button>
                        <button class="tablinks adminCapTableTabLinks" onclick="adminCapTableTab(event,'certificates')" id="activity-certificates-btn">Certificates</button>
                    </div>

                    <form method="GET" action="" id="select_company">
                        <p class="mt-3">Company</p>
                        <select class="form-control form-select select-data " name="" id="company" onchange="companySelect()" required>
                            {{-- do not change Ist option--}}
                            <option hidden value="">Please Select</option>
                            @foreach($companies as $company)
                                <option value="{{$company->id}}" data-name="{{$company->name}}" {{$company->id == \App\Helpers\CapTableCompanyHelper::get() ? 'selected' : ''}}>{{$company->name}}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn search-btn">Search</button>
                    </form>
                </div>
            </div>
            <div class="col-12 col-md-10 col-sm-12">
                <div class="card admin-cap-table-card">
                    <div class="card-body admin-cap-table-content-body">
                        @if(!session()->has('capTableCompanyId'))
                            <!-- Select Company Portion Starts -->
                            <div id="defaultTab" class="tabcontent adminCapTableTabContent defaultTab text-center">
                                <h1>Please Select A Company First</h1>
                            </div>
                            <!-- Select Company Portion Ends -->
                        @endif

                        <!-- Overview Portion Starts -->
                        <div id="overview" class="tabcontent adminCapTableTabContent overview text-center">
                            <div class="text-start mb-2">Current Selection: <b class="capTable-current-company-selection"></b></div>

                                <div class="card captable-overview-card col-12 col-md-12 col-lg-12">
                                    <div class="card-body overview-card-body">
                                        <div class="overview-card-header">
                                            <h6 class="header-text">Cap Table Overview</h6>
                                        </div>
                                        <div class="date-div">
                                            <label for="asOnDate">As On:</label>
                                            <input type="date" id="asOnDate" name="asOnDate" class="form-control-sm my-1" value="{{ date('Y-m-d') }}">
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
                        <div id="members" class="tabcontent adminCapTableTabContent members">
                            @include('capTableMembers.partials.admin.membersTable')

                        </div>
                        <!-- Member Portion Ends -->

                        <!-- Activity Entries Table starts -->
                        <div id="activity-entries" class="tabcontent adminCapTableTabContent activity-entries">
                            @include('capTableActivityEntries.admin.partials.activity_table', array('activity_entries' => $activity_entries, 'selected_company' => $selected_company))
                        </div>
                        <!-- Activity Entries Table ends -->

                        <!--Activity Entries Create Modal Starts -->
                        <div class="modal fade" id="activityEntryCreateModal" data-bs-backdrop="static"
                             data-bs-keyboard="false" tabindex="-1" aria-labelledby="activityEntryCreateModalLabel"
                             aria-hidden="true">
                            @include('capTableActivityEntries.admin.partials.create_activity_entries', array('companies' =>$companies,'members' => $members))
                        </div>
                        <!-- Activity Entries Create Modal Ends -->

                        <!--Activity Entries Edit Modal Starts -->
                        <div class="modal fade" id="activityEntryEditModal" data-bs-backdrop="static"
                             data-bs-keyboard="false" tabindex="-1" aria-labelledby="activityEntryEditModalLabel"
                             aria-hidden="true">
                            @include('capTableActivityEntries.admin.partials.edit_activity_entries')
                        </div>
                        <!-- Activity Entries Edit Modal Ends -->


                        <!--Member Create Modal Starts -->
                        <div class="modal fade" id="memberCreateModal" data-bs-backdrop="static"
                             data-bs-keyboard="false" tabindex="-1" aria-labelledby="memberCreateModalLabel"
                             aria-hidden="true">
                            @include('capTableActivityEntries.admin.partials.create_member')
                        </div>
                        <!-- Member Create Modal Ends -->

                        <!--Transfer Create Modal Starts -->
                        <div class="modal fade member-transfer-modal" id="transferCreateModal" data-bs-backdrop="static"
                             data-bs-keyboard="false" tabindex="-1" aria-labelledby="transferCreateModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog activity-entry-modal ">
                                <div class="modal-content">
                                    <div class="activity-entry-modal-body">
                                        <div class="activity-entry-modal-header row">
                                            <h5 class="modal-title col-sm-11 col-11" id="memberCreateModalLabel">Add New
                                                Transfer</h5>
                                            <button type="button"
                                                    class="btn btn-close btn-sm activity-entry-modal-close-btn col-sm-1 col-1"
                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="activity-entry-modal-data row">
                                            <form action="#">
                                                <div class="data-body row">
                                                    <div class="data-row col-6">
                                                        <label for="first-name"> First Name<span
                                                                class="required-sign">*</span></label>
                                                        <input type="text" name="first_name" class="form-control"
                                                               id="first-name" placeholder="First Name" required>
                                                    </div>
                                                    <div class="data-row col-6">
                                                        <label for="last-name">Last Name<span
                                                                class="required-sign">*</span></label>
                                                        <input type="text" name="last_name" class="form-control"
                                                               id="last-name" placeholder="Last Name" required>
                                                    </div>
                                                    <div class="data-row col-12">
                                                        <label for="email-adrs">Email Address<span
                                                                class="required-sign">*</span></label>
                                                        <input type="email" name="email" class="form-control"
                                                               id="email-adrs" placeholder="Email Address" required>
                                                    </div>
                                                    <div class="data-row col-12 text-end">
                                                        <button type="submit" class="create-user-btn btn"
                                                                id="add-member">Create
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Transfer Create Modal Ends -->

                        <!-- Activity Entries Portion Ends -->

                        <!-- Certificates Portion Starts -->

                        <!-- Certificate Table Starts -->
                        <div id="certificates" class="tabcontent adminCapTableTabContent certificates">
                           @include('capTableShareCertificate.admin.partials.certificateTable')
                        </div>
                        <!-- Certificate Table Ends -->

                        <!--Certificates Create Modal Starts -->
                        <div class="modal fade" id="certificateCreateModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="certificateCreateModalLabel" aria-hidden="true">
                           @include('capTableShareCertificate.admin.partials.certificateCreateModal')
                        </div>
                        <!-- Certificates Create Modal Ends -->


                        <!--Certificates Edit Modal Starts -->
                            @include('capTableShareCertificate.admin.partials.certificateEditModal')
                        <!-- Certificates Edit Modal Ends -->
                        <!--Certify to Create Modal Starts -->
                        <div class="modal fade" id="certifyToCreateModal" data-bs-backdrop="static"
                             data-bs-keyboard="false" tabindex="-1" aria-labelledby="memberCreateModalLabel"
                             aria-hidden="true">
                            @include('capTableShareCertificate.admin.partials.create_certify_to_member')
                        </div>
                        <!-- Certify to Create Modal Ends -->

                        <!--Certificates View Modal Starts -->
                       @include('capTableShareCertificate.admin.partials.certificateViewModal')
                        <!-- Certificates View Modal Ends -->

                        <!-- Director Select Modal Start -->
                        <div class="modal fade" id="directorSelectModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="directorCreateModalLabel" aria-hidden="true">
                           @include('capTableShareCertificate.admin.partials.directorSelectModal')
                        </div>
                        <!-- Director Select Modal End -->
                        <!-- Director Select Modal Start -->
                        <div class="modal fade" id="directorSelectModalEdit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="directorSelectModalEditLabel" aria-hidden="true">
                            @include('capTableShareCertificate.admin.partials.directorSelectModalEdit')
                        </div>
                        <!-- Director Select Modal End -->

                        <!-- Director/Secretary Select Modal Start -->
                        <div class="modal fade" id="directorSecretarySelectModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="directorSecretaryCreateModalLabel" aria-hidden="true">
                            @include('capTableShareCertificate.admin.partials.secretarySelectModal')
                        </div>
                        <!-- Director/Secretary Select Modal Start -->
                        <div class="modal fade" id="secretarySelectModalEdit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="directorSecretaryCreateModalLabel" aria-hidden="true">
                            @include('capTableShareCertificate.admin.partials.secretarySelectModalEdit')
                        </div>
                        <!-- Director/Secretary Create Modal End -->
                        <!-- Certificates Portion Ends -->

                        <!--DEBJIT UPDATED CODE END--><!--DEBJIT UPDATED CODE END--><!--DEBJIT UPDATED CODE END-->
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- Main Body End -->

@endsection
@push('customScripts')
    @yield('indexActivityEntryJs')
    @yield('activityEntriesJs')
    @yield('memberJs')
    @yield('editActivityEntryJs')
    @yield('membersTableJs')
    @yield('certificateTableJs')
    @yield('certificateCreateJs')
    @yield('certifyToMemberJs')
    @yield('certificateEditJs')
    @yield('certificateViewJs')

    <script>
        // document.getElementById("activity-defaultOpen").click();
        var overview_share_types = [];
        var chart = echarts.init(document.getElementById('overviewPieChart'));


        document.addEventListener("DOMContentLoaded", function() {
            /*
            var initialData = [
                { value: 60.87, name: "Ordinary", shares: 60870 },
                { value: 14.10, name: "Preference", shares: 14100 },
                { value: 13.16, name: "ESOP", shares: 13160 },
                { value: 11.87, name: "Convertible Note", shares: 11870 }
            ];

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
                        formatter: function(params) {
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
                    formatter: function(name) {
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
*/
            // Get the table row
            // var convertibleRow = document.getElementById('convertible');

            // Toggle visibility on checkbox click
            var checkbox = document.getElementById('convertibleSelect');
            checkbox.addEventListener('change', function() {
                console.log('checkbox changed')
                var initialData = overview_share_types;
                if (checkbox.checked) {
                    console.log('checkbox checked')
                    // Show the table row
                    // convertibleRow.style.display = 'table-row';
                    // Add "Convertible Note" back to the data array
                    // initialData.push({ value: 11.87, name: "Convertible Note", shares: 11870 });
                    // Update the chart with the new data
                    // chart.setOption({
                    //     series: [{
                    //         data: initialData
                    //     }]
                    // });
                } else {
                    console.log('checkbox uncheck')
                    // Hide the "Convertible Note" from the data array
                    filterData = initialData.filter(item => item.name !== 'Convertible');
                    console.log('filterData', filterData)
                    initialData=[];
                    initialData = calculateData(filterData)
                    // Update the chart with the new data
                    // chart.setOption({
                    //     series: [{
                    //         data: initialData
                    //     }]
                    // });

                    // Hide the table row
                    // convertibleRow.style.display = 'none';
                }
                // Update the chart with the new data
                showGraphOverview(initialData);
                showTableData(initialData);
            });
        });



        function onCTAEDelete(e) {
            let slug = e.getAttribute('data-id')
            console.log(slug)
            document.getElementById('delForm-' + slug).setAttribute('action', e.id)
        }

        $('.create-activity-entry-button').on('click', function () {
            $('#flashMessages').html('')
            $('#memberFlashMessages').html('')
        })

        function companySelect() {
            let companyId = $("select option:selected").val()
            var url = "<?php echo e(route('cap-table.set-company', ':companyId')); ?>";
            url = url.replace(':companyId', companyId);
            $('#select_company').attr('action', url)
        }

        function searchActivity() {
            let search = $('#search').val()
            var url = "<?php echo e(route('activity_entry.search', ':search')); ?>";
            url = url.replace(':search', search);
            $('#search_form').attr('action', url)
        }

        $(document).ready(function () {

            $('.capTable-current-company-selection').text($('#company').find(':selected').data("name"))
            $("#addMemberLoadingDiv").hide();
            $("#addCertifyToMemberLoadingDiv").hide();
            $("#EditLoadingDiv").hide();
            $("#createActivityEntriesLoadingDiv").hide();
            $("#editActivityEntriesLoadingDiv").hide();
            $("#CreateLoadingDiv").hide();
            $(".select2").select2();
            $(".select2").select2({
                allowClear: true
            });
            // Get the element with id="defaultOpen" and click on it
            // document.getElementById("activity-defaultOpen").click();
            $('.admin-doc-create-send-btn').click(function () {
                $('.admin-doc-create-submit-btn').click();
            })
            let companyId = $("select option:selected").val();
            console.log('companyID :', companyId);
            var activeEvent = localStorage.getItem('activeEvent');
            var company = localStorage.getItem('company');
            console.log('activeEvent', activeEvent)
            console.log('company', company)

            if (companyId === '') {
                // Get the element with id="defaultOpen" and click on it
                document.getElementById("activity-defaultOpen").click();
            }
            if (companyId !== '' && activeEvent == null) {
                $('#activity-overview-btn').click();
            }

            if (activeEvent && company) {
                // $('#company').val(company)
                $('#activity-' + activeEvent + '-btn').click()
            }
        })




        // CAP TABLE INDEX FRONTEND JS STARTS
        function displayFileName(fileId, inputId) {
            var fileInput = document.getElementById(inputId);
            $("#" + fileId).val(fileInput.files[0].name);
        }
        function adminCapTableTab(evt, eventName) {
            if ($('#company').val() !== "") {
                var i, tabcontent, tablinks, elements;
                tabcontent = document.getElementsByClassName("adminCapTableTabContent");
                for (i = 0; i < tabcontent.length; i++) {
                    tabcontent[i].style.display = "none";
                }
                tablinks = document.getElementsByClassName("adminCapTableTabLinks");
                for (i = 0; i < tablinks.length; i++) {
                    tablinks[i].className = tablinks[i].className.replace(" active", "");
                }

                elements = document.getElementsByClassName(eventName);
                for (i = 0; i < elements.length; i++) {
                    elements[i].style.display = "block";
                }
                $('#activity-' + eventName + '-btn').addClass("active")

                switch (eventName) {
                    case "members":
                        headerText = "Cap Table - Members";
                        break;
                    case "activity-entries":
                        headerText = "Cap Table - Activity Entries";
                        break;
                    case "certificates":
                        headerText = "Cap Table - Certificates";
                        break;
                    case "overview":
                        headerText = "Cap Table - Overview";
                        // fetch overview data from backend
                        fetchOverviewData();
                        break;
                    case "defaultTab":
                        headerText = "Cap Table";
                        break;
                    default:
                        headerText = "Cap Table";
                }

                localStorage.setItem('activeEvent', eventName);
                localStorage.setItem('company', $('#company').val());
                var pageHeaderChange = document.getElementById("page-header")
                pageHeaderChange.innerHTML = headerText

                let pageHeaderText = document.getElementById("page-header").innerHTML;
                let pageHeaderTextShort = pageHeaderText.slice(22, 50);

                // console.log (pageHeaderText)
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
            else {

                var i, tabcontent, tablinks, elements;
                tabcontent = document.getElementsByClassName("adminCapTableTabContent");
                for (i = 0; i < tabcontent.length; i++) {
                    tabcontent[i].style.display = "none";
                }

                elements = document.getElementsByClassName('defaultTab');
                for (i = 0; i < elements.length; i++) {
                    elements[i].style.display = "block";
                }
            }
            //Member start
            fetchMembersData()
            //Member end

            //Share certificate start
            if(eventName=='certificates'){
                fetchShareCertificateData()
                // fetchCertificateSigners() //abandoned due to remove director/secretary
            }
            //written in partial certificateCreateModal

            getCompanyDetailsForShareCertificate()
            fetchCompanyMembers()
            //Share certificate end
        }
        function goBack(event, eventName) {
            var i;
            var tabcontent = document.getElementsByClassName("adminCapTableTabContent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }

            var elements = document.getElementsByClassName(eventName);
            for (i = 0; i < elements.length; i++) {
                elements[i].style.display = "block";
            }
            event.currentTarget.className += " active";
            // console.log('Tab:'.tabcontent)
            // console.log('Element:'.elements)
            // console.log('Class:'.className)
        }
        function adminDocCreateTab(evt, eventName) {
            var i, tabcontent, tablinks, elements;
            tabcontent = document.getElementsByClassName("adminCapTableTabContent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }

            elements = document.getElementsByClassName(eventName);
            for (i = 0; i < elements.length; i++) {
                elements[i].style.display = "block";
            }
            evt.currentTarget.className += " active";

        }

        $(document).on('click', ".cancel-btn", function () {
            $(this).parent('div').remove();
        });

        function disableTransfer(checkbox) {
            console.log(checkbox.checked == true)
            if (checkbox.checked == true) {
                document.getElementById("transfer").removeAttribute("disabled");
            } else {
                document.getElementById("transfer").setAttribute("disabled", "disabled");
            }
        }
        function disableTransferEdit(checkbox) {
            if (checkbox.checked == true) {
                document.getElementById("edit_transfer").removeAttribute("disabled");
            } else {
                document.getElementById("edit_transfer").setAttribute("disabled", "disabled");
            }
        }
        $('#company_member_id').on('change', function () {
            let val = $(this).val();
            $('#transfer option').removeAttr('hidden', true)
            $('#transfer option:eq(0)').attr('hidden', 'hidden')
            $('#transfer option[value="' + val + '"]').attr('hidden', 'hidden')
        })
        $('#edit_company_member_id').on('change', function () {
            let val = $(this).val();
            $('#edit_transfer option').removeAttr('hidden', true)
            $('#edit_transfer option:eq(0)').attr('hidden', 'hidden')
            $('#edit_transfer option[value="' + val + '"]').attr('hidden', 'hidden')
        })
        $('#transfer').on('change', function () {
            let val = $(this).val();
            $('#company_member_id option').removeAttr('hidden', true)
            $('#company_member_id option:eq(0)').attr('hidden', 'hidden')
            $('#company_member_id option[value="' + val + '"]').attr('hidden', 'hidden')
        })
        // CAP TABLE INDEX FRONTEND JS END STARTS
        // CAP TABLE INDEX JS END

        /*
        * ==============================================================================================================
        *   Overview
        * ==============================================================================================================
        * */


        $('#asOnDate').on('change', function () {
            fetchOverviewData()
        });

        function fetchOverviewData() {
            let date = $('#asOnDate').val();
            let url = "{{ route('cap-table-overview.index',"date=") }}" + date
            $.ajax({
                url: url,
                success: function (res) {
                    console.log('res: ',res)
                    overview_share_types = calculateData(res)
                    console.log('overview_share_types',overview_share_types)

                    showGraphOverview(overview_share_types);
                    showTableData(overview_share_types);
                }
            });
        }

        function calculateData(data) {
            let total_share_number = data.reduce((total_share_number, obj) => parseInt(obj.shares) + total_share_number, 0)
            let total_amount = data.reduce((total_amount, obj) => obj.total_amount + total_amount, 0.00)
            console.log('total', [total_share_number, total_amount])
            result = []
            for (let i of data) {
                let obj = {}
                obj["value"] = parseFloat(((parseInt(i.shares) / total_share_number) * 100).toFixed(2));
                obj["name"] = i.name[0].toUpperCase() + i.name.slice(1);
                obj["shares"] = parseInt(i.shares);
                obj["total_amount"] = parseFloat(i.total_amount);
                result.push(obj)
            }
            console.log('calculateData result:', result)
            return result
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
                            console.log("initialData : ",initialData)
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

        function showTableData(data_rows) {
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
                                <td class="description-data">${numberWithCommas( total_shares ) }</td>
                                <td class="description-data">${total_ownership}%</td>
                                <td class="description-data">$${numberWithCommas( parseFloat(total_amount).toFixed(2) ) }</td>
                            </tr>`;


            $('#overview-table-body').empty().append(table_row);
        }
    </script>

@endpush
