@extends('layouts.master')
@section('content')
    <!-- Main Body Start -->


        <div class="row main-body g-0">
        <div class="top-part">
            <button type="button" onclick="window.history.back()" class="btn back-btn"><i class="fa-solid fa-arrow-left"></i></button>
{{--            <h5 class="top-header">Notifications</h5>--}}
        </div>
        <div class="card admin-notification-card">
            <div class="card-body">
                <div class="select-pagination-portion  table-top-portion row g-0">
                    <div class="select-part col-2 col-md-2 col-lg-2">
                        <input type="checkbox" class="select-all-checkbox">
                        <label for="" class="selected-checkbox-number">Select All</label>
                    </div>
                    <div class="sb-part search-box-part col-6 col-md-6  col-lg-6">
                        <div class="d-flex form-inputs search-data">
                            <input class="form-control notification-search" type="text" name="search" id="notification_search_upper" value="" placeholder=" Search ">
                            <button type="button" class="search-btn btn" onclick="searchNotification()"><i class="fa-solid fa-search"></i></button>
                        </div>
                    </div>
                    <div class="button-part col-6 col-md-6 col-lg-6">
                        <button type="button" class="btn unread-btn action-buttons" onclick="markAsRead()">Mark as Read</button>
                        <button type="button" class="btn unread-btn action-buttons" onclick="markAsUnread()">Mark as Unread</button>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#notificationDeleteModal" class="btn delete-btn action-buttons ">Delete</button>
                        <!-- Delete Modal Start -->
                        <div class="modal fade" id="notificationDeleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="notificationDeleteModalLabel" aria-hidden="true">
                            <div class="modal-dialog notification-delete-modal">
                                <div class="modal-content">
                                    <div class="notification-delete-modal-body">
                                        <p class="text-center">Confirm Delete</p>
                                        <div class="text-center">
                                            <button type="button" class="btn btn-sm notification-delete-modal-close-btn"  data-bs-dismiss="modal" aria-label="No">No</button>
                                            <button type="button" onclick="deleteMarked()" class="btn btn-sm yes-btn">Yes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Delete Modal End -->
                    </div>
{{--                    @foreach($notifications as $notification)--}}

