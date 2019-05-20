@extends('users.penjual.include.penjual-navbar')
@section('breadcrumb')
<div class="mt-4">
    <nav class="breadcrumb">
        <a class="breadcrumb-item" href="{{route('penjual.dashboard')}}">Dashboard</a>
        <a class="breadcrumb-item" href="{{route('permintaan')}}">Permintaan</a>
        <span class="breadcrumb-item active">Proses Permintaan</span>
    </nav>
</div>
@endsection

@section('content')
<div class="container">
    <h2>Proses Keranjang {{$keranjang->pembeli->user->nama}} (Kota : {{$keranjang->pembeli->kota}})</h2>
    <div class="row">
        <div class="col-md-8">
            <div class="p-2 border rounded">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="driver">Driver yang tersedia</label>
                        <select name="asd" id="driver" class="select2 form-control">
                            <option value="">-</option>
                            @foreach($driver as $pengantar)
                            <option value="{{$pengantar->id}}">{{$pengantar->user->nama}}</option>
                            @endforeach
                        </select>
                        <p class="text-info text-right">Kosongkan bila tidak memerlukan jasa driver</p>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-2 border rounded">
                <img id="foto-profil" src="" alt="" class="img img-fluid">
                <ul id="driver-profile" class="list-group">
                    <li id="nama-driver" class="list-group-item"></li>
                    <li id="nomor-plat" class="list-group-item"></li>
                    <li id="no-telp" class="list-group-item"></li>
                    <li id="alamat" class="list-group-item"></li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script>
        $('.select2').select2();

        $('.select2').on('change',function(){
            var driver_id = $(this).val();
            if(driver_id != ""){
                axios.get('/driver/'+driver_id).then(function(response){
                    data = response.data;
                    $('#nama-driver').html('Nama : '+data.user.nama);
                    $('#nomor-plat').html('Nomor Plat Kendaraan : '+data.plat_nomor_kendaraan.toUpperCase());
                    $('#no-telp').html('Nomor Telpon : '+data.no_telp);
                    $('#alamat').html('Alamat Driver : '+data.alamat);
                    if(data.foto_profil != ""){
                        $('#foto-profil').attr('src','/storage/foto_profil/'+data.foto_profil);
                    } else {
                        $('#foto-profil').attr('src','/img/default.jpg')
                    }
                });
            } else {
                $('#foto-profil').attr('src','/img/default.jpg')
                $("#driver-profile").children().html("");
            }
        });
    </script>
@endsection