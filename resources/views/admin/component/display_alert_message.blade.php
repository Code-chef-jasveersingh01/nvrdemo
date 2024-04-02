{{-- @if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        @foreach ($errors->all() as $error)
        <div>* {{ $error }}</div>
        @endforeach
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>
@endif
@if (session('alert-success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('alert-success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>
@endif
@if (session('alert-error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('alert-error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>
@endif --}}
