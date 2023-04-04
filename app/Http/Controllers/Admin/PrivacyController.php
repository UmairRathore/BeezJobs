<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Privacy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PrivacyController extends Controller
{
    //

    //Privacy Policy_LIST
    public function index()
    {

        $show = Privacy::all();
        return view('backend.privacypolicy.privacypolicy-list', compact('show'));

    }

//ADD_Privacy Policy

    //Add-Privacy Policy (page)
    public function create()
    {
        return view('backend.privacypolicy.create-privacypolicy');
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(),
            [
                'description' => 'required',
            ]);


        if ($validator->fails()) {
            return back()->with('required_fields_empty', 'FIll all the required fields!')
                ->withErrors($validator)
                ->withInput();
        }


        $show = new Privacy;
        $show->description = $request->input('description');

        $show->save();
        return back()->with('info_created', 'New Privacy Policy has been added Successfully!');
    }


//EDIT_Privacy Policy
    public function edit($id)
    {
        $show = Privacy::where('id', $id)->first();
        return view('backend.privacypolicy.update-privacypolicy', compact('show'));
    }


//UPDATE_Privacy Policy
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'description' => 'required',

        ]);
        if ($validator->fails()) {
            return back()->with('fields_empty', 'FIll all the required fields!')
                ->withErrors($validator)
                ->withInput();
        }

        $show = Privacy::find($id);
        $show->description = $request->input('description');

        //for update in table
        $show->update();
        return back()->with('info_updated', 'Privacy Policy Info has been updated successfuly!');
    }
}
