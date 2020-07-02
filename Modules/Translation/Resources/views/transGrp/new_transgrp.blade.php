@extends('layouts.master')

@section('content')
  <form method="POST" action="{{route('translation.group.create')}}">  
    @csrf
    <div class="content-wrapper">
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>{{__('translations.new_translation_group')}}</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{url('/')}}">{{__('commun.home')}}</a></li>
                <li class="breadcrumb-item active"><a href="{{route('translation.allgroups')}}">{{__('translations.all_translation_groups')}}</a></li>
                <li class="breadcrumb-item active">{{__('translations.new_translation_group')}}</li>
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
            <label>{{__('translations.group_name')}}</label>
            <input type="text" value="" placeholder="{{__('translations.group_name')}}" name="name" class="form-control  @error('name') is-invalid @enderror">
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