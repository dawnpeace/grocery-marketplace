@extends('default')

@section('breadcrumb')
<div class="container my-3">
    <nav class="breadcrumb">
        <a class="breadcrumb-item" href="{{route('dashboard')}}">Dapurpedia</a>
        <a class="breadcrumb-item" href="{{route('keranjang')}}">Keranjang</a>
        <span class="breadcrumb-item active">Detail Keranjang</span>
    </nav>
</div>
@endsection 

@section('content')
    <div style="min-height:68vh" class="container">
        @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            {{Session::get('success')}}
        </div>
        @endif
        <div class="card">
            <div class="card-body">
                <div class="float-right">
                    @if(!$keranjang->telah_diselesaikan)
                    <form method="POST" action="{{route('keranjang.checkout',$keranjang->id)}}">
                        @csrf
                        <button  id="btn-checkout" type="button" class="btn btn-success"><i class="fa fa-check"></i> Checkout</button>
                    </form>
                    @endif
                </div>
                <h2 class="mb-3">Detail Keranjang</h2>
                <div class="clearfix"></div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <th>Nama Produk</th>
                            <th class="text-right">Jumlah</th>
                            <th class="text-right">Harga</th>
                            <th class="text-right">Subtotal</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody>
                            @php $total = 0 @endphp
                            @foreach($keranjang->belanjaan as $item)
                            @php $subtotal = $item->jumlah*$item->harga; @endphp
                            <tr>
                                <td>{{$item->produk->nama_produk}}</td>
                                <td class="text-right">{{$item->jumlah}}</td>
                                <td class="text-right">{{formatRP($item->harga)}}</td>
                                <td class="text-right">{{formatRP($subtotal)}}</td>
                                <td>
                                    <button data-url="{{route('hapus.item',[$keranjang->id,$item->id])}}" class="btn btn-delete-item btn-danger"><i class="fas fa-trash-alt"></i></button>
                                    <a href="{{route('tambah.produk',[$item->produk_id])}}" class="btn btn-primary"><i class="fas fa-arrow-right"></i></a>
                                </td>
                            </tr>
                            @php $total+=$subtotal; @endphp
                            @endforeach
                            <tfoot>
                                <td colspan="2"><h5>Total</h5></td>
                                <td class="text-right" colspan="2">
                                    <h5><u>{{formatRP($total)}}</u></h5>
                                </td>
                                <td></td>
                            </tfoot>
                        </tbody>
                    </table>
                    <form id="delete-item" action="" method="POST">@csrf</form>
                </div>
            </div>
        </div>
        

    </div>
@endsection

@section('js')
    <script>
        $(".btn-delete-item").click(function(){
            swal({
                title: "Menghapus Item pada keranjang",
                text: "Apakah anda yakin?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((val)=>{
                if(val){
                    formdel = $('form#delete-item');
                    formdel.attr('action',$(this).data('url'));
                    formdel.submit();
                }
            });
        });

        $("#btn-checkout").click(function(){
            swal({
                title: "Checkout Keranjang",
                text: "Apakah anda yakin?",
                icon: "info",
                buttons: true,
                dangerMode: true,
            }).then((val)=>{
                if(val){
                    $(this).parent('form').submit();
                }
            });
        });
    </script>
@endsection