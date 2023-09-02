@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div class="row">
        <div class="col-md-4"></div>
        <div class="card col-md-4">
            <div class="card-body">
                <h1 class="text-center">Login</h1>

                @if(session()->has('error_message')) {{-- berkaitan dengan with() pada authenticaiton method di AuthController, jika pada method tersebut with set error_message maka mereturn nilai true dan session memiliki error_message sehingga blok didalamnya dijalankan  --}}
                    <div class="alert alert-danger">
                        {{ session()->get('error_message') }}
                    </div>
                @endif

                {{-- jadi kalo kita set password plain text di database untuk usernya maka tidak bisa dan gagal login karena jetstream atau library auth mengecek password yang terenkripsi --}}
                <form action="{{ url('login') }}" method="post" class="form-control">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="enter your valid email address" name="email">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="enter your correct email" name="password">
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                </form>
            </div>
        </div>
    </div>
@endsection

