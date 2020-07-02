@extends('layouts.master')

@section('content')
<div class="content-wrapper">
<!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>{{__('translations.languages')}}</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('/')}}">{{__('commun.home')}}</a></li>
            <li class="breadcrumb-item active">{{__('translations.languages')}}</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
    <div class="header-actions">
      
    
      
      
      

      
          <a href="{{route('translation.locales.create')}}" class="btn btn-info">{{__('translations.add_new_language')}}</a>
      
      
     
      
      
    </div>
  </section>

  <section class="content">
    <div class="box">
      <table class="table table-hover">
        <thead>
          <tr>
            <th>{{__('translations.language_code')}}</th>
            <th>{{__('commun.name')}}</th>
            <th width="150px"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($locales as $locale)
            <tr>
              <td class="title">
               
                  <a href="{{url('/translation/transbygroup/'.$locale->code)}}">{{ucfirst($locale->code)}}</a>
                
                
              </td>
              <td>{{ucfirst($locale->name)}}</td>
              <td>
                
                  <a class="btn btn-sm btn-primary" href="{{url('/translation/locales/edit/'.$locale->code)}}">{{__('commun.edit')}}</a> 
              

                
              </td>
            </tr>

          @endforeach
        </tbody>
      </table>
    </div>
  </section>

  

</div>

@endsection


@section('javascript')
  <script type="text/javascript">
      $(function () {
          $(".deleterole").click(function () {
              var id = $(this).data('id');
              var name = $(this).data('name');
              $(".modal-body #hiddenValue").val(id);
              $(".modal-body #namerole").html(name);
          })
      });
  </script>
@endsection