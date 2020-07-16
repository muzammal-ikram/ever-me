<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Custom html Template">
    <meta name="author" content="Front-end developer">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Title -->
    <title>EverHost | {{ $properties['property_name'] }}</title>

    <link rel="icon" href="{{asset('guest_site/images/title-icon.png')}}" type="image/icon type">


    <!-- Bootstrap css file -->
    <link rel="stylesheet" type="text/css" href="{{ asset('guest_site/css/bootstrap.min.css') }}">
    <!-- Fontawesome icon file -->
    <link rel="stylesheet" type="text/css" href="{{ asset('guest_site/css/all.min.css') }}">

    <link href="{{ asset('guest_site/css/select2.min.css') }}" rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.27.0/feather.min.js"></script>

    <!-- Custom Style Sheet -->
    <link rel="stylesheet" href="{{ asset('guest_site/css/styles.css') }}">

    <style>
        body {
            background-color: #f5f5f5;
            overflow: hidden;
        }
        html {
            overflow: hidden;
        }
        ::-webkit-scrollbar {
            width: 0px;
            background: transparent;
            /* make scrollbar transparent */
        }
    </style>


</head>

<body class="bg-color-pink">
    <div class="content bg-img">
        @if(session('success'))
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
        <!-- main body -->
        <div id="header-top">
            <!-- top button left and right -->
            <div class="top-icons clearfix">
                <div class="float-right">
                    <a href="#" class="btn btn-default btn-message">
                        <!-- <i class="fas fa-angle-left"></i> -->
                        <img src="{{ asset('guest_site/images/top-icon-2.png') }}" alt="">
                    </a>
                    <a href="#" class="btn btn-shareable">
                        <!-- <i class="fas fa-angle-left"></i> -->
                        <img src="{{ asset('guest_site/images/top-icon-3.png') }}" alt="">
                    </a>
                </div>
            </div>
            <!-- t./op button left and right -->

            <div class="top-img-box">
                <img src="@if(isset($properties->property_image)) {{ $properties->property_image->getUrl('thumb') }} @endif"
                    alt="Top Image" class="img-box">
                <h3 class="heading">
                    {{ $properties['property_name'] }}
                </h3>
            </div>

        </div> <!-- ./main body -->

        <!-- main content -->
        <div class="main-container">
            <!-- top line -->
            <div class="top-line">
                <span class="main-top-line"></span>

                <div class="menu-lists-section">
                    <ul class="category-list-items">
                        @foreach($properties['property_resources'] as $key => $property_resource)
                        <li class="category-item">
                            <div class="category-detail">
                                <div class="icon-box">
                                    <img src=" {{ asset('guest_site/images/icon-'.$key.'.png') }}" alt="">
                                </div>
                                <div class="category-name">
                                    <h4 class="title">{{$property_resource['title']}}</h4>
                                    @if($property_resource['nearby'] != '1' && $property_resource['media'] != '1' &&
                                    $property_resource->property_property_sections->count())
                                    <a href="#" class="btn-detail color-info float-right" data-toggle="modal"
                                        data-target="#property_{{$property_resource['id']}}">
                                        Details
                                    </a>
                                    @elseif($property_resource['nearby'] == '1')
                                    <a href="{{url('guest/nearby/'.$property_resource['id'].'/restaurant')}}"
                                        class="btn-detail color-info float-right"> Details </a>

                                    @elseif($property_resource['media'] == '1' &&
                                    $property_resource['property_property_media'])
                                    <a href="#" class="btn-detail color-info float-right" data-toggle="modal"
                                        data-target="#media_{{$property_resource['id']}}">
                                        Details
                                    </a>
                                    @else

                                    @endif
                                </div>
                            </div>
                        </li>
                        @endforeach

                        <li class="category-item">
                            <div class="category-detail">
                                <div class="icon-box">
                                    <img src="{{ asset('guest_site/images/icon-5.png') }}" alt="">
                                </div>
                                <div class="category-name">
                                    <h4 class="title">Deals</h4>
                                    <p class="btn-detail coming-soon float-right">Coming soon</p>
                                </div>
                            </div>
                        </li>

                    </ul>
                </div>


                <div class="bottom-line">
                    <span class="main-top-line"></span>
                </div>
            </div>
        </div>

        <!-- popup media -->
        @foreach($properties['property_resources'] as $key => $property_resource)
        <div class="modal fade modal-top" id="media_{{$property_resource['id']}}" tabindex="-1" role="dialog"
            aria-labelledby="property_modal_title" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body p-2 pt-3">
                        <!-- Popup Header -->
                        <div class="modal-header border-0 p-3">
                            <!-- popup heading -->
                            <h5 class="modal-title" id="property_modal_title">{{$property_resource['title']}}</h5>
                            <!-- close button -->
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div><!-- ./Popup Header -->

                        <!-- main body content -->
                        @if($property_resource['property_property_media'])
                        <div id="carousel_{{$property_resource['id']}}" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                @foreach($property_resource['property_property_media']['media_image'] as $key => $media)
                                <div class="carousel-item @if($key == 0) active @endif">
                                    <img class="d-block w-100" src="{{$media->getUrl()}}" alt="First slide">
                                </div>
                                @endforeach
                            </div>
                            <a class="carousel-control-prev" href="#carousel_{{$property_resource['id']}}" role="button"
                                data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carousel_{{$property_resource['id']}}" role="button"
                                data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                        @else
                        No Media
                        @endif


                        <!-- ./main body content -->
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        <!-- popup main -->
        @foreach($properties['property_resources'] as $key => $property_resource)
        <div class="modal fade modal-top" id="property_{{$property_resource['id']}}" tabindex="-1" role="dialog"
            aria-labelledby="property_modal_title" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body p-2 pt-3">
                        <!-- Popup Header -->
                        <div class="modal-header border-0 p-3">
                            <!-- popup heading -->
                            <h5 class="modal-title" id="property_modal_title">{{$property_resource['title']}}</h5>
                            <!-- close button -->
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div><!-- ./Popup Header -->

                        <!-- main body content -->

                        <!-- tabs navigation -->

                        <nav class="tab-navigation">

                            <div class="nav nav-tabs" id="nav-tab" role="tablist">

                                @foreach($property_resource['property_property_sections'] as $key => $section)
                                @if($section)
                                <a class="nav-item nav-link {{ $key == 0 ? 'active' : '' }}"
                                    id="nav-{{$section['id']}}-tab" data-toggle="tab" href="#nav-{{$section['id']}}"
                                    role="tab" aria-controls="nav-welcome">{{ $section['title'] }}</a>
                                @else
                                No section
                                @endif

                                @endforeach
                            </div>

                        </nav>
                        <!-- ./tabs navigation -->


                        <!-- tabs content -->
                        <div class="tab-content nearby-block" id="nav-tabContent">
                            <!-- Welcome -->
                            @foreach($property_resource['property_property_sections'] as $key => $section)
                            <div class="tab-pane fade show {{ $key == 0 ? 'active' : '' }}" id="nav-{{$section['id']}}"
                                role="tabpanel" aria-labelledby="nav-{{$section['id']}}-tab">

                                <!-- Accordion -->

                                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                    @foreach($section['property_section_information'] as $key => $information)
                                    @if(isset($information['id']))
                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="heading_{{$information['id']}}">
                                            <h4 class="panel-title">
                                                <a role="button" data-toggle="collapse" data-parent="#accordion"
                                                    href="#collapse_{{$information['id']}}" aria-expanded="true"
                                                    aria-controls="collapse_{{$information['id']}}">
                                                    <span class="bg-show-color"><i
                                                            class="more-less fas fa-minus"></i></span>
                                                    {{ $information['title'] }}
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapse_{{$information['id']}}" class="panel-collapse collapse show"
                                            role="tabpanel" aria-labelledby="heading_{{$information['id']}}">
                                            <div class="zero">
                                                @if(!empty($information['video_url']) &&
                                                isset($information['video_url']) &&
                                                $information['video_url'] != Null)
                                                <!-- Video -->
                                                <video width="100%" controls>
                                                    <source src="{{$information['video_url']}}" type="video/mp4">
                                                    Your browser does not support HTML video.
                                                </video>
                                                <!-- ./video -->
                                                @elseif (isset($information['video_url']) &&
                                                isset($information['image_url']))
                                                <!-- Video -->
                                                <video width="100%" controls>
                                                    <source src="{{$information['video_url']}}" type="video/mp4">
                                                    Your browser does not support HTML video.
                                                </video>
                                                <!-- ./video -->
                                                @else
                                                @if($information->image_url)
                                                <img src="{{ $information->image_url->getUrl() }}" alt=""
                                                    class="img-responsive"
                                                    style="width: 100%; height: 300px; object-fit: cover">
                                                @endif
                                                @endif
                                                <div class="vidoe-content">

                                                    {!! $information['description'] !!}

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Address accordion -->
                                    @endif
                                    @endforeach
                                </div>

                            </div>
                            @endforeach
                        </div>
                        <!-- ./tabs content -->


                        <!-- ./main body content -->
                    </div>
                </div>
            </div>
        </div>
        @endforeach 

        <!-- popup contact us -->
        <div class="modal fade modal-top" id="contact_person" tabindex="-1" role="dialog"
            aria-labelledby="contact_person_title" aria-hidden="true">
            <div class="modal-dialog modal-attached-with-end" role="document">
                <div class="modal-content">
                    <div class="modal-body p-3">
                        <!-- Popup Header -->
                        <div class="modal-header border-0 pt-3 pb-3 pl-0 pr-0">
                            <!-- popup heading -->
                            <h5 class="modal-title" id="property_modal_title">Contact Us</h5>
                            <!-- close button -->
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div><!-- ./Popup Header -->
                        <div class="main-imgBox">
                            <div class="imgBox">
                                @if($user['profile_image'])
                                <img src="{{ asset($user['profile_image']) }}" class="round-img" alt="">
                                @else
                                <img src="{{ asset('guest_site/images/person.png') }}" class="img-rounded" alt="">
                                @endif
                                <span class="person-name">
                                    @if($user['first_name'] && $user['last_name'])
                                    Hi, I'm {{$user['first_name']}} {{$user['last_name']}}
                                    @else
                                    Hi, I'm {{$user['name']}}
                                    @endif
                                </span>
                            </div> <!-- ./img box -->
                        </div> <!-- ./main imgBox -->

                        <!-- selected Platform message -->
                        <div class="messages-platform">
                            <form method="POST" action="{{route('contact-email')}}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="property_name" value="{{ $properties['property_name'] }}" >
                                <input type="hidden" name="property_address" value="{{ $properties['property_address'] }}" >
                                <input type="hidden" name="property_city" value="{{ $properties['property_city'] }}" >
                                <input type="hidden" name="user_id" value="{{ $properties['user_id'] }}">

                                <div class="form-group">
                                    <select id="platform_selected" name="platform" class="form-control bg-color"
                                        placeholder="Platform Message">
                                        <!-- <option disabled selected>Platform Message</option> -->
                                        <option value="airbnb">Airbnb</option>
                                        <option value="homeway">Homeway</option>
                                        <option value="booking">Booking.com</option>
                                        <option value="vrbo">Vrob</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <input type="text" name="name" class="form-control" placeholder="Name"
                                            aria-label="Name" aria-describedby="button-addon3" required>
                                            <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="button" id="button-addon3">
                                            <img src="https://img.icons8.com/material-rounded/24/000000/name.png"/>
                                            </button>
                                        </div>
                                        
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <input type="text" name="email" class="form-control" placeholder="Email"
                                            aria-label="Email" aria-describedby="button-addon3" required>
                                            <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="button" id="button-addon3">
                                            <img src="https://img.icons8.com/material/24/000000/email--v1.png"/>
                                            </button>
                                        </div>
                                        
                                    </div>
                                </div>

                                <!-- Cell number -->
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <input type="text" name="cell_no" class="form-control" placeholder="Cell"
                                            aria-label="Cell" aria-describedby="button-addon3" required>
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="button" id="button-addon3">
                                                <img src="{{ asset('guest_site/images/cell-icon.png') }}" alt="">
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- text sms -->
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <input type="text" name="message" class="form-control" placeholder="Text / SMS"
                                            aria-label="Text / SMS" aria-describedby="button-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="button" id="button-addon2">
                                            <img src="https://img.icons8.com/material-sharp/24/000000/read-message.png"/>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <button type="submit" class="btn btn-success btn-block">Send</button>
                                    </div>
                                </div>


                            </form>
                        </div>
                    </div><!-- ./modal body -->
                </div><!-- ./main modal-content -->
            </div><!-- ./main modal dialog -->
        </div> <!-- ./contact us popup -->

        <!-- popup Shareable -->
        <div class="modal fade modal-top" id="shareable" tabindex="-1" role="dialog" aria-labelledby="shareable_title"
            aria-hidden="true">
            <div class="modal-dialog modal-attached-with-end" role="document">
                <div class="modal-content">
                    <div class="modal-body p-3 pb-3">
                        <!-- Popup Header -->
                        <div class="modal-header border-0 pt-3 pb-3 pl-0 pr-0">
                            <!-- popup heading -->
                            <h5 class="modal-title" id="property_modal_title">Social Share</h5>
                            <!-- close button -->
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div><!-- ./Popup Header -->

                        <!-- selected Platform message -->
                        <div style="padding-bottom: 7%">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{url('guest/site'.$properties['id'].'/'.$properties['uuid'].'')}}"
                            target="_blank" class="feather-icon facebook"><img src="https://img.icons8.com/fluent/48/000000/facebook-new.png"/></a>
                        <a href="https://twitter.com/intent/tweet?text=my share text&amp;url={{url('guest/site'.$properties['id'].'/'.$properties['uuid'].'')}}"
                            target="_blank" class="feather-icon twitter"><img src="https://img.icons8.com/fluent/48/000000/twitter.png"/></a>
                        <a href="https://www.linkedin.com/shareArticle?mini=true&amp;url={{url('guest/site'.$properties['id'].'/'.$properties['uuid'].'')}}&amp;title=EverHost {{$properties['property_name']}}&amp;summary=dit is de linkedin summary"
                            target="_blank" class="feather-icon linkedin"><img src="https://img.icons8.com/fluent/48/000000/linkedin-2.png"/></a>
                        <a href="https://wa.me/?text={{url('guest/site'.$properties['id'].'/'.$properties['uuid'].'')}}"
                            target="_blank" class="feather-icon"><img src="https://img.icons8.com/color/48/000000/whatsapp.png"/></a>
                        </div>    

                    </div><!-- ./modal body -->
                </div><!-- ./main modal-content -->
            </div><!-- ./main modal dialog -->
        </div> <!-- ./popup Shareable -->








    </div>


    <script>
        feather.replace();
    </script>

    <!-- Scripts -->
    <script src="{{ asset('guest_site/js/jquery.min.js') }}"></script>
    <!-- Bootstrap js -->
    <script src=" {{ asset('guest_site/js/bootstrap.min.js') }}"></script>
    <!-- Fontawesome for svgs icon use -->
    <script src=" {{ asset('guest_site/js/all.min.js') }} "></script>
    <script src="{{ asset('guest_site/js/select2.min.js') }}"></script>
    <!-- custom scripts -->
    <script src="{{ asset('guest_site/js/scripts.js') }}"></script>

    <!-- site worker scripts -->
    <script src="{{ asset('guest_site/js/siteworker_script.js') }}"></script>

    <script type="text/javascript">
        $(document).on('click', '.btn-message', function () {
            $('#contact_person').modal('toggle');
        });

        $(document).on('click', '.btn-shareable', function () {
            $('#shareable').modal('toggle');
        });

        $(document).ready(function () {
            $("#platform_selected").select2({
                templateResult: formatOptions
            });
        });

        function formatOptions(platform) {
            if (!platform.id) {
                return platform.text;
            }
            console.log(platform.element.value.toLowerCase());
            let src = '/guest_site/images/' + platform.element.value.toLowerCase() + '.jpg';
            var $platform = $(
                '<span ><img sytle="display: inline-block;width:50px;" src=' + src + '></img></span>'
                //' + platform.text + '
            );
            return $platform;
        }
    </script>
</body>

</html>
