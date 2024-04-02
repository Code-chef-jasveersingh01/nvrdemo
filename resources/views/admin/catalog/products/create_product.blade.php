@extends('layouts.admin.layout')
@section('title')
{{ __('main.create_product')}}
@endsection
@section('css')
<link rel="stylesheet" href={{asset("assets/css/dropify.css")}}>
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') {{__('main.create')}} @endslot
@slot('title') {{__('main.product')}} @endslot
@slot('link') {{route('admin.productList')}} @endslot
@endcomponent
<section class="content">
    <div id="loading"></div>
    <div id="full-body">
        <div class="card shadow mb-4">
            <div class="card-body">
                <form method="POST" action="{{ route('admin.storeProduct') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="container">
                        <div class="row justify-content-md-center mb-2">
                            <div class='form-group row justify-content-between'>
                                <label class="col-sm-2 col-form-label" for="is_active">{{__('main.is_active')}}</label>
                                <div class="col-sm-8">
                                    <div class='form-check form-switch' dir='ltr'>
                                        <input type='checkbox' id="is_active" name="is_active" class='form-check-input' checked=''>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-md-center mb-2">
                            <div class='form-group row justify-content-between'>
                                <label class="col-sm-2 col-form-label" for="categories">{{__('main.category')}}</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="choices-multiple-default" data-choices
                                        data-choices-removeItem name="categories[]" multiple>
                                        @foreach ($categories as $category)
                                        <option value="{{$category->id}}" id="{{$category->id}}">{{$category->name}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        @foreach($attributes as $key => $attribute)
                        <div class="row justify-content-md-center mb-2">
                            <div class='form-group row justify-content-between'>
                                    @if(($attribute->field_type == 1 || $attribute->field_type == 2) && $attribute->name_code != 'sku')
                                        <label for="attribute" class="col-sm-4 col-form-label">{{$attribute->label_name}}
                                            [
                                            <span href="javascript:void(0)" class="mutli-lang" data-lang-type="en" data-lang-field="data[{{$attribute->id}}]" data-field-type="{{($attribute->field_type == 2) ? 'textarea' : 'input'}}" style="@if(app()->getLocale() == 'en') color:#38b7fe; cursor: pointer; @else cursor: pointer; @endif">{{__('main.english')}} @if($attribute->field_required === 1) <code>*</code> @endif </span>&nbsp;
                                            <span href="javascript:void(0)" class="mutli-lang" data-lang-type="ar" data-lang-field="data[{{$attribute->id}}]" data-field-type="{{($attribute->field_type == 2) ? 'textarea' : 'input'}}" style="@if(app()->getLocale() == 'ar') color:#38b7fe; cursor: pointer; @else cursor: pointer; @endif">{{__('main.arabic')}} @if($attribute->field_required === 1) <code>*</code> @endif</span>
                                            ]
                                        </label>
                                    @else
                                        <label class="col-sm-2 col-form-label" for="{{ $attribute->label_name }}">{{ $attribute->label_name }} @if($attribute->field_required === 1) <code>*</code> @endif :</label>
                                    @endif
                                <div class="col-sm-8">
                                    @switch($attribute->field_type)
                                    @case(1)
                                        @if($attribute->name_code != 'sku')
                                            <input type="text" class="form-control" id="{{$attribute->name_code}}en" name="data[{{$attribute->id}}][en]" placeholder="{{__('main.english_field')}}" style="@if(app()->getLocale() == 'en') display: block; @else display: none; @endif" @if($attribute->field_required === 1 ) required autofocus @endif/>
                                            <input type="text" class="form-control" id="{{$attribute->name_code}}ar" name="data[{{$attribute->id}}][ar]" placeholder="{{__('main.arabic_field')}}" style="@if(app()->getLocale() == 'ar') display: block; @else display: none; @endif" @if($attribute->field_required === 1) required autofocus @endif/>
                                        @else
                                            <input class='form-control' name='data[{{$attribute->id}}]' data-name="{{ $attribute->name_code }}" id="{{$attribute->name_code}}" type='text' @if($attribute->field_required === 1) required autofocus @endif />
                                        @endif
                                    @break
                                    @case(2)
                                        <textarea class="form-control" name="data[{{$attribute->id}}][en]" id="{{$attribute->name_code}}" placeholder="{{__('main.english_field')}}" rows='2' cols='50' style="@if(app()->getLocale() == 'en') display: block; @else display: none; @endif" @if("+e.field_required+ === 1") required autofocus @endif></textarea>
                                        <textarea class="form-control" name="data[{{$attribute->id}}][ar]" id="{{$attribute->name_code}}" placeholder="{{__('main.arabic_field')}}" rows='2' cols='50' style="@if(app()->getLocale() == 'ar') display: block; @else display: none; @endif" @if("+e.field_required+ === 1") required autofocus @endif></textarea>
                                    @break
                                    @case(3)
                                    <input class='form-control' name=' data[{{$attribute->id}}]'
                                        data-name="{{ $attribute->name_code }}" id="{{$attribute->name_code}}" type='date'
                                        max='{{date("Y-m-d")}}' @if($attribute->field_required === 1) required autofocus
                                    @endif/>
                                    @break
                                    @case(4)
                                    <select class='form-select' name='data[{{$attribute->id}}]'
                                        data-name="{{ $attribute->name_code }}" id="{{$attribute->name_code}}"
                                        @if($attribute->field_required === 1) required autofocus @endif>
                                        @foreach($attribute->field_data as $key => $value)
                                        <option value="{{$value}}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                    @break
                                    @case(5)
                                    <input class='dropify' name='image[{{$attribute->id}}]'
                                        data-name="{{ $attribute->name_code }}" id="{{$attribute->name_code}}" type='file'
                                        accept='image/png, image/jpeg, image/jpg' @if($attribute->field_required === 1)
                                    required autofocus @endif/>
                                    @include('layouts.admin.scripts.create_product_script')
                                    @break
                                    @case(6)
                                    <input class='form-control' name='data[{{$attribute->id}}]'
                                        data-name="{{ $attribute->name_code }}" id="{{$attribute->name_code}}"
                                        type='number' @if($attribute->field_required === 1) required autofocus @endif />
                                    @break
                                    @case(28)
                                    <input class="form-control" type="file" name="multipleImage[{{$attribute->id}}][]"
                                        data-name="{{ $attribute->name_code }}" id="{{$attribute->name_code}}" accept='image/png, image/jpeg, image/jpg' multiple=""
                                        @if($attribute->field_required === 1) required autofocus @endif>
                                    @break
                                    @case(29)
                                    <select class='form-select' name='data[{{$attribute->id}}]' id="{{$attribute->name_code}}"
                                        data-name="{{ $attribute->name_code }}" @if($attribute->field_required === 1)
                                        required autofocus @endif>
                                        @foreach($attribute->field_data as $key => $value)
                                        <option value="{{$value}}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                    @break
                                    @case(30)
                                    <input class="form-control" name="data[{{$attribute->id}}]" type="color"
                                        data-name="{{ $attribute->name_code }}" id="{{$attribute->name_code}}"
                                        @if($attribute->field_required === 1) required autofocus @endif>
                                    @break
                                    @default

                                    @endswitch
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <div class="row justify-content-md-center" id="variation">

                        </div>
                        <!-- Accordions with Plus Icon -->
                        <div class="accordion custom-accordionwithicon-plus" id="accordionWithplusicon">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="accordionwithplusExample1">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#accor_plusExamplecollapse1" aria-expanded="true"
                                        aria-controls="accor_plusExamplecollapse1">
                                        {{__('main.configuration')}}
                                    </button>
                                </h2>
                                <div id="accor_plusExamplecollapse1" class="accordion-collapse collapse hide"
                                    aria-labelledby="accordionwithplusExample1" data-bs-parent="#accordionWithplusicon">
                                    <div class="accordion-body d-flex flex-wrap">
                                        {{__('main.Configurable products allow customers to choose options (Ex: shirt color). You need to create a simple product for each configuration (Ex: a product for each color)')}} .
                                        <button class="btn btn-light" id="configurationButton" type="button">{{__('main.create_configuration')}}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <a class="btn btn-secondary mr-2" href="{{url()->previous()}}">{{__('main.cancel')}}</a>
                        <button class="btn btn-primary" type="submit">{{__('main.save_changes')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- right offcanvas -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel"
        style="width: 90%">
        <div class="offcanvas-header">
            <h5 id="offcanvasRightLabel">{{__('main.Create Product Configurations')}}</h5>
            <button type="button" id="configurationCanvasClose" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="card">
                <div class="card-body form-steps">
                    <form action="#">
                        <div id="custom-progress-bar" class="progress-nav mb-4">
                            <div class="progress" style="height: 1px;">
                                <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>

                            <ul class="nav nav-pills progress-bar-tab custom-nav" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link rounded-pill active" data-progressbar="custom-progress-bar"
                                        id="pills-gen-info-tab" data-bs-toggle="pill" data-bs-target="#pills-gen-info"
                                        type="button" role="tab" aria-controls="pills-gen-info"
                                        aria-selected="true">{{__('main.1')}}</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link rounded-pill" data-progressbar="custom-progress-bar"
                                        id="pills-info-desc-tab" data-bs-toggle="pill" type="button" role="tab"
                                        aria-controls="pills-info-desc" aria-selected="false" disabled>2</button>
                                </li>
                            </ul>
                        </div>

                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="pills-gen-info" role="tabpanel"
                                aria-labelledby="pills-gen-info-tab">
                                <div class="card-header">
                                    <h4 class="card-title mb-0">{{__('main.Step')}} {{__('main.1')}}: {{__('main.Select Attributes')}}</h4>
                                </div><!-- end card header -->
                                <form class="was-validated" id="selectVariationType">
                                    <div class="table-responsive">
                                        <table class="table table-hover" width="100%" cellspacing="0" id="listTypes">
                                            <thead class="">
                                                <tr>
                                                    <th style="text-center"><input type="checkbox"
                                                            id="checkAllVariationType"></th>
                                                    <th style="text-center">{{__('main.attribute_name')}}</th>
                                                    <th style="text-center">{{__('main.attribute_code')}}</th>
                                                    <th style="text-center">{{__('main.is_active')}}</th>
                                                    <th style="text-center">{{__('main.is_system')}}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($variationTypes as $key => $value)
                                                <tr>
                                                    <td><input type="checkbox"
                                                            class="form-check-input form-input-for-variationType"
                                                            data-name="{{$value->name}}"
                                                            id="validationFormCheck{{$value->id}}" required
                                                            data-id="{{$value->id}}"></td>
                                                    <td>{{$value->name}}</td>
                                                    <td>{{$value->key}}</td>
                                                    <td>{{$value->is_active}}</td>
                                                    <td>{{$value->is_system}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="d-flex align-items-start gap-3 mt-4">
                                        <button class="btn btn-primary btn-label right ms-auto nexttab nexttab"
                                            id="variationTypeSumbit"><i
                                                class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>{{__('main.next')}}</button>
                                    </div>
                                </form>
                            </div>
                            <!-- end tab pane -->

                            <div class="tab-pane fade" id="pills-info-desc" role="tabpanel"
                                aria-labelledby="pills-info-desc-tab">
                                <div class="card-header">
                                    <h4 class="card-title mb-0">{{__('main.Step')}} {{__('main.2')}}: {{__('main.Attribute Values')}}</h4>
                                </div><!-- end card header -->
                                <form class="was-validated" id="selectVariationValue">
                                    <div id="variationValue">

                                    </div>
                                    <div class="d-flex align-items-start gap-3 mt-4">
                                        <button type="button"
                                            class="btn btn-link text-decoration-none btn-label previestab"
                                            data-previous="pills-gen-info-tab"><i
                                                class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i> {{__('main.back')}}
                                        </button>
                                        <button type="button"
                                            class="btn btn-success btn-label right ms-auto nexttab nexttab"
                                            onclick="sumbitSelectedVariationValue(this)" id="variationValueSumbit"><i
                                                class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>{{__('main.Submit')}}</button>
                                    </div>
                                </form>
                            </div>
                            <!-- end tab pane -->
                        </div>
                        <!-- end tab content -->
                    </form>
                </div>
                <!-- end card body -->
            </div>
        </div>
    </div>
</section>
@endsection
@include('layouts.admin.scripts.create_product_script')
