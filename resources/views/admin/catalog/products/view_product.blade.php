@php
    $lang = Session::get('locale')
@endphp
@extends('layouts.admin.layout')
@section('title')
{{ __('main.view_product')}}
@endsection
@section('css')
    <link rel="stylesheet" href={{asset("assets/css/dropify.css")}}>
    <link href="{{ URL::asset('assets/libs/swiper/swiper.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') {{__('main.view')}} @endslot
@slot('title') {{__('main.product')}} @endslot
@slot('link') {{route('admin.productList')}} @endslot
@endcomponent
  <section class="content">
    <div class="card shadow mb-4">
      <div class="card-header border-0">
        <div class="d-flex align-items-center">
            <h5 class="card-title mb-0 flex-grow-1">
                {{__('main.package_detail')}}
            </h5>
            <div class="flex-shrink-0">
                <a class="btn btn-primary edit-item-btn" href="{{ route('admin.editProduct', ['id' => $productDetails->id]) }}"><i class="ri-edit-line fs-16"></i></a>

                <a href="javascript:void(0)" id='deleteProduct' class="btn btn-danger remove-item-btn" data-id="{{ $productDetails->id }}"><i class="ri-delete-bin-2-line fs-16"></i></a>
            </div>
        </div>
       </div>

      <div class="row">
        <div class="col-lg-12">
            <div class="card shadow-none">
                <div class="card-body">
                    <div class="row gx-lg-5">
                        <div class="col-xl-4 col-md-8 mx-auto">
                            <div class="product-img-slider sticky-side-div">
                                <div class="swiper product-thumbnail-slider p-2 rounded bg-light">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide    ">
                                            <div class="customeslider-container-image">
                                            <img src="{{ $productDetail['productimage'] }}" alt="{{$productDetail['producttitle'][$lang]}}" class="img-fluid d-block" />
                                        </div>
                                        </div>
                                        @if(isset($productDetail['productgallery']) && !empty($productDetail['productgallery']))
                                            @foreach($productDetail['productgallery'] as $key => $value)
                                                @if (isset($value) && !empty($value))
                                                    <div class="swiper-slide">
                                                        <div class="customeslider-container-image">
                                                            <img src="{{$value['name']}}" alt="{{$productDetail['producttitle'][$lang].$value['name']}}"
                                                            class="img-fluid d-block" />
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>
                                    <div class="swiper-button-next"></div>
                                    <div class="swiper-button-prev"></div>
                                </div>
                                <!-- end swiper thumbnail slide -->
                                <div class="swiper product-nav-slider mt-2">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            <div class="nav-slide-item">
                                                <img src="{{ $productDetail['productimage'] }}" alt="{{$productDetail['producttitle'][$lang]}}"
                                                    class="img-fluid d-block" />
                                            </div>
                                        </div>
                                        @if(isset($productDetail['productgallery']) && !empty($productDetail['productgallery']))
                                            @foreach($productDetail['productgallery'] as $key => $value)
                                                @if (isset($value) && !empty($value))
                                                    <div class="swiper-slide" style="width: 100px;height: 100px;">
                                                        <div class="nav-slide-item" style="width: 100px;height: 100px;">
                                                            <img src="{{ $value['thumbnail_name'] }}" alt="{{$value['thumbnail_name']}}"
                                                                class="img-fluid d-block" />
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                <!-- end swiper nav slide -->
                            </div>
                        </div>
                        <div class="col-xl-8">
                            <div class="table-responsive table-card mb-1">
                                <table class="table align-middle">
                                    <tbody class="">
                                        <tr>
                                            <td><strong>{{__('main.is_active')}}</strong></td>
                                            <td>
                                                @switch($productDetails->is_active)
                                                    @case(1)
                                                        <span class="badge badge-soft-success text-uppercase">{{__('main.active')}}</span>
                                                        @break
                                                    @default
                                                        <span class="badge badge-soft-danger text-uppercase">{{__('main.in_active')}}</span>
                                                @endswitch
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>{{__('main.product_type')}}</strong></td>
                                            <td style="width: 30%"> {{isset($productDetails->type) ? $productDetails->type : '' }} </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 30%"><strong>{{ __('main.categories') }}</strong></td>
                                            <td style="width: 30%">
                                                @foreach ($productDetails['categories'] as $categories)
                                                {{ $categories['name'] }} ,
                                                @endforeach
                                            </td>
                                        </tr>
                                        @foreach ($productDetails->productAttribute as $item)
                                            @if ($item->field_type !== 5 && $item->field_type !== 28)
                                                <tr>
                                                    <td style="width: 30%"><strong>{{ $item->label_name }}</strong></td>
                                                    <td style="width: 30%">{{ $item->pivot->data }}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        @if(isset($productDetail['combination']) && !empty($productDetail['combination']))
                                            @foreach($productDetail['combination'] as $key => $value)
                                            <tr>
                                                <td style="width: 30%"><strong>{{ $key }}</strong></td>
                                                <td style="width: 30%">
                                                    @foreach($value as $key => $val)
                                                    {{ $val['name'] }},
                                                    @endforeach
                                                </td>
                                            </tr>
                                            @endforeach
                                        @endif

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-8 d-flex flex-row justify-content-center">

        </div>
        <div class="col-4">

        </div>
    </div>
  </section>
@endsection
@section('script')
  <script src={{asset("assets/libs/swiper/swiper.min.js")}}></script>
  <script src={{asset("assets/js/pages/ecommerce-product-details.init.js")}}></script>
  <script>
    $(document).ready(function() {
      $('.dropify').dropify();
    });
  </script>
  <script>
    $(document).ready(function() {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $('#deleteProduct').click(function(e) {
        e.preventDefault();

        var id = $(this).data("id");
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this Product!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              var data = {
                "_token": $('a[name="csrf-token"]').val(),
                "id": id,
              }
              $.ajax({
                type: "DELETE",
                url: "{{ route('admin.destroyProduct', '') }}" + "/" + id,
                data: data,
                success: function(response) {
                  swal(response.status, {
                      icon: "success",
                      timer: 3000,
                    })
                    .then((result) => {
                      window.location =
                        '{{ route('admin.productList') }}'
                    });
                }
              });
            }
          });
      });
    });
  </script>
@endsection
