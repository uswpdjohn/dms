<div class="modal-dialog activity-entry-modal member-transfer-modal">
    <div class="modal-content">
        <div class="activity-entry-modal-body">
            <div class="activity-entry-modal-header row">
                <h5 class="modal-title col-sm-11 col-11" id="memberCreateModalLabel">Add New Member</h5>
                <button type="button" class="btn btn-close btn-sm activity-entry-modal-close-btn col-sm-1 col-1 certify-to-member-modal-close"
                        data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="activity-entry-modal-data row">
                <form action="#" id="create-member_for_certify_to">
                    <meta name="csrf-token" content="{{ csrf_token() }}"/>
                    <input type="text" name="company_id" id="company_id_for_certify_to"  value="{{\App\Helpers\CapTableCompanyHelper::get()}}" readonly hidden="hidden">
                    <div class="data-body row">
                        <div class="data-row col-12">
                            <label for="name">Name<span class="required-sign">*</span></label>
                            <input type="text" name="name" class="form-control" id="certify_to_member_name" placeholder="Name" required>
                        </div>
                        <span class="text-danger certify-to-member-name"></span>
                        <div class="data-row col-12 text-end">
                            <button type="button" onclick="addCertifyToMember()" class="create-user-btn btn" id="add-certify-to-member"><div id="addCertifyToMemberLoadingDiv"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></div>Create
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@section('certifyToMemberJs')
    <script>
        $('.certify-to-member-modal-close').on('click', function () {
            $('.certify-to-member-name').text('')
        })

        function addCertifyToMember() {
            var token = $('meta[name="csrf-token"]').attr('content')
            // let form = $("#create-member")[0];
            // var formData = new FormData(form);
            var formData = $("#create-member_for_certify_to").serialize();
            console.log(formData)

            $.ajax({
                type: "POST",
                url: "{{route('capTable.member.store')}}",
                dataType:"json",
                // data: formData,
                data:{
                    'name': $('#certify_to_member_name').val(),
                    'company_id': $('#company_id_for_certify_to').val(),
                    '_token' : token
                },
                beforeSend: function () {
                    $("#addCertifyToMemberLoadingDiv").show();
                },
                success: function (data) {
                    $("#addCertifyToMemberLoadingDiv").hide();
                    if (data.success == 1) {
                        $('#certify_to_member_name').val('')
                        // $('#company_id').val('')
                        $('.certify-to-member-modal-close').click()
                        let options = ''
                        options += `<option value="${data.response.id}">${data.response.name}</option>`
                        $("#certify-to").append(options)
                        // $("#certify-to-edit").append(options)
                        // $("#edit_company_member_id").append(options)
                        // $("#transfer").append(options)
                        // $("#edit_transfer").append(options)
                        // $("html, body").animate({scrollTop: 0});
                        $('#certificateCreateModal').animate({ scrollTop: 0 }, 400);

                        $('#certifyToMemberFlashMessages').html(
                            `<div class="alert alert-success alert-redirect modal-alert">
                                <img class="alert-img" src="{{asset('assets/icons/success-alert-icon.png')}}" alt="">
                                <p class="alert-text"> ${data.message}</p>
                            </div>`
                        )
                        {{--$('#memberInEditActivityFlashMessages').html(--}}
                        {{--    `<div class="alert alert-success alert-redirect modal-alert">--}}
                        {{--        <img class="alert-img" src="{{asset('assets/icons/success-alert-icon.png')}}" alt="">--}}
                        {{--        <p class="alert-text"> ${data.message}</p>--}}
                        {{--    </div>`--}}
                        {{--)--}}
                        // setTimeout(function () {
                        //     // window.location.href=data.url;
                        //     window.location.reload()
                        // }, 4000);
                    }else{
                        $('#certifyToMemberFlashMessages').html(
                            `<div class="alert alert-success alert-redirect modal-alert">
                                <img class="alert-img" src="{{asset('assets/icons/success-alert-icon.png')}}" alt="">
                                <p class="alert-text"> ${data.message}</p>
                            </div>`
                        )
                        {{--$('#memberInEditActivityFlashMessages').html(--}}
                        {{--    `<div class="alert alert-success alert-redirect modal-alert">--}}
                        {{--        <img class="alert-img" src="{{asset('assets/icons/success-alert-icon.png')}}" alt="">--}}
                        {{--        <p class="alert-text"> ${data.message}</p>--}}
                        {{--    </div>`--}}
                        {{--)--}}

                    }
                },
                error: function (xhr) {
                    // console.log(xhr.responseJSON)
                    $("#addCertifyToMemberLoadingDiv").hide();
                    $("#add-certify-to-member").prop('disabled', false);
                    if (xhr.responseJSON.hasOwnProperty('errors') == true) {
                        $.each(xhr.responseJSON.errors, function (key, value) {
                            $('.certify-to-member-' + key).text(value);
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
