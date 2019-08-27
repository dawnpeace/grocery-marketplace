@extends('shared.layout')
@section('breadcrumb')
<div class="mt-4">
    <nav class="breadcrumb">
        <a href="{{url('/')}}" class="breadcrumb-item">Home</a>
        <span class="breadcrumb-item active">Daftar Register</span>    
    </nav>
</div>
@endsection
@section('content')
    <div class="container">
        <div class="py-5">
            <div class="row">
                {{-- Customer Registration --}}
                <div class="col-md-6 p-2">
                    <div class="card">
                        <div class="card-header">
                            <h3>Daftar Sebagai Pembeli</h3>
                        </div>
                        <div class="card-body">
                            @include('auth.register.register-pembeli')
                        </div>
                    </div>
                </div>
                {{-- Seller Registration --}}
                <div class="col-md-6 p-2">
                    <div class="card">
                        <div class="card-header">
                            <h3>Daftar Sebagai Penjual</h3>
                        </div>
                        <div class="card-body">
                            @include('auth.register.register-penjual')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection