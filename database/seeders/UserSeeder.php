<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'name' => 'Super Admin',
            'email' => 'admin@rims.co.id',
            'email_verified_at' => now(),
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'remember_token' => \Illuminate\Support\Str::random(10),
            'role_id' => 1
        ]);

        $dataUser = ['Kosasih, SP, MP', 'Daniel Muttaqin, SP, MP', 'Christina Shanti Dewi, SP, MP', 'Yudi Fahriza, SP', 'Ina Prihatina, S.Pi', 'Sugiyanto, SP','M. Noor Eka Dita','Enggi Gumilang','Heru Sumantri, A.md','Ismayadi','Sudirman','Arief Rachman','Yudha Karsa','Maria B Syamnur','Samsudin','Setyo Purwanto','Aprilia Bella Rahmita R','Sundusin'];
        $dataNip = ['19738102000031005', '19821124009031005', '197902132011012001', '197806032001121005', '198301072009032011', '197202121992031005','197406042001121005','198406182009032008','198406182009032008','196905102007011045','197705262008011015','197912142008011015','197303112009011002','197109202010012001','196906302007011016','197810232014011001','199604132024212031','198404232024211005'];
        $dataRank = ['Pembina TK.I', 'Pembina', 'Pembina', 'Penata TK.I', 'Penata TK.I', 'Penata','Penata Muda TK.I','Penata Muda TK.I','Penata Muda','Penata Muda','Penata Muda','Pengatur TK.I','Pengatur TK.I','Pengatur TK.I','Pengatur','Pengatur','P3K','P3K'];
        $dataGroup = ['IV.b', 'IV.a', 'IV.a', 'III.d', 'III.d', 'III.c','III.b','III.b','III.a','III.a','III.a','II.d','II.d','II.d','II.c','II.c','',''];
        $dataPosition = ['Kepala Bidang Produksi Holtikultura', 'Widyaiswara Ahli Madya', 'Widyaiswara Ahli Madya', 'Penelaah Teknis Kebijakan', 'Penelaah Teknis Kebijakan', 'Penelaah Teknis Kebijakan','Pranata Teknologi Komputer','Pengawas Mutu Hasil Pertanian Ahli Pertama','Pengadministrasi Keuangan','Pengadministrasi Sarana dan Prasarana','Pengadministrasi Data Penyajian dan Publikasi','Pengadministrasian Anggaran','Pengadministrasi Data Penyajian dan Publikasi','Pengandministrasian keuangan','Pranata Teknologi Komputer','Pengandministrasian keuangan','Pelaksana','Pelaksana'];

        for ($i = 0; $i < count($dataUser); $i++) {
            $nameWithoutDegree = preg_replace('/,\s?[A-Z]+\.*\s?[A-Z]*/', '', $dataUser[$i]);

            \App\Models\User::create([
                'name' => $dataUser[$i],
                'email' => strtolower(str_replace(' ', '', $nameWithoutDegree)) . '@gmail.com',
                'email_verified_at' => now(),
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
                'remember_token' => \Illuminate\Support\Str::random(10),
                'role_id' => 2,
                'nip' => $dataNip[$i],
                'rank' => $dataRank[$i],
                'group' => $dataGroup[$i],
                'position' => $dataPosition[$i],
            ]);
        }
    }
}
