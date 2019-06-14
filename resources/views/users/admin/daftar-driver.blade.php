@extends("users.admin.include.admin-navbar")


@section('breadcrumb')
    <div class="mt-4">
        <nav class="breadcrumb">
            <a href="{{route('admin.dashboard')}}" class="breadcrumb-item">Dapurpedia Admin</a>
            <span class="breadcrumb-item active">Manajemen Driver</span>
        </nav>
    </div>
@endsection

@section("content")
@include('users.admin.include.alerts')
<div class="card">
    <div class="card-body">
        <div class="table-responsive mb-5">
            <div class="float-right">
                <div class="pb-2 text-right">
                    Verifikasi Akun - <button class="btn btn-sm btn-success"><i class="fa fa-check"></i></button>
                </div>
                <div class="pb-2 text-right">
                    Batalkan Verifikasi - <button class="btn btn-sm btn-danger"><i class="far fa-window-close"></i></button>
                </div>
            </div>
            <h3><i class="fa fa-motorcycle"></i> Daftar Driver</h3>
            <form action="" method="GET">
                <div class="form-group">
                    <label for="nama"></label>
                    <div class="input-group col-md-4 col-sm-6">
                        <input placeholder="Nama Driver" type="text" id="nama" name="nama" value="{{request('nama','')}}" class="form-control" />
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-sm btn-outline-secondary"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </form>
            <table class="table table-sm table-striped">
                @php $i = $users->firstItem(); @endphp
                <thead>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Tanggal Daftar</th>
                    <th>Status</th>
                    <th>E-Mail</th>
                    <th>Aksi</th>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{$i}}</td>
                        <td>{{$user->nama}}</td>
                        <td>{{$user->username}}</td>
                        <td>{{$user->tanggalDaftar()}}</td>
                        <td>{{$user->driver['telah_diverifikasi'] ? 'Telah Diverifikasi' : 'Belum Diverifikasi'}}</td>
                        <td>{{$user->email}}</td>
                        <td>
                            <a class="btn btn-sm btn-primary" href="{{route('edit.driver',[$user->driver->id])}}"><i class="fas fa-pencil-alt"></i> Perbaharui</a>
                            <button data-url="{{route('verif.driver',[$user->driver->id])}}" class="btn btn-sm btn-verif {{$user->driver['telah_diverifikasi'] ? 'btn-danger' : 'btn-success'}}"><i class="{{$user->driver['telah_diverifikasi'] ? 'far fa-window-close' : 'fa fa-check'}}"></i> {{$user->driver['telah_diverifikasi'] ? 'Batal' : 'Verif'}}</button>
                        </td>
                    @php $i++; @endphp
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="hidden">
                <form id="verification" method="POST" action="">
                    @csrf
                </form>
            </div>
            <div class="d-flex">
                <div class="m-auto">
                    {{$users->links()}}
                </div>
            </div>
        </div>      
    </div>
</div>
@endsection
@section('js')
    <script>
        $('.btn-verif').click(function(){
            url = $(this).data('url');
            $('#verification').attr('action',url) ;
            $('#verification').submit();
        });
    </script>
@endsection