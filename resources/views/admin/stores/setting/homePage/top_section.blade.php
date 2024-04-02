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
<section class="content">
  <div class="col-12">
      <ul class="nav nav-tabs customtab2" role="tablist">
        <li class="nav-item"> <a class="nav-link active" href="{{route('admin.homePageTopSectionIndex')}}"><span class="hidden-sm-up"><i class="ion-laptop"></i></span> <span class="hidden-xs-down">{{__('main.top_section')}}</span></a> </li>
        <li class="nav-item"> <a class="nav-link" href="{{route('admin.homePageCatalogSettingIndex')}}"><span class="hidden-sm-up"><i class="ion-clipboard"></i></span> <span class="hidden-xs-down">{{__('main.catalog_setting')}}</span></a> </li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane active" id="top_section" role="tabpanel">
          @if (count($homePageSettings) == 0)
          <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="box box-bordered border-primary">
                        <div class="box-header with-border">
                            <h4 class="box-title text-primary"><strong>{{ __('main.home_page_setting') }}</strong></h4>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                  <form method="POST" action="{{route('admin.storeHomePageSetting')}}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="table-responsive rounded card-table" >
                                      <table class="table border-no">
                                        <thead>
                                        </thead>
                                        <tbody id="add_more">
                                          <tr>
                                            <td>
                                              <div class='form-group row'>
                                                <label class="col-sm-2 col-form-label" for="gallery_type">{{__('main.gallery_type')}}</label>
                                                <div class="col-sm-10">
                                                <select class="form-control" id="gallery_type" name="gallery_type">
                                                      @foreach ($gallery_types as $gallery_type)
                                                      <option value="{{$gallery_type->id}}" id="{{$gallery_type->id}}">{{$gallery_type->name}}</option>
                                                      @endforeach
                                                  </select>
                                                </div>
                                              </div>
                                              <div class="form-group row" id="gridText1">

                                              </div>
                                              <div class="form-group row" id="gridText2">

                                              </div>
                                              <div class="form-group row" id="gridDescription">

                                              </div>
                                              <div class="form-group row add-grid" id="gridButtonText">

                                              </div>
                                              <div class="form-group row add-grid" id="gridButtonUrl">

                                              </div>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td>
                                              <div class="row">
                                                <div class="col-md-6">
                                                  <label class="small mb-1" for="image">{{ __('main.upload_image') }}
                                                    <code>({{ __('main.required') }})</code></label>
                                                  <input class="dropify" id="formFile" name="R[1][image]" type="file" accept="image/png, image/jpeg, image/jpg" required>
                                                </div>
                                                <div class="col-md-6">
                                                  <label class="small mb-1" for="title">{{__('main.image_title')}}
                                                    <code>({{ __('main.required') }})</code></label>
                                                  <input class="form-control @error('title') is-invalid @enderror" id="text" type="text" name="R[1][title]" required>

                                                  <label class="small mb-1" for="image_alt_text">{{__('main.image_alt')}}
                                                    <code>({{ __('main.required') }})</code></label>
                                                  <input class="form-control @error('image_alt_text') is-invalid @enderror" id="text" type="text" name="R[1][image_alt_text]" required>

                                                  <label class="small mb-1" for="description">{{__('main.image_description')}}</label>
                                                  <textarea class="form-control" name="R[1][description]" rows="1" cols="5" ></textarea>
                                                  <div id="r1button"></div>
                                                </div>
                                              </div>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td>
                                              <div class="row">
                                                <div class="col-md-6">
                                                  <label class="small mb-1" for="image">{{ __('main.upload_image') }}
                                                    <code>({{ __('main.required') }})</code></label>
                                                  <input class="dropify" id="formFile" name="R[2][image]" type="file" accept="image/png, image/jpeg, image/jpg" required>
                                                </div>
                                                <div class="col-md-6 add">
                                                  <label class="small mb-1" for="title">{{__('main.image_title')}}
                                                    <code>({{ __('main.required') }})</code></label>
                                                  <input class="form-control @error('title') is-invalid @enderror" id="text" type="text" name="R[2][title]" required>

                                                  <label class="small mb-1" for="image_alt_text">{{__('main.image_alt')}}
                                                    <code>({{ __('main.required') }})</code></label>
                                                  <input class="form-control @error('image_alt_text') is-invalid @enderror" id="text" type="text" name="R[2][image_alt_text]" required>

                                                  <label class="small mb-1" for="description">{{__('main.image_description')}}</label>
                                                  <textarea class="form-control" name="R[2][description]" rows="1" cols="5" ></textarea>
                                                  <div id="r2button">
                                                  </div>
                                                </div>
                                              </div>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td>
                                              <div class="row">
                                                <div class="col-md-6 add">
                                                  <label class="small mb-1" for="image">{{ __('main.upload_image') }}
                                                    <code>({{ __('main.required') }})</code></label>
                                                  <input class="dropify" id="formFile" name="R[3][image]" type="file" accept="image/png, image/jpeg, image/jpg" required>
                                                </div>
                                                <div class="col-md-6">
                                                  <label class="small mb-1" for="title">{{__('main.image_title')}}
                                                    <code>({{ __('main.required') }})</code></label>
                                                  <input class="form-control @error('title') is-invalid @enderror" id="text" type="text" name="R[3][title]" required>

                                                  <label class="small mb-1" for="image_alt_text">{{__('main.image_alt')}}
                                                    <code>({{ __('main.required') }})</code></label>
                                                  <input class="form-control @error('image_alt_text') is-invalid @enderror" id="text" type="text" name="R[3][image_alt_text]" required>

                                                  <label class="small mb-1" for="description">{{__('main.image_description')}}</label>
                                                  <textarea class="form-control" name="R[3][description]" rows="1" cols="5" ></textarea>
                                                  <div id="r3button"></div>
                                                </div>
                                              </div>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td>
                                              <div class="row">
                                                <div class="col-md-6 add">
                                                  <label class="small mb-1" for="image">{{ __('main.upload_image') }}
                                                    <code>({{ __('main.required') }})</code></label>
                                                  <input class="dropify" id="formFile" name="R[4][image]" type="file" accept="image/png, image/jpeg, image/jpg" required>
                                                </div>
                                                <div class="col-md-6">
                                                  <label class="small mb-1" for="title">{{__('main.image_title')}}
                                                    <code>({{ __('main.required') }})</code></label>
                                                  <input class="form-control @error('title') is-invalid @enderror" id="text" type="text" name="R[4][title]" required>

                                                  <label class="small mb-1" for="image_alt_text">{{__('main.image_alt')}}
                                                    <code>({{ __('main.required') }})</code></label>
                                                  <input class="form-control @error('image_alt_text') is-invalid @enderror" id="text" type="text" name="R[4][image_alt_text]" required>

                                                  <label class="small mb-1" for="description">{{__('main.image_description')}}</label>
                                                  <textarea class="form-control" name="R[4][description]" rows="1" cols="5" ></textarea>
                                                  <div id="r4button"></div>
                                                </div>
                                              </div>
                                            </td>
                                          </tr>
                                        </tbody>
                                        <tfoot>
                                          <tr>
                                            <th colspan="5" class="">
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
          </section>
          @elseif (count($homePageSettings) > 0)
          <section class="content" id="edit" >
            <div class="row">
                <div class="col-12">
                    <div class="box box-bordered border-primary">
                        <div class="box-header with-border">
                            <h4 class="box-title text-primary"><strong>{{ __('main.home_page_image') }}</strong></h4>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                  <form method="POST" action="{{route('admin.storeHomePageSetting')}}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="table-responsive rounded card-table" >
                                      <table class="table border-no">
                                        <thead>
                                        </thead>
                                        @php
                                          $typeOfGallery = collect($homePageSettings)->map(function($n){
                                                    return ['id' =>$n['type_of_gallery']['id'], 'name' =>$n['type_of_gallery']['name']['en']];
                                          })->first();
                                          $R = 0;
                                        @endphp
                                        <tbody id="add_more">
                                          <tr>
                                            <td>
                                              <div class='form-group row'>
                                                <label class="col-sm-2 col-form-label" for="gallery_type">{{__('main.gallery_type')}}</label>
                                                <div class="col-sm-10">
                                                <select class="form-control" id="gallery_type" name="gallery_type">
                                                  @foreach ($gallery_types as $gallery_type)
                                                    <option value="{{$gallery_type->id}}" id="{{$gallery_type->id}}" @if ($gallery_type->id == $typeOfGallery['id']) selected @endif>{{$gallery_type->name}}</option>
                                                  @endforeach
                                                  </select>
                                                </div>
                                              </div>
                                              <div class="form-group row" id="gridText1">

                                              </div>
                                              <div class="form-group row" id="gridText2">

                                              </div>
                                              <div class="form-group row" id="gridDescription">

                                              </div>
                                              <div class="form-group row add-grid" id="gridButtonText">

                                              </div>
                                              <div class="form-group row add-grid" id="gridButtonUrl">

                                              </div>
                                            </td>
                                          </tr>
                                          @foreach ($homePageSettings as $homePageSetting)
                                          @php
                                            $R = ++$R;
                                          @endphp
                                          <tr>
                                            <td>
                                              <div class="row">
                                                <div class="col-md-6">
                                                  <label class="small mb-1" for="image">{{ __('main.upload_image') }}
                                                    <code>({{ __('main.required') }})</code></label>
                                                  <input class="dropify" id="formFile" name="R[{{$R}}][image]" data-default-file='{{ asset(config('image.homePage_image_path_view').$homePageSetting['media']['name']) }}' type="file" accept="image/png, image/jpeg, image/jpg" >
                                                </div>
                                                <div class="col-md-6">
                                                  <label class="small mb-1" for="title">{{__('main.image_title')}}</label>
                                                  <input class="form-control @error('title') is-invalid @enderror" id="text" type="text" name="R[{{$R}}][title]" value="{{ $homePageSetting['title'] }}" >

                                                  <label class="small mb-1" for="image_alt_text">{{__('main.image_alt')}}</label>
                                                  <input class="form-control @error('image_alt_text') is-invalid @enderror" id="text" type="text" name="R[{{$R}}][image_alt_text]" value="{{ $homePageSetting['image_alt_text'] }}">

                                                  <label class="small mb-1" for="description">{{__('main.image_description')}}</label>
                                                  <textarea class="form-control" name="R[{{$R}}][description]" rows="1" cols="5" >{{ $homePageSetting['description'] }}</textarea>
                                                  <div id="r{{$R}}button">
                                                    </div>
                                                </div>
                                              </div>
                                            </td>
                                          </tr>
                                          @endforeach
                                        </tbody>
                                        <tfoot>
                                          <tr>
                                            <th colspan="5" class="">
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
          @endif
        </div>
    </div>
