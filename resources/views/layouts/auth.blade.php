<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-topbar="light">

<head>
    <meta charset="utf-8" />
    <title>@yield('title') | Admin & Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Admin & Dashboard" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ URL::asset('assets/images/favicon.ico')}}">
    @include('layouts.admin.header.header')
</head>

@yield('body')

@yield('content')

<script src="{{ asset('assets/libs/bootstrap/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ asset('assets/libs/node-waves/node-waves.min.js') }}"></script>
<script src="{{ asset('assets/libs/feather-icons/feather-icons.min.js') }}"></script>
<script src="{{ asset('assets/js/pages/plugins/lord-icon-2.1.0.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins.min.js') }}"></script>

{{-- vendor script --}}
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src={{asset("assets/libs/jquery-toast-plugin-master/src/jquery.toast.js")}}></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="{{ URL::asset('assets/libs/prismjs/prismjs.min.js') }}"></script>
<script src={{asset("assets/js/pages/dropify.min.js")}}></script>
<script>
    @if(Session::has('success'))
        toastr.options =
        {
        "closeButton" : true,
        "progressBar" : true
        }
        toastr.success("{{ session('success') }}");
    @endif

    @if(Session::has('alert-success'))
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true
    }
    toastr.success("{{ session('alert-success') }}");
    @endif

    @if(Session::has('alert-error'))
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true
    }
            toastr.error("{{ session('alert-error') }}");
    @endif

    @if($errors->any())
        @foreach ($errors->all() as $error)
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
        toastr.error("* {{ $error }}");
        @endforeach
    @endif

</script>
</body>

</html>
