<?php

namespace App\Http\Middleware;

use Closure;
use App\Repositories\UserRepository;

class CheckPackage
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
        $this->repository->checkPackageStatus();

        return $next($request);
    }
}
