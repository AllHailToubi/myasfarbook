<div class="tab-container style1" id="hotel-main-content">
    <ul class="tabs">
        <li class="active"><a data-toggle="tab" href="#photos-tab">photos</a></li>
        <li><a data-toggle="tab" href="#map-tab-embeded">map</a></li>
        @if(!empty($hotel->video))
            <li><a data-toggle="tab" href="#steet-view-tab">video</a></li>
        @endif
        {{-- <li><a data-toggle="tab" href="#calendar-tab">calendar</a></li> --}}
        {{-- <li class="pull-right"><a class="button btn-small yellow-bg white-color" href="#">TRAVEL GUIDE</a></li> --}}
    </ul>
    <style>
        .crop img {
            max-height: 400px;
        }
    </style>
    @php $images = explode(",", $hotel->gallery);@endphp
    <div class="tab-content">
        <div id="photos-tab" class="tab-pane fade in active">
            <div class="photo-gallery style1" data-animation="slide" data-sync="#photos-tab .image-carousel">
                <ul class="slides">
                    @foreach($images as $img)   
                        <li class="crop"><img   src="{{asset(IMAGES_HOTELS.$img)}}" alt="" /></li>
                    @endforeach
                </ul>
            </div>
            <div class="image-carousel style1" data-animation="slide" data-item-width="70" data-item-margin="10" data-sync="#photos-tab .photo-gallery">
                <ul class="slides">
                    @foreach($images as $img)   
                        <li><img src="{{asset(IMAGES_HOTELS.$img)}}" alt="" /></li>
                    @endforeach
                </ul>
            </div>
        </div>
        
        <div id="map-tab-embeded" class="tab-pane fade">
            {!!$hotel->embedmap!!}
        </div>
        @if(!empty($hotel->video))
            <div id="steet-view-tab" class="tab-pane fade" style="height: 500px;">
                {!!convertYoutube($hotel->video)!!}
            </div>
        @endif
        {{-- <div id="calendar-tab" class="tab-pane fade">
            <label>SELECT MONTH</label>
            <div class="col-sm-6 col-md-4 no-float no-padding">
                <div class="selector">
                    <select class="full-width" id="select-month">
                        <option value="2014-6">June 2014</option>
                        <option value="2014-7">July 2014</option>
                        <option value="2014-8">August 2014</option>
                        <option value="2014-9">September 2014</option>
                        <option value="2014-10">October 2014</option>
                        <option value="2014-11">November 2014</option>
                        <option value="2014-12">December 2014</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-8">
                    <div class="calendar"></div>
                    <div class="calendar-legend">
                        <label class="available">available</label>
                        <label class="unavailable">unavailable</label>
                        <label class="past">past</label>
                    </div>
                </div>
                <div class="col-sm-4">
                    <p class="description">
                        The calendar is updated every five minutes and is only an approximation of availability.<br /><br />
                        Some hosts set custom pricing for certain days on their calendar, like weekends or holidays. The rates listed are per day and do not include any cleaning fee or rates for extra people the host may have for this listing. Please refer to the listing's Description tab for more details.
                        <br /><br />
                        We suggest that you contact the host to confirm availability and rates before submitting a reservation request.
                    </p>
                </div>
            </div>
        </div> --}}
    </div>
</div>