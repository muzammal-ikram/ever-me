@extends('layouts.app')
@section('content')
<input type="hidden" id="property_id" value="{{$property_id}}">
<input type="hidden" id="resource_id" value="{{$property_resource_id}}">
<!-- HK Wrapper -->
<div class="hk-wrapper hk-vertical-nav">

    @include('layouts.partials._header')

    @include('layouts.partials._leftSideNav')

    <!-- Main Content -->
    <div class="hk-pg-wrapper">

        <div class="container-fluid">

            @if(count($errors))
            <div class="col-12">
                <ul class="alert alert-danger ">
                    @foreach($errors->all() as $error)
                    <li class="ml-4">{{$error}}</li>
                    @endforeach
                </ul>
            </div>
            @endif

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

            <div class="row">
                <div class="col-12" style="float: right">
                    <div class="card card-shadow mb-4">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    <div class="card-title">
                                        <div class="hk-pg-header mb-10">
                                            <div>
                                                <h5><i data-feather="book"></i> {{$property['property_name']}} </h5>

                                            </div>
                                            <div class="d-flex">
                                                <button class="btn btn-primary btn-sm add_section" data-toggle="modal"
                                                    data-target="#myModal">Add Property Section</button> </div>                                                
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card w-100">
                        <div class="card-body">
                            <h5 class="card-title">{{$property_resource['title']}} 
                            @if($sections->count() > 1)    
                            <span class="card-subtitle mb-2 text-muted" style="font-size: 15px; float:right">(Drag and Drop to set order)</span>
                            @endif    
                            </h5>
                           
                            <ul class="nav nav-tabs dragable" id="myTab" role="tablist">  

                                @if($sections->count())
                                    @foreach($sections as $key => $section) 
                                    <li class="nav-item row1" data-id="{{ $section['id'] }}">
                                        <span style="align-content: center">
                                            <a title="Edit" data-toggle="modal" data-target="#edit_modal{{$section['id']}}" class="custom-action action-icon icon-pencil" style="color: #ff9528"></a>
                                            <a title="Remove" class="action-icon icon-trash confirm_delete"  href="{{url('delete-section/'.$section['id'].'')}}"></a>
                                        </span>
                                        <a class="nav-link custom-style" id="home-{{$section['id']}}-tab" data-toggle="tab"
                                            href="#home_{{$section['id']}}" role="tab" aria-controls="home"
                                            aria-selected="true">{{$section['title']}}
                                        </a>                                           
                                    </li>
                                    @endforeach
                                @else
                                    No section, Please add section
                                @endif
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                
                                @if($sections)
                                    @foreach($sections as $key => $section)
                                    <div class="tab-pane fade show" id="home_{{$section['id']}}" role="tabpanel" aria-labelledby="home-{{$section['id']}}-tab">
                                        <button style="float: right; margin-bottom: 10px" class="btn btn-primary btn-sm add_section_info" data-toggle="modal" data-target="#mySectionInfoModal{{$section['id']}}">Add Sub Section</button>
                                        @include('property_sections.partials.add_information_modal')

                                        @if(!empty($section['property_section_information']))
                                            <div class="accordion" id="accordionExample">
                                                @foreach($section['property_section_information'] as $key => $information)
                                                    <div class="card" style="width: 100%;">
                                                        <div class="card-header" id="heading_{{$information['id']}}">
                                                        
                                                            <div class="row" style="height: 35px; padding-left: 5px; padding-top: 5px; cursor: pointer;">
                                                                <div class="col-9 collapsed" data-toggle="collapse" data-target="#collapse_{{$information['id']}}" aria-expanded="false" aria-controls="collapseThree">
                                                                    {{$information['title']}}
                                                                </div>
                                                                <div class="col-3"> 
                                                                    {{--<a class="" data-toggle="modal"
                                                                        data-target="#mySectionInfoEditModal{{$information['id']}}">
                                                                        <span title="Edit" class="action-icon icon-pencil edit_section_info" style="color: #ff9528"></span>
                                                                    </a>--}}
                                                                    <a href="{{url('section-info/'.$information['id'].'/edit')}}" title="Edit" class="action-icon icon-pencil edit_section_info" style="color: #ff9528"></a> 

                                                                    <a href="{{url('delete-section-info/'.$information['id'].'')}}" title="Remove" class="action-icon icon-trash confirm_delete" style="color: red"></a> 

                                                                </div>
                                                                @include('property_sections.partials.edit_information_modal')

                                                            </div>
                                                        
                                                        </div>
                                                        <div id="collapse_{{$information['id']}}" class="collapse" aria-labelledby="heading_{{$information['id']}}" data-parent="#accordionExample">
                                                        <div class="card-body">
                                                            @if(!empty($information['video_url']) && isset($information['video_url']) && $information['video_url'] != Null)
                                                            <!-- Video -->
                                                            <video width="100%" controls>
                                                                <source src="{{$information['video_url']}}" type="video/mp4">
                                                                Your browser does not support HTML video.
                                                            </video>
                                                            <!-- ./video -->
                                                            @elseif (isset($information['video_url']) && isset($information['image_url']))
                                                            <!-- Video -->
                                                            <video width="100%" controls>
                                                                <source src="{{$information['video_url']}}" type="video/mp4">
                                                                Your browser does not support HTML video.
                                                            </video>
                                                            <!-- ./video -->
                                                            @else
                                                            @if($information->image_url != null)
                                                            <img src="{{$information->image_url->getUrl()}}" style="height: 300px" alt="" class="img-responsive">
                                                            @endif
                                                            @endif
                                                            <div class="vidoe-content">
                                                                {!! $information['description'] !!}
                                                            </div>
                                                        </div>
                                                        </div>
                                                    </div>

                                                @endforeach
                                            </div>
                                        @else
                                            No sub section   
                                        @endif
                                    </div>
                                    @endforeach
                                @endif
                            </div>
                            
                                    
                                    

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

{{--@include('layouts.partials._footer')--}}

<!-- /Main Content -->
</div>

</div>
<!-- /HK Wrapper -->

@include('layouts.partials._script')
@include('property_sections.partials.add_modal')
@include('property_sections.partials.edit_modal')


@endsection
