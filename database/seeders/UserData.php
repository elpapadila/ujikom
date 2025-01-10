<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserData extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $user = [
            [
                'name' => 'Administrator',
                'username' => 'admin',
                'password' => bcrypt('admin123'),
                'role' => 'admin',
                'email' => 'admin@gmail.com'
            ],
            [
                'name' => 'Kasir',
                'username' => 'kasir',
                'password' => bcrypt('kasir123'),
                'role' => 'kasir',
                'email' => 'kasir@gmail.com'
            ],
            [
                'name' => 'Administrator',
                'username' => 'owner',
                'password' => bcrypt('owner123'),
                'role' => 'owner',
                'email' => 'owner@gmail.com'
            ]
        ];
        foreach($user as $key => $value) {
            User::create($value);
        }
    }
}
