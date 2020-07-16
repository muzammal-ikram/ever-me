@extends('layouts.app')
@section('content')


<!-- HK Wrapper -->
<div class="hk-wrapper hk-vertical-nav">

    @include('layouts.partials._header')

    @include('layouts.partials._leftSideNav')


  
    <!-- Main Content -->
    <div class="hk-pg-wrapper">
    

        @include('layouts.partials._footer')


    </div>
    <!-- /Main Content -->

</div>
<!-- /HK Wrapper -->


@include('layouts.partials._script')

@endsection