</section>
@endsection
@section('javascript')
@if (count($homePageSettings) == 0)
<script>
  $(document).ready(function () {
    $('.dropify').dropify();
    $('#gallery_type').change(function () {
      $(this).find("option:selected").each(function () {
        var optionValue = $(this).attr('id');
        if (optionValue == 22){
          $("#r1button").html("");
          $("#r2button").html("");
          $("#r3button").html("");
          $("#r4button").html("");
          var gridText1 = "<label class='col-sm-2 col-form-label' for='grid_text'>{{__('main.grid_text_line_one')}}</label><div class='col-sm-10'><input class='form-control @error('grid_text') is-invalid @enderror' id='grid_text' type='text' name='grid_text[]' ></div>";

          var gridText2 = "<label class='col-sm-2 col-form-label' for='grid_text'>{{__('main.grid_text_line_two')}}</label><div class='col-sm-10'><input class='form-control @error('grid_text') is-invalid @enderror' id='grid_text' type='text' name='grid_text[]' ></div>";

          var gridDescription = "<label class='col-sm-2 col-form-label' for='gridDescription'>{{__('main.grid_description')}}</label><div class='col-sm-10'><textarea class='form-control @error('grid_text') is-invalid @enderror' name='grid_description' rows='1' cols='5' ></textarea></div>";

          var gridButtonText = "<label class='col-sm-2 col-form-label' for='grid_button_text'>{{__('main.grid_button_text')}}</label><div class='col-sm-10'><input class='form-control @error('grid_button_text') is-invalid @enderror' id='grid_button_text' type='text' name='grid_button_text' ></div>";

          var gridButtonUrl = "<label class='col-sm-2 col-form-label' for='title'>{{__('main.grid_button_url')}}</label><div class='col-sm-10'><input class='form-control @error('grid_button_url') is-invalid @enderror' id='grid_button_url' type='text' name='grid_button_url' ></div>";

          $('#gridText1').html(gridText1);
          $('#gridText2').html(gridText2);
          $('#gridDescription').html(gridDescription);
          $('#gridButtonText').html(gridButtonText);
          $('#gridButtonUrl').html(gridButtonUrl);
        }
        if(optionValue == 23){
          $('#gridText1').html('');
          $('#gridText2').html('');
          $('#gridDescription').html('');
          $('#gridButtonText').html('');
          $('#gridButtonUrl').html('');
          var r1button = "<label class='small mb-1' for='button_url'>{{__('main.button_url')}}</label><input class='form-control @error('button_url') is-invalid' @enderror type='text' name='R[1][button_url]' id='button_url'>";
          var r2button = "<label class='small mb-1' for='button_url'>{{__('main.button_url')}}</label><input class='form-control @error('button_url') is-invalid' @enderror type='text' name='R[2][button_url]' id='button_url'>";
          var r3button = "<label class='small mb-1' for='button_url'>{{__('main.button_url')}}</label><input class='form-control @error('button_url') is-invalid' @enderror type='text' name='R[3][button_url]' id='button_url'>";
          var r4button = "<label class='small mb-1' for='button_url'>{{__('main.button_url')}}</label><input class='form-control @error('button_url') is-invalid' @enderror type='text' name='R[4][button_url]' id='button_url'>";
          $("#r1button").html(r1button);
          $("#r2button").html(r2button);
          $("#r3button").html(r3button);
          $("#r4button").html(r4button);
        }
      });
    }).change();
    });
