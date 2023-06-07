<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Stevebauman\Location\Facades\Location;

class LoginController extends Controller
{


    public function signout()
    {
        $check = Auth::guard('user')->logout();
        if ($check == null) {
            return view('auth.signin');
        }

    }

    public function signin()
    {
//        $newEventData = session()->pull('job_data');
//        dd($newEventData);

        $data['active'] = '';
        if (Auth::guard('user')->check() && auth('user')->user()->role_id == 1) {
            return redirect('/');
            //            echo 'admin';
        } elseif (Auth::guard('user')->check() && auth('user')->user()->role_id == 2) {
            return redirect('/');
            //            echo 'buyer';
        } elseif (Auth::guard('user')->check() && auth('user')->user()->email == 3) {
            return Redirect::to('dashboard');
            //            echo 'seller';
        }
        return view('auth.signin');
    }


    function postsignin(Request $request)
    {

//        dd(session()->flash('job_data', $request->all()));
//        dd([$request->email, $request->password]);
        $email = $request->email;
        $password = $request->password;

//        dd($request);



        if (Auth::guard('user')->attempt(['email' => $email, 'password' => $password], true) && auth('user')->user()->status == 1 && auth('user')->user()->role_id == 1) {
            //            echo 'admin';

            return redirect('/dashboard');
//            return 'admin dashboard is in development';


        } elseif (Auth::guard('user')->attempt(['email' => $email, 'password' => $password], true) && auth('user')->user()->status == 1 && auth('user')->user()->role_id == 2) {

//            $newEventData = session()->pull('job_data');
            $newEventData = json_decode($request->cookie('job_data'), true);
//            dd($newEventData);

            if ($newEventData) {
                $task = new Job;
                $task->user_id = auth('user')->user()->id;
                $task->title = $newEventData['title'];
                $task->date = $newEventData['date'];
                $task->time_of_day = $newEventData['time_of_day'];
                $task->online_or_in_person = $newEventData['online_or_in_person'];
                $task->location = $newEventData['location'];
                $task->description = $newEventData['description'];
                $task->budget = $newEventData['budget'];
//                dd($task);
                $task->save();
                $check = $task->save();
                if ($check) {
                    return redirect()->route('job_single_view',['id' => $task->id])->withCookie(Cookie::forget('job_data'))->with('success', 'Job created successfully!');
                } else {
                    return redirect()->route('job_single_view',['id' => $task->id])->with('error', 'Job did not created successfully!');
                }
            }
                else{
                    return redirect('/');
                }


        } elseif (Auth::guard('user')->attempt(['email' => $email, 'password' => $password], true) && auth('user')->user()->status == 0 && auth('user')->user()->role_id == 2) {

            $newEventData = json_decode($request->cookie('job_data'), true);
//            dd($newEventData);

            if ($newEventData) {
                $task = new Job;
                $task->user_id = auth('user')->user()->id;
                $task->title = $newEventData['title'];
                $task->date = $newEventData['date'];
                $task->time_of_day = $newEventData['time_of_day'];
                $task->online_or_in_person = $newEventData['online_or_in_person'];
                $task->location = $newEventData['location'];
                $task->description = $newEventData['description'];
                $task->budget = $newEventData['budget'];
//                dd($task);
                $task->save();
                $check = $task->save();
                if ($check) {
                    return redirect()->route('job_single_view',['id' => $task->id])->withCookie(Cookie::forget('job_data'))->with('success', 'Job created successfully!');
                } else {
                    return redirect()->route('job_single_view',['id' => $task->id])->with('error', 'Job did not created successfully!');
                }
            } else {
                return redirect('/freelancesignup');
            }



        } else {

            return redirect()->back()->with('alert', 'Your credentials do not match our record, Please try again!');

        }

    }


    public function showForgetPasswordForm()
    {
        return view('auth.forgetPassword');
    }


    public function submitForgetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        Mail::send('backend.email.forgetPassword', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Reset Password');
        });

        return back()->with('message', 'We have e-mailed your password reset link!');
    }

    public function showResetPasswordForm($token)
    {
        //        return view($this->_viewPath.'forgetPasswordLink', ['token' => $token]);
        return view('auth.forgetpassLink', ['token' => $token]);
    }


    public function submitResetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);

        $updatePassword = DB::table('password_resets')
            ->where([
                'email' => $request->email,
                'token' => $request->token
            ])
            ->first();

        if (!$updatePassword) {
            return back()->withInput()->with('error', 'Invalid token!');
        }

        $user = User::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);

        DB::table('password_resets')->where(['email' => $request->email])->delete();

        return redirect('/login')->with('message', 'Your password has been changed!');
    }
}
