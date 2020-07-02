<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li id="togglesidebar" class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="{{route('web.hotels.list')}}" class="btn btn-link" target="_blank"><i class="fa fa-eye"></i> {{__('menu.go_website')}}</a>
    </li>
    
  </ul>

  

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">

    @if (false)
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="{{ asset('./src/dist/img/user1-128x128.jpg')}}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="./src/dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="./src/dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
    @endif

    <li class="nav-item dropdown">
      <a class="nav-link user-profile dropdown-toggle" data-toggle="dropdown" href="#">{{ucfirst(app()->getLocale())}}</a>

      <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="{{route('user.changeLocale','en')}}"> En (English)</a>
        <a class="dropdown-item" href="{{route('user.changeLocale','fr')}}">Fr (Français)</a>
      </div>

    </li>

    <li class="nav-item dropdown">
      <a class="nav-link user-profile dropdown-toggle" data-toggle="dropdown" href="#">
        
          @php  
              $authuser=Auth::user();
              $photoname=$authuser->photo?$authuser->photo:'avatar.png'; 
          @endphp
          <img src="{{url('/src/images/profiles/'.$photoname.'?t='.time())}}" alt="">{{ $authuser->firstname }} {{ $authuser->lastname }}
        
        </a>

      <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="{{route('user.editprofile')}}"> {{__('menu.profile')}}</a>
        <a class="dropdown-item" href="{{route('user.changemypassword')}}">{{__('menu.change_password')}}</a>
        <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form-topbar').submit();"><i class="fas fa-sign-out-alt "></i>{{__('auth.logout')}}</a>
        <form id="logout-form-topbar" action="{{ route('logout') }}" method="POST" style="display: none;">
          {{ csrf_field() }}
        </form>
      </div>

    </li>
    

  </ul>
</nav>