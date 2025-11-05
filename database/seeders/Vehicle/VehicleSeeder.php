<?php

namespace Database\Seeders\Vehicle;

use App\Models\Vehicle\Kind;
use App\Models\Vehicle\Status;
use App\Models\Vehicle\Thumbnail;
use App\Models\Vehicle\Vehicle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->before();
        $kinds = Kind::oldest()->get();
        $statuses = Status::oldest()->get();
        $thumbnails = Thumbnail::oldest()->get();

        $vehicles = [
            [
                'id'            => 'fad903e5-03cd-4c7c-8ca9-b3b73bc5fa4b',
                'thumbnail_id'  => $thumbnails[0]->id,
                'kind_id'       => $kinds[0]->id,
                'status_id'     => $statuses[0]->id,
                'name'          => 'PCX 160 - ABS',
                'description'   => 'It has red color with black accents',
                'color'         => '#AC1E25',
                'number_plate'  => 'B 4017 SYJ',
                'bought_on'     => '2024-05-10',
            ],
            [
                'id'            => '97bd670a-9ea7-4c85-ba86-68a13a03ab2b',
                'thumbnail_id'  => $thumbnails[1]->id,
                'kind_id'       => $kinds[0]->id,
                'status_id'     => $statuses[0]->id,
                'name'          => 'PCX 160 - CBS',
                'description'   => 'It has silver color with black accents',
                'color'         => '#A0A1A3',
                'number_plate'  => 'B 4019 SYJ',
                'bought_on'     => '2024-05-12',
            ],
        ];

        $vehicles = collect($vehicles)->map(fn($vehicle, $index) => ([
            ...$vehicle,
            'created_at' => now()->addMinutes($index),
            'updated_at' => now()->addMinutes($index),
        ]));

        Vehicle::insert($vehicles->toArray());
    }


    /**
     * Running before run() method
     */
    public function before() :void
    {
        $this->call([
            ThumbnailSeeder::class,
            KindSeeder::class,
            StatusSeeder::class,
        ]);
    }
}
