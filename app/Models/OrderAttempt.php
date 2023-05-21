<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderAttempt extends Model
{
    use HasFactory;

    protected $table = 'order_attempts';
    protected $fillable =
        [
          'order_id' ,
          'accepted' ,
          'rejected' ,
          'description' ,
          'order_attempt_file' ,
        ];
}
