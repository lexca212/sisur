<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
     <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item d-none d-sm-inline-block">
        <form action="{{route('logout')}}" method="post">
            @csrf
            <button type="submit" class="btn btn-danger"><i class="fa fa-ban"></i></button>
        </form>
        <!-- <a href="{{route('logout')}}" class="nav-link"><i class="fa fa-list"></i></a> -->
      </li>
     </ul>
</nav>
