<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UsersExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public $data;

    public function __construct($users){
        $this->data = $users;
    }

     public function headings(): array
    {
        return [
            'id',
            'program',
            'voucher',
            'voucher_value',
            'is_use',
            'created_at',
            'updated_at',
        ];
    }

    public function map($user): array
    {
        return [
            $invoice->invoice_number,
            Date::dateTimeToExcel($invoice->created_at),
        ];
    }


    public function collection()
    {
        return $this->data;
    }

  	
}
