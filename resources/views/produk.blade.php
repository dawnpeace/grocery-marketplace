@extends('default')

@section('breadcrumb')
<div class="m-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Dapurpedia</li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="container w-75">
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
                            <h5>{{$item->nama_produk}}</h5>
                            <i>{{$item->harga()."/".$item->satuan_unit}}</i>
                        </div>
                        @can('pembeli')
                            @if($item->tersedia)
                            <a href="{{route('tambah.produk',[$item->id])}}" class="btn btn-primary btn-sm"><i class="fas fa-cart-plus"></i></a>
                            @endif
                        @endcan
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection