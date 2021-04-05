<?php

use Illuminate\Database\Seeder;
use App\SuratKeluar;
use App\SuratMasuk;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (count(User::get()) == 0) {
            User::insert([
                'name' => 'masbro',
                'email' => 'a@gmail.com',
                'password' => Hash::make(1),
                'pw' => 1,
                'role' => 'user', //author, editor, admin
            ]);
        }

        $faker = Faker\Factory::create('id_ID');
        for ($i = 1; $i <= 500; $i++) {
            SuratMasuk::insert([
                'tanggal_terima' => $faker->date($startDate = '-30 years', $endDate = 'now', $format = 'Y-m-d', $timezone = null),
                'asal_surat' => $faker->text($maxNbChars = 200),
                'nomor_agenda' => $faker->numberBetween($min = 1, $max = 9000),
                'nomor_surat' => $faker->ipv4 . '_tgl_' . $faker->date($format = 'Y-m-d', $max = 'now'),
                'perihal' => $faker->text($maxNbChars = 200),

                'sifat_surat' => $faker->valid()->randomElement($array = array(
                    'Rahasia',
                    'Biasa',
                )),
            ]);
        }
    }
}
