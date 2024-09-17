@extends('layouts.master')
@section('content')
    <!-- Main Body Start -->
    <div class="row main-body g-0">
        <div class="card admin-support-ticket-card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="admin-support-ticket-table">
                    <thead>
                    <tr>
                        <th class="ticket-no-header">Ticket No.</th>
                        <th class="message-header">Message</th>
                        <th class="category-header">Category</th>
                        <th class="file-header">File</th>
                        <th class="status-header">Status</th>
                        @if(auth()->guard('web')->user()->can('edit.support_ticket'))
                        <th class="action-header">Action</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody id="ticket-table">
                    <!-- Main row start -->
                        @foreach($tickets as $ticket)
                            <tr>
                                <td class="ticket-no-data">#{{$ticket->ticket_no}}</td>
                                <td class="message-data">{{$ticket->message}}</td>
                                <td class="category-data">{{$ticket->categories->name}}</td>
                                <td class="file-data"><a href="{{route('ticket.download', $ticket->id)}}">{{$ticket->file}}</a></td>
                                <td class="status-data"><span name="ticket-status" class="ticket-status">{{ucfirst($ticket->status)}}</span></td>
{{--                                @if(auth()->guard('web')->user()->can('edit.support_ticket'))--}}
                                @if(auth()->user()->hasRole('Company Owner') || auth()->user()->hasRole('Admin'))
                                <td class="action-data">
                                        <a href="{{route('ticket.edit', $ticket->slug)}}" class="manage-ticket-btn" type="button" >Manage</a>
                                </td>
                                @endif
                            </tr>
                        @endforeach
                    <!-- Main row end -->

                    </tbody>
                </table>
                </div>
                @if($tickets->hasPages())
                    <div class="select-pagination-portion end-select-pagination-portion table-bottom-portion row g-0">
                        <input type="text" id="last_page" value="{{$tickets->hasPages()}}" hidden="hidden">
                        <div class="pagination-part bottom-pagination-part col-12 col-md-12 col-lg-12">
                            @if($tickets->currentPage() > 1)
                                <a href="{{$tickets->previousPageUrl()}}" class="btn left-arrow"><i class="fa-solid fa-chevron-left"></i></a>
                            @endif
                            <span class="pagination-number pagination-left-number ">{{$tickets->currentPage()}}</span>
                            <span class="pagination-divider">/</span>
                            <span class="pagination-number pagination-right-number">{{$tickets->lastPage()}}</span>
                            @if($tickets->currentPage()!= $tickets->lastPage())
                                <a href="{{$tickets->nextPageUrl()}}" class="btn right-arrow"><i class="fa-solid fa-chevron-right"></i></a>
                            @endif
                        </div>
                    </div>
                @endif
            </div>

        </div>
    </div>
    <!-- Main Body End -->
