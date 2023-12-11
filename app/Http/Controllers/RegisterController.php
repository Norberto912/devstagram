<?php

namespace App\Http\Controllers;

use Stringable;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    //
    public function index () {
        return view('auth.register');
    }
    public function store(Request $request){
      //  dd($request);
     // dd($request->get('username'));
     //modifica el request
     $request->request->add(['username'=>Str::slug($request->username)]);

        //validacion
        $this->validate($request,[
            'name'=>'required|max:30',
            'username'=>'required|unique:users|min:5|max:20',
            'email'=>'required|unique:users|email|max:60',
            'password'=>'required|confirmed|min:6'
        ]);

        //dd('creando suasuario');
        User::create([
            'name'=> $request->name,
            'username'=>$request->username,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
        ]);

//autenticar
       auth()->attempt([
            'email'=>$request->email,
            'password'=> $request->password,

        ]);

        //otraforma de autenticar
      //  auth()->attempt($request->only('email','password'));
        //redericioanr
        return redirect()->route('posts.index');

    }


}
