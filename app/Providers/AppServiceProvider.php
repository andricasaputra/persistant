<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Queue;
use Illuminate\Queue\Events\JobFailed;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\Http\View\Composer\ProfileComposer;
use App\Repositories\Payments\PaymentsFactory;
use App\Http\View\Composer\AdminProfileComposer;

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
        } else {
            View::composer(['home', 'profile', 'log', 'layouts.navbar', 'info'], ProfileComposer::class);
        }

        Queue::failing(function (JobFailed $event) {

            $lastId = app('queue.failer')->log(
                $event->connectionName, $event->job->getQueue(),
                $event->job->getRawBody(), $event->exception
            );

            event(new \App\Events\UserJobFailedEvent($event, $lastId));
            
        });
    } 

}
