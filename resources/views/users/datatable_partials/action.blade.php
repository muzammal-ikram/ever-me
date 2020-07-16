{{--<a href="#"><span title="Copy link" class="action-icon icon-link" style="color: dodgerblue"></span></a>--}}
{{--<a href="#"><span title="Show" class="action-icon icon-eye" style="color: limegreen"></span></a>--}}

<a href="javascript:void(0)" data-toggle="modal" data-target=".bd-example-modal-sm{{$user->id}}">
    <span title="Remove" class="action-icon icon-trash" style="color: red"></span>
</a>


<div class="row">
    <div class="modal fade bd-example-modal-sm{{$user->id}}"
         tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mySmallModalLabel">
                        Delete User <strong>{{ $user->name }}</strong>
                    </h5>
                    <button type="button" class="close"
                            data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h6>Are you sure?</h6><br>
                    <form action="{{url('users', $user->id)}}" method="post">
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
