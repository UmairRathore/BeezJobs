<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class CityController extends Controller
{
    //city_LIST
    public function index()
    {

        $show = City::all();
        return view('backend.city.city-list', compact('show'));

    }



//ADD_city

    //Add-city (page)
    public function create()
    {
        return view('backend.city.create-city');
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(),
            [
                'city' => 'required',
                'c_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

        //         'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        if ($validator->fails()) {
            return back()->with('required_fields_empty', 'FIll all the required fields!')
                ->withErrors($validator)
                ->withInput();
        }


        $show = new City;
        $show->city = $request->input('city');
        if ($request->hasfile('c_image')) {
            //upload new file
            $file = $request->file('c_image');
            $path = 'images/';
//                $extension=$file->getClientOriginalExtension();
            $filename = $path . time() . '-' . $file->getClientOriginalName();
            $file->move($path, $filename);
            $show->c_image = $filename;
        }
        else
        {

            $show->c_image = 'default-image.png';
        }

        $show->save();
        return back()->with('info_created', 'New city has been added Successfully!');
    }


//EDIT_cityS
    public function edit($id)
    {
        $show = City::where('id', $id)->first();
        return view('backend.city.update-city', compact('show'));
    }


//UPDATE_cityS
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'city' => 'required',
            'c_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);
        if ($validator->fails()) {
            return back()->with('fields_empty', 'FIll all the required fields!')
                ->withErrors($validator)
                ->withInput();
        }

        $show = City::find($id);
        $show->city = $request->input('city');

        if ($request->hasfile('c_image')) { //code for remove old file
            $destination = $show->c_image;
//            dd($destination);
            if (File::exists($destination)) {
                File::delete($destination);
            }

            //upload new file
            $file = $request->file('c_image');
            $path = 'images/';
//                $extension=$file->getClientOriginalExtension();
            $filename = $path . time() . '-' . $file->getClientOriginalName();
            $show->c_image = $filename;
            $file->move($path, $filename);

        }

        //for update in table
        $show->update();
        return back()->with('info_updated', 'City Info has been updated successfuly!');
    }


    //DELETE_city
    public function destroy($id)
    {
        $show = City::find($id);
        $destination = $show->c_image;
        //code for remove old file
//        dd($destination);
        if (File::exists($destination)) {
            File::delete($destination);
        }
        $show->delete();
        return back()->with('info_deleted', 'City Info has been deleted successfully!');
    }
}
