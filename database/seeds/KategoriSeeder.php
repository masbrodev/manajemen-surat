<?php

use Illuminate\Database\Seeder;
use App\Models\Kategori;
use App\User;
use Illuminate\Support\Facades\Hash;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            'name' => 'masbro',
            'email' => 'a@gmail.com',
            'password' => Hash::make(1),
            'pw' => 1,
            'role' => 'user', //author, editor, admin
        ]);
    }
}
