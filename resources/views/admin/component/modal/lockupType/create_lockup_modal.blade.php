<div id="createLockupModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">{{__('main.add_item')}}</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form" method="POST" action="{{route('admin.storeListItem')}}" id="createItem">
                    @csrf
                    <input type="hidden" name="lockup_type_id" value="{{$lockupType->id}}">
                    <div class="box-body">
                        <div class="form-group">
                            <label class="small mb-1">{{__('main.name')}}
                            </label>
                            <div class="input-group mb-3">
                                <input type="text" name="name" class="form-control" placeholder="{{__('main.name')}}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="small mb-1">{{__('main.other')}} <span class="form-text-ext text-muted"><code>{{__('main.optional')}}</code></span></label>
                            <div class="input-group mb-3">
                                <input type="text" name="other" class="form-control" placeholder="{{__('main.other')}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="is_active" id="md_checkbox_21" class="filled-in chk-col-primary" checked="">
                            <label for="md_checkbox_21">{{__('main.is_active')}}</label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">{{__('main.close')}}</button>
                <button type="submit" class="btn btn-primary float-end" form="createItem">{{__('main.save')}}</button>
            </div>
        </div>
    </div>
</div>
