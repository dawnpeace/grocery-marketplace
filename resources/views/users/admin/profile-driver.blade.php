@extends('users.admin.include.admin-navbar')


@section('breadcrumb')
    <div class="mt-4">
        <nav class="breadcrumb">
            <a href="{{route('admin.dashboard')}}" class="breadcrumb-item">Dapurpedia Admin</a>
            <a href="{{route('admin.manajemen.driver')}}" class="breadcrumb-item">Manajemen Driver</a>
            <span class="breadcrumb-item active">Profil Driver</span>
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
    <div class="container py-3">
        <div class="card mb-3">
            <div class="card-body">
                <div class="p-3">
                    <h4 class="py-2">Profil {{$driver->user->nama}}</h4>
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="nama">Nama Driver</label>
                                    <input type="text" name="nama" value="{{ old('nama') ?? $driver->user->nama}}" id="name" class="form-control {{$errors->has('nama') ? 'is-invalid' : ''}}" placeholder="Nama Driver">
                                    @if ($errors->has('nama'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('nama') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="username">Display Username (Login Userid)</label>
                                    <input type="text" name="username" value="{{ old('username') ?? $driver->user->username}}" id="username" class="form-control {{$errors->has('username') ? 'is-invalid' : ''}}" placeholder="Display Username Driver">
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
                                    <input type="password" name="password_confirmation" class="form-control {{$errors->has('password') ? 'is-invalid' : ''}}" placeholder="Konfirmasi Password">
                                </div>

                                <div class="form-group">
                                    <label for="plat_nomor_kendaraan">Plat Nomor Kendaraan</label>
                                    <input type="text" value="{{old('plat_nomor_kendaraan') ?? $driver->plat_nomor_kendaraan}}" name="plat_nomor_kendaraan" id="plat" class="form-control {{$errors->has('plat_nomor_kendaraan') ? 'is-invalid' : ''}}" placeholder="Nomor Plat Kendaraan">
                                </div>
                                @if ($errors->has('plat_nomor_kendaraan'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('plat_nomor_kendaraan') }}</strong>
                                    </span>
                                @endif

                                <div class="form-group">
                                    <label for="no_telp">No Handphone</label>
                                    <input type="text" name="no_telp" value="{{old('no_telp') ?? $driver->no_telp }}" id="no_telp" class="form-control {{$errors->has('no_telp') ? 'is-invalid' : ''}}" placeholder="Nomor Handphone">
                                    <small class="float-right">Contoh : +62812345999</small>
                                    <div class="clearfix"></div>
                                    @if ($errors->has('no_telp'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('no_telp') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" value="{{old('email') ?? $driver->user->email }}" id="email" class="form-control {{$errors->has('email') ? 'is-invalid' : ''}}" placeholder="Alamat Email">
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="kota">Kota</label>
                                    <input type="text" name="kota" value="{{old('kota') ?? $driver->kota}}"  id="kota" class="form-control {{$errors->has('kota') ? 'is-invalid' : ''}}" placeholder="Kota Driver">
                                    @if ($errors->has('kota'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('kota') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <input type="text" name="alamat" value="{{old('alamat') ?? $driver->alamat}}" id="alamat" class="form-control {{$errors->has('alamat') ? 'is-invalid' : ''}}" placeholder="Alamat Driver">
                                    @if ($errors->has('alamat'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('alamat') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <img id="profile-pic" src="{{empty($driver->foto_profil) ? asset('img/default.jpg') : asset('storage/foto_profil/'.$driver->foto_profil)}}" alt="" class="img img-fluid">
                                </div>
                                <div class="form-group">
                                    <input id="foto-profil" type="file" name="foto_profil" class="form-control-file {{$errors->has('foto') ? 'is-invalid' : ''}}">
                                </div>

                                <div class="form-group">
                                    <button type="button" data-toggle="modal" data-target="#modal-sim" class="btn btn-outline-info btn-sm"><i class="fa fa-eye"></i> Lihat SIM</button>
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

    <!-- Modal -->
    <div class="modal fade" id="modal-sim" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="card">
                    <div class="card-body m-auto">
                        <div class="border border-secondary">
                            <img src="{{$driver->urlSIM()}}" alt="" class="img img-fluid">
                        </div>
                    </div>
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