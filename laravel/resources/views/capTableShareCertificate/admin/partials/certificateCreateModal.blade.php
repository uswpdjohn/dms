<div id="certifyToMemberFlashMessages"></div>
<div class="modal-dialog certificate-modal">
    <div class="modal-content">
        <div class="certificate-modal-body">
            <div class="certificate-modal-header row">
                <h5 class="modal-title col-sm-11 col-11" id="certificateCreateModalLabel">Create New Certificate</h5>
                <button type="button" onclick="emptyFlashMessage()" class="btn btn-close btn-sm certificate-modal-close-btn col-sm-1 col-1" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="certificate-modal-data">
                <form class="row" action="#" id="share-certificate-form">
                    <meta name="csrf-token" content="{{ csrf_token() }}"/>
{{--                    <input type="text" name="director[]" id="share_certificate_directors" readonly hidden="hidden">--}}
{{--                    <input type="text" name="secretary[]" id="share_certificate_secretaries" readonly hidden="hidden">--}}
{{--                    <div class="left-body col-12 col-md-7 col-lg-8">--}}
                    <div class="left-body col-12 col-md-12 col-lg-12">
                        <input type="text" value="{{\App\Helpers\CapTableCompanyHelper::get()}}" name="company_id" id="share_certificate_create_company_id" hidden="hidden" readonly>
                        <div class="data-body row">
                            <div class="data-row col-6 ">
                                <label for="status"><span class="required-sign">*</span>Status</label>
                                <select class="form-control form-select status-select" name="status" id="status">
                                    <option value hidden >--Please Select--</option>
                                    <option value="valid">Valid</option>
                                    <option value="cancel">Cancel</option>
                                </select>
                            </div>
                            <span class="share-certificate-status clear-error"></span>
                        </div>
                        <div class="data-body row">
                            <div class="data-row col-6 ">
                                <label for="type-of-share"><span class="required-sign">*</span>Type of Share</label>
                                <select class="form-control form-select share-select" name="share_type" id="type-of-share" >
                                    <option value hidden >--Please Select--</option>
                                    <option value="ordinary">Ordinary</option>
                                    <option value="preference">Preference</option>
                                </select>
                                <span class="share-certificate-share_type clear-error"></span>
                            </div>
                            <div class="data-row col-6 ">
                                <label for="share-certificate-id"><span class="required-sign">*</span>Share Certificate ID</label>
                                <input type="text" name="share_certificate_id" class="form-control" id="share-certificate-id"  readonly>
                                <span class="share-certificate-share_certificate_id clear-error"></span>
                            </div>
                            <div class="data-row col-6">
                                <label for="issue-date"><span class="required-sign">*</span>Issue Date</label>
                                <input type="date" name="issue_date" class="form-control" id="issue-date" >
                                <span class="share-certificate-issue_date clear-error"></span>
                            </div>
                            <div class="data-row col-6">
                                <label for="company-name"><span class="required-sign">*</span>Company Name</label>
                                <input type="text" class="form-control" id="company-name" name="company_name"  readonly>
                                <span class="share-certificate-company_id clear-error"></span>
                            </div>
                            <div class="data-row col-6">
                                <label for="company-reg-no"><span class="required-sign">*</span>Company Registration No.</label>
                                <input type="text" name="company_reg_no" class="form-control" id="company-reg-no"  readonly>
                            </div>
                            <div class="data-row col-6">
                                <label for="incorporation-date"><span class="required-sign">*</span>Incorporation Date</label>
                                <input type="text" name="incorporation_date" class="form-control" id="incorporation-date"  readonly>
                            </div>
                            <div class="data-row col-12">
                                <label for="reg-office-add-line-1"><span class="required-sign">*</span>Registered Office (Address Line)</label>
                                <input type="text" name="company_address_line" class="form-control" id="company_address_line" >
                                <span class="share-certificate-company_address_line clear-error"></span>
                            </div>
{{--                            <div class="data-row col-6">--}}
{{--                                <label for="reg-office-add-line-2"><span class="required-sign">*</span>Registered Office (Address Line 2)</label>--}}
{{--                                <input type="text" name="reg_office_add_line_2" class="form-control" id="reg-office-add-line-2" required>--}}
{{--                            </div>--}}
{{--                            <div class="data-row col-6">--}}
{{--                                <label for="reg-office-country"><span class="required-sign">*</span>Registered Office (Country)</label>--}}
{{--                                <input type="text" name="company_country" class="form-control" id="reg-office-country" >--}}
{{--                                <span class="share-certificate-company_country clear-error"></span>--}}
{{--                            </div>--}}
{{--                            <div class="data-row col-6">--}}
{{--                                <label for="reg-office-post-code">Registered Office (Postal Code)</label>--}}
{{--                                <input type="number" name="company_postal_code" class="form-control" id="reg-office-post-code" >--}}
{{--                                <span class="share-certificate-company_postal_code clear-error"></span>--}}
{{--                            </div>--}}
                            <div class="data-row col-6">
                                <label for="certify-to"><span class="required-sign">*</span>Certify To</label>
                                <div class="row g-0">
                                    <select class="form-control form-select member-select col-10" name="company_member_id" id="certify-to"></select>
                                    <button type="button"
                                            class="btn action-buttons add-btn active col-2"
                                            data-bs-toggle="modal"
                                            data-bs-target="#certifyToCreateModal">
                                        <i class="fa-solid fa-circle-plus"></i>
                                    </button>
                                </div>
                                <span class="share-certificate-company_member_id clear-error"></span>
                            </div>

                            <div class="data-row col-6">
                                <label for="number-of-shares"><span class="required-sign">*</span>Number of Shares</label>
                                <input type="number" name="share_number" class="form-control" id="number-of-shares" >
                                <span class="share-certificate-share_number clear-error"></span>
                            </div>
                            <div class="data-row col-6">
                                <label for="add-line-1"><span class="required-sign">*</span>Address Line 1</label>
                                <input type="text" name="member_address_line[]" class="form-control" id="add-line-1" >
                                <span class="clear-error" id="member_add_1"></span>
                            </div>
                            <div class="data-row col-6">
                                <label for="add-line-2">Address Line 2</label>
                                <input type="text" name="member_address_line[]" class="form-control" id="add-line-2" >
                            </div>
                            <div class="data-row col-6">
                                <label for="country"><span class="required-sign">*</span>Country</label>
                                <input type="text" name="member_country" class="form-control" id="country" >
                                <span class="share-certificate-member_country clear-error"></span>
                            </div>
                            <div class="data-row col-6">
                                <label for="post-code">Postal Code</label>
                                <input type="number" name="member_postal_code" class="form-control" id="post-code" >
                                <span class="share-certificate-member_postal_code clear-error"></span>
                            </div>
                            <div class="data-row col-12">
                                <label for="description"><span class="required-sign">*</span>Description</label>
                                <input type="text" name="description" class="form-control" id="description" >
                                <span class="share-certificate-description clear-error"></span>
                            </div>
                        </div>
                    </div>
{{--                    <div class="right-body col-12 col-md-5 col-lg-4">--}}
{{--                        <label for="directors"><span class="required-sign">*</span>Directors</label>--}}
{{--                        <div class="director-div mt-1">--}}
{{--                            <div class="d-flex">--}}
{{--                                <h6 class="director-header">Directors</h6>--}}
{{--                                <a href="#" class="director-create-modal-btn"  data-bs-toggle="modal" data-bs-target="#directorSelectModal"><img src="{{asset('assets/icons/add-button-transparent-icon.png')}}" alt=""></a>--}}
{{--                            </div>--}}
{{--                            <div id="append-directors"></div>--}}
{{--                        </div>--}}
{{--                        <small id="directorNoSignerAlert" class="text-danger clear-error"></small>--}}

