<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Dapurpedia</title>
  <link href="{{asset('css/app.css')}}" rel="stylesheet">
  <script src="{{asset('js/app.js')}}"></script>


</head>

<body>

  <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
      <a href="{{url('')}}" class="link-unstyled"><div class="sidebar-heading"> Dapurpedia</div></a>
      <div class="list-group list-group-flush">
        <a href="{{route('admin.dashboard') == url()->current() ? '#' : route('admin.dashboard')}}" class="list-group-item list-group-item-action bg-light"> <i class="fa fa-home"></i> Menu Utama</a>
        <a href="{{ route('admin.manajemen.driver') == url()->current() ? '#' : route('admin.manajemen.driver')}}" class="list-group-item list-group-item-action bg-light"> <i class="fa fa-motorcycle"></i> Manajemen Driver</a>
        <a href="{{route('admin.manajemen.pembeli') == url()->current() ? '#' : route('admin.manajemen.pembeli')}}" class="list-group-item list-group-item-action bg-light"> <i class="fas fa-shopping-basket"></i> </i> Manajemen Pembeli</a>
        <a href="{{route('admin.manajemen.penjual') == url()->current() ? '#' : route('admin.manajemen.penjual')}}" class="list-group-item list-group-item-action bg-light"> <i class="fas fa-address-book"></i> Manajemen Penjual</a>
      </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-dark bg-dark border-bottom">
        <button class="btn btn-secondary" id="menu-toggle"><i class="fa fa-bars"></i></button>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item dropdown">
              <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{Auth::user()->nama}}
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
              </div>
            </li>
          </ul>
        </div>
      </nav>
      <div class="container-fluid">
        @yield('breadcrumb')
        @yield('content')
      </div>
    </div>
    <!-- /#page-content-wrapper -->

  </div>


  @yield('js')
  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });


  </script>

</body>

</html>
