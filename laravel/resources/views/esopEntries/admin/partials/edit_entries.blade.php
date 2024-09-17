<div class="" id="memberInEditEntryFlashMessages"></div>
<div class="modal-dialog entries-modal">
    <div class="modal-content">
        <div class="entries-modal-body">
            <div class="entries-modal-header row">
                <h5 class="modal-title col-sm-11 col-11" id="entriesEditModalLabel">Update Entry</h5>
                <button type="button" class="btn btn-close btn-sm entries-modal-close-btn edit-modal-close col-sm-1 col-1" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="entries-modal-data row">
                <form action="#" id="updateEntryForm" method="POST">
                    {{-- @method('PUT')
                    @csrf_token --}}

                    <input type="text" id="edit_entry_id" readonly hidden="">
                    <input type="text" name="company_id" value="{{\App\Helpers\EsopCompanyHelper::get()}}" readonly hidden="hidden">
                    <div class="data-body row">
                        <div class="data-row col-6">
                            <label for="member"><span class="required-sign">*</span>Member</label>
                            <div class="row g-0">
                                <select class="form-control form-select member-select col-11" name="company_member_id" id="edit_company_member_id"  onChange="editMemberStatus(this);" required>
                                    <option value hidden></option>
                                </select>
                                <button type="button" class="btn action-buttons add-btn active col-1" data-bs-toggle="modal" data-bs-target="#memberCreateModal"><i class="fa-solid fa-circle-plus"></i></button>
                            </div>
                            <span class="text-danger company_member_id"></span>
                        </div>
                        <div class="data-row col-6">
                            <label for="status"><span class="required-sign">*</span>Status</label>
                            <select class="form-control form-select col-10" name="status" id="edit_status" required>
                                <option value hidden></option>
                                {{-- <option value>Reserved</option>
                                <option value selected>Issued</option>
                                <option value>Exercised</option> --}}
                            </select>
                            <span class="text-danger status"></span>
                        </div>
                        <div class="data-row col-6">
                            <label for="issue-date"><span class="required-sign">*</span>Issue Date</label>
                            <input type="date" name="issue_date" class="form-control" id="edit_issue_date" value="" required>
                            <span class="text-danger issue_date"></span>
                        </div>
                        <div class="data-row col-6">
                            <label for="vesting-period"><span class="required-sign">*</span>Vesting Period (Month)</label>
                            <input type="number" name="vesting_period" class="form-control" id="edit_vesting_period" value="" required>
                            <span class="text-danger vesting_period"></span>
                        </div>
                        <div class="data-row col-6">
                            <label for="granted-date"><span class="required-sign">*</span>Date of Granted</label>
                            <input type="date" name="granted_date" class="form-control" id="edit_granted_date" value="" required readonly>
                            <span class="text-danger granted_date"></span>
                        </div>
                        <div class="data-row col-6">
                            <label for="no-of-share"><span class="required-sign">*</span>Number of Share</label>
                            <input type="number" name="no_of_share" class="form-control" id="edit_no_of_share" value="" required>
                            <span class="text-danger no_of_share"></span>
                        </div>
                        <div class="data-row col-6">
                            <label for="reminder-date">Reminder Date</label>
                            <input type="date" name="reminder_date" class="form-control" id="edit_reminder_date" value="">
                        </div>
                        <div class="data-row col-6">
                            <label for="reminder-email-1">1st Email for Reminder</label>
                            <input type="email" name="first_reminder_email" class="form-control" id="edit_reminder_email_1" value="">
                        </div>
                        <div class="data-row col-6">
                            <label for="reminder-email-2">2nd Email for Reminder</label>
                            <input type="email" name="second_reminder_email" class="form-control" id="edit_reminder_email_2" value="">
                        </div>
                        <div class="data-row col-6">
                            <label for="reminder-email-3">3rd Email for Reminder</label>
                            <input type="email" name="third_reminder_email" class="form-control" id="edit_reminder_email_3"  value="">
                        </div>
                        <div class="data-row col-6">
                            <label for="reminder-email-4">4th Email for Reminder</label>
                            <input type="email" name="forth_reminder_email" class="form-control" id="edit_reminder_email_4"  value="">
                        </div>
                        <div class="data-row col-6">
                            <label for="reminder-email-5">5th Email for Reminder</label>
                            <input type="email" name="fifth_reminder_email" class="form-control" id="edit_reminder_email_5"  value="">
                        </div>
                        <div class="data-row col-12">
                            <label for="amount-raised">Note</label>
                            <textarea name class="form-control" id cols="30" rows="3" name="note" id="edit_note"></textarea>
                        </div>
                        <div class="data-row col-12 text-end">
                            <button type="submit" class="create-user-btn btn" id="edit_activity_entry" onclick="updateEntry()"><div id="editEsopEntriesLoadingDiv"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></div>Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@section('editEntryJs')
    <script>

        $('.edit-modal-close').on('click', function () {
            $('#edit_issue_date').val('')
            $('#edit_vesting_period').val('')
            $('#edit_granted_date').val('')
            $('#edit_no_of_share').val('')
            $('#edit_reminder_date').val('')
            $('#edit_reminder_email_1').val('')
            $('#edit_reminder_email_2').val('')
            $('#edit_reminder_email_3').val('')
            $('#edit_reminder_email_4').val('')
            $('#edit_reminder_email_5').val('')
            $('#edit_note').text('')
            $('#edit_company_member_id').empty()
            $("#edit_status").empty()
        })
        function dateFormat(date){
            var dt = new Date(date);
            month = '' + (dt.getMonth() + 1),
                day = '' + dt.getDate(),
                year = dt.getFullYear();

            if (month.length < 2){
                month = '0' + month;
            }
            if (day.length < 2){
                day = '0' + day;
            }
            return (year) + "-" + (month) + "-" + (day)
        };
        function fetchEditData(e) {
            $('#memberInEditEntryFlashMessages').html('')
            // let id = $('#edit_activity_entry_btn').attr('data-id')
            let id = e.getAttribute('data-id')
            let url = "{{route('esop-entry.edit', ':entry')}}"
            url=url.replace(':entry', id)
            $.ajax({
                type: "GET",
                url: url,
                dataType:"json",
                success: function (data) {
                    console.log("fetchEditData() data: ",data)



                    let gdate=prepareDate(data.entry.granted_date)
                    let issued_date=prepareDate(data.entry.issue_date)
                    $('#edit_granted_date').val(gdate)
                    $('#edit_entry_id').val(data.entry.id)
                    $('#edit_issue_date').val(issued_date)

                    $('#edit_vesting_period').val(data.entry.vesting_period)
                    $('#edit_no_of_share').val(data.entry.no_of_share)
                    if (data.entry.reminder_date != null){
                        $('#edit_reminder_date').val(data.entry.reminder_date)
                    }
                    if (data.entry.note != null){
                        $('#edit_note').text(data.entry.note)
                    }
                    if (data.entry.first_reminder_email != null){
                        $('#edit_reminder_email_1').val(data.entry.first_reminder_email)
                    }
                    if (data.entry.second_reminder_email != null){
                        $('#edit_reminder_email_2').val(data.entry.second_reminder_email)
                    }
                    if (data.entry.third_reminder_email != null){
                        $('#edit_reminder_email_3').val(data.entry.third_reminder_email)
                    }
                    if (data.entry.forth_reminder_email!= null){
                        $('#edit_reminder_email_4').val(data.entry.forth_reminder_email)
                    }
                    if (data.entry.fifth_reminder_email!= null){
                        $('#edit_reminder_email_5').val(data.entry.fifth_reminder_email)
                    }
                    let company_member_options = ''
                    company_member_options += `<option value="${data.reserve_member.id}" ${data.entry.company_member_id == data.reserve_member.id ? 'selected' : " "}>${data.reserve_member.name}</option>`
                    $.each(data.members, function (index, value) {
                        company_member_options += `<option value="${value.id}"  ${data.entry.company_member_id == value.id ? 'selected' : " "}>${value.name}</option>`
                    });
                    $("#edit_company_member_id").empty().append(company_member_options)

                    let status_options =''
                    // if($("#edit_company_member_id option:selected").text() == "Reserved"){
                        status_options+=`<option value="reserved"  ${data.entry.status == 'Reserved' ? 'selected' : " "}>Reserved</option>`
                    // }else{
                        status_options+=`<option value="issued"  ${data.entry.status == 'Issued' ? 'selected' : " "}>Issued</option>`
                        status_options+=`<option value="exercised"  ${data.entry.status == 'Exercised' ? 'selected' : " "}>Exercised</option>`
                    // }

                    $('#edit_status').empty().append(status_options)
                },
                error: function (xhr) {
                    console.log(xhr.responseJSON)
                }
            });
        }

        function prepareDate(date) {
            // var dt = new Date(data.entry.granted_date);
            var dt = new Date(date);
            month = '' + (dt.getMonth() + 1),
                day = '' + dt.getDate(),
                year = dt.getFullYear();

            if (month.length < 2){
                month = '0' + month;
            }
            if (day.length < 2){
                day = '0' + day;
            }
            return (year)+"-"+(month)+"-"+(day)
            // return final_date;
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        });
        function updateEntry() {
            event.preventDefault()
            let id=$('#edit_entry_id').val()
            // console.log('Entered Update Entry')
            var formData = $("#updateEntryForm").serialize();
            let url = "{{route('esop-entry.update', ':esop-entry')}}"
            url=url.replace(':esop-entry', id)
            $.ajax({
                type: "PUT",
                url: url,
                dataType:"json",
                data:formData,
                beforeSend: function () {
                    $("#editEsopEntriesLoadingDiv").show();
                },
                success: function (data) {

                    $("#editEsopEntriesLoadingDiv").hide();
                    if (data.success == 1) {
                        $(".entries-modal-close-btn").click()
                        $("html, body").animate({scrollTop: 0});
                        $('#flashMessages').html(
                            `<div class="alert alert-success">
                            <img class="alert-img" src="{{asset('assets/icons/success-alert-icon.png')}}" alt="">
                            <p class="alert-text"> ${data.message}</p>
                        </div>`
                        )
                        setTimeout(function () {
                            window.location.reload()
                        }, 4000);
                    }else{
                        $(".entries-modal-close-btn").click()
                        $("html, body").animate({scrollTop: 0});
                        $('#flashMessages').html(
                            `<div class="alert alert-success">
                            <img class="alert-img" src="{{asset('assets/icons/mailbody-!.png')}}" alt="">
                            <p class="alert-text"> ${data.message}</p>
                        </div>`
                        )
                        setTimeout(function () {
                            window.location.reload()
                        }, 2000);

                    }
                },
                error: function (xhr) {
                    // console.log('updateEntry() error')
                    // console.log(xhr.responseJSON)
                    $("#editEsopEntriesLoadingDiv").hide();
                    $("#edit_entry").prop('disabled', false);
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

        $('#edit_vesting_period').on("keyup change",function (e) {
            var dt = new Date($('#edit_issue_date').val());
            let no_of_months = $(this).val();
            dt.setMonth(dt.getMonth() + parseInt(no_of_months))

            month = '' + (dt.getMonth() + 1),
            day = '' + dt.getDate(),
            year = dt.getFullYear();

            if (month.length < 2){
                month = '0' + month;
            }
            if (day.length < 2){
                day = '0' + day;
            }
            var gdate = (year)+"-"+(month)+"-"+(day)
            $('#edit_granted_date').val(gdate)
            if($('#edit_vesting_period').val() == ''){
                $('#edit_granted_date').val('')
            }
        });

        $('#edit_issue_date').change(function (e) {
            if($('#edit_vesting-period').val() != ''){
                var dt = new Date($('#edit_issue_date').val());
                let no_of_months = $('#edit_vesting_period').val();
                dt.setMonth(dt.getMonth() + parseInt(no_of_months))

                month = '' + (dt.getMonth() + 1),
                day = '' + dt.getDate(),
                year = dt.getFullYear();

                if (month.length < 2){
                    month = '0' + month;
                }
                if (day.length < 2){
                    day = '0' + day;
                }
                var gdate = (year)+"-"+(month)+"-"+(day)
                $('#edit_granted_date').val(gdate)
            }
        });
        $('#edit_status').on('change', function (){
            if($("#edit_status option:selected").val() == 'exercised') {
                var dt = new Date();
                month = '' + (dt.getMonth() + 1),
                    day = '' + dt.getDate(),
                    year = dt.getFullYear();

                if (month.length < 2){
                    month = '0' + month;
                }
                if (day.length < 2){
                    day = '0' + day;
                }
                var gdate = (year)+"-"+(month)+"-"+(day)
                // console.log(gdate)
                $('#edit_granted_date').val(gdate)
            }

        })
        function editMemberStatus(sel) {
            memberValue = sel.options[sel.selectedIndex].text
            var statusSelect = document.getElementById("edit_status");
            $('#edit_status option').filter('[value=""],[value="reserved"],[value="issued"],[value="exercised"]').remove();
            statusSelect.options[0] = new Option('', '');
            statusSelect.options[1] = new Option('Reserved', 'reserved');
            statusSelect.options[2] = new Option('Issued', 'issued');
            statusSelect.options[3] = new Option('Exercised', 'exercised');
            if(memberValue == "ESOP Reserve"){
                // statusSelect.remove(0)
                $('#edit_status option').filter('[value=""],[value="issued"],[value="exercised"]').remove();
            }else{
                $('#edit_status option').filter('[value="reserved"]').remove();
            }
        }
    </script>
@stop
