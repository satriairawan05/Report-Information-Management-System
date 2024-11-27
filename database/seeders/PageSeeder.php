<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pageNames = ['Report', 'Folder', 'Profile'];
        $actions = ['Create', 'Read', 'Update', 'Delete'];

        foreach ($pageNames as $pageName) {
            foreach ($actions as $action) {
                if ($pageName === 'Profile') {
                    if ($action === 'Read') {
                        \App\Models\Page::create([
                            'page_name' => $pageName,
                            'action' => $action,
                        ]);
                    }

                    if($action === 'Update'){
                        \App\Models\Page::create([
                            'page_name' => $pageName,
                            'action' => $action,
                        ]);
                    }
                } else {
                    \App\Models\Page::create([
                        'page_name' => $pageName,
                        'action' => $action,
                    ]);
                }
            }
        }


        // comment yang atas dan uncomment yang bawah jika mau buka yg download
        // jangan lupa jalankan php artisan migrate:fresh untuk migrasikan yang ada fitur downloadnya
        // $pageNames = ['Report', 'Folder', 'Profile'];
        // $actions = ['Create', 'Read', 'Update', 'Delete'];

        // // Tambahkan aksi "Download" khusus untuk halaman "Report"
        // foreach ($pageNames as $pageName) {
        //     $currentActions = $actions;

        //     // Tambahkan "Download" hanya jika halaman adalah "Report"
        //     if ($pageName === 'Report') {
        //         $currentActions[] = 'Download';
        //     }

        //     foreach ($currentActions as $action) {
        //         // Kondisi khusus untuk halaman "Profile"
        //         if ($pageName === 'Profile') {
        //             if (in_array($action, ['Read', 'Update'])) {
        //                 \App\Models\Page::create([
        //                     'page_name' => $pageName,
        //                     'action' => $action,
        //                 ]);
        //             }
        //         } else {
        //             // Proses halaman lain termasuk "Report"
        //             \App\Models\Page::create([
        //                 'page_name' => $pageName,
        //                 'action' => $action,
        //             ]);
        //         }
        //     }
        // }
    }
}
