<?php

namespace App\Jobs;

use Goutte\Client;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ProcessUpload implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $rows, $user_id;

    protected $uri, $butir;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($butir, $rows, $uri)
    {
        $this->uri = $uri;

        $this->rows = $rows;

        $this->butir = $butir;

        $this->user_id = auth()->user()->id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $client = $this->decorateClient();

        $crawler = $client->request('GET', $this->uri);

        $form = $crawler->selectButton('upload')->form();

        $method = $form->getMethod();

        $files = $form->getPhpFiles();

        $uri  = $form->getUri();

        $values = $this->formatValues($form->getPhpValues());

        $this->rows->reject(function($row){

            return is_null($row['kegiatan']) || $this->butir === 0;       

        })->each(function($row) use ($client, $method, $uri, $values) {

            $values['kuantitas_skp'] = $row['kuantitas_skp'];
            $values['skpbulan'] = $this->butir;
            $values['tanggal'] =  $row['tanggal'];
            $values['waktu'] = $row['waktu'];
            $values['waktu_sd'] = $row['waktu_sd'];
            $values['jenis_tugas'] = $row['jenis_tugas'];
            $values['kegiatan'] = $row['kegiatan'];
            $values['output'] = $row['output'];

            $client->request($method, $uri, $values);

        });
    }

    protected function formatValues(array $values)
    {
        unset(
            $values['upload'], 
            $values['tugas_tambahan'], 
            $values['nomer_surat'],
            $values['foto'],
            $values['fupload']
        ); 

        $values['kuantitas_skp'] = '';

        return $values;
    }

    public function decorateClient()
    {
        $client =  new Client;

        $user = User::findOrFail($this->user_id);

        $login = config('e-persistant.uri.login');

        $crawler = $client->request('GET', $login);

        $form = $crawler->selectButton('Login')->form();

        $form['admin'] = $user->name;
        
        $form['kunci'] = $user->e_password;

        $client->submit($form);

        return $client;
    }
}
