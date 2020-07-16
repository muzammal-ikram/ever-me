
<a href="#"><span title="Show" class="action-icon icon-eye" style="color: limegreen"></span></a>
{{--<a href=""><span title="Edit" class="action-icon icon-pencil" style="color: #ff9528"></span></a>--}}

<a href="{{url('properties/'.$property_section->property_id.'/property-resources/'.$property_section->property_resource_id.'/property-sections/'.$property_section->id.'/edit')}}">
    <span title="Edit" class="action-icon icon-pencil" style="color: #ff9528"></span>
</a>

<a href="javascript:void(0)" data-toggle="modal" data-target=".bd-example-modal-sm{{$property_section->id}}">
    <span title="Remove" class="action-icon icon-trash" style="color: red"></span>
</a>


<div class="row">
    <div class="modal fade bd-example-modal-sm{{$property_section->id}}"
         tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mySmallModalLabel">
                        Delete Property Resource: <strong>{{ $property_section->title }}</strong>
                    </h5>
                    <button type="button" class="close"
                            data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h6>Are you sure?</h6><br>
                    <form
                        action="{{url('properties/'.$property_section->property_id.'/property-resources/'.$property_section->property_resource_id.'/property-sections/'.$property_section->id)}}" method="post">
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

