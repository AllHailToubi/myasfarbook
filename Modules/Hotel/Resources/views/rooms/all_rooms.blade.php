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
          <h3>{{__('room.all_rooms')}} - {{__('menu.hotel')}}: {{$hotel->name}}</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/')}}">{{__('commun.home')}}</a></li>
              <li class="breadcrumb-item"><a href="{{route('hotel.allHotels')}}">{{__('hotel.all_hotels')}}</a></li>
              <li class="breadcrumb-item active">{{__('room.all_rooms')}}</li>
            </ol>
          </div>
        </div>
      </div>
      <div class="header-actions">
        <button  type="button" class="btn  btn-success" data-toggle="modal" data-target="#modal-new-hotel">+ {{__('room.add_new_room')}}</button>
        <a href="{{route('hotel.availabilityRooms',$hotel->id)}}" class="btn btn-warning float-right savebtn"><i class="far fa-calendar-alt" style="margin-right:5px;"></i>   {{__('room.rooms availability')}}</a>
        
      </div>
    </section>
    <style>
      .td_img{
        padding: 3px!important;
      }

     

    </style>

    <section class="content">
      <div class="box">
        <table id="tablehotels" class="table  table-hover display responsive nowrap "style="width:100%">
          <thead>
            <tr>
              <th></th>
              <th>{{__('commun.name')}}</th>
              <th>{{__('commun.price')}}</th>
              <th>{{__('commun.status')}}</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach($rooms as $room)
              <tr>
                <td class="td_img">
                  @if (isset($room->image_id))
                    <img width="108px" height="56px" src="{{asset(IMAGES_ROOMS.$room->image_id)}}?t={{rand()}}"  />
                  @else
                  <img width="108px" height="56px" src="{{asset(IMAGES_ROOMS.'unnamed.png')}}"  />
                  @endif
                </td>

                
                <td>{{$room->name}}</td>

                <td>{{$room->price}} DHs</td>
                
                <td>
                  @if($room->status)
                    <span class="badge badge-success">{{__('commun.published_f')}}</span>
                  @else
                    <span class="badge badge-danger">{{__('commun.suspended_f')}}</span>
                  @endif
                </td>

                
                <td width="150px">
                    <a class="btn btn-sm btn-primary" href="{{route('hotel.editRoom',$room->id)}}">{{__('commun.edit')}}</a>
                    <button  data-id="{{$room->id}}" data-name="{{$room->name}}" type="button" class="btn btn-sm btn-danger deletehotel" data-toggle="modal" data-target="#modal-delete">{{__('commun.delete')}}</button>
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
          <form action="{{route('hotel.deleteroom')}}" method="POST">
            @csrf
            <div class="modal-header text-danger">
              <h4 class="modal-title">{{__('room.modal_delete_room_header')}}</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <input type="hidden" name="id" id="hiddenValue" value="" />
              <input type="hidden" name="hotel_id"  value="{{$hotel->id}}" />
              <p class="text-danger">{{__('room.modal_delete_room_body')}}<strong id="namehotel"></strong> ?</p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">{{__('commun.close')}}</button>
              <div>
                <button type="submit" class="btn btn-danger" name="submit" value="delete">{{__('commun.delete')}}</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

     {{-- #################### New Room modal ########################--}}
     <div class="modal fade" id="modal-new-hotel">
      <div class="modal-dialog">
        <div class="modal-content">
          <form action="{{route('hotel.newRoom')}}" method="POST">
            @csrf
            <div class="modal-header text-success">
              <h4 class="modal-title">{{__('room.create_new_room')}}</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <input type="hidden" name="hotel_id" id="hiddenValue" value="{{$hotel->id}}" />
              <div class="form-group ">
                <label>{{ucfirst(__('hotel.hotel name'))}}</label>
                <input  type="text"  value="" name="name" placeholder="{{__('room.room_name')}}" class="form-control @error('name') is-invalid @enderror">
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
          "columnDefs": [ {"targets": 0,"orderable": false},{"targets": 4,"orderable": false} ],
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