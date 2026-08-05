<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'budi@gmail.com'],
            ['username' => 'budi', 'password' => '12345678'],
        );

        User::updateOrCreate(
            ['email' => 'test@example.com'],
            ['username' => 'testuser', 'password' => 'password'],
        );

        $this->call([
            GameSeeder::class,
            StoreSeeder::class,
            MyGameSeeder::class,
        ]);
    }
}
