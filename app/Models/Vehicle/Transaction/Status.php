<?php

namespace App\Models\Vehicle\Transaction;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Status extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $table = 'vehicle_transaction_statuses';

    protected $guarded = [
        'id'
    ];

    protected $casts = [
        'settings' => 'json',
    ];

    /**
     * Get transactions of the status 
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transactions() :HasMany
    {
        return $this->hasMany(Transaction::class);
    }
}
