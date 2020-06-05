<?php  

namespace App\Repositories\Uploads;

use Goutte\Client;
use App\Http\Controllers\Concern\WithExcel;

ini_set('max_execution_time', '500');

class SyncProcess
{
	use WithExcel;

	public static function init($request)
	{
		try {

			$client = app(Client::class);

			resolve('Login')->jump();

			$crawler = $client->request('GET', config('e-persistant.uri.log'));

			$form = $crawler->filterXpath('//*[@id="modal-buat-catatan"]/div/div/form')->form();

			// Import data dari excel
			return static::importExcel($form, $client, $request)->count();
			
		} catch (\Exception $e) {

			return false;
		}
	}

	private static function importExcel($form, $client, $request)
	{
		$method = $form->getMethod();

		$uri  = $form->getUri();

		$values = $form->getPhpValues();

		$rows = static::setImporterClass($request);

		return $rows->each(function($row) use ($method, $uri, $values, $client, $request) {

			$row['jam_dari'] = gmdate("h:i", static::convertTime($row['jam_dari']));
            $row['jam_sampai'] = gmdate("h:i", static::convertTime($row['jam_sampai']));

			$values['tj']['tj_tb_id'] = $request->tj['tj_tb_id'];
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