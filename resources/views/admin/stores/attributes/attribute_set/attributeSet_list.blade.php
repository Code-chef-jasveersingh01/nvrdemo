@extends('layouts.admin.layout')
@section('title')
{{__('main.attribute_set_list')}}
@endsection
@section('content')
<div class="content-header">
    <div class="d-flex align-items-center">
        <div class="me-auto">
            <h4 class="page-title">{{__('main.attribute_set')}}</h4>
            <div class="d-inline-block align-items-center">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin.attributeSetList')}}"><i class="mdi mdi-home-outline"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{__('main.index')}}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="d-grid gap-2 d-md-flex justify-content-md-end">
    <a href="{{route('admin.createAttributeSet')}}" class="waves-effect waves-light btn btn-primary mb-5"><i class="fa fa-plus" aria-hidden="true"></i> {{__('main.add')}} {{__('main.attribute_set')}}</a>
  </div>
  <section class="content">
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-10">
                            <div class="form-group">
                                <label class="form-label">{{ __('main.search') }}</label>
                                <input type="text" name="filter_search_key" id="filter_search_key"
                                    class="form-control" placeholder="{{ __('main.search') }}">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <button type="button" id="search_filter" class="btn btn-primary"
                                    style="margin-top: 30px;" title="{{ __('main.search') }}"><i
                                        class="fa fa-search"></i></button>
                                <button type="button" id="reset_filter" class="btn btn-success"
                                    style="margin-top: 30px;" title="{{ __('main.reset') }}"><i
                                        class="fa fa-refresh"></i></button>
                            </div>
                        </div>
                        <div class="table-responsive rounded card-table">
                            <table class="table border-no" id="attributeSetTable">
                                <thead>
                                    <tr>
                                        <th>{{ __('main.name') }}</th>
                                        <th> </th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('javascript')
<script>
    $(document).ready(function () {
        $('#attributeSetTable').DataTable({
            'paging'        : true,
            'lengthChange'  : false,
            'searching'     : false,
            'ordering'      : true,
            'info'          : true,
            'autoWidth'     : false,
            "processing"    : true,
            "serverSide"    : true,
            "ajax"          : {
                                "url": "{!! route('dataTable.dataTableAttributeSetTable') !!}",
                                "type": "GET",
                                "data": function ( d ) {
                                    d.filterSearchKey = $("#filter_search_key").val();
                                }
                            },
            "columns"       : [
                                {   "data": "name",
                                    "render":function(data,type,row){
                                        return '<a href="{{route("web.viewAttributeSet","")}}/'+row.id+'">'+row.name+'</a>';
                                    }
                                },
                                {
                                    "data":"id",
                                    "render":function(data,type,row){
                                        return '<div class="btn-group"><a class="hover-primary dropdown-toggle no-caret" data-bs-toggle="dropdown"><i class="fa fa-ellipsis-h"></i></a><div class="dropdown-menu"><a class="dropdown-item" href="{{route("web.viewAttributeSet","")}}/'+row.id+'">{{__('main.editDetails')}}</a></div></div>';
                                    }
                                }
                              ],
            'columnDefs': [
                            {
                                    "targets": 1,
                                    "className": "text-center",
                                    "width": "2%"
                            }

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
