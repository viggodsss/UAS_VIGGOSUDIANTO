<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class LoginController extends Controller
{
    public function index(){
        return view('auth.login');
    }
    public function login_proses(Request $request){
        $request->validate([
            'email'  => 'required',
            'password' =>'required',
        ]);

        $data = [
            'email'  => $request->email,
            'password'  => $request->password,
        ];

        if(Auth::attempt($data)){
            return redirect()->route('admin.Game.index');
        }else{
            return redirect()->route('login')->with('failed','Email atau Password Salah');
        }
    }
    public function logout(){
        Auth::logout();
        return redirect()->route('login')->with('success','kamu berhasil logout');
    }
    public function register(){
        return view('auth.register');
    }
    public function register_proses(Request $request){
        $request->validate([
            'name'     => 'required',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6'
        ]);

        $users['name']     = $request->name;
        $users['email']    = $request->email;
        $users['password'] = Hash::make($request->password);

        $user = User::create($users);

        $login = [
            'email'  => $request->email,
            'password'  => $request->password,
        ];

        if(Auth::attempt($login)){
            return redirect()->route('admin.Game.index');
        }else{
            return redirect()->route('login')->with('failed','Email atau Password Salah');
        }
    }
}
