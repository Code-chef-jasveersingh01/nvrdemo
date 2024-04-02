@extends('layouts.admin.layout')
@section('title')
    {{__('main.view_package')}}
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
@slot('title') {{__('main.packages')}} @endslot
@slot('link') {{ route('admin.packageList')}} @endslot
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
                            <a class="btn btn-primary edit-item-btn" href="{{ route('admin.editPackage', ['id' => $packageDetails->id]) }}"><i class="ri-edit-line fs-16"></i></a>
                            <a href="javascript:void(0)" class="btn btn-danger remove-item-btn" data-id="{{ $packageDetails->id }}"><i class="ri-delete-bin-2-line fs-16"></i></a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4 d-flex flex-row flex-wrap justify-content-center">
                        <div class="pb-2 d-flex flex-row flex-wrap justify-content-center" style="height: 10rem;width: 100%">
                            <div class="pb-2" style="height: 10rem;width: 10rem">
                                <img id="image_id" data-id="{{$packageDetails->id}}" @if(isset($packageDetails->media->thumbnail_name) && !empty($packageDetails->media->thumbnail_name))
                                src="{{ asset( config('image.package_image_path_view').$packageDetails->media->thumbnail_name)}}" alt="{{$packageDetails->media->thumbnail_name}}"
                                @else
                                src="{{asset("assets/images/No_Image_Available.jpg")}}" alt="{{ $packageDetails->package_name }}"
                                @endif  height="100%" width="100%">
                            </div>
                        </div>
                        <div class="pb-2 d-flex flex-row flex-wrap">
                            @if(isset($packageDetails->gallery) && !empty($packageDetails->gallery))
                            @foreach($packageDetails->gallery as $key => $value)
                                @if (isset($value) && !empty($value))
                                    <div class="m-2" style="height: 5rem;width: 5rem">
                                        <img src="{{$value['name']}}" alt="{{$value['name']}}" class="img-fluid d-block" />
                                    </div>
                                @endif
                            @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="table-responsive table-card mb-1">
                            <table class="table align-middle">
                                <tbody class="">
                                    <tr>
                                        <td>{{__('main.name')}}</td>
                                        <td>
                                            {{ $packageDetails->package_name}}
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
                                    <tr>
                                        <td>{{__('main.original_price')}}</td>
                                        <td>{{$packageDetails->original_price}}</td>
                                    </tr>
                                    <tr>
                                        <td>{{__('main.profit_percentage')}}</td>
                                        <td>{{$packageDetails->profit_percentage}}</td>
                                    </tr>
                                    <tr>
                                        <td>{{__('main.selling_price')}}</td>
                                        <td>{{$packageDetails->price}}</td>
                                    </tr>
                                    <tr>
                                        <td>{{__('main.discount')}}</td>
                                        <td>{{$packageDetails->discount}}</td>
                                    </tr>
                                    <tr>
                                        <td>{{__('main.preparation_time')}}</td>
                                        <td>{{$packageDetails->preparation_time}}</td>
                                    </tr>
                                    <tr>
                                        <td>{{__('main.estimate_delivery_time')}}</td>
                                        <td>{{$packageDetails->estimate_delivery_time}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card-body border border-dashed border-end-0 border-start-0">
                    <x-list_view>
                        <x-slot name="create_button_title"> {{__('main.create_package')}} </x-slot>
                        <x-slot name="table_id"> package_product_table </x-slot>
                        <x-slot name="table_th">
                            <th>{{ __('main.id') }}</th>
                            <th>{{ __('main.image') }}</th>
                            <th>{{ __('main.product_name') }}</th>
                            <th>{{ __('main.sku_id') }}</th>
                            <th>{{ __('main.original_price') }}</th>
                            <th>{{ __('main.selling_price') }}</th>
                            <th>{{ __('main.quantity') }}</th>
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
<script>
    const lang = sessionStorage.getItem('lang');
    $(document).ready(function () {
        $('#package_product_table').DataTable({
            'paging'        : true,
            'lengthChange'  : false,
            'searching'     : false,
            'ordering'      : true,
            'info'          : true,
            'autoWidth'     : false,
            "processing"    : true,
            "serverSide"    : true,
            "ajax"          : {
                                "url": "{!! route('dataTable.dataTablePackageProductTable') !!}",
                                "type": "GET",
                                "data": function ( d ) {
                                        // d.filterSearchKey = $("#filter_search_key").val();
                                        d.id = $("#image_id").data('id');
                                        // d.filterStatus = $("#filter_status").val();
                                        // d.filterUserType = $("#filter_user_type").val();
                                }
                            },
            "columns"       : [
                                    {   "data": "productId",
                                        "render": function(data,type,row)
                                        {
                                            console.log(row);
                                          return "<a class='dropdown-item' href='{{route('admin.viewProduct','')}}/"+row.productId+"'>"+data+"</a>";
                                        }
                                    },
                                    {   "data": "productId",
                                        "render": function(data,type,row)
                                        {
                                            switch (row.type) {
                                                case "Configured Product":
                                                return (row.product_variation.image && row.product_variation.image !== null) ? '<img src="'+row.product_variation.image+'" alt='+row.product_variation.image+' class="img-fluid d-block">' : '';
                                                    break;
                                                default:
                                                return (row.productimage && row.productimage !== null) ? '<img src="'+row.productimage+'" alt="'+row.productimage+'" class="img-fluid d-block">' : '';
                                                    break;
                                            }
                                        }
                                    },
                                    {   "data": "producttitle",
                                        "render": function(data,type,row)
                                        {
                                            return "<a class='dropdown-item' href='{{route('admin.viewProduct','')}}/"+row.productId+"'>"+row.producttitle[lang]+"</a>";
                                        }
                                    },
                                    {   "data": "productId",
                                        "render": function(data,type,row)
                                        {
                                            switch (row.type) {
                                                case "Configured Product":
                                                return (row.product_variation.sku && row.product_variation.sku !== null) ? "<a class='dropdown-item' href='{{route('admin.viewProduct','')}}/"+row.productId+"'>"+row.product_variation.sku+"</a>": '';
                                                    break;
                                                default:
                                                return (row.sku && row.sku !== null) ? "<a class='dropdown-item' href='{{route('admin.viewProduct','')}}/"+row.productId+"'>"+row.sku+"</a>": '';
                                                    break;
                                            }
                                        }
                                    },
                                    {   "data": "productId",
                                        "render": function(data,type,row)
                                        {
                                            switch (row.type) {
                                                case "Configured Product":
                                                return (row.product_variation.price && row.product_variation.price !== null) ? "<a class='dropdown-item' href='{{route('admin.viewProduct','')}}/"+row.productId+"'>"+row.product_variation.price+"</a>" : '';
                                                    break;
                                                default:
                                                return (row.originalprice && row.originalprice !== null) ? "<a class='dropdown-item' href='{{route('admin.viewProduct','')}}/"+row.productId+"'>"+row.originalprice+"</a>" : '';
                                                    break;
                                            }
                                        }
                                    },
                                    {   "data": "productId",
                                        "render": function(data,type,row)
                                        {
                                            switch (row.type) {
                                                case "Configured Product":
                                                return (row.product_variation.price && row.product_variation.price !== null) ? "<a class='dropdown-item' href='{{route('admin.viewProduct','')}}/"+row.productId+"'>"+row.product_variation.price+"</a>" : '';
                                                    break;
                                                default:
                                                return (row.sellingprice && row.sellingprice !== null) ? "<a class='dropdown-item' href='{{route('admin.viewProduct','')}}/"+row.productId+"'>"+row.sellingprice+"</a>" : '';
                                                    break;
                                            }
                                        }
                                    },
                                    {
                                        "data": "quantity",
                                        "render": function ( data, type, row )
                                        {
                                            return (row.quantity && row.quantity !== null) ? "<a class='dropdown-item' href='{{route('admin.viewProduct','')}}/"+row.productId+"'>"+data+"</a>" : 'not found';
                                        },
                                    },
                                    {
                                        "data": "is_active",
                                        "render": function ( data, type, row ) {
                                            switch (row.type) {
                                                case "Configured Product":
                                                if(row.product_variation.is_active == 1){
                                                    return '<a href="{{route("admin.viewProduct","")}}/'+row.productId+'"><span class="badge badge-soft-success text-uppercase">Active</span></a>';
                                                }else{
                                                    return '<a href="{{route("admin.viewProduct","")}}/'+row.productId+'"><span class="badge badge-soft-danger text-uppercase">Not Active</span></a>';
                                                }
                                                    break;
                                                default:
                                                if(data == 1){
                                                    return '<a href="{{route("admin.viewProduct","")}}/'+row.productId+'"><span class="badge badge-soft-success text-uppercase">Active</span></a>';
                                                }else{
                                                    return '<a href="{{route("admin.viewProduct","")}}/'+row.productId+'"><span class="badge badge-soft-danger text-uppercase">Not Active</span></a>';
                                                }
                                                    break;
                                            }

                                    },
                                    },
                                    {   "data": "productId",
                                    "render": function(data,type,row)
                                    {
                                        return '<li class="list-inline-item edit"><a href="{{route("admin.viewProduct","")}}/'+row.productId+'" data-id="'+row.productId+'" class="text-primary d-inline-block edit-btn"><i class="ri-eye-fill fs-16"></i></a></li><li class="list-inline-item edit"><a href="{{route("admin.editProduct","")}}/'+row.productId+'" data-id="'+row.productId+'" class="text-primary d-inline-block edit-btn"><i class="ri-pencil-fill fs-16"></i></a></li><li class="list-inline-item"><a class="text-danger d-inline-block remove-product-btn"  data-id="'+row.productId+'" href="javascript:void(0)"><i class="ri-delete-bin-5-fill fs-16"></i></a></li>';
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
                            {
                                    "targets": 7,
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
@endsection
