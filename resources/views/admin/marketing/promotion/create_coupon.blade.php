@extends('layouts.admin.layout')
@section('title') {{__('main.create_coupon')}} @endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') {{ __('main.coupon') }} @endslot
@slot('li_2') {{ __('main.promotion') }} @endslot
@slot('title') {{__('main.marketing')}} @endslot
@slot('link') {{ route('admin.createCoupon')}} @endslot
@endcomponent
<section class="content">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold">
                {{__('main.create_coupon')}}
            </h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{route('admin.storeCoupon')}}" id="storeCouponForm"
                enctype="multipart/form-data">
                @csrf
                <div class="row m-1">
                    <label class="col-sm-2 col-form-label">{{__('main.coupon_option')}}</label>
                    <div class="col-sm-10 d-flex align-items-center">
                        <div class="form-check ps-0">
                            <input name="coupon_option" type="radio" class="with-gap" id="automatic" value="automatic" checked />
                            <label class="mb-0" for="automatic">{{__('main.automatic')}}</label>
                        </div>
                        <div class="form-check">
                            <input name="coupon_option" type="radio" class="with-gap" id="manual" value="manual" />
                            <label class="mb-0" for="manual">{{__('main.manual')}}</label>
                        </div>
                    </div>
                </div>
                {{-- <div class="demo-radio-button">
                    <h6>{{__('main.coupon_option')}}</h6>
                    <br>
                    <input name="coupon_option" type="radio" class="with-gap" id="automatic" value="automatic"
                        checked />
                    <label for="automatic">{{__('main.automatic')}}</label>
                    <input name="coupon_option" type="radio" class="with-gap" id="manual" value="manual" />
                    <label for="manual">{{__('main.manual')}}</label>
                </div> --}}
                <div class="form-group row m-1">
                    <label class="col-sm-2 col-form-label"
                        for="uses_per_customer">{{__('main.uses_per_customer')}}</label>
                    <div class="col-sm-10">
                        <input class="form-control @error('uses_per_customer') is-invalid @enderror"
                            id="uses_per_customer" name="uses_per_customer" type="number" min="0" value="0" required
                            autofocus>
                    </div>
                </div>

                <div class="form-group row m-1" id="coupon_code">
                </div>
                <div class='form-group row m-1'>
                    <label class="col-sm-2 col-form-label" for="coupon_rule">{{__('main.coupon_rule')}}</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="coupon_rule" name="coupon_rule">
                            <option value="" id="">{{__('main.select')}}</option>
                            @foreach ($couponRules as $couponRule)
                            <option value="{{$couponRule->id}}" id="{{$couponRule->id}}">{{$couponRule->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row m-1 amount_type">

                </div>
                <div class="form-group row m-1" id="amount">

                </div>
                <div class='form-group row m-1 couponRuleData'>

                </div>
                <div class="form-group row m-1">
                    <label class="col-sm-2 col-form-label" for="expiry_date">{{__('main.expiry_date')}}</label>
                    <div class="col-sm-10">
                        <input class="form-control @error('expiry_date') is-invalid @enderror" id="expiry_date"
                            name="expiry_date" type="date" min="{{date(" Y-m-d")}}"
                            placeholder="{{__('main.Enter Expiry Date')}}" value="{{ old('expiry_date') }}" required
                            autofocus>
                    </div>
                </div>
                <div class="row gx-3 mb-3">
                    <div class="col-md-6">
                        <br>
                        <!-- Form Checkbox Right -->
                        <div class="form-check form-check-right mb-2">
                            <input class="form-check-input" type="checkbox" name="formCheckboxRight" id="formCheckboxRight1" checked="">
                            <label class="form-check-label" for="formCheckboxRight1">
                                Form Radio Right
                            </label>
                        </div>
                        {{-- <label class="form-check-label" for="is_active"> {{__('main.status')}} </label>
                        <input type="checkbox" id="status" name="status" class="form-check-input" /> --}}
                        {{-- <input type="checkbox" class="filled-in chk-col-primary" id="status" name="status"
                            checked />
                        <label class="small mb-1" for="status">{{__('main.status')}}</label> --}}
                    </div>
                </div>
                <div class="col-6 mb-3">
                    <a class="btn btn-secondary mr-2" href="{{url()->previous()}}">{{__('main.cancel')}}</a>
                    <button class="btn btn-primary" type="submit">{{__('main.save_changes')}}</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
@section('script')
<script src={{asset("assets/libs/jquery-validation-1.17.0/dist/jquery.validate.js")}}></script>
<script src={{asset("assets/libs/bootstrap-select/dist/js/bootstrap-select.min.js")}}></script>
<script>
    $(document).ready(function () {
    var jqueryFormatterJS = document.createElement("script");
    jqueryFormatterJS.type = "text/javascript";
    jqueryFormatterJS.src = "{{asset('assets/assets/vendor_components/formatter/jquery.formatter.js')}}";

    var formatterJS = document.createElement("script");
    formatterJS.type = "text/javascript";
    formatterJS.src = "{{asset('assets/assets/vendor_components/formatter/formatter.js')}}";

    var formatJS = document.createElement("script");
    formatJS.type = "text/javascript";
    formatJS.src = "{{asset('assets/js/pages/formatter.js')}}";

    // var amountType = '<h6>{{__('main.amount_type')}}</h6><br><input name="amount_type" type="radio" class="with-gap" id="percentage" value="percentage" /><label for="percentage">{{__('main.percentage_(in_%)')}}</label><input name="amount_type" type="radio" class="with-gap" id="fixed" value="fixed" /><label for="fixed">{{__('main.fixed')}}</label>';
    var amountType = '<label class="col-sm-2 col-form-label">{{__("main.amount_type")}}</label><div class="col-sm-10 d-flex align-items-center"><div class="form-check ps-0"><input name="amount_type" type="radio" class="with-gap" id="percentage" value="percentage"/><label class="mb-0" for="percentage">{{__("main.percentage_(in_%)")}}</label></div><div class="form-check"><input name="amount_type" type="radio" class="with-gap" id="fixed" value="fixed" /><label class="mb-0" for="fixed">{{__("main.fixed")}}</label></div></div>';

    var percentage = '<label class="col-sm-2 col-form-label" for="percent">{{__('main.percentage')}}</label><div class="col-sm-10"><input class="form-control @error('percentage') is-invalid @enderror" id="percent" name="amount" type="number" min="0" value="{{ old('percentage') }}" required autofocus></div>';

    var fixedAmount = '<label class="col-sm-2 col-form-label" for="fixedAmount">{{__('main.amount')}}</label><div class="col-sm-10"><input class="form-control @error('amount') is-invalid @enderror" id="fixedAmount" name="amount" type="number" min="0" placeholder="{{__('main.Enter amount')}}" value="{{ old('amount') }}" required autofocus></div>';



    $('#manual').click(function (e) {
    var coupon_code = '<label class="col-sm-2 col-form-label" for="coupon_code">{{__('main.coupon_code')}}</label><div class="col-sm-10"><input class="form-control @error('coupon_code') is-invalid @enderror" name="coupon_code" type="text" placeholder="{{__('main.Enter coupon code')}}" value="{{ old('coupon_code') }}" required autofocus></div>';
    $('#coupon_code').html(coupon_code);
    });

    $('#automatic').click(function (e) {
    $('#coupon_code').html('');
    });

    $('#coupon_rule').change(function (e) {
        $(this).find('option:selected').each(function () {
          var optionVale = $(this).attr('id');
          console.log(optionVale);
          if (optionVale == '45'){
            $('.couponRuleData').html('');

            $('.amount_type').html('');
            $('.amount_type').html(amountType);
            $('.couponRuleData').html('<label class="col-sm-2 col-form-label" for="categories">{{__('main.category')}}</label><div class="col-sm-10"><select class="selectpicker" id="categories" name="coupon_rule_data[]" multiple>@foreach ($categories as $category)<option value="{{$category->id}}" id="{{$category->id}}">{{$category->name}}</option>@endforeach</select></div>');
            $('#percentage').click(function (e) {
              $('#amount').html('');
              $('#amount').html(percentage);
            });

            $('#fixed').click(function (e) {
              $('#amount').html('');
              $('#amount').html(fixedAmount);
            });


          }else if(optionVale == '46'){
            $('#amount').html('');
            $('.amount_type').html('');
            $('.couponRuleData').html('');
            $('.couponRuleData').append(`<fieldset class="box-body" id="attributeField">
                                    <legend class="small mb-1">
                                        <h4><span>Options(Range of Discount)</span></h4>
                                    </legend>
                                <br />
                                <div class="table-responsive rounded card-table" >
                                    <table class="table border-no">
                                      <thead>
                                      </thead>
                                      <tbody id="tbody">
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
                                </fieldset>`);
                                var rowIdx = 0;
            $('#add_new_option_button').on('click', function () {
              $('.amount_type').html(amountType);
              $('#fixed').attr('checked', true);
              $('#tbody').append(`<tr class="R" id="R${rowIdx++}">
                      <td class="row-index">
                      <label class="small mb-1 @error('minimum_value') is-invalid @enderror" for="minimum_value">{{__('main.minimum_value')}}</label>
                      <input class="form-control" id="R${rowIdx}" name="range[${rowIdx}][]" type="number" min="0" placeholder="{{__('main.Enter Min. Value')}}" required autofocus>
                </td>
                <td class="row-index">
                      <label class="small mb-1 @error('maximum_vlaue') is-invalid @enderror" for="maximum_vlaue">{{__('main.maximum_value')}}</label>
                      <input class="form-control" id="R${rowIdx}" name="range[${rowIdx}][]" type="number" min="0" placeholder="{{__('main.Enter Max. Value')}}" required autofocus>
                </td>
                <td class="row-index">
                      <label class="small mb-1 @error('amount') is-invalid @enderror" for="amount">{{__('main.discount_value')}}</label>
                      <input class="form-control" id="amount" name="range[${rowIdx}][]" type="number" min="0" required autofocus>
                </td>
                <td class="row-index" id="discount">
                </td>
                <td class="text-center">
                  <button class="btn btn-danger remove"
                  type="button">{{__('main.remove')}}</button>
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


          }else if(optionVale == '47'){
            $('.couponRuleData').html('');

            $('.amount_type').html('');
            $('.amount_type').html(amountType);
            $('.couponRuleData').html('<label class="col-sm-2 col-form-label" for="user_type">{{__('main.user_type')}}</label><div class="col-sm-10"><select class="selectpicker" name="coupon_rule_data[]" id="user_type" multiple>@if (count($userTypes))@foreach ($userTypes as $type)<option value="{{$type->id}}">{{$type->name}}</option> @endforeach @endif</select></div>');

            $('#percentage').click(function (e) {
              $('#amount').html('');
              $('#amount').html(percentage);
            });

            $('#fixed').click(function (e) {
              $('#amount').html('');
              $('#amount').html(fixedAmount);
            });

          }else{
            $('.couponRuleData').html('');
            $('.amount_type').html('');

          }
          $('.selectpicker').selectpicker('render');
        });

    });

    $("#storeCouponForm").validate({
          rules: {
            "percent": {
                        required: true,
                        minlength: 1,
                        maxlength: 2,
                        number: true
            },
            "fixedAmount": {
                        required: true,
                        minlength: 1,
                        maxlength: 7,
                        number: true
            },
            "categories": {
                        required: true,
                    },
            "user_type": {
                        required: true,
                    },
            "expiry_date" : {
                        required: true,
            }
          },
          messages: {
            "amount": {
                        required: "Enter Vaild Amount",
                    },
            "categories": {
                required: "Select at least one Category",
            },
            "user_type": {
                        required: "Select any one option",
            },
            "expiry_date": {
                        required: "Enter Expiry Date",
          }
        }
        });
  });
</script>
@endsection
