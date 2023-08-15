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
use Illuminate\Support\Facades\Validator;

class JobController extends Controller
{
    //

    public function showJob()
    {
        $this->data['categories'] = Profession::all();
        return view('frontend.job.post_a_job',$this->data);
    }

    public function createRandomJobs()
    {
        Job::createRandomJobs(11);
        return redirect()->back();
    }

    public function createJob(Request $request)
    {

        if (!Auth::check()) {
            // Store the job data in the session
            $jobData = $request->all();
//            dd($jobData);
            return redirect()->route('signin')->cookie('service_data', null)->cookie('job_data', json_encode($jobData));
        }
//        return $request;
//dd($request);

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
//        if ($request->file('file_attachments')) {
//            $uploadedFile = $request->file('file_attachments');
//            $path = 'jobsFiles/';
//            $filename = time() . '-' . $uploadedFile->getClientOriginalName();
//            $uploadedFile->move($path, $filename);
//            $task->file_attachments = $path . $filename;
//        } else {
//            $task->file_attachments = null;
//        }
//        dd($task);
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

//        dd($request->location);
        $this->data['categories'] = Profession::get();
        $this->data['jobs'] = Job::select('jobs.*', 'jobs.id as jid', 'professions.id as pid', 'professions.profession', 'users.longitude', 'users.latitude')
            ->join('users', 'users.id', '=', 'jobs.user_id')
            ->join('professions', 'professions.id', '=', 'users.profession_id');
//        dd($this->data['jobs'] );
        if ($request->lat && $request->lng && count($request->all()) === 2) {
//            dd('lat and lng hello');
//            dd($request->lat);
//            dd('hello at lng requested');
            $lat = $request->lat;
            $lng = $request->lng;
            $users = User::select('users.*', 'professions.profession as profession_name')
                ->where('status', 1)
                ->where('role_id', 2)
                ->join('professions', 'users.profession_id', '=', 'professions.id')
                ->whereNotNull('latitude')
                ->whereNotNull('longitude')
                ->get();

            $nearbyUsers = [];

            foreach ($users as $user) {
                $distance = $this->calculateDistance($lat, $lng, $user->latitude, $user->longitude);
                if ($distance <= 10000) { // Modify the distance threshold as needed
                    $nearbyUsers[] = $user;
                }
            }

            $this->data['users'] = $nearbyUsers;

            $userIds = collect($this->data['users'])->pluck('id');
            $jobs = Job::select('jobs.*', 'jobs.id as jid', 'users.longitude', 'professions.profession', 'users.latitude')->join('users', 'jobs.user_id', '=', 'users.id')
                ->join('professions', 'professions.id', '=', 'users.profession_id')
                ->whereIn('user_id', $userIds)->paginate(10);

            if ($jobs->isEmpty()) {
                $this->data['jobs'] = $this->data['jobs']->orderBy('jobs.created_at', 'desc')->paginate(10);
            } else {
                $this->data['jobs'] = $jobs;
            }

        }
        elseif ($request->online_in_person || $request->search || $request->category || $request->pay_rate_min || $request->pay_rate_max || $request->has('has_bid')) {

            $search = $request->search;
            $category = $request->category;
            $pay_rate_max = $request->pay_rate_max;
            $pay_rate_min = $request->pay_rate_min;
            $online_in_person = $request->online_in_person;
            $location = $request->location;
//           dd( $location);
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
//dd('hello');
                    $this->data['jobs'] = Job::select('jobs.*', 'jobs.id as jid', 'professions.id as pid', 'professions.profession', 'users.longitude', 'users.latitude')
                        ->join('users', 'users.id', '=', 'jobs.user_id')
                        ->join('professions', 'professions.id', '=', 'users.profession_id');
                    $jobsInPerons = Job::select('jobs.*', 'jobs.id as jid', 'professions.profession', 'users.longitude', 'users.latitude')
                        ->join('users', 'jobs.user_id', '=', 'users.id')
                        ->join('professions', 'professions.id', '=', 'users.profession_id')
                        ->where('online_or_in_person', $online_in_person);

                    $jobsCount = $jobsInPerons->count();
//                    dd($location);
                    if ($jobsCount > 0) {
                        if (!empty($location)) {
                            $jobsLocation = $jobsInPerons->where('jobs.location', 'LIKE', "%{$location}%");
//                            dd($jobsLocation);
                            if ($request->radius) {
                                $users = User::select('users.*', 'professions.profession as profession_name')
                                    ->where('status', 1)
                                    ->where('role_id', 2)
                                    ->join('professions', 'users.profession_id', '=', 'professions.id')
                                    ->whereNotNull('latitude')
                                    ->whereNotNull('longitude')
                                    ->get();
                                $userIds = $jobsLocation->pluck('user_id')->unique()->toArray();
                                $usersSearch = User::whereIn('id', $userIds)->select('id', 'longitude', 'latitude')->get();
                                $nearbyUsers = [];

                                foreach ($usersSearch as $userlatandlng) {
//
                                    $lat = $userlatandlng->latitude;
                                    $lng = $userlatandlng->longitude;
                                    foreach ($users as $userradius) {
                                        $distance = $this->calculateDistance($lat, $lng, $userradius->latitude, $userradius->longitude);
                                        if ($distance <= $request->radius) { // Modify the distance threshold as needed
                                            $userWithDistance = $userlatandlng;
                                            $userWithDistance->distance = $distance;
                                            $nearbyUsers[] = $userWithDistance;
                                        }
                                    }
                                }

                                $this->data['users'] = $nearbyUsers;
//dd($this->data['users']);
                                $userJobs = array_column($this->data['users'], 'id');

                                $jobs = Job::select('jobs.*', 'jobs.id as jid', 'users.longitude', 'users.latitude')
                                    ->join('users', 'jobs.user_id', '=', 'users.id')
                                    ->whereIn('user_id', $userJobs)
                                    ->where('online_or_in_person', $online_in_person);
                                $array=[];
                                $jobs->each(function ($job) {
//                                    dd($job);
                                    foreach ($this->data['users'] as $user) {
//                                        dd($user['id']);
                                        if ($user['id'] == $job->user_id) {
                                            $job->distance = round($user['distance'], 1);;
                                            $array[]= $job->distance;
//                                            dd($job->distance );
                                            break;
                                        }
                                    }
//                                    dd($job->distance );
                                });
//                                dd($jobs);
//                                dd($array);
                                $this->data['jobs'] = $jobs;


                                $jobsCount = Job::select('jobs.*', 'jobs.id as jid', 'users.longitude', 'users.latitude')->join('users', 'jobs.user_id', '=', 'users.id')
                                    ->whereIn('user_id', $userJobs)
                                    ->where('online_or_in_person', $online_in_person)->count();

                                if ($jobsCount == 0) {
                                    $this->data['jobs'] = $this->data['jobs']->where('jobs.online_or_in_person', 'in_person');
                                } else {

                                    $this->data['jobs'] = $jobs;

                                    foreach ($this->data['jobs']  as $job) {
//                                        dd($job->distance);
                                    }
                                }
                                $this->data['user_lat'] = $lat;
                                $this->data['user_lng'] = $lng;

                            }
                        }
                    } else {
                        $this->data['jobs'] = $this->data['jobs']->where('jobs.online_or_in_person', 'in_person');
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
//            dd($this->data['jobs']);

        } else {
            if (!auth()->check()) {

                $this->data['jobs'] = $this->data['jobs']->orderBy('jobs.created_at', 'desc')->paginate(10);

                return view('frontend.job.browse_jobs', $this->data);
            } else {

                $user = User::where('id', \auth()->user()->id)->select('longitude', 'latitude')->first();
                $lat = $user->latitude;
                $lng = $user->longitude;
                $users = User::select('users.*', 'professions.profession as profession_name')
                    ->where('status', 1)
                    ->where('role_id', 2)
                    ->join('professions', 'users.profession_id', '=', 'professions.id')
                    ->whereNotNull('latitude')
                    ->whereNotNull('longitude')
                    ->get();

                $nearbyUsers = [];

                foreach ($users as $user) {
                    $distance = $this->calculateDistance($lat, $lng, $user->latitude, $user->longitude);
                    if ($distance <= 10000) { // Modify the distance threshold as needed
                        $nearbyUsers[] = $user;
                    }
                }

                $this->data['users'] = $nearbyUsers;

                $userIds = collect($this->data['users'])->pluck('id');
                $jobs = Job::select('jobs.*', 'jobs.id as jid', 'users.longitude', 'professions.profession', 'users.latitude')
                    ->join('users', 'jobs.user_id', '=', 'users.id')
                    ->join('professions', 'professions.id', '=', 'users.profession_id')
                    ->whereIn('user_id', $userIds)->paginate(10);

                if ($jobs->isEmpty()) {
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
            ->select('jobs.*', 'users.first_name', 'users.last_name','users.latitude','users.longitude')
            ->join('users', 'users.id', '=', 'jobs.user_id')
//            ->join('professions', 'users.profession_id', '=', 'professions.id')
            ->first();


        if (Auth::user()) {
            $user_id = Auth::user()->id;
            $authUser = User::where('id',$user_id)->first();

            $authlat =$authUser->latitude;
            $authlan =$authUser->longitude;
            $joblat = $this->data['job']->latitude;
            $joblng = $this->data['job']->longitude;
            $nearbyUsers = '';
            $distance = $this->calculateDistance($authlat, $authlan, $joblng,$joblat);
//        dd($distance);

            $this->data['distance'] = round($distance*0.62);

        }

        $this->data['bids'] = Bid::select('bids.*', 'jobs.user_id as jobUserId', 'u.location', 'u.first_name', 'u.last_name', 'u.rating')
            ->where('job_id', $id)
            ->join('users as u', 'u.id', '=', 'bids.user_id')
            ->join('jobs', 'jobs.id', '=', 'bids.job_id')->get();






        return view('frontend.job.job_single_view', $this->data);


    }


    public function storeBid(Request $request)
    {
//dd($request->user_id);


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

