<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class InvoiceExport implements FromCollection, WithHeadings
{
    protected $data;
  
    public function __construct($data)
    {
        $this->data = $data;
    }
    public function collection()
    {
        return collect($this->data);
    }
    public function headings(): array
    {
        return [
            'Docnum',
            'Card Code',
            'Card Name',
            'Address',
            'NPWP',
            'NIK',
            'STATUS',
        ];
    }
}
