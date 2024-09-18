{{--@php use Illuminate\Support\Facades\Session; @endphp--}}
<div class="col-11 col-sm-9 col-md-9 col-xl-10 px-0 nav-part">
    <!-- Top-Nav Start -->
    <nav class="navbar top-nav navbar-expand navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand nav-title" id="page-header" href="#">{{App\Helpers\Helper::determinePageHeading()['heading']}}</a>
            <div class="collapse navbar-collapse " id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item company-list-area">
                        @role('Company User')
                            @if(!auth()->user()->companies->isEmpty())
{{--                                @dd(\session()->get('auth_user_company')->id)--}}
                                <fieldset class="form-group input-group company-list">
                                    <select class="form-control form-select nav-select" name="company_id" onchange="getCompany()" id="service_id" required>
{{--                                        @dd(\session()->get('auth_user_company')->id)--}}
                                        @if(auth()->user())
                                            @foreach(auth()->user()->companies as $company)
{{--                                                <option class=""  value="{{$company->id}}" {{session()->get('auth_user_company')->id ==  $company->id ? 'selected' : ''}} >{{$company->name}}</option>--}}
                                                <option class=""  value="{{$company->id}}" {{App\Helpers\Helper::auth_user_company() ==  $company->id ? 'selected' : ''}} >{{$company->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </fieldset>
                            @endif
                        @endrole
                    </li>
                    <li class="nav-item dropdown  notifications">
                        <a class="nav-link dropdown-toggle" href="#" id="notificationDropdownMenuLink" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="notification-icon"><i class="fa-regular fa-bell bell-icon"></i></span>
                            @if(auth()->guard('web')->user() && count(auth()->user()->notifications->where('read_at',null )) > 0)
                                <span class="badge">{{count(auth()->user()->notifications->where('read_at',null))}}</span>
                            @endif
                        </a>


                        <ul class="dropdown-menu notification-menu" aria-labelledby="notificationDropdownMenuLink">
                            <li class="notification-upper">
                                <ul class="notifications-part">
                                    @if(auth()->guard('web')->user())
                                        @foreach(auth()->user()->notifications->take(5) as $key=>$notification)
                                            <li>
                                                <a class="dropdown-item notification-body mark"
                                                   onclick="markAsRead({{$key}})" id="{{$key}}"
                                                   data-id="{{$notification['id']}}" href="{{route('notification.index')}}">
                                                    @if($notification['read_at'] != null)
                                                        <p class="notification-text"
                                                           style="color: #777777; font-weight: 400;">{{$notification['data']['notification']}}</p>
                                                    @else
                                                        <p class="notification-text"
                                                           style="color:#000000;font-weight: 400;">{{$notification['data']['notification']}}</p>
                                                    @endif
                                                    <p class="notification-time">{{$notification['created_at']->diffForHumans()}}</p>
                                                </a>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </li>
                            <li class="notification-footer">
                                <a href="{{route('notification.index')}}">See All Notification</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item profile-image">
                        <img class="pro-img" src="{{asset('assets/images/user01.jpg')}}" alt="Logo">
                    </li>
                    <li class="nav-item dropdown profile-portion">
                        <a class="nav-link dropdown-toggle profile-dropdown" href="#" id="profileDropdownMenuLink"
                           role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <span id="profilename">{{Auth::user()->full_name}}</span>
                            <span class="down-icon"><i class="fa-solid fa-chevron-down"></i></span>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="profileDropdownMenuLink">
                            <li><a class="dropdown-item" href="{{route('admin.support.ticket')}}">Tickets Submitted</a></li>
                            <li><a class="dropdown-item" href="#">Settings</a></li>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();localStorage.clear();document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
{{--    <!-- Top-Nav End -->--}}




