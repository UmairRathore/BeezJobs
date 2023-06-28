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
        return view('frontend.job.post_a_job');
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


        $validator = Validator::make($request->all(), [

            'title' => 'required',
            'date' => 'required',
            'time_of_day' => 'required',
            'online_or_in_person' => 'required',
//            'location' => 'required',
            'description' => 'required',
            'budget' => 'required',
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
        $task->time_of_day = $request->input('time_of_day');
        $task->online_or_in_person = $request->input('online_or_in_person');
        $task->location = $request->input('location');
        $task->description = $request->input('description');
        $task->budget = $request->input('budget');
//        dd($task);
        $check = $task->save();
//        $check = $task;

        if ($check) {
            return redirect()->back()->with('success', 'Job created successfully!');

        } else {
            return redirect()->back()->with('error', 'Job did not created successfully!');

        }
    }

    public function browse_jobs(Request $request, $lat = null, $lng = null)
    {
        $lat = $request->lat;
        $lng = $request->lng;
        $this->data['categories'] = Profession::get();
        $this->data['jobs'] = Job::select('jobs.*', 'jobs.id as jid', 'professions.profession')
            ->join('users', 'users.id', '=', 'jobs.user_id')
            ->join('professions', 'professions.id', '=', 'users.profession_id');
        if ($lat && $lng) {
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
//            dd($distance);

            $this->data['users'] = $nearbyUsers;
//            dd($this->data['users']);
//dd($this->data['users']->id=1533););
            $userIds = collect($this->data['users'])->pluck('id');
            $jobs = Job::select('jobs.*','jobs.id as jid' )->whereIn('user_id', $userIds)->paginate(10);
//            dd($jobs);
            if ($jobs->isEmpty()) {
                $this->data['jobs'] = $this->data['jobs']->orderBy('jobs.created_at', 'desc')->paginate(10);
            } else {
                $this->data['jobs'] = $jobs;
            }

        }
        else {


            $search = $request->search;
            $category = $request->category;
            $pay_rate_range = $request->pay_rate_range;
            $location = $request->location;
            $start_date = $request->input('start_date');
            $end_date = $request->input('end_date');


            if (!empty($search)) {
                $this->data['jobs']->where('professions.profession', 'LIKE', "%{$search}%");
            }
            if (!empty($category)) {
                $this->data['jobs']->where('professions.id', $category);
            }

            if (!empty($start_date) && !empty($end_date)) {
                // Convert the start and end dates to Carbon instances for proper comparison
                $startDate = Carbon::parse($start_date)->startOfDay();
                $endDate = Carbon::parse($end_date)->endOfDay();

                $this->data['jobs']->whereBetween('date', [$startDate, $endDate]);
            }
            if (!empty($pay_rate_range)) {
                if ($pay_rate_range == 0) {
                    $pay_rate_range = null;
                }
                $this->data['jobs']->where('jobs.budget', '<=', $pay_rate_range);

            }

            if (!empty($location)) {
                $this->data['jobs']->where('jobs.location', 'like', "%{$location}%");
            }

            $this->data['jobs'] = $this->data['jobs']->orderBy('jobs.created_at', 'desc')->paginate(10);
        }
        return view('frontend.job.browse_jobs',$this->data);
    }





    public function job_single_view($id)
    {
//        dd($id);
        if (Auth::user()) {
            $user_id = Auth::user()->id;
        }
//        $this->data['job']

//        dd($this->data['job']);

//        $this->data['bids']
        $this->data['bids'] = Bid::select('bids.*', 'jobs.user_id as jobUserId','u.location', 'u.first_name', 'u.last_name','u.rating')
            ->where('job_id', $id)
            ->join('users as u', 'u.id', '=', 'bids.user_id')
            ->join('jobs', 'jobs.id', '=', 'bids.job_id')->get();


        $this->data['job']= Job::where('jobs.id', $id)
            ->select('jobs.*','users.first_name','users.last_name')
            ->join('users', 'users.id', '=', 'jobs.user_id')
//            ->join('professions', 'users.profession_id', '=', 'professions.id')
            ->first();
//        dd($this->data['job']);

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

            $check = Bid::where('user_id','=',$request->user_id )->where( 'job_id','=',$request->job_id)->first();
        if($check) {
            return back()->with('required_fields_empty', "Bid placed already. Can't place more than one bid");
        }else
            {
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

