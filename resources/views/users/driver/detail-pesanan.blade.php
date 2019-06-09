@extends('users.driver.include.driver-navbar')

@section('breadcrumb')
    <div class="mt-4">
        <nav class="breadcrumb">
            <a class="breadcrumb-item" href="{{route('driver.dashboard')}}">Dapurpedia Driver</a>
            <span class="breadcrumb-item active">Detail Pesanan</span>
        </nav>
    </div>
@endsection

@section('content')
    <div class="">
        <div class="card mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <div class="float-right">
                        <form id="form-confirm" method="POST" action="{{route('pesanan.ambil',[$keranjang->id])}}">
                            @csrf
                            <button id="btn-confirm" type="button" class="btn btn-primary"><i class="fa fa-check-square"></i> Ambil Pesanan</button>
                        </form>
                    </div>
                    <div class="clearfix"></div>
                    <h2><i class="fa fa-id-card"></i> Detail Kontak</h2>
                    <table class="table table-sm table-bordered">
                        <tr>
                            <th>Nama Toko</th>
                            <td><p>{{$keranjang->penjual->nama_toko.' - '.$keranjang->penjual->pasar->nama_pasar}}</p></td>
                        </tr>
                        <tr>
                            <th>Alamat Toko</th>
                            <td><p>{{$keranjang->penjual->alamat}}</p></td>
                        </tr>
                        <tr>
                            <th>Kontak Toko</th>
                            <td><p><button data-toggle="tooltip" title="Kirim Pesan ke Penjual" data-placement="bottom" onclick="openWA({{whatsappLink($keranjang->penjual->no_telp)}})" class="btn btn-outline-dark"><i class="fab fa-whatsapp"></i> {{$keranjang->penjual->no_telp}}</button></p></td>                            
                        </tr>
                        <tr>
                            <th>Nama Pembeli</th>
                            <td><p>{{$keranjang->pembeli->user->nama}}</p></td>
                        </tr>
                        <tr>
                            <th>Alamat Pembeli</th>
                            <td><p>{{$keranjang->pembeli->alamat}}</p></td>
                        </tr>
                        <tr>
                            <th>Kontak Pembeli</th>
                            <td><p><button data-toggle="tooltip" title="Kirim Pesan ke Pembeli" data-placement="bottom" onclick="openWA({{whatsappLink($keranjang->pembeli->no_telp)}})" class="btn btn-outline-dark"><i class="fab fa-whatsapp"></i> {{$keranjang->pembeli->no_telp}}</button></p></td>
                        </tr>
                    </table>
        
                    <h2><i class="fa fa-shopping-cart"></i> Detail Barang</h2>
                    <table class="table table-striped table-bordered table-sm">
                        <thead>
                            <th>Nama Item</th>
                            <th>Jumlah</th>
                            <th>Satuan</th>
                        </thead>
                        <tbody>
                            @php $total = 0; @endphp
                            @foreach($keranjang->belanjaan as $item)
                            @php
                                $subtotal = $item->harga * $item->jumlah;
                                $total+=$subtotal;
                            @endphp
                            <tr>
                                <td>{{$item->produk->nama_produk}}</td>
                                <td>{{$item->jumlah}}</td>
                                <td>{{$item->produk->satuan_unit}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <p class="text-right font-weight-bold">Total belanja : {{formatRP($total)}}</p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(function () {
          $('[data-toggle="tooltip"]').tooltip()
        });
        $('#btn-confirm').click(function(){
            swal({
                title: "Proses Pesanan",
                text: "Anda ingin mengambil Pesanan?",
                icon: "info",
                buttons: true,
                dangerMode: true,
            }).then((val)=>{
                if(val){
                    formdel = $('#form-confirm');
                    formdel.submit();
                }
            });
        });
    </script>
@endsection