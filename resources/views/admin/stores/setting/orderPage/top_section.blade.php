@extends('layouts.admin.layout')
@section('title')
  {{__('main.order_now_page_setting')}}
@endsection
@section('content')
<div class="content-header">
  <div class="d-flex align-items-center">
      <div class="me-auto">
          <h4 class="page-title">{{ __('main.setting') }}</h4>
          <div class="d-inline-block align-items-center">
              <nav>
                  <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{ route('admin.orderNowTopSectionIndex') }}"><i
                                  class="mdi mdi-home-outline"></i></a></li>
                      <li class="breadcrumb-item active" aria-current="page">{{ __('main.order_now_page_setting') }}</li>
                  </ol>
              </nav>
          </div>
      </div>
  </div>
</div>
<section class="content">
  <div class="col-12">
      <ul class="nav nav-tabs customtab2" role="tablist">
        <li class="nav-item"> <a class="nav-link active" href="{{route('admin.orderNowTopSectionIndex')}}"><span class="hidden-sm-up"><i class="ion-laptop"></i></span> <span class="hidden-xs-down">{{__('main.top_section')}}</span></a> </li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane active" id="top_section" role="tabpanel">
          @if (count($menuPageTopSectionDetails) == 0)
          <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="box box-bordered border-primary">
                        <div class="box-header with-border">
                            <h4 class="box-title text-primary"><strong>{{ __('main.order_now_page_setting') }}</strong></h4>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                  <form method="POST" action="{{route('admin.orderNowTopSectionStore')}}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="table-responsive rounded card-table" >
                                      <table class="table border-no">
                                        <thead>
                                        </thead>
                                        <tbody id="add_more">
                                          <tr id="R1">
                                            <td>
                                              <div class="row">
                                                <div class="col-md-6">
                                                  <label class="small mb-1" for="image">{{ __('main.upload_image') }}
                                                    <code>({{ __('main.required') }})</code></label>
                                                    <input class="dropify" id="formFile" name="R[1][image]" type="file" accept="image/png, image/jpeg, image/jpg" required>
                                                </div>
                                                <div class="col-md-6">
                                                  <label class="small mb-1" for="title">{{__('main.image_title')}}</label>
                                                  <input class="form-control @error('title') is-invalid @enderror" id="text" type="text" name="R[1][title]" >

                                                  <label class="small mb-1" for="image_alt_text">{{__('main.image_alt')}}</label>
                                                  <input class="form-control @error('image_alt_text') is-invalid @enderror" id="text" type="text" name="R[1][image_alt_text]" required>

                                                  <label class="small mb-1" for="description">{{__('main.image_description')}}</label>
                                                  <textarea class="form-control" name="R[1][description]" rows="1" cols="5" ></textarea>

                                                  <label class='small mb-1' for='button_url'>{{__('main.button_url')}}</label>
                                                  <input class='form-control @error('button_url') is-invalid' @enderror type='text' name='R[1][button_url]' id='button_url'>

                                                </div>
                                              </div>
                                            </td>
                                          </tr>
                                        </tbody>
                                        <tfoot>
                                          <tr>
                                            <th colspan="5" class="">
                                              <button id="add_new_option_button" data-action="add_new_row" title="Add Option" type="button" class="btn btn-primary">
                                                <span>{{__('main.add_one_more')}}</span>
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
          @elseif (count($menuPageTopSectionDetails) > 0)
          <div id="sections" data-id="{{count($menuPageTopSectionDetails)}}"></div>
          <section class="content">
            <div class="row">
              <div class="col-12">
                  <div class="box box-bordered border-primary">
                      <div class="box-header with-border">
                          <h4 class="box-title text-primary"><strong>{{ __('main.top_section_slider') }}</strong></h4>
                      </div>
                      <div class="box-body">
                          <div class="row">
                              <div class="col-xs-12 col-sm-12 col-md-12">
                                <form method="POST" action="{{route('admin.orderNowTopSectionStore')}}" enctype="multipart/form-data">
                                  @csrf
                                  <div class="table-responsive rounded card-table" >
                                    <table class="table border-no">
                                      <thead>
                                      </thead>
                                      <tbody id="add_more">
                                        @foreach ($menuPageTopSectionDetails as $menuPageTopSectionDetail)
                                        <tr id="R{{$menuPageTopSectionDetail->id}}">
                                          <td>
                                            <div class="row">
                                              <div class="col-md-6">
                                                <label class="small mb-1" for="image">{{ __('main.upload_image') }}
                                                  <code>({{ __('main.required') }})</code></label>
                                                  <input class="dropify" id="formFile" name="R[{{$menuPageTopSectionDetail->id}}][image]" data-default-file='{{ asset(config('image.menuPage_image_path_view'). $menuPageTopSectionDetail->media->name) }}' type="file" accept="image/png, image/jpeg, image/jpg">
                                              </div>
                                              <div class="col-md-6">
                                                <label class="small mb-1" for="title">{{__('main.image_title')}}</label>
                                                <input class="form-control @error('title') is-invalid @enderror" id="text" type="text" name="R[{{$menuPageTopSectionDetail->id}}][title]" value="{{$menuPageTopSectionDetail->title}}">

                                                <label class="small mb-1" for="image_alt_text">{{__('main.image_alt')}}</label>
                                                <input class="form-control @error('image_alt_text') is-invalid @enderror" id="text" type="text" name="R[{{$menuPageTopSectionDetail->id}}][image_alt_text]" value="{{$menuPageTopSectionDetail->image_alt_text}}" required>

                                                <label class="small mb-1" for="description">{{__('main.image_description')}}</label>
                                                <textarea class="form-control" name="R[{{$menuPageTopSectionDetail->id}}][description]" rows="1" cols="5" >@if ($menuPageTopSectionDetail->description != null) {{$menuPageTopSectionDetail->description}}@endif</textarea>

                                                <label class='small mb-1' for='button_url'>{{__('main.button_url')}}</label>
                                                <input class='form-control @error('button_url') is-invalid' @enderror type='text' name='R[{{$menuPageTopSectionDetail->id}}][button_url]' id='button_url' value="{{$menuPageTopSectionDetail->url}}">

                                              </div>
                                            </div>
                                            <button class="btn btn-danger remove" id="remove_section" data-id="{{ $menuPageTopSectionDetail->id }}" type="button" @if ($menuPageTopSectionDetail->id == '1') disabled @endif >{{__('main.remove')}}</button>
                                          </td>
                                        </tr>
                                        @endforeach
                                      </tbody>
                                      <tfoot>
                                        <tr>
                                          <th colspan="5" class="">
                                            <button id="add_new_option_button" data-action="add_new_row" title="Add Option" type="button" class="btn btn-primary">
                                              <span>{{__('main.add_one_more')}}</span>
                                            </button>
                                          </th>
                                        </tr>
                                      </tfoot>
                                    </table>
                                  </div>
                                    <a class="btn btn-secondary mr-2" href="{{url()->previous()}}">{{__('main.cancel')}}</a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="ti-save-alt"></i>{{ __('main.save_changes') }}
                                    </button>
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
  </div>
