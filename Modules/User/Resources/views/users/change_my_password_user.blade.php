@extends('layouts.master')

@section('content')
<form method="POST" action="{{ route('user.changemypassword') }}">
  @csrf
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{__('menu.change_password')}}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/')}}">{{__('commun.home')}}</a></li>
              <li class="breadcrumb-item active">{{__('menu.change_password')}}</li>
            </ol>
          </div>
        </div>
       
      </div><!-- /.container-fluid -->
      <div class=" header-actions">
        <button type="submit" class="btn btn-primary float-right savebtn"> {{__('commun.save_change')}}</button>
      </div>
      
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="box">      
          <div class="row ">
            
            <div class="col-md-1 "></div>
            <div class="col-md-5 ">
                
                

                  

                

                <div class="form-group ">
                    <label for="password" >{{ __('registration.current_password') }}</label>

                    
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="{{ __('registration.current_password') }}" >

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    
                </div>
                
                <div class="form-group ">
                    <label for="password" >{{ __('registration.new_password') }}</label>

                    
                        <input id="newpassword" type="password" class="form-control @error('newpassword') is-invalid @enderror" name="newpassword" required autocomplete="new-password" placeholder="{{ __('registration.new_password') }}" >

                        @error('newpassword')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    
                </div>

                <div class="form-group ">
                    <label for="{{ __('registration.confirm_password') }}" >{{ __('Confirm Password') }}</label>

                    
                        <input id="newpassword-confirm" type="password" class="form-control" name="newpassword_confirmation" required autocomplete="new-password" placeholder="{{ __('registration.confirm_password') }}" >
                    
                </div>
            </div>
            <div class="col-md-1 "></div>

            
            <div class="col-md-1 "></div>
          </div>
        </div>
    </section>
  </div>
</form>

@endsection