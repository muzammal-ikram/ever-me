
@extends('layouts.app')
@section('content')


    <!-- HK Wrapper -->
    <div class="hk-wrapper hk-vertical-nav">

        @include('layouts.partials._header')

        @include('layouts.partials._leftSideNav')

    <!-- Main Content -->
        <div class="hk-pg-wrapper">

        <div class="container-fluid">

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
 

            <div class="row">
                <div class=" col-12" style="float: right">
                    <div class="card card-shadow mb-4">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    <div class="card-title">
                                        <div class="hk-pg-header mb-10">
                                            <div>
                                                <h5><i data-feather="book"></i> Properties </h5>
                                            </div>
                                            <div class="d-flex">
                                                    <a class="btn btn-primary btn-sm" href="{{url('properties/create')}}" style="color: white">Add Property</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                {!! $dataTable->table(['class' => 'table']) !!}
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


    @include('layouts.partials._script')

@endsection


@push('scripts')
    {!! $dataTable->scripts() !!}
@endpush
