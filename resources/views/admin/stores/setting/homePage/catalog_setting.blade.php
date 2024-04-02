@extends('layouts.admin.layout')
@section('title')
  {{__('main.home_page_setting')}}
@endsection
@section('content')
<div class="content-header">
  <div class="d-flex align-items-center">
      <div class="me-auto">
          <h4 class="page-title">{{ __('main.setting') }}</h4>
          <div class="d-inline-block align-items-center">
              <nav>
                  <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{ route('admin.homePageTopSectionIndex') }}"><i
                                  class="mdi mdi-home-outline"></i></a></li>
                      <li class="breadcrumb-item active" aria-current="page">{{ __('main.home_page_setting') }}</li>
                  </ol>
              </nav>
          </div>
      </div>
  </div>
</div>
@if (count($sections) == 0)
<section class="content">
  <div class="col-12">
      <ul class="nav nav-tabs customtab2" role="tablist">
        <li class="nav-item"> <a class="nav-link" href="{{route('admin.homePageTopSectionIndex')}}"><span class="hidden-sm-up"><i class="ion-laptop"></i></span> <span class="hidden-xs-down">{{__('main.top_section')}}</span></a> </li>
        <li class="nav-item"> <a class="nav-link active" href="{{route('admin.homePageCatalogSettingIndex')}}"><span class="hidden-sm-up"><i class="ion-clipboard"></i></span> <span class="hidden-xs-down">{{__('main.catalog_setting')}}</span></a> </li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane active" id="catalog_setting" role="tabpanel">
        <section class="content">
          <div class="row">
            <div class="col-12">
              <div class="box box-bordered border-primary">
                <div class="box-header with-border">
                  <h4 class="box-title text-primary"><strong>{{ __('main.home_page_catalog') }}</strong></h4>
                </div>
                <div class="box-body">
                  <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                      <form method="POST" action="{{route('admin.homePageCatalogSettingStore')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="table-responsive rounded card-table">
                          <table class="table border-no">
                            <thead>
                            </thead>
                            <tbody id="add_more_catalog_setting">
                              <tr id="R1">
                                <td>
                                  <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="title">{{ __('main.section_title') }}</label>
                                    <div class="col-sm-10">
                                      <input class="form-control @error('title') is-invalid @enderror" id="text" type="text"
                                        name="section[1][title]" required>
                                    </div>
                                  </div>
                                  <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="title">{{ __('main.select_product') }}</label>
                                    <div class="col-sm-10">
                                      <div class="form-group">
                                        <select name="section[1][product][]" class="js-example-basic-multiple" multiple="multiple" style="width: 50%" required>
                                          @foreach ($products as $product)
                                          <option value="{{$product['product_id']}}" data-tokens="{{$product['product_name']}}">{{$product['product_name']}}</option>
                                          @endforeach
                                        </select>
                                      </div>
                                    </div>
                                  </div>
                                  <div id="section[1]remove_option">
                                    <button class="btn btn-danger remove" id="remove_section" type="button" disabled>{{__('main.remove')}}</button>
                                  </div>
                                </td>
                              </tr>
                            </tbody>
                            <tfoot>
                              <tr>
                                <th colspan="5">
                                  <button id="add_new_option_button" data-action="add_new_option_button" title="Add Option"
                                    type="button" class="btn btn-primary">
                                    <span>{{ __('main.add_one_more') }}</span>
                                  </button>
                                  <button type="submit" class="btn btn-primary">
                                    <i class="ti-save-alt"></i>{{ __('main.save_changes') }}
                                  </button>
                                </th>
                              </tr>
                            </tfoot>
                          </table>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
