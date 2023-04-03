<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
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


        $this->data['jobs'] = Job::select('jobs.*','users.*','professions.*')
            ->join('users', 'users.id', '=', 'jobs.user_id')
            ->join('professions', 'users.professions_id', '=', 'professions.id');

        $search = $request->search;
        $category = $request->category;
        $pay_rate_range = $request->pay_rate_range;
        $location = $request->location;


//        dd($search);
        if (!empty($search)) {
            $this->data['jobs']->where('professions.profession','like','% '.$search.'%')
                ->orwhere('jobs.location', 'like', '%'.$search.'%');
        }
        if (!empty($category)) {
            $this->data['jobs']->where('professions.id', $category);
        }

        if (!empty($pay_rate_range)) {
            $this->data['jobs']->where('jobs.budget', '>=', $pay_rate_range);
        }

        if (!empty($location)) {
            $this->data['jobs']->where('jobs.location', 'like', '%' . $location . '%');
        }

        $this->data['jobs'] = $this->data['jobs']->orderBy('jobs.created_at', 'desc')->paginate(10);

//dd($this->data['jobs']);

        return view('frontend.job.browse_jobs',$this->data);
    }





    public function job_single_view($id)
    {
        $this->data['job'] = Job::select('jobs.*','users.*','jobs.description as desc','users.first_name as fname','users.last_name as lname','professions.*')
            ->join('users', 'users.id', '=', 'jobs.user_id')
            ->join('professions', 'users.professions_id', '=', 'professions.id')
        ->where('jobs.id',$id)->first();
//        dd($this->data['job']);
        return view('frontend.job.job_single_view',$this->data);
    }
}
