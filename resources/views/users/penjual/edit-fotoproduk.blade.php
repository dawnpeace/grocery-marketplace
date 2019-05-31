@extends('users.penjual.include.penjual-navbar')
@section('breadcrumb')
    <div class="mt-4">
        <nav class="breadcrumb">
            <a class="breadcrumb-item" href="{{route('penjual.dashboard')}}">Dapurpedia Penjual</a>
            <a class="breadcrumb-item" href="{{route('produk.edit',[$fotoproduk->produk->id])}}">Manajemen Produk</a>
            <a class="breadcrumb-item" href="{{route('galeri.create',[$fotoproduk->produk->id])}}">Galeri Foto</a>
            <span class="breadcrumb-item active">Ubah Foto</span>
        </nav>
    </div>
@endsection
@section('content')
@include('users.penjual.include.alerts')
    <div class="row my-3">
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <h5>Ubah Foto Produk</h5>
                    <hr>
                    <form method="POST" action="" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="foto_produk">
                            <input type="file" id="foto_produk" name="foto_produk" class="form-control-file" accept="image/jpeg,image/png,image/jpg"/>
                        </div>
                        <button type="submit" class="btn btn-primary float-right"><i class="fas fa-upload"></i> Upload</button>
                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="card">
                <div class="card-body text-center bg-secondary">
                    <img id="img-show" class="img img-fluid" src="{{$fotoproduk->url()}}" alt="">
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')
<script>
    var validImage = ["image/jpeg","image/png",'image/jpg'];
    $('#foto_produk').change(function(e){
    file = this.files[0];
    fileType = file["type"];
    if($.inArray(fileType,validImage) > -1){
        url = URL.createObjectURL(e.target.files[0]);
        $('#img-show').attr('src',url);
    }
});    
</script>
@endsection