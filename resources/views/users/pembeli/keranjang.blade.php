@extends('default')

@section('breadcrumb')
<div class="container my-3">
    <nav class="breadcrumb">
        <a class="breadcrumb-item" href="{{route('dashboard')}}">Dapurpedia</a>
        <a class="breadcrumb-item" href="{{route('keranjang')}}">Keranjang</a>
        <span class="breadcrumb-item active">Detail Keranjang</span>
    </nav>
</div>
@endsection 

@section('content')
    <div style="min-height:68vh" class="container">
        @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            {{Session::get('success')}}
        </div>
        @endif
        <div class="card mb-4">
            <div class="card-body">
                <h2 class="mb-3">Detail Keranjang</h2>
                <div class="clearfix"></div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <th>Nama Produk</th>
                            <th class="text-right">Jumlah</th>
                            <th class="text-right">Harga</th>
                            <th class="text-right">Subtotal</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody>
                            @php $total = 0 @endphp
                            @foreach($keranjang->belanjaan as $item)
                            @php $subtotal = $item->jumlah*$item->harga; @endphp
                            <tr>
                                <td>{{$item->produk->nama_produk}}</td>
                                <td class="text-right">{{$item->jumlah}}</td>
                                <td class="text-right">{{formatRP($item->harga)}}</td>
                                <td class="text-right">{{formatRP($subtotal)}}</td>
                                <td>
                                    <button data-url="{{route('hapus.item',[$keranjang->id,$item->id])}}" class="btn btn-delete-item btn-danger"><i class="fas fa-trash-alt"></i></button>
                                    <a href="{{route('tambah.produk',[$item->produk_id])}}" class="btn btn-primary"><i class="fas fa-arrow-right"></i></a>
                                </td>
                            </tr>
                            @php $total+=$subtotal; @endphp
                            @endforeach
                            <tfoot>
                                <td colspan="2"><h5>Total</h5></td>
                                <td class="text-right" colspan="2">
                                    <h5><u>{{formatRP($total)}}</u></h5>
                                </td>
                                <td></td>
                            </tfoot>
                        </tbody>
                    </table>
                    <form id="delete-item" action="" method="POST">@csrf</form>
                </div>
                <div class="w-100 mt-3">
                    @if($errors->has('metode_pembayaran'))
                    <div class="alert alert-danger" role="alert">
                        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                        {{$errors->get('metode_pembayaran')[0]}}
                    </div>
                    @endif

                    @if($errors->has('nomor_identifikasi'))
                    <div class="alert alert-danger" role="alert">
                        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                        {{$errors->get('nomor_identifikasi')[0]}}
                    </div>
                    @endif

                    @if(!$keranjang->telah_diselesaikan)
                    <form id="checkout" method="POST" action="{{route('keranjang.checkout',$keranjang->id)}}">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Pembayaran</h3>
                            </div>
                            <div class="col-md-3 text-center">
                                <div class="custom-control custom-radio">
                                    <input name="metode_pembayaran" value="bca" type="radio" class="custom-control-input" id="bca">
                                    <label class="custom-control-label" for="bca">Transfer BCA</label>
                                </div>
                                <img src="{{asset('img/payment/BCA.png')}}" alt="" class="img img-fluid payment-icon">
                            </div>
                            <div class="col-md-3 text-center">
                                <div class="custom-control custom-radio">
                                    <input name="metode_pembayaran" value="mandiri" type="radio" class="custom-control-input" id="mandiri">
                                    <label class="custom-control-label" for="mandiri">Transfer Mandiri</label>
                                </div>
                                <img src="{{asset('img/payment/mandiri.png')}}" alt="" class="img img-fluid payment-icon">
                            </div>
                            <div class="col-md-3 text-center">
                                <div class="custom-control custom-radio">
                                    <input name="metode_pembayaran" value="ovo" type="radio" class="custom-control-input" id="ovo">
                                    <label class="custom-control-label" for="ovo">Pembayaran Melalui OVO</label>
                                </div>
                                <img src="{{asset('img/payment/ovo.jpg')}}" alt="" class="img img-fluid payment-icon">
                            </div>
                            
                            <div class="col-md-3 text-center">
                                <div class="custom-control custom-radio">
                                    <input name="metode_pembayaran" value="gopay" type="radio" class="custom-control-input" id="gopay">
                                    <label class="custom-control-label" for="gopay">Pembayaran Melalui GO-Pay</label>
                                </div>
                                <img src="{{asset('img/payment/gopay.jpg')}}" alt="" class="img img-fluid payment-icon">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="form-group col-md-12">
                                <label class="font-weight-bold" for="nomor_identifikasi">Nomor Identifikasi</label>
                                <input placeholder="Input Nomor Akun Pembayaran" type="text" id="nomor_identifikasi" name="nomor_identifikasi" value="{{old('nomor_identifikasi')}}" class="form-control {{$errors->has('nomor_identifikas') ? 'is-invalid' : ''}}" required/>
                                @if ($errors->has('nomor_identifikasi'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('nomor_identifikasi') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <h3>Jasa Antar</h3>
                                @if($errors->has('metode_pengiriman'))
                                <div class="alert alert-danger" role="alert">
                                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                    {{$errors->get('metode_pengiriman')[0]}}
                                </div>
                                @endif
                            </div>
                            <div class="col-md-3 text-center">
                                <div class="custom-control custom-radio">
                                    <input name="metode_pengiriman" value="gojek" type="radio" class="custom-control-input" id="gojek">
                                    <label class="custom-control-label" for="gojek">Jasa GOJEK</label>
                                </div>
                                <img src="{{asset('img/courier/gojek.png')}}" alt="" class="img img-fluid payment-icon">
                            </div>
                            <div class="col-md-3 text-center">
                                <div class="custom-control custom-radio">
                                    <input name="metode_pengiriman" value="grab" type="radio" class="custom-control-input" id="grab">
                                    <label class="custom-control-label" for="grab">Jasa GRAB</label>
                                </div>
                                <img src="{{asset('img/courier/grab.png')}}" alt="" class="img img-fluid payment-icon">
                            </div>
                            <div class="col-md-3 text-center">
                                <div class="custom-control custom-radio">
                                    <input name="metode_pengiriman" value="bujangkurir" type="radio" class="custom-control-input" id="bujang_kurir">
                                    <label class="custom-control-label" for="bujang_kurir">Jasa Bujang Kurir</label>
                                </div>
                                <img src="{{asset('img/courier/bujangkurir.jpg')}}" alt="" class="img img-fluid payment-icon">
                            </div>
                            <div class="col-md-3 text-center">
                                <div class="custom-control custom-radio">
                                    <input name="metode_pengiriman" value="jemput" type="radio" class="custom-control-input" id="ambil">
                                    <label class="custom-control-label" for="ambil">Jemput Sendiri</label>
                                </div>
                                <img src="{{asset('img/courier/self.png')}}" alt="" class="img img-fluid payment-icon">
                            </div>
                        </div>
                        <div class="text-right mt-3">
                            <button  id="btn-checkout" type="button" class="btn btn-success"><i class="fa fa-check"></i> Checkout</button>
                        </div>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(".btn-delete-item").click(function(){
            swal({
                title: "Menghapus Item pada keranjang",
                text: "Apakah anda yakin?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((val)=>{
                if(val){
                    formdel = $('form#delete-item');
                    formdel.attr('action',$(this).data('url'));
                    formdel.submit();
                }
            });
        });

        $("#btn-checkout").click(function(){
            swal({
                title: "Checkout Keranjang",
                text: "Apakah anda yakin?",
                icon: "info",
                buttons: true,
                dangerMode: true,
            }).then((val)=>{
                if(val){
                    $('#checkout').submit();
                }
            });
        });
    </script>
@endsection