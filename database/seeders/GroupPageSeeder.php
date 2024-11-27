<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GroupPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Untuk admin (group_id = 1), akses semua page_id dari 1 hingga 10 dengan access = 1
        // tambah 1 jika ingin buka yang download, di 10 di ubah jadi 11
        for ($i = 1; $i <= 10; $i++) {
            \App\Models\GroupPage::create([
                'gp_id' => $i,
                'group_id' => 1, // Admin
                'page_id' => $i,
                'access' => 1, // Selalu akses 1
            ]);
        }

        // Untuk pegawai (group_id = 2), akses page_id dari 12 hingga 22
        // for ($i = 12; $i <= 22; $i++) {
        //     $access = 1; // Default akses untuk pegawai

        //     // Jika page_id adalah 14, 16, atau 17, set access menjadi 0
        //     if (in_array($i, [14, 16, 17])) {
        //         $access = 0;
        //     }

        //     \App\Models\GroupPage::create([
        //         'gp_id' => $i,
        //         'group_id' => 2, // Pegawai
        //         'page_id' => $i,
        //         'access' => $access,
        //     ]);
        // }
    }
}
