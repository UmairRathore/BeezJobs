<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    protected $table = 'wallets';
    protected $fillable = [
        'user_id', 'available_balance', 'uncleared_balance','total_earnings' // Add other relevant fields
    ];
}
