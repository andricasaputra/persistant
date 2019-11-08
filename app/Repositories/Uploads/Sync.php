<?php  

namespace App\Repositories\Uploads;

use Goutte\Client;
use App\Http\Controllers\Concern\WithExcel;

ini_set('max_execution_time', '300');

class Sync
{
	use WithExcel;

	protected $client;

	protected $request;

	protected $destinationUri;

	public function __construct($request)
	{
		$this->client = app(Client::class);

		$this->request = $request;

		$this->destinationUri = config('e-persistant.uri.log');
	}

	public function make()
	{
		try {

			$crawler = $this->client->request('GET', $this->destinationUri);

			$form = $crawler->selectButton('upload')->form();

			$method = $form->getMethod();

			$uri  = $form->getUri();

			$values = $this->formatValues($form->getPhpValues());

			// Import data dari excel
			$rows = $this->setImporterClass($this->request)->getRows();

			$process = $rows->reject(function($row){

				return is_null($row['kegiatan']) || $this->request->butir_kegiatan === 0;		

			})->each(function($row) use ($values, $method, $uri) {

				$values['kuantitas_skp'] = $row['kuantitas_skp'];
				$values['skpbulan'] = $this->request->butir_kegiatan;
				$values['tanggal'] =  $row['tanggal'];
				$values['waktu'] = $row['waktu'];
            	$values['waktu_sd'] = $row['waktu_sd'];
				$values['jenis_tugas'] = $row['jenis_tugas'];
				$values['kegiatan'] = $row['kegiatan'];
				$values['output'] = $row['output'];

				$this->client->request($method, $uri, $values);

			});

			return $process->count();

		} catch (\InvalidArgumentException $e) {

		    return false;
		}
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
}