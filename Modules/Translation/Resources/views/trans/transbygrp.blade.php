@extends('layouts.master')

@section('content')
<form method="POST" action="{{route('translation.showAllbyGrpSave')}}">  
  @csrf
  <input type="hidden" name="name" value="{{$namegrp}}">
  <div class="content-wrapper">
  <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          <h3>{{__('commun.group')}}: <i class="text-success">{{$namegrp}}</i></h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/')}}">{{__('commun.home')}}</a></li>
              <li class="breadcrumb-item active"><a href="{{route('translation.allgroups')}}">{{__('translations.translation_groups')}}</a></li>
              <li class="breadcrumb-item active">{{__('commun.group')}}:{{$namegrp}}</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
      <div class="header-actions">
        
          <a href="{{route('translation.createTransKey',$namegrp)}}" class="btn btn-info">{{__('translations.add_new_key')}}</a>
      

        
        
        
       
        <button type="submit" class="btn btn-primary float-right savebtn">{{__('commun.save_change')}}</button>
       
        
      
        
        
      </div>
    </section>

    <section class="content">
      <div class="box">
       


        <div class="card card-primary card-outline card-tabs">
          <div class="card-header p-0 pt-1 border-bottom-0">
            <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
              @foreach($locales as $locale)
                <li class="nav-item">
                  <a class="nav-link @if($locale->code=='en') active @endif"  data-toggle="pill" href="#tab{{$locale->code}}" role="tab" aria-controls="#tab{{$locale->code}}" aria-selected="false" aria-selected="true">{{ucfirst($locale->name)}}</a>
                </li>
              @endforeach 
            </ul>
          </div>
          <div class="card-body">
            <div class="tab-content" id="custom-tabs-two-tabContent">
              @foreach($locales as $locale)
                <div class="tab-pane fade @if($locale->code=='en')  active show @endif" id="tab{{$locale->code}}" role="tabpanel" aria-labelledby="#tab{{$locale->code}}">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>{{__('translations.key_name')}}</th>
                        
                          <th>{{ucfirst($locale->name)}}</th>
                          <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($transkeys as $transkey) 
                        <tr>
                          <td class="title">
                          @php  echo "{{__('$namegrp.$transkey->key')}}"; @endphp 
                            
                          </td>
                         
                            <td>
                              @if($locale->code!='en')  <b><i>En:</i></b> {{$tabtrans[$transkey->key]["en"]}} @endif
                              <input type="text" placeholder=" " value="{{$tabtrans[$transkey->key][$locale->code]}}" name="{{$transkey->key}}_{{$locale->code}}" class="form-control" >
                            </td>

                            <td>
                              <button  data-id="{{$transkey->id}}" data-key="{{$transkey->key}}" type="button" class="btn btn-sm btn-danger deletekey" data-toggle="modal" data-target="#modal-default">
                                {{__('commun.delete')}}
                              </button>
                            </td>
                          
                        </tr>

                        
                      @endforeach
                    </tbody>
                  </table>
                </div>
                @endforeach  
              
              
            </div>
          </div>
          <!-- /.card -->
        </div>
      </div>
    </section>

    

  </div>
</form>

<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{route('translation.transkey.delete',$namegrp)}}" method="POST">
        @csrf
        <div class="modal-header text-danger">
          <h4 class="modal-title">Role delete confirmation</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id" id="hiddenValue" value="" />
          <p class="text-danger">Are you sure you want to delete the role: <strong id="namerole">write</strong> ?</p>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger">Delete</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
@endsection


@section('javascript')
  <script type="text/javascript">
      $(function () {
          $(".deletekey").click(function () {
              var id = $(this).data('id');
              var key = $(this).data('key');
              $(".modal-body #hiddenValue").val(id);
              $(".modal-body #namerole").html(key);
          })
      });
  </script>
@endsection