<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;
    protected $table = 'chats';
    protected $fillable =
        [
            'sender_id',
            'receiver_id',
            'message',
            'time_of_job',
            'description',
            'price',
            'reject',
            'accept',
            'status',

        ];
}
