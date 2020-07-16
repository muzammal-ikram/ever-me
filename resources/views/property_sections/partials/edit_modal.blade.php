@foreach($sections as $key => $section)
<div id="edit_modal{{$section['id']}}" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                Edit Section Title
            </div>
            <form method="post" action="{{url('update-section')}}" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <input type="text" class="form-control" name="title" value="{{$section['title']}}" placeholder="">
                    <input type="hidden" name="section_id" value="{{$section['id']}}">
                    <input type="hidden" name="property_id" value="{{$section['property_id']}}">
                    <input type="hidden" name="property_resource_id" value="{{$section['property_resource_id']}}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Section</button>
                </div>
            </form>
        </div>

    </div>
</div>
@endforeach
