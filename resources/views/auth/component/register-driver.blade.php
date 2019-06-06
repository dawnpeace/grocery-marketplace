@section('breadcrumb-child')
    <span class="breadcrum-item">Registrasi Driver</span>
@endsection

<div class="form-group row">
    <label for="plat" class="col-md-4 col-form-label text-md-right">Plat Nomor Kendaraan</label>

    <div class="col-md-6">
        <input id="plat" style="text-transform:uppercase;" type="text" class="form-control{{ $errors->has('plat_nomor_kendaraan') ? ' is-invalid' : '' }}" name="plat_nomor_kendaraan" value="{{ old('plat_nomor_kendaraan') }}" required>
        <small class="float-right"><i>Ditulis tanpa spasi</i></small>
        <div class="clearfix"></div>
        @if ($errors->has('plat_nomor_kendaraan'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('plat_nomor_kendaraan') }}</strong>
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
        <input id="no-telp" type="text" class="form-control{{ $errors->has('alamat') ? ' is-invalid' : '' }}" name="alamat" value="{{ old('alamat') }}" required>

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
        <input id="no_telp" type="text" class="form-control{{ $errors->has('no_telp') ? ' is-invalid' : '' }}" name="no_telp" value="{{ old('no_telp') }}" required>

        @if ($errors->has('no_telp'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('no_telp') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group row">
    <label class="col-md-4 col-form-label text-md-right" for="nomor_sim">Nomor Sim</label>
    <div class="col-md-6">
        <input type="text" id="nomor_sim" name="nomor_sim" value="{{old('nomor_sim')}}" class="form-control {{$errors->has('alamat') ? 'is-invalid' : ''}}" required/>
        @if ($errors->has('nomor_sim'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('nomor_sim') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group row">
    <label class="col-md-4 col-form-label text-md-right" for="foto_profil">Foto Profil</label>
    <div class="col-md-6">
        <input type="file" id="foto_profil" name="foto_profil" value="{{old('foto_profil')}} " class="form-control-file {{$errors->has('alamat') ? 'is-invalid' : ''}}" />
        @if ($errors->has('foto_profil'))
        @endif
        <p class="text-danger">{{ $errors->first('foto_profil') }}</p>
    </div>
</div>

<div class="form-group row">
    <label class="col-md-4 col-form-label text-md-right" for="foto_sim">Foto Sim</label>
    <div class="col-md-6">
        <input type="file" id="foto_sim" name="foto_sim" value="{{old('foto_sim')}} " class="form-control-file {{$errors->has('alamat') ? 'is-invalid' : ''}}" />
        @if ($errors->has('foto_sim'))
            <p class="text-danger">{{ $errors->first('foto_sim') }}</p>
        @endif
    </div>
</div>