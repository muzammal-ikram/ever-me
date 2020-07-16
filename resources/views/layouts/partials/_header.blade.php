

<!-- Top Navbar -->
<nav class="navbar navbar-expand-xl navbar-light fixed-top hk-navbar">
    <a id="navbar_toggle_btn" class="navbar-toggle-btn nav-link-hover" href="javascript:void(0);"><span class="feather-icon"><i data-feather="menu"></i></span></a>
    <a class="navbar-brand" href="{{ url('properties') }}">
        <img class="brand-img d-inline-block mr-10" src="{{asset('dist/img/everhost-icon.png')}}" alt="brand" height="30px" width="30px" />
        EverHost
    </a>
    <ul class="navbar-nav hk-navbar-content">

        <li class="nav-item dropdown dropdown-authentication">
            <a class="nav-link dropdown-toggle no-caret" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="media">
                    <div class="media-img-wrap">
                        <div class="avatar">
                            @if(Auth::user()->profile_image)
                            <img src="{{Auth::user()->profile_image}}" alt="user" class="avatar-img rounded-circle">
                            @else
                            <img src="{{asset('dist/img/user.png')}}" alt="user" class="avatar-img rounded-circle">
                            @endif
                        </div>
                        <span class="badge badge-success badge-indicator"></span>
                    </div>
                    <div class="media-body">
                        <span>{{ Auth::user()->name }}<i class="zmdi zmdi-chevron-down"></i></span>
                    </div>
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-right" data-dropdown-in="flipInX" data-dropdown-out="flipOutX">
{{--                <a class="dropdown-item" href="#"><i class="dropdown-icon zmdi zmdi-account"></i><span>Profile</span></a>--}}
{{--                <div class="dropdown-divider"></div>--}}
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    <i class="dropdown-icon zmdi zmdi-power"></i>  {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>

            </div>
        </li>
    </ul>
</nav>

<!-- /Top Navbar -->

