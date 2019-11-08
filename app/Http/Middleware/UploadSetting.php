<?php

namespace App\Http\Middleware;

use Closure;

class UploadSetting
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(auth()->user()->setting()->first()->upload_setting == 'async'){
            return $next($request);
        }

        return back()->withWarning('Halaman hanya khusus bagi pengguna upload secara async');
    }
}
