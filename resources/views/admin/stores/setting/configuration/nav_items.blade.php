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
        <li class="nav-item"> <a class="nav-link active" href="{{route('admin.navbarIndexConfiguration')}}" role="tab"><span class="hidden-sm-up"><i class="ion-ios-list"></i></span> <span class="hidden-xs-down">{{__('main.navbar_items')}}</span> </a> </li>
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
        <div class="tab-pane active" id="navbar_items" role="tabpanel">
          <div class="row">
            <div class="col-xl-12">
              <div class="box box-bordered border-primary m-10">
                <div class="box-header with-border">
                  <h4 class="box-title text-primary"><strong>{{ __('main.navbar_items') }}</strong></h4>
                </div>
                <div class="box-body">
                  <form class="form" method="POST" action="{{ route('admin.navbarStoreConfiguration') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="table-responsive rounded card-table">
                      <table class="table border-no">
                        <thead>
                        </thead>
                        <tbody id="add_more_nav_items">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="row d-flex flex-column">
                                <div>

                                  <label class="small mb-1" for="image">{{ __('main.upload_logo') }}
                                    <code>({{ __('main.required') }})</code></label>
                                  <input class="dropify" id="formFile" name="logo" type="file" @if (isset($navItems->logo_image->thumbnail_name) && $navItems->logo_image->thumbnail_name !=null) data-default-file='{{ asset(config('image.logo_image_path_view').$navItems->logo_image->thumbnail_name) }}' @endif accept="image/png, image/jpeg, image/jpg">

                                  <label class="small mb-1" for="favicoin">{{ __('main.upload_favicoin') }}
                                    <code>({{ __('main.required') }})</code></label>

                                    <input class="dropify" id="formFile" name="favicoin" type="file" @if (isset($favicon) && $favicon !=null) data-default-file='{{ asset(config('image.logo_image_path_view').$favicon->thumbnail_name) }}' @endif accept="image/png, image/jpeg, image/jpg">
                                </div>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <label class="small mb-1" for="title">{{__('main.logo_title')}}</label>
                              <input class="form-control @error('title') is-invalid @enderror" id="text" type="text" name="logo_title" @if (isset($navItems['nav_logo_title']) && $navItems['nav_logo_title'] !=null) value="{{$navItems['nav_logo_title']}}" @endif autofocus required>

                              <label class="small mb-1" for="image_alt_text">{{__('main.logo_alt')}}</label>
                              <input class="form-control @error('image_alt_text') is-invalid @enderror" id="text" type="text" name="logo_alt" @if (isset($navItems['nav_logo_alt']) && $navItems['nav_logo_alt'] !=null) value="{{$navItems['nav_logo_alt']}}" @endif autofocus required>
                              <div class="row gx-3 mb-3">
                                <div class="col-md-6">
                                  <label class="small mb-1" for="data[height]">{{__('main.height')}}</label>
                                  <input class="form-control" id="height" name="data[height]" type="number" min="0" placeholder="{{__('main.Logo height in pixels')}}" @if (isset($navItems->data->height))
                                    value = "{{$navItems->data->height}}" @else value="{{ old('data[height]') }}" @endif>
                                </div>
                                <div class="col-md-6">
                                  <label class="small mb-1" for="data[width]">{{__('main.width')}}</label>
                                  <input class="form-control" id="width" name="data[width]" type="number" min="0" placeholder="{{__('main.Logo width in pixels')}}" @if (isset($navItems->data->width))
                                  value = "{{$navItems->data->width}}" @else value="{{ old('data[width]') }}" @endif>
                                </div>
                              </div>
                            </div>
                          </div>
                          <hr>
                          @if (isset($navItems['nav_items']) && $navItems['nav_items'] != null)
                            @foreach ($navItems['nav_items'] as $navItem)
                            <tr>
                              <td>
                                <div class="form-group row">
                                  <label class="col-sm-2 col-form-label" for="title">{{ __('main.title')}} <strong>({{$navItem}})</strong></label>
                                  <div class="col-sm-10">
                                    <input class="form-control @error('title') is-invalid @enderror" id="text" type="text" name="navItems[]" value="{{$navItem}}" autofocus required>
                                  </div>
                                </div>
                              </td>
                            </tr>
                            @endforeach
                          @else
                          <tr>
                            <td>
                              <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="title">{{ __('main.title') }}</label>
                                <div class="col-sm-10">
                                  <input class="form-control @error('title') is-invalid @enderror" id="text" type="text" name="navItems[]" autofocus required>
                                </div>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="title">{{ __('main.title') }}</label>
                                <div class="col-sm-10">
                                  <input class="form-control @error('title') is-invalid @enderror" id="text" type="text" name="navItems[]" autofocus required>
                                </div>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="title">{{ __('main.title') }}</label>
                                <div class="col-sm-10">
                                  <input class="form-control @error('title') is-invalid @enderror" id="text" type="text" name="navItems[]" autofocus required>
                                </div>
                              </div>
                            </td>
                          </tr>
                          @endif
                          <hr>
                        </tbody>
                        <tfoot>
                          <tr>
                            <th colspan="5">
                              <button type="submit" class="btn btn-primary">
                                <i class="ti-save-alt"></i>{{ __('main.save_changes') }}
                              </button>
                            </th>
                          </tr>
                        </tfoot>
                      </table>
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
@section('javascript')
<script type="text/javascript">
  $(document).ready(function() {
    $('.dropify').dropify();
  });
</script>
@endsection
