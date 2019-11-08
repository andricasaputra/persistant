<?php  

namespace App\Repositories\Uploads;

use App\Jobs\ProcessUpload;
use App\Http\Controllers\Concern\WithExcel;

ini_set('max_execution_time', '300');

class Async
{
	use WithExcel;

	protected $request;

	protected $destinationUri;

	public function __construct($request)
	{
		$this->request = $request;

		$this->destinationUri = config('e-persistant.uri.log');
	}

	public function make()
	{
		try {

			$butir = $this->request->butir_kegiatan;

			// Import data dari excel
			$rows = $this->setImporterClass($this->request)->getRows();

			ProcessUpload::dispatch($butir, $rows, $this->destinationUri);

			return $rows->reject(function($row) use ($butir) {

           		return is_null($row['kegiatan']) || $butir === 0;       

       		})->count();

		} catch (\InvalidArgumentException $e) {

		    return false;
		}
	}

	
}