{{--                    @if($notifications->hasPages())--}}
{{--                        <div class="pagination-part">--}}
{{--                            <input type="text" id="last_page" value="{{$notifications->hasPages()}}" hidden="hidden">--}}
{{--                            @if(!$notifications->onFirstPage())--}}
{{--                                <a data-href="{{$notifications->previousPageUrl()}}" class="btn d-none"><i class="fa-solid fa-chevron-left"></i></a>--}}
{{--                            @endif--}}
{{--                            <span class="pagination-number pagination-left-number">{{$notifications->currentPage()}}</span>--}}
{{--                            <span class="pagination-divider">/</span>--}}
{{--                            <span class="pagination-number pagination-right-number">{{$notifications->lastPage()}}</span>--}}
{{--                            @if(!$notifications->onLastPage())--}}
{{--                                <a data-href="{{$notifications->nextPageUrl()}}" class="btn d-none"><i class="fa-solid fa-chevron-right"></i></a>--}}
{{--                            @endif--}}
{{--                        </div>--}}
{{--                    @endif--}}
{{--                    @endforeach--}}
                </div>
                <div class="admin-notification-body">
                    <!-- This notification box height will depends on the number of data row -->
                    <div id="notification-data">
                        @if(count($notifications) > 0)
                            @foreach($notifications as $key=>$notification)
                                <div class="notifications row g-0 unread" >
                                    <div class="col-2 col-md-2 col-lg-2 checkbox-div">
                                        <input type="checkbox" class="select-checkbox notification-{{$key}}" name="notification-id[]" value="{{$notification['id']}}">
                                    </div>
                                    <div class="col-6 col-md-6 col-lg-6 data-div">
                                        @if($notification['read_at'] != null)
                                            <!-- Button trigger modal -->
                                            <a type="button" class="" data-bs-toggle="modal" data-bs-target="#staticBackdrop-{{$key}}" style="text-decoration: none">
                                                <p class="" style="color: #777777; font-weight: 400;">{{$notification['data']['notification']}}</p>
                                            </a>

                                        @else
                                            <!-- Button trigger modal -->
                                            <a type="button" class="" data-bs-toggle="modal" data-bs-target="#staticBackdrop-{{$key}}" style="text-decoration: none">
                                                <p class="" style="color:#000000; font-weight: bold;">{{$notification['data']['notification']}}</p>
                                            </a>

                                        @endif
                                    </div>
                                    <div class="col-4 col-md-4 col-lg-4 time-div">
{{--                                        <span>{{$notification['created_at']->diffForHumans(now(), \Carbon\CarbonInterface::DIFF_RELATIVE_AUTO, true)}}</span>--}}
                                        <span>{{\Carbon\Carbon::parse($notification['created_at'])->format('d/m/Y')}}</span>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <h6 class="" style="text-align: center; color:#777777;padding: 10px;margin: auto;">No Data Available ...</h6>
                        @endif
                    </div>

                </div>
                <div class="select-pagination-portion end-select-pagination-portion table-bottom-portion row g-0">
                    <div class="select-part col-2 col-md-2 col-lg-2">
                        <input type="checkbox" class="select-all-checkbox">
                        <label for="" class="selected-checkbox-number">Select All</label>
                    </div>
                    <div class="sb-part search-box-part col-6 col-md-6  col-lg-6">
                        <form action="#" id="notification_search_lower_form">
                            <div class="d-flex form-inputs search-data">
                                <input class="form-control notification-search"  name="search" value="" type="text"  placeholder="Search">
                                <button type="button" class="search-btn btn" onclick="searchNotification()"><i class="fa-solid fa-search"></i></button>
                            </div>
                        </form>
                    </div>
                    <div class="button-part col-6 col-md-6 col-lg-6">
                        <button type="button" class="btn unread-btn action-buttons" onclick="markAsRead()">Mark as Read</button>
                        <button type="button" onclick="markAsUnread()" class="btn unread-btn action-buttons">Mark as Unread</button>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#notificationDeleteModal" class="btn delete-btn action-buttons ">Delete</button>
                    </div>
                    <div class="pagination-part">
                        <input type="text" id="last_page" value="{{$notifications->hasPages()}}" hidden="hidden">
                        {{--                            @if(!$notifications->onFirstPage())--}}
                        <a data-href="{{$notifications->previousPageUrl()}}" class="btn d-none left-arrow"><i class="fa-solid fa-chevron-left"></i></a>
                        {{--                            @endif--}}
                        <span class="pagination-number pagination-left-number">{{$notifications->currentPage()}}</span>
                        <span class="pagination-divider">/</span>
                        <span class="pagination-number pagination-right-number">{{$notifications->lastPage()}}</span>
                        {{--                            @if(!$notifications->onLastPage())--}}
                        <a data-href="{{$notifications->nextPageUrl()}}" class="btn d-none right-arrow"><i class="fa-solid fa-chevron-right"></i></a>
                        {{--                            @endif--}}
                    </div>
                </div>
                <!-- Modal -->
                <div id="notification-modal">
                @if(count($notifications) > 0)
                    @foreach($notifications as $key=>$notification)
                        <div class="modal fade" id="staticBackdrop-{{$key}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog ">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <span class="notification-icon"><i class="fa-regular fa-bell bell-icon"></i></span>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        {{$notification['data']['notification']}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
                </div>
                <!-- Modal -->
            </div>
        </div>
    </div>

    <!-- Main Body End -->

@endsection
@push('customScripts')
    <script>
        let url= "notification?page="
        $('.pagination-part .left-arrow').on('click', function () {
            if ($(this).attr('data-href') != '') {
                var page = $(this).attr('data-href').split('page=')[1];
                if ($('.pagination-part .left-arrow').hasClass('searchNotification') == true) {
                    let search = $(this).attr('data-href').split('?')[0].split('/')[4]
                    url = "search-notification/" + search + "?page="
                }
                fetch_data(page);
            }
        })
        $('.pagination-part .right-arrow').on('click', function () {
            if ($(this).attr('data-href') != '') {
                var page = $(this).attr('data-href').split('page=')[1];
                if ($('.pagination-part .right-arrow').hasClass('searchNotification') == true) {
                    let search = $(this).attr('data-href').split('?')[0].split('/')[4]
                    url = "search-notification/" + search + "?page="
                }
                fetch_data(page);
            }

        })

        function fetch_data(page) {
            let wrapper = "#t-body"
            $.ajax({
                url: url + page,
                success: function (res) {
                    determinePaginationArrow(res)

                    $('.pagination-left-number').text(res.current_page)
                    $('.pagination-right-number').text(res.last_page)
                    $(".pagination-part .left-arrow").attr('data-href', res.prev_page_url)
                    $(".pagination-part .right-arrow").attr('data-href', res.next_page_url)

                    domLoad(res.data)
                }
            });
        }

        function domLoad(res){
            let wrapper='#notification-data'
            let modalWrapper='#notification-modal'
            let table=''
            let modal=''

            $.map(res, function(value,i){
                if(value.length!=0){
                    table+= `<div class="notifications row g-0 unread" >
                                    <div class="col-2 col-md-2 col-lg-2 checkbox-div">
                                        <input type="checkbox" class="select-checkbox notification-${i}" name="notification-id[]" value="${value.id}">
                                    </div>
                                    <div class="col-6 col-md-6 col-lg-6 data-div">` + (value.read_at != null ? `<a type="button" class="" data-bs-toggle="modal" data-bs-target="#staticBackdrop-${i}" style="text-decoration: none"><p class="" style="color: #777777; font-weight: 400;">${value.data.notification}</p></a>` : `<a type="button" class="" data-bs-toggle="modal" data-bs-target="#staticBackdrop-${i}" style="text-decoration: none"><p class="" style="color:#000000; font-weight: bold;">${value.data.notification}</p></a>`) + `</div>
                                    <div class="col-4 col-md-4 col-lg-4 time-div">

                                        <span>${$.date(value.created_at)}</span>
                                    </div>
                            </div>`

                    modal+=`<div class="modal fade" id="staticBackdrop-${i}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog ">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <span class="notification-icon"><i class="fa-regular fa-bell bell-icon"></i></span>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            ${value.data.notification}
                                        </div>
                                    </div>
                                </div>
                            </div>`
                }

            })
            $(wrapper).empty().append(table)
            $(modalWrapper).empty().append(modal)
            checkbox()
            selectedCheckBox()

        }
        $.date = function(dateObject) {
            var d = new Date(dateObject);
            var day = d.getDate();
            var month = d.getMonth() + 1;
            var year = d.getFullYear();
            if (day < 10) {
                day = "0" + day;
            }
            if (month < 10) {
                month = "0" + month;
            }
            var date = day + "/" + month + "/" + year;

            return date;
        };



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

        function selectedCheckBox() {
            $("input[type='checkbox']").change(function (e) {
                let idValue=$(this).attr("value")
                if ($(this).is(':checked')) {
                    id.push(idValue); //pushing checked id in array

                } else {
                    let index = id.indexOf(e.target.value)
                    id.splice(index, 1)
                }
            })
        }



        let id=[]
        $(document).ready(function(){
            $("input[type='checkbox']").change(function (e) {
                let idValue=$(this).attr("value")
                if ($(this).is(':checked')) {
                    id.push(idValue); //pushing checked id in array
                } else {
                    let index = id.indexOf(e.target.value)
                    id.splice(index, 1)
                }
                id=id.filter(e => e)
                // console.log(id)
            })
            selectedCheckBox()
            checkbox()

            let page=$('#last_page').val()

            if (page != ""){
                $('.pagination-part .right-arrow').removeClass('d-none')
            }else {

                $('.pagination-part .right-arrow').addClass('d-none')
                // $('.pagination-part').addClass('d-none')
            }
        });

        function checkbox() {
            var $checkboxes = $('.admin-notification-body .notifications  input[type="checkbox"]');
            $('.button-part').hide();
            function checkbox(){
                var countCheckedCheckboxes = $checkboxes.filter(':checked').length;
                if(countCheckedCheckboxes > 0){
                    $('.selected-checkbox-number').text(countCheckedCheckboxes + " selected");
                    $('.search-box-part').hide();
                    $('.button-part').show();
                }
                else{
                    $('.selected-checkbox-number').text("Select All");
                    $('.search-box-part').show();
                    $('.button-part').hide();
                }
            }
            $checkboxes.change(function(e){
                console.log(e)
                e.target.parentElement.parentElement.classList.toggle("selected");
                checkbox();
            });
            $(".select-all-checkbox").click(function () {
                $('input:checkbox').not(this).prop('checked', this.checked);
                $('input:checkbox.select-checkbox').each(function (e) {
                    // var sThisVal = (this.checked ? $(this).val() : "");
                    if(this.checked){
                        id.push($(this).val())
                    }else {
                        let index = id.indexOf($(this).val())
                        id.splice(index, 1)
                    }
                    // id=id.filter(e => e) //removing undefined value from array
                    console.log(id)
                });
                checkbox();
            });

            $('.action-buttons').click(function(e){
                const notificationTopBtns = document.querySelectorAll(".action-buttons");
                notificationTopBtns.forEach((btn) => {
                    notificationTopBtns.forEach(f => f.classList.remove('active'));
                    e.target.classList.toggle("active");
                });
            });
        }

        function markAsUnread(){
            id=id.filter(e => e) //removing undefined value from array
            id = getUnique(id)
            let markAsUnreadURL ="mark-as-unread/"+id
            console.log(markAsUnreadURL)
            $.ajax({
                type: "GET",
                url: markAsUnreadURL,
                success: function (obj, textstatus) {
                    window.location.reload()
                    // window.addEventListener("DOMContentLoaded", hardRefresh());
                }
            })
        }
        function markAsRead(){
            id=id.filter(e => e) //removing undefined value from array
            id = getUnique(id)
            // console.log(id)
            let markAsReadURL ="mark-as-read/"+id
            // console.log(markAsUnreadURL)
            $.ajax({
                type: "GET",
                url: markAsReadURL,
                success: function (obj, textstatus) {
                    window.location.reload()
                    // window.addEventListener("DOMContentLoaded", hardRefresh());
                }
            })
        }
        function deleteMarked() {
            id=id.filter(e => e) //removing undefined value from array
            id = getUnique(id)
            $('#notificationDeleteModal').modal('hide')
           let URL="delete-marked/"+id
            $.ajax({
                type: "GET",
                url: URL,
                success: function (obj, textstatus) {
                    window.location.reload()
                    // window.addEventListener("DOMContentLoaded", hardRefresh());
                },
            })
        }
        $('.notification-search').on('keyup', function () {
           if (this.value.length == 0){
               searchNotification()
           }
        })

        function searchNotification() {
            let value=0
            $("input[name='search']").each(function() {
                if (this.value.length != 0){
                    value=this.value;
                }
            });


            let url = "{{ route('search.notification', ':search') }}"
            url=url.replace(':search', value)
            $.ajax({
                url: url,
                success: function(res) {
                    // console.log(res.last_page)
                    determinePaginationArrow(res)
                    //
                    $('.pagination-left-number').text(res.current_page)
                    $('.pagination-right-number').text(res.last_page)
                    injectClass('searchNotification')
                    $(".pagination-part .left-arrow").attr('data-href', res.prev_page_url)
                    $(".pagination-part .right-arrow").attr('data-href', res.next_page_url)
                    domLoad(res.data)
                }
            });
        }
        function getUnique(array){
            var uniqueArray = [];

            // Loop through array values
            for(let i=0; i < array.length; i++){
                if(uniqueArray.indexOf(array[i]) === -1) {
                    uniqueArray.push(array[i]);
                }
            }
            return uniqueArray;
        }

    </script>
@endpush
