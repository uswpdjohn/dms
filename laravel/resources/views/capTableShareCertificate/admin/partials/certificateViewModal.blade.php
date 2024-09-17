<div class="modal fade" id="certificateViewModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="certificateViewModalLabel" aria-hidden="true">
    <div class="modal-dialog certificate-modal">
        <div class="modal-content">
            <div class="certificate-modal-body">
                <div class="certificate-modal-header row">
                    <h5 class="modal-title col-sm-11 col-11" id="certificateViewModalLabel">View Share Certificate</h5>
                    <button type="button" class="btn btn-close btn-sm certificate-modal-close-btn col-sm-1 col-1" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="certificate-modal-data">
                    <form class="row" action="#" id="invite_form">
                        <input type="text" name="document_id" id="share_certificate_document_hash_id" readonly hidden="hidden">
{{--                        <input name="director" id="viewDirector" value="" type="text" hidden readonly/>--}}
{{--                        <input name="secretary" id="viewSecretary" value="" type="text" hidden readonly/>--}}

{{--                        <div class="left-body col-12 col-md-7 col-lg-8">--}}
                        <div class="left-body col-12 col-md-12 col-lg-12">
                            <div class="data-body row">
                                <div class="data-row col-6 ">
                                    <label for="status"><span class="required-sign">*</span>Status</label>
                                    <select class="form-control form-select status-select" id="status-view" required disabled></select>
                                </div>
                            </div>
                            <div class="data-body row">
                                <div class="data-row col-6 ">
                                    <label for="type-of-share"><span class="required-sign">*</span>Type of Share</label>
                                    <select class="form-control form-select share-select" id="type-of-share-view" required disabled></select>
                                </div>
                                <div class="data-row col-6 ">
                                    <label for="share-certificate-id"><span class="required-sign">*</span>Share Certificate ID</label>
                                    <input type="text" class="form-control" id="share-certificate-id-view" required disabled>
                                </div>
                                <div class="data-row col-6">
                                    <label for="issue-date"><span class="required-sign">*</span>Issue Date</label>
                                    <input type="date" class="form-control" id="issue-date-view" required disabled>
                                </div>
                                <div class="data-row col-6">
                                    <label for="company-name"><span class="required-sign">*</span>Company Name</label>
                                    <input type="text" class="form-control" id="company-name-view" required disabled>
                                </div>
                                <div class="data-row col-6">
                                    <label for="company-reg-no"><span class="required-sign">*</span>Company Registration No.</label>
                                    <input type="text" class="form-control" id="company-reg-no-view" required disabled>
                                </div>
                                <div class="data-row col-6">
                                    <label for="incorporation-date"><span class="required-sign">*</span>Incorporation Date</label>
                                    <input type="text" class="form-control" id="incorporation-date-view" required disabled>
                                </div>
                                <div class="data-row col-12">
                                    <label for="reg-office-add-line-1"><span class="required-sign">*</span>Registered Office (Address Line)</label>
                                    <input type="text" class="form-control" id="reg-office-add-line-view" required disabled>
                                </div>
{{--                                <div class="data-row col-6">--}}
{{--                                    <label for="reg-office-country"><span class="required-sign">*</span>Registered Office (Country)</label>--}}
{{--                                    <input type="text" class="form-control" id="reg-office-country-view" required disabled>--}}
{{--                                </div>--}}
{{--                                <div class="data-row col-6">--}}
{{--                                    <label for="reg-office-post-code">Registered Office (Postal Code)</label>--}}
{{--                                    <input type="number" class="form-control" id="reg-office-post-code-view" required disabled>--}}
{{--                                </div>--}}
                                <div class="data-row col-6">
                                    <label for="certify-to"><span class="required-sign">*</span>Certify To</label>
                                    <select class="form-control form-select certify-select" id="certify-to-view" required disabled></select>
                                </div>
                                <div class="data-row col-6">
                                    <label for="number-of-shares"><span class="required-sign">*</span>Number of Shares</label>
                                    <input type="number" class="form-control" id="number-of-shares-view" required disabled>
                                </div>
                                <div class="data-row col-6">
                                    <label for="add-line-1"><span class="required-sign">*</span>Address Line 1</label>
                                    <input type="text" class="form-control" id="add-line-1-view" required disabled>
                                </div>
                                <div class="data-row col-6">
                                    <label for="add-line-2"><span class="required-sign">*</span>Address Line 2</label>
                                    <input type="text" class="form-control" id="add-line-2-view" required disabled>
                                </div>
                                <div class="data-row col-6">
                                    <label for="country"><span class="required-sign">*</span>Country</label>
                                    <input type="text" class="form-control" id="country-view" required disabled>
                                </div>
                                <div class="data-row col-6">
                                    <label for="post-code">Postal Code</label>
                                    <input type="number" class="form-control" id="post-code-view" required disabled>
                                </div>
                                <div class="data-row col-12">
                                    <label for="description"><span class="required-sign">*</span>Description</label>
                                    <input type="text" class="form-control" id="description-view" required disabled>
                                </div>
                            </div>
                        </div>
                        <!--ABANDONED-->
{{--                        <div class="right-body col-12 col-md-5 col-lg-4">--}}
{{--                            <label for="directors"><span class="required-sign">*</span>Directors</label>--}}
{{--                            <div class="director-div mt-1">--}}
{{--                                <div class="d-flex">--}}
{{--                                    <h6 class="director-header">Directors</h6>--}}
{{--                                </div>--}}
{{--                                <div id="append-director-to-view"></div>--}}
{{--                            </div>--}}

