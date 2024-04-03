@extends('layouts.admin.layout')
@section('title')
    {{__('main.faces')}}
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
    <link rel="stylesheet" href={{asset("assets/css/custom/all_face_list.css")}}>
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') {{__('main.index')}} @endslot
@slot('title') {{__('main.faces')}} @endslot
@slot('link') {{ route('admin.faceList')}} @endslot
@endcomponent
    <x-list_view>
        <x-slot name="card_heard"> {{__('main.faces')}} </x-slot>
        <x-slot name="search_label">
            <div class="row g-3">
                <div class="col-xxl-9 col-sm-6">
                    <div class="search-box">
                        <input type="text" name="filter_search_key" id="filter_search_key" class="form-control search" placeholder="{{__('main.search')}}">
                        <i class="ri-search-line search-icon"></i>
                    </div>
                </div>
                <div class="col-xxl-3 col-sm-4">
                    <div class="d-flex">
                        <button type="button" id="search_filter" class="btn btn-primary w-100 mx-1" ><i class="ri-equalizer-fill me-1 align-bottom"></i> {{__('main.filter')}}</button>
                        <button type="button" id="reset_filter" class="btn btn-success w-100 mx-1"><i class="ri-refresh-line me-1 align-bottom"></i> {{__('main.reset')}}</button>
                    </div>
                </div>
                <!--end col-->
            </div>
     </x-slot>
        <x-slot name="table_id"> facesTable </x-slot>
        <x-slot name="table_th">
            <th>{{ __('main.image') }}</th>
            <th>{{ __('main.fullname') }}</th>
            <th>{{ __('main.email') }}</th>
            <th>{{ __('main.phone') }}</th>
            <th>{{ __('main.action') }}</th>
        </x-slot>
    </x-list_view>
@endsection
@section('script')
@include('layouts.admin.scripts.Datatables_scripts')
<script>
    $(document).ready(function () {
        $('#facesTable').DataTable({
            'paging'        : true,
            'lengthChange'  : false,
            'searching'     : false,
            'ordering'      : false,
            'info'          : true,
            'autoWidth'     : false,
            "processing"    : true,
            "serverSide"    : true,
            "ajax"          : {
                                "url": "{!! route('dataTable.dataTableFacesListTable') !!}",
                                "type": "GET",
                                "data": function ( d ) {
                                        d.filterSearchKey = $("#filter_search_key").val();
                                        d.filterStatus = $("#filter_status").val();
                                        d.filterFaceType = $("#filter_face_type").val();
                                }
                            },
            "columns"       : [
                                {   "data": "image",
                                    "render": function ( data, type, row ) {
                                        return (row.image !== "") ? '<img src="'+row.image+'" alt="'+row.image+'" class="img-fluid d-block w-100 h-100">' : '';
                                    },
                                },
                                {   "data": "name",
                                },
                                {   "data": "email" },
                                {   "data": "phone" },
                                {   "data": "uuid",
                                    "render": function ( data, type, row ) {
                                        return '<li class="list-inline-item edit"><a href="{{route("admin.viewFace","")}}/'+row.uuid+'" data-id="'+row.uuid+'" class="text-primary d-inline-block edit-btn"><i class="ri-eye-fill fs-16"></i></a></li><li class="list-inline-item edit"><a href="{{route("admin.editFace","")}}/'+row.uuid+'" data-id="'+row.uuid+'" class="text-primary d-inline-block edit-btn"><i class="ri-pencil-fill fs-16"></i></a></li><li class="list-inline-item"><a class="text-danger d-inline-block remove-item-btn"  data-id="'+row.uuid+'" href="javascript:void(0)"><i class="ri-delete-bin-5-fill fs-16"></i></a></li>';
                                    },
                                },
                            ],
            'columnDefs': [
                            {
                                    "targets": 0,
                                    "className": "text-center  avatar-md bg-light rounded p-1",

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
                        ],
            language: {
                            url: '@if (session()->get('locale') == 'ar') {{asset('js/Arabic.json')}} @elseif(session()->get('locale') == 'fr') {{asset('js/French.json')}} @endif'
                        }
        });
    });

    $("#search_filter").click(function (e) {
        e.preventDefault();
        $('#facesTable').DataTable().ajax.reload();
    });

    $("#reset_filter").click(function (e) {
        e.preventDefault();
        $('#filter_search_key').val('');
        $('#filter_status').prop('selectedIndex',0);
        $('#filter_face_type').prop('selectedIndex',0);
        $('#facesTable').DataTable().ajax.reload();
    });
</script>
<script>
    $(document).ready(function() {
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });

        $('body').on('click','.remove-item-btn',function(e) {
        e.preventDefault();
        var id = $(this).data("id");
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this Face!",
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
                url: "{{ route('admin.destroyFace', '') }}" + "/" + id,
                data: data,
                success: function(response) {
                    swal(response.status, {
                        icon: "success",
                        timer: 3000,
                    })
                    .then((result) => {
                        window.location =
                        '{{ route('admin.faceList') }}'
                    });
                }
                });
            }
            });
        });
    });
</script>
@endsection
