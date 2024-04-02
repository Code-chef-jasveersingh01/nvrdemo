@php
    use Carbon\Carbon;
@endphp
@extends('layouts.admin.layout')
@section('title')
    {{__('main.order_details')}}
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
@slot('li_1') {{__('main.order_details')}} @endslot
@slot('title') {{__('main.orders')}} @endslot
@slot('link') {{ route('admin.allOrderList')}} @endslot
@endcomponent
{{-- ======================================= --}}
<div class="row">
    <div class="col-xl-9 col-lg-12 col-12">
        <div class="card">
            <div class="card-header">
               <div class="d-flex align-items-center flex-wrap">
                    <h5 class="card-title flex-grow-1 mb-0" id="orderId" data-id="{{$allOrders->id}}">{{__('main.order')}} #00000{{$allOrders->id}}</h5>
                    @if ($allOrders->payment_status == 24)
                  <span class="badge badge-soft-primary m-sm-3">
                    <span class="legend-indicator bg-primary"></span>
                    {{$allOrders->paymentStatus->name}}
                  </span>
                  @else
                  <span class="badge badge-soft-danger m-sm-3">
                    <span class="legend-indicator bg-danger"></span>
                    {{$allOrders->paymentStatus->name}}
                  </span>
                  @endif

                  @switch($allOrders->orderStatus->id)
                    @case(16)
                        <span class="badge badge-soft-info m-2 m-sm-3 text-capitalize">
                            <span class="legend-indicator bg-info text"></span>
                            {{$allOrders->orderStatus->name}}
                        </span>
                        @break
                    @case(17)
                        <span class="badge badge-soft-info m-2 m-sm-3 text-capitalize">
                            <span class="legend-indicator bg-info text"></span>
                            {{$allOrders->orderStatus->name}}
                        </span>
                        @break
                    @case(18)
                        <span class="badge badge-soft-warning m-2 m-sm-3 text-capitalize">
                            <span class="legend-indicator bg-warning text"></span>
                            {{$allOrders->orderStatus->name}}
                        </span>
                        @break
                    @case(19)
                        <span class="badge badge-soft-warning m-2 m-sm-3 text-capitalize">
                            <span class="legend-indicator bg-warning text"></span>
                            {{$allOrders->orderStatus->name}}
                        </span>
                        @break
                    @case(20)
                        <span class="badge badge-soft-primary m-2 m-sm-3 text-capitalize">
                            <span class="legend-indicator bg-primary text"></span>
                            {{$allOrders->orderStatus->name}}
                        </span>
                        @break
                    @case(21)
                        <span class="badge badge-soft-danger m-2 m-sm-3 text-capitalize">
                            <span class="legend-indicator bg-danger text"></span>
                            {{$allOrders->orderStatus->name}}
                        </span>
                        @break
                    @case(22)
                        <span class="badge badge-soft-danger m-2 m-sm-3 text-capitalize">
                            <span class="legend-indicator bg-danger text"></span>
                            {{$allOrders->orderStatus->name}}
                        </span>
                        @break
                    @case(23)
                        <span class="badge badge-soft-danger m-2 m-sm-3 text-capitalize">
                            <span class="legend-indicator bg-danger text"></span>
                            {{$allOrders->orderStatus->name}}
                        </span>
                        @break
                    @default
                    <span class="badge badge-soft-danger m-2 m-sm-3 text-capitalize">
                        <span class="legend-indicator bg-danger text"></span>
                        {{$allOrders->orderStatus->name}}
                    </span>
                  @endswitch
                  <span class="m-2 m-sm-3">
                    <i class="tio-date-range"></i>
                    {{Carbon::parse($allOrders->order_date)->toDayDateTimeString()}}
                  </span>
                    {{-- <div class="flex-shrink-0">
                        <a href="{{URL::asset('/apps-invoices-details')}}" class="btn btn-success btn-sm"><i class="ri-download-2-fill align-middle me-1"></i> Invoice</a>
                    </div> --}}
                    <div class="row flex-shrink-0">
                        <div class="col-md-4" style="width: auto">
                          <div class="form-group">
                            <select class="form-select" name="order_status" id="order_status"
                            @if($allOrders->order_status == "20" && $allOrders->payment_status == "24")
                             disabled
                            @elseif (in_array($allOrders->order_status,[20,21,22,23]))
                             disabled
                            @endif>
                              @foreach ($orderStatus as $order_status)
                              <option value="{{$order_status->id}}" {{ ($order_status->id == $allOrders->order_status) ? 'selected' : '' }}>{{$order_status->name}}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>
                        <div class="col-md-4" style="width: auto">
                          <div class="form-group">
                            {{-- <label class="form-label">{{__('main.payment_status')}}</label> --}}
                            <select class="form-select" name="order_status" id="payment_status" @if($allOrders->order_status == "20" && $allOrders->payment_status == "24") disabled @endif>
                              @foreach ($paymentStatus as $payment_status)
                              <option value="{{$payment_status->id}}" {{ ($payment_status->id == $allOrders->payment_status) ? 'selected' : '' }}>{{$payment_status->name}}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>
                      </div>
               </div>
            </div>
            <div class="card-body">
                <div class="table-responsive table-card">
                    <table class="table table-nowrap align-middle mb-0">
                        <thead class="table-light text-muted">
                            <tr>
                              <th scope="col">{{__('main.product_details')}}</th>
                              <th scope="col">{{__('main.items_price')}}</th>
                              <th scope="col">{{__('main.quantity')}}</th>
                              <th scope="col">{{__('main.delivery_time')}}</th>
                              <th scope="col" class="text-end">{{__('main.total_amount')}}</th>
                            </tr>
                          </thead>
                        <tbody>
                            @foreach ($allOrders->order_items as $orderItem)
                                @if($orderItem->product_type == 1)
                                    <tr>
                                        <td>
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 avatar-md bg-light rounded p-1">
                                                    <a href="{{route('admin.viewProduct',$orderItem->product_id)}}"><img src="{{isset($orderItem->image) && !empty($orderItem->image) ? $orderItem->image : asset("assets/images/No_Image_Available.jpg")}}" alt="{{$orderItem->name}}" class="img-fluid d-block"></a>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <h5 class="fs-16 link-primary">{{$orderItem->name}}</h5>
                                                    <p class="text-muted mb-0">{{__('main.type')}}: <span class="fw-medium">{{($orderItem->product_type == 1) ? __('main.product') : __('main.package') }}</span></p>
                                                    @if(isset($orderItem->data))
                                                        @switch($orderItem->data->type)
                                                            @case("Configured Product")
                                                                <span>{{isset($orderItem->data->type) ? $orderItem->data->type : '' }}</span><br>
                                                                @if(isset($orderItem->data->combination) && !empty($orderItem->data->combination))
                                                                @foreach($orderItem->data->combination as $key => $value)
                                                                <span><strong>{{ $key }}</strong> :
                                                                    @foreach($value as $key => $val)
                                                                        {{ $val->name }},
                                                                    @endforeach
                                                                </span>
                                                                @endforeach
                                                                @endif
                                                                @break
                                                            @case("Simple Product")
                                                                <span>{{isset($orderItem->data->type) ? $orderItem->data->type : '' }}</span>
                                                                @break
                                                            @default
                                                        @endswitch
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            @if(isset($currency->data->currency_symbol))
                                            {{$currency->data->currency_symbol}}
                                            @elseif(isset($currency->data->currency_code))
                                                {{$currency->data->currency_code}}
                                            @endif
                                            {{isset($orderItem->price) ? $orderItem->price : '' }}</h6>
                                        </td>
                                        <td>{{isset($orderItem->quantity) ? $orderItem->quantity : '' }} {{isset($orderItem->quantity) ? __('main.qty') : '' }}</td>
                                        <td>{{Carbon::parse($orderItem->delivery_time)->toDayDateTimeString()}}</td>
                                        <td class="fw-medium text-end">
                                            @if(isset($currency->data->currency_symbol))
                                                {{$currency->data->currency_symbol}}
                                            @elseif(isset($currency->data->currency_code))
                                                {{$currency->data->currency_code}}
                                            @endif
                                            {{$orderItem->price * $orderItem->quantity}}
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            @foreach ($allOrders->order_items as $orderItem)
                                @if($orderItem->product_type == 2)
                                <tr>
                                    <td>
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 avatar-md bg-light rounded p-1">
                                                <a href="{{route('admin.viewPackage',$orderItem->product_id)}}"><img src="{{(isset($orderItem->image) && !empty($orderItem->image)) ? $orderItem->image : asset("assets/images/No_Image_Available.jpg")}}" alt="{{$orderItem->name}}" class="img-fluid d-block"></a>
                                            </div>
                                           <div class="flex-grow-1 ms-3">
                                                <h5 class="fs-16"><a data-bs-toggle="collapse" href="#multiCollapseExample{{$orderItem->id}}" role="button" aria-expanded="false" aria-controls="multiCollapseExample{{$orderItem->id}}" class="link-primary">{{$orderItem->name}} <span class="text-muted mb-0 fw-medium"> &#40; {{__('main.click_to_see_product')}} &#41; </span></a> </h5>

                                                <p class="text-muted mb-0">{{__('main.type')}}: <span class="fw-medium">{{($orderItem->product_type == 1) ? __('main.product') : __('main.package') }}</span> @if($orderItem->product_type == 2 && isset($orderItem->data->packageType))
                                                    &#40; {{$orderItem->data->packageType}} &#41;
                                                @endif </p>
                                           </div>
                                        </div>
                                    </td>
                                    <td>
                                        @if(isset($currency->data->currency_symbol))
                                        {{$currency->data->currency_symbol}}
                                        @elseif(isset($currency->data->currency_code))
                                            {{$currency->data->currency_code}}
                                        @endif
                                        {{isset($orderItem->price) ? $orderItem->price : '' }}</h6>
                                    </td>
                                    <td>{{isset($orderItem->quantity) ? $orderItem->quantity : '' }} {{isset($orderItem->quantity) ? __('main.qty') : '' }}</td>
                                    <td>{{Carbon::parse($orderItem->delivery_time)->toDayDateTimeString()}}</td>
                                    <td class="fw-medium text-end">
                                        @if(isset($currency->data->currency_symbol))
                                            {{$currency->data->currency_symbol}}
                                        @elseif(isset($currency->data->currency_code))
                                            {{$currency->data->currency_code}}
                                        @endif
                                        {{$orderItem->price * $orderItem->quantity}}
                                    </td>
                                </tr>
                                    <tr class="collapse multi-collapse hide" id="multiCollapseExample{{$orderItem->id}}">
                                        <td colspan="4">
                                            <div class="row d-flex flex-wrap justify-content-center">
                                                {{-- <div class="col-lg-6 col-12"> --}}
                                                <div class="col-12">
                                                    <h6>{{__('main.default_product')}}</h6>
                                                    @if(isset($orderItem->data->defaultProducts))
                                                        @foreach ($orderItem->data->defaultProducts as $packageDefaultProduct)
                                                        <div class="row pb-2">
                                                            <div class="col-lg-2 col-md-3 col-sm-3 col-4">
                                                                <div id="image" class="package-product-image-container">
                                                                    <img @if(isset($packageDefaultProduct->productimage))
                                                                    src="{{$packageDefaultProduct->productimage}}" alt="{{isset($packageDefaultProduct->producttitle) ? $packageDefaultProduct->producttitle : '' }}"
                                                                    @else
                                                                    src="{{asset("assets/images/No_Image_Available.jpg")}}" alt="{{isset($packageDefaultProduct->producttitle) ? $packageDefaultProduct->producttitle : '' }}"
                                                                    @endif class="package-product-image-for-order" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-3 col-sm-3 col-6">
                                                                {{isset($packageDefaultProduct->producttitle) ? $packageDefaultProduct->producttitle : '' }}
                                                            </div>
                                                            <div class="col-lg-2 col-md-3 col-sm-3 col-2">
                                                                {{isset($packageDefaultProduct->quantity) ? $packageDefaultProduct->quantity : '' }} {{isset($packageDefaultProduct->quantity) ? __('main.qty') : '' }}
                                                            </div>
                                                            <div class="col-lg-2 col-md-3 col-sm-3 col-2">
                                                                @switch($packageDefaultProduct->type)
                                                                    @case("Configured Product")
                                                                        <span>{{isset($packageDefaultProduct->type) ? $packageDefaultProduct->type : '' }}</span>
                                                                        @if(isset($packageDefaultProduct->combination) && !empty($packageDefaultProduct->combination))
                                                                        @foreach($packageDefaultProduct->combination as $key => $value)
                                                                        <span><strong>{{ $key }}</strong> :
                                                                            @foreach($value as $key => $val)
                                                                                {{ $val->name }},
                                                                            @endforeach
                                                                        </span>
                                                                        @endforeach
                                                                        @endif
                                                                        @break
                                                                    @case("Simple Product")
                                                                        <span>{{isset($packageDefaultProduct->type) ? $packageDefaultProduct->type : '' }}</span>
                                                                        @break
                                                                    @default
                                                                @endswitch
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                                {{-- <div class="col-lg-6 col-12"> --}}
                                                <div class="col-12">
                                                    @if(isset($orderItem->data->productsDetails))
                                                    <h6>{{__('main.ordered_product')}}</h6>
                                                        @foreach ($orderItem->data->productsDetails as $packageOrderedProduct)
                                                        <div class="row pb-2 flex-nowrap">
                                                            <div class="col-lg-2 col-md-3 col-sm-3 col-4">
                                                                <div id="image" class="package-product-image-container">
                                                                    <img @if(isset($packageOrderedProduct->productimage))
                                                                    src="{{$packageOrderedProduct->productimage}}" alt="{{isset($packageOrderedProduct->producttitle) ? $packageOrderedProduct->producttitle : '' }}"
                                                                    @else
                                                                    src="{{asset("assets/images/No_Image_Available.jpg")}}" alt="{{isset($packageOrderedProduct->producttitle) ? $packageOrderedProduct->producttitle : '' }}"
                                                                    @endif class="package-product-image-for-order"/>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-3 col-sm-3 col-6">
                                                                {{isset($packageOrderedProduct->producttitle) ? $packageOrderedProduct->producttitle : '' }}
                                                            </div>
                                                            <div class="col-lg-2 col-md-3 col-sm-3 col-2">
                                                                {{isset($packageOrderedProduct->quantity) ? $packageOrderedProduct->quantity : '' }} {{isset($packageOrderedProduct->quantity) ? __('main.qty') : '' }}
                                                            </div>
                                                            <div class="col-lg-2 col-md-3 col-sm-3 col-2">
                                                                @switch($packageDefaultProduct->type)
                                                                    @case("Configured Product")
                                                                        <span>{{isset($packageDefaultProduct->type) ? $packageDefaultProduct->type : '' }}</span>
                                                                        @if(isset($packageDefaultProduct->combination) && !empty($packageDefaultProduct->combination))
                                                                        @foreach($packageDefaultProduct->combination as $key => $value)
                                                                        <span><strong>{{ $key }}</strong> :
                                                                            @foreach($value as $key => $val)
                                                                                {{ $val->name }},
                                                                            @endforeach
                                                                        </span>
                                                                        @endforeach
                                                                        @endif
                                                                        @break
                                                                    @case("Simple Product")
                                                                        <span>{{isset($packageDefaultProduct->type) ? $packageDefaultProduct->type : '' }}</span>
                                                                        @break
                                                                    @default
                                                                @endswitch
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                             <tr class="border-top border-top-dashed">
                                <td colspan="3"></td>
                                <td colspan="2" class="fw-medium p-0">
                                    <table class="table table-borderless mb-0">
                                        <tbody>
                                            <tr>
                                                <td>{{__('main.items_price')}} :</td>
                                                <td class="text-end">
                                                    @if(isset($currency->data->currency_symbol))
                                                        {{$currency->data->currency_symbol}}
                                                    @elseif(isset($currency->data->currency_code))
                                                        {{$currency->data->currency_code}}
                                                    @endif {{$allOrders->items_price}}
                                                </td>
                                            </tr>
                                            <tr class="border-top border-top-dashed">
                                                <th scope="row">{{__('main.total')}} :</th>
                                                <th class="text-end">
                                                    @if(isset($currency->data->currency_symbol))
                                                        {{$currency->data->currency_symbol}}
                                                    @elseif(isset($currency->data->currency_code))
                                                        {{$currency->data->currency_code}}
                                                    @endif {{$allOrders->total_amount}}
                                                </th>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div><!--end card-->
        <div class="card">
            <div class="card-header">
                <div class="d-sm-flex align-items-center">
                    <h5 class="card-title flex-grow-1 mb-0">{{__('main.delivery_note')}}</h5>
                </div>
            </div>
            <div class="card-body">
                <span class="text-muted">
                    {{isset($allOrders->delivery_note) ? $allOrders->delivery_note : '' }}
                </span>
            </div>
        </div>
        {{-- <div class="card">
            <div class="card-header">
                <div class="d-sm-flex align-items-center">
                    <h5 class="card-title flex-grow-1 mb-0">Order Status</h5>
                    <div class="flex-shrink-0 mt-2 mt-sm-0">
                        <a href="javasccript:void(0;)" class="btn btn-soft-info btn-sm mt-2 mt-sm-0"><i class="ri-map-pin-line align-middle me-1"></i> Change Address</a>
                        <a href="javasccript:void(0;)" class="btn btn-soft-danger btn-sm mt-2 mt-sm-0"><i class="mdi mdi-archive-remove-outline align-middle me-1"></i> Cancel Order</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="profile-timeline">
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item border-0">
                            <div class="accordion-header" id="headingOne">
                                <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0 avatar-xs">
                                            <div class="avatar-title bg-success rounded-circle">
                                                <i class="ri-shopping-bag-line"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="fs-15 mb-0 fw-semibold">Order Placed - <span class="fw-normal">Wed, 15 Dec 2021</span></h6>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body ms-2 ps-5 pt-0">
                                    <h6 class="mb-1">An order has been placed.</h6>
                                    <p class="text-muted">Wed, 15 Dec 2021 - 05:34PM</p>

                                    <h6 class="mb-1">Seller has proccessed your order.</h6>
                                    <p class="text-muted mb-0">Thu, 16 Dec 2021 - 5:48AM</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item border-0">
                            <div class="accordion-header" id="headingTwo">
                                <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0 avatar-xs">
                                            <div class="avatar-title bg-success rounded-circle">
                                                <i class="mdi mdi-gift-outline"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="fs-15 mb-1 fw-semibold">Packed - <span class="fw-normal">Thu, 16 Dec 2021</span></h6>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div id="collapseTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                <div class="accordion-body ms-2 ps-5 pt-0">
                                    <h6 class="mb-1">Your Item has been picked up by courier patner</h6>
                                    <p class="text-muted mb-0">Fri, 17 Dec 2021 - 9:45AM</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item border-0">
                            <div class="accordion-header" id="headingThree">
                                <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0 avatar-xs">
                                            <div class="avatar-title bg-success rounded-circle">
                                                <i class="ri-truck-line"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="fs-15 mb-1 fw-semibold">Shipping - <span class="fw-normal">Thu, 16 Dec 2021</span></h6>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div id="collapseThree" class="accordion-collapse collapse show" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                <div class="accordion-body ms-2 ps-5 pt-0">
                                    <h6 class="fs-14">RQK Logistics - MFDS1400457854</h6>
                                    <h6 class="mb-1">Your item has been shipped.</h6>
                                    <p class="text-muted mb-0">Sat, 18 Dec 2021 - 4.54PM</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item border-0">
                            <div class="accordion-header" id="headingFour">
                                <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse" href="#collapseFour" aria-expanded="false">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0 avatar-xs">
                                            <div class="avatar-title bg-light text-success rounded-circle">
                                                <i class="ri-takeaway-fill"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="fs-14 mb-0 fw-semibold">Out For Delivery</h6>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="accordion-item border-0">
                            <div class="accordion-header" id="headingFive">
                                <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse" href="#collapseFile" aria-expanded="false">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0 avatar-xs">
                                            <div class="avatar-title bg-light text-success rounded-circle">
                                                <i class="mdi mdi-package-variant"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="fs-14 mb-0 fw-semibold">Delivered</h6>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div><!--end accordion-->
                </div>
            </div>
        </div><!--end card--> --}}
    </div><!--end col-->
    <div class="col-xl-3 col-lg-12 col-12">
        <div class="card">
            <div class="card-header">
               <div class="d-flex">
                    <h5 class="card-title flex-grow-1 mb-0">Customer Details</h5>
                    <div class="flex-shrink-0">
                        @if(isset($allOrders->user->uuid))
                            <a href="{{ route('admin.viewUser',['uuid' => $allOrders->user->uuid]) }}" class="link-secondary">View Profile</a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="card-body">
                <ul class="list-unstyled mb-0 vstack gap-3">
                    <li>
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                {{-- <img src="{{ URL::asset('assets/images/users/avatar-3.jpg') }}" alt="" class="avatar-sm rounded"> --}}
                                <img class="avatar-sm rounded" src="{{!empty($allOrders->user->profile_image) ? $allOrders->user->profile_image: asset("assets/images/users/user-dummy-img.jpg")}}" style="width: 100% !important">
                            </div>
                            <div class="flex-grow-1 ms-3">
                               <h6 class="fs-15 mb-1">{{isset($allOrders->user->full_name) ? $allOrders->user->full_name : '' }}</h6>
                            </div>
                        </div>
                    </li>
                    <li><i class="ri-mail-line me-2 align-middle text-muted fs-16"></i>{{isset($allOrders->user->email) ? $allOrders->user->email : '' }}</li>
                    <li><i class="ri-phone-line me-2 align-middle text-muted fs-16"></i>{{isset($allOrders->user->phone) ? $allOrders->user->phone : '' }}</li>
                </ul>
            </div>
        </div><!--end card-->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0"><i class="ri-map-pin-line align-middle me-1 text-muted"></i> Billing Address</h5>
            </div>
            <div class="card-body">
                <ul class="list-unstyled vstack gap-2 fs-14 mb-0">
                    <li class="fw-semibold fs-15">{{isset($allOrders->orderAddress->full_name) ? $allOrders->orderAddress->full_name : 'helo' }}</li>
                    <li>{{isset($allOrders->orderAddress->phone) ? $allOrders->orderAddress->phone : '' }}</li>
                    <li>{{isset($allOrders->orderAddress->address) ? $allOrders->orderAddress->address : '' }}</li>
                    <li>{{isset($allOrders->orderAddress->city->name) ? $allOrders->orderAddress->city->name : '' }} -- {{isset($allOrders->orderAddress->zip_code) ? $allOrders->orderAddress->zip_code : '' }}</li>
                    <li>{{isset($allOrders->orderAddress->state->name) ? $allOrders->orderAddress->state->name : '' }} -- {{isset($allOrders->orderAddress->country->name) ? $allOrders->orderAddress->country->name : '' }}</li>
                </ul>
            </div>
        </div><!--end card-->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0"><i class="ri-map-pin-line align-middle me-1 text-muted"></i> Shipping Address</h5>
            </div>
            <div class="card-body">
                <ul class="list-unstyled vstack gap-2 fs-14 mb-0">
                    <li class="fw-semibold fs-15">{{isset($allOrders->orderAddress->full_name) ? $allOrders->orderAddress->full_name : 'helo' }}</li>
                    <li>{{isset($allOrders->orderAddress->phone) ? $allOrders->orderAddress->phone : '' }}</li>
                    <li>{{isset($allOrders->orderAddress->address) ? $allOrders->orderAddress->address : '' }}</li>
                    <li>{{isset($allOrders->orderAddress->city->name) ? $allOrders->orderAddress->city->name : '' }} -- {{isset($allOrders->orderAddress->zip_code) ? $allOrders->orderAddress->zip_code : '' }}</li>
                    <li>{{isset($allOrders->orderAddress->state->name) ? $allOrders->orderAddress->state->name : '' }} -- {{isset($allOrders->orderAddress->country->name) ? $allOrders->orderAddress->country->name : '' }}</li>
                </ul>
            </div>
        </div><!--end card-->

        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0"><i class="ri-secure-payment-line align-bottom me-1 text-muted"></i> Payment Details</h5>
            </div>
            <div class="card-body">
                <div class="d-flex align-items-center mb-2">
                    <div class="flex-shrink-0">
                       <p class="text-muted mb-0">Transactions:</p>
                    </div>
                    <div class="flex-grow-1 ms-2">
                        <h6 class="mb-0">#{{isset($allOrders->transaction_id) ? $allOrders->transaction_id : '' }}</h6>
                     </div>
                </div>
                <div class="d-flex align-items-center mb-2">
                    <div class="flex-shrink-0">
                       <p class="text-muted mb-0">Payment Method:</p>
                    </div>
                    <div class="flex-grow-1 ms-2">
                        <h6 class="mb-0">{{isset($allOrders->paymentMethod->name) ? $allOrders->paymentMethod->name : '' }}</h6>
                     </div>
                </div>
                {{-- <div class="d-flex align-items-center mb-2">
                    <div class="flex-shrink-0">
                       <p class="text-muted mb-0">Card Holder Name:</p>
                    </div>
                    <div class="flex-grow-1 ms-2">
                        <h6 class="mb-0">Joseph Parker</h6>
                     </div>
                </div>
                <div class="d-flex align-items-center mb-2">
                    <div class="flex-shrink-0">
                       <p class="text-muted mb-0">Card Number:</p>
                    </div>
                    <div class="flex-grow-1 ms-2">
                        <h6 class="mb-0">xxxx xxxx xxxx 2456</h6>
                     </div>
                </div> --}}
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                       <p class="text-muted mb-0">Total Amount:</p>
                    </div>
                    <div class="flex-grow-1 ms-2">
                        <h6 class="mb-0">
                            @php
                              $currency = (isset($allOrders->currency) && gettype($allOrders->currency) == 'string') ? json_decode($allOrders->currency) : null ;
                            @endphp
                            @if(isset($currency->en))
                            {{$currency->en}}
                            @endif {{$allOrders->total_amount}}
                        </h6>
                     </div>
                </div>
            </div>
        </div><!--end card-->
    </div><!--end col-->
