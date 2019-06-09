<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{config("app.name")}}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{asset('js/app.js')}}"></script>

</head>
<body>
    <div id="app">
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="{{url('')}}">Dapurpedia</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <form method="GET" action="{{route('pencarian')}}" class="form-inline w-50 ml-auto">
            <input class="form-control mr-sm-2 w-100" name="q" type="search" placeholder="Pencarian" aria-label="Search">
          </form>
          @guest
          <div class="btn-group">
            <a href="{{route('login')}}" class="btn btn-light">Masuk</a>
            <a href="{{route('register')}}" class="btn btn-light">Daftar</a>
          </div>
          @endguest
          @can('pembeli')
          <a href="{{route('keranjang')}}" class="btn btn-primary d-block">
              <i class="fas fa-cart-plus"></i>
              Keranjang Anda
          </a>
          @endcan
        </div>
      </nav>
        <div class="">
          @yield('breadcrumb')
        </div>
        @guest
        <div class="container w-75">
            <div class="alert alert-secondary" role="alert">
                <strong>Anda belum masuk. Silahkan masuk untuk melanjutkan</strong>
            </div>
        </div>
        @endguest
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
      @yield('js')
</body>
</html>