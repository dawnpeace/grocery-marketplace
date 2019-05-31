@extends('users.penjual.include.penjual-navbar')

@section('breadcrumb')
    <div class="mt-4">
        <nav class="breadcrumb">
        <a class="breadcrumb-item" href="{{route('penjual.dashboard')}}">Dapurpedia Penjual</a>
        <a class="breadcrumb-item" href="{{route('produk.edit',[request('produk')])}}">Manajemen Produk</a>
        <span class="breadcrumb-item active">Galeri Foto</span>
        </nav>
    </div>
@endsection

@section('content')
@include('users.penjual.include.alerts')
  <div class="row">
    <div class="col-md-12 my-2">
      <div class="card">
        <div class="card-body">
          <h4>Upload Gambar Baru</h4>
          <hr>
            <form action="" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <label for="foto-produk">
                  <input id="input-upload" type="file" id="foto-produk" name="foto_produk" class="form-control-file" accept="image/jpeg,image/png,image/png" />
                </div>
                <div class="clearfix"></div>
                <button id="img-upload" type="submit" class="btn btn-primary float-right">Submit</button>
                <div class="clearfix"></div>
            </form>
            <div id="img-display-container" class="text-center d-gone mt-2">
              <img id="img-show" src="" class="text-center img img-fluid bg-secondary ">
            </div>
        </div>
      </div>
    </div>
  <!-- End Card Upload -->
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <div class="row">
            @forelse ($galeri as $foto)
              <div class="col-md-4 my-2">
                <div class="border rounded p-2">
                    <a class="link-unstyled" href="#">
                      <img src="{{asset($foto->url())}}" class="img img-fluid">
                    </a>
                    <div class="text-right mt-1">
                      <a href="{{route('photo.edit',[$foto->id])}}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                      <button data-url="{{route('photo.delete',[$foto->id])}}" class="btn btn-danger btn-sm btn-delete"><i class="fas fa-trash-alt"></i></button>
                    </div>
                    <div class="clearfix"></div>
                </div>
              </div>
            @empty
              <div class="col-md-12">
                <h5 class="text-info text-center">Anda belum mengupload Foto Produk </h5>
              </div>
            @endforelse
          </div>
          <form id="delete-form" action="" method="post" class="d-none">@csrf</form>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('js')
  <script>
    var validImage = ["image/jpeg","image/png",'image/jpg'];
      $('#input-upload').change(function(e){
        file = this.files[0];
        fileType = file["type"];
        if($.inArray(fileType,validImage) > -1){
          url = URL.createObjectURL(e.target.files[0]);
          $('#img-display-container').removeClass('d-gone');
          console.log(url);
          $('#img-show').attr('src',url);
        }
      });

      $('.btn-delete').click(function(e){
        var url = $(this).data('url');
        swal({
          title: "Anda akan menghapus Gambar",
          text: "Apakah anda yakin ?",
          icon: "warning",
          buttons: ["Tidak","Ya"],
          dangerMode: true,
        })
        .then((isDelete) => {
          if (isDelete) {
            form = $("#delete-form");
            form.attr("action",url);
            form.submit();
            console.log(url);
        }
        });
      });
  </script>
@endsection
