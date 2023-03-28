<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Job;
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
    public function browse_jobs()
    {
        return view('frontend.job.browse_jobs');
    }
    public function job_single_view()
    {
        return view('frontend.job.job_single_view');
    }
}