@extends('shared.layout')
@section('title', 'Login')


@section('content')
<div class="container my-5">
    @if(Session::has('success'))
    <div class="alert alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
        {{Session::get('success')}}
    </div>
    @endif
    <div class="card" style="width: 50%; margin: auto">
        <div class="card-header">
            <i class="fas fa-sign-in-alt"></i>
            Laman Login
        </div>
        <div class="card-body">
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class='form-group'>
                    <label for='username'> Username: </label>
                
                    <input
                        id='username' name='username' type='text'
                        placeholder='Username'
                        value='{{ old('username') }}'
                        class='form-control {{ !$errors->has('username') ?: 'is-invalid' }}'
                        autofocus>
                
                    <div class='invalid-feedback'>
                        {{ $errors->first('username') }}
                    </div>
                </div>

                <div class='form-group'>
                    <label for='password'> Password: </label>
                
                    <input
                        id='password' name='password' type='password'
                        placeholder='Password'
                        value='{{ old('password') }}'
                        class='form-control {{ !$errors->has('password') ?: 'is-invalid' }}'>
                
                    <div class='invalid-feedback'>
                        {{ $errors->first('password') }}
                    </div>
                </div>

                <div class='form-group'>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">
                            Tetap Masuk
                        </label>
                    </div>
                </div>

                <div class="mt-3 text-right">
                    <a href="{{route('register.index')}}" class="btn btn-dark">Daftar</a>
                    <button class="btn btn-primary">
                        Log In
                        <i class="fa fa-sign-in"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection