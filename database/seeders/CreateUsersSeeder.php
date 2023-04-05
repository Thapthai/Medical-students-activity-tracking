<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $user = [
            [
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'is_admin' => '1',
                'password' => bcrypt('123456789')
            ],
            [
                'name' => 'User',
                'email' => 'user@admin.com',
                'is_admin' => '0',
                'password' => bcrypt('password')
            ]
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
