<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Goutte\Client;

class EpersonalLoginController extends Controller
{
    protected $nip = null, $nip_hashed = null;

    public function __construct()
    {
        $this->setNip();
        $this->setHashedNip();
    }

    public function setNip($nip = null)
    {
        if (auth()->check()) {

            $this->nip = auth()->user()->nip;

        } else {

            $this->nip = $nip;
        }

        return $this;
    }

    public function setHashedNip($nip_hashed = null)
    {
        if (auth()->check()) {

            $this->nip_hashed = auth()->user()->nip_hashed;

        } else {

            $this->nip_hashed = $nip_hashed;
        }

        return $this;
    }

    public function jump()
    {
        if (auth()->check()) $this->checkUserData();

        $client = app(Client::class);

        $client->request('GET', config('e-persistant.uri.login') . $this->nip_hashed);

        return $client;
    }

    private function checkUserData()
    {
        $user = auth()->user();

        if (is_null($this->nip) && customer()) {
            $this->nip = $this->getNip();
        }

        if (is_null($user->id_skp) || is_null($user->nip_hashed)) {

            $data = $this->getHashedNip($this->nip);

            $user->id_skp = $data['id_skp'];
            $user->nip_hashed = $data['nip_hashed'];

            $user->save();
        }
    }

    private function getNip()
    {
        $client = app(Client::class);

        $loginUrl = config('e-persistant.simasn.uri.login');
        $homeUri = config('e-persistant.simasn.uri.home');
        $inputLoginXpath = config('e-persistant.simasn.input.loginXpath');

        $input['username'] = config('e-persistant.simasn.input.name.username');
        $input['password'] = config('e-persistant.simasn.input.name.password');

        $crawler = $client->request('GET', $loginUrl);
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
        
        $loginUrl = config('e-persistant.uri.login');

        $nip = file_get_contents(config('e-persistant.encode') . $nip);

        $client->request('GET', $loginUrl . $nip);

        $logUrl = config('e-persistant.uri.log');

        $crawler = $client->request('GET', $logUrl);

        $id_skp = $crawler->filterXpath('//*[@id="modal-buat-catatan"]/div/div/form/div[1]/input[1]')->attr('value');

        $nip_hashed = $crawler->filterXpath('//*[@id="modal-buat-catatan"]/div/div/form/div[1]/input[2]')->attr('value');

        return compact('id_skp', 'nip_hashed');
    }
}
