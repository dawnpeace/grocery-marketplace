@extends('default')

@section('breadcrumb')
<div class="mt-4 container w-75">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <a href="{{route('dashboard')}}" class="breadcrumb-item" aria-current="page">Dapurpedia</a>
            <span class="breadcrumb-item active">Transaksi Saya</span>
        </ol>
    </nav>
</div>
@endsection

@section('content')
    <div class="container w-75 mh-70vh">
        @foreach ($keranjang as $item)
            <div class="card mb-4">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <a data-target="#detail-{{$item->id}}" class="show" href="javascript:void(0)">{{$item->penjual->nama_toko}}</a>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="text-right">
                                Tanggal Checkout : {{localeDate($item->tanggal_checkout)}}
                            </div>
                        </div>
                    </div>
                </div>
                <div style="display:none;" id="detail-{{$item->id}}" class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-striped border">
                            <thead>
                                <th>Nama Produk</th>
                                <th class="text-right">Harga Satuan</th>
                                <th class="text-right">Jumlah</th>
                                <th class="text-right">Subtotal</th>
                            </thead>
                            <tbody>
                                @php $total = 0; @endphp
                                @foreach($item->belanjaan as $belanja)
                                <tr>
                                    <td>{{$belanja->produk->nama_produk}}</td>
                                    <td class="text-right">{{$belanja->harga}}</td>
                                    <td class="text-right">{{$belanja->jumlah}}</td>
                                    <td class="text-right">{{$subtotal = $belanja->harga * $belanja->jumlah}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3">
                                        <h5 class="font-weight-bold">Total</h5>
                                    </td>
                                    <td class="text-right font-weight-bold">{{$total+=$subtotal}}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="d-flex justify-content-center">
            {{$keranjang->links()}}
        </div>
    </div>
@endsection

@section('js')
    <script>
        $('a.show').click(function(){
            target = $(this).data('target');
            $(target).toggle('slow');
        });
    </script>
@endsection