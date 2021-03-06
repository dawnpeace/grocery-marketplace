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
      <a class="link-unstyled" href="{{url('/')}}"><div class="sidebar-heading">Dapurpedia</div></a>
      <div class="list-group list-group-flush">
        <a href="{{route('penjual.dashboard') == url()->current() ? '#' : route('penjual.dashboard')}}" class="list-group-item list-group-item-action bg-light {{route('penjual.dashboard') == url()->current() ? 'text-primary font-weight-bold' : route('penjual.dashboard')}}"> <i class="fa fa-list"></i> Produk</a>
        <a href="{{route('permintaan') == url()->current() ? '#' : route('permintaan')}}" class="list-group-item list-group-item-action bg-light {{route('permintaan') == url()->current() ? 'text-primary font-weight-bold' : route('permintaan')}}"> <i class="fa fa-check-square"></i> Permintaan</a>
        <a href="{{route('permintaan.diproses') == url()->current() ? '#' : route('permintaan.diproses')}}" class="list-group-item list-group-item-action bg-light {{route('permintaan.diproses') == url()->current() ? 'text-primary font-weight-bold' : route('permintaan.diproses')}}"> <i class="fas fa-clipboard"></i> </i> Permintaan Ditunggu</a>
        <a href="{{route('penjual.profil.edit') == url()->current() ? '#' : route('penjual.profil.edit')}}" class="list-group-item list-group-item-action bg-light {{route('penjual.profil.edit') == url()->current() ? 'text-primary font-weight-bold' : route('penjual.profil.edit')}}"> <i class="fas fa-user"></i> </i> Profil Saya</a>
        <button onclick="openWA({{whatsappLink(whatsappAdmin())}})" href="#" class="list-group-item list-group-item-action bg-light"> <i class="fas fa-phone"></i> Hubungi Admin</button>
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
      <div class="container">
        @yield('breadcrumb')
        <div class="">
          @yield('content')
        </div>
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

