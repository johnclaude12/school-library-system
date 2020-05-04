<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'user_type_id' => 1,
            'firstname' => 'John Claude',
            'middlename' => 'Toledo',
            'lastname' => 'Maghanoy',
            'gender' => 'M',
            'contact_no' => 9395782830,
            'birthday' => '1995-08-02',
            'username' => 'johnclaude12',
            'email' => 'johnclaudemaghanoy@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'question_id' => 1,
            'security_answer' => 'beauty',
            'status' => 1,
            'user_image' => null,
            'remember_token' => Str::random(10),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}
