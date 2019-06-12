@extends('default')

@section('breadcrumb')
<div class="container w-75 mt-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Dapurpedia</li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="container w-75">
    <div class="row my-4 mh-70vh">
        @foreach($daftarPasar as $pasar)
            <div class="col-md-6 col-sm-12">
                <a href="{{route('dashboard.produk',[$pasar->id])}}" class="link-unstyled">
                    <div class="p-2">
                        <div class="card shadow">
                            <div class="row">
                                <div class="col-md-5 m-auto">
                                    <img src="{{$pasar->displayUrl()}}" class="img img-fluid">
                                </div>
                                <div class="col-md-7">
                                    <div class="card-body">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item"><strong>{{$pasar->nama_pasar}}</strong></li>
                                            <li class="list-group-item">{{$pasar->alamat}}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>

@endsection