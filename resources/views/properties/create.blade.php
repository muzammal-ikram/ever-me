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

    .container {
        max-width: 800px !important;
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

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
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
                                    <h5><i data-feather="book"></i> Add Property </h5>
                                </div>
                                <div class="d-flex">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">

                <form method="post" action="{{url('properties')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 col-sm-12">

                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label for="property_name">Property Name</label>
                                    <input type="text" class="form-control" name="property_name" id="property_name"
                                        placeholder="" value="{{old('property_name')}}" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label for="property_address">Property Address</label>
                                    <div id="locationField">
                                        <input id="autocomplete" class="form-control" name="property_address"
                                            placeholder="Property address" onFocus="geolocate()" type="text" required>
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
                                    <input type="text" class="form-control" name="property_city" class="field"
                                        id="locality">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="property_state">State</label>
                                    <input type="text" class="form-control" name="property_state" class="field"
                                        id="administrative_area_level_1">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="property_zipcode">ZipCode</label>
                                    <input type="hidden" class="field" id="postal_code">
                                    <input type="hidden" class="field" id="country">
                                    <input type="number" class="form-control" name="property_zipcode"
                                        id="property_zipcode" placeholder="" value="{{old('property_zipcode')}}"
                                        required>
                                </div>
                            </div>
                            
                            <label for="document">Listing Photo</label>
                            <div class="form-group dropzone needs-validation" id="propertyimage-dropzone">
                                <div class="fallback">
                                    <input name="file" type="file" required>

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
                                        placeholder="" value="{{old('host_name')}}" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="host_phone">Host Phone</label>
                                    <input type="number" class="form-control" name="host_phone" id="host_phone"
                                        placeholder="" value="{{old('host_phone')}}" required>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="host_other_phone">Host Other Phone</label>
                                    <input type="number" class="form-control" name="host_other_phone"
                                        id="host_other_phone" placeholder="" value="{{old('host_other_phone')}}">
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
                                <div class="col-md-12 form-group">
                                    <select name="host_platform[]" id="host_platform" multiple="multiple"
                                        class="form-control select2 select2-multiple">
                                        @foreach($platform as $platform)
                                        <option value="{{$platform['id']}}">{{$platform['platform_name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>



                        </div>


                    </div>
                    <hr>
                    <div class="save_button" style="float: right">
                        <button class="btn btn-primary" id="onsubmitproperty" type="submit">Save Changes</button>
                    </div>

                </form>
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

@section('scripts')
<script>
  var uploadedDocumentMap = {}
  Dropzone.options.propertyimageDropzone = {
    url: '{{ route('property.storeMedia') }}',
    maxFiles: 1,
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="property_image" value="' + response.name + '">')
      uploadedDocumentMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedDocumentMap[file.name]
      }
      $('form').find('input[name="property_image"][value="' + name + '"]').remove()
    },
    init: function () {
        
    }
  }

</script>


<script>
  var uploadedDocumentMap = {}
  Dropzone.options.hostphotoDropzone = {
    url: '{{ route('property.storeMedia') }}',
    maxFiles: 1,
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="host_photo" value="' + response.name + '" required="required">')
      uploadedDocumentMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedDocumentMap[file.name]
      }
      $('form').find('input[name="host_photo"][value="' + name + '"]').remove()
    },
    init: function () {
      @if(isset($project) && $project->document)
        var files =
          {!! json_encode($project->document) !!}
        for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="host_photo" value="' + file.file_name + '" required="required">')
        }
      @endif
    }
  }



</script>

@stop

