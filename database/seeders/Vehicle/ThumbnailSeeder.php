<?php

namespace Database\Seeders\Vehicle;

use App\Models\Vehicle\Thumbnail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ThumbnailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $thumbnails = [
            [
                'id'            => '9c0c115c-1559-48aa-a369-c2a34627da8e',
                'uri'           => '/seeders/vehicles/thumbnails/e14c3f34-8b51-418b-bb3a-496d9cfd3ca0.webp',
                'alt'           => 'Vehicle 1',
            ],
            [
                'id'            => '9c0c11ab-c240-4ac9-bbb1-112327720ab5',
                'uri'           => '/seeders/vehicles/thumbnails/995900a1-bad8-468d-a7db-657f1079a760.webp',
                'alt'           => 'Vehicle 2',
            ],
        ];

        $thumbnails = collect($thumbnails)->map(fn($thumbnail, $index) => ([
            ...$thumbnail,
            'created_at' => now()->addMinutes($index),
            'updated_at' => now()->addMinutes($index),
        ]));

        Thumbnail::insert($thumbnails->toArray());
    }
}
