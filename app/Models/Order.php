<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $fillable=
        [
            'offer_id',
            'status',
            'duration',
            'payment',
            'payment_intent_id'
        ];
}
