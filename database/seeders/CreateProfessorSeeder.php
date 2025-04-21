<?php

namespace Database\Seeders;

use App\Models\Professor;
use Illuminate\Database\Seeder;

class CreateProfessorSeeder extends Seeder
{
    public function run()
    {
        $professors = [
            [
                'name' => 'Rasulov Jahongir',
                'department_id' => 1,
                'user_id' => 2,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Azimov Ravshan',
                'department_id' => 2,
                'user_id' => 3,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Xusinov Nodir',
                'department_id' => 3,
                'user_id' => 4,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];
        foreach ($professors as $professor) {
            Professor::create($professor);
        }
    }
}
