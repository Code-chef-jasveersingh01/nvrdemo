@extends('layouts.admin.layout')
@section('content')
<div class="row">
    <div class="col-lg-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">{{__('main.profile_picture')}}</h6>
            </div>
            <div class="card-body">
                <div class="card-body text-center">
                    <img class="rounded-circle mb-2 avater-ext" src="{{!empty(Auth::user()->profile_image)? Auth::user()->profile_image: asset("/img/profile-1.png")}}" alt="" style="height: 10rem;width: 10rem;">
                    <div class="large text-muted mb-4">
                        <span class="badge badge-pill badge-{{Auth::user()->is_active==1?'success':'danger'}}">
                            {{Auth::user()->is_active ?  __('main.active')  :  __('main.in_active') }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">{{__('main.change_password')}}</h6>
            </div>
            <div class="card-body">
                @include('admin.component.display_alert_message')
                <form method="POST" id="changePasswordForm" action="{{route('admin.changePasswordStore')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="row gx-3 mb-3">
                        <div class="col-md-12">
                            <label class="small mb-1" for="fname">{{__('main.old_password')}}</label>
                            <input class="form-control mb-2" id="old-password" name="old_password" type="password" placeholder="{{__('main.old_password')}}" required autofocus>
                        </div>
                        <div class="col-md-12">
                            <label class="small mb-1" for="fname">{{__('main.new_password')}}</label>
                            <input class="form-control mb-2" id="new-password" name="password" type="password" placeholder="{{__('main.new_password')}}" required autofocus>
                        </div>
                        <div class="col-md-12">
                            <label class="small mb-1" for="fname">{{__('main.retype_password')}}</label>
                            <input class="form-control mb-2" id="password-confirm" name="password_confirmation" type="password" placeholder="{{__('main.retype_password')}}" required autofocus>
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit">{{__('main.save_changes')}}</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
