<?php

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
        $this->call([
            UserSeeder::class,
            UserTypeSeeder::class,
            UserSecuritySeeder::class,
            SecurityQuestionSeeder::class,
            SecurityAnswerSeeder::class
        ]);
    }
}
