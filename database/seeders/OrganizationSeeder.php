<?php

namespace Database\Seeders;

use App\Models\Organization;
use Illuminate\Database\Seeder;

class OrganizationSeeder extends Seeder
{
    public function run()
    {
        $organizations = [
            [
                'name' => 'Toshkent axborot texnologiyalari',
                'status' => 0,
                'email' => 'tatu@gmail.com',
                'password' => 'tatu123'
            ],
            [
                'name' => 'Urganch davlat universiteti',
                'status' => 1,
                'email' => 'urdutatu@gmail.com',
                'password' => 'urdu123'
            ],
            [
                'name' => 'Toshkent tibbiyot akademiyasi',
                'status' => 0,
                'email' => 'tta@gmail.com',
                'password' => 'tta123'
            ],
        ];
        foreach ($organizations as $org) {
            Organization::create($org);
        }
    }
}
