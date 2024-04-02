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
@slot('li_1') {{__('main.deleted_users')}} @endslot
@slot('title') {{__('main.users')}} @endslot
@slot('link') {{ route('admin.usersList')}} @endslot
@endcomponent
    <x-list_view>
        <x-slot name="card_heard"> {{__('main.deleted_users')}} </x-slot>
        {{-- <x-slot name="create_button_href"> {{route('admin.deletedUserInfo')}} </x-slot>
        <x-slot name="create_button_title"> {{__('main.deleted_users')}} </x-slot> --}}
        {{-- <x-slot name="search_label">
            <div class="row g-3">
                <div class="col-xxl-5 col-sm-6">
                    <div class="search-box">
                        <input type="text" name="filter_search_key" id="filter_search_key" class="form-control search" placeholder="{{__('main.search')}}">
                        <i class="ri-search-line search-icon"></i>
                    </div>
                </div>
                <!--end col-->
                <div class="col-xxl-2 col-sm-4">
                    <div class="form-group">
                        <select class="form-control" name="filter_status" id="filter_status">
                            <option value="all">{{__('main.all')}}</option>
                            <option value="1">{{__('main.active')}}</option>
                            <option value="0">{{__('main.in_active')}}</option>
                        </select>
                    </div>
                </div>
                <!--end col-->
                <div class="col-xxl-2 col-sm-4">
                        <div class="form-group">
                            <select class="form-control" name="filter_user_type" id="filter_user_type">
                                <option value="all">{{__('main.all')}}</option>
                                @if (count($userTypes))
                                    @foreach ($userTypes as $type)
                                        <option value="{{$type->id}}">{{$type->name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                </div>
                <!--end col-->
                <div class="col-xxl-3 col-sm-4">
                    <div class="d-flex">
                        <button type="button" id="search_filter" class="btn btn-primary w-100 mx-1" ><i class="ri-equalizer-fill me-1 align-bottom"></i> {{__('main.filter')}}</button>
                        <button type="button" id="reset_filter" class="btn btn-success w-100 mx-1"><i class="ri-refresh-line me-1 align-bottom"></i> {{__('main.reset')}}</button>
                    </div>
                </div>
                <!--end col-->
            </div>
        </x-slot> --}}
        <x-slot name="table_id"> deletedUsersTable </x-slot>
        <x-slot name="table_th">
            <th>{{ __('main.image') }}</th>
            <th>{{ __('main.fullname') }}</th>
            <th>{{ __('main.email') }}</th>
            <th>{{ __('main.phone') }}</th>
            <th>{{ __('main.status') }}</th>
            <th>{{ __('main.user_type') }}</th>
            <th>{{ __('main.action') }}</th>
        </x-slot>
    </x-list_view>
@endsection
@section('script')
@include('layouts.admin.scripts.Datatables_scripts')
<script>
    $(document).ready(function () {
        $('#deletedUsersTable').DataTable({
            'paging'        : true,
            'lengthChange'  : false,
            'searching'     : false,
            'ordering'      : true,
            'info'          : true,
            'autoWidth'     : false,
            "processing"    : true,
            "serverSide"    : true,
            "ajax"          : {
                                "url": "{!! route('dataTable.dataTableDeletedUsersListTable') !!}",
                                "type": "GET",
                                "data": function ( d ) {
                                        d.filterSearchKey = $("#filter_search_key").val();
                                        d.filterStatus = $("#filter_status").val();
                                        d.filterUserType = $("#filter_user_type").val();
                                }
                            },
            "columns"       : [
                                {   "data": "uuid",
                                    "render": function ( data, type, row ) {
                                        return (row.profile_image !== "") ? '<img src="'+row.profile_image+'" alt="'+row.profile_image+'" class="img-fluid d-block">' : '';
                                    },
                                },
                                {   "data": "full_name",
                                    "render": function ( data, type, row ) {
                                        return row.full_name;
                                    },
                                },
                                {   "data": "email" },
                                {   "data": "phone" },
                                {   "data": "is_active",
                                    "render": function ( data, type, row ) {
                                        if(data == 1){
                                            return '<span class="badge badge-soft-success text-uppercase">Active</span>';
                                        }else{
                                            return '<span class="badge badge-soft-danger text-uppercase">Not Active</span>';
                                        }
                                    },
                                },
                                {   "data": "name",
                                    "render": function ( data, type, row ) {
                                        @if (session()->get('locale') == 'ar')
                                            return '<div class="badge bg-info text-white rounded-pill">'+row.user_type.name.ar+'</div>';
                                        @elseif(session()->get('locale') == 'fr')
                                            return '<div class="badge bg-info text-white rounded-pill">'+row.user_type.name.fr+'</div>';
                                        @else
                                            return '<div class="badge bg-info text-white rounded-pill">'+row.user_type.name.en+'</div>';
                                        @endif
                                    },
                                },
                                {   "data": "uuid",
                                    "render": function ( data, type, row ) {
                                        return '<li class="list-inline-item"><a class="text-primary d-inline-block restore-btn" href="javascript:void(0)" data-id="'+row.uuid+'" ><i class="ri-restart-line fs-16"></i></a></li><li class="list-inline-item"><a class="text-danger d-inline-block remove-item-btn"  data-id="'+row.uuid+'" href="javascript:void(0)"><i class="ri-delete-bin-5-fill fs-16"></i></a></li>';
                                    },
                                },
                            ],
            'columnDefs': [
                            {
                                    "targets": 0,
                                    "className": "text-center avatar-sm bg-light rounded p-1",
                            },
                            {
                                    "targets": 1,
                                    "className": "text-center",
                            },
                            {
                                    "targets": 2,
                                    "className": "text-center",
                            },
                            {
                                    "targets": 3,
                                    "className": "text-center",
                                    // "width": "15%"
                            },
                            {
                                    "targets": 4,
                                    "className": "text-center",
                                    // "width": "15%"
                            },
                            {
                                    "targets": 5,
                                    "className": "text-center",
                                    // "width": "15%"
                            },
                            {
                                    "targets": 6,
                                    "className": "text-center",
                                    // "width": "15%"
                            },
                        ],
            language: {
                            url: '@if (session()->get('locale') == 'ar') {{asset('js/Arabic.json')}} @elseif(session()->get('locale') == 'fr') {{asset('js/French.json')}} @endif'
                        }
        });
    });

</script>
<script>
    $(document).ready(function() {
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });

        $('body').on('click','.restore-btn',function(e) {
        e.preventDefault();
        var id = $(this).data("id");
        console.log(id);
        swal({
            title: "Are you sure?",
            text: "You want to recover this User!",
            icon: "info",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                var data = {
                "_token": $('a[name="csrf-token"]').val(),
                "uuid": id,
                }
                $.ajax({
                type: "post",
                url: "{{ route('admin.restoreDeletedUser') }}",
                data: data,
                success: function(response) {
                    swal(response.status, {
                        icon: "success",
                        timer: 3000,
                    })
                    .then((result) => {
                        window.location =
                        '{{ route('admin.deletedUserInfo') }}'
                    });
                }
                });
            }
            });
        });

        $('body').on('click','.remove-item-btn',function(e) {
        e.preventDefault();
        var id = $(this).data("id");
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this User!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                var data = {
                "_token": $('a[name="csrf-token"]').val(),
                "id": id,
                }
                $.ajax({
                type: "DELETE",
                url: "{{ route('admin.forceDeleteUser', '') }}" + "/" + id,
                data: data,
                success: function(response) {
                    swal(response.status, {
                        icon: "success",
                        timer: 3000,
                    })
                    .then((result) => {
                        window.location =
                        '{{ route('admin.deletedUserInfo') }}'
                    });
                }
                });
            }
            });
        });
    });
</script>
@endsection
