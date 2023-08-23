<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StripeConnect extends Model
{
    use HasFactory;

    protected $table = 'stripe_connects';
    protected $fillable = [
        'user_id',
        'connect_id',
        'bank_account_id'
    ];
}
