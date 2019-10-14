<?php

namespace App\Http\Middleware;

use Closure;

class IsUser
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
        if (customer()) {

            app()->register(\App\Providers\EpersonalServiceProvider::class);

            return $next($request);
        } 

        return back()->withWarning('Anda Tidak Mempunyai Hak Akses Ke Halaman Ini!');
        
    }
}
