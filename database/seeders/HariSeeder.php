<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HariSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('table_hari')->insert([
            ['kode' => 1, 'nama_hari' => 'Senin'],
            ['kode' => 2, 'nama_hari' => 'Selasa'],
            ['kode' => 3, 'nama_hari' => 'Rabu'],
            ['kode' => 4, 'nama_hari' => 'Kamis'],
            ['kode' => 5, 'nama_hari' => 'Jumat'],
            ['kode' => 6, 'nama_hari' => 'Sabtu'],
            ['kode' => 7, 'nama_hari' => 'Minggu'],
        ]);
    }
}
