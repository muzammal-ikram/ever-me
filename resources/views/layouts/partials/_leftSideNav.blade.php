<!-- Vertical Nav -->
<nav class="hk-nav hk-nav-dark">
    <a href="javascript:void(0);" id="hk_nav_close" class="hk-nav-close"><span class="feather-icon"><i data-feather="x"></i></span></a>
    <div class="nicescroll-bar">
        <div class="navbar-nav-wrap">
            <ul class="navbar-nav flex-column">
                <!-- User Profile -->
                <li class="nav-item user-profile my-20">
                    <div class="media d-block">
                        <div class="media-img-wrap">
                            <div class="avatar">
                                @if(Auth::user()->profile_image)
                                <img src="{{asset(Auth::user()->profile_image)}}" alt="user" class="avatar-img rounded-circle">
                                @else
                                <img src="{{asset('dist/img/user.png')}}" alt="user" class="avatar-img rounded-circle">
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="dropdown text-center">
                        <a class="dropdown-toggle no-caret font-15" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span>{{ Auth::user()->name }}</span>
                        </a>
                    </div>
                </li>
{{--                {{dd(Request::segment(1))}}--}}
                <!-- /User Profile -->
                {{--<li class="nav-item @if(Request::segment(1) == 'home') active @endif">
                    <a class="nav-link" href="{{url('home')}}">
                        <span class="feather-icon"><i data-feather="activity"></i></span>
                        <span class="nav-link-text">Dashboard</span>
                    </a>
                </li>--}}
                @can('properties-page')
                <li class="nav-item @if(Request::segment(1) == 'properties') active @endif">
                    <a class="nav-link" href="{{url('properties')}}">
                        <span class="feather-icon"><i data-feather="book"></i></span>
                        <span class="nav-link-text">Properties</span>
                    </a>
                </li>
                @endcan

                @can('users-page')
                <li class="nav-item @if(Request::segment(1) == 'users') active @endif">
                    <a class="nav-link" href="{{url('users')}}">
                        <span class="feather-icon"><i data-feather="users"></i></span>
                        <span class="nav-link-text">Users</span>
                    </a>
                </li>
                @endcan

                <li class="nav-item @if(Request::segment(1) == 'users-profile') active @endif">
                    <a class="nav-link" href="{{url('users-profile/'.auth()->user()->id)}}">
                        <span class="feather-icon"><i data-feather="user"></i></span>
                        <span class="nav-link-text">My Account</span>
                    </a>
                </li>


                {{--<li class="nav-item @if(Request::segment(1) == 'support') active @endif">
                    <a class="nav-link" href="#">
                        <span class="feather-icon"><i data-feather="headphones"></i></span>
                        <span class="nav-link-text">Support</span>
                    </a>
                </li>--}}

            </ul>

        </div>
    </div>
</nav>
<div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>
<!-- /Vertical Nav -->


<script>

    $(document).ready(function() {

        $(".nav-item").click(function () {
            $(".nav-item").removeClass("active");
            // $(".tab").addClass("active"); // instead of this do the below
            $(this).addClass("active");
        });
        
    });

</script>
