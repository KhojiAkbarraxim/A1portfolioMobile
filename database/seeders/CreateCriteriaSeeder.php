<?php

namespace Database\Seeders;

use App\Models\Criteria;
use Illuminate\Database\Seeder;

class CreateCriteriaSeeder extends Seeder
{
    public function run()
    {
        $criteries = [
            [
                'name' => 'mezon 1',
                'announcement_id' => 1,
                'score' => 15,
            ],
            [
                'name' => 'mezon 2',
                'announcement_id' => 2,
                'score' => 17,
            ],
            [
                'name' => 'mezon 3',
                'announcement_id' => 3, 
                'score' => 20,
            ],
        ];
        foreach ($criteries as $one) {
            Criteria::create($one);
        }
    }
}
