<?php

namespace Database\Seeders;

use App\Models\Faculte;
use Illuminate\Database\Seeder;

class CreateFacultySeeder extends Seeder
{
    public function run()
    {
        $faculties = [
                ['name' => 'Telekomunikatsiya texnologiyalari'],
                ['name' => 'Axborot xavfsizligi'],
                ['name' => 'Iqtisodiyot']
        ];
        foreach ($faculties as $faculty) {
            Faculte::create($faculty);
        }
    }
}
