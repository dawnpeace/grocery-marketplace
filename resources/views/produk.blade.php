@extends('default')

@section('breadcrumb')
<div class="container w-75 mt-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <a href="{{url('/')}}" class="breadcrumb-item" aria-current="page">Dapurpedia</a>
            <li class="breadcrumb-item active" aria-current="page">Pasar</li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="container w-75">
    <div class="card">
        <div class="row">
            <div class="col-md-4">
                <img style="max-height: 12rem;" src="{{$pasar->displayUrl()}}" alt="" class="img img-fluid">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h2>Produk di {{$pasar->nama_pasar}}</h2>
                    <hr>
                    <h5>{{$pasar->alamat}}</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="row my-4 mh-70vh">
        @foreach($produk as $item)
            <div class="col-md-3">
                <div class="p-2">
                    <div class="card shadow">
                        <a href="{{route('lihat.produk',[$item->id])}}" class="link-unstyled">
                            <img style="min-height:150px;object-fit:cover;" class="img-fluid" src="{{displayUrl($item->display)}}" alt="">
                        </a>
                        <div class="card-body">
                            <hr>
                            <p class="h5">{{$item->nama_produk}}</p>
                            <p class="text-primary font-weight-bold">{{$item->penjual->nama_toko}}</p>
                            <i>{{$item->harga()."/".$item->satuan_unit}}</i>
                        </div>
                        @can('pembeli')
                        <a href="{{route('tambah.produk',[$item->id])}}" class="btn {{$item->tersedia ? 'btn-primary ' : 'btn-secondary'}} btn-sm">{!! $item->tersedia ? '<i class="fas fa-cart-plus"></i>' : '<i class="fas fa-times-circle"></i> Item Kosong' !!}</a>
                        @endcan
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="d-flex">
        <div class="m-auto">
            {{$produk->links()}}
        </div>
    </div>
</div>

@endsection