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
        'websites',
        'rating'
    ];


    public static function createRandomUsers($count = 10)
    {

        try {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < $count; $i++) {
            $user = new User();
            $user->first_name = $faker->firstName();
            $user->last_name = $faker->lastName();
            $user->email = $faker->unique()->safeEmail();
            $user->password = bcrypt('password');
            $user->role_id = 2;
            $user->profession_id = $faker->numberBetween(3, 10);
            $user->birthday = $faker->date('Y-m-d', '-18 years');
            $user->tagline = $faker->sentence(10);
            $user->location = $faker->city();
            $user->pay_rate = $faker->randomFloat(2, 10, 50);
            $user->websites = $faker->url();
            $user->profile_image = $faker->imageUrl();
            $user->status = $faker->boolean(50);
            $user->rating = $faker->randomFloat(1, 0, 5);
            $user->google_id = $faker->uuid();
            $user->facebook_id = $faker->uuid();
            $user->latitude = $faker->latitude();
            $user->longitude = $faker->longitude();
            $user->facebook_link = $faker->url();
            $user->google_link = $faker->url();
            $user->youtube_link = $faker->url();
            $user->linkedin_link = $faker->url();
            $user->instagram_link = $faker->url();
            $user->twitter_link = $faker->url();
//            $user->remember_token = Str::random(10);
            $user->save();
        }

            // Existing code to create random users
            // ...
        } catch (\Exception $e) {
            // Log the exception for debugging
            \Log::error('Exception while creating random users: ' . $e->getMessage());
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
