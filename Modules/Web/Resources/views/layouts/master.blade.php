<!DOCTYPE html>
<!--[if IE 8]>          <html class="ie ie8"> <![endif]-->
<!--[if IE 9]>          <html class="ie ie9"> <![endif]-->
<!--[if gt IE 9]><!-->  <html> <!--<![endif]-->
<head>
    <!-- Page Title -->
    <title>SafarBooking</title>
    
    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Travelo - Travel, Tour Booking HTML5 Template">
    <meta name="author" content="SoapTheme">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    
    <!-- Theme Styles -->
    <link rel="stylesheet" href="{{ asset('web/css/bootstrap.min.css')}}">
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> --}}
    
    <link rel="stylesheet" href="{{ asset('web/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ asset('/src/plugins/fontawesome-free/css/all.min.css')}}">
    <link href='http://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="{{ asset('web/css/animate.min.css')}}">
    <link rel="stylesheet" href="{{ asset('/css/soap-icon.css')}}">
    
    
    @yield('css')

    <!-- Main Style -->
    <link id="main-style" rel="stylesheet" href="{{ asset('web/css/style.css')}}">
    <link id="main-style" rel="stylesheet" href="{{ asset('web/css/popup.css')}}">
    
    <!-- Updated Styles -->
    <link rel="stylesheet" href="{{ asset('web/css/updates.css')}}">

    <!-- Custom Styles -->
    <link rel="stylesheet" href="{{ asset('web/css/custom.css')}}">
    
    <!-- Responsive Styles -->
    <link rel="stylesheet" href="{{ asset('web/css/responsive.css')}}">
    
    <!-- CSS for IE -->
    <!--[if lte IE 9]>
        <link rel="stylesheet" type="text/css" href="{{ asset('web/css/ie.css')}}" />
    <![endif]-->
    
    
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script type='text/javascript' src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
      <script type='text/javascript' src="http://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.js"></script>
    <![endif]-->
   
</head>
<body>
    
    <div id="page-wrapper">
        @include("web::layouts.header")
        <div class="page-title-container">
            @yield('banner')
        </div>
        <section id="content">
            <div class="container">
                <div id="main">
                   @yield('main')
                </div>
            </div>
        </section>
        
        @include("web::layouts.footer")
    </div>

    <div class="md-modal md-effect-1" id="modal-1">
        <div class="md-content">
            <div class="md-close" id="md-close"><i class="fas fa-times-circle"></i></div>
            <div id="popup-content"></div>
                
        </div>
    </div>

    

    
	<div class="md-overlay"></div><!-- the overlay element -->

    <!-- Javascript -->
    <script type="text/javascript" src="{{ asset('web/js/jquery-1.11.1.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('web/js/jquery.noconflict.js')}}"></script>
    <script type="text/javascript" src="{{ asset('web/js/modernizr.2.7.1.min.js')}}"></script> 
    <script type="text/javascript" src="{{ asset('web/js/jquery-migrate-1.2.1.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('web/js/jquery.placeholder.js')}}"></script>
    <script type="text/javascript" src="{{ asset('web/js/jquery-ui.1.10.4.min.js')}}"></script>
    
    <!-- Twitter Bootstrap -->
    <script type="text/javascript" src="{{ asset('web/js/bootstrap.js')}}"></script>
    
    <!-- load revolution slider scripts -->
    <script type="text/javascript" src="{{ asset('web/components/revolution_slider/js/jquery.themepunch.tools.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('web/components/revolution_slider/js/jquery.themepunch.revolution.min.js')}}"></script>
    
    <!-- load BXSlider scripts -->
    <script type="text/javascript" src="{{ asset('web/components/jquery.bxslider/jquery.bxslider.min.js')}}"></script>
    
    <!-- load FlexSlider scripts -->
    <script type="text/javascript" src="{{ asset('web/components/flexslider/jquery.flexslider-min.js')}}"></script>
    
    <!-- Google Map Api -->
    <script type='text/javascript' src="http://maps.google.com/maps/api/js?sensor=false&amp;language=en"></script>
    <script type="text/javascript" src="{{ asset('web/js/gmap3.min.js')}}"></script>
    
    <!-- parallax -->
    <script type="text/javascript" src="{{ asset('web/js/jquery.stellar.min.js')}}"></script>
    
    <!-- waypoint -->
    <script type="text/javascript" src="{{ asset('web/js/waypoints.min.js')}}"></script>

    <!-- load page Javascript -->
    <script type="text/javascript" src="{{ asset('web/js/theme-scripts.js')}}"></script>
    <script type="text/javascript" src="{{ asset('web/js/scripts.js')}}"></script>
    
    <script type="text/javascript">

    

        tjq(document).ready(function() {
           
            
            tjq("#rating").slider({
                range: "min",
                value: 40,
                min: 0,
                max: 50,
                slide: function( event, ui ) {
                    
                }
            });

           

           
        });
    </script>

@yield('js')
</body>
</html>

