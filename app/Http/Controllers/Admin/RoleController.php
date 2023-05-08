<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    //
    public function showRole()
    {
        return view('admin.role.create_role');
    }

    public function createRole(Request $request)
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

        $role = new Role();
        $role->name = $request->input('name');
        $role->save();
        $check = $role->save();

        if ($check) {
            return redirect()->back()->with('success', 'Role created successfully!');

        } else {
            return redirect()->back()->with('success', 'Role did not created successfully!');

        }

    }
}
