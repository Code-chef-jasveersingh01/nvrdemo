@extends('layouts.admin.layout')
@section('title')
    {{ __('main.edit_occasion')}}
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') {{__('main.edit')}} @endslot
@slot('title') {{__('main.special_occasion')}} @endslot
@slot('link') {{route('admin.specialOccasionList')}} @endslot
@endcomponent
<section class="content">
  <div id="loading"></div>
  <div id="full-body">
    <div class="card shadow mb-4">
      <div class="card-body">
        <form method="POST" action="{{ route('admin.updateSepcialOccasion',['id' => $specialOccasion->id]) }}" enctype="multipart/form-data">
          @csrf
          @php
            $specialOccasionProducts[] = '';
            if ($specialOccasion->product_type == "1"){
                if (collect($specialOccasion->products)->isEmpty()) {
                    $specialOccasionProducts[] = '';
                } elseif (isset($specialOccasion->products)) {
                    foreach ($specialOccasion->products as $product) {
                        $specialOccasionProducts[] = $product;
                    }
                }
            }elseif ($specialOccasion->product_type == "2") {
                if (collect($specialOccasion->packages)->isEmpty()) {
                    $specialOccasionProducts[] = '';
                } elseif (isset($specialOccasion->packages)){
                    foreach ($specialOccasion->packages as $package) {
                        $specialOccasionProducts[] = $package;
                    }
                }
            }
          @endphp
          <div class="row">
            <div class="col-6">
                <div class="mb-4">
                    <label class="form-label" for="image">{{__('main.upload_image')}} <code>({{__('main.required')}})</code></label>
                    <input class="dropify" id="formFile" name="image" type="file" data-min-height="900" data-min-width="1750" accept="image/png, image/jpeg, image/jpg" @if ($specialOccasion->image) data-default-file='{{ $specialOccasion->image}}' @endif />
                </div>
                <div class="mb-2">
                    <input type="checkbox" class="filled-in chk-col-primary" id="is_active" name="is_active" @if($specialOccasion->is_active === 1) checked @endif />
                    <label class="small mb-1" for="is_active">{{__('main.is_active')}}</label>
                </div>
            </div>
            <div class="col-6">
                <div class="mt-4 mb-4">
                    <input class="form-check-input m-1" type="radio" name="product_type" id="sp-product" value="1" @if($specialOccasion->product_type == "1") checked @else data-id="1" @endif>
                    <label class="form-check-label m-1" for="formradioRight5">{{__('main.product')}}</label>
                    <input class="form-check-input m-1" type="radio" name="product_type" id="sp-package" value="2" @if($specialOccasion->product_type == "2") checked @else data-id="2" @endif>
                    <label class="form-check-label m-1" for="formradioRight5">{{__('main.package')}}</label>
                </div>
                <div class="mb-2">
                    @include('components.edit_lang_input',['inputType'=>'vertical',
                        'label_class'=>'form-label',
                        'input_class'=>"form-control @error('name') is-invalid @enderror",
                        'field_lable'=> __('main.name'),
                        'en_required'=>'1',
                        'ar_required'=>'1',
                        'field_placeholder'=>__('main.Enter Special Occasion Name'),
                        'field_name'=>'name',
                        'value'=>'name',
                        'data_obj'=>$specialOccasion
                    ])
                    {{-- <label class="form-label" for="name">{{__('main.name')}}</label>
                    <input class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $specialOccasion->name }}" type="text" placeholder="{{__('main.Enter Special Occasion Name')}}" required autofocus> --}}
                </div>
                <div class="mb-2">
                    <label class="form-label mb-0">{{__('main.date_range')}}</label>
                    <input type="text" class="form-control selector" name="dateRange" data-provider="flatpickr" data-minDate="today" data-date-format="Y-m-d" data-range-date="true" data-altFormat="F j, Y">
                </div>
            </div>
          </div>
          <div class="row gx-3 mb-3 dropdownattribute" id="dropdownOption">
        </div>
        <div class="row gx-3 mb-3">
        <div class="col-6 mb-3">
            <a class="btn btn-secondary mr-2" href="{{url()->previous()}}">{{__('main.cancel')}}</a>
            <button class="btn btn-primary" type="submit">{{__('main.save_changes')}}</button>
        </div>
        </div>
        </form>
      </div>
    </div>
  </div>
