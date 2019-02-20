<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ProgramExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public $data;
    public $type;

    public function __construct($type, $users){
        $this->type = $type;
        $this->data = $users;
    }

     public function headings(): array
    {
        if( $this->type  == 'mom_kid')
            return [
                'Họ tên',
                'SDT',
                'Tên bé',
                'Tuổi bé',
                'Quà',
                'Ngày',
                'UTM',
            ];

        return [
           'Họ tên',
            'SDT',
            'Mã Voucher',
            'Giá trị',
            'Ngày',
            'UTM'
        ];

    }

    public function map($user): array
    {
        
        if( $this->type == 'mom_kid' )
            return [
                $user->full_name,
                $user->phone,
                $user->child_name,
                $user->getChildOld(),
                $user->gift1->title,
                $user->gift_date1,
                $user->utm_mom_kid
            ];

        return [
            $user->full_name,
            $user->phone,
            $user->voucher_id,
            $user->voucher->voucher_value,
            $user->voucher_date,
            $user->utm_voucher
        ];    

    }


    public function collection()
    {
        return $this->data;
    }

  	
}
