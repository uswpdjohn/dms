
</div>
</div>
</div>

</div>
<script src="{{asset('assets/fontawesome/js/all.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js" integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
{{--<script src="{{asset('assets/popperJs/popper.min.js')}}"></script>--}}
<script src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/jQuery/jquery.js')}}"></script>
<script src="{{asset('assets/jqueryUI/jquery-ui.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/select2/js/select2.min.js')}}"></script>
<script src="{{asset('assets/momentJS/moment.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/echarts/5.2.2/echarts.min.js"></script>
<script>
    $(document).ready(function () {
        if( window.location.pathname.split("/")[1] !== 'setup' ){
            localStorage.removeItem("activeTab");
        }
        // $('[data-toggle="tooltip"]').tooltip({
        //     placement: 'right'
        // })
        $('.tooltip-sidebar').tooltip({
            placement: 'right'
        })

    });

    function onDelete(e) {
        console.log(e.id)
        let slug = e.getAttribute('data-slug')
        document.getElementById('delForm-'+slug).setAttribute('action', e.id)
    }

    function userDelete(e){
        let url= "{{route('user.destroy', ':slug')}}"
        url = url.replace(':slug', e.id)

        let token =  $("meta[name='csrf-token']").attr("content");

        $.ajax({
            type: "DELETE",
            url: url,
            data: {
                'slug':e.id,
                "_token": token,
            },
            success: function(data) {
                if (data.success == 1){
                    $('.alert-text').text(data.message)

                    // window.location.reload()
                    // console.log(data.message)
                }

            },
            error: function(xhr){
                $('.error-text').text(data.message)
                // alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
            }
        });

    }

    function ucfirst(str,force){
        str=force ? str.toLowerCase() : str;
        return str.replace(/(\b)([a-zA-Z])/,
            function(firstLetter){
                return   firstLetter.toUpperCase();
            });
    }
    function markAsRead(key) {

        //for navbar
        let id = $('#'+key).attr('data-id')
        fetch(`mark-as-read/${id}`)
        {{--var url = "{{ route('mark.as.read', ':id') }}";--}}
        {{--url = url.replace(':id', id);--}}

        {{--var notificationIndexUrl = "{{ route('notification.index') }}"--}}
        {{--$.ajax({--}}
        {{--    type: "GET",--}}
        {{--    url: url,--}}
        {{--    success: function (obj) {--}}
        {{--        window.open(notificationIndexUrl, "_self")--}}
        {{--        // window.location.reload()--}}
        {{--    }--}}
        {{--})--}}
    }
    function getCompany(){
        let id=$( "select option:selected" ).val()
        var url = "{{ route('company-management.set-company', ':id') }}";
        url = url.replace(':id', id);
        $.ajax({
            type: "GET",
            url: url,
            success: function (obj) {
                console.log(obj)
                window.location.reload()
            }
        })
    }

    function hardRefresh() {
        const t = parseInt(Date.now() / 10000); //10s tics
        const x = localStorage.getItem("t");
        localStorage.setItem("t", t);

        if (x != t) location.reload(true) //force page refresh from server
        else { //refreshed from server within 10s
            const a = document.querySelectorAll("a, link, script, img")
            var n = a.length
            while(n--) {
                var tag = a[n]
                var url = new URL(tag.href || tag.src);
                url.searchParams.set('r', t.toString());
                tag.href = url.toString(); //a, link, ...
                tag.src = tag.href; //rerun script, refresh img
            }
        }
    }

    function snake2Pascal( str ){
        str +='';
        str = str.split('_');
        for(var i=0;i<str.length;i++){
            str[i] = str[i].slice(0,1).toUpperCase() + str[i].slice(1,str[i].length);
        }
        return str.join(' ');
    }
    function timeSince(date) {

        var seconds = Math.floor((new Date() - date) / 1000);

        var interval = seconds / 31536000;

        if (interval > 1) {
            return Math.floor(interval) + "y before";
        }
        interval = seconds / 2592000;
        if (interval > 1) {
            return Math.floor(interval) + "mo before";
        }
        interval = seconds / 86400;
        if (interval > 1) {
            return Math.floor(interval) + "d before";
        }
        interval = seconds / 3600;
        if (interval > 1) {
            return Math.floor(interval) + "h before";
        }
        interval = seconds / 60;
        if (interval > 1) {
            return Math.floor(interval) + "m before";
        }
        return Math.floor(seconds) + " seconds";
    }

    function numberWithCommas(n) {
        var parts=n.toString().split(".");
        return parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",") + (parts[1] ? "." + parts[1] : "");
    }


    // Validation For Restrict Taking Date
    var dtToday = new Date();

    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();
    if (month < 10)
        month = '0' + month.toString();
    if (day < 10)
        day = '0' + day.toString();

    var prepareDate = year + '-' + month + '-' + day;

    // Validation For Restrict Taking Past Date Only Take Future Date
    $('.take_future_date').attr('min', prepareDate);
    // Validation For Restrict Taking Past Date Only Take Future Date Ends

    // Validation For Restrict Taking Future Date Only Take Past Date
    $('.take_past_date').attr('max', prepareDate);
    // Validation For Restrict Taking Future Date Only Take Past Date Ends


</script>
@stack('customScripts')
</body>
</html>
