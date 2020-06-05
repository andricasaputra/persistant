<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

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

    public function info()
    {
    	return view('info');
    }

    public function getDownload()
	{
	    $file = public_path(). "/files/e-persistant_format.xlsx";

	    $headers = ['Content-Type: application/xlsx'];

	    return Response::download($file, 'e-persistant_format.xlsx', $headers);
	}
}
