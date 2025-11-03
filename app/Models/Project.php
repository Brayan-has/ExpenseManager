<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Wallet;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    //
    use HasFactory;
    protected $fillable = ["name","description","state","start_date","final_date"];

    // Relations for the projects and wallets
    public function wallet(): HasMany
    {
        return $this->hasMany(Wallet::class);
    }
} 
