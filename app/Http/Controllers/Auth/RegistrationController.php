<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegistrationController extends Controller
{

    protected $_viewPath;
    protected $data = array();

    public function __construct()
    {
        $this->_model = new User();
        $this->setDefaultData();
    }

    private function setDefaultData()
    {
        $this->_viewPath = 'auth.';
        $this->data['moduleName'] = 'User';
    }

    public function signup()
    {
        return view($this->_viewPath . 'signup');
    }

    public function postsignUp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
        $this->data['user'] = $this->_model;
        $this->data['user']->email = $request->input('email');
        $this->data['user']->password = bcrypt($request->password);
        $this->data['user']->status = 0;
        $this->data['user']->save();
        $check = $this->data['user']->save();
        if ($check) {
            return redirect()->route('signin')->with('alert', 'Signup Successfully! You Can Login Now');

        } else {
            return redirect()->route('signin')->with('alert', 'Something Is Wrong Try Again!');

        }

    }

    public function selectprofile()
    {
        return view($this->_viewPath . 'freelancesignup');
    }






    public function freelancesignup(Request $request)
    {
        $id = auth()->user()->id;
        $profile_image = auth()->user()->profile_image;
        $image = '';
        $date = date('d-m-Y');
        if ($request->hasFile('file')) {
            $image = $request->file;
            $fileName = date('dmyhisa') . '-' . $image->getClientOriginalName();
            $fileName = str_replace(" ", "-", $fileName);
            $image->move('images/user_profile/' . $date . '/', $fileName);
            $image = 'images/user_profile/' . $date . '/' . $fileName;
        }
        if ($image == '') {
            $image = $profile_image;
        }

        $this->data['user'] = $this->_model::find($id);
        $this->data['user']->first_name = $request->input('first_name');
        $this->data['user']->last_name = $request->input('last_name');
        $this->data['user']->birthday = $request->input('birthday');
        $this->data['user']->email = $request->input('email');
        $this->data['user']->description = $request->input('description');
        $this->data['user']->location = $request->input('location');
        $this->data['user']->pay_rate = $request->input('pay_rate');
        $this->data['user']->tagline = $request->input('tagline');
        $this->data['user']->status = 1;
        $this->data['user']->profile_image = $image;
        $websites = implode(",", $request->input('websites'));
        $this->data['user']->websites = $websites;
        $this->data['user']->save();
        $check = $this->data['user']->save();

        if ($check) {
            return redirect()->back()->with('alert', 'Profile is updated successfully!');
        } else {
            return redirect()->back()->with('alert', 'Something is wrong!');
        }


    }

    public function dashboard()
    {
        $this->data['user'] = User::where('status', '=', '1')->count();
        return view('backend.pages.dashboard', $this->data);
    }



}
