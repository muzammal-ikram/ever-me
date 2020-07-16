{{--<a href="javascript:void(0)" data-link="{{url('properties/guest_'.$property->uuid')}}"
onclick="copyToClipboard(this)"><span title="Copy link" class="action-icon icon-link"
    style="color: dodgerblue"></span></a>--}}

<div class="btn-group">
    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
        aria-expanded="false">
        Action
    </button>
    <div class="dropdown-menu">
        @if($property->preference == 0)
        <a class="dropdown-item" href="{{url('guest/site'.$property->id.'/'.$property->uuid.'')}}" target="_blank"><span
                title="Guest site" class="action-icon icon-link" style="color: dodgerblue"></span></a>
        @else
        <a class="dropdown-item" href="{{url('guest/site'.$property->id.'')}}" target="_blank"><span title="Guest site"
                class="action-icon icon-link" style="color: dodgerblue"></span></a>
        @endif
        <a class="dropdown-item" href="{{url('properties/'.$property->id.'/edit')}}"><span title="Edit"
                class="action-icon icon-pencil" style="color: #ff9528"></span></a>

        <a class="dropdown-item" href="javascript:void(0)" data-toggle="modal"
            data-target=".bd-example-modal-sm{{$property->id}}">
            <span title="Remove" class="action-icon icon-trash" style="color: red"></span>
        </a>
        <div class="dropdown-divider"></div>

        <a href="#" class="dropdown-item preferences"
            data-property-id="{{$property->id}}" data-preference="{{$property->preference}}" data-seo="{{$property->seo_hide}}">Visibility</a>

    </div>
</div>



<span class="tooltiptext">copied</span>
{{--<a href="#"><span title="Show" class="action-icon icon-eye" style="color: limegreen"></span></a>--}}




<a class="btn btn-primary" href="{{url('properties/'.$property->id.'/property-resources')}}"
    style="color: white">Blocks</a>



<!-- popup Shareable -->
<div class="modal fade" id="preferences" tabindex="-1" role="dialog" aria-labelledby="preferences_title"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body p-3">
                <!-- Popup Header -->
                <div class="modal-header border-0 pt-3 pb-3 pl-0 pr-0">
                    <!-- popup heading -->
                    <h5 class="modal-title" id="property_modal_title">Set Visibility</h5>
                    <!-- close button -->
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div><!-- ./Popup Header -->

                <!-- selected Platform message -->

                <form method="post" action="{{url('set_property_preference')}}" id="pageFormPopup">
                    @csrf
                    <input type="hidden" class="property_hidden" name="property_id">
                    <div class="form-group">
                        <label>Visibility</label>
                        <select name="preference_selected" id="preference_selected"
                            class="form-control location_selected" required>
                            <option value="0">Public</option>
                            <option value="1">Private</option>
                        </select>
                    </div>
                    <div class="row" id="property_password_div" style="display: none">
                        <div class="col-md-12 form-group">
                            <label for="property_password">Password</label>
                            <input type="password" class="form-control" name="property_password" class="field"
                                id="property_password">
                        </div>
                    </div>
                    <!-- Distance -->
                    <div class="form-group">
                        <label><b>Search Engines</b></label>
                        <select name="search_engine_selected" id="search_engine_selected"
                            class="form-control seo_selected" required>
                            <option value="1">Yes, let search engines find my property guide</option>
                            <option value="0">No, hide my property guide from search engines</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <button type="submit" id="preferences_submit"
                            class="btn btn-block btn-lg btn-info p-3">Apply</button>
                    </div>
                </form>


            </div><!-- ./modal body -->
        </div><!-- ./main modal-content -->
    </div><!-- ./main modal dialog -->
</div> <!-- ./popup Shareable -->




<div class="row">
    <div class="modal fade bd-example-modal-sm{{$property->id}}" tabindex="-1" role="dialog"
        aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mySmallModalLabel">
                        Delete Property <strong>{{ $property->property_name }}</strong>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h6>Are you sure?</h6><br>
                    <form {{--                        action="{{action('LotController@destroy', $property->id)}}"--}}
                        action="{{url('properties', $property->id)}}" method="post">
                        @method('delete')
                        @csrf
                        <input name="_method" type="hidden" value="DELETE">
                        <div class="float-right">
                            <button type="submit" class="btn btn-primary mx-a">Yes
                            </button>
                            <button type="button" class="btn btn-secondary mx-a" data-dismiss="modal">No
                            </button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('#preference_selected').on('change', function () {
        if (this.value == 1) {
            $("#property_password_div").show();
            // $('#property_password').attr('required', 'required');
        } else {
            $("#property_password_div").hide();
        }
    });

    $(document).on('click', '.preferences', function () {
        var id = $(this).data('property-id');
        var preference = $(this).data('preference');
        var seo = $(this).data('seo');

        $(".location_selected option[value=" + preference + "]").attr('selected','selected');
        if (preference == 1) {
            $("#property_password_div").show();
        } else {
            $("#property_password_div").hide();
        }
        $(".seo_selected option[value=" + seo + "]").attr('selected','selected');


        $('.property_hidden').val(id);
        $('#preferences').modal('toggle');
    });

</script>
