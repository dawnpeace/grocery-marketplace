@extends('users.admin.include.admin-navbar')

@section('breadcrumb')
    <div class="mt-4">
        <nav class="breadcrumb">
            <a href="{{route('admin.dashboard')}}" class="breadcrumb-item">Dapurpedia Admin</a>
            <a href="{{route('admin.manajemen.penjual')}}" class="breadcrumb-item">Manajemen Penjual</a>
            <span class="breadcrumb-item active">Profil Penjual</span>
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

    <div class="container">
        <div class="card mb-3">
            <div class="card-body">
                <div class="p-3">
                    <h4 class="py-2">Profil {{$penjual->user->nama}}</h4>
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="nama">Nama Penjual</label>
                                    <input type="text" name="nama" value="{{ old('nama') ?? $penjual->user->nama}}" id="name" class="form-control {{$errors->has('nama') ? 'is-invalid' : ''}}" placeholder="Nama penjual">
                                    @if ($errors->has('nama'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('nama') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="username">Display Username (Login Userid)</label>
                                    <input type="text" name="username" value="{{ old('username') ?? $penjual->user->username}}" id="username" class="form-control {{$errors->has('username') ? 'is-invalid' : ''}}" placeholder="Display Username penjual">
                                    @if ($errors->has('username'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('username') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" id="password" class="form-control {{$errors->has('password') ? 'is-invalid' : ''}}" placeholder="Password">
                                    <small class="float-right">Kosongkan field bila tidak mengganti password</small>                                
                                    <div class="clearfix"></div>
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="password_confirmation">Konfirmasi Password</label>
                                    <input type="password" name="password_confirmation" id="email" class="form-control {{$errors->has('password') ? 'is-invalid' : ''}}" placeholder="Konfirmasi Password">
                                </div>

                                <div class="form-group">
                                    <label for="no_telp">No Handphone</label>
                                    <input type="text" name="no_telp" value="{{old('no_telp') ?? $penjual->no_telp }}" id="no_telp" class="form-control {{$errors->has('no_telp') ? 'is-invalid' : ''}}" placeholder="Nomor Handphone">
                                    @if ($errors->has('no_telp'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('no_telp') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="no_telp">Nama Toko</label>
                                    <input type="text" name="nama_toko" value="{{old('nama_toko') ?? $penjual->nama_toko }}" id="nama_toko" class="form-control {{$errors->has('nama_toko') ? 'is-invalid' : ''}}" placeholder="Nama Toko">
                                    @if ($errors->has('nama_toko'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('nama_toko') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" value="{{old('email') ?? $penjual->user->email }}" id="email" class="form-control {{$errors->has('email') ? 'is-invalid' : ''}}" placeholder="Alamat Email">
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="kota">Kota</label>
                                    <input type="text" name="kota" value="{{old('kota') ?? $penjual->kota}}"  id="kota" class="form-control {{$errors->has('kota') ? 'is-invalid' : ''}}" placeholder="Kota penjual">
                                    @if ($errors->has('kota'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('kota') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <input type="text" name="alamat" value="{{old('alamat') ?? $penjual->alamat}}" id="alamat" class="form-control {{$errors->has('alamat') ? 'is-invalid' : ''}}" placeholder="Alamat penjual">
                                    @if ($errors->has('alamat'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('alamat') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <img id="profile-pic" src="{{empty($penjual->foto_profil) ? asset('img/default.jpg') : asset('storage/foto_profil/'.$penjual->foto_profil)}}" alt="" class="img img-fluid">
                                </div>
                                <div class="form-group">
                                    <input id="foto-profil" type="file" name="foto_profil" class="form-control-file {{$errors->has('foto') ? 'is-invalid' : ''}}">
                                </div>
                            </div>
                            
                            <button class="btn btn-primary center btn-lg">Submit</button>
                            <div class="clearfix"></div>
                        </div>
                    </form>
    
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $("#foto-profil").change(function(e){
            $('#profile-pic').attr('src',URL.createObjectURL(e.target.files[0]));
        });
    </script>
@endsection