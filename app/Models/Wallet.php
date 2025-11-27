<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Project;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
USE Illuminate\Database\Eloquent\Factories\Hasfactory;

class Wallet extends Model
{
    use HasFactory;
    // Protected fillable fields
    protected $fillable = [
        "name",
        "origin",
        "quantity",
        "project_id"
    ];

    // Relation with Project and Wallet
    public function project():BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    
}
