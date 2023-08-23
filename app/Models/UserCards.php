<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCards extends Model
{
    use HasFactory;
    protected $table = 'user_cards';
    protected $fillable = [
        'user_id',
        'card_number',
        'account_number',
        'routing_number',
        'full_name',
        'expiring',
        'cvv',
        'ssn_last_4',
        'phone',
        'email',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
