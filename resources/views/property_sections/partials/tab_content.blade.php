  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist" id="tablist">

    @if($section->sectionInformation->count() > 0)
        @foreach($section->sectionInformation as $key => $section_info)
            <li class="nav-item">
                <a class="nav-link @if($key == 0) active @endif" data-toggle="tab" href="#section-{{$section_info->id}}" onclick="loadSectionInfoTabContent({{$section_info->id}})">{{$section_info->title}}</a>
            </li>
        @endforeach
    @else
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#section-default" >Welcome</a>
        </li>
    @endif
  </ul>
<div class="tab-content" id="dynamic_section_tab">
@if($section->sectionInformation->count() > 0)
        @foreach($section->sectionInformation as $key => $section_info)
    <div class="bhoechie-tab-content container tab-pan @if($key == 0) active @endif" id="section-{{$section_info->id}}">
        <center>
        <div class="card-body test">
        <form action="/section-info/{{$section_info->id}}" method="post" enctype="multipart/form-data" id="updateSectionInformation">
                <input type="hidden" name="_method" value="PUT">
                @csrf
                <input type="hidden" name="property_section_id" value="{{$section_info->property_section_id}}">
                <div class="row">
                    <div class="col-lg-12 col-sm-12">
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label for="property_name">Section Information Title</label>
                                <input type="text" class="form-control" name="title" id="title" placeholder="" value="{{$section_info->title}}" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label for="exampleFormControlTextarea1">Section Information Description</label>
                                <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3">{{$section_info->description}}</textarea>
                                <script>
                                    CKEDITOR.replace( 'description' );
                                </script>

                            </div>
                        </div>
                        <div class="float-left">
                            <button type="button" class="btn btn-primary mx-a" onclick="add_image_input({{$section_info->id}})">
                                Add Image
                            </button>
                            <button type="button" class="btn btn-primary mx-a" onclick="add_video_input({{$section_info->id}})">
                                Add Video url
                            </button>
                        </div>
                        <br>
                        <br>
                        <div class="row">
                            <div class="col-12" style="display: none" id="image-div{{$section_info->id}}">
                                <div class="col-md-12 form-group">
                                    <label for="image_url">Add Image</label>
                                    <input type="file" class="" name="image_url" id="image_url" placeholder="" value="" accept=".png, .jpg, .jpeg">
                                </div>
                            </div>
                            <div class="col-12" style="display: none" id="video-div{{$section_info->id}}">
                                <div class="col-md-12 form-group">
                                    <label for="video_url">Add Video url</label>
                                    <input type="text" class="form-control" name="video_url" id="video_url" placeholder="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <button class="btn btn-primary" type="button" id="updateSectionInfo"> Save </button>
                {{--<button class="btn btn-primary">Preview</button>--}}
                <button class="btn btn-primary" type="button" onclick="deleteSectionInfo({{$section_info->id}})"> Remove </button>
                <button class="btn btn-primary" type="button" onclick="addNewTab({{$section_info->property_section_id}})"><h6 class="glyphicon glyphicon-plus"></h6> Add More</button>
            </form>
        </div>
        </center>
        </div>
        @endforeach

        @else
            <div class="bhoechie-tab-content container tab-pan active" id="section-default">
            <center>
            <div class="card-body test">
            <form action="/section-info" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="property_section_id" value="{{$section->id}}">
                    <div class="row">
                        <div class="col-lg-12 col-sm-12">
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label for="property_name">Section Information Title</label>
                                    <input type="text" class="form-control" name="title" id="title" placeholder="" value="" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label for="exampleFormControlTextarea1">Section Information Description</label>
                                    <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3"></textarea>
                                    <script>
                                        CKEDITOR.replace( 'description' );
                                    </script>

                                </div>
                            </div>
                            <div class="float-left">
                                <button type="button" class="btn btn-primary mx-a" onclick="add_image_input({{$section->id}})">
                                    Add Image
                                </button>
                                <button type="button" class="btn btn-primary mx-a" onclick="add_video_input({{$section->id}})">
                                    Add Video url
                                </button>
                            </div>
                            <br>
                            <br>
                            <div class="row">
                                <div class="col-12" style="display: none" id="image-div{{$section->id}}">
                                    <div class="col-md-12 form-group">
                                        <label for="image_url">Add Image</label>
                                        <input type="file" class="" name="image_url" id="image_url" placeholder="" value="" accept=".png, .jpg, .jpeg">
                                    </div>
                                </div>
                                <div class="col-12" style="display: none" id="video-div{{$section->id}}">
                                    <div class="col-md-12 form-group">
                                        <label for="video_url">Add Video url</label>
                                        <input type="text" class="form-control" name="video_url" id="video_url" placeholder="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <button class="btn btn-primary" type="submit" id=""> Save </button>
                    {{--<button class="btn btn-primary">Preview</button>--}}
                    <button class="btn btn-primary" type="button" onclick="deleteSection({{$section->id}})"> Remove </button>
                    <button class="btn btn-primary" type="button" onclick="addNewTab({{$section->id}})"><h6 class="glyphicon glyphicon-plus"></h6> Add More</button>
                </form>
            </div>
            </center>
            </div>
        @endif
<!-- Tab content start -->
<!-- tAB CONTENT END -->
</div>