{{--                        <label for="directors" class="mt-3"><span class="required-sign">*</span>Directors/Secretary</label>--}}
{{--                        <div class="director-div mt-1 secretary-div">--}}
{{--                            <div class="d-flex">--}}
{{--                                <h6 class="director-header">Directors/Secretary</h6>--}}
{{--                                <a href="#" class="director-create-modal-btn"  data-bs-toggle="modal" data-bs-target="#directorSecretarySelectModal"><img src="{{asset('assets/icons/add-button-transparent-icon.png')}}" alt=""></a>--}}
{{--                            </div>--}}
{{--                            <div id="append-secretaries"></div>--}}
{{--                        </div>--}}
{{--                        <small id="secretaryNoSignerAlert" class="text-danger clear-error"></small>--}}
{{--                    </div>--}}
                    <div class="data-row col-12 text-end">
                        <button type="button" class="create-user-btn btn" id="add-share-certificate">
                            <div id="CreateLoadingDiv"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></div>
                            Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@section('certificateCreateJs')
    <script>
        function emptyFlashMessage() {
            $('#certifyToMemberFlashMessages').html('')
        }

        //Share Certificate Create JS Starts Here


        /*Abandoned Start*/
        // let directorsEmailIds = []
        // let secretaryEmailIds = []

        //Uncomment fetchCertificateSigners() from cap table->admin->index.blade.php
        {{--function fetchCertificateSigners() {--}}
        {{--    let directorWrapper= "#append-directors"--}}
        {{--    let directorModalWrapper= "#append-to-director-modal"--}}
        {{--    let secretaryWrapper= "#append-secretaries"--}}
        {{--    let secretaryModalWrapper= "#append-to-secretary-modal"--}}

        {{--    let companyId=$('#share_certificate_create_company_id').val()--}}
        {{--    let url="{{route('fetch', ':company_id')}}"--}}
        {{--    url=url.replace(':company_id',companyId )--}}
        {{--    $.ajax({--}}
        {{--        type: "GET",--}}
        {{--        url: url,--}}
        {{--        success: function (obj) {--}}

        {{--            let functionName = 'remove(this)'--}}
        {{--            $(directorModalWrapper).html(obj.directors.map((item) =>--}}
        {{--                directorAndSecretaryModalDomLoad(item,functionName)--}}
        {{--            ))--}}
        {{--            $(secretaryModalWrapper).html(obj.directors.map((item) =>--}}
        {{--                directorAndSecretaryModalDomLoad(item,functionName)--}}
        {{--            ))--}}
        {{--        }--}}
        {{--    })--}}
        {{--}--}}
        // function directorDomLoad(director, functionName) {
        //     return `
        //             <div class="directors d-flex">
        //                 <div>
        //                     <p>${director.first_name + " " + director.last_name + " (" + director.email + ")"}</p>` +
        //                     (director.ccs.map((cc) => (cc != null ? `<p>cc: ${cc}</p>` : '')).join(" ")) +
        //                 `</div>
        //                  <button type="button" id="director-${director.id}" onclick="${functionName}" class="btn p-0 ps-3 ms-auto cancel-btn">x</button>
        //             </div>
        //             `
        // }
        // function secretaryDomLoad(director, functionName) {
        //     return `
        //             <div class="directors d-flex">
        //                 <div>
        //                     <p>${director.first_name + " " + director.last_name + " (" + director.email + ")"}</p>` +
        //                     (director.ccs.map((cc) => (cc != null ? `<p>cc: ${cc}</p>` : '')).join(" ")) +
        //                 `</div>
        //                  <button type="button" id="secretary-${director.id}" onclick="${functionName}" class="btn p-0 ps-3 ms-auto cancel-btn">x</button>
        //             </div>
        //             `
        // }
