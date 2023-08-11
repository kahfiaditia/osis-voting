<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AkunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('users')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $user = [
            [
                'name' => 'Administrator',
                'email' => 'administrator@gmail.com',
                'password' => bcrypt('12345'),
                'roles' => 'Administrator',
                'nis' => '85898995',
                'nik' => '89565555',
                'email_verified_at' => Carbon::now(),
            ],
            [
                'name' => 'Guru',
                'email' => 'guru@gmail.com',
                'password' => bcrypt('12345'),
                'roles' => 'guru',
                'nis' => '85898995',
                'nik' => '89565555',
                'email_verified_at' => Carbon::now(),
            ],
            [
                'name' => 'Siswa',
                'email' => 'siswa@gmail.com',
                'password' => bcrypt('12345'),
                'roles' => 'siswa',
                'nis' => '85898995',
                'nik' => '89565555',
                'email_verified_at' => Carbon::now(),
            ],
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