</section>
@endsection
@section('javascript')
<script src="{{asset('assets/assets/vendor_components/select2-4.0.13/dist/js/select2.full.js')}}"></script>
<script>
  $(document).ready(function(){
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('.js-example-basic-multiple').select2({
      placeholder: 'Select an option',
      // scrollAfterSelect: true,
      width: 'resolve',
      dropdownAutoWidth:false,
      closeOnSelect:false,
      allowClear: true,
    });

    var rowIdx = 1;
    $('#add_new_option_button').on('click', function () {
      $('#add_more_catalog_setting').append(`<tr id="R${++rowIdx}">
                                <td>
                                  <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="title">{{ __('main.section_title') }}</label>
                                    <div class="col-sm-10">
                                      <input class="form-control @error('title') is-invalid @enderror" id="text" type="text"
                                        name="section[${rowIdx}][title]" required>
                                    </div>
                                  </div>
                                  <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="title">{{ __('main.select_product') }}</label>
                                    <div class="col-sm-10">
                                      <div class="form-group">
                                        <select name="section[${rowIdx}][product][]" class="js-example-basic-multiple" multiple="multiple" style="width: 50%" required>
                                          @foreach ($products as $product)
                                          <option value="{{$product['product_id']}}" data-tokens="{{$product['product_name']}}">{{$product['product_name']}}</option>
                                          @endforeach
                                        </select>
                                      </div>
                                    </div>
                                  </div>
                                  <div id="remove_option">
                                    <button class="btn btn-danger remove" id="remove_section" type="button">{{__('main.remove')}}</button>
                                  </div>
                                </td>
                              </tr>`);
          $('.js-example-basic-multiple').select2({
                        placeholder: 'Select an option',
                        // scrollAfterSelect: true,
                        dropdownAutoWidth:false,
                        closeOnSelect:false,
                        allowClear: true,
                      });
                    });// click

    $("#add_more_catalog_setting").on('click', '.remove', function () {
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
@elseif (count($sections) > 0)
<div id="sections" data-id="{{count($sections)}}"></div>
<section class="content">
  <div class="col-12">
      <ul class="nav nav-tabs customtab2" role="tablist">
        <li class="nav-item"> <a class="nav-link" href="{{route('admin.homePageTopSectionIndex')}}"><span class="hidden-sm-up"><i class="ion-laptop"></i></span> <span class="hidden-xs-down">{{__('main.top_section')}}</span></a> </li>
        <li class="nav-item"> <a class="nav-link active" href="{{route('admin.homePageCatalogSettingIndex')}}"><span class="hidden-sm-up"><i class="ion-clipboard"></i></span> <span class="hidden-xs-down">{{__('main.catalog_setting')}}</span></a> </li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane active" id="catalog_setting" role="tabpanel">
        <section class="content">
          <div class="row">
            <div class="col-12">
              <div class="box box-bordered border-primary">
                <div class="box-header with-border">
                  <h4 class="box-title text-primary"><strong>{{ __('main.home_page_catalog') }}</strong></h4>
                </div>
                <div class="box-body">
                  <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                      <form method="POST" action="{{route('admin.homePageCatalogSettingStore')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="table-responsive rounded card-table">
                          <table class="table border-no">
                            <thead>
                            </thead>
                            <tbody id="add_more_catalog_setting">
                              @foreach ($sections as $section)
                              <tr id="R{{$section['id']}}">
                                <td>
                                  <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="title">{{ __('main.section_title') }}</label>
                                    <div class="col-sm-10">
                                      <input class="form-control @error('title') is-invalid @enderror" id="text" type="text"
                                        name="section[{{$section['id']}}][title]" value="{{$section['title']}}" required>
                                    </div>
                                  </div>
                                  <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="title">{{ __('main.select_product') }}</label>
                                    <div class="col-sm-10">
                                      <div class="form-group">
                                        <select name="section[{{$section['id']}}][product][]" class="js-example-basic-multiple" multiple="multiple" style="width: 50%" required>
                                          @foreach ($products as $product)
                                          <option value="{{$product['product_id']}}" data-tokens="{{$product['product_name']}}" {{ in_array($product['product_id'], $section['product_id']) ? 'selected' : ""}}>{{$product['product_name']}}</option>
                                          @endforeach
                                        </select>
                                      </div>
                                    </div>
                                  </div>
                                  <button class="btn btn-danger remove" id="remove_section" data-id="{{ $section['id'] }}" type="button" @if ($section['id'] == '1') disabled @endif >{{__('main.remove')}}</button>
                                </td>
                              </tr>
                              @endforeach
                            </tbody>
                            <tfoot>
                              <tr>
                                <th colspan="5">
                                  <button id="add_new_option_button" data-action="add_new_option_button" title="Add Option"
                                    type="button" class="btn btn-primary">
                                    <span>{{ __('main.add_one_more') }}</span>
                                  </button>
                                  <button type="submit" class="btn btn-primary">
                                    <i class="ti-save-alt"></i>{{ __('main.save_changes') }}
                                  </button>
                                </th>
                              </tr>
                            </tfoot>
                          </table>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
</section>
@endsection
@section('javascript')
<script src="{{asset('assets/assets/vendor_components/select2-4.0.13/dist/js/select2.full.js')}}"></script>
<script>
  $(document).ready(function(){
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('.js-example-basic-multiple').select2({
      placeholder: 'Select an option',
      // scrollAfterSelect: true,
      dropdownAutoWidth:false,
      closeOnSelect:false,
      allowClear: true,
    });

    var rowIdx = $('#sections').data('id');
    $('#add_new_option_button').on('click', function () {
      $('#add_more_catalog_setting').append(`<tr id="R${++rowIdx}">
                                <td>
                                  <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="title">{{ __('main.section_title') }}</label>
                                    <div class="col-sm-10">
                                      <input class="form-control @error('title') is-invalid @enderror" id="text" type="text"
                                        name="section[${rowIdx}][title]" required>
                                    </div>
                                  </div>
                                  <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="title">{{ __('main.select_product') }}</label>
                                    <div class="col-sm-10">
                                      <div class="form-group">
                                        <select name="section[${rowIdx}][product][]" class="js-example-basic-multiple" multiple="multiple" style="width: 50%" required>
                                          @foreach ($products as $product)
                                          <option value="{{$product['product_id']}}" data-tokens="{{$product['product_name']}}">{{$product['product_name']}}</option>
                                          @endforeach
                                        </select>
                                      </div>
                                    </div>
                                  </div>
                                  <button class="btn btn-danger remove" id="remove_section" type="button">{{__('main.remove')}}</button>
                                </td>
                              </tr>`);
                    $('.js-example-basic-multiple').select2({
                        placeholder: 'Select an option',
                        // scrollAfterSelect: true,
                        dropdownAutoWidth:false,
                        closeOnSelect:false,
                        allowClear: true,
                      });
                    });// click

      $("#add_more_catalog_setting").on('click', '.remove', function (e) {
        e.preventDefault();
        var id = $(this).data("id");
        if (id != null || id != undefined){
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
                        url: "{{route('admin.homePageCatalogSettingDestroy',"")}}"+"/"+id,
                        data: data,
                        success: function(response) {
                            swal(response.status, {
                                    icon: "success",
                                })
                                .then((result) => {
                                    window.location = '{{ route('admin.homePageCatalogSettingIndex') }}';
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
                        }
                    });
                }
            });
        }else{
          var child = $(this).closest('tr').nextAll();
          child.each(function () {
          var id = $(this).attr('id');
          var idx = $(this).children('.row-index').children('p');
          var dig = parseInt(id.substring(1));
          $(this).attr('id', `R${dig - 1}`);
          });
          $(this).closest('tr').remove();
          rowIdx--;
        }
    });
  });
</script>
@endsection
@endif

