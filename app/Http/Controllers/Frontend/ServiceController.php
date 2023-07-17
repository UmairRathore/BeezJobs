<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Bid;
use App\Models\Job;
use App\Models\Profession;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{
    //
    public function showservice()
    {
        if (auth()->check()) {
            $this->data['existingService'] = Job::where('user_id', auth()->user()->id)->whereNotNull('job_type')->first();
            $this->data['heading'] = 'Update Your Services';
        return view('frontend.service.post_a_service', $this->data);
        }else{

        return view('frontend.service.post_a_service');
        }
    }

    public function createRandomservice()
    {
        Job::createRandomservice(11);
        return redirect()->back();
    }

    public function createservice(Request $request)
    {

//        dd($request);
        if (!Auth::check()) {
            $service_data = $request->all();
//            dd($jobData);
            return redirect()->route('signin')->cookie('job_data', null)->cookie('service_data', json_encode($service_data));
        }


        $validator = Validator::make($request->all(), [

            'title' => 'required',
            'description' => 'required',
            'online_or_in_person' => 'required',
//            'location' => 'nullable|required_if:online_or_in_person,in_person',
            'hourly_rate' => 'nullable|numeric',
            'basic_price' => 'nullable|numeric',
            'basic_description' => 'nullable',
//            'standard_price' => 'nullable|numeric',
//            'standard_description' => 'nullable',
//            'premium_price' => 'nullable|numeric',
//            'premium_description' => 'nullable',

        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        $userId = Auth::id();
        $existingService = Job::where('user_id', $userId)->where('job_type', 'service')->first();

        if ($existingService) {
            // Update the existing service
            $existingService->title = $request->input('title');
            $existingService->description = $request->input('description');
            $existingService->online_or_in_person = $request->input('online_or_in_person');
            $existingService->location = $request->input('location');
            $existingService->hourly_rate = $request->input('hourly_rate');
            $existingService->basic_price = $request->input('basic_price');
            $existingService->basic_description = $request->input('basic_description');
            $existingService->standard_price = $request->input('standard_price');
            $existingService->standard_description = $request->input('standard_description');
            $existingService->premium_price = $request->input('premium_price');
            $existingService->premium_description = $request->input('premium_description');

            $check = $existingService->save();
            if ($check) {
                return redirect()->back()->with('success', 'Service updated successfully!');

            } else {
                return redirect()->back()->with('error', 'Service did not updated successfully!');

            }
        } else {
            $service = new Job;
            $service->job_type = 'service';
            $service->user_id = Auth::id();
            $service->title = $request->input('title');
            $service->description = $request->input('description');
            $service->online_or_in_person = $request->input('online_or_in_person');
            $service->location = $request->input('location');
            $service->hourly_rate = $request->input('hourly_rate');
            $service->basic_price = $request->input('basic_price');
            $service->basic_description = $request->input('basic_description');
            $service->standard_price = $request->input('standard_price');
            $service->standard_description = $request->input('standard_description');
            $service->premium_price = $request->input('premium_price');
            $service->premium_description = $request->input('premium_description');
//dd($service);
            $check = $service->save();
//        dd($check);


            if ($check) {
                return redirect()->back()->with('success', 'Service created successfully!');

            } else {
                return redirect()->back()->with('error', 'Service did not created successfully!');

            }
        }
    }

    public function browse_services(Request $request, $lat = null, $lng = null)
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
            $jobs = Job::select('jobs.*', 'jobs.id as jid')->whereIn('user_id', $userIds)->paginate(10);
//            dd($jobs);
            if ($jobs->isEmpty()) {
                $this->data['jobs'] = $this->data['jobs']->orderBy('jobs.created_at', 'desc')->paginate(10);
            } else {
                $this->data['jobs'] = $jobs;
            }

        } else {


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
        return view('frontend.job.browse_jobs', $this->data);
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
        $this->data['bids'] = Bid::select('bids.*', 'jobs.user_id as jobUserId', 'u.location', 'u.first_name', 'u.last_name', 'u.rating')
            ->where('job_id', $id)
            ->join('users as u', 'u.id', '=', 'bids.user_id')
            ->join('jobs', 'jobs.id', '=', 'bids.job_id')->get();


        $this->data['job'] = Job::where('jobs.id', $id)
            ->select('jobs.*', 'users.first_name', 'users.last_name')
            ->join('users', 'users.id', '=', 'jobs.user_id')
//            ->join('professions', 'users.profession_id', '=', 'professions.id')
            ->first();
//        dd($this->data['job']);

        return view('frontend.service.service_single_view', $this->data);


    }
}
