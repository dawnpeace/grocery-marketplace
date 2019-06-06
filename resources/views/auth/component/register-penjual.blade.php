<div class="form-group row">
    <label for="pasar_id" class="col-md-4 col-form-label text-md-right">Pasar</label>
    <div class="col-md-6">
        <select name="pasar_id" id="pasar_id" class="select2 form-control">
            @foreach($pasar as $market)
                <option value="{{$market->id}}">{{$market->nama_pasar}}</option>
            @endforeach
        </select>
        @if ($errors->has('alamat'))
            <p class="text-danger">{{ $errors->first('alamat') }}</p>
        @endif
    </div>
</div>

<div class="form-group row">
    <label for="nama_toko" class="col-md-4 col-form-label text-md-right">Nama Toko</label>
    <div class="col-md-6">
        <div class="form-group">
            <input type="text" id="nama_toko" name="nama_toko" value="{{old('nama_toko')}} " class="form-control {{$errors->has('nama_toko') ? 'is-invalid' : ''}}" />
        </div>
        @if ($errors->has('nama_toko'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('nama_toko') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group row">
    <label for="kota" class="col-md-4 col-form-label text-md-right">Kota</label>

    <div class="col-md-6">
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

    <div class="col-md-6">
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

    <div class="col-md-6">
        <input id="no_telp" type="text" class="form-control{{ $errors->has('no_telp') ? ' is-invalid' : '' }}" value="{{old('no_telp')}}" name="no_telp" required>

        @if ($errors->has('no_telp'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('no_telp') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group row">
    <label class="col-md-4 col-form-label text-md-right" for="foto_profil">Foto Profil</label>
    <div class="col-md-6">
        <input type="file" id="foto_profil" name="foto_profil" value="{{old('foto_profil')}} " class="form-control-file {{$errors->has('alamat') ? 'is-invalid' : ''}}" />
        @if ($errors->has('foto_profil'))
        <p class="text-danger">{{$errors->first('foto_profil')}}</p>
        @endif
    </div>
</div>

