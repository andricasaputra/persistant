<?php 

namespace App\Http\Controllers\Concern;

use Excel;
use App\Imports\EpersonalImport;

trait WithExcel
{
	protected $rows;

	public function setImporterClass($request)
	{
		$importClass = new EpersonalImport();

		Excel::import($importClass, $request->file('filenya'));

		$this->rows = $importClass->getRows();

		return $this;
	}

	public function getRows()
	{
		return $this->rows;
	}
}
