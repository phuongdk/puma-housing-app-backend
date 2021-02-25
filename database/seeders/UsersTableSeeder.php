<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        // Admin
        User::create([
            'first_name' => env('SEEDER_USER_FIRST_NAME', 'Phuong'),
            'last_name' => env('SEEDER_USER_LAST_NAME', 'Do'),
            'username' => env('SEEDER_USER_USERNAME', 'admin'),
            'password' => bcrypt((env('SEEDER_USER_PASSWORD', 'admin'))),
            'email' => 'phuongdkk@gmail.com',
						'is_admin' => true,
						'is_agent' => false,
        ]);

        // Agent
        User::create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'username' => 'agent',
            'password' => bcrypt('123456'),
						'email' => 'johndoe@example.com',
						'is_admin' => false,
            'is_agent' => true,
        ]);
    }
}
