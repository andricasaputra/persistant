<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\ResponseCache\ResponseCacheRepository;
use Spatie\ResponseCache\Events\ClearedResponseCache;
use Spatie\ResponseCache\Events\ClearingResponseCache;

class HomeAdminController extends Controller
{
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	return view('admin.home');
    } 

    public function clear(ResponseCacheRepository $cache)
    {
    	event(new ClearingResponseCache());

        $cache->clear();

        event(new ClearedResponseCache());

    	return redirect(route('admin.home'))->withSuccess('Response cache cleared!');
    }
}
