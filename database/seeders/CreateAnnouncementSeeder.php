<?php

namespace Database\Seeders;

use App\Models\Announcement;
use Illuminate\Database\Seeder;

class CreateAnnouncementSeeder extends Seeder
{
    public function run()
    {
        $announcements = [
            [
                'name' => 'ICPC 2024-2025 Xalqaro olimpiada',
                'organization_id' => 1,
                'image' => 'rasm.png',
                'thumb_image' => 'qisqarasm',
                'app_begin' => '2024-10-10',
                'app_deadline' => '2024-10-30',
                'selection_begin' => '2024-11-10',
                'selection_date' => '2024-11-30',
                'description' => 'ICPC 2024-2025 Xalqaro olimpiada tugmasini boshlash uchun keling!'
            ],
            [
                'name' => 'startaplar tanlovi',
                'organization_id' => 2,
                'image' => 'rasm.png',
                'thumb_image' => 'qisqarasm',
                'app_begin' => '2024-10-15',
                'app_deadline' => '2024-11-03',
                'selection_begin' => '2024-11-10',
                'selection_date' => '2024-11-30',
                'description' => 'Yo‘nalishlar: — San’at — Dizayn — Moda — O‘yinlar — Interaktiv media — Badiiy kontent yaratish — Aqlli shaharlar va shaharsozlik'
            ],
            [
                'name' => 'Eng faol talaba',
                'organization_id' => 3,
                'image' => 'rasm.png',
                'thumb_image' => 'qisqarasm',
                'app_begin' => '2024-11-15',
                'app_deadline' => '2024-11-20',
                'selection_begin' => '2024-11-21',
                'selection_date' => '2024-11-30',
                'description' => 'Universitetimizdagi eng faol talaba bo\'ling'
            ],
        ];
        foreach ($announcements as $announcement) {
            Announcement::create($announcement);
        }
    }
}
