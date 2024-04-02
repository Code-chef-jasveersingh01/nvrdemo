@extends('layouts.admin.layout')
@section('title')
    {{__('main.all_package')}}
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
@slot('li_1') {{__('main.index')}} @endslot
@slot('title') {{__('main.all_package')}} @endslot
@slot('link') {{ route('admin.packageList')}} @endslot
@endcomponent
    <x-list_view>
        <x-slot name="card_heard"> {{__('main.all_package')}} </x-slot>
        <x-slot name="create_button_href"> {{route('admin.createPackage')}} </x-slot>
        <x-slot name="create_button_title"> {{__('main.create_package')}} </x-slot>
        <x-slot name="table_id"> package_table </x-slot>
        <x-slot name="table_th">
            <th>{{ __('main.id') }}</th>
            <th>{{ __('main.image') }}</th>
            <th>{{ __('main.package_name') }}</th>
            <th>{{ __('main.price') }}</th>
            <th>{{ __('main.is_active') }}</th>
            <th>{{ __('main.parent_packages') }}</th>
            <th>{{ __('main.action') }}</th>
        </x-slot>
    </x-list_view>
@endsection
@section('script')
@include('layouts.admin.scripts.Datatables_scripts')
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
                                "url": "{!! route('dataTable.dataTablePackageTable') !!}",
                                "type": "GET",
                                "data": function ( d ) {
                                        d.filterSearchKey = $("#filter_search_key").val();
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
                                    {   "data": "media",
                                        "render": function(data,type,row)
                                        {
                                            return (row.media && row.media.id !== null) ? '<img src="{{asset(config("image.package_image_path_view"))}}/'+row.media.thumbnail_name+'" alt='+row.media.thumbnail_name+' class="img-fluid d-block">' : '<img src="{{asset("assets/images/No_Image_Available.jpg")}}" class="img-fluid d-block">';
                                        }
                                    },
                                    {   "data": "package_name",
                                        "render": function(data,type,row)
                                        {
                                            return "<a class='dropdown-item' href='{{route('admin.viewPackage','')}}/"+row.id+"'>"+data[lang]+"</a>";
                                        }
                                    },
                                    {   "data": "price",
                                        "render": function(data,type,row)
                                        {
                                            return "<a class='dropdown-item' href='{{route('admin.viewPackage','')}}/"+row.id+"'>"+data+"</a>";
                                        }
                                    },
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
                                    {   "data": "parent_package",
                                        "render": function(data,type,row)
                                        {
                                            if (row.parent_package && row.parent_package.length != 0){
                                                var packageName = $.map(row.parent_package, function (e) {
                                                    if (typeof(e.parent_package_name) !== 'undefined'){
                                                        return e.parent_package_name[lang];
                                                    };
                                                });
                                                return packageName;
                                            }
                                            return " ";
                                        }
                                    },
                                    {   "data": "id",
                                    "render": function(data,type,row)
                                    {
                                        return '<li class="list-inline-item edit"><a href="{{route("admin.viewPackage","")}}/'+row.id+'" data-id="'+row.id+'" class="text-primary d-inline-block edit-btn"><i class="ri-eye-fill fs-16"></i></a></li><li class="list-inline-item edit"><a href="{{route("admin.editPackage","")}}/'+row.id+'" data-id="'+row.id+'" class="text-primary d-inline-block edit-btn"><i class="ri-pencil-fill fs-16"></i></a></li><li class="list-inline-item"><a class="text-danger d-inline-block remove-item-btn"  data-id="'+row.id+'" href="javascript:void(0)"><i class="ri-delete-bin-5-fill fs-16"></i></a></li>';
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
                                    // "width": "25%",
                            },
                            {
                                    "targets": 3,
                                    "className": "text-center",
                                    // "width": "15%",
                            },
                            {
                                    "targets": 4,
                                    "className": "text-center",
                                    // "width": "15%",
                            },
                            {
                                    "targets": 5,
                                    "className": "text-center",
                                    // "width": "15%",
                            },
                            {
                                    "targets": 6,
                                    "className": "text-center",
                                    // "width": "15%",
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
            text: "Once deleted, you will not be able to recover this Package!",
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
                url: "{{ route('admin.destroyPackage', '') }}" + "/" + id,
                data: data,
                success: function(response) {
                    swal(response.status, {
                        icon: "success",
                        timer: 3000,
                    })
                    .then((result) => {
                        window.location =
                        '{{ route('admin.packageList') }}'
                    });
                }
                });
            }
            });
        });
    });
</script>
@endsection
