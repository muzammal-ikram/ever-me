<!-- Modal -->
<div id="mySectionInfoEditModal{{$information['id']}}" class="modal fade edit_modal_section_info" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
            Sub section
            </div>
            <form action="{{url('section-info', $information['id'])}}" method="post" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="card-body">
                        
                        <div class="row">
                            <div class="col-lg-12 col-sm-12">

                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <label for="property_name">Section Title</label>
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
                                        <label for="exampleFormControlTextarea1">Section Description</label>
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

                                <div class="form-group">
                                    <label for="image_url">Picture</label>
                                    <div class="needsclick dropzone" id="editinfoimage-dropzone">

                                    </div>
                                </div>

                                <div class="row">
                                    @if($information['video_url'] != NULL)

                                    <div class="col-12" id="edit-video-div">
                                        <div class="col-md-12 form-group">
                                            <label for="video_url">Update Video url</label>
                                            <input type="text" class="form-control" name="video_url" id="video_url"
                                                value="{{$information['video_url']}}" placeholder="">
                                        </div>
                                    </div>

                                    @else
                                    <div class="col-12" id="edit-video-div">
                                        <div class="col-md-12 form-group">
                                            <label for="video_url">Add Video url</label>
                                            <input type="text" class="form-control" name="video_url" id="video_url"
                                                placeholder="">
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit">Save Changes</button>
                </div>
            </form>
        </div>

    </div>
</div>


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