@endsection
@push('customScripts')
    <script>
        let url= "support-ticket?page="
        $('.pagination-part .left-arrow').on('click', function (){
            if ($(this).attr('data-href') != ''){
                var page = $(this).attr('data-href').split('page=')[1];


                // if($('.pagination-part .left-arrow').hasClass('getMailByCategory') == true){
                //     let category=$(this).attr('data-href').split('?')[0].split('/')[5]
                //     url="mail/get-mail-by-category/"+category+"?page="
                // }
                // if($('.pagination-part .left-arrow').hasClass('getMailByPriority') == true){
                //     let priority=$(this).attr('data-href').split('?')[0].split('/')[5]
                //     url="mail/get-mail-by-priority/"+priority+"?page="
                // }
                // if($('.pagination-part .left-arrow').hasClass('searchMail') == true){
                //     let search=$(this).attr('data-href').split('?')[0].split('/')[5]
                //     url="mail/search-mail/"+search+"?page="
                // }
                fetch_data(page);
            }
        })
        $('.pagination-part .right-arrow').on('click', function (){

            if ($(this).attr('data-href') != ''){
                var page = $(this).attr('data-href').split('page=')[1];

                // if($('.pagination-part .right-arrow').hasClass('getMailByCategory') == true){
                //     let category=$(this).attr('data-href').split('?')[0].split('/')[5]
                //     url="mail/get-mail-by-category/"+category+"?page="
                //     console.log(url)
                //
                // }
                // if($('.pagination-part .right-arrow').hasClass('getMailByPriority') == true){
                //     let priority=$(this).attr('data-href').split('?')[0].split('/')[5]
                //     url="mail/get-mail-by-priority/"+priority+"?page="
                // }
                // if($('.pagination-part .right-arrow').hasClass('searchMail') == true){
                //     let search=$(this).attr('data-href').split('?')[0].split('/')[5]
                //     url="mail/search-mail/"+search+"?page="
                // }
                fetch_data(page);
            }

        })

        function fetch_data(page) {
            let wrapper = "#mail-body"
            $.ajax({
                url: url + page,
                success: function(res) {
                    determinePaginationArrow(res)

                    $('.pagination-left-number').text(res.current_page)
                    $('.pagination-right-number').text(res.last_page)
                    $(".pagination-part .left-arrow").attr('data-href', res.prev_page_url)
                    $(".pagination-part .right-arrow").attr('data-href', res.next_page_url)
                    domLoad(res)
                    ticketStatus()
                },
                error: function (request) {
                    alert(request.responseText);
                }
            });
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

        function domLoad(item){
            let wrapper="#ticket-table"
            let ticketTable=''


            $.map(item.data, function(value,i){

                let fileDownloadUrl="{{route('ticket.download', ':id')}}"
                fileDownloadUrl= fileDownloadUrl.replace(':id', value.id)

                let manageUrl="{{route('ticket.edit', ':slug')}}"
                manageUrl= manageUrl.replace(':slug', value.slug)

                    ticketTable += `<tr>
                                        <td class="ticket-no-data">#${value.ticket_no}</td>
                                        <td class="message-data">${value.message}</td>
                                        <td class="category-data">${value.categories.name}</td>`+
                                            (value.file !=null ? `<td class="file-data"><a href="${fileDownloadUrl}">${value.file}</a></td>` : `<td class="file-data"></td> `)+

                                        `<td class="status-data"><span name="ticket-status" class="ticket-status">${value.status[0].toUpperCase() + value.status.slice(1)}</span></td>
                                        <td class="action-data">
                                            <a href="${manageUrl}" class="manage-ticket-btn" type="button" >Manage</a>
                                        </td>
                                    </tr>`
            })


            $(wrapper).empty().append(ticketTable)


        }


        $(document).ready(function() {
            let page=$('#last_page').val()
            if (page != ""){
                $('.pagination-part .right-arrow').removeClass('d-none')
            }else {
                $('.pagination-part .right-arrow').addClass('d-none')
                // $('.pagination-part').addClass('d-none')
            }
            ticketStatus()


        });

        function ticketStatus() {
            var ticketStatus = document.getElementsByName("ticket-status");
            var countTickets = ticketStatus.length;
            for (var i = 0; i < countTickets; i++)
                if(ticketStatus[i].innerHTML == "Open"){
                    ticketStatus[i].style.color = "#52C41A";
                    ticketStatus[i].style.border = "1px solid #52C41A";
                    ticketStatus[i].style.backgroundColor = "#F4FFE3";
                }else{
                    ticketStatus[i].style.color = "#EB2F96";
                    ticketStatus[i].style.border = "1px solid #FFADD2";
                    ticketStatus[i].style.backgroundColor = "#FFF0F6";
                }

            var fileData = document.getElementsByClassName("file-data");
            var countData = fileData.length;
            for(var i = 0; i < countData; i++){
                if(fileData[i].innerHTML == ""){
                    fileData[i].innerHTML = "-";
                    fileData[i].style.textDecoration = "none";
                }
            }
        }
    </script>
@endpush
