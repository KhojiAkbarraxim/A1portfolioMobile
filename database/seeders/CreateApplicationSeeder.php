<?php

namespace Database\Seeders;

use App\Models\Applicationn;
use Illuminate\Database\Seeder;

class CreateApplicationSeeder extends Seeder
{
    public function run()
    {
        $applications = [
            [
                'fullname' => 'Islombek Shomurodov',
                'org_info' => 'Urdu',
                'announcement_id' => 1,
                'phone' => '+998910910330',
                'status' => true,
                'file' => 'file.txt',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'fullname' => 'Jamshid Xojiyev',
                'org_info' => '6-son maktab',
                'announcement_id' => 2,
                'phone' => '+998958562323',
                'status' => false,
                'file' => 'file2.txt',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'fullname' => 'Bobur Bobomurodov',
                'org_info' => 'hech qayerda o\'qimaydi',
                'announcement_id' => 3,
                'phone' => '+998622293382',
                'status' => true,
                'file' => 'file3.txt',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];
        foreach ($applications as $app) {
           Applicationn::create($app);
        }
    }
};
