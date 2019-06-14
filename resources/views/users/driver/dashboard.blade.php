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
        <div class="card my-2">
            <div class="card-body">
                <div class="table-responsive">
                    @can('SedangBekerja')
                    <table class="table table-bordered table-sm">
                        <tr>
                            <th>Pasar - Nama Toko</th>
                            <td>{{$user->driver->keranjang->penjual->pasar->nama_pasar." - ".$user->driver->keranjang->penjual->nama_toko}}</td>
                        </tr>
                        <tr>
                            <th>Alamat Toko</th>
                            <td>{{$user->driver->keranjang->penjual->alamat}}</td>
                        </tr>
                        <tr>
                            <th>Nama Pembeli</th>
                            <td>{{$user->driver->keranjang->pembeli->user->nama}}</td>
                        </tr>
                        <tr>
                            <th>Alamat Pembeli</th>
                            <td>{{$user->driver->keranjang->pembeli->alamat}}</td>
                        </tr>
                        <tr>
                            <th>Kontak Pembeli</th>
                            <td>{{$user->driver->keranjang->pembeli->no_telp}}</td>
                        </tr>
                    </table>

                    <h3>Detail belanja</h3>
                    <table class="table table-sm table-striped table-bordered">
                        <thead>
                            <th>Nama Produk</th>
                            <th class="text-right">Jumlah</th>
                            <th class="text-right">Satuan Unit</th>
                        </thead>
                        <tbody>
                            @foreach($user->driver->keranjang->belanjaan as $item)
                            <tr>
                                <td>{{$item->produk->nama_produk}}</td>
                                <td class="text-right">{{$item->jumlah}}</td>
                                <td class="text-right">{{$item->produk->satuan_unit}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @can('DapatDiselesaikan',[$user->driver->keranjang])
                    <div class="float-right">
                        <form id="form-pekerjaan" method="POST" action="{{route('pekerjaan.selesai')}}">
                            @csrf
                            <button id="btn-finish" type="button" class="btn btn-primary"><i class="fa fa-thumbs-up"></i> Pekerjaan Selesai</button>
                        </form>
                    </div>
                    @endcan
                    <div class="clearfix"></div>

                    @endcan
                    @cannot('SedangBekerja')
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
                                            <button type="button" onclick="openWA({{whatsappLink($item->penjual->no_telp)}})" class="btn btn-sm btn-success"><i class="fab fa-whatsapp"></i> Kirim Pesan WA ke Penjual</button>
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
                    @endcannot
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

        $('#btn-finish').click(function(){
            swal({
                title: "Selesaikan Pekerjaan",
                text: "Pekerjaan akan diselesaikan, Lanjutkan?",
                icon: "info",
                buttons: true,
                dangerMode: true,
            }).then((val)=>{
                if(val){
                    $('#form-pekerjaan').submit();
                }
            });
        });
        
    </script>
@endsection