{{--                            <label for="directors" class="mt-3"><span class="required-sign">*</span>Directors/Secretary</label>--}}
{{--                            <div class="director-div mt-1">--}}
{{--                                <div class="d-flex">--}}
{{--                                    <h6 class="director-header">Directors/Secretary</h6>--}}
{{--                                </div>--}}
{{--                                <div id="append-secretary-to-view"></div>--}}

{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="data-row col-12 text-end">
                            <a href="#" id="downloadShareCertificate" class="create-user-btn btn mx-2 download-btn">Download PDF</a>
{{--                            <button type="button" id="send-signing-invitation" class="create-user-btn btn">Send Invitation</button>--}}
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@section('certificateViewJs')
    <script>
        // $(document).ready(function () {
        //     $('[data-toggle="tooltip"]').tooltip({
        //         placement: 'right'
        //     })
        // })
        // let directorEmailIdInView=[]
        // let secretaryEmailIdInView=[]

        $('#send-signing-invitation').on('click', function (e) {
            $('#send-signing-invitation').prop('disabled', true)
            let document_id = $('#share_certificate_document_hash_id').val()
            let url = "{{route('shareCertificate.invite', ':document_id')}}"
            url = url.replace(':document_id', document_id)

            // let form = $("#invite_form").serialize();
            var formData = $("#invite_form").serialize();
            console.log(formData)
            e.preventDefault();
            $.ajax({
                type: "GET",
                url: url,
                // data: $('#corp-sec-doc-upload').serialize(),
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function () {
                    // $("#CorpSecSendMailLoadingDiv").show();
                },
                success: function (data) {
                    $('#send-signing-invitation').prop('disabled', true)
                    // $("#CorpSecSendMailLoadingDiv").hide();
                    if (data.success == 1) {
                        $('#certificateViewModal').modal('hide')
                        $("html, body").animate({scrollTop: 0});
                        $('#flashMessages').html(
                            `<div class="alert alert-success">
                                <img class="alert-img" src="{{asset('assets/icons/success-alert-icon.png')}}" alt="">
                                <p class="alert-text">Email invitations send successfully</p>
                            </div>`
                        )
                        // setTimeout(function () {
                        //     window.location.reload();
                        // }, 2000);
                        // $(".alert-text").html(response.message);
                    } else if (data.abort == 403) {
                        $('#corp-sec-send-mail').prop('disabled', false)
                        $("html, body").animate({scrollTop: 0});
                        $('#flashMessages').html(
                            `<div class="alert alert-success alert-access">
                                <img class="alert-img" src="{{asset('assets/icons/mailbody-!.png')}}" alt="">
                                <p class="alert-text">${data.message}</p>
                            </div>`
                        )
                    }else{
                        $('#send-signing-invitation').prop('disabled', false)
                        $("html, body").animate({scrollTop: 0});
                        $('#flashMessages').html(
                            `<div class="alert alert-success alert-access">
                                <img class="alert-img" src="{{asset('assets/icons/mailbody-!.png')}}" alt="">
                                <p class="alert-text">${data.message}</p>
                            </div>`
                        )
                    }
                },
                error: function (xhr, res) {
                    $('#send-signing-invitation').prop('disabled', false)
                    // $("#CorpSecSendMailLoadingDiv").hide();
                    if (xhr.status == 500) {
                        $('#send-signing-invitation').prop('disabled', false)

                        $("html, body").animate({scrollTop: 0});
                        $('#flashMessages').html(
                            `<div class="alert alert-success alert-access">
                                <img class="alert-img" src="{{asset('assets/icons/close.png')}}" alt="">
                                <p class="alert-text">Something went wrong! Please try again later.</p>
                            </div>`
                        )
                    }
                    // alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
                }
            });

        })
        function fetchShareCertificateViewData(e) {

            let id=e.getAttribute('data-id')
            let url= "{{route('share-certificate.show', ':share_certificate')}}"
            url= url.replace(':share_certificate', id)
            $.ajax({
                type:"GET",
                url:url,
                success: function (obj) {
                    //below route will be used when using signNow
                    {{--let downloadUrl="{{route('download.shareCertificate', ':document_id')}}" --}}
                    let downloadUrl="{{route('shareCertificate.download', ':document_id')}}"
                    downloadUrl=downloadUrl.replace(':document_id', obj.certificate.document_id)
                    $('#downloadShareCertificate').attr('href', downloadUrl)

                    let directorViewWrapper='#append-director-to-view'
                    let secretaryViewWrapper='#append-secretary-to-view'
                    let viewDirectors=''
                    let viewSecretaries=''
                    $.each(obj.certificate.member_address_line,function(index,value){
                        if(index==0){
                            $('#add-line-1-view').val(value)
                        }
                        $('#add-line-2-view').val(value)
                    });

                    let statusOptions = ''
                    statusOptions += `<option value="valid"  ${obj.certificate.status == 'valid' ? 'selected' : " "}>Valid</option>`
                    statusOptions += `<option value="cancel"  ${obj.certificate.status == 'cancel' ? 'selected' : " "}>Cancel</option>`

                    let shareTypeOptions = ''
                    shareTypeOptions += `<option value="ordinary"  ${obj.certificate.share_type == 'ordinary' ? 'selected' : " "}>Ordinary</option>`
                    shareTypeOptions += `<option value="preference"  ${obj.certificate.share_type == 'preference' ? 'selected' : " "}>Preference</option>`

                    let companyMembers=''
                    companyMembers += `<option value="">${obj.certificate.member.name}</option>`

                    $("#status-view").empty().append(statusOptions)
                    $("#type-of-share-view").empty().append(shareTypeOptions)
                    $("#certify-to-view").empty().append(companyMembers)

                    $('#share-certificate-id-view').val(obj.certificate.share_certificate_id)
                    $('#share_certificate_document_hash_id').val(obj.certificate.document_id)

                    $('#issue-date-view').val(obj.certificate.issue_date)
                    $('#company-name-view').val(obj.certificate.company.name)
                    $('#company-reg-no-view').val(obj.certificate.company.uen)
                    $('#incorporation-date-view').val($.date(obj.certificate.company.incorporation_date))
                    $('#reg-office-add-line-view').val(obj.certificate.company_address_line)
                    $('#reg-office-country-view').val(obj.certificate.company_country)
                    $('#reg-office-post-code-view').val(obj.certificate.company_postal_code)
                    $('#number-of-shares-view').val(obj.certificate.share_number)
                    $('#country-view').val(obj.certificate.member_country)
                    $('#post-code-view').val(obj.certificate.member_postal_code)
                    $('#description-view').val(obj.certificate.description)
                    /*Abandoned*/
                    // let editFunctionName = 'editremove(this)'
                    // $.map(obj.certificate.certificate_signers, function (value, i) {
                    //     if (value.pivot.user_type == 'director') {
                    //         console.log(value)
                    //         directorEmailIdInView.push(value.id)
                    //         $('#viewDirector').val(directorEmailIdInView)
                    //         viewDirectors+=`
                    //                         <div class="directors d-flex">
                    //                             <div>
                    //                                 <p>${value.first_name + " " + (value.last_name!=null?value.last_name:'') + " (" + value.email + ")"}</p>` +
                    //             (value.ccs.map((cc) => (cc != null ? `<p>cc: ${cc}</p>` : '')).join(" ")) +
                    //             `</div>
                    //                         </div>`
                    //     }else if(value.pivot.user_type == 'secretary'){
                    //         secretaryEmailIdInView.push(value.id)
                    //         $('#viewSecretary').val(secretaryEmailIdInView)
                    //         viewSecretaries+=`
                    // <div class="directors d-flex">
                    //     <div>
                    //         <p>${value.first_name + " " + (value.last_name!=null?value.last_name:'') + " (" + value.email + ")"}</p>` +
                    //             (value.ccs.map((cc) => (cc != null ? `<p>cc: ${cc}</p>` : '')).join(" ")) +
                    //             `</div>
                    //
                    // </div>
                    // `
                    //     }
                    //
                    // })
                    // $(directorViewWrapper).empty().append(viewDirectors);
                    // $(secretaryViewWrapper).empty().append(viewSecretaries);
                    // if(obj.certificate.invited_at != null){
                    //     $('#send-signing-invitation').text('Invited')
                    //     $('#send-signing-invitation').prop('disabled',true)
                    //
                    // }

                },
                error: function () {

                }
            })
        }
        const fullMonthNameForView = ["January","February","March","April","May","June","July","August","September","October","November","December"];
        $.date = function(dateObject) {
            var d = new Date(dateObject);
            var day = d.getDate();
            var month = fullMonthNameForView[d.getMonth()];
            var year = d.getFullYear();
            if (day < 10) {
                day = "0" + day;
            }
            if (month < 10) {
                month = "0" + month;
            }
            var date = day + " " + month + " " + year.toString();

            return date;
        };
    </script>
@stop
