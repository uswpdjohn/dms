@extends('layouts.master')
@section('content')

    <!-- Main Body Start -->
    <div class="row main-body g-0">
        @if(session()->has('success'))
            <div class="alert alert-success">
                <img class="alert-img" src="{{asset('assets/icons/success-alert-icon.png')}}" alt="">
                <p class="alert-text">{{session('success')}}</p>
            </div>
        @endif
        <div id="flashMessages"></div>
        <div class="card company-management-index-card">
            <div class="card-body">
                <div class="upper-part row g-0">
                    <div class="search-box-part col-6 col-md-4 col-lg-3">
                        <div class="d-flex form-inputs">
                            <input class="form-control" name="search" id="search" type="text" placeholder=" Search">
                            <button type="button" class="search-btn btn"><i class="fa-solid fa-search"></i></button>
                        </div>
                    </div>
                    <div class="col-6 co-md-8 col-lg-9 text-end ms-auto">
                        <a href="{{route('export.companies')}}" class="create-company-btn btn  download-all" type="button" >Download All</a>
                        @if(auth()->guard('web')->user()->can('create.company_management'))
                            <a href="#" class="create-company-btn btn" id="create-company-btn" type="button" data-bs-toggle="modal" data-bs-target="#companyCreateModal">Create</a>
                        @endif
                    </div>
                    <!-- Company Create Modal Start -->
                    <div class="modal fade" id="companyCreateModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="companyCreateModalLabel" aria-hidden="true">
                        <div class="modal-dialog company-create-modal">
                            <div class="modal-content">
                                <div class="company-create-modal-body">
                                    <div class="company-create-modal-header row">
                                        <h5 class="modal-title col-11" id="companyCreateModalLabel">Create New Company</h5>
                                        <button type="button" class="btn-close btn-sm company-create-modal-close-btn col-1" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <small>General Information of the Company</small>
                                    <div class="company-create-modal-data row">
                                        <form action="" method="POST" id="company_create">
                                            <meta name="csrf-token" content="{{ csrf_token() }}" />
                                            <div class="data-body row">
                                                <div class="data-row col-12">
                                                    <label for=""><span class="required-sign">*</span>Company Name</label>
                                                    <input type="text" class="form-control clear" name="name" id="name" placeholder="Company Name" required>
                                                    <span class="text-danger company-name"></span>
                                                </div>

                                                <div class="data-row col-12 col-md-6">
                                                    <label for=""><span class="required-sign">*</span>Unique Entity Number (UEN)</label>
                                                    <input type="text" class="form-control clear" name="uen" id="uen" placeholder="Unique Entity Number" required>
                                                    <span class="text-danger company-uen"></span>
                                                </div>

                                                <div class="data-row fye-row col-12 col-md-6">
                                                    <label for=""><span class="required-sign">*</span>FYE</label>
                                                    <input type="date" class="form-control clear date-input noTyping" name="fye" id="fye" placeholder="DD/MM/YYYY" required>
                                                    <span class="text-danger company-fye"></span>
                                                </div>

                                                <div class="data-row col-12 col-md-6">
                                                    <label for=""><span class="required-sign">*</span>Incorporation Date</label>
                                                    <input type="date" class="form-control clear noTyping" name="incorporation_date" id="incorporation_date" placeholder="" required>
                                                    <span class="text-danger company-incorporation_date"></span>
                                                </div>
                                                <div class="data-row col-12 col-md-6">
                                                    <label for="">Last AGM Filed</label>
                                                    <input type="date" class="form-control noTyping" name="last_agm_filed" id="name" placeholder="DD/MM/YYYY" >
                                                </div>
                                                <div class="data-row col-12 col-md-6">
                                                    <label for="">Last AR Filed</label>
                                                    <input type="date" class="form-control noTyping" name="last_ar_filed" id="name" placeholder="DD/MM/YYYY">
                                                </div>

                                                <div class="data-row col-12">
                                                    <label for=""><span class="required-sign">*</span>Address</label>
                                                    <textarea name="address_line" class="form-control clear" id="" rows="2" placeholder="Address Line"></textarea>
                                                    <span class="text-danger company-address_line"></span>
                                                </div>

                                                <div class="data-row col-12">
                                                    <label for=""><span class="required-sign">*</span>Primary Industry Services</label>
                                                    <select class="form-control select form-select select2" name="primary_industry_service_ssic_id" id="primary_industry_service_ssic_id" required>
                                                        <option hidden class="first-option" value="">Select</option>
{{--                                                        @foreach($ssics as $ssic)--}}
{{--                                                            <option value="{{$ssic->id}}">{{$ssic->code.' - '.$ssic->title}}</option>--}}
{{--                                                        @endforeach--}}
                                                    </select>
                                                    <span class="text-danger company-primary_industry_service_ssic_id"></span>
                                                </div>

                                                <div class="data-row col-12">
                                                    <label for="">Secondary Industry Services</label>
                                                    <select class="form-control select form-select select2" name="secondary_industry_service_ssic_id" id="secondary_industry_service_ssic_id">
                                                        <option hidden class="first-option" value="">Select</option>
{{--                                                        @foreach($ssics as $ssic)--}}
{{--                                                            <option value="{{$ssic->id}}">{{$ssic->code.'-'.$ssic->title}}</option>--}}
{{--                                                        @endforeach--}}
                                                    </select>
                                                    <span class="text-danger company-secondary_industry_service_ssic_id"></span>
                                                </div>

                                                <div class="data-row col-12 text-end">
                                                    <button type="button" id="submit" name="submit" class="create-company-btn btn"><div id="loadingDiv"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></div>Next</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Company Create Modal End -->
                </div>
                <div class="table-responsive">
                    <table class="company-management-index-table">
                    <thead>
                    <tr class="row g-0">
{{--                        <th class="name-header col-3 col-md-3 col-lg-3 col-xl-3">Name <button onclick="filterByName()" class="filter-btn"><span id="order" hidden="hidden">DESC</span><img class="filter-icon" src="{{asset('assets/icons/filter-icon.png')}}" alt="Filter Icon"></button></th>--}}
                        <th class="name-header col-3 col-md-3 col-lg-3 col-xl-3">Name <button class="border-0 btn-background" id="sort_by_name" data-column="Name" data-direction="DESC" data-sortBy="name" onclick="sort(this)"><i class="icon-color fas fa-sort fa-xs"></i></button></th>
                        <th class="status-header col-1 col-md-1 col-lg-1 col-xl-1">Status <button class="border-0 btn-background" id="sort_by_status" data-column="Status" data-direction="DESC" data-sortBy="status" onclick="sort(this)"><i class="icon-color fas fa-sort fa-xs"></i></button></th>
                        <th class="fye-header col-2 col-md-2 col-lg-2 col-xl-1">FYE <button class="border-0 btn-background" id="sort_by_fye" data-column="Fye" data-direction="DESC" data-sortBy="fye" onclick="sort(this)"><i class="icon-color fas fa-sort fa-xs"></i></button></th>
                        <th class="startDate-header col-2 col-md-2 col-lg-2 col-xl-1">Incorporation <button class="border-0 btn-background" id="sort_by_incorporation" data-column="Incorporation" data-direction="DESC" data-sortBy="incorporation_date" onclick="sort(this)"><i class="icon-color fas fa-sort fa-xs"></i></button></th>
                        <th class="ar-header col-2 col-md-1 col-lg-2 col-xl-1">Last AR <button class="border-0 btn-background" id="sort_by_ar" data-column="AR" data-direction="DESC" data-sortBy="last_ar_filed" onclick="sort(this)"><i class="icon-color fas fa-sort fa-xs"></i></button></th>
                        <th class="agm-header col-2 col-md-1 col-lg-2 col-xl-1">Last AGM <button class="border-0 btn-background" id="sort_by_agm" data-column="AGM" data-direction="DESC" data-sortBy="last_agm_filed" onclick="sort(this)"><i class="icon-color fas fa-sort fa-xs"></i></button></th>
{{--                        <th class="renewal-header col-2 col-md-2 col-lg-2 col-xl-1">Next Renewal <button class="border-0 btn-background" id="sort_by_next_renewal" data-column="Next_Renewal" data-direction="ASC" data-sortBy="next_renewal" onclick="sort(this)"><i class="icon-color fas fa-sort fa-xs"></i></button></th>--}}
                        <th class="action-header col-2 col-md-2 col-lg-2 col-xl-2">Action</th>
                    </tr>
                    </thead>
                    <tbody id="t-body">
                    <!-- Main row start -->
                    @foreach($companies as $company)

                        <tr class="row g-0">
                            <td class="name-data col-3 col-md-3 col-lg-3 col-xl-3">{{$company->name}}</td>
                            <td class="status-data col-1 col-md-1 col-lg-1 col-xl-1"><span name="company-status" class="company-status">{{ucfirst($company->status)}}</span></td>
                            <td class="fye-data col-2 col-md-2 col-lg-2 col-xl-1">{{\Carbon\Carbon::parse($company->fye)->format('d M')}}</td>
                            <td class="startDate-data col-2 col-md-2 col-lg-2 col-xl-1">{{\Carbon\Carbon::parse($company->incorporation_date)->format('d M Y')}}</td>
                            @if($company->last_ar_filed != null)
                                <td class="renewal-data col-2 col-md-1 col-lg-2 col-xl-1">{{\Carbon\Carbon::parse($company->last_ar_filed)->format('d M Y')}}</td>
                            @else
                                <td class="renewal-data text-center col-2 col-md-1 col-lg-2 col-xl-1">--</td>
                            @endif
                            @if($company->last_agm_filed)
                                <td class="startDate-data col-2 col-md-1 col-lg-2 col-xl-1">{{\Carbon\Carbon::parse($company->last_agm_filed)->format('d M Y')}}</td>
                            @else
                                <td class="startDate-data text-center col-2 col-md-1 col-lg-2 col-xl-1">--</td>
                            @endif
{{--                            @if(count($company->invoices) > 0)--}}
{{--                                @dd($company->invoices[0])--}}
{{--                                <td class="startDate-data col-2 col-md-2 col-lg-2">{{\Carbon\Carbon::parse($company->invoices[0]->subscription_start)->format('d M Y')}}</td>--}}
{{--                                <td class="renewal-data col-2 col-md-2 col-lg-2 col-xl-1">{{\Carbon\Carbon::parse($company->invoices[0]->subscription_end)->format('d M Y')}}</td>--}}
{{--                            @else--}}
{{--                                <td class="startDate-data col-2 col-md-2 col-lg-2">-</td>--}}
{{--                                <td class="renewal-data text-center col-2 col-md-2 col-lg-2 col-xl-1">--</td>--}}
{{--                            @endif--}}

