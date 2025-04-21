<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class CreateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'email' => 'bolim@gmail.com',
                'role_id' => 1,
                'status' => 1,
                'password' => bcrypt('bolim123'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'email' => 'rahbar@gmail.com',
                'role_id' => 2,
                'status' => 1,
                'password' => bcrypt('rahbar777'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'email' => 'teacher@gmail.com',
                'role_id' => 2,
                'status' => 1,
                'password' => bcrypt('teacher'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'email' => 'ustoz@gmail.com',
                'role_id' => 2,
                'status' => 1,
                'password' => bcrypt('ustoz'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'email' => 'talaba1@gmail.com',
                'role_id' => 3,
                'status' => 1,
                'password' => bcrypt('talaba1'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'email' => 'talaba2@gmail.com',
                'role_id' => 3,
                'status' => 1,
                'password' => bcrypt('talaba2'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'email' => 'talaba3@gmail.com',
                'role_id' => 3,
                'status' => 1,
                'password' => bcrypt('talaba3'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            ];
            foreach ($user as $key => $value) {
                User::create($value);
            }
    }
}
