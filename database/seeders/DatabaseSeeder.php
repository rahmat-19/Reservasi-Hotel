<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::create([
            'email' => 'admin@testing.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'level' => 'admin'
        ]);

        \App\Models\Karyawan::create([
            'nama_lengka' => 'admin',
            'no_hp' =>  "0000000000000",
            'alamat' => 'bumi',
            'jabatan' => 'administrator',
            'user_id' => 1
        ]);
    }
}
