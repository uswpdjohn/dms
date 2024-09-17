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
            <li class="nav-item {{(request()->segment(1) == 'dashboard' ? 'active' : '')}}">
                <a href="{{route('dashboard')}}" class="nav-link align-middle px-0">
                    <img class="sidebar-icons" src="{{asset('assets/icons/dashboard-icon.png')}}" alt=""> <span class="ms-1 d-none d-sm-inline">Dashboard</span>
                </a>
            </li>
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
{{--                <li class="nav-item {{(request()->segment(1) == 'billing' ? 'active' : '')}}">--}}
{{--                    <a href="{{route('billing.index')}}" class="nav-link px-0 align-middle">--}}
{{--                        <img class="sidebar-icons" src="{{asset('assets/icons/billing-icon.png')}}" alt=""> <span class="ms-1 d-none d-sm-inline">Billing</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
                <li class="nav-item {{(request()->segment(1) == 'setup' ? 'active' : '')}}">
                    <a href="{{route('setup.index')}}" class="nav-link px-0 align-middle">
                        <img class="sidebar-icons" src="{{asset('assets/icons/setup-icon.png')}}" alt=""> <span class="ms-1 d-none d-sm-inline">Setup</span>
                    </a>
                </li>

{{--                @if(\App\Helpers\Helper::checkIfXeroIsExpiring()['message'] != '')--}}
{{--                    <div class="footer-part">--}}
{{--                        <p class="nav-link px-0 align-middle">--}}
{{--                            <i class="fa-solid fa-bell {{\App\Helpers\Helper::checkIfXeroIsExpiring()['message'] == 'Xero is Expired' ? 'text-danger' : ''}}"></i> <span class="ms-1 d-none d-sm-inline {{\App\Helpers\Helper::checkIfXeroIsExpiring()['message'] == 'Xero is Expired' ? 'text-danger' : ''}} ">{{\App\Helpers\Helper::checkIfXeroIsExpiring()['message']}}--}}
{{--                            @if(\App\Helpers\Helper::checkIfXeroIsExpiring()['days to expire'] > 0)--}}
{{--                                </span><br><span style="margin-left: 20px">You have {{\App\Helpers\Helper::checkIfXeroIsExpiring()['days to expire']}} days left</span>--}}
{{--                            @endif--}}
{{--                            <a href="{{route('authorize')}}" class="tooltip-sidebar" data-toggle="tooltip" title="Connect to Xero">--}}
{{--                                <svg fill="#0d6efd" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"--}}
{{--                                     width="18px" height="18px" viewBox="0 0 484.566 484.566"--}}
{{--                                     xml:space="preserve">--}}
{{--                                    <g>--}}
{{--                                        <g>--}}
{{--                                            <path fill="#0d6efd" d="M360.342,216.266L219.373,113.882c-9.783-7.106-22.723-8.121-33.498-2.63c-10.771,5.49-17.556,16.559-17.556,28.65V344.67--}}
{{--                                                c0,12.092,6.784,23.158,17.556,28.646c4.61,2.348,9.611,3.506,14.6,3.506c6.666,0,13.301-2.07,18.898-6.138l140.969-102.383--}}
{{--                                                c8.33-6.047,13.256-15.719,13.256-26.018C373.598,231.988,368.672,222.312,360.342,216.266z"/>--}}
{{--                                            <path d="M242.285,0C108.688,0,0.004,108.689,0.004,242.283c0,133.592,108.686,242.283,242.281,242.283--}}
{{--                                                c133.594,0,242.278-108.691,242.278-242.283C484.562,108.689,375.881,0,242.285,0z M242.285,425.027--}}
{{--                                                c-100.764,0-182.744-81.979-182.744-182.744c0-100.766,81.98-182.742,182.744-182.742s182.745,81.976,182.745,182.742--}}
{{--                                                C425.029,343.049,343.049,425.027,242.285,425.027z"/>--}}
{{--                                        </g>--}}
{{--                                    </g>--}}
{{--                                </svg>--}}
{{--                            </a>--}}
{{--                        </p>--}}
{{--                    </div>--}}
{{--                @endif--}}

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
{{--                <li class="nav-item {{(request()->segment(1) == 'cap-table' ? 'active' : '') || request()->segment(1) == 'cap-table-activity-entry-search' ? 'active' : ''}}">--}}
{{--                    <a href="{{route('cap-table.index')}}" class="nav-link px-0 align-middle">--}}
{{--                        <img class="sidebar-icons" src="{{asset('assets/icons/cap-table-icon.png')}}" alt=""> <span class="ms-1 d-none d-sm-inline">CAP Table</span> </a>--}}
{{--                </li>--}}
{{--                <li class="nav-item {{(request()->segment(1) == 'esop' ? 'active' : '')}}">--}}
{{--                    <a href="{{route('esop.index')}}" class="nav-link px-0 align-middle">--}}
{{--                        <img class="sidebar-icons" src="{{asset('assets/icons/ctahce-icon.png')}}" alt=""> <span class="ms-1 d-none d-sm-inline">ESOP</span> </a>--}}
{{--                </li>--}}
{{--                <li class="nav-item {{(request()->segment(1) == 'billing' ? 'active' : '')}}">--}}
{{--                    <a href="{{route('billing.index')}}" class="nav-link px-0 align-middle">--}}
{{--                        <img class="sidebar-icons" src="{{asset('assets/icons/billing-icon.png')}}" alt=""> <span class="ms-1 d-none d-sm-inline">Billing</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="nav-item {{(request()->segment(1) == 'customer-support' ? 'active' : '')}}">--}}
{{--                    <a href="{{route('customer-support.index')}}" class="nav-link px-0 align-middle">--}}
{{--                        <img class="sidebar-icons" src="{{asset('assets/icons/cus-support-icon.png')}}" alt=""> <span class="ms-1 d-none d-sm-inline">Customer Support</span>--}}
{{--                    </a>--}}
{{--                </li>--}}

{{--            @if(\App\Helpers\Helper::subscriptionAlert() !=null)--}}
{{--                @if( \App\Helpers\Helper::subscriptionAlert()['message'] == 'Subscription Expiring Soon')--}}
{{--                    <div class="footer-part">--}}
{{--                        <p class="nav-link px-0 align-middle">--}}
{{--                            <img class="expire-icon" src="{{asset('assets/icons/subscription-alert-icon.png')}}" alt=""> <span class="ms-1 d-none d-sm-inline">{{\App\Helpers\Helper::subscriptionAlert()['message']}}</span> </p>--}}
{{--                    </div>--}}
{{--                @elseif(\App\Helpers\Helper::subscriptionAlert()['message'] == 'Subscription Ended. Pending payment')--}}
{{--                    <div class="footer-part">--}}
{{--                        <p class="nav-link expired px-0 align-middle">--}}
{{--                            <img class="expire-icon" src="{{asset('assets/icons/subscription-alert-icon.png')}}" alt="">--}}
{{--                            <span class=" d-none d-sm-inline">{{explode(".", \App\Helpers\Helper::subscriptionAlert()['message'])[0]}}.</span><br>--}}
{{--                            <span class="ms-4 d-none d-sm-inline">{{explode(".", \App\Helpers\Helper::subscriptionAlert()['message'])[1]}}</span></p>--}}
{{--                    </div>--}}
{{--                @else--}}
{{--                    <div class="footer-part"></div>--}}
{{--                @endif--}}
{{--            @endif--}}
{{--            @if(\App\Helpers\Helper::agmAlert() != null)--}}
{{--                <div class="footer-part">--}}
{{--                    <p class="nav-link px-0 align-middle">--}}
{{--                        <i class="fa-solid fa-bell"></i> <span class="ms-1 d-none d-sm-inline">{{\App\Helpers\Helper::agmAlert()['agm_alert_message']}}</span> </p>--}}
{{--                </div>--}}
{{--            @endif--}}

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
{{--            <li class="nav-item {{(request()->segment(1) == 'billing' ? 'active' : '')}}">--}}
{{--                <a href="{{route('billing.index')}}" class="nav-link px-0 align-middle">--}}
{{--                    <img class="sidebar-icons" src="{{asset('assets/icons/billing-icon.png')}}" alt=""> <span class="ms-1 d-none d-sm-inline">Billing</span>--}}
{{--                </a>--}}
{{--            </li>--}}
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
    </div>
</div>
<!-- Sidebar End -->
