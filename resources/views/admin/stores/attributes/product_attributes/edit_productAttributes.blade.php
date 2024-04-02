@extends('layouts.admin.layout')
@section('title')
    {{__('main.edit_attribute')}}
@endsection
@section('content')
@component('components.breadcrumb')
    @slot('li_1') {{__('main.edit')}} @endslot
    @slot('title') {{__('main.attribute')}} @endslot
    @slot('link') {{ route('admin.attributeProductList')}} @endslot
@endcomponent
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex align-items-center">
                        <h6 class="card-title mb-0 flex-grow-1">{{__('main.edit_attribute')}}</h6>
                        <div>
                            {{-- <a href="javascript:void(0)" type="button" class="btn btn-danger btn-icon waves-effect waves-light" @if(!in_array($attribute->name_code, $reservedAttribute)) id="deleteAttribute" @endif><i class="ri-delete-bin-5-line"></i></a> --}}
                            <a href="javascript:void(0)" type="button" class="btn btn-danger btn-icon waves-effect waves-light" id="deleteAttribute" data-id="{{$attribute->id}}"><i class="ri-delete-bin-5-line"></i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.updateProductAttribute',['id'=>$attribute->id]) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row gx-3 mb-3">
                                <div class="col-md-6">
                                    <label class="small mb-1"
                                        for="label_name">{{ __('main.default_label') }}</label>
                                    <input class="form-control" id="label_name" name="label_name" type="text"
                                        value="{{ $attribute->label_name }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="small mb-1"
                                        for="field_type">{{ __('main.catalog_input_type_for_stote_owner') }}</label>
                                    <input class="form-control" id="field_type" name="field_type"
                                        data-field="{{ $attribute->field_type }}" type="text"
                                        @if(isset($attribute->fieldType->name)) value="{{$attribute->fieldType->name}}" @endif
                                        readonly="true"/>
                                </div>
                            </div>
                            <div class="row gx-3 mb-3">
                                <div class="col-md-6">
                                    <br>
                                    <input type="checkbox" class="filled-in chk-col-primary" id="is_active"
                                        name="is_active" value="{{ old($attribute->is_active) }}"
                                        @if (old('is_active', $attribute->is_active)) checked @endif>
                                    <label class="small mb-1"
                                        for="is_active">{{ __('main.is_active') }}</label>
                                </div>
                                <div class="col-md-6">
                                    <label class="small mb-1"
                                        for="field_required">{{ __('main.values_required') }}</label>
                                    <select class="form-control" name="field_required" id="field_required">
                                        @if ($attribute->field_required == 0)
                                            <option value="0" selected="selected">{{__('main.no')}}</option>
                                            <option value="1">{{__('main.yes')}}</option>
                                        @elseif ($attribute->field_required == 1)
                                            <option value="1" selected="selected">{{__('main.yes')}}</option>
                                            <option value="0">{{__('main.no')}}</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            @switch($attribute->field_type)
                                @case(4)
                                    <div class="row gx-3 mb-3" id="dropdown">
                                        <fieldset class="box-body">
                                            <legend class="small mb-1">
                                                <h4><span>{{__('main.Options(Value of your Attribute)')}}</span></h4>
                                            </legend>
                                            <br />
                                            <div class="table-responsive rounded card-table">
                                                <table class="table border-no">
                                                    <thead>
                                                        <tr id="attribute-options-table">
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tbody">
                                                        @if (isset($attribute->field_data) && $attribute->field_data != null)
                                                        @foreach ($attribute->field_data as $field_data)
                                                            <tr id="R1">
                                                                <td class="row-index">
                                                                    <label class="small mb-1 @error('attribute_value') is-invalid @enderror" for="attribute_value">{{__('main.attribute_value')}}</label>
                                                                    <input class="form-control" id="R1"
                                                                        name="field_data[]" value="{{ $field_data }}"
                                                                        type="text"
                                                                        placeholder="{{ __('main.Enter Attribute Value') }}"
                                                                        required autofocus>
                                                                </td>
                                                                <td class="row-index">
                                                                    <button class="btn btn-danger mt-4 remove"type="button">{{__('main.remove')}}</button>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        @endif
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                        <th colspan="5" class="">
                                                            <button id="add_new_option_button" data-action="add_new_row" title="Add Option" type="button" class="btn btn-primary">
                                                            <span>{{__('main.add_option')}}</span>
                                                            </button>
                                                        </th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </fieldset>
                                    </div>
                                    @break
                                @case(29)
                                    <div class="row gx-3 mb-3" id="dropdown">
                                        <fieldset class="box-body">
                                            <legend class="small mb-1">
                                                <h4><span>{{__('main.Options(Value of your Attribute)')}}</span></h4>
                                            </legend>
                                            <br />
                                            <div class="table-responsive rounded card-table">
                                                <table class="table border-no">
                                                    <thead>
                                                        <tr id="attribute-options-table">
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tbody">
                                                        @if (isset($attribute->field_data) && $attribute->field_data != null)
                                                        @foreach ($attribute->field_data as $field_data)
                                                            <tr id="R1">
                                                                <td class="row-index">
                                                                    <label class="small mb-1 @error('attribute_value') is-invalid @enderror" for="attribute_value">{{__('main.attribute_value')}}</label>
                                                                    <input class="form-control" id="R1"
                                                                        name="field_data[]" value="{{ $field_data }}"
                                                                        type="number"
                                                                        placeholder="{{ __('main.Enter Attribute Value as Number') }}"
                                                                        required autofocus>
                                                                </td>
                                                                <td class="row-index">
                                                                    <button class="btn btn-danger mt-4 remove"type="button">{{__('main.remove')}}</button>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        @endif
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                        <th colspan="5" class="">
                                                            <button id="add_new_option_button" data-action="add_new_row" title="Add Option" type="button" class="btn btn-primary">
                                                            <span>{{__('main.add_option')}}</span>
                                                            </button>
                                                        </th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </fieldset>
                                    </div>
                                    @break
                                @default

                            @endswitch
                            <div class="row gx-3 mb-3"></div>
                            <a class="btn btn-secondary mr-2"
                            href="{{ route('admin.attributeProductList') }}">{{ __('main.cancel') }}</a>
                            <button class="btn btn-primary" type="submit">{{ __('main.save') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#deleteAttribute').click(function(e) {
                e.preventDefault();

                var id = $(this).data("id");
                swal({
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover this Data!",
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
                                url: "{{route('admin.destroyProductAttribute',"")}}"+"/"+id,
                                data: data,
                                success: function(response) {
                                    switch (response.status) {
                                        case 1:
                                        swal(response.message, {
                                            icon: "success",
                                            timer: 3000,
                                        })
                                        .then((result) => {
                                            window.location =
                                                '{{ route('admin.attributeProductList') }}'
                                        });
                                            break;
                                        case 0:
                                        swal(response.message, {
                                            timer: 3000,
                                        });

                                            break;

                                        default:
                                            break;
                                    }
                                }
                            });
                        }
                    });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            var rowIdx = 1;
            $('#add_new_option_button').on('click', function () {
                var optionValue = $('#field_type').data('field');
                const newRow = addNewRow(optionValue);
                $('#tbody').append(newRow);
            });
            function addNewRow(optionValue)
            {
                switch (optionValue) {
                case (4):
                    var row = `<tr class="R" id="R${++rowIdx}">
                            <td class="row-index">
                            <label class="small mb-1 @error('attribute_value') is-invalid @enderror" for="attribute_value">{{__('main.attribute_value')}}</label>
                            <input class="form-control" id="R${rowIdx}" name="field_data[]" type="text" placeholder="{{__('main.Enter Attribute Value as Text')}}" required autofocus>
                            </td>
                            <td class="row-index">
                                <button class="btn btn-danger mt-4 remove"
                                type="button">Remove</button>
                                </td>
                            </tr>`;
                    break;
                case (29):
                    var row =  `<tr class="R" id="R${++rowIdx}">
                            <td class="row-index">
                            <label class="small mb-1 @error('attribute_value') is-invalid @enderror" for="attribute_value">{{__('main.attribute_value')}}</label>
                            <input class="form-control" id="R${rowIdx}" name="field_data[]" type="number" placeholder="{{__('main.Enter Attribute Value as Number')}}" required autofocus>
                            </td>
                            <td class="row-index">
                                <button class="btn btn-danger mt-4 remove"
                                type="button">Remove</button>
                                </td>
                        </tr>`;
                    break;

                default:
                    var row = `nothing found`;
                    break;
                }
                return row;
            }
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
            });
    </script>
@endsection
