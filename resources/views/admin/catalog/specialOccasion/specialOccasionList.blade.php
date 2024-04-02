@extends('layouts.admin.layout')
@section('title')
    {{__('main.special_occasion')}}
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
@slot('title') {{__('main.special_occasion')}} @endslot
@slot('link') {{ route('admin.specialOccasionList')}} @endslot
@endcomponent
    <x-list_view>
        <x-slot name="card_heard"> {{__('main.special_occasion')}} </x-slot>
        <x-slot name="create_button_href"> {{route('admin.createSepcialOccasion')}} </x-slot>
        <x-slot name="create_button_title"> {{__('main.create_occasion')}} </x-slot>
        <x-slot name="table_id"> special_occasion_list </x-slot>
        <x-slot name="table_th">
            <th>{{ __('main.id') }}</th>
            <th>{{ __('main.image') }}</th>
            <th>{{ __('main.occasion_name') }}</th>
            <th>{{ __('main.product_type') }}</th>
            <th>{{ __('main.number_of_product') }}</th>
            <th>{{ __('main.start_date') }}</th>
            <th>{{ __('main.end_date') }}</th>
            <th>{{ __('main.status') }}</th>
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
        $('#special_occasion_list').DataTable({
            'paging'        : true,
            'lengthChange'  : false,
            'searching'     : false,
            'ordering'      : true,
            'info'          : true,
            'autoWidth'     : false,
            "processing"    : true,
            "serverSide"    : true,
            "ajax"          : {
                                "url": "{!! route('dataTable.dataTableSpecialOccastion') !!}",
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
                                          return "<a class='dropdown-item' href='{{route('admin.viewSepcialOccasion','')}}/"+row.id+"'>"+row.id+"</a>";
                                        }
                                    },
                                    {   "data": "id",
                                        "render": function(data,type,row)
                                        {
                                            return (row.image && row.image.id !== null) ? '<img src='+row.image+' alt='+row.image+' class="img-fluid d-block">' : '<img src="{{asset("assets/images/No_Image_Available.jpg")}}" class="img-fluid d-block">';
                                        }
                                    },
                                    {   "data": "name",
                                        "render": function(data,type,row)
                                        {
                                            return (!!data && typeof data == 'object') ? (!!data[lang]) ? data[lang]: ' ' : data;
                                        }
                                    },
                                    {   "data": "product_type",
                                        "render": function(data,type,row)
                                        {
                                            switch (row.product_type) {
                                                case "1":
                                                    return "<a class='dropdown-item' href='{{route('admin.viewSepcialOccasion','')}}/"+row.id+"'>{{__('main.product')}}</a>";
                                                    break;
                                                case "2":
                                                    return "<a class='dropdown-item' href='{{route('admin.viewSepcialOccasion','')}}/"+row.id+"'>{{ __('main.package')}}</a>";
                                                    break;
                                            default:
                                                break;
                                            }
                                        }
                                    },
                                    {   "data": "id",
                                        "render": function(data,type,row)
                                        {
                                            if (row.product_type === "1"){
                                                if (row.products === null){
                                                    return "<a class='dropdown-item' href='{{route('admin.viewSepcialOccasion','')}}/"+row.id+"'>"+ 0+"</a>"
                                                }else{
                                                    return "<a class='dropdown-item' href='{{route('admin.viewSepcialOccasion','')}}/"+row.id+"'>"+ row.products.length +"</a>";
                                                }
                                            }else if(row.product_type === "2"){
                                                if (row.packages === null){
                                                    return "<a class='dropdown-item' href='{{route('admin.viewSepcialOccasion','')}}/"+row.id+"'>"+ 0 +"</a>"
                                                }else{
                                                    return "<a class='dropdown-item' href='{{route('admin.viewSepcialOccasion','')}}/"+row.id+"'>"+ row.packages.length +"</a>";
                                                }
                                            }
                                        }
                                    },
                                    {   "data": "start_date" },
                                    {   "data": "end_date" },
                                    {
                                        "data": "status",
                                        "render": function ( data, type, row ) {
                                            switch (data) {
                                                case ("On Going Occassion"):
                                                        return '<a href="{{route("admin.viewSepcialOccasion","")}}/'+row.id+'"><span class="badge badge-soft-success text-uppercase">On Going Occassion</span></a>';
                                                    break;
                                                case ("Up Comming Occassion"):
                                                return '<a href="{{route("admin.viewSepcialOccasion","")}}/'+row.id+'"><span class="badge badge-soft-primary text-uppercase">Up Comming Occassion</span></a>';
                                                    break;
                                                case ("Occassion Ended"):
                                                return '<a href="{{route("admin.viewSepcialOccasion","")}}/'+row.id+'"><span class="badge badge-soft-danger text-uppercase">Occassion Ended</span></a>';
                                                    break;

                                                default:
                                                    return '<a href="{{route("admin.viewSepcialOccasion","")}}/'+row.id+'"><span class="badge badge-soft-danger text-uppercase">no status found</span></a>';
                                                    break;
                                            }
                                        },
                                    },

                                    {
                                        "data": "is_active",
                                        "render": function ( data, type, row ) {
                                            if(data == 1){
                                                return '<a href="{{route("admin.viewSepcialOccasion","")}}/'+row.id+'"><span class="badge badge-soft-success text-uppercase">Active</span></a>';
                                            }else{
                                                return '<a href="{{route("admin.viewSepcialOccasion","")}}/'+row.id+'"><span class="badge badge-soft-danger text-uppercase">Not Active</span></a>';
                                            }
                                        },
                                    },

                                    {   "data": "id",
                                    "render": function(data,type,row)
                                    {
                                        return '<li class="list-inline-item edit"><a href="{{route("admin.viewSepcialOccasion","")}}/'+row.id+'" data-id="'+row.id+'" class="text-primary d-inline-block edit-btn"><i class="ri-eye-fill fs-16"></i></a></li><li class="list-inline-item edit"><a href="{{route("admin.editSepcialOccasion","")}}/'+row.id+'" data-id="'+row.id+'" class="text-primary d-inline-block edit-btn"><i class="ri-pencil-fill fs-16"></i></a></li><li class="list-inline-item"><a class="text-danger d-inline-block remove-item-btn"  data-id="'+row.id+'" href="javascript:void(0)"><i class="ri-delete-bin-5-fill fs-16"></i></a></li>';
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
                                    "className": "text-center avatar-sm bg-light rounded p-1 w-6rem",
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
            language: {
                            url: '@if (session()->get('locale') == 'ar') {{asset('js/Arabic.json')}} @elseif(session()->get('locale') == 'fr') {{asset('js/French.json')}} @endif'
                        }
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
                url: "{{ route('admin.destroySepcialOccasion', '') }}" + "/" + id,
                data: data,
                success: function(response) {
                    swal(response.status, {
                        icon: "success",
                        timer: 3000,
                    })
                    .then((result) => {
                        window.location =
                        '{{ route('admin.specialOccasionList') }}'
                    });
                }
                });
            }
            });
        });
    });
</script>
@endsection
