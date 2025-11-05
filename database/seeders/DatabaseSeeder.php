<?php

namespace Database\Seeders;

use App\Models\User\User;
use Database\Seeders\User\RoleSeeder;
use Database\Seeders\User\UserSeeder;
use Database\Seeders\Vehicle\Transaction\TransactionSeeder;
use Database\Seeders\Vehicle\VehicleSeeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            VehicleSeeder::class,
            TransactionSeeder::class,
        ]);
    }
}
