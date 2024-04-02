@extends('layouts.admin.layout')
@section('title')
    {{__('main.nvr_details')}}
@endsection
@section('css')
    <link href="{{ URL::asset('assets/libs/jsvectormap/jsvectormap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/libs/swiper/swiper.min.css') }}" rel="stylesheet" type="text/css" />
    <!--datatable css-->
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <!--datatable responsive css-->
    <link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href={{asset("assets/css/dropify.css")}}>
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') {{__('main.index')}} @endslot
@slot('title') {{__('main.details')}} @endslot
@endcomponent
 <!-- Session Status -->
 <x-auth-session-status class="mb-4" :status="session('status')" />
<div class="col-sm-4 offset-sm-4">
    <form action="{{ route('admin.setNvrDetails') }}" method="POST">
        @csrf
        <div class="mb-4 text-center">
            <label for="username" class="form-label fs-4 ">Username</label>
            <input type="text"  class="form-control @error('email') is-invalid @enderror" value="" id="username" name="email" placeholder="Enter username">
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3 text-center">
            <label class="form-label fs-4" for="password-input">{{__('main.password')}}</label>
            <div class="position-relative auth-pass-inputgroup mb-3">
                <input type="password" class="form-control pe-5 @error('password') is-invalid @enderror" name="password" placeholder="Enter password" id="password-input">
                <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="mb-4 text-center">
            <label for="nvrip" class="form-label fs-4">NVR IP</label>
            <input type="text" class="form-control @error('nvrip') is-invalid @enderror" value="" id="nvrip" name="nvrip" placeholder="Enter NVR ip address">
            @error('nvrip')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="mt-4 offset-sm-4">
            <button class="btn btn-success w-50 fs-4" type="submit">{{__('main.connect')}}</button>
        </div>

        <div class="mt-4 text-center">
            <div class="signin-other-title">
                <h5 class="fs-13 mb-4 title"></h5>
            </div>
            <div class="mt-5 text-center">
            </div>
        </div>
    </form>
</div>
@endsection

