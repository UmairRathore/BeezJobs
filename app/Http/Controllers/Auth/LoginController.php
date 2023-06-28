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

            if (json_decode($request->cookie('job_data'), true)) {
                $newJobData = json_decode($request->cookie('job_data'), true);
                if ($newJobData) {
                    $task = new Job;
                    $task->user_id = auth('user')->user()->id;
                    $task->title = $newJobData['title'];
                    $task->date = $newJobData['date'];
                    $task->time_of_day = $newJobData['time_of_day'];
                    $task->online_or_in_person = $newJobData['online_or_in_person'];
                    $task->location = $newJobData['location'];
                    $task->description = $newJobData['description'];
                    $task->budget = $newJobData['budget'];
                    $check = $task->save();
                    if ($check) {
                        return redirect()->route('job_single_view', ['id' => $task->id])->withCookie(Cookie::forget('job_data'))->with('success', 'Job created successfully!');
                    } else {
                        return redirect()->route('job_single_view', ['id' => $task->id])->with('error', 'Job did not create successfully!');
                    }
                }
            } elseif (json_decode($request->cookie('service_data'), true)) {
                $newServiceData = json_decode($request->cookie('service_data'), true);
                if ($newServiceData) {
                    $userId = auth('user')->user()->id;

                    // Check if the user already has a service
                    $existingService = Job::where('user_id', $userId)->where('job_type', 'service')->first();

                    if ($existingService) {
                        // Update the existing service
                        $existingService->title = $newServiceData['title'];
                        $existingService->description = $newServiceData['description'];
                        $existingService->online_or_in_person = $newServiceData['online_or_in_person'];
                        $existingService->location = $newServiceData['location'];
                        $existingService->hourly_rate = $newServiceData['hourly_rate'];
                        $existingService->basic_price = $newServiceData['basic_price'];
                        $existingService->basic_description = $newServiceData['basic_description'];
                        $existingService->standard_price = $newServiceData['standard_price'];
                        $existingService->standard_description = $newServiceData['standard_description'];
                        $existingService->premium_price = $newServiceData['premium_price'];
                        $existingService->premium_description = $newServiceData['premium_description'];

                        $check = $existingService->save();

                        if ($check) {
                            return redirect()
                                ->route('post_a_service.show', ['id' => $existingService->id])
                                ->withCookie(Cookie::forget('service_data'))
                                ->with('success', 'Service updated successfully!');
                        } else {
                            return redirect()
                                ->route('post_a_service.show', ['id' => $existingService->id])
                                ->with('error', 'Service did not update successfully!');
                        }
                    } else {
                        // Create a new service
                        $service = new Job;
                        $service->job_type = 'service';
                        $service->user_id = $userId;
                        $service->title = $newServiceData['title'];
                        $service->description = $newServiceData['description'];
                        $service->online_or_in_person = $newServiceData['online_or_in_person'];
                        $service->location = $newServiceData['location'];
                        $service->hourly_rate = $newServiceData['hourly_rate'];
                        $service->basic_price = $newServiceData['basic_price'];
                        $service->basic_description = $newServiceData['basic_description'];
                        $service->standard_price = $newServiceData['standard_price'];
                        $service->standard_description = $newServiceData['standard_description'];
                        $service->premium_price = $newServiceData['premium_price'];
                        $service->premium_description = $newServiceData['premium_description'];

                        $check = $service->save();

                        if ($check) {
                            return redirect()
                                ->route('my_freelancer_service', ['id' => $service->id])
                                ->withCookie(Cookie::forget('service_data'))
                                ->with('success', 'Service created successfully!');
                        } else {
                            return redirect()
                                ->route('my_freelancer_service', ['id' => $service->id])
                                ->with('error', 'Service did not create successfully!');
                        }
                    }
                }
            } else {
                return redirect('/freelancesignup');
            }



        } elseif (Auth::guard('user')->attempt(['email' => $email, 'password' => $password], true) && auth('user')->user()->status == 0 && auth('user')->user()->role_id == 2) {

            if (json_decode($request->cookie('job_data'), true)) {
                $newJobData = json_decode($request->cookie('job_data'), true);
                if ($newJobData) {
                    $task = new Job;
                    $task->user_id = auth('user')->user()->id;
                    $task->title = $newJobData['title'];
                    $task->date = $newJobData['date'];
                    $task->time_of_day = $newJobData['time_of_day'];
                    $task->online_or_in_person = $newJobData['online_or_in_person'];
                    $task->location = $newJobData['location'];
                    $task->description = $newJobData['description'];
                    $task->budget = $newJobData['budget'];
                    $check = $task->save();
                    if ($check) {
                        return redirect()->route('job_single_view', ['id' => $task->id])->withCookie(Cookie::forget('job_data'))->with('success', 'Job created successfully!');
                    } else {
                        return redirect()->route('job_single_view', ['id' => $task->id])->with('error', 'Job did not create successfully!');
                    }
                }
            } elseif (json_decode($request->cookie('service_data'), true)) {
                $newServiceData = json_decode($request->cookie('service_data'), true);
                if ($newServiceData) {
                    $userId = auth('user')->user()->id;

                    // Check if the user already has a service
                    $existingService = Job::where('user_id', $userId)->where('job_type', 'service')->first();

                    if ($existingService) {
                        // Update the existing service
                        $existingService->title = $newServiceData['title'];
                        $existingService->description = $newServiceData['description'];
                        $existingService->online_or_in_person = $newServiceData['online_or_in_person'];
                        $existingService->location = $newServiceData['location'];
                        $existingService->hourly_rate = $newServiceData['hourly_rate'];
                        $existingService->basic_price = $newServiceData['basic_price'];
                        $existingService->basic_description = $newServiceData['basic_description'];
                        $existingService->standard_price = $newServiceData['standard_price'];
                        $existingService->standard_description = $newServiceData['standard_description'];
                        $existingService->premium_price = $newServiceData['premium_price'];
                        $existingService->premium_description = $newServiceData['premium_description'];

                        $check = $existingService->save();

                        if ($check) {
                            return redirect()
                                ->route('post_a_service.show')
                                ->withCookie(Cookie::forget('service_data'))
                                ->with('success', 'Service updated successfully!');
                        } else {
                            return redirect()
                                ->route('post_a_service.show')
                                ->with('error', 'Service did not update successfully!');
                        }
                    } else {
                        // Create a new service
                        $service = new Job;
                        $service->job_type = 'service';
                        $service->user_id = $userId;
                        $service->title = $newServiceData['title'];
                        $service->description = $newServiceData['description'];
                        $service->online_or_in_person = $newServiceData['online_or_in_person'];
                        $service->location = $newServiceData['location'];
                        $service->hourly_rate = $newServiceData['hourly_rate'];
                        $service->basic_price = $newServiceData['basic_price'];
                        $service->basic_description = $newServiceData['basic_description'];
                        $service->standard_price = $newServiceData['standard_price'];
                        $service->standard_description = $newServiceData['standard_description'];
                        $service->premium_price = $newServiceData['premium_price'];
                        $service->premium_description = $newServiceData['premium_description'];

                        $check = $service->save();

                        if ($check) {
                            return redirect()
                                ->route('my_freelancer_service', ['id' => $service->id])
                                ->withCookie(Cookie::forget('service_data'))
                                ->with('success', 'Service created successfully!');
                        } else {
                            return redirect()
                                ->route('my_freelancer_service', ['id' => $service->id])
                                ->with('error', 'Service did not create successfully!');
                        }
                    }
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
