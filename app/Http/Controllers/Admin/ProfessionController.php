<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProfessionController extends Controller
{
    //
    public function showProfession()
    {
        return view('admin.profession.create_profession');
    }

    public function createProfession(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $profession = new Profession();
        $profession->name = $request->input('name');
        $profession->save();
        $check = $profession->save();

        if ($check) {
            return redirect()->back()->with('success', 'Job created successfully!');

        } else {
            return redirect()->back()->with('success', 'Job did not created successfully!');

        }

    }
}
