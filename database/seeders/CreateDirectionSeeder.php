<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Direction;

class CreateDirectionSeeder extends Seeder
{
    public function run()
    {
        $direction = [
            ['name' => 'Dasturiy injiniring'],
            ['name' => 'Kompyuter injiniring'],
            ['name' => 'Axborot xavfsizligi'],
            ['name' => 'Pochta aloqasi texnologiyasi']
        ];
        foreach ($direction as $direction) {
            Direction::create($direction);
        }
    }
}
