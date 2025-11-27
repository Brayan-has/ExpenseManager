<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Saving extends Model
{

    //this trait has to be here always
    use HasFactory;
    //
    protected $fillable = [
        "project_name",
        "saving_value",
        "status",
        "user_id"
    ];

    //This section is for the relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
