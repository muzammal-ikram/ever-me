@extends('layouts.app')

@section('content')

<!-- HK Wrapper -->
<div class="hk-wrapper">

    <!-- Main Content -->
    <div class="hk-pg-wrapper hk-auth-wrapper">
        <header class="d-flex justify-content-between align-items-center">
            <a class="navbar-brand font-22 text-white" href="#">
                <img class="brand-img d-inline-block mr-5" src="dist/img/logo.png" alt="brand" />
            </a>
            {{--<div class="btn-group btn-group-sm">
                <a href="#" class="btn btn-outline-secondary">Help</a>
                <a href="#" class="btn btn-outline-secondary">About Us</a>
            </div>--}}
        </header>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-5 pa-0">
                    <div id="owl_demo_1" class="owl-carousel dots-on-item owl-theme">
                        <div class="fadeOut item auth-cover-img overlay-wrap" style="background-image:url(dist/img/bg.jpg);">
                            {{--<div class="auth-cover-info py-xl-0 pt-100 pb-50">
                                <div class="auth-cover-content text-center w-xxl-75 w-sm-90 w-xs-100">
                                    <h1 class="display-3 text-white mb-20">Understand and look deep into nature.</h1>
                                    <p class="text-white">The purpose of lorem ipsum is to create a natural looking block of text (sentence, paragraph, page, etc.) that doesn't distract from the layout. Again during the 90s as desktop publishers bundled the text with their software.</p>
                                </div>
                            </div>--}}
                            <div class="bg-overlay bg-trans-dark-50"></div>
                        </div>
                        {{--<div class="fadeOut item auth-cover-img overlay-wrap" style="background-image:url(dist/img/house_3.jpg);">
                            <div class="auth-cover-info py-xl-0 pt-100 pb-50">
                                <div class="auth-cover-content text-center w-xxl-75 w-sm-90 w-xs-100">
                                    <h1 class="display-3 text-white mb-20">Experience matters for good applications.</h1>
                                    <p class="text-white">The passage experienced a surge in popularity during the 1960s when Letraset used it on their dry-transfer sheets, and again during the 90s as desktop publishers bundled the text with their software.</p>
                                </div>
                            </div>
                            <div class="bg-overlay bg-trans-dark-50"></div>
                        </div>--}}
                    </div>
                </div>
                <div class="col-xl-7 pa-0">
                    <div class="auth-form-wrap py-xl-0 py-50">
                        <div class="auth-form w-xxl-55 w-xl-75 w-sm-90 w-xs-100">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <h1 class="display-4 mb-10">Welcome Beta Users!</h1>
                                <p class="mb-30">Create an account and get your free digital property guide.</p>
                                <div class="form-group">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email" required autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input id="password" type="password" placeholder="Password" class="form-control  @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror

{{--                                        <input class="form-control" placeholder="Password" type="password">--}}
{{--                                        <div class="input-group-append">--}}
{{--                                            <span class="input-group-text"><span class="feather-icon"><i data-feather="eye-off"></i></span></span>--}}
{{--                                        </div>--}}
                                    </div>
                                </div>
                                <div class="custom-control custom-checkbox mb-25 custom_container">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') !== null ? 'checked' : '' }}>
                                    <label class="custom-control-label font-14 checkmark" for="remember">Keep me logged in</label>
                                </div>
                                <button type="submit" class="btn btn-gradient-danger btn-block">
                                    Login
                                </button>
                                @if (Route::has('password.request'))
                                    <a class="font-14 text-center mt-15" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif

                                <div class="option-sep">or</div>
{{--                                <div class="form-row">--}}
{{--                                    <div class="col-sm-6 mb-20">--}}
{{--                                        <button class="btn btn-indigo btn-block btn-wth-icon"> <span class="icon-label"><i class="fa fa-facebook"></i> </span><span class="btn-text">Login with facebook</span></button>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-sm-6 mb-20">--}}
{{--                                        <button class="btn btn-sky btn-block btn-wth-icon"> <span class="icon-label"><i class="fa fa-twitter"></i> </span><span class="btn-text">Login with Twitter</span></button>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <p class="text-center">Do have an account yet? <a href="{{ route('register') }}">Sign Up</a></p>
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
