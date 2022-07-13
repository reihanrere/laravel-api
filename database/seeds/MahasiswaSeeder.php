<?php

use Illuminate\Database\Seeder;
use App\Models\mahasiswa;
use App\User;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'admin',
            'phone' => '0987653234',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin123#'),
            'address' => 'Jl. admin',
            'role' => 'admin',
        ]);
    }
}
