<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class CreateDepartmentSeeder extends Seeder
{
    public function run()
    {
        $departments = [
            [
                'faculte_id' => 1,
                'name' => 'Daturiy injiniringi'
            ],
            [
                'faculte_id' => 2,
                'name' => 'Komputer injiniringi'
            ],
            [
                'faculte_id' => 2,
                'name' => 'Axborot xavfsizligi'
            ],
            [
                'faculte_id' => 3,
                'name' => 'Gumanitar'
            ]
        ];
        foreach ($departments as $department) {
            Department::create($department);
        }
    }
}