</section>
<x-modal>
    <x-slot name="id">productModal</x-slot>
    <x-slot name="modalTitle">{{__('main.add_product')}}</x-slot>
    <x-slot name="modalFormId">productList</x-slot>
    <x-slot name="modalFormBody">
        <div class="table-responsive table-card">
            <table id="productTable" class="table table-nowrap align-middle mb-0">
                <thead class="table-light text-muted">
                    <tr>
                      <th scope="col" class="text-center">{{__('main.product_id')}}</th>
                      <th scope="col" class="text-center">{{__('main.product_image')}}</th>
                      <th scope="col" class="text-center">{{__('main.product_type')}}</th>
                      <th scope="col" class="text-center">{{__('main.product_name')}}</th>
                      <th scope="col" class="text-center">{{__('main.original_price')}}</th>
                      <th scope="col" class="text-center">{{__('main.selling_price')}}</th>
                      <th scope="col" class="text-center">{{__('main.action')}}</th>
                    </tr>
                  </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr class="product" id="productTr{{$product['productId']}}">
                            <td>
                                <div class="text-center">
                                    {{$product['productId']}}
                                </div>
                            </td>
                            <td>
                                <div class="flex-shrink-0 avatar-md bg-light rounded p-1">
                                    <img src="{{(isset($product['productimage']) && !empty($product['productimage'])) ? $product['productimage'] : asset("assets/images/No_Image_Available.jpg")}}" alt="{{$product['producttitle'][app()->getLocale()]}}" class="img-fluid d-block">
                                </div>
                            </td>
                            <td>
                                <div class="text-center">
                                    {{$product['type']}}
                                </div>
                            </td>
                            <td>
                                <div class="flex-grow-1 ms-3 text-center">
                                    <h5 class="fs-16"><a data-bs-toggle="collapse" href="#multiCollapseExample{{$product['productId']}}" role="button" aria-expanded="false" aria-controls="multiCollapseExample{{$product['productId']}}" class="link-primary">{{$product['producttitle'][app()->getLocale()]}} <span class="text-muted mb-0 fw-medium"> &#40; {{__('main.click_to_see_product_details')}} &#41; </span> </a> </h5>
                               </div>
                            </td>
                            <td>
                                <div class="text-center">
                                    {{($product['type'] == "Simple Product") ? $product['originalprice'] : ''}}
                                </div>
                            </td>
                            <td>
                                <div class="text-center">
                                    {{($product['type'] == "Simple Product") ? $product['sellingprice'] : ''}}
                                </div>
                            </td>
                            <td class="fw-medium text-end">
                                <a href="javascript:void(0)" data-action="add_new_row" data-id="{{$product['productId']}}" data-type="1" title="Add Product to Package" class="btn btn-primary add_new_product_button">
                                    <span>{{__('main.add_product')}}</span>
                                </a>
                            </td>
                        </tr>
                        <tr class="collapse multi-collapse hide" id="multiCollapseExample{{$product['productId']}}">
                            @switch($product['type'])
                                @case("Simple Product")
                                    <td colspan="4">
                                        <div class="row d-flex flex-wrap justify-content-center">
                                            <div class="col-12">
                                                {{__('main.product_name')}}: {{isset($product['producttitle'][app()->getLocale()]) ? $product['producttitle'][app()->getLocale()] : ''}}
                                            </div>
                                            <div class="col-12">
                                                {{__('main.status')}}: {{isset($product['stockstatus']) ? $product['stockstatus'] : ''}}
                                            </div>
                                            <div class="col-12">
                                                {{__('main.short_description')}}: {{isset($product['shortdescription'][app()->getLocale()]) ? $product['shortdescription'][app()->getLocale()] : ''}}
                                            </div>
                                            <div class="col-12">
                                                {{__('main.product_description')}}: {{isset($product['description'][app()->getLocale()]) ? $product['description'][app()->getLocale()] : ''}}
                                            </div>
                                            <div class="col-12">
                                                {{__('main.manufacturer_name')}}: {{isset($product['manufacturername'][app()->getLocale()]) ? $product['manufacturername'][app()->getLocale()] : ''}}
                                            </div>
                                            <div class="col-12">
                                                {{__('main.manufacturer_brand')}}: {{isset($product['manufacturerbrand'][app()->getLocale()]) ? $product['manufacturerbrand'][app()->getLocale()] : ''}}
                                            </div>
                                            <div class="col-12">
                                                {{__('main.original_price')}}: {{isset($product['originalprice']) ? $product['originalprice'] : ''}}
                                            </div>
                                            <div class="col-12">
                                                {{__('main.profit_percentage')}}: {{isset($product['profitpercentage']) ? $product['profitpercentage'] : ''}}
                                            </div>
                                            <div class="col-12">
                                                {{__('main.selling_price')}}: {{isset($product['sellingprice']) ? $product['sellingprice'] : ''}}
                                            </div>
                                            <div class="col-12">
                                                {{__('main.profit')}}: {{isset($product['profit']) ? $product['profit'] : ''}}
                                            </div>
                                            <div class="col-12">
                                                {{__('main.discount')}}: {{(isset($product['discount']) && $product['discount'] != ' ') ? $product['discount'] : 0}}
                                            </div>
                                        </div>
                                    </td>
                                    @break
                                @case("Configured Product")
                                <td colspan="7" class="text-center">
                                    <div class="row d-flex flex-wrap justify-content-center">
                                        <table class="table table-nowrap align-middle mb-0">
                                            <thead class="table-light text-muted">
                                                <tr>
                                                    <th scope="col" class="text-center">{{__('main.product_image')}}</th>
                                                    @foreach($product['ths'] as $key => $th)
                                                        <th scope="col" class="text-center">{{$th}}</th>
                                                    @endforeach
                                                    <th scope="col" class="text-center">{{__('main.selling_price')}}</th>
                                                    <th scope="col" class="text-center">{{__('main.action')}}</th>
                                                  </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($product['product_variation'] as $key => $value)
                                                <tr id="variantTr{{$value['id']}}">
                                                    <td>
                                                        <div class="flex-shrink-0 avatar-md bg-light rounded p-1">
                                                            <img src="{{$value['image']}}" alt="{{$value['sku']}}" class="img-fluid d-block">
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="text-center">
                                                            {{$value['sku']}}
                                                        </div>
                                                    </td>
                                                    @foreach($value['variation_combination'] as $key => $variation_combination)
                                                    <td class="text-center">
                                                        <div class="text-center">
                                                            {{$variation_combination['name']}}
                                                        </div>
                                                    </td>
                                                    @endforeach
                                                    <td class="text-center">
                                                        <div class="text-center">
                                                            {{$value['price']}}
                                                        </div>
                                                    </td>
                                                    {{-- <td class="fw-medium text-end">
                                                        <div class="text-center">
                                                            <button id="add_new_option_button" data-action="add_new_row" data-id="{{$product['productId']}}" data-type="2" data-variation="{{$value['id']}}" title="Add Product to Package" type="button" class="btn btn-primary">
                                                                <span>{{__('main.add_product')}}</span>
                                                            </button>
                                                        </div>
                                                    </td> --}}
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                                    @break
                                @default
                            @endswitch
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </x-slot>
    <x-slot name="modalFormFooter"></x-slot>
    <x-slot name="modalFormSumbitText">{{__('main.update')}}</x-slot>
