@extends('layouts.admin.layout')
@section('title')
{{__('main.list_types')}}
@endsection
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        {{__('main.list_types')}}
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover" width="100%" cellspacing="0" id="listTypes">
                <thead class="">
                    <tr>
                        <th style="text-center">{{__('main.id')}}</th>
                        <th style="width: 30%">{{__('main.title')}}</th>
                        <th style="width: 30%">{{__('main.key')}}</th>
                        <th class="text-center" style="width: 25%">{{__('main.is_active')}}</th>
                        <th class="text-center" style="width: 25%">{{__('main.action')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($lockupTypes as $key=>$lockupType)
                        <tr class="hover-primary">
                            <td>
                               {{$lockupType->id}}
                            </td>
                            <td>
                               {{$lockupType->name}}
                            </td>
                            <td>
                                {{$lockupType->key}}
                             </td>
                            <td class="text-center">
                                @if ($lockupType->is_active)
                                    <div class="badge bg-success text-white rounded-pill">{{__('main.active')}}</div>
                                @else
                                    <div class="badge bg-danger text-white rounded-pill">{{__('main.in_active')}}</div>
                                @endif
                            </td>
                            <td class="text-center">
                                <a class="text-primary d-inline-block edit-btn" href="{{route('admin.showListType', $lockupType->id)}}"><i class="ri-eye-fill fs-16"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('javascript')
<script>
    $(document).ready(function () {
        $('#listTypes').DataTable({
            'paging'        : true,
            'lengthChange'  : false,
            'searching'     : false,
            'ordering'      : true,
            'info'          : true,
            'autoWidth'     : false,
            "processing"    : false,
            "serverSide"    : false,
            language: {
                            url: '@if (session()->get('locale') == 'ar') {{asset('js/Arabic.json')}} @elseif(session()->get('locale') == 'fr') {{asset('js/French.json')}} @endif'
                        }
        });
    });
</script>
@endsection
