
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
                        <div class="col-sm-12 col-md-9">
                            <div class="card-title">
                                <h5><i data-feather="users"></i> Users </h5>
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
