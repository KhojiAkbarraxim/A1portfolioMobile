<?php

namespace Database\Seeders;

use App\Models\Commission;
use Illuminate\Database\Seeder;

class CreateComissionSeeder extends Seeder
{
    public function run()
    {
        $commissions = [
            [
                'announcement_id' => 1,
                'name' => 'Alisher Sadullayev',
                'phone' => +998995731248,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'announcement_id' => 2,
                'name' => 'Saidbek Abdullayev',
                'phone' => +998912757511,
                'status' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'announcement_id' => 3, 
                'name' => 'Dilshod Davlatov',
                'phone' => +998914554505,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];
        foreach ($commissions as $one) {
            Commission::create($one);
        }
    }
}
