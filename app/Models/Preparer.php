<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Preparer extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function Country_mail():BelongsTo
    {
        return $this->belongsTo(Country::class,'country_id_mail');
    }
    public function City_mail():BelongsTo
    {
        return $this->belongsTo(Citie::class,'city_id_mail');
    }
    public function State_mail():BelongsTo
    {
        return $this->belongsTo(state::class,'state_id_mail');
    }
    public function Cases():hasMany
    {
        return $this->hasMany(cases::class,'id');
    }

}
