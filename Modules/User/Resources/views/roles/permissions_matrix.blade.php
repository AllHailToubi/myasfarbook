@extends('layouts.master')

@section('content')
  <form method="POST" action="{{route('user.showpermissionsmatrix')}}">  
    @csrf
    <div class="content-wrapper">
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>{{__('roles.permission_matrix')}}</h1>
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
        <button type="submit" class="btn btn-primary float-right savebtn">{{__('commun.save_change')}}</button>
        </div>
        
      </section>


      <section class="content">
        <div class="box">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>{{__('roles.permission')}}</th>
                @foreach($roles as $role)
                  <th>{{$role->name}}</th>
                  
                @endforeach
              </tr>
            </thead>
            <tbody>
              @foreach($tab_permissions_groups as $gname=>$permissions_group)
                <tr>
                  <td class="bg-secondary tdsmall" colspan=3>{{__('commun.group')}}: <strong>{{$gname}}</strong></td>
                </tr>
                @foreach($permissions_group as $permission)
                  <tr>
                    <td class="tdsmall"><a  href="{{url('/user/permissions/edit/'.$permission["id"])}}">{{$permission["name"]}}</a></td>
                    
                    @foreach($roles as $role)
                      <td class="tdsmall">                  
                        <input type="checkbox" id="vehicle1" name="permissions[]" value="{{$role->name}}:{{$permission['name']}}" @if($role->hasPermissionTo($permission['name'])) checked @endif>
                      </td>
                    @endforeach
                    
                  </tr>
                @endforeach
    
              @endforeach
            </tbody>
          </table>
        </div>
      </section>

    </div>
  </form>
@endsection