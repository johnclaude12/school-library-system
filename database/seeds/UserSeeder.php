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
        App\Model\User::create([
            'user_type' => 1,
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
            'security_question' => 1,
            'security_answer' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'status' => 1,
            'image_id' => 1,
            'remember_token' => Str::random(10)
        ]);
    }
}
