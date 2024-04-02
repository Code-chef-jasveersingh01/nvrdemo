@extends('layouts.auth')
@section('title')
    @lang('main.sign_in')
@endsection
@section('content')

    <!-- auth-page wrapper -->
    <div class="auth-page-wrapper auth-bg-cover py-5 d-flex justify-content-center align-items-center min-vh-100">
        <div class="bg-overlay"></div>
        <!-- auth-page content -->
        <div class="auth-page-content overflow-hidden pt-lg-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card overflow-hidden">
                            <div class="row g-0">
                                <div class="col-lg-6">
                                    <div class="p-lg-5 p-4 auth-one-bg h-100">
                                        {{-- <div class="bg-overlay"></div> --}}
                                        <div class="position-relative h-100 d-flex flex-row justify-content-center">
                                            {{-- <div class="mt-5"> --}}
                                                {{-- <img src="{{ URL::asset('assets/images/logo.svg') }}" alt="" height="auto" width="auto"> --}}
                                            {{-- </div> --}}
                                            {{-- <div class="mt-auto"> --}}
                                                {{-- <div class="mb-3">
                                                    <i class="ri-double-quotes-l display-4 text-success"></i>
                                                </div> --}}

                                                {{-- <div id="qoutescarouselIndicators" class="carousel slide"
                                                    data-bs-ride="carousel">
                                                    <div class="carousel-indicators">
                                                        <button type="button" data-bs-target="#qoutescarouselIndicators"
                                                            data-bs-slide-to="0" class="active" aria-current="true"
                                                            aria-label="Slide 1"></button>
                                                        <button type="button" data-bs-target="#qoutescarouselIndicators"
                                                            data-bs-slide-to="1" aria-label="Slide 2"></button>
                                                        <button type="button" data-bs-target="#qoutescarouselIndicators"
                                                            data-bs-slide-to="2" aria-label="Slide 3"></button>
                                                    </div>
                                                    <div class="carousel-inner text-center text-white-50 pb-5">
                                                        <div class="carousel-item active">
                                                            <p class="fs-15 fst-italic">" Great! Clean code, clean design,
                                                                easy for customization. Thanks very much! "</p>
                                                        </div>
                                                        <div class="carousel-item">
                                                            <p class="fs-15 fst-italic">" The theme is really great with an
                                                                amazing customer support."</p>
                                                        </div>
                                                        <div class="carousel-item">
                                                            <p class="fs-15 fst-italic">" Great! Clean code, clean design,
                                                                easy for customization. Thanks very much! "</p>
                                                        </div>
                                                    </div>
                                                </div> --}}
                                                <!-- end carousel -->
                                            {{-- </div> --}}
                                        </div>
                                    </div>
                                </div>
                                <!-- end col -->

                                <div class="col-lg-6">
                                    <div class="p-lg-5 p-4">
                                        <div>
                                            <h2 class="text-primary">Welcome Back !</h2>
                                            <p class="text-muted fs-4"><strong>Sign in to continue to ecommerce.</strong></p>
                                        </div>

                                        <div class="mt-4">
                                            <form action="{{ route('login') }}" method="POST">
                                                @csrf
                                                <div class="mb-4">
                                                    <label for="username" class="form-label fs-4">Username</label>
                                                    <input type="text" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" id="username" name="email" placeholder="Enter username">
                                                    @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <div class="float-end">
                                                        <a href="auth-pass-reset-basic" class="text-muted fs-5">{{__('main.forgot_password?')}}</a>
                                                    </div>
                                                    <label class="form-label fs-4" for="password-input">{{__('main.password')}}</label>
                                                    <div class="position-relative auth-pass-inputgroup mb-3">
                                                        <input type="password" class="form-control pe-5 @error('password') is-invalid @enderror" name="password" placeholder="Enter password" id="password-input">
                                                        <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                                        @error('password')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="auth-remember-check">
                                                    <label class="form-check-label" for="auth-remember-check">{{__('main.remember_me')}}</label>
                                                </div>

                                                <div class="mt-4">
                                                    <button class="btn btn-success w-100 fs-4" type="submit">{{__('main.sign_in')}}</button>
                                                </div>

                                                <div class="mt-4 text-center">
                                                    <div class="signin-other-title">
                                                        {{-- <h5 class="fs-13 mb-4 title">Sign In with</h5> --}}
                                                        <h5 class="fs-13 mb-4 title"></h5>
                                                    </div>
                                                    <div class="mt-5 text-center">
                                                        {{-- <button type="button" class="btn"></button>
                                                        <button type="button" class="btn"></button>
                                                        <button type="button" class="btn"></button>
                                                        <button type="button" class="btn"></button> --}}
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                        <div class="mt-5 text-center">
                                            {{-- <p class="mb-0">Don't have an account ? <a
                                                    href="auth-signup-cover"
                                                    class="fw-semibold text-primary text-decoration-underline"> Signup</a>
                                            </p> --}}
                                        </div>
                                    </div>
                                </div>
                                <!-- end col -->
                            </div>
                            <!-- end row -->
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->

                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->

        <!-- footer -->
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            @
                            <script>
                                document.write(new Date().getFullYear())
                            </script> Admin Panel Crafted by HangingPanda</p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->
    </div>
    <!-- end auth-page-wrapper -->

@endsection
@section('script')
    <script src="{{ URL::asset('assets/js/pages/password-addon.init.js') }}"></script>
@endsection
