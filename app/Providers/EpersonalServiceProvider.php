<?php

namespace App\Providers;

use Goutte\Client;
use GuzzleHttp\Cookie\CookieJar;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Support\DeferrableProvider;

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
        $this->setClient();

        $this->jumperLogin();

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

    private function setClient()
    {
        $this->app->singleton(Client::class, function($app) {
            return new Client;
        });
    }

    private function jumperLogin()
    {
        $this->app->singleton('Login', function($app) {

            $client = app(Client::class);

            $user = auth()->user();

            $nip = $user->nip;

            if (is_null($nip) && customer()) {
                $nip = $this->getNip();
            }

            if (is_null($user->id_skp) || is_null($user->nip_hashed)) {

                $data = $this->getHashedNip($nip);

                $user->id_skp = $data['id_skp'];
                $user->nip_hashed = $data['nip_hashed'];

                $user->save();
            }

            $loginUri = config('e-persistant.uri.login');

            $client->request('GET', $loginUri . $user->nip_hashed);

            return $client;
        });
    }

    private function getNip()
    {
        $client = app(Client::class);
        $loginUri = config('e-persistant.simasn.uri.login');
        $homeUri = config('e-persistant.simasn.uri.home');
        $inputLoginXpath = config('e-persistant.simasn.input.loginXpath');
        $input['username'] = config('e-persistant.simasn.input.name.username');
        $input['password'] = config('e-persistant.simasn.input.name.password');

        $crawler = $client->request('GET', $loginUri);
        $form = $crawler->filterXPath($inputLoginXpath)->form();

        $form[$input['username']] = auth()->user()->name;
        $form[$input['password']] = auth()->user()->e_password;

        $client->submit($form);

        $crawler = $client->request('GET', $homeUri);

        $nip = $crawler->filter('#nip')->attr('value');

        auth()->user()->update(['nip' => $nip]);

        return $nip;
    }

    private function getHashedNip($nip)
    {
        $client = app(Client::class);
        
        $loginUri = config('e-persistant.uri.login');

        $nip = file_get_contents(config('e-persistant.encode') . $nip);

        $client->request('GET', $loginUri . $nip);

        $logUri = config('e-persistant.uri.log');

        $crawler = $client->request('GET', $logUri);

        $id_skp = $crawler->filterXpath('//*[@id="modal-buat-catatan"]/div/div/form/div[1]/input[1]')->attr('value');

        $nip_hashed = $crawler->filterXpath('//*[@id="modal-buat-catatan"]/div/div/form/div[1]/input[2]')->attr('value');

        return compact('id_skp', 'nip_hashed');
    }

    private function logout()
    {
        $this->app->singleton('Logout', function($app) {

            $client = $app['Login'];

            $profileUri = $app['config']->get('e-persistant.uri.profile');

            $crawler = $client->request('GET', $profileUri);

            $link = $crawler->filterXpath('//*[@id="side-menu"]/li[10]/a')->link();

            return $client->click($link);

        });
    }

    private function getProfile()
    {
        $this->app->singleton('Profile', function($app) {

            $client = $app['Login'];

            $logUri = $app['config']->get('e-persistant.uri.log');

            try {

                $cookieJar = CookieJar::fromArray([
                    'username' => auth()->user()->username
                ], $logUri);

                $crawler = $client->request('GET', $logUri, ['cookies' => $cookieJar]);

                $datas = $crawler->filter('.sidebar-menu div span')->each(function($span){
                    return $span->text();
                });

                array_push($datas, $crawler->filter('.img')->attr('src'));

                $keys = ['jabatan', 'nama', 'nip', 'foto'];

                $datas = array_combine($keys, $datas);

                return $datas;

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
