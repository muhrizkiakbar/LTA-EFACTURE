<?php

namespace App\Imports;

use App\Models\Cra;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
class CrasImport implements ToModel, WithHeadingRow,SkipsEmptyRows
{
    use Importable;

    function parseDate($value, $format = 'Y-m-d') {
        try {
            return \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value));
        } catch (\ErrorException $e) {
            return \Carbon\Carbon::createFromFormat($format, $value);
        }
    }

    public function model(array $row)
    {
        return new Cra([
            'bp_code'   => $row['bp_code'],
            'bp_name'   => $row['bp_name'],
            'type'      => $row['type'],
            'doc_num'   => $row['doc_num'],
            'doc_date'  => $this->parseDate($row['doc_date']),
            'post_date' => $this->parseDate($row['post_date']),
            'due_date'  => $this->parseDate($row['due_date']),
            'bp_ref_no' => isset($row['bp_ref_no']) ? $row['bp_ref_no'] : '-' ,
            'original_amount' => $row['original_amount'],
            'balance_due' => $row['balance_due'],
            'pt'        => $row['pt'],
            'branch'    => $row['branch'],
            'delivery_date' => $this->parseDate($row['delivery_date']),
            'pic_admin' => $row['pic_admin'],
            'note'      => $row['note'],
            
        ]);
    }
}
