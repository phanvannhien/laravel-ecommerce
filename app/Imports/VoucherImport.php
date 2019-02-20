<?php

namespace App\Imports;

use App\Voucher;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Validator;
use Illuminate\Validation\Rule;

class VoucherImport implements ToModel, WithHeadingRow, WithValidation
{
    use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if( $row )
            return new Voucher([
                'program'  => $row['program'],
                'voucher' => $row['voucher'],
                'voucher_value'    => $row['voucher_value'],
            ]);

//        Validator::make($rows->toArray(), [
//            '*.0' => 'required|in:mom_kid,christmas',
//            '*.1' => 'required|unique:vouchers',
//            '*.2' => 'required|numeric',
//        ])->validate();
//
//        foreach ($rows as $row) {
//            Voucher::create([
//                'program'  => $row['program'],
//                'voucher_code' => $row['voucher_code'],
//                'voucher_value'    => $row['voucher_value'],
//            ]);
//        }

    }

    public function rules(): array
    {
        return [
            'program' => 'required|in:mom_kid,christmas',
            'voucher' => 'required|unique:vouchers',
            'voucher_value' => 'required|numeric',
//            'program' => Rule::in(['mom_kid','christmas']),
//            'voucher' => Rule::unique('vouchers','voucher')
        ];
    }

    public function headingRow(): int
    {
        return 1;
    }


}