</x-modal>
<x-modal>
    <x-slot name="id">packageModal</x-slot>
    <x-slot name="modalTitle">{{__('main.add_package')}}</x-slot>
    <x-slot name="modalFormId">packageList</x-slot>
    <x-slot name="modalFormBody">
        {{-- <div class="table-responsive table-card"> --}}
            <table class="table table-nowrap align-middle mb-0">
                <thead class="table-light text-muted">
                    <tr>
                      <th scope="col" class="text-center">{{__('main.package_id')}}</th>
                      <th scope="col" class="text-center">{{__('main.package_image')}}</th>
                      <th scope="col" class="text-center">{{__('main.package_name')}}</th>
                      <th scope="col" class="text-center">{{__('main.original_price')}}</th>
                      <th scope="col" class="text-center">{{__('main.selling_price')}}</th>
                      {{-- <th scope="col" class="text-center">{{__('main.is_active')}}</th> --}}
                      <th scope="col" class="text-center">{{__('main.action')}}</th>
                    </tr>
                  </thead>
                <tbody>
                    @foreach ($packages as $package)
                        <tr class="package" id="packageTr{{$package['id']}}">
                            <td>
                                <div class="text-center">
                                    {{$package['id']}}
                                </div>
                            </td>
                            <td>
                                <div class="flex-shrink-0 avatar-md bg-light rounded p-1">
                                    <img src="{{(isset($package['image']) && !empty($package['image'])) ? $package['image'] : asset("assets/images/No_Image_Available.jpg")}}" alt="{{$package['package_name']}}" class="img-fluid d-block">
                                </div>
                            </td>
                            <td>
                                <div class="flex-grow-1 ms-3 text-center">
                                    <h5 class="fs-16 link-primary">{{$package['package_name']}} </h5>
                               </div>
                            </td>
                            <td>
                                <div class="text-center">
                                    {{(isset($package['original_price']) && !empty($package['original_price'])) ? $package['original_price'] : ''}}
                                </div>
                            </td>
                            <td>
                                <div class="text-center">
                                    {{(isset($package['price']) && !empty($package['price'])) ? $package['price'] : ''}}
                                </div>
                            </td>
                            <td class="fw-medium text-end">
                                <a href="javascript:void(0)" data-action="add_new_row" data-id="{{$package['id']}}" data-type="1" title="Add Package" class="btn btn-primary add_new_package_button">
                                    <span>{{__('main.add_package')}}</span>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tbody>
                </tbody>
            </table>
        {{-- </div> --}}
    </x-slot>
    <x-slot name="modalFormFooter"></x-slot>
    <x-slot name="modalFormSumbitText">{{__('main.update')}}</x-slot>
