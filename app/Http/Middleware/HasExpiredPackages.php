<?php

namespace App\Http\Middleware;

use Closure;
use App\Repositories\UserRepository;

class HasExpiredPackages
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
        if ($this->repository->isExpiredPackage() || trial()) return $next($request);
           
        return redirect(route('home'))->withWarning('Maaf paket anda masih aktif, anda tidak dapat membeli paket lainnya!');
    }
}
