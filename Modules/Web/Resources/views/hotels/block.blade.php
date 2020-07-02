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

    @media (max-width: 480px){
        .image-box .box img, .image-box.box img {
            width: 100%;
            height: auto;
        }
    }
   
</style>   

    {{-- ############# List hotels ################### --}}
    <div class="hotel-list">
        <div class="row image-box listing-style2">
            @foreach($hotels as $hotel)
            <div class="col-sms-6 col-sm-6 col-md-4">
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
                        <a title="View all" href="{{route('web.hotels.showHoteldetail')}}?idh={{$hotel->id}}" class="pull-right button uppercase">select</a>
                        <h6 class="box-title">{{$hotel->name}}  </h6>
                        <label class="price-wrapper">
                            <span class="price-per-unit">{{$hotel->minprice}} DHs</span>/{{plural("Nuit",$hotel->nbr_nights)}}
                        </label>
                    </div>
                </article>
            </div>

            @endforeach
            {{-- ############# Fin List hotels ############### --}}
        </div>
    </div>
    