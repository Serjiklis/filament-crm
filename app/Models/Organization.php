<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Account;
use App\Models\Contact;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use Squire\Models\Country;
use App\Models\HasMany;

class Organization extends Model
{
    use HasFactory; 
    use SoftDeletes;
    
    public function account(): BelongsTo
    {
        return $this->belongsTo(
            Account::class,
            'account_id',
        );
    }
    
    public function countryName()
    {
        return $this->belongsTo(
            Country::class,
            'country',
        );
    }
    
    public function contacts()
    {
        return $this->hasMany(
            Contact::class,
            'organization_id',
        );
    }
    
    public function scopeAccount(Builder $builder): Builder
    {
       
        return  $builder->where('account_id', auth()->user()->account_id);
    }
     
}
