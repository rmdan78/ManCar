<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\Pivot;

class UserRolePivot extends Pivot
{
    use HasUuids;

    public $timestamps = true;
}
