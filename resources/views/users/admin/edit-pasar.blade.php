@extends('users.admin.include.admin-navbar')

@section('breadcrumb')
    <nav class="breadcrumb mt-4">
        <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">Dapurpedia Admin</a>
        <a class="breadcrumb-item" href="{{route('admin.manajemen.pasar')}}">Manajemen Pasar</a>
        <span class="breadcrumb-item active">Perbaharui Data Pasar</span>
    </nav>
@endsection

@section('content')
    @if(Session::has('success'))
    <div class="alert alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
        {{Session::get('success')}}
    </div>
    @endif
    <div class="py-3">
        <div class="card">
            <div class="card-body">
                <h2><i class="fa fa-map"></i> Perbaharui {{$pasar->nama_pasar}}</h2>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="form-group">
                                <label for="nama_pasar">Nama Pasar</label>
                                <input type="text" id="nama_pasar" name="nama_pasar" value="{{old('nama_pasar') ?? $pasar->nama_pasar}}" class="form-control {{$errors->has('nama_pasar') ? 'is-invalid' : ''}}" required/>
                                @if ($errors->has('nama_pasar'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nama_pasar') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <input type="text" id="alamat" name="alamat" value="{{old('alamat') ?? $pasar->alamat}}" class="form-control {{$errors->has('alamat') ? 'is-invalid' : ''}}" required/>
                                @if ($errors->has('alamat'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('alamat') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-primary float-right"><i class="fa fa-plus"></i> Submit</button>
                        </div>
                        <div class="col-md-5">
                            <div class="border d-flex border-secondary rounded">
                                <img id="img-show" src="{{$pasar->displayUrl()}}" alt="" class="img m-auto img-fluid">
                            </div>

                            <div class="form-group mt-3">
                                <label for="foto_pasar">Foto Pasar</label>
                                <input type="file" id="foto_pasar" name="foto_pasar" class="form-control-file" />
                                @if ($errors->has('foto_pasar'))
                                    <p class="text-danger"> {{ $errors->first('foto_pasar') }} </p>
                                @endif
                            </div>

                            <br>
                            @csrf
                            
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script>
var validImage = ["image/jpeg","image/png",'image/jpg'];
        $('#foto_pasar').change(function(e){
            file = this.files[0];
            fileType = file["type"];
            if($.inArray(fileType,validImage) > -1){
                url = URL.createObjectURL(e.target.files[0]);
                $('#img-show').attr('src',url);
            }
        });
</script>
@endsection