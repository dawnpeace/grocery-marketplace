@extends('users.penjual.include.penjual-navbar')

@section('breadcrumb')
    <div class="mt-4">
        <nav class="breadcrumb">
        <a class="breadcrumb-item" href="{{route('penjual.dashboard')}}">Dashboard</a>
        <span class="breadcrumb-item active">Manajemen Produk</span>
        </nav>
    </div>
@endsection

@section('content')
@if (Session::has('success'))
    <div class="alert alert-success mt-2" role="alert">
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
        {{Session::get('success')}}
    </div>
@endif
    <div class="row mt-3">
        <div class="col-md-4">
            <div class="card">
                @php
                    $imgsrc = $produk->gallery->isEmpty() ? asset('img/product.jpg') : asset('storage/foto_produk/'.$produk->gallery->first()->foto_produk);
                @endphp
                <img src="{{$imgsrc}}" alt="" class="img img-fluid">
                <div class="card-body">
                    <div class="card-title">
                        <h4>{{$produk->nama_produk}}</h3>
                    </div>
                    <hr>
                    <p class="card-text">
                        {!! nl2br($produk->deskripsi) !!}
                    </p>
                </div>
                <div class="card-footer">
                    <div class="row text-center">
                        <div class="col-sm-6">
                            {{$produk->harga()}}
                        </div>
                        <div class="col-sm-6">
                            Jumlah : {{$produk->jumlah()}}
                        </div>
                        <div class="col-sm-12">
                            <strong>
                                Status : {{$produk->tersedia ? 'Tersedia' : 'Tidak tersedia'}}
                            </strong>
                            <div class="clearfix"></div>
                            <button id="btn-availability" class="btn btn-outline-{{$produk->tersedia ? 'danger' : 'success'}}"><i class="fas fa-pencil-alt"></i> Ubah ketersediaan</button>
                        </div>
                        <form id="form-availability" method="POST" action="{{route('produk.update.ketersediaan',[$produk->id])}}">@csrf</form>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Card Display -->
        <div class="col-md-8 mb-5">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h4>Perbaharui Informasi Produk</h4>
                    </div>
                    <hr>
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="nama_produk">Nama Produk</label>
                            <input type="text" name="nama_produk" value="{{old('nama_produk') ?? $produk->nama_produk}}" class="form-control {{$errors->has('nama_produk') ? 'is-invalid' : ''}}" placeholder="Nama Produk">
                            @if ($errors->has('nama_produk'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('nama_produk') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea name="deskripsi" rows="5" class="form-control {{$errors->has('deskripsi') ? 'is-invalid' : ''}}">{{$produk->deskripsi}}</textarea>
                            @if ($errors->has('deskripsi'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('deskripsi') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="harga">Harga per Satuan produk</label>
                            <input type="text" name="harga" value="{{old('harga') ?? $produk->harga}}" class="form-control {{$errors->has('harga') ? 'is-invalid' : ''}}" placeholder="Harga Produk">                            
                            @if ($errors->has('harga'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('harga') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="satuan_unit">Jenis Satuan</label>
                            <input type="text" name="satuan_unit" class="form-control {{$errors->has('satuan_unit') ? 'is-invalid' : ''}}" value="{{old('satuan_unit') ?? $produk->satuan_unit}}" placeholder="Jenis satuan produk">
                            @if ($errors->has('satuan_unit'))
                              <span class="invalid-feedback" role="alert">
                                   <strong>{{ $errors->first('satuan_unit') }}</strong>
                              </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="jumlah_tersedia">Jumlah Produk</label>
                            <input type="text" name="jumlah_tersedia" class="form-control  {{$errors->has('kota') ? 'is-invalid' : ''}}" value="{{old('jumlah_tersedia') ?? $produk->jumlah_tersedia}}" placeholder="Jumlah Produk yang Tersedia">
                            @if ($errors->has('jumlah_tersedia'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('jumlah_tersedia') }}</strong>
                            </span>
                            @endif
                        </div>                   
                        <div class="form-group text-right">
                            <button class="btn btn-outline-primary" type="submit"> <i class="fas fa-edit"></i> Perbaharui</button>
                            <a href="{{route('galeri.create',[$produk->id])}}" class="btn btn-outline-info"><i class="fas fa-image"></i> Atur Gambar</a>
                        </div>
                    </form>
                </div>
            </div>            
        </div>


    </div>
@endsection
@section('js')
    <script>
        $('input').focus(function(){
            if($(this).hasClass('is-invalid')){
                $(this).removeClass('is-invalid');
            }
        });
        $('textarea').focus(function(){
            if($(this).hasClass('is-invalid')){
                $(this).removeClass('is-invalid');
            }
        });

        $('#btn-availability').click(function(){
            var formavailable = $('#form-availability');
            swal({
                title: "Mengubah status Ketersediaan produk!",
                text: "Apakah anda yakin?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((val)=>{
                if(val){
                    formavailable.submit();
                }
            });
        });
    </script>
@endsection