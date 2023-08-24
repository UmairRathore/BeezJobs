<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Bid;
use App\Models\Message;
use App\Models\City;
use App\Models\Job;
use Illuminate\Support\Collection;

use App\Models\Profession;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class JobController extends Controller
{
    //

    public function showJob()
    {
        $this->data['categories'] = Profession::all();
        return view('frontend.job.post_a_job', $this->data);
    }

    public function createRandomJobs()
    {

        $zipCityData = [
            '0' => 'New York, NY 10001, USA',
            '1' => 'Miami, FL 33101, USA',
            '2' => 'Richmond, VA 23220, USA',
            '3' => 'New York, NY 10002, USA',
            '4' => 'Brooklyn, NY 11101, USA',
            '5' => 'Norfolk, VA 23454, USA',
            '6' => 'Washington, DC 20002, USA',
            '7' => 'Washington, DC 20001, USA',
            '8' => 'Orlando, FL 33401, USA',
            '9' => 'New York, NY 10003, USA',
            '10' => 'Jacksonville, FL 32210, USA',
            '11' => 'Los Angeles, CA 90001, USA',
            '12' => 'Dallas, TX 75001, USA',
            '13' => 'Chicago, IL 60601, USA',
            '14' => 'San Francisco, CA 94101, USA',
            '15' => 'Cincinnati, OH 42101, USA',
            '16' => 'Houston, TX 76101, USA',
            '17' => 'Seattle, WA 98101, USA',
            '18' => 'Atlanta, GA 31201, USA',
            '19' => 'Indianapolis, IN 46201, USA',
            '20' => 'St. Louis, MO 63101, USA',
            '21' => 'Minneapolis, MN 55401, USA',
            '22' => 'Omaha, NE 60501, USA',
            '23' => 'Denver, CO 81601, USA',
            '24' => 'Phoenix, AZ 85001, USA',
            '25' => 'Sacramento, CA 91601, USA',
            '26' => 'Salt Lake City, UT 80101, USA',
            '27' => 'Detroit, MI 61601, USA',
            '28' => 'Indianapolis, IN 31701, USA',
            '29' => 'Portland, OR 50301, USA',
            '30' => 'Kansas City, MO 64101, USA',
            '31' => 'Wichita, KS 66201, USA',
            '32' => 'Cleveland, OH 33001, USA',
            '33' => 'Des Moines, IA 51501, USA',
            '34' => 'Milwaukee, WI 41401, USA',
            '35' => 'Minneapolis, MN 61201, USA',
            '36' => 'Portland, ME 97201, USA',
            '37' => 'Fort Worth, TX 75201, USA',
            '38' => 'St. Paul, MN 55101, USA',
            '39' => 'Albuquerque, NM 71901, USA',
            '40' => 'Des Moines, IA 50001, USA',
            '41' => 'Long Beach, CA 91701, USA',
            '42' => 'Richmond, VA 80401, USA',
            '43' => 'Omaha, NE 40201, USA',
            '44' => 'Baton Rouge, LA 70101, USA',
        ];


        $jobs = Job::all();


        foreach ($jobs as $job) {
            // Clear the location field for each job
            $job->update([
//                'location' => null,
//                'longitude' => null,
                'latitude' => null,
            ]);
        }
        $numZipCityData = count($zipCityData);

        foreach ($jobs as $index => $job) {
            $location = $zipCityData[$index % $numZipCityData];
            $job->update([
                'location' => $location,
            ]);
        }
        foreach ($zipCityData as $index => $location) {
            if (isset($jobs[$index])) {
                $job = $jobs[$index];
                $job->update([
                    'location' => $location,
                ]);
            }
        }

        foreach ($jobs as $job) {

            $zipCode = $job->location;


            $parts = explode(',', $zipCode);


            $zipCode = trim($parts[0]);


            $apiKey = 'AIzaSyAF0m_0JWZgOmoExRNRO3lwem1yfqJJ6B4'; // Replace with your actual Google API key
            $url = "https://maps.googleapis.com/maps/api/geocode/json?address={$zipCode}&key={$apiKey}";

// Make the API request
            $response = file_get_contents($url);

            if ($response) {
                $data = json_decode($response, true);

                if ($data && $data['status'] === 'OK' && isset($data['results'][0]['geometry']['location'])) {
                    $latitude = $data['results'][0]['geometry']['location']['lat'];
                    $longitude = $data['results'][0]['geometry']['location']['lng'];
                    echo "Latitude: {$latitude}, Longitude: {$longitude}";

                    $job->latitude = $latitude;
                    $job->longitude = $longitude;
                    $job->save();

                    // Now you have the lat and lng values
                } else {
                    echo "Geocoding API request failed or no results found.";
                }
            } else {
                echo "Failed to fetch response from Geocoding API.";
            }
        }
        return 'Job locations updated successfully.';
//
//        $minLatitude = 24.396308;
//        $maxLatitude = 49.384358;
//        $minLongitude = -125.000000;
//        $maxLongitude = -66.934570;
//
//        $jobs = Job::all();
//
//        foreach ($jobs as $job) {
//            $randomLatitude = mt_rand($minLatitude * 1000000, $maxLatitude * 1000000) / 1000000;
//            $randomLongitude = mt_rand($minLongitude * 1000000, $maxLongitude * 1000000) / 1000000;
//
//            // Use the generated latitude and longitude in the API request
//            $url = "https://maps.googleapis.com/maps/api/place/nearbysearch/json?location={$randomLatitude},{$randomLongitude}&radius=100000&type=establishment&key=AIzaSyAF0m_0JWZgOmoExRNRO3lwem1yfqJJ6B4";
//            $curl = curl_init();
//
//            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // Disable SSL certificate verification
//
//            curl_setopt($curl, CURLOPT_URL, $url);
//            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
//
//            $response = curl_exec($curl);

//
//            if ($response === false) {
//                $error = curl_error($curl);
//                // Handle the error
//            } else {
//                $data = json_decode($response, true);

//
//                if ($data['status'] === 'OK' && isset($data['results'][0]['address_components'])) {
//                    $addressComponents = $data['results'][0]['address_components'];
//
//                    $postalCode = null;
//                    $city = null;
//
//                    foreach ($addressComponents as $component) {
//                        if (in_array('postal_code', $component['types'])) {
//                            $postalCode = $component['long_name'];
//                        }
//                        if (in_array('locality', $component['types'])) {
//                            $city = $component['long_name'];
//                        }
//                    }
//
//                    if ($postalCode !== null && $city !== null) {
//                        // Set the job's latitude, longitude, and location with postal code and city
//                        $roundedLatitude = round($randomLatitude, 6);
//                        $roundedLongitude = round($randomLongitude, 6);
//                        $job->latitude = $roundedLatitude;
//                        $job->longitude = $roundedLongitude;
//                        $job->location = $postalCode . ', ' . $city;
//
//                        $job->save();
//                    }
//                }
//            }
//
//            curl_close($curl);
//        }

        return redirect()->back();
    }

    public function createJob(Request $request)
    {
        if (!Auth::check()) {
            // Store the job data in the session
            $jobData = $request->all();

            return redirect()->route('signin')->cookie('service_data', null)->cookie('job_data', json_encode($jobData));
        }


        $validator = Validator::make($request->all(), [

            'title' => 'required',
            'date' => 'required',
//            'time_of_day' => 'required',
            'online_or_in_person' => 'required',
//            'location' => 'required',
            'description' => 'required',
            'budget' => 'required',
//            'profession_id' => 'required|exists:professions,id',

        ]);


        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $task = new Job;
        $task->user_id = Auth::id();
        $task->title = $request->input('title');
        $task->date = $request->input('date');
//        $task->time_of_day = $request->input('time_of_day');
        $task->online_or_in_person = $request->input('online_or_in_person');
        $task->location = $request->input('location');
        $task->latitude = $request->input('latitude');
        $task->longitude = $request->input('longitude');
        $task->description = $request->input('description');
        $task->budget = $request->input('budget');
        $task->profession_id = $request->input('profession_id');
        if ($request->hasfile('file_attachments')) {
            //upload new file
            $file = $request->file('file_attachments');
            $path = 'images/';
//                $extension=$file->getClientOriginalExtension();
            $filename = $path . time() . '.' . $file->getClientOriginalExtension();
            $file->move($path, $filename);
            $task->file_attachments = $filename;
        }

        $check = $task->save();
        if ($check) {
            return redirect()->back()->with('success', 'Job created successfully!');

        } else {
            return redirect()->back()->with('error', 'Job did not created successfully!');

        }
    }

    public function browse_categories()
    {
        $this->data['professions'] = Profession::all();
        return view('frontend.categories.browse_categories', $this->data);
    }

    public function browse_jobs(Request $request, $lat = null, $lng = null)
    {

        $this->data['categories'] = Profession::get();
        $this->data['jobs'] = Job::select('jobs.*', 'professions.profession')
            ->join('professions', 'professions.id', '=', 'jobs.profession_id');
        if ($request->lat && $request->lng && count($request->all()) === 2) {

            $lat = $request->lat;
            $lng = $request->lng;
//
            $jobs = Job::all();


            $nearbyJobs = [];

            foreach ($jobs as $job) {
                $distance = $this->calculateDistance($lat, $lng, $job->latitude, $job->longitude);
                if ($distance <= 10) { // Modify the distance threshold as needed
                    $nearbyJobs[] = $job;
                }
            }

            $jobs = $nearbyJobs;

            $jobIds = collect($jobs)->pluck('id');


            $jobs = Job::select('jobs.*', 'professions.profession')
                ->join('professions', 'jobs.profession_id', '=', 'professions.id')
                ->whereIn('jobs.id', $jobIds)
                ->orderBy('jobs.created_at', 'desc')->paginate(10);
            $job = Job::whereIn('jobs.id', $jobIds)->count();


            if ($job < 0) {
                $this->data['jobs'] = $this->data['jobs']->orderBy('jobs.created_at', 'desc')->paginate(10);
            } else {
                $this->data['jobs'] = $jobs;
            }

        } elseif ($request->online_in_person || $request->search || $request->category || $request->pay_rate_min || $request->pay_rate_max || $request->has('has_bid')) {

            $search = $request->search;
            $category = $request->category;
            $pay_rate_max = $request->pay_rate_max;
            $pay_rate_min = $request->pay_rate_min;
            $online_in_person = $request->online_in_person;
            $location = $request->location;

            $radius = $request->radius;

            $hasBidFilter = $request->has('has_bid');
            if ($hasBidFilter) {
                $this->data['jobs']->leftJoin('bids', 'jobs.id', '=', 'bids.job_id')
                    ->groupBy('jobs.id')
                    ->havingRaw('COUNT(bids.id) > 0');
            }
            if (!empty($search)) {
                $this->data['jobs']->where('professions.profession', 'LIKE', "%{$search}%");
            }
            if (!empty($category)) {
                if (is_array($category)) {
                    $this->data['jobs']->whereIn('professions.id', $category);
                } else {
                    $this->data['jobs']->where('professions.id', $category);
                }
            }

            if (!empty($online_in_person)) {
                if ($online_in_person === 'online') {
                    $this->data['jobs']->where('jobs.online_or_in_person', 'online');
                } elseif ($online_in_person === 'in_person') {
                    $jobsInPerson = Job::select('jobs.*', 'professions.profession')
                        ->join('professions', 'jobs.profession_id', '=', 'professions.id')
                        ->where('online_or_in_person', $online_in_person);

                    $jobsInPersonCount = $jobsInPerson->count();
                    if ($jobsInPersonCount > 0) {
                        if (!empty($location)) {
                            $jobsInLocation = $jobsInPerson->where('jobs.location', 'LIKE', "%{$location}%");
                            $jobsInLocationCount = $jobsInLocation->count();
                            if ($jobsInLocationCount > 0) {
                                if ($request->radius) {

                                    $JobsIds = $jobsInLocation->pluck('id');
//                                    dd($JobsIds);
                                    $jobsInRadius = $jobsInLocation->whereIn('jobs.id', $JobsIds)->get();
                                    $allJobs = Job::all();
                                    $nearbyJobs = [];
                                    foreach ($allJobs as $Joblatandlng) {
                                        $lat = $Joblatandlng->latitude;
                                        $lng = $Joblatandlng->longitude;
                                        foreach ($jobsInRadius as $jobsRadius) {
                                            $distance = $this->calculateDistance($lat, $lng, $jobsRadius->latitude, $jobsRadius->longitude);
                                            if ($distance <= $request->radius) { // Modify the distance threshold as needed
                                                $jobWithDistance = $Joblatandlng;
                                                $jobWithDistance->distance = $distance;
                                                $nearbyJobs[] = $jobWithDistance;
                                            }
                                        }
                                    }
                                    $this->data['users'] = $nearbyJobs;
//                                    dd($this->data['users'] );
                                    $jobIds = collect($this->data['users'])->pluck('id');


                                    $jobs = Job::select('jobs.*', 'professions.profession')
                                        ->join('professions', 'jobs.profession_id', '=', 'professions.id')
                                        ->whereIn('jobs.id', $jobIds);
                                    $job = Job::whereIn('jobs.id', $jobIds)->count();

                                    if ($job < 0) {
                                        $this->data['jobs'] = $this->data['jobs']->orderBy('jobs.created_at', 'desc')->paginate(10);
                                    } else {
                                        $this->data['jobs'] = $jobs;
                                    }
                                    $this->data['user_lat'] = $lat;
                                    $this->data['user_lng'] = $lng;

                                }
                            } else {
                                $this->data['jobs'] = $jobsInLocation;
                            }
                        }

                    } else {
                        $this->data['jobs'] = $jobsInPerson;
                    }
                }
            }

            if (!empty($pay_rate_min)) {
                if ($pay_rate_min == 0) {
                    $pay_rate_min = null;
                } else {
                    $this->data['jobs']->where('jobs.budget', '>=', $pay_rate_min);
                }
            }

            if (!empty($pay_rate_max)) {
                if ($pay_rate_max == 0) {
                    $pay_rate_max = null;
                } else {
                    $this->data['jobs']->where('jobs.budget', '<=', $pay_rate_max);
                }
            }

            $this->data['jobs'] = $this->data['jobs']->orderBy('jobs.created_at', 'Desc')->paginate(10);

        } else {
            if (!auth()->check()) {

                $this->data['jobs'] = $this->data['jobs']->orderBy('jobs.created_at', 'desc')->paginate(10);

                return view('frontend.job.browse_jobs', $this->data);
            } else {

                $user = User::where('id', \auth()->user()->id)->select('longitude', 'latitude')->first();
                $lat = $user->latitude;
                $lng = $user->longitude;
                $jobs = Job::all();


                $nearbyJobs = [];

                foreach ($jobs as $job) {
                    $distance = $this->calculateDistance($lat, $lng, $job->latitude, $job->longitude);
                    if ($distance <= 10) { // Modify the distance threshold as needed
                        $nearbyJobs[] = $job;
                    }
                }

                $jobs = $nearbyJobs;

                $jobIds = collect($jobs)->pluck('id');

                $jobs = Job::select('jobs.*', 'professions.profession')
                    ->join('professions', 'jobs.profession_id', '=', 'professions.id')
                    ->whereIn('jobs.id', $jobIds)
                    ->orderBy('jobs.created_at', 'desc')->paginate(10);
                $job = Job::whereIn('jobs.id', $jobIds)->count();


                if ($job < 0) {
                    $this->data['jobs'] = $this->data['jobs']->orderBy('jobs.created_at', 'desc')->paginate(10);
                } else {
                    $this->data['jobs'] = $jobs;
                }
                $this->data['user_lat'] = $lat;
                $this->data['user_lng'] = $lng;
            }
        }
        return view('frontend.job.browse_jobs', $this->data);
    }

    public function job_single_view($id)
    {

        $this->data['job'] = Job::where('jobs.id', $id)
            ->select('jobs.*', 'users.first_name', 'users.last_name','professions.profession')
            ->join('users', 'users.id', '=', 'jobs.user_id')
            ->join('professions', 'jobs.profession_id', '=', 'professions.id')
            ->first();


        if (Auth::user()) {
            $user_id = Auth::user()->id;
            $authUser = User::where('id', $user_id)->first();

            $authlat = $authUser->latitude;
            $authlan = $authUser->longitude;
//            dd($authlan);
            $joblat = $this->data['job']->latitude;
            $joblng = $this->data['job']->longitude;
//            dd($joblng);
            $nearbyUsers = '';
            $distance = $this->calculateDistance( $joblng, $joblat,$authlan,$authlat,);
//dd($distance);

            $this->data['distance'] = round($distance * 0.62);

        }

        $this->data['bids'] = Bid::select('bids.*', 'jobs.user_id as jobUserId', 'u.location', 'u.first_name', 'u.last_name', 'u.rating')
            ->where('job_id', $id)
            ->join('users as u', 'u.id', '=', 'bids.user_id')
            ->join('jobs', 'jobs.id', '=', 'bids.job_id')->get();


        return view('frontend.job.job_single_view', $this->data);


    }


    public function storeBid(Request $request)
    {


        $validator = Validator::make($request->all(),
            [
                'user_id' => 'required',
                'job_id' => 'required',
                'bid_description' => 'required',
                'bid_budget' => 'required',
            ]);
        if ($validator->fails()) {
            return back()->with('required_fields_empty', 'FIll all the required fields!')
                ->withErrors($validator)
                ->withInput();
        }

        $check = Bid::where('user_id', '=', $request->user_id)->where('job_id', '=', $request->job_id)->first();
        if ($check) {
            return back()->with('required_fields_empty', "Bid placed already. Can't place more than one bid");
        } else {
            $show = new Bid();
            $show->user_id = auth()->user()->id;
            $show->job_id = $request->input('job_id');
            $show->bid_budget = $request->input('bid_budget');
            $show->bid_description = $request->input('bid_description');
            $show->save();
            return back()->with('info_created', 'You Bid has been added Successfully!');
        }
    }


    private function calculateDistance($lat1, $lng1, $lat2, $lng2)
    {
        // Implementation of the Haversine formula to calculate distance between two points

        $earthRadius = 6371; // Radius of the earth in kilometers

        $latDiff = deg2rad($lat2 - $lat1);
        $lngDiff = deg2rad($lng2 - $lng1);

        $a = sin($latDiff / 2) * sin($latDiff / 2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($lngDiff / 2) * sin($lngDiff / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        $distance = $earthRadius * $c; // Distance in kilometers

        return $distance;
    }
}

