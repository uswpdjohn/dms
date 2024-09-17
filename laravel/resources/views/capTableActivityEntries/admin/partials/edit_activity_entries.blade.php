<div class="" id="memberInEditActivityFlashMessages"></div>
<div class="modal-dialog activity-entry-modal">
    <div class="modal-content">
        <div class="activity-entry-modal-body">
            <div class="activity-entry-modal-header row">
                <h5 class="modal-title col-sm-11 col-11" id="activityEntryEditModalLabel">Update Entry</h5>
                <button type="button"
                        class="btn btn-close btn-sm activity-entry-modal-close-btn edit-modal-close col-sm-1 col-1"
                        data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="activity-entry-modal-data row">
                <form action="#" id="updateActivityEntryForm">
                    <input type="text" id="edit_activity_entry_id" readonly hidden="">
                    <div class="data-body row">
                        <div class="data-row col-6 ">
                            <label for="share-certificate-id"><span class="required-sign">*</span> Share Certificate ID</label>
                            <input type="text" name="share_certificate_id" class="form-control" id="edit_share_certificate_id" required>
                            <span class="text-danger share_certificate_id"></span>
                        </div>
                    </div>
                    <div class="data-body row">
                        <div class="data-row col-6">
                            <label for="transaction-date"><span class="required-sign">*</span> Transaction Date</label>
                            <input type="date" name="transaction_date" class="form-control" id="edit_transaction_date" required>
                            <span class="text-danger transaction_date"></span>
                        </div>
                        <div class="data-row col-6">
                            <label for="founding-round"><span class="required-sign">*</span>Funding Round</label>
                            <input type="text" name="funding_round" class="form-control" id="edit_funding_round" required>
                            <span class="text-danger funding_round"></span>
                        </div>
                        <div class="data-row col-6">
                            <label for="member"><span class="required-sign">*</span> Member</label>
                            <div class="row g-0">
                                <select class="form-control form-select member-select col-10" name="company_member_id" id="edit_company_member_id" required>
                                    <option value="" hidden></option>
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
                            <select class="form-control form-select select-data " name="share_type" id="edit_share_type" required>
                                <option value="" hidden></option>
                            </select>
                            <span class="text-danger share_type"></span>
                        </div>
                        <div class="data-row col-6">
                            <label for="number-of-share"><span class="required-sign">*</span> Number of Share</label>
                            <input type="number" name="share_number" class="form-control" id="edit_share_number" required>
                            <span class="text-danger share_number"></span>
                        </div>
                        <div class="data-row col-6">
                            <label for="amount-raised"><span class="required-sign">*</span>Amount Raised</label>
                            <input type="number" name="amount" class="form-control" id="edit_amount" step="0.01" required>
                            <span class="text-danger amount"></span>
                        </div>
                        <div class="data-row transfer-checkbox-area col-6">
                            <input type="checkbox" class="select-checkbox" onchange='disableTransferEdit(this);' value="true" name="is_transfer_share" id="edit_is_transfer_share">
                            <label for="transfer-share" class="transfer-checkbox-text">Transfer Share</label>
                        </div>
                        <div class="data-row col-6">
                            <label for="transfer"><span class="required-sign">*</span>Transfer To</label>
                            <div class="row g-0">
                                <select class="form-control form-select select-data transfer-select col-10" name="transfer_to_company_member_id" id="edit_transfer" disabled>
                                    <option value="" hidden></option>
                                </select>
                                <button type="button"
                                        class="btn action-buttons add-btn active col-2"
                                        data-bs-toggle="modal"
                                        data-bs-target="#memberCreateModal">
                                    <i class="fa-solid fa-circle-plus"></i>
                                </button>
                            </div>
                            <span id="edit_transfer_to_company_member_error" class="text-bg-danger"></span>
                        </div>
                        <div class="data-row col-12">
                            <label for="note">Note</label>
                            <textarea name="note" class="form-control note" id="edit_note" cols="30" rows="3"></textarea>
                        </div>
                        <div class="data-row col-12 text-end">
                            <button type="button" class="create-user-btn btn" id="edit_activity_entry" onclick="updateActivity()"><div id="editActivityEntriesLoadingDiv"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></div>Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@section('editActivityEntryJs')
    <script>

        $('.edit-modal-close').on('click', function () {
            $('#edit_activity_entry_id').val('')
            $('#edit_share_certificate_id').val('')
            $('#edit_transaction_date').val('')
            $('#edit_funding_round').val('')
            $('#edit_share_type').val('')
            $('#edit_share_number').val('')
            $('#edit_amount').val('')
            $('#edit_note').text('')
            $('#edit_is_transfer_share').prop('checked',false)
            $('#edit_transfer').empty()
            $("#edit_company_member_id").empty()
            $('#edit_share_type').empty()
            disableTransferEdit($('#edit_is_transfer_share'))


        })
        function fetchEditData(e) {
            $('#memberInEditActivityFlashMessages').html('')
            // let id = $('#edit_activity_entry_btn').attr('data-id')
            let id = e.getAttribute('data-id')
            let url = "{{route('cap-table-activity-entry.edit', ':activityEntry')}}"
            url=url.replace(':activityEntry', id)
            $.ajax({
                type: "GET",
                url: url,
                dataType:"json",
                success: function (data) {

                    console.log('edit_is_transfer_share',data.activity_entry.is_transfer_share == true)
                    $('#edit_activity_entry_id').val(data.activity_entry.id)
                    $('#edit_share_certificate_id').val(data.activity_entry.share_certificate_id)
                    $('#edit_transaction_date').val(data.activity_entry.transaction_date)
                    $('#edit_funding_round').val(data.activity_entry.funding_round)
                    $('#edit_share_type').val(data.activity_entry.share_type)
                    $('#edit_share_number').val(Math.abs(data.activity_entry.share_number))
                    $('#edit_amount').val(data.activity_entry.amount.toFixed(2))
                    if (data.activity_entry.note!= null){
                        $('#edit_note').text(data.activity_entry.note)
                    }
                    if (data.activity_entry.is_transfer_share == true){
                        $('#edit_is_transfer_share').prop('checked', 'checked')
                        $('#edit_transfer').attr('disabled', false)
                    }
                    let company_member_options = ''
                    // company_member_options += `<option value="">Please Select</option>`
                    $.each(data.members, function (index, value) {
                        company_member_options += `<option value="${value.id}"  ${data.activity_entry.company_member_id == value.id ? 'selected' : " "}>${value.name}</option>`
                    });
                    $("#edit_company_member_id").empty().append(company_member_options)
                    if (data.activity_entry.transfer_to_company_member_id != null){
                        let options=''
                        $.each(data.members, function (index, value) {
                            options += `<option value="${value.id}"  ${data.activity_entry.transfer_to_company_member_id == value.id ? 'selected' : " "}>${value.name}</option>`
                        });
                        $("#edit_transfer").empty().append(options)
                    }else {
                        let options=''
                        options += `<option value="">Please Select</option>`
                        $.each(data.members, function (index, value) {
                            options += `<option value="${value.id}">${value.name}</option>`
                        });
                        $("#edit_transfer").empty().append(options)
                    }
                    let share_type_options =''
                    share_type_options+=`<option value="ordinary"  ${data.activity_entry.share_type == 'ordinary' ? 'selected' : " "}>Ordinary</option>`
                    share_type_options+=`<option value="preference"  ${data.activity_entry.share_type == 'preference' ? 'selected' : " "}>Preference</option>`
                    share_type_options+=`<option value="esop"  ${data.activity_entry.share_type == 'esop' ? 'selected' : " "}>ESOP</option>`
                    share_type_options+=`<option value="convertible"  ${data.activity_entry.share_type == 'convertible' ? 'selected' : " "}>Convertible</option>`
                    $('#edit_share_type').empty().append(share_type_options)
                },
                error: function (xhr) {
                    console.log(xhr.responseJSON)
                }
            });
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        });
        function updateActivity() {
            let id=$('#edit_activity_entry_id').val()

            // clearErrorMessages()
            // if ($("#is_transfer_share").is(':checked') && $('#transfer').val() == '') {
            //     $('#transfer_to_company_member_error').text('Select Transfer to proceed');
            //     return false;
            // }
            // var token = $('meta[name="csrf-token"]').attr('content')
            // let form = $("#create-member")[0];
            // var formData = new FormData(form);
            if ($("#edit_is_transfer_share").is(':checked') && $('#edit_transfer').val() == '') {
                $('#edit_transfer_to_company_member_error').text('Select Transfer to proceed');
                return false;
            }
            var formData = $("#updateActivityEntryForm").serialize();
            let url = "{{route('cap-table-activity-entry.update', ':activity_entry')}}"
            url=url.replace(':activity_entry', id)
            $.ajax({
                type: "PUT",
                url: url,
                dataType:"json",
                data:formData,
                beforeSend: function () {
                    $("#editActivityEntriesLoadingDiv").show();
                },
                success: function (data) {
                    $("#editActivityEntriesLoadingDiv").hide();
                    if (data.success == 1) {
                        // let options = ''
                        // options += `<option value="${data.response.id}">${data.response.name}</option>`
                        // $("#company_member_id").append(options)
                        // $("#transfer").append(options)
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
                        }, 4000);
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
                    $("#editActivityEntriesLoadingDiv").hide();
                    $("#edit_activity_entry").prop('disabled', false);
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

        $('#edit_company_member_id').on('change', function(){
            let val = $(this).val();
            $('#edit_transfer option').removeAttr('hidden', true)
            $('#edit_transfer option:eq(0)').attr('hidden', 'hidden')
            $('#edit_transfer option[value="'+val+'"]').attr('hidden', 'hidden')
        })

        $('#edit_transfer').on('change', function(){
            let val = $(this).val();
            $('#edit_company_member_id option').removeAttr('hidden', true)
            $('#edit_company_member_id option:eq(0)').attr('hidden', 'hidden')
            $('#edit_company_member_id option[value="'+val+'"]').attr('hidden', 'hidden')
        })
    </script>
@stop
