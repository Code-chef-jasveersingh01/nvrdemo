<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="{{route('admin.dashboard')}}" class="logo logo-dark">
            <span class="logo-sm">
                {{-- Admin panel --}}
                <img src="{{ URL::asset('assets/images/svgviewer-output.svg') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                {{-- Admin panel --}}
                <img src="{{ URL::asset('assets/images/svgviewer-output.svg') }}" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="{{route('admin.dashboard')}}" class="logo logo-light">
            <span class="logo-sm">
                {{-- Admin panel --}}
                <img src="{{ URL::asset('assets/images/svgviewer-output.svg') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                {{-- Admin panel --}}
                <img src="{{ URL::asset('assets/images/svgviewer-output.svg') }}" alt="" height="17">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="nav-item ">
                    <a class="nav-link {{ (request()->is('dashboard*')) ? 'menu-link active' : 'menu-link' }}" href="{{route('admin.dashboard')}}">
                        <i class="ri-dashboard-2-line"></i> <span>@lang('main.dashboard')</span>
                    </a>
                </li> <!-- end Dashboard Menu -->

                @if (Auth::user())
                    {{-- @canany(['View All Admin', 'View All Designer', 'View All Users','View All Roles']) --}}
                        <li class="nav-item d-none">
                            <a class="nav-link menu-link {{ (request()->is('users*')) ? 'active collaspe' : 'collapsed' }}" href="#users"  data-bs-toggle="collapse" role="button" aria-expanded="{{ (request()->is('users*')) ? 'true' : 'false' }}" aria-controls="users">
                                <i class="ri-account-circle-line"></i> <span>@lang('main.users')</span>
                            </a>
                            <div class="menu-dropdown {{ (request()->is('users*')) ? 'collapse show' : 'collapse' }}" id="users">
                                <ul class="nav nav-sm flex-column">
                                </ul>
                            </div>
                        </li> <!-- end Users Menu -->
                    {{-- @endcanany --}}
                @endif

                <li class="nav-item">
                    <a href="#face" class="nav-link menu-link {{ (request()->is('face*')) ? 'active collaspe' : 'collapsed' }}" data-bs-toggle="collapse" role="button" aria-expanded="{{ (request()->is('face*')) ? 'true' : 'false' }}" aria-controls="face" data-key="t-email">
                        <i class="ri-stack-line"></i> <span>@lang('main.face')</span>
                    </a>
                    <div class="menu-dropdown {{ (request()->is('face*')) ? 'collapse show' : 'collapse' }}" id="face">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{route('admin.getAddFaceForm')}}" class="nav-link {{ (request()->is('face/add*')) ? 'active' : '' }}">@lang('main.add_face')</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin.faceList')}}" class="nav-link {{ (request()->is('face/list*')) ? 'active' : '' }}">@lang('main.face_list')</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a href="#settings" class="nav-link menu-link {{ (request()->is('settings*')) ? 'active collaspe' : 'collapsed' }}" data-bs-toggle="collapse" role="button" aria-expanded="{{ (request()->is('settings*')) ? 'true' : 'false' }}" aria-controls="settings" data-key="t-email">
                        <i class="ri-stack-line"></i> <span>@lang('main.setting')</span>
                    </a>
                    <div class="menu-dropdown {{ (request()->is('settings*')) ? 'collapse show' : 'collapse' }}" id="settings">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{route('admin.nvrDetails')}}" class="nav-link {{ (request()->is('settings/nvr*')) ? 'active' : '' }}">@lang('main.nvr_configuration')</a>
                            </li>
                        </ul>
                    </div>
                </li> <!--- setting -->
                <!-- end store Menu -->
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>
