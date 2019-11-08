<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\ResponseCache\ResponseCacheRepository;
use Spatie\ResponseCache\Events\ClearedResponseCache;
use Spatie\ResponseCache\Events\ClearingResponseCache;

class UserSettingController extends Controller
{
	public function __construct()
	{
		$this->middleware('doNotCacheResponse');
	}

    public function index()
    {
    	$user = auth()->user()->setting()->first();

    	return view('setting')->withUser($user);
    }

    public function store(Request $request)
    {
    	$setting = $request->only('upload_setting');

    	auth()->user()->setting()->update($setting);

    	return redirect(route('setting.index'))
    			->withSuccess('Setting berhasil dirubah ke ' . $setting['upload_setting']);
    }

    public function clearCache(ResponseCacheRepository $cache)
    {
    	event(new ClearingResponseCache());

        $cache->clear();

        event(new ClearedResponseCache());

        return redirect(route('setting.index'))
    			->withSuccess('Response cache cleared!');
    }
}
