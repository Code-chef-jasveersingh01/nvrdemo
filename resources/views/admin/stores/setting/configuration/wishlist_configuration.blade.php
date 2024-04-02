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
        <li class="nav-item"> <a class="nav-link active"  href="{{route('admin.wishlistSettingIndexConfiguration')}}" role="tab"><span class="hidden-sm-up"><i class="ion-bag"></i></span> <span class="hidden-xs-down">{{__('main.wishlist')}}</span> </a> </li>
        <li class="nav-item">
          <a class="nav-link"  href="{{route('admin.colorSettingIndexConfiguration')}}" role="tab">
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
          <a class="nav-link" href="{{route('admin.mapIndexConfiguration')}}" role="tab">
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
        <div class="tab-pane active" id="wishlist" role="tabpanel">
          <div class="box box-bordered border-primary">
            <div class="box-header with-border">
              <h4 class="box-title text-primary"><strong>{{ __('main.wishlist') }}</strong></h4>
            </div>
            <div class="box-body">
              <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                  <form class="form" method="POST" action="{{ route('admin.wishlistStatusConfiguration') }}"
                    enctype="multipart/form-data">
                    @csrf
                      <p><strong>{{__('main.wishlist')}}</strong></p>
                      <div class="row d-flex flex-row">
                        <div class="col-sm-6">
                          <p>{{__('main.enable_wishlist')}}</p>
                        </div>
                        <div class="col-sm-6">
                          <label class="custom-control custom-checkbox">
                            <input class="filled-in chk-col-blue" type="checkbox" id="wishlist_status_checkbox" name="wishlist_status"
                              value="{{ old($wishlist->status) }}" @if (old('status', $wishlist->status)) checked @endif>
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
