@extends('layouts.admin.layout')
@section('title')
    {{ __('main.view_attribute_set') }}
@endsection
@section('content')
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="me-auto">
                <h4 class="page-title">{{ __('main.attribute_set') }}</h4>
                <div class="d-inline-block align-items-center">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.attributeSetList') }}"><i
                                        class="mdi mdi-home-outline"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('main.view') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="box box-bordered border-primary">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                    <label for="formFile" class="form-label" for="name"><strong>{{ __('main.name') }}
                                            : {{ $viewDetails->name }}
                                        </strong></label>
                                    <span
                                        class="badge badge-pill badge-{{ $viewDetails->is_active == 1 ? 'primary' : 'danger' }}">
                                        @if ($viewDetails->is_active)
                                            {{ __('main.active') }}
                                        @else
                                            {{ __('main.in_active') }}
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="box box-bordered border-primary">
                    <div class="box-body">
                        <div class="row">
                            <form class="form-wrapper" method="POST"
                                action="{{ route('admin.updateAttributeSet', ['id' => $viewDetails->id]) }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    @foreach ($labeles_data as $label_data)

                                        <div class="form-input">
                                            <input type="checkbox" class="filled-in chk-col-primary"
                                                name="attribute_id[{{ $label_data->id }}]"
                                                id="{{ $label_data->label_name }}" value="{{ $label_data->id }}"
                                                @foreach ($viewDetails->attribute as $attribute) @if ($attribute->id == $label_data->id)  checked="" @endif
                                                @endforeach >
                                            <label
                                                for="{{ $label_data->label_name }}">{{ $label_data->label_name }}</label>
                                        </div>
                                    @endforeach
                                    <div class="col-12">
                                        <button class="btn btn-primary" type="submit">{{ __('main.save') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
