
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
    <div class="col-md-6">
        <input type="file" id="foto_profil" name="foto_profil" value="{{old('foto_profil')}} " class="form-control-file {{$errors->has('alamat') ? 'is-invalid' : ''}}" />
        @if ($errors->has('foto_profil'))
        <p class="text-danger">{{$errors->first('foto_profil')}}</p>
        @endif
    </div>
</div>

