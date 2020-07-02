@extends('layouts.master')

@section('content')
  <form method="POST" action="{{route('user.roles.create')}}">  
    @csrf
    <div class="content-wrapper">
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>{{__('roles.add_new_role')}}</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{url('/')}}">{{__('commun.home')}}</a></li>
                <li class="breadcrumb-item active"><a href="{{route('user.allroles')}}">{{__('roles.all_roles')}}</a></li>
                <li class="breadcrumb-item active">{{__('roles.add_new_role')}}</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
        <div class="header-actions">
          <button type="submit" class="btn float-right btn-primary savebtn">{{__('commun.save')}}</button>
        </div>
        
      </section>


      <section class="content">
        <div class="box">
          <div class="form-group">
            <label>{{__('roles.role_name')}}</label>
            <input type="text" value="" placeholder="{{__('roles.role_name')}}" name="name" class="form-control  @error('name') is-invalid @enderror">
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
          <div class="form-group">
            <label>{{__('commun.description')}}</label>
            <textarea name="description" cols="40" rows="5" placeholder="{{__('commun.description')}}" class="form-control  "></textarea>
          </div>
        </div>
      </section>

    </div>
  </form>
@endsection