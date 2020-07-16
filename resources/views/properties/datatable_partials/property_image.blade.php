<div class="row">
@if(isset($property->property_image))
    <img class="brand-img d-inline-block mr-10" src="{{$property->property_image->getUrl('thumb')}}" alt="brand" height="50px" width="50px"/>
@else
    <img class="brand-img d-inline-block mr-10" src="dist/img/bg.jpg" alt="brand" height="50px" width="50px"/>
@endif
<span style="padding-top: 2%">{{$property->property_name}}</span>
</div>

