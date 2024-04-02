@extends('layouts.admin.layout')
@section('title')
  {{__('main.menu_page')}}
@endsection
@section('content')
<div class="content-header">
  <div class="d-flex align-items-center">
      <div class="me-auto">
          <h4 class="page-title">{{ __('main.menu_page') }}</h4>
          <div class="d-inline-block align-items-center">
              <nav>
                  <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{ route('admin.menuPageList') }}"><i
                                  class="mdi mdi-home-outline"></i></a></li>
                      <li class="breadcrumb-item active" aria-current="page">{{ __('main.menu_page_setting') }}</li>
                  </ol>
              </nav>
          </div>
      </div>
  </div>
</div>
@if (count($menuList) == 0)
  <section class="content">
    <div class="row">
        <div class="col-12">
            <div class="box box-bordered border-primary">
                <div class="box-header with-border">
                    <h4 class="box-title text-primary"><strong>{{ __('main.menu') }}</strong></h4>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                          <form method="POST" action="{{route('admin.menuStore')}}" enctype="multipart/form-data">
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
                                          <label class="small mb-1" for="image_alt_text">{{__('main.image_alt')}}
                                            <code>({{ __('main.required') }})</code></label>
                                          <input class="form-control @error('image_alt_text') is-invalid @enderror" id="text" type="text" name="R[1][image_alt_text]" required>
                                        </div>
                                      </div>
                                      <div class="mt-2" id="remove_option">
                                        <button class="btn btn-danger remove" id="remove_section" type="button">{{__('main.remove')}}</button>
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
  </section>
  @endsection
  @section('javascript')
  <script>
    $(document).ready(function(){
      $('.dropify').dropify();

      var rowIdx = 1;
      $('#add_new_option_button').on('click', function () {
        $('#add_more').append(`<tr id="R${++rowIdx}"><td><div class="row">
                            <div class="col-md-6">
                            <label class="small mb-1" for="image">{{ __('main.upload_image') }}
                              <code>({{ __('main.required') }})</code></label>
                            <input class="dropify" id="formFile" name="R[${rowIdx}][image]" type="file" accept="image/png, image/jpeg, image/jpg" required>
                          </div>
                          <div class="col-md-6">
                            <label class="small mb-1" for="image_alt_text">{{__('main.image_alt')}}
                              <code>({{ __('main.required') }})</code></label>
                            <input class="form-control @error('image_alt_text') is-invalid @enderror" id="text" type="text" name="R[${rowIdx}][image_alt_text]" required>
                          </div>
                          <div class="mt-2" id="remove_option">
                            <button class="btn btn-danger remove" id="remove_section" type="button">{{__('main.remove')}}</button>
                          </div>
                          </td></tr>`);
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
  @endsection

@elseif (count($menuList) > 0)
  <section class="content">
    <div class="row">
        <div class="col-12">
            <div class="box box-bordered border-primary">
                <div class="box-header with-border">
                    <h4 class="box-title text-primary"><strong>{{ __('main.menu') }}</strong></h4>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                          <form method="POST" action="{{route('admin.menuStore')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="table-responsive rounded card-table" >
                              <table class="table border-no">
                                <thead>
                                </thead>
                                <tbody id="add_more">
                                  @foreach ($menuList as $item)
                                  <tr data-id="{{$item['id']}}" id="R{{$item['id']}}">
                                    <td>
                                      <div class="row">
                                        <div data-id="1" class="col-md-6">
                                          <label class="small mb-1" for="image">{{ __('main.upload_image') }}
                                            <code>({{ __('main.required') }})</code></label>
                                          <input class="dropify" id="formFile" name="R[{{$item['id']}}][image]" data-default-file='{{ asset(config('image.menuList_image_path_view').$item['media']['name']) }}' type="file" accept="image/png, image/jpeg, image/jpg" >
                                        </div>
                                        <div class="col-md-6">
                                          <label class="small mb-1" for="image_alt_text">{{__('main.image_alt')}}
                                            <code>({{ __('main.required') }})</code></label>
                                          <input class="form-control @error('image_alt_text') is-invalid @enderror" id="text" type="text" name="R[{{$item['id']}}][image_alt_text]" value="{{$item['img_alt']}}" required>
                                        </div>
                                      </div>
                                      <div class="mt-2" id="remove_option">
                                        <button class="btn btn-danger remove" id="remove_section" type="button">{{__('main.remove')}}</button>
                                      </div>
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
  </section>
  @endsection
  @section('javascript')
  <script>
    $(document).ready(function(){
      $('.dropify').dropify();

      var rowIdx = {{count($menuList)}};
      $('#add_new_option_button').on('click', function () {
        $('#add_more').append(`<tr id="R${++rowIdx}"><td><div class="row">
                            <div class="col-md-6">
                            <label class="small mb-1" for="image">{{ __('main.upload_image') }}
                              <code>({{ __('main.required') }})</code></label>
                            <input class="dropify" id="formFile" name="R[${rowIdx}][image]" type="file" accept="image/png, image/jpeg, image/jpg" required>
                          </div>
                          <div class="col-md-6">
                            <label class="small mb-1" for="image_alt_text">{{__('main.image_alt')}}
                              <code>({{ __('main.required') }})</code></label>
                            <input class="form-control @error('image_alt_text') is-invalid @enderror" id="text" type="text" name="R[${rowIdx}][image_alt_text]" required>
                          </div>
                          <div class="mt-2" id="remove_option">
                            <button class="btn btn-danger remove" id="remove_section" type="button">{{__('main.remove')}}</button>
                          </div>
                          </td></tr>`);
              $('.dropify').dropify();
                      });
        $("#add_more").on('click', '.remove', function () {
        var child = $(this).closest('tr').nextAll();
        var childId = $(this).closest('tr').data('id')
        if (childId === undefined){
          child.each(function () {
          var id = $(this).attr('id');
          var idx = $(this).children('.row-index').children('p');
          var dig = parseInt(id.substring(1));
          $(this).attr('id', `R${dig - 1}`);
          });
          $(this).closest('tr').remove();
          rowIdx--;
        }else{
          $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
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
                        "id": childId,
                    }
                    $.ajax({
                        type: "DELETE",
                        url: "{{route('admin.menuItemDestroy')}}",
                        data: data,
                        success: function(response) {
                            swal(response.status, {
                                    icon: "success",
                                    timer: 3000,
                                })
                                .then((result) => {
                                    window.location =
                                        '{{ route('admin.menuPageList') }}'
                                });
                        }
                    });
                }
            });
        }
      });
    })
  </script>
  @endsection

@endif
