<div class="modal fade" id="editLockupModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('main.update_item')}}</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form" method="POST" action="" id="lockupEdit">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label  class="small mb-1">{{__('main.name')}} </label>
                            <div class="input-group mb-3">
                                <input type="text" name="edit_name" id="edit_name" class="form-control" placeholder="{{__('main.name')}}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label  class="small mb-1">{{__('main.other')}} <span class="form-text-ext text-muted"><code>({{__('main.optional')}})</code></span></i></label>
                            <div class="input-group mb-3">
                                <input type="text" name="edit_other" id="edit_other" class="form-control" placeholder="{{__('main.other')}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="edit_is_active" id="edit_is_active" class="filled-in chk-col-primary">
                            <label for="edit_is_active">{{__('main.is_active')}}</label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">{{__('main.close')}}</button>
                <button type="submit" class="btn btn-primary" form="lockupEdit">{{__('main.update')}}</button>
            </div>
        </div>
    </div>
</div>
