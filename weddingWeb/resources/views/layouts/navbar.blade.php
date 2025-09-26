 <nav class="app-header navbar navbar-expand bg-body">
     <!--begin::Container-->
     <div class="container-fluid">
         <ul class="navbar-nav">
             <li class="nav-item">
                 <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                     <i class="bi bi-list"></i>
                 </a>
             </li>
         </ul>
         <!--begin::End Navbar Links-->
         <ul class="navbar-nav ms-auto">
             <!--end::Notifications Dropdown Menu-->
             <!--begin::Fullscreen Toggle-->
             <li class="nav-item">
                 <a class="nav-link" href="#" data-lte-toggle="fullscreen">
                     <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                     <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none"></i>
                 </a>
             </li>
             <!--end::Fullscreen Toggle-->
             <!--begin::User Menu Dropdown-->
             <li class="nav-item dropdown user-menu">
                 <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                     <img src="{{asset('AdminLTE/dist/assets/img/user2-160x160.jpg')}}"
                         class="user-image rounded-circle shadow" alt="User Image" />
                     <span class="d-none d-md-inline">Alexander Pierce</span>
                 </a>
                 <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                     <!--begin::User Image-->
                     <li class="user-header text-bg-primary">
                         <img src="{{asset('AdminLTE/dist/assets/img/user2-160x160.jpg')}}"
                             class="rounded-circle shadow" alt="User Image" />
                         <p>
                             Alexander Pierce - Web Developer
                             <small>Member since Nov. 2023</small>
                         </p>
                     </li>
                     <!--end::User Image-->
                     <!--begin::Menu Footer-->
                     <li class="user-footer">
                         <a href="#" class="btn btn-default btn-flat">Profile</a>
                         <a class="btn btn-default btn-flat float-end" href="{{ route('logout') }}" onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                             Sign out
                         </a>

                         <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                             @csrf
                         </form>
                         <a href="{{route('logout')}}" class="btn btn-default btn-flat float-end"></a>
                     </li>
                     <!--end::Menu Footer-->
                 </ul>
             </li>
             <!--end::User Menu Dropdown-->
         </ul>
         <!--end::End Navbar Links-->
     </div>
     <!--end::Container-->
 </nav>
