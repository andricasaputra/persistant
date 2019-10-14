<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\Http\View\Composer\ProfileComposer;
use App\Http\View\Composer\AdminProfileComposer;
use App\Repositories\Payments\PaymentsFactory;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('Payments', function($app){
            return new PaymentsFactory();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        Carbon::setLocale(config('app.locale'));

        if (admin()) {
            View::composer(['admin.home'], AdminProfileComposer::class);
        }

        if (! admin()) {
            View::composer(['home', 'profile', 'log', 'layouts.navbar'], ProfileComposer::class);
        }
    } 

}
