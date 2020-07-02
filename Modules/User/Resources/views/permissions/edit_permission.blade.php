@extends('layouts.master')

@section('content')
  <form method="POST" action="{{route('user.permissions.update')}}">  
    @csrf
    <div class="content-wrapper">
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h3>{{__('roles.edit_permission')}}: <i class="text-success">{{$permission->name}}</i></h3>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{url('/')}}">{{__('commun.home')}}</a></li>
                <li class="breadcrumb-item active"><a href="{{route('user.AllPermissions')}}">{{__('roles.all_permissions')}}</a></li>
                <li class="breadcrumb-item active">{{__('roles.edit_permission')}}</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
        <div class="header-actions">
          <button type="submit" class="btn float-right btn-primary savebtn">{{__('commun.save_change')}}</button>
        </div>
        
      </section>


      <section class="content">
        <div class="box">
          <input type="hidden" name="id" value="{{$permission->id}}">
          <div class="form-group">
            <label>{{__('roles.permission_name')}}</label>
            <input type="text" value="{{ old('name',$permission->name) }}" placeholder="{{__('roles.permission_name')}}" name="name" class="form-control  @error('name') is-invalid @enderror" disabled>
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
          <div class="form-group">
            <label>{{__('commun.group')}}</label>
            <input type="text" value="{{ old('group',$permission->group) }}" placeholder="{{__('commun.group')}}" name="group" class="form-control  @error('group') is-invalid @enderror">
            @error('group')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
          <div class="form-group">
            <label>{{__('commun.description')}}</label>
            <textarea name="description" cols="40" rows="5" placeholder="Description" class="form-control  ">{{ old('group',$permission->description) }}</textarea>
          </div>
        </div>
      </section>

    </div>
  </form>
@endsection