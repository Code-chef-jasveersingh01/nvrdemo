@extends('layouts.admin.layout')
@section('title')
{{ __('main.edit_paraent_pacakage')}}
@endsection
@section('css')
    <link rel="stylesheet" href={{asset("assets/css/dropify.css")}}>
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') {{__('main.edit')}} @endslot
@slot('title') {{__('main.packages')}} @endslot
@slot('link') {{route('admin.packageList')}} @endslot
@endcomponent
<section class="content">
  <div id="loading"></div>
  <div id="full-body">
    <div class="card shadow mb-4">
      <div class="card-body">
        <form method="POST" action="{{ route('admin.updateParentPackage',['id' => $packageDetails->id]) }}" enctype="multipart/form-data">
          @csrf
        <div class="row gx-3 mb-3">
            <div class="col-md-6">
                @include('components.edit_lang_input',['inputType'=>'vertical',
                'label_class'=>'form-label',
                'input_class'=>"form-control @error('name') is-invalid @enderror",
                'field_lable'=> __('main.name'),
                'en_required'=>'1',
                'ar_required'=>'1',
                'field_placeholder'=>__('main.Enter Package Name'),
                'field_name'=>'name',
                'value'=>'parent_package_name',
                'data_obj'=>$packageDetails
                ])
                {{-- <label class="form-label" for="name">{{__('main.name')}}</label>
                <input class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ isset($packageDetails->parent_package_name) ? $packageDetails->parent_package_name : ""}}" type="text" placeholder="{{__('main.Enter Package Name')}}" required autofocus> --}}
            </div>
        </div>
        <div class="row gx-3 mb-3">
            <div class="col-md-6">
                <label class="form-label" for="image">{{__('main.upload_image')}} <code>({{__('main.required')}})</code></label>
                <input class="dropify" id="formFile" name="image" type="file" accept="image/png, image/jpeg, image/jpg" data-default-file='{{ asset(config('image.package_image_path_view').$packageDetails->media->thumbnail_name) }}'/>
            </div>
        </div>
        <div class="row gx-3 mb-3">
            <div class="col-md-6">
            <br>
            <input type="checkbox" class="filled-in chk-col-primary" id="is_active" name="is_active" @if($packageDetails->is_active === 1) checked @endif />
            <label class="small mb-1" for="is_active">{{__('main.is_active')}}</label>
            </div>
        </div>
        <div class="row gx-3 mb-3">
        <div class="col-6 mb-3">
            <a class="btn btn-secondary mr-2" href="{{url()->previous()}}">{{__('main.cancel')}}</a>
            <button class="btn btn-primary" type="submit">{{__('main.save_changes')}}</button>
        </div>
        </div>


        </form>
      </div>
    </div>
  </div>
</section>
@endsection
@section('script')
<script src="{{ URL::asset('assets/libs/prismjs/prismjs.min.js') }}"></script>
<script src={{asset("assets/js/pages/dropify.min.js")}}></script>
<script>
  $(document).ready(function () {
    $('.dropify').dropify();
  });
</script>
@endsection
