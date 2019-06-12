@extends('users.penjual.include.penjual-navbar')
@section('breadcrumb')
    <div class="mt-4">
        <nav class="breadcrumb">
            <a href="{{url('/')}}" class="breadcrumb-item">{{config('app.name')}}</a>
            <span class="breadcrumb-item active">Penjual</span>
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

<h2><i class="fa fa-list"></i> Daftar Produk Anda</h2>
<div class="row">
    <div class="col-md-10 col-sm-12">
        <a href="{{route('produk.tambah')}}" class="btn btn-primary float-right"><i class="fa fa-plus"></i> Tambah Produk</a>
    </div>
        @forelse($daftarProduk as $produk)
        <div class="col-md-10 col-sm-12">
            <div class="card my-3"> 
                <div class="card-body">
                    <div class="text-right">
                        <a href="{{route('produk.edit',[$produk->id])}}" class="btn btn-sm btn-primary"><i class="far fa-edit"></i> Perbaharui</a>
                        <button data-url={{route('produk.delete',[$produk->id])}} class="btn btn-sm btn-danger btn-delete " {{empty($produk->item) ? '' : 'disabled'}}><i class="fa fa-trash"></i>Hapus</button>
                        <button data-toggle="tooltip" data-placement="bottom" title="{{$produk->tersedia ? 'Tersedia' : 'Tidak Tersedia'}}" data-url="{{route('produk.update.ketersediaan',[$produk->id])}}" class="btn btn-sm {{$produk->tersedia ? 'btn-secondary' : 'btn-success'}} btn-update"><i class="fa fa-pencil-alt"></i> Ganti Ketersediaan</button>
                    </div>
                    <h5>{{$produk->nama_produk}}</h5> 
                    <hr>
                    <p class="text-justify">{{$produk->deskripsi}}</p>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-4 text-center">Harga : {{formatRP($produk->harga)}}</div>
                        <div class="col-md-4 text-center">Jumlah Tersedia : {{$produk->jumlah_tersedia}}</div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="w-75 m-auto">
            <div class="card mt-3">
                <div class="card-body">
                    <div class="p-2 text-center">
                        <h3>Anda belum mendaftarkan Produk anda.</h3>
                    </div>
                </div>
            </div>
        </div>
        @endforelse
        <form method="POST" id="form-update" action="">@csrf</form>
        <div class="row w-100">
            <div class="col-md-10 col-sm-12">
                <div class="d-flex justify-content-center">
                    {{$daftarProduk->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $('.btn-update').click(function(){
            url = $(this).data('url');
            form = $('#form-update');
            form.attr('action',url);
            form.submit();
        });

        $('.btn-delete').click(function(e){
            var url = $(this).data('url');
            swal({
            title: "Anda akan menghapus Produk",
            text: "Apakah anda yakin ?",
            icon: "warning",
            buttons: ["Tidak","Ya"],
            dangerMode: true,
            })
            .then((isDelete) => {
            if (isDelete) {
                url = $(this).data('url');
                form = $('#form-update');
                form.attr('action',url);
                form.submit();
            }
            });
        });

        $(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endsection
