<?php

namespace App\Models\Vehicle;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vehicle extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $guarded = [
        'id'
    ];

    protected $casts = [
        'bought_on' => 'datetime',
    ];


    static protected function boot()
    {
        parent::boot();

        parent::creating(fn($model) => (
            $model->status_id = Status::where('codename', 'AVAILABLE')->first()->id
        ));
    }


    /**
     * Get kind of the vehicle
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kind() :BelongsTo
    {
        return $this->belongsTo(Kind::class);
    }


    /**
     * Get transactions of the vehicle
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transactions() :HasMany
    {
        return $this->hasMany(Transaction\Transaction::class);
    }


    /**
     * Get status of the vehicle
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status() :BelongsTo
    {
        return $this->belongsTo(Status::class);
    }


    /**
     * Get status of the thumbnail
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function thumbnail() :BelongsTo
    {
        return $this->belongsTo(Thumbnail::class);
    }


    /**
     * Get next available timestamps
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function availableAt() :Attribute
    {
        return Attribute::make(
            get: fn() => $this->transactions()
                ->whereDate('used_on', now()->today()->format('Y/m/d'))
                ->whereDate('ends_on', '>=', now())
                ->whereRelation('status', 'codename', 'ONGOING')
                ->oldest()
                ->first()->ends_on ?? null
            ,
        );
    }
}
