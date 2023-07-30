<?php

namespace App\Models;
use Illuminate\Support\Facades\File;

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
        'rating',
        'online_status'
    ];

    public function setOnlineStatus($status)
    {
        $this->update(['online_status' => $status]);
    }

    public static function createRandomsUsers($filePath)
    {


            $numberOfUsers = 10;
//        dd($numberOfUsers);

            // Generate a random place using Google Places API
            $minLatitude = -90;
            $maxLatitude = 90;
            $minLongitude = -180;
            $maxLongitude = 180;
            $faker = \Faker\Factory::create();
            for ($i = 0; $i < $numberOfUsers; $i++) {
                $randomLatitude = mt_rand($minLatitude * 1000000, $maxLatitude * 1000000) / 1000000;
                $randomLongitude = mt_rand($minLongitude * 1000000, $maxLongitude * 1000000) / 1000000;

// Use the generated latitude and longitude in the API request
                $url = "https://maps.googleapis.com/maps/api/place/nearbysearch/json?location={$randomLatitude},{$randomLongitude}&radius=100000&type=establishment&key=AIzaSyAF0m_0JWZgOmoExRNRO3lwem1yfqJJ6B4";
                $curl = curl_init();

                curl_setopt($curl, CURLOPT_URL, $url);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // Disable SSL certificate verification

                $response = curl_exec($curl);
//            dd($response);

                if ($response === false) {
                    $error = curl_error($curl);
                    // Handle the error
                } else {
                    // Process the response
                    $data = json_decode($response, true);


//                dd($data);
                // Retrieve the area name or city name from the geocoding results
                if ($data['status'] === 'OK' && isset($data['results'][0])) {
                    $addressComponents = $data['results'][0]['address_components'];

                    // Search for the area name or city name in the address components
                    $areaName = '';
                    foreach ($addressComponents as $component) {
                        if (in_array('locality', $component['types'])) {
                            $areaName = $component['long_name'];
                            break;
                        }
                    }

                    // Create a new user with the generated location details
                    $user = new User();
                    $user->first_name = $faker->firstName();
                    $user->last_name = $faker->lastName();
                    $user->email = $faker->unique()->safeEmail();
                    $user->password = bcrypt('password');
                    $user->role_id = 2;
                    $user->profession_id = $faker->numberBetween(3, 10);
                    $user->birthday = $faker->date('Y-m-d', '-18 years');
                    $user->tagline = $faker->sentence(10);
                    $user->location = $areaName;
                    $user->pay_rate = $faker->randomFloat(2, 10, 50);
                    $user->websites = $faker->url();
                    $user->profile_image = $faker->imageUrl();
                    $user->status = $faker->boolean(50);
                    $user->rating = $faker->randomFloat(1, 0, 5);
                    $user->google_id = $faker->uuid();
                    $user->facebook_id = $faker->uuid();
                    $user->latitude = $randomLatitude;
                    $user->longitude = $randomLongitude;
                    $user->facebook_link = $faker->url();
                    $user->google_link = $faker->url();
                    $user->youtube_link = $faker->url();
                    $user->linkedin_link = $faker->url();
                    $user->instagram_link = $faker->url();
                    $user->twitter_link = $faker->url();

                    $user->save();
                }
            }
            }
            return redirect()->back();


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
//public static function createRandomsUsers()
//{
//    try {
//        $faker = \Faker\Factory::create();
//        $data = [
//            "Toronto,Canada,43.6532,-79.3832", "Montreal,Canada,45.5000,-73.5667",
//            "Vancouver,Canada,49.2827,-123.1207", "Ottawa,Canada,45.4219,-75.6958",
//            "Calgary,Canada,51.0498,-114.0625", "Winnipeg,Canada,49.8833,-97.1333",
//            "Edmonton,Canada,53.5500,-113.4833", "Québec City,Canada,46.7750,-71.2500",
//            "Hamilton,Canada,43.2500,-79.5000", "Halifax,Canada,44.6481,-63.5833", "Mexico City,Mexico,19.4333,-99.1333", "Guadalajara,Mexico,20.6944,-103.3444", "Monterrey,Mexico,25.6944,-100.3333", "Cancun,Mexico,21.0666,-86.8166", "Puebla,Mexico,19.0666,-98.1833", "Tijuana,Mexico,32.5222,-117.0222", "León,Mexico,20.6666,-101.1666", "Morelia,Mexico,19.6944,-101.1333", "Hermosillo,Mexico,29.1166,-111.6166", "Oaxaca,Mexico,17.0500,-96.7500",
//            "London,United Kingdom,51.5074,-0.1278", "Manchester,United Kingdom,53.4839,-2.2446",
//            "Birmingham,United Kingdom,52.4862,-1.8904", "Glasgow,United Kingdom,55.8642,-4.2518",
//            "Liverpool,United Kingdom,53.4084,-2.9916", "Edinburgh,United Kingdom,55.9533,-3.1883", "Bristol,United Kingdom,51.4545,-2.5879", "Leeds,United Kingdom,53.8008,-1.5491", "Sheffield,United Kingdom,53.3811,-1.4701", "Cardiff,United Kingdom,51.4816,-3.1791", "Paris,France,48.8566,2.3522", "Marseille,France,43.2964,5.3690", "Lyon,France,45.75,4.85", "Toulouse,France,43.6045,1.4440", "Nice,France,43.7102,7.2619", "Nantes,France,47.2181,-1.5528", "Strasbourg,France,48.5839,7.7455", "Montpellier,France,43.6110,3.8767", "Bordeaux,France,44.8378,-0.5792", "Lille,France,50.6292,3.0573", "Berlin,Germany,52.5200,13.4050", "Hamburg,Germany,53.5511,9.9937", "Munich,Germany,48.1351,11.5820", "Cologne,Germany,50.9375,6.9603", "Frankfurt,Germany,50.1109,8.6821", "Stuttgart,Germany,48.7758,9.1829", "Düsseldorf,Germany,51.2277,6.7735", "Dortmund,Germany,51.5136,7.4653", "Essen,Germany,51.4556,7.0116", "Dresden,Germany,51.0504,13.7373", "Barcelona,Spain,41.3851,2.1734", "Madrid,Spain,40.4168,-3.7038", "Valencia,Spain,39.4699,-0.3763", "Seville,Spain,37.3891,-5.9845", "Zaragoza,Spain,41.6488,-0.8891", "Málaga,Spain,36.7213,-4.4213", "Murcia,Spain,37.9838,-1.1293", "Palma de Mallorca,Spain,39.5696,2.6502", "Las Palmas de Gran Canaria,Spain,28.1237,-15.4360", "Bilbao,Spain,43.2630,-2.9340", "Rome,Italy,41.9028,12.4964", "Milan,Italy,45.4642,9.1900", "Naples,Italy,40.8522,14.2681", "Turin,Italy,45.0703,7.6869", "Palermo,Italy,38.1157,13.3613", "Genoa,Italy,44.4056,8.9463", "Bologna,Italy,44.4949,11.3426", "Florence,Italy,43.7696,11.2558", "Venice,Italy,45.4408,12.3155", "Verona,Italy,45.4384,10.9916", "Amsterdam,Netherlands,52.3676,4.9041", "Rotterdam,Netherlands,51.9225,4.47917", "The Hague,Netherlands,52.0705,4.3007", "Utrecht,Netherlands,52.0907,5.1214", "Eindhoven,Netherlands,51.4416,5.4697", "Tilburg,Netherlands,51.5555,5.0913", "Groningen,Netherlands,53.2194,6.5665", "Almere,Netherlands,52.3500,5.2642", "Breda,Netherlands,51.5831,4.7764", "Nijmegen,Netherlands,51.8126,5.8372", "Stockholm,Sweden,59.3293,18.0686", "Gothenburg,Sweden,57.7089,11.9746", "Malmö,Sweden,55.6040,13.0038", "Uppsala,Sweden,59.8586,17.6389", "Linköping,Sweden,58.4108,15.6214", "Västerås,Sweden,59.6162,16.5528", "Örebro,Sweden,59.2753,15.2134", "Helsingborg,Sweden,56.0467,12.6944", "Jönköping,Sweden,57.7826,14.1612", "Norrköping,Sweden,58.5877,16.1920", "Oslo,Norway,59.9139,10.7522", "Bergen,Norway,60.3913,5.3221", "Stavanger,Norway,58.9699,5.7331", "Trondheim,Norway,63.4305,10.3951", "Drammen,Norway,59.7425,10.2045", "Fredrikstad,Norway,59.2181,10.9298", "Kristiansand,Norway,58.1462,7.9956", "Tromsø,Norway,69.6496,18.9560", "Aberdeen,United Kingdom,57.1497,-2.0943", "Edinburgh,United Kingdom,55.9533,-3.1883", "Glasgow,United Kingdom,55.8642,-4.2518", "Dundee,United Kingdom,56.4620,-2.9707", "Inverness,United Kingdom,57.4778,-4.2247", "Perth,United Kingdom,56.3970,-3.4346", "Stirling,United Kingdom,56.1165,-3.9369", "Dunfermline,United Kingdom,56.0717,-3.4523", "Kirkcaldy,United Kingdom,56.1160,-3.1597", "Galway,Ireland,53.2707,-9.0568", "Dublin,Ireland,53.3498,-6.2603", "Cork,Ireland,51.8969,-8.4863", "Limerick,Ireland,52.6638,-8.6267", "Derry,United Kingdom,54.9966,-7.3086", "Belfast,United Kingdom,54.5973,-5.9301", "Newcastle upon Tyne,United Kingdom,54.9783,-1.6170", "Cardiff,United Kingdom,51.4816,-3.1791", "Swansea,United Kingdom,51.6214,-3.9436", "Bristol,United Kingdom,51.4545,-2.5879", "Southampton,United Kingdom,50.9097,-1.4044", "Portsmouth,United Kingdom,50.8160,-1.1084", "Bournemouth,United Kingdom,50.7192,-1.8808", "Brighton,United Kingdom,50.8225,-0.1372", "Leicester,United Kingdom,52.6369,-1.1398", "Nottingham,United Kingdom,52.9548,-1.1581", "Coventry,United Kingdom,52.4068,-1.5197", "Birmingham,United Kingdom,52.4862,-1.8904", "Leeds,United Kingdom,53.8008,-1.5491", "Manchester,United Kingdom,53.4839,-2.2446", "Liverpool,United Kingdom,53.4084,-2.9916", "Sheffield,United Kingdom,53.3811,-1.4701", "New York,United States,40.7127,-74.0059", "Los Angeles,United States,34.0522,-118.2437", "Chicago,United States,41.8781,-87.6298", "Houston,United States,29.7604,-95.3698", "Phoenix,United States,33.4484,-112.0740", "San Francisco,United States,37.7749,-122.4194", "Philadelphia,United States,39.9526,-75.1652", "San Antonio,United States,29.4241,-98.4936", "Dallas,United States,32.7767,-96.7970", "Austin,United States,30.2672,-97.7431", "San Diego,United States,32.7157,-117.1611", "Boston,United States,42.3601,-71.0589", "Seattle,United States,47.6062,-122.3321", "Denver,United States,39.7392,-104.9903",
//            "Washington, D.C.,United States,38.9072,-77.0369",
//        ];
//        foreach ($data as $dataa) {
//            $parts = explode(',', $dataa);
//            $city = $parts[0];
//            $country = $parts[1];
//            $latitude = $parts[2];
//            $longitude = $parts[3];
//
//            $user = new User();
//            $user->first_name = $faker->firstName();
//            $user->last_name = $faker->lastName();
//            $user->email = $faker->unique()->safeEmail();
//            $user->password = bcrypt('password');
//            $user->role_id = 2;
//            $user->profession_id = $faker->numberBetween(3, 10);
//            $user->birthday = $faker->date('Y-m-d', '-18 years');
//            $user->tagline = $faker->sentence(10);
//            $user->location = $city . ',' . $country;
//            $user->pay_rate = $faker->randomFloat(2, 10, 50);
//            $user->websites = $faker->url();
//            $user->profile_image = $faker->imageUrl();
//            $user->status = $faker->boolean(50);
//            $user->rating = $faker->randomFloat(1, 0, 5);
//            $user->google_id = $faker->uuid();
//            $user->facebook_id = $faker->uuid();
//            $user->latitude = $latitude;
//            $user->longitude = $longitude;
//            $user->facebook_link = $faker->url();
//            $user->google_link = $faker->url();
//            $user->youtube_link = $faker->url();
//            $user->linkedin_link = $faker->url();
//            $user->instagram_link = $faker->url();
//            $user->twitter_link = $faker->url();
//            $user->save();
//        }
//    } catch (\Exception $e) {
//        // Log the exception for debugging
//        \Log::error('Exception while creating random users: ' . $e->getMessage());
//    }
//}
