<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class CreateRoleSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            ['name' => 'Iqtidorli talabalar bo\'limi'],
            ['name' => 'Ilmiy rahbar'],
            ['name' => 'Talaba']
        ];
        foreach ($roles as $key => $value) {
            Role::create($value);
        }
    }
}
