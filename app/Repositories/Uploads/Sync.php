<?php  

namespace App\Repositories\Uploads;

use Goutte\Client;
use App\Http\Controllers\Concern\WithExcel;

ini_set('max_execution_time', '500');

class Sync
{
	use WithExcel;

	protected $client;

	protected $login;

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

			$this->login = resolve('Login');

			$crawler = $this->client->request('GET', $this->destinationUri);

			$form = $crawler->filterXpath('//*[@id="modal-buat-catatan"]/div/div/form')->form();

			$method = $form->getMethod();

			$uri  = $form->getUri();

			$values = $form->getPhpValues();

			// Import data dari excel
			$rows = $this->setImporterClass($this->request)->getRows();

			$process = $rows->each(function($row) use ($values, $method, $uri) {

				$row['jam_dari'] = gmdate("h:i", $this->convertTime($row['jam_dari']));
	            $row['jam_sampai'] = gmdate("h:i", $this->convertTime($row['jam_sampai']));

				$values['tj']['tj_tb_id'] = $this->request->tj['tj_tb_id'];
				$values['tanggal'] =  $row['tanggal_bulantanggaltahun'];
				$values['jam_dari'] = $row['jam_dari'];
            	$values['jam_sampai'] = $row['jam_sampai'];
				$values['jenis_tugas'] = 'Jabatan';
				$values['tj']['tj_realisasi'] = $row['realisasi'];
				$values['tj']['tj_deskripsi'] = $row['deskripsi'];
				$values['tj']['tj_output'] = $row['output'];
				$values['penjadwalankerja'] = 'WFO';

				$this->client->request($method, $uri, $values);

			});

			return $process->count();
			
		} catch (\Exception $e) {

			return false;
			
		}
	}

	protected function convertTime($decimal) 
    {
        return \PhpOffice\PhpSpreadsheet\Shared\Date::excelToTimestamp($decimal);
    }

	protected function formatValues(array $values)
	{
		unset($values['tm']); 

		return $values;
	}
}