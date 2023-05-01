<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            ['name' => 'user', 'description'=>'user' ],
            ['name' => 'admin', 'description'=>'administrator' ],
            ['name' => 'moderator', 'description'=>'moderator' ],
            ['name' => 'guest', 'description'=>'guest' ],
        ];

        foreach ($statuses as $status) {
            Role::create($status);
        }
    }
}
