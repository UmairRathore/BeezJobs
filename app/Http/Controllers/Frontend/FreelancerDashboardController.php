<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Message;
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

    public function my_freelancer_dashboard()
    {
        return view('frontend.freelancer.my_freelancer.my_freelancer_dashboard');
    }
    public function my_freelancer_settings()
    {
        return view('frontend.freelancer.my_freelancer.my_freelancer_settings');
    }
//    public function my_freelancer_messages()
//    {
//        return view('frontend.freelancer.my_freelancer_messages');
//    }
//    public function my_freelancer_jobs()
//    {
//        return view('frontend.freelancer.my_freelancer.my_freelancer_jobs');
//    }
    public function my_freelancer_bids()
    {
        return view('frontend.freelancer.my_freelancer.my_freelancer_bids');
    }
    public function my_freelancer_portfolio()
    {
        $user_id = auth()->user()->id;
        $data['portfolios'] = Portfolio::where('user_id', $user_id)->get();
        return view('frontend.freelancer.my_freelancer.my_freelancer_portfolio', $data);
    }
    public function my_freelancer_bookmarks()
    {
        return view('frontend.freelancer.my_freelancer.my_freelancer_bookmarks');
    }
    public function my_freelancer_payments()
    {
        return view('frontend.freelancer.my_freelancer.my_freelancer_payments');
    }
    public function my_freelancer_profile()
    {
        return view('frontend.freelancer.my_freelancer.my_freelancer_profile');
    }
    public function my_freelancer_notifications()
    {
        return view('frontend.freelancer.my_freelancer.my_freelancer_notifications');
    }
    public function my_freelancer_reviews()
    {
        return view('frontend.freelancer.my_freelancer.my_freelancer_reviews');
    }
    public function update_freelancer_social_media_links(Request $request)
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
    public function change_freelancer_password(Request $request)
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
        return back()->with('success', "Password Changed Successfully");


    }
    public function browse_freelancers(Request $request)
    {

        $this->data['categories'] = Profession::get();

        $category = $request->input('category');
        $pay_rate_range = $request->input('pay_rate_range');
        $location = $request->input('location');
        $search = $request->input('search');

        $this->data['users'] = User::select('users.*', 'professions.profession as profession_name')
            ->where('status',1)
            ->where('role_id',2)
            ->join('professions', 'users.profession_id', '=', 'professions.id');

        if (!empty($search)) {
            $this->data['users']->where('professions.id',$search)
                ->orwhere('users.location', 'like', '%'.$search.'%')->first();
        }

        if (!empty($category)) {
            $this->data['users']->where('professions.id', $category);
        }

        if (!empty($pay_rate_range)) {
            if($pay_rate_range==0)
            {
                $pay_rate_range=null;
            }
            else
            {
                $this->data['users']->where('users.pay_rate', '<=', $pay_rate_range);
            }
        }

        if (!empty($location)) {
             $this->data['users']->where('users.location', 'LIKE',"%{$location}%");
        }

        $this->data['users'] = $this->data['users']->orderBy('created_at', 'desc')->paginate(10);


        return view('frontend.freelancer.browse_freelancers', $this->data);
    }


    public function other_freelancer_profile($id)
    {
             $this->data['users']= User::where('users.id',$id)
            ->select('users.*','users.profile_image','p.profession as profession')
            ->join('professions as p', 'users.profession_id', '=', 'p.id')
            ->first();

        return view('frontend.freelancer.other_freelancer.other_freelancer_profile',$this->data);
    }
    public function other_freelancer_portfolio($id)
    {

        $this->data['users']= User::where('users.id',$id)
            ->select('users.*','p.profession as profession')
            ->join('professions as p', 'users.profession_id', '=', 'p.id')
            ->first();

                $this->data['portfolios']= Portfolio::where('user_id',$id)
            ->get();


        return view('frontend.freelancer.other_freelancer.other_freelancer_portfolio',$this->data);
    }

    public function other_freelancer_review($id)
    {
                $this->data['users']= User::where('users.id',$id)
            ->select('users.*','p.profession as profession')
            ->join('professions as p', 'users.profession_id', '=', 'p.id')
            ->first();

        return view('frontend.freelancer.other_freelancer.other_freelancer_review',$this->data);
    }


    public function my_freelancer_jobs()
    {
        $this->data['SentOffers'] = Message::
//        select('messages.*','jobs.*','offers.*')

        where('sender_id',Auth()->user()->id)
            ->leftjoin('offers as offer','offer.message_id','=','messages.id')
            ->leftjoin('jobs as job','job.id','=','offer.job_id')
            ->where('messages.message',Null)
            ->get();
//        dd($this->data['SentOffers']);
//        foreach( $this->data['Sent'] as  $this->data['SentOffer'])
//        {
//            $this->data['SentOffers'] = $this->data['SentOffer']->select('job.*')->leftjoin('jobs as job','job.id','=','offers.job_id')
//            ->get();
//dd($this->data['SentOffers'] );
//        }
        $this->data['RecievedOffers'] = Message:: where('receiver_id',Auth()->user()->id)
            ->leftjoin('offers as offer','offer.message_id','=','messages.id')
            ->leftjoin('jobs as job','job.id','=','offer.job_id')
            ->where('messages.message',Null)
            ->get();

        $this->data['Orders'] = Message::select('job.location','job.title','offer.created_at','offer.negotiated_description','offer.negotiated_price','orders.status as Ostatus')
            ->where('sender_id',Auth()->user()->id)
            ->leftjoin('offers as offer','offer.message_id','=','messages.id')
            ->leftjoin('jobs as job','job.id','=','offer.job_id')
            ->leftjoin('orders','orders.offer_id','offer.id')
            ->where('message',Null)
            ->where('offer.accepted',1)
            ->get();
//        dd( $this->data['Orders']);





//        $this->data['RecievedOffers'] = Message::where('receiver_id',Auth()->user()->id)->where('message',Null)->get();
//        $this->data['Orders'] = Message::where('sender_id',Auth()->user()->id)->where('message',Null)->where('accept',1)->get();
        return view('frontend.freelancer.my_freelancer.my_freelancer_jobs', $this->data);

    }

}
