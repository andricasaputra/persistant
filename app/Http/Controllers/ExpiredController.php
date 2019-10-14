<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;

class ExpiredController extends Controller
{
	public function __construct()
	{
		$this->middleware('expired');
	}

    public function index()
    {
    	$package = Package::forSale()->get();

    	return view('expired')->withPackage($package);
    }
}
