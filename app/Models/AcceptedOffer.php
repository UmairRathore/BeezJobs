<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcceptedOffer extends Model
{
    use HasFactory;

    protected $table = 'accepted_offers';
    protected $fillable = [
        'sender_id',
        'reciever_id',
        'date',
        'description',
        'online_or_in_person',
        'location',
        'title',
        'time_of_day',
        'budget'
    ];
}
