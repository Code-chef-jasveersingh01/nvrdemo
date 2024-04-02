@extends('layouts.admin.layout')
@section('title')
    {{__('main.view_paraent_pacakage')}}
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
@slot('title') {{__('main.parent_packages')}} @endslot
@slot('link') {{ route('admin.parentPackageList')}} @endslot
@endcomponent
    <div class="row">
        <div class="col-lg-12">
            <div class="card" id="viewPackage">
                <div class="card-header border-0">
                    <div class="d-flex align-items-center">
                        <h5 class="card-title mb-0 flex-grow-1">
                            {{__('main.package_detail')}}
                        </h5>
                        <div class="flex-shrink-0">
                            <a class="btn btn-primary edit-item-btn" href="{{ route('admin.editParentPackage', ['id' => $packageDetails->id]) }}"><i class="ri-edit-line fs-16"></i></a>
                            <a href="javascript:void(0)" class="btn btn-danger remove-item-btn" data-id="$packageDetails->id"><i class="ri-delete-bin-2-line fs-16"></i></a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4 d-flex flex-row justify-content-center">
                        <div class="pb-2" style="height: 10rem;width: 10rem">
                            <img id="image_id" data-id="{{$packageDetails->id}}" src="{{ asset( config('image.package_image_path_view').$packageDetails->media->thumbnail_name)}}" alt="{{$packageDetails->media->thumbnail_name}}" height="100%" width="100%">
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="table-responsive table-card mb-1">
                            <table class="table align-middle">
                                <tbody class="">
                                    <tr>
                                        <td>{{__('main.name')}}</td>
                                        <td>
                                            {{ isset($packageDetails->parent_package_name) ? $packageDetails->parent_package_name : ""}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{__('main.is_active')}}</td>
                                        <td>
                                            @switch($packageDetails->is_active)
                                                @case(1)
                                                    <span class="badge badge-soft-success text-uppercase">{{__('main.active')}}</span>
                                                    @break
                                                @default
                                                    <span class="badge badge-soft-danger text-uppercase">{{__('main.in_active')}}</span>
                                            @endswitch
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card-body border border-dashed border-end-0 border-start-0">
                    <x-list_view>
                        <x-slot name="create_button_title"> {{__('main.create_package')}} </x-slot>
                        <x-slot name="table_id"> package_table </x-slot>
                        <x-slot name="table_th">
                            <th>{{ __('main.id') }}</th>
                            <th>{{ __('main.image') }}</th>
                            <th>{{ __('main.product_name') }}</th>
                            <th>{{ __('main.original_price') }}</th>
                            <th>{{ __('main.profit_percentage') }}</th>
                            <th>{{ __('main.selling_price') }}</th>
                            <th>{{ __('main.profit') }}</th>
                            <th>{{ __('main.is_active') }}</th>
                            <th>{{ __('main.action') }}</th>
                        </x-slot>
                    </x-list_view>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
@include('layouts.admin.scripts.Datatables_scripts')
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
            text: "Once deleted, you will not be able to recover this data!",
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
                url: "{{ route('admin.destroyParentPackage', '') }}" + "/" + id,
                data: data,
                success: function(response) {
                    swal(response.status, {
                        icon: "success",
                        timer: 3000,
                    })
                    .then((result) => {
                        window.location =
                        '{{ route('admin.parentPackageList') }}'
                    });
                }
                });
            }
            });
        });
    });
