<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Faker\Factory as Faker;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
    	foreach (range(1,10) as $index) {
            DB::table('books')->insert([
                'isbn' => $faker->numberBetween(9827348348,19827348348),
                'call_number' => $faker->creditCardNumber,
                'title' => $faker->word,
                'author' => $faker->name,
                'publisher' => $faker->word,
                'description' => $faker->paragraph,
                'category_id' => $faker->numberBetween(1,10),
                'date_published' => $faker->year,
                'series' => $faker->numberBetween(1,10),
                'price' => $faker->randomDigit,
                'copies' => $faker->numberBetween(10,50),
                'total_copies' => $faker->numberBetween(10,50),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        }

    }
}
