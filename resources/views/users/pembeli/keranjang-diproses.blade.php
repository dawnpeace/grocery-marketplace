@extends('default')
@section('breadcrumb')
<div class="container mt-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <a href="{{route('dashboard')}}" class="breadcrumb-item" aria-current="page">Home</a>
            <a href="{{route('keranjang')}}" class="breadcrumb-item" aria-current="page">Keranjang Saya</a>
            <span class="breadcrumb-item active">Dalam Proses</span>
        </ol>
    </nav>
</div>
@endsection

@section('content')
    <div style="min-height:70vh" class="container">
        @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            {{Session::get('success')}}
        </div>
        @endif
        <h1>Pesanan yang sedang diproses</h1>

        @forelse($keranjang as $belanja)
        <ul class="list-group dark mb-3 mx-3">
            <li class="list-group-item {{$belanja->sedang_diproses ? 'list-group-item-success' : 'list-group-item-info'}}">{{$belanja->penjual->user->nama}}</li>
            @foreach($belanja->belanjaan as $item)
                <li class="list-group-item">
                    <u>{{$item->produk->nama_produk}}</u> - {{formatRP($item->jumlah*$item->harga)}}
                </li>
            @endforeach
        </ul>
        @empty
            <div class="alert alert-info mx-4" role="alert">
                <strong class="my-4">Anda belum memiliki keranjang diproses</strong>
            </div>
        @endforelse
    </div>
@endsection