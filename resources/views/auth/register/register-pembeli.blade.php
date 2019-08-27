<form method="POST" action="{{route('store.customer')}}" enctype="multipart/form-data">
    @csrf
    <div class="form-group row">
        <label for="name" class="col-md-4 col-form-label text-md-right">Nama</label>

        <div class="col-md-8">
            <input id="name" type="text" class="form-control{{ $errors->has('nama') ? ' is-invalid' : '' }}" name="nama" value="{{ old('nama') }}" required autofocus>

            @if ($errors->has('nama'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('nama') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group row">
        <label for="email" class="col-md-4 col-form-label text-md-right">Alamat Email</label>

        <div class="col-md-8">
            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

            @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group row">
        <label for="email" class="col-md-4 col-form-label text-md-right">Username</label>

        <div class="col-md-8">
            <input id="email" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required>
            <small class="float-right"><i>Login Username, 5-18 Karakter</i></small>
            <div class="clearfix"></div>
            @if ($errors->has('username'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('username') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group row">
        <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

        <div class="col-md-8">
            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

            @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group row">
        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Konfirmasi Password</label>

        <div class="col-md-8">
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
        </div>
    </div>

    <div class="form-group row">
        <label for="kota" class="col-md-4 col-form-label text-md-right">Kota</label>
    
        <div class="col-md-8">
            <input id="kota" type="kota" class="form-control{{ $errors->has('kota') ? ' is-invalid' : '' }}" name="kota" value="{{ old('kota') }}" required>
    
            @if ($errors->has('kota'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('kota') }}</strong>
                </span>
            @endif
        </div>
    </div>
    
    <div class="form-group row">
        <label for="no-telp" class="col-md-4 col-form-label text-md-right">Alamat</label>
    
        <div class="col-md-8">
            <input id="no-telp" type="text" class="form-control{{ $errors->has('alamat') ? ' is-invalid' : '' }}" value="{{old('alamat')}}" name="alamat" required>
    
            @if ($errors->has('alamat'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('alamat') }}</strong>
                </span>
            @endif
        </div>
    </div>
    
    <div class="form-group row">
        <label for="no_telp" class="col-md-4 col-form-label text-md-right">No Handphone</label>
    
        <div class="col-md-8">
            <input id="no_telp" type="text" class="form-control{{ $errors->has('no_telp') ? ' is-invalid' : '' }}" value="{{old('no_telp')}}" name="no_telp" required>
            <small class="float-right">Format Indonesia (+62)</small>
            <div class="clearfix"></div>
            @if ($errors->has('no_telp'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('no_telp') }}</strong>
                </span>
            @endif
        </div>
    </div>
    
    <div class="form-group row">
        <label class="col-md-4 col-form-label text-md-right" for="foto_profil">Foto Profil</label>
        <div class="col-md-8">
            <input type="file" id="foto_profil" name="foto_profil" value="{{old('foto_profil')}} " class="form-control-file {{$errors->has('alamat') ? 'is-invalid' : ''}}" />
            @if ($errors->has('foto_profil'))
            <p class="text-danger">{{$errors->first('foto_profil')}}</p>
            @endif
        </div>
    </div>
        
        
    <div class="form-group text-right">
        <button type="submit" class="float-right btn btn-primary">
            Register
        </button>
    </div>
</form>