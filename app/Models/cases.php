<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class cases extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function Applicants():BelongsTo
    {
        return $this->belongsTo(Applicant::class,'applicants_id');
    }
    public function TypeCases():BelongsTo
    {
        return $this->belongsTo(typecase::class,'typecases_id');
    }
    public function Preparers():BelongsTo
    {
        return $this->belongsTo(Preparer::class,'preparers_id');
    }
    public function Users():BelongsTo
    {
        return $this->belongsTo(User::class,'users_id');
    }

}
