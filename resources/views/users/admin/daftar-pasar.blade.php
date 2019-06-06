@extends('users.admin.include.admin-navbar')

@section('breadcrumb')
    <nav class="breadcrumb mt-4">
        <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">Dapurpedia Admin</a>
        <span class="breadcrumb-item active">Manajemen Pasar</span>
    </nav>
@endsection


@section('content')
    <div class="my-4">
        @if(Session::has('success'))
        <div class="my-2">
            <div class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                {{Session::get('success')}}
            </div>
        </div>
        @endif
        <div class="card">
            <div class="card-body">
                <a href="{{route('pasar.create')}}" class="btn btn-primary btn-sm float-right"><i class="fa fa-plus"></i> Tambah Pasar</a>
                <h2><i class="fa fa-list"></i> Daftar Pasar</h2>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <th>Nama Pasar</th>
                            <th>Alamat</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody>
                            @foreach($pasar as $market)
                            <tr>
                                <td>{{$market->nama_pasar}}</td>
                                <td>{{$market->alamat}}</td>
                                <td>
                                    <a href="{{route('pasar.edit',[$market->id])}}" class="btn btn-outline-info btn-sm"><i class="fa fa-pencil-alt"></i> Ubah</a>
                                    @if(!empty($market->pedagang))
                                        <button type="button" class="btn btn-sm btn-danger" disabled><i class="fa fa-trash"></i> Hapus</button>
                                    @else
                                        <button data-url="{{route('pasar.delete',[$market->id])}}" type="button" class="btn btn-sm btn-danger btn-delete"><i class="fa fa-trash"></i> Hapus</button>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <form id="delete-pasar" method="POST" action="">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script>
    $('.btn-delete').click(function(){
        swal({
                title: "Hapus Pasar",
                text: "Anda ingin menghapus Pasar?",
                icon: "info",
                buttons: true,
                dangerMode: true,
            }).then((val)=>{
                if(val){
                    formdel = $('form#delete-pasar');
                    formdel.attr('action',$(this).data('url'));
                    formdel.submit();
                }
            });
    });
</script>
@endsection