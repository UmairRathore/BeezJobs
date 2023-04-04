<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    use HasFactory;

    protected $table = 'bids';
    protected $fillable = [
        'user_id',
        'job_id',
        'bid_description',
        'bid_budget',
    ];
}
