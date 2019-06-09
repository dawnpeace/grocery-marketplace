@extends('users.penjual.include.penjual-navbar')

@section('breadcrumb')
    <div class="mt-4">
        <nav class="breadcrumb">
        <a href="{{route('penjual.dashboard')}}" class="breadcrumb-item">Dapurpedia Penjual</a>
        <a href="{{route('permintaan')}}" class="breadcrumb-item">Permintaan</a>
        <span class="breadcrumb-item active">Detail Permintaan</span>
        </nav>
    </div>
@endsection

@section('content')
    <div class="table-responsive">
        <div class="card">
            <div class="card-body">
                <h2 class="mt-2 ml-2 mb-2"><i class="fa fa-info-circle"></i> Detail Keranjang {{$keranjang->pembeli->user->nama}}</h2>
                <div class="float-right m-2">
                    @can('ProsesPermintaan',$keranjang)
                    <button id="button-confirm" data-url="{{route('permintaan.proses',[$keranjang->id])}}" class="btn btn-primary btn-sm my-1"><i class="fas fa-check-circle"></i> Proses</button>
                    @endcan
                    <button type="button" class="btn btn-outline-info btn-sm my-1" data-toggle="modal" data-target="#modal-info"><i class="fa fa-info"></i> Informasi Pelanggan</button>
                    <button type="button" onclick="openWA({{whatsappLink($keranjang->pembeli->no_telp)}})" class="btn btn-sm btn-outline-success my-1"><i class="fab fa-whatsapp"></i> Hubungi Pembeli</button>
                </div>
                <div class="clearfix"></div>
                <table class="table table-striped">
                    <thead>
                        <th>Nama Produk</th>
                        <th>Harga Satuan</th>
                        <th>Jumlah</th>
                        <th class="text-center">Subtotal</th>
                    </thead>
                    <tbody>
                        @php $total = 0; @endphp
                        @foreach($keranjang->belanjaan as $item)
                        <tr>
                            @php 
                                $subtotal = $item->jumlah*$item->harga;
                                $total+=$subtotal;
                            @endphp
                            <td>{{$item->produk->nama_produk}}</td>
                            <td>{{$item->harga}}</td>
                            <td>{{$item->jumlah}}</td>
                            <td class="text-right">{{formatRP($subtotal)}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3"><h5 class="font-weight-bold">Total</h5></td>
                            <td><h5 class="text-right"><strong><u>{{formatRP($total)}},-<u></strong></h5></td>
                        </tr>
                    </tfoot>
                </table>

            </div>
        </div>
    </div>
    <form id="confirm-order" method="POST" action="{{route('permintaan.proses',[$keranjang->id])}}">@csrf</form>

    <!-- Modal -->
    <div class="modal fade" id="modal-info" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="clearfix"></div>
                    <div class="text-center">
                        <img style="max-height:14rem" src="{{$keranjang->pembeli->urlFoto()}}" alt="" class="img img-fluid">
                    </div>
                    <ul class="list-group mt-3">
                        <li class="list-group-item">{{$keranjang->pembeli->kota}}</li>
                        <li class="list-group-item">{{$keranjang->pembeli->alamat}}</li>
                        <li class="list-group-item">{{$keranjang->pembeli->no_telp}}</li>
                    </ul>
                </div>
                
            </div>
        </div>
    </div>
    
    <script>
        $('#exampleModal').on('show.bs.modal', event => {
            var button = $(event.relatedTarget);
            var modal = $(this);
            // Use above variables to manipulate the DOM
            
        });
    </script>
    
@endsection

@section('js')
    <script>
        $('#button-confirm').click(function(){    
            swal({
                title: "Proses Pesanan",
                text: "Anda ingin memproses Pesanan?",
                icon: "info",
                buttons: true,
                dangerMode: true,
            }).then((val)=>{
                if(val){
                    formdel = $('form#confirm-order');
                    formdel.attr('action',$(this).data('url'));
                    formdel.submit();
                }
            });
        });

        listHeight = $('#user-info').height();
        $('#pembeli-img').css({'max-height':listHeight});

    </script>
@endsection
