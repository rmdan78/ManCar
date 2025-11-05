<?php

namespace App\Models\Vehicle;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kind extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $table = 'vehicle_kinds';

    protected $guarded = [
        'id'
    ];
    
    
    /**
     * Get vehicles of the kind 
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function vehicles() :HasMany
    {
        return $this->hasMany(Vehicle::class);
    }
}
