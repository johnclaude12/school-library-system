<?php

use Illuminate\Database\Seeder;

class AdminSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin_settings')->insert([
            'no_of_books' => 4,
            'no_of_days_allow' => 3,
            'penalty_per_day' => 100,
            'grace_period' => 2,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}
