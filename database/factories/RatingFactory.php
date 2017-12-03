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

$factory->define(App\Rating::class, function (Faker\Generator $faker) {
    return [
        'recipe_id' => function() {
            return factory('App\Recipe')->create()->id;
        },
        'ip' => $faker->ipv4(),
        'rating' => $faker->numberBetween(1, 5),
    ];
});
