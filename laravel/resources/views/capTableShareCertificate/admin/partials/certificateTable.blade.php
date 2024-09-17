<div class="select-pagination-portion table-top-portion row g-0">
    <div class="sb-part search-box-part col-12 col-md-4 offset-lg-1 col-lg-5">
        <div class="d-flex form-inputs search-data">
            <input class="form-control" type="text" placeholder=" Cert ID" id="share_certificate_search"   value="{{request()->has('share_certificate_search') ? request()->get('share_certificate_search') : ''}}">
            <button type="button" class="search-btn btn" onclick="shareCertificateSearchActivity()"><i class="fa-solid fa-search"></i></button>
        </div>
    </div>

    <div class="button-part col-12 col-md-8 col-lg-7">
        <button type="button" class="btn create-btn action-buttons active" data-bs-toggle="modal" data-bs-target="#certificateCreateModal">Create New</button>
    </div>
</div>
<div class="mb-2">Current Selection: <b class="capTable-current-company-selection"></b></div>
<div class="table-responsive">
    <div class="cap-table-manage-body">
        <div class="table-rows row g-0">
            <div class="col-2 header-div">
                <span>Issue Date</span>
            </div>
            <div class="col-1 header-div">
                <span>Cert ID</span>
            </div>
            <div class="col-2 header-div">
                <span>Member</span>
            </div>
            <div class="col-1 header-div">
                <span>Cert Status</span>
            </div>
{{--            <div class="col-1 header-div">--}}
{{--                <span>Sign Status</span>--}}
{{--            </div>--}}
            <div class="col-2 header-div">
                <span>No. of Shares</span>
            </div>
            <div class="col-3 header-div">
                <span>Action</span>
            </div>
        </div>
        <!-- Main Row Starts -->
        <div id="shareCertificateTable"></div>
        <!-- Main Row ENDS -->
    </div>
</div>
<div id="shareCertificatePagination"></div>

