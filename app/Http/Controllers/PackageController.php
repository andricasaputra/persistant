<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function __construct()
	{
		$this->middleware('expired')->only('index');
	}

    public function index()
    {
    	$package = Package::forSale()->get();

    	return view('package.index')->withPackage($package);
    }

    public function list()
    {
    	$payment = auth()->user()->payments()->paginate(10);

    	return view('package.list')->withPayments($payment);
    }
}
