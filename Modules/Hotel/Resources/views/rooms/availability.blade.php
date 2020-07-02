@extends('layouts.master')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset(PLUGINS.'jquery/jquery-ui.css')}}">
    {{-- <link rel="stylesheet" href="{{ asset(PLUGINS.'daterangepicker/daterangepicker.css')}}"> --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    

    <style>
      thead td {
        //font-size: 12px;
        font-weight: bold;
        }
      
      tbody td {
        font-size: 15px;
        min-width:50px;
        padding:0px;
        
      }
      .content_cell{
        text-align:center;
        min-width:70px;
        height:50px;
        padding:0px;
        display: table-cell;
        vertical-align: middle!important;
      }
      .content_cell:hover{
        background-color:aliceblue;
        
      }

      .text-disable{
        color:#bbbbbb;
      }

      
      .fist-line{
        background-color:#ffffff;
        display: table-cell;
        vertical-align: middle!important;
      }


    </style>
    <style>
      .ui-widget-header{
        //background:#ff0000;
      }
      .ui-widget.ui-widget-content {
      
        box-shadow: 0px 0px 7px 0px #cecece;
      }
      
       
</style>
@endsection


@section('content')
  <div class="content-wrapper">

    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3>{{__('room.rooms availability')}} - {{__('menu.hotel')}}: {{$hotel->name}}</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/')}}">{{ __('commun.home') }}</a></li>
              <li class="breadcrumb-item"><a href="{{route('hotel.allHotels')}}">{{__('hotel.all_hotels')}}</a></li>
              <li class="breadcrumb-item"><a href="{{route('hotel.allRooms',$hotel->id)}}">{{__('room.all_rooms')}}</a></li>
              <li class="breadcrumb-item active">Rooms Avibility</li>
            </ol>
          </div>
        </div>
      </div>
      <div class="header-actions">
        <a href="{{route('hotel.allRooms',$hotel->id)}}" class="btn btn-info">< {{__('commun.back')}} </a>
      </div>
    </section>
    

    <section class="content">
      <div class="box">
        
        <div style="margin:5px;">
          <div class="row border" style="margin:5px 0px; padding:2px; background-color:#e9ecef;">
            <div class="col-1" style="padding:0px;"><button id="btn-previous" class="btn btn-light btn-sm" onclick="previous()"><<</button></div>
            <div class="col-10 " style="padding:0px;text-align:center;font-weight: 700;margin-top: auto;margin-bottom: auto;" id="month">April</div>
            <div class="col-1"style="text-align:right;padding:0px;"><button id="btn-next" class="btn btn-sm btn-light" onclick="next()">>></button></div>
          </div>
        
            
          <div class="table-basic border">
            <table cellspacing="0" id="table-basic" class="table table-sm table-bordered table-striped" style="min-width: 1200px;">
              <thead id="calendar-thead"></thead>
              <tbody id="calendar-body"></tbody>
            </table>
          </div>
        </div>
      </div>
      

      <div id="dialog-form" title="Room: x" style=" display: none;">
        <div style="min-height:150px">
          <div class="form-group">
            <label>{{__('commun.price')}}</label>
            
            <div class="input-group">
              <input  type="text"  id="dialog-price" value="" name="price" placeholder="" class="form-control">
              <div class="input-group-append">
                <span class="input-group-text">{{devise()}}</span>
              </div>
            </div>

            <div class="form-check  col-sm">
              <input class="form-check-input" id="default-price" type="checkbox" >
              <label class="form-check-label font-italic">Defaut price</label>
            </div>

            <div class="form-check  col-sm">
              <input class="form-check-input" id="dialog-block" type="checkbox" >
              <label class="form-check-label font-italic text-danger"><i class="fas fa-ban"></i>Block</label>
            </div>

          </div>
          <div class="form-group">
            <label>Date range:</label>
  
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  <i class="far fa-calendar-alt"></i>
                </span>
              </div>
              <input type="text" class="form-control float-right" id="reservation">
            </div>
            <!-- /.input group -->
          </div>

          <div class="form-group">
            <label>Days</label>
           
            
            <div id="boder-days" class="row border" style="padding:10px;">
              <div class="form-check col-sm-3">
                <input class="form-check-input" id="Mon" type="checkbox" checked>
                <label class="form-check-label">Mon</label>
              </div>
              <div class="form-check  col-sm-3">
                <input class="form-check-input" id="Tue" type="checkbox" checked>
                <label class="form-check-label">Tue</label>
              </div>
              <div class="form-check  col-sm-3">
                <input class="form-check-input" id="Wed" type="checkbox" checked>
                <label class="form-check-label">Wed</label>
              </div>
              <div class="form-check  col-sm-3">
                <input class="form-check-input" id="Thu" type="checkbox" checked>
                <label class="form-check-label">Thu</label>
              </div>
              <div class="form-check  col-sm-3">
                <input class="form-check-input" id="Fri" type="checkbox" checked>
                <label class="form-check-label">Fri</label>
              </div>
              <div class="form-check  col-sm-3">
                <input class="form-check-input" id="Sat" type="checkbox" checked>
                <label class="form-check-label">Sat</label>
              </div>
              <div class="form-check  col-sm-3">
                <input class="form-check-input" id="Sun" type="checkbox" checked>
                <label class="form-check-label font-weight-bold">Sun</label>
              </div>
            </div>
          </div>

       
         

          
        </div>
      </div>
  
      
    
    </section>

   
    

    
    

  </div>
@endsection

@section('javascript')
  <script src="{{ asset(JS_ADMIN.'dialog.js')}}"></script>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="{{ asset(JS_ADMIN.'freeze-table.js')}}"></script>
  {{-- <script src="{{ asset(PLUGINS.'daterangepicker/daterangepicker.js')}}"></script> --}}
  <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
  
  
 
  <script>

    $.ajaxSetup({ 
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var dialog;
    idmonth= document.getElementById("month");
    monthsNames = [   "January",   "February",   "March",   "April",   "May",   "June",   "July",   "August",   "September",   "October",   "November",   "December" ];
    months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    daysNames = [   "Mon",   "Tue",   "Wed",   "Thu",   "Fri",   "Sat",   "Sun" ]; 
    
    today = new Date();
    
    currentMonth = today.getMonth();
    currentYear = today.getFullYear();
    
    thisDay=today.getDate();
    thisMonth=currentMonth;
    thisYear=currentYear;

    maxdate = new Date();
    maxdate.setMonth(currentMonth + 17);
    maxMonth = maxdate.getMonth();
    maxYear = maxdate.getFullYear();

    mindate = new Date();
    //thisday = mindate.getDate();
    mindate.setDate(thisDay - 15);
    
    minMonth = mindate.getMonth();
    minYear = mindate.getFullYear();

    var startdialog,enddialog;


    
    
  
    
    myAjax();

    function saveChange() {
            var valid = true;


            
            myAjax();
            dialog.dialog( "close" );
            return valid;
    }

    function isEmpty(str) {
      return !str.trim().length;
    }

    function showdialog(id_td,id_room,room_name,price,day,month,year){
      // console.log("=>"+month+'/'+day+'/'+year);
      // console.log(thisMonth+'/'+thisDay+'/'+thisYear);
      d0=new Date((month-1)+'/'+day+'/'+year);
      d1=new Date(thisMonth+'/'+thisDay+'/'+thisYear);
        // d1=new Date(day+'/'+month+'/'+year);
        // d0=new Date("DD/MM/YYYY");
        
         if(d1>d0){
          return;
         }

        $('#Mon').prop('checked', true);
        $('#Tue').prop('checked', true);
        $('#Wed').prop('checked', true);
        $('#Thu').prop('checked', true);
        $('#Fri').prop('checked', true);
        $('#Sat').prop('checked', true);
        $('#Sun').prop('checked', true);
        $('#default-price').prop('checked', false);
        $('#dialog-block').prop('checked', false);

        $("#dialog-price").removeClass( "is-invalid" );
        $("#boder-days").removeClass( "border-danger" );
        $("#dialog-price").prop( "disabled", false );
        

        lastval="";
        $('#default-price').change(function() {
          if($(this).is(":checked")) {
            lastval= $("#dialog-price").val();
            dp=$("#"+id_td).attr('dprice');
            $("#dialog-price").val(dp);
            $("#dialog-price").prop( "disabled", true );
              //return;
          }else{
            
            $("#dialog-price").val(lastval);
            $("#dialog-price").prop( "disabled", false );
          }
          //'unchecked' event code
        });

        dialog = $( "#dialog-form" ).dialog({
              title:room_name,
              autoOpen: false,
              height: 'auto',
              width: 350,
              modal: true,
              position: { my: "center top", at: "center top+100", of: window },
              buttons: {
              "Save": function(){
                dprice=$("#dialog-price").val();
                //console.log(id_room+" "+startdialog+" "+enddialog+"  "+dprice);
                chked="";
                chked+=$('#Mon').prop('checked')?'1,':'';
                chked+=$('#Tue').prop('checked')?'2,':'';
                chked+=$('#Wed').prop('checked')?'3,':'';
                chked+=$('#Thu').prop('checked')?'4,':'';
                chked+=$('#Fri').prop('checked')?'5,':'';
                chked+=$('#Sat').prop('checked')?'6,':'';
                chked+=$('#Sun').prop('checked')?'0,':'';
                chked = chked.replace(/,\s*$/, "");
                
                
                priceval= $("#dialog-price").val();
                
                if(isEmpty(priceval) || isNaN(priceval)){
                  $("#dialog-price").addClass( "is-invalid" );
                  console.log("input empty");
                  return;
                }

                if(priceval<0){
                  $("#dialog-price").addClass( "is-invalid" );
                  console.log("input 0");
                  return;
                }
                
                
                if(chked===""){
                  $("#boder-days").addClass( "border-danger" );
                  console.log("chked");
                  return;
                }

                isdefault=0;
                if($('#default-price').prop('checked')){
                  isdefault=1;
                }

                isdispo=1;
                if($('#dialog-block').prop('checked')){
                  isdispo=0;
                }


                
                
                //return;
                $.ajax({
                    url: "{{ route('hotel.avibilitySetPrice',$hotel->id) }}",
                    method: "POST",
                    data: { "id_room":id_room,"strat_date":startdialog,"end_date":enddialog,"price":dprice,"chked":chked,"isdefault":isdefault,"isdispo":isdispo },

                    beforeSend: function() {
                    
                    },
                    success: function(dataresult) {
                      console.log(dataresult);
                      myAjax();
                      dialog.dialog( "close" );
                    },
                    error: function(jqXhr, textStatus, errorMessage) { // error callback 
                      dialog.dialog( "close" );
                    }
                });
                
              },
              Cancel: function() {dialog.dialog( "close" );}
              },
              close: function() {
              }
        });

        startdialog=enddialog=year+'-'+month+'-'+day;
        //document.getElementById("dialog-price").setAttribute('value', price);  
       // 10-2020-04-17
        
        
        //console.log(id_td);
        price=$("#"+id_td).attr('price');
        $("#dialog-price").val(price)
        dialog.dialog( "open" );
       
        $('#reservation').daterangepicker({
          "locale": {
                    "format": "DD/MM/YYYY",
                    "separator": " ==> ",
                  },
          "startDate": day+"/"+month+"/"+year,
          "endDate": day+"/"+month+"/"+year,
          "minDate": thisDay+"/"+(thisMonth+1)+"/"+thisYear,
          "maxDate": "01/"+(maxMonth+2)+"/"+maxYear
        },
          function(start, end, label) {
            startdialog=start.format('YYYY-MM-DD');
            enddialog=end.format('YYYY-MM-DD');
          });

        //console.log(thisDay+"/"+(thisMonth+1)+"/"+thisYear);

    }
    

    function showCalendar(month, year) {

      if(month===minMonth && year===minYear){
        document.getElementById("btn-previous").disabled = true;
      }else{
        document.getElementById("btn-previous").disabled = false;
      }

      if(month===maxMonth && year===maxYear){
        document.getElementById("btn-next").disabled = true;
      }else{
        document.getElementById("btn-next").disabled = false;
      }
      
      currentYear=year;
      currentMonth=month;
      idmonth.innerHTML=monthsNames[month]+" "+year;
      let daysmonth=daysInMonth(month, year);
      tblh= document.getElementById("calendar-thead");
      tblb = document.getElementById("calendar-body");
      
      let row='<tr><td class="fist-line">Rooms\\days</td>';
      for (let i = 0; i < daysmonth; i++) {
        let Day = (new Date(year, month,i)).getDay();
        d1 = new Date(year, month,i+1);
        d0=new Date((thisMonth+1)+'/'+thisDay+'/'+thisYear);

        cls="";
        if(d0>d1){
          cls='class="text-disable"';
        }


        if(Day===6){
          row+='<td '+cls+' style="text-align:center;background-color: #fff6ea;">'+(i+1)+"<br>"+daysNames[Day]+"</td>";
        }else{
          row+='<td '+cls+' style="text-align:center">'+(i+1)+"<br>"+daysNames[Day]+"</td>";
        }
      }
      row+="</tr>";
      tblh.innerHTML=row;
      row="";
      for(room=0;room<data.length;room++){
        row+="<tr>";
        row+='<td style="white-space: nowrap;font-weight: bold;" class="fist-line">'+data[room].name+"</td>";
        for (let i = 0; i < daysmonth; i++) {
          d1 = new Date(year, month,i+1);
          d0=new Date((thisMonth+1)+'/'+thisDay+'/'+thisYear);
          let d = ("0" + (i+1)).slice(-2);
          let m = ("0" + (month+1)).slice(-2);
          //console.log(d0+"    "+d1);
          id_td=data[room].id+'-'+year+'-'+m+'-'+d;

          if(d0<=d1){
            row+='<td class="content_cell " id="'+id_td+'" price="'+data[room].price+'" dprice="'+data[room].price+'" onClick="showdialog(\''+id_td+'\','+data[room].id+',\''+data[room].name+'\','+data[room].price+','+d+','+m+','+year+');">'+data[room].price+"</td>";
          }else{
            row+='<td class="content_cell text-disable" id="'+id_td+'" price="'+data[room].price+'" dprice="'+data[room].price+'">'+data[room].price+"</td>";
          }
          
        }
        row+="</tr>";
      }
      
      
      
      tblb.innerHTML=row;
      
      if(pricing!=null){
        for(p=0;p<pricing.length;p++){
          if(pricing[p].status===1){
            document.getElementById(pricing[p].id+"-"+pricing[p].date).innerHTML='<b class="text-primary">'+pricing[p].price+'</b>';
          }
            
          else
            document.getElementById(pricing[p].id+"-"+pricing[p].date).innerHTML='<b class="text-danger" style="font-size:22px;"><i class="fas fa-ban"></i></b>';
          
            $("#"+pricing[p].id+"-"+pricing[p].date).attr("price",pricing[p].price);
        }
      }

    }
    
    function daysInMonth(iMonth, iYear) {
      return 32 - new Date(iYear, iMonth, 32).getDate();
    }
    
    function next() {
      currentYear = (currentMonth === 11) ? currentYear + 1 : currentYear;
      currentMonth = (currentMonth + 1) % 12;
      myAjax();
    }

    function myAjax(){
      $.ajax({
          url: "{{ route('hotel.avibilityMonth',$hotel->id) }}",
          method: "POST",
          data: { "month":(currentMonth+1),"year":currentYear },

          beforeSend: function() {
           
          },
          success: function(dataresult) {
       
            data = JSON.parse(dataresult.data);
            pricing = JSON.parse(dataresult.avibility);
           
            showCalendar(currentMonth, currentYear);
            $(".table-basic").freezeTable(); 
          },
          error: function(jqXhr, textStatus, errorMessage) { // error callback 

          }
      });
    }
    
    function previous() {
      currentYear = (currentMonth === 0) ? currentYear - 1 : currentYear;
      currentMonth = (currentMonth === 0) ? 11 : currentMonth - 1;
      myAjax();
    }
    
    
    $(document).ready(function() {
      $(".table-basic").freezeTable(); 
      
      
    });
  </script>


<script>
    $( function() {
        
      
        

        

        
        
    });
</script>

  
  
@endsection