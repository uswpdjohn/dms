@extends('layouts.master')
@section('content')
    <div class="row main-body g-0">
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
        <div class="card customer-mailbox-card">
            <div class="card-body">
                <div class="select-pagination-portion table-top-portion row g-0">
                    <div class="select-part col-6 col-md-3 col-lg-2">
                        <input type="checkbox" class="select-all-checkbox" name="select_all">
                        <label for="" class="selected-checkbox-number">Select All</label>
                    </div>
                    <div class="sb-part search-box-part col-6 col-md-4 offset-lg-1 col-lg-5">
{{--                        <form action="{{route('mail.index')}}" method="GET" class="d-flex">--}}
                            <div class="d-flex form-inputs search-data">
                                <input class="form-control up-search" type="text" name="search" placeholder="Search">
                                <button type="button" onclick="searchMail()" class="search-btn btn"><i class="fa-solid fa-search"></i></button>
                            </div>
{{--                        </form>--}}
                    </div>
                    <div class="sb-part priority-category-select offset-4 col-6 offset-md-0 col-md-2 col-lg-2">
                        <select class="form-control form-select nav-select select-data" onchange="filterByPriority()" name="priority" id="priority">
{{--                            <option disabled class="first-option" value="">Select Priority</option>--}}
                            <option value="all">All</option>
                            <option value="urgent">Urgent</option>
                            <option value="new">New</option>
                        </select>
                    </div>
                    <div class="sb-part col-6 col-md-3 category-select col-lg-2">
                        <select class="form-control form-select nav-select select-data" onchange="filterByCategory()" name="category" id="category">
{{--                            <option disabled class="first-option" value="">Select Category</option>--}}
                            <option value="all">All</option>
                            <option value="mailbox">Mailbox</option>
                            <option value="corporate_secretary">Corporate Secretary</option>
                            <option value="tax">Tax</option>
                            <option value="accounting">Accounting</option>
                            <option value="human_resource">Human Resource</option>
                        </select>
                    </div>
                    <div class="button-part col-12 col-md-9 col-lg-10">
                        <button type="button" id="downloadAttachmentCloneBtn" class="btn download-btn action-buttons active">Download</button>
                        <button type="button" id="markAsDownloadedCloneBtn" class="btn mark-as-download-btn action-buttons">Mark as Downloaded</button>
                        <button type="button" id="deleteMarkedCloneBtn" data-bs-toggle="modal" data-bs-target="#mailDeleteModal"  class="btn delete-btn action-buttons">Delete</button>

                        <div class="modal fade" id="mailDeleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="mailDeleteModalLabel" aria-hidden="true">
                            <div class="modal-dialog mail-delete-modal">
                                <div class="modal-content">
                                    <div class="mail-delete-modal-body">
                                        <p class="text-center">Confirm Delete</p>
                                        <div class="text-center">
                                            <button type="button" class="btn btn-sm mail-delete-modal-close-btn"  data-bs-dismiss="modal" aria-label="No">No</button>
                                            <button type="button" onclick="deleteMarkedMail()" class="btn btn-sm yes-btn">Yes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="pagination-part col-4 col-md-4 col-lg-2">
                        <a href="#" class="btn"><i class="fa-solid fa-chevron-left"></i></a>
                        <span class="pagination-number pagination-left-number">5</span>
                        <span class="pagination-divider">/</span>
                        <span class="pagination-number pagination-right-number">10</span>
                        <a href="#" class="btn"><i class="fa-solid fa-chevron-right"></i></a>
                    </div> -->
                </div>
                <form action="" method="GET" id="form-1">
                    <div class="table-responsive">
                        <div class="mailbox-body" id="mail-body">
                            @if(count($mails) > 0)
                                @foreach($mails as $mail)
                                    {{--style based on downloaded or not--}}
                                    <div class="mails row g-0">
                                        <div class="col-3 col-md-2 checkbox-div">
                                            <input type="checkbox" class="select-checkbox" name="mail-id[]" value="{{$mail->id}}">
                                            @if($mail->priority == 'urgent')
                                                <img src="{{asset('assets/icons/mailbody-!.png')}}" alt="">
                                            @else
                                                <img src="{{asset('assets/icons/mailbody-!-white.png')}}" alt="">
                                            @endif
                                            <span class="fw-semibold">{{$mail->from}}</span>
                                        </div>

                                        <div class="col-5 col-md-7 col-lg-7 message-div">
                                            @if($mail->read_at != null)
                                                <p class="">{{$mail->title}}</p>
                                            @else
                                                <p class="text-dark fw-bold" style="">{{$mail->title}}</p>
                                            @endif
                                        </div>

                                        <div class="col-4 col-md-3 col-lg-3 time-div">
                                            @if($mail->read_at != null)
                                                <span class="">{{ \Carbon\Carbon::parse($mail->created_at)->format('d M y')}}</span>
                                            @else
                                                <span class="text-dark fw-bold">{{ \Carbon\Carbon::parse($mail->created_at)->format('d M y')}}</span>
                                            @endif
                                            @if($mail->file != null)
                                                <button type="submit" onclick="downloadIndividual(this,{{$mail->id}})" class="btn download-btn {{$mail->downloaded_at != null ? '' : 'active'}}">{{$mail->downloaded_at != null ? 'Downloaded' : 'Download'}}</button>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="mails row g-0">
                                    <div class="col-12 col-md-12 col-lg-12 message-div text-center"><span>No Data Available</span></div>
                                </div>

                            @endif
                </div>
                    </div>

                <div class="select-pagination-portion table-bottom-portion row g-0">
{{--                    <div class="select-part col-6 col-md-3 col-lg-2">--}}
{{--                        <input type="checkbox" class="select-all-checkbox" name="select_all">--}}
{{--                        <label for="" class="selected-checkbox-number">Select All</label>--}}
{{--                    </div>--}}
{{--                    <div class="search-box-part sb-part col-6 col-md-4 offset-lg-1 col-lg-5">--}}
{{--                        <div class="d-flex form-inputs">--}}
{{--                            <input class="form-control down-search"  name="search" type="text" placeholder="Search">--}}
{{--                            <button type="button" onclick="searchMail()" class="search-btn btn"><i class="fa-solid fa-search"></i></button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <div class="button-part col-12 col-md-9 col-lg-10">
                        <button hidden="hidden" type="submit" onclick="downloadAttachment()" id="downloadAttachmentBtn" class="btn download-btn action-buttons active">Download</button>
                        <button hidden="hidden" type="button" onclick="markAsDownloaded()" id="markAsDownloadedBtn" class="btn mark-as-download-btn action-buttons">Mark as Downloaded</button>
{{--                        <button type="button" onclick="deleteMarkedMail()" id="deleteMarkedBtn"  class="btn delete-btn action-buttons">Delete</button>--}}
{{--                        <button hidden="hidden" type="button" id="deleteMarkedBtn" data-bs-toggle="modal" data-bs-target="#mailDeleteModal" class="btn delete-btn action-buttons">Delete</button>--}}
                        <button hidden="hidden" type="submit" id="deleteMarkedBtn" class="btn delete-btn action-buttons">Delete</button>
                    </div>

{{--                    @if($mails->hasPages())--}}
                        <input type="text" id="last_page" value="{{$mails->hasPages()}}" hidden="hidden">
                        <div class="pagination-part bottom-pagination-part col-12 col-md-5 col-lg-4">
                            <a data-href="{{$mails->previousPageUrl()}}" class="btn left-arrow d-none"><i class="fa-solid fa-chevron-left"></i></a>
                            <span class="pagination-number pagination-left-number ">{{$mails->currentPage()}}</span>
                            <span class="pagination-divider">/</span>
                            <span class="pagination-number pagination-right-number">{{$mails->lastPage()}}</span>
                            <a data-href="{{$mails->nextPageUrl()}}" class="btn right-arrow"><i class="fa-solid fa-chevron-right"></i></a>
                        </div>
{{--                    @endif--}}
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Main Body End -->
@endsection
@push('customScripts')

    <script>
        function removeClassFromPaginationArrow(className){
            if ( $(".pagination-part .right-arrow").hasClass(className)){
                $(".pagination-part .right-arrow").removeClass(className)
            }
            if (  $(".pagination-part .left-arrow").hasClass(className)){
                $(".pagination-part .left-arrow").removeClass(className)
            }
        }
    </script>
    <script>
        let url= "mail?page="
        $('.pagination-part .left-arrow').on('click', function (){
            if ($(this).attr('data-href') != ''){
                var page = $(this).attr('data-href').split('page=')[1];

                if($('.pagination-part .left-arrow').hasClass('getMailByCategory') == true){
                    let category=$(this).attr('data-href').split('?')[0].split('/')[5]
                    url="mail/get-mail-by-category/"+category+"?page="
                }
                if($('.pagination-part .left-arrow').hasClass('getMailByPriority') == true){
                    let priority=$(this).attr('data-href').split('?')[0].split('/')[5]
                    url="mail/get-mail-by-priority/"+priority+"?page="
                }
                if($('.pagination-part .left-arrow').hasClass('searchMail') == true){
                    let search=$(this).attr('data-href').split('?')[0].split('/')[5]
                    url="mail/customer-search-mail/"+search+"?page="
                }
                fetch_data(page);
            }
        })
        $('.pagination-part .right-arrow').on('click', function (){

            if ($(this).attr('data-href') != ''){
                var page = $(this).attr('data-href').split('page=')[1];

                if($('.pagination-part .right-arrow').hasClass('getMailByCategory') == true){
                    let category=$(this).attr('data-href').split('?')[0].split('/')[5]
                    url="mail/get-mail-by-category/"+category+"?page="
                    console.log(url)

                }
                if($('.pagination-part .right-arrow').hasClass('getMailByPriority') == true){
                    let priority=$(this).attr('data-href').split('?')[0].split('/')[5]
                    url="mail/get-mail-by-priority/"+priority+"?page="
                }
                if($('.pagination-part .right-arrow').hasClass('searchMail') == true){
                    let search=$(this).attr('data-href').split('?')[0].split('/')[5]
                    url="mail/customer-search-mail/"+search+"?page="
                }
                fetch_data(page);
            }

        })

        function fetch_data(page) {
            let search = '0'
            // if($('.up-search').val().length == 0 && $('.up-search').val().length === 0){
            //     search = '0'
            // }
            let category=$('#category').find(":selected").val()
            let priority =$('#priority').find(":selected").val()

            console.log(url + page)
            let wrapper = "#mail-body"
            $.ajax({
                url: url + page,
                data: {search:search,category: category, priority:priority},
                success: function(res) {
                    console.log(res)
                    determinePaginationArrow(res)

                    $('.pagination-left-number').text(res.current_page)
                    $('.pagination-right-number').text(res.last_page)
                    $(".pagination-part .left-arrow").attr('data-href', res.prev_page_url)
                    $(".pagination-part .right-arrow").attr('data-href', res.next_page_url)
                    if (res.data.length > 0 ) {
                        $(wrapper).html(res.data.map((item) =>
                            domLoad(item)
                        ))
                    }else {
                        $(wrapper).empty().append(`<div class="mails row g-0">
                                    <div class="col-12 col-md-12 col-lg-12 message-div text-center"><span>No Data Available</span></div>
                                </div>`)
                    }
                },
                error: function (request) {
                    alert(request.responseText);
                }
            });
        }
        $('.up-search').on('keyup',function () {
            let wrapper = "#mail-body"
            if (this.value.length == 0){
                loadIndex(wrapper)
            }
        })
        $('.down-search').on('keyup',function () {
            let wrapper = "#mail-body"
            if (this.value.length == 0){
                loadIndex(wrapper)
            }
        })
        function loadIndex(wrapper) {
            removeClassFromPaginationArrow('searchMail')
            removeClassFromPaginationArrow('getMailByPriority')
            removeClassFromPaginationArrow('getMailByCategory')
            let url = "{{ route('mail.index')}}"
            let category=$('#category').find(":selected").val()
            let priority =$('#priority').find(":selected").val()
            $.ajax({
                url: url,
                data: {search:0,category:category,priority:priority },
                success: function(res) {
                    console.log(res)
                    determinePaginationArrow(res)
                    //
                    $('.pagination-left-number').text(res.current_page)
                    $('.pagination-right-number').text(res.last_page)
                    $(".pagination-part .left-arrow").attr('data-href', res.prev_page_url)
                    $(".pagination-part .right-arrow").attr('data-href', res.next_page_url)
                    if (res.data.length > 0){
                        $(wrapper).html(res.data.map((item) =>
                            domLoad(item)
                        ))
                    }else {
                        $(wrapper).empty().append(`<div class="mails row g-0">
                                    <div class="col-12 col-md-12 col-lg-12 message-div text-center"><span>No Data Available</span></div>
                                </div>`)

                    }
                }
            });

        }
        function searchMail(){
            removeClassFromPaginationArrow('getMailByPriority')
            removeClassFromPaginationArrow('getMailByCategory')
            let value=""
            let wrapper = "#mail-body"
            $("input[name='search']").each(function() {
                if (this.value != ''){
                    value=this.value;
                }
            });
            let category=$('#category').find(":selected").val()
            let priority =$('#priority').find(":selected").val()


            {{--let url = "{{ route('mail.search', ':search') }}"--}}
            let url = "{{ route('customer.mail.search', ':search') }}"
            url=url.replace(':search', value)
            $.ajax({
                url: url,
                data: {category: category, priority:priority},
                success: function(res) {
                    determinePaginationArrow(res)
                    //
                    $('.pagination-left-number').text(res.current_page)
                    $('.pagination-right-number').text(res.last_page)
                    injectClass('searchMail')
                    $(".pagination-part .left-arrow").attr('data-href', res.prev_page_url)
                    $(".pagination-part .right-arrow").attr('data-href', res.next_page_url)
                    if (res.data.length > 0 ){
                        $(wrapper).html(res.data.map((item) =>
                            domLoad(item)
                        ))
                    }else {
                        $(wrapper).empty().append(`<div class="mails row g-0">
                                    <div class="col-12 col-md-12 col-lg-12 message-div text-center"><span>No Data Available</span></div>
                                </div>`)
                    }

                }
            });

        }
        function filterByPriority() {
            removeClassFromPaginationArrow('searchMail')
            removeClassFromPaginationArrow('getMailByCategory')

            let priority= $('#priority').find(":selected").val()
            let category= $('#category').find(":selected").val()
            let url = "{{ route('mail.priority', ':priority') }}"
            url=url.replace(':priority', priority)
            $.ajax({
                url: url,
                data: {category: category},
                success: function(res) {
                    determinePaginationArrow(res)
                    //
                    $('.pagination-left-number').text(res.current_page)
                    $('.pagination-right-number').text(res.last_page)
                    injectClass('getMailByPriority')
                    $(".pagination-part .left-arrow").attr('data-href', res.prev_page_url)
                    $(".pagination-part .right-arrow").attr('data-href', res.next_page_url)
                    if(res.data.length > 0){
                        $('#mail-body').html(res.data.map((item) =>
                            domLoad(item)
                        ).join(' '))
                    }else {
                        $('#mail-body').empty().append(`<div class="mails row g-0">
                                    <div class="col-12 col-md-12 col-lg-12 message-div text-center"><span>No Data Available</span></div>
                                </div>`)
                    }
                }
            });
        }
    </script>
    <script>
        function filterByCategory() {
            removeClassFromPaginationArrow('searchMail')
            removeClassFromPaginationArrow('getMailByPriority')

            let category= $('#category').find(":selected").val()
            let priority =$('#priority').find(":selected").val()
            let url = "{{ route('mail.category', ':category') }}"
            url=url.replace(':category', category)

            $.ajax({
                url: url,
                data: {priority: priority},
                success: function(res) {
                    determinePaginationArrow(res)
                    //
                    $('.pagination-left-number').text(res.current_page)
                    $('.pagination-right-number').text(res.last_page)
                    injectClass('getMailByCategory')
                    $(".pagination-part .left-arrow").attr('data-href', res.prev_page_url)
                    $(".pagination-part .right-arrow").attr('data-href', res.next_page_url)
                    if(res.data.length > 0){
                        $('#mail-body').html(res.data.map((item) =>
                            domLoad(item)
                        ).join(' '))
                    }else {
                        $('#mail-body').empty().append(`<div class="mails row g-0">
                                    <div class="col-12 col-md-12 col-lg-12 message-div text-center"><span>No Data Available</span></div>
                                </div>`)
                    }
                }
            });






            // fetch(`mail/get-mail-by-category/${category}`)
            //     .then(response => response.json())
            //     .then(response => {
            //         // console.log(response)
            //         determinePaginationArrow(response)
            //         //
            //         $('.pagination-left-number').text(response.current_page)
            //         $('.pagination-right-number').text(response.last_page)
            //         injectClass('getMailByCategory')
            //         $(".pagination-part .left-arrow").attr('data-href', response.prev_page_url)
            //         $(".pagination-part .right-arrow").attr('data-href', response.next_page_url)
            //         if(response.data.length > 0) {
            //             $('#mail-body').html(response.data.map((item) =>
            //                 domLoad(item)
            //             ).join(' '))
            //         }else {
            //             $('#mail-body').empty().append(`<div class="mails row g-0">
            //                         <div class="col-12 col-md-12 col-lg-12 message-div text-center"><span>No Data Available</span></div>
            //                     </div>`)
            //         }
            //     })
        }
    </script>

    <script>
        function domLoad(item) {
            let download_button_class="btn download-btn"
            if (item.downloaded_at != null){
                download_button_class= download_button_class + ''

            }else {
                download_button_class= download_button_class + ' active'
            }
            console.log(item)
            return `<div class="mails row g-0">
                <div class="col-3 col-md-2 checkbox-div">
                <input type="checkbox" class="select-checkbox" onchange="checkboxSelectAfterAppend(this)" name="mail-id[]" value="${item.id}">`+
                (item.priority == 'urgent' ? `<img src="{{asset('assets/icons/mailbody-!.png')}}" alt="" style="margin-right: 5px;">` : `<img src="{{asset('assets/icons/mailbody-!-white.png')}}" alt="" style="margin-right: 5px;">`)+
                `<span>${item.from}</span>
                </div>
                <div class="col-5 col-md-7 col-lg-7 message-div">`+
                (item.read_at != null ? `<p class="">${item.title} </p>` : `<p class="text-dark fw-bold">${item.title} </p>`) +
                `</div>
                <div class="col-4 col-md-3 col-lg-3 time-div">`+(item.read_at != null ? `<span class="text-dark">${$.date(item.created_at)}</span>` : `<span class="text-dark fw-bold">${$.date(item.created_at)}</span>`)+
                    // <span class="text-dark">${$.date(item.created_at)}</span>`+
                // (item.file != null ? (item.downloaded_at != null ? `<button type="submit" onclick="downloadIndividual(${item.id})" class="btn download-btn">Downloaded</button>` : `<button type="submit" onclick="downloadIndividual(${item.id})" class="btn download-btn active">Download</button>` ) :'')+
                (item.file != null ? `<button type="submit" onclick="downloadIndividual(this,${item.id})" class="${download_button_class}">`+(item.downloaded_at != null ? "Downloaded" : "Download")+`</button>` : '')+
                `</div>
            </div>`
        }

        function injectClass(className){
            $(".pagination-part .right-arrow").addClass(className)
            $(".pagination-part .left-arrow").addClass(className)
        }
    </script>

    <script>
        $(document).on('click', '#markAsDownloadedCloneBtn', function(event) {
            event.preventDefault();
            $("#markAsDownloadedBtn").click()
        });
        // $(document).on('click', '#deleteMarkedCloneBtn', function(event) {
        //     event.preventDefault();
        //     $("#deleteMarkedBtn").click()
        // });
    </script>

    <script>
        let id=[];
        // click below download button when clicked upper download button
        $(document).on('click', '#downloadAttachmentCloneBtn', function(event) {
            event.preventDefault();
            $("#downloadAttachmentBtn").click()
        });

        //storing the selected ids in id array
        $(document).ready(function(){
            //pagination
            let page=$('#last_page').val()
            if (page != ""){
                $('.pagination-part .right-arrow').removeClass('d-none')
            }else {
                $('.pagination-part .right-arrow').addClass('d-none')
                // $('.pagination-part').addClass('d-none')
            }

            $("input[type='checkbox']").change(function (e) {
                let idValue=$(this).attr("value")
                if ($(this).is(':checked')) {
                    id.push(idValue); //pushing checked id in array
                } else {
                    let index = id.indexOf(e.target.value)
                    id.splice(index, 1)
                }
                id=id.filter(e => e)
                console.log(id)
            })


            var $checkboxes = $('.mailbox-body .mails  input[type="checkbox"]');

            $('.button-part').hide();
            function checkbox(){
                console.log('check')
                var countCheckedCheckboxes = $checkboxes.filter(':checked').length;
                if(countCheckedCheckboxes > 0){
                    $('.selected-checkbox-number').text(countCheckedCheckboxes + " selected");
                    $('.sb-part').hide();
                    $('.button-part').show();
                    $('.bottom-pagination-part').hide();
                    // $('bottom-pagination-part').removeClass('col-4 col-md-5 col-lg-5');
                    // $('bottom-pagination-part').addClass('col-12 col-lg-5');
                }
                else{
                    $('.selected-checkbox-number').text("Select All");
                    $('.sb-part').show();
                    $('.button-part').hide();
                    $('.bottom-pagination-part').show();
                    // $('bottom-pagination-part').addClass('col-4 col-md-5 col-lg-5');
                    // $('bottom-pagination-part').removeClass('col-12 col-lg-5');
                }
            }
            $checkboxes.change(function(e){
                // console.log(e.target.parentElement.parentElement.classList.toggle("selected"))
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
                    id=id.filter(e => e) //removing undefined value from array
                });
                checkbox();

                var checkboxes2 = $('.mailbox-body .mails input[type="checkbox"]');
                var countCheckedCheckboxes = checkboxes2.filter(':checked').length;
                if(countCheckedCheckboxes > 0){
                    $('.selected-checkbox-number').text(countCheckedCheckboxes + " selected");
                    $('.sb-part').hide();
                    $('.button-part').show();
                    $('.bottom-pagination-part').hide();
                }
                else{
                    $('.selected-checkbox-number').text("Select All");
                    $('.sb-part').show();
                    $('.button-part').hide();
                    $('.bottom-pagination-part').show();
                }
                // checkboxSelectAfterAppend();

            });

            $('.action-buttons').click(function(e){
                const mailboxTopBtns = document.querySelectorAll(".action-buttons");
                mailboxTopBtns.forEach((btn) => {
                    mailboxTopBtns.forEach(f => f.classList.remove('active'));
                    e.target.classList.toggle("active");
                });
            });
        });

        //revoked
        $('.mailbox-top-btn').click(function(e){
            const mailboxTopBtns = document.querySelectorAll(".mailbox-top-btn");
            mailboxTopBtns.forEach((btn) => {
                mailboxTopBtns.forEach(f => f.classList.remove('active'));
                e.target.classList.toggle("active");
            });
        });
        //
        $('.action-buttons').click(function(e){
            const mailboxTopBtns = document.querySelectorAll(".action-buttons");
            mailboxTopBtns.forEach((btn) => {
                mailboxTopBtns.forEach(f => f.classList.remove('active'));
                e.target.classList.toggle("active");
            });
        });

        function markAsDownloaded(){
            let URL="mail/mark-as-downloaded/"+id
            // console.log(id)
            $.ajax({
                type: "GET",
                url: URL,
                success: function (obj) {
                    window.addEventListener("DOMContentLoaded", hardRefresh());
                },
                error: function(xhr, status, error) {
                    alert(xhr.responseText);
                }
            })
        }

        function deleteMarkedMail(){
            let action = "{{route('mail.delete')}}"
            $("#form-1").attr('action', action)

            $('#deleteMarkedBtn').click()


            $('#mailDeleteModal').modal('hide')
            {{--let URL="mail/delete/"+id--}}
            {{--$.ajax({--}}
            {{--    type: "GET",--}}
            {{--    url: URL,--}}
            {{--    success: function (res) {--}}
            {{--        console.log(res)--}}
            {{--        $("html, body").animate({ scrollTop: 0 });--}}
            {{--        if (res.success == 1){--}}
            {{--            $('#flashMessages').html(--}}
            {{--                `<div class="alert alert-success">--}}
            {{--                <img class="alert-img" src="{{asset('assets/icons/success-alert-icon.png')}}" alt="">--}}
            {{--                <p class="alert-text">${res.message}</p></div>`--}}
            {{--            )--}}
            {{--            setTimeout(function(){--}}
            {{--                window.location.reload();--}}
            {{--            }, 2000);--}}
            {{--        }else if(res.abort == '403'){--}}
            {{--            $('#flashMessages').html(--}}
            {{--                `<div class="alert alert-success">--}}
            {{--                <img class="alert-img" src="{{asset('assets/icons/mailbody-!.png')}}" alt="">--}}
            {{--                <p class="alert-text">${res.message}</p></div>`--}}
            {{--            )--}}
            {{--        }--}}

            {{--        // window.addEventListener("DOMContentLoaded", hardRefresh());--}}
            {{--    },--}}

            {{--    error: function(xhr, status, error) {--}}
            {{--        alert(xhr.responseText);--}}
            {{--    }--}}
            {{--})--}}
        }
        function downloadAttachment(){
            let action = "{{route('mail.downloadAttachment')}}"
            $("#form-1").attr('action', action)

            $('input:checked').map(function(){
                let button = $(this).parent().siblings().find('button');
                console.log(button.hasClass('active'))
                if(button.hasClass('active')){
                    button.removeClass('active');
                    button.text("Downloaded");
                }
            });
        }
        function downloadIndividual(el,id){
            var url = "{{ route('mail.individual.download', ':id') }}";
            url = url.replace(':id', id);
            $("#form-1").attr('action', url)

            if (el.classList.contains('active') == true){
                el.classList.remove('active')
                el.innerHTML = 'Downloaded'
                // console.log()
            }
        }


        function hardRefresh() {
            const t = parseInt(Date.now() / 10000); //10s tics
            const x = localStorage.getItem("t");
            localStorage.setItem("t", t);

            if (x != t) location.reload(true) //force page refresh from server
            else { //refreshed from server within 10s
                const a = document.querySelectorAll("a, link, script, img")
                var n = a.length
                while(n--) {
                    var tag = a[n]
                    var url = new URL(tag.href || tag.src);
                    url.searchParams.set('r', t.toString());
                    tag.href = url.toString(); //a, link, ...
                    tag.src = tag.href; //rerun script, refresh img
                }
            }
        }
    </script>
    {{--select checkbox function for dynamically appended DOM--}}
    <script>
        function checkboxSelectAfterAppend(e){

            let idValue=e.value
            if ($("input[type='checkbox']").is(':checked')) {
                id.push(idValue); //pushing checked id in array
            } else {
                let index = id.indexOf(e.value)
                id.splice(index, 1)
            }
            id=id.filter(e => e)

            var checkboxes2 = $('.mailbox-body .mails input[type="checkbox"]');
            var countCheckedCheckboxes = checkboxes2.filter(':checked').length;
            if(countCheckedCheckboxes > 0){
                $('.selected-checkbox-number').text(countCheckedCheckboxes + " selected");
                $('.sb-part').hide();
                $('.button-part').show();
            }
            else{
                $('.selected-checkbox-number').text("Select All");
                $('.sb-part').show();
                $('.button-part').hide();
            }

        }
    </script>
    <script>
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
    </script>

    <script>
        function determinePaginationArrow(res){
            console.log(res.current_page)
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
    </script>
@endpush
