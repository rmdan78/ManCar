<?php

namespace Database\Seeders\Vehicle\Transaction;

use App\Helpers\RandomHelper;
use App\Models\User\User;
use App\Models\Vehicle\Transaction\Transaction;
use App\Models\Vehicle\Transaction\Status;
use App\Models\Vehicle\Vehicle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->before();
        $users = User::oldest()->get();
        $vehicles = Vehicle::oldest()->get();
        $statuses = Status::oldest()->get();

        $requests = [
            [
                'id'            => 'ae87d087-ee9f-4111-a5ce-d88ece9d5c12',
                'vehicle_id'    => $vehicles[0]->id,
                'user_id'       => $users[1]->id,
                'approver_id'   => null,
                'status_id'     => $statuses[0]->id,
                'code'          => Str::padRight('ORDER', 20, Str::upper(RandomHelper::code(15))),
                'amount'        => 0,
                'description'   => 'Visit to Monas',
                'destination'   => 'Monas, Jakarta Pusat, Jakarta',
                'detail'        => json_encode((object) []),
                'used_on'       => '2024-06-10 09:00:00',
                'ends_on'       => '2024-06-10 10:30:00',
            ],
            [
                'id'            => '60481edc-4b18-4705-808c-265b2b3fd3e3',
                'vehicle_id'    => $vehicles[1]->id,
                'user_id'       => $users[1]->id,
                'approver_id'   => null,
                'status_id'     => $statuses[0]->id,
                'code'          => Str::padRight('ORDER', 20, Str::upper(RandomHelper::code(15))),
                'amount'        => 0,
                'description'   => 'Visit to Vendor',
                'destination'   => 'Tebet Raya, Jakarta Selatan, Jakarta',
                'detail'        => json_encode((object) []),
                'used_on'       => '2024-06-12 13:00:00',
                'ends_on'       => '2024-06-12 15:00:00',
            ],
        ];

        $requests = collect($requests)->map(fn ($request, $index) => ([
            ...$request,
            'created_at' => now()->addMinutes($index),
            'updated_at' => now()->addMinutes($index),
        ]));

        Transaction::insert($requests->toArray());
    }


    /**
     * Running before run() method
     */
    public function before(): void
    {
        $this->call([
            StatusSeeder::class,
        ]);
    }
}
