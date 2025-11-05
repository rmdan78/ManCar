<?php

namespace Database\Seeders\User;

use App\Models\User\User;
use App\Models\User\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::oldest()->get();
        $roles = Role::oldest()->get();

        $users->where('username', 'admin')
            ->first()
            ->roles()
            ->attach($roles->where('codename', 'ADMIN')->first()->id);

        $users->where('username', 'user')
            ->first()
            ->roles()
            ->attach($roles->where('codename', 'USER')->first()->id);
    }
}
