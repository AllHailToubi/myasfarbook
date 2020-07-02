<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="icon" type="image/png" href="{{asset('./src/dist/img/icon.png')}}" />
  
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AsfarBooking Admin</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('/src/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('./src/plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">
  @yield('css')
  <link rel="stylesheet" href="{{ asset('./src/dist/css/adminlte.min.css')}}">
  <link rel="stylesheet" href="{{ asset('./src/dist/css/style.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
 
 
</head>

<body class="hold-transition sidebar-mini sidebar-collapse">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  @include('layouts.header')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('layouts.side_menu')

  <!-- Content Wrapper. Contains page content -->
  

  @yield('content')
  <!-- /.content-wrapper -->

  <!-- @include('layouts.footer') -->

  

  
  <!-- /.control-sidebar -->
</div>
<!-- ./src/wrapper -->

<!-- jQuery -->

<script src="{{ asset('./src/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('./src/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{ asset('./src/plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{ asset('./src/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>

<!-- AdminLTE App -->
<script src="{{ asset('./src/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('./src/dist/js/demo.js')}}"></script>
{{-- <script src="{{ asset('/src/libs/bootstrap/dist/js/bootstrap.min.js')}}"></script> --}}
@yield('javascript')


<script >
    $(document).ready(function() {
      
    
        var readURL = function(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('.avatar').attr('src', e.target.result);
                }
        
                reader.readAsDataURL(input.files[0]);
            }
        }
        

        $(".file-upload").on('change', function(){
            readURL(this);
        });

        $('#togglesidebar').click(function() {
          event.preventDefault();
          console.log($("body").attr("class"));
        });
    });
    
  </script>

  
</body>
</html>
