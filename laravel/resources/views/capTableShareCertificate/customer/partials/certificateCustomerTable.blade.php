<div class="select-pagination-portion table-top-portion row g-0">
    <div class="sb-part search-box-part col-12 col-md-4 offset-lg-1 col-lg-5">
        <div class="d-flex form-inputs search-data">
            <input class="form-control" type="text" placeholder=" Cert ID" id="share_certificate_customer_search"   value="{{request()->has('share_certificate_search') ? request()->get('share_certificate_search') : ''}}">
            <button type="button" class="search-btn btn" onclick="shareCertificateSearchActivity()"><i class="fa-solid fa-search"></i></button>
        </div>
    </div>
</div>
<div class="table-responsive">
    <div class="certificate-manage-body">
        <div class="certificate row g-0">
            <div class="col-2 col-md-2 col-lg-2 header-div">
                <span>Issue Date</span>
            </div>
            <div class="col-2 col-md-2 col-lg-2 header-div">
                <span>Cert Id</span>
            </div>
            <div class="col-2 col-md-2 col-lg-2 header-div">
                <span>Member</span>
            </div>
            <div class="col-2 col-md-2 col-lg-2 header-div member-div">
                <span>Status</span>
            </div>
            <div class="col-2 col-md-2 col-lg-2 header-div">
                <span>Number of Share</span>
            </div>
            <div class="col-2 col-md-2 col-lg-2 header-div action-div">
                <span>Action</span>
            </div>
        </div>
        <div id="shareCertificateCustomerTable"></div>
    </div>
