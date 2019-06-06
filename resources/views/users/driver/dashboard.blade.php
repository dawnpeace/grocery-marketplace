@extends('users.driver.include.driver-navbar')

@section('breadcrumb')
    <div class="container">
        <div class="mt-4">
            <nav class="breadcrumb">
                <a class="breadcrumb-item active" href="#">Dapurpedia Driver</a>
            </nav>
        </div>
    </div>
@endsection

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <h2><i class="fa fa-list"></i> Daftar Pesanan</h2>
                    <table class="table table-striped table-sm">
                        <thead>
                            <th>Nama Toko</th>
                            <th>Alamat Toko</th>
                            <th>Alamat Tujuan</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-success"><i class="fab fa-whatsapp"></i> Pesan</button>
                                    <button type="button" class="btn btn-sm btn-primary"><i class="fa fa-check-square"></i> Ambil</button>
                                    <button type="button" class="btn btn-sm btn-secondary"><i class="fa fa-bars"></i> Detail</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection