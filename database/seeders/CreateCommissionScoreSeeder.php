<?php

namespace Database\Seeders;

use App\Models\CommissionScore;
use Illuminate\Database\Seeder;

class CreateCommissionScoreSeeder extends Seeder
{
    public function run()
    {
        $comscores = [
            [
                'application_id' => 2,
                'commission_id' => 1,
                'announcement_id' => 1,
                'criteria_id' => 2,
                'score' => 20,
                'desc' => '20 baho uchun izoh',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'application_id' => 1,
                'commission_id' => 2,
                'announcement_id' => 2,
                'criteria_id' => 3,
                'score' => 15,
                'desc' => 'izoh 15 ball uchun',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'application_id' => 3,
                'commission_id' => 3,
                'announcement_id' => 3,
                'criteria_id' => 1,
                'score' => 25,
                'desc' => 'izoh 25 ball uchun',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];
        foreach ($comscores as $cs) {
           CommissionScore::create($cs);
        }
    }
}
