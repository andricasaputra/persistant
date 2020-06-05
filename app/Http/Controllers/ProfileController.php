<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Profile;
use GuzzleHttp\Cookie\CookieJar;

class ProfileController extends Controller
{
    public function index()
    {
    	return view('profile');
    }

    public function log()
    {
    	return view('log');
    }

    public function profile()
    {
    	$client = resolve('Login')->jump();

        $logurl = config('e-persistant.uri.log');

        try {

            $cookieJar = CookieJar::fromArray([
                'username' => auth()->user()->username
            ], $logurl);

            $crawler = $client->request('GET', $logurl, ['cookies' => $cookieJar]);

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
    }
}
