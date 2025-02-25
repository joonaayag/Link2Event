<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    
    public function inicio(){
        return view('base');
    }

    public function login(){
        return view('login');
    }

    public function registrar(){
        return view('registrar');
    }

}
