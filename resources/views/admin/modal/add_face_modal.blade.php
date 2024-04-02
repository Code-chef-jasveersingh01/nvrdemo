 <div class="modal fade" id="addFaceModal" tabindex="-1" role="dialog" aria-labelledby="addFaceModal"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addFaceModalLabel">{{__('main.add_face')}}</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" id="changePasswordForm" action="{{route('admin.addFace')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="row gx-3 mb-3">
                        <div class="col-md-12">
                            <label for="name" class="form-label fs-4 ">{{__('main.name')}}</label>
                            <input type="text"  class="form-control @error('name') is-invalid @enderror" value="" id="name" name="name" placeholder="Enter name">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label for="email" class="form-label fs-4 ">{{__('main.email')}}</label>
                            <input type="email"  class="form-control @error('email') is-invalid @enderror" value="" id="email" name="email" placeholder="Enter email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label for="phone" class="form-label fs-4 ">{{__('main.phone')}}</label>
                            <input type="number"  class="form-control @error('phone') is-invalid @enderror" value="" id="phone" name="phone" placeholder="Enter phone">
                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-md-7 ">
                                    <label for="image" class="form-label fs-4">{{__('main.upload_image')}}</label>
                                    <input type="file" class="form-control" id="image" name="image">

                            </div>
                            <div class="col-md-5 mt-4 pt-4">
                                <div class=" d-flex justify-content-around">
                                    <label class="form-check-label ">
                                        <input type="radio" class="" name="uploadOption" value="fromComputer" checked>
                                        {{__('main.upload_from_pc')}}
                                    </label>
                                    <br>
                                    <label class="form-check-label">
                                        <input type="radio" name="uploadOption" value="fromWebcam">
                                        {{__('main.take_picture')}}
                                    </label>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">{{__('main.close')}}</button>
                <button class="btn btn-primary" type="submit" data-dismiss="modal" form="changePasswordForm">{{__('main.add')}}
                </button>

            </div>
        </div>
    </div>
</div>
