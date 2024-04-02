@extends('layouts.admin.layout')
@section('title')
{{__('main.list_types')}}
@endsection
@section('content')
<div class="card shadow mb-4">
    <div class="card-header d-flex align-items-center">
            <h5 class="card-title mb-0 flex-grow-1">{{__('main.list_types')}}</h5>
        <div>
            <button class="btn btn-sm btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#createLockupModal"><i class="fas fa-plus fa-sm text-white-50"></i> {{__('main.add_item')}}</button>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover" width="100%" cellspacing="0" id="listTypes">
                <thead class="">
                    <tr>
                        <th style="text-center">{{__('main.id')}}</th>
                        <th style="width: 50%">{{__('main.title')}}</th>
                        <th class="text-center" style="width: 25%">{{__('main.is_active')}}</th>
                        <th class="text-center" style="width: 25%">{{__('main.action')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($variationTypes as $key=>$variationType)
                        <tr class="hover-primary">
                            <td>
                                <a class="dropdown-item" href="{{route('admin.showVariationType', $variationType->id)}}">
                                    {{$variationType->id}}
                                </a>
                            </td>
                            <td>
                                <a class="dropdown-item" href="{{route('admin.showVariationType', $variationType->id)}}">
                                    {{$variationType->name}}
                                </a>
                            </td>
                            <td class="text-center">
                                @if ($variationType->is_active)
                                    <a class="dropdown-item" href="{{route('admin.showVariationType', $variationType->id)}}">
                                        <div class="badge bg-success text-white rounded-pill">{{__('main.active')}}</div>
                                    </a>
                                @else
                                    <a class="dropdown-item" href="{{route('admin.showVariationType', $variationType->id)}}">
                                        <div class="badge bg-danger text-white rounded-pill">{{__('main.in_active')}}</div>
                                    </a>
                                @endif
                            </td>
                            <td class="text-center">
                                <a class="text-primary d-inline-block" href="{{route('admin.showVariationType', $variationType->id)}}"><i class="ri-eye-fill fs-16"></i></a>
                                <a class="text-primary d-inline-block" id="edit-btn" href="javascript:void(0);" data-href="{{route('admin.updateVariationType', $variationType->id)}}" data-is-active="{{$variationType->is_active}}" data-is-system="{{$variationType->is_system}}" data-name="{{$variationType->name}}"><i class="ri-pencil-fill fs-16"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<x-modal>
    <x-slot name="id">createLockupModal</x-slot>
    <x-slot name="modalSize">modal-m</x-slot>
    <x-slot name="modalTitle">{{__('main.add_item')}}</x-slot>
    <x-slot name="modalFormBody">
        <form class="form" method="POST" action="{{route('admin.storeVariationType')}}" id="createItem">
            @csrf
            <div class="box-body">
                <div class="form-group">
                    <label class="small mb-1">{{__('main.name')}}
                    </label>
                    <div class="input-group mb-3">
                        <input type="text" name="name" class="form-control" placeholder="{{__('main.name')}}" required>
                    </div>
                </div>
                <div class="row form-group form-switch form-check-right">
                    <div class="col-12 mb-3">
                        <input type="checkbox" name="is_active" role="switch" id="md_checkbox_21" class="form-check-input mx-1" checked="">
                        <label for="md_checkbox_21">{{__('main.is_active')}}</label>
                    </div>
                    <div class="col-12">
                        <input type="checkbox" name="is_system" role="switch" id="md_checkbox_21" class="form-check-input mx-1" checked="">
                        <label for="md_checkbox_21">{{__('main.is_system')}}</label>
                    </div>
                </div>
            </div>
        </form>
    </x-slot>
    <x-slot name="modalFormFooter">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">{{__('main.close')}}</button>
        <button type="submit" class="btn btn-primary float-end" form="createItem">{{__('main.save')}}</button>
    </x-slot>
</x-modal>
<x-modal>
    <x-slot name="id">editLockupModal</x-slot>
    <x-slot name="modalSize">modal-m</x-slot>
    <x-slot name="modalTitle">{{__('main.update_item')}}</x-slot>
    <x-slot name="modalFormBody">
        <form class="form" method="POST" action="" id="lockupEdit">
            @csrf
            <div class="box-body">
                <div class="form-group">
                    <label  class="small mb-1">{{__('main.name')}} </label>
                    <div class="input-group mb-3">
                        <input type="text" name="edit_name" id="edit_name" class="form-control" placeholder="{{__('main.name')}}" required>
                    </div>
                </div>
                <div class="form-group">
                    <input type="checkbox" name="edit_is_active" id="edit_is_active" class="filled-in chk-col-primary">
                    <label for="edit_is_active">{{__('main.is_active')}}</label>
                </div>
                <div class="form-group">
                    <input type="checkbox" name="edit_is_system" id="edit_is_system" class="filled-in chk-col-primary">
                    <label for="edit_is_system">{{__('main.is_system')}}</label>
                </div>
            </div>
        </form>
    </x-slot>
    <x-slot name="modalFormFooter">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">{{__('main.close')}}</button>
        <button type="submit" class="btn btn-primary" form="lockupEdit">{{__('main.update')}}</button>
    </x-slot>
</x-modal>
@endsection
@section('script')
@include('layouts.admin.scripts.Datatables_scripts')
<script>
    $(document).ready(function () {
        $('#listTypes').DataTable({
            'paging'        : true,
            'lengthChange'  : false,
            'searching'     : false,
            'ordering'      : true,
            'info'          : true,
            'autoWidth'     : false,
            "processing"    : false,
            "serverSide"    : false,
            language: {
                            url: '@if (session()->get('locale') == 'ar') {{asset('js/Arabic.json')}} @elseif(session()->get('locale') == 'fr') {{asset('js/French.json')}} @endif'
                        }
        });
    });

    $('body').on("click", "#edit-btn",function (e) {
        e.preventDefault();
        var href            = $(this).attr('data-href');
        var isActive        = $(this).attr('data-is-active');
        var isSystem        = $(this).attr('data-is-system');
        var name            = $(this).attr('data-name');

        $("#lockupEdit").attr("action", href);
        $("#edit_name").val(name);

        if(isActive==1){
            $('#edit_is_active').prop('checked', true);
        }
        if(isSystem==1){
            $('#edit_is_system').prop('checked', true);
        }
        $('#editLockupModal').modal('show');
    });
</script>
@endsection
