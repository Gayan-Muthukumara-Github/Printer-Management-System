<?php

namespace App\Imports;

use App\Models\DatafeedDetails;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportDataFeedDetails implements ToModel
{
    /**
     * @param array $row
     * @param $request
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row, $request)
    {
        return new DatafeedDetails([

            'datafeed_id' => "0",
            'customer_id' => "0",
            'printer_id' => "0",
            'total_page_count' => intval($row[5]),
            'mono_page_count' => intval($row[11]),
            'colour_page_count' => intval($row[7]),
            'serial_number' => $row[1],
            'date' => $request->date,

        ]);
    }
}
