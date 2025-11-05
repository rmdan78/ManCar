<?php

namespace App\Models\User;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\User\Role;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\{BelongsToMany, HasMany, HasOne};
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, HasUuids, Notifiable, SoftDeletes;

    /**
     * The attributes that are guarded from mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [
        'id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    /**
     * Get roles of the user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles() :BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'user_role_pivot', 'user_id', 'role_id')
            ->using(UserRolePivot::class)
            ->withTimestamps();
    }


    /**
     * Get transactions of the user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transactions() :HasMany
    {
        return $this->hasMany(\App\Models\Vehicle\Transaction\Transaction::class);
    }


    /**
     * Get profile picture of the user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function profilePicture() :HasOne
    {
        return $this->hasOne(ProfilePicture::class);
    }


    /**
     * Check the user has administrator role?
     *
     * @return bool
     */
    public function isAdministrator(): bool
    {
        return $this->roles()
            ->where('codename', 'ADMIN')
            ->exists();
    }

    /**
     * Check the user has administrator role?
     *
     * @return bool
     */
    public function isSuperAdministrator(): bool
    {
        return $this->roles()
            ->where('codename', 'SUPERADMIN')
            ->exists();
    }
}
