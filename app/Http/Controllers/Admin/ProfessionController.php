<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ProfessionController extends Controller
{
    //Profession_LIST
    public function index()
    {

        $show = Profession::all();

        return view('backend.profession.profession-list', compact('show'));

    }

    //Add-Profession (page)
    public function create()
    {
        return view('backend.profession.create-profession');
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(),
            [
                'profession' => 'required',
                'detail' => 'required',
                'p_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);


        if ($validator->fails()) {
            return back()->with('required_fields_empty', 'FIll all the required fields!')
                ->withErrors($validator)
                ->withInput();
        }


        $show = new Profession;
        $show->profession = $request->input('profession');
        $show->detail = $request->input('detail');
        if ($request->hasfile('p_image')) {
            //upload new file
            $file = $request->file('p_image');
            $path = 'images/';
//                $extension=$file->getClientOriginalExtension();
            $filename = $path . time() . '-' . $file->getClientOriginalName();
            $file->move($path, $filename);
            $show->p_image = $filename;
        }
        else
        {

            $show->p_image = 'default-image.png';
        }

        $show->save();
        return back()->with('info_created', 'New Profession has been added Successfully!');
    }


//EDIT_ProfessionS
    public function edit($id)
    {
        $show = Profession::where('id', $id)->first();
        return view('backend.profession.update-profession', compact('show'));
    }


//UPDATE_ProfessionS
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'profession' => 'required',
            'detail' => 'required',
            'p_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);
        if ($validator->fails()) {
            return back()->with('fields_empty', 'FIll all the required fields!')
                ->withErrors($validator)
                ->withInput();
        }

        $show = Profession::find($id);
        $show->profession = $request->input('profession');
        $show->detail = $request->input('detail');

        if ($request->hasfile('p_image')) { //code for remove old file
            $destination = $show->p_image;
//            dd($destination);
            if (File::exists($destination)) {
                File::delete($destination);
            }

            //upload new file
            $file = $request->file('p_image');
            $path = 'images/';
//                $extension=$file->getClientOriginalExtension();
            $filename = $path . time() . '-' . $file->getClientOriginalName();
            $show->p_image = $filename;
            $file->move($path, $filename);

        }

        //for update in table
        $show->update();
        return back()->with('info_updated', 'Profession Info has been updated successfuly!');
    }


    //DELETE_Profession
    public function destroy($id)
    {
        $show = Profession::find($id);
        $destination = $show->p_image;
        //code for remove old file
//        dd($destination);
        if (File::exists($destination)) {
            File::delete($destination);
        }
        $show->delete();
        return back()->with('info_deleted', 'Profession Info has been deleted successfully!');
    }
    //

}
