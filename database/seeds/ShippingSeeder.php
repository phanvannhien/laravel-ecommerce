<?php

use Illuminate\Database\Seeder;

class ShippingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'code' => 'free_shipping',
                'fields' => json_encode([
                    'title' => ['vi' => 'Giao hàng miễn phí','en' => 'Free shipping'],
                    'description' => ['vi' => 'Giao hàng miễn phí','en' => 'Free shipping']
                ]),
                'status' => 1
            ],

            [
                'code' => 'standard',
                'fields' => json_encode([
                    'title' => ['vi' => 'Giao hàng chuẩn','en' => 'Standard shipping'],
                    'description' => ['vi' => 'Giao hàng chuẩn','en' => 'Standard shipping']
                ]),
                'status' => 1
            ],
            [
                'code' => 'giao_hang_tiet_kiem',
                'fields' => json_encode([
                    'title' => ['vi' => 'Giao hàng tiết kiệm','en' => 'GHTK'],
                    'description' => ['vi' => 'Giao hàng tiết kiệm qua giaohangtietkiem.vn','en' => 'Shipping via giaohangtietkiem.vn']
                ]),
                'status' => 1,
                'extracts' => json_encode([
                    'production_url' => 'https://services.giaohangtietkiem.vn',
                    'sandbox_url' => 'https://dev.ghtk.vn',
                    'api_token' => 'a7461495ACd402735C6Dee577AA839fe34B9DAa1',
                    'active_sandbox' => true
                ])
            ],

        ];

        foreach ( $data as $data ){
            App\Models\ShippingMethod::create($data);
        }



    }
}
