<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Bid;
use App\Models\Chat;
use App\Models\City;
use App\Models\Job;

use App\Models\Profession;
use App\Models\User;
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

        //        dd($request);
        $validator = Validator::make($request->all(), [

            'title' => 'required',
            'date' => 'required',
            'time_of_day' => 'required',
            'online_or_in_person' => 'required',
            'location' => 'required',
            'description' => 'required',
            'budget' => 'required',
        ]);


        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        //        if (!Auth::check()) {
//            $request->session()->put('task_data', $request->all());
//            return redirect()->route('signin')->with('success','Please Login to post job');
//        }
//        else {
//            // if the user is logged in, create the task
        $task = new Job;
        $task->user_id = Auth::id();
        $task->title = $request->input('title');
        $task->date = $request->input('date');
        $task->time_of_day = $request->input('time_of_day');
        $task->online_or_in_person = $request->input('online_or_in_person');
        $task->location = $request->input('location');
        $task->description = $request->input('description');
        $task->budget = $request->input('budget');
        $task->save();
        $check = $task->save();
        if ($check) {
            return redirect()->back()->with('alert', 'Job created successfully!');

        } else {
            return redirect()->back()->with('alert', 'Job did not created successfully!');

        }
        //        }

    }
    public function browse_jobs(Request $request)
    {

        $this->data['categories'] = Profession::get();


        $search = $request->search;

//        dd($search);
//        $this->data['jobs'] = Job::select('jobs.*','jobs.location','jobs.id as jid','users.*','professions.profession')
//            ->join('users', 'users.id', '=', 'jobs.user_id')
//            ->join('professions', 'professions.id', '=', 'users.professions_id')
//            ->where('professions.profession','like','% '.$search.'%')
//        ->get();

        $this->data['jobs'] = Job::select('jobs.*','jobs.id as jid', 'professions.profession')
            ->join('users', 'users.id', '=', 'jobs.user_id')
            ->join('professions', 'professions.id', '=', 'users.professions_id');
//            ->where('professions.profession', 'LIKE', "%{$search}%")
//            ->get();
//dd($this->data['jobs'] );
        $category = $request->category;
        $pay_rate_range = $request->pay_rate_range;
        $location = $request->location;

        if (!empty($search)) {
            $this->data['jobs']->where('professions.profession','LIKE',"%{$search}%");
        }
        if (!empty($category)) {
            $this->data['jobs']->where('professions.id', $category);
        }

        if (!empty($pay_rate_range)) {
            if ($pay_rate_range==0)
            {
                $pay_rate_range = null;
            }
                $this->data['jobs']->where('jobs.budget', '<=', $pay_rate_range);
        }

        if (!empty($location)) {
            $this->data['jobs']->where('jobs.location', 'like', "%{$location}%");
        }

//dd( $this->data['jobs'] );
        $this->data['jobs'] = $this->data['jobs']->orderBy('jobs.created_at', 'desc')->paginate(10);

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
        $this->data['bids'] = Bid::select('bids.*', 'jobs.user_id as jobUserId','u.location', 'u.first_name', 'u.last_name')
            ->where('job_id', $id)
            ->join('users as u', 'u.id', '=', 'bids.user_id')
            ->join('jobs', 'jobs.id', '=', 'bids.job_id')->get();


        $this->data['job']= Job::where('jobs.id', $id)->select('jobs.*','users.first_name','users.last_name')
            ->join('users', 'users.id', '=', 'jobs.user_id')
            ->join('professions', 'users.professions_id', '=', 'professions.id')
            ->first();

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
}
