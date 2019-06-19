@extends('default')
@section('breadcrumb')
<div class="container mt-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <a href="{{route('dashboard')}}" class="breadcrumb-item" aria-current="page">Dapurpedia</a>
            <a href="{{route('keranjang')}}" class="breadcrumb-item" aria-current="page">Keranjang Saya</a>
            <span class="breadcrumb-item active">Dalam Proses</span>
        </ol>
    </nav>
</div>
@endsection

@section('content')
    <div class="container mh-70vh">
        @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            {{Session::get('success')}}
        </div>
        @endif
        <h2>Pesanan yang sedang diproses</h2>
        @forelse($keranjang as $belanja)
        <div class="card mb-3">
            <div class="card-header">
                <h4><a href="{{route('profil.penjual',$belanja->penjual->id)}}">{{$belanja->penjual->nama_toko}}</a> {{$belanja->telah_diproses ? '(Transaksi telah Diproses Penjual)' : ''}}</h4>
            </div>
            <div class="card-body">
                <table class="table table-sm table-borderless m-0 mb-3">
                    <tr>
                        <th width="30%">Alamat Toko</th>
                        <td>{{$belanja->penjual->alamat}}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Checkout</th>
                        <td>{{localeDate($belanja->tanggal_checkout)}}</td>
                    </tr>
                    @if($belanja->telah_diproses)
                    <tr>
                        <th>Tanggal Diproses</th>
                        <td>{{localeDate($belanja->tanggal_diproses)}}</td>
                    </tr>
                    @endif
                    @isset($belanja->biaya_antar)
                    <tr>
                        <th>Biaya Antar</th>
                        <td>{{formatRP($belanja->biaya_antar)}}</td>
                    </tr>
                    @endisset
                    <tr>
                        <td colspan="2" class="text-right">
                            @can('SelesaikanTransaksi',[$belanja])
                            <button data-url="{{route('transaksi.selesai',[$belanja->id])}}" class="btn btn-sm btn-outline-success btn-selesai"><i class="fa fa-thumbs-up"></i> Transaksi Selesai</button>
                            @endcan
                            @if($belanja->telah_diambil_driver)
                            <a href="{{route('profil.driver',$belanja->status->driver_id)}}" class="btn btn-sm btn-outline-secondary"><i class="fas fa-motorcycle"></i> Lihat Driver</a>
                            @endcan
                            <button data-bid="{{$belanja->id}}" class="btn btn-sm btn-outline-info btn-detail"><i class="fa fa-eye"></i> Lihat Detail</button>
                        </td>
                    </tr>
                    
                </table>
                @php $subTotal = 0; @endphp
                <table class="table table-sm table-striped border-right border-bottom border-left">
                    <tbody id="{{$belanja->id}}" class="detail-info d-none">
                        <tr>
                            <th>Nama Produk</th>
                            <th class="text-right">Jumlah</th>
                            <th class="text-right">Harga</th>
                            <th class="text-right">Subtotal</th>
                        </tr>
                    @foreach($belanja->belanjaan as $item)
                        <tr>
                            <td><u>{{$item->produk->nama_produk}}</u></td>
                            <td class="text-right">{{$item->jumlah}}</td>
                            <td class="text-right">{{formatRP($item->harga)}}</td>
                            <td class="text-right">{{formatRP($item->jumlah*$item->harga)}}</td>
                        </tr>
                    @php $subTotal+= $item->jumlah*$item->harga; @endphp
                    @endforeach
                        <tr>
                            <th colspan="2">Total Biaya</th>
                            <td colspan="2"><h5 class="text-right">{{formatRP($subTotal + ($belanja->biaya_antar ?? 0))}},-</h5></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        @empty
            <div class="alert alert-info mx-4" role="alert">
                <strong class="my-4">Anda belum memiliki keranjang diproses</strong>
            </div>
        @endforelse
    </div>
    <form id="form-selesai" method="POST" action="">@csrf</form>
@endsection

@section('js')
    <script>
        $('.btn-detail').click(function(){
            id = $(this).data('bid');
            $('tbody#'+id).toggleClass('d-none','d-block');
        });

        $('.btn-selesai').click(function(){
            url = $(this).data('url');
            form = $('#form-selesai');
            form.attr('action',url);
            swal({
                title: "Anda akan menyelesaikan transaksi !",
                text: "Lanjutkan?",
                icon: "info",
                buttons: true,
                dangerMode: true,
            }).then((val)=>{
                if(val){
                    form.submit();
                }
            });
        });
    </script>
@endsection