
    <div class="hotel-list listing-style3 hotel">
        @foreach($hotels as $hotel)
        <article class="box">
            <figure class="col-sm-5 col-md-4">
                <a title="" href="{{route('web.slideshow',$hotel->id)}}" class="hover-effect popup-gallery">
                    @if (isset($hotel->image_id))
                        <img width="270" height="160" src="{{asset(IMAGES_HOTELS.$hotel->image_id)}}"  />
                    @else
                        <img width="270" height="160" src="{{asset(IMAGES_HOTELS.'unnamed.png')}}"  />
                    @endif
                </a>
            </figure>
            <div class="details col-sm-7 col-md-8">
                <div>
                    <div>
                        <h4 class="box-title">{{$hotel->name}}<small><i class="soap-icon-departure yellow-color"></i> {{$hotel->city}}, {{getCountry($hotel->country,"fr")}}</small></h4>
                        {{-- <div class="amenities">
                            <i class="soap-icon-wifi circle"></i>
                            <i class="soap-icon-fitnessfacility circle"></i>
                            <i class="soap-icon-fork circle"></i>
                            <i class="soap-icon-television circle"></i>
                            
                        </div> --}}
                    </div>
                    <div>
                        <div class="five-stars-container" title="{{$hotel->star_rate}} stars">
                            <span class="five-stars" style="width: {{$hotel->star_rate*20}}%;"></span>
                        </div>
                        <span class="review">{{$hotel->star_rate}} stars</span>
                        {{-- <span class="review">270 reviews</span> --}}
                    </div>
                </div>
                <div>
                    <p>{{$hotel->shortdesc}}</p>
                    <div>
                    <span class="price " style="text-align: right;"><small>/{{plural("Nuit",$hotel->nbr_nights)}} </small><div style="display: inline-block;font-size: 18px;">{{$hotel->minprice}}</div> <div style="display: inline-block;font-size: 11px;">DHs</div></span>
                    <a class="button btn-small full-width text-center" title="" href="{{route('web.hotels.showHoteldetail')}}?idh={{$hotel->id}}">SELECT</a>
                        <button class="button btn-small full-width yellow  md-trigger" data-src='{{$hotel->embedmap}}'>MAP</button>
                    </div>
                </div>
            </div>
        </article>

        @endforeach
        
        {{-- <input type="hidden" class="rangemin" value="{{$hotels->min->minprice}}">
        <input type="hidden" class="rangemax" value="{{$hotels->max->minprice}}"> --}}
    </div>

    
  