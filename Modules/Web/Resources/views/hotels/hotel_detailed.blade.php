@extends('web::layouts.master')

@section('css')
    
    <!-- Current Page Styles -->
    <link rel="stylesheet" type="text/css" href="{{ asset('web/components/revolution_slider/css/settings.css')}}" media="screen" />
    <link rel="stylesheet" type="text/css" href="{{ asset('web/components/revolution_slider/css/style.css')}}" media="screen" />
    <link rel="stylesheet" type="text/css" href="{{ asset('web/components/jquery.bxslider/jquery.bxslider.css')}}" media="screen" />
    <link rel="stylesheet" type="text/css" href="{{ asset('web/components/flexslider/flexslider.css')}}" media="screen" />

    <style>
        ul.description {
            list-style: disc;
            margin: 10px 0px 10px 15px;
        }
    </style>
@endsection

@section('banner')
    <div class="container">
        <div class="page-title pull-left">
        <h2 class="entry-title">Details of hotel: {{$hotel->name}}</h2>
        </div>
        <ul class="breadcrumbs pull-right">
            <li><a href="#">HOME</a></li>
            <li class="active">Hotel Detailed</li>
        </ul>
    </div>
@endsection

@section('main')
    <div class="row">
        <div id="main" class="col-md-9">
             {{-- ####################### Hotel Gallery,Map,video  ########################--}}
             @include('web::hotels.detail.hotel-main-content')
            

            {{-- ######## Hotel features: Description,availability,Facilities,reviews,... ###########--}}
            <div id="hotel-features" class="tab-container">
                <ul class="tabs">
                    <li class="active"><a href="#hotel-description" data-toggle="tab">Description</a></li>
                    {{-- <li><a href="#hotel-availability" data-toggle="tab">Availability</a></li> --}}
                    <li><a href="#hotel-amenities" data-toggle="tab">Facilities</a></li>
                    {{-- <li><a href="#hotel-reviews" data-toggle="tab">Reviews</a></li> --}}
                    {{-- <li><a href="#hotel-faqs" data-toggle="tab">FAQs</a></li> --}}
                    {{-- <li><a href="#hotel-things-todo" data-toggle="tab">Things to Do</a></li> --}}
                    {{-- <li><a href="#hotel-write-review" data-toggle="tab">Write a Review</a></li> --}}
                </ul>
                <div class="tab-content">

                    {{-- ####################### Hotel Description  ########################--}}
                    @include('web::hotels.detail.features.hotel-description')
                    
                    {{-- ####################### Hotel availability  ########################--}}
                    {{-- @include('web::hotels.detail.availability') --}}
                    
                    {{-- ####################### Hotel Facilities  ########################--}}
                    @include('web::hotels.detail.features.facilities_hotel')

                    {{-- ####################### Hotel reviews  ########################--}}
                    {{-- @include('web::hotels.detail.features.reviews') --}}

                    {{-- ####################### Hotel faqs  ########################--}}
                    {{-- @include('web::hotels.detail.features.faqs') --}}
                    
                    {{-- ####################### Hotel things-todo  ########################--}}
                    {{-- @include('web::hotels.detail.features.things-todo') --}}

                    {{-- ####################### Hotel write-review  ########################--}}
                    {{-- @include('web::hotels.detail.features.write-review') --}}
                    
                   
                    
                </div>
            
            </div>
        </div>
        <div class="sidebar col-md-3">
            {{-- ####################### Hotel Sidebar detailed-book ########################--}}
            @include('web::hotels.detail.sidebar.detailed-book')
            

            <div class="travelo-box contact-box">
                <h4>Need Travelo Help?</h4>
                <p>We would be more than happy to help you. Our team advisor are 24/7 at your service to help you.</p>
                <address class="contact-details">
                    <span class="contact-phone"><i class="soap-icon-phone"></i> 1-800-123-HELLO</span>
                    <br>
                    <a class="contact-email" href="#">help@travelo.com</a>
                </address>
            </div>
            <div class="travelo-box">
                <h4>Similar Listings</h4>
                <div class="image-box style14">
                    <article class="box">
                        <figure>
                            <a href="#"><img src="http://placehold.it/63x59" alt="" /></a>
                        </figure>
                        <div class="details">
                            <h5 class="box-title"><a href="#">Plaza Tour Eiffel</a></h5>
                            <label class="price-wrapper">
                                <span class="price-per-unit">$170</span>avg/night
                            </label>
                        </div>
                    </article>
                    <article class="box">
                        <figure>
                            <a href="#"><img src="http://placehold.it/63x59" alt="" /></a>
                        </figure>
                        <div class="details">
                            <h5 class="box-title"><a href="#">Sultan Gardens</a></h5>
                            <label class="price-wrapper">
                                <span class="price-per-unit">$620</span>avg/night
                            </label>
                        </div>
                    </article>
                    <article class="box">
                        <figure>
                            <a href="#"><img src="http://placehold.it/63x59" alt="" /></a>
                        </figure>
                        <div class="details">
                            <h5 class="box-title"><a href="#">Park Central</a></h5>
                            <label class="price-wrapper">
                                <span class="price-per-unit">$322</span>avg/night
                            </label>
                        </div>
                    </article>
                </div>
            </div>
            <div class="travelo-box book-with-us-box">
                <h4>Why Book with us?</h4>
                <ul>
                    <li>
                        <i class="soap-icon-hotel-1 circle"></i>
                        <h5 class="title"><a href="#">135,00+ Hotels</a></h5>
                        <p>Nunc cursus libero pur congue arut nimspnty.</p>
                    </li>
                    <li>
                        <i class="soap-icon-savings circle"></i>
                        <h5 class="title"><a href="#">Low Rates &amp; Savings</a></h5>
                        <p>Nunc cursus libero pur congue arut nimspnty.</p>
                    </li>
                    <li>
                        <i class="soap-icon-support circle"></i>
                        <h5 class="title"><a href="#">Excellent Support</a></h5>
                        <p>Nunc cursus libero pur congue arut nimspnty.</p>
                    </li>
                </ul>
            </div>
            
        </div>
    </div>
@endsection


@section('js')
<script type="text/javascript" src="{{ asset('web/js/calendar.js')}}"></script>

<script type="text/javascript">
    tjq(document).ready(function() {
        // calendar panel
        var cal = new Calendar();
        var unavailable_days = [17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27,  29, 30, 31];
        var price_arr = {3: '$170', 4: '$170', 5: '$170', 6: '$170', 7: '$170', 8: '$170', 9: '$170', 10: '$170', 11: '$170', 12: '$170', 13: '$170', 14: '$170', 15: '$170', 16: '$170', 28: '1500Dhs'};

        var current_date = new Date();
        var current_year_month = (1900 + current_date.getYear()) + "-" + (current_date.getMonth() + 1);
        tjq("#select-month").find("[value='" + current_year_month + "']").prop("selected", "selected");
        cal.generateHTML(current_date.getMonth(), (1900 + current_date.getYear()), unavailable_days, price_arr);
        tjq(".calendar").html(cal.getHTML());
        
        tjq("#select-month").change(function() {
            var selected_year_month = tjq("#select-month option:selected").val();
            var year = parseInt(selected_year_month.split("-")[0], 10);
            var month = parseInt(selected_year_month.split("-")[1], 10);
            cal.generateHTML(month - 1, year, unavailable_days, price_arr);
            tjq(".calendar").html(cal.getHTML());
        });
        
        
        tjq(".goto-writereview-pane").click(function(e) {
            e.preventDefault();
            tjq('#hotel-features .tabs a[href="#hotel-write-review"]').tab('show')
        });
        
        // editable rating
        tjq(".editable-rating.five-stars-container").each(function() {
            var oringnal_value = tjq(this).data("original-stars");
            if (typeof oringnal_value == "undefined") {
                oringnal_value = 0;
            } else {
                //oringnal_value = 10 * parseInt(oringnal_value);
            }
            tjq(this).slider({
                range: "min",
                value: oringnal_value,
                min: 0,
                max: 5,
                slide: function( event, ui ) {
                    
                }
            });
        });
    });
    
    tjq('a[href="#map-tab"]').on('shown.bs.tab', function (e) {
        var center = panorama.getPosition();
        google.maps.event.trigger(map, "resize");
        map.setCenter(center);
    });
    tjq('a[href="#steet-view-tab"]').on('shown.bs.tab', function (e) {
        fenway = panorama.getPosition();
        panoramaOptions.position = fenway;
        panorama = new google.maps.StreetViewPanorama(document.getElementById('steet-view-tab'), panoramaOptions);
        map.setStreetView(panorama);
    });
    var map = null;
    var panorama = null;
    var fenway = new google.maps.LatLng(48.855702, 2.292577);
    var mapOptions = {
        center: fenway,
        zoom: 12
    };
    var panoramaOptions = {
        position: fenway,
        pov: {
            heading: 34,
            pitch: 10
        }
    };
    function initialize() {
        tjq("#map-tab").height(tjq("#hotel-main-content").width() * 0.6);
        map = new google.maps.Map(document.getElementById('map-tab'), mapOptions);
        panorama = new google.maps.StreetViewPanorama(document.getElementById('steet-view-tab'), panoramaOptions);
        map.setStreetView(panorama);
    }
    google.maps.event.addDomListener(window, 'load', initialize);
</script>

    
@endsection