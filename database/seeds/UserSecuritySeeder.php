<?php

use Illuminate\Database\Seeder;

class UserSecuritySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_securities')->insert([
            'user_id' => 1,
            'question_id' => 1,
            'answer' => 'beauty'
        ]);
    }
}
