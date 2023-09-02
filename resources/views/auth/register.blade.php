@extends('layouts.app')

@section('title', 'Register')

@section('content')
    <div class="row">
        <div class="col-md-4"></div>
        <div class="card col-md-4">
            <div class="card-body">
                <h1 class="text-center">Register</h1>

                @if(session()->has('error_message')) {{-- berkaitan dengan with() pada authenticaiton method di AuthController, jika pada method tersebut with set error_message maka mereturn nilai true dan session memiliki error_message sehingga blok didalamnya dijalankan  --}}
                    <div class="alert alert-danger">
                        {{ session()->get('error_message') }}
                    </div>
                @endif

                {{-- jadi kalo kita set password plain text di database untuk usernya maka tidak bisa dan gagal login karena jetstream atau library auth mengecek password yang terenkripsi --}}
                <form action="{{ url("register") }}" method="post">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" placeholder="enter your name" name="name">
                        @if($errors->has('name')) {{-- jadi errors itu bawaannya method validate() dan name itu harus sama dengan name field di validate() --}}
                            <span class="text-danger ">{{ $errors->first('name') }}</span> {{-- menampilkan pesan error name --}}
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="enter your valid email address" name="email">
                        @if($errors->has('email')) 
                            <span class="text-danger ">{{ $errors->first('email') }}</span>
                        @endif
                
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="enter your correct password" name="password">
                        @if($errors->has('password')) 
                            <span class="text-danger ">{{ $errors->first('password') }}</span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="password_confirmation" placeholder="enter your correct confirmation password" name="password_confirmation">{{-- jadi namenya itu kata pertama sesuai dengan inputan password ditambah _confirmation --}}
                    </div>
                    <button type="submit" class="btn btn-primary">Signup</button>
                </form>
            </div>
        </div>
    </div>
@endsection

