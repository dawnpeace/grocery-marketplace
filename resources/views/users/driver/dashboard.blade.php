@extends('users.driver.include.driver-navbar')

@section('breadcrumb')
    <div class="">
        <div class="mt-4">
            <nav class="breadcrumb">
                <a class="breadcrumb-item active" href="#">Dapurpedia Driver</a>
            </nav>
        </div>
    </div>
@endsection

@section('content')
    <div class="">
        @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            {{Session::get('success')}}
        </div>
        @endif
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    @can('SedangBekerja')
                        <a href="{{route('pekerjaan.index')}}" class="btn btn-outline-info btn-sm float-right">Pekerjaan Saya</a>
                    @endcan
                    <h2><i class="fa fa-list"></i> Daftar Pesanan</h2>
                    <table class="table table-striped table-sm">
                        <thead>
                            <th>Nama Toko</th>
                            <th>Alamat Toko</th>
                            <th>Alamat Tujuan</th>
                            @can('TidakBekerja')
                            <th>Aksi</th>
                            @endcan
                        </thead>
                        <tbody>
                            @forelse ($keranjang as $item)
                                <tr>
                                    <td>{{$item->penjual->nama_toko}}</td>
                                    <td>{{$item->penjual->alamat}}</td>
                                    <td>{{$item->pembeli->alamat}}</td>
                                    @can('TidakBekerja')
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-success"><i class="fab fa-whatsapp"></i> WA Penjual</button>
                                            <button data-url="{{route('pesanan.ambil',[$item->id])}}" type="button" class="btn btn-sm btn-primary btn-ambil"><i class="fa fa-check-square"></i> Ambil</button>
                                            <a href="{{route('pesanan.detail',[$item->id])}}" type="button" class="btn btn-sm btn-secondary"><i class="fa fa-bars"></i> Detail</a>
                                        </div>
                                    </td>
                                    @endcan
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">
                                        <h5 class="text-center">Belum terdapat permintaan.</h5>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="d-flex">
                        <div class="m-auto">
                            {{$keranjang->links()}}
                        </div>
                    </div>
                    <form method="POST" id="form-ambil" action="">@csrf</form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $('.btn-ambil').click(function(){
            url = $(this).data('url');
            form = $('#form-ambil');
            form.attr('action',url);
            swal({
                title: "Proses Pesanan",
                text: "Anda ingin mengambil Pesanan? ",
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