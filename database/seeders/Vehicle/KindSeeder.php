<?php

namespace Database\Seeders\Vehicle;

use App\Models\Vehicle\Kind;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KindSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kinds = [
            [
                'id'            => '3cbdcb29-6540-4113-8738-2623b83d4538',
                'name'          => 'Motorcycle',
                'codename'      => 'motorcycle'
            ],
            [
                'id'            => 'eacd81a8-7129-41fe-8a8f-5744050a2b71',
                'name'          => 'Car',
                'codename'      => 'car'
            ],
        ];

        $kinds = collect($kinds)->map(fn($kind, $index) => ([
            ...$kind,
            'created_at' => now()->addMinutes($index),
            'updated_at' => now()->addMinutes($index),
        ]));

        Kind::insert($kinds->toArray());
    }
}
