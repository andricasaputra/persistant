<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function __invoke()
    {
        if(admin()) return redirect(route('admin.home'));
 
        return redirect(route('home'));
    }
}
