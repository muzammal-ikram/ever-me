<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Custom html Template">
    <meta name="author" content="Front-end developer">

    <!-- Title -->
    <title>EverHost</title>
    <link rel="icon" href="{{asset('guest_site/images/title-icon.png')}}" type="image/icon type">
    <!-- Scroll style -->
    <link rel="stylesheet" type="text/css" href="{{ asset('guest_site/css/flickity.css') }}">
    <!-- Bootstrap css file -->
    <link rel="stylesheet" type="text/css" href="{{ asset('guest_site/css/bootstrap.min.css') }}">
    <!-- Fontawesome icon file -->
    <link rel="stylesheet" type="text/css" href="{{ asset('guest_site/css/all.min.css') }}">

    <link href="{{ asset('guest_site/css/select2.min.css') }}" rel='stylesheet' type='text/css'>

    <!-- Custom Style Sheet -->
    <link rel="stylesheet" href="{{ asset('guest_site/css/styles.css') }}">

    <style>
        .modal-dialog-centered {
            align-items: normal !important;
        }
    </style>

</head>



<body class="bg-color-pink nearby-page">
    @if (session('success'))
    <div class="container-fluid">
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="container-fluid">
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    </div>
    @endif

    @php
    $referral_urls = Session::get('nearby_url');
    @endphp

    <div class="loading"><img src="{{ asset('guest_site/images/ajax-loader.gif') }}" alt="" style="display: none" />
    </div>

    <div class="content bg-img">
        <!-- main body -->
        <div id="header-top">
            <!-- top button left and right -->
            <div class="top-icons clearfix">
                <div class="float-left">

                    <a href="@if(isset($referral_urls)) {{ $referral_urls }} @endif" class="btn btn-default">
                        <!-- <i class="fas fa-angle-left"></i> -->
                        <img src="{{ asset('guest_site/images/top-icon-1.png') }}" alt="">
                    </a>
                </div>
                <div class="float-right">
                    <a href="#" class="btn btn-default btn-filter">
                        <!-- <i class="fas fa-angle-left"></i> -->
                        <img src=" {{ asset('guest_site/images/filter-icon.png') }}" alt="">
                    </a>
                </div>
            </div>
            <!-- t./op button left and right -->

            <!-- categories name -->
            <div class="top-img-box deal-heading">
                <h3 class="heading">
                    Nearby
                </h3>
            </div>

        </div> <!-- ./main body -->

        <!-- main content -->
        <div class="main-container">
            <div class="top-line">
                <span class="main-top-line"></span>

                <div class="nearby-block">
                    @foreach($nearby_results['results'] as $key => $nearby)
                    @if(isset($nearby['photos']))
                    <div class="nearby-company-name">
                        @if(isset($nearby['name']))
                        <h4 class="title">
                            {{ $nearby['name'] }}
                        </h4>
                        @endif
                        @if(isset($nearby['rating']))
                        <div class="company-rating">
                            <!-- rating counter -->
                            <span class="rating-point">{{$nearby['rating']}}</span>

                            <!-- positive stars -->
                            @if($nearby['rating'] == 1 && $nearby['rating'] <= 2) <span class="rating">
                                <img src="{{ asset('guest_site/images/star-xs.png') }}" alt="">
                                </span>
                                @elseif($nearby['rating'] == 2 && $nearby['rating'] <= 3) <span class="rating">
                                    <img src="{{ asset('guest_site/images/star-xs.png') }}" alt="">
                                    <img src="{{ asset('guest_site/images/star-xs.png') }}" alt="">
                                    </span>
                                    @elseif($nearby['rating'] == 3 && $nearby['rating'] <= 4) <span class="rating">
                                        <img src="{{ asset('guest_site/images/star-xs.png') }}" alt="">
                                        <img src="{{ asset('guest_site/images/star-xs.png') }}" alt="">
                                        <img src="{{ asset('guest_site/images/star-xs.png') }}" alt="">
                                        </span>
                                        @elseif($nearby['rating'] == 4 && $nearby['rating'] <= 5) <span class="rating">
                                            <img src="{{ asset('guest_site/images/star-xs.png') }}" alt="">
                                            <img src="{{ asset('guest_site/images/star-xs.png') }}" alt="">
                                            <img src="{{ asset('guest_site/images/star-xs.png') }}" alt="">
                                            <img src="{{ asset('guest_site/images/star-xs.png') }}" alt="">
                                            </span>
                                            @else
                                            <span class="rating">
                                                <img src="{{ asset('guest_site/images/star-xs.png') }}" alt="">
                                                <img src="{{ asset('guest_site/images/star-xs.png') }}" alt="">
                                                <img src="{{ asset('guest_site/images/star-xs.png') }}" alt="">
                                                <img src="{{ asset('guest_site/images/star-xs.png') }}" alt="">
                                                <img src="{{ asset('guest_site/images/star-xs.png') }}" alt="">
                                            </span>
                                            @endif

                                            <!-- positive rating comments -->
                                            <span class="positive-rating">({{$nearby['user_ratings_total']}})</span>
                        </div>
                        @endif
                        <!-- opening at -->
                        @if(isset($nearby['opening_hours']))
                        <div class="open-store">
                            Open 24 hr
                        </div>
                        @endif

                        <!-- stroe detail -->
                        <div class="store-detail">
                            <!-- store description -->
                            <p class="desc">
                                {{$nearby['vicinity']}}
                            </p>
                            <!-- Dishes lists -->
                            @if(isset($nearby['photos']))
                            <div class="store-dishes">
                                <ul class="dishes-list" data-flickity='{ "cellAlign": "left", "contain": true }'>
                                    <li class="dish-item">
                                        <a href="#" class="dish-link">
                                            <img src="{{ $nearby_photos[$nearby['id']] }}" alt="">
                                        </a>
                                    </li>
                                </ul>
                            </div> <!-- ./dish list -->
                            @endif
                        </div> <!-- ./store detail -->
                    </div>
                    @endif
                    @endforeach


                </div>
                <div class="bottom-line">
                    <span class="main-top-line"></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Property popup -->
    <!-- Modal -->
    <div class="modal fade modal-top" id="nearby_modal" tabindex="-1" role="dialog" aria-labelledby="nearby_modal_title"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body p-4">
                    <!-- Popup Header -->
                    <div class="modal-header border-0">
                        <!-- popup heading -->
                        <h5 class="modal-title" id="property_modal_title">Nearby</h5>
                        <!-- close button -->
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div><!-- ./Popup Header -->

                    <!-- main body content -->
                    <div class="main-content">
                        <!-- Nearby location selectation -->
                        <form method="get" accept-charset="utf-8">
                            <div class="form-group">
                                <select name="" id="location_selected" class="form-control nearby_filters">
                                    <option value="restaurant">Resturant</option>
                                    <option value="hospital">Hospital</option>
                                </select>
                            </div>
                            <!-- Distance -->
                            <div class="form-group">
                                <select name="" id="distance_selected" class="form-control nearby_filters">
                                    <option value="null">Distance</option>
                                    <option value="500">500m</option>
                                    <option value="1000">1000m</option>
                                    <option value="2000">2000m</option>
                                </select>
                            </div>

                            {{--<div class="range-slider">
                                <input class="range-slider__range" type="range" value="100" min="500" max="5000">
                                <span class="range-slider__value">0</span>
                            </div>--}}

                            <div class="form-group">
                                <button type="button" id="nearby_filter_submit"
                                    class="btn btn-block btn-lg btn-info p-3">Apply</button>
                            </div>
                        </form>
                    </div>
                    <!-- ./main body content -->
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('guest_site/js/jquery.min.js') }}"></script>
    <!-- Bootstrap js -->
    <script src=" {{ asset('guest_site/js/bootstrap.min.js') }}"></script>
    <!-- Fontawesome for svgs icon use -->
    <script src=" {{ asset('guest_site/js/all.min.js') }} "></script>
    <script src="{{ asset('guest_site/js/select2.min.js') }}"></script>
    <!-- custom scripts -->
    <script src="{{ asset('guest_site/js/scripts.js') }}"></script>

    <script src="{{ asset('guest_site/js/flickity.pkgd.min.js') }}"></script>

    <script type="text/javascript">
        $(document).on('click', '.btn-filter', function () {
            $('#nearby_modal').modal('toggle');
        });

        // $(document).ready(function(e){
        $("body").on('click', '#nearby_filter_submit', function () {
            var value = $("#location_selected").val();
            window.location.href = value
        });


        // Range Slider
        var rangeSlider = function(){
        var slider = $('.range-slider'),
            range = $('.range-slider__range'),
            value = $('.range-slider__value');
            
        slider.each(function(){

            value.each(function(){
            var value = $(this).prev().attr('value');
            $(this).html(value);
            });

            range.on('input', function(){
            $(this).next(value).html(this.value);
            });
        });
        };

        rangeSlider();
        // End Range Slider

        // });
    </script>

</body>

</html>
