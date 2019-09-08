@extends('default')

@section('breadcrumb')
<div class="container w-75 mt-4">
    <nav class="breadcrumb">
        <a class="breadcrumb-item" href="{{url('/')}}">Dapurpedia</a>
        <span class="breadcrumb-item active">Penilaian</span>
    </nav>
</div>
@endsection

@section('content')
    <div class="container mh-70vh w-75">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <img src="{{displayUrl($item->produk->display)}}" alt="" class="img img-fluid">
                    </div>
                    <div class="col-md-8">
                        <h3>{{$item->produk->nama_produk}}</h3>
                        <hr>
                        <h4 class="text-right">{{$item->produk->penjual->nama_toko}}</h4>
                        <div id="rateYo"></div>
                        @if ($errors->has('penilaian'))
                            <small class="text-danger" role="alert">
                                <strong>{{ $errors->first('penilaian') }}</strong>
                            </small>
                        @endif
                        <small class="ml-2">Berikan rating untuk produk</small>

                        <form method="POST" action="">
                            @csrf
                            <input id="rate" type="hidden" name="penilaian" value="3">
                            <div class="form-group m-2">
                                <label for="ulasan">Berikan ulasan untuk produk</label>
                                <textarea rows="3" id="ulasan" name="review" class="form-control {{$errors->has('review') ? 'is-invalid' : ''}}">{{old('review')}}</textarea>
                                @if ($errors->has('review'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('review') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="text-right">
                                <button class="btn btn-sm btn-primary"><i class="fa fa-pencil-alt"></i> Berikan Ulasan</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
<script>
    $(document).ready(function(){
        curRate = $('#rate').val();
        $("#rateYo").rateYo({
            rating: curRate,
            fullStar: true,
            onSet : function(rating,rateYoInstance){
                $('#rate').val(rating);
            }
        });
    });
</script>
@endsection