{{--                            {{\Carbon\Carbon::parse($company->companyServices->min('next_renewal'))->format('d M Y')}}--}}
                            <td class="action-data col-2 col-md-2 col-lg-2 col-xl-2">

                                @if(auth()->guard('web')->user()->can('view.company_management'))
                                    <a href="{{route('company.show', $company->slug)}}" class="action-buttons">View</a>
                                @endif
                                @if(auth()->guard('web')->user()->can('edit.company_management'))
                                    <a href="{{route('company.edit', $company->slug)}}" class="action-buttons edit-btn">Edit</a>
                                @endif
                                @if(auth()->guard('web')->user()->can('delete.company_management'))
                                    <a href="#" class="action-buttons delete-btn"  data-bs-toggle="modal" onclick="onDelete(this)" data-slug="{{$company->slug}}" id="{{route('company.destroy', $company->slug)}} " data-bs-target="#companyDeleteModal-{{$company->slug}}">Delete</a>
                                @endif
                                <div class="modal fade" id="companyDeleteModal-{{$company->slug}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="companyDeleteModalLabel" aria-hidden="true">

                                    <div class="modal-dialog company-delete-modal">
                                        <form id="delForm-{{$company->slug}}" method="POST">
                                            @csrf
{{--                                            {{csrf_field()}}--}}
                                            @method('DELETE')
{{--                                            {{ method_field('DELETE') }}--}}
                                            <div class="modal-content">
                                                <div class="company-delete-modal-body">
                                                    <p class="text-center">Confirm Delete</p>
                                                    <div class="text-center">
                                                        <button type="button" class="btn btn-sm company-delete-modal-close-btn" data-bs-dismiss="modal" aria-label="No">No</button>
                                                        <button type="submit" class="btn btn-sm yes-btn">Yes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </td>
                        </tr>
                    @endforeach
                    <!-- Main row end -->


                    </tbody>
                </table>
                </div>
                <div class="bottom-part">
                    <input type="text" id="last_page" value="{{$companies->hasPages()}}" hidden="hidden">
                    <div class="pagination-part col-12 col-md-12 col-lg-12 text-end">
                    <a data-href="{{$companies->previousPageUrl()}}" class="btn d-none left-arrow"><i class="fa-solid fa-chevron-left"></i></a>
                    <span class="pagination-number pagination-left-number">{{$companies->currentPage()}}</span>
                    <span class="pagination-divider">/</span>
                    <span class="pagination-number pagination-right-number">{{$companies->lastPage()}}</span>

                    <a data-href="{{$companies->nextPageUrl()}}" class="btn d-none right-arrow"><i class="fa-solid fa-chevron-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
   <!-- Main Body End -->
