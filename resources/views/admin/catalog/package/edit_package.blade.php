@extends('layouts.admin.layout')
@section('title')
{{ __('main.edit_package')}}
@endsection
@section('css')
    <link rel="stylesheet" href={{asset("assets/css/dropify.css")}}>
    <link href="{{ URL::asset('assets/libs/swiper/swiper.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') {{__('main.edit')}} @endslot
@slot('title') {{__('main.packages')}} @endslot
@slot('link') {{route('admin.packageList')}} @endslot
@endcomponent
<section class="content">
  <div id="loading"></div>
  <div id="full-body">
    <div class="card shadow mb-4">
      <div class="card-body">
        <form method="POST" action="{{ route('admin.updatePackage',['id' => $packageDetails->id]) }}" enctype="multipart/form-data">
          @csrf
        <div class="row gx-3 mb-3">
            <div class="col-md-6">
                @include('components.edit_lang_input',['inputType'=>'vertical',
                'label_class'=>'form-label',
                'input_class'=>"form-control @error('name') is-invalid @enderror",
                'field_lable'=> __('main.name'),
                'en_required'=>'1',
                'ar_required'=>'1',
                'field_placeholder'=>__('main.Enter Package Name'),
                'field_name'=>'name',
                'value'=>'package_name',
                'data_obj'=>$packageDetails
                ])

                {{-- <label class="form-label" for="name">{{__('main.name')}} <code>({{__('main.required')}})</code></label>
                <input class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{$packageDetails->package_name}}" type="text" placeholder="{{__('main.Enter Package Name')}}" required autofocus> --}}
            </div>
            @php
                if ($packageDetails->parentPackage->isEmpty()) {
                    $packageParent_package[] = '';
                } else {
                    foreach ($packageDetails->parentPackage as $parent_package) {
                        $packageParent_package[] = $parent_package->id;
                    }
                }
            @endphp
            <div class="col-md-6">
                <label class="form-label" for="parent_packages">{{__('main.parent_packages')}} <code>({{__('main.required')}})</code></label>
                <select name="parent_package[]" class="form-control" id="choices-multiple-default" data-choices data-choices-removeItem multiple required>
                    @foreach ($parentPackages as $parent_package)
                            <option value="{{ $parent_package['id'] }}"
                                {{ in_array($parent_package['id'], $packageParent_package) ? 'selected' : '' }}>{{ $parent_package['parent_package_name'] }}
                            </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row gx-3 mb-3">
            <div class="col-lg-6 col-md-12">
                <label for="name" class="col-form-label">{{__('main.package_description')}}
                    [
                    <span href="javascript:void(0)" class="mutli-lang" data-lang-type="en" data-lang-field="package_description" data-field-type="textarea" style="@if(app()->getLocale() == 'en') color:#38b7fe; cursor: pointer; @else cursor: pointer; @endif">{{__('main.english')}} <code>*</code> </span>&nbsp;
                    <span href="javascript:void(0)" class="mutli-lang" data-lang-type="ar" data-lang-field="package_description" data-field-type="textarea" style="@if(app()->getLocale() == 'ar') color:#38b7fe; cursor: pointer; @else cursor: pointer; @endif">{{__('main.arabic')}} <code>*</code> </span>
                    ]
                </label>
                <textarea class="form-control" name="package_description[en]" id="package_description" placeholder="{{__('main.english_field')}}" rows='2' cols='50' style="@if(app()->getLocale() == 'en') display: block; @else display: none; @endif" required autofocus >{{ isset($packageDetails) ? $packageDetails->getTranslation('package_description', 'en') : '' }}</textarea>
                <textarea class="form-control" name="package_description[ar]" id="package_description" placeholder="{{__('main.arabic_field')}}" rows='2' cols='50' style="@if(app()->getLocale() == 'ar') display: block; @else display: none; @endif" required autofocus >{{ isset($packageDetails) ? $packageDetails->getTranslation('package_description', 'ar') : '' }}</textarea>

                {{-- image --}}
                <label class="form-label" for="image">{{__('main.upload_image')}} <code>({{__('main.required')}})</code></label>
                <input class="dropify" id="formFile" name="image" type="file" accept="image/png, image/jpeg, image/jpg" @if(isset($packageDetails->media->thumbnail_name))
                data-default-file='{{ asset(config('image.package_image_path_view').$packageDetails->media->thumbnail_name) }}'
                @endif/>

                <div class="nav-slide-item d-flex mt-2" style="width: 100px; height:100px;">
                    @if(isset($packageDetails->gallery) && !empty($packageDetails->gallery))
                        @foreach($packageDetails->gallery as $key => $value)
                        @if(isset($value) && !empty($value))
                            <img src="{{ $value['thumbnail_name'] }}" alt="{{$value['thumbnail_name']}}"
                                class="img-fluid d-block me-2" />
                        @endif
                        @endforeach
                    @endif
                </div>

            </div>
            <div class="col-lg-6 col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label" for="originalprice">{{__('main.price')}} <code>({{__('main.required')}})</code></label>
                            <div class="input-group has-validation mb-3">
                                <span class="input-group-text" id="original_price">$</span>
                                <input type="number" name="original_price" class="form-control" id="originalprice" placeholder="{{__('main.Enter Original Price')}}" aria-label="Price" aria-describedby="originalprice" value="{{$packageDetails->original_price}}" required>
                                <div class="invalid-feedback">{{__('main.Please Enter a Package price')}}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label" for="profit_percentage">{{__('main.profit_percentage')}} <code>({{__('main.required')}})</code></label>
                            <div class="input-group has-validation mb-3">
                                <span class="input-group-text" id="profit_percentage">%</span>
                                <input type="number" name="profit_percentage" class="form-control" id="profitpercentage" placeholder="{{__('main.Enter Profit Percentage')}}" aria-label="Price" aria-describedby="profit_percentage" value="{{$packageDetails->profit_percentage}}" required>
                                <div class="invalid-feedback">{{__('main.Please Enter a Package price')}}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label" for="product-price-input">{{__('main.selling_price')}} <code>({{__('main.required')}})</code></label>
                            <div class="input-group has-validation mb-3">
                                <span class="input-group-text" id="product-price-addon">$</span>
                                <input type="number" name="price" class="form-control" id="sellingprice" placeholder="{{__('main.Enter Selling Price')}}" aria-label="Price" aria-describedby="product-price-addon" value="{{$packageDetails->price}}" required>
                                <div class="invalid-feedback">{{__('main.Please Enter a Package price')}}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label" for="product-price-input">{{__('main.profit')}} <code>({{__('main.required')}})</code></label>
                            <div class="input-group has-validation mb-3">
                                <span class="input-group-text" id="product-price-addon">$</span>
                                <input type="number" name="profit" class="form-control" id="profit" aria-label="Price" aria-describedby="product-price-addon" value="{{$packageDetails->profit}}" required>
                                <div class="invalid-feedback">{{__('main.Please Enter a Package price')}}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label" for="product-price-input">{{__('main.discount')}} <code>({{__('main.required')}})</code></label>
                            <div class="input-group has-validation mb-3">
                                <span class="input-group-text" id="product-price-addon">$</span>
                                <input type="number" name="discount" class="form-control" id="discount" placeholder="{{__('main.Enter Discount value')}}" aria-label="Price" aria-describedby="product-price-addon" value="{{$packageDetails->discount}}" required>
                                <div class="invalid-feedback">{{__('main.Please Enter a Discount on Package')}}.</div>
                            </div>

                        </div>
                    </div>
                    @if(isset($estimateDeliveryTime->field_data))
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label" for="product-price-input">{{__('main.estimate_delivery_time')}} <code>({{__('main.required')}})</code></label>
                            <div class="input-group has-validation mb-3">
                                <select class='form-select' name='estimate_delivery' id="estimate_delivery">
                                    @foreach($estimateDeliveryTime->field_data as $key => $value)
                                        <option value="{{$value}}"
                                            {{ ($packageDetails->estimate_delivery_time == $value) ? 'selected' : '' }}>{{$value}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if(isset($preparationTime->field_data))
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label" for="product-price-input">{{__('main.preparation_time')}} <code>({{__('main.required')}})</code></label>
                            <div class="input-group has-validation mb-3">
                                <select class='form-select' name='preparation_time' id="preparation_time">
                                    @foreach($preparationTime->field_data as $key => $value)
                                        <option value="{{$value}}"
                                            {{ ($packageDetails->preparation_time == $value) ? 'selected' : '' }}>{{$value}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label" for="image">{{__('main.upload_image')}} <code>({{__('main.required')}})</code></label>
                            <div class="input-group has-validation mb-3">
                                <input class="form-control" type="file" name="multipleImage[]" accept='image/png, image/jpeg, image/jpg' multiple="">
                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
            </div>
        </div>
        <div class="row gx-3 mb-3">
            <div class="col-md-6">
            <br>
            <input type="checkbox" class="filled-in chk-col-primary" id="is_active" name="is_active" @if($packageDetails->is_active === 1) checked @endif />
            <label class="small mb-1" for="is_active">{{__('main.is_active')}}</label>
            </div>
        </div>
        <div class="row gx-3 mb-3 dropdownattribute" id="dropdownOption">
            <fieldset class="box-body" id="attributeField">
                <table class="table border-no">
                <thead>
                </thead>
                <tbody id="add_more">
                    @if (isset($products) && $products != null)
                        @foreach ($packageProducts as $key => $field_data)
                            @if(isset($field_data['quantity']))
                            @php
                            $id = $key + 1;
                            @endphp
                            @switch($field_data['type'])
                                @case("Configured Product")
                                <tr id="R{{$id}}">
                                    <td>
                                        <div class="row d-flex flex-row">
                                            <div class="col-lg-2 col-md-6 col-md-3 col-12">
                                                <div id="image{{$id}}" class="package-product-image-container">
                                                    <a href="javascript::void(0)" data-bs-toggle="modal" data-bs-target="#productdetail{{$field_data['productId']}}">
                                                        <img src='{{isset($field_data['product_variation']['image']) && !empty($field_data['product_variation']['image']) ? $field_data['product_variation']['image'] : asset("assets/images/No_Image_Available.jpg")}}' alt="{{$field_data['product_variation']['image']}}" class="package-product-image"/>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-6 col-md-3 col-12" id="productName{{$id}}">
                                                <div style="display:grid;">
                                                    <span><strong>{{__('main.product_name')}}</strong>: {{$field_data['producttitle'][app()->getLocale()]}}</span>
                                                        @foreach($field_data['combination'] as $key => $value)
                                                            <div><span><strong>{{$key}}</strong></span>:<span> {{$value[0]['name']}}</span></div>
                                                        @endforeach
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-6 col-md-2 col-12 product-data">
                                                <label class="small mb-1" for="quantity">{{__('main.quantity')}}</label>
                                                <input class="form-control qtyProduct" id="quantity{{$id}}" data-id="{{$id}}" data-value="{{$field_data['productId']}}" min='1' name="field_data[{{$field_data['productId']}}][{{$field_data['product_variation']['id']}}][data]"  value="{{$field_data['quantity']}}" type="number" placeholder="{{__('main.Enter Product Quantity')}}" required autofocus>
                                            </div>
                                            <div class="col-lg-2 col-md-6 col-md-2 col-12 product-data">
                                                <label class="small mb-1" for="total-price">{{__('main.total_price')}}</label>
                                                <input type="hidden" id="variantId{{$id}}" name="field_data[{{$field_data['productId']}}][{{$field_data['product_variation']['id']}}][price]" value="{{$field_data['product_variation']['id']}}">
                                                <input class="form-control total-amount-product" id="total-price{{$id}}" min='0' type="number" value="{{$field_data['totalForPackage']}}" placeholder="{{__('main.Enter amount')}}" required autofocus>
                                            </div>
                                            <div class="col-lg-3 col-md-6 col-md-2 col-12 mt-4" id="remove_option">
                                                <input type="hidden" id="variantId{{$id}}" name="field_data[{{$field_data['productId']}}][{{$field_data['product_variation']['id']}}][variation_id]" value="{{$field_data['product_variation']['id']}}">
                                                <button class="btn btn-danger remove" id="remove_section" data-id="{{$field_data['productId']}}" type="button">{{__('main.remove')}}</button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                    @break
                                @default
                                <tr id="R{{$id}}">
                                    <td>
                                        <div class="row d-flex flex-row">
                                            <div class="col-lg-2 col-md-6 col-md-3 col-12">
                                                <div id="image{{$id}}" class="package-product-image-container">
                                                    <a href="javascript::void(0)" data-bs-toggle="modal" data-bs-target="#productdetail{{$field_data['productId']}}">
                                                        <img src='{{(isset($field_data['productimage']) && !empty($field_data['productimage'])) ? $field_data['productimage'] : asset("assets/images/No_Image_Available.jpg")}}' alt="{{$field_data['producttitle'][app()->getLocale()]}}" class="package-product-image"/>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-6 col-md-3 col-12" id="productName{{$id}}">
                                                <div style="display:grid;">
                                                    <span>
                                                        <strong>{{__('main.product_name')}}</strong>:{{$field_data['producttitle'][app()->getLocale()]}}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-6 col-md-2 col-12 product-data">
                                                <label class="small mb-1" for="quantity">{{__('main.quantity')}}</label>
                                                <input class="form-control qtyProduct" id="quantity{{$id}}" data-id="{{$id}}" data-value="{{$field_data['productId']}}" min='1' name="field_data[{{$field_data['productId']}}][null][data]"  value="{{$field_data['quantity']}}" type="number" placeholder="{{__('main.Enter Product Quantity')}}" required autofocus>
                                            </div>
                                            <div class="col-lg-2 col-md-6 col-md-2 col-12 product-data">
                                                <label class="small mb-1" for="total-price">{{__('main.total_price')}}</label>
                                                <input class="form-control total-amount-product" id="total-price{{$id}}" min='0' type="number" value="{{$field_data['totalForPackage']}}" placeholder="{{__('main.Enter amount')}}" required autofocus>
                                            </div>
                                            <div class="col-lg-3 col-md-6 col-md-2 col-12 mt-4" id="remove_option">
                                                <input type="hidden" id="variantId{{$id}}" name="field_data[{{$field_data['productId']}}][null][variation_id]">
                                                <button class="btn btn-danger remove" id="remove_section" data-id="{{$field_data['productId']}}" type="button">{{__('main.remove')}}</button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endswitch
                            @endif
                        @endforeach
                    @endif
                </tbody>
                <tfoot>
                    <tr>
                      <th colspan="5" class="">
                        <button class="btn btn-soft-primary" data-bs-toggle="modal" data-bs-target="#productModal" type="button">{{__('main.add_product')}}</button>
                      </th>
                    </tr>
                  </tfoot>
                </table>
            </fieldset>
        </div>
        <div class="row gx-3 mb-3">
            <div class="col-md-6 mb-3">
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
            <table class="table table-nowrap align-middle mb-0">
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
                        <tr id="productTr{{$product['productId']}}">
                            <td>
                                <div class="text-center">
                                    {{$product['productId']}}
                                </div>
                            </td>
                            <td>
                                <div class="flex-shrink-0 avatar-md bg-light rounded p-1">
                                    <img src="{{ (isset($product['productimage']) && !empty($product['productimage'])) ? $product['productimage'] : asset("assets/images/No_Image_Available.jpg")}}" alt="{{$product['producttitle'][app()->getLocale()]}}" class="img-fluid d-block">
                                </div>
                            </td>
                            <td>
                                <div class="text-center">
                                    {{$product['type']}}
                                </div>
                            </td>
                            <td>
                                <div class="flex-grow-1 ms-3">
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
                                @if ($product['type'] == "Simple Product")
                                    <button id="add_new_option_button" data-action="add_new_row" data-id="{{$product['productId']}}" data-type="1" title="Add Product to Package" type="button" class="btn btn-primary">
                                        <span>{{__('main.add_product')}}</span>
                                    </button>
                                @endif
                            </td>
                        </tr>
                        <tr class="collapse multi-collapse hide" id="multiCollapseExample{{$product['productId']}}">
                            @switch($product['type'])
                                @case("Simple Product")
                                    <td colspan="4">
                                        <div class="row d-flex flex-wrap justify-content-center">
                                            <div class="col-12">
                                                {{__('main.product_name')}}: {{$product['producttitle'][app()->getLocale()] ?? ''}}
                                            </div>
                                            <div class="col-12">
                                                {{__('main.status')}}: {{$product['stockstatus'] ?? ''}}
                                            </div>
                                            <div class="col-12">
                                                {{__('main.short_description')}}: {{$product['shortdescription'][app()->getLocale()] ?? ''}}
                                            </div>
                                            <div class="col-12">
                                                {{__('main.product_description')}}: {{$product['description'][app()->getLocale()] ?? ''}}
                                            </div>
                                            <div class="col-12">
                                                {{__('main.manufacturer_name')}}: {{$product['manufacturername'][app()->getLocale()] ?? ''}}
                                            </div>
                                            <div class="col-12">
                                                {{__('main.manufacturer_brand')}}: {{$product['manufacturerbrand'][app()->getLocale()] ?? ''}}
                                            </div>
                                            <div class="col-12">
                                                {{__('main.original_price')}}: {{$product['originalprice'] ?? ''}}
                                            </div>
                                            <div class="col-12">
                                                {{__('main.profit_percentage')}}: {{$product['profitpercentage'] ?? ''}}
                                            </div>
                                            <div class="col-12">
                                                {{__('main.selling_price')}}: {{$product['sellingprice'] ?? ''}}
                                            </div>
                                            <div class="col-12">
                                                {{__('main.profit')}}: {{$product['profit'] ?? ''}}
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
                                                            <img src="{{(isset($value['image']) && !empty($value['image'])) ? $value['image'] : asset("assets/images/No_Image_Available.jpg")}}" alt="{{$value['sku']}}" class="img-fluid d-block">
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
                                                    <td class="fw-medium text-end">
                                                        <div class="text-center">
                                                            <button id="add_new_option_button" data-action="add_new_row" data-id="{{$product['productId']}}" data-type="2" data-variation="{{$value['id']}}" title="Add Product to Package" type="button" class="btn btn-primary">
                                                                <span>{{__('main.add_product')}}</span>
                                                            </button>
                                                        </div>
                                                    </td>
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
                                <td style="width: 30%">{{isset($product['producttitle'])?$product['producttitle'][app()->getLocale()]:''}}</td>
                            </tr>
                            <tr>
                                <td style="width: 30%"><strong>{{__('main.status')}}: </strong></td>
                                <td style="width: 30%">{{isset($product['stockstatus'])?$product['stockstatus']:''}}</td>
                            </tr>
                            <tr>
                                <td style="width: 30%"><strong>{{__('main.short_description')}}: </strong></td>
                                <td style="width: 30%">{{isset($product['shortdescription'])?$product['shortdescription'][app()->getLocale()]:''}}</td>
                            </tr>
                            <tr>
                                <td style="width: 30%"><strong>{{__('main.product_description')}}: </strong></td>
                                <td style="width: 30%">{{isset($product['description'])?$product['description'][app()->getLocale()]:''}}</td>
                            </tr>
                            <tr>
                                <td style="width: 30%"><strong>{{__('main.manufacturer_brand')}}: </strong></td>
                                <td style="width: 30%">{{isset($product['manufacturerbrand'])?$product['manufacturerbrand'][app()->getLocale()]:''}}</td>
                            </tr>
                            <tr>
                                <td style="width: 30%"><strong>{{__('main.manufacturer_name')}}: </strong></td>
                                <td style="width: 30%">{{isset($product['manufacturername'])?$product['manufacturername'][app()->getLocale()]:''}}</td>
                            </tr>
                            <tr>
                                <td style="width: 30%"><strong>{{__('main.original_price')}}: </strong></td>
                                <td style="width: 30%">{{isset($product['originalprice'])?$product['originalprice']:0}}</td>
                            </tr>
                            <tr>
                                <td style="width: 30%"><strong>{{__('main.profit_percentage')}}: </strong></td>
                                <td style="width: 30%">{{isset($product['profitpercentage'])?$product['profitpercentage']:0}}</td>
                            </tr>
                            <tr>
                                <td style="width: 30%"><strong>{{__('main.selling_price')}}: </strong></td>
                                <td style="width: 30%">{{isset($product['sellingprice'])?$product['sellingprice']:0}}</td>
                            </tr>
                            <tr>
                                <td style="width: 30%"><strong>{{__('main.profit')}}: </strong></td>
                                <td style="width: 30%">{{isset($product['profit'])?$product['profit']:0}}</td>
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
<script src={{asset("assets/js/pages/ecommerce-product-details.init.js")}}></script>
<script>
    var pVariantID;
    var ptype;
    const lang = sessionStorage.getItem('lang');
    $(document).ready(function(){
        $('.dropify').dropify();
        var rowIdx = {{isset($id) ? $id : 1 }};
        $('body').on('click', '#add_new_option_button', function () {
            var pID         = $(this).data('id');
            ptype           = $(this).data('type');
            if (ptype == 2){
                pVariantID          = $(this).data('variation');
                var pVariantTr      = "#variantTr"+pVariantID+"";
            }
            const prodctTr  = "#productTr"+pID+"";
            $('#add_more').append(`<tr id="R${++rowIdx}"><td><div class="row d-flex flex-row">
                            <div class="col-lg-2 col-md-6 col-md-3 col-12">
                                <div id="image${rowIdx}" class="package-product-image-container"></div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-md-3 col-12 d-flex align-items-center" id="productName${rowIdx}">
                            <label class="small mb-1" for="product">{{__('main.product')}}</label>
                            <select class="form-control product-dropdown" onchange='productDropdown(${rowIdx})' data-id='${rowIdx}' data-choices  id="choices-single-default${rowIdx}">
                                <option value="">This is a placeholder</option>
                                @foreach($products as $key => $value)
                                    <option value="{{$value['productId']}}">{{$value['producttitle'][app()->getLocale()]}}</option>
                                @endforeach
                            </select>
                            </div>
                            <div class="col-lg-2 col-md-6 col-md-2 col-12 product-data">
                                <label class="small mb-1" for="quantity">{{__('main.quantity')}}</label>
                                <input class="form-control" id="quantity${rowIdx}" min='1'  value="1" type="number" placeholder="{{__('main.Enter Product Quantity')}}" required autofocus>
                            </div>
                            <div class="col-lg-2 col-md-6 col-md-2 col-12 product-data">
                                <label class="small mb-1" for="total-price">{{__('main.total_price')}}</label>
                                <input type="hidden" id="single-price${rowIdx}" name="">
                                <input class="form-control total-amount-product" id="total-price${rowIdx}" min='0' type="number" placeholder="{{__('main.Enter amount')}}" required autofocus>
                            </div>
                            <div class="col-lg-3 col-md-6 col-md-2 col-12 mt-4" id="remove_option">
                                <input type="hidden" id="variantId${rowIdx}" name="">
                                <button class="btn btn-danger remove" id="remove_section${rowIdx}" data-id="${pID}" data-ptype="${ptype}" data-variation="${pID}" type="button">{{__('main.remove')}}</button>
                            </div>
                            </td></tr>`
            );
            $(`#choices-single-default${rowIdx}`).val(pID).change();
            $('#productModal').modal('toggle');
            (ptype == 1) ? $(prodctTr).addClass('collapse') : $(pVariantTr).addClass('collapse');

            var choicesExamples = document.querySelectorAll("[data-choices]");
                choicesExamples.forEach(function (item) {
                    var choiceData = {};
                    var isChoicesVal = item.attributes;
                    if (isChoicesVal["data-choices-groups"]) {
                        choiceData.placeholderValue = "This is a placeholder set in the config";
                    }
                    if (isChoicesVal["data-choices-search-false"]) {
                        choiceData.searchEnabled = false;
                    }
                    if (isChoicesVal["data-choices-search-true"]) {
                        choiceData.searchEnabled = true;
                    }
                    if (isChoicesVal["data-choices-removeItem"]) {
                        choiceData.removeItemButton = true;
                    }
                    if (isChoicesVal["data-choices-sorting-false"]) {
                        choiceData.shouldSort = false;
                    }
                    if (isChoicesVal["data-choices-sorting-true"]) {
                        choiceData.shouldSort = true;
                    }
                    if (isChoicesVal["data-choices-multiple-remove"]) {
                        choiceData.removeItemButton = true;
                    }
                    if (isChoicesVal["data-choices-limit"]) {
                        choiceData.maxItemCount = isChoicesVal["data-choices-limit"].value.toString();
                    }
                    if (isChoicesVal["data-choices-limit"]) {
                        choiceData.maxItemCount = isChoicesVal["data-choices-limit"].value.toString();
                    }
                    if (isChoicesVal["data-choices-editItem-true"]) {
                        choiceData.maxItemCount = true;
                    }
                    if (isChoicesVal["data-choices-editItem-false"]) {
                        choiceData.maxItemCount = false;
                    }
                    if (isChoicesVal["data-choices-text-unique-true"]) {
                        choiceData.duplicateItemsAllowed = false;
                    }
                    if (isChoicesVal["data-choices-text-disabled-true"]) {
                        choiceData.addItems = false;
                    }
                    isChoicesVal["data-choices-text-disabled-true"] ? new Choices(item, choiceData).disable() : new Choices(item, choiceData);
                });
        });

        $("#add_more").on('click', '.remove', function () {
            var child           = $(this).closest('tr').nextAll();
            const productId     = $(this).data('id');
            const variantId     = $(this).data('variation');
            const proType       = $(this).data('ptype');

            const trId          = "#productTr"+productId+"";
            const trVariantId   = "#variantTr"+variantId+"";

            $(this).closest('tr').remove();
            rowIdx--;
            (proType == 1) ? $(trId).removeClass("collapse") : $(trVariantId).removeClass("collapse");
            packageTotalAmount()
        });
    });

    async function doProductPriceAjax(output,variantvalue) {
        let result;

        try {
            result = await $.ajax({
                url: "{{route('admin.productPriceApi')}}",
                type: 'POST',
                data: {
                    "_token": $('a[name="csrf-token"]').val(),
                    "selectedProdcuct": output,
                    "variant": variantvalue,
                }
            });

            return result;
        } catch (error) {
            console.error(error);
        }
    }

    function productDropdown(value){
        const stringId          = "#choices-single-default"+value+"";
        const image             = "#image"+value+"";
        const totalField        = "#total-price"+value+"";
        const singleField       = "#single-price"+value+"";
        const quantityField     = "#quantity"+value+"";
        const productname       = "#productName"+value+"";
        const removeBtn         = "#remove_section"+value+"";
        const variantId         = "#variantId"+value+"";
        var productAmount       = 0;

        selectElement = document.querySelector(stringId);
        output = selectElement.options[selectElement.selectedIndex].value;
        const variantvalue = (pVariantID === undefined) ? null : pVariantID;
        $(removeBtn).attr('data-variation', pVariantID);

        if (output !== "") {
            doProductPriceAjax(output,variantvalue).then( (response) => {
                if (response.status === 1){
                    productAmount = response.productDetatis['originalprice'];
                    const productVariantArray = response.productDetatis['variation_combination'];
                    const ths = response.productDetatis['ths'];
                    const productVariant = $.map(productVariantArray, function (element, index) {
                        const details = '<span><strong>'+ths[index]+'</strong></span> : <span>'+element['name']+'</span>';
                        return details;
                    });
                    const productImage = (response.productDetatis['productimage'] && response.productDetatis['productimage'] != null) ? response.productDetatis['productimage'] : '{{asset("assets/images/No_Image_Available.jpg")}}';
                    $(image).html('');
                    $(image).append('<a href="javascript::void(0)" data-bs-toggle="modal" data-bs-target="#productdetail'+output+'"><img src='+productImage+' alt="response.productDetatis["+producttitle+"]" class="package-product-image"/></a>');
                    $(productname).html('');
                    $(productname).append('<div style="display:grid;"><span><strong>Product Name</strong>:'+response.productDetatis.producttitle[lang]+'</span><div>'+productVariant+'</div></div>');
                    $(totalField).prop('value',response.productDetatis['originalprice']);
                    $(quantityField).prop('name','field_data['+output+']['+variantvalue+'][data]');
                    $(variantId).prop('name','field_data['+output+']['+variantvalue+'][variation_id]');
                    $(variantId).val(variantvalue);
                    $(singleField).prop('name','field_data['+output+']['+variantvalue+'][price]');
                    $(singleField).val(response.productDetatis['sellingprice']);

                    packageTotalAmount();
                }else{
                    $(image).html('');
                    $(totalField).prop('value',0);
                    $(quantityField).prop('value',0);
                    $('#originalprice').prop('value',response.productDetatis);
                }
            });
        }else{
            $(image).html('');
            $(totalField).prop('value',0);
            $(quantityField).prop('value',0);
        }

        $(quantityField).keyup(function (e) {
            qtyfield(this,productAmount,totalField);
        });
        $(quantityField).change(function (e) {
            qtyfield(this,productAmount,totalField);
        });
    }
    function qtyfield(val,productAmount,totalField){
        const cp = $(val).val();
        const productTotalAmount = cp * productAmount;
        $(totalField).prop('value',productTotalAmount);
        packageTotalAmount()
    }

    function packageTotalAmount(){
        var totalPackageAmountDetails = document.querySelectorAll(".total-amount-product");
        var PackageTotalAmount = 0
        for (let index = 0; index < totalPackageAmountDetails.length; index++) {
            const element = totalPackageAmountDetails[index].id;
            const elementAmount = parseInt(document.getElementById(element).value);
            PackageTotalAmount += elementAmount;
        }
        $('#originalprice').prop('value',PackageTotalAmount);
        originalPrice(PackageTotalAmount)
    }

    function originalPrice(value){
        const cp = value;
        let ppercent = $('#profitpercentage').val();
        let discountPercentage = $('#discount').val();
        ppercent = (!ppercent.trim()) ? 0 : parseInt(ppercent);
        discountPercentage = (!discountPercentage.trim()) ? 0 : parseInt(discountPercentage);
        const profit = (ppercent !== 0) ? (cp*(ppercent/100)) : ppercent ;
        let sp = (ppercent !== 0) ? parseInt(cp) + (cp*(ppercent/100)) : cp ;
        const discount = (discountPercentage !== 0) ? (sp*(discountPercentage/100)) : 0 ;
        // sp = (discountPercentage !== 0) ? Math.round((sp*100)/(100-discountPercentage)) : sp ;
        $('#sellingprice').prop('value',sp);
        $('#profit').prop('value',profit);
        sellingPrice()

    }

    function sellingPrice(){

        const cp = $('#originalprice').val();

        let ppercent = $('#profitpercentage').val();
        let discountPercentage = $('#discount').val();
        ppercent = (!ppercent.trim()) ? 0 : parseInt(ppercent);
        discountPercentage = (!discountPercentage.trim()) ? 0 : parseInt(discountPercentage);
        const profit = (ppercent !== 0) ? (cp*(ppercent/100)) : ppercent ;
        const discount = (discountPercentage !== 0) ? (cp*(discountPercentage/100)) : 0 ;
        let sp = (ppercent !== 0) ? parseInt(cp) + (cp*(ppercent/100)) : cp ;
        // sp = (discountPercentage !== 0) ? Math.round((sp*100)/(100-discountPercentage)) : sp ;

        $('#sellingprice').prop('value',sp);
        $('#profit').prop('value',profit);
    }

    $(document).ready(function () {
      $('#originalprice').keyup(function (e) {
          e.preventDefault();
          const cp = $(this).val();
          originalPrice(cp);
      });

      $('#originalprice').change(function (e) {
          e.preventDefault();
          const cp = $(this).val();
          originalPrice(cp);
      });

      $('#profitpercentage').keyup(function (e) {
          e.preventDefault();
          sellingPrice();
      });

      $('#profitpercentage').change(function (e) {
        e.preventDefault();
            sellingPrice();
      });

      $('#discount').keyup(function (e) {
          e.preventDefault();
          sellingPrice();
      });

      $('#discount').change(function (e) {
        e.preventDefault();
            sellingPrice();
      });
    });
    $('body').on('keyup', '.qtyProduct', function () {
        const qtyPrID       = $(this).data('value');
        const id            = $(this).data('id');
        const totalField    = "#total-price"+id+"";
        doProductPriceAjax(qtyPrID).then( (data) => {
            productAmount = data.productDetatis['originalprice'];
            qtyfield(this,productAmount,totalField);
        })
    });
    $('body').on('change', '.qtyProduct', function () {
        const qtyPrID       = $(this).data('value');
        const id            = $(this).data('id');
        const totalField    = "#total-price"+id+"";
        doProductPriceAjax(qtyPrID).then( (data) => {
            productAmount = data.productDetatis['originalprice'];
            qtyfield(this,productAmount,totalField);
        })
    });
  </script>
@endsection
