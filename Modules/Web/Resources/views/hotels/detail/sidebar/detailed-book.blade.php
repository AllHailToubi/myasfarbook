<article class="detailed-logo">
    <figure>
        {{-- <img width="114" height="85" src="http://placehold.it/114x85" alt=""> --}}
        @if (isset($hotel->image_id))
            <img width="114" height="85" src="{{asset(IMAGES_HOTELS.$hotel->image_id)}}"  />
        @else
            <img width="270" height="160" src="{{asset(IMAGES_HOTELS.'unnamed.png')}}"  />
        @endif
    </figure>
    <div class="details">
        <h2 class="box-title">
            {{$hotel->name}}
            <small><i class="soap-icon-departure yellow-color"></i><span class="fourty-space">{{$hotel->city}}, {{getCountry($hotel->country,"fr")}}</span></small>
            <div title="4 stars" class="five-stars-container" data-toggle="tooltip" data-placement="bottom"><span class="five-stars" style="width: 80%;"></span></div>
        </h2>
        
            <span class="price clearfix">
            <small class="pull-left">3 nuits</small>
            <span class="pull-right">6750 Dhs</span>
        </span>
        
        
           <ul class="description">
               <li><strong>CHECK IN:</strong> 12/06/2020</li>
               <li><strong>CHECK OUT:</strong> 15/06/2020</li>
               <li><strong>GUESTS:</strong> 2xAdults + 1xEnfant</li>
           </ul>
        
        <a class="button yellow full-width uppercase btn-small">add to wishlist</a>
    </div>
</article>