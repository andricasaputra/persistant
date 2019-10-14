<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application home.
     *
     * @return \Illuminate\Support\Collection
     */
    public function index()
    {	
        return view('home');
    }
}
