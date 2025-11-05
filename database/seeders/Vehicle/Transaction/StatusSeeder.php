<?php

namespace Database\Seeders\Vehicle\Transaction;

use App\Models\Vehicle\Transaction\Status;
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
                'id'            => 'a14f3d11-7b8c-4ba7-834c-ad6e66dab477',
                'name'          => 'Pending',
                'codename'      => 'PENDING',
                'settings'      => json_encode([
                    'color' => '#EAB308',
                ]),
            ],
            [
                'id'            => '650a28c9-b631-4457-892a-4d9e92809ff0',
                'name'          => 'Approved',
                'codename'      => 'APPROVED',
                'settings'      => json_encode([
                    'color' => '#16A34A',
                ]),
            ],
            [
                'id'            => '167fab08-3a97-4d0e-a85e-d89efbd8ca51',
                'name'          => 'Rejected',
                'codename'      => 'REJECTED',
                'settings'      => json_encode([
                    'color' => '#DC2626',
                ]),
            ],
            [
                'id'            => 'c8faebb3-0e31-45a7-9deb-ccbff42888eb',
                'name'          => 'On Going',
                'codename'      => 'ONGOING',
                'settings'      => json_encode([
                    'color' => '#65A30D',
                ]),
            ],
            [
                'id'            => '5f4f5727-e59a-488f-89c0-ff2d43851b82',
                'name'          => 'Completed',
                'codename'      => 'COMPLETED',
                'settings'      => json_encode([
                    'color' => '#2563EB',
                ]),
            ],
            [
                'id'            => '4a74180b-b5a8-4364-8b91-6c27b5b3a418',
                'name'          => 'Expired',
                'codename'      => 'EXPIRED',
                'settings'      => json_encode([
                    'color' => '#991B1B',
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
