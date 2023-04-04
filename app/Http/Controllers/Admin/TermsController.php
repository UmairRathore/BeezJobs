<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Privacy;
use App\Models\Terms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TermsController extends Controller
{
    //
    //Terms _LIST
    public function index()
    {

        $show = Terms::all();
        return view('backend.terms.terms-list', compact('show'));

    }

//ADD_Terms

    //Add-Terms (page)
    public function create()
    {
        return view('backend.terms.create-terms');
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


        $show = new Terms();
        $show->description = $request->input('description');

        $show->save();
        return back()->with('info_created', 'New Terms has been added Successfully!');
    }


//EDIT_Terms
    public function edit($id)
    {
        $show = Terms::where('id', $id)->first();
        return view('backend.terms.update-terms', compact('show'));
    }


//UPDATE_Terms
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

        $show = Terms::find($id);
        $show->description = $request->input('description');

        //for update in table
        $show->update();
        return back()->with('info_updated', 'Terms Info has been updated successfuly!');
    }
}
