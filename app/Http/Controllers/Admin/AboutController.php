<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class AboutController extends Controller
{

    //About_LIST
    public function index()
    {

        $show = About::all();
        return view('backend.aboutus.aboutus-list', compact('show'));

    }

//ADD_About

    //Add-About (page)
    public function create()
    {
        return view('backend.aboutus.create-aboutus');
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


        $show = new About;
        $show->description = $request->input('description');

        $show->save();
        return back()->with('info_created', 'New About has been added Successfully!');
    }


//EDIT_AboutS
    public function edit($id)
    {
        $show = About::where('id', $id)->first();
        return view('backend.aboutus.update-aboutus', compact('show'));
    }


//UPDATE_AboutS
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

        $show = About::find($id);
        $show->description = $request->input('description');

        //for update in table
        $show->update();
        return back()->with('info_updated', 'About Info has been updated successfuly!');
    }
}
