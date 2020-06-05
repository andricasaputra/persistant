<?php

namespace App\Providers;

use App\Http\Controllers\Auth\EpersonalLoginController;
use App\Http\Controllers\ProfileController;
use Goutte\Client;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

ini_set('max_execution_time', 500);

class EpersonalServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->client();

        $this->login();

        $this->logout(); 

        $this->profile();
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

    private function client()
    {
        $this->app->singleton(Client::class, function($app) {
            return new Client;
        });
    }

    private function login()
    {
        $this->app->singleton('Login', function($app) {
            return new EpersonalLoginController;
        });
    }

    private function profile()
    {
        $this->app->singleton('Profile', function($app) {
            return new ProfileController;
        });
    }

    private function logout()
    {
        $this->app->singleton('Logout', function($app) {

            $client = $app['Login'];

            $profileUrl = $app['config']->get('e-persistant.uri.profile');

            $crawler = $client->request('GET', $profileUrl);

            $link = $crawler->filterXpath('//*[@id="side-menu"]/li[10]/a')->link();

            return $client->click($link);

        });
    }

    public function provides()
    {
        return [Client::class, 'Logout', 'Profile'];
    }
}
