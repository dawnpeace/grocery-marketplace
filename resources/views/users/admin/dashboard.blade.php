@extends('users.admin.include.admin-navbar')
@section('breadcrumb')
    <div class="mt-4">
        <nav class="breadcrumb">
            <span class="breadcrumb-item active">Dapurpedia Admin</span>
        </nav>
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-4 pb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="text-center">Driver Total : {{$dataUser["driver"]["total"]}}</h5>
                    <div class="row">
                        <div class="col-sm-6 text-center">Telah Diverifikasi <br>{{$dataUser["driver"]["telahDiverifikasi"]}}</div>
                        <div class="col-sm-6 text-center">Belum Diverifikasi <br>{{$dataUser["driver"]["belumDiverifikasi"]}}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 pb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="text-center">Pembeli Total : {{$dataUser["pembeli"]["total"]}}</h5>
                    <div class="row">
                        <div class="col-sm-6 text-center">Telah Diverifikasi <br>{{$dataUser["pembeli"]["telahDiverifikasi"]}}</div>
                        <div class="col-sm-6 text-center">Belum Diverifikasi <br>{{$dataUser["pembeli"]["belumDiverifikasi"]}}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 pb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="text-center">Penjual Total : {{$dataUser["penjual"]["total"]}}</h5>
                    <div class="row">
                        <div class="col-sm-6 text-center">Belum Diverifikasi <br>{{$dataUser["penjual"]["belumDiverifikasi"]}}</div>
                        <div class="col-sm-6 text-center">Telah Diverifikasi <br>{{$dataUser["penjual"]["telahDiverifikasi"]}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection