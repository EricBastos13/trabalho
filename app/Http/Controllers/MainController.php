<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    //
    public function index(){
        return view('welcome');
    }
    public function fale(){
        return view('info.fale');
    }
    public function sobre(){
        return view('info.sobre');
    }
}
