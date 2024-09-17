<div class="modal-dialog entries-modal member-create-modal">
    <div class="modal-content">
        <div class="entries-modal-body">
            <div class="entries-modal-header row">
                <h5 class="modal-title col-sm-11 col-11" id="memberCreateModalLabel">Add New Member</h5>
                <button type="button" class="btn btn-close btn-sm activity-entry-modal-close-btn col-sm-1 col-1 member-modal-close"
                        data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="entries-modal-data row">
                <form action="#" id="create-member">
                    <meta name="csrf-token" content="{{ csrf_token() }}"/>
                    <input type="text" name="company_id" id="company_id" value="{{\App\Helpers\EsopCompanyHelper::get()}}" hidden="hidden">
                    <div class="data-body row">
                        <div class="data-row col-12">
                            <label for="name">Name<span class="required-sign">*</span></label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="Name" required>
                        </div>
                        <span class="text-danger member-name" ></span>
                        <div class="data-row col-12 text-end">
                            <button type="button" onclick="addMember()" class="create-user-btn btn" id="add-member"><div id="addMemberLoadingDiv"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></div>Create
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@section('addMemberJs')
    <script>
        function addMember() {
            var token = $('meta[name="csrf-token"]').attr('content')
            // let form = $("#create-member")[0];
            // var formData = new FormData(form);
            var formData = $("#create-member").serialize();

            $.ajax({
                type: "POST",
                url: "{{route('esop-entry.member.store')}}",
                dataType:"json",
                // data: formData,
                data:{
                  'name': $('#name').val(),
                  'company_id': $('#company_id').val(),
                    '_token' : token
                },
                beforeSend: function () {
                    $("#addMemberLoadingDiv").show();
                },
                success: function (data) {
                    $("#addMemberLoadingDiv").hide();
                    if (data.success == 1) {
                        $('#name').val('')
                        // $('#company_id').val('')
                        $('.member-modal-close').click()
                        let options = ''
                        options += `<option value="${data.response.id}">${data.response.name}</option>`
                        $("#company_member_id").append(options)
                        // $("#edit_company_member_id").append(options)
                        // $("#transfer").append(options)
                        // $("#edit_transfer").append(options)
                        $("html, body").animate({scrollTop: 0});
                        $('#memberFlashMessages').html(
                            `<div class="alert alert-success alert-redirect modal-alert">
                                <img class="alert-img" src="{{asset('assets/icons/success-alert-icon.png')}}" alt="">
                                <p class="alert-text"> ${data.message}</p>
                            </div>`
                        )
                        $('#memberInEditActivityFlashMessages').html(
                            `<div class="alert alert-success alert-redirect modal-alert">
                                <img class="alert-img" src="{{asset('assets/icons/success-alert-icon.png')}}" alt="">
                                <p class="alert-text"> ${data.message}</p>
                            </div>`
                        )
                        // setTimeout(function () {
                        //     // window.location.href=data.url;
                        //     window.location.reload()
                        // }, 4000);
                    }else{
                        $('#memberFlashMessages').html(
                            `<div class="alert alert-success alert-redirect modal-alert">
                                <img class="alert-img" src="{{asset('assets/icons/success-alert-icon.png')}}" alt="">
                                <p class="alert-text"> ${data.message}</p>
                            </div>`
                        )
                        $('#memberInEditActivityFlashMessages').html(
                            `<div class="alert alert-success alert-redirect modal-alert">
                                <img class="alert-img" src="{{asset('assets/icons/success-alert-icon.png')}}" alt="">
                                <p class="alert-text"> ${data.message}</p>
                            </div>`
                        )

                    }
                },
                error: function (xhr) {
                    // console.log(xhr.responseJSON)
                    $("#addMemberLoadingDiv").hide();
                    $("#add-member").prop('disabled', false);
                    if (xhr.responseJSON.hasOwnProperty('errors') == true) {
                        $.each(xhr.responseJSON.errors, function (key, value) {
                            $('.member-' + key).text(value);
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
