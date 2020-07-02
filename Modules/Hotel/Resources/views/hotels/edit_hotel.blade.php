@extends('layouts.master')

@section('css')
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="{{ asset(PLUGINS.'select2/dist/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{ asset(PLUGINS.'summernote/summernote-bs4.css')}}">
  <link rel="stylesheet" href="{{ asset('/css/soap-icon.css')}}">
@endsection

@section('content')

<form method="POST" action="{{ route('hotel.saveupdate') }}" >
  <input type="hidden" name="id" value="{{$hotel->id}}">
  @csrf
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{__('hotel.edit_hotel')}}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/')}}">{{ __('commun.home') }}</a></li>
              <li class="breadcrumb-item"><a href="{{route('hotel.allHotels')}}">{{__('hotel.all_hotels')}}</a></li>
              <li class="breadcrumb-item active">{{__('hotel.edit_hotel')}}</li>
            </ol>
          </div>
        </div>    
      </div><!-- /.container-fluid -->
      <div class=" header-actions">
        <a href="{{route('hotel.allRooms',$hotel->id)}}" class="btn btn-warning">{{__('hotel.manage_rooms')}}</a>
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
              <input type="checkbox" class="success" name="publish" value="1" @if($hotel->status) checked @endif>
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
                <label>{{__('hotel.hotel name')}}</label>
                <input  type="text"  value="{{ old('name',$hotel->name) }}" name="name" placeholder="{{__('hotel.hotel name')}}" class="form-control @error('name') is-invalid @enderror">
                @error('name')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>

              <div class="form-group col-sm-12">
                <label>{{__('hotel.Short description')}}</label>
                <input  type="text" value="{{ old('shortdesc',$hotel->shortdesc) }}" name="shortdesc" placeholder="{{__('hotel.Short description')}}" class="form-control @error('shortdesc') is-invalid @enderror" >
                @error('shortdesc')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>

              <div class="form-group col-sm-12 @error('fulldesc') border border-danger @enderror ">
                <label>{{__('hotel.Full description')}}</label>
                <textarea class="textarea " name="fulldesc" placeholder="" style="width: 100%; height: 500px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" >{{ old('fulldesc',$hotel->fulldesc) }}</textarea>
                
                  

                  @error('fulldesc')
                  <span class="text-danger">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
                
              
              </div>  
            </div>
          </div>
        </div>
      </div>

      {{-- ################# Box Location #####################--}}
      <div class="box card card-secondary" style="padding:0px;">
        <div class="card-header">
          <h3 class="card-title ">{{__('commun.Location')}}</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
          </div>
        </div>

        <div class="card-body">
          <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                  <label>{{__('registration.address')}}</label>
                <input  type="text"  value="{{ old('address',$hotel->address) }}" name="address" placeholder="{{__('registration.address')}}" class="form-control @error('address') is-invalid @enderror">
                @error('address')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              @php $oldcity = explode(":", old('city',$hotel->city))[0];@endphp
             

              <div class="form-group">
                <label>{{__('registration.city')}}</label>
                <select id="cities" name="city" class="form-control select2 @error('city') is-invalid @enderror" style="width: 100%;" >
                  <option value="">-- {{ __('commun.select') }} --</option>
                  @foreach ($cities as $citie)  
                    <option value="{{$citie->name}}:{{$citie->lat}}:{{$citie->lng}}" @if ($citie->name==$oldcity) selected @endif>{{$citie->name}}</option>
                  @endforeach
                </select>
                @error('city')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>

              <div class="form-group">
                <label>{{__('registration.country')}}</label>
                <select class="form-control select2 @error('country') is-invalid @enderror" name="country" style="width: 100%;" >
                  <option value="">-- {{ __('commun.select') }} --</option>
                  @foreach(get_country_lists(app()->getLocale()) as $id=>$name)
                    <option value="{{$id}}" @if ($id==$hotel->country || $id=="MA") selected @endif>{{$name}}</option>
                  @endforeach

                  @error('country')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </select>
              </div>

              <div class="form-group">
                <label>{{__('registration.Gps coordinates')}}</label>
                <div style="border:1px solid #cccccc;padding:10px;">
                  <input  id="map_lat" type="text"  style="margin-bottom:5px;" value="{{ old('map_lat',$hotel->map_lat) }}" name="map_lat"  placeholder="lat : 30.4166" class="form-control @error('map_lat') is-invalid @enderror">
                  <input  id="map_lon" type="text"  style="margin-bottom:5px;" value="{{ old('map_lon',$hotel->map_lng) }}" name="map_lng"  placeholder="lon : -9.60297" class="form-control @error('map_lng') is-invalid @enderror">
                  <input  id="map_zoom" type="number"  style="margin-bottom:5px;" value="{{ old('map_zoom',$hotel->map_zoom) }}" name="map_zoom"  placeholder="zoom : 5" class="form-control @error('map_zoom') is-invalid @enderror" min="0" max="22">
                  <button id="getgps" type="button" class="btn btn-primary btn-sm">{{__('commun.Show on map')}}</button>
                </div>
              </div>

              <div class="form-group">
                <label>{{__('commun.embed map')}}</label>
                <textarea id="embedmap_value" style="margin-bottom:5px;" class="form-control @error('embedmap') is-invalid @enderror" name="embedmap"  rows="5" >{{ old('embedmap',$hotel->embedmap) }}</textarea>
                <button id="checkembed" type="button" class="btn btn-primary btn-sm">{{__('commun.check')}}</button>
                <a href="https://www.google.com/maps/d/?hl=fr" target="_blank">{{__('commun.create embed map')}}</a>
              </div>
            </div>

            <div class="col-sm-8">
              <div id="map"></div>
            </div>
          </div>
        </div>
      </div>
      
      {{-- ################# Box Media #####################--}}
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
                @if(!isset($hotel->image_id) || empty($hotel->image_id))
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
                        <img width="100%" height="100%" src="{{asset(IMAGES_HOTELS.$hotel->image_id)}}?t={{rand()}}"  />
                      </div> 
                    </figure>
                    <input id="imagefeature" type="file" name="imagefeature" />
                  </div>
                @endif
                <button id="btndeleteimgfeature" type="button" class="btn btn-danger btn-sm delimg" ><i class="fas fa-trash-alt"></i></button>
              </div>
            </div>
          </div>
          <div class="row" style="margin-top:20px">
            <div class="col-sm-12">
              <label class="col-sm-12 ">{{__('commun.Gallery Images')}}</label>
              <div class=" upload-btn-wrapper col-sm-12">
                <button type="button" class="btn btn-primary btn-sm">{{__('commun.Add image')}}</button>
                <input id="gallerybtn" type="file" name="gallerybtn" />
              </div>
              
              <div class=" boxgallery"> 
                @if(isset($hotel->gallery) && !empty($hotel->gallery))
                  @php $images = explode(",", $hotel->gallery);@endphp
                  @foreach($images as $img)   
                    <div class="imgboxgallery">
                      <img width="100%" height="100%" src="{{asset(IMAGES_HOTELS.$img)}}" />
                    <button  type="button" class="btn btn-danger btn-sm delimg" onclick="deleteimgGallery('{{$img}}')"><i class="fas fa-trash-alt"></i></button>
                    </div>
                  @endforeach
                @endif 
              </div>
            </div>
          </div>
          
          <div class="form-group col-sm-12" style="margin-top:20px">
            <label class="control-label">Youtube Video</label>
            <input type="text" name="video" class="form-control" value="{{ old('video',$hotel->video) }}" placeholder="Youtube link video">
          </div>
          
          
        </div>
      </div>

      {{-- ################# Box Hotel Policy #####################--}}
      <div class="box card card-secondary" style="padding:0px;">
        <div class="card-header">
          <h3 class="card-title ">Hotel Policy</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="form-group col-sm-4">
              <label>Hotel rating standard</label>
              <input  type="number"  value="{{ old('star_rate',$hotel->star_rate) }}" name="star_rate" placeholder="{{__('hotel.hotel name')}}" class="form-control @error('star_rate') is-invalid @enderror" min="1" max="5">
              @error('star_rate')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
              @enderror
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
            @foreach ($facilities as $facility)
              <div class="col-md-4 col-sm-6 amenitiebox">
                <label class="amenitie-container">
                  <span><div class="icon">
                    <i class="{{$facility['icon']}}"></i>
                  </div>{{$facility['title']}}</span>
                  <input type="checkbox" name="facilities[]" value="{{$facility['id']}}" {{$facility['checked']}}>
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
  <script src="{{ asset(PLUGINS.'select2/dist/js/select2.full.min.js')}}"></script>
  <script src="{{ asset(PLUGINS.'summernote/summernote-bs4.min.js')}}"></script>
  <script >
    $('.select2').select2();

    function deleteimgGallery(imgname) {
        $.ajax({
            url: "{{ route('hotel.deleteimageGallery') }}",
            method: "POST",
            data: { id: {{$hotel->id}}, name: imgname },
            beforeSend: function() {},
            success: function(data) {
                var partsArray = data.uploaded_image.split(',');
                var str = "";
                for (i = 0; i < partsArray.length; i++) {
                    if (partsArray[i] !== "") {
                        imgsrc = '{{asset(IMAGES_HOTELS.":idimg")}}';
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
                url: "{{ route('hotel.deleteimage') }}",
                method: "POST",
                data: { id: {{$hotel->id}} },

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
                form_data.append("id", {{$hotel->id}});

                $.ajax({
                    url: "{{ route('hotel.addToGallery') }}",
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
                                    imgsrc = '{{asset(IMAGES_HOTELS.":idimg")}}';
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
                form_data.append("id", {{$hotel->id}});

                $.ajax({
                    url: "{{ route('hotel.uploadImage') }}",
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

        $('.textarea').summernote({
            height: 200,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link']],
                //['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']],
            ],

        });

        $("#cities").change(function() {
            var coolVar = $(this).val();
            var partsArray = coolVar.split(':');
            $("#map_lat").val(partsArray[1]);
            $("#map_lon").val(partsArray[2]);
            $("#map_zoom").val(10);
            initMap();
            $("#embedmap_value").val("");
        });

        $("#checkembed").on('click', function(e) {
          var str = $('#embedmap_value').val();
          $("#map").html(str);
        });

        $('#getgps').on('click', function(e) {       
          initMap();
        });
    });
  
    function initMap() {
        var xlat = parseFloat($("#map_lat").val());
        var ylon = parseFloat($("#map_lon").val());
        var zoommap = parseFloat($("#map_zoom").val());


        var myLatlng = { lat: xlat, lng: ylon };
        var map;
        map = new google.maps.Map(document.getElementById('map'), {
            center: myLatlng,
            zoom: zoommap
        });

        var marker = new google.maps.Marker({
            position: myLatlng,
            map: map
        });

        map.addListener('click', function(e) {
            marker.setPosition(e.latLng);
            $("#map_lat").val(e.latLng.lat());
            $("#map_lon").val(e.latLng.lng());
            $("#map_zoom").val(map.getZoom());

            var str = '<iframe width="100%" height="480"  id="gmap_canvas" src="https://maps.google.com/maps?q=' + e.latLng.lat() + ',' + e.latLng.lng() + '&t=&z=' + map.getZoom() + '&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>';
            $("#embedmap_value").val(str);
        });

        map.addListener('zoom_changed', function() {
            var lt = $("#map_lat").val();
            var ln = $("#map_lon").val();
            $("#map_zoom").val(map.getZoom());

            var str = '<iframe width="100%" height="480"  id="gmap_canvas" src="https://maps.google.com/maps?q=' + lt + ',' + ln + '&t=&z=' + map.getZoom() + '&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>';
            $("#embedmap_value").val(str);

        });
    }
  </script>
  <script src="https://maps.googleapis.com/maps/api/js?callback=initMap" async defer></script>
@endsection