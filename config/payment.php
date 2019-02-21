<?php

return [
    'cashondelivery' => [
        'code' => 'cashondelivery',
        'title' => [
            'en' => 'Cash On Delivery',
            'vi' => 'Thanh toán khi nhận hàng'
        ],
        'description' => [
            'en' => 'Cash On Delivery',
            'vi' => 'Thanh toán khi nhận hàng'
        ],
        'class' => 'App\Payment\CashOnDelivery',
        'active' => true
    ],

    'moneytransfer' => [
        'code' => 'moneytransfer',
        'title' => [
            'en' => 'Money Bank Transfer',
            'vi' => 'Thanh toán chuyển khoản ngân hàng'
        ],
        'banks' => [
            [
                'name' => 'Vietcomnank',
                'acc_number' => '0081001133888',
                'acc_name' => 'Phan Van Nhien',
                'acc_location' => 'Vũng Tàu'
            ],
        ],
        'description' => 'Money Transfer',
        'class' => 'App\Payment\MoneyTransfer',
        'active' => true
    ],

    'paypal_standard' => [
        'code' => 'paypal_standard',
        'title' => [
            'en' => 'Paypal Standard',
            'vi' => 'Thanh toán qua paypal'
        ],
        'description' => 'Paypal Standard',
        'class' => 'App\Payment\Paypal',
        'sandbox' => true,
        'active' => true,
        'business_account' => 'test@webkul.com'
    ],

    'momo' => [
        'code' => 'moo',
        'title' => [
            'en' => 'MoMo Payment',
            'vi' => 'Thanh toán qua MoMo'
        ],
        'description' => '',
        'class' => 'App\Payment\MoMo',
        'sandbox' => true,
        'active' => true,
        'partner_code' => 'MOMOWUYZ20190221',
        'access_key' => 'nwXF4kJmoFUG8aGx',
        'secret_key' => 'eYYFKlI5HymwJhLpU0atrELfT7132tmo',
        'end_point_test' => 'https://test-payment.momo.vn/gw_payment/transactionProcessor',
        'end_point_production' => 'https://payment.momo.vn',
    ],

];

?>