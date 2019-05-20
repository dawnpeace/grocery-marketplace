@extends('users.penjual.include.penjual-navbar')

@section('breadcrumb')
    <div class="mt-4">
        <nav class="breadcrumb">
            <a href="{{route('penjual.dashboard')}}" class="breadcrumb-item">Dashboard</a>
            <span class="breadcrumb-item active">Permintaan Diproses</span>
        </nav>
        @if(Session::has('success'))
        <div class="alert alert-success mt-2" role="alert">
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            {{Session::get('success')}}
        </div>
        @endif
    </div>
@endsection

@section('content')
    <h1>Daftar Permintaan Diproses</h1>
    <div class="table-responsive mt-2">
        <table class="table table-borderless">
            <thead>
                <th>Nama Pelanggan</th>
                <th>Tanggal Pesan</th>
                <th>Driver</th>
                <th>Status Pengantaran</th>
                <th>Aksi</th>
            </thead>
            <tbody>
                @foreach($permintaan as $item)
                <tr>
                    <td>{{$item->pembeli->user->nama}}</td>
                    <td>{{$item->tanggalPemesanan()}}</td>
                    <td>{{$item->status->driver->user->nama ?? "-"}}</td>
                    <td>{{$item->status->tampilStatus()}}</td>
                    <td></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection