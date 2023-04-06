<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BidController extends Controller
{
    //

//    public function showBid()
//    {
//        $show = Bid::all();
//
//    }

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

        $show = new Bid();
        $show->user_id = auth()->user()->id;
        $show->job_id = $request->input('job_id');
        $show->bid_budget = $request->input('bid_budget');
        $show->bid_description = $request->input('bid_description');

        $show->save();
        return back()->with('info_created', 'You Bid has been added Successfully!');
    }
}
