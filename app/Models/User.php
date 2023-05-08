<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'birthday',
        'tagline',
        'location',
        'role_id',
        'profession_id',
        'pay_rate',
        'websites'
    ];


    public static function createRandomUsers($count = 10)
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < $count; $i++) {
            $user = new User();
            $user->first_name = $faker->firstName();
            $user->last_name = $faker->lastName();
            $user->email = $faker->unique()->safeEmail();
            $user->password = bcrypt('password');
            $user->birthday = $faker->dateTimeBetween('-50 years', '-18 years')->format('Y-m-d');
            $user->tagline = $faker->sentence(10);
            $user->location = $faker->city();
            $user->role_id = $faker->numberBetween(1, 2);
            $user->profession_id = $faker->numberBetween(3, 10);
            $user->pay_rate = $faker->randomFloat(2, 10, 50);
            $user->websites = $faker->url();
            $user->save();
        }
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function profession()
    {
        return $this->belongsTo(Profession::class);
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
