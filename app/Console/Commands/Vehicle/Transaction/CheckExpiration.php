<?php

namespace App\Console\Commands\Vehicle\Transaction;

use App\Models\Vehicle\Transaction\{Status, Transaction};
use Illuminate\Console\Command;

class CheckExpiration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-transaction-expiration';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check and change status of pending vehicle transactios when it was expired';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $EXPIRED_ID = Status::where('codename', 'EXPIRED')->first()->id;
        $PENDING_ID = Status::where('codename', 'PENDING')->first()->id;

        Transaction::where('used_on', '<=', now())
            ->where('status_id', $PENDING_ID)
            ->update([
                'status_id' => $EXPIRED_ID,
            ]);

        $this->info('DONE');
    }
}
