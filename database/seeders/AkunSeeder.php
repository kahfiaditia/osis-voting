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
                'name' => 'Riki',
                'email' => 'administrator@gmail.com',
                'password' => bcrypt('12345'),
                'roles' => 'Administrator',
                'nis' => '89565555',
                'pin' => 1234,
                'address' => 'Jalan Utama',
                'phone' => '08569789744',
                'email_verified_at' => Carbon::now(),
            ],
            [
                'name' => 'Olivia Ajeng',
                'email' => 'riki@gmail.com',
                'password' => bcrypt('12345'),
                'roles' => 'guru',
                'nis' => '89565577',
                'pin' => 1234,
                'address' => 'Jalan Hutan Kayu',
                'phone' => '0896566644',
                'email_verified_at' => Carbon::now(),
            ],
            [
                'name' => 'Tania',
                'email' => 'tania@gmail.com',
                'password' => bcrypt('12345'),
                'roles' => 'guru',
                'nis' => '895675789',
                'pin' => 1234,
                'address' => 'Jalan Jaksa 7',
                'phone' => '0896547788',
                'email_verified_at' => Carbon::now(),
            ],
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
