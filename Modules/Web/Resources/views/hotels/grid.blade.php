<style>
    .box{
        //height: 350px;
    }
    .box-title{
        text-overflow: ellipsis;
        white-space: nowrap;
        overflow: hidden;
        text-transform: uppercase;
        margin-bottom: 2px!important; 
    }
    .separator{
        border-bottom: 1px solid #f5f5f5;
    }
    .price {
        color: #7db921;
        font-size: 1.3em;
        text-transform: uppercase;
        float: right;
        text-align: right;
        line-height: 1;
        font-weight: 700;
        display: block;
    }
    .image-box .box > .details, .image-box.box > .details {
        padding: 7px 9px;
    }

    p.description {
        height: 64px;
        overflow: hidden;
        margin-bottom: 5px;
    }
    .image-box .box img, .image-box.box img {
        width: 100%;
        height: 140px;
    }

    @media (max-width: 775px){
        .image-box .box img, .image-box.box img {
            width: 100%;
            height: auto;
        }
    }
</style>    


    {{-- ############# List hotels ################### --}}
    <div class="hotel-list">
        <div class="row image-box hotel listing-style1">
            @foreach($hotels as $hotel)
                <div class="col-sm-6 col-md-4">
                    <article class="box">
                        <figure>
                        <a href="{{route('web.slideshow',$hotel->id)}}" class="hover-effect popup-gallery">
                                @if (isset($hotel->image_id))
                                    <img width="270" height="160" src="{{asset(IMAGES_HOTELS.$hotel->image_id)}}"  />
                                @else
                                    <img width="270" height="160" src="{{asset(IMAGES_HOTELS.'unnamed.png')}}"  />
                                @endif
                            </a>
                        </figure>
                        <div class="details">
                            <h6 class="box-title">{{$hotel->name}}  </h6>
                            
                            <div class="box-title"><small>{{$hotel->city}}, {{getCountry($hotel->country,"fr")}}<div style="float:right">/{{plural("Nuit",$hotel->nbr_nights)}}</div></small></div>
                            
                            <div class="box-title">
                                <div data-placement="bottom" data-toggle="tooltip" class="five-stars-container" title="{{$hotel->star_rate}} stars">
                                    <span style="width: {{$hotel->star_rate*20}}%;" class="five-stars"></span>
                                </div>
                                
                                <span class="price" style="float:right">{{$hotel->minprice}} DHs</span>
                            </div>
                                                                   
                            <div class="separator"></div>

                            <p class="description">{{$hotel->shortdesc}}</p>
                            <div class="action">
                                <a class="button btn-small" href="{{route('web.hotels.showHoteldetail')}}?idh={{$hotel->id}}">SELECT</a>
                                <button class="button btn-small yellow  md-trigger" data-src='{{$hotel->embedmap}}'>VIEW ON MAP</button>

                                {{-- <a class="button btn-small yellow popup-map" href="#" data-box="{{$hotel->map_lat}},{{$hotel->map_lng}}">VIEW ON MAP</a> --}}
                            </div>                                      
                            
                        </div>
                    </article>
                </div>
            @endforeach
            {{-- ############# Fin List hotels ############### --}}
        </div>
    </div>
    