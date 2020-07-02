@extends('web::layouts.master')

@section('css')
    <!-- Current Page Styles -->
    <link rel="stylesheet" type="text/css" href="{{ asset('web/components/revolution_slider/css/settings.css')}}" media="screen" />
    <link rel="stylesheet" type="text/css" href="{{ asset('web/components/revolution_slider/css/style.css')}}" media="screen" />
    <link rel="stylesheet" type="text/css" href="{{ asset('web/components/jquery.bxslider/jquery.bxslider.css')}}" media="screen" />
    <link rel="stylesheet" type="text/css" href="{{ asset('web/components/flexslider/flexslider.css')}}" media="screen" />
    <link rel="stylesheet" href="{{ asset(PLUGINS.'select2/dist/css/select2.min.css')}}">
@endsection

@section('banner')
    <div class="container">
        <div class="page-title pull-left">
            <h2 class="entry-title">Recherche d'hôtels</h2>
        </div>
        <ul class="breadcrumbs pull-right">
            <li><a href="#">Accueil</a></li>
            <li class="active">Recherche d'hôtels</li>
        </ul>
    </div>
@endsection

@section('main')
    <div class="row">
        <div class="col-sm-4 col-md-3">
            {{-- <h4 class="search-results-title"><i class="soap-icon-search"></i><b>1,984</b> results found.</h4> --}}
            <div class="toggle-container filters-container">
                <div class="panel style1 arrow-right">
                    <h4 class="panel-title">
                        <style>#modify-search-title:before { content: none;}</style>
                        <a id="modify-search-title">Modify Search</a>
                    </h4>
                    <div id="modify-search-panel" >
                        <div class="panel-content">
                            
                                <div class="form-group">
                                    <label>destination</label>
                                    {{-- <input type="text" class="input-text full-width" placeholder="" value="Paris" /> --}}
                                    <select id="city" name="city" class=" input-text full-width select2 " >
                                        <option value="">All</option>
                                        @foreach ($hotelCities as $citie)  
                                          <option value="{{$citie->city}}" >{{$citie->city}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>check in</label>
                                    <div class="datepicker-wrap">
                                        <input type="text" id="date_from" name="date_from" data-min-date="{{date("d/m/Y")}}" class="input-text full-width"  />
                                    </div>
                                    <span id="error_date_from" class="text-danger">
                                        
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label>check out</label>
                                    <div class="datepicker-wrap">
                                        <input type="text" id="date_to" name="date_to" data-min-date="{{(new DateTime('+1 day'))->format('d/m/Y')}}" class="input-text full-width"  />
                                    </div>
                                    <span id="error_date_to" class="text-danger">
                                        
                                    </span>
                                    <div id="stay"></div>
                                </div>
                                <br />
                                
                                
                                <button id="search-again" class="btn-medium icon-check uppercase full-width">
                                    search again</button>

                                    
                            
                        </div>
                    </div>
                </div>

                {{-- <div class="panel style1 arrow-right">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" href="#price-filter" class="collapsed">Price</a>
                    </h4>
                    <div id="price-filter" class="panel-collapse collapse">
                        <div class="panel-content">
                            <div id="price-range"></div>
                            <br />
                            <span class="min-price-label pull-left"></span>
                            <span class="max-price-label pull-right"></span>
                            <div class="clearer"></div>
                        </div><!-- end content -->
                    </div>
                </div> --}}
                
                {{-- <div class="panel style1 arrow-right">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" href="#rating-filter" class="collapsed">User Rating</a>
                    </h4>
                    <div id="rating-filter" class="panel-collapse collapse">
                        <div class="panel-content">
                            <div id="rating" class="five-stars-container editable-rating"></div>
                            <br />
                            <small>2458 REVIEWS</small>
                        </div>
                    </div>
                </div> --}}
                
                {{-- <div class="panel style1 arrow-right">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" href="#accomodation-type-filter" class="collapsed">Accomodation Type</a>
                    </h4>
                    <div id="accomodation-type-filter" class="panel-collapse collapse">
                        <div class="panel-content">
                            <ul class="check-square filters-option">
                                <li><a href="#">All<small>(722)</small></a></li>
                                <li><a href="#">Hotel<small>(982)</small></a></li>
                                <li><a href="#">Resort<small>(127)</small></a></li>
                                <li class="active"><a href="#">Bed &amp; Breakfast<small>(222)</small></a></li>
                                <li><a href="#">Condo<small>(158)</small></a></li>
                                <li><a href="#">Residence<small>(439)</small></a></li>
                                <li><a href="#">Guest House<small>(52)</small></a></li>
                            </ul>
                            <a class="button btn-mini">MORE</a>
                        </div>
                    </div>
                </div> --}}
                
                <div class="panel style1 arrow-right">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" href="#amenities-filter" class="collapsed">Amenities</a>
                    </h4>
                    <div id="amenities-filter" class="panel-collapse collapse">
                        <div class="panel-content">
                            <ul class="check-square filters-option">
                                @foreach ($facilities_hotel as $key=>$item)
                                    @if($key==5)
                                        <div id="facilities_hotel_more_li" style="display: none;">
                                    @endif
                                        <li class="facilities_hotel" data-id="{{$item->id}}"><a href="#">{{__($item->trans_key)}}<small></small></a></li>
                                    
                                @endforeach
                                        </div>
                                
                            </ul>
                            <a id="facilities_hotel_btn_more" class="button btn-mini">MORE</a>
                        </div>
                    </div>
                </div>
                
                {{-- <div class="panel style1 arrow-right">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" href="#language-filter" class="collapsed">Host Language</a>
                    </h4>
                    <div id="language-filter" class="panel-collapse collapse">
                        <div class="panel-content">
                            <ul class="check-square filters-option">
                                <li><a href="#">English<small>(722)</small></a></li>
                                <li><a href="#">Español<small>(982)</small></a></li>
                                <li class="active"><a href="#">Português<small>(127)</small></a></li>
                                <li class="active"><a href="#">Français<small>(222)</small></a></li>
                                <li><a href="#">Suomi<small>(158)</small></a></li>
                                <li><a href="#">Italiano<small>(439)</small></a></li>
                                <li><a href="#">Sign Language<small>(52)</small></a></li>
                            </ul>
                            <a class="button btn-mini">MORE</a>
                        </div>
                    </div>
                </div> --}}
                
               
            </div>
        </div>
        <div class="col-sm-8 col-md-9">
            <div class="sort-by-section clearfix">
                <h4 class="sort-by-title block-sm">Sort results by:</h4>
                <ul class="sort-bar clearfix block-sm">
                    <li class="sort-by-name sort-type active active-sort-type"  data-type="name" ><a class="sort-by-container" href="#"><span>name</span></a></li>
                    <li class="sort-by-price sort-type"  data-type="minprice" ><a class="sort-by-container" href="#"><span>price</span></a></li>
                    {{-- <li class="clearer visible-sms"></li>
                    <li class="sort-by-rating "><a class="sort-by-container" href="#"><span>rating</span></a></li>
                    <li class="sort-by-popularity"><a class="sort-by-container" href="#"><span>popularity</span></a></li> --}}
                </ul>
                
                <ul class="swap-tiles clearfix block-sm">
                    <li class="swap-list list-type active active-list-type" data-type="list" data-link="{{url('web/hotels/list/list')}}">
                        <a ><i class="soap-icon-list"></i></a>
                    </li>
                    <li class="swap-grid list-type" data-type="grid" data-link="{{url('web/hotels/list/grid')}}">
                        <a ><i class="soap-icon-grid"></i></a>
                    </li>
                    <li class="swap-block list-type" data-type="block" data-link="{{url('web/hotels/list/block')}}">
                        <a ><i class="soap-icon-block" ></i></a>
                    </li>
                </ul>
            

            </div>
        
            <div id="list_hotels"> 
                @include('web::hotels.list')
            </div>
            <a href="#" class="uppercase full-width button btn-large">load more listing</a>
        </div>    
    </div>   
@endsection


@section('js')
<script src="{{ asset(PLUGINS.'select2/dist/js/select2.full.min.js')}}"></script>
<script>



    tjq(document).ready(function() {

        tjq("#facilities_hotel_btn_more").on("click",function(){
            tjq("#facilities_hotel_more_li").show(500);
            tjq(this).hide();
        });


        function setSliderValue(min,max){
            // tjq("#price-range").slider( "option", "min", min);
            // tjq("#price-range").slider( "option", "max", max );
            //tjq(".min-price-label").html( tjq("#price-range").slider( "values", 0 )+"DHs");
            //tjq(".max-price-label").html( tjq("#price-range").slider( "values", 1 )+"DHs");
           
        }

        tjq('.select2').select2();

        
        tjq("#price-range").slider({
                range: true,
                min: 0,
                max: 6000,
                values: [ 0, 6000 ],
                slide: function( event, ui ) {
                    tjq(".min-price-label").html(  ui.values[ 0 ] +"DHs");
                    tjq(".max-price-label").html( ui.values[ 1 ]+"DHs");
                },
                stop( event, ui ){
                    //alert(tjq("#price-range").slider( "values", 0 ));
                }
        });
       

        tjq(".min-price-label").html( tjq("#price-range").slider( "values", 0 )+"DHs");
        tjq(".max-price-label").html( tjq("#price-range").slider( "values", 1 )+"DHs");

        var tody = new Date();
        tjq("#date_from").datepicker("setDate", tody);
        tody.setDate(tody.getDate() + 1);
        tjq("#date_to").datepicker("setDate", tody);

        tjq('.list-type').on('click', function(e) {
            tjq('.list-type').removeClass('active-list-type active');
            tjq(this).addClass('active active-list-type');
            

            url=tjq(this).data("link");
            list_type=tjq(".active-list-type").data("type");
            myajax();
            
        });

        tjq('.sort-type').on('click', function(e) {
            tjq('.sort-type').removeClass('active-sort-type active');
            tjq(this).addClass('active active-sort-type');
            myajax();
 
        });

        tjq("#date_from ,#date_to").change(function() { 
            //alert("change"); 
        }); 

        tjq('#search-again').on('click', function(e) {
            
            //console.log(all);
            
            date_from=tjq('#date_from').val();
            date_to=tjq('#date_to').val();
            tjq('#error_date_from').html("");
            tjq('#error_date_to').html("");
            tjq('#search-again').prop('disabled', true);

            if(!date_from){
                tjq('#error_date_from').html("<strong>Date incorrecte</strong>");
            }

            if(!date_to){
                tjq('#error_date_to').html("<strong>Date incorrecte</strong>");
            }

            //console.log(diffDays(date_from,date_to));
            stay_days=diffDays(date_from,date_to);
            tjq('#stay').html("Séjour de "+stay_days+" nuit");
            if(stay_days>1)
                tjq('#stay').html("Séjour de "+stay_days+" nuits");
            
            if(compare(date_from,date_to)){
                myajax();
            }else{
                tjq('#error_date_from').html("<strong>Date incorrecte</strong>");
                tjq('#error_date_to').html("<strong>Date incorrecte</strong>");
            }
           
        });

        //concert dd/mm/yyyy to yyyy-mm-dd
        function convertDate(datestr,offsetday=0){
            var dateParts = datestr.split("/");
            var dateObject = new Date(+dateParts[2], dateParts[1] - 1, +dateParts[0]); 
            dateObject.setDate(dateObject.getDate()+offsetday)
            dd=dateObject.getDate();
            mm=dateObject.getMonth()+1;
            yy=dateObject.getFullYear();

            return yy+"-"+mm+"-"+dd;
        }

        function diffDays(datestr_from,datestr_to){
            const _MS_PER_DAY = 1000 * 60 * 60 * 24;
            if(!datestr_from){
                return 0;
            }

            if(!datestr_to){
                return 0;
            }


            var dateParts_from = datestr_from.split("/");
            var dateObject_from = new Date(+dateParts_from[2], dateParts_from[1] - 1, +dateParts_from[0]); 
        
            var dateParts_to = datestr_to.split("/");
            var dateObject_to = new Date(+dateParts_to[2], dateParts_to[1] - 1, +dateParts_to[0]); 


            return Math.floor((dateObject_to-dateObject_from) / _MS_PER_DAY);
            //return dateObject_to-dateObject_from;
        }

        function compare(datestr_from,datestr_to){
            if(!datestr_from){
                return false;
            }

            if(!datestr_to){
                return false;
            }


            var dateParts_from = datestr_from.split("/");
            var dateObject_from = new Date(+dateParts_from[2], dateParts_from[1] - 1, +dateParts_from[0]); 
        
            var dateParts_to = datestr_to.split("/");
            var dateObject_to = new Date(+dateParts_to[2], dateParts_to[1] - 1, +dateParts_to[0]); 
        
            return datestr_from<datestr_to;
        }
        

        function myajax(){
            url=tjq('.active-list-type').data("link");
            list_type=tjq(".active-list-type").data("type");
            sort_type=tjq(".active-sort-type").data("type");
            city=tjq('#city').val();
            date_from=tjq('#date_from').val();
            date_from=convertDate(date_from);

            date_to=tjq('#date_to').val();
            date_to=convertDate(date_to,-1);

            var facilities_hotel = tjq(".facilities_hotel.active").map(function() {
                return this.getAttribute('data-id');
            }).get();
            console.log(facilities_hotel);
            
            
            tjq.ajax({
                url: url,
                type: 'get',
                data: { sort_type:sort_type,city:city,date_from:date_from,date_to:date_to,facilities_hotel:facilities_hotel },
                dataType: 'html',
                success: function(html) {
                    
                    tjq('#list_hotels').html(html);
                    tjq('#search-again').prop('disabled', false);
                   
                }
            });
        }



        
    });
</script>
    
@endsection