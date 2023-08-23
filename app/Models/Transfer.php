<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    use HasFactory;

    protected $table = 'transfers';
    protected $fillable = [
        'buyer_id','seller_id','order_id', 'amount', 'status', // Add other relevant fields
    ];
}
