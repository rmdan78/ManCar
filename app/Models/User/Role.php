<?php

namespace App\Models\User;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $table = 'user_roles';

    protected $guarded = [
        'id'
    ];


    /**
     * Get the users of the role
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users() :BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_role_pivot', 'role_id', 'user_id')
            ->using(UserRolePivot::class)
            ->withTimestamps();
    }
}
