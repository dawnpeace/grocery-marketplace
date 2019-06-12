@extends('default')

@section('breadcrumb')
    <div class="container mt-4">
        <nav class="breadcrumb">
            <a class="breadcrumb-item" href="{{url('/')}}">Dapurpedia</a>
            <span class="breadcrumb-item active">Pencarian</span>
        </nav>
    </div>
@endsection

@section('content')
    <div class="container mh-70vh">
        <div class="row">
            <div class="col-md-3 col-sm-12">
                <div class="card mt-2">
                    <div class="card-body">
                        <form action="{{route('pencarian')}}">
                                <div class="form-group">
                                    <label for="q">Pencarian</label>
                                    <input type="text" id="q" value="{{request('q')}}" name="q" value="{{old('q')}} " class="form-control form-control-sm {{$errors->has('q') ? 'is-invalid' : ''}}" />
                                    @if ($errors->has('q'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('q') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                <select name="cari"  class="form-control form-control-sm">
                                        <option value="produk" {{request('cari') == 'produk' ? 'selected' :  ''}}>Produk</option>
                                        <option value="penjual" {{request('cari') == 'penjual' ? 'selected' :  ''}}>Penjual</option>
                                    </select>
                                </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-9 col-sm-12">
                <div class="row">
                    @if(request('cari') == 'penjual')
                    @forelse($hasil as $penjual)
                    <div class="col-md-6">
                        <div class="p-2">
                            <div class="card">
                                <div class="card-body">
                                    <strong class="text-primary"> <a href="{{route('profil.penjual',[$penjual->id])}}">{{$penjual->nama_toko}}</a></strong>
                                    <a class="float-right btn btn-sm btn-outline-primary" href="{{route('profil.penjual',[$penjual->id])}}"><i class="fa fa-arrow-right"></i></a>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item list-group-item-flush">Domisili Pasar : {{$penjual->pasar->nama_pasar}}</li>
                                    <li class="list-group-item list-group-item-flush">{{$penjual->alamat}}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-md-12">
                        <div class="alert alert-secondary" role="alert">
                            <strong>Data tidak ditemukan.</strong>
                        </div>
                    </div>
                    @endforelse
                    @else
                    @forelse($hasil as $produk)
                    <div class="col-md-3">
                        <div class="p-2">
                            <div class="card shadow">
                                <a href="{{route('lihat.produk',[$produk->id])}}" class="link-unstyled">
                                    <img style="min-height:150px;object-fit:cover;" class="img-fluid" src="{{displayUrl($produk->display)}}" alt="">
                                </a>
                                <div class="card-body">
                                    <hr>
                                    <p class="h5">{{$produk->nama_produk}}</p>
                                    <p class="text-primary font-weight-bold">{{$produk->penjual->nama_toko}}</p>
                                    <i>{{$produk->harga()."/".$produk->satuan_unit}}</i>
                                </div>
                                @can('pembeli')
                                <a href="{{route('tambah.produk',[$produk->id])}}" class="btn {{$produk->tersedia ? 'btn-primary ' : 'btn-secondary'}} btn-sm">{!! $produk->tersedia ? '<i class="fas fa-cart-plus"></i>' : '<i class="fas fa-times-circle"></i> Item Kosong' !!}</a>
                                @endcan
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-md-12">
                        <div class="alert alert-secondary" role="alert">
                            <strong>Data tidak ditemukan.</strong>
                        </div>
                    </div>
                    @endforelse
                    @endif
                </div>
                <div class="d-flex my-4">
                    <div class="mx-auto">
                        {{$hasil->links()}}
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection