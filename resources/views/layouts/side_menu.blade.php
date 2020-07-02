<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="#" class="brand-link">
    <img src="{{asset('./src/dist/img/AdminLogo.png')}}" alt="AsfarBooking" class="brand-image img-circle elevation-3" style="opacity: .8">
    <h3 class="brand-text font-weight-light logo-menu">Booking Asfar</h3>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user (optional) -->


    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->

        {{-- ############## Menu Users ################# --}}
        @if(hasAnyPermission(['manage users','manage roles','manage permissions']))
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users-cog"></i>
              <p>
                {{ __('menu.users') }}
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @if(checkpermission('manage users'))
                <li class="nav-item">
                  <a href="{{route('user.allusers')}}" class="nav-link {{ currentRoute(route('user.allusers')) }}">
                    <i class="fas fa-users nav-icon"></i>
                    <p>{{ __('menu.all_users') }}</p>
                  </a>
                </li>
              @endif
              @if(checkpermission('manage roles'))
                <li class="nav-item">
                  <a href="{{route('user.allroles')}}" class="nav-link {{ currentRoute(route('user.allroles')) }}">
                    <i class="fas fa-user-lock nav-icon"></i>
                    <p>{{ __('menu.roles_manager') }}</p>
                  </a>
                </li>
              @endif
              @if(checkpermission('manage permissions'))
                <li class="nav-item">
                  <a href="{{route('user.AllPermissions')}}" class="nav-link {{ currentRoute(route('user.AllPermissions')) }}">
                    <i class="fa fa-lock nav-icon"></i>
                    <p>{{ __('menu.permissions') }}</p>
                  </a>
                </li>
              @endif
            </ul>
          </li>
        @endif

        {{-- ############## Menu Translation ################# --}}
        @if(hasAnyPermission(['manage translation admin','manage translation web','manage admin languages']))
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-language"></i>
              <p>

                {{ __('menu.translations') }}
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @if(checkpermission('manage translation admin'))
                <li class="nav-item">
                  <a href="{{route('translation.allgroups')}}" class="nav-link {{ currentRoute(route('translation.allgroups')) }}">
                    <i class="fas fa-crown nav-icon"></i>
                    <p>{{ __('menu.translation_admin') }}</p>
                  </a>
                </li>
              @endif

              @if(checkpermission('manage translation web'))
                <li class="nav-item">
                  <a href="#" class="nav-link ">
                    <i class="fas fa-globe-africa nav-icon"></i>
                    <p>{{ __('menu.translation_web') }}</p>
                  </a>
                </li>
              @endif

              @if(checkpermission('manage admin languages'))
                <li class="nav-item">
                  <a href="{{route('translation.locales')}}" class="nav-link {{ currentRoute(route('translation.locales')) }}">
                    <i class="fas fa-globe nav-icon"></i>
                    <p>{{ __('menu.languages') }}</p>
                  </a>
                </li>
              @endif


            </ul>
          </li>
        @endif
          
        {{-- ############## Menu Hotels ################# --}}
        @if(hasAnyPermission(['manage hotels','manage rooms']))
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-hotel"></i>
                <p>{{ucfirst(__('menu.hotel'))}}<i class="right fas fa-angle-left"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">
              @if(checkpermission('manage hotels'))
                <li class="nav-item">
                  <a href="{{ route('hotel.allHotels') }}" class="nav-link">
                    <i class="fas fa-h-square nav-icon"></i>
                    <p>{{ucfirst(__('menu.hotel_manager'))}}</p>
                  </a>
                </li>
              @endif
            </ul>

            <ul class="nav nav-treeview">
              @if(checkpermission('manage hotels'))
                <li class="nav-item">
                  <a href="{{ route('facilities.hotel') }}" class="nav-link">
           
                    <i class="fas fa-hands-helping nav-icon"></i>
                    <p>{{ucfirst(__('menu.facilities'))}}</p>
                  </a>
                </li>
                
              @endif
            </ul>
          </li>
        @endif
        {{-- ############## Fin Menu Hotels ################# --}}

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
