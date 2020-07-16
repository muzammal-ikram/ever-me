<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                Enter Section Title
            </div>
            <form
                action="{{url('properties/'.$property_id.'/property-resources/'.$property_resource_id.'/property-sections')}}"
                method="post" enctype="multipart/form-data">
                <div class="modal-body">

                    @csrf
                    <input type="text" class="form-control" name="section_name" id="section_name" placeholder="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary click_add_section">Add Section</button>
                </div>
            </form>
        </div>

    </div>
</div>


<script>
  $(window).keydown(function(event){
    if(event.keyCode == 13) {
      event.preventDefault();
      return false;
    }
  });
</script>    
