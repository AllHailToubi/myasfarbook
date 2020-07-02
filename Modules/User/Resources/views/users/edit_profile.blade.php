@extends('layouts.master')

@section('content')
  <form method="POST" action="{{route('user.editprofile')}}" enctype="multipart/form-data">
  @csrf
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>{{__('menu.profile')}}</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{url('/')}}">{{__('commun.home')}}</a></li>
                <li class="breadcrumb-item active">{{__('registration.edit_profile')}}</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
        <div class="header-actions">
          
          <button type="submit" class="btn btn-primary float-right savebtn"> {{ __('commun.save_change') }}</button>
        </div>
      </section>
      <!-- Main content -->
      <section class="content">
          <div class="box">
            <div class="row">
                      
              <!--left col--> 
              <div class="col-sm-4">  
                  <div class="text-center">
                  @php  
                      $photoname=$user->photo?$user->photo:'avatar.png'; 
                  @endphp
                  <img src="{{url('/src/images/profiles/'.$photoname).'?t='.time()}}" class="avatar img-circle img-thumbnail" alt="avatar">
                    <h6>{{__('registration.photo_profile')}}</h6>
                    <input type="file" name="photo" class="text-center center-block file-upload" >
                  </div>
              </div>  
              <!--End left col-->       
              <!--right col--> 
              <div class="row col-sm-8 ">  
                  
                <div class="col-md-6">
                  <div class="form-group">
                    <label>{{__('registration.first_name')}}</label>
                    <input type="text" required value="{{$user->firstname}}" name="firstname" placeholder="{{__('registration.first_name')}}" class="form-control @error('firstname') is-invalid @enderror">
                    @error('firstname')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>{{__('registration.last_name')}}</label>
                    <input type="text" required value="{{$user->lastname}}" name="lastname" placeholder="{{__('registration.last_name')}}" class="form-control @error('lastname') is-invalid @enderror">
                    @error('lastname')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>{{__('registration.email_address')}}</label>
                    <input type="email" required value="{{$user->email}}" placeholder="{{__('registration.email_address')}}" name="email" class="form-control" disabled="true">
                  </div>
                </div>
                
                <div class="col-md-6">
                  <div class="form-group">
                    <label>{{__('registration.phone')}}</label>
                    <input type="text" value="{{$user->phone}}" placeholder="{{__('registration.phone')}}" name="phone" class="form-control" >
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>{{__('registration.address')}}</label>
                    <input type="text" value="{{$user->address}}" placeholder="{{__('registration.address')}}" name="address" class="form-control" >
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>{{__('registration.city')}}</label>
                    <input type="text" value="{{$user->city}}" placeholder="{{__('registration.city')}}" name="city" class="form-control" >
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label >{{__("registration.country")}}</label>
                    <select name="country" class="form-control" id="country-sms-testing"    >
                        <option value="">-- {{ __('commun.select') }} --</option>
                        @foreach(get_country_lists() as $id=>$name)
                            <option value="{{$id}}" @if ($id==$user->country) selected @endif>{{$name}}</option>
                        @endforeach
                    </select>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label >{{__("registration.gender")}}</label>
                    <select name="gender" class="form-control" id="country-sms-testing"    >
                        <option value="">-- {{ __('commun.select') }} --</option>
                        
                        <option value="Male" @if ($user->gender=='Male') selected @endif>{{__("registration.male")}}</option>
                        <option value="Female" @if ($user->gender=='Female') selected @endif>{{__("registration.female")}}</option>
                        
                    </select>
                  </div>
                </div>

                
                
                  
                      
                      
              </div>  
              <!--End right col-->  
                
            </div>
          </div>
      </section>
  </div>
  </form>
@endsection