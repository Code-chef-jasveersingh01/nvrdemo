@extends('layouts.admin.layout')
@section('title')
    {{__('main.create_attribute')}}
@endsection
@section('content')
@component('components.breadcrumb')
    @slot('li_1') {{__('main.create')}} @endslot
    @slot('title') {{__('main.attribute')}} @endslot
    @slot('link') {{ route('admin.attributeProductList')}} @endslot
@endcomponent
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h5 class="m-0 font-weight-bold">{{__('main.add_new_attribute')}}</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{route('admin.storeProductAttribute')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="row gx-3 mb-3">
                                <div class="col-md-6">
                                    <label class="small mb-1" for="label_name">{{__('main.default_label')}}</label>
                                    <input class="form-control @error('label_name') is-invalid @enderror" id="label_name" name="label_name" value="{{ old('label_name') }}" type="text" placeholder="{{__('main.Enter Default Label')}}" required autofocus>
                                </div>
                                <div class="col-md-6">
                                    <label class="small mb-1" for="field_type">{{__('main.catalog_input_type_for_stote_owner')}}</label>
                                    <select class="form-control" name="field_type" id="field_type">
                                        @foreach ($fieldType as $fieldType)
                                        <option value="{{$fieldType->id}}" id="{{$fieldType->id}}">{{$fieldType->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row gx-3 mb-3">
                                <div class="col-md-6">
                                    <br>
                                    <input type="checkbox" class="filled-in chk-col-primary" id="is_active" name="is_active" checked />
                                    <label class="small mb-1" for="is_active">{{__('main.is_active')}}</label>
                                </div>
                                <div class="col-md-6">
                                <label class="small mb-1" for="field_required">{{__('main.values_required')}}</label>
                                <select class="form-control" name="field_required" id="field_required">
                                    <option value="0" selected="selected">No</option>
                                    <option value="1" >Yes</option>
                                </select>
                                </div>
                            </div>
                            <div class="row gx-3 mb-3 dropdownattribute" id="dropdownOption">

                            </div>
                            <div class="row gx-3 mb-3"></div>
                            <a class="btn btn-secondary mr-2" href="{{route('admin.attributeProductList')}}">{{__('main.cancel')}}</a>
                            <button class="btn btn-primary" type="submit">{{__('main.save')}}</button>
                        </form>
                    </div>
                </div>
            </div>
    </section>
@endsection
@section('script')
<script>
    $(document).ready(function () {
        $("#field_type").change(function(){
        $(this).find("option:selected").each(function(){
            var optionValue = $(this).attr("id");
            // #ToDo change the hard code
            switch (optionValue) {
                case ('4'):
                $('#dropdownOption').html('');
                    $('#dropdownOption').append(`<fieldset class="box-body" id="attributeField">
                                    <legend class="small mb-1">
                                        <h4><span>Options(Value of your Attribute)</span></h4>
                                    </legend>
                                <br />
                                <div class="table-responsive rounded card-table" >
                                    <table class="table border-no">
                                      <thead>
                                        <tr id="attribute-options-table">
                                          <th class="small mb-1">
                                            <span>Attribute Value</span>
                                          </th>
                                          <th class="small mb-1"></th>
                                          <th class="small mb-1">&nbsp;</th>
                                        </tr>
                                      </thead>
                                      <tbody id="tbody">
                                      </tbody>
                                      <tfoot>
                                        <tr>
                                          <th colspan="5" class="">
                                            <button id="add_new_option_button" data-action="add_new_row" title="Add Option" type="button" class="btn btn-primary">
                                              <span>Add Option</span>
                                            </button>
                                          </th>
                                        </tr>
                                      </tfoot>
                                    </table>
                                    </div>
                                </fieldset>`);
                                var rowIdx = 1;
                    $('#add_new_option_button').on('click', function () {
                        $('#tbody').append(`<tr class="R" id="R${++rowIdx}">
                                <td class="row-index">
                                <label class="small mb-1 @error('attribute_value') is-invalid @enderror" for="attribute_value">{{__('main.attribute_value')}}</label>
                                <input class="form-control" id="R${rowIdx}" name="field_data[]" type="text" placeholder="{{__('main.Enter Attribute Value as Text')}}" required autofocus>
                                </td>
                                <td class="text-center">
                                <button class="btn btn-danger remove"
                                type="button">Remove</button>
                                </td>
                                </tr>`);
                        });
                    $('#tbody').on('click', '.remove', function () {
                        var child = $(this).closest('tr').nextAll();
                        child.each(function () {
                        var id = $(this).attr('id');
                        var idx = $(this).children('.row-index').children('p');
                        var dig = parseInt(id.substring(1));
                        $(this).attr('id', `R${dig - 1}`);
                        });
                        $(this).closest('tr').remove();
                        rowIdx--;
                    });
                    break;

                case ('29'):
                $('#attributeField').remove();
                    $('#dropdownOption').html('');
                    $('#dropdownOption').append(`<fieldset class="box-body" id="attributeField">
                                    <legend class="small mb-1">
                                        <h4><span>Options(Value of your Attribute)</span></h4>
                                    </legend>
                                <br />
                                <div class="table-responsive rounded card-table" >
                                    <table class="table border-no">
                                      <thead>
                                        <tr id="attribute-options-table">
                                          <th class="small mb-1">
                                            <span>Attribute Value</span>
                                          </th>
                                          <th class="small mb-1"></th>
                                          <th class="small mb-1">&nbsp;</th>
                                        </tr>
                                      </thead>
                                      <tbody id="tbody">
                                      </tbody>
                                      <tfoot>
                                        <tr>
                                          <th colspan="5" class="">
                                            <button id="add_new_option_button" data-action="add_new_row" title="Add Option" type="button" class="btn btn-primary">
                                              <span>Add Option</span>
                                            </button>
                                          </th>
                                        </tr>
                                      </tfoot>
                                    </table>
                                    </div>
                    </fieldset>`);
                    var rowIdx = 1;
                    $('#add_new_option_button').on('click', function () {
                        $('#tbody').append(`<tr class="R" id="R${++rowIdx}">
                                <td class="row-index">
                                <label class="small mb-1 @error('attribute_value') is-invalid @enderror" for="attribute_value">{{__('main.attribute_value')}}</label>
                                <input class="form-control" id="R${rowIdx}" name="field_data[]" type="number" max="336" placeholder="{{__('main.Enter Attribute Value')}}" required autofocus>
                                </td>
                                <td class="text-center">
                                <button class="btn btn-danger remove"
                                type="button">Remove</button>
                                </td>
                                </tr>`);
                        });
                    $('#tbody').on('click', '.remove', function () {
                        var child = $(this).closest('tr').nextAll();
                        child.each(function () {
                        var id = $(this).attr('id');
                        var idx = $(this).children('.row-index').children('p');
                        var dig = parseInt(id.substring(1));
                        $(this).attr('id', `R${dig - 1}`);
                        });
                        $(this).closest('tr').remove();
                        rowIdx--;
                    });
                    break;

                default:
                $('#attributeField').remove();
                $('#dropdownOption').html('');
                    break;
            }
        });
      }).change();

    });
</script>
@endsection
