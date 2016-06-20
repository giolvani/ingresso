<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Models\Organizador::class, function (Faker\Generator $faker) {
    return [
        'nome' => $faker->name
    ];
});

$factory->define(App\Models\Evento::class, function (Faker\Generator $faker) {
    return [
        'nome' => $faker->name,
        'data_inicial' => $faker->dateTimeBetween('1+ days', '+2 months'),
        'data_final' => $faker->dateTimeBetween('1+ days', '+2 months'),
        'descricao' => $faker->text(),
        'lotacao_maxima' => $faker->numberBetween(5, 20),
        'tipo' => $faker->randomElement(['show', 'balada', 'teatro', 'esporte']),
        'publicado' => $faker->boolean()
    ];
});

$factory->define(App\Models\Ingresso::class, function (Faker\Generator $faker) {
    return [
        'codigo' => $faker->unique()->numberBetween(10000000, 99999999),
        'nome' => $faker->name,
        'cpf' => $faker->unique()->numberBetween(10000000000, 99999999999)
    ];
});
