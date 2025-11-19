<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Wallet;
use App\Models\User;

class Project extends Model
{
    //
    use HasFactory;
    protected $fillable = ["name","description","state","start_date","final_date","user_id"];

    // Relations for the projects and wallets
    public function wallet(): HasMany
    {
        return $this->hasMany(Wallet::class);
    }
    // relation between projects and users
    public function user(): BelongsToMany
    {
        return $this->belongsToMany(User::class,"project_related");        
    }
} 
