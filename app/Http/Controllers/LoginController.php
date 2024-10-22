<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function index(){
        return view('login.index');
    }

    public function login(Request $request){
        
        $temp=$request->only('email','password');
        if(Auth::attempt($temp)){
            return redirect()->route('welcome');
        }else{
            return back()->withErrors([
                'email' => 'As credenciais fornecidas não correspondem ao nosso registro.',
            ]);    
        }
    }
    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->back();
    }
}