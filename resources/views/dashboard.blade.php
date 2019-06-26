@extends('default')

@section('breadcrumb')
<div class="container-fluid w-100 mt-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Dapurpedia</li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="container-fluid w-100 px-5">
    @if(Session::has('warning'))
    <div class="alert alert-warning my-2" role="alert">
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
        {{Session::get('warning')}}
    </div>
    @endif
    <div class="row my-4 mh-70vh">
        <div class="col-md-10 col-sm-6 p-2">
            <div class="row">
                @foreach($daftarPasar as $pasar)
                    <div class="col-md-6 col-sm-12">
                        <a href="{{route('dashboard.produk',[$pasar->id])}}" class="link-unstyled">
                            <div class="p-2">
                                <div class="card shadow">
                                    <div class="row">
                                        <div class="col-md-5 col-sm-12 m-auto">
                                            <img src="{{$pasar->displayUrl()}}" class="img img-fluid">
                                        </div>
                                        <div class="col-md-7 col-sm-12">
                                            <div class="card-body">
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item"><strong>{{$pasar->nama_pasar}}</strong></li>
                                                    <li class="list-group-item">{{$pasar->alamat}}</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col-md-2 col-sm-6 p-2">
            <div class="row p-2">
                <div class="card shadow">
                    <div class="card-body">
                        <h5>Produk Termurah</h5>
                        @foreach($produkMurah as $produk)
                        <hr>
                        <a href="{{route('lihat.produk',[$produk->id])}}" class="link-unstyled">
                            <img src="{{displayUrl($produk->display)}}" class="img img-fluid mb-3">
                        </a>
                        <h6 class="font-weight-bold">
                            <a class="text-primary" href="{{route('lihat.produk',[$produk->id])}}">{{$produk->nama_produk}}</a>
                        </h6>
                        <h6 class="font-weight-bold">
                            <a class="text-dark" href="{{route('profil.penjual',[$produk->penjual_id])}}">{{$produk->penjual->nama_toko}}</a>
                        </h6>
                        <p>Harga : {{formatRP($produk->harga)}}</p>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection