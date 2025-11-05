<?php

namespace App\Models\Vehicle;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Thumbnail extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $table = 'vehicle_thumbnails';

    protected $guarded = [
        'id'
    ];

    
    /**
     * Get vehicle of the thumbnail 
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function vehicle() :HasOne
    {
        return $this->hasOne(Vehicle::class);
    }
}
