
<div class="modal fade" id="certificateEditModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="certificateEditModalLabel" aria-hidden="true">
    <!-- New Success Alert For Modal End -->
    <div class="modal-dialog certificate-modal">
        <div class="modal-content">
            <div class="certificate-modal-body">
                <div class="certificate-modal-header row">
                    <h5 class="modal-title col-sm-11 col-11" id="certificateEditModalLabel">Update Share Certificate</h5>
                    <button type="button" class="btn btn-close btn-sm certificate-modal-close-btn col-sm-1 col-1" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="certificate-modal-data">
                    <form class="row" action="#" id="edit_share_certificate_form">
                       <!--Abandoned-->
{{--                        <input type="text" name="director[]" id="share_certificate_edit-directors" readonly hidden="hidden">--}}
{{--                        <input type="text" name="secretary[]" id="share_certificate_edit-secretaries" readonly hidden="hidden">--}}
                        <!--Abandoned-->
                        <input type="text" value="" name="company_id" id="share_certificate_edit_company_id" hidden="hidden" readonly>
                        <input type="text" value="" name="share_certificate" id="share_certificate_edit_id" hidden="hidden" readonly>
                        <input type="text" value="" name="share_certificate_document_hash_id" id="share_certificate_edit_document_hash_id" hidden="hidden" readonly>
{{--                        <div class="left-body col-12 col-md-7 col-lg-8">--}}
                        <div class="left-body col-12 col-md-12 col-lg-12">
                            <div class="data-body row">
                                <div class="data-row col-6 ">
                                    <label for="status"><span class="required-sign">*</span>Status</label>
                                    <select class="form-control form-select status-select" name="status" id="cer-edit-status"></select>
                                    <span class="share_certificate_edit_status clear-error"></span>
                                </div>
                            </div>
                            <div class="data-body row">
                                <div class="data-row col-6 ">
                                    <label for="type-of-share"><span class="required-sign">*</span>Type of Share</label>
                                    <select class="form-control form-select share-select" name="share_type" id="type-of-share-edit"></select>
                                    <span class="share_certificate_edit_share_type clear-error"></span>
                                </div>
                                <div class="data-row col-6 ">
                                    <label for="share-certificate-id"><span class="required-sign">*</span>Share Certificate ID</label>
                                    <input type="text" name="share_certificate_id" data-id="" class="form-control" id="share-certificate-id-edit" readonly>
                                    <span class="share_certificate_edit_share_certificate_id clear-error"></span>
                                </div>
                                <div class="data-row col-6">
                                    <label for="issue-date"><span class="required-sign">*</span>Issue Date</label>
                                    <input type="date" name="issue_date" class="form-control" id="issue-date-edit" >
                                    <span class="share_certificate_edit_issue_date clear-error"></span>
                                </div>
                                <div class="data-row col-6">
                                    <label for="company-name"><span class="required-sign">*</span>Company Name</label>
                                    <input type="text" name="company_name" class="form-control" id="company-name-edit"  readonly>
                                    <span class="share_certificate_edit_company_name clear-error"></span>
                                </div>
                                <div class="data-row col-6">
                                    <label for="company-reg-no"><span class="required-sign">*</span>Company Registration No.</label>
                                    <input type="text" name="company_reg_no" class="form-control" id="company-reg-no-edit" readonly>
                                </div>
                                <div class="data-row col-6">
                                    <label for="incorporation-date"><span class="required-sign">*</span>Incorporation Date</label>
                                    <input type="text" name="incorporation_date" class="form-control" id="incorporation-date-edit" readonly>
                                </div>
                                <div class="data-row col-12">
                                    <label for="reg-office-add-line-1"><span class="required-sign">*</span>Registered Office (Address Line)</label>
                                    <input type="text" name="company_address_line" class="form-control" id="reg-office-add-line-edit" >
                                    <span class="share_certificate_edit_company_address_line clear-error"></span>
                                </div>
{{--                                <div class="data-row col-6">--}}
{{--                                    <label for="reg-office-country"><span class="required-sign">*</span>Registered Office (Country)</label>--}}
{{--                                    <input type="text" name="company_country" class="form-control" id="reg-office-country-edit" >--}}
{{--                                    <span class="share_certificate_edit_company_country clear-error"></span>--}}
{{--                                </div>--}}
{{--                                <div class="data-row col-6">--}}
{{--                                    <label for="reg-office-post-code">Registered Office (Postal Code)</label>--}}
{{--                                    <input type="number" name="company_postal_code" class="form-control" id="reg-office-post-code-edit" >--}}
{{--                                    <span class="share_certificate_edit_company_postal_code clear-error"></span>--}}
{{--                                </div>--}}
                                <div class="data-row col-6">
                                    <label for="certify-to"><span class="required-sign">*</span>Certify To</label>
                                    <div class="row g-0">
                                        <select class="form-control form-select member-select col-10" name="company_member_id" id="certify-to-edit" ></select>
                                        <button type="button"
                                                class="btn action-buttons add-btn active col-2"
                                                data-bs-toggle="modal"
                                                data-bs-target="#certifyToCreateModal">
                                            <i class="fa-solid fa-circle-plus"></i>
                                        </button>
                                    </div>
                                    <span class="share_certificate_edit_company_member_id clear-error"></span>
                                </div>
                                <div class="data-row col-6">
                                    <label for="number-of-shares"><span class="required-sign">*</span>Number of Shares</label>
                                    <input type="number" name="share_number" class="form-control" id="number-of-share-edit" >
                                    <span class="share_certificate_edit_share_number clear-error"></span>
                                </div>
                                <div class="data-row col-6">
                                    <label for="add-line-1"><span class="required-sign">*</span>Address Line 1</label>
                                    <input type="text" name="member_address_line[]" class="form-control" id="add-line-1-edit" >
                                    <span class="clear-error" id="member_edit_add_1"></span>
                                </div>
                                <div class="data-row col-6">
                                    <label for="add-line-2"><span class="required-sign">*</span>Address Line 2</label>
                                    <input type="text" name="member_address_line[]" class="form-control" id="add-line-2-edit" >
                                </div>
                                <div class="data-row col-6">
                                    <label for="country"><span class="required-sign">*</span>Country</label>
                                    <input type="text" name="member_country" class="form-control" id="country-edit" >
                                    <span class="share_certificate_edit_member_country clear-error"></span>
                                </div>
                                <div class="data-row col-6">
                                    <label for="post-code">Postal Code</label>
                                    <input type="number" name="member_postal_code" class="form-control" id="post-code-edit" >
                                    <span class="share_certificate_edit_member_postal_code clear-error"></span>
                                </div>
                                <div class="data-row col-12">
                                    <label for="description"><span class="required-sign">*</span>Description</label>
                                    <input type="text" name="description" class="form-control" id="description-edit" >
                                    <span class="share_certificate_edit_description clear-error"></span>
                                </div>
                            </div>
                        </div>
                        <!--Abandoned-->
{{--                        <div class="right-body col-12 col-md-5 col-lg-4">--}}
{{--                            <label for="directors"><span class="required-sign">*</span>Directors</label>--}}
{{--                            <div class="director-div mt-1">--}}
{{--                                <div class="d-flex">--}}
{{--                                    <h6 class="director-header">Directors</h6>--}}
{{--                                    <a href="#" class="director-create-modal-btn"  data-bs-toggle="modal" data-bs-target="#directorSelectModalEdit"><img src="{{asset('assets/icons/add-button-transparent-icon.png')}}" alt=""></a>--}}
{{--                                </div>--}}
{{--                                <div id="append-edit-directors"></div>--}}
{{--                            </div>--}}
{{--                            <small id="directorNoSignerAlertEdit" class="text-danger clear-error"></small>--}}

