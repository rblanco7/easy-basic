<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class country extends Model
{
    use HasFactory;

    public function States():hasMany
    {
        return $this->hasMany(State::class,'id');
    }
}
