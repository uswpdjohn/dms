<div id="esop" class="tabcontent adminEsopTabContent documents">
    <div class="select-pagination-portion table-top-portion row g-0">
        <div class="sb-part search-box-part col-12 col-md-4 offset-lg-1 col-lg-5">
            <div class="d-flex form-inputs search-data">
                <input class="form-control" id="esop-search-value" name="esop-search" type="text" placeholder="Document Name">
                <input class="form-control" name="service_id" id="esop-service-id" value="5" type="text" hidden>
                <button type="button" onclick="EsopSearchDocument()" class="search-btn btn"><i class="fa-solid fa-search"></i></button>
            </div>
        </div>
        <div class="button-part col-12 col-md-8 col-lg-7">
            <button type="button" class="btn download-btn action-buttons active" onclick="adminDocCreateTab(event,'esop-create-doc')">Create</button>
        </div>
    </div>
    <div class="mb-2">Current Selection: <b class="esop-current-company-selection"></b></div>
    <div class="table-responsive">
        <div class="esop-table-manage-body">
            <div class="table-rows docs row g-0">
                <div class="col-4 col-md-4 header-div">
                    <span>Company Name</span>
                </div>
                <div class="col-4 col-md-4 header-div">
                    <span>Document Title</span>
                </div>
                <div class="col-2 col-md-2 header-div status-header">
                    <span>Status</span>
                </div>
                <div class="col-2 col-md-2 header-div">
                    <span>Action</span>
                </div>
            </div>
            <div id="esop-table"></div>
            <!-- Main Row Starts -->
{{--            <div class="table-rows docs row g-0">--}}
{{--                <div class="col-4 col-md-4 name-div">--}}
{{--                    <span>Trillion Company Pte Ltd</span>--}}
{{--                </div>--}}
{{--                <div class="col-4 col-md-4 document-div">--}}
{{--                    <p class="">Corporate Secretary Document #5421324</p>--}}
{{--                </div>--}}
{{--                <div class="col-2 col-md-2 status-div">--}}
{{--                    <p name="doc-status" class="doc-status">Pending</p>--}}
{{--                </div>--}}
{{--                <div class="col-2 col-md-2 action-div">--}}
{{--                    <a href="#" onclick="adminDocCreateTab(event,'esop-view-doc')" class="action-buttons">View</a>--}}
{{--                    <a href="#" class="action-buttons delete-btn" data-bs-toggle="modal" data-bs-target="#entriesDeleteModal">Delete</a>--}}
{{--                </div>--}}
{{--            </div>--}}
            <!-- Main Row Ends -->

        </div>
    </div>
    <div class="select-pagination-portion table-bottom-portion row g-0">
        <div class="pagination-part bottom-pagination-part col-4 col-md-5 col-lg-4">
            <a data-href="" class="btn esop-data" id="esop-left-arrow"><i class="fa-solid fa-chevron-left"></i></a>
            <span class="pagination-number pagination-left-number" id="esop-left-number"></span>
            <span class="pagination-divider">/</span>
            <span class="pagination-number pagination-right-number" id="esop-right-number"></span>
            <a data-href="" class="btn esop-data" id="esop-right-arrow"><i class="fa-solid fa-chevron-right"></i></a>
        </div>
    </div>
</div>
@section('esopDocumentTableJs')
    <script>
        let url=''
        $('#esop-left-arrow').on('click', function () {
            console.log($(this).attr('data-href'))

            if ($(this).attr('data-href') != '') {

                let companyId=$('#esop-company').val()
                var page = $(this).attr('data-href').split('page=')[1];
                var searchParam = $(this).attr('data-href').split('?')[0].split('/')[5]

                 if ($(this).hasClass('esop-data') == true) {
                    // let category=$(this).attr('data-href').split('?')[0].split('/')[5]
                     url = "fetch-esop-document/" + 5 + "/"+ companyId+ "?page="
                } else if ($(this).hasClass('esop-search') == true) {
                     url = "esop-search/" + 5 + "/" + searchParam + '/' + companyId + "?page="
                }

                esop_fetch_data(page);
            }
        })
        $('#esop-right-arrow').on('click', function () {

            if ($(this).attr('data-href') != '') {
                let companyId=$('#esop-company').val()
                var page = $(this).attr('data-href').split('page=')[1];
                var searchParam = $(this).attr('data-href').split('?')[0].split('/')[5]

                 if ($(this).hasClass('esop-data') == true) {
                    // let category=$(this).attr('data-href').split('?')[0].split('/')[5]
                    url = "fetch-esop-document/" + 5 + "/"+ companyId+ "?page="
                } else if ($(this).hasClass('esop-search') == true) {
                    url = "esop-search/" + 5 + "/" + searchParam + '/' + companyId + "?page="
                }

                esop_fetch_data(page);
            }

        })
        function esop_fetch_data(page) {
            let wrapper = "#esop-table"
            let left_number = ""
            let right_number = ""
            let left_arrow = ""
            let right_arrow = ""

            $.ajax({
                url: url + page,
                success: function (res) {

                    // console.log(tab)
                    determineEsopPaginationArrow(res, 'esop')
                    left_number = "#esop-left-number"
                    right_number = "#esop-right-number"
                    left_arrow = "#esop-left-arrow"
                    right_arrow = "#esop-right-arrow"

                    $(left_number).text(res.current_page)
                    $(right_number).text(res.last_page)

                    $(left_arrow).attr('data-href', res.prev_page_url)
                    $(right_arrow).attr('data-href', res.next_page_url)

                    $(wrapper).html(res.data.map((item) =>
                        esopDomLoad(item)
                    ))

                    styleDocStatus()
                }
            });
        }


        function fetchEsopData() {
            let companyId=$('#esop-company').val()
            let wrapper = "#esop-table"
            let url = '{{route('esop.document.fetch', ['service_id'=> ':service_id', 'company_id' => ':company_id'])}}'
            url= url.replace(':company_id', companyId)
            url= url.replace(':service_id', 5)
            $.ajax({
                url: url,
                success: function (res) {
                    determineEsopPaginationArrow(res, 'esop')
                    $('#esop-left-number').text(res.current_page)
                    $('#esop-right-number').text(res.last_page)
                    $("#esop-left-arrow").attr('data-href', res.prev_page_url)
                    $("#esop-right-arrow").attr('data-href', res.next_page_url)
                    $('#esop-left-arrow').removeClass('esop-search')
                    $('#esop-right-arrow').removeClass('esop-search')
                    if (res.data.length > 0) {
                        $(wrapper).html(res.data.map((item) =>
                            esopDomLoad(item, res)
                        ))
                    } else {
                        $(wrapper).html(`<div class="docs row g-0">
                        <div class="col-12 col-md-12 col-lg-12 name-div text-center">
                            <span>No Data Available</span>
                        </div>`)
                    }

                    styleDocStatus()
                }
            });

        }
        function determineEsopPaginationArrow(res, tab) {

            let left_arrow = ""
            let right_arrow = ""
            if (tab == 'esop') {
                left_arrow = "#esop-left-arrow"
                right_arrow = "#esop-right-arrow"
            }
            if (res.current_page > 1) {
                if ($(left_arrow).hasClass("d-none") == true) {
                    $(left_arrow).removeClass('d-none')
                }
            } else {
                $(left_arrow).addClass('d-none')
            }
            if (res.current_page == res.last_page) {
                $(right_arrow).addClass('d-none')
            } else {
                $(right_arrow).removeClass('d-none')
            }
        }
        function esopDomLoad(item) {
            let delRoute = '{{route('esop.document.del', ':document_id')}}'
            delRoute = delRoute.replace(':document_id', item.id)

            return `<div class="table-rows docs row g-0">
                        <input type="text" value="${item.id}" id="doc_id" hidden>
                        <div class="col-4 col-md-4 name-div">
                            <span>${item.companies.name}</span>
                        </div>
                        <div class="col-4 col-md-4 document-div">
                            <p class="">${item.name}</p>
                        </div>
                        <div class="col-2 col-md-2 status-div">
                            <p name="doc-status" class="doc-status">${item.status[0].toUpperCase() + item.status.slice(1)}</p>
                        </div>
                        <div class="col-2 col-md-2 action-div">

                            <a href="#" id="esop-${item.id}" onclick="adminDocCreateTab(event,'esop-view-doc', this)" class="action-buttons">View</a>

                            <a href="#" id="${delRoute}" onclick="esopDel(this)" class="action-buttons delete-btn" data-bs-toggle="modal" data-bs-target="#esopDeleteModal-${item.id}">Delete</a>
                            <!-- Delete Modal Start -->
                            <form id="esopForm-${item.id}" method="POST">
                                {{csrf_field()}}
                                {{ method_field('DELETE') }}
                                <div class="modal fade" id="esopDeleteModal-${item.id}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="esopDeleteModalLabel" aria-hidden="true">
                                    <div class="modal-dialog delete-modal">
                                        <div class="modal-content">
                                            <div class="delete-modal-body">
                                                <p class="text-center">Confirm Delete</p>
                                                <div class="text-center">
                                                    <button type="button" class="btn btn-sm  delete-modal-close-btn" data-bs-dismiss="modal" aria-label="No">No</button>
                                                    <button type="submit" class="btn btn-sm yes-btn" data-id="esopDeleteModal-${item.id}" onclick="hideModal(this,'esopDeleteModal-${item.id}')">Yes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <!-- Delete Modal End -->
                        </div>
                    </div>`
        }
        function esopDel(e) {
            let buttonId = e.id
            let delFormId = buttonId.split('/')[4]
            document.getElementById('esopForm-' + delFormId).setAttribute('action', e.id)
        }
        function hideModal(e, modalId) {
            $('#' + modalId).modal('hide')
            // .parent().parent().parent().parent().parent('div')
        }
        //when esop search input is empty
        $('#esop-search-value').on('keyup', function () {
            if (this.value.length == 0) {
                EsopSearchDocument()
            }
        })
        function EsopSearchDocument() {
            let wrapper = "#esop-table"
            let search = $('#esop-search-value').val()
            let company_id = $('#esop-company').val()
            let url = ''
            if (search != '') {
                url = 'esop-search/5/' + search + '/' + company_id
            } else {
                url = 'esop-search/5/' + 0 + '/'+ company_id
            }
            //
            $.ajax({
                url: url,
                success: function (res) {
                    determineEsopPaginationArrow(res, 'esop')

                    $('#esop-left-number').text(res.current_page)
                    $('#esop-right-number').text(res.last_page)
                    $("#esop-left-arrow").attr('data-href', res.prev_page_url)
                    $("#esop-right-arrow").attr('data-href', res.next_page_url)

                    $('#esop-left-arrow').addClass('esop-search')
                    $('#esop-right-arrow').addClass('esop-search')

                    $('#esop-left-arrow').removeClass('esop-data')
                    $('#esop-right-arrow').removeClass('esop-data')
                    $('#esop-left-arrow').removeClass('esop-filter')
                    $('#esop-right-arrow').removeClass('esop-filter')
                    if (res.data.length > 0) {
                        $(wrapper).html(res.data.map((item) =>
                            esopDomLoad(item, res)
                        ))
                    } else {
                        $(wrapper).html(`<div class="docs row g-0">
                        <div class="col-12 col-md-12 col-lg-12 name-div text-center">
                            <span>No Data Available</span>
                        </div>`)
                    }
                    styleDocStatus()
                }
            });

        }
    </script>
@stop