@endsection
@push('customScripts')
    <script>
        //Restricting users from typing in date field
        document.querySelectorAll(".noTyping").forEach(el=>{
            el.addEventListener("keydown", function(e){
                e.preventDefault()
            })
        })

        //restrict user from input special character
        $("input[name*='uen']").keyup(function () {
            let value_input = $("input[name*='uen']").val();
            let regexp = /[^0-9A-Za-z. ]/g;
            if (value_input.match(regexp)) {
                $("input[name*='uen']").val(value_input.replace(regexp, ''))
            }
        });


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#submit').on('click', function(e) {
            $('.company-name').text('')
            $('.company-uen').text('')
            $('.company-fye').text('')
            $('.company-incorporation_date').text('')
            $('.company-last_agm_filed').text('')
            $('.company-last_ar_filed').text('')
            $('.company-address_line').text('')
            $('.company-primary_industry_service_ssic_id').text('')
            $('.company-secondary_industry_service_ssic_id').text('')
            $(this).prop('disabled', true);
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "{{route('company.store')}}",
                data: $('#company_create').serialize(),
                beforeSend: function() {
                    $("#loadingDiv").show();
                },
                success: function(data) {
                    console.log(data)
                    $('#companyCreateModal').modal('hide')
                    $("#loadingDiv").hide();
                    if (data.success == 1){
                        $("html, body").animate({ scrollTop: 0 });
                        $('#flashMessages').html(
                            `<div class="alert alert-success">
                            <img class="alert-img" src="{{asset('assets/icons/success-alert-icon.png')}}" alt="">
                            <p class="alert-text">${data.message}</p></div>`
                        )
                        setTimeout(function(){
                            window.location.reload();
                        }, 2000);
                        // $(".alert-text").html(response.message);
                    }else if(data.abort == 403){
                        $('#submit').prop('disabled', false);
                        $('#companyCreateModal').modal('hide')
                        $("html, body").animate({ scrollTop: 0 });
                        $('#flashMessages').html(
                            `<div class="alert alert-success">
                            <img class="alert-img" src="{{asset('assets/icons/mailbody-!.png')}}" alt="">
                            <p class="alert-text">${data.message}</p></div>`
                        )
                        // setTimeout(function(){
                        //     window.location.reload();
                        // }, 2000);
                    }
                },
                error: function(xhr){
                    // console.log(xhr)
                    $('#submit').prop('disabled', false);
                    $("#loadingDiv").hide();
                    if(xhr.responseJSON.hasOwnProperty('errors') == true){
                        $.each(xhr.responseJSON.errors, function (key, value) {
                            $('.company-' + key).text(value);
                        });
                    }else {
                        $('#companyCreateModal').modal('hide')
                        $('#flashMessages').html(
                            `<div class="alert alert-success">
                            <img class="alert-img" src="{{asset('assets/icons/mailbody-!.png')}}" alt="">
                            <p class="alert-text">Something went wrong!</p></div>`
                        )
                    }

                    // alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
                }
            });
        });

        $('.company-create-modal-close-btn').on('click', function () {
            $('.clear').val('')
            $('.text-danger').text('')
            $('#primary_industry_service_ssic_id').val(null).trigger('change');
            $('#secondary_industry_service_ssic_id').val(null).trigger('change');
        })
    </script>
    <script>
        let url= "company?page="
        $('.pagination-part .left-arrow').on('click', function (){
            if ($(this).attr('data-href') != ''){
                var page = $(this).attr('data-href').split('page=')[1];
                if($('.pagination-part .left-arrow').hasClass('filterByName') == true){
                    let order=$(this).attr('data-href').split('?')[0].split('/')[5]
                    url="company/filter-by-name/"+order+"?page="
                }
                if($('.pagination-part .left-arrow').hasClass('searchCompany') == true){
                    let search=$(this).attr('data-href').split('?')[0].split('/')[5]
                    url="search-mail/"+search+"?page="
                }
                if($('.pagination-part .left-arrow').hasClass('sortCompany') == true){
                    //param1=sorting column
                    //param2=data direction
                    let param1=$(this).attr('data-href').split('?')[0].split('/')[4]
                    let param2=$(this).attr('data-href').split('?')[0].split('/')[5]
                    url="sort-company/"+param1+"/"+param2+"?page="

                }
                fetch_data(page);
            }
        })
        $('.pagination-part .right-arrow').on('click', function (){
            if ($(this).attr('data-href') != ''){
                var page = $(this).attr('data-href').split('page=')[1];
                if($('.pagination-part .right-arrow').hasClass('filterByName') == true){
                    let order=$(this).attr('data-href').split('?')[0].split('/')[5]
                    url="company/filter-by-name/"+order+"?page="
                }
                if($('.pagination-part .right-arrow').hasClass('searchCompany') == true){
                    let search=$(this).attr('data-href').split('?')[0].split('/')[5]
                    url="search-mail/"+search+"?page="
                } if($('.pagination-part .right-arrow').hasClass('sortCompany') == true){
                    //param1=sorting column
                    //param2=data direction
                    let param1=$(this).attr('data-href').split('?')[0].split('/')[4]
                    let param2=$(this).attr('data-href').split('?')[0].split('/')[5]
                    url="sort-company/"+param1+"/"+param2+"?page="
                    // url="search-mail/"+search+"?page="
                }
                fetch_data(page);
            }

        })

        function fetch_data(page) {
            let wrapper = "#t-body"
            $.ajax({
                url: url + page,
                dataType: "json",
                success: function(res) {
                    console.log(res)

                    determinePaginationArrow(res)

                    $('.pagination-left-number').text(res.current_page)
                    $('.pagination-right-number').text(res.last_page)
                    $(".pagination-part .left-arrow").attr('data-href', res.prev_page_url)
                    $(".pagination-part .right-arrow").attr('data-href', res.next_page_url)

                    domLoad(res.data)
                    styleCompanyStatus("company-status")
                }
            });
        }
    </script>

    <script>
        var order=""
        $(document).ready(function() {
            var $loading = $('#loadingDiv').hide();
            $(".select2").select2();
            $(".select2").select2({
                dropdownParent: $('#companyCreateModal'),
                // placeholder: "Select",
                allowClear: true
            });

            let page=$('#last_page').val()
           if (page != ""){
               $('.pagination-part .right-arrow').removeClass('d-none')
           }else {

               $('.pagination-part .right-arrow').addClass('d-none')
               // $('.pagination-part').addClass('d-none')
           }
           styleCompanyStatus("company-status")

            // var companyStatus = document.getElementsByName("company-status");
            // var countTickets = companyStatus.length;
            // for (var i = 0; i < countTickets; i++)
            //     if(companyStatus[i].innerHTML == "Active"){
            //         companyStatus[i].style.color = "#52C41A";
            //         companyStatus[i].style.border = "1px solid #52C41A";
            //         companyStatus[i].style.backgroundColor = "#F4FFE3";
            //     }else{
            //         companyStatus[i].style.color = "#EB2F96";
            //         companyStatus[i].style.border = "1px solid #FFADD2";
            //         companyStatus[i].style.backgroundColor = "#FFF0F6";
            //     }
            order = $('#order').text();

        });

        function styleCompanyStatus(fieldName){
            var companyStatus = document.getElementsByClassName(fieldName);
            var countTickets = companyStatus.length;
            for (var i = 0; i < countTickets; i++)
                if(companyStatus[i].innerHTML == "Active"){
                    companyStatus[i].style.color = "#52C41A";
                    companyStatus[i].style.border = "1px solid #52C41A";
                    companyStatus[i].style.backgroundColor = "#F4FFE3";
                }else{
                    companyStatus[i].style.color = "#EB2F96";
                    companyStatus[i].style.border = "1px solid #FFADD2";
                    companyStatus[i].style.backgroundColor = "#FFF0F6";
                }
        }
        function filterByName(){
            removeClassFromPaginationArrow('searchCompany')
            removeClassFromPaginationArrow('sortCompany')
            if (order =='DESC'){
                order='ASC'
                $('#order').text('ASC')

            }else {
                order='DESC'
                $('#order').text('DESC')

            }
            let url = "{{ route('company.filter.name', ':order') }}"
            url=url.replace(':order', order)
            let wrapper = "#t-body"
            $.ajax({
                url: url,
                success: function(res) {
                    console.log(res)
                    determinePaginationArrow(res)
                    $('.pagination-left-number').text(res.current_page)
                    $('.pagination-right-number').text(res.last_page)
                    injectClass('filterByName')
                    $(".pagination-part .left-arrow").attr('data-href', res.prev_page_url)
                    $(".pagination-part .right-arrow").attr('data-href', res.next_page_url)
                    domLoad(res.data)
                    styleCompanyStatus("company-status")
                }
            });

            // var companyStatus = document.getElementsByClassName("company-status");
            //
            // var countTickets = companyStatus.length;
            // // console.log(countTickets)
            // for (var i = 0; i <= countTickets; i++)
            //     console.log(companyStatus[i])
            //     if(companyStatus[i].innerHTML == "Active"){
            //         companyStatus[i].style.color = "#52C41A";
            //         companyStatus[i].style.border = "1px solid #52C41A";
            //         companyStatus[i].style.backgroundColor = "#F4FFE3";
            //     }else{
            //         companyStatus[i].style.color = "#EB2F96";
            //         companyStatus[i].style.border = "1px solid #FFADD2";
            //         companyStatus[i].style.backgroundColor = "#FFF0F6";
            //     }
            // styleCompanyStatus("company-status")

        }
    </script>
    <script>
        // function searchCompany(){
        $('#search').on('keyup', function () {
            removeClassFromPaginationArrow('filterByName')
            removeClassFromPaginationArrow('sortCompany')
            let value=""
            let wrapper = "#t-body"
            $("input[name='search']").each(function() {
                if (this.value.length != 0){
                    value=this.value;
                }else {
                    value=0;
                }
            });
            let url = "{{ route('company.search', ':search') }}"
            url=url.replace(':search', value)
            $.ajax({
                url: url,
                success: function(res) {
                    // console.log('when search is empty:',res)
                    determinePaginationArrow(res)
                    //
                    $('.pagination-left-number').text(res.current_page)
                    $('.pagination-right-number').text(res.last_page)
                    injectClass('searchCompany')
                    $(".pagination-part .left-arrow").attr('data-href', res.prev_page_url)
                    $(".pagination-part .right-arrow").attr('data-href', res.next_page_url)
                    domLoad(res.data)
                    styleCompanyStatus("company-status")
                }
            });
        })


        // }
    </script>
    <script>
        function removeClassFromPaginationArrow(className){
            if ( $(".pagination-part .right-arrow").hasClass(className)){
                $(".pagination-part .right-arrow").removeClass(className)
            }
            if (  $(".pagination-part .left-arrow").hasClass(className)){
                $(".pagination-part .left-arrow").removeClass(className)
            }
        }

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

        function injectClass(className){
            $(".pagination-part .right-arrow").addClass(className)
            $(".pagination-part .left-arrow").addClass(className)
        }

    </script>
    <script>
        function ucfirst(str,force){
            str=force ? str.toLowerCase() : str;
            return str.replace(/(\b)([a-zA-Z])/,
                function(firstLetter){
                    return   firstLetter.toUpperCase();
                });
        }
    </script>
    <script>


        function domLoad(res){
            // console.log(res)

            // let showUrl = 'company/'+item.slug
            // $('tbody .action-data .view').attr('href', showUrl)

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
                    `<td class="action-data col-2 col-md-2 col-lg-2 col-xl-2">
                <a href="${showUrl}" class="action-buttons view {{auth()->guard('web')->user()->can('view.company_management') ? '' : 'd-none' }}">View</a>
                <a href="${editUrl}" class="edit action-buttons edit-btn {{auth()->guard('web')->user()->can('edit.company_management') ? '' : 'd-none' }}">Edit</a>
                <a href="#" class="del action-buttons delete-btn {{auth()->guard('web')->user()->can('delete.company_management') ? '' : 'd-none' }}"  data-bs-toggle="modal" onclick="onDelete(this)" data-slug="${value.slug}" id="${deleteUrl}" data-bs-target="#companyDeleteModalCopy-${value.slug}">Delete</a>
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

        const fullMonth = ["Jan","Feb","Mar","Apr","May","June","Jul","Aug","Sept","Oct","Nov","Dec"];
        $.date = function(dateObject, column) {
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
            if (column=='fye'){
                var date = day + " " + month;
            }else {
                var date = day + " " + month+ " "+year;
            }

            return date;
        };

        $('#create-company-btn').on('click', function () {
            $.ajax({
                url: "{{route('company.getSsic')}}",
                type: 'GET',
                dataType: "json",
                success: function (res) {
                    let options = `<option value="" selected>Please Select</option>`
                    $.each(res, function (index, value) {
                        // options += `<option value="${value.id}"  ${res[0].company_id == value.id ? 'selected' : " "}>${value.name}</option>`

                        options += `<option value="${value.id}" >${value.code+' - '+value.title}</option>`
                    });


                    $("#primary_industry_service_ssic_id").empty().append(options)
                    $("#secondary_industry_service_ssic_id").empty().append(options)
                    // response(data);
                }
            });
        })
        // $('#submit').on('submit')
        //     (value.invoices.length > 0 ? `<td class="startDate-data col-2 col-md-2 col-lg-2">${$.date(value.invoices[0].subscription_start)}</td>` : `<td class="startDate-data col-2 col-md-2 col-lg-2">-</td>`)+

        function sort(e){
            let column = e.getAttribute('data-column')
            let sortBy = e.getAttribute('data-sortBy')
            let direction = e.getAttribute('data-direction')
            let url = "{{ route('company.sort', ['sortBy'=>':sortBy', 'currentDirection'=>':currentDirection']) }}"
            url=url.replace(':sortBy', sortBy)
            url=url.replace(':currentDirection', direction)

            $.ajax({
                url: url,
                beforeSend: function () {
                    if (column == 'Status'){
                        $('#sort_by_status').addClass('fa-pulse');
                    }else if(column == 'Fye'){
                        $('#sort_by_fye').addClass('fa-pulse');
                    }else if(column == 'Incorporation'){
                        $('#sort_by_incorporation').addClass('fa-pulse');
                    }else if(column == 'AR'){
                        $('#sort_by_ar').addClass('fa-pulse');
                    }else if(column == 'AGM'){
                        $('#sort_by_agm').addClass('fa-pulse');
                    }else if(column == 'Next_Renewal'){
                        $('#sort_by_next_renewal').addClass('fa-pulse');
                    }else if(column == 'Name'){
                        $('#sort_by_name').addClass('fa-pulse');
                    }

                },
                success: function(res) {
                    console.log(res)
                    if (column == 'Status'){
                        setButtonAttributeForSorting('#sort_by_status', direction)
                    }else if(column == 'Fye'){
                        setButtonAttributeForSorting('#sort_by_fye', direction)
                    }else if(column == 'Incorporation'){
                        setButtonAttributeForSorting('#sort_by_incorporation', direction)
                    }else if(column == 'AR'){
                        setButtonAttributeForSorting('#sort_by_ar', direction)
                    }else if(column == 'AGM'){
                        setButtonAttributeForSorting('#sort_by_agm', direction)
                    }else if(column == 'Next_Renewal'){
                        setButtonAttributeForSorting('#sort_by_next_renewal', direction)
                    }else if(column == 'Name'){
                        setButtonAttributeForSorting('#sort_by_name', direction)
                    }

                    determinePaginationArrow(res)
                    $('.pagination-left-number').text(res.current_page)
                    $('.pagination-right-number').text(res.last_page)
                    injectClass('sortCompany')
                    $(".pagination-part .left-arrow").attr('data-href', res.prev_page_url)
                    $(".pagination-part .right-arrow").attr('data-href', res.next_page_url)
                    domLoad(res.data)
                    styleCompanyStatus("company-status")
                },
                error: function (xhr) {
                    if (xhr.responseJSON.message == 'Unauthenticated.'){
                        $('#flashMessages').html(
                            `<div class="alert alert-success">
                            <img class="alert-img" src="{{asset('assets/icons/mailbody-!.png')}}" alt="">
                            <p class="alert-text">Unauthenticated.Please login to continue</p></div>`
                        )
                    }else {
                        $('#flashMessages').html(
                            `<div class="alert alert-success">
                            <img class="alert-img" src="{{asset('assets/icons/mailbody-!.png')}}" alt="">
                            <p class="alert-text">Something went wrong!</p></div>`
                        )
                    }
                    if ( $('#sort_by_status').hasClass('fa-pulse')){
                        $('#sort_by_status').removeClass('fa-pulse')
                    }else if($('#sort_by_fye').hasClass('fa-pulse')){
                        $('#sort_by_fye').removeClass('fa-pulse');
                    }else if($('#sort_by_incorporation').hasClass('fa-pulse')){
                        $('#sort_by_incorporation').removeClass('fa-pulse')
                    }else if($('#sort_by_ar').hasClass('fa-pulse')){
                        $('#sort_by_ar').removeClass('fa-pulse')
                    }else if($('#sort_by_agm').hasClass('fa-pulse')){
                        $('#sort_by_agm').removeClass('fa-pulse')
                    }else if($('#sort_by_next_renewal').hasClass('fa-pulse')){
                        $('#sort_by_next_renewal').removeClass('fa-pulse')
                    }else if($('#sort_by_name').hasClass('fa-pulse')){
                        $('#sort_by_name').removeClass('fa-pulse')
                    }
                }
            });
        }

        function setButtonAttributeForSorting(buttonId,direction) {
            $(buttonId).removeClass('fa-pulse');
            if (direction == 'DESC'){
                $(buttonId).attr('data-direction', 'ASC')
            }else {
                $(buttonId).attr('data-direction', 'DESC')
            }
        }
    </script>

@endpush
