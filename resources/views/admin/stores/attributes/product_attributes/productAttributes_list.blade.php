@extends('layouts.admin.layout')
@section('title')
    {{ __('main.product_attribute_list')}}
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
@slot('title') {{__('main.attribute')}} @endslot
@slot('link') {{route('admin.attributeProductList')}} @endslot
@endcomponent
   <x-list_view>
        <x-slot name="card_heard"> {{__('main.attribute')}} </x-slot>
        <x-slot name="create_button_href"> {{route('admin.createProductAttribute')}} </x-slot>
        <x-slot name="create_button_title"> {{__('main.create_attribute')}} </x-slot>
        <x-slot name="table_id"> productAttributeTable </x-slot>
        <x-slot name="table_th">
            <th>{{ __('main.label_name') }}</th>
            <th>{{ __('main.name_code') }}</th>
            <th>{{ __('main.field_type') }}</th>
            <th>{{ __('main.field_required') }}</th>
            <th>{{ __('main.is_active') }}</th>
            <th></th>
        </x-slot>
   </x-list_view>

@endsection
@section('script')
@include('layouts.admin.scripts.Datatables_scripts')
<script>
    $(document).ready(function () {
        $('#productAttributeTable').DataTable({
            'paging'        : true,
            'lengthChange'  : false,
            'searching'     : false,
            'ordering'      : true,
            'info'          : true,
            'autoWidth'     : false,
            "processing"    : true,
            "serverSide"    : true,
            "ajax"          : {
                                "url": "{!! route('dataTable.dataTableProductAtttributesTable') !!}",
                                "type": "GET",
                                "data": function ( d ) {
                                    d.filterSearchKey = $("#filter_search_key").val();
                                    d.filterStatus = $("#filter_status").val();
                                    d.filterFieldType = $("#filter_field_type").val();
                                }
                            },
            "columns"       : [
                                {   "data": "label_name",
                                    "render": function(data,type,row)
                                    {
                                      return '<a class="dropdown-item" href="{{route("admin.editProductAttribute","")}}/'+row.id+'">'+row.label_name+'</a>';
                                    }
                                },
                                {   "data": "name_code",
                                    "render": function(data,type,row)
                                    {
                                      return '<a class="dropdown-item" href="{{route("admin.editProductAttribute","")}}/'+row.id+'">'+row.name_code+'</a>';
                                    }
                                },
                                {   "data": "field_type",
                                     "render": function( data, type, row) {
                                        return (row.field_type && typeof(row.field_type.name) !== 'undefined' && row.field_type.name !== null) ? '<a class="dropdown-item" href="{{route("admin.editProductAttribute","")}}/'+row.id+'">'+row.field_type.name.en+'</a>': "";
                                     }
                                },
                                {   "data": "field_required",
                                    "render": function( data, type, row) {
                                        if(data == 1){
                                            return '<a class="dropdown-item" href="{{route("admin.editProductAttribute","")}}/'+row.id+'">Yes</a>';
                                        }else{
                                            return '<a class="dropdown-item" href="{{route("admin.editProductAttribute","")}}/'+row.id+'">No</a>';
                                        }
                                    },
                                },
                                {   "data": "is_active",
                                    "render": function ( data, type, row) {
                                        if(data == 1){
                                            return '<a class="dropdown-item" href="{{route("admin.editProductAttribute","")}}/'+row.id+'"><span class="badge bg-success">Active</span></a>';
                                        }else{
                                            return '<a href="{{route("admin.editProductAttribute","")}}/'+row.id+'"><span class="badge bg-danger">In Active</span></a>';
                                        }
                                    }
                                },
                                {   "data": "id",
                                    "render": function ( data, type, row ) {
                                        return '<div class="dropdown d-inline-block"> <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false"> <i class="ri-more-fill align-middle"></i> </button> <ul class="dropdown-menu dropdown-menu-end"> <li><a href="{{route("admin.editProductAttribute","")}}/'+row.id+'" class="dropdown-item edit-item-btn"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a></li> <li> <a href="javascript:void(0)" data-id='+row.id+' class="dropdown-item remove-item-btn deleteAttribute"> <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete </a> </li> </ul> </div>';
                                    },
                                },
                            ],
            'columnDefs': [
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
                                    "width": "15%"
                            }

                        ],
        });
    });

    $("#search_filter").click(function (d) {
        d.preventDefault();
        $('#productAttributeTable').DataTable().ajax.reload();
    });

    $("#reset_filter").click(function (d) {
        d.preventDefault();
        $('#filter_search_key').val('');
        $('#filter_status').prop('selectedIndex',0);
        $('#filter_field_type').prop('selectedIndex',0);
        $('#productAttributeTable').DataTable().ajax.reload();
    });
</script>
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('body').on('click','.deleteAttribute',function(e) {
            e.preventDefault();
            var id = $(this).data("id");
            swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this Data!",
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
                            url: "{{route('admin.destroyProductAttribute',"")}}"+"/"+id,
                            data: data,
                            success: function(response) {
                                swal(response.status, {
                                        icon: "success",
                                        timer: 3000,
                                    })
                                    .then((result) => {
                                        window.location =
                                            '{{ route('admin.attributeProductList') }}'
                                    });
                            }
                        });
                    }
                });
        });
    });
</script>
@endsection

