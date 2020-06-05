<?php  

namespace App\Repositories\Uploads;

use App\Contracts\UploadContract;
use App\Http\Controllers\Concern\WithExcel;
use App\Jobs\AsyncProcess;

ini_set('max_execution_time', '300');

class Async implements UploadContract
{
	use WithExcel;

	public static function process($request)
	{
		try {

			$butir = $request->tj['tj_tb_id'];
			
			$rows = static::setImporterClass($request);

			AsyncProcess::dispatch($butir, $rows, config('e-persistant.uri.log'));

			return $rows->count();

		} catch (\InvalidArgumentException $e) {

		    return false;
		}
	}
	
}