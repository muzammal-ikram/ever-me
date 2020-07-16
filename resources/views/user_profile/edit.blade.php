
@extends('layouts.app')
@section('content')

    <style>
        .vl {
            border-left: 2px solid lightgray;
            height: 100%;
            position: absolute;
            left: 40%;
            margin-left: -3px;
            top: 0;
        }
        @media only screen and (max-width: 1000px) {
            .vl{
                display: none;
            }
        }
    </style>


    <!-- HK Wrapper -->
    <div class="hk-wrapper hk-vertical-nav">

    @include('layouts.partials._header')

    @include('layouts.partials._leftSideNav')

    <!-- Main Content -->
        <div class="hk-pg-wrapper">

            @if (session('success'))
                <div class="container-fluid">
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                </div>
            @endif

                @if (session('error'))
                    <div class="container-fluid">
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    </div>
                @endif

            @if(count($errors))
                <div class="col-12">
                    <ul class="alert alert-danger ">
                        @foreach($errors->all() as $error)
                            <li class="ml-4">{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
        @endif



                <div class="card card-shadow mb-4">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="card-title">
                                    <div class="hk-pg-header mb-10">
                                        <div>
                                            <h5><i data-feather="user"></i> My Account </h5>
                                        </div>
                                        <div class="d-flex">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                            <div class="row">

                                <div class="col-lg-5 col-sm-12">


                                    <div class="col-10">
                                        <a onclick="profile()">
                                            <div class="card" style="background-color: gray;" id="account-profile-card">
                                                <div class="card-body">
                                                    <h5 class="card-title">Account Profile</h5>
                                                </div>
                                            </div>
                                        </a>
                                    </div>


                                    <div class="col-10" id="security_profile">
                                        <a onclick="profile_security()">
                                        <div class="card" style="background-color: lightgray;" id="security-card">
                                            <div class="card-body">
                                                <h5 class="card-title">Security</h5>
                                            </div>
                                        </div>
                                        </a>
                                    </div>

                                </div>


                                <div class="vl"></div>


                                    <div class="col-lg-7 col-sm-12" id="account-profile-div">
                                        
                                        <h4>{{Auth::user()->name}}'s Profile</h4>
                                        <br>
                                        <br>

                                        <form method="post" action="{{url('users-profile/'.$user->id)}}" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')

                                            <div class="row">
                                                <div class="col-md-12 form-group">
                                                    @if($user->profile_image)
                                                        <img src="{{asset($user->profile_image)}}" alt="user" class="img-thumbnail rounded-circle" height="150px" width="200px">
                                                    @else
                                                        <img src="{{asset('dist/img/user.png')}}" alt="user" class="img-thumbnail rounded-circle" height="150px" width="200px">
                                                    @endif
                                                    <p>Recommended Size 250x250</p>
                                                    <br>
                                                    <input type="file" class="" name="profile_image" id="profile_image" placeholder="" value="" accept=".png, .jpg, .jpeg">
                                                </div>
                                            </div>

                                            <br>

                                            <div class="row">
                                                <div class="col-md-6 form-group">
                                                    <label for="first_name">First Name</label>
                                                    <input type="text" class="form-control" name="first_name" id="first_name" placeholder="" value="{{$user->first_name}}" required>
                                                </div>

                                                <div class="col-md-6 form-group">
                                                    <label for="last_name">Last Name</label>
                                                    <input type="text" class="form-control" name="last_name" id="last_name" placeholder="" value="{{$user->last_name}}" required>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 form-group">
                                                    <label for="email">Email Address</label>
                                                    <input type="email" class="form-control" name="email" id="email" placeholder="" value="{{$user->email}}" required>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 form-group">
                                                    <label for="company_name">Company Name</label>
                                                    <input type="text" class="form-control" name="company_name" id="company_name" placeholder="" value="{{$user->company_name}}">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 form-group">
                                                    <label for="property_address">Phone</label>
                                                    <input type="number" class="form-control" name="phone" id="phone" placeholder="" value="{{$user->phone}}" required>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 form-group">
                                                    <label for="other_phone">Other Phone</label>
                                                    <input type="number" class="form-control" name="other_phone" id="other_phone" placeholder="" value="{{$user->other_phone}}">
                                                </div>
                                            </div>

                                            <button class="btn btn-primary" type="submit">Save Changes</button>
                                        </form>
                                    </div>

                                <div class="col-lg-6 col-sm-12" style="display: none" id="security-div">
                                    <h4>Change Password</h4>
                                    <br>
                                    <br>
                                    <form method="POST" action="{{ url('users-profile/change-password') }}">
                                        @csrf

                                        {{--<div class="form-group">
                                            <label for="inputName" class="col-md-12 col-form-label">Current Password:</label>
                                            <div class="col-md-12">
                                                <input type="password" name="current_password" class="form-control" id="inputName" placeholder="Current Password" required>
                                            </div>
                                        </div>--}}

                                        <div class="form-group">
                                            <label for="inputName" class="col-md-12 col-form-label">New Password:</label>
                                            <div class="col-md-12">
                                                <input type="password" name="password" class="form-control" id="inputName" placeholder="New Password" required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputName" class="col-md-12 col-form-label">Confirm Password:</label>
                                            <div class="col-md-12">
                                                <input type="password" name="password_confirmation" class="form-control" placeholder="Re-Enter Password" required>
                                            </div>
                                        </div>

                                        <div class="form-group">
{{--                                            <a href="{{ url('dashboard') }}"--}}
{{--                                               class="btn btn-warning ml-3">Cancel</a>--}}
                                            <button type="submit" class="btn btn-primary ml-3">Submit</button>
                                        </div>

                                    </form>


                                </div>



                         </div>

                     </div>

                </div>






        @include('layouts.partials._footer')

        <!-- /Main Content -->
        </div>

    </div>
    <!-- /HK Wrapper -->


    @include('layouts.partials._script')

@endsection

<script>

    

        function profile() {
        document.getElementById("account-profile-div").style.display = "inline";
            document.getElementById("security-div").style.display = "none";
            document.getElementById("security-card").style.backgroundColor = "lightgray";
            document.getElementById("account-profile-card").style.backgroundColor = "gray";
        }
        function profile_security() {
            document.getElementById("security-div").style.display = "inline";
            document.getElementById("account-profile-div").style.display = "none";
            document.getElementById("security-card").style.backgroundColor = "gray";
            document.getElementById("account-profile-card").style.backgroundColor = "lightgray";
        }
    
</script>
