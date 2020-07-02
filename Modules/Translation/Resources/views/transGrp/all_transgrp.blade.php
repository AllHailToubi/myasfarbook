@extends('layouts.master')

@section('content')
<div class="content-wrapper">
<!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>{{__('translations.all_translation_groups')}}</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('/')}}">{{__('commun.home')}}</a></li>
            <li class="breadcrumb-item active">{{__('translations.translation_groups')}}</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
    <div class="header-actions">
      <a href="{{route('translation.group.create')}}" class="btn btn-info">{{__('translations.Add_new_translation_group')}}</a>
      @if(checkpermission('manage admin languages'))
        <a href="{{route('translation.locales')}}" class="btn btn-secondary">{{__('translations.add_new_language')}}</a>  
      @endif
    </div>
  </section>

  <section class="content">
    <div class="box">
      <table class="table table-hover">
        <thead>
          <tr>
            <th>{{__('translations.group_name')}}</th>
            <th>{{__('commun.description')}}</th>
            <th width="150px"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($transgps as $transgp)
            <tr>
              <td class="title">
                
              <a href="{{url('/translation/transbygroup/'.$transgp->name)}}">{{$transgp->name}}</a>
               
                
              </td>
              <td>{{$transgp->description}}</td>
              <td>
                
                  <a class="btn btn-sm btn-primary" href="{{url('/translation/group/edit/'.$transgp->id)}}">{{__('commun.edit')}}</a> 
                

                
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