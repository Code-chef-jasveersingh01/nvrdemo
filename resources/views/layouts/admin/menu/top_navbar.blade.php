@php
    $notifications = [];
@endphp
<header id="page-topbar">
    <div class="layout-width">
        <div class="navbar-header">
            <div class="d-flex">
                <!-- LOGO -->
                <div class="navbar-brand-box horizontal-logo">
                    <a href="index" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="{{ URL::asset('assets/images/Group130.svg') }}" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="{{ URL::asset('assets/images/Group130.svg') }}" alt="" height="17">
                        </span>
                    </a>
                    <a href="index" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="{{ URL::asset('assets/images/Group130.svg') }}" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="{{ URL::asset('assets/images/Group130.svg') }}" alt="" height="17">
                        </span>
                    </a>
                </div>

                <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger" id="topnav-hamburger-icon">
                    <span class="hamburger-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </button>

                
            </div>

            <div class="d-flex align-items-center">

                <div class="dropdown ms-1 d-none topbar-head-dropdown header-item">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        @switch(Session::get('locale'))
                        @case('ar')
                            <img src="{{ URL::asset('/assets/images/flags/uae.svg') }}" class="rounded" alt="Header Language"
                                height="20">
                        @break
                       
                        @default
                            <img src="{{ URL::asset('/assets/images/flags/us.svg') }}" class="rounded" alt="Header Language" height="20">
                    @endswitch
                    </button>
                    <div class="dropdown-menu dropdown-menu-end d-none">

                        <!-- item-->
                        <a href="{{route('admin.changeLanguage',['lang'=>"en"])}}" class="dropdown-item notify-item language py-2" data-lang="en"
                            title="{{__('main.english')}}">
                            <img src="{{ URL::asset('assets/images/flags/us.svg') }}" alt="user-image" class="me-2 rounded" height="20" width="20">
                            <span class="align-middle">{{__('main.english')}}</span>
                        </a>

                        <!-- item-->
                        <a href="{{route('admin.changeLanguage',['lang'=>"ar"])}}" class="dropdown-item notify-item language" data-lang="ar"
                            title="{{__('main.arabic')}}">
                            <img src="{{ URL::asset('assets/images/flags/uae.svg') }}" alt="user-image" class="me-2 rounded" height="20" width="20">
                            <span class="align-middle">{{__('main.arabic')}}</span>
                        </a>

                        {{-- <!-- item-->
                        <a href="{{ url('index/gr') }}" class="dropdown-item notify-item language" data-lang="gr"
                            title="German">
                            <img src="{{ URL::asset('assets/images/flags/germany.svg') }}" alt="user-image" class="me-2 rounded"
                                height="20"> <span class="align-middle">Deutsche</span>
                        </a>

                        <!-- item-->
                        <a href="{{ url('index/it') }}" class="dropdown-item notify-item language" data-lang="it"
                            title="Italian">
                            <img src="{{ URL::asset('assets/images/flags/italy.svg') }}" alt="user-image" class="me-2 rounded" height="20">
                            <span class="align-middle">Italiana</span>
                        </a>

                        <!-- item-->
                        <a href="{{ url('index/ru') }}" class="dropdown-item notify-item language" data-lang="ru"
                            title="Russian">
                            <img src="{{ URL::asset('assets/images/flags/russia.svg') }}" alt="user-image" class="me-2 rounded" height="20">
                            <span class="align-middle">русский</span>
                        </a>

                        <!-- item-->
                        <a href="{{ url('index/ch') }}" class="dropdown-item notify-item language" data-lang="ch"
                            title="Chinese">
                            <img src="{{ URL::asset('assets/images/flags/china.svg') }}" alt="user-image" class="me-2 rounded" height="20">
                            <span class="align-middle">中国人</span>
                        </a>

                        <!-- item-->
                        <a href="{{ url('index/fr') }}" class="dropdown-item notify-item language" data-lang="fr"
                            title="French">
                            <img src="{{ URL::asset('assets/images/flags/french.svg') }}" alt="user-image" class="me-2 rounded" height="20">
                            <span class="align-middle">français</span>
                        </a> --}}
                    </div>
                </div>



                {{-- <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"
                        data-toggle="fullscreen">
                        <i class='bx bx-fullscreen fs-22'></i>
                    </button>
                </div> --}}

                {{-- <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle light-dark-mode">
                        <i class='bx bx-moon fs-22'></i>
                    </button>
                </div> --}}

                <div class="dropdown d-none topbar-head-dropdown ms-1 header-item">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class='bx bx-bell fs-22'></i>
                        <span class="position-absolute topbar-badge fs-10 translate-middle badge rounded-pill bg-danger">
                            <span class="notification-count" data-id="{{isset($notifications) ? count($notifications) : 0}}"> {{isset($notifications) ? count($notifications) : 0}} </span>
                            <span class="visually-hidden">{{__('main.unread_messages')}}</span>
                        </span>
                    </button>
                    <div class="dropdown-menu d-none dropdown-menu-lg dropdown-menu-end p-0"
                        aria-labelledby="page-header-notifications-dropdown">

                        <div class="dropdown-head bg-primary bg-pattern rounded-top">
                            <div class="p-3">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h6 class="m-0 fs-16 fw-semibold text-white"> {{__('main.notifications')}}</h6>
                                    </div>
                                    <div class="col-auto dropdown-tabs">
                                        <span class="badge badge-soft-light fs-13"> <span class="notification-count">{{isset($notifications) ? count($notifications) : 0}}</span> {{__('main.new_orders')}}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="px-2 pt-2">
                                <ul class="nav nav-tabs dropdown-tabs nav-tabs-custom" data-dropdown-tabs="true"
                                    id="notificationItemsTab" role="tablist">
                                    <li class="nav-item waves-effect waves-light">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#all-noti-tab" role="tab"
                                            aria-selected="true">
                                            {{__('main.new_orders')}} (<span class="notification-count">{{isset($notifications) ? count($notifications) : 0}}</span>)
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    {{-- <audio id="audio" src="{{asset('assets/audio/171671-success_1.mp3')}}" autoplay="false" muted></audio> --}}
                        <div class="tab-content" id="notificationItemsTabContent">
                            @if(count($notifications) > 0)
                            <div class="tab-pane fade show active py-2 ps-2 notification-inner-menu" id="all-noti-tab" role="tabpanel">
                                <div data-simplebar style="max-height: 300px;" class="pe-2">
                                    @foreach($notifications as $notification)
                                        @php
                                            $order_id = $notification->data['order_id'];
                                        @endphp
                                        <div class="text-reset notification-item d-block dropdown-item position-relative">
                                            <div class="d-flex">
                                                <div class="avatar-xs me-3">
                                                    <span class="avatar-title bg-soft-info text-info rounded-circle fs-16">
                                                        <i class="bx bx-badge-check"></i>
                                                    </span>
                                                </div>
                                                <div class="flex-1">
                                                    <a class="stretched-link mark-as-read" href="{{route("admin.orderItemDetails","$order_id")}}" data-id="{{$notification->id}}"><h6 class="mt-0 mb-2 lh-base"> {{__('main.new_order_no.')}} {{$order_id}}.</h6>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="my-3 text-center">
                                        <a class="btn btn-soft-success waves-effect waves-light mark-all" href="{{route('admin.allOrderList')}}"> {{__('main.view_all')}}<i class="ri-arrow-right-line align-middle"></i></a>
                                    </div>
                                </div>
                            </div>
                            @else
                            <div class="tab-pane fade show active py-2 ps-2 notification-inner-menu" id="all-noti-tab" role="tabpanel" aria-labelledby="all-noti-tab">
                                <div class="w-25 w-sm-50 pt-3 mx-auto">
                                    <img src="{{ URL::asset('assets/images/svg/bell.svg') }}" class="img-fluid" alt="user-pic">
                                </div>
                                <div class="text-center pb-5 mt-2">
                                    <h6 class="fs-18 fw-semibold lh-base">{{__("main.Hey! You have no any notifications") }}</h6>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="dropdown ms-sm-3 header-item topbar-user">
                    <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <span class="d-flex align-items-center">
                            <img class="rounded-circle header-profile-user" src="{{!empty(Auth::user()->profile_image)? Auth::user()->profile_image: asset("assets/images/users/user-dummy-img.jpg")}}"
                                alt="Header Avatar">
                            <span class="text-start ms-xl-2">
                                <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text">{{Auth::user()->name}}</span>
                                <span class="d-none d-xl-block ms-1 fs-12 text-muted user-name-sub-text">{{Auth::user()->name}}</span>
                            </span>
                        </span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <!-- item-->
                        <h6 class="dropdown-header">{{__('main.welcome')}} {{Auth::user()->name}}</h6>
                        <a class="dropdown-item" href="{{route('admin.profile')}}"><i
                                class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i> <span
                                class="align-middle">{{__('main.profile')}}</span></a>
                        <a class="dropdown-item" href="{{route('admin.changePassword')}}"><i
                                class="mdi mdi-message-text-outline text-muted fs-16 align-middle me-1"></i> <span
                                class="align-middle">{{__('main.change_password')}}</span></a>
                       {{-- <a class="dropdown-item" href="apps-tasks-kanban"><i
                                class="mdi mdi-calendar-check-outline text-muted fs-16 align-middle me-1"></i> <span
                                class="align-middle">Taskboard</span></a>
                        <a class="dropdown-item" href="pages-faqs"><i
                                class="mdi mdi-lifebuoy text-muted fs-16 align-middle me-1"></i> <span
                                class="align-middle">Help</span></a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="pages-profile"><i
                                class="mdi mdi-wallet text-muted fs-16 align-middle me-1"></i> <span
                                class="align-middle">Balance : <b>$5971.67</b></span></a>
                        <a class="dropdown-item" href="pages-profile-settings"><span
                                class="badge bg-soft-success text-success mt-1 float-end">New</span><i
                                class="mdi mdi-cog-outline text-muted fs-16 align-middle me-1"></i> <span
                                class="align-middle">Settings</span></a>
                        <a class="dropdown-item" href="auth-lockscreen-basic"><i
                                class="mdi mdi-lock text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Lock screen</span></a> --}}
                        <a class="dropdown-item " href="javascript:void();"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                                class="bx bx-power-off font-size-16 align-middle me-1"></i> <span
                                key="t-logout">@lang('main.logout')</span></a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
