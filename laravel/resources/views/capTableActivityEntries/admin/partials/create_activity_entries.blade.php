<div id="memberFlashMessages"></div>
<div class="modal-dialog activity-entry-modal">
    <div class="modal-content">
        <div class="activity-entry-modal-body">
            <div class="activity-entry-modal-header row">
                <h5 class="modal-title col-sm-11 col-11" id="activityEntryCreateModalLabel">Add New Entry</h5>
                <button type="button" class="btn btn-close btn-sm activity-entry-modal-close-btn col-sm-1 col-1" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="activity-entry-modal-data row">
                <form action="{{route('cap-table-activity-entry.store')}}"  id="create_activity_entries">
                    <meta name="csrf-token" content="{{ csrf_token() }}"/>
                    <input type="text" name="company_id" value="{{\App\Helpers\CapTableCompanyHelper::get()}}" readonly hidden="hidden">
                    <div class="data-body row">
                        <div class="data-row col-6 ">
                            <label for="share-certificate-id"><span class="required-sign">*</span> Share Certificate ID</label>
                            <input type="text" name="share_certificate_id" class="form-control" id="share_certificate_id" required>
                            <span class="text-danger share_certificate_id"></span>
                        </div>
                    </div>
                    <div class="data-body row">
                        <div class="data-row col-6">
                            <label for="transaction-date"><span class="required-sign">*</span> Transaction Date</label>
                            <input type="date" name="transaction_date" class="form-control" id="transaction_date" required>
                            <span class="text-danger transaction_date"></span>
                        </div>
                        <div class="data-row col-6">
                            <label for="founding-round"><span class="required-sign">*</span>Funding Round</label>
                            <input type="text" name="funding_round" class="form-control" id="funding_round" required>
                            <span class="text-danger funding_round"></span>
                        </div>
                        <div class="data-row col-6">
                            <label for="member"><span class="required-sign">*</span> Member</label>
                            <div class="row g-0">
                                <select class="form-control form-select member-select col-10" name="company_member_id" id="company_member_id" required>
                                    <option value="" hidden></option>
                                    @foreach($members as $member)
                                        <option value="{{$member->id}}">{{$member->name}}</option>
                                    @endforeach
                                </select>
                                <button type="button"
                                        class="btn action-buttons add-btn active col-2"
                                        data-bs-toggle="modal"
                                        data-bs-target="#memberCreateModal">
                                    <i class="fa-solid fa-circle-plus"></i>
                                </button>
                            </div>
                            <span class="text-danger company_member_id"></span>
                        </div>

                        <div class="data-row col-6">
                            <label for="type-of-share"><span class="required-sign">*</span>Type of Share</label>
                            <select class="form-control form-select select-data " name="share_type" id="share_type" required>
                                <option value="" hidden></option>
                                <option value="ordinary">Ordinary</option>
                                <option value="preference">Preference</option>
                                <option value="esop">ESOP</option>
                                <option value="convertible">Convertible</option>
                            </select>
                            <span class="text-danger share_type"></span>
                        </div>
                        <div class="data-row col-6">
                            <label for="number-of-share"><span class="required-sign">*</span> Number of Share</label>
                            <input type="number" name="share_number" class="form-control" id="share_number" required>
                            <span class="text-danger share_number"></span>
                        </div>
                        <div class="data-row col-6">
                            <label for="amount-raised"><span class="required-sign">*</span>Amount Raised</label>
                            <input type="number" name="amount" class="form-control" id="amount" step="0.01" required>
                            <span class="text-danger amount"></span>
                        </div>
                        <div class="data-row transfer-checkbox-area col-6">
                            <input type="checkbox" class="select-checkbox" onchange='disableTransfer(this);' value="true" name="is_transfer_share" id="is_transfer_share">
                            <label for="transfer-share" class="transfer-checkbox-text">Transfer Share</label>
                        </div>
                        <div class="data-row col-6">
                            <label for="transfer"><span class="required-sign">*</span>Transfer To</label>
                            <div class="row g-0">
                                <select class="form-control form-select select-data transfer-select col-10" name="transfer_to_company_member_id" id="transfer" disabled>
{{--                                <select class="form-control select form-select select2" name="transfer_to_company_member_id" id="transfer" disabled>--}}
                                    <option value="" hidden></option>
                                    @foreach($members as $member)
                                        <option value="{{$member->id}}">{{$member->name}}</option>
                                    @endforeach
                                </select>
                                <button type="button"
                                        class="btn action-buttons add-btn active col-2"
                                        data-bs-toggle="modal"
{{--                                        data-bs-target="#transferCreateModal">--}}
                                        data-bs-target="#memberCreateModal">
                                    <i class="fa-solid fa-circle-plus"></i>
                                </button>
                                <span id="transfer_to_company_member_error" class="text-bg-danger"></span>
                            </div>
                        </div>
                        <div class="data-row col-12">
                            <label for="note">Note</label>
                            <textarea name="note" class="form-control note" id="note" cols="30" rows="3"></textarea>
                        </div>
                        <div class="data-row col-12 text-end">
                            <button type="button" class="create-user-btn btn" id="add_activity" onclick="createActivity()"><div id="createActivityEntriesLoadingDiv"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></div>Create</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@section('activityEntriesJs')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        });
        function clearErrorMessages() {
            $('.share_certificate_id').text('')
            $('.transaction_date').text('')
            $('.funding_round').text('')
            $('.company_member_id').text('')
            $('.share_type').text('')
            $('.share_number').text('')
            $('.amount').text('')
            $('#transfer_to_company_member_error').text('')
        }

        function createActivity() {
            clearErrorMessages()
            if ($("#is_transfer_share").is(':checked') && $('#transfer').val() == '') {
                $('#transfer_to_company_member_error').text('Select Transfer to proceed');
                return false;
            }
            console.log($('#transfer').val() == '')
            // var token = $('meta[name="csrf-token"]').attr('content')
            // let form = $("#create-member")[0];
            // var formData = new FormData(form);
            var formData = $("#create_activity_entries").serialize();
            // console.log(formData)
            $.ajax({
                type: "POST",
                url: "{{route('cap-table-activity-entry.store')}}",
                dataType:"json",
                data:formData,
                beforeSend: function () {
                    $("#createActivityEntriesLoadingDiv").show();
                },
                success: function (data) {
                    $("#createActivityEntriesLoadingDiv").hide();
                    if (data.success == 1) {
                        $(".activity-entry-modal-close-btn").click()
                        $("html, body").animate({scrollTop: 0});
                        $('#flashMessages').html(
                            `<div class="alert alert-success">
                                <img class="alert-img" src="{{asset('assets/icons/success-alert-icon.png')}}" alt="">
                                <p class="alert-text"> ${data.message}</p>
                            </div>`
                        )
                        setTimeout(function () {
                            // window.location.href=data.url;
                            window.location.reload()
                        }, 2000);
                    }else{
                        $(".activity-entry-modal-close-btn").click()
                        $("html, body").animate({scrollTop: 0});
                        $('#flashMessages').html(
                            `<div class="alert alert-success">
                                <img class="alert-img" src="{{asset('assets/icons/mailbody-!.png')}}" alt="">
                                <p class="alert-text"> ${data.message}</p>
                            </div>`
                        )
                        setTimeout(function () {
                            // window.location.href=data.url;
                            window.location.reload()
                        }, 2000);

                    }
                },
                error: function (xhr) {
                    // console.log(xhr.responseJSON)
                    $("#createActivityEntriesLoadingDiv").hide();
                    $("#add_activity").prop('disabled', false);
                    if (xhr.responseJSON.hasOwnProperty('errors') == true) {
                        $.each(xhr.responseJSON.errors, function (key, value) {
                            $('.'+key).text(value);
                        });
                    } else {
                        $("html, body").animate({scrollTop: 0});
                        $('#flashMessages').html(
                            `<div class="alert alert-success alert-access">
                                <img class="alert-img" src="{{asset('assets/icons/mailbody-!.png')}}" alt="">
                                <p class="alert-text">${xhr.responseJSON.message}</p>
                            </div>`
                        )
                    }
                }
            });
        }
    </script>
@stop
