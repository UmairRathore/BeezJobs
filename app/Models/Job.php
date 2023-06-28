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
        'budget',
        'hourly_rate',
        'basic_price',
        'basic_description',
        'standard_price',
        'standard_description',
        'premium_price',
        'premium_description',
        'job_type'
    ];

    public static function createRandomJobs($count = 10)
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < $count; $i++) {
            $job = new Job();
            $job->user_id = $faker->numberBetween(16, 31);
            $job->title = $faker->sentence(5);
            $job->date = $faker->dateTimeBetween('+1 week', '+1 month')->format('Y-m-d');
            $job->time_of_day = $faker->randomElement(['Morning', 'Afternoon', 'Evening']);
            $job->online_or_in_person = $faker->randomElement(['Online', 'In_Person']);
            $job->location = $faker->city();
            $job->description = $faker->paragraph(5);
            $job->budget = $faker->randomFloat(2, 100, 1000);
            $job->save();
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
