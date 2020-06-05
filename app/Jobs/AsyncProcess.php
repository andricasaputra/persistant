<?php

namespace App\Jobs;

use Goutte\Client;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

ini_set('max_execution_time', '500');

class AsyncProcess implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $rows, $user_id, $nip_hashed;

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

        $this->nip_hashed = auth()->user()->nip_hashed;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $client = resolve('Login')->setHashedNip($this->nip_hashed)->jump();

        $crawler = $client->request('GET', $this->uri);

        $form = $crawler->filterXpath('//*[@id="modal-buat-catatan"]/div/div/form')->form();

        $method = $form->getMethod();

        $uri  = $form->getUri();

        $values = $form->getPhpValues();

        return $this->rows->each(function($row) use ($method, $uri, $values, $client) {

            $row['jam_dari'] = gmdate("h:i", static::convertTime($row['jam_dari']));
            $row['jam_sampai'] = gmdate("h:i", static::convertTime($row['jam_sampai']));

            $values['tj']['tj_tb_id'] = $this->butir;
            $values['tanggal'] =  $row['tanggal_bulantanggaltahun'];
            $values['jam_dari'] = $row['jam_dari'];
            $values['jam_sampai'] = $row['jam_sampai'];
            $values['jenis_tugas'] = 'Jabatan';
            $values['tj']['tj_realisasi'] = $row['realisasi'];
            $values['tj']['tj_deskripsi'] = $row['deskripsi'];
            $values['tj']['tj_output'] = $row['output'];
            $values['penjadwalankerja'] = 'WFO';

            $client->request($method, $uri, $values);

        });
    }

    protected static function convertTime($decimal) 
    {
        if (! is_null($decimal)) {
            return \PhpOffice\PhpSpreadsheet\Shared\Date::excelToTimestamp($decimal);
        }
    }
}
