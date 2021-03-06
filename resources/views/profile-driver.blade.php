@extends('default')

@section('breadcrumb')
    <div class="container w-75 mt-3">
        <nav class="breadcrumb">
            <a class="breadcrumb-item" href="{{url('/')}}">Dapurpedia</a>
            <span class="breadcrumb-item active">Profil </span>
        </nav>
    </div>
@endsection

@section('content')
    <div class="container w-75 mh-70vh">
        <div class="card mb-4">
            <div class="card-body mb-3">
                <h2 class="text-center">{{$driver->user->nama." - ".strtoupper($driver->plat_nomor_kendaraan)}}</h2>
                <hr>
                <div class="row">
                    <div class="col-md-4">
                        <img src="{{$driver->urlFoto()}}" class="img img-fluid">
                    </div>
                    <div class="col-md-8">
                        <ul class="list-group">
                            <li class="list-group-item">Kota : {{$driver->kota}}</li>
                            <li class="list-group-item">Nomor SIM :  {{$driver->nomor_sim}}</li>
                            <li class="list-group-item">E-mail : {{$driver->user->email}}</li>
                        </ul>
                        <div class="clearfix mb-2"></div>
                        <button type="button" onclick="openWA({{whatsappLink($driver->no_telp)}})" class="btn btn-success float-right"><i class="fab fa-whatsapp"></i> Kontak Driver</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection