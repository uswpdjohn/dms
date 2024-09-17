<div id="esop-view-doc" class="tabcontent adminEsopTabContent esop-view-doc">
    <form action="#" id="esop-view-document">
        <input name="document_hashed_id" id="esopHashedDocId" value="" type="text" hidden/>
        <input name="document_id" id="esopDocId" value="" type="text" hidden/>
        <input name="category-name" value="Esop" type="text" hidden/>
        <div class="row ">
            <input name="category-name" value="Corporate Secretary" type="text" hidden/>
            <div class="col-sm-12 col-md-6">
                <fieldset class="form-group">
                    <label for="company_id" class="mb-2 mt-3">Company Name</label>
                    <p id="esop_company_id"></p>
                </fieldset>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="form-group">
                    <label for="title" class="mb-2 mt-3">Document Name</label>
                    <p id="esop_document_name" class=""></p>
                </div>
            </div>
            <br>
            <div class="col-sm-12 col-md-6">
                <label for="document-upload" class="custom-file-uploaded">
                    Your Document
                </label>
                <div class="row doc-div">
                    <p id="esop_file_name" class="col-8 col-lg-9 doc-title"></p>
                    <div class="btn-portion col-4 col-lg-3">
                        <a href="#" id="esop-doc-download-btn" class=" btn download-bth" data-id="">
                            <img src="{{asset('assets/icons/download-silver-icon.png')}}" alt="">
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="form-group">
                    <label for="title" class="mb-2 mt-3">Reminder</label>
                    <p id="esop_reminder_date" class=""></p>
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="form-group">
                    <label for="recipent_name" class="mb-2 mt-3">Name of Recipent</label>
                    <p id="esop_recipient_name" class=""></p>
                </div>
            </div>
            {{--                                    <div class="col-sm-12 col-md-6 mt-2">--}}
            {{--                                        <button type="button" class="btn admin-doc-create-submit-btn" hidden>Submit</button>--}}
            {{--                                    </div>--}}
        </div>
    </form>
</div>
@section('esopViewDataJs')
    <script>
        $('#esop-doc-download-btn').on('click', function () {
            let documentId = $(this).attr('data-id')
            let url = '{{route('download.individual.document', ':document_id')}}'
            url = url.replace(':document_id', documentId)
            $(this).attr('href', url)
        })
        function fetchEsopViewData(e) {
            let rawId = e
            let id = rawId.split('-')[1]

            // let directorWrapper = "#hr-view-director"
            // let shareholderWrapper = "#hr-view-shareholder"

            let document_id = id
            let url = '{{route('document.edit', ':document_id')}}'
            url = url.replace(':document_id', document_id)

            $.ajax({
                url: url,
                success: function (res) {
                    if (res.abort == 403) {
                        $('#esop-view-doc').addClass('d-none')
                        $("html, body").animate({scrollTop: 0});
                        $('#flashMessages').html(
                            `<div class="alert alert-success alert-access">
                                <img class="alert-img" src="{{asset('assets/icons/mailbody-!.png')}}" alt="">
                                <p class="alert-text">Oops! You do not have access to view the document.</p>
                            </div>`
                        )
                    } else {
                        $('#esop_company_id').text(res[0].companies.name)
                        $('#esop_document_name').text(res[0].name)
                        $('#esop_file_name').text(res[0].file)
                        $('#esop_reminder_date').text($.esopDate(res[0].reminder_date))
                        $('#esop_recipient_name').text(res[0].recipient_name)

                        $('#esopDocId').attr('value', res[0].id)
                        $('#esopHashedDocId').attr('value', res[0].document_id)
                        $('#esop-doc-download-btn').attr('data-id', res[0].document_id)
                    }
                }
            });
        }
        const fullMonthForEsopDocument = ["Jan","Feb","Mar","Apr","May","June","Jul","Aug","Sept","Oct","Nov","Dec"];
        $.esopDate = function(dateObject) {
            var d = new Date(dateObject);
            var day = d.getDate();
            var month = fullMonthForEsopDocument[d.getMonth()];
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
    </script>
@stop
