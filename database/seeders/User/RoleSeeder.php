<?php

namespace Database\Seeders\User;

use App\Models\User\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'id'            => '96b3246d-c9ff-4684-8810-dc5d35fb3919',
                'name'          => 'Super Admin',
                'codename'      => 'SUPERADMIN',
            ],
            [
                'id'            => '15216903-018d-4b19-8441-5581074ad6c5',
                'name'          => 'Admin',
                'codename'      => 'ADMIN',
            ],
            [
                'id'            => '1889afaf-7416-464d-9d63-8eca21aa9194',
                'name'          => 'User',
                'codename'      => 'USER',
            ],
        ];

        $roles = collect($roles)->map(fn($role, $index) => ([
            ...$role,
            'created_at' => now()->addMinutes($index),
            'updated_at' => now()->addMinutes($index),
        ]));

        Role::insert($roles->toArray());
    }
}
