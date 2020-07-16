<!-- Modal -->
<div id="mySectionInfoModal{{$section['id']}}" class="modal fade add_modal_section_info" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
            Sub Section
            </div>
            <form action="{{url('section-info')}}" method="post" enctype="multipart/form-data">

                <div class="card-body">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12 col-sm-12">

                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label for="property_name">Sub Section Title</label>
                                    <input type="hidden" name="section_id" value="{{$section['id']}}">
                                    <input type="text" class="form-control" name="title" id="title" placeholder=""
                                        required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label for="exampleFormControlTextarea1">Sub Section Description</label>
                                    <textarea class="form-control" name="description" id="ckeditor{{$section['id']}}"
                                        rows="3"></textarea>
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

                            <!-- Default switch -->

                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input add_video" id="customSwitch2"
                                    data-video-id="{{$section['id']}}" checked>
                                <label class="custom-control-label" for="customSwitch2">Switch to video</label>
                            </div>

                            <br>
                            <br>

                            <div class="row">
                                <div class="col-12 form-group" id="image-div{{$section['id']}}">
                                    <label for="image_url">Add Photo</label>
                                    <div class="needsclick dropzone" id="sectioninfoimage-dropzone">

                                    </div>
                                </div>

                                <div class="col-12" style="display: none" id="video-div{{$section['id']}}">
                                    <div class="col-md-12 form-group">
                                        <label for="video_url">Add Video url</label>
                                        <input type="text" class="form-control" name="video_url" id="video_url"
                                            placeholder="">
                                    </div>
                                </div>
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
    var uploadedDocumentMap = {}
    Dropzone.options.sectioninfoimageDropzone = {
        url: '{{ route('sectioninfo.storeMedia') }}',
        maxFiles: 1,
        maxFilesize: 2, // MB
        acceptedFiles: '.jpeg,.jpg,.png,.gif',
        addRemoveLinks: true,
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        success: function (file, response) {
            $('form').append('<input type="hidden" name="image_url" value="' + response.name + '">')
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
            $('form').find('input[name="image_url"][value="' + name + '"]').remove()
        },
        init: function () {
            @if(isset($project) && $project->document)
            var files = {
                !!json_encode($project->document) !!
            }
            for (var i in files) {
                var file = files[i]
                this.options.addedfile.call(this, file)
                file.previewElement.classList.add('dz-complete')
                $('form').append('<input type="hidden" name="image_url" value="' + file.file_name + '">')
            }
            @endif
        }
    }

</script>

@stop
