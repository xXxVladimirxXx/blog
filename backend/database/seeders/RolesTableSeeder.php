<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['name' => Role::SUPER_ADMIN],
            ['name' => Role::USER],
        ];

        foreach ($items as $item) {
            Role::create($item);
        }
    }
}
