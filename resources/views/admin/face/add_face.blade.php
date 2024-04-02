@extends('layouts.admin.layout')
@section('title')
    {{__('main.add_face')}}
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
@slot('li_1') {{__('main.index')}} @endslot
@slot('title') {{__('main.add_face')}} @endslot
@endcomponent
 <!-- Session Status -->
 <x-auth-session-status class="mb-4" :status="session('status')" />
<div class="col-sm-12 ">

        <form class="bg-white p-2" action="{{ route('admin.addFace') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row gx-3 mb-3">
                <div class="col-sm-6 ">
                    <div class="mb-4 ">
                        <label for="name" class="form-label fs-4 ">{{__('main.name')}}</label>
                        <input type="text"  class="form-control @error('name') is-invalid @enderror" value="" id="name" name="name" placeholder="Enter name">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-4 ">
                        <label for="email" class="form-label fs-4 ">{{__('main.email')}}</label>
                        <input type="email"  class="form-control @error('email') is-invalid @enderror" value="" id="email" name="email" placeholder="Enter email">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-4 ">
                        <label for="phone" class="form-label fs-4 ">{{__('main.phone')}}</label>
                        <input type="number"  class="form-control @error('phone') is-invalid @enderror" value="" id="phone" name="phone" placeholder="Enter phone">
                        @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="image" class="form-label fs-4">{{__('main.upload_image')}}</label>
                        <input type="file" class="form-control" id="image" name="image">
                    </div>
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
                <div class="col-sm-6 ">

                    <!-- Display image preview -->
                    <div class="image-preview-container text-center ">
                        <h4>Image Preview</h4>
                        <img id="imagePreview" class="d-none" width="150px" height="150px"  src="">
                    </div>
                    <div class="d-flex justify-content-around align-items-end">
                        <video id="webcamStream" class="w-50" autoplay></video>
                        <button class="d-none btn btn-primary mb-8" id="captureButton">Capture</button>
                    </div>
                    <input type="hidden" id="webCapturedImage" name="webCapturedImage" src="" value="">
                </div>

                <div class="col-sm-12">
                    <div class="hstack gap-2 justify-content-end">
                        <button class="btn btn-success w-10 fs-4" type="submit">{{__('main.add')}}</button>
                    </div>
                </div>
            </div>
        </form>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function() {
    var imageInput = $('#image');
    var webcamStream = $('#webcamStream');
    var captureButton = $('#captureButton');
    var imagePreview = $('#imagePreview');
    var webCapturedImage = $('#webCapturedImage');


   // Handle radio button change
    $('input[name="uploadOption"]').change(function() {
        if ($(this).val() === 'fromWebcam') {
            activateWebcam();
        } else {
            deactivateWebcam();
        }
    });

    // Activate webcam
    function activateWebcam() {
        navigator.mediaDevices.getUserMedia({ video: true })
            .then(function(stream) {
                imagePreview.prop('src', '');
                imagePreview.addClass('d-none');
                webcamStream.removeClass('d-none');
                webcamStream.prop('srcObject', stream);
                captureButton.removeClass('d-none');
            })
            .catch(function(error) {
                console.error('Error accessing webcam:', error);
            });
    }

    // Deactivate webcam
    function deactivateWebcam() {
        var stream = webcamStream.prop('srcObject');
        if (stream) {
            var tracks = stream.getTracks();
            tracks.forEach(function(track) {
                track.stop();
            });
            webcamStream.prop('srcObject', null);
            captureButton.addClass('d-none');
            webcamStream.prop('srcObject', '');
            webcamStream.addClass('d-none');
        }
    }

    // Handle file selection from computer
    imageInput.change(function() {
        var selectedFile = $(this).prop('files')[0];
        if (selectedFile) {
            webcamStream.addClass('d-none');
            imagePreview.removeClass('d-none');
            imagePreview.prop('src', URL.createObjectURL(selectedFile));
        }
    });

    // Handle capture button click (from webcam)
    captureButton.click(function(e) {
        e.preventDefault();
        var canvas = $('<canvas></canvas>')[0];
        var context = canvas.getContext('2d');
        canvas.width = webcamStream.prop('videoWidth');
        canvas.height = webcamStream.prop('videoHeight');
        context.drawImage(webcamStream[0], 0, 0, canvas.width, canvas.height);
        var capturedImage = canvas.toDataURL('image/jpeg');
        webcamStream.addClass('d-none');
        webCapturedImage.prop('value', capturedImage);
        imagePreview.removeClass('d-none');
        imagePreview.prop('src', capturedImage);
        deactivateWebcam();
    });
});

</script>
@endsection

