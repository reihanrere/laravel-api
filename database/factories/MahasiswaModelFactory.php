<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\mahasiswa;
use Faker\Generator as Faker;

$factory->define(App\Models\mahasiswa::class, function (Faker $faker) {
    return [
        'nama_mahasiswa' => $this->faker->name(),
        'no_telp' => $this->faker->phoneNumber(),
        'email' => $this->faker->unique()->safeEmail,
        'alamat'    => $this->faker->address(),
        'keterangan'     => $this->faker->suffix()
    ];
});
