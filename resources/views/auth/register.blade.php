@extends('layouts.app')

@section('content')

<!-- HK Wrapper -->
<div class="hk-wrapper">

    <!-- Main Content -->
    <div class="hk-pg-wrapper hk-auth-wrapper">
        <header class="d-flex justify-content-between align-items-center">
            <a class="navbar-brand font-22 text-white" href="dashboard1.html">
                <img class="brand-img d-inline-block mr-5" src="dist/img/logo.png" alt="brand" />
                EverHost
            </a>
            {{--<div class="btn-group btn-group-sm">
                <a href="#" class="btn btn-outline-secondary">Help</a>
                <a href="#" class="btn btn-outline-secondary">About Us</a>
            </div>--}}
        </header>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-5 pa-0">
                    <div class="auth-cover-img overlay-wrap" style="background-image:url(dist/img/bg.jpg);">
                        <div class="auth-cover-info py-xl-0 pt-100 pb-50">
                            <div class="auth-cover-content w-xxl-75 w-sm-90 w-100">
                                <h1 class="display-3 text-white mb-20">Enjoy unlimited beautiful display content area</h1>
                                <p class="text-white">The passage experienced a surge in popularity during the 1960s when Letraset used it on their dry-transfer sheets, and again during the 90s as desktop publishers bundled the text with their software.</p>
                                <div class="play-wrap">
                                    <a class="play-btn" href="#"></a>
                                    <span>How it works ?</span>
                                </div>
                            </div>
                        </div>
                        <div class="bg-overlay bg-trans-dark-50"></div>
                    </div>
                </div>
                <div class="col-xl-7 pa-0">
                    <div class="auth-form-wrap py-xl-0 py-50">
                        <div class="auth-form w-xxl-55 w-xl-75 w-sm-90 w-100">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <h1 class="display-4 mb-10">Sign up for free</h1>
                                <p class="mb-30">Create your account and start your free trial today</p>
                                <div class="form-group">
                                    <input id="name" type="text" placeholder="Name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input id="email" type="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input id="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input id="password-confirm" type="password" placeholder="Confirm Password" class="form-control" name="password_confirmation" required autocomplete="new-password">
{{--                                        <div class="input-group-append">--}}
{{--                                            <span class="input-group-text"><span class="feather-icon"><i data-feather="eye-off"></i></span></span>--}}
{{--                                        </div>--}}
                                    </div>
                                </div>
{{--                                <div class="custom-control custom-checkbox mb-25">--}}
{{--                                    <input class="custom-control-input" id="same-address" type="checkbox">--}}
{{--                                    <label class="custom-control-label font-14" for="same-address">I have read and agree to the <a href=""><u>term and conditions</u></a></label>--}}
{{--                                </div>--}}
                                <button class="btn btn-gradient-danger btn-block" type="submit">Register</button>
                                <div class="option-sep">or</div>
{{--                                <div class="form-row">--}}
{{--                                    <div class="col-sm-6 mb-20">--}}
{{--                                        <button class="btn btn-indigo btn-block btn-wth-icon"> <span class="icon-label"><i class="fa fa-facebook"></i> </span><span class="btn-text">Login with facebook</span></button>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-sm-6 mb-20">--}}
{{--                                        <button class="btn btn-sky btn-block btn-wth-icon"> <span class="icon-label"><i class="fa fa-twitter"></i> </span><span class="btn-text">Login with Twitter</span></button>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <p class="text-center">Already have an account? <a href="{{ route('login') }}">Sign In</a></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Main Content -->

</div>
<!-- /HK Wrapper -->

@include('layouts.partials._script')

@endsection
