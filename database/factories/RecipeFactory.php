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

$factory->define(App\Recipe::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->name,
        'slug' => $faker->slug,
        'short_title' => $faker->word,
        'marketing_description' => $faker->sentence,
        'calories_kcal' => $faker->numberBetween(100, 800),
        'protein_grams' => $faker->numberBetween(100, 800),
        'fat_grams' => $faker->numberBetween(100, 800),
        'carbs_grams' => $faker->numberBetween(100, 800),
        'bulletpoint1' => implode(', ', $faker->words(4)),
        'bulletpoint2' => implode(', ', $faker->words(4)),
        'bulletpoint3' => implode(', ', $faker->words(4)),
        'preparation_time_minutes' => $faker->numberBetween(1, 30),
        'shelf_life_days' => $faker->numberBetween(1, 30),
        'in_your_box' => implode(', ', $faker->words(10)),
        'gousto_reference' => $faker->numberBetween(1, 100)
    ];
});
