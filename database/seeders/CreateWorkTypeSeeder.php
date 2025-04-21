<?php

namespace Database\Seeders;

use App\Models\Work_type;
use Illuminate\Database\Seeder;

class CreateWorkTypeSeeder extends Seeder
{
    public function run()
    {
        $types = [
            [
                'scale_id' => '3',
                'name' => '5 tashabbus axborot texnologiyalari',
            ],
            [
                'scale_id' => '3',
                'name' => 'Barcha fanlardan o\'zlashtirish ko\'rsatkichi 86-100',
            ],
            [
                'scale_id' => '3',
                'name' => 'Barcha fanlardan o\'zlashtirish ko\'rsatkichi 71-86',
            ],
            [
                'scale_id' => '3',
                'name' => 'Barcha fanlardan o\'zlashtirish ko\'rsatkichi 55-70',
            ]

            ];
            foreach ($types as $key => $value) {
                Work_type::create($value);
            }
    }
}
