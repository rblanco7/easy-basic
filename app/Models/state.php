<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class state extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function Countries():BelongsTo
    {
        return $this->belongsTo(Country::class,'country_id');
    }
    public function Cities():HasMany
    {
        return $this->hasMany(Citie::class,'state_id');
    }
   /* public function Applicants ():hasMany
    {
        return $this->hasMany(Applicant::class,'state_id_mail');
    }*/
}
