<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'rahbar']);
        Role::create(['name' => 'talaba']);
        // \App\Models\User::factory(10)->create();
        $this->call(CreateRoleSeeder::class);
        $this->call(CreateUserSeeder::class);
        $this->call(OrganizationSeeder::class);
        $this->call(PaymentSeeder::class);
        $this->call(CreateAnnouncementSeeder::class);
        $this->call(CreateApplicationSeeder::class); 
        $this->call(CreateFacultySeeder::class);
        $this->call(CreateDirectionSeeder::class);
        $this->call(CreateGroupSeeder::class);
        $this->call(CreateDepartmentSeeder::class);
        $this->call(CreateProfessorSeeder::class);
        $this->call(CreateWorkScaleSeeder::class);
        $this->call(CreateWorkTypeSeeder::class);
        $this->call(CreateComissionSeeder::class);
        $this->call(CreateCriteriaSeeder::class);
        $this->call(CreateScoreSeeder::class);    
        $this->call(CreateStudentSeeder::class);                                                                                               
        $this->call(CreateWorkSeeder::class);
        $this->call(CreateAttachSeeder::class);
        $this->call(CreateCommissionScoreSeeder::class);
    }
}
