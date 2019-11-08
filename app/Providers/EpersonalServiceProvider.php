<?php

namespace App\Providers;

use Goutte\Client;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Support\DeferrableProvider;

class EpersonalServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->login();

        $this->logout(); 

        $this->getProfile();
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

    private function login()
    {
        $this->app->singleton(Client::class, function($app) {

            $client =  new Client;

            $loginUri = $app['config']->get('e-persistant.uri.login');
    
            $crawler = $client->request('GET', $loginUri);

            $form = $crawler->selectButton('Login')->form();

            $form['admin'] = auth()->user()->name;
            
            $form['kunci'] = auth()->user()->e_password;

            $client->submit($form);

            return $client;

        });
    }

    private function logout()
    {
        $this->app->singleton('Logout', function($app) {

            $client = $app[Client::class];

            $profileUri = $app['config']->get('e-persistant.uri.profile');

            $crawler = $client->request('GET', $profileUri);

            $link = $crawler->filterXpath('//*[@id="side-menu"]/li[10]/a')->link();

            return $client->click($link);

        });
    }

    private function getProfile()
    {
        $this->app->singleton('Profile', function($app) {

            $client = $app[Client::class];

            $profileUri = $app['config']->get('e-persistant.uri.profile');

            try {
        
                $crawler = $client->request('GET', $profileUri);

                $datas = $crawler->filter('table')->filter('tr')->each(function ($tr, $i) {

                    return $tr->filter('td')->each(function ($td, $i) {

                        return $td->filter('td')->text();
                    });

                });

                $image = $crawler->filter('img')->eq(2)->attr('src');

                $result = [];

                foreach ($datas as $data) {
                    if (! empty($data)) {
                        $result += [
                            strtolower(str_replace(' ', '_', $data[0])) => $data[2]
                        ];
                    }
                }

                $result += ['foto' => $image];

                return $result;

            } catch (\InvalidArgumentException $e) {

                return abort('500');

            }

        });
    }

    public function provides()
    {
        return [Client::class, 'Logout', 'Profile'];
    }
}
