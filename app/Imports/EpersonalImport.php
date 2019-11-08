<?php

namespace App\Imports;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class EpersonalImport implements ToCollection, WithMultipleSheets, WithHeadingRow
{
	private $rows;

    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
    	$this->rows = $this->prepare($rows);

        return $this->prepare($rows);
    }

    public function getRows()
    {
    	return $this->rows;
    }

    /**
     * Mengambil sheet pertama saja pada dokumen excel
     *
     * @return array
     */
    public function sheets(): array
    {
        return [0 => $this];
    }

    /**
     * Mengambil data dari row ke 1, 
     * row ke 1 adalah header, row ke 2 dst adalah data
     *
     * @return int
     */
    public function headingRow(): int
    {
        return 1;
    }

    public function prepare($rows)
    {
    	return $rows->map(function($row){

    		$row['tanggal'] = $this->transformDate($row['tanggal'])->toDateString();
            $row['kuantitas_skp'] = (int) $row['kuantitas_skp'];
            $row['waktu'] = number_format($row['waktu'], 2);
            $row['waktu_sd'] = number_format($row['waktu_sd'], 2);

    		return $row;
    	});
    }

    /**
	 * Transform tanggal menjadi object dari carbon
	 *
	 * @param string $value
	 * @param string $format
	 * @return \Carbon\Carbon|null
	 */
	protected function transformDate($value, $format = 'Y-m-d')
	{
	    try {

	        return Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value));

	    } catch (\ErrorException $e) {

	        return Carbon::createFromFormat($format, $value);
	    }
	}
}
