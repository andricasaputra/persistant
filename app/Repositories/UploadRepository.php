<?php  

namespace App\Repositories;

use Goutte\Client;
use App\Http\Controllers\Concern\WithExcel;

class UploadRepository
{
	use WithExcel;

	protected $client;

	protected $request;

	public function __construct()
	{
		$this->client = app(Client::class);

		$this->request = request();
	}

	public function make($destinationUri)
	{
		try {

			$crawler = $this->client->request('GET', $destinationUri);

			$form = $crawler->selectButton('upload')->form();

			$values = $form->getPhpValues();

			$method = $form->getMethod();

			$uri  = $form->getUri();

			$total = 0;

			// Import data dari excel
			$rows = $this->setImporterClass($this->request)->getRows();

			$rows->reject(function($row){

				return is_null($row['kegiatan']) || $this->request->butir_kegiatan === 0;		

			})->each(function($row) use ($values, $method, $uri, &$total) {

				$values['kuantitas_skp'] = intval($this->request->kuantitas_skp);
				$values['skpbulan'] = $this->request->butir_kegiatan;
				$values['tanggal'] =  $row['tanggal'];
				$values['waktu'] = $row['waktu'];
				$values['waktu_sd'] = $row['waktu_sd'];
				$values['jenis_tugas'] = $row['jenis_tugas'];
				$values['kegiatan'] = $row['kegiatan'];
				$values['output'] = $row['output'];

				if (! is_null($row['kegiatan']) && ! is_null($this->request->butir_kegiatan)) {
					$total++;
				}

				$this->client->request($method, $uri, $values);

			});

			return $total;

		} catch (\InvalidArgumentException $e) {

		    return false;
		}
	}
}