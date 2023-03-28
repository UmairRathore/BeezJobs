<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //
    public function edit($id)
    {

        $show = User::where('id', $id)->first();
        return view('backend.admin.admin-profile', compact('show'));
    }

    public function update(Request $request, $id)
    {
        $this->data['user'] = User::find($id);
        $this->data['user']->first_name = $request->input('first_name');
        $this->data['user']->last_name = $request->input('last_name');
        $this->data['user']->email = $request->input('email');
        if (!empty($request->password)) {
            $this->data['user']->password = Hash::make($request->password);
        }

        $this->data['user']->save();
        return back()->with('info_updated', 'Admin Info has been updated successfuly!');


    }
}
