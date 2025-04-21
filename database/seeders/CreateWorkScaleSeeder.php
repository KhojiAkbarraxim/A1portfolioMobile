<?php

namespace Database\Seeders;

use App\Models\WorkScale;
use Illuminate\Database\Seeder;

class CreateWorkScaleSeeder extends Seeder
{

    public function run()
    {
        $workScale = [
            ['name' => 'Xalqaro'],
            ['name' => 'Mahalliy'],
            ['name' => 'Respublika']
        ];
        foreach ($workScale as $key => $value) {
            WorkScale::create($value);
        }
    }
}
