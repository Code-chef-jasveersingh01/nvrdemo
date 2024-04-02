@php
    $value_field = isset($value) ? $value : $field_name;
    $en_value = (isset($data_obj) && gettype($data_obj) == 'object') ? (isset($data_obj->$value_field) ? $data_obj->getTranslation($value_field, 'en') : '') : ((isset($data_obj) && gettype($data_obj) == 'array') ? (isset($data_obj[$value_field]['en']) ? $data_obj[$value_field]['en'] : '') : '');
    $ar_value = (isset($data_obj) && gettype($data_obj) == 'object') ? (isset($data_obj->$value_field) ? $data_obj->getTranslation($value_field, 'ar') : '') : ((isset($data_obj) && gettype($data_obj) == 'array') ? (isset($data_obj[$value_field]['ar']) ? $data_obj[$value_field]['ar'] : '') : '');
@endphp
@if(isset($inputType) && $inputType  == "horizontal")
    <label for="{{$field_name}}" class={{isset($label_class) ? $label_class : 'form-label'}}>{{$field_lable}}
        [
        <span href="javascript:void(0)" class="mutli-lang" data-lang-type="en" data-lang-field="{{$field_name}}" data-field-type="input" style="@if(app()->getLocale() == 'en') color:#38b7fe; cursor: pointer; @else cursor: pointer; @endif">{{__('main.english')}} {{(isset($en_required) && ($en_required == '1') ) ? '*' : ''}}</span>&nbsp;
        <span href="javascript:void(0)" class="mutli-lang" data-lang-type="ar" data-lang-field="{{$field_name}}" data-field-type="input" style="@if(app()->getLocale() == 'ar') color:#38b7fe; cursor: pointer; @else cursor: pointer; @endif">{{__('main.arabic')}} {{(isset($ar_required) && ($ar_required == '1') ) ? '*' : ''}}</span>
        ]
    </label>
    <div class="col-sm-10">
        <input type="text" class={{isset($input_class) ? $input_class : 'form-control w-100'}} id="{{$field_name}}" name="{{$field_name}}[en]" value="{{ $en_value }}" placeholder="{{$field_placeholder}}" @if(isset($en_required) && ($en_required == '1')) required @endif style="@if(app()->getLocale() == 'en') display: block; @else display: none; @endif">
        <input type="text" class={{isset($input_class) ? $input_class : 'form-control w-100'}} id="{{$field_name}}" name="{{$field_name}}[ar]" value="{{ $ar_value }}" placeholder="{{$field_placeholder}}" @if(isset($ar_required) && ($ar_required == '1')) required @endif style="@if(app()->getLocale() == 'ar') display: block; @else display: none; @endif">
    </div>
@else
    <label for="{{$field_name}}" class={{isset($label_class) ? $label_class : 'form-label'}}>{{$field_lable}}
        [
        <span href="javascript:void(0)" class="mutli-lang" data-lang-type="en" data-lang-field="{{$field_name}}" data-field-type="input" style="@if(app()->getLocale() == 'en') color:#38b7fe; cursor: pointer; @else cursor: pointer; @endif">{{__('main.english')}}</span>&nbsp;
        <span href="javascript:void(0)" class="mutli-lang" data-lang-type="ar" data-lang-field="{{$field_name}}" data-field-type="input" style="@if(app()->getLocale() == 'ar') color:#38b7fe; cursor: pointer; @else cursor: pointer; @endif">{{__('main.arabic')}}</span>
        ]
    </label>
    <input type="text" class={{isset($input_class) ? $input_class : 'form-control w-100'}} id="{{$field_name}}" name="{{$field_name}}[en]" value="{{ $en_value }}" placeholder="{{$field_placeholder}}" @if(isset($en_required) && ($en_required == '1')) required @endif style="@if(app()->getLocale() == 'en') display: block; @else display: none; @endif">
    <input type="text" class={{isset($input_class) ? $input_class : 'form-control w-100'}} id="{{$field_name}}" name="{{$field_name}}[ar]" value="{{ $ar_value }}" placeholder="{{$field_placeholder}}" @if(isset($ar_required) && ($ar_required == '1')) required @endif style="@if(app()->getLocale() == 'ar') display: block; @else display: none; @endif">
@endif
