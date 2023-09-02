<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        return view('auth.login');
    }

    public function authentication(Request $request){
        $credentials = $request->only('email', 'password');
 
        if(Auth::attempt($credentials)){ //mengirimkan credentials ke library auth untuk mengecek apakah email dan password sesuai dengan yang di database
            return redirect('posts');
        }else{
            return redirect('login')->with('error_message', 'Incorrect Email or Password!'); //redirect ke halaman login dan ada pesan error gagal login
        }
    }

    public function logout(){
        Session::flush();
        Auth::logout(); //destroy auth yang kita punya

        return redirect('login');
    }

    public function register_form(){
        return view('auth.register');
    }

    public function register(Request $request){
        $request->validate([ //name, email, dan passowrd itu harus sesuai dengan nama field di database
            'name'     => 'required',
            'email'    => 'required|email|unique:users', //email harus unik dalam tabel users
            'password' => 'required|min:6|confirmed', //confirmed itu untuk melakukan pengecekan terhadap name password dengan nama password juga ditambah _confirmation seperti password == password_confirmation
        ]);

        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password'))
        ]);

        return redirect('login');
    }
}
