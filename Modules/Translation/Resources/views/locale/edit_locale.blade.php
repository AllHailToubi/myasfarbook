@extends('layouts.master')

@section('content')
  <form method="POST" action="{{route('translation.locales.update')}}">  
    @csrf
    <div class="content-wrapper">
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h3>{{__('translations.edit_language')}}: <i class="text-success">{{$locale->name}} ({{$locale->code}} )</i></h3>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{url('/')}}">{{__('commun.home')}}</a></li>
                <li class="breadcrumb-item active"><a href="{{route('translation.allgroups')}}">{{__('translations.languages')}}</a></li>
                <li class="breadcrumb-item active">{{__('translations.new_language')}}</li>
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
          <div class="form-group">
            <label>{{__('translations.language_code')}}</label>
            <input type="hidden" name="codelacale" value="{{$locale->code}}">
            <input type="text" value="{{ old('code',$locale->code) }}" placeholder="{{__('commun.example')}}: Fr, En, Ar, Es, De, ..." name="code" class="form-control  @error('code') is-invalid @enderror" required disabled>
            @error('code')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
          <div class="form-group">
            <label>{{__('translations.language_name')}}</label>
            <input type="text" value="{{ old('name',$locale->name) }}" placeholder="{{__('commun.example')}}: Français, English, العربية" name="name" class="form-control  @error('name') is-invalid @enderror">
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
        </div>
      </section>

    </div>
  </form>
@endsection