<?php  

namespace App\Repositories\Uploads;

use App\Contracts\UploadContract;

class Sync implements UploadContract
{
	public static function process($request)
	{
		return SyncProcess::init($request);
	}
}