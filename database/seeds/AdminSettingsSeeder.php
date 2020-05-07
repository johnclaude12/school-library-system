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
            [
                'description' => 'No. of Book(s) allow to be borrow',
                'name' => 'no_of_books',
                'required' => 'required',
                'type' => 'number',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'description' => 'No. of day(s) allowed',
                'name' => 'no_of_days',
                'required' => 'required',
                'type' => 'number',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'description' => 'Penalty per day',
                'name' => 'penalty',
                'required' => 'required',
                'type' => 'number',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'description' => 'Grace period after time-in and time-out',
                'name' => 'grace_period',
                'required' => 'required',
                'type' => 'number',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
        ]);
    }
}
