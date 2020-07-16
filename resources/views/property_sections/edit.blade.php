
@extends('layouts.app')
@section('content')
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

        @if(count($errors))
        <div class="col-12">
            <ul class="alert alert-danger ">
                @foreach($errors->all() as $error)
                <li class="ml-4">{{$error}}</li>
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
                                    <h5><i data-feather="book"></i> Edit Property Sub Section </h5>
                                </div>
                                <div class="d-flex">                                      
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">

                <form action="{{url('section-info', $information['id'])}}" method="post" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="row">
                        <div class="col-lg-12 col-sm-12">

                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label for="property_name">Sub Section Title</label>
                                    <input type="hidden" name="section_id"
                                        value="{{$information['property_section_id']}}">
                                    <input type="hidden" name="info_id" value="{{$information['id']}}">
                                    <input type="text"
                                        value="@if(isset($information['title'])) {{$information['title']}} @endif"
                                        class="form-control" name="title" id="title" placeholder="" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label for="exampleFormControlTextarea1">Sub Section Description</label>
                                    <textarea class="form-control" name="description"
                                        id="ckeditor{{$information['id']}}"
                                        rows="3">@if(isset($information['description'])) {{$information['description']}} @endif</textarea>
                                    <script>
                                        $("textarea").each(function () {
                                            var editorId = $(this).attr("id");
                                            try {
                                                var instance = CKEDITOR.instances[editorId];
                                                if (instance) {
                                                    instance.destroy(true);
                                                }
                                            } catch (e) {} finally {
                                                CKEDITOR.replace(editorId);
                                            }
                                        });
                                    </script>
                                </div>
                            </div>
                            
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input add_video" id="customSwitch2"
                                    data-video-id="{{$information['property_section_id']}}">
                                <label class="custom-control-label" for="customSwitch2">Click to change</label>
                            </div>
                          
                            
                            <div class="row">
                            
                                <div class="col-12 form-group" id="image-div{{$information['property_section_id']}}" 
                                @if(($information->image_url && $information->video_url) || $information->image_url)  @else style="display: none" @endif>
                                    <label for="image_url">Picture</label>
                                    <div class="needsclick dropzone" id="editinfoimage-dropzone">

                                    </div>
                                </div>

                                <div class="col-12" 
                                    id="video-div{{$information['property_section_id']}}" 
                                    @if(($information->image_url && $information->video_url) || $information->video_url)  @else style="display: none" @endif>
                                    <div class="col-md-12 form-group">
                                        <label for="video_url">Add Video url</label>
                                        <input type="text" value="{{$information['video_url']}}" class="form-control" name="video_url" id="video_url"
                                            placeholder="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <br>
                    <button class="btn btn-primary" type="submit">Save Changes</button>
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
    Dropzone.options.editinfoimageDropzone = {
    url: '{{ route('sectioninfo.storeMedia') }}',
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
      $('form').find('input[name="image_url"]').remove()
      $('form').append('<input type="hidden" name="image_url" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="image_url"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($information) && $information->image_url)
      var file = {!! json_encode($information->image_url) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, '{{$information->image_url->getUrl('thumb')}}')
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="image_url" value="' + file.file_name + '">')
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

