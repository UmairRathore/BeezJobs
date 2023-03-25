<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $table = 'jobs';
    protected $fillable = [
        'user_id',
        'title',
        'date',
        'time_of_day',
        'online_or_in_person',
        'location',
        'description',
        'budget'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