</section>
@endsection
@section('javascript')
@if (count($menuPageTopSectionDetails) == 0)
<script>
  $(document).ready(function(){
      $('.dropify').dropify();

      var rowIdx = 1;
      $('#add_new_option_button').on('click', function () {
        $('#add_more').append(`<tr id="R${++rowIdx}"><td><div class="row">
                          <div class="col-md-6" >
                          <label class="small mb-1" for="image">{{ __('main.upload_image') }}
                            <code>({{ __('main.required') }})</code></label>
                          <input class="dropify" id="formFile" name="R[${rowIdx}][image]" type="file" accept="image/png, image/jpeg, image/jpg" required>
                        </div>
                        <div class="col-md-6">
                          <label class="small mb-1" for="title">{{__('main.image_title')}}</label>
                          <input class="form-control @error('title') is-invalid @enderror" id="text" type="text" name="R[${rowIdx}][title]" >

                          <label class="small mb-1" for="image_alt_text">{{__('main.image_alt')}}</label>
                          <input class="form-control @error('image_alt_text') is-invalid @enderror" id="text" type="text" name="R[${rowIdx}][image_alt_text]" required>

                          <label class="small mb-1" for="description">{{__('main.image_description')}}</label>
                          <textarea class="form-control" name="R[${rowIdx}][description]" rows="1" cols="5" ></textarea>

                          <label class='small mb-1' for='button_url'>{{__('main.button_url')}}</label>
                          <input class='form-control @error('button_url') is-invalid' @enderror type='text' name='R[${rowIdx}][button_url]' id='button_url'>
                        </div>
                        <div id="remove_option">
                          <button class="btn btn-danger remove" id="remove_section" type="button">{{__('main.remove')}}</button>
                        </div>
                        </div></td></tr>`);
              $('.dropify').dropify();
                      });
        $("#add_more").on('click', '.remove', function () {
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
  })
</script>
@elseif (count($menuPageTopSectionDetails) > 0)
<script>
  $(document).ready(function(){
      $('.dropify').dropify();
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

      var rowIdx = $('#sections').data('id');
      $('#add_new_option_button').on('click', function () {
        $('#add_more').append(`<tr id="R${++rowIdx}"><td><div class="row">
                          <div class="col-md-6" >
                          <label class="small mb-1" for="image">{{ __('main.upload_image') }}
                            <code>({{ __('main.required') }})</code></label>
                          <input class="dropify" id="formFile" name="R[${rowIdx}][image]" type="file" accept="image/png, image/jpeg, image/jpg" >
                        </div>
                        <div class="col-md-6">
                          <label class="small mb-1" for="title">{{__('main.image_title')}}</label>
                          <input class="form-control @error('title') is-invalid @enderror" id="text" type="text" name="R[${rowIdx}][title]" >

                          <label class="small mb-1" for="image_alt_text">{{__('main.image_alt')}}</label>
                          <input class="form-control @error('image_alt_text') is-invalid @enderror" id="text" type="text" name="R[${rowIdx}][image_alt_text]" >

                          <label class="small mb-1" for="description">{{__('main.image_description')}}</label>
                          <textarea class="form-control" name="R[${rowIdx}][description]" rows="1" cols="5" ></textarea>

                          <label class='small mb-1' for='button_url'>{{__('main.button_url')}}</label>
                          <input class='form-control @error('button_url') is-invalid' @enderror type='text' name='R[${rowIdx}][button_url]' id='button_url'>
                        </div>
                        <div id="remove_option">
                          <button class="btn btn-danger remove" id="remove_section" type="button">{{__('main.remove')}}</button>
                        </div>
                        </div></td></tr>`);
              $('.dropify').dropify();
                      });
        $("#add_more").on('click', '.remove', function (e) {
          e.preventDefault();

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
  })
</script>
@endif
@endsection
