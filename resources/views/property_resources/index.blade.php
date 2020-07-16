@extends('layouts.app')
@section('content')


<!-- HK Wrapper -->
<div class="hk-wrapper hk-vertical-nav">

    @include('layouts.partials._header')

    @include('layouts.partials._leftSideNav')

    <!-- Main Content -->
    <div class="hk-pg-wrapper">

        <div class="container-fluid">

            @if (session('success'))
            <div class="container-fluid">
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            </div>
            @endif

            <div class="row">
                <div class=" col-12" style="float: right">
                    <div class="card card-shadow mb-4">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    <div class="card-title">
                                        <div class="hk-pg-header mb-10">
                                            <div>
                                                <h5><i data-feather="book"></i> {{$resources['property_name']}} </h5>
                                            </div>
                                            <div class="d-flex">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Property Blocks</h5>

                            <div class="row">
                                @foreach($resources['property_resources'] as $property_resource)

                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

                                    <div class="card" >

                                        <div class="card-body">
                                            @if($property_resource['nearby'] != 1 && $property_resource['media'] != 1)
                                            <a href="{{url('properties/'.$property_resource['property_id'].'/property-resources/'.$property_resource['id'].'/property-sections')}}">
                                                <h5 class="card-title">{{$property_resource['title']}}</h5>
                                                <a href="{{url('properties/'.$property_resource['property_id'].'/property-resources/'.$property_resource['id'].'/property-sections')}}" class="card-link">Click to add</a>
                                                <a href="{{url('properties/'.$property_resource['property_id'].'/property-resources/'.$property_resource['id'].'/property-sections')}}"><span title="Edit" class="action-icon icon-plus"
                                                    style="color: #ff9528; float:right"></span></a>
                                            </a>
                                            @elseif($property_resource['media'] == 1)
                                            <a href="{{ url('property-resources/'.$property_resource['id']) }}">
                                                <h5 class="card-title">{{$property_resource['title']}}</h5>
                                                <a href="{{ url('property-resources/'.$property_resource['id']) }}" class="card-link">Click to add</a>
                                                <a href="{{ url('property-resources/'.$property_resource['id']) }}"><span title="Edit" class="action-icon icon-plus"
                                                    style="color: #ff9528; float:right"></span></a>
                                            </a>
                                            @else
                                            <h5 class="card-title">{{$property_resource['title']}}</h5>
                                            <a href="#" class="card-link">Can't edit this block</a>

                                            @endif
                                        </div>

                                    </div>

                                </div>

                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        @include('layouts.partials._footer')

        <!-- /Main Content -->
    </div>

</div>
<!-- /HK Wrapper -->


<!-- create Modal -->

<div class="row">
    <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mySmallModalLabel">
                        Add Property Blocks
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="#" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label for="property_name">Resource Title</label>
                                <input type="text" class="form-control" name="title" id="title" placeholder="" required>
                            </div>
                        </div>

                        <div class="float-right">
                            <button type="submit" class="btn btn-primary mx-a">Add
                            </button>
                            <button type="button" class="btn btn-secondary mx-a" data-dismiss="modal">Cancel
                            </button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- End create Modal -->

@include('layouts.partials._script')

@endsection
