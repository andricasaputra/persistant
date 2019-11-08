<?php

namespace App\Http\Middleware;

use Closure;
use App\Repositories\UserRepository;

class HasPayments
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
        if (count($this->repository->hasPendingPayments()) === 0) return $next($request);
           
        return redirect(route('home'))->withWarning('Maaf anda mempunyai pembayaran yang masih pending, mohon selesaikan terlebih dahulu pembayaran anda :)');

        return $next($request);
    }
}
