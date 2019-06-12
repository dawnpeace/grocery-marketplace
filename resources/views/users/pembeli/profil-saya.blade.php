@extends('default')

@section('breadcrumb')
<div class="container w-75 mt-4">
    <nav class="breadcrumb">
        <a class="breadcrumb-item" href="{{url('/')}}">Dapurpedia</a>
        <a class="breadcrumb-item" href="">Profil Saya</a>
    </nav>
</div>
@endsection

@section('content')
    <div class="container my-2 w-75">
        @if(Session::has('success'))
        <div class="alert alert-success my-2" role="alert">
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            {{Session::get('success')}}
        </div>
        @endif
        @if(Session::has('error'))
        <div class="alert alert-danger" role="alert">
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            {{Session::get('error')}}
        </div>
        @endif
    </div>

    <div class="container w-75 my-3">
        <div class="row">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-body">
                        <h2><i class="fa fa-user"></i> Profil {{$user->nama}} (<i>{{$user->username}})</i></h2>
                        <hr>
                        <form action="" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input type="text" id="name" name="nama" value="{{old('nama') ?? $user->nama}}" class="form-control {{$errors->has('nama') ? 'is-invalid' : ''}}" />
                                @if ($errors->has('nama'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nama') }}</strong>
                                    </span>
                                @endif
                            </div>
    
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" id="email" name="email" value="{{old('email') ?? $user->email}}" class="form-control {{$errors->has('email') ? 'is-invalid' : ''}}" />
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
    
                            <div class="form-group">
                                <label for="no_telp">Nomor Handphone</label>
                                <input type="text" id="no_telp" name="no_telp" value="{{old('no_telp') ?? $user->pembeli->no_telp}}" class="form-control {{$errors->has('no_telp') ? 'is-invalid' : ''}}" />
                                @if ($errors->has('no_telp'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('no_telp') }}</strong>
                                    </span>
                                @endif
                            </div>
    
                            <div class="form-group">
                                <label for="kota">Kota</label>
                                <input type="text" id="kota" name="kota" value="{{old('kota') ?? $user->pembeli->kota}}" class="form-control {{$errors->has('kota') ? 'is-invalid' : ''}}" />
                                @if ($errors->has('kota'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('kota') }}</strong>
                                    </span>
                                @endif
                            </div>
    
                            <div class="form-group">
                                <label for="password_lama">Password Lama</label>
                                <input type="password" id="password_lama" name="password_lama" value="" class="form-control" />
                                <small>Hanya perlu diisi bila mengganti password</small>
                            </div>
    
                            <div class="form-group">
                                <label for="password">Password Baru</label>
                                <input type="password" id="password" name="password" value="" class="form-control {{$errors->has('password') ? 'is-invalid' : ''}}" />
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
    
                            <div class="form-group">
                                <label for="password_confirmation">Konfirmasi Password</label>
                                <input type="password" id="password" name="password_confirmation" value="" class="form-control" />
                            </div>
    
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <input type="text" id="alamat" name="alamat" value="{{old('alamat') ?? $user->pembeli->alamat}}" class="form-control {{$errors->has('alamat') ? 'is-invalid' : ''}}" />
                                @if ($errors->has('alamat'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('alamat') }}</strong>
                                    </span>
                                @endif
                            </div>
    
                            <div class="form-group mt-2">
                                <label for="foto_profil">Foto Penjual</label>
                                <input type="file" id="foto_profil" name="foto_profil" class="form-control-file" />
                                <small class="float-right">Gambar harus dibawah 500kb, Berekstensi JPEG,JPG atau PNG</small>
                                <div class="clearfix"></div>
                            </div>
                            @if ($errors->has('foto_profil'))
                                <p class="text-danger"> {{ $errors->first('foto_profil') }} </p>
                            @endif
    
                            <button type="submit" class="btn btn-primary float-right"><i class="fas fa-check"></i> Submit</button>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body">
                        <img id="img-display-container" class="img img-fluid" src="{{$user->pembeli->urlFoto()}}" alt="">
                    </div>
                </div>
            </div>
        </div>
        
    </div>
@endsection