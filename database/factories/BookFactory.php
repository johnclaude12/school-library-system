<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Book;
use App\Model\BookCategory;
use Faker\Generator as Faker;

$factory->define(Book::class, function (Faker $faker) {
    return [
        'isbn' => $faker->numberBetween(9827348348,19827348348),
        'call_number' => $faker->creditCardNumber,
        'title' => $faker->word,
        'author' => $faker->name,
        'publisher' => $faker->word,
        'description' => $faker->paragraph,
        'category_id' => function() {
            return BookCategory::all()->random();
        },
        'date_published' => $faker->year,
        'series' => $faker->numberBetween(1,10),
        'price' => $faker->randomDigit,
        'avail_copies' => $faker->numberBetween(10,50),
        'total_copies' => $faker->numberBetween(10,50),
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s')
    ];
});