</script>
@elseif (count($homePageSettings) > 0)
<script>
  $(document).ready(function () {
  $('.dropify').dropify();
  $('#gallery_type').change(function () {
    $(this).find("option:selected").each(function () {
      var optionValue = $(this).attr('id');
      $.ajax({
        type: "GET",
        url: "{{route('admin.homePageSettingEdit')}}",
        success: function (response) {
          var r = 0;
        if (optionValue == 22){

        $("#r1button").html("");
        $("#r2button").html("");
        $("#r3button").html("");
        $("#r4button").html("");

        var grid_button_text = $.map(response, function (element) {
          return element["grid_button_text"];
        });
        var grid_button_url = $.map(response, function (element) {
          return element["grid_button_url"];
        });
        var grid_text = $.map(response, function (element) {
          return element["grid_text"];
        });
        var grid_description = $.map(response, function (element) {
          return element["grid_description"];
        });
        if (grid_text["0"] === undefined) {
          grid_text["0"] = "";
        }
        if (grid_text["1"] === undefined) {
          grid_text["1"] = "";
        }
        if (grid_description["0"] === undefined) {
          grid_description["0"] = "";
        }
        if (grid_button_text["0"] === undefined) {
          grid_button_text["0"] = "";
        }
        if (grid_button_url["0"] === undefined) {
          grid_button_url["0"] = "";
        }
        var gridText1 = "<label class='col-sm-2 col-form-label' for='grid_text'>{{__('main.grid_text_line_one')}}</label><div class='col-sm-10'><input class='form-control @error('grid_text') is-invalid @enderror' id='grid_text' type='text' name='grid_text[]' value=\""+grid_text["0"]+"\"></div>";

        var gridText2 = "<label class='col-sm-2 col-form-label' for='grid_text'>{{__('main.grid_text_line_two')}}</label><div class='col-sm-10'><input class='form-control @error('grid_text') is-invalid @enderror' id='grid_text' type='text' name='grid_text[]' value=\""+grid_text["1"]+"\"></div>";

        var gridDescription = "<label class='col-sm-2 col-form-label' for='gridDescription'>{{__('main.grid_description')}}</label><div class='col-sm-10'><textarea class='form-control @error('grid_text') is-invalid @enderror' name='grid_description' rows='1' cols='5' >"+grid_description["0"]+"</textarea></div>";

        var gridButtonText = "<label class='col-sm-2 col-form-label' for='grid_button_text'>{{__('main.grid_button_text')}}</label><div class='col-sm-10'><input class='form-control @error('grid_button_text') is-invalid @enderror' id='grid_button_text' type='text' name='grid_button_text' value=\""+grid_button_text["0"]+"\"></div>";

        var gridButtonUrl = "<label class='col-sm-2 col-form-label' for='title'>{{__('main.grid_button_url')}}</label><div class='col-sm-10'><input class='form-control @error('grid_button_url') is-invalid @enderror' id='grid_button_url' type='text' name='grid_button_url' value=\""+grid_button_url["0"]+"\"></div>";

        $('#gridText1').html(gridText1);
        $('#gridText2').html(gridText2);
        $('#gridDescription').html(gridDescription);
        $('#gridButtonText').html(gridButtonText);
        $('#gridButtonUrl').html(gridButtonUrl);
      } //if condition of grid

      if(optionValue == 23){
        $('#gridText1').html('');
        $('#gridText2').html('');
        $('#gridDescription').html('');
        $('#gridButtonText').html('');
        $('#gridButtonUrl').html('');
        response.forEach(element => {
          ++r;
          if (r < element.length) {
            r = 0;
          }
          if (element["button_url"] === null) {
            element["button_url"] = "";
          }
          var id = "#r"+r+"button";
          var value = "<label class='small mb-1' for='button_url'>{{__('main.button_url')}}</label><input class='form-control @error('button_url') is-invalid' @enderror type='text' name='R["+r+"][button_url]' id='button_url' value=\""+element["button_url"]+"\">"
          $(id).html(value);
          });
          } //if condition of slider
        } //ajax
        });
      });
    }).change();
  });
</script>
@endif
@endsection
