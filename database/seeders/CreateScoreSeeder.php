<?php

namespace Database\Seeders;

use App\Models\Score;
use Illuminate\Database\Seeder;

class CreateScoreSeeder extends Seeder
{
    public function run()
    {
        $scores = [
            [
                'type_id' => 1,
                'ball' => 5,

            ],
            [
                'type_id' => 2,
                'ball' => 10,

            ],
            [
                'type_id' => 3,
                'ball' => 13,

            ],
        ];
        foreach ($scores as $key => $value) {
            Score::create($value);
        }
    }
}
