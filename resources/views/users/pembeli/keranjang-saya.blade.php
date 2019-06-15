@extends('default')
@section('breadcrumb')
<div class="container mt-3">
    <nav class="breadcrumb">
        <a class="breadcrumb-item" href="{{route('dashboard')}}">Dapurpedia</a>
        <span class="breadcrumb-item active">Keranjang Saya</span>
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
        <div class="card">
            <div class="card-body">
                <div>
                    <a href="{{route('keranjang.diproses')}}" class="btn btn-sm btn-outline-info float-right"><i class="fas fa-arrow-right"></i> Lihat Transaksi</a>
                    <h2 class="mt-3"><i class="fa fa-cart-plus"></i> Keranjang Saya</h2>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <th>Produk Oleh</th>
                            <th class="text-right">Jumlah Item pada Keranjang</th>
                            <th class="text-right">Subtotal</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody>
                            @forelse ($daftarBelanja as $item)
                            <tr>
                                <td>
                                <a class="btn btn-link" href="{{route('profil.penjual',[$item['penjual_id']])}}">{{$item['nama_toko']}}</td></a>
                                <td class="text-right">{{$item['jumlah_produk']}}</td>
                                <td class="text-right">{{formatRP($item['subtotal'])}}</td>
                                <td>
                                    <button data-url="{{route('keranjang.hapus',[$item['keranjang_id']])}}" class="btn btn-danger btn-delete-cart" title="Hapus Belanjaan"><i class="fas fa-trash-alt"></i> Hapus</button>
                                    <a href="{{route('keranjang.detail',[$item['keranjang_id']])}}" class="btn btn-primary"><i class="fas fa-pencil-alt"></i> Ubah/Checkout</a>
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="4"><h5>Maaf Anda belum Memiliki Keranjang Terisi</h5></td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <form action="" method="POST" id="delete-cart">@csrf</form>

            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $('.btn-delete-cart').click(function(){
            swal({
                title: "Menghapus Keranjang",
                text: "Apakah anda ingin menghapus keranjang beserta isinya?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((val)=>{
                if(val){
                    formdel = $('form#delete-cart');
                    formdel.attr('action',$(this).data('url'));
                    formdel.submit();
                }
            });
        });

    </script>
@endsection