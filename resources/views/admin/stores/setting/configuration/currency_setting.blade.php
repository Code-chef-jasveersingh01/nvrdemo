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
          <a class="nav-link" href="{{route('admin.mapIndexConfiguration')}}" role="tab">
            <span class="hidden-sm-up"><i class="ion-map"></i></span>
            <span class="hidden-xs-down">{{__('main.map_setting')}}</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="{{route('admin.currencyIndexConfiguration')}}" role="tab">
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
            <span class="hidden-sm-up"><i class="fa fa-newspaper-o" aria-hidden="true"></i></span>
            <span class="hidden-xs-down">{{__('main.footer_setting')}}</span>
          </a>
        </li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane active" id="currency-setting" role="tabpanel">
          <div class="row">
            <div class="col-xl-12">
              <div class="box box-bordered border-primary m-10">
                <div class="box-header with-border">
                  <h4 class="box-title text-primary"><strong>{{ __('main.currency_setting') }}</strong></h4>
                </div>
                <div class="box-body">
                  <form class="form" method="POST" action="{{ route('admin.currencyStoreConfiguration') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row gx-3 mb-3">
                      <div class="col-md-6">
                        <label class="small mb-1" for="currency">{{__('main.base_currency')}}</label>
                        <select class="form-control" name="data[currency]" id="currency">
                            @foreach ($countryCurrencies as $countryCurrency)
                            <option value="{{$countryCurrency->currency}}" id="{{$countryCurrency->id}}"
                              @if(isset($currencyDetail) && ($currencyDetail->data->currency == $countryCurrency->currency)) selected @endif >{{$countryCurrency->name}} ({{$countryCurrency->currency}})</option>
                            @endforeach
                        </select>
                      </div>
                      <div class="col-md-6">
                        <label class="small mb-1" for="currency_code">{{__('main.currency_code')}}</label>
                        <select class="form-control" name="data[currency_code]" id="currency_code">
                        </select>
                      </div>
                    </div>
                    <div class="row gx-3 mb-3">
                      <div class="col-md-6">
                        <label class="small mb-1" for="currency_symbol">{{__('main.currency_symbol')}}</label>
                        <input class="form-control @error('currency_symbol') is-invalid @enderror" id="currency_symbol" name="data[currency_symbol]"
                        @if (isset($currencyDetail) && isset($currencyDetail->data->currency_symbol))
                          value = "{{$currencyDetail->data->currency_symbol}}"
                        @else
                          value="{{ old('label_name') }}"
                        @endif  type="text" placeholder="{{__('main.Enter Currency Symbol')}}" required autofocus>
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
@section('javascript')
  <script>
    $(document).ready(function () {
      $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

      $('#currency').change(function (e) {
        $(this).find("option:selected").each(function(){
            var id = $(this).attr("id");
            var data = {
                "_token": $('a[name="csrf-token"]').val(),
                "id": id,
                        }
                        $.ajax({
                            type: "POST",
                            url: "{{route('admin.currencyCodeConfiguration',"")}}"+'/'+id,
                            dataType: "JSON",
                            success: function (response) {
                              $('#currency_code').html('');
                              let b = "<option value="+response.currency_code+" id="+response.id+">"+response.currency_code+"</option>)";
                              $('#currency_code').html(b);

                              if (response.currency_symbol != null){
                                $("#currency_symbol").val(response.currency_symbol);
                              }

                            }
                        });
        });
      }).change();
      $("#currency").change(function (e) {
        $(this).find("option:selected").each(function(){
          $("#currency_symbol").val('');
        });

      });
    });
  </script>
@endsection