</script>
<script>
    const lang = sessionStorage.getItem('lang');
    $(document).ready(function () {
        $('#package_table').DataTable({
            'paging'        : true,
            'lengthChange'  : false,
            'searching'     : false,
            'ordering'      : true,
            'info'          : true,
            'autoWidth'     : false,
            "processing"    : true,
            "serverSide"    : true,
            "ajax"          : {
                                "url": "{!! route('dataTable.dataTableParentPackageSubPackage') !!}",
                                "type": "GET",
                                "data": function ( d ) {
                                        // d.filterSearchKey = $("#filter_search_key").val();
                                        d.id = $("#image_id").data('id');
                                        // d.filterStatus = $("#filter_status").val();
                                        // d.filterUserType = $("#filter_user_type").val();
                                }
                            },
            "columns"       : [
                                    {   "data": "id",
                                        "render": function(data,type,row)
                                        {
                                          return "<a class='dropdown-item' href='{{route('admin.viewPackage','')}}/"+row.id+"'>"+row.id+"</a>";
                                        }
                                    },
                                    {   "data": "image",
                                        "render": function(data,type,row)
                                        {
                                            return (typeof(row.image) !== 'undefined' && row.image !== null) ? '<img src='+row.image+' alt='+row.image+' class="img-fluid d-block">' : '';
                                        }
                                    },
                                    {   "data": "package_name",
                                        "render": function(data,type,row)
                                        {
                                            return data[lang];
                                        }
                                    },
                                    {   "data": "original_price" },
                                    {   "data": "profit_percentage" },
                                    {   "data": "price" },
                                    {   "data": "profit" },
                                    {
                                        "data": "is_active",
                                        "render": function ( data, type, row ) {
                                        if(data == 1){
                                            return '<a href="{{route("admin.viewPackage","")}}/'+row.id+'"><span class="badge badge-soft-success text-uppercase">Active</span></a>';
                                        }else{
                                            return '<a href="{{route("admin.viewPackage","")}}/'+row.id+'"><span class="badge badge-soft-danger text-uppercase">Not Active</span></a>';
                                        }
                                    },
                                    },
                                    {   "data": "id",
                                    "render": function(data,type,row)
                                    {
                                        return '<li class="list-inline-item edit"><a href="{{route("admin.viewPackage","")}}/'+row.id+'" data-id="'+row.id+'" class="text-primary d-inline-block edit-btn"><i class="ri-eye-fill fs-16"></i></a></li><li class="list-inline-item edit"><a href="{{route("admin.editPackage","")}}/'+row.id+'" data-id="'+row.id+'" class="text-primary d-inline-block edit-btn"><i class="ri-pencil-fill fs-16"></i></a></li><li class="list-inline-item"><a class="text-danger d-inline-block remove-product-btn"  data-id="'+row.id+'" href="javascript:void(0)"><i class="ri-delete-bin-5-fill fs-16"></i></a></li>';
                                    }
                                },
                            ],
            'columnDefs': [
                            {
                                    "targets": 0,
                                    "className": "text-center",
                            },
                            {
                                    "targets": 1,
                                    "className": "text-center avatar-sm bg-light rounded p-1",
                            },
                            {
                                    "targets": 2,
                                    "className": "text-center",
                            },
                            {
                                    "targets": 3,
                                    "className": "text-center",
                            },
                            {
                                    "targets": 4,
                                    "className": "text-center",
                            },
                            {
                                    "targets": 5,
                                    "className": "text-center",
                            },
                            {
                                    "targets": 6,
                                    "className": "text-center",
                            },
                            {
                                    "targets": 7,
                                    "className": "text-center",
                            },
                            {
                                    "targets": 8,
                                    "className": "text-center",
                            },
                        ],
            // language: {
            //                 url: '@if (session()->get('locale') == 'ar') {{asset('js/Arabic.json')}} @elseif(session()->get('locale') == 'fr') {{asset('js/French.json')}} @endif'
            //             }
        });
    });

    $("#search_filter").click(function (e) {
        e.preventDefault();
        $('#usersTable').DataTable().ajax.reload();
    });

    $("#reset_filter").click(function (e) {
        e.preventDefault();
        $('#filter_search_key').val('');
        $('#filter_status').prop('selectedIndex',0);
        $('#filter_user_type').prop('selectedIndex',0);
        $('#usersTable').DataTable().ajax.reload();
    });
</script>
@endsection
