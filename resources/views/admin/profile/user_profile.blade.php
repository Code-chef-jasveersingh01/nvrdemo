@extends('layouts.admin.layout')
@section('title')
    {{ __('main.profile')}}
@endsection
@section('content')
@component('components.breadcrumb')
@slot('title') {{__('main.profile')}} @endslot
@slot('link') {{route('admin.profile')}} @endslot
@endcomponent
<div class="row">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">{{__('main.account_details')}}</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{route('admin.updateProfile')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <label class="small mb-1" for="full_name">{{__('main.full_name')}}</label>
                            <input class="form-control @error('full_name') is-invalid @enderror" id="full_name" name="full_name" type="text" placeholder="{{__('main.Enter your full name')}}" value="{{ Auth::user()->full_name }}" required autofocus>
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="email">{{__('main.email')}}</label>
                            <input class="form-control @error('email') is-invalid @enderror" id="email" name="email" type="email" placeholder="{{__('main.Enter email adderss')}} " value="{{ Auth::user()->email }}" readonly>
                        </div>
                    </div>
                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <label class="small mb-1" for="phone">{{__('main.phone_number')}}</label>
                            <input class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" type="tel" placeholder="{{__('main.Enter your phone number')}}" value="{{ Auth::user()->phone }}" required autofocus>
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="birthdate">{{__('main.birthday')}}</label>
                            <input class="form-control @error('birthdate') is-invalid @enderror" id="birthdate" name="birthdate" type="date" max="{{date("Y-m-d")}}" placeholder="{{__('main.Enter your birthday')}}" value="{{ Auth::user()->birthdate }}" required autofocus>
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
                                    <option value="{{$key}}" {{isset(Auth::user()->gender_type) && Auth::user()->gender_type == $key? 'selected':''}}>{{$gender}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1">{{__('main.address')}}</label>
                            <input class="form-control @error('address') is-invalid @enderror" id="address" name="address" type="tel" placeholder="{{__('main.Enter your address')}}" value="{{ Auth::user()->address }}" required autofocus>
                        </div>
                    </div>
                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <label class="small mb-1">{{__('main.city')}}</label>
                            <select class="form-control @error('city_type') is-invalid @enderror" name="city_type">
                                <option value="">{{__('main.select')}}</option>
                                @php
                                    $cityTypes = \App\Models\Lockup::getByTypeKey('cityType');
                                @endphp
                                @foreach ($cityTypes as $key=>$cityType)
                                    <option value="{{$key}}"  {{isset(Auth::user()->city_type) && Auth::user()->city_type == $key? 'selected':''}}>{{$cityType}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1">{{__('main.country')}}</label>
                            <select class="form-control @error('country_type') is-invalid @enderror" name="country_type">
                                <option value="">{{__('main.select')}}</option>
                                @php
                                    $countryTypes = \App\Models\Lockup::getByTypeKey('countryType');
                                @endphp
                                @foreach ($countryTypes as $key=>$countryType)
                                    <option value="{{$key}}" {{isset(Auth::user()->country_type) && Auth::user()->country_type == $key? 'selected':''}}>{{$countryType}}</option>
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
                <h6 class="m-0 font-weight-bold text-primary">{{__('main.profile_picture')}}</h6>
            </div>
            <div class="card-body">
                <div class="card-body text-center">
                    <img class="rounded-circle mb-2 avater-ext" src="{{!empty(Auth::user()->profile_image)? Auth::user()->profile_image: asset("assets/images/users/user-dummy-img.jpg")}}" style="height: 10rem;width: 10rem;">
                    <div class="large text-muted mb-4">
                        <span class="badge badge-pill badge-{{Auth::user()->is_active==1?'success':'danger'}}">
                            {{Auth::user()->is_active ?  __('main.active')  :  __('main.in_active') }}
                        </span>
                    </div>
                    <button class="btn btn-soft-primary" data-bs-toggle="modal" data-bs-target="#adminProfileImageUpdateModal">{{__('main.update_profile_image')}}</button>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.component.modal.admin_profile_image_update_modal')
@endsection
@section('script')
<script>
$(document).ready(function () {
    $('.dropify').dropify();
});
</script>
@endsection
