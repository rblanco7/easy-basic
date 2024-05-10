<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class citie extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function Countries():BelongsTo
    {
        return $this->belongsTo(Country::class,'country_id');
    }
    public function States():BelongsTo
    {
        return $this->BelongsTo(State::class,'state_id');
    }
}
