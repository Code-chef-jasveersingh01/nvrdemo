@extends('layouts.admin.layout')
@section('title')
{{__('main.list_type_detail')}}
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                {{__('main.list_type_detail')}}
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-borderless mb-0">
                        <tbody>
                            <tr>
                                <td class="font-bold-600" style="width: 25%;">{{__('main.title')}}</td>
                                <td> {{$variationTypes->name}} </td>
                            </tr>
                            <tr>
                                <td class="font-bold-600" style="width: 25%;">{{__('main.active')}}</td>
                                <td>
                                    @if ($variationTypes->is_active)
                                        <div class="badge bg-success text-white rounded-pill">{{__('main.active')}}</div>
                                    @else
                                        <div class="badge bg-danger text-white rounded-pill">{{__('main.de-active')}}</div>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header d-flex align-items-center">
                <h5 class="card-title mb-0 flex-grow-1">{{__('main.list_items')}}</h5>
                <div class="">

                </div>
                <button class="btn btn-sm btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#createLockupModal"><i class="fas fa-plus fa-sm text-white-50"></i> {{__('main.add_item')}}</button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="listItem">
                        <thead>
                            <tr>
                                <th style="text-center">{{__('main.id')}}</th>
                                <th style="width: 50%">{{__('main.name')}}</th>
                                <th class="text-center" style="width: 25%">{{__('main.is_active')}}</th>
                                <th class="text-center" style="width: 25%">{{__('main.action')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($variationTypes->variation) && count($variationTypes->variation))
                                @foreach ($variationTypes->variation as $key=>$variation)
                                    <tr class="hover-primary">
                                        <td>{{$variation->id}}</td>
                                        <td>{{$variation->name}}</td>
                                        <td class="text-center">
                                            @if ($variation->is_active)
                                                <div class="badge bg-success text-white rounded-pill">{{__('main.active')}}</div>
                                            @else
                                                <div class="badge bg-danger text-white rounded-pill">{{__('main.de-active')}}</div>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a class="text-primary d-inline-block edit-btn" href="javascript:void(0);" data-href="{{route('admin.updateVariationItem', $variation->id)}}" data-is-active="{{$variation->is_active}}" data-variation-type-id="{{$variation->variation_type_id}}" data-name="{{$variation->name}}" data-other="{{$variation->other}}"><i class="ri-eye-fill fs-16"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<x-modal>
    <x-slot name="id">createLockupModal</x-slot>
    <x-slot name="modalTitle">{{__('main.add_item')}}</x-slot>
    <x-slot name="modalFormBody">
        <div class="modal-body">
            <form class="form" method="POST" action="{{route('admin.storeVariationItem')}}" id="createItem">
                @csrf
                <input type="hidden" name="variation_type_id" value="{{$variationTypes->id}}">
                <div class="box-body">
                    <div class="form-group">
                        <label class="small mb-1">{{__('main.name')}}
                        </label>
                        <div class="input-group mb-3">
                            <input type="text" name="name" class="form-control" placeholder="{{__('main.name')}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="small mb-1">{{__('main.other')}} <span class="form-text-ext text-muted"><code>{{__('main.optional')}}</code></span></label>
                        <div class="input-group mb-3">
                            <input type="text" name="other" class="form-control" placeholder="{{__('main.other')}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="is_active" id="md_checkbox_21" class="filled-in chk-col-primary" checked="">
                        <label for="md_checkbox_21">{{__('main.is_active')}}</label>
                    </div>
                </div>
            </form>
        </div>
    </x-slot>
    <x-slot name="modalFormFooter">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">{{__('main.close')}}</button>
        <button type="submit" class="btn btn-primary float-end" form="createItem">{{__('main.save')}}</button>
    </x-slot>
</x-modal>
<x-modal>
    <x-slot name="id">editLockupModal</x-slot>
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
                    <label  class="small mb-1">{{__('main.other')}} <span class="form-text-ext text-muted"><code>({{__('main.optional')}})</code></span></i></label>
                    <div class="input-group mb-3">
                        <input type="text" name="edit_other" id="edit_other" class="form-control" placeholder="{{__('main.other')}}">
                    </div>
                </div>
                <div class="form-group">
                    <input type="checkbox" name="edit_is_active" id="edit_is_active" class="filled-in chk-col-primary">
                    <label for="edit_is_active">{{__('main.is_active')}}</label>
                </div>
            </div>
        </form>
    </x-slot>
    <x-slot name="modalFormFooter">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">{{__('main.close')}}</button>
        <button type="submit" class="btn btn-primary" form="lockupEdit">{{__('main.update')}}</button>
    </x-slot>
</x-modal>
{{-- <form action="" id="deleteLockupForm" method="post">
    @csrf
</form> --}}
@endsection
@section('script')
@include('layouts.admin.scripts.Datatables_scripts')
<script>
$(document).ready(function () {
    $('#listItem').DataTable({
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

    $(".edit-btn").click(function (e) {
        e.preventDefault();
        var href            = $(this).attr('data-href');
        var lockupTypeId    = $(this).attr('data-lockup-type-id');
        var isActive        = $(this).attr('data-is-active');
        var name            = $(this).attr('data-name');
        var other_data      = $(this).attr('data-other');

        $("#lockupEdit").attr("action", href);
        $("#edit_lockup_type_id").val(lockupTypeId);
        $("#edit_name").val(name);
        $("#edit_other").val(other_data);

        if(isActive==1){
            $('#edit_is_active').prop('checked', true);
        }
        $('#editLockupModal').modal('show');
    });

    // $(".delete-item").click(function (e) {
    //     e.preventDefault();
    //     var href = $(this).attr('data-lockup-href');
    //     swal({
    //         title: "{{__('message.are_you_sure')}}",
    //         text: "{{__('message.you_will_not_be_able_to_recover_data')}}",
    //         type: "warning",
    //         showCancelButton: true,
    //         confirmButtonColor: "#3246D3",
    //         confirmButtonText: "{{__('message.delete_it')}}",
    //         closeOnConfirm: false
    //     }, function(){
    //         $("#deleteLockupForm").attr("action", href);
    //         $('#deleteLockupForm').submit();
    //     });
    // });
});
</script>

@endsection
