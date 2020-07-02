@extends('layouts.master')

@section('css')
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <link rel="stylesheet" href="{{ asset('/css/soap-icon.css')}}">
@endsection

@section('content')

<form method="POST" action="{{ route('hotel.editRoom',$room->id) }}" >
  <input type="hidden" name="id" value="{{$room->id}}">
  @csrf
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{__('room.edit_room')}}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/')}}">{{ __('commun.home') }}</a></li>
              <li class="breadcrumb-item"><a href="{{route('hotel.allHotels')}}">{{__('hotel.all_hotels')}}</a></li>
              <li class="breadcrumb-item"><a href="{{route('hotel.allRooms',$room->hotel_id)}}">{{__('room.all_rooms')}}</a></li>
              <li class="breadcrumb-item active">{{__('room.edit_room')}}</li>
            </ol>
          </div>
        </div>    
      </div><!-- /.container-fluid -->
      <div class=" header-actions">
        
        <button type="submit" class="btn btn-primary float-right savebtn"> {{ __('commun.save_change') }}</button>
      </div> 
    </section>

    <!-- Main content -->
    <section class="content">
      {{-- Error --}}
      @if ($errors->any())
        <div class="alert alert-danger alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <i class="icon fas fa-ban"></i>  {{__('validation.some_fields_are_required')}}
        </div>
      @endif
      

      {{-- ################# Box bublish #####################--}}
      <div class="box">      
          <div style="display: flow-root;">
            <label  style="margin-bottom: 0px;margin-top: 5px;">{{__('commun.publish')}}</label>
            <label class="switch ">  
              <input type="checkbox" class="success" name="publish" value="1" @if($room->status) checked @endif>
              <span class="slider round"></span>
            </label>
          </div>
      </div>

      {{-- ################# Box Content #####################--}}
      <div class="box card card-secondary" style="padding:0px;">
        <div class="card-header">
          <h3 class="card-title ">{{__('commun.content')}}</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-sm-12">
              <div class="form-group col-sm-4">
                <label>{{__('room.room_name')}}</label>
                <input  type="text"  value="{{ old('name',$room->name) }}" name="name" placeholder="{{__('room.room_name')}}" class="form-control @error('name') is-invalid @enderror">
                @error('name')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>
          </div>  
          <div class="row border" style="margin: 0px 8px;padding: 10px;">
            <div class=" col-sm-4">
              <div class="form-group">
                <label>{{__('commun.price')}}</label>
                
                <div class="input-group">
                  <input  type="text"  value="{{ old('price',$room->price) }}" name="price" placeholder="" class="form-control @error('price') is-invalid @enderror">
                  <div class="input-group-append">
                    <span class="input-group-text">{{devise()}}</span>
                  </div>
                </div>
                @error('price')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>

            <div class=" col-sm-4">
              <div class="form-group">
                <label>{{__('room.Number of rooms')}}</label>
                <input  type="number"  value="{{ old('number_of_rooms',$room->number_of_rooms) }}" name="number_of_rooms" placeholder="" class="form-control @error('number_of_rooms') is-invalid @enderror" min="1">
                @error('number_of_rooms')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>
            <div class=" col-sm-4">
              <div class="form-group">
                <label>{{__('room.Number of beds')}}</label>
                <input  type="number"  value="{{ old('number_of_beds',$room->number_of_beds) }}" name="number_of_beds" placeholder="" class="form-control @error('number_of_beds') is-invalid @enderror" min="1">
                @error('number_of_beds')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>

            <div class=" col-sm-4">
              <div class="form-group">
                <label>{{__('room.Room size')}}</label>
                
                <div class="input-group">
                  <input  type="number"  value="{{ old('size',$room->size) }}" name="size" placeholder="" class="form-control @error('size') is-invalid @enderror" min="1">
                  <div class="input-group-append">
                    <span class="input-group-text">m²</span>
                  </div>
                </div>
                @error('size')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>

            <div class=" col-sm-4">
              <div class="form-group">
                <label>{{__('room.Max adults')}}</label>
                <input  type="number"  value="{{ old('max_adults',$room->max_adults) }}" name="max_adults" placeholder="" class="form-control @error('max_adults') is-invalid @enderror" min="1">
                @error('max_adults')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>

            <div class=" col-sm-4">
              <div class="form-group">
                <label>{{__('room.Max children')}}</label>
                <input  type="number"  value="{{ old('max_children',$room->max_children) }}" name="max_children" placeholder="" class="form-control @error('max_children') is-invalid @enderror" min="1">
                @error('max_children')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>
            
            
          </div>

          
        </div>
      </div>

      
      
      {{-- ################# Box Media ##################### --}}
      <div class="box card card-secondary" style="padding:0px;">
        <div class="card-header">
          <h3 class="card-title ">{{__('commun.Media')}}</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-sm-12">
              <label class="col-sm-12 ">{{__('commun.Feature Image')}}</label>
              <div class="imgbox">
                @if(!isset($room->image_id) || empty($room->image_id))
                  <div class=" upload-btn-wrapper contentimg">
                    <figure class="figureimg">
                      <div class="uploaded_image">
                        <span>+ <br> {{__('commun.Add image')}}</span>
                      </div> 
                    </figure>
                    <input id="imagefeature" type="file" name="imagefeature" />
                  </div>
                @else
                  <div class=" upload-btn-wrapper contentimg">
                    <figure class="figureimg">
                      <div class="uploaded_image">
                        <img width="100%" height="100%" src="{{asset(IMAGES_ROOMS.$room->image_id)}}?t={{rand()}}"  />
                      </div> 
                    </figure>
                    <input id="imagefeature" type="file" name="imagefeature" />
                  </div>
                @endif
                <button id="btndeleteimgfeature" type="button" class="btn btn-danger btn-sm delimg" ><i class="fas fa-trash-alt"></i></button>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <label class="col-sm-12 ">{{__('commun.Gallery Images')}}</label>
              <div class=" upload-btn-wrapper col-sm-12">
                <button type="button" class="btn btn-primary btn-sm">{{__('commun.Add image')}}</button>
                <input id="gallerybtn" type="file" name="gallerybtn" />
              </div>
              
              <div class=" boxgallery"> 
                @if(isset($room->gallery) && !empty($room->gallery))
                  @php $images = explode(",", $room->gallery);@endphp
                  @foreach($images as $img)   
                    <div class="imgboxgallery">
                      <img width="100%" height="100%" src="{{asset(IMAGES_ROOMS.$img)}}" />
                    <button  type="button" class="btn btn-danger btn-sm delimg" onclick="deleteimgGallery('{{$img}}')"><i class="fas fa-trash-alt"></i></button>
                    </div>
                  @endforeach
                @endif 
              </div>
            </div>
          </div>
        </div>
      </div>
      
       {{-- ################# Box Amenities #####################--}}
      <div class="box card card-secondary" style="padding:0px;">
        <div class="card-header">
          <h3 class="card-title ">{{__('commun.Amenities')}}</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            @foreach ($Amenities as $Amenitie)
              <div class="col-md-4 col-sm-6 amenitiebox">
                <label class="amenitie-container">
                  <span><div class="icon">
                    <i class="{{$Amenitie['icon']}}"></i>
                  </div>{{$Amenitie['title']}} </span>
                  <input type="checkbox" name="amenities[]" value="{{$Amenitie['id']}}" {{$Amenitie['checked']}}>
                  <span class="checkmark"></span>
                </label>
              </div>
            @endforeach     
          </div>
        </div>
      </div>


    </section>
  </div>
</form>

@endsection

@section('javascript')
  
  <script >
   

    function deleteimgGallery(imgname) {
        $.ajax({
            url: "{{ route('hotel.deleteimageGallery_room') }}",
            method: "POST",
            data: { id: {{$room->id}}, name: imgname },
            beforeSend: function() {},
            success: function(data) {
                var partsArray = data.uploaded_image.split(',');
                var str = "";
                for (i = 0; i < partsArray.length; i++) {
                    if (partsArray[i] !== "") {
                        imgsrc = '{{asset(IMAGES_ROOMS.":idimg")}}';
                        imgsrc = imgsrc.replace(':idimg', partsArray[i]);
                        str += '<div class="imgboxgallery"><img width="100%" height="100%" src="' + imgsrc + '?t=' + Math.random() + '" /><button  type="button" class="btn btn-danger btn-sm delimg" onclick="deleteimgGallery(\'' + partsArray[i] + '\')"><i class="fas fa-trash-alt"></i></button></div>';
                    }
                }
                $('.boxgallery').html(str);
            },
            error: function(jqXhr, textStatus, errorMessage) { // error callback 

            }
        });
    }

    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("#btndeleteimgfeature").on('click', function(e) {
            $.ajax({
                url: "{{ route('hotel.deleteimage_room') }}",
                method: "POST",
                data: { id: {{$room->id}} },

                beforeSend: function() {

                },
                success: function(data) {
                    $('.uploaded_image').html("<span>+ <br> Add image</span>");

                },
                error: function(jqXhr, textStatus, errorMessage) { // error callback 

                }
            });
        });

        $(document).on('change', '#gallerybtn', function() {
            var name = document.getElementById("gallerybtn").files[0].name;
            var ext = name.split('.').pop().toLowerCase();
            var form_data = new FormData();
            if (jQuery.inArray(ext, ['png', 'jpg', 'jpeg']) == -1) {
                alert("Invalid Image File");
            }
            var oFReader = new FileReader();
            oFReader.readAsDataURL(document.getElementById("gallerybtn").files[0]);
            var f = document.getElementById("gallerybtn").files[0];
            var fsize = f.size || f.fileSize;
            if (fsize > 2000000) {
                alert("Max Image File Size is 2Mo");
            } else {
                form_data.append("file", document.getElementById('gallerybtn').files[0]);
                form_data.append("id", {{$room->id}});

                $.ajax({
                    url: "{{ route('hotel.addToGallery_room') }}",
                    enctype: 'multipart/form-data',
                    method: "POST",
                    data: form_data,
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        //$('.boxgallery').html("<label class='text-success'>Image Uploading...</label>");
                    },
                    success: function(data) {
                        if (data.message == "success") {
                            var partsArray = data.uploaded_image.split(',');
                            var str = "";
                            for (i = 0; i < partsArray.length; i++) {
                                if (partsArray[i] !== "") {
                                    imgsrc = '{{asset(IMAGES_ROOMS.":idimg")}}';
                                    imgsrc = imgsrc.replace(':idimg', partsArray[i]);
                                    str += '<div class="imgboxgallery"><img width="100%" height="100%" src="' + imgsrc + '" /><button  type="button" class="btn btn-danger btn-sm delimg" onclick="deleteimgGallery(\'' + partsArray[i] + '\')"><i class="fas fa-trash-alt"></i></button></div>';
                                }
                            }
                            //console.log(str);
                            $('.boxgallery').html(str);
                        }
                    },
                    error: function(jqXhr, textStatus, errorMessage) { // error callback 
                        $('.boxgallery').html(errorMessage);
                    }
                });
            }

        });

        $(document).on('change', '#imagefeature', function() {
            var name = document.getElementById("imagefeature").files[0].name;
            var ext = name.split('.').pop().toLowerCase();
            var form_data = new FormData();
            if (jQuery.inArray(ext, ['png', 'jpg', 'jpeg']) == -1) {
                alert("Invalid Image File");
            }
            var oFReader = new FileReader();
            oFReader.readAsDataURL(document.getElementById("imagefeature").files[0]);
            var f = document.getElementById("imagefeature").files[0];
            var fsize = f.size || f.fileSize;
            if (fsize > 2000000) {
                alert("Max Image File Size is 2Mo");
            } else {
                form_data.append("file", document.getElementById('imagefeature').files[0]);
                form_data.append("id", {{$room->id}});

                $.ajax({
                    url: "{{ route('hotel.uploadImage_room') }}",
                    enctype: 'multipart/form-data',
                    method: "POST",
                    data: form_data,
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        $('.uploaded_image').html("<span>Image Uploading...</span>");
                    },
                    success: function(data) {
                      console.log(data);
                        if (data.message == "success") {
                            $('.uploaded_image').html(data.uploaded_image);
                        }
                    },
                    error: function(jqXhr, textStatus, errorMessage) { // error callback 
                        $('.uploaded_image').html(errorMessage);
                    }
                });
            }

        });

      

        
       

        
    });
  
    
  </script>
  
@endsection