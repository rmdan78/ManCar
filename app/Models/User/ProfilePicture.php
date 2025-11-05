<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProfilePicture extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $table = 'user_profile_pictures';

    protected $guarded = [
        'id'
    ];
}
