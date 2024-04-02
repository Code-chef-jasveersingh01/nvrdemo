@extends('layouts.admin.layout')
@section('title')
    {{__('main.all_order_list')}}
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
@slot('li_1') {{__('main.order_report')}} @endslot
@slot('title') {{__('main.reports')}} @endslot
@slot('link') {{ route('admin.allOrderList')}} @endslot
@endcomponent
    <x-list_view>
        <x-slot name="search_label">
            <div class="row g-3">
                <div class="col-xxl-4 col-sm-6">
                    <div class="search-box">
                        <input type="text" name="filter_search_key" id="filter_search_key" class="form-control search" placeholder="{{__('main.search')}}">
                        <i class="ri-search-line search-icon"></i>
                    </div>
                </div>
                <div class="col-xxl-4 col-sm-4">
                    <div class="date-range">
                        <input type="text" class="form-control" name="filter_date" placeholder="Select Date Range" id="filter_date" data-provider="flatpickr" data-maxDate="today" data-date-format="Y-m-d" data-range-date="true" data-altFormat="F j, Y">
                    </div>
                </div>
                <!--end col-->
                <div class="col-xxl-2 col-sm-4">
                    <div class="form-group">
                        <select class="form-control" name="filter_status" id="filter_status">
                            <option value="all">{{__('main.all')}}</option>
                            @if (count($statusList))
                                @foreach ($statusList as $statusListItem)
                                    <option value="{{$statusListItem->id}}">{{$statusListItem->name}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="col-xxl-2 col-sm-4">
                    <div class="d-flex">
                        <button type="button" id="search_filter" class="btn btn-primary w-100 mx-1" ><i class="ri-equalizer-fill me-1 align-bottom"></i></button>
                        <button type="button" id="reset_filter" class="btn btn-success w-100 mx-1"><i class="ri-refresh-line me-1 align-bottom"></i></button>
                        <button type="button" title="{{ __('main.download') }}" class="btn btn-info w-100 mx-1" data-bs-toggle="modal" data-bs-target="#downloadOrderDetailseModal"><i class="ri-file-download-line align-bottom me-1"></i> </button>
                    </div>
                </div>
                <!--end col-->
            </div>
        </x-slot>
        <x-slot name="card_heard"> {{__('main.orders')}} </x-slot>
        <x-slot name="table_id"> orderListTable </x-slot>
        <x-slot name="table_th">
            <th>{{ __('main.order_id') }}</th>
            <th>{{ __('main.order_items') }} </th>
            <th>{{ __('main.order_amount') }} </th>
            <th>{{ __('main.order_date') }} </th>
            <th>{{ __('main.order_status') }} </th>
            <th>{{ __('main.payment_status') }} </th>
            <th>{{ __('main.original_price') }} </th>
            <th>{{ __('main.selling_price') }} </th>
            <th>{{ __('main.profit') }} </th>
            <th>{{ __('main.profit_percentage') }} (%) </th>
        </x-slot>
    </x-list_view>
    @include('admin.component.modal.order.download_order_details_modal')
@endsection
@section('script')
@include('layouts.admin.scripts.Datatables_scripts')
<script>
    $(document).ready(function () {
        $('#orderListTable').DataTable({
            'paging'        : true,
            'lengthChange'  : false,
            'searching'     : false,
            'ordering'      : true,
            'info'          : true,
            'autoWidth'     : false,
            "processing"    : true,
            "serverSide"    : true,
            "ajax"          : {
                                "url": "{!! route('dataTable.dataTableOrderListReport') !!}",
                                "type": "GET",
                                "data": function ( d ) {
                                    d.filterSearchKey = $("#filter_search_key").val();
                                    d.filterStatus = $("#filter_status").val();
                                    d.filterDate = $("#filter_date").val();
                                }
                            },
            "columns"       : [
                                  {   "data": "id",
                                      "render": function(data,type,row)
                                      {
                                        return data;
                                      }
                                  },
                                  {   "data": "id",
                                      "render": function(data,type,row)
                                      {
                                          return row.order_items_count;
                                      }
                                  },
                                  {   "data": "total_amount"},
                                //   {   "data": "discount_amount"},
                                //   {   "data": "applied_coupon"},
                                  {   "data": "order_date",
                                      "render": function(data,type,row)
                                      {
                                        return row.order_date
                                      }
                                  },
                                  {   "data": "order_status",
                                      "render": function(data,type,row)
                                      {
                                        return row.order_status.name.en;
                                      }
                                  },
                                  {   "data": "payment_status",
                                      "render": function(data,type,row)
                                      {
                                        return row.payment_status.name.en;
                                      }
                                  },
                                  {   "data": "original_price",
                                      "render": function(data,type,row)
                                      {
                                        return row.original_price;
                                      }
                                  },
                                  {   "data": "selling_price",
                                      "render": function(data,type,row)
                                      {
                                        return row.selling_price;
                                      }
                                  },
                                  {   "data": "profit",
                                      "render": function(data,type,row)
                                      {
                                        return row.profit;
                                      }
                                  },
                                  {   "data": "profit_percentage",
                                      "render": function(data,type,row)
                                      {
                                        return row.profit_percentage;
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
                                    "className": "text-center",
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

        $('.download').click(function(e) {
            e.preventDefault();
            var downloadType = $(this).attr('data-download-type');
            var orderStatus = $("#filter_status").val();
            $('#download_type').val(downloadType);
            $('#order_status').val(orderStatus);
            $('form#downloadOrderDetailseForm').submit();
        });
    });

    // setInterval( function () {
    //   $('#orderListTable').DataTable().ajax.reload( null, false);
    // }, 10000 );

    $("#search_filter").click(function (e) {
      e.preventDefault();
      $('#orderListTable').DataTable().ajax.reload();
      });

    $("#reset_filter").click(function (e) {
        e.preventDefault();
        $('#filter_search_key').val('');
        $('#filter_date').val('');
        $('#filter_status').prop('selectedIndex',0);
        $('#orderListTable').DataTable().ajax.reload();
        location.reload();
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
