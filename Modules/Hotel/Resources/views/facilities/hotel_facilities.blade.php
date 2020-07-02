@extends('layouts.master')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset(PLUGINS.'jquery/jquery-ui.css')}}">
    <link rel="stylesheet" href="{{ asset('/css/soap-icon.css')}}">
    
    

    
@endsection


@section('content')
<form method="POST" action="{{ route('facilities.hotel') }}" >
  
  @csrf
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Facilities</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/')}}">{{__('commun.home')}}</a></li>
              <li class="breadcrumb-item active">Facilities</li>
            </ol>
          </div>
        </div>
      </div>
      <div class="header-actions">
        {{-- <button  type="button" class="btn  btn-success boxcontent listsorthotel" data-toggle="modal" data-target="#modal-new-hotel-facility">+ Add hotel facility</button>
        <button  type="button" class="btn  btn-success boxcontent listsortRoom" data-toggle="modal" data-target="#modal-new-room-facility" style="display:none;">+ Add Room facility</button> --}}
        <button type="submit" class="btn btn-primary float-right savebtn"> {{ __('commun.save_change') }}</button>
        
        
      </div>
    </section>
    

     

    

    <section class="content">
      <div class="row">
        <div class="col-md-3">
          <style>
            :root {
              --menu-border-color: #989898;
              --menu-color-focus: #fcfcfc;
              --menu-radius: 5px;  

            }
            .facilities {
                margin: 0px;
                padding: 0px;
                border: 1px solid var(--menu-border-color);
                border-radius: var(--menu-radius);
            }
            .facilities li{
              background: #eeeeee;
              list-style: none;
              padding: 10px;
              border-top: 1px solid var(--menu-border-color)
            }
            .facilities li:hover{
              background-color: var(--menu-color-focus);
              color: #222;
              -webkit-transition: all 0.2s ease-out;
              -o-transition: all 0.2s ease-out;
              transition: all 0.2s ease-out;
              cursor: pointer;
            }

            .facilities .active{
              background-color: var(--menu-color-focus);
              color: #222;
              
            }

            .facilities .active:before{
              content: "";
              border:5px solid transparent;
              border-left:5px solid #000;
              display: inline-block;
              //margin: 5px;
            }

            .facilities li a {
                color: #000;
            }

             .facilities li:first-child {
                border-top: none;
                border-top-left-radius: var(--menu-radius);
                border-top-right-radius: var(--menu-radius);
            }

            .facilities li:last-child {
                border-bottom: none;
                border-bottom-left-radius: var(--menu-radius);
                border-bottom-right-radius: var(--menu-radius);
            } 
          </style>
          <div class="box" >
            <ul class="facilities">
              <li class="active" data-target="listsorthotel">Hotel  facilities</li>
              <li data-target="listsortRoom">Room  facilities</li>
            </ul>
        
          </div>
        </div>

        <style>
          #sortable { list-style-type: none; margin: 0; padding: 0px; }
          #sortable li { border-left: 4px solid #afafaf;margin: 5px; padding-left: 7px;  font-size: 16px;text-transform: uppercase;}
          

          
          #sortable li .icon {
              background: #17a2b8;
              color: #fff;
              width: 40px;
              display: inline-block;
              margin: 0px;
              line-height: 40px;
              text-align: center;
              font-size: 22px;
              margin-right:5px;
              margin-left: 5px;
          }
          #sortable li .fas {
            color: #a5a5a5;
          }

          #sortable li:hover {
            cursor: move;
          }

          .ui-state-highlight { height: 40px; border: 1px dotted #989898;background: #fffed0; }
          
        </style>
        
        <div class="col-md-9">
          <div  class="box boxcontent listsorthotel" >
            <input id="sorthotel" type="hidden" name="sorthotel" value="">
            <ul id="sortable">
              @foreach ($facilities_hotel as $item)
                <li class="ui-state-default" id="{{$item->id}}">
                  <i class="fas fa-ellipsis-v"></i>
                  <i class="fas fa-ellipsis-v"></i>
                  <div class="icon"><i class="{{$item->icon}}"></i>
                  </div> {{__($item->trans_key)}}
                </li>
              @endforeach
            </ul>
        
          </div>

          <div  class="box boxcontent listsortRoom" style="display:none;">
            <input id="sortroom" type="hidden" name="sortroom" value="" >
              xxx
          </div>
        </div>
      </div>
      
    
    </section>

    

    

  </div>
</form>
@endsection

@section('javascript')

  <script type="text/javascript">
    

      $(".facilities li").click(function(){
        $(".facilities li").removeClass("active");
        $(".boxcontent").hide();
        $(this).addClass("active");

        target=$(this).data('target');
        $("."+target).show();
        
      });

    
     

  </script>

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.10.12/dist/sweetalert2.all.min.js">


<script>
$( function() {
  $( "#sortable" ).sortable({
    placeholder: "ui-state-highlight"
  });
  $( "#sortable" ).disableSelection();
  $( "#sortable" ).on( "sortstop", function( event, ui ) {
    var sortedIDs = $( "#sortable" ).sortable( "toArray" );
    console.log(sortedIDs);
    $("#sorthotel").val(sortedIDs);
    //alert('hello');
  } );

  
} );
</script>
@endsection