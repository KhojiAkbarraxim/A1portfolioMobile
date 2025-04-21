<?php

namespace Database\Seeders;

use App\Models\Group;
use Illuminate\Database\Seeder;

class CreateGroupSeeder extends Seeder
{
    public function run()
    {
        $groups = [
            [
                'name' => '942-22',
                'faculte_id' => '1',
                'direction_id' => '1'
            ],
            [
                'name' => '931-22',
                'faculte_id' => '1',
                'direction_id' => '1'
            ],
            [
                'name' => '911-22',
                'faculte_id' => '2',
                'direction_id' => '2'
            ],
            [
                'name' => '951-22',
                'faculte_id' => '2',
                'direction_id' => '3'
            ]
        ];
        foreach ($groups as $group) {
            Group::create($group);
        }
    }
}
