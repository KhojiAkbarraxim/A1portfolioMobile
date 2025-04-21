<?php

namespace Database\Seeders;

use App\Models\Attach;
use Illuminate\Database\Seeder;

class CreateAttachSeeder extends Seeder
{
    public function run()
    {
        $attaches = [
            [
                'student_id' => 1,
                'teacher_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'student_id' => 2,
                'teacher_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'student_id' => 3,
                'teacher_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];
        foreach ($attaches as $attach) {
            Attach::create($attach);
        }
    }
}
