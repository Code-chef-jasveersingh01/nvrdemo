@extends('layouts.admin.layout')
@section('title')
    {{__('main.users')}}
@endsection
@section('css')
    <link href="{{ URL::asset('assets/libs/jsvectormap/jsvectormap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/libs/swiper/swiper.min.css') }}" rel="stylesheet" type="text/css" />
    <!--datatable css-->
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <!--datatable responsive css-->
    <link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href={{asset("assets/css/dropify.css")}}>
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') {{__('main.view')}} @endslot
@slot('title') {{__('main.roles')}} @endslot
@slot('link') {{route('admin.roleList')}} @endslot
@endcomponent
<div class="row">
    <div class="col-xxl-12">
        <div class="card shadow-sm">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h5 class="card-title flex-grow-1 mb-0">{{ __('main.role_detail') }}</h5>
                    @canany(['Edit Role', 'Delete Role'])
                    <div class="flex-shrink-0">
                        @can('Edit Role')
                        <a href="{{ route('admin.editRole', $role->id) }}" class="btn btn-primary btn-sm"><i class="ri-edit-2-line align-middle me-1"></i> {{ __('main.edit') }}</a>
                        @endcan
                    </div>
                    @endcan
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive border-bottom border-primary">
                    <table class="table table-borderless mb-0">
                        <tbody>
                            <tr>
                                <th class="ps-0" scope="row" style="width:10%;">{{ __('main.name') }}</th>
                                <td class="text-muted"><span class="badge badge-soft-primary fs-12">{{ $role->name }}</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="row mt-3">
                    @if (!empty($permission['allGroups']))
                        @foreach ($permission['allGroups'] as $key => $group)
                            @if (!empty($permission['allPermissionsLists']))
                                @php
                                    $allPermissionsLists = $permission['allPermissionsLists']
                                        ->filter(function ($item) use ($group) {
                                            if ($item->group == $group) {
                                                return $item;
                                            }
                                        })
                                        ->values();
                                @endphp
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <div class="form-group">
                                        <ul style="list-style-type: none;padding-inline-start: 15px;">
                                            <li>
                                                <h6><i class="mdi mdi-link-variant"></i><strong> {{ ucwords($group) }}</strong></h6>
                                                <ul style="list-style-type: none;padding-left: 20px;">
                                                    @foreach ($allPermissionsLists as $key => $allPermissionsList)
                                                        <li>
                                                            @if (in_array($allPermissionsList->id, $permission['rolePermissions']))
                                                                <i class="mdi mdi-check-bold text-success"></i>
                                                            @else
                                                                <i class="mdi mdi-close-thick text-danger"></i>
                                                            @endif
                                                            {{ $allPermissionsList->name }}
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@can('Delete Role')
<form id="deleteRecordForm" method="post">
    @csrf
</form>
@endcan
@endsection
@section('script')
<script>
@can('Delete Role')
function deleteRecord(element) {
    Swal.fire({
        title: "{{ __('message.are_you_sure') }}",
        text: "{{ __('message.you_will_not_be_able_to_recover_data') }}",
        showCancelButton: true,
        confirmButtonClass: 'btn btn-primary w-xs me-2 mb-1',
        cancelButtonClass: 'btn btn-danger w-xs mb-1',
        confirmButtonText: "{{ __('message.delete_it') }}",
        buttonsStyling: false,
    }).then((result) => {
        if (result.isConfirmed) {
            var href = $(element).attr('data-href');
            $("#deleteRecordForm").attr("action", href);
            $('#deleteRecordForm').submit();
        }
    })
}
@endcan
</script>
@endsection
