@extends('layouts.master')

@section('css')
    <style>
      td form {
          display: inline-block;
      }
    </style>
@endsection


@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{__('hotel.all_hotels')}}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/')}}">{{__('commun.home')}}</a></li>
              <li class="breadcrumb-item active">{{__('hotel.all_hotels')}}</li>
            </ol>
          </div>
        </div>
      </div>
      <div class="header-actions">
        <button  type="button" class="btn  btn-success" data-toggle="modal" data-target="#modal-new-hotel">+ {{__('hotel.add_new_hotel')}}</button>
          {{-- <a class="btn  btn-primary" href="{{url('/hotel/edit/')}}">{{__('hotel.add_new_hotel')}}</a>  --}}
        <a href="{{route('hotel.allArchiveHotels')}}" class="btn btn-warning float-right savebtn">{{__('hotel.show_archived_hotels')}}</a>
      </div>
    </section>
    <style>
      .td_img{
        padding: 3px!important;
      }

     

    </style>

    <section class="content">
      <div class="box">
        <table id="tablehotels" class="table  table-hover display responsive nowrap "style="width:100%;min-height:250px;">
          <thead>
            <tr>
              <th></th>
              <th>{{__('commun.name')}}</th>
              <th>{{__('commun.status')}}</th>
              
              <th width="1px"></th>
            </tr>
          </thead>
          <tbody>
            @foreach($hotels as $hotel)
              <tr>
                <td class="td_img">
                  @if (isset($hotel->image_id))
                    <img width="108px" height="56px" src="{{asset(IMAGES_HOTELS.$hotel->image_id)}}?t={{rand()}}"  />
                  @else
                    <img width="108px" height="56px" src="{{asset(IMAGES_HOTELS.'unnamed.png')}}"  />
                  @endif
                  
                
                
                </td>
                <td>{{$hotel->name}}</td>
                
                <td>
                  @if($hotel->status)
                    <span class="badge badge-success">{{__('commun.published_m')}}</span>
                  @else
                    <span class="badge badge-danger">{{__('commun.suspended_m')}}</span>
                  @endif
                </td>
                {{-- <td width="150px">
                    <a class="btn btn-sm btn-primary" href="{{url('/hotel/edit/'.$hotel->id)}}">{{__('commun.edit')}}</a>
                    <button  data-id="{{$hotel->id}}" data-name="{{$hotel->name}}" type="button" class="btn btn-sm btn-danger deletehotel" data-toggle="modal" data-target="#modal-delete">{{__('commun.delete')}}</button>
                </td> --}}
                <td>
                  <div class="dropdown">
                    <button class="btn btn-sm btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Action
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      <a class="dropdown-item" href="{{url('/hotel/edit/'.$hotel->id)}}">{{__('commun.edit')}}</a>
                      <a class="dropdown-item" href="{{route('hotel.allRooms',$hotel->id)}}">{{__('hotel.manage_rooms')}}</a>
                      <a class="dropdown-item" href="{{route('hotel.availabilityRooms',$hotel->id)}}">{{__('room.rooms availability')}}</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item deletehotel text-danger" data-id="{{$hotel->id}}" data-name="{{$hotel->name}}" data-toggle="modal" data-target="#modal-delete">{{__('commun.delete')}}</a>
                    </div>
                    </div>
                </td>
              </tr>
            @endforeach

          
            </tbody> 
        </table>
      </div>
    
    </section>

    {{-- #################### delete modal ########################--}}
    <div class="modal fade" id="modal-delete">
      <div class="modal-dialog">
        <div class="modal-content">
          <form action="{{route('hotel.delete')}}" method="POST">
            @csrf
            <div class="modal-header text-danger">
              <h4 class="modal-title">{{__('hotel.archive_hotel_header')}}</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <input type="hidden" name="id" id="hiddenValue" value="" />
              <p class="text-danger">{{__('hotel.archive_hotel')}} <strong id="namehotel"></strong> ?</p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">{{__('commun.close')}}</button>
              <div>
                <button type="submit" class="btn btn-danger" name="submit" value="archive">{{__('commun.archive')}}</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

     {{-- #################### New hotel modal ########################--}}
     <div class="modal fade" id="modal-new-hotel">
      <div class="modal-dialog">
        <div class="modal-content">
          <form action="{{route('hotel.newHotel')}}" method="POST">
            @csrf
            <div class="modal-header text-success">
              <h4 class="modal-title">{{ucfirst(__('hotel.create_new_hotel'))}}</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <input type="hidden" name="id" id="hiddenValue" value="" />
              <div class="form-group ">
                <label>{{ucfirst(__('hotel.hotel name'))}}</label>
                <input  type="text"  value="" name="name" placeholder="{{ucfirst(__('hotel.hotel name'))}}" class="form-control @error('name') is-invalid @enderror">
                @error('name')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">{{__('commun.close')}}</button>
              <div>
                <button type="submit" class="btn btn-primary" name="submit" value="archive">{{__('commun.save')}}</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

    

  </div>
@endsection

@section('javascript')
  <script type="text/javascript">
      $(function () {
          $(".deletehotel").click(function () {                 
              $(".modal-body #hiddenValue").val($(this).data('id'));
              $(".modal-body #namehotel").html($(this).data('name'));
          })
      });

      
      $(function () {
      
        $('#tablehotels').DataTable({
          "columnDefs": [ {"targets": 0,"orderable": false},{"targets": 3,"orderable": false} ],
          "paging": true,
          "lengthChange": true,
          "searching": true,
          "ordering": true,
          "info": true,
          //"autoWidth": true,
          "scrollX": true,
          "aaSorting": [],
          "language": {
                "url": "{{__('datatables.url')}}"
            }
        });
      });

  </script>
@endsection