</div>
@endsection
@section('script')
<script>
  $(document).ready(function() {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $('#order_status').change(function() {
      var orderId = $("#orderId").data("id");
      var selectedOptionText = $('#order_status').find(":selected").text();
      var selectedOptionValue = $('#order_status').find(":selected").val();
      $(this).find("option:selected").each(function() {
        swal({
            title: "Are you sure?"
            , text: "Change status to " + selectedOptionText + ""
            , icon: "warning"
            , buttons: true
            , dangerMode: true
          , })
          .then((willDelete) => {
            if (willDelete) {
              var data = {
                "_token": $('a[name="csrf-token"]').val()
                , "id": orderId
                , "selectedOptionValue": selectedOptionValue
              , }
              $.ajax({
                type: "POST"
                , url: "{{ route('admin.changeOrderStatus', '') }}" + "/" + orderId
                , data: data
                , success: function(response) {
                  swal({
                      icon: "success"
                      , text: "Order Status Updated"
                      , buttons: false
                      , dangerMode: true
                      , timer: 3000
                    , })
                    .then((result) => {
                      location.reload();
                    });
                }
              });
            }
          });
      });
    });
    $('#payment_status').change(function() {
      var orderId = $("#orderId").data("id");
      var selectedOptionText = $('#payment_status').find(":selected").text();
      var selectedOptionValue = $('#payment_status').find(":selected").val();
      $(this).find("option:selected").each(function() {
        swal({
            title: "Are you sure?"
            , text: "Change status to " + selectedOptionText + ""
            , icon: "warning"
            , buttons: true
            , dangerMode: true
          , })
          .then((willDelete) => {
            if (willDelete) {
              var data = {
                "_token": $('a[name="csrf-token"]').val()
                , "id": orderId
                , "selectedOptionValue": selectedOptionValue
              , }
              $.ajax({
                type: "POST"
                , url: "{{ route('admin.changePaymentStatus') }}"
                , data: data
                , success: function(response) {
                  swal({
                      icon: "success"
                      , text: "Payment Status Updated"
                      , buttons: false
                      , dangerMode: true
                      , timer: 3000
                    , })
                    .then((result) => {
                      location.reload();
                    });
                }
              });
            }
          });
      });
    });
  });
</script>
@endsection
