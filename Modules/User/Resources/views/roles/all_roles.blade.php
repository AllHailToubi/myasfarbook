@extends('layouts.master')

@section('content')
<div class="content-wrapper">
<!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>{{__('roles.all_roles')}}</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('/')}}">{{__('commun.home')}}</a></li>
            <li class="breadcrumb-item active">{{__('roles.all_roles')}}</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
    <div class="header-actions">
        <a href="{{route('user.roles.create')}}" class="btn btn-info">{{__('roles.add_new_role')}}</a>
        
        @if(checkpermission('manage permissions'))
          <a href="{{route('user.showpermissionsmatrix')}}" class="btn btn-info">{{__('roles.permission_matrix')}}</a>
        @endif
        
    </div>
  </section>

  <section class="content">
    <div class="box">
      <table class="table table-hover">
        <thead>
          <tr>
            <th>{{__('commun.name')}}</th>
            <th>{{__('commun.description')}}</th>
            <th width="200px"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($roles as $role)
            <tr>
              <td class="title">
                
                  <a href="{{url('/user/roles/edit/'.$role->id)}}">{{ucfirst($role->name)}}</a>
                
                
              </td>
              <td>{{$role->description}}</td>
              <td>
                
                  <a class="btn btn-sm btn-primary" href="{{url('/user/roles/edit/'.$role->id)}}">{{__('commun.edit')}}</a> 
                

                
                  <button  data-id="{{$role->id}}" data-name="{{$role->name}}" type="button" class="btn btn-sm btn-danger deleterole" data-toggle="modal" data-target="#modal-default">
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
        <form action="{{route('user.roles.delete')}}" method="POST">
          @csrf
          <div class="modal-header text-danger">
            <h4 class="modal-title">{{__('roles.modal_role_delete_header')}}</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <input type="hidden" name="id" id="hiddenValue" value="" />
            <p class="text-danger">{{__('roles.modal_role_delete_body')}} <strong id="namerole">write</strong> ?</p>
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
              var name = $(this).data('name');
              $(".modal-body #hiddenValue").val(id);
              $(".modal-body #namerole").html(name);
          })
      });
  </script>
@endsection