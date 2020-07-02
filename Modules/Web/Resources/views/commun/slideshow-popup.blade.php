
<style>
   
    .crop img {
        max-height: 400px;
    }
</style>
@php $images = explode(",", $hotel->gallery);@endphp
<div class="photo-gallery style1" id="photo-gallery1" data-animation="slide" data-sync="#image-carousel1">
    <ul class="slides">
       
        
        @foreach($images as $img)   
        
            <li class="crop"><img   src="{{asset(IMAGES_HOTELS.$img)}}" alt="" /></li>
        
        @endforeach
       
    </ul>
</div>
<div class="image-carousel style1" id="image-carousel1" data-animation="slide" data-item-width="70" data-item-margin="10" data-sync="#photo-gallery1">
    <ul class="slides">

        @foreach($images as $img)   
            <li><img src="{{asset(IMAGES_HOTELS.$img)}}" alt="" /></li>
        @endforeach
        
    </ul>
</div>