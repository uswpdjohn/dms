<div class="select-pagination-portion table-top-portion row g-0">
    <!-- responsive task: change col class in this row -->
    <div class="sb-part search-box-part col-12 col-md-4 offset-lg-1 col-lg-5">
        <div class="d-flex form-inputs search-data">
            <input class="form-control" type="text" name="member_search" placeholder=" Name" id="member_search"   value="{{request()->has('member_search') ? request()->get('member_search') : ''}}">
            <button type="button" onclick="membersSearchActivity()" class="search-btn btn"><i class="fa-solid fa-search"></i></button>
        </div>
    </div>
</div>
<!-- responsive task: get table inside div  -->
<div class="table-responsive">
    <div class="member-manage-body">
        <div class="member member-table-header row g-0">
            <div class="col-2 col-md-2 col-lg-2 header-div">
                <span>Name</span>
            </div>
            <div class="col-2 col-md-2 col-lg-2 header-div">
                <span>OS</span>
            </div>
            <div class="col-2 col-md-2 col-lg-2 header-div">
                <span>PS</span>
            </div>
            <div class="col-2 col-md-2 col-lg-2 header-div">
                <span>ESOP</span>
            </div>
            <div class="col-1 col-md-1 col-lg-1 header-div">
                <span>CN</span>
            </div>
            <div class="col-2 col-md-2 col-lg-2 header-div">
                <span>Total # of Share</span>
            </div>
            <div class="col-1 col-md-1 col-lg-1 header-div">
                <span>Total %</span>
            </div>
        </div>
        <div id="customer-member-list"></div>
    </div>
