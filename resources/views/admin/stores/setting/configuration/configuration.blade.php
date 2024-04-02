@extends('layouts.admin.layout')
@section('title')
    {{ __('main.configuration')}}
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
@slot('title') {{__('main.attribute')}} @endslot
@slot('link') {{route('admin.attributeProductList')}} @endslot
@endcomponent
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h5 class="card-title mb-0 flex-grow-1">{{__("main.configuration")}}</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="nav flex-column nav-pills text-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link mb-2 active" id="currency-tab" data-bs-toggle="pill" href="#currency" role="tab" aria-controls="currency" aria-selected="true">{{__('main.base_currency')}}</a>
                            <a class="nav-link mb-2" id="store-time-tab" data-bs-toggle="pill" href="#store-time" role="tab" aria-controls="store-time" aria-selected="false">{{__('main.store_timing')}}</a>
                            <a class="nav-link mb-2" id="payment-menthod-tab" data-bs-toggle="pill" href="#payment-menthod" role="tab" aria-controls="payment-menthod" aria-selected="false">{{__('main.payment_method')}}</a>
                        </div>
                    </div><!-- end col -->
                    <div class="col-md-9">
                        <div class="tab-content text-muted mt-4 mt-md-0" id="v-pills-tabContent">
                            <div class="tab-pane fade show active" id="currency" role="tabpanel" aria-labelledby="currency-tab">
                                <div class="d-flex flex-column mb-2">
                                <div class="box-header with-border">
                                    <h4 class="box-title text-primary"><strong>{{ __('main.currency_setting') }}</strong></h4>
                                  </div>
                                  <div class="box-body">
                                    <form class="form" method="POST" action="{{ route('admin.currencyStoreConfiguration') }}" enctype="multipart/form-data">
                                      @csrf
                                      <div class="row gx-3 mb-3">
                                        <div class="col-md-6">
                                          <label class="small mb-1" for="currency">{{__('main.base_currency')}}</label>
                                            @php
                                                $currencyType = \App\Models\Lockup::getByTypeKey('currencyType');
                                            @endphp
                                          <select class="form-control" name="data[]" id="currency">
                                            @foreach ($currencyType as $key=>$currency)
                                                <option value="{{$key}}" {{isset($currencyDetail->data) && $currencyDetail->data[0] == $key? 'selected':''}}>{{$currency}}</option>
                                            @endforeach
                                          </select>
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
                            <div class="tab-pane fade" id="store-time" role="tabpanel" aria-labelledby="store-time-tab">
                                <div class="d-flex flex-column mb-2">
                                    <div class="flex-shrink-0 box-header with-border">
                                        <h4 class="box-title text-primary"><strong>{{ __('main.store_time_schedule') }}</strong></h4>
                                    </div>
                                    <div class="box-body flex-grow-1 ms-3">
                                        <form method="POST" action="{{route('admin.storeTimeSchedule')}}" id="storeTimeSchedule">
                                            @csrf
                                            {{-- <div class='table-responsive'>
                                                <table class='table table-hover' width='100%' cellspacing='0'>
                                                    <thead>
                                                        <tr>
                                                            <th>{{__('main.days')}}</th>
                                                            <th style='text-center'>{{__('main.is_working')}}</th>
                                                            <th style='text-center'>{{__('main.opening_time')}}</th>
                                                            <th style='text-center'>{{__('main.closing_time')}}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id='tbody'>
                                                        @php
                                                            $dayTypes = \App\Models\Lockup::getByTypeKey('day_type');
                                                        @endphp
                                                        @foreach ($dayTypes as $key=>$day)
                                                        @php
                                                            $dayTime = (isset($storeTimeSchedule) && !empty($storeTimeSchedule)) ? $storeTimeSchedule->where('day_type',$key)->first() : null;
                                                        @endphp
                                                        <tr>
                                                            <td style="width: 15%;">
                                                                {{$day}}
                                                                <input type="hidden" class="form-control" name="day_type[]" value="{{$key}}">
                                                            </td>
                                                            <td>
                                                                <select class="form-control is_active_store_time" name="is_active[]" data-day-type="{{$key}}">
                                                                    <option value="1" {{(isset($dayTime) && $key == $dayTime->day_type)&&($dayTime->is_active == '1') ? 'selected' : '' }}>{{__('main.working')}}</option>
                                                                    <option value="0" {{(isset($dayTime) && $key == $dayTime->day_type)&&($dayTime->is_active == '0') ? 'selected' : '' }}>{{__('main.holiday')}}</option>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <input type="time" class="form-control opening_time_{{$key}}" name="opening_time[]" @if((isset($dayTime) && $key == $dayTime->day_type) && (isset($dayTime->opening_time) && !empty($dayTime->opening_time))) value='{{$dayTime->opening_time}}' @endif />
                                                            </td>
                                                            <td>
                                                                <input type="time" class="form-control closing_time_{{$key}}" name="closing_time[]" @if((isset($dayTime) && $key == $dayTime->day_type) && (isset($dayTime->closing_time) && !empty($dayTime->closing_time))) value='{{$dayTime->closing_time}}' @endif/>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                                <div class="card-footer text-muted text-end">
                                                    <button class="btn btn-primary" type="submit" form="storeTimeSchedule">{{__('main.save')}}</button>
                                                </div>
                                            </div> --}}
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label" for="title">{{ __('main.opening_time') }}</label>
                                                <div class="col-sm-2 mb-2">
                                                  <div class="form-group">
                                                    <input type="time" class="form-control opening_time" name="opening_time" @if(isset($store_timing->data->opening_time) && !empty($store_timing->data->opening_time)) value='{{$store_timing->data->opening_time}}' @endif />
                                                  </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label" for="title">{{ __('main.closing_time') }}</label>
                                                <div class="col-sm-2 mb-2">
                                                  <div class="form-group">
                                                    <input type="time" class="form-control closing_time" name="closing_time" @if((isset($store_timing->data->closing_time) && !empty($store_timing->data->closing_time))) value='{{$store_timing->data->closing_time}}' @endif/>
                                                  </div>
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
                            <div class="tab-pane fade" id="payment-menthod" role="tabpanel" aria-labelledby="payment-menthod-tab">
                                <div class="d-flex flex-column mb-2">
                                    <div class="box box-bordered border-primary m-10">
                                        <div class="box-header with-border mb-4">
                                          <h4 class="box-title text-primary"><strong>{{ __('main.payment_method_setting') }}</strong></h4>
                                        </div>
                                        <div class="box-body">
                                          <form class="form" method="POST" action="{{ route('admin.paymentMethodStoreConfiguration') }}" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group row">
                                              <label class="col-sm-2 col-form-label" for="title">{{ __('main.select_payment_options') }}</label>
                                              <div class="col-sm-10 mb-2">
                                                <div class="form-group">
                                                    @php
                                                        $paymentMethods = \App\Models\Lockup::getByTypeKey('paymentMethod');
                                                    @endphp
                                                <select class="form-control" id="choices-multiple-default" name="data[]" style="width: 50%" required data-choices data-choices-removeItem multiple>
                                                    @foreach ($paymentMethods as $key => $value)
                                                        <option value="{{$key}}" data-tokens="{{$value}}" @if($selectedPayemntMethods->data) {{ in_array($key, $selectedPayemntMethods->data) ? 'selected' : ""}} @endif>{{$value}}</option>
                                                    @endforeach
                                                </select>
                                                </div>
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
                    </div><!--  end col -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $('.is_active_store_time').change(function (e) {
                e.preventDefault();
                var isActive = $(this).val();
                var dayType = $(this).data('day-type');
                console.log(isActive,dayType);
                if(isActive==1){
                    $(".opening_time_"+dayType).prop("readonly", false);
                    $(".closing_time_"+dayType).prop("readonly", false);
                }else{
                    $(".opening_time_"+dayType).prop("readonly", true);
                    $(".closing_time_"+dayType).prop("readonly", true);
                }
            });
        });
    </script>
@endsection