</x-modal>
@foreach ($products as $product)
<x-modal>
    <x-slot name="id">productdetail{{$product['productId']}}</x-slot>
    <x-slot name="modalTitle"> {{__('main.product_details')}}</x-slot>
    <x-slot name="modalFormId">{{__('main.product_details')}}</x-slot>
    <x-slot name="modalFormBody">
        <div class="row gx-lg-5">
            <div class="col-xl-4 col-md-8 mx-auto">
                <div class="product-img-slider sticky-side-div">
                    <div class="swiper product-thumbnail-slider p-2 rounded bg-light">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide    ">
                                <div class="customeslider-container-image">
                                <img src="{{ $product['productimage']}}" alt="{{$product['producttitle'][app()->getLocale()]}}"
                                    class="img-fluid d-block" />
                            </div>
                            </div>
                            @if(isset($product['gallery']) && !empty($product['gallery']))
                                @foreach($product['gallery'] as $key => $value)
                                    @if (isset($value) && !empty($value))
                                        <div class="swiper-slide">
                                            <div class="customeslider-container-image">
                                                <img src="{{$value['name']}}" alt="{{$value['name']}}"
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
                                    <img src="{{ $product['productimage']}}" alt="{{$product['producttitle'][app()->getLocale()]}}"
                                        class="img-fluid d-block" />
                                </div>
                            </div>
                            @if(isset($product['gallery']) && !empty($product['gallery']))
                                @foreach($product['gallery'] as $key => $value)
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
                                <td>{{__('main.is_active')}}</td>
                                <td>
                                    @switch($product['is_active'])
                                        @case(1)
                                            <span class="badge badge-soft-success text-uppercase">{{__('main.active')}}</span>
                                            @break
                                        @default
                                            <span class="badge badge-soft-danger text-uppercase">{{__('main.in_active')}}</span>
                                    @endswitch
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 30%"><strong>{{ __('main.categories') }}</strong></td>
                                <td style="width: 30%">
                                    @foreach ($product['category'] as $categories)
                                    {{ $categories['name'][app()->getLocale()] }} ,
                                    @endforeach
                                </td>
                            <tr>
                                <td style="width: 30%"><strong>{{__('main.product_name')}}: </strong></td>
                                <td style="width: 30%">{{isset($product['producttitle'][app()->getLocale()]) ? $product['producttitle'][app()->getLocale()] : ''}}</td>
                            </tr>
                            <tr>
                                <td style="width: 30%"><strong>{{__('main.status')}}: </strong></td>
                                <td style="width: 30%">{{isset($product['stockstatus']) ? $product['stockstatus'] : ''}}</td>
                            </tr>
                            <tr>
                                <td style="width: 30%"><strong>{{__('main.short_description')}}: </strong></td>
                                <td style="width: 30%">{{isset($product['shortdescription'][app()->getLocale()]) ? $product['shortdescription'][app()->getLocale()] : ''}}</td>
                            </tr>
                            <tr>
                                <td style="width: 30%"><strong>{{__('main.product_description')}}: </strong></td>
                                <td style="width: 30%">{{isset($product['description'][app()->getLocale()]) ? $product['description'][app()->getLocale()] : ''}}</td>
                            </tr>
                            <tr>
                                <td style="width: 30%"><strong>{{__('main.manufacturer_brand')}}: </strong></td>
                                <td style="width: 30%">{{isset($product['manufacturerbrand'][app()->getLocale()]) ? $product['manufacturerbrand'][app()->getLocale()] : ''}}</td>
                            </tr>
                            <tr>
                                <td style="width: 30%"><strong>{{__('main.manufacturer_name')}}: </strong></td>
                                <td style="width: 30%">{{isset($product['manufacturername'][app()->getLocale()]) ? $product['manufacturername'][app()->getLocale()] : ''}}</td>
                            </tr>
                            <tr>
                                <td style="width: 30%"><strong>{{__('main.original_price')}}: </strong></td>
                                <td style="width: 30%">{{isset($product['originalprice']) ? $product['originalprice'] : ''}}</td>
                            </tr>
                            <tr>
                                <td style="width: 30%"><strong>{{__('main.profit_percentage')}}: </strong></td>
                                <td style="width: 30%">{{isset($product['profitpercentage']) ? $product['profitpercentage'] : ''}}</td>
                            </tr>
                            <tr>
                                <td style="width: 30%"><strong>{{__('main.selling_price')}}: </strong></td>
                                <td style="width: 30%">{{isset($product['sellingprice']) ? $product['sellingprice'] : ''}}</td>
                            </tr>
                            <tr>
                                <td style="width: 30%"><strong>{{__('main.profit')}}: </strong></td>
                                <td style="width: 30%">{{isset($product['profit']) ? $product['profit'] : ''}}</td>
                            </tr>
                            <tr>
                                <td style="width: 30%"><strong>{{__('main.discount')}}</strong></td>
                                <td style="width: 30%">{{(isset($product['discount']) && $product['discount'] != ' ') ? $product['discount'] : 0}}</td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </x-slot>
    <x-slot name="modalFormFooter"></x-slot>
    <x-slot name="modalFormSumbitText"></x-slot>