//         function directorAndSecretaryModalDomLoad(director) {
//             return `<div class="directors d-flex">
//                         <div class="col-md-2 col-sm-1 col-1">
// <!--                            <input type="checkbox" class="select-checkbox" name="directors[]" value="${director.id}" checked/>-->
//                             <input type="checkbox" class="select-checkbox" name="directors[]" value="${director.id}"/>
//                         </div>
//                         <div class="col-md-10 col-sm-11 col-11">
//                             <p for="${director.id}">${director.first_name + " " + (director.last_name!=null ? director.last_name : '') + " (" + director.email + ")"}</p>` +
//                 (director.ccs.map((cc) => (cc != null ? `<p>cc: ${cc}</p>` : '')).join(" ")) +
//                 `</div>
//                     </div>`
//         }
        // function remove(e) {
        //
        //     let id = e.id
        //     let btnid = "#" + id
        //     let removedItem = id.split('-')[1]
        //     if (id.split('-')[0] == 'director') {
        //         let directorModalId = ''
        //         directorModalId = '#append-to-director-modal'
        //         $(directorModalId).children().find('input[type=checkbox]').each(function () {
        //             if ($(this).val() == removedItem) {
        //                 $(this).prop('checked', false);
        //             }
        //         })
        //         // delete directorsEmailIds.removedItem;
        //         var result = directorsEmailIds.filter(function (elem) {
        //             return elem != removedItem;
        //         });
        //
        //         directorsEmailIds.length = 0;                  // Clear contents
        //         directorsEmailIds.push.apply(directorsEmailIds, result);  // Append new contents
        //     }
        //     if (id.split('-')[0] == 'secretary') {
        //         let secretaryModalId = ''
        //         secretaryModalId = '#append-to-secretary-modal'
        //
        //         $(secretaryModalId).children().find('input[type=checkbox]').each(function () {
        //             if ($(this).val() == removedItem) {
        //                 $(this).prop('checked', false);
        //             }
        //         })
        //         // delete directorsEmailIds.removedItem;
        //         var result = secretaryEmailIds.filter(function (elem) {
        //             return elem != removedItem;
        //         });
        //         secretaryEmailIds.length = 0;                  // Clear contents
        //         secretaryEmailIds.push.apply(secretaryEmailIds, result);  // Append new contents
        //     }
        //     $(btnid).parent('div').remove()
        // }

        // $('#add-director').on('click', function () {
        //     directorsEmailIds = []
        //     var director_ids = new Array();
        //     $('#append-directors').children().remove() //new
        //     $("#append-to-director-modal input[name='directors[]']:checked").each(function (index,value) {
        //         $(this).prop('checked', true)
        //         let id = "director-" + $(this).val()
        //         director_ids.push($(this).val());
        //         directorsEmailIds.push($(this).val())
        //         var closeBtn = '<button type="button" id="' + id + '" onclick="remove(this)" class="btn p-0 ps-3 ms-auto cancel-btn">x</button>'
        //         var directorBox = $(this).closest(".directors");
        //         directorBox.append(closeBtn);
        //         directorBox.clone().appendTo('#append-directors');
        //         directorBox.find($('.cancel-btn')).remove()
        //     });
        //
        //     $("#append-directors").find('.col-md-2').addClass('d-none')
        //     $('#directorSelectModal').modal('hide');
        // })
        // $('#add-secretary').on('click', function () {
        //     secretaryEmailIds = []
        //     var secretaries_ids = new Array();
        //     $('#append-secretaries').children().remove() //new
        //     $("#append-to-secretary-modal input[name='directors[]']:checked").each(function (index,value) {
        //         $(this).prop('checked', true)
        //         let id = "secretary-" + $(this).val()
        //         secretaries_ids.push($(this).val());
        //         secretaryEmailIds.push($(this).val())
        //         var closeBtn = '<button type="button" id="' + id + '" onclick="remove(this)" class="btn p-0 ps-3 ms-auto cancel-btn">x</button>'
        //         var directorBox = $(this).closest(".directors");
        //         directorBox.append(closeBtn);
        //         directorBox.clone().appendTo('#append-secretaries');
        //         directorBox.find($('.cancel-btn')).remove()
        //     });
        //     $("#append-secretaries").find('.col-md-2').addClass('d-none')
        //     $('#directorSecretarySelectModal').modal('hide');
        // })

        /*Abandoned End*/

        function getShareCertificateUniqueId(share_type) {

            let company_id=$('#share_certificate_create_company_id').val()
            let url = "{{route('get.shareCertificateId')}}"
            let share_certificate_id=''
            $.ajax({
                type: "GET",
                url: url,
                data: {
                    'share_type': share_type,
                    'company_id': company_id
                },
                success: function (obj) {
                    if (share_type == 'ordinary'){
                        // share_certificate_id= 'O'+obj
                        share_certificate_id= obj
                    }else if(share_type == 'preference'){
                        share_certificate_id= 'P'+obj
                    }
                    $('#share-certificate-id').val(share_certificate_id)
                },
                error: function () {

                }
            })
        }
        function getCompanyDetailsForShareCertificate() {
            let url = "{{route('get.CompanyDetails')}}"
            $.ajax({
                type: "GET",
                url: url,
                success: function (obj) {
                    console.log($.date(obj.incorporation_date))
                    $('#company-name').val(obj.name)
                    $('#company-reg-no').val(obj.uen)
                    $('#incorporation-date').val($.date(obj.incorporation_date))
                    $('#company_address_line').val(obj.address_line)
                },
                error: function (xhr) {

                }
            })
        }
        const fullMonthNameForCreate = ["January","February","March","April","May","June","July","August","September","October","November","December"];
        $.date = function(dateObject) {
            var d = new Date(dateObject);
            var day = d.getDate();
            var month = fullMonthNameForCreate[d.getMonth()];
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
        $('#type-of-share').on('change', function (e) {

            getShareCertificateUniqueId(e.target.value)
        })
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        });
        $('#add-share-certificate').on('click', function () {
            clearErrorFields()
            $('#add-share-certificate').prop('disabled', true);
            /*Abandoned Start*/
            // $('#share_certificate_directors').attr('value',directorsEmailIds)
            // $('#share_certificate_secretaries').attr('value',secretaryEmailIds)

            // let secretary = secretaryEmailIds.length;
            // let director = directorsEmailIds.length;

            // if(director > 1 || secretary > 1){
            //     if (director>1){
            //         let noSignerAlertDirector=''
            //         noSignerAlertDirector+=`<i class="fa-solid fa-circle-info text-danger" style="font-size: 13px;"></i> `
            //         noSignerAlertDirector+='More than one Director is not allowed'
            //         $('#directorNoSignerAlert').empty().append(noSignerAlertDirector)
            //     }
            //     if(secretary > 1){
            //         let noSignerAlertSecretary=''
            //         noSignerAlertSecretary+=`<i class="fa-solid fa-circle-info text-danger" style="font-size: 13px;"></i> `
            //         noSignerAlertSecretary+='More than one Director/Secretary is not allowed'
            //         $('#secretaryNoSignerAlert').empty().append(noSignerAlertSecretary)
            //     }
            //     $('#add-share-certificate').prop('disabled', false)
            //     return false;
            // }
            // if (director < 1 || secretary < 1) {
            //     if (director < 1){
            //         let noSignerAlertDirector=''
            //         noSignerAlertDirector+=`<i class="fa-solid fa-circle-info text-danger" style="font-size: 13px;"></i> `
            //         noSignerAlertDirector+='Minimum one Director is required'
            //         $('#directorNoSignerAlert').empty().append(noSignerAlertDirector)
            //     }
            //     if(secretary < 1){
            //         let noSignerAlertSecretary=''
            //         noSignerAlertSecretary+=`<i class="fa-solid fa-circle-info text-danger" style="font-size: 13px;"></i> `
            //         noSignerAlertSecretary+='Minimum one Director/Secretary is required'
            //         $('#secretaryNoSignerAlert').empty().append(noSignerAlertSecretary)
            //
            //     }
            //
            //     $('#add-share-certificate').prop('disabled', false)
            //     return false;
            // }
            /*Abandoned End*/
            let formData=$('#share-certificate-form').serialize()
            $.ajax({
                type:"POST",
                url: "{{route('share-certificate.store')}}",
                data:formData,
                dataType: "json",
                beforeSend: function () {
                    $("#CreateLoadingDiv").show();
                },
                success: function (data) {
                    $("#CreateLoadingDiv").hide();
                    if (data.success == 1) {
                        $('#certificateCreateModal').modal('hide')
                        $("html, body").animate({scrollTop: 0});
                        $('#flashMessages').html(
                            `<div class="alert alert-success">
                            <img class="alert-img" src="{{asset('assets/icons/success-alert-icon.png')}}" alt="">
                            <p class="alert-text">${data.message}</p></div>`
                        )
                        // window.open(data.url)

                        let documentId=data.share_cer.document_id
                        let downloadUrl="{{route('shareCertificate.download', ':document_id')}}"
                        downloadUrl = downloadUrl.replace(':document_id',documentId )
                        window.location = downloadUrl; //Download created share certificate Immediately

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
                    $("#CreateLoadingDiv").hide();
                    $('#add-share-certificate').prop('disabled', false);
                    if (xhr.responseJSON.hasOwnProperty('errors') == true) {
                        $.each(xhr.responseJSON.errors, function (key, value) {
                            console.log('key',key)
                            console.log('value',value)
                            if(key == 'member_address_line.0'){
                                let add_html_error=''
                                add_html_error+=`<i class="fa-solid fa-circle-info text-danger" style="font-size: 13px;"></i> `
                                add_html_error+=value
                                $('#member_add_1').empty().append(add_html_error)
                            }
                            let html=''
                            html+=`<i class="fa-solid fa-circle-info text-danger" style="font-size: 13px;"></i> `
                            html+=value
                            $('.share-certificate-' + key).empty().append(html);
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
        function fetchCompanyMembers() {
            $.ajax({
                type:"GET",
                url:"{{route('get.CompanyMembers')}}",
                success: function (obj) {
                    let options = ''
                    options+= `<option value hidden >--Please Select--</option>`
                    $.each(obj, function (index, value) {
                        // options += `<option value="${value.id}"  ${res[0].company_id == value.id ? 'selected' : " "}>${value.name}</option>`
                        options += `<option value="${value.id}">${value.name}</option>`
                    });
                    $("#certify-to").empty().append(options)
                },
                error: function () {

                }
            })
        }
        function clearErrorFields() {
            $('.clear-error').text('')
        }

        //Share Certificate Create JS Ends Here

    </script>
@stop
