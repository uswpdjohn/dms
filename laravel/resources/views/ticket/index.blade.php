@extends('layouts.master')
@section('content')
    <!-- Main Body Start -->
{{--    @dd($tickets->perPage())--}}
        <div class="row main-body g-0">
        <div class="top-part">
            <button type="button" onclick="location.href='{{route('dashboard')}}';" class="btn back-btn"><i class="fa-solid fa-arrow-left"></i></button>
            <h5 class="top-header">Tickets</h5>
        </div>
        <div class="card customer-ticket-card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="customer-ticket-table">
                    <thead>
                    <tr>
                        <th class="ticket-no-header">Ticket No.</th>
                        <th class="message-header">Message</th>
                        <th class="service-header">Services</th>
                        <th class="file-header">File</th>
                        <th class="status-header">Status</th>
                        <th class="action-header">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <!-- Main row start -->
                    @foreach($tickets as $ticket)
                        <tr>
                            <td class="ticket-no-data">#{{$ticket->ticket_no}}</td>
                            <td class="message-data">{{$ticket->message}}</td>
                            <td class="service-data">{{$ticket->categories->name}}</td>
                            @if($ticket->file != null)
                                <td class="file-data"><a href="{{route('ticket.download', $ticket->id)}}">{{$ticket->file}}</a></td>
                            @else
                                <td class="file-data">N/A</td>
                            @endif

                            <td class="status-data"><span name="ticket-status" class="ticket-status">{{ucfirst($ticket->status)}}</span></td>
                            <td class="action-data">
                                <a href="{{route('ticket.show',$ticket->slug)}}" class="view-tickets-btn" type="button" data-bs-toggle="modal" data-bs-target="#viewCustomerTicketModal-{{$ticket->slug}}">View</a>
                                <div class="modal fade" id="viewCustomerTicketModal-{{$ticket->slug}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="viewCustomerTicketModalLabel" aria-hidden="true">
                                    <div class="modal-dialog viewCustomerTicket-modal">
                                        <div class="modal-content">
                                            <div class="viewCustomerTicket-modal-body">
                                                <div class="viewCustomerTicket-modal-header row">
                                                    <p class="modal-title col-4 col-md-3" id="viewCustomerTicketModalLabel">Ticket No:</p>
                                                    <p class="modal-data col-6 col-md-8">#{{$ticket->ticket_no}}</p>
                                                    <button type="button col-2" class="btn-close btn-sm viewCustomerTicket-modal-close-btn" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="viewCustomerTicket-modal-data">
                                                    <div class="data-body row">
                                                        <p class="modal-title col-4 col-md-3">Services: </p>
                                                        <p class="modal-data col-8 col-md-9">{{$ticket->categories->name}}</p>
                                                    </div>
                                                    <div class="data-body row">
                                                        <p class="modal-title col-4 col-md-3">File:</p>
                                                        @if($ticket->file != null)
                                                            <p class="modal-data modal-file-data col-8 col-md-9"><a href="{{route('ticket.download',$ticket->id)}}">{{$ticket->file}}</a></p>
                                                        @else
                                                            <p class="modal-data modal-file-data col-8 col-md-9">N/A</p>
                                                        @endif

                                                    </div>
                                                    <div class="data-body row">
                                                        <p class="modal-title col-4 col-md-3">Status:</p>
                                                        <p class="modal-data ticket-status col-3 col-md-2 col-lg-2 text-center p-0" name="ticket-status">{{ucfirst($ticket->status)}}</p>
                                                    </div>
                                                    <div class="data-body row">
                                                        <p class="modal-title col-4 col-md-3">Message:</p>
                                                        <p class="modal-data col-8 col-md-9">
                                                            {{ucfirst($ticket->message)}}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    <!-- Main row end -->
                    </tbody>
                </table>
                </div>
                @if($tickets->hasPages())
                <div class="select-pagination-portion end-select-pagination-portion table-bottom-portion row g-0">
                    <div class="pagination-part bottom-pagination-part col-12 col-md-12 col-lg-12">
                        @if($tickets->currentPage() > 1)
                        <a href="{{$tickets->previousPageUrl()}}" class="btn"><i class="fa-solid fa-chevron-left"></i></a>
                        @endif
                        <span class="pagination-number pagination-left-number">{{$tickets->currentPage()}}</span>
                        <span class="pagination-divider">/</span>
                        <span class="pagination-number pagination-right-number">{{$tickets->lastPage()}}</span>
                        @if($tickets->currentPage()!= $tickets->lastPage())
                        <a href="{{$tickets->nextPageUrl()}}" class="btn"><i class="fa-solid fa-chevron-right"></i></a>
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
        $(document).ready(function() {
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

        });
    </script>
@endpush
