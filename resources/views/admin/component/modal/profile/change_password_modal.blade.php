 <div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="changePasswordModal"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('main.change_password')}}</h5>
                <button class="btn-close" type="button" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" id="changePasswordForm" action="{{route('admin.updatePassword')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="row gx-3 mb-3">
                        <div class="col-md-12">
                            <input class="form-control mb-2" id="old-password" name="old_password" type="password" placeholder="{{__('main.old_password')}}" required autofocus>
                        </div>
                        <div class="col-md-12">
                            <input class="form-control mb-2" id="new-password" name="password" type="password" placeholder="{{__('main.new_password')}}" required autofocus>
                        </div>
                        <div class="col-md-12">
                            <input class="form-control mb-2" id="password-confirm" name="password_confirmation" type="password" placeholder="{{__('main.retype_password')}}" required autofocus>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" type="button" data-dismiss="modal">{{__('main.close')}}</button>
                <button class="btn btn-primary" type="submit" data-dismiss="modal" form="changePasswordForm">{{__('main.update')}}</button>
            </div>
        </div>
    </div>
</div>
