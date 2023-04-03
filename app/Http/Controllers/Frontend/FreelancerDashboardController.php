<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Profession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\Portfolio;

use Illuminate\Support\Facades\Hash;

class FreelancerDashboardController extends Controller
{

    function my_freelancer_dashboard()
    {
        return view('frontend.freelancer.my_freelancer_dashboard');
    }
    function my_freelancer_settings()
    {
        return view('frontend.freelancer.my_freelancer_settings');
    }
    function my_freelancer_messages()
    {
        return view('frontend.freelancer.my_freelancer_messages');
    }
    function my_freelancer_jobs()
    {
        return view('frontend.freelancer.my_freelancer_jobs');
    }
    function my_freelancer_bids()
    {
        return view('frontend.freelancer.my_freelancer_bids');
    }
    function my_freelancer_portfolio()
    {
        $user_id = auth()->user()->id;
        $data['portfolios'] = Portfolio::where('user_id', $user_id)->get();
        return view('frontend.freelancer.my_freelancer_portfolio', $data);
    }
    function my_freelancer_bookmarks()
    {
        return view('frontend.freelancer.my_freelancer_bookmarks');
    }
    function my_freelancer_payments()
    {
        return view('frontend.freelancer.my_freelancer_payments');
    }
    function my_freelancer_profile()
    {
        return view('frontend.freelancer.my_freelancer_profile');
    }
    function my_freelancer_notifications()
    {
        return view('frontend.freelancer.my_freelancer_notifications');
    }
    function my_freelancer_reviews()
    {
        return view('frontend.freelancer.my_freelancer_reviews');
    }
    function update_freelancer_social_media_links(Request $request)
    {
        $id = auth()->user()->id;


        $this->data['user'] = User::find($id);
        $this->data['user']->facebook_link = $request->input('facebook_link');
        $this->data['user']->twitter_link = $request->input('twitter_link');
        $this->data['user']->google_link = $request->input('google_link');
        $this->data['user']->linkedin_link = $request->input('linkedin_link');
        $this->data['user']->youtube_link = $request->input('youtube_link');
        $this->data['user']->instagram_link = $request->input('instagram_link');

        $check = $this->data['user']->save();

        if ($check) {
            return redirect()->back()->with('alert', 'Social Media is updated successfully!');
        } else {
            return redirect()->back()->with('alert', 'Something is wrong!');
        }
    }
    function change_freelancer_password(Request $request)
    {

        $this->validate($request, [
            'current_password' => 'required',
            'new_password' => 'required'
        ]);
        $auth = Auth::user();

        // The passwords matches
        if (!Hash::check($request->get('current_password'), $auth->password)) {
            return back()->with('alert', "Current Password is Invalid");
        }

        // Current password and new password same
        if (strcmp($request->get('current_password'), $request->new_password) == 0) {
            return redirect()->back()->with("alert", "New Password cannot be same as your current password.");
        }

        $user = User::find($auth->id);
        $user->password = Hash::make($request->new_password);
        $user->save();
        return back()->with('alert', "Password Changed Successfully");


    }
    function browse_freelancers(Request $request)
    {

//        $this->data['users']= User::select('users.*','p.profession as profession')
//            ->join('professions as p', 'users.professions_id', '=', 'p.id')
//            ->orderBy('created_at', 'desc')->get();

        $this->data['categories'] = Profession::get();
        $category = $request->input('category');
        $pay_rate_range = $request->input('pay_rate_range');
        $location = $request->input('location');
//dd($location);
        $this->data['users'] = User::select('users.*', 'professions.profession as profession_name')
            ->join('professions', 'users.professions_id', '=', 'professions.id');

        if (!empty($category)) {
            $this->data['users']->where('professions.id', $category);
        }

        if (!empty($pay_rate_range)) {
            $this->data['users']->where('pay_rate', '>=', $pay_rate_range);
        }

        if (!empty($location)) {
//            dd($location);
            $check = $this->data['users']->where('location', 'like', '%' . $location . '%');
//        dd($check);
        }
//dd($this->data['users']);
        $this->data['users'] = $this->data['users']->orderBy('created_at', 'desc')->paginate(10);

        return view('frontend.freelancer.browse_freelancers', $this->data);
    }

//    function user_search(Request $request)
//    {
//
//
//        return redirect()->back();
//    }
    function other_freelancer_profile($id)
    {
        $this->data['users']= User::find($id)
            ->select('users.*','p.profession as profession')
            ->join('professions as p', 'users.professions_id', '=', 'p.id')
            ->first();
//        dd($this->data['users']);

        return view('frontend.freelancer.other_freelancer.other_freelancer_profile',$this->data);
    }
    function other_freelancer_portfolio($id)
    {


        $this->data['users']= User::find($id)
            ->select('users.*','p.profession as profession')
            ->join('professions as p', 'users.professions_id', '=', 'p.id')
            ->where('users.id',$id)
            ->first();

                $this->data['portfolios']= Portfolio::where('user_id',$id)
            ->get();


        return view('frontend.freelancer.other_freelancer.portfolio.other_freelancer_portfolio',$this->data);
    }

    function other_freelancer_review($id)
    {
        $this->data['users']= User::find($id)
            ->select('users.*','p.profession as profession')
            ->join('professions as p', 'users.professions_id', '=', 'p.id')
            ->where('users.id',$id)
            ->first();

        return view('frontend.freelancer.other_freelancer.other_freelancer_review',$this->data);
    }

}
