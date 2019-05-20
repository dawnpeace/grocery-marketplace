@extends('users.penjual.include.penjual-navbar')
@section('breadcrumb')
    <div class="mt-4">
        <nav class="breadcrumb">
        <span class="breadcrumb-item active">Dashboard</span>
        </nav>
    </div>
@endsection
@section('content')
    <div class="w-75">
        <h1>Daftar Produk Anda</h1>
        @forelse($daftarProduk as $produk)
        <div class="card my-3"> 
            <div class="card-body">
                <a href="{{route('produk.edit',[$produk->id])}}" class="btn btn-sm btn-outline-primary float-right"><i class="far fa-edit"></i></a>
                <h5>{{$produk->nama_produk}}</h5> 
                <hr>
                <p class="text-justify">{{$produk->deskripsi}}</p>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-md-4 text-center">Harga : {{$produk->harga}}</div>
                    <div class="col-md-4 text-center">Jumlah Tersedia : {{$produk->jumlah_tersedia}}</div>
                    <div class="col-md-4 text-center">Rata rata penilaian : some stars</div>
                </div>
            </div>
        </div>
        @empty
            <div class="card">
                <div class="card-body">
                    <div class="p-3 text-center">
                        <h3>Anda belum mendaftarkan Produk anda.</h3>
                    </div>
                </div>
            </div>
        @endforelse
        {{$daftarProduk->links()}}
    </div>
@endsection
