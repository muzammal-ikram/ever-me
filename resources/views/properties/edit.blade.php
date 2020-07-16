

@extends('layouts.app')
@section('content')

<style>
    .vl {
        border-left: 2px solid lightgray;
        height: 100%;
        position: absolute;
        left: 50%;
        margin-left: -3px;
        top: 0;
    }

    @media only screen and (max-width: 1000px) {
        .vl {
            display: none;
        }
    }

    .custom-padding {
        padding-left: 10%;
    }

    .img-thumbnail {
    max-width: 100%;
    height: 150px !important;
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

        <div class="card card-shadow mb-4">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <div class="card-title">
                            <div class="hk-pg-header mb-10">
                                <div>
                                    <h5><i data-feather="book"></i> Edit Property </h5>
                                </div>
                                <div class="d-flex">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">

                <form method="post" action="{{url('properties/'.$property['id'])}}" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 col-sm-12">

                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label for="property_name">Property Name</label>
                                    <input type="text" class="form-control" name="property_name" id="property_name"
                                        placeholder="" value="{{$property['property_name']}}" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label for="property_address">Property Address</label>
                                    <div id="locationField">
                                        <input id="autocomplete" class="form-control" name="property_address"
                                            placeholder="Property address" value="{{$property['property_address']}}"
                                            onFocus="geolocate()" type="text" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <input type="hidden" class="field" id="street_number">
                                <input type="hidden" class="field" id="route">
                                <input name="lat" id="latitude" hidden>
                                <input name="long" id="longitude" hidden>
                                <div class="col-md-4 form-group">
                                    <label for="property_city">City</label>
                                    <input type="text" class="form-control" name="property_city"
                                        value="{{$property['property_city']}}" class="field" id="locality" required>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="property_state">State</label>
                                    <input type="text" class="form-control" name="property_state"
                                        value="{{$property['property_state']}}" class="field"
                                        id="administrative_area_level_1" required>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="property_zipcode">ZipCode</label>
                                    <input type="hidden" class="field" id="postal_code">
                                    <input type="hidden" class="field" id="country">
                                    <input type="number" class="form-control" name="property_zipcode"
                                        id="property_zipcode" placeholder="" value="{{$property['property_zipcode']}}"
                                        required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="document">Listing Photo</label>
                                <div class="needsclick dropzone" id="propertyimage-dropzone">

                                </div>
                            </div>
                        </div>

                        <div class="vl"></div>

                        <div class="col-lg-6 col-sm-12">

                            <div class="col-md-12 form-group">
                                <div class="form-group row">
                                    <label class="col-form-label col-6 pt-0">Host Info</label>
                                    <div class="custom-control custom-checkbox mb-15">
                                        <input class="custom-control-input property_user_account" id="chkbox_horizontal"
                                            type="checkbox" name="auth_host">
                                        <label class="custom-control-label" for="chkbox_horizontal">Use Account
                                            Profile</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label for="host_name">Host Name</label>
                                    <input type="text" class="form-control" name="host_name" id="host_name"
                                        placeholder="" value="{{$property['host_name']}}" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="host_phone">Host Phone</label>
                                    <input type="number" class="form-control" name="host_phone" id="host_phone"
                                        placeholder="" value="{{$property['host_phone']}}" required>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="host_other_phone">Host Other Phone</label>
                                    <input type="number" class="form-control" name="host_other_phone"
                                        id="host_other_phone" placeholder="" value="{{$property['host_other_phone']}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="document">Host Photo</label>
                                <div class="needsclick dropzone" id="hostphoto-dropzone">

                                </div>
                            </div>

                            <hr>

                            <div class="form-group">
                                <label><b>Platforms (used for contact host page)</b></label>

                                <select name="host_platform[]" id="host_platform" multiple="multiple"
                                        class="form-control select2 select2-multiple">
                                    @foreach($platforms as $platform)
                                    <option value="{{$platform['id']}}" {{ isset($ids) && in_array($platform['id'], $ids) ? 'selected' : '' }}>{{$platform['platform_name']}}</option>
                                    @endforeach
                                </select>
                            </div>



                        </div>
                    </div>

                    <hr>

                    <div style="float: right">
                        <button class="btn btn-primary" type="submit">Save Changes</button>
                    </div>

                </form>

            </div>
        </div>





        @include('layouts.partials._footer')

        <!-- /Main Content -->
    </div>

</div>
<!-- /HK Wrapper -->


@include('layouts.partials._script')

@endsection

@section('scripts')

<script>
    Dropzone.options.propertyimageDropzone = {
    url: '{{ route('property.storeMedia') }}',
    maxFiles: 1,
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="property_image"]').remove()
      $('form').append('<input type="hidden" name="property_image" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="property_image"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($property) && $property->property_image)
      var file = {!! json_encode($property->property_image) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, '{{$property->property_image->getUrl('thumb')}}')
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="property_image" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}
</script>



<script>
    Dropzone.options.hostphotoDropzone = {
    url: '{{ route('property.storeMedia') }}',
    maxFiles: 1,
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="host_photo"]').remove()
      $('form').append('<input type="hidden" name="host_photo" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="host_photo"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($property) && $property->host_photo)
      var file = {!! json_encode($property->host_photo) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, '{{$property->host_photo->getUrl('thumb')}}')
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="host_photo" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}
</script>
@stop