</x-modal>
@endforeach
@endsection
@section('script')
<script src="{{ URL::asset('assets/libs/prismjs/prismjs.min.js') }}"></script>
<script src={{asset("assets/js/pages/dropify.min.js")}}></script>
<script type="text/javascript" src="/../assets/libs/flatpickr/flatpickr.min.js"></script>
<script>
    const lang = sessionStorage.getItem('lang');
  $(document).ready(function () {
    $('.selector').flatpickr({
			mode: 'range',
            enableTime: false,
            dateFormat: 'Y-m-d',
            defaultDate: ['{{ $specialOccasion->start_date }}', '{{ $specialOccasion->end_date }}'],
    });

    var AllProducts = {{(isset($products) && !empty($products))? Illuminate\Support\Js::from($products) : null}};
    var AllPackages = {{(isset($packages) && !empty($packages))? Illuminate\Support\Js::from($packages) : null}};
    var OccasionData = {{(isset($specialOccasionProducts) && !empty($specialOccasionProducts))? Illuminate\Support\Js::from($specialOccasionProducts) : null}};
    console.log(AllProducts,"AllProducts");
    console.log(AllPackages,"AllPackages");
    console.log(OccasionData,"OccasionData");
    $('.dropify').dropify();
    let product_type = $('input[name="product_type"]:checked').val();
    appendProductType(product_type);

    $('body').on('click','.form-check-input', function(){
        const valueOfField = $(this).val();
        const dbvalue = {!! $specialOccasion->product_type !!} ;
        let product_type = $('input[name="product_type"]:checked').val();
        (valueOfField != dbvalue) ? alertForChange() : appendProductType(product_type);
    });
    var rowIdx = 1;
    $('body').on('click','.add_new_product_button',function(e){
        e.preventDefault();
        const itemId = $(this).data('id');
        const selectedProduct = filterItem(itemId,AllProducts,1);
        const productTr = "#productTr"+itemId+"";

        $('#add_more').html();
        $('#add_more').append(`<tr id="productTr${itemId}">
                            <td>
                                <div class="text-center">
                                    ${selectedProduct.productId}
                                </div>
                            </td>
                            <td>
                                <div class="flex-shrink-0 avatar-md bg-light rounded p-1 m-auto">
                                    <img src="${(selectedProduct.productimage && selectedProduct.productimage !== null) ? selectedProduct.productimage : "{{asset('assets/images/No_Image_Available.jpg')}}"}" alt="${selectedProduct.producttitle[lang]}" class="img-fluid d-block">
                                </div>
                            </td>
                            <td>
                                <div class="text-center">
                                    <input type="hidden"  name="products[]" value="${itemId}">
                                    ${selectedProduct.producttitle[lang]}
                                </div>
                            </td>
                            <td>
                                <div class="flex-grow-1 ms-3 text-center">
                                    ${selectedProduct.type === "Simple Product" ? selectedProduct.originalprice : "" }
                               </div>
                            </td>
                            <td>
                                <div class="text-center">
                                    ${selectedProduct.type === "Simple Product" ? selectedProduct.sellingprice : "" }
                                </div>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-danger remove" id="remove_section${rowIdx}" data-id="${itemId}" data-type="1" type="button">{{__('main.remove')}}</button>
                            </td>
                        </tr>`);
        $('#productModal').modal('toggle');
        $(productTr+".product").addClass('collapse');
    });

    $('body').on('click','.add_new_package_button',function(e){
        e.preventDefault();
        const itemId = $(this).data('id');
        const selectedPackage = filterItem(itemId,AllPackages,2);
        const packageTr = "#packageTr"+itemId+"";
        $('#add_more').html();
        $('#add_more').append(`<tr id="productTr${itemId}">
                            <td>
                                <div class="text-center">
                                    ${selectedPackage.id}
                                </div>
                            </td>
                            <td>
                                <div class="flex-shrink-0 avatar-md bg-light rounded p-1 m-auto">
                                    <img src="${(selectedPackage.image && selectedPackage.image !== null) ? selectedPackage.image : "{{asset('assets/images/No_Image_Available.jpg')}}"}" alt="${selectedPackage.package_name}" class="img-fluid d-block">
                                </div>
                            </td>
                            <td>
                                <div class="text-center">
                                    <input type="hidden"  name="packages[]" value="${itemId}">
                                    ${selectedPackage.package_name}
                                </div>
                            </td>
                            <td>
                                <div class="flex-grow-1 ms-3 text-center">
                                    ${selectedPackage.original_price}
                               </div>
                            </td>
                            <td>
                                <div class="text-center">
                                    ${selectedPackage.price}
                                </div>
                            </td>
                            <td class="fw-medium text-end">
                                <button class="btn btn-danger remove" id="remove_section${rowIdx}" data-id="${itemId}" data-type="2" type="button">{{__('main.remove')}}</button>
                            </td>
                        </tr>`);
        $('#packageModal').modal('toggle');
        $(packageTr+".package").addClass('collapse');
    });
    function alertForChange()
    {
        swal({
        title: "Are you sure?",
        text: "Once Changed, You will lose all saved data!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        })
        .then((willDelete) => {
        if (willDelete) {
            let product_type = $('input[name="product_type"]:checked').val();
        switch (product_type) {
            case "1":
                $('#dropdownOption').html('');
                $('#dropdownOption').append('<fieldset class="box-body" id="attributeField"><table id="productTable" class="table border-no"><thead><tr><th class="text-center">{{__("main.product_id")}}</th><th class="text-center">{{__("main.product_image")}}</th><th class="text-center">{{__("main.product_name")}}</th><th class="text-center">{{__("main.original_price")}}</th><th class="text-center">{{__("main.selling_price")}}</th><th class="text-center">{{__("main.action")}}</th></tr></thead><tbody id="add_more"></tbody><tfoot><tr><th colspan="5" class=""><a href="javascript:void(0)" class="btn btn-soft-primary" data-bs-toggle="modal" data-bs-target="#productModal">{{__("main.add_product")}}</a></button></th></tr></tfoot></table></fieldset>');
                break;
            case "2":
                $('#dropdownOption').html('');
                $('#dropdownOption').html('<fieldset class="box-body" id="attributeField"><table id="packageTable" class="table border-no"><thead><tr><th class="text-center">{{__("main.package_id")}}</th><th class="text-center">{{__("main.package_image")}}</th><th class="text-center">{{__("main.package_name")}}</th><th class="text-center">{{__("main.original_price")}}</th><th class="text-center">{{__("main.selling_price")}}</th><th class="text-center">{{__("main.action")}}</th></tr></thead><tbody id="add_more"></tbody><tfoot><tr><th colspan="5" class=""><a href="javascript:void(0)" class="btn btn-soft-primary" data-bs-toggle="modal" data-bs-target="#packageModal">{{__("main.add_package")}}</a></button></th></tr></tfoot></table></fieldset>');
                break;
            default:
                break;
        }
            }else{
                location.reload();
            }
        });

    }

    function appendProductType(product_type)
    {
        switch (product_type) {
            case "1":
                $('#dropdownOption').html('');
                $('#dropdownOption').append('<fieldset class="box-body" id="attributeField"><table id="productTable" class="table border-no"><thead><tr><th class="text-center">{{__("main.product_id")}}</th><th class="text-center">{{__("main.product_image")}}</th><th class="text-center">{{__("main.product_name")}}</th><th class="text-center">{{__("main.original_price")}}</th><th class="text-center">{{__("main.selling_price")}}</th><th class="text-center">{{__("main.action")}}</th></tr></thead><tbody id="add_more"></tbody><tfoot><tr><th colspan="5" class=""><a href="javascript:void(0)" class="btn btn-soft-primary" data-bs-toggle="modal" data-bs-target="#productModal">{{__("main.add_product")}}</a></button></th></tr></tfoot></table></fieldset>');
                const ocassionProduct = OccasionData.map((data)=>{
                    if (data !== ''){
                        const filterProduct = filterItem(data,AllProducts,product_type);
                        const productTr = "#productTr"+data+"";
                        $(productTr+".product").addClass('collapse');

                        $('#add_more').html();
                        $('#add_more').append(`<tr id="productTr${data}">
                            <td>
                                <div class="text-center">
                                    ${filterProduct.productId}
                                </div>
                            </td>
                            <td>
                                <div class="flex-shrink-0 avatar-md bg-light rounded p-1 m-auto">
                                    <img src="${(filterProduct.productimage && filterProduct.productimage !== null) ? filterProduct.productimage : "{{asset('assets/images/No_Image_Available.jpg')}}"}" alt="${filterProduct.producttitle[lang]}" class="img-fluid d-block">
                                </div>
                            </td>
                            <td>
                                <div class="text-center">
                                    <input type="hidden"  name="products[]" value="${data}">
                                    ${filterProduct.producttitle[lang]}
                                </div>
                            </td>
                            <td>
                                <div class="flex-grow-1 ms-3 text-center">
                                    ${filterProduct.type === "Simple Product" ? filterProduct.originalprice : "" }
                               </div>
                            </td>
                            <td>
                                <div class="text-center">
                                    ${filterProduct.type === "Simple Product" ? filterProduct.sellingprice : "" }
                                </div>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-danger remove" id="remove_section" data-id="${data}" data-type="1" type="button">{{__('main.remove')}}</button>
                            </td>
                        </tr>`);
                    }
                })
                break;
            case "2":
                $('#dropdownOption').html('');
                $('#dropdownOption').html('<fieldset class="box-body" id="attributeField"><table id="packageTable" class="table border-no"><thead><tr><th class="text-center">{{__("main.package_id")}}</th><th class="text-center">{{__("main.package_image")}}</th><th class="text-center">{{__("main.package_name")}}</th><th class="text-center">{{__("main.original_price")}}</th><th class="text-center">{{__("main.selling_price")}}</th><th class="text-center">{{__("main.action")}}</th></tr></thead><tbody id="add_more"></tbody><tfoot><tr><th colspan="5" class=""><a href="javascript:void(0)" class="btn btn-soft-primary" data-bs-toggle="modal" data-bs-target="#packageModal">{{__("main.add_package")}}</a></button></th></tr></tfoot></table></fieldset>');
                const ocassionPackage = OccasionData.map((data)=>{
                    console.log(data,"data of product");
                    if (data !== ''){
                        const filterPackage = filterItem(data,AllPackages,product_type);
                        const packageTr = "#packageTr"+data+"";
                        $(packageTr+".package").addClass('collapse');

                        $('#add_more').html();
                        $('#add_more').append(`<tr id="packageTr${data}">
                            <td>
                                <div class="text-center">
                                    ${filterPackage.id}
                                </div>
                            </td>
                            <td>
                                <div class="flex-shrink-0 avatar-md bg-light rounded p-1 m-auto">
                                    <img src="${(filterPackage.image && filterPackage.image !== null) ? filterPackage.image : "{{asset('assets/images/No_Image_Available.jpg')}}"}" alt="${filterPackage.package_name}" class="img-fluid d-block">
                                </div>
                            </td>
                            <td>
                                <div class="text-center">
                                    <input type="hidden"  name="packages[]" value="${data}">
                                    ${filterPackage.package_name}
                                </div>
                            </td>
                            <td>
                                <div class="flex-grow-1 ms-3 text-center">
                                    ${filterPackage.original_price}
                               </div>
                            </td>
                            <td>
                                <div class="text-center">
                                    ${filterPackage.price}
                                </div>
                            </td>
                            <td class="fw-medium text-end">
                                <button class="btn btn-danger remove" id="remove_section" data-id="${data}" data-type="2" type="button">{{__('main.remove')}}</button>
                            </td>
                        </tr>`);
                    }
                })
                break;
            default:
                break;
        }

    }
    $("body").on('click', '.remove', function () {
        var child               = $(this).closest('tr').nextAll();
        const productId         = $(this).data('id');
        const productType       = $(this).data('type');

        const trId          = (productType == "1") ? "#productTr"+productId+"" : "#packageTr"+productId+"";
        console.log(productId,"productId",productType,"productType",trId,"trId");
        $(this).closest('tr').remove();
        rowIdx--;
        (productType == 1) ? $(trId+".product").removeClass("collapse") : $(trId+".package").removeClass("collapse");
    });

    function filterItem(itemId,AllData,type)
    {
        let selectedItem;
        if (type == 1){
            selectedItem = AllData.find(function(n,i){
                return n.productId == itemId;
            });
        }else{
            selectedItem = AllData.find(function(n,i){
                return n.id == itemId;
            });
        }
        return selectedItem;
    }

  });
</script>
@endsection
