<?php

namespace Database\Seeders;

use App\Models\ExtraModel;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EkstraDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('ekstrakurikuler')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $data = [
            [
                'kode' => 'PMK',
                'name' => 'Pramuka',
                'deskripsi' => 'Kegiatan Pramuka',
                'status' => '1',
                'user_created' => 1,
            ],
            [
                'kode' => 'PKB',
                'name' => 'Paskibraka',
                'deskripsi' => 'Pengibaran Bendera Pusaka',
                'status' => '1',
                'user_created' => 1,
            ],
        ];

        foreach ($data as $key => $value) {
            ExtraModel::create($value);
        }
    }
}
