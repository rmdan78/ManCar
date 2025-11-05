<?php

namespace Database\Seeders\Vehicle;

use App\Models\Vehicle\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            [
                'id'            => '2faa5b1f-9b24-4f26-a7fc-0e0a64b2e194',
                'name'          => 'Available',
                'codename'      => 'AVAILABLE',
                'settings'      => json_encode([
                    'color' => '#16A34A'
                ]),
                
            ],
            [
                'id'            => '0403e36f-3281-4ef0-8628-d2ccf6be679e',
                'name'          => 'In Used',
                'codename'      => 'INUSED',
                'settings'      => json_encode([
                    'color' => '#DC2626',
                ]),
            ],
        ];

        $statuses = collect($statuses)->map(fn($statuse, $index) => ([
            ...$statuse,
            'created_at' => now()->addMinutes($index),
            'updated_at' => now()->addMinutes($index),
        ]));

        Status::insert($statuses->toArray());
    }
}
