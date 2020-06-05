<?php 

namespace App\Http\Controllers\Concern;

use Excel;
use App\Imports\EpersonalImport;

trait WithExcel
{
	protected static $rows;

	protected static function setImporterClass($request)
	{
		$importClass = new EpersonalImport();

		Excel::import($importClass, $request->file('filenya'));

		return static::$rows = $importClass->getRows();
	}

	protected static function getRows()
	{
		return static::$rows;
	}
}
