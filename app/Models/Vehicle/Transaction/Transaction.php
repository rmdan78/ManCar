<?php

namespace App\Models\Vehicle\Transaction;

use App\Helpers\RandomHelper;
use App\Models\User\User;
use App\Models\Vehicle\Vehicle;
use App\Traits\Models\ChartTrait;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Transaction extends Model
{
    use ChartTrait, HasFactory, HasUuids, SoftDeletes;

    protected $table = 'vehicle_transactions';

    protected $guarded = [
        'id'
    ];

    protected $casts = [
        'used_on'   => 'datetime',
        'ends_on'   => 'datetime',
        'settings'  => 'json',
    ];


    static protected function boot()
    {
        parent::boot();

        parent::creating(function ($model) {
            if (!$model->code)
                $model->code = Str::padRight('ORDER', 20, Str::upper(RandomHelper::code(15)));
        });
    }


    /**
     * Get approver user of the request
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function approver(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    /**
     * Get completer user of the request
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function completer(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    /**
     * Get status of the request
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }


    /**
     * Get user user of the request
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    /**
     * Get vehicle of the request
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }
}
