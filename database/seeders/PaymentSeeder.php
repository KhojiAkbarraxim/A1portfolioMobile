<?php

namespace Database\Seeders;

use App\Models\Payment;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    public function run()
    {
        $payments = [
            [
                'organization_id' => 1,
                'price' => '10$',
                'payment_method' => 'cash'
            ],
            [
                'organization_id' => 2,
                'price' => '10$',
                'payment_method' => 'credit card'
            ],
            [
                'organization_id' => 3, 
                'price' => '10$',
                'payment_method' => 'credit card'
            ]
        ];
        foreach ($payments as $payment) {
            Payment::create($payment);
         }
    }
}
