@extends('layouts.master')
@section('content')
    <!-- Main Body Start -->
    <div class="row main-body g-0">
        <div class="admin-support-tickit-manage-top-portion row g-0">
            <div class="card">
                <div class="card-body row">
                    <div class="col-4 col-md-2 col-lg-1">
                        @if($ticket->companies->image != null )
                            <img class="b-info-img" src="{{url('/assets/images/'.$ticket->companies->image)}}" alt="">
                        @else
                            <img class="b-info-img" src="{{asset('assets/images/company.jpg')}}" alt="">
                        @endif
                    </div>
                    <div class="col-8 col-md-10 col-lg-11 ps-0 my-auto">
                        <h5 class="company-name">{{$ticket->companies->name}}</h5>
                    </div>
                </div>
            </div>
            <div class="card info-card">
                <div class="card-body">
                    <div class="row">
                        <p class="col-3 col-md-2 col-lg-1">Category: </p>
                        <p class="col-9 col-md-10 col-lg-11">{{$ticket->categories->name}}</p>
                    </div>
                    <div class="row">
                        <p class="col-3 col-md-2 col-lg-1">File:</p>
                        <p class="col-9 col-md-10 col-lg-11 file-name"><a href="{{route('ticket.download', $ticket->id)}}">{{$ticket->file}}</a></p>
                    </div>
                    <div class="row">
                        <p class="col-3 col-md-2 col-lg-1">Status:</p>
                        <p class="col-9 col-md-10 col-lg-11"><span class="ticket-status"  name="ticket-status">{{ucfirst($ticket->status)}}</span></p>
                    </div>
                    <div class="row">
                        <p class="col-3 col-md-2 col-lg-1">Message:</p>
                        <p class="col-9 col-md-10 col-lg-11">
                            {{$ticket->message}}
                            <input type="hidden" id="status" value="{{$ticket->status}}">
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="admin-support-tickit-manage-bottom-portion row g-0">
            <div class="card">
                <form action="" method="POST" id="updateForm">
                    @method('PUT')
                    @csrf
                    <div class="card-body">
                        <div class="row desc-body input-group">
                            <textarea style="border: none" class="" id="admin_reply"  name="admin_reply" >{{$ticket->admin_reply ?? ''}}</textarea>

                        </div>
                        <span class="text-danger">@error('admin_reply'){{ $message }}@enderror</span>

                        <div class="row button-portion">
                            <div class="">
                                <button type="submit" onclick="reopen(this,{{$ticket->id}})" class="btn reopen-btn">Reopen</button>
                                <button type="submit" onclick="ticketClose({{$ticket->id}})" class="btn close-btn">Close</button>
                            </div>
                        </div>
                    </div>
                </form>
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

            if($('#status').val() == 'closed'){
                $('#admin_reply').attr('readonly','readonly')
            }else {
                $('#admin_reply').removeAttr('readonly')
            }
        });

        function reopen(el,id){

            let action = "{{route('support.ticket.reopen',':id')}}"

            action=action.replace(':id', id)
            $("#updateForm").attr('action', action)

        }
        function ticketClose(id){
            let action = "{{route('ticket.update',':id')}}"

            action=action.replace(':id', id)
            console.log(action)
            $("#updateForm").attr('action', action)

        }
    </script>

@endpush
