@if(session()->has('success'))
    <div class="alert alert-success">
        <img class="alert-img" src="{{asset('assets/icons/success-alert-icon.png')}}" alt="">
        <p class="alert-text">{{session('success')}}</p>
    </div>
@endif
