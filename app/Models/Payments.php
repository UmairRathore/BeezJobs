<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    use HasFactory;

    protected $table = 'payments';
    protected $fillable = [
        'offer_id',
        'admin_id',
        'receiver_id',
        'card_id',
        'amount',
        'status',
    ];

    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function card()
    {
        return $this->belongsTo(UserCards::class);
    }
}
