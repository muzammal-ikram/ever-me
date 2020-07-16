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

            @if (session('error'))
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
                                                <h5><i data-feather="book"></i> {{$property_resources['property']['property_name']}} </h5>
                                            </div>
                                            <div class="d-flex">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                        <form action="{{ url('store-resource-media') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                {{-- Name/Description fields, irrelevant for this article --}}

                                <div class="form-group">
                                    <label for="media">Add Property Media</label>
                                    <div class="needsclick dropzone" id="media-dropzone">
                                        <input type="hidden" name="property_id" value="{{$property_resources['property_id']}}" />
                                        <input type="hidden" name="property_resource_id" value="{{$property_resources['id']}}" />
                                    </div>
                                </div>
                                <div>
                                    <input class="btn btn-danger" type="submit">
                                </div>
                            </form>
                            
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


@section('scripts')
<script>
  var uploadedDocumentMap = {}
  Dropzone.options.mediaDropzone = {
    url: '{{ route('resource.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="media_image[]" value="' + response.name + '">')
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
      $('form').find('input[name="media_image[]"][value="' + name + '"]').remove()
    },
    init: function () {
      @if(isset($property_resources) && $property_resources->property_property_media)
        var files =
          {!! json_encode($property_resources->property_property_media->media_image) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.thumbnail)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="media_image[]" value="' + file.file_name + '">')
        }
      @endif
    }
  }
</script>
@stop
