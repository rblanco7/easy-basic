<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Applicant extends Model
{
    use HasFactory;
    protected $guarded = [];

/*************Relaciones *********/
    public function Country_birth():BelongsTo
    {
        return $this->belongsTo(Country::class,'country_id_birth');
    }
    public function State_birth():BelongsTo
    {
        return $this->belongsTo(state::class,'state_id_birth');
    }
    public function City_birth():BelongsTo
    {
        return $this->belongsTo(Citie::class,'city_id_birth');
    }
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
    public function Country_physi():BelongsTo
    {
        return $this->belongsTo(Country::class,'country_id_physi');
    }
    public function City_physi():BelongsTo
    {
        return $this->belongsTo(Citie::class,'city_id_physi');
    }
    public function State_physi():BelongsTo
    {
        return $this->belongsTo(state::class,'state_id_physi');
    }
    public function Cases():hasMany
    {
        return $this->hasMany(cases::class,'id');
    }

}
