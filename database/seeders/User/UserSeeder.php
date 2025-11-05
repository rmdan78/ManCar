<?php

namespace Database\Seeders\User;

use App\Models\User\User;
use App\Models\User\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->before();
        $roles = Role::oldest()->get();

        $users = [
            [
                'id'            => '9a4e2163-e8b5-4054-81f2-532ad20489fa',
                'employee_id'   => '12345678910',
                'name'          => 'Administrator',
                'username'      => 'admin',
                'email'         => 'admin@example.com',
                'password'      => '$2y$12$Ck4D2nnpoBsFbfbfDEAEEeEUqrC3U8bO8hlRCT4PQgWH2FdYR710O' //password
            ],
            [
                'id'            => 'c12ac881-2be5-43fb-879e-0e7233b94fa7',
                'employee_id'   => '12345678911',
                'name'          => 'User',
                'username'      => 'user',
                'email'         => 'user@example.com',
                'password'      => '$2y$12$Ck4D2nnpoBsFbfbfDEAEEeEUqrC3U8bO8hlRCT4PQgWH2FdYR710O' //password
            ],
        ];

        $users = collect($users)->map(fn ($user, $index) => ([
            ...$user,
            'created_at' => now()->addMinutes($index),
            'updated_at' => now()->addMinutes($index),
        ]));

        User::insert($users->toArray());
        $this->after();
    }


    /**
     * Running before run() method
     */
    public function before(): void
    {
        $this->call([
            RoleSeeder::class,
        ]);
    }


    /**
     * Running after run() method
     */
    public function after(): void
    {
        $this->call([
            UserRoleSeeder::class,
            ProfilePictureSeeder::class,
        ]);
    }
}
