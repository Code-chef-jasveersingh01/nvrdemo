@extends('layouts.admin.layout')
@section('title')
    {{__('main.all_parent_packages')}}
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
@slot('title') {{__('main.all_parent_packages')}} @endslot
@slot('link') {{ route('admin.parentPackageList')}} @endslot
@endcomponent
    <x-list_view>
        <x-slot name="card_heard"> {{__('main.all_parent_packages')}} </x-slot>
        <x-slot name="create_button_href"> {{route('admin.createParentPackage')}} </x-slot>
        <x-slot name="create_button_title"> {{__('main.create_package')}} </x-slot>
        <x-slot name="table_id"> parent_package_table </x-slot>
        <x-slot name="table_th">
            <th>{{ __('main.id') }}</th>
            <th>{{ __('main.image') }}</th>
            <th>{{ __('main.parent_package_name') }}</th>
            <th>{{ __('main.package_name') }}</th>
            {{-- <th>{{ __('main.price') }}</th> --}}
            <th>{{ __('main.is_active') }}</th>
            <th>{{ __('main.action') }}</th>
        </x-slot>
    </x-list_view>
@endsection
@section('script')
@include('layouts.admin.scripts.Datatables_scripts')
<script>
    const lang = sessionStorage.getItem('lang');
    $(document).ready(function () {
        $('#parent_package_table').DataTable({
            'paging'        : true,
            'lengthChange'  : false,
            'searching'     : false,
            'ordering'      : true,
            'info'          : true,
            'autoWidth'     : false,
            "processing"    : true,
            "serverSide"    : true,
            "ajax"          : {
                                "url": "{!! route('dataTable.dataTableParentPackage') !!}",
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
                                          return "<a class='dropdown-item' href='{{route('admin.viewParentPackage','')}}/"+row.id+"'>"+row.id+"</a>";
                                        }
                                    },
                                    {   "data": "image",
                                        "render": function(data,type,row)
                                        {
                                            return (typeof(row.image) !== 'undefined' && row.image !== null) ? '<img src='+row.image+' alt='+row.image+' class="img-fluid d-block">' : '';
                                        }
                                    },
                                    {   "data": "parent_package_name",
                                        "render": function(data,type,row)
                                        {
                                            return "<a class='dropdown-item' href='{{route('admin.viewParentPackage','')}}/"+row.id+"'>"+data[lang]+"</a>";
                                        }
                                    },
                                    {   "data": "packages",
                                        "render": function(data,type,row)
                                        {
                                            var packageName = $.map(row.packages, function (e) {
                                                    if (typeof(e.package_name) !== 'undefined'){
                                                        return e.package_name[lang];
                                                    };
                                            });
                                            return packageName;
                                        }
                                    },
                                    // {   "data": "price",
                                    //     "render": function(data,type,row)
                                    //     {
                                    //         return "<a class='dropdown-item' href='{{route('admin.viewParentPackage','')}}/"+row.id+"'>"+data+"</a>";
                                    //     }
                                    // },
                                    {
                                        "data": "is_active",
                                        "render": function ( data, type, row ) {
                                        if(data == 1){
                                            return '<a href="{{route("admin.viewParentPackage","")}}/'+row.id+'"><span class="badge badge-soft-success text-uppercase">Active</span></a>';
                                        }else{
                                            return '<a href="{{route("admin.viewParentPackage","")}}/'+row.id+'"><span class="badge badge-soft-danger text-uppercase">Not Active</span></a>';
                                        }
                                    },
                                    },
                                    {   "data": "id",
                                        "render": function(data,type,row)
                                        {
                                            return '<li class="list-inline-item edit"><a href="{{route("admin.viewParentPackage","")}}/'+row.id+'" data-id="'+row.id+'" class="text-primary d-inline-block edit-btn"><i class="ri-eye-fill fs-16"></i></a></li><li class="list-inline-item edit"><a href="{{route("admin.editParentPackage","")}}/'+row.id+'" data-id="'+row.id+'" class="text-primary d-inline-block edit-btn"><i class="ri-pencil-fill fs-16"></i></a></li><li class="list-inline-item"><a class="text-danger d-inline-block remove-item-btn"  data-id="'+row.id+'" href="javascript:void(0)"><i class="ri-delete-bin-5-fill fs-16"></i></a></li>';
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
                            // {
                            //         "targets": 6,
                            //         "className": "text-center",
                            // },
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
            text: "Once deleted, you will not be able to recover this Product!",
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
@endsection
