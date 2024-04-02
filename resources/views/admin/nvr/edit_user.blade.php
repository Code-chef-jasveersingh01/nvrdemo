@extends('layouts.admin.layout')
@section('title')
    {{ __('main.edit_user')}}
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') {{__('main.edit')}} @endslot
@slot('title') {{__('main.users')}} @endslot
@slot('link') {{ route('admin.usersList')}} @endslot
@endcomponent
<div class="row">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
        <form method="POST" action="{{route('admin.editUser',['uuid'=>$userDetails->uuid])}}" enctype="multipart/form-data">
            <div class="row card-header py-3 d-flex align-items-center" style="background: none">
                <h6 class="col-10 m-0 font-weight-bold text-primary flex-grow-1">{{__('main.user_details')}}</h6>
                <div class="col-2 form-check form-switch form-check-right flex-shrink-0">
                    <input class="form-check-input mx-1" name="is_active" type="checkbox" role="switch" id="is_active" value="{{ old($userDetails->is_active) }}" @if (old('is_active', $userDetails->is_active)) checked @endif>
                    <label class="form-check-label mx-1" for="is_active">{{__('main.is_active')}}</label>
                </div>
            </div>
            <div class="card-body">
                    @csrf
                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <label class="small mb-1" for="full_name">{{__('main.full_name')}}</label>
                            <input class="form-control @error('full_name') is-invalid @enderror" id="full_name" name="full_name" type="text" placeholder="{{__('main.Enter your full name')}}" value="{{ $userDetails->full_name }}" required autofocus>
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="email">{{__('main.email')}}</label>
                            <input class="form-control @error('email') is-invalid @enderror" id="email" name="email" type="email" placeholder="{{__('main.Enter email adderss')}} " value="{{ $userDetails->email }}" readonly>
                        </div>
                    </div>
                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <label class="small mb-1" for="phone">{{__('main.phone_number')}}</label>
                            <input class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" type="tel" placeholder="{{__('main.Enter your phone number')}}" value="{{ $userDetails->phone }}" required autofocus>
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="birthdate">{{__('main.birthday')}}</label>
                            <input class="form-control @error('birthdate') is-invalid @enderror" id="birthdate" name="birthdate" type="date" max="{{date("Y-m-d")}}" placeholder="{{__('main.Enter your birthday')}}" value="{{ $userDetails->birthdate }}" required autofocus>
                        </div>
                    </div>
                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <label class="small mb-1">{{__('main.gender')}}</label>
                            <select class="form-control @error('gender_type') is-invalid @enderror" name="gender_type">
                                @php
                                    $genders = \App\Models\Lockup::getByTypeKey('genderType');
                                @endphp
                                @foreach ($genders as $key=>$gender)
                                    <option value="{{$key}}" {{isset($userDetails->gender_type) && $userDetails->gender_type == $key? 'selected':''}}>{{$gender}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit">{{__('main.save_changes')}}</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">{{__('main.user_profile_picture')}}</h6>
            </div>
            <div class="card-body">
                <div class="card-body text-center">
                    <img class="rounded-circle mb-2 avater-ext" src="{{!empty($userDetails->media->name) ? asset(config('image.profile_image_path_view').$userDetails->media->name): asset("assets/images/users/user-dummy-img.jpg")}}" style="height: 10rem;width: 10rem;">
                    <div class="large text-muted mb-4">
                        <span class="badge rounded-pill badge-outline-{{$userDetails->is_active==1?'success':'danger'}}">
                            {{$userDetails->is_active ?  __('main.active')  :  __('main.in_active') }}
                        </span>
                    </div>
                    <button class="btn btn-soft-primary" data-bs-toggle="modal" data-bs-target="#userProfileImageUpdateModal">{{__('main.update_profile_image')}}</button>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.component.modal.user_profile_image_update_modal')
@endsection
@section('script')
<script>
$(document).ready(function () {
    $('.dropify').dropify();
});
</script>
@endsection