@section('certificateTableJs')
    <script>
        //SHARE CERTIFICATE TABLE JS STARTS HERE
        $(document).on('click', '.pagination-part .cer-left-arrow', function () {
            let shareCertificateUrl=''
            if ($(this).attr('data-href') != '') {
                shareCertificateUrl=$(this).attr('data-href')
                share_certificate_fetch_data(shareCertificateUrl);
            }
        })
        $(document).on('click', '.pagination-part .cer-right-arrow', function () {
            let shareCertificateUrl=''
            if ($(this).attr('data-href') != '') {
                shareCertificateUrl=$(this).attr('data-href')
                share_certificate_fetch_data(shareCertificateUrl);
            }
        })
        function share_certificate_fetch_data(url) {
            let pagination_wrapper= "#shareCertificatePagination"
            $.ajax({
                type: "GET",
                url: url,
                success: function (obj) {
                    $(pagination_wrapper).html(shareCertificateAppendPaginator())
                    // determinePaginationArrow(obj)
                    shareCerDeterminePaginationArrow(obj)
                    $('#cer-left-number').text(obj.current_page)
                    $('#cer-right-number').text(obj.last_page)

                    $("#cer-left-arrow").attr('data-href', obj.prev_page_url)
                    $("#cer-right-arrow").attr('data-href', obj.next_page_url)
                    shareCertificateTableDomLoad(obj)
                }
            })
        }
        $('#share_certificate_search').on('keyup', function () {
            if (this.value.length == 0) {
                fetchShareCertificateData()
            }
        })
        function shareCertificateSearchActivity() {
            let pagination_wrapper= "#shareCertificatePagination"
            let search = $('#share_certificate_search').val()
            var url = "<?php echo e(route('share-certificate.index')); ?>";
            url = url.replace(':search', search);
            $.ajax({
                type: "GET",
                url: url,
                data:{
                    'search':search
                },
                success: function (obj) {
                    $(pagination_wrapper).html(shareCertificateAppendPaginator())
                    shareCerDeterminePaginationArrow(obj)
                    // addClassInPaginationArrow('member-search')
                    // removeClassFromPaginationArrow('member-base')
                    // removeClassFromPaginationArrow('as-ob-filter')

                    $('#cer-left-number').text(obj.current_page)
                    $('#cer-right-number').text(obj.last_page)

                    // $("#cer-left-arrow").removeAttr('href')
                    // $("#cer-right-arrow").removeAttr('href')

                    $("#cer-left-arrow").attr('data-href', obj.prev_page_url)
                    $("#cer-right-arrow").attr('data-href', obj.next_page_url)
                    shareCertificateTableDomLoad(obj)
                }
            })
        }
        function fetchShareCertificateData() {
            let pagination_wrapper="#shareCertificatePagination"

            $.ajax({
                type:"GET",
                url:"{{route('share-certificate.index')}}",
                success: function (obj) {
                    shareCertificateTableDomLoad(obj)
                    $(pagination_wrapper).html(shareCertificateAppendPaginator())
                    shareCerDeterminePaginationArrow(obj)
                    $('#cer-left-number').text(obj.current_page)
                    $('#cer-right-number').text(obj.last_page)
                    $("#cer-left-arrow").attr('data-href', obj.prev_page_url)
                    $("#cer-right-arrow").attr('data-href', obj.next_page_url)
                    // let options = ''
                    // options+= `<option value hidden >--Please Select--</option>`
                    // $.each(obj, function (index, value) {
                    //     // options += `<option value="${value.id}"  ${res[0].company_id == value.id ? 'selected' : " "}>${value.name}</option>`
                    //     options += `<option value="${value.id}">${value.name}</option>`
                    // });
                    // $("#certify-to").empty().append(options)
                },
                error: function () {

                }
            })
        }
        function shareCertificateAppendPaginator() {
            return `<div class="select-pagination-portion table-bottom-portion row g-0">
                    <div class="pagination-part bottom-pagination-part col-12 col-md-5 col-lg-4">
                        <a data-href="#" class="btn cer-left-arrow" id="cer-left-arrow"><i class="fa-solid fa-chevron-left"></i></a>
                        <span class="pagination-number pagination-left-number" id="cer-left-number"></span>
                        <span class="pagination-divider">/</span>
                        <span class="pagination-number pagination-right-number" id="cer-right-number"></span>
                        <a data-href="#" class="btn cer-right-arrow" id="cer-right-arrow"><i class="fa-solid fa-chevron-right"></i></a>
                    </div>
                </div>`

        }
        // <div class="col-1 data-div">
        //     <span class="sign-status" name="sign-status">${ucwords(item.sign_status)}</span>
        // </div>
        // <button type="button" class="btn refresh-btn" data-id="cer-refresh-${item.id}" onclick="cerRefreshStatus(this, '${item.document_id}')">Refresh <span id="cer-refresh-${item.id}" class="d-none spinner-border spinner-border-sm" role="status" aria-hidden="true"></button>
        function shareCertificateTableDomLoad(obj) {
            let wrapper="#shareCertificateTable"
            let html=''
            if(obj.data.length > 0){
                $.map(obj.data, function(item,i){
                        html+=`<div class="table-rows row g-0">
                                <div class="col-2 data-div">
                                    <span>${$.tableDate(item.issue_date)}</span>
                                </div>
                                <div class="col-1 data-div">
                                    <span>${item.share_certificate_id}</span>
                                </div>
                                <div class="col-2 data-div">
                                    <span>${item.member.name}</span>
                                </div>
                                <div class="col-1 data-div">
                                    <span class="cert-status">${ucwords(item.status)}</span>
                                </div>

                                <div class="col-2 data-div">
                                    <span>${addCommas(item.share_number)}</span>
                                </div>
                                <div class="col-3 action-div">

                                    <button type="button" class="btn" data-bs-toggle="modal" data-id="${item.id}" data-bs-target="#certificateViewModal" onclick="fetchShareCertificateViewData(this)">View</button>
                                    <button type="button" class="btn" data-bs-toggle="modal" data-id="${item.id}" data-cer-id="${item.share_certificate_id}" data-bs-target="#certificateEditModal" onclick="fetchShareCertificateEditData(this)">Edit</button>
                                    <button type="button" class="btn delete-btn" data-bs-toggle="modal" data-bs-target="#certificateDeleteModal-${item.share_certificate_id}" >Delete</button>
                                </div>
                                <div class="modal fade" id="certificateDeleteModal-${item.share_certificate_id}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="certificateDeleteModalLabel" aria-hidden="true">
                                    <div class="modal-dialog delete-modal">
                                        <div
                                            class="modal-content">
                                            <div class="delete-modal-body">
                                                <p class="text-center">Confirm Delete</p>
                                                <div class="text-center">
                                                    <button type="button" class="btn btn-sm delete-modal-close-btn" data-bs-dismiss="modal" aria-label="No">No</button>
                                                    <button type="button" data-id="${item.id}" onclick="deleteShareCertificate(this,'${item.share_certificate_id}')" class="btn btn-sm yes-btn">Yes <span id="loadingDiv-${item.id}" class="d-none spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>`
                })

                $(wrapper).empty().append(html)
                styleSignStatus()
                styleCerStatus()
            }else {
                $(wrapper).html(`<div class="table-rows row g-0">
            <div class="col-12 data-div text-center">
                <span class="text-danger">No Data Available</span>
            </div></div>`)
            }
        }
        function cerRefreshStatus(e, document_id) {
            let spinnerId = e.getAttribute('data-id')

            console.log(spinnerId)
            let url = '{{route('document.cerRefresh.status', ':document_id')}}'
            url = url.replace(':document_id', document_id)
            $.ajax({
                type: "GET",
                url: url,
                // data: $('#corp-sec-doc-upload').serialize(),
                processData: false,
                contentType: false,
                beforeSend: function () {
                    $("#" + spinnerId).removeClass('d-none');
                },
                success: function (data) {
                    $("#" + spinnerId).addClass('d-none');
                    // console.log(data.status == 'completed')
                    if (data.sign_status == 'completed') {
                        let wrapper = $(e).parent().prev('div').prev('div')
                        wrapper.children("span").remove()
                        let completeBtn = '<span name="sign-status" class="sign-status">Completed</span>'; // completed btn
                        wrapper.append(completeBtn);
                        styleSignStatus()
                    }
                    // setTimeout(function () {
                    //     // window.location.href=data.url;
                    //     window.location.reload()
                    // }, 1000);
                },
                error: function (xhr) {
                    $("#" + spinnerId).addClass('d-none');
                    $('#flashMessages').html(
                        `<div class="alert alert-success">
                                <img class="alert-img" src="{{asset('assets/icons/mailbody-!.png')}}" alt="">
                                <p class="alert-text">Something went wrong</p>
                            </div>`
                    )
                    // alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
                }
            });
        }
        function shareCerDeterminePaginationArrow(obj) {
            let left_arrow = ""
            let right_arrow = ""
            left_arrow = "#cer-left-arrow"
            right_arrow = "#cer-right-arrow"

            if (obj.current_page > 1) {
                if ($(left_arrow).hasClass("d-none") == true) {
                    $(left_arrow).removeClass('d-none')
                }
            } else {
                $(left_arrow).addClass('d-none')
            }
            if (obj.current_page == obj.last_page) {
                $(right_arrow).addClass('d-none')
            } else {
                $(right_arrow).removeClass('d-none')
            }
        }
        function removeClassFromPaginationArrow(className) {
            $('#left-arrow').removeClass(className)
            $('#right-arrow').removeClass(className)
        }
        function addClassInPaginationArrow(className) {
            $('#left-arrow').addClass(className)
            $('#right-arrow').addClass(className)
        }
        function deleteShareCertificate(e,document_unique_id) {
            let deleteUrl= "{{route('share-certificate.destroy', ':id')}}"
            deleteUrl=deleteUrl.replace(':id', e.getAttribute('data-id'))
            $.ajax({
                type: "DELETE",
                url: deleteUrl,
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                beforeSend: function () {
                    $("#loadingDiv-" + e.getAttribute('data-id')).removeClass('d-none');
                },
                success: function (data) {
                    $('#certificateDeleteModal-'+document_unique_id).modal('hide')
                    $("#loadingDiv-" + e.getAttribute('data-id')).addClass('d-none');
                    if (data.success == true){
                        $("html, body").animate({scrollTop: 0});
                        $('#flashMessages').html(
                            `<div class="alert alert-success">
                                <img class="alert-img" src="{{asset('assets/icons/success-alert-icon.png')}}" alt="">
                                <p class="alert-text">${data.message}</p>
                            </div>`
                        )
                        setTimeout(function () {
                            // window.location.href=data.url;
                            window.location.reload()
                        }, 1000);
                    }else {
                        $('#flashMessages').html(
                            `<div class="alert alert-success">
                                <img class="alert-img" src="{{asset('assets/icons/mailbody-!.png')}}" alt="">
                                <p class="alert-text">${data.message}</p>
                            </div>`
                        )
                    }

                },
                error: function (xhr) {
                    $("#" + spinnerId).addClass('d-none');
                    $('#flashMessages').html(
                        `<div class="alert alert-success">
                                <img class="alert-img" src="{{asset('assets/icons/mailbody-!.png')}}" alt="">
                                <p class="alert-text">Something went wrong</p>
                            </div>`
                    )
                    // alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
                }
            });

        }
        //HELPERS START
        function ucwords (str) {
            return (str + '').replace(/^([a-z])|\s+([a-z])/g, function ($1) {
                return $1.toUpperCase();
            });
        }
        function addCommas(nStr) {
            nStr += '';
            x = nStr.split('.');
            x1 = x[0];
            x2 = x.length > 1 ? '.' + x[1] : '';
            var rgx = /(\d+)(\d{3})/;
            while (rgx.test(x1)) {
                x1 = x1.replace(rgx, '$1' + ',' + '$2');
            }
            return x1 + x2;
        }
        const fullMonthForCerList = ["Jan","Feb","Mar","Apr","May","June","Jul","Aug","Sept","Oct","Nov","Dec"];
        $.tableDate = function(dateObject) {
            var d = new Date(dateObject);
            var day = d.getDate();
            var month = fullMonthForCerList[d.getMonth()];
            var year = d.getFullYear();
            if (day < 10) {
                day = "0" + day;
            }
            if (month < 10) {
                month = "0" + month;
            }
            var date = day + " " + month + " " + year.toString().substring(2);

            return date;
        };
        //HELPERS END




        //FRONTEND JS START
        styleSignStatus()
        styleCerStatus()
        function styleCerStatus() {
            var certStatus = document.getElementsByClassName("cert-status");
            var countCertificates = certStatus.length;
            for (var i = 0; i < countCertificates; i++){
                console.log(certStatus[i].innerHTML)
                if(certStatus[i].innerHTML == "Valid"){
                    certStatus[i].style.color = "#52C41A";
                }else{
                    certStatus[i].style.color = "#CF1322";
                }
            }
        }
        function styleSignStatus() {
            var signStatus = document.getElementsByClassName("sign-status");
            var countSign = signStatus.length;
            for (var i = 0; i < countSign; i++){
                if(signStatus[i].innerHTML == "Completed"){
                    signStatus[i].style.color = "#52C41A";
                    signStatus[i].style.border = "1px solid #52C41A";
                    signStatus[i].style.backgroundColor = "#F6FFED";
                }else{
                    signStatus[i].style.color = "#FA8C16";
                    signStatus[i].style.border = "1px solid #FFD591";
                    signStatus[i].style.backgroundColor = "#FFF7E6";
                }
            }
        }
        //FRONTEND JS END

        //SHARE CERTIFICATE TABLE JS ENDS HERE
    </script>
@stop
