<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            ['title' => 'Онлайн', 'handler'=>'status-success' ],
            ['title' => 'Отошел', 'handler'=>'status-warning' ],
            ['title' => 'Занят', 'handler'=>'status-danger' ]
        ];

        foreach ($statuses as $status) {
            Status::create($status);
        }
    }
}
