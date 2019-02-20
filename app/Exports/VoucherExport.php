<?php

namespace App\Exports;

use App\Voucher;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromQuery;

class VoucherExport implements FromQuery, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

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

    public function ids(array $arrIDs)
    {
        $this->ids = $arrIDs;
        return $this;
    }

    public function query()
    {
        if( count($this->ids) > 0 )
            return Voucher::query()->whereIn('id', $this->ids);
        return Voucher::query();
    }


}