</div>
<div id="shareCertificateCustomerPagination"></div>
@section('certificateCustomerTableJs')
    <script>
        $(document).on('click', '.pagination-part .cer-left-arrow', function () {
            let shareCertificateUrl=''
            if ($(this).attr('data-href') != '') {
                shareCertificateUrl=$(this).attr('data-href')
                share_certificate_fetch_data_customer(shareCertificateUrl);
            }
        })
        $(document).on('click', '.pagination-part .cer-right-arrow', function () {
            let shareCertificateUrl=''
            if ($(this).attr('data-href') != '') {
                shareCertificateUrl=$(this).attr('data-href')
                share_certificate_fetch_data_customer(shareCertificateUrl);
            }
        })
        function share_certificate_fetch_data_customer(url) {
            let pagination_wrapper= "#shareCertificatePagination"
            $.ajax({
                type: "GET",
                url: url,
                success: function (obj) {
                    $(pagination_wrapper).html(shareCertificateAppendPaginatorCustomer())
                    // determinePaginationArrow(obj)
                    shareCerDetermineCustomerPaginationArrow(obj)
                    $('#cer-left-number').text(obj.current_page)
                    $('#cer-right-number').text(obj.last_page)

                    $("#cer-left-arrow").attr('data-href', obj.prev_page_url)
                    $("#cer-right-arrow").attr('data-href', obj.next_page_url)
                    shareCertificateCustomerTableDomLoad(obj)
                }
            })
        }
        $('#share_certificate_customer_search').on('keyup', function () {
            if (this.value.length == 0) {
                fetchShareCertificateCustomerData()
            }
        })
        function shareCertificateSearchActivity() {
            let pagination_wrapper= "#shareCertificateCustomerPagination"
            let search = $('#share_certificate_customer_search').val()
            var url = "<?php echo e(route('share-certificate.index')); ?>";
            url = url.replace(':search', search);
            $.ajax({
                type: "GET",
                url: url,
                data:{
                    'search':search
                },
                success: function (obj) {
                    $(pagination_wrapper).html(shareCertificateAppendPaginatorCustomer())
                    shareCerDetermineCustomerPaginationArrow(obj)

                    $('#cer-left-number').text(obj.current_page)
                    $('#cer-right-number').text(obj.last_page)

                    $("#cer-left-arrow").attr('data-href', obj.prev_page_url)
                    $("#cer-right-arrow").attr('data-href', obj.next_page_url)
                    shareCertificateCustomerTableDomLoad(obj)
                }
            })
        }

        function fetchShareCertificateCustomerData() {
            let pagination_wrapper="#shareCertificateCustomerPagination"

            $.ajax({
                type:"GET",
                url:"{{route('share-certificate.index')}}",
                success: function (obj) {
                    shareCertificateCustomerTableDomLoad(obj)
                    $(pagination_wrapper).html(shareCertificateAppendPaginatorCustomer())
                    shareCerDetermineCustomerPaginationArrow(obj)
                    $('#cer-left-number').text(obj.current_page)
                    $('#cer-right-number').text(obj.last_page)
                    $("#cer-left-arrow").attr('data-href', obj.prev_page_url)
                    $("#cer-right-arrow").attr('data-href', obj.next_page_url)

                },
                error: function () {

                }
            })
        }
        function shareCertificateAppendPaginatorCustomer() {
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
        function shareCerDetermineCustomerPaginationArrow(obj) {
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
        function shareCertificateCustomerTableDomLoad(obj) {

            let wrapper="#shareCertificateCustomerTable"
            let html=''
            if(obj.data.length > 0){
                $.map(obj.data, function(item,i){
                    let downloadUrl=''
                    {{--downloadUrl="{{route('download.shareCertificate', ':document_id')}}"--}}
                    downloadUrl="{{route('shareCertificate.download', ':document_id')}}"
                    downloadUrl=downloadUrl.replace(':document_id', item.document_id)

//                     let viewStatusOptions = ''
//                     viewStatusOptions += `<option value="valid"  ${item.status == 'valid' ? 'selected' : " "}>Valid</option>`
//                     viewStatusOptions += `<option value="cancel"  ${item.status == 'cancel' ? 'selected' : " "}>Cancel</option>`
// console.log("#view-status-"+item.id)
                    // let viewShareTypeOptions = ''
                    // viewShareTypeOptions += `<option value="ordinary"  ${obj.certificate.share_type == 'ordinary' ? 'selected' : " "}>Ordinary</option>`
                    // viewShareTypeOptions += `<option value="preference"  ${obj.certificate.share_type == 'preference' ? 'selected' : " "}>Preference</option>`
                    //
                    // let viewCompanyMembers=''
                    // viewCompanyMembers += `<option value="">${obj.certificate.member.name}</option>`
                    //
                    // $("#view-status-"+item.id).empty().append(viewStatusOptions)
                    // $("#type-of-share-view").empty().append(shareTypeOptions)
                    // $("#certify-to-view").empty().append(companyMembers)

                    html+=  `<div class="certificate row g-0">
                                <div class="col-2 col-md-2 col-lg-2 document-div">
                                    <span>${$.customerTableDate(item.issue_date)}</span>
                                </div>
                                <div class="col-2 col-md-2 col-lg-2 document-div">
                                    <span>${item.share_certificate_id}</span>
                                </div>
                                <div class="col-2 col-md-2 col-lg-2 document-div member-div">
                                    <span>${item.member.name}</span>
                                </div>
                                <div class="col-2 col-md-2 col-lg-2 document-div ">
                                    <span class="status-data">${ucwords(item.status)}</span>
                                </div>

                                <div class="col-2 col-md-2 col-lg-2 document-div">
                                    <span>${addCommas(item.share_number)}</span>
                                </div>
                                <div class="col-2 col-md-2 col-lg-2 action-div">
                                    <a href="#" class="action-buttons" data-bs-toggle="modal" data-id="${item.id}" data-bs-target="#certificateViewModal-${item.share_certificate_id}">View</a>
                                    <div class="modal fade" id="certificateViewModal-${item.share_certificate_id}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="certificateViewModalLabel" aria-hidden="true">
                                    <div class="modal-dialog certificate-view-modal">
                                        <div class="modal-content">
                                            <div class="certificate-view-modal-body">
                                                <div class="certificate-view-modal-header row">
                                                    <h5 class="modal-title col-11" id="certificateViewModalLabel">View Share Certificate</h5>
                                                    <button type="button" class="btn btn-close btn-sm certificate-view-modal-close-btn col-1" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="certificate-view-modal-data row">
                                                    <form action="#">
                                                        <div class="data-body row">
                                                           <div class="data-row col-6">
                                                                <label for=""><span class="required-sign">*</span>Status</label>
                                                                <select class="form-control form-select select-data" disabled>
                                                                    <option value="valid"  ${item.status == 'valid' ? 'selected' : " "}>Valid</option>
                                                                    <option value="cancel"  ${item.status == 'cancel' ? 'selected' : " "}>Cancel</option>
                                                                </select>
                                                            </div>
                                                            <div class="data-row col-6">
                                                            </div>
                                                            <div class="data-row col-6">
                                                                <label for=""><span class="required-sign">*</span>Type of Share</label>
                                                                 <select class="form-control form-select select-data " name="status" disabled>
                                                                    <option value="ordinary"  ${item.share_type == 'ordinary' ? 'selected' : " "}>Ordinary</option>
                                                                    <option value="preference"  ${item.share_type == 'preference' ? 'selected' : " "}>Preference</option>
                                                                </select>
                                                            </div>
                                                            <div class="data-row col-6">
                                                                <label for=""><span class="required-sign">*</span>Share Certificate ID</label>
                                                                <input class="entry-data" type="text" value="${item.share_certificate_id}" disabled>
                                                            </div>
                                                            <div class="data-row fye-row col-6 col-md-6">
                                                                <label for=""><span class="required-sign">*</span>Issue Date</label>
                                                                <input class="entry-data" type="text" value="${$.customerTableDate(item.issue_date)}" disabled>
                                                            </div>
                                                            <div class="data-row col-6 col-md-6">
                                                                <label for=""><span class="required-sign">*</span>Company Name</label>
                                                                <input class="entry-data" type="text" value="${item.company.name}" disabled>
                                                            </div>
                                                            <div class="data-row col-6 col-md-6">
                                                                <label for=""><span class="required-sign">*</span>Company Registration No</label>
                                                                <input class="entry-data" type="text" value="${item.company.uen}" disabled>
                                                            </div>
                                                            <div class="data-row fye-row col-6 col-md-6">
                                                                <label for=""><span class="required-sign">*</span>Incorporation Date</label>
                                                                <input class="entry-data" type="text" value="${$.customerTableDate(item.company.incorporation_date)}" disabled>
                                                            </div>
                                                            <div class="data-row col-12 col-md-12">
                                                                <label for=""><span class="required-sign">*</span>Registered Office (Address Line)</label>
                                                                <input class="entry-data" type="text" value="${item.company_address_line}" disabled>
                                                            </div>
                                                            <div class="data-row col-6 col-md-6">
                                                                <label for=""><span class="required-sign">*</span>Registered Office (Country)</label>
                                                                <input class="entry-data" type="text" value="${ucwords(item.company_country)}" disabled>
                                                            </div>
                                                            <div class="data-row col-6 col-md-6">
                                                                <label for=""><span class="required-sign">*</span>Registered Office (Postal Code)</label>
                                                                <input class="entry-data" type="text" value="${item.company_postal_code}" disabled>
                                                            </div>
                                                            <div class="data-row col-6">
                                                                <label for=""><span class="required-sign">*</span>Certify to</label>
                                                                <input class="entry-data" type="text" value="${item.member.name}" disabled>
                                                            </div>
                                                            <div class="data-row col-6">
                                                                <label for=""><span class="required-sign">*</span>Number of Shares</label>
                                                                <input class="entry-data" type="text" value="${item.share_number}" disabled>
                                                            </div>
                                                            <div class="data-row col-6 col-md-6">
                                                                <label for=""><span class="required-sign">*</span>Address Line 1</label>
                                                                <input class="entry-data" type="text" value="${item.member_address_line[0]}" disabled>
                                                            </div>
                                                            <div class="data-row col-6 col-md-6">
                                                                <label for=""><span class="required-sign">*</span>Address Line 2</label>

                                                                <input class="entry-data" type="text" value="${(item.member_address_line[1] != null ? item.member_address_line[1] : null)}" disabled>
                                                            </div>
                                                            <div class="data-row col-6 col-md-6">
                                                                <label for=""><span class="required-sign">*</span>Country</label>
                                                                <input class="entry-data" type="text" value="${ucwords(item.member_country)}" disabled>
                                                            </div>
                                                            <div class="data-row col-6 col-md-6">
                                                                <label for=""><span class="required-sign">*</span>Postal Code</label>
                                                                <input class="entry-data" type="text" value="${item.member_postal_code} " disabled>
                                                            </div>
                                                            <div class="data-row fye-row col-12">
                                                                <label for="" ><span class="required-sign">*</span>Descriptions</label>
                                                                <input class="entry-data" type="text" value="${ucwords(item.description)}" disabled>
                                                            </div>
                                                            <div class="data-row col-12 text-end">
                                                                <a href="${downloadUrl}" class="download-pdf-btn btn" >Download PDF</a>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                </div>

                            </div>`
                })

                $(wrapper).empty().append(html)
                // styleSignStatus()
                styleCustomerCerStatus()
            }else {
                $(wrapper).html(`<div class="certificate row g-0">
            <div class="col-12 data-div text-center">
                <span class="text-danger">No Data Available</span>
            </div></div>`)
            }
        }

        function styleCustomerCerStatus() {
            var certStatus = document.getElementsByClassName("status-data");
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
        const fullMonthForCerList = ["Jan","Feb","Mar","Apr","May","June","Jul","Aug","Sept","Oct","Nov","Dec"];
        $.customerTableDate = function(dateObject) {
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
        function ucwords (str) {
            return (str + '').replace(/^([a-z])|\s+([a-z])/g, function ($1) {
                return $1.toUpperCase();
            });
        }
    </script>
@stop
