<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Support\DeferrableProvider;
use App\Repositories\Uploads\CustomQueue\DatabaseFailedJob;

class CustomQueueServiceProvider extends ServiceProvider  implements DeferrableProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // Get a default implementation to trigger a deferred binding
        $_ = $this->app['queue.failer'];

        //regiter the custom class you created
        $this->app->singleton('queue.failer', function ($app) {

            $config = $app['config']['queue.failed'];
            
            return new DatabaseFailedJob($app['db'], $config['database'], $config['table']);

        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['queue.failer'];
    }
}
