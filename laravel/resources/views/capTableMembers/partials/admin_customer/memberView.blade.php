<div class="modal fade " id="memberViewModal-{{$item->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="memberViewModalLabel" aria-hidden="true">
    <div class="modal-dialog member-view-modal">
        <div class="modal-content">
            <div class="member-view-modal-body">
                <div class="member-view-modal-header row">
                    <h6 class="modal-title col-11" id="memberViewModalLabel">{{$item->name}}</h6>
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

                                    </div>
                                    @if(count($item->capTableActivity) > 0)
                                        @foreach($item->capTableActivity as $capTableActivity)
                                            <div class="member-body row g-0">
                                        <div class="col-2 col-md-2 col-lg-2 entry-data">
                                            <span>{{$capTableActivity->transaction_date}}</span>
                                        </div>
                                        <div class="col-2 col-md-2 col-lg-2 entry-data">
                                            <p>{{$capTableActivity->funding_round}}</p>
                                        </div>
                                        <div class="col-2 col-md-2 col-lg-2 entry-data">
                                            <p>{{$capTableActivity->share_type}}</p>
                                        </div>
                                        <div class="col-3 col-md-3 col-lg-3 entry-data">
                                            <p>{{$capTableActivity->share_number}}</p>
                                        </div>
                                        <div class="col-3 col-md-3 col-lg-3 entry-data">
                                            <p>${{number_format($capTableActivity->amount, '2', '.', ',')}}</p>
                                        </div>

                                    </div>
                                        @endforeach
                                    @else
                                        <div class="member-body row g-0">
                                            <div class="text-center col-12 entry-data">
                                                <span>No Data Available</span>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="member-body row g-0 footer-row">
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
                                            <p>{{$item->capTableActivity->sum('share_number')}}</p>
                                        </div>
                                        <div class="col-3 col-md-3 col-lg-3 footer-div">
                                            <p>${{number_format($item->capTableActivity->sum('amount'), '2', '.', ',')}}</p>
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
