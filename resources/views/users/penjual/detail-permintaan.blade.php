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
    @if(Session::has('success'))
    <div class="alert alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
        {{Session::get('success')}}
    </div>
    @endif
    <div class="table-responsive">
        <div class="card">
            <div class="card-body">
                <div class="text-right m-2">
                    @can('ProsesPermintaan',$keranjang)
                    <button id="button-confirm" data-url="{{route('permintaan.proses',[$keranjang->id])}}" class="btn btn-primary btn-sm my-1"><i class="fas fa-check-circle"></i> Pesanan Siap Dibayarkan</button>
                    @endcan

                    @can('BelumDibayar',$keranjang)
                    <button id="button-paid" data-url="{{route('permintaan.dibayarkan',[$keranjang->id])}}" class="btn btn-primary btn-sm my-1"><i class="fas fa-check-circle"></i> Pesanan Telah Dibayarkan</button>
                    @endcan

                    @can('SiapDiantar',$keranjang)
                    <button id="button-send" data-url="{{route('permintaan.antar',[$keranjang->id])}}" class="btn btn-primary btn-sm my-1"><i class="fas fa-check-circle"></i> Antarkan Pesanan</button>
                    @endcan

                    <button data-toggle="tooltip" data-clipboard-text="{{$keranjang->pembeli->no_telp}}" class="btn btn-sm btn-secondary clipboard"><i class="fa fa-clipboard"></i> Salin No Telp</button>                    
                    <button type="button" class="btn btn-info btn-sm my-1" data-toggle="modal" data-target="#modal-info"><i class="fa fa-info"></i> Informasi Pelanggan</button>
                    <button type="button" onclick="openWA({{whatsappLink($keranjang->pembeli->no_telp)}})" class="btn btn-sm btn-success my-1"><i class="fab fa-whatsapp"></i> Kirim Pesan WA ke Pembeli</button>
                    <p style="display:none;" class="copy-text pr-3 text-right font-weight-bold pt-2">Nomor telepon tersalin !</p>
                </div>
                <h2 class="ml-2 mb-2">
                    <i class="fa fa-info-circle"></i> 
                    Detail Keranjang {{$keranjang->pembeli->user->nama}} 
                </h2>
                 
                <div class="table-responsive my-3">
                    <table class="table-sm table-borderless">
                        <tr>
                            <th class="text-right">Tanggal Checkout</th>
                            <td>{{localeDate($keranjang->tanggal_checkout)}}</td>
                        </tr>
                        <tr>
                            <th class="text-right">Nomor Identifikasi</th>
                            <td>{{$keranjang->nomor_identifikasi." / ".$keranjang->metode_pembayaran}}</td>
                        </tr>
                        @if($keranjang->telah_diproses)
                        <tr>
                            <th class="text-right">Tanggal Proses</th>
                            <td>{{localeDate($keranjang->tanggal_diproses)}}</td>
                        </tr>
                        @endif
                        @cannot('InputBiayaAntar',$keranjang)
                        <tr>
                            <th class="text-right">Biaya Antar</th>
                            <td>{{formatRP($keranjang->biaya_antar)}}</td>
                        </tr>
                        @endcannot
                        @can('InputBiayaAntar',$keranjang)
                        <tr>
                            <th class="text-right">Biaya Antar</th>
                            <td>
                                <form method="POST" action="{{route('permintaan.biaya',[$keranjang->id])}}">
                                    @csrf
                                    <div class="form-group {{$errors->has('biaya_antar') ? 'has-error' : ''}} m-auto">
                                        <div class="input-group">
                                            <input type="text" id="biaya_antar" name="biaya_antar" value="{{old('biaya_antar') ?? ($keranjang->biaya_antar ?? 0)}}" class="form-control form-control-sm {{$errors->has('biaya_antar') ? 'is-invalid' : ''}}" />
                                            <div class="input-group-append">
                                                <button class="btn btn-sm btn-primary"><i class="fa fa-arrow-right"></i></button>
                                            </div>
                                        </div>
                                        @if ($errors->has('biaya_antar'))
                                            <p class="text-danger">{{ $errors->first('biaya_antar') }}</p>
                                        @endif
                                        @if(is_null($keranjang->biaya_antar))
                                            <p class="text-secondary">Permintaan dapat diproses setelah biaya antar terisi.</p>
                                        @endif
                                    </div>
                                </form>
                            </td>
                        </tr>
                        @endcan
                    </table>
                </div>
                
                @can('SedangDiantar',$keranjang)
                <p class="font-weight-bold text-right" class="text-right ">Barang sedang dalam pengantaran</p>
                @endcan
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <th>Nama Produk</th>
                            <th class="text-right">Jumlah</th>
                            <th class="text-right">Harga Satuan</th>
                            <th class="text-right">Subtotal</th>
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
                                <td class="text-right">{{$item->jumlah}}</td>
                                <td class="text-right">{{formatRP($item->harga)}}</td>
                                <td class="text-right">{{formatRP($subtotal)}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3"><h5 class="font-weight-bold">Total</h5></td>
                                <td><h5 class="text-right"><strong><u>{{formatRP($total+($keranjang->biaya_antar ?? 0))}},-<u></strong></h5></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

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
                    <h4>Informasi Pelanggan</h4>
                    <hr>
                    <div class="clearfix"></div>
                    <div class="text-center">
                        <img style="max-height:14rem" src="{{$keranjang->pembeli->urlFoto()}}" alt="" class="img img-fluid">
                    </div>
                    <div class="table-responsive mt-3">
                        <table class="table table-sm table-borderless">
                            <tr>
                                <th>Nama Pelanggan</th>
                                <td> : {{$keranjang->pembeli->user->nama}}</td>
                            </tr>
                            <tr>
                                <th>Kota</th>
                                <td> : {{$keranjang->pembeli->kota}}</td>
                            </tr>
                            <tr>
                                <th>No Telp</th>
                                <td> : {{$keranjang->pembeli->no_telp}}</td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                                <td> : {{$keranjang->pembeli->alamat}}</td>
                            </tr>
                        </table>
                    </div>
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
        $(document).ready(function(){
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
            $('#button-paid').click(function(){    
                swal({
                    title: "Proses Pesanan",
                    text: "Tandai pesanan sebagai telah dibayar?",
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
            $('#button-send').click(function(){    
                swal({
                    title: "Proses Pesanan",
                    text: "Kirim Pesanan?",
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
    
            var clipboard = new ClipboardJS('.clipboard');
            clipboard.on('success',function(e){
                $('.copy-text').show();
                setInterval(function(){
                    $('.copy-text').hide();
                },1600);
            });
        });
    </script>
@endsection
