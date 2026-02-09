 <aside class="main-sidebar sidebar-dark-primary bg-navy elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="-" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{Auth::user()->name}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
          </li>
           @if(!in_array(Auth::user()->role, ['kabag','kasubag','pj']))
          <li class="nav-item">
            <a href="{{route('dashboard')}}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Dashboard
        
              </p>
            </a>
           
            <li class="nav-item">
                <a href="{{route('suratmasuk')}}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Surat Masuk
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
            </li>
            @endif
            <li class="nav-item">
                    <a href="{{route('disposisimasuk')}}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Disposisi
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
            </li>
        
          </li>
          <hr>
          
          <li class="nav-item menu-open">
            <a href="#" class="nav-link bg-success">Master Data</a>
          </li>
          <li class="nav-item">
            <a href="{{route('dashboard')}}" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                User
        
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
