<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Organization;
use App\Models\User;
use App\Models\Contact;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Account extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    public function organizations(): HasMany
    {
        return $this->hasMany(
                Organization::class, 
                'account_id',
                );
    }
    
    public function users(): HasMany
    {
        return $this->hasMany(
                User::class, 
                'account_id',
                );
    }
    
    public function contacts(): HasMany
    {
        return $this->hasMany(
                Contact::class, 
                'account_id',
                );
    }
    
}
