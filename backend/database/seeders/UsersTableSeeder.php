<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['name' => 'Super Admin', 'email' => 'admin@gmail.com', 'password' => bcrypt('123456789')],
            ['name' => 'User 1', 'email' => 'user1@gmail.com', 'password' => bcrypt('123456789')],
            ['name' => 'User 2', 'email' => 'user2@gmail.com', 'password' => bcrypt('123456789')],
        ];

        foreach ($items as $item) {
            User::create($item);
        }
    }
}
