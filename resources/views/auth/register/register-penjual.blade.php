<form method="POST" action="{{route('store.seller')}}" enctype="multipart/form-data">
    @csrf
    <div class="form-group row">
        <label for="name" class="col-md-4 col-form-label text-md-right">Nama</label>

        <div class="col-md-8">
            <input id="name" type="text" class="form-control{{ $errors->has('nama_penjual') ? ' is-invalid' : '' }}" name="nama_penjual" value="{{ old('nama_penjual') }}" required>

            @if ($errors->has('nama_penjual'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('nama_penjual') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group row">
        <label for="email" class="col-md-4 col-form-label text-md-right">Alamat Email</label>

        <div class="col-md-8">
            <input id="email" type="email" class="form-control{{ $errors->has('email_penjual') ? ' is-invalid' : '' }}" name="email_penjual" value="{{ old('email_penjual') }}" required>

            @if ($errors->has('email_penjual'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email_penjual') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group row">
        <label for="email" class="col-md-4 col-form-label text-md-right">Username</label>

        <div class="col-md-8">
            <input id="email" type="text" class="form-control{{ $errors->has('username_penjual') ? ' is-invalid' : '' }}" name="username_penjual" value="{{ old('username_penjual') }}" required>
            <small class="float-right"><i>Login Username, 5-18 Karakter</i></small>
            <div class="clearfix"></div>
            @if ($errors->has('username_penjual'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('username_penjual') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group row">
        <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

        <div class="col-md-8">
            <input id="password" type="password" class="form-control{{ $errors->has('password_penjual') ? ' is-invalid' : '' }}" name="password_penjual" required>

            @if ($errors->has('password_penjual'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password_penjual') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group row">
        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Konfirmasi Password</label>

        <div class="col-md-8">
            <input id="password-confirm" type="password" class="form-control" name="password_penjual_confirmation" required>
        </div>
    </div>

    <div class="form-group row">
        <label for="kota" class="col-md-4 col-form-label text-md-right">Kota</label>
    
        <div class="col-md-8">
            <input id="kota" type="text" class="form-control{{ $errors->has('kota_penjual') ? ' is-invalid' : '' }}" name="kota_penjual" value="{{ old('kota_penjual') }}" required>
    
            @if ($errors->has('kota_penjual'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('kota_penjual') }}</strong>
                </span>
            @endif
        </div>
    </div>
    
    <div class="form-group row">
        <label for="alamat" class="col-md-4 col-form-label text-md-right">Alamat</label>
    
        <div class="col-md-8">
            <input id="alamat" type="text" class="form-control{{ $errors->has('alamat_penjual') ? ' is-invalid' : '' }}" value="{{old('alamat_penjual')}}" name="alamat_penjual" required>
    
            @if ($errors->has('alamat_penjual'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('alamat_penjual') }}</strong>
                </span>
            @endif
        </div>
    </div>
    
    <div class="form-group row">
        <label for="pasar_id" class="col-md-4 col-form-label text-md-right">Pasar</label>
        <div class="col-md-8">
            <select name="pasar_id" id="pasar_id" class="select2 form-control">
                @foreach($pasar as $market)
                    <option value="{{$market->id}}">{{$market->nama_pasar}}</option>
                @endforeach
            </select>
            @if ($errors->has('pasar_id'))
                <p class="text-danger">{{ $errors->first('pasar_id') }}</p>
            @endif
        </div>
    </div>
    
    <div class="form-group row">
        <label for="nama_toko" class="col-md-4 col-form-label text-md-right">Nama Toko</label>
        <div class="col-md-8">
            <div class="">
                <input type="text" id="nama_toko" name="nama_toko" value="{{old('nama_toko')}}" class="form-control {{$errors->has('nama_toko') ? 'is-invalid' : ''}}" />
            </div>
            @if ($errors->has('nama_toko'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('nama_toko') }}</strong>
                </span>
            @endif
        </div>
    </div>
    
    
    <div class="form-group row">
        <label for="no_telp" class="col-md-4 col-form-label text-md-right">No Handphone</label>
    
        <div class="col-md-8">
            <input id="no_telp" type="text" class="form-control{{ $errors->has('no_telp_penjual') ? ' is-invalid' : '' }}" value="{{old('no_telp_penjual')}}" name="no_telp_penjual" required>
            <small class="float-right">Format Indonesia (+62)</small>
            <div class="clearfix"></div>
            @if ($errors->has('no_telp_penjual'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('no_telp_penjual') }}</strong>
                </span>
            @endif
        </div>
    </div>
    
    <div class="form-group row">
        <label class="col-md-4 col-form-label text-md-right" for="foto_profil">Foto Profil</label>
        <div class="col-md-8">
            <input type="file" id="foto_profil" name="foto_profil_penjual" value="{{old('foto_profil_penjual')}} " class="form-control-file {{$errors->has('foto_profil_penjual') ? 'is-invalid' : ''}}" />
            @if ($errors->has('foto_profil_penjual'))
            <p class="text-danger">{{$errors->first('foto_profil_penjual')}}</p>
            @endif
        </div>
    </div>
        
    <div class="form-group text-right">
        <button type="submit" class="float-right btn btn-primary">
            Register
        </button>
    </div>
</form>