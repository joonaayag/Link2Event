<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public function index()
    {
        // Return the view named 'search'
        return view('search');
    }
}
