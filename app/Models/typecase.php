<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class typecase extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function Cases():hasMany
    {
        return $this->hasMany(cases::class,'id');
    }
}
