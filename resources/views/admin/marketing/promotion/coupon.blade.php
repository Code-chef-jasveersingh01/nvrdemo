@extends('layouts.admin.layout')
@section('title') {{__('main.coupon_list')}} @endsection
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
    @slot('li_1') {{ __('main.coupon') }} @endslot
    @slot('li_2') {{ __('main.promotion') }} @endslot
    @slot('title') {{__('main.marketing')}} @endslot
    @slot('link') {{ route('admin.couponList')}} @endslot
@endcomponent
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h5 class="card-title mb-0 flex-grow-1">{{__("main.coupon")}}</h5>
                <div>
                    <a type="button" class="btn btn-secondary add-btn" href="{{route('admin.createCoupon')}}" id="create-btn">
                        <i class="ri-add-line align-bottom me-1"></i> {{__('main.create_coupon')}}
                    </a>
                </div>
            </div>
            <div class="card-body">

                <table id="all_coupon_list" class="table table-nowrap dt-responsive table-bordered display" style="width:100%">
                    <thead>
                        <tr>
                            <th>{{ __('main.id') }}</th>
                            <th>{{ __('main.coupon_option') }}</th>
                            <th>{{ __('main.coupon_rule') }}</th>
                            <th>{{ __('main.coupon_code') }}</th>
                            <th>{{ __('main.uses_per_customer') }}</th>
                            <th>{{ __('main.amount_type') }}</th>
                            <th>{{ __('main.amount') }}</th>
                            <th>{{ __('main.expiry_date') }}</th>
                            <th>{{ __('main.status') }}</th>
                            <th>{{ __('main.action')}}</th>
                        </tr>
                    </thead>
                </table>
                <!--end modal -->
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
@include('layouts.admin.scripts.Datatables_scripts')
<script>
    console.log("hello");
  $(document).ready(function (){
    $('#all_coupon_list').DataTable({
      'paging'            : true,
      'lengthChange'      : false,
      'searching'         : false,
      'ordering'          : true,
      'info'              : true,
      'autowidth'         : false,
      "processing"        : true,
      "serverSide"        : true,
      "ajax"              : {
                          "url": "{!! route('dataTable.dataTableAllCoupon') !!}",
                          "type": "GET",
                          "data": function ( d ) {
                              d.filterSearchKey = $("#filter_search_key").val();
                          }
                      },
      "columns"       : [
                          {   "data": "id",
                              "render":function(data,type,row){
                                  return '<a class="dropdown-item" href="{{route("admin.editCoupon","")}}/'+row.id+'">'+row.id+'</a>';
                              }
                          },
                          {   "data": "coupon_option",
                              "render":function(data,type,row){
                                  return '<a class="dropdown-item" href="{{route("admin.editCoupon","")}}/'+row.id+'">'+data.toUpperCase()+'</a>';
                              }
                          },
                          {   "data": "lockup",
                              "render":function(data,type,row){
                                  return '<a class="dropdown-item" href="{{route("admin.editCoupon","")}}/'+row.id+'">'+data.name.en+'</a>';
                              }
                          },
                          {   "data": "coupon_code",
                              "render":function(data,type,row){
                                  return '<a class="dropdown-item" href="{{route("admin.editCoupon","")}}/'+row.id+'">'+data.toUpperCase()+'</a>';
                              }
                          },
                          {   "data": "uses_per_customer",
                              "render":function(data,type,row){
                                  return '<a class="dropdown-item" href="{{route("admin.editCoupon","")}}/'+row.id+'">'+data+'</a>';
                              }
                          },
                          {   "data": "amount_type",
                              "render":function(data,type,row){
                                  return '<a class="dropdown-item" href="{{route("admin.editCoupon","")}}/'+row.id+'">'+data.toUpperCase()+'</a>';
                              }
                          },
                          {   "data": "amount",
                              "render":function(data,type,row){
                                if(!row.amount == 0){
                                  return '<a class="dropdown-item" href="{{route("admin.editCoupon","")}}/'+row.id+'">'+data+'</a>';
                                }else{
                                    const map = $.map(row.coupon_rule_data, function (element,i) {
                                        return element[2];
                                    });
                                    return '<a class="dropdown-item" href="{{route("admin.editCoupon","")}}/'+row.id+'">'+map+'</a>';
                                }

                              }
                          },
                          {   "data": "expiry_date",
                              "render":function(data,type,row){
                                  return '<a class="dropdown-item" href="{{route("admin.editCoupon","")}}/'+row.id+'">'+data+'</a>';
                              }
                          },
                          {   "data": "status",
                              "render":function(data,type,row){
                              if(data == 1){
                              return '<i class="fa fa-check-circle" style="color: green; font-weight: 600;"></i>';
                              }else{
                              return '<i class="fa fa-times-circle" style="color: red; font-weight: 600;"></i>';
                              }
                            },
                          },
                          {
                              "data":"id",
                              "render":function(data,type,row){
                                  return '<div class="btn-group"><a class="hover-primary dropdown-toggle no-caret" data-bs-toggle="dropdown"><i class="fa fa-ellipsis-h"></i></a><div class="dropdown-menu"><a class="dropdown-item" href="{{route("admin.editCoupon","")}}/'+row.id+'">{{__('main.editDetails')}}</a></div></div>';
                              }
                          }
                        ],
      'columnDefs': [
                      {
                              "targets": 1,
                              "className": "text-center",
                              "width": "2%"
                      },
                      {
                              "targets": 4,
                              "className": "text-center",
                              "width": "2%"
                      },
                      {
                              "targets": 6,
                              "className": "text-center",
                              "width": "2%"
                      },

                  ],

    });
  });
  $("#search_filter").click(function (d) {
        d.preventDefault();
        $('#attributeSetTable').DataTable().ajax.reload();
    });

    $("#reset_filter").click(function (d) {
        d.preventDefault();
        $('#filter_search_key').val('');
        $('#attributeSetTable').DataTable().ajax.reload();
    });
</script>
@endsection
