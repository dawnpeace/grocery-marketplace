@extends('users.penjual.include.penjual-navbar')

@section('breadcrumb')
    <div class="mt-4">
        <nav class="breadcrumb">
        <a href="{{route('penjual.dashboard')}}" class="breadcrumb-item">Dashboard</a>
        <a href="{{route('permintaan')}}" class="breadcrumb-item">Permintaan</a>
        <span class="breadcrumb-item active">Detail Permintaan</span>
        </nav>
    </div>
@endsection

@section('content')
    <div class="table-responsive">
        <div class="float-right mt-3">
            <button id="button-confirm" data-url="{{route('permintaan.proses',[$keranjang->id])}}" class="btn btn-outline-success m-1"><i class="fas fa-check-circle"></i> Proses</button>
        </div>
        <div class="w-75">
            <h2 class="mt-2 ml-2 mb-2">Detail Keranjang {{$keranjang->pembeli->user->nama}}</h2>
        </div>
        <div class="clearfix"></div>
        <table class="table table-striped">
            <thead>
                <th>Nama Produk</th>
                <th>Harga Satuan</th>
                <th>Jumlah</th>
                <th class="text-center">Subtotal</th>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach($keranjang->belanjaan as $item)
                <tr>
                    @php 
                        $subtotal = $item->jumlah*$item->harga;
                        $total+=$subtotal;
                    @endphp
                    <td>{{$item->produk->nama_produk}}</td>
                    <td>{{$item->harga}}</td>
                    <td>{{$item->jumlah}}</td>
                    <td class="text-right">{{formatRP($subtotal)}}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3"><h5>Total</h5></td>
                    <td><h5 class="text-right"><strong><u>{{formatRP($total)}},-<u></strong></h5></td>
                </tr>
            </tfoot>
        </table>
    </div>
    <form id="confirm-order" method="POST" action="{{route('permintaan.proses',[$keranjang->id])}}">@csrf</form>
    
@endsection

@section('js')
    <script>
        $('#button-confirm').click(function(){    
            swal({
                title: "Proses Pesanan",
                text: "Anda ingin memproses Pesanan?",
                icon: "info",
                buttons: true,
                dangerMode: true,
            }).then((val)=>{
                if(val){
                    formdel = $('form#confirm-order');
                    formdel.attr('action',$(this).data('url'));
                    formdel.submit();
                }
            });
        });
    </script>
@endsection
