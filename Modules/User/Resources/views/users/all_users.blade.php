@extends('layouts.master')


@section('content')
  <div class="content-wrapper">
    
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{__('menu.all_users')}}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/')}}">{{__('commun.home')}}</a></li>
              <li class="breadcrumb-item active">{{__('menu.all_users')}}</li>
            </ol>
          </div>
        </div>
       
        
      </div><!-- /.container-fluid -->
      <div class="header-actions">
        
          <a href="{{route('user.newuser')}}" class="btn btn-info">{{__('registration.add_new_user')}}</a>
       
      </div>
    </section>

    <section class="content">
      
     
      <div class="box">
        <table id="tableusers" class="table  table-hover display responsive nowrap" style="width:100%">
          <thead>
            <tr>
              <th>{{__('registration.first_name')}}</th>
              <th>{{__('registration.last_name')}}</th>
              <th>{{__('registration.email')}}</th>
              <th>{{__('registration.type')}}</th>
              <th>{{__('registration.role')}}</th>
              <th>{{__('registration.status')}}</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach($users as $user)
              <tr>
                <td>{{$user->firstname}}</td>
                <td>{{$user->lastname}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->type}}</td>
                <td>
                  @php $roles = $user->getRoleNames();
                    if(!empty($roles[0])){
                        echo e(ucfirst($roles[0]));
                    }
                  @endphp
                </td>
                <td>{{$user->status}}</td>
                <td>
                 
                    <a class="btn btn-sm btn-primary" href="{{url('/user/edit/'.$user->id)}}">{{__('commun.edit')}}</a> 
                 

                  
                    <button  data-id="{{$user->id}}" data-firstname="{{$user->firstname}}" data-lastname="{{$user->lastname}}" type="button" class="btn btn-sm btn-danger deleterole" data-toggle="modal" data-target="#modal-default">
                      {{__('commun.delete')}}
                    </button>
                 
                </td>
              </tr>
            @endforeach

          
            </tbody> 
        </table>
      </div>
    
    </section>

    <div class="modal fade" id="modal-default">
      <div class="modal-dialog">
        <div class="modal-content">
          <form action="{{route('user.delete')}}" method="POST">
            @csrf
            <div class="modal-header text-danger">
              <h4 class="modal-title">{{__('registration.modal_delete_user_header')}}</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <input type="hidden" name="id" id="hiddenValue" value="" />
              <p class="text-danger">{{__('registration.modal_delete_user_body')}} <strong id="namerole">write</strong> ?</p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">{{__('commun.close')}}</button>
              <button type="submit" class="btn btn-danger">{{__('commun.delete')}}</button>
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
          $(".deleterole").click(function () {
              var id = $(this).data('id');
              var lastname = $(this).data('lastname');
              var firstname = $(this).data('firstname');
              
              $(".modal-body #hiddenValue").val(id);
              $(".modal-body #namerole").html(firstname+" "+lastname);
          })
      });

      
      $(function () {
      
        $('#tableusers').DataTable({
          "columnDefs": [ {"targets": 5,"orderable": false} ],
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