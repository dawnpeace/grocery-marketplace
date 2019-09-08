<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{config("app.name")}}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div id="app">
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="{{url('')}}">Dapurpedia</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          
          <form method="GET" action="{{route('pencarian')}}" class="mx-2 my-auto d-inline w-100">
            <div class="input-group mr-sm-2">
              <input class="form-control" name="q" type="search" placeholder="Pencarian" aria-label="Search">
              <div class="input-group-append">
                <button type="submit" class="btn btn-light"><i class="fa fa-arrow-right"></i></button>
              </div>
              
              @can('pembeli')
              <a href="{{route('keranjang')}}" class="btn btn-primary ml-sm-2">
                  <i class="fas fa-cart-plus"></i>
                  Keranjang Anda
              </a>
              @endcan
              
            </div>
          </form>
          @auth
          <div class="navbar-nav ml-auto">
            <li class="nav-item active dropdown mr-1">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{explode(" ",Auth::user()->nama)[0]}}
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                @if(auth()->user()->jenis != 'SUPERADMIN')
                <a class="dropdown-item" href="{{Auth::user()->profilUrl()}}">Profil</a>
                @endif
                @if(auth()->user()->jenis == 'PEMBELI')
                <a class="dropdown-item" href="{{route('review.index')}}">Penilaian</a>
                <a class="dropdown-item" href="{{route('transaksi.history')}}">Riwayat Belanja</a>
                @endif
                @if(auth()->user()->jenis != 'PEMBELI')
                <a class="dropdown-item" href="{{Auth::user()->dashboardUrl()}}">Dashboard</a>
                @endif
                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                    Logout
                </a>
              </div>
            </li>
          </div>
          @endauth
          @guest
          <div class="btn-group">
            <a href="{{route('login')}}" class="btn btn-light">Masuk</a>
            <a href="{{route('register')}}" class="btn btn-light">Daftar</a>
          </div>
          @endguest

        </div>
      </nav>
        <div class="">
          @yield('breadcrumb')
        </div>
        @guest
        <div class="{{Route::current()->getName() == 'dashboard' ? 'container-fluid' : 'container w-75'}}">
            <div class="alert alert-secondary" role="alert">
                <strong>Anda belum masuk. <a href="{{route('login')}}">Silahkan masuk untuk melanjutkan</a></strong>
            </div>
        </div>
        @endguest
        @auth
        @if(Auth::user()->jenis == 'PEMBELI')
        @cannot('pembeli')
        <div class="container w-75">
          <div class="alert alert-secondary" role="alert">
              <strong>Akun anda masih dalam tahap verifikasi.</strong>
          </div>
        </div>
        @endcannot
        @endif
        @endauth
        @yield('content')

      </div>
      <footer class="d-block bg-dark py-2">
        <div class="text-center text-light">
            <ul class="list-inline text-center mb-0">
                @guest<li class="list-inline-item"><a href="{{route('register')}}">Register</a></li>
                <li class="list-inline-item"><a href="{{route('login')}}">Login</a></li>@endguest
                @auth <li class="list-inline-item"><a href="{{Auth::user()->dashboardUrl()}}">Dashboard</a></li> @endauth
                @auth
                <li class="list-inline-item">
                    <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                    Logout
                </a>
                </li>
                @endauth         
            </ul>
            @auth
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            @endauth
          Dapurpedia &copy; 2019 
        </div>
      </footer>
      <script src="{{asset('js/app.js')}}"></script>
      <script>
        $(document).ready(function() {
          $(".dropdown-toggle").dropdown();
        });
      </script>
      @yield('js')
</body>
</html>