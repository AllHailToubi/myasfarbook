@extends('layouts.master')

@section('content')
<form method="POST" action="{{ route('user.editsave') }}">
  @csrf
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3>{{__('registration.edit_user')}}: <i class="text-success">{{$user->firstname}} {{$user->lastname}}</i></h3> 
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/')}}">{{ __('commun.home') }}</a></li>
              <li class="breadcrumb-item active">{{__('registration.edit_user')}}</li>
            </ol>
          </div>
        </div>
        
      </div><!-- /.container-fluid -->
      <div class=" header-actions">
        <button type="submit" class="btn btn-primary float-right savebtn"> {{ __('Save Change') }}</button>
      </div>
      
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="box">      
          <div class="row ">
            
            <div class="col-md-1 "></div>
            <div class="col-md-5 ">
                <input type="hidden" name="id" value="{{$user->id}}">
                <div class="form-group ">
                    <label for="firstname" >{{__('registration.first_name')}}</label>                              
                    <input id="firstname" type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('firstname',$user->firstname) }}" required autocomplete="firstname" autofocus placeholder="{{__('registration.first_name')}}">
                    @error('firstname')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div> 

                  <div class="form-group ">
                    <label for="lastname" >{{__('registration.last_name')}}</label>                              
                    <input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname',$user->lastname) }}" required autocomplete="lastname" placeholder="{{__('registration.last_name')}}" >
                    @error('lastname')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group ">
                    <label for="email">{{__('registration.email_address')}}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email',$user->email) }}"  autocomplete="email" placeholder="{{__('registration.email_address')}}" disabled>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group ">
                    <label for="password" >{{__('registration.password')}}</label>

                    
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password" placeholder="{{__('registration.password')}}" >

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    
                </div>

                <div class="form-group ">
                    <label for="password-confirm" >{{ __('registration.confirm_password') }}</label>

                    
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  autocomplete="new-password" placeholder="{{ __('registration.confirm_password') }}" >
                    
                </div>
            </div>
            <div class="col-md-1 "></div>

            <div class="col-md-4 ">
              
                    <div class="form-group">
                        <label>{{ __('registration.status') }}</label>
                        <select required class="custom-select @error('status') is-invalid @enderror" name="status" >
                            <option value="">-- {{ __('commun.select') }} --</option>
                            <option value="publish" @if ($user->status=='publish') selected @endif>{{ __('commun.publish') }}</option>
                            <option value="blocked" @if ($user->status=='blocked') selected @endif>{{ __('commun.blocked') }}</option>
                        </select>
                        @error('status')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        @php 
                          $user_role = $user->getRoleNames(); 
                        @endphp
                        <label>{{ __('registration.role') }}</label>
                        <select required class="custom-select @error('role') is-invalid @enderror" name="role">
                            <option value="">-- {{ __('commun.select') }} --</option>
                            @foreach($roles as $role)
                              <option value="{{$role->name}}" @if ($user_role[0]==$role->name) selected @endif>{{ucfirst($role->name)}}</option>   
                            @endforeach
                        </select>

                        @error('role')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>  
            </div>
            <div class="col-md-1 "></div>
          </div>
        </div>
    </section>
  </div>
</form>

@endsection