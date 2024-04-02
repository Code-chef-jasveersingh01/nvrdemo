@extends('layouts.admin.layout')
@section('title')
{{__('main.configuration')}}
@endsection
@section('content')
<div class="content-header">
  <div class="d-flex align-items-center">
    <div class="me-auto">
      <h4 class="page-title">{{__('main.setting')}}</h4>
      <div class="d-inline-block align-items-center">
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.wishlistSettingIndexConfiguration')}}"><i class="mdi mdi-home-outline"></i></a></li>
            <li class="breadcrumb-item active" aria-current="page">{{__('main.configuration')}}</li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
</div>
<section class="content">
  <div class="row">
    <div class="col-12">
      <ul class="nav nav-tabs customtab2" role="tablist">
        <li class="nav-item">
          <a class="nav-link" href="{{route('admin.wishlistSettingIndexConfiguration')}}" role="tab">
            <span class="hidden-sm-up"><i class="ion-bag"></i></span>
            <span class="hidden-xs-down">{{__('main.wishlist')}}</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('admin.colorSettingIndexConfiguration')}}" role="tab">
            <span class="hidden-sm-up"><i class="ion-contrast"></i></span>
            <span class="hidden-xs-down">{{__('main.color_setting')}}</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('admin.navbarIndexConfiguration')}}" role="tab">
            <span class="hidden-sm-up"><i class="ion-ios-list"></i></span>
            <span class="hidden-xs-down">{{__('main.navbar_items')}}</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('admin.cartCleanIndexConfiguration')}}" role="tab">
            <span class="hidden-sm-up"><i class="fa fa-shopping-cart" aria-hidden="true"></i></span>
            <span class="hidden-xs-down">{{__('main.cart_setting')}}</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="{{route('admin.mapIndexConfiguration')}}" role="tab">
            <span class="hidden-sm-up"><i class="ion-map"></i></span>
            <span class="hidden-xs-down">{{__('main.map_setting')}}</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('admin.currencyIndexConfiguration')}}" role="tab">
            <span class="hidden-sm-up"><i class="fa fa-fw fa-money"></i></span>
            <span class="hidden-xs-down">{{__('main.currency_setting')}}</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('admin.paymentMethodIndexConfiguration')}}" role="tab">
            <span class="hidden-sm-up"><i class="fa fa-fw fa-credit-card"></i></span>
            <span class="hidden-xs-down">{{__('main.payment_method_setting')}}</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('admin.footerSettingIndexConfiguration')}}" role="tab">
            <span class="hidden-sm-up"><i class="fa fa-newspaper-o" aria-hidden="true"></i></span></span>
            <span class="hidden-xs-down">{{__('main.footer_setting')}}</span>
          </a>
        </li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane active" id="map-setting" role="tabpanel">
          <div class="row">
            <div class="col-xl-12">
              <div class="box box-bordered border-primary m-10">
                <div class="box-header with-border">
                  <h4 class="box-title text-primary"><strong>{{ __('main.map_setting') }}</strong></h4>
                </div>
                <div class="box-body">
                  <form class="form" method="POST" action="{{ route('admin.mapStoreConfiguration') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row gx-3 mb-3">
                      <div class="col-md-6">
                        <label class="small mb-1" for="data[latitude]">{{__('main.latitude')}}</label>
                        <input class="form-control" id="latitude" name="data[latitude]" type="text" placeholder="{{__('main.latitude')}}" @if (isset($map->data->latitude))
                          value = "{{$map->data->latitude}}" @else value="{{ old('data[latitude]') }}" @endif>
                      </div>
                      <div class="col-md-6">
                        <label class="small mb-1" for="data[longitude]">{{__('main.longitude')}}</label>
                        <input class="form-control" id="longitude" name="data[longitude]" type="text" placeholder="{{__('main.longitude')}}" @if (isset($map->data->longitude))
                        value = "{{$map->data->longitude}}" @else value="{{ old('data[longitude]') }}" @endif>
                      </div>
                    </div>
                    <div class="row gx-3 mb-3">
                      <div class="col-md-6">
                        <label class="small mb-1" for="data[title]">{{__('main.title')}}</label>
                        <input class="form-control" id="title" name="data[title]" type="text" placeholder="{{__('main.title')}}" @if (isset($map->data->title))
                        value = "{{$map->data->title}}" @else value="{{ old('data[title]') }}" @endif>
                      </div>
                      <div class="col-md-6">
                        <p>{{__('main.enable_map')}}</p>
                        <label class="custom-control custom-checkbox">
                          <input class="filled-in chk-col-blue" type="checkbox" id="wishlist_status_checkbox" name="map_status" @if (isset($map->status)) value="{{ old($map->status) }}" @if (old('status', $map->status)) checked @endif @endif>
                          <label for="wishlist_status_checkbox"></label>
                        </label>
                      </div>
                    </div>
                    <div class="box-footer">
                      <button type="submit" class="btn btn-primary">
                        <i class="ti-save-alt"></i>{{ __('main.save_changes') }}
                      </button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

