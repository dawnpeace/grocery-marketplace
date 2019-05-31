@extends('users.penjual.include.penjual-navbar')

@section('breadcrumb')
<div class="mt-4">
        <nav class="breadcrumb">
            <a href="{{route('penjual.dashboard')}}" class="breadcrumb-item">Dapurpedia Penjual</a>
            <span class="breadcrumb-item active">Tambah Produk</span>
        </nav>
    </div>
@endsection

@section('content')
    <div class="container">

        @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            {{Session::get('success')}}
        </div>
        @endif

             <div class="card">
                 <div class="card-body">
                    <h1>Tambah Produk</h1>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <form method="POST" action="" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="nama_produk">Nama Produk</label>
                                    <input type="text" id="nama_produk" name="nama_produk" value="{{old('nama_produk')}} " class="form-control {{$errors->has('nama_produk') ? 'is-invalid' : ''}}" />
                                </div>
                                @if ($errors->has('nama_produk'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nama_produk') }}</strong>
                                    </span>
                                @endif
        
                                <div class="form-group">
                                    <label for="jumlah_tersedia">Jumlah Tersedia</label>
                                    <input type="text" id="jumlah_tersedia" name="jumlah_tersedia" value="{{old('jumlah_tersedia')}}" class="form-control {{$errors->has('jumlah_tersedia') ? 'is-invalid' : ''}}" />
                                </div>
                                @if ($errors->has('jumlah_tersedia'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('jumlah_tersedia') }}</strong>
                                    </span>
                                @endif
        
                                <div class="form-group">
                                    <label for="harga">Harga</label>
                                    <input type="text" id="harga" name="harga" value="{{old('harga')}}" class="form-control {{$errors->has('harga') ? 'is-invalid' : ''}}" />
                                </div>
                                @if ($errors->has('harga'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('harga') }}</strong>
                                    </span>
                                @endif
        
                                <div class="form-group">
                                    <label for="satuan_unit">Satuan Unit</label>
                                    <input type="text" id="satuan_unit" name="satuan_unit" value="{{old('satuan_unit')}}" class="form-control {{$errors->has('satuan_unit') ? 'is-invalid' : ''}}" />
                                </div>
                                @if ($errors->has('satuan_unit'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('satuan_unit') }}</strong>
                                    </span>
                                @endif
        
                                <div class="form-group">
                                    <label for="deskripsi">Deskripsi</label>
                                    <textarea rows="3" id="deskripsi" name="deskripsi" class="form-control">{{old('deskripsi')}}</textarea>
                                </div>
                                @if ($errors->has('deskripsi'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('deskripsi') }}</strong>
                                    </span>
                                @endif

                                <div class="form-group">
                                    <label for="foto_produk">Upload Foto Produk</label>
                                    <input type="file" id="foto_produk" name="foto_produk" class="form-control-file" />
                                </div>
                                @if ($errors->has('foto_produk'))
                                    <p class="text-danger"> {{ $errors->first('foto_produk') }} </p>
                                @endif
                                @csrf
                                <button type="submit" class="btn btn-primary float-right"><i class="fa fa-plus"></i> Tambah</button>
                            </form>

                            </div>

                            <div class="col-md-6">
                                <div class="bg-secondary p-1 border">
                                    <img id="img-show" src="" alt="" class="img img-fluid">
                                </div>
                                
                            </div>
                        </div>
                        <div class="clearfix"></div>
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