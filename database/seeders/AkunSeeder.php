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
                'nis' => '0',
                'nik' => '89565555',
                'address' => 'Jalan Utama',
                'phone' => '08569789744',
                'email_verified_at' => Carbon::now(),
            ],
            [
                'name' => 'Riki',
                'email' => 'riki@gmail.com',
                'password' => bcrypt('12345'),
                'roles' => 'guru',
                'nis' => '0',
                'nik' => '89565555',
                'address' => 'Jalan Hutan Kayu',
                'phone' => '0896566644',
                'email_verified_at' => Carbon::now(),
            ],
            [
                'name' => 'Tania',
                'email' => 'tania@gmail.com',
                'password' => bcrypt('12345'),
                'roles' => 'guru',
                'nis' => '0',
                'nik' => '895675789',
                'address' => 'Jalan Jaksa 7',
                'phone' => '0896547788',
                'email_verified_at' => Carbon::now(),
            ],
            [
                'name' => 'Dani',
                'email' => 'dani@gmail.com',
                'password' => bcrypt('12345'),
                'roles' => 'siswa',
                'nis' => '85898790',
                'nik' => '0',
                'address' => 'Jalan Juni 577',
                'phone' => '08135685577',
                'email_verified_at' => Carbon::now(),
            ],
            [
                'name' => 'Lusi',
                'email' => 'lusi@gmail.com',
                'password' => bcrypt('12345'),
                'roles' => 'siswa',
                'nis' => '85898791',
                'nik' => '0',
                'address' => 'Jalan KH Mustofa',
                'phone' => '0897545554',
                'email_verified_at' => Carbon::now(),
            ],
            [
                'name' => 'Damar',
                'email' => 'damar@gmail.com',
                'password' => bcrypt('12345'),
                'roles' => 'siswa',
                'nis' => '85898996',
                'nik' => '0',
                'address' => 'Jalan Kelapa 2',
                'phone' => '0896633266',
                'email_verified_at' => Carbon::now(),
            ],
            [
                'name' => 'Cerina',
                'email' => 'cerina@gmail.com',
                'password' => bcrypt('12345'),
                'roles' => 'siswa',
                'nis' => '85898997',
                'nik' => '0',
                'address' => 'Jalan Ceria 1',
                'phone' => '08966338998',
                'email_verified_at' => Carbon::now(),
            ],
            [
                'name' => 'Garvi',
                'email' => 'garvi@gmail.com',
                'password' => bcrypt('12345'),
                'roles' => 'siswa',
                'nis' => '85898999',
                'nik' => '0',
                'address' => 'Jalan Ceria 2',
                'phone' => '08966338998',
                'email_verified_at' => Carbon::now(),
            ],
            [
                'name' => 'Kahfi',
                'email' => 'kahfi@gmail.com',
                'password' => bcrypt('12345'),
                'roles' => 'siswa',
                'nis' => '85898785',
                'nik' => '0',
                'address' => 'Jalan Ciuber 7',
                'phone' => '0895556555',
                'email_verified_at' => Carbon::now(),
            ],
            [
                'name' => 'Adinda',
                'email' => 'adinda@gmail.com',
                'password' => bcrypt('12345'),
                'roles' => 'siswa',
                'nis' => '85898786',
                'nik' => '0',
                'address' => 'Jalan Oktober',
                'phone' => '0856655222',
                'email_verified_at' => Carbon::now(),
            ],
            [
                'name' => 'Jery',
                'email' => 'jerian@gmail.com',
                'password' => bcrypt('12345'),
                'roles' => 'siswa',
                'nis' => '85898787',
                'nik' => '0',
                'address' => 'Jalan Oktober 3',
                'phone' => '0856655222',
                'email_verified_at' => Carbon::now(),
            ],
            [
                'name' => 'Kartini',
                'email' => 'kartini@gmail.com',
                'password' => bcrypt('12345'),
                'roles' => 'siswa',
                'nis' => '85898788',
                'nik' => '0',
                'address' => 'Jalan Oktober 6',
                'phone' => '0856658922',
                'email_verified_at' => Carbon::now(),
            ],
            [
                'name' => 'Lisa',
                'email' => 'lisa10@gmail.com',
                'password' => bcrypt('12345'),
                'roles' => 'siswa',
                'nis' => '85898789',
                'nik' => '0',
                'address' => 'Jalan Oktober 8',
                'phone' => '08566563636',
                'email_verified_at' => Carbon::now(),
            ],

        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
