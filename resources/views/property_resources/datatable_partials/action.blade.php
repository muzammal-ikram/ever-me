{{--<a href="#"><span title="Show" class="action-icon icon-eye" style="color: limegreen"></span></a>--}}
{{--<a href=""><span title="Edit" class="action-icon icon-pencil" style="color: #ff9528"></span></a>--}}

{{--<a href="javascript:void(0)" data-toggle="modal" data-target=".bd-example-modal-sm-{{$property_resource->id}}">
    <span title="Edit" class="action-icon icon-pencil" style="color: #ff9528"></span>
</a>--}}

{{--<a href="javascript:void(0)" data-toggle="modal" data-target=".bd-example-modal-sm{{$property_resource->id}}">
    <span title="Remove" class="action-icon icon-trash" style="color: red"></span>
</a>--}}

@if($property_resource->nearby != 1 && $property_resource->media != 1)
<a class="btn btn-primary" href="{{url('properties/'.$property_resource->property_id.'/property-resources/'.$property_resource->id.'/property-sections')}}" style="color: white">Edit Sections</a>
@endif

<div class="row">
    <div class="modal fade bd-example-modal-sm-{{$property_resource->id}}"
         tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mySmallModalLabel">
                        Edit Property Resource: <strong>{{ $property_resource->title }}</strong>
                    </h5>
                    <button type="button" class="close"
                            data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form
                        action="{{url('properties/'.$property_resource->property_id.'/property-resources/'.$property_resource->id)}}" method="post">
                        @method('put')
                        @csrf
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label for="property_name">Resource Title</label>
                                <input type="text" class="form-control" name="title" value="{{$property_resource->title}}" id="title" placeholder="" required>
                            </div>
                        </div>
                        <div class="float-right">
                            <button type="submit"
                                    class="btn btn-primary mx-a">Update
                            </button>
                            <button type="button"
                                    class="btn btn-secondary mx-a"
                                    data-dismiss="modal">Cancel
                            </button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="modal fade bd-example-modal-sm{{$property_resource->id}}"
         tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mySmallModalLabel">
                        Delete Property Resource: <strong>{{ $property_resource->title }}</strong>
                    </h5>
                    <button type="button" class="close"
                            data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h6>Are you sure?</h6><br>
                    <form
                        action="{{url('properties/'.$property_resource->property_id.'/property-resources/'.$property_resource->id)}}" method="post">
                        @method('delete')
                        @csrf
                        <input name="_method" type="hidden"
                               value="DELETE">
                        <div class="float-right">
                            <button type="submit"
                                    class="btn btn-primary mx-a">Yes
                            </button>
                            <button type="button"
                                    class="btn btn-secondary mx-a"
                                    data-dismiss="modal">No
                            </button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
