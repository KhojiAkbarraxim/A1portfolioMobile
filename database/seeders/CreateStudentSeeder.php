<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;

class CreateStudentSeeder extends Seeder
{
    public function run()
    {
        $students = [
            [
                'name' => 'Rasulov Jamshid',
                'user_id' => 5,
                'group_id' => 1,
                'phone' => +998995731249,
                'status' => 1,
                'attach_status' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Azizov G\'anisher',
                'user_id' => 6,
                'group_id' => 2,
                'phone' => +998995731248,
                'status' => 1,
                'attach_status' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Xusinov Dilshod',
                'user_id' => 7,
                'group_id' => 3,
                'phone' => +998995731247,
                'status' => 1,
                'attach_status' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];
        foreach ($students as $student) {
            Student::create($student);
        }
    }
}
