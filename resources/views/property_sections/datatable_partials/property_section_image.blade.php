
@if($property_section->image_url)
    <img class="brand-img d-inline-block mr-10" src="{{asset($property_section->image_url)}}" alt="brand" height="50px" width="50px"/>
@else
No Image
@endif

