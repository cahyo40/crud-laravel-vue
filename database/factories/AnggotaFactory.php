<?php

use Faker\Generator as Faker;

$factory->define(App\Anggota::class, function (Faker $faker) {
    return [
       'nama'   =>  $faker->name,
       'alamat' =>  $faker->city,
       'telepon'    =>  $faker->phoneNumber,
       'email'  => $faker->safeEmail
    ];
});
