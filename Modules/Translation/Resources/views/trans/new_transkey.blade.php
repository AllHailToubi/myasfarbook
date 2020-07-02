@extends('layouts.master')

@section('content')
  <form method="POST" action="{{route('translation.createTransKey',$namegrp)}}">  
    @csrf
    <div class="content-wrapper">
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h3>{{__('translations.new_key_in_group')}}: <i class="text-success">{{$namegrp}}</i></h3>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{url('/')}}">{{__('commun.home')}}</a></li>
                <li class="breadcrumb-item active"><a href="{{route('translation.allgroups')}}">{{__('translations.translation_groups')}}</a></li>
                <li class="breadcrumb-item active">{{__('translations.new_translation_key')}}</li>
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
            <label>{{__('translations.key_name')}}</label>
            <input type="hidden" name="group" value="{{$namegrp}}">
            <input type="text" value="" placeholder="{{__('translations.key_name')}}" name="key" class="form-control  @error('key') is-invalid @enderror">
            @error('key')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
          @foreach ($locales as $locale)
            <div class="form-group">
              <label>{{ucfirst($locale->name)}}</label>
              <input type="text" value=""  name="{{$locale->code}}" class="form-control">
            </div>
          @endforeach
          
          
        </div>
      </section>

    </div>
  </form>
@endsection