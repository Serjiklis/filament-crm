<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Organization;
use Squire\Models\Country;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Contact extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    public function organization()
    {
        return $this->belongsTo(
            Organization::class,
            'organization_id'
        );
    }
    
     public function countryName()
    {
        return $this->belongsTo(
            Country::class,
            'country',
        );
    }
    
}
