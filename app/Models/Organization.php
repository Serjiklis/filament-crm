<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Account;
use App\Models\Contact;
use App\Models\Organization;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

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
    
    public function contacts(): HasMany
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
