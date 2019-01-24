<?php

use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Appmax\Models\User::class, function (Faker $faker) {
    return [
        'Name' => $faker->name,
        'Email' => $faker->unique()->safeEmail,
        'Password' => Hash::make(123456),
        'RememberToken' => str_random(10),
    ];
});

$factory->define(Appmax\Models\Product::class, function (Faker $faker) {
    $alpha = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','X','Y','Z','W');
    $prefix = $faker->randomElements($alpha, 3, true);
    return [
        'Name' => $faker->sentence,
        'Description' => $faker->text,
        'Amount' => $faker->numberBetween(1, 500),
        'Price' => $faker->randomFloat(2, NULL, 10),
        'Sku' => implode($prefix, "").'-'.$faker->randomNumber(4),
        'MethodInsert' => $faker->randomElements(array(1,2)),
        'IsActive' => $faker->boolean,
        'CreatedAt' => $faker->date('Y-m-d H:i:s')
    ];
});
