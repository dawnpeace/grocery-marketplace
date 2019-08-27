@extends('default')

@section('breadcrumb')
    <div class="container w-75 mt-3">
        <nav class="breadcrumb">
            <a class="breadcrumb-item" href="{{url('/')}}">Dapurpedia</a>
            <span class="breadcrumb-item active">Profil Penjual</span>
        </nav>
    </div>
@endsection

@section('content')
    <div class="container w-75 mh-70vh mb-5">
        <div class="card">
            <div class="card-body">
                <h2 class="text-center">{{$penjual->nama_toko}}</h2>
                <hr>
                <div class="row">
                    <div class="col-md-4">
                        <img src="{{$penjual->urlFoto()}}" class="img img-fluid">
                    </div>
                    <div class="col-md-8">
                        <ul class="list-group">
                            <li class="list-group-item">Kota : {{$penjual->kota}}</li>
                            <li class="list-group-item">Alamat :  {{$penjual->alamat}}</li>
                            <li class="list-group-item">E-mail :  {{$penjual->user->email}}</li>
                            <li class="list-group-item">Jumlah Produk Tersedia : {{$penjual->produk->count()}}</li>
                            <li class="list-group-item">Domisili Pasar : {{$penjual->pasar->nama_pasar}}</li>
                            <li class="list-group-item">
                                Deskripsi Penjual
                                <p>
                                    {{$penjual->deskripsi}}
                                </p>
                            </li>
                        </ul>
                        <div class="mb-2"></div>
                        <div class="text-right">
                            <button type="button" onclick="openWA({{whatsappLink($penjual->no_telp)}})" class="btn btn-success"><i class="fab fa-whatsapp"></i> Kontak Penjual</button>
                            <button data-toggle="tooltip" data-clipboard-text="{{$penjual->no_telp}}" class="btn btn-secondary clipboard"><i class="fa fa-clipboard"></i> Salin No Telp</button>
                        </div>
                        <p style="display:none;" class="copy-text pr-3 text-right font-weight-bold pt-2">Nomor telepon tersalin !</p>
                    </div>
                </div>
                <hr>
                <h4 class="text-center">Produk {{$penjual->nama_toko}}</h4>
                <div class="row">
                    @forelse($penjual->produk as $item)
                    <div class="col-md-3">
                        <div class="p-2">
                            <div class="card shadow">
                                <a href="{{route('lihat.produk',[$item->id])}}" class="link-unstyled">
                                    <img style="min-height:150px;object-fit:cover;" class="img-fluid" src="{{displayUrl($item->display)}}" alt="">
                                </a>
                                <div class="card-body">
                                    <hr>
                                    <p class="h5">{{$item->nama_produk}}</p>
                                    <i>{{$item->harga()."/".$item->satuan_unit}}</i>
                                </div>
                                @can('pembeli')
                                <a href="{{route('tambah.produk',[$item->id])}}" class="btn {{$item->tersedia ? 'btn-primary ' : 'btn-secondary'}} btn-sm">{!! $item->tersedia ? '<i class="fas fa-cart-plus"></i>' : '<i class="fas fa-times-circle"></i> Item Kosong' !!}</a>
                                @endcan
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-md-12 p-4">
                        <div class="alert alert-secondary" role="alert">
                          <h5 class="alert-heading text-center">Penjual belum memiliki Produk yang tersedia.</h5>
                        </div>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function(){
            var clipboard = new ClipboardJS('.clipboard');
            clipboard.on('success',function(e){
                $('.copy-text').show();
                setInterval(function(){
                    $('.copy-text').hide();
                },1600);
            });
        });
    </script>
@endsection