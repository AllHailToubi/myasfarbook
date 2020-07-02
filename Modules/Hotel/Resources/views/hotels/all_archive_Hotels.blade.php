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
       
        
      </div><!-- /.container-fluid -->
      <div class="header-actions">
        
          <a href="{{route('hotel.allHotels')}}" class="btn btn-info">< {{__('commun.back')}} </a>
       
      </div>
    </section>

    <section class="content">
      @error('error')
        <div class="alert alert-danger alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <i class="icon fas fa-ban"></i>  {{ $message }}
        </div>
      @enderror
      
     
      <div class="box">
        <table id="tablehotels" class="table  table-hover display responsive nowrap" style="width:100%">
          <thead>
            <tr>
              <th>{{__('commun.name')}}</th>
              <th>{{__('commun.status')}}</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach($hotels as $hotel)
              <tr>
                <td>{{$hotel->name}}</td>
                
                <td>
                  @if($hotel->status)
                    <span class="badge badge-success">Published</span>
                  @else
                    <span class="badge badge-danger">Suspended</span>
                  @endif
                </td>
                <td width="150px">
                  
                    
                    
                      <button  data-id="{{$hotel->id}}" data-name="{{$hotel->name}}" type="button" class="btn btn-sm btn-danger deletehotel" data-toggle="modal" data-target="#modal-delete">
                        {{__('commun.delete')}}
                      </button>
                    
                      <button  data-id="{{$hotel->id}}" data-name="{{$hotel->name}}" type="button" class="btn btn-sm btn-info deletehotel" data-toggle="modal" data-target="#modal-restore">
                        {{__('commun.restore')}}
                      </button>
                    
                 
                </td>
              </tr>
            @endforeach

          
            </tbody> 
        </table>
      </div>
    
    </section>

    <div class="modal fade" id="modal-delete">
      <div class="modal-dialog">
        <div class="modal-content">
          <form action="{{route('hotel.delete')}}" method="POST">
            @csrf
            <div class="modal-header text-danger">
              <h4 class="modal-title">{{__('hotel.delete_hotel_header')}}</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <input type="hidden" name="id" id="hiddenValue" value="" />
              <p class="text-danger">{{__('hotel.delete_hotel')}} <strong id="namehotel"></strong> ?</p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">{{__('commun.close')}}</button>
              <div>
                
                <button type="submit" class="btn btn-danger" name="submit" value="delete">{{__('commun.delete')}}</button>
              </div>
              
            </div>
          </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="modal-restore">
      <div class="modal-dialog">
        <div class="modal-content">
          <form action="{{route('hotel.delete')}}" method="POST">
            @csrf
            <div class="modal-header text-info">
              <h4 class="modal-title">{{__('hotel.restore_hotel_header')}}</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <input type="hidden" name="id" id="hiddenValue" value="" />
              <p class="text-info">{{__('hotel.restore_hotel')}} <strong id="namehotel"></strong> ?</p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">{{__('commun.close')}}</button>
              <div>
                <button type="submit" class="btn btn-info" name="submit" value="restore">{{__('commun.restore')}}</button>
              </div>
              
            </div>
          </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
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
          "columnDefs": [ {"targets": 2,"orderable": false} ],
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