{{--                            <label for="directors" class="mt-3"><span class="required-sign">*</span>Directors/Secretary</label>--}}
{{--                            <div class="director-div mt-1">--}}
{{--                                <div class="d-flex">--}}
{{--                                    <h6 class="director-header">Directors/Secretary</h6>--}}
{{--                                    <a href="#" class="director-create-modal-btn"  data-bs-toggle="modal" data-bs-target="#secretarySelectModalEdit"><img src="{{asset('assets/icons/add-button-transparent-icon.png')}}" alt=""></a>--}}
{{--                                </div>--}}
{{--                                <div id="append-edit-secretary"></div>--}}
{{--                            </div>--}}
{{--                            <small id="secretaryNoSignerAlertEdit" class="text-danger clear-error"></small>--}}
{{--                        </div>--}}
                        <!--Abandoned-->
                        <div class="data-row col-12 text-end">
                            <button type="button" class="create-user-btn btn" id="update_share_certificate"><div id="EditLoadingDiv"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></div>Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@section('certificateEditJs')

    <script>
        //Share Certificate Edit JS Starts Here

        let directorEditEmailId;
        let secretaryEditEmailId;
        //certify to members for edit are loaded inside
        function fetchShareCertificateEditData(e) {
            directorEditEmailId=[]
            secretaryEditEmailId=[]
            // $(item).attr('id','certificateEditModal')
            let id=e.getAttribute('data-id')
            let url= "{{route('share-certificate.edit', ':id')}}"
            url= url.replace(':id', id)
            $.ajax({
                type:"GET",
                url:url,
                success: function (obj) {
                    let directorEditWrapper='#append-edit-directors'
                    let secretaryEditWrapper='#append-edit-secretary'
                    let editDirectors=''
                    let editSecretaries=''
                    console.log(obj.certificate.company)
                    $.each(obj.certificate.member_address_line,function(index,value){
                        if(index==0){
                            $('#add-line-1-edit').val(value)
                        }
                        $('#add-line-2-edit').val(value)
                    });

                    let statusOptions = ''
                    statusOptions += `<option value="valid"  ${obj.certificate.status == 'valid' ? 'selected' : " "}>Valid</option>`
                    statusOptions += `<option value="cancel"  ${obj.certificate.status == 'cancel' ? 'selected' : " "}>Cancel</option>`

                    let shareTypeOptions = ''
                    shareTypeOptions += `<option value="ordinary"  ${obj.certificate.share_type == 'ordinary' ? 'selected' : " "}>Ordinary</option>`
                    shareTypeOptions += `<option value="preference"  ${obj.certificate.share_type == 'preference' ? 'selected' : " "}>Preference</option>`

                    let companyMembers=''
                    $.each(obj.company_members, function (index, value) {
                        companyMembers += `<option value="${value.id}"  ${value.id == obj.certificate.company_member_id ? 'selected' : " "}>${value.name}</option>`
                    });
                    $("#cer-edit-status").empty().append(statusOptions)
                    $("#type-of-share-edit").empty().append(shareTypeOptions)
                    $("#certify-to-edit").empty().append(companyMembers)

                    $('#share_certificate_edit_company_id').attr('value',obj.certificate.company.id)
                    $('#share_certificate_edit_id').val(obj.certificate.id)

                    $('#share-certificate-id-edit').val(obj.certificate.share_certificate_id)
                    $('#share-certificate-id-edit').attr('data-id',obj.certificate.id)
                    $('#share_certificate_edit_document_hash_id').val(obj.certificate.document_id)

                    $('#issue-date-edit').val(obj.certificate.issue_date)
                    $('#issue-date-edit').val(obj.certificate.issue_date)
                    $('#company-name-edit').val(obj.certificate.company.name)
                    $('#company-reg-no-edit').val(obj.certificate.company.uen)
                    $('#incorporation-date-edit').val($.date(obj.certificate.company.incorporation_date))
                    $('#reg-office-add-line-edit').val(obj.certificate.company_address_line)
                    $('#reg-office-country-edit').val(obj.certificate.company_country)
                    $('#reg-office-post-code-edit').val(obj.certificate.company_postal_code)
                    $('#number-of-share-edit').val(obj.certificate.share_number)
                    $('#country-edit').val(obj.certificate.member_country)
                    $('#post-code-edit').val(obj.certificate.member_postal_code)
                    $('#description-edit').val(obj.certificate.description)

                    /*Abandoned*/
                    // let editFunctionName = 'editremove(this)'
                    // $.map(obj.certificate.certificate_signers, function (value, i) {
                    //     if (value.pivot.user_type == 'director') {
                    //         console.log(value)
                    //         directorEditEmailId.push(value.id)
                    //         editDirectors+=`
                    //                         <div class="directors d-flex">
                    //                             <div>
                    //                                 <p>${value.first_name + " " + (value.last_name!=null?value.last_name:'') + " (" + value.email + ")"}</p>` +
                    //                                     (value.ccs.map((cc) => (cc != null ? `<p>cc: ${cc}</p>` : '')).join(" ")) +
                    //                                     `</div>
                    //                                     <button type="button" id="director-${value.id}" onclick="${editFunctionName}" class="btn p-0 ps-3 ms-auto cancel-btn">x</button>
                    //                         </div>`
                    //     }else if(value.pivot.user_type == 'secretary'){
                    //         secretaryEditEmailId.push(value.id)
                    //         editSecretaries+=`
                    // <div class="directors d-flex">
                    //     <div>
                    //         <p>${value.first_name + " " + (value.last_name!=null?value.last_name:'') + " (" + value.email + ")"}</p>` +
                    //             (value.ccs.map((cc) => (cc != null ? `<p>cc: ${cc}</p>` : '')).join(" ")) +
                    //             `</div>
                    //      <button type="button" id="secretary-${value.id}" onclick="${editFunctionName}" class="btn p-0 ps-3 ms-auto cancel-btn">x</button>
                    // </div>
                    // `
                    //     }
                    //
                    // })
                    // $(directorEditWrapper).empty().append(editDirectors);
                    // $(secretaryEditWrapper).empty().append(editSecretaries);
                    // fetchCertificateSignersForEdit(obj.certificate.certificate_signers)
                    /*Abandoned*/

                },
                error: function (xhr) {
                    $('#flashMessages').html(
                        `<div class="alert alert-success">
                            <img class="alert-img" src="{{asset('assets/icons/mailbody-!.png')}}" alt="">
                            <p class="alert-text">${xhr.responseJSON.message}</p></div>`
                    )

                }
            })
        }
        /*Abandoned*/
        {{--function fetchCertificateSignersForEdit(signers) {--}}
        {{--    let directorModalWrapperEdit= "#append-to-director-modal-edit"--}}
        {{--    let secretaryModalWrapperEdit= "#append-to-secretary-modal-edit"--}}
        {{--    let directors=''--}}
        {{--    let secretaries=''--}}

        {{--    let companyId=$('#share_certificate_edit_company_id').val()--}}
        {{--    let url="{{route('fetch', ':company_id')}}"--}}
        {{--    url=url.replace(':company_id',companyId )--}}
        {{--    $.ajax({--}}
        {{--        type: "GET",--}}
        {{--        url: url,--}}
        {{--        success: function (obj) {--}}
        {{--            let directorsArr =[]--}}
        {{--            let secretariesArr =[]--}}
        {{--            $.map(signers, function (value, i) {--}}
        {{--                if (value.pivot.user_type == 'director') {--}}
        {{--                    directorsArr.push(value)--}}
        {{--                } else {--}}
        {{--                    secretariesArr.push(value)--}}
        {{--                }--}}
        {{--            })--}}
        {{--            --}}
        {{--            $.map(obj.directors, function (value, i) {--}}
        {{--                let disableCheckbox = ' onclick="this.checked=!this.checked;"'--}}
        {{--                directors += `<div class="directors d-flex">--}}
        {{--                                <div class="col-md-2 col-sm-1 col-1">--}}
        {{--                                    <input type="checkbox" class="select-checkbox" name="directors[]" value="${value.id}" ${directorsArr.findIndex(x => x.id === value.id) >= 0 ? 'checked' + disableCheckbox : ''}/>--}}
        {{--                                </div>--}}
        {{--                                <div class="col-md-10 col-sm-11 col-11">--}}
        {{--                                    <p>${value.first_name + " " + (value.last_name!=null ? value.last_name : '') + " (" + value.email + ")"}</p>` +--}}
        {{--                    managementCCDomLoad(value.ccs) +--}}
        {{--                    `</div>--}}
        {{--                               </div>`--}}
        {{--            })--}}
        {{--            $.map(obj.directors, function (secretary, i) {--}}

        {{--                console.log(secretary)--}}
        {{--                let disableCheckbox = ' onclick="this.checked=!this.checked;"'--}}
        {{--                secretaries += `<div class="directors d-flex">--}}
        {{--                                    <div class="col-md-2 col-sm-1 col-1">--}}
        {{--                                        <input type="checkbox" class="select-checkbox" name="secretaries[]" value="${secretary.id}" ${secretariesArr.findIndex(y => y.id === secretary.id) >= 0 ? 'checked' + disableCheckbox : ''}/>--}}
        {{--                                    </div>--}}
        {{--                                    <div class="col-md-10 col-sm-11 col-11">--}}
        {{--                                        <p>${secretary.first_name + " " + (secretary.last_name!=null ? secretary.last_name : '') + " (" + secretary.email + ")"}</p>` +--}}
        {{--                    managementCCDomLoad(secretary.ccs) +--}}
        {{--                    `</div>--}}
        {{--                                 </div>`--}}
        {{--            })--}}

        {{--            $(directorModalWrapperEdit).empty().append(directors)--}}
        {{--            $(secretaryModalWrapperEdit).empty().append(secretaries)--}}
        {{--        }--}}
        {{--    })--}}
        {{--}--}}
        /*Abandoned*/
        /*Abandoned*/
        // function editremove(e) {
        //     console.log('d email before',directorEditEmailId)
        //     console.log(secretaryEditEmailId)
        //     let id = e.id
        //     let removedItem = id.split('-')[1]
        //     console.log(removedItem)
        //     // let service = id.split('-')[0] //weather it is corp sec||tax||acc||hr
        //     if (id.split('-')[0] == 'director') {
        //         let directorModalId = '#directorSelectModalEdit'
        //
        //         $(directorModalId).children().find('input[type=checkbox]').each(function () {
        //             if ($(this).val() == removedItem) {
        //                 $(this).prop('checked', false);
        //                 $(this).removeAttr('onclick')
        //             }
        //         })
        //         var result = directorEditEmailId.filter(function (elem) {
        //             // console.log(elem)
        //             return elem != removedItem;
        //         });
        //         directorEditEmailId.length = 0;                  // Clear contents
        //         directorEditEmailId.push.apply(directorEditEmailId, result);  // Append new contents
        //     }
        //     if (id.split('-')[0] == 'secretary') {
        //         let secretaryModalId = '#secretarySelectModalEdit'
        //         $(secretaryModalId).children().find('input[type=checkbox]').each(function () {
        //             console.log('this',$(this).val())
        //             console.log('this',removedItem)
        //             if ($(this).val() == removedItem) {
        //
        //                 $(this).prop('checked', false);
        //                 $(this).removeAttr('onclick')
        //             }
        //         })
        //         var result = secretaryEditEmailId.filter(function (elem) {
        //             return elem != removedItem;
        //         });
        //         secretaryEditEmailId.length = 0;                  // Clear contents
        //         secretaryEditEmailId.push.apply(secretaryEditEmailId, result);  // Append new contents
        //     }
        //     $("#" + id).parent('div').remove() //good
        // }
        /*Abandoned*/
        // $('#add-edit-director').on('click', function () {
        //     directorEditEmailId = []
        //     var director_ids = new Array();
        //     $('#append-edit-directors').children().remove() //new
        //     $("#append-to-director-modal-edit input[name='directors[]']:checked").each(function (index,value) {
        //         $(this).prop('checked', true)
        //         let id = "director-" + $(this).val()
        //         director_ids.push($(this).val());
        //         directorEditEmailId.push($(this).val())
        //         var closeBtn = '<button type="button" id="' + id + '" onclick="editremove(this)" class="btn p-0 ps-3 ms-auto cancel-btn">x</button>'
        //         var directorBox = $(this).closest(".directors");
        //         directorBox.append(closeBtn);
        //         directorBox.clone().appendTo('#append-edit-directors');
        //         directorBox.find($('.cancel-btn')).remove()
        //     });
        //
        //     $("#append-edit-directors").find('.col-md-2').addClass('d-none')
        //     $('#directorSelectModalEdit').modal('hide');
        //     // $('.btn-close').click();
        //     console.log(directorEditEmailId)
        //
        // })
        // $('#add-edit-secretary').on('click', function () {
        //     secretaryEditEmailId = []
        //     var secretaries_ids = new Array();
        //     // $('#append-directors').children().children().remove() //document management
        //     $('#append-edit-secretary').children().remove() //new
        //     $("#append-to-secretary-modal-edit input[name='secretaries[]']:checked").each(function (index,value) {
        //         $(this).prop('checked', true)
        //         let id = "secretary-" + $(this).val()
        //         secretaries_ids.push($(this).val());
        //         secretaryEditEmailId.push($(this).val())
        //         var closeBtn = '<button type="button" id="' + id + '" onclick="editremove(this)" class="btn p-0 ps-3 ms-auto cancel-btn">x</button>'
        //         var directorBox = $(this).closest(".directors");
        //         console.log('directorBox',directorBox)
        //         directorBox.append(closeBtn);
        //         directorBox.clone().appendTo('#append-edit-secretary');
        //         directorBox.find($('.cancel-btn')).remove()
        //     });
        //     $("#append-edit-secretary").find('.col-md-2').addClass('d-none')
        //     $('#secretarySelectModalEdit').modal('hide');
        //     console.log(secretaryEditEmailId)
        // })
        /*Abandoned*/
        // function managementCCDomLoad(ccs) {
        //     let html = '';
        //     $.map(ccs, function (cc, j) {
        //         if (cc != null) {
        //             html += '<p>cc: ' + cc + '</p>';
        //         }
        //
        //     });
        //     return html;
        // }
        /*Abandoned*/
        $('#type-of-share-edit').on('change', function (e) {
            getEditShareCertificateUniqueId(e.target.value)
        })

        function getEditShareCertificateUniqueId(share_type) {
            let certificate_id=$('#share-certificate-id-edit').attr('data-id')
            let company_id=$('#share_certificate_create_company_id').val()
            let url = "{{route('get.shareCertificateIdEdit')}}"
            $.ajax({
                type: "GET",
                url: url,
                data: {
                    'cer_id': certificate_id,
                    'share_type': share_type,
                    'company_id': company_id
                },
                success: function (obj) {
                    $('#share-certificate-id-edit').val(obj)
                },
                error: function () {

                }
            })
        }
        // function directorEditDomLoad(director, functionName) {
        //     return `
        //             <div class="directors d-flex">
        //                 <div>
        //                     <p>${director.first_name + " " + director.last_name + " (" + director.email + ")"}</p>` +
        //         (director.ccs.map((cc) => (cc != null ? `<p>cc: ${cc}</p>` : '')).join(" ")) +
        //         `</div>
        //                  <button type="button" id="director-${director.id}" onclick="${functionName}" class="btn p-0 ps-3 ms-auto cancel-btn">x</button>
        //             </div>
        //             `
        // }
        function clearErrorFields() {
            $('.clear-error').text('')
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        });
        $('#update_share_certificate').on('click', function () {
            clearErrorFields()
            $('#update_share_certificate').prop('disabled', true);
            // $('#share_certificate_edit-directors').val(directorEditEmailId)
            // $('#share_certificate_edit-secretaries').val(secretaryEditEmailId)
            /*Abandoned*/
            // let editSecretary = secretaryEditEmailId.length;
            // let editDirector = directorEditEmailId.length;
            // if(editDirector > 1 || editSecretary > 1){
            //     if (editDirector > 1){
            //         let noSignerAlertDirector=''
            //         noSignerAlertDirector+=`<i class="fa-solid fa-circle-info text-danger" style="font-size: 13px;"></i> `
            //         noSignerAlertDirector+='More than one Director is not allowed'
            //         $('#directorNoSignerAlertEdit').empty().append(noSignerAlertDirector)
            //     }
            //     if(editSecretary > 1){
            //         let noSignerAlertSecretary=''
            //         noSignerAlertSecretary+=`<i class="fa-solid fa-circle-info text-danger" style="font-size: 13px;"></i> `
            //         noSignerAlertSecretary+='More than one Director/Secretary is not allowed'
            //         $('#secretaryNoSignerAlertEdit').empty().append(noSignerAlertSecretary)
            //     }
            //     $('#update_share_certificate').prop('disabled', false)
            //     return false;
            //
            // }
            //
            // if (editDirector < 1 || editSecretary < 1) {
            //     if (editDirector < 1){
            //         let noSignerAlertDirector=''
            //         noSignerAlertDirector+=`<i class="fa-solid fa-circle-info text-danger" style="font-size: 13px;"></i> `
            //         noSignerAlertDirector+='Minimum one Director is required'
            //
            //         $('#directorNoSignerAlertEdit').empty().append(noSignerAlertDirector)
            //     }
            //     if(editSecretary < 1){
            //         let noSignerAlertSecretary=''
            //         noSignerAlertSecretary+=`<i class="fa-solid fa-circle-info text-danger" style="font-size: 13px;"></i> `
            //         noSignerAlertSecretary+='Minimum one Director/Secretary is required'
            //         $('#secretaryNoSignerAlertEdit').empty().append(noSignerAlertSecretary)
            //     }
            //     $('#update_share_certificate').prop('disabled', false)
            //     return false;
            // }
            /*Abandoned*/
            let formData=$('#edit_share_certificate_form').serialize()
            let url = "{{route('share-certificate.update', ':id')}}"
            url = url.replace(":id",  $('#share_certificate_edit_id').val())
            $.ajax({
                type:"PUT",
                url: url,
                data:formData,
                dataType: "json",
                beforeSend: function () {
                    $("#EditLoadingDiv").show();
                },
                success: function (data) {
                    console.log(data.share_cer)
                    $("#EditLoadingDiv").hide();
                    if (data.success == 1) {
                        $('#certificateEditModal').modal('hide')
                        $("html, body").animate({scrollTop: 0});
                        $('#flashMessages').html(
                            `<div class="alert alert-success">
                            <img class="alert-img" src="{{asset('assets/icons/success-alert-icon.png')}}" alt="">
                            <p class="alert-text">${data.message}</p></div>`
                        )
                        let documentId=data.share_cer.document_id

                        let downloadUrl="{{route('shareCertificate.download', ':document_id')}}"
                        downloadUrl = downloadUrl.replace(':document_id',documentId )
                        window.location = downloadUrl; //Download created share certificate Immediately
                        // window.open(data.url) // open signNow admin panel
                        setTimeout(function () {
                            window.location.reload()
                        }, 4000);
                    }

                    else if(data.success == 0){
                        $("html, body").animate({scrollTop: 0});
                        $('#flashMessages').html(
                            `<div class="alert alert-success alert-access">
                            <img class="alert-img" src="{{asset('assets/icons/mailbody-!.png')}}" alt="">
                            <p class="alert-text">${data.message}</p></div>`
                        )
                    }

                },
                error: function (xhr) {
                    $("#EditLoadingDiv").hide();
                    $('#update_share_certificate').prop('disabled', false);
                    if (xhr.responseJSON.hasOwnProperty('errors') == true) {
                        $.each(xhr.responseJSON.errors, function (key, value) {
                            if(key == 'member_address_line.0'){
                                let add_html_error=''
                                add_html_error+=`<i class="fa-solid fa-circle-info text-danger" style="font-size: 13px;"></i> `
                                add_html_error+=value
                                $('#member_edit_add_1').empty().append(add_html_error)
                            }
                            let html=''
                            html+=`<i class="fa-solid fa-circle-info text-danger" style="font-size: 13px;"></i> `
                            html+=value
                            $('.share_certificate_edit_' + key).empty().append(html);
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
            })
        })
        const fullMonthNameForEdit = ["January","February","March","April","May","June","July","August","September","October","November","December"];
        $.date = function(dateObject) {
            var d = new Date(dateObject);
            var day = d.getDate();
            var month = fullMonthNameForEdit[d.getMonth()];
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
        //Share Certificate Edit JS Ends Here
    </script>
@stop
