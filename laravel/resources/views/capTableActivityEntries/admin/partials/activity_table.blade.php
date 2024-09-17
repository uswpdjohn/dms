<div class="select-pagination-portion table-top-portion row g-0">
    <div class="sb-part search-box-part col-12 col-md-4 col-lg-5">
        <form action="" method="GET" id="search_form">
            @csrf
            <div class="d-flex form-inputs search-data">
                <input class="form-control" type="text" name="search" id="search"
                       value="{{request()->has('search') ? request()->get('search') : ''}}" placeholder=" Member">
                <button type="submit" onclick="searchActivity()" class="search-btn btn"><i
                        class="fa-solid fa-search"></i></button>
            </div>
        </form>
    </div>

    <div class="button-part col-12 col-md-8 col-lg-7">
        <button type="button" class="btn download-btn action-buttons active create-activity-entry-button"
                data-bs-toggle="modal" data-bs-target="#activityEntryCreateModal">Create
        </button>
    </div>
</div>
<div class="mb-2">Current Selection: <b class="capTable-current-company-selection"></b></div>
<div class="table-responsive" style="margin-top: 10px">
    <div class="cap-table-manage-body">
        <div class="table-rows row g-0 text-center">
            <div class="col-2 header-div">
                <span>Transaction Date</span>
            </div>
            <div class="col-1 header-div">
                <span>Funding Round</span>
            </div>
            <div class="col-2 header-div">
                <span>Shared Certificate Id</span>
            </div>
            <div class="col-2 header-div">
                <span>Member</span>
            </div>
            <div class="col-1 header-div">
                <span>Type of Share</span>
            </div>
            <div class="col-1 header-div">
                <span>Number of Shares</span>
            </div>
            <div class="col-2 header-div">
                <span>Amount</span>
            </div>
            <div class="col-1 header-div">
                <span>Action</span>
            </div>
        </div>
        @if(count($activity_entries) > 0)
            @foreach($activity_entries as $activity_entry)
                <div class="table-rows row g-0 text-center">
                    <div class="col-2 data-div">
                        <span>{{\Carbon\Carbon::parse($activity_entry->transaction_date)->format('d M Y')}}</span>
                    </div>
                    <div class="col-1 data-div">
                        <span>{{ucfirst($activity_entry->funding_round)}}</span>
                    </div>
                    <div class="col-2 data-div">
                        <span>{{$activity_entry->share_certificate_id}}</span>
                    </div>
                    <div class="col-2 data-div">
                        <span>{{$activity_entry->member->name ?? ''}}</span>
                    </div>
                    <div class="col-1 data-div">
                        <span>{{ucfirst($activity_entry->share_type)}}</span>
                    </div>
                    @if($activity_entry->share_number < 0)
                        <div class="col-1 data-div">
                            <span>({{abs((int)$activity_entry->share_number)}})</span>
                        </div>
                    @else
                        <div class="col-1 data-div">
                            <span
                                style="{{$activity_entry->share_type == 'ordinary' && !$activity_entry->is_transfer_share ? 'color:#5DBF12;' : 'color:#262626;'}}">{{$activity_entry->share_number}}</span>
                        </div>
                    @endif
                    <div class="col-2 data-div">
                        <span>{{number_format($activity_entry->amount, 2, '.', ',')}}</span>
                    </div>
                    <div class="col-1 action-div">
                        <button type="button" data-id="{{$activity_entry->id}}" onclick="fetchEditData(this)" class="btn" data-bs-toggle="modal" data-bs-target="#activityEntryEditModal">Edit</button>
{{--                        <button class="btn text-danger" data-bs-toggle="modal" onclick="onCTAEDelete(this)" data-id="{{$activity_entry->id}}" id="{{route('cap-table-activity-entry.destroy', $activity_entry->id)}}" data-bs-target="#companyDeleteModal-{{$activity_entry->id}}">Delete</button>--}}
                        <button type="button" class="btn delete-btn" data-bs-toggle="modal" data-bs-target="#activityDeleteModal-{{$activity_entry->id}}" onclick="onCTAEDelete(this)" data-id="{{$activity_entry->id}}" id="{{route('cap-table-activity-entry.destroy', $activity_entry->id)}}">Delete</button>
                    </div>
                    <!-- Activity Entries Delete Modal Starts -->
                    <div class="modal fade" id="activityDeleteModal-{{$activity_entry->id}}"
                        data-bs-backdrop="static"
                        data-bs-keyboard="false"
                        tabindex="-1"
                        aria-labelledby="activityDeleteModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog activity-delete-modal">
                            <form action="" id="delForm-{{$activity_entry->id}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <div class="modal-content">
                                    <div class="activity-delete-modal-body">
                                        <p class="text-center">Confirm Delete</p>
                                        <div class="text-center">
                                            <button type="button" class="btn btn-sm activity-delete-modal-close-btn" data-bs-dismiss="modal" aria-label="No">No</button>
                                            <button type="submit" class="btn btn-sm yes-btn">Yes</button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                    <!-- Activity Entries Delete Modal Ends -->

                </div>
            @endforeach
        @else
            <div class="table-rows row g-0 text-center">
                <div class="col-12 data-div text-center">
                    <span>No Data Available</span>
                </div>
            </div>
        @endif
    </div>
</div>
<div class="select-pagination-portion table-bottom-portion row g-0">
    <div class="pagination-part bottom-pagination-part col-12 col-md-5 col-lg-4">
        @if($activity_entries->currentPage() > 1)
            <a href="{{$activity_entries->previousPageUrl()}}" class="btn"><i class="fa-solid fa-chevron-left"></i></a>
        @endif
        <span class="pagination-number pagination-left-number">{{$activity_entries->currentPage()}}</span>
        <span class="pagination-divider">/</span>
        <span class="pagination-number pagination-right-number">{{$activity_entries->lastPage()}}</span>
        @if($activity_entries->currentPage() != $activity_entries->lastPage())
            <a href="{{$activity_entries->nextPageUrl()}}" class="btn"><i class="fa-solid fa-chevron-right"></i></a>
        @endif
    </div>
</div>


@push('indexActivityEntriesJs')
    <script>

    </script>
@endpush
