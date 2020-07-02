@extends('layouts.master')

@section('content')
  <form method="POST" action="{{route('user.Permissions')}}">  
    @csrf
    <div class="content-wrapper">
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>{{__('roles.all_permissions')}}</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{url('/')}}">{{__('commun.home')}}</a></li>
                <li class="breadcrumb-item active">{{__('roles.all_permissions')}}</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
        <div class="header-actions">
         
            <a href="{{route('user.permissions.create')}}" class="btn btn-info">{{__('roles.add_new_permissions')}}</a>
          
          <a href="{{route('user.showpermissionsmatrix')}}" class="btn btn-secondary">{{__('roles.permission_matrix')}}</a>
        
        </div>
        
      </section>


      <section class="content">
        <div class="box">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>{{__('commun.name')}}</th>
                <th>{{__('commun.description')}}</th>
                
              </tr>
            </thead>
            <tbody>
              @foreach($tab_permissions_groups as $gname=>$permissions_group)
                <tr>
                  <td class="bg-secondary tdsmall" colspan=3>{{__('commun.group')}}: <strong>{{$gname}}</strong></td>
                </tr>
                @foreach($permissions_group as $permission)
                  <tr>
                    <td class="tdsmall">
                      
                        <a  href="{{url('/user/permissions/edit/'.$permission["id"])}}">{{$permission["name"]}}</a>
                      
                    </td>
                    <td class="tdsmall">{{$permission["description"]}}</td>
                    
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