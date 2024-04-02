@extends('layouts.admin.layout')
@section('title')
{{__('main.create_attribute_set')}}
@endsection
@section('content')
<div class="content-header">
    <div class="d-flex align-items-center">
        <div class="me-auto">
            <h4 class="page-title">{{__('main.attribute_set')}}</h4>
            <div class="d-inline-block align-items-center">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin.attributeSetList')}}"><i class="mdi mdi-home-outline"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{__('main.create')}}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{__('main.attribute_set')}}</h6>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('admin.storeAttributeSet')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="name">{{__('main.name')}}</label>
                                <input class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" type="text" placeholder="{{__('main.Enter Attribute Set Name')}}" required autofocus>
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="based_on">{{__('main.based_on')}}</label>
                                <select class="form-control" name="based_on" id="based_on">
                                    @foreach ($basedOn as $basedon)
                                    <option value="{{$basedon->id}}" id="{{$basedon->name}}">{{$basedon->name}}</option>
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
                        </div>
                        <div class="row gx-3 mb-3"></div>
                        <a class="btn btn-secondary mr-2" href="{{route('admin.attributeSetList')}}">{{__('main.cancel')}}</a>
                        <button class="btn btn-primary" type="submit">{{__('main.save')}}</button>
                    </form>
                </div>
            </div>
        </div>
</section>
@endsection
