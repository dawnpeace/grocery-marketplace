@extends('users.driver.include.driver-navbar')
@section('breadcrumb')
    <div class="mt-4">
        <nav class="breadcrumb">
            <a class="breadcrumb-item" href="{{route('driver.dashboard')}}">Dapurpedia Driver</a>
            <span class="breadcrumb-item active">Pekerjaan Saya</span>
        </nav>
    </div>
@endsection
@section('content')
    <div class="">
        <div class="card">
            <div class="card-body">
                <h2>Pekerjaan Aktif</h2>
                <div class="table-responsive">
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
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        @can('DapatDiselesaikan',[$user->driver->keranjang])
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
        @endcan
    </script>
@endsection