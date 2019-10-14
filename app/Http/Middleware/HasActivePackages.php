<?php

namespace App\Http\Middleware;

use Closure;
use App\Repositories\UserRepository;

class HasActivePackages
{
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->repository->isActivePackage()) return $next($request);
           
        return redirect(route('home'))->withWarning('Tidak dapat mengakses halaman yang dituju :( Masa berlaku paket anda telah habis, segera perbarui paket anda untuk dapat mengakses semua fitur pada aplikasi ini :)');
    }
}
