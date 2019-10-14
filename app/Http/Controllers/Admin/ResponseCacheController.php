<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\ResponseCache\ResponseCache;

class ResponseCacheController extends Controller
{
    public function clear()
    {
    	ResponseCache::clear();

    	return redirect(route('admin.home'))->withSuccess('Cache Cleared Successfully');
    }
}
