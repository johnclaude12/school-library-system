<?php

use Illuminate\Database\Seeder;

class SecurityAnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('security_answers')->insert([
            [
                'user_id' => 1,
                'question_id' => 1,
                'answer' => 'beauty',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ]);
    }
}
