<?php

namespace Database\Seeders;

use App\Models\Expenses;
use App\Models\Users;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Users::factory(10)
            ->has(Expenses::factory()->count(3))
            ->create();
    }
}
