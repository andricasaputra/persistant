<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Profile;

class ProfileController extends Controller
{
    public function index()
    {
    	return view('profile');
    }

    public function log()
    {
    	return view('log');
    }
}
