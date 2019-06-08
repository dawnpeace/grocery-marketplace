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
        <ul class="list-group dark mb-3 mx-3">
            <li class="list-group-item {{$belanja->telah_diproses ? 'list-group-item-info' : ''}}">
                <div class="float-right">
                    @can('SelesaikanTransaksi',[$belanja])
                    <button data-url="{{route('transaksi.selesai',[$belanja->id])}}" class="btn btn-sm btn-outline-success btn-selesai"><i class="fa fa-thumbs-up"></i> Transaksi Selesai</button>
                    @endcan
                    <button class="btn btn-sm btn-outline-info btn-detail"><i class="fa fa-eye"></i></button>
                </div>
                {{$belanja->penjual->user->nama}}
            </li>
            @php $subTotal = 0; @endphp
            @foreach($belanja->belanjaan as $item)
                <li class="list-group-item detail-info d-none">
                    <span><u>{{$item->produk->nama_produk}}</u></span>
                    <span class="float-right">{{formatRP($item->jumlah*$item->harga)}}</span>
                </li>
                @php $subTotal+= $item->jumlah*$item->harga; @endphp
            @endforeach
            <li class="list-group-item text-right font-weight-bold">
                {{formatRP($subTotal)}},-
            </li>
        </ul>
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
            $(this).parent().parent().siblings('.detail-info').toggleClass('d-none','d-block');
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