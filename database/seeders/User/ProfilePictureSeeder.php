<?php

namespace Database\Seeders\User;

use App\Models\User\ProfilePicture;
use App\Models\User\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfilePictureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::oldest()->get();
        
        $profilePictures = [
            [
                'id'            => '7b8dd972-4a71-4f6d-a032-5071dae1e449',
                'user_id'       => $users[0]->id,
                'uri'           => '/seeders/users/profilePictures/5d730508-f0cb-4658-9d74-0f688f0c31d9.webp',
                'alt'           => 'User 1',
            ],
            [
                'id'            => '90af6f3d-801f-442e-bb13-51b98b87bec2',
                'user_id'       => $users[1]->id,
                'uri'           => '/seeders/users/profilePictures/35de487d-98f3-4d82-8c51-e26e34a4a323.webp',
                'alt'           => 'User 2',
            ],
        ];

        $profilePictures = collect($profilePictures)->map(fn($thumbnail, $index) => ([
            ...$thumbnail,
            'created_at' => now()->addMinutes($index),
            'updated_at' => now()->addMinutes($index),
        ]));

        ProfilePicture::insert($profilePictures->toArray());
    }
}
