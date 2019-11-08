<?php  

namespace App\Repositories\Uploads;

class UploadFactory
{
	public static function init($request)
	{
		$setting = auth()->user()->setting()->first();

		if ($setting->upload_setting == 'sync') {
			return new Sync($request);
		} else {
			return new Async($request);
		}

		throw new \Exception("You need to set upload setting first", 1);
	}
}