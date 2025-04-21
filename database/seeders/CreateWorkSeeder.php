<?php

namespace Database\Seeders;

use App\Models\Work;
use Illuminate\Database\Seeder;

class CreateWorkSeeder extends Seeder
{
    public function run()
    {
        $works = [
            [
                'student_id' => 1,
                'type_id' => 1,
                'subject' => 'Mening umumiy baholarim',
                'score' => 0,
                'link' => 'http://instagram.com',
                'status' => 2,
                'desc' => 'baholarim majmui',
                'date' => '2024-10-17',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'student_id' => 2,
                'type_id' => 2,
                'subject' => 'Ilmiy maqola',
                'score' => 10,
                'link' => 'http://telegram.com',
                'status' => 1,
                'desc' => 'Ilmiy maqola bo\'yicha',
                'date' => '2024-10-19',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'student_id' => 3,
                'type_id' => 3,
                'subject' => 'Kompyuter to\'garagidan diplom',
                'score' => 15,
                'link' => 'http://github.com',
                'status' => 1,
                'desc' => 'Diplom to\'garak tomonidan tasdiqlangan',
                'date' => '2024-10-29',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];
        foreach ($works as $key => $value) {
            Work::create($value);
        }
    }
}
