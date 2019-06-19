@extends('users.penjual.include.penjual-navbar')

@section('breadcrumb')
    <div class="mt-4">
        <nav class="breadcrumb">
            <a href="{{route('penjual.dashboard')}}" class="breadcrumb-item"> Dapurpedia Penjual</a>
            <span class="breadcrumb-item active">Permintaan</span>
        </nav>
        @if(Session::has('success'))
        <div class="alert alert-success mt-2" role="alert">
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            {{Session::get('success')}}
        </div>
        @endif
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <h2 class="mt-2"><i class="fa fa-check-square"></i> Permintaan Toko Anda</h2>
            <div class="table-responsive">
                <table class="table w-100 table-striped">
                    <thead>
                        <th>Pembeli</th>
                        <th>Kota</th>
                        <th>Alamat</th>
                        <th>Tanggal Pemesanan</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                        @forelse($permintaan as $item)
                        <tr>
                            <td>{{$item->pembeli->user->nama}}</td>
                            <td>{{$item->pembeli->kota}}</td>
                            <td>{{$item->pembeli->alamat}}</td>
                            <td>{{$item->tanggalPemesanan()}}</td>
                            <td>
                                <a href="{{route('permintaan.detail',[$item->id])}}" class="btn btn-sm btn-primary"><i class="fas fa-clipboard"></i> Detail Transaksi/Terima</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5">
                                <h5 class="text-center">Anda belum memiliki permintaan aktif.</h5>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <form id="confirm-order" action="" method="POST">@csrf</form>
    </div>
@endsection

@section('js')
    <script>
        $('.btn-confirm').click(function(){
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