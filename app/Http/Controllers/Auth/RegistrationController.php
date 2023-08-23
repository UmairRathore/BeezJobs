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
use Laravel\Socialite\Facades\Socialite;
use Stevebauman\Location\Facades\Location;

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


    public function generateRandomUsers($count = 10)
    {
        User::createRandomUsers($count);

        return redirect()->back()->with('success', $count . ' random users created successfully!');
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
        $this->data['user']->location = $request->input('location');
        $this->data['user']->latitude = $request->input('latitude');
        $this->data['user']->longitude = $request->input('longitude');
        $this->data['user']->status = 0;
        $this->data['user']->role_id = 2;
        $check = $this->data['user']->save();
        if ($check) {
            return redirect()->route('signin')->with('success', 'Signup Successfully! You Can Login Now');

        } else {
            return redirect()->route('signin')->with('alert', 'Something Is Wrong Try Again!');

        }

    }



    public function loginUsingFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function callbackFromFacebook()
    {
        try {
            $user = Socialite::driver('facebook')->user();

            $saveUser = User::updateOrCreate([
                'facebook_id' => $user->getId(),
            ],[
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'password' => Hash::make($user->getName().'@'.$user->getId())
            ]);

            Auth::loginUsingId($saveUser->id);

            return redirect()->route('home');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function loginWithGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callbackFromGoogle()
    {
        try {
            $user = Socialite::driver('google')->user();

            $is_user = User::where('email', $user->getEmail())->first();
            if(!$is_user){

                $saveUser = User::updateOrCreate([
                    'google_id' => $user->getId(),
                ],[
                    'name' => $user->getName(),
                    'email' => $user->getEmail(),
                    'password' => Hash::make($user->getName().'@'.$user->getId())
                ]);
            }else{
                $saveUser = User::where('email',  $user->getEmail())->update([
                    'google_id' => $user->getId(),
                ]);
                $saveUser = User::where('email', $user->getEmail())->first();
            }


            Auth::loginUsingId($saveUser->id);

            return redirect()->route('signin')->with('success', 'Profile is updated successfully!');;
        } catch (\Throwable $th) {
            throw $th;
        }
    }



    public function freelancesignup()
    {
        return view($this->_viewPath . 'freelancesignup');
    }



    public function postfreelancesignup(Request $request)
    {
        if(\auth()->check()) {
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
            $this->data['user']->save();
            $check = $this->data['user']->save();
        if ($check) {
            return redirect()->back()->with('success', 'Profile is updated successfully!');
        } else {
            return redirect()->back()->with('error', 'Something is wrong!');
        }
        }
    }

    public function dashboard()
    {
        $this->data['user'] = User::where('status', '=', '1')->count();
        return view('backend.pages.dashboard', $this->data);
    }



}
