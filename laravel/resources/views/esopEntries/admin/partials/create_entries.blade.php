<div id="memberFlashMessages"></div>
<div class="modal-dialog entries-modal">
    <div class="modal-content">
        <div class="entries-modal-body">
            <div class="entries-modal-header row">
                <h5 class="modal-title col-sm-11 col-11" id="entriesCreateModalLabel">Add New Entry</h5>
                <button type="button" class="btn btn-close btn-sm entries-modal-close-btn col-sm-1 col-1" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="entries-modal-data row">
                <form action="#" id="create_esop_entries" method="POST">
                    <meta name="csrf-token" content="{{ csrf_token() }}"/>
                    <input type="text" name="company_id" value="{{\App\Helpers\EsopCompanyHelper::get()}}" readonly hidden="hidden">
                    <div class="data-body row">
                        <div class="data-row col-6">
                            <label for="member"><span class="required-sign">*</span>Member</label>
                            <div class="row g-0">
                                <select class="form-control form-select member-select col-10" name="company_member_id" id="company_member_id" onChange="memberStatus(this);" required>
                                    <option hidden>Select</option>
                                    <option value="{{ \App\Helpers\EsopCompanyHelper::getESOPReserveData()->id ?? 0 }}" >{{ \App\Helpers\EsopCompanyHelper::getESOPReserveData()->name ?? 'ESOP Reserve' }}</option>
                                    @foreach($members as $member)
                                        <option value="{{$member->id}}">{{$member->name}}</option>
                                    @endforeach
                                </select>
                                <button type="button" class="btn action-buttons add-btn active col-1" data-bs-toggle="modal" data-bs-target="#memberCreateModal"><i class="fa-solid fa-circle-plus"></i></button>
                            </div>
                            <span class="text-danger company_member_id"></span>
                        </div>
                        <div class="data-row col-6">
                            <label for="status"><span class="required-sign">*</span>Status</label>
                            <select class="form-control form-select col-10" name="status" id="status" required>
                                <option value hidden></option>
                                <option value="reserved">Reserved</option>
                                <option value="issued">Issued</option>
                                <option value="exercised">Exercised</option>
                            </select>
                            <span class="text-danger status"></span>
                        </div>
                        <div class="data-row col-6">
                            <label for="issue-date"><span class="required-sign">*</span>Issue Date</label>
                            <input type="date" name="issue_date" class="form-control" id="issue-date" required>
                            <span class="text-danger issue_date"></span>
                        </div>
                        <div class="data-row col-6">
                            <label for="vesting-period"><span class="required-sign">*</span>Vesting Period (Month)</label>
                            <input type="number" name="vesting_period" value="0" min="0" class="form-control" id="vesting-period" required>
                            <span class="text-danger vesting_period"></span>
                        </div>
                        <div class="data-row col-6">
                            <label for="granted-date"><span class="required-sign">*</span>Date of Granted</label>
                            <input type="date" name="granted_date" class="form-control" id="granted-date" required readonly>
                            <span class="text-danger granted_date"></span>
                        </div>
                        <div class="data-row col-6">
                            <label for="number-of-share"><span class="required-sign">*</span>Number of Share</label>
                            <input type="number" name="no_of_share" class="form-control" id="no-of-share" required>
                            <span class="text-danger no_of_share"></span>
                        </div>
                        <div class="data-row col-6">
                            <label for="reminder-date">Reminder Date</label>
                            <input type="date" name="reminder_date" class="form-control" id="reminder-date">
                        </div>
                        <div class="data-row col-6">
                            <label for="reminder-email-1">1st Email for Reminder</label>
                            <input type="email" name="first_reminder_email" class="form-control" id="reminder-email-1">
                        </div>
                        <div class="data-row col-6">
                            <label for="reminder-email-2">2nd Email for Reminder</label>
                            <input type="email" name="second_reminder_email" class="form-control" id="reminder-email-2">
                        </div>
                        <div class="data-row col-6">
                            <label for="reminder-email-3">3rd Email for Reminder</label>
                            <input type="email" name="third_reminder_email" class="form-control" id="reminder-email-3">
                        </div>
                        <div class="data-row col-6">
                            <label for="reminder-email-4">4th Email for Reminder</label>
                            <input type="email" name="forth_reminder_email" class="form-control" id="reminder-email-4">
                        </div>
                        <div class="data-row col-6">
                            <label for="reminder-email-5">5th Email for Reminder</label>
                            <input type="email" name="fifth_reminder_email" class="form-control" id="reminder-email-5">
                        </div>
                        <div class="data-row col-12">
                            <label for="amount-raised">Note</label>
                            <textarea name class="form-control" id cols="30" rows="3" name="note"></textarea>
                        </div>
                        <div class="data-row col-12 text-end">
                            <button type="button" class="create-user-btn btn" id="add-entry" onclick="createEntry()"><div id="createEsopEntriesLoadingDiv"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></div>Create</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@section('createEntryJs')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        });
        $(document).ready(function(){
            var now = new Date();
            var day = ("0" + now.getDate()).slice(-2);
            var month = ("0" + (now.getMonth() + 1)).slice(-2);
            var today = now.getFullYear()+"-"+(month)+"-"+(day) ;
            $('#issue-date').val(today);
            $('#granted-date').val(today);
        })
        function clearErrorMessages() {
            $('.company_member_id').text('')
            $('.status').text('')
            $('.issue_date').text('')
            $('.vesting_period').text('')
            $('.granted_date').text('')
            $('.no_of_share').text('')
        }

        function createEntry() {
            // clearErrorMessages()

            var formData = $("#create_esop_entries").serialize();
            $.ajax({
                type: "POST",
                url: "{{route('esop-entry.store')}}",
                dataType:"json",
                data:formData,

                beforeSend: function () {
                    $("#createEsopEntriesLoadingDiv").show();
                },
                success: function (data) {
                    clearErrorMessages()
                    $("#createEsopEntriesLoadingDiv").hide();
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
                            // window.location.href=data.url;
                            window.location.reload()
                        }, 2000);
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
                            // window.location.href=data.url;
                            window.location.reload()
                        }, 2000);

                    }
                },
                error: function (xhr) {
                    console.log(xhr.responseJSON)
                    $("#createEsopEntriesLoadingDiv").hide();
                    $("#add-entry").prop('disabled', false);
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

        $('#vesting-period').on("keyup change",function (e) {
            let issue_date = $('#issue-date').val()
            var dt = new Date(issue_date);
            // var dt = new Date();
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
            $('#granted-date').val(gdate)
            if($('#vesting-period').val() == ''){
                $('#granted-date').val('')
            }
        });

        $('#issue-date').change(function (e) {
            if($('#vesting-period').val() != ''){
                var dt = new Date($('#issue-date').val());
                let no_of_months = $('#vesting-period').val();
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
                $('#granted-date').val(gdate)
            }
        });

        function memberStatus(sel) {
            console.log('Entered Here')
            memberValue = sel.options[sel.selectedIndex].text
            var statusSelect = document.getElementById("status");
            $('#status option').filter('[value=""],[value="reserved"],[value="issued"],[value="exercised"]').remove();
            statusSelect.options[0] = new Option('', '');
            statusSelect.options[1] = new Option('Reserved', 'reserved');
            statusSelect.options[2] = new Option('Issued', 'issued');
            statusSelect.options[3] = new Option('Exercised', 'exercised');
            if(memberValue == "ESOP Reserve"){
                // statusSelect.remove(0)
                $('#status option').filter('[value=""],[value="issued"],[value="exercised"]').remove();
            }else{
                $('#status option').filter('[value="reserved"]').remove();
            }
        }
    </script>
@stop
