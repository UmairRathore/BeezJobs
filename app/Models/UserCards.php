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
        'full_name',
        'expiring',
        'cvv',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
