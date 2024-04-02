<!doctype html >
    <html lang="{{Session::get('locale')}}" data-layout="vertical" data-layout-style="default" data-layout-position="fixed" data-topbar="light" data-sidebar="light" data-sidebar-size="lg" data-layout-width="fluid" data-sidebar-image="none" dir="{{Session::get('locale')=="ar"?"rtl":"ltr"}}">

<head>
    <title>{{ env('APP_NAME', 'Admin Panel') }} - @yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Admin & Dashboard" name="description" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ URL::asset('assets/images/favicon.ico')}}">
    @include('layouts.admin.header.header')
</head>

@section('body')
    @include('layouts.admin.body.body')
@show
    <!-- Begin page -->
    <div id="layout-wrapper">
        @include('layouts.admin.menu.top_navbar')
        @include('layouts.admin.menu.side_navbar')
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    @yield('content')
                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->
            @include('layouts.admin.footer.footer')
        </div>
        <!-- end main content-->
    </div>
    <!-- END layout-wrapper -->

    {{-- @include('layouts.admin.footer.customizer') --}}

    <!-- JAVASCRIPT -->
    @include('layouts.admin.footer.footerJS')
</body>

</html>
