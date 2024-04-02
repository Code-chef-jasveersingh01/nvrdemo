@extends('layouts.admin.layout')
@section('title')
{{ __('main.edit_product')}}
@endsection
@section('css')
    <link rel="stylesheet" href={{asset("assets/css/dropify.css")}}>
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') {{__('main.edit')}} @endslot
@slot('title') {{__('main.product')}} @endslot
@slot('link') {{route('admin.productList')}} @endslot
@endcomponent
<section class="content">
  <div id="loading"></div>
  <div id="full-body">
    <div class="card shadow mb-4">
      <div class="card-body">
        <form method="POST" action="{{ route('admin.updateProduct',['id' => $productDetails->id]) }}" enctype="multipart/form-data">
          @csrf

          <div class="container">
            <div class="row justify-content-md-center mb-2">
                <div class='form-group row justify-content-between'>
                    <label class="col-sm-2 col-form-label" for="is_active">{{__('main.is_active')}}</label>
                    <div class="col-sm-8">
                        <div class='form-check form-switch' dir='ltr'>
                            <input type='checkbox' id="is_active" name="is_active" class='form-check-input' @if($productDetails->is_active === 1) checked @endif>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-md-center mb-2">
              <div class='form-group row justify-content-between'>
                <label class="col-sm-2 col-form-label" for="categories">{{__('main.category')}}</label>
                <div class="col-sm-8">
                    @php
                    if ($productDetails->categories->isEmpty()) {
                        $productCategoryID[] = '';
                    } else {
                        foreach ($productDetails->categories as $productCategory) {
                            $productCategoryID[] = $productCategory->id;
                        }
                    }
                    @endphp
                  <select class="form-control" id="choices-multiple-default" data-choices data-choices-removeItem name="categories[]" multiple>
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ in_array($category->id, $productCategoryID) ? 'selected' : '' }}>{{ $category->name }}
                      </option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            @foreach($merged1 as $key => $attribute)
            @php
                $checkRequiredAndType = ($attribute->field_required === 1 && $productDetails->type !== "Configured Product") ? true : false;
            @endphp
            <div class="row justify-content-md-center mb-2">
              <div class='form-group row justify-content-between'>
                @if(($attribute->field_type == 1 || $attribute->field_type == 2) && $attribute->name_code != 'sku')
                    @php
                    $data_field_type = ($attribute->field_type == 2) ? 'textarea' : 'input' ;
                    @endphp
                    <label for="{{ $attribute->label_name }}" class="col-sm-4 col-form-label mt-2">{{ $attribute->label_name }}
                        [
                        <span href="javascript:void(0)" class="mutli-lang" data-lang-type="en" data-lang-field="data[{{$attribute->id}}]" data-field-type="{{$data_field_type}}" style="@if(app()->getLocale() == 'en') color:#38b7fe; cursor: pointer; @else cursor: pointer; @endif">{{__('main.english')}} {{(isset($attribute->field_required) && ($attribute->field_required == '1') ) ? '*' : ''}}</span>&nbsp;
                        <span href="javascript:void(0)" class="mutli-lang" data-lang-type="ar" data-lang-field="data[{{$attribute->id}}]" data-field-type="{{$data_field_type}}" style="@if(app()->getLocale() == 'ar') color:#38b7fe; cursor: pointer; @else cursor: pointer; @endif">{{__('main.arabic')}} {{(isset($attribute->field_required) && ($attribute->field_required == '1') ) ? '*' : ''}}</span>
                        ]
                    </label>
                @else
                    <label class="col-sm-4 col-form-label mt-2" for="{{ $attribute->label_name }}">{{ $attribute->label_name }} @if($attribute->field_required === 1) <code>*</code> @endif</label>
                @endif
                <div class="col-sm-8">
                    @switch($attribute->field_type)
                    @case(1)
                        @if(isset($attribute->pivot->data))
                            @if ($attribute->name_code != 'sku')
                                <input type="text" class="form-control" id="{{$attribute->name_code}}" data-name="{{ $attribute->name_code }}" name="data[{{$attribute->id}}][en]" placeholder="{{__('main.english_field')}}" value="{{$attribute->pivot->data}}"  @if($checkRequiredAndType) required autofocus @endif style="@if(app()->getLocale() == 'en') display: block; @else display: none; @endif">
                                <input type="text" class="form-control" name="data[{{$attribute->id}}][ar]" placeholder="{{__('main.arabic_fields')}}" value="{{$attribute->pivot->ar_data}}"  @if($checkRequiredAndType) required autofocus @endif style="@if(app()->getLocale() == 'ar') display: block; @else display: none; @endif">
                            @else
                                <input class='form-control' name='data[{{$attribute->id}}]' data-name="{{ $attribute->name_code }}" id="{{$attribute->name_code}}" type='text' @if($checkRequiredAndType) required autofocus @endif value ="{{$attribute->pivot->data}}" >
                            @endif
                        @else
                            @if($attribute->name_code != 'sku')
                                <input type="text" class="form-control" id="{{$attribute->name_code}}" data-name="{{ $attribute->name_code }}" name="data[{{$attribute->id}}][en]" placeholder="{{__('main.english_field')}}" @if($checkRequiredAndType) required autofocus @endif style="@if(app()->getLocale() == 'en') display: block; @else display: none; @endif">
                                <input type="text" class="form-control" name="data[{{$attribute->id}}][ar]" placeholder="{{__('main.arabic_field')}}"  @if($checkRequiredAndType) required autofocus @endif style="@if(app()->getLocale() == 'ar') display: block; @else display: none; @endif">
                            @else
                                <input class='form-control' name='data[{{$attribute->id}}]' data-name="{{ $attribute->name_code }}" id="{{$attribute->name_code}}" type='text' @if($checkRequiredAndType) required autofocus @endif/>
                            @endif
                        @endif
                    @break
                    @case(2)
                        @if(isset($attribute->pivot->data))
                            <textarea class="form-control" name="data[{{$attribute->id}}][en]" data-name="{{ $attribute->name_code }}" id="{{$attribute->name_code}}" placeholder="{{__('main.english_field')}}" rows='2' cols='50' @if($checkRequiredAndType) required  autofocus @endif style="@if(app()->getLocale() == 'en') display: block; @else display: none; @endif">{{$attribute->pivot->data}}</textarea>
                            <textarea class="form-control" name="data[{{$attribute->id}}][ar]" data-name="{{ $attribute->name_code }}" id="{{$attribute->name_code}}" placeholder="{{__('main.arabic_field')}}" rows='2' cols='50' @if($checkRequiredAndType) required  autofocus @endif style="@if(app()->getLocale() == 'ar') display: block; @else display: none; @endif" >{{$attribute->pivot->ar_data}}</textarea>
                        @else
                            <textarea class="form-control" name="data[{{$attribute->id}}][en]" data-name="{{ $attribute->name_code }}" id="{{$attribute->name_code}}" placeholder="{{__('main.english_field')}}" rows='2' cols='50' rows='2' cols='50' @if($checkRequiredAndType) required  autofocus @endif style="@if(app()->getLocale() == 'en') display: block; @else display: none; @endif"></textarea>
                            <textarea class="form-control" name="data[{{$attribute->id}}][ar]" data-name="{{ $attribute->name_code }}" id="{{$attribute->name_code}}" placeholder="{{__('main.arabic_field')}}" rows='2' cols='50' style="@if(app()->getLocale() == 'ar') display: block; @else display: none; @endif" @if("+e.field_required+ === 1") required autofocus @endif></textarea>
                        @endif
                    @break
                    @case(3)
                        @if(isset($attribute->pivot->data))
                            <input class='form-control' name='data[{{$attribute->id}}]' data-name="{{ $attribute->name_code }}" id="{{$attribute->name_code}}" type='date' max='{{date("Y-m-d")}}' @if($checkRequiredAndType) required autofocus @endif value ="{{$attribute->pivot->data}}" />
                        @else
                            <input class='form-control' name='data[{{$attribute->id}}]' data-name="{{ $attribute->name_code }}" id="{{$attribute->name_code}}" type='date' max='{{date("Y-m-d")}}' @if($checkRequiredAndType) required autofocus @endif/>
                        @endif
                    @break
                    @case(4)
                        <select class='form-select' name='data[{{$attribute->id}}]' id="{{$attribute->id}}" @if($checkRequiredAndType) required autofocus @endif>
                            @foreach($attribute->field_data as $field_data_key => $field_data_value)
                            @if(isset($attribute->pivot->data))
                                <option value="{{$field_data_value}}" @if($field_data_value === $attribute->pivot->data) selected @endif >{{$field_data_value}}</option>
                            @else
                                <option value="{{$field_data_value}}" >{{$field_data_value}}</option>
                            @endif
                            @endforeach
                        </select>
                    @break
                    @case(5)
                    @if(isset($attribute->pivot->data))
                        <input class='dropify' name='image[{{$attribute->id}}]' type='file' accept='image/png, image/jpeg, image/jpg' data-default-file='{{ asset(config('image.product_image_path_view').$productDetails->image->thumbnail_name) }}' />
                        @else
                        <input class='dropify' name='image[{{$attribute->id}}]' type='file' accept='image/png, image/jpeg, image/jpg' @if($checkRequiredAndType) required autofocus @endif
                        />
                    @endif
                    @include('layouts.admin.scripts.create_product_script')
                    @break
                    @case(6)
                    @if (isset($attribute->pivot->data))
                        <input class='form-control' name='data[{{$attribute->id}}]' id="{{$attribute->name_code}}" type='number' @if($checkRequiredAndType) required autofocus @endif value = "{{$attribute->pivot->data}}" >
                    @else
                        <input class='form-control' name='data[{{$attribute->id}}]' id="{{$attribute->name_code}}" type='number' @if($checkRequiredAndType) required  autofocus @endif />
                    @endif
                        @break
                    @case(28)
                    @if (isset($attribute->pivot->data))
                    <input class="form-control" type="file" name="multipleImage[{{$attribute->id}}][]" accept='image/png, image/jpeg, image/jpg' id="formFileMultiple" multiple="" @if($checkRequiredAndType) required autofocus @endif value = {{$attribute->pivot->data}} >
                        <div class="nav-slide-item d-flex mt-2" style="width: 100px; height:100px;">
                            @foreach($productDetails->gallery as $key => $value)
                            @if(isset($value) && !empty($value))
                                <img src="{{ $value['thumbnail_name'] }}" alt="{{$value['thumbnail_name']}}"
                                    class="img-fluid d-block me-2" />
                            @endif
                            @endforeach
                        </div>
                    @else
                        <input class="form-control" type="file" name="multipleImage[{{$attribute->id}}][]"
                        accept='image/png, image/jpeg, image/jpg' id="formFileMultiple" multiple="" @if($checkRequiredAndType) required  autofocus @endif />
                    @endif
                        @break
                    @case(29)
                    <select class='form-select' name='data[{{$attribute->id}}]' data-name="{{ $attribute->name_code }}" id="{{$attribute->name_code}}" id="{{$attribute->id}}" @if($checkRequiredAndType) required autofocus @endif>
                        @foreach($attribute->field_data as $field_data_key => $field_data_value)
                        @if(isset($attribute->pivot->data))
                            <option value="{{$field_data_value}}" @if($field_data_value === $attribute->pivot->data) selected @endif >{{$field_data_value}}</option>
                        @else
                            <option value="{{$field_data_value}}" >{{$field_data_value}}</option>
                        @endif
                        @endforeach
                    </select>
                    @break
                    @case(30)
                        @if (isset($attribute->pivot->data))
                        <input class='form-control' name='data[{{$attribute->id}}]' data-name="{{ $attribute->name_code }}" id="{{$attribute->name_code}}" id="{{$attribute->name_code}}" type='color' @if($checkRequiredAndType) required autofocus @endif value = {{$attribute->pivot->data}} >
                        @else
                        <input class='form-control' name='data[{{$attribute->id}}]' data-name="{{ $attribute->name_code }}" id="{{$attribute->name_code}}" id="{{$attribute->name_code}}" type='color' @if($checkRequiredAndType) required  autofocus @endif />
                        @endif
                          @break
                    @default
                    @endswitch
                </div>
              </div>
            </div>
            @endforeach
            @if ($productDetails->type == "Configured Product" && isset($productDetails->product_variation) && !empty($productDetails->product_variation) && $productDetails->product_variation != '[]')
                <div class="row justify-content-md-center" id="variation">
                    <div class='table-responsive'>
                        <table class='table table-hover' width='100%' cellspacing='0'>
                            <thead>
                                <tr>
                                    <th>{{__('main.image')}}</th>
                                    @foreach ($ths as $th)
                                    <th>{{$th}}</th>
                                    @endforeach
                                    <th style='text-center'>{{__('main.quantity')}}</th>
                                    <th style='text-center'>{{__('main.original_price')}}</th>
                                    <th style='text-center'>{{__('main.profit_percentage')}}</th>
                                    <th style='text-center'>{{__('main.profit')}}</th>
                                    <th style='text-center'>{{__('main.discount')}}</th>
                                    <th style='text-center'>{{__('main.price')}}</th>
                                    <th style='text-center'>{{__('main.is_active')}}</th>
                                </tr>
                            </thead>
                            <tbody id='tbody'>
                                @foreach ($product_variation as $key => $value )
                                    <tr>
                                        <td style='width: 15%'>
                                            <input class='dropify' name='variant[{{$value->id}}][image]' type='file' accept='image/png, image/jpeg, image/jpg' @if (isset($value->image) && !empty($value->image)) data-default-file='{{ $value->image }}' @endif/>
                                        </td>
                                        @foreach ($tds[$key] as $td)
                                        <td style='text-center'>
                                            {{gettype($td) == 'array' ? $td['name'] : $td}}
                                        </td>
                                        @endforeach
                                        <td>
                                            <input class='form-control' name='variant[{{$value->id}}][quantity]' type='number' value="{{$value->quantity}}" required/>
                                        </td>
                                        <td>
                                            <input class='form-control original_price' id="original_price{{$value->id}}" data-type="{{$value->id}}" name='variant[{{$value->id}}][original_price]' type='number' value="{{$value->original_price}}" required/>
                                        </td>
                                        <td>
                                            <input class='form-control profit_percentage' id="profit_percentage{{$value->id}}" data-type="{{$value->id}}" name='variant[{{$value->id}}][profit_percentage]' type='number' value="{{$value->profit_percentage}}" required/>
                                        </td>
                                        <td>
                                            <input class='form-control profit' id="profit{{$value->id}}" data-type="{{$value->id}}" name='variant[{{$value->id}}][profit]' type='number' value="{{$value->profit}}" required/>
                                        </td>
                                        <td>
                                            <input class='form-control discount' id="discount{{$value->id}}" data-type="{{$value->id}}" name='variant[{{$value->id}}][discount]' type='number' value="{{$value->discount}}" required/>
                                        </td>
                                        <td>
                                            <input class='form-control price' id="price{{$value->id}}" data-type="{{$value->id}}" name='variant[{{$value->id}}][price]' type='number' value="{{$value->price}}" required/>
                                        </td>
                                        <td>
                                            <div class='form-check form-switch' dir='ltr'>
                                                <input type='checkbox' name='variant[{{$value->id}}][is_active]' class='form-check-input' id='customSwitchsizesm' @if($value->is_active) checked @endif >
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
          </div>
          <div class="col-6 mb-3">
            <a class="btn btn-secondary mr-2" href="{{url()->previous()}}">{{__('main.cancel')}}</a>
            <button class="btn btn-primary" type="submit">{{__('main.save_changes')}}</button>
          </div>

        </form>
      </div>
    </div>
  </div>
</section>

@endsection
@include('layouts.admin.scripts.create_product_script')
