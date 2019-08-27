@extends('default')

@section('breadcrumb')
<div class="container w-75 mt-4">
    <nav class="breadcrumb">
        <a class="breadcrumb-item" href="{{url('/')}}">Dapurpedia</a>
        <span class="breadcrumb-item active">Penilaian</span>
    </nav>
</div>
@endsection

@section('content')
<div class="container mh-70vh w-75">

    @if(Session::has('success'))
    <div class="alert alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
        {{Session::get('success')}}
    </div>
    @endif

    @foreach($keranjang as $belanja)
        @foreach($belanja->belanjaan as $item)
        @if(is_null($item->review))
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="{{$item->produk->display->url()}}" alt="" class="img img-fluid">
                        </div>
                        <div class="col-md-8">
                            <h4>{{$item->produk->nama_produk}}</h4>
                            <hr>
                            <div class="table-responsive">
                                <table class="table border">
                                    <tr>
                                        <th>Tanggal Pemesanan</th>
                                        <td>: {{localeDate($belanja->created_at)}}</td>
                                    </tr>
                                    <tr>
                                        <th>Harga Satuan</th>
                                        <td>: {{$item->harga}}</td>
                                    </tr>
                                    <tr>
                                        <th>Jumlah Pembelian</th>
                                        <td>: {{$item->jumlah." ".$item->produk->satuan_unit}}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="text-right">
                                <a class="btn btn-info btn-sm" href="{{route('review.show',$item->id)}}"><i class="fa fa-pencil-alt"></i> Berikan Ulasan Produk</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @endforeach
    @endforeach
</div>
@endsection