</div>
<div id="pagination-wrapper"></div>
@section('memberCustomerTableJs')
    <script>
        //NOT USING////NOT USING////NOT USING////NOT USING////NOT USING//

        {{--let url=''--}}
        {{--$(document).on('click', '.pagination-part .left-arrow', function () {--}}
        {{--    var page = $(this).attr('data-href').split('page=')[1];--}}
        {{--    console.log(page)--}}
        {{--    if ($(this).attr('data-href') != '') {--}}
        {{--        if ($(this).hasClass('member-base')){--}}
        {{--            url = "/cap-table-members?page="+page--}}
        {{--        }else if($(this).hasClass('as-on-filter')){--}}
        {{--            var filterParam = $(this).attr('data-href').split('?')[0].split('/')[4]--}}
        {{--            url = "cap-table-members-as-on-filter/" + filterParam + "?page="+page--}}
        {{--            console.log(filterParam)--}}
        {{--        }else if($(this).hasClass('member-search')){--}}
        {{--            var searchParam = $(this).attr('data-href').split('?')[0].split('/')[4]--}}
        {{--            url = "cap-table-members-search/" + searchParam + "?search="+searchParam+"&page="+page--}}
        {{--        }--}}
        {{--        fetch_data(url);--}}
        {{--    }--}}
        {{--})--}}
        {{--$(document).on('click', '.pagination-part .right-arrow', function () {--}}
        {{--    var page = $(this).attr('data-href').split('page=')[1];--}}
        {{--    if ($(this).attr('data-href') != '') {--}}
        {{--        if ($(this).hasClass('member-base')){--}}
        {{--            url = "/cap-table-members?page="+page--}}
        {{--        }else if($(this).hasClass('as-on-filter')){--}}
        {{--            var filterParam = $(this).attr('data-href').split('?')[0].split('/')[4]--}}
        {{--            url = "cap-table-members-as-on-filter/" + filterParam + "?page="+page--}}
        {{--        }else if($(this).hasClass('member-search')){--}}
        {{--            var searchParam = $(this).attr('data-href').split('?')[0].split('/')[4]--}}
        {{--            url = "cap-table-members-search/" + searchParam + "?search="+searchParam+"&page="+page--}}
        {{--        }--}}
        {{--        fetch_data(url);--}}
        {{--    }--}}
        {{--})--}}
        {{--function addCommas(nStr) {--}}
        {{--    nStr += '';--}}
        {{--    x = nStr.split('.');--}}
        {{--    x1 = x[0];--}}
        {{--    x2 = x.length > 1 ? '.' + x[1] : '';--}}
        {{--    console.log(x2)--}}
        {{--    var rgx = /(\d+)(\d{3})/;--}}
        {{--    while (rgx.test(x1)) {--}}
        {{--        x1 = x1.replace(rgx, '$1' + ',' + '$2');--}}
        {{--    }--}}
        {{--    return x1 + x2;--}}
        {{--}--}}
        {{--function fetch_data(url) {--}}
        {{--    $.ajax({--}}
        {{--        type: "GET",--}}
        {{--        url: url,--}}
        {{--        success: function (obj) {--}}

        {{--            determinePaginationArrow(obj)--}}
        {{--            // $('#left-arrow').addClass('as-on-filter')--}}
        {{--            // $('#right-arrow').addClass('as-on-filter')--}}

        {{--            $('#left-number').text(obj.data.current_page)--}}
        {{--            $('#right-number').text(obj.data.last_page)--}}

        {{--            // $("#left-arrow").removeAttr('href')--}}
        {{--            // $("#right-arrow").removeAttr('href')--}}

        {{--            $("#left-arrow").attr('data-href', obj.data.prev_page_url)--}}
        {{--            $("#right-arrow").attr('data-href', obj.data.next_page_url)--}}


        {{--            memberCustomerTableDomLoad(obj)--}}

        {{--            // window.location.reload()--}}
        {{--        }--}}
        {{--    })--}}
        {{--}--}}
        {{--function fetchMembersData() {--}}

        {{--    let pagination_wrapper= "#pagination-wrapper"--}}
        {{--    let indexUrl="{{route('capTableMembers.index')}}"--}}
        {{--    $.ajax({--}}
        {{--        type: "GET",--}}
        {{--        url: indexUrl,--}}
        {{--        success: function (obj) {--}}
        {{--            $(pagination_wrapper).html(appendPaginator)--}}
        {{--            determinePaginationArrow(obj)--}}
        {{--            $('#left-arrow').removeClass('as-on-filter')--}}
        {{--            $('#right-arrow').removeClass('as-on-filter')--}}
        {{--            $('#left-arrow').addClass('member-base')--}}
        {{--            $('#right-arrow').addClass('member-base')--}}

        {{--            $('#left-number').text(obj.data.current_page)--}}
        {{--            $('#right-number').text(obj.data.last_page)--}}

        {{--            $("#left-arrow").removeAttr('href')--}}
        {{--            $("#right-arrow").removeAttr('href')--}}

        {{--            $("#left-arrow").attr('data-href', obj.data.prev_page_url)--}}
        {{--            $("#right-arrow").attr('data-href', obj.data.next_page_url)--}}


        {{--            memberCustomerTableDomLoad(obj)--}}

        {{--            // window.location.reload()--}}
        {{--        }--}}
        {{--    })--}}
        {{--}--}}
        {{--function getAsOnDateData(e) {--}}
        {{--    let pagination_wrapper= "#pagination-wrapper"--}}
        {{--    let url="{{route('members.asOn', ':asOn')}}"--}}
        {{--    url=url.replace(':asOn', e)--}}
        {{--    $.ajax({--}}
        {{--        type: "GET",--}}
        {{--        url: url,--}}
        {{--        success: function (obj) {--}}
        {{--            $(pagination_wrapper).html(appendPaginator)--}}
        {{--            determinePaginationArrow(obj)--}}
        {{--            $('#left-arrow').addClass('as-on-filter')--}}
        {{--            $('#right-arrow').addClass('as-on-filter')--}}
        {{--            $('#left-arrow').removeClass('member-base')--}}
        {{--            $('#right-arrow').removeClass('member-base')--}}

        {{--            $('#left-number').text(obj.data.current_page)--}}
        {{--            $('#right-number').text(obj.data.last_page)--}}

        {{--            $("#left-arrow").removeAttr('href')--}}
        {{--            $("#right-arrow").removeAttr('href')--}}

        {{--            $("#left-arrow").attr('data-href', obj.data.prev_page_url)--}}
        {{--            $("#right-arrow").attr('data-href', obj.data.next_page_url)--}}


        {{--            memberCustomerTableDomLoad(obj)--}}

        {{--            // window.location.reload()--}}
        {{--        }--}}
        {{--    })--}}
        {{--}--}}
        {{--function determinePaginationArrow(obj) {--}}
        {{--    console.log('in')--}}
        {{--    console.log('arrow',obj.data.current_page == obj.data.last_page)--}}

        {{--    let left_arrow = ""--}}
        {{--    let right_arrow = ""--}}
        {{--    left_arrow = "#left-arrow"--}}
        {{--    right_arrow = "#right-arrow"--}}

        {{--    if (obj.data.current_page > 1) {--}}
        {{--        if ($(left_arrow).hasClass("d-none") == true) {--}}
        {{--            $(left_arrow).removeClass('d-none')--}}
        {{--        }--}}
        {{--    } else {--}}
        {{--        $(left_arrow).addClass('d-none')--}}
        {{--    }--}}
        {{--    if (obj.data.current_page == obj.data.last_page) {--}}
        {{--        $(right_arrow).addClass('d-none')--}}
        {{--    } else {--}}
        {{--        $(right_arrow).removeClass('d-none')--}}
        {{--    }--}}
        {{--}--}}
        {{--function memberCustomerTableDomLoad(obj){--}}
        {{--    let wrapper = '#customer-member-list'--}}
        {{--    let html = ''--}}
        {{--    let total=obj.total--}}
        {{--    console.log(obj)--}}
        {{--    if(obj.data.data.length > 0 ){--}}
        {{--        console.log('in1')--}}
        {{--        $.map(obj, function(item,i){--}}
        {{--            $.map(item.data, function (value) {--}}
        {{--                var individual_member_total_share_number = 0;--}}
        {{--                var individual_member_total_amount = 0;--}}
        {{--                for (var i = 0; i < value.cap_table_activity.length; i++) {--}}
        {{--                    individual_member_total_share_number += value.cap_table_activity[i].share_number;--}}
        {{--                    individual_member_total_amount += value.cap_table_activity[i].amount;--}}
        {{--                }--}}
        {{--                html+= ` <div class="member row g-0">--}}
        {{--        <div class="col-2 col-md-2 col-lg-2 document-div">--}}
        {{--            <a href="#" class="action-buttons" data-bs-toggle="modal" data-id="${value.id}" data-bs-target="#memberViewModal-${value.id}">${value.name}</a>--}}

        {{--            <div class="modal fade " id="memberViewModal-${value.id}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="memberViewModalLabel" aria-hidden="true">--}}
        {{--                <div class="modal-dialog member-view-modal">--}}
        {{--                    <div class="modal-content">--}}
        {{--                        <div class="member-view-modal-body">--}}
        {{--                            <div class="member-view-modal-header row">--}}
        {{--                                <h6 class="modal-title col-11" id="memberViewModalLabel">${value.name}</h6>--}}
        {{--                                <button type="button" class="btn btn-close btn-sm member-view-modal-close-btn col-1" data-bs-dismiss="modal" aria-label="Close"></button>--}}
        {{--                            </div>--}}
        {{--                            <div class="member-view-modal-data row">--}}
        {{--                                <form action="#">--}}
        {{--                                    <div class="data-body row">--}}
        {{--                                        <div class="table-responsive">--}}
        {{--                                            <div class="member-manage-body">--}}
        {{--                                                <div class="member row g-0 header-row">--}}
        {{--                                                    <div class="col-2 col-md-2 col-lg-2 header-div">--}}
        {{--                                                        <span>Transaction Date</span>--}}
        {{--                                                    </div>--}}
        {{--                                                    <div class="col-2 col-md-2 col-lg-2 header-div">--}}
        {{--                                                        <span>Funding Round</span>--}}
        {{--                                                    </div>--}}
        {{--                                                    <div class="col-2 col-md-2 col-lg-2 header-div">--}}
        {{--                                                        <span>Type of Share</span>--}}
        {{--                                                    </div>--}}
        {{--                                                    <div class="col-3 col-md-3 col-lg-3 header-div">--}}
        {{--                                                        <span>Number of Shares</span>--}}
        {{--                                                    </div>--}}
        {{--                                                    <div class="col-3 col-md-3 col-lg-3 header-div">--}}
        {{--                                                        <span>Amount Raised</span>--}}
        {{--                                                    </div>--}}

        {{--                                                </div>`+--}}
        {{--                                                (value.cap_table_activity.length > 0 ? (value.cap_table_activity.map((activity) => `<div class="member row g-0">--}}
        {{--                                                <div class="col-2 col-md-2 col-lg-2 entry-data"><span>${activity.transaction_date}</span></div> <div class="col-2 col-md-2 col-lg-2 entry-data">--}}
        {{--                                                        <p>${activity.funding_round}</p></div><div class="col-2 col-md-2 col-lg-2 entry-data">--}}
        {{--                                                        <p>${activity.share_type}</p>--}}
        {{--                                                    </div> <div class="col-3 col-md-3 col-lg-3 entry-data">--}}
        {{--                                                        <p>${activity.share_number}</p>--}}
        {{--                                                    </div> <div class="col-3 col-md-3 col-lg-3 entry-data">--}}
        {{--                                                        <p>$${addCommas(activity.amount)}</p>--}}
        {{--                                                    </div></div>`).join("")) : `<div class="member row g-0">--}}
        {{--                                                                                   <div class="text-center col-12 document-div">--}}
        {{--                                                                                       <span>No Data Available</span>--}}
        {{--                                                                                   </div>--}}
        {{--                                                                               </div>`)+--}}
        {{--                                    `<div class="member row g-0 footer-row">--}}
        {{--                                       <div class="col-2 col-md-2 col-lg-2 footer-div">--}}
        {{--                                           <span>Total</span>--}}
        {{--                                       </div>--}}
        {{--                                       <div class="col-2 col-md-2 col-lg-2 footer-div">--}}
        {{--                                           <p> </p>--}}
        {{--                                       </div>--}}
        {{--                                       <div class="col-2 col-md-2 col-lg-2 footer-div">--}}
        {{--                                           <p> </p>--}}
        {{--                                       </div>--}}
        {{--                                       <div class="col-3 col-md-3 col-lg-3 footer-div">--}}
        {{--                                           <p>${individual_member_total_share_number}</p>--}}
        {{--                                                    </div>--}}
        {{--                                                    <div class="col-3 col-md-3 col-lg-3 footer-div">--}}
        {{--                                                        <p>$${addCommas(individual_member_total_amount)}</p>--}}
        {{--                                                    </div>--}}
        {{--                                                </div>--}}
        {{--                                            </div>--}}
        {{--                                        </div>--}}
        {{--                                        <div class="data-row col-12 text-end">--}}
        {{--                                            <button type="button" class="close-view-btn btn" data-bs-dismiss="modal" aria-label="Close">Close</button>--}}
        {{--                                        </div>--}}
        {{--                                    </div>--}}
        {{--                                </form>--}}
        {{--                            </div>--}}
        {{--                        </div>--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </div>--}}
        {{--        <div class="col-2 col-md-2 col-lg-2 document-div">`+--}}
        {{--                    (value.cap_table_sum.length > 0 ? value.cap_table_sum.map((data) => (data.share_type == 'ordinary' ? `<p>${data.sum_of_share_number}</p>` : null)).join("")  : `<p>0</p>`)+--}}
        {{--                    `</div>--}}
        {{--       <div class="col-2 col-md-2 col-lg-2 document-div">`+--}}
        {{--                    (value.cap_table_sum.length > 0 ? value.cap_table_sum.map((data) => (data.share_type == 'preference' ? `<p>${data.sum_of_share_number}</p>` : '')).join("")  : `<p>0</p>`)+--}}

        {{--                    `</div>--}}
        {{--       <div class="col-2 col-md-2 col-lg-2 document-div member-div">`+--}}
        {{--                    (value.cap_table_sum.length > 0 ? value.cap_table_sum.map((data) => (data.share_type == 'esop' ? `<p>${data.sum_of_share_number}</p>` : '')).join("")  : `<p>0</p>`)+--}}

        {{--                    `</div>--}}
        {{--       <div class="col-1 col-md-1 col-lg-1 document-div">`+--}}
        {{--                    (value.cap_table_sum.length > 0 ? value.cap_table_sum.map((data) => (data.share_type == 'convertible' ? `<p>${data.sum_of_share_number}</p>` : '')).join("")  : `<p>0</p>`)+--}}
        {{--                    `</div>--}}
        {{--       <div class="col-2 col-md-2 col-lg-2 document-div">`+--}}
        {{--                    (value.cap_table_total_share_sum.length > 0 ? value.cap_table_total_share_sum.map((data) => `<p>${addCommas(data.sum_of_total_share_number)}</p>`).join("")  : `<p>0</p>`)+--}}
        {{--                    `</div>--}}
        {{--       <div class="col-1 col-md-1 col-lg-1 document-div">`+--}}
        {{--                    (value.cap_table_total_share_sum.length > 0 ? value.cap_table_total_share_sum.map((data) => `<p>${(data.sum_of_total_share_number/total).toFixed(2)}%</p>`).join("")  : `<p>0</p>`)+--}}
        {{--                    `</div>--}}
        {{--       </div>`--}}
        {{--            }).join("")--}}
        {{--        }).join("")--}}
        {{--    }else {--}}
        {{--        console.log('in2')--}}
        {{--        html+=`<div class="member row g-0">--}}
        {{--                   <div class="text-center col-12 document-div">--}}
        {{--                       <span>No Data Available</span>--}}
        {{--                   </div>--}}
        {{--               </div>`--}}
        {{--    }--}}
        {{--    $(wrapper).empty().append(html)--}}

        {{--}--}}
        {{--function membersSearchActivity() {--}}
        {{--    let pagination_wrapper= "#pagination-wrapper"--}}
        {{--    let search = $('#member_search').val()--}}
        {{--    var url = "<?php echo e(route('members.search', ':search')); ?>";--}}
        {{--    url = url.replace(':search', search);--}}
        {{--    $.ajax({--}}
        {{--        type: "GET",--}}
        {{--        url: url,--}}
        {{--        success: function (obj) {--}}
        {{--            $(pagination_wrapper).html(appendPaginator)--}}
        {{--            determinePaginationArrow(obj)--}}
        {{--            $('#left-arrow').addClass('member-search')--}}
        {{--            $('#right-arrow').addClass('member-search')--}}
        {{--            $('#left-arrow').removeClass('member-base')--}}
        {{--            $('#right-arrow').removeClass('member-base')--}}
        {{--            $('#left-arrow').removeClass('as-ob-filter')--}}
        {{--            $('#right-arrow').removeClass('as-ob-filter')--}}

        {{--            $('#left-number').text(obj.data.current_page)--}}
        {{--            $('#right-number').text(obj.data.last_page)--}}

        {{--            $("#left-arrow").removeAttr('href')--}}
        {{--            $("#right-arrow").removeAttr('href')--}}

        {{--            $("#left-arrow").attr('data-href', obj.data.prev_page_url)--}}
        {{--            $("#right-arrow").attr('data-href', obj.data.next_page_url)--}}

        {{--            memberCustomerTableDomLoad(obj)--}}
        {{--        }--}}
        {{--    })--}}
        {{--}--}}
        {{--function appendPaginator() {--}}
        {{--    return `<div class="select-pagination-portion table-bottom-portion row g-0">--}}
        {{--            <div class="pagination-part bottom-pagination-part col-12 col-md-5 col-lg-4">--}}
        {{--                <a href="" data-href="" class="btn left-arrow" id="left-arrow"><i class="fa-solid fa-chevron-left"></i></a>--}}
        {{--                <span class="pagination-number pagination-left-number" id="left-number"></span>--}}
        {{--                <span class="pagination-divider">/</span>--}}
        {{--                <span class="pagination-number pagination-right-number" id="right-number"></span>--}}
        {{--                <a href="" data-href="" class="btn right-arrow" id="right-arrow"><i class="fa-solid fa-chevron-right"></i></a>--}}
        {{--                </div>--}}
        {{--            </div>`--}}
        {{--}--}}
        {{--$('#member_search').on('keyup', function () {--}}
        {{--    if (this.value.length == 0) {--}}
        {{--        fetchMembersData()--}}
        {{--    }--}}
        {{--})--}}

    </script>
@stop
