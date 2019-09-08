@extends('default')

@section('breadcrumb')
<div class="mt-4 container w-75">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <a href="{{route('dashboard')}}" class="breadcrumb-item" aria-current="page">Dapurpedia</a>
            <span class="breadcrumb-item active">Register</span>
        </ol>
    </nav>
</div>
@endsection

@section('content')
    <div class="mh-70vh">
        <div class="container w-75">
            <register-component
                :markets = "{{json_encode($pasar)}}"  
                register_seller = "{{route('store.seller')}}"
                register_customer = "{{route('store.customer')}}"
                csrf_token = "{{csrf_token()}}"
                redirect_url = "{{route('login')}}"
            />
        </div>

    </div>
@endsection