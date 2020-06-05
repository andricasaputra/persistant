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
    private $time;

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
     * Mengambil data dari row ke 3, 
     * row ke 3 adalah header, row ke 4 dst adalah data
     *
     * @return int
     */
    public function headingRow(): int
    {
        return 3;
    }

    public function prepare($rows)
    {
    	return $rows->reject(function($row){

            return is_null($row['deskripsi']) || is_null($row['output']);       

        })->map(function($row){

    		$row['tanggal_bulantanggaltahun'] = $this->transformDate($row['tanggal_bulantanggaltahun'])->toDateString();
            $row['realisasi'] = (int) $row['realisasi'];

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
