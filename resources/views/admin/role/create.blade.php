@extends('layouts.admin.layout')
@section('title')
{{ __('main.create_product')}}
@endsection
@section('css')
    <link rel="stylesheet" href={{asset("assets/css/dropify.css")}}>
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') {{__('main.create')}} @endslot
@slot('title') {{__('main.roles')}} @endslot
@slot('link') {{route('admin.roleList')}} @endslot
@endcomponent
<div class="row">
	<div class="col-xxl-12">
		<div class="card shadow-sm">
			<div class="card-body">
				<form method="POST" action="{{ route('admin.storeRole') }}" id="storeRole">
					@csrf
					<div class="row">
						<div class="col-lg-12">
							<div class="mb-3">
								<label for="role_name" class="form-label">{{__('main.role_name')}}</label>
								<input type="text" class="form-control @error('role_name') is-invalid @enderror" id="role_name" name="role_name" value="{{ old('role_name') }}" placeholder="{{__('main.Enter Role Name')}}" required>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="row">
								@if (!empty($permission['allGroups']))
								@foreach ($permission['allGroups'] as $key => $group)
								@if (!empty($permission['allPermissionsLists']))
								@php
								$allPermissionsLists = $permission['allPermissionsLists']
                                    ->filter(function ($item) use ($group) {
                                        if ($item->group == $group) {
                                            return $item;
                                        }
                                    })
								->values();
								$group_check_status = false;
								foreach ($allPermissionsLists as $key => $allPermissionsList){
                                    if (in_array($allPermissionsList->id, $permission['rolePermissions'])){
                                        $group_check_status = true;
                                        break;
                                    }
								}
								@endphp
								<div class="col-lg-4 col-md-4 col-sm-4">
									<div class="form-group">
										<ul style="list-style-type: none; padding-inline-start: 0px;">
											<li>
												<div class="form-check mb-1">
													<input class="select_group form-check-input" id="list-group-{{$group}}" type="checkbox" data-group-name="{{preg_replace('/\s+/','',$group)}}" {{$group_check_status ? "checked" : ''}}>
													<label class="form-check-label fw-semibold" for="list-group-{{$group}}">{{ ucwords($group) }} </label>
												</div>
												<ul style="list-style-type: none;padding-left: 20px;">
													@foreach ($allPermissionsLists as $key => $allPermissionsList)
													<li>
														@if (in_array($allPermissionsList->id, $permission['rolePermissions']))
														<div class="form-check mb-1">
															<input type="checkbox" name="permission[]"  id="md_checkbox_{{ $allPermissionsList->id }}" class="form-check-input group_{{preg_replace('/\s+/','',$group)}}" checked value="{{ $allPermissionsList->id }}">
															<label class="form-check-label" for="md_checkbox_{{ $allPermissionsList->id }}">{{ $allPermissionsList->name }} </label>
														</div>
														@else
														<div class="form-check mb-1">
															<input type="checkbox" name="permission[]" id="md_checkbox_{{ $allPermissionsList->id }}" class="form-check-input group_{{preg_replace('/\s+/','',$group)}}" value="{{ $allPermissionsList->id }}">
															<label class="form-check-label" for="md_checkbox_{{ $allPermissionsList->id }}">{{ $allPermissionsList->name }} </label>
														</div>
														@endif
													</li>
													@endforeach
												</ul>
											</li>
										</ul>
									</div>
								</div>
								@endif
								@endforeach
								@endif
							</div>
						</div>
						<div class="col-lg-12">
							<div class="hstack gap-2 justify-content-end">
								<button type="submit" class="btn btn-primary">{{ __('main.save') }}</button>
								<a type="button" class="btn btn-danger" href="{{ url()->previous() }}">{{ __('main.cancel') }}</a>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
@section('script')
<script>
$(function () {
    $(".select_group").click(function(e) {
        let groupName = $(this).attr("data-group-name");
        let state = false;
        $(this).is(":checked") ? state = true : state = false;
        $(".group_"+groupName+"").each(function() {
            $(".group_"+groupName+"").prop('checked', state);
        })
    });
});
</script>
@endsection
