<div class="modal fade" id="adminProfileImageUpdateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{__('main.update_profile_image')}}</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
        </button>
      </div>
      <div class="modal-body">
        <form class="form" method="POST" action="{{route('admin.updateProfileImage')}}" id="updateProfileImage" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <input type="file" name="image" required class="dropify" accept="image/png, image/jpeg, image/jpg" data-default-file="{{isset(Auth::user()->profile_image) && !empty(Auth::user()->profile_image)? Auth::user()->profile_image:''}}">
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">{{__('main.close')}}</button>
        <button type="submit" class="btn btn-primary" form="updateProfileImage">{{__('main.update')}}</button>
      </div>
    </div>
  </div>
</div>
