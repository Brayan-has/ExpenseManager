<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Expense extends Model
{
    //
    use HasFactory;
    protected $fillable = [
        "name",
        "description",
        "value",
        "date",
        "status",
        "daily",
        "by_week",
        "by_month",
        "annual",
        "user_id",
        "wallet_id"
    ];

    // Relation with Expense and User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // relation with Expense and Wallet
    public function wallet(): BelongsTo
    {
        return $this->belongsTo(Wallet::class);
    }
}
