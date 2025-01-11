<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index(){
        return view('login');
    }
    // login
    public function login(Request $request){
        $request->validate([
            'login'=>'required',
            'password'=>'required',
        ]);     
        $login = $request->input('login');
        $password = $request->input('password');
        if (auth()->attempt(['login' => $login, 'password' => $password,
        'is_active' => 1])) {
            toast('Успешно введено в программу','success');
            return redirect()->route('home');
            } else {
                return redirect()->back()->with('error', 'Введен неверный логин или пароль');
            }

    }
    // logout   
    public function logout(){
        auth()->logout();
        return redirect()->route('auth.index');
    }
}
