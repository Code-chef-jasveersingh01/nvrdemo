@extends('layouts.admin.layout')
@section('title')
{{ __('main.create_paraent_pacakage')}}
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') {{__('main.create')}} @endslot
@slot('title') {{__('main.all_parent_packages')}} @endslot
@slot('link') {{route('admin.parentPackageList')}} @endslot
@endcomponent
<section class="content">
    <div class="card shadow mb-4">
      <div class="card-body">
        <form method="POST" action="{{ route('admin.storeParentPackage') }}" enctype="multipart/form-data">
          @csrf
        <div class="row gx-3 mb-3">
            <div class="col-md-6">
                <x-create_lang_input>
                    <x-slot name="field_lable">{{__('main.name')}} <code>({{__('main.required')}})</code></x-slot>
                    <x-slot name="field_name">name</x-slot>
                    <x-slot name="field_placeholder">{{__('main.Enter Package Name')}}</x-slot>
                </x-create_lang_input>
                {{-- <label class="form-label" for="name">{{__('main.name')}}</label>
                <input class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" type="text" placeholder="{{__('main.Enter Package Name')}}" required autofocus> --}}
            </div>
        </div>
        <div class="row gx-3 mb-3">
            <div class="col-md-6">
                <label class="form-label" for="image">{{__('main.upload_image')}} <code>({{__('main.required')}})</code></label>
                <input class="dropify" id="formFile" name="image" type="file" accept="image/png, image/jpeg, image/jpg"/>
            </div>
        </div>
        <div class="row gx-3 mb-3">
            <div class="col-md-6">
            <br>
            <input type="checkbox" class="filled-in chk-col-primary" id="is_active" name="is_active" checked />
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
