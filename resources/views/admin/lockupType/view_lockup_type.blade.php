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
                                <td> {{$lockupType->name}} </td>
                            </tr>
                            <tr>
                                <td class="font-bold-600" style="width: 25%;">{{__('main.active')}}</td>
                                <td>
                                    @if ($lockupType->is_active)
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
                            @if (isset($lockupType->lockup) && count($lockupType->lockup))
                                @foreach ($lockupType->lockup as $key=>$lockup)
                                    <tr class="hover-primary">
                                        <td>{{$lockup->id}}</td>
                                        <td>{{$lockup->name}}</td>
                                        <td class="text-center">
                                            @if ($lockup->is_active)
                                                <div class="badge bg-success text-white rounded-pill">{{__('main.active')}}</div>
                                            @else
                                                <div class="badge bg-danger text-white rounded-pill">{{__('main.de-active')}}</div>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a class="text-primary d-inline-block edit-btn" href="javascript:void(0);" data-href="{{route('admin.updateListItem', $lockup->id)}}" data-is-active="{{$lockup->is_active}}" data-lockup-type-id="{{$lockup->lockup_type_id}}" data-name="{{$lockup->name}}" data-other="{{$lockup->other}}"><i class="ri-eye-fill fs-16"></i></a>
                                            {{-- <a class="btn btn-datatable btn-icon btn-transparent-dark delete-item" href="javascript:void(0);" data-lockup-href="{{route('admin.destroyListItem', $lockup->id)}}"><i class="far fa-trash-alt"></i></a> --}}
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
@include('admin.component.modal.lockupType.create_lockup_modal')
@include('admin.component.modal.lockupType.edit_lockup_modal')
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
