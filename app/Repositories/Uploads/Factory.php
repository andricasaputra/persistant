<?php  

namespace App\Repositories\Uploads;

class Factory
{
	public static function init($request)
	{
		$setting = auth()->user()->setting()->first();

		if ($setting->upload_setting == 'sync') {
			return Sync::process($request);
		} else {
			return Async::process($request);
		}

		throw new \Exception("You need to set upload setting first", 1);
	}
}