<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ProgramVoucherExport implements FromCollection, WithHeadings, WithMapping
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
            'full_name',
            'phone',
            'child_name',
            'child_old',
            'gift_id1',
            'gift_date1',
            'utm_mom_kid',
        ];
    }

    public function map($user): array
    {
        
      
        return [
            $user->full_name,
            $user->phone,
            $user->child_name,
            $user->getChildOld(),
            $user->gift1->title,
            $user->gift_date1,
            $user->utm_mom_kid
        ];
    }


    public function collection()
    {
        return $this->data;
    }

  	
}
