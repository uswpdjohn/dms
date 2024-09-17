<div class="back-btn-div tabcontent adminEsopTabContent esop-create-doc">
    <button class="back-btn btn" onclick="goBack(event,'documents')"><i class="fa-solid fa-arrow-left"></i></button>
</div>
<div id="esop-create-doc" class="tabcontent adminEsopTabContent esop-create-doc">
    <form action="#" id="esop-doc-upload">
        <div class="row ">
            <meta name="csrf-token" content="{{ csrf_token() }}" />
            <input name="service_id" id="" value="5" type="text" readonly hidden/>
            <input name="category-name" value="ESOP" type="text" hidden/>
            <input type="text" name="company_id" id="company_id" value="{{\App\Helpers\EsopCompanyHelper::get()}}" readonly hidden>

            <div class="col-sm-12 col-md-6">
                <div class="form-group">
                    <label for="title" class="mb-2 mt-3">Document Name</label>
                    <input type="text" class="form-control" name="name" id="title">
                </div>
                <span class="error_esop-name d-none"><i class="fa-solid fa-circle-info text-danger" style="font-size: 13px;"></i></span> <span class="text-danger esop-name"></span>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="form-group upload-group">
                    <label for="document-upload-esop" class="custom-file-uploaded">Upload Your Document</label>
                    <div class="upload-container">
                        <label for="document-upload" class="custom-file-upload"><i class="fa fa-paperclip" aria-hidden="true"></i></label>
                        <input id="file-name-esop" class="file-name form-control" type="text" readonly />
                        <input name="file"  id="document-upload-esop" class="document-upload" type="file" accept=".doc, .docx, .pdf, .zip, .rar" onchange="displayFileName('file-name-esop', 'document-upload-esop')"/>
                        <button class="upload-button" type="button">Upload</button>
                    </div>
                </div>
                <span class="error_esop-file d-none"><i class="fa-solid fa-circle-info text-danger" style="font-size: 13px;"></i></span> <span class="text-danger esop-file"></span>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="form-group">
                    <label for="title" class="mb-2 mt-3"><span class="required-sign">*</span>Reminder</label>
                    <input name="reminder_date" type="date" class="form-control" id="reminder">
                </div>
                <span class="error_esop-recipient_name d-none"><i class="fa-solid fa-circle-info text-danger" style="font-size: 13px;"></i></span> <span class="text-danger esop-reminder_date"></span>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="form-group">
                    <label for="title" class="mb-2 mt-3"><span class="required-sign">*</span>Name of Recipient</label>
                    <input id="recipient_name" type="text" class="form-control" name="recipient_name"  placeholder="Enter name of Recipient">
                </div>
                <span class="error_esop-reminder_date d-none"><i class="fa-solid fa-circle-info text-danger" style="font-size: 13px;"></i></span> <span class="text-danger esop-recipient_name"></span>
            </div>
            <div class="col-sm-12 col-md-6 mt-2">
                <button id="esop-submit" type="button" class="btn admin-doc-create-submit-btn" hidden>Submit</button>
            </div>
        </div>
    </form>
    <div class="admin-doc-create-btn-section tabcontent ">
        <button id="esop-send" type="button" class="btn admin-doc-create-send-btn mt-3"><div id="EsopLoadingDiv"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></div>Submit</button>
    </div>
</div>



@section('esopDocumentCreateJs')
    <script>
        //esop-submit click
        $('#esop-send').click(function () {
            submitEsopDocument()
        })
        function submitEsopDocument() {

            $('#esop-send').prop('disabled', true);
            $('.esop-company_id').text('')
            $('.esop-name').text('')
            $('.esop-file').text('')
            $('.esop-reminder_date').text('')
            $('.esop-recipient_name').text('')

            $('.error_esop-name').addClass('d-none')
            $('.error_esop-file').addClass('d-none')
            $('.error_esop-recipient_name').addClass('d-none')
            $('.error_esop-reminder_date').addClass('d-none')





            let form = $("#esop-doc-upload")[0];
            var formData = new FormData(form);
            $.ajax({
                type: "POST",
                url: "{{route('upload.document')}}",
                // data: $('#corp-sec-doc-upload').serialize(),
                data: formData,
                dataType: "json",
                processData: false,
                contentType: false,
                beforeSend: function () {
                    $("#EsopLoadingDiv").show();
                },
                success: function (data) {
                    $("#EsopLoadingDiv").hide();
                    if (data.success == 1) {
                        $("html, body").animate({scrollTop: 0});
                        $('#flashMessages').html(
                            `<div class="alert alert-success">
                            <img class="alert-img" src="{{asset('assets/icons/success-alert-icon.png')}}" alt="">
                            <p class="alert-text">${data.message}</p></div>`
                        )
                        setTimeout(function () {
                            window.location.reload()
                        }, 2000);
                    } else if (data.abort == 403) {
                        $("html, body").animate({scrollTop: 0});
                        $('#flashMessages').html(
                            `<div class="alert alert-success login-alert-error">
                            <img class="alert-img" src="{{asset('assets/icons/mailbody-!.png')}}" alt="">
                            <p class="alert-text">${data.message}</p></div>`
                        )
                    }
                },
                error: function (xhr) {
                    // console.log(xhr.responseJSON.hasOwnProperty('errors'))
                    $("#EsopLoadingDiv").hide();
                    $("#esop-send").prop('disabled', false);
                    // alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
                    // alert(xhr.responseText);
                    let errorAlert=''
                    // errorAlert+=`<i class="fa-solid fa-circle-info text-danger" style="font-size: 13px;"></i>`
                    if (xhr.responseJSON.hasOwnProperty('errors') == true) {
                        // errorAlert+=`<i class="fa-solid fa-circle-info text-danger" style="font-size: 13px;"></i>`
                        $.each(xhr.responseJSON.errors, function (key, value) {
                            $('.esop-' + key).text(value);
                            $('.error_esop-' + key).removeClass('d-none');
                        });
                    } else {
                        $("html, body").animate({scrollTop: 0});
                        $('#flashMessages').html(
                            `<div class="alert alert-success alert-access">
                            <img class="alert-img" src="{{asset('assets/icons/mailbody-!.png')}}" alt="">
                            <p class="alert-text">${xhr.responseJSON.message}</p></div>`
                        )
                    }


                }
            });
        }

        function displayFileName(fileId , inputId) {
            var fileInput = document.getElementById(inputId);
            $("#" + fileId).val(fileInput.files[0].name);
        }
    </script>
@stop
