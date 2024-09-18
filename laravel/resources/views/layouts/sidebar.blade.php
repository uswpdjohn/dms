<!-- Sidebar Start -->

<div class="col-1 col-sm-3 col-md-3 col-xl-2 px-0 sidebar min-vh-100">
    <div class="logo-part">
        <img class="logo-img" src="{{asset('assets/images/project-logo.jpeg')}}" alt="Logo">
    </div>
    <div class="item-part d-flex flex-column align-items-center align-items-sm-start">
        <!-- <a href="/" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
             <span class="fs-5 d-none d-sm-inline">Menu</span>
            <img src="../../assets/images/goa-logo.jpg" alt="Logo">
        </a> -->
        <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start pt-2" id="menu">
            @if(!auth()->user()->hasRole('General User'))
            <li class="nav-item {{(request()->segment(1) == 'dashboard' ? 'active' : '')}}">
                <a href="{{route('dashboard')}}" class="nav-link align-middle px-0">
                    <img class="sidebar-icons" src="{{asset('assets/icons/dashboard-icon.png')}}" alt=""> <span class="ms-1 d-none d-sm-inline">Dashboard</span>
                </a>
            </li>
            @endif
            @role('Company Owner')
{{--                <li class="nav-item {{(request()->segment(1) == 'dashboard' ? 'active' : '')}}">--}}
{{--                    <a href="{{route('dashboard')}}" class="nav-link align-middle px-0">--}}
{{--                        <img class="sidebar-icons" src="{{asset('assets/icons/dashboard-icon.png')}}" alt=""> <span class="ms-1 d-none d-sm-inline">Dashboard</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
                <li class="nav-item {{(request()->segment(1) == 'mail' ? 'active' : '')}}">
                    <a href="{{route('mail.admin.index')}}" class="nav-link px-0 align-middle">
                        <img class="sidebar-icons" src="{{asset('assets/icons/mailbox-capital-icon.png')}}" alt=""> <span class="ms-1 d-none d-sm-inline">Mailbox</span>
                        @if(auth()->user()->unreadNotifications()->where('type','App\Notifications\MailboxNotification')->first() != null)
                            <i class="fa-solid fa-circle"></i>
                        @endif </a>
                </li>
                <li class="nav-item {{(request()->segment(1) == 'company' ? 'active' : '')}}">
                    <a href="{{route('company.index')}}" class="nav-link px-0 align-middle">
                        <img class="sidebar-icons bb-icon" src="{{asset('assets/icons/bussiness-info-icon.png')}}" alt=""> <span class="ms-1 d-none d-sm-inline">Company Management</span> </a>
                </li>
                <li class="nav-item {{(request()->segment(1) == 'document-management' ? 'active' : '')}}">
                    <a href="{{route('document-management.index')}}" class="nav-link px-0 align-middle">
                        <img class="sidebar-icons" src="{{asset('assets/icons/ctahce-icon.png')}}" alt=""> <span class="ms-1 d-none d-sm-inline">Document Management</span> </a>
                </li>
                <li class="nav-item {{(request()->segment(1) == 'user' ? 'active' : '')}}">
                    <a href="{{route('user.index')}}" class="nav-link px-0 align-middle">
                        <img class="sidebar-icons" src="{{asset('assets/icons/user-management-icon.png')}}" alt=""> <span class="ms-1 d-none d-sm-inline">User Management</span> </a>
                </li>
                <li class="nav-item {{(request()->segment(1) == 'support-ticket' ? 'active' : '')}} || {{(request()->segment(1) == 'ticket' ? 'active' : '')}}">
                    <a href="{{route('admin.support.ticket')}}" class="nav-link px-0 align-middle">
                        <img class="sidebar-icons" src="{{asset('assets/icons/support-ticket-icon.png')}}" alt=""> <span class="ms-1 d-none d-sm-inline">Support Ticket</span>
                        @if(auth()->user()->unreadNotifications()->where('type', 'App\Notifications\TicketAdminNotification')->first() != null)
                            <i class="fa-solid fa-circle"></i>
                        @endif
                    </a>
                </li>
                <li class="nav-item {{(request()->segment(1) == 'setup' ? 'active' : '')}}">
                    <a href="{{route('setup.index')}}" class="nav-link px-0 align-middle">
                        <img class="sidebar-icons" src="{{asset('assets/icons/setup-icon.png')}}" alt=""> <span class="ms-1 d-none d-sm-inline">Setup</span>
                    </a>
                </li>
            @endrole


            {{--Defining a Super-Admin--}}
            @role('Super Admin')
                <li class="nav-item {{(request()->segment(1) == 'company' ? 'active' : '')}}">
                    <a href="{{route('company.index')}}" class="nav-link px-0 align-middle">
                        <img class="sidebar-icons bb-icon" src="{{asset('assets/icons/bussiness-info-icon.png')}}" alt=""> <span class="ms-1 d-none d-sm-inline">Company Management</span> </a>
                </li>
                <li class="nav-item {{(request()->segment(1) == 'mail' ? 'active' : '')}}">
                    <a href="{{route('mail.admin.index')}}" class="nav-link px-0 align-middle">
                        <img class="sidebar-icons" src="{{asset('assets/icons/mailbox-capital-icon.png')}}" alt=""> <span class="ms-1 d-none d-sm-inline">Mailbox</span>
                        @if(auth()->user()->unreadNotifications()->where('type','App\Notifications\MailboxNotification')->first() != null)
                            <i class="fa-solid fa-circle"></i>
                        @endif </a>
                </li>
                <li class="nav-item {{(request()->segment(1) == 'document-management' ? 'active' : '')}}">
                    <a href="{{route('document-management.index')}}" class="nav-link px-0 align-middle">
                        <img class="sidebar-icons" src="{{asset('assets/icons/ctahce-icon.png')}}" alt=""> <span class="ms-1 d-none d-sm-inline">Document Management</span> </a>
                </li>
{{--                <li class="nav-item {{(request()->segment(1) == 'cap-table' || request()->segment(1) == 'cap-table-activity-entry-search' || request()->segment(1) == 'cap-table-members-search' ? 'active' : '' )}}">--}}
{{--                    <a href="{{route('cap-table.index')}}" class="nav-link px-0 align-middle">--}}
{{--                        <img class="sidebar-icons" src="{{asset('assets/icons/cap-table-icon.png')}}" alt=""> <span class="ms-1 d-none d-sm-inline">CAP Table</span> </a>--}}
{{--                </li>--}}
{{--                <li class="nav-item {{(request()->segment(1) == 'esop' ? 'active' : '')}}">--}}
{{--                    <a href="{{ route('esop.index') }}" class="nav-link px-0 align-middle">--}}
{{--                        <img class="sidebar-icons" src="{{asset('assets/icons/esop-icon.png')}}" alt> <span class="ms-1 d-none d-sm-inline">ESOP</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
                <li class="nav-item {{(request()->segment(1) == 'user' ? 'active' : '')}}">
                    <a href="{{route('user.index')}}" class="nav-link px-0 align-middle">
                        <img class="sidebar-icons" src="{{asset('assets/icons/user-management-icon.png')}}" alt=""> <span class="ms-1 d-none d-sm-inline">User Management</span> </a>
                </li>
                <li class="nav-item {{(request()->segment(1) == 'support-ticket' ? 'active' : '')}} || {{(request()->segment(1) == 'ticket' ? 'active' : '')}}">
                    <a href="{{route('admin.support.ticket')}}" class="nav-link px-0 align-middle">
                        <img class="sidebar-icons" src="{{asset('assets/icons/support-ticket-icon.png')}}" alt=""> <span class="ms-1 d-none d-sm-inline">Support Ticket</span>
                        @if(auth()->user()->unreadNotifications()->where('type', 'App\Notifications\TicketAdminNotification')->first() != null)
                            <i class="fa-solid fa-circle"></i>
                        @endif
                    </a>
                </li>
                <li class="nav-item {{(request()->segment(1) == 'setup' ? 'active' : '')}}">
                    <a href="{{route('setup.index')}}" class="nav-link px-0 align-middle">
                        <img class="sidebar-icons" src="{{asset('assets/icons/setup-icon.png')}}" alt=""> <span class="ms-1 d-none d-sm-inline">Setup</span>
                    </a>
                </li>
            @endrole
            @role('Company User')
                <li class="nav-item {{(request()->segment(1) == 'mail' ? 'active' : '')}}">
                    <a href="{{route('mail.index')}}" class="nav-link px-0 align-middle">
                        <img class="sidebar-icons" src="{{asset('assets/icons/mailbox-capital-icon.png')}}" alt=""> <span class="ms-1 d-none d-sm-inline">Mailbox</span>
                        @if(auth()->user()->unreadNotifications()->where('type','App\Notifications\MailboxNotification')->first() != null)
                            <i class="fa-solid fa-circle"></i>
                        @endif
                    </a>
                </li>
                <li class="nav-item {{(request()->segment(3) == '1' ? 'active' : '')}}">
                    <a href="{{route('documentManagement.customer', 1)}}" class="nav-link px-0 align-middle">
                        <img class="sidebar-icons" src="{{asset('assets/icons/ctahce-icon.png')}}" alt=""> <span class="ms-1 d-none d-sm-inline">Corporate Secretary</span> </a>
                </li>
                <li class="nav-item {{(request()->segment(3) == '2' ? 'active' : '')}}">
                    <a href="{{route('documentManagement.customer',2)}}" class="nav-link px-0 align-middle">
                        <img class="sidebar-icons" src="{{asset('assets/icons/ctahce-icon.png')}}" alt=""> <span class="ms-1 d-none d-sm-inline">Tax</span> </a>
                </li>
                <li class="nav-item {{(request()->segment(3) == '3' ? 'active' : '')}}">
                    <a href="{{route('documentManagement.customer',3)}}" class="nav-link px-0 align-middle">
                        <img class="sidebar-icons" src="{{asset('assets/icons/ctahce-icon.png')}}" alt=""> <span class="ms-1 d-none d-sm-inline">Accounting</span> </a>
                </li>
                <li class="nav-item {{(request()->segment(3) == '4' ? 'active' : '')}}">
                    <a href="{{route('documentManagement.customer',4)}}" class="nav-link px-0 align-middle">
                        <img class="sidebar-icons" src="{{asset('assets/icons/ctahce-icon.png')}}" alt=""> <span class="ms-1 d-none d-sm-inline">Human Resource</span> </a>
                </li>

            @endrole
            @role('Employee')
            <li class="nav-item {{(request()->segment(1) == 'company' ? 'active' : '')}}">
                <a href="{{route('company.index')}}" class="nav-link px-0 align-middle">
                    <img class="sidebar-icons bb-icon" src="{{asset('assets/icons/bussiness-info-icon.png')}}" alt=""> <span class="ms-1 d-none d-sm-inline">Company Management</span> </a>
            </li>
            <li class="nav-item {{(request()->segment(1) == 'mail' ? 'active' : '')}}">
                <a href="{{route('mail.admin.index')}}" class="nav-link px-0 align-middle">
                    <img class="sidebar-icons" src="{{asset('assets/icons/mailbox-capital-icon.png')}}" alt=""> <span class="ms-1 d-none d-sm-inline">Mailbox</span>
                    @if(auth()->user()->unreadNotifications()->where('type','App\Notifications\MailboxNotification')->first() != null)
                        <i class="fa-solid fa-circle"></i>
                    @endif </a>
            </li>
            <li class="nav-item {{(request()->segment(1) == 'document-management' ? 'active' : '')}}">
                <a href="{{route('document-management.index')}}" class="nav-link px-0 align-middle">
                    <img class="sidebar-icons" src="{{asset('assets/icons/ctahce-icon.png')}}" alt=""> <span class="ms-1 d-none d-sm-inline">Document Management</span> </a>
            </li>

{{--            <li class="nav-item {{(request()->segment(1) == 'cap-table' || request()->segment(1) == 'cap-table-activity-entry-search'   ? 'active' : '')}}">--}}
{{--                <a href="{{route('cap-table.index')}}" class="nav-link px-0 align-middle">--}}
{{--                    <img class="sidebar-icons" src="{{asset('assets/icons/cap-table-icon.png')}}" alt=""> <span class="ms-1 d-none d-sm-inline">CAP Table</span> </a>--}}
{{--            </li>--}}
            <li class="nav-item {{(request()->segment(1) == 'user' ? 'active' : '')}}">
                <a href="{{route('user.index')}}" class="nav-link px-0 align-middle">
                    <img class="sidebar-icons" src="{{asset('assets/icons/user-management-icon.png')}}" alt=""> <span class="ms-1 d-none d-sm-inline">User Management</span> </a>
            </li>
            <li class="nav-item {{(request()->segment(1) == 'support-ticket' ? 'active' : '')}}">
                <a href="{{route('admin.support.ticket')}}" class="nav-link px-0 align-middle">
                    <img class="sidebar-icons" src="{{asset('assets/icons/support-ticket-icon.png')}}" alt=""> <span class="ms-1 d-none d-sm-inline">Support Ticket</span>
                    @if(auth()->user()->unreadNotifications()->where('type', 'App\Notifications\TicketAdminNotification')->first() != null)
                        <i class="fa-solid fa-circle"></i>
                    @endif
                </a>
            </li>
            <li class="nav-item {{(request()->segment(1) == 'setup' ? 'active' : '')}}">
                <a href="{{route('setup.index')}}" class="nav-link px-0 align-middle">
                    <img class="sidebar-icons" src="{{asset('assets/icons/setup-icon.png')}}" alt=""> <span class="ms-1 d-none d-sm-inline">Setup</span>
                </a>
            </li>

            @endrole
            @role('General User')
                <li class="nav-item {{(request()->segment(1) == 'document-management' ? 'active' : '')}}">
                    <a href="{{route('document-management.index')}}" class="nav-link px-0 align-middle">
                        <img class="sidebar-icons" src="{{asset('assets/icons/ctahce-icon.png')}}" alt=""> <span class="ms-1 d-none d-sm-inline">Document Management</span> </a>
                </li>
            @endrole

        </ul>
        @if(!auth()->user()->hasRole('Company User'))
        <div class="class-name" style="margin-top: 51px;width: 100%;height: 1px;background-color: #ffffff;opacity: 0.5;"></div>
        <div style="padding: 10px;color: skyblue;">Supporting Tools</div>
        <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start pt-2" id="menu">
            <li class="nav-item ">
                <a href="#" class="nav-link align-middle px-0">
                    <i class="fa-regular fa-circle-dot" style="margin-right: 13px;"></i>Tool 1</span>
                </a>
            </li><li class="nav-item ">
                <a href="#" class="nav-link align-middle px-0">
                    <i class="fa-regular fa-circle-dot" style="margin-right: 13px;"></i>Tool 2</span>
                </a>
            </li><li class="nav-item ">
                <a href="#" class="nav-link align-middle px-0">
                    <i class="fa-regular fa-circle-dot" style="margin-right: 13px;"></i>Tool 3</span>
                </a>
            </li>
        </ul>
        @endif

    </div>


</div>
<!-- Sidebar End -->
