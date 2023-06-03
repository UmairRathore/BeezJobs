<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Notification;
use App\Models\Order;
use App\Models\OrderAttempt;
use App\Models\Profession;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\Portfolio;
use App\Service\NotificationService;

use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Stmt\Return_;

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
        $Notification = Notification::where('user_id',\auth()->user()->id);
        return view('frontend.freelancer.my_freelancer.my_freelancer_notifications');
    }
    public function my_freelancer_reviews()
    {
        $this->data['Reviews'] = Review::where('receiver_id',\auth()->user()->id)->
        join('users','users.id','=','reviews.receiver_id')
            ->join('professions','professions.id','=','users.profession_id')->get();


        return view('frontend.freelancer.my_freelancer.my_freelancer_reviews',$this->data);
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

        $this->data['Orders'] = Message::select('job.location','job.title','offer.created_at','offer.negotiated_description','offer.negotiated_price','orders.id as Order_id','orders.status as Ostatus')
            ->where('sender_id',Auth()->user()->id)
            ->leftjoin('offers as offer','offer.message_id','=','messages.id')
            ->leftjoin('jobs as job','job.id','=','offer.job_id')
            ->leftjoin('orders','orders.offer_id','offer.id')
            ->where('message',Null)
            ->where('offer.accepted',1)
            ->get();
//        dd( $this->data['Orders']);

        return view('frontend.freelancer.my_freelancer.my_freelancer_jobs', $this->data);

    }


    public function my_freelancer_order_details($id)
    {

        $this->data['order'] = Order::find($id)
            ->select('orders.id as order_id','orders.offer_id as order_offer_id','orders.status as order_status','orders.duration as order_duration',
                'orders.payment_status as order_payment_status','orders.created_at as order_created_at','orders.updated_at as order_updated_at',

                'offers.id as offer_id','offers.job_id as offer_job_id','offers.negotiated_duration as offer_negotiated_duration',
                'offers.negotiated_description as offer_negotiated_description','offers.negotiated_price as offer_negotiated_price',
                'offers.rejected as offer_rejected','offers.accepted as offer_accepted','offers.created_at as offer_created_at',
                'offers.updated_at as offer_updated_at','offers.message_id as offer_message_id',

                'jobs.id as job_id','jobs.user_id as job_user_id','jobs.title as job_title','jobs.date as job_date','jobs.time_of_day as job_time_of_day',
                'jobs.online_or_in_person as job_online_or_in_person','jobs.location as job_location','jobs.description as job_description','jobs.budget as job_budget',
                'sender.id as user_sender_id','sender.first_name as sender_first_name','sender.last_name as sender_last_name','sender.profile_image as sender_profile_image','sender.profession_id as sender_profession',
                'receiver.id as user_receiver_id','receiver.first_name as receiver_first_name','receiver.last_name as receiver_last_name','receiver.profile_image as receiver_profile_image','receiver.profession_id as receiver_profession',



            )
            ->leftJoin('offers', 'offers.id', '=', 'orders.offer_id')
            ->leftJoin('messages', 'messages.offer_id', '=', 'offers.id')
            ->leftJoin('jobs', 'jobs.id', '=', 'offers.job_id')
            ->leftJoin('users AS sender', 'sender.id', '=', 'messages.sender_id')
            ->leftJoin('users AS receiver', 'receiver.id', '=', 'messages.receiver_id')
            ->first();

        $this->data['accepted'] = OrderAttempt::where('order_id',$this->data['order']->order_id)->where('accepted',1)->latest()->first();

        $this->data['AttemptOrder'] = OrderAttempt::
        where('order_id',$this->data['order']->order_id)
            ->leftjoin('orders','orders.id','=','order_attempts.order_id')
            ->where('orders.status','active')
            ->get();

        $this->data['Reviews'] = Review::
        where('order_id',$this->data['order']->order_id)
            ->first();


        return view('frontend.freelancer.my_freelancer.my_freelancer_order_details',$this->data);
    }


    public function  postOrderAttempt(Request $request)
    {
        $order = new OrderAttempt();
        $order->order_id=$request->input('order_id');
        $order->description = $request->input('description');
        if ($request->hasFile('order_attempt_file')) {
            $file = $request->file('order_attempt_file');
            // Handle the file upload and save the file path to the order
            // For example:
            $filePath = $file->store('order_attempt_files');
            $order->order_attempt_file = $filePath;
        }
        $check  = $order->save();
        if($check){
            $job = Order::find($order->order_id)
                ->join('offers', 'offers.id', '=', 'orders.offer_id')
                ->join('messages','messages.offer_id','=','offers.id')
                ->join('users','users.id','=','messages.offer_id')
                ->join('jobs', 'jobs.id', '=', 'offers.job_id')
                ->first();
            $user_id =\auth()->user()->id;
            $User_Name = User::find($user_id)->select('users.first_name', 'users.last_name')->first();
//            dd($job);
            $receiver_id = $job->user_id;
            $message = $User_Name->first_name . '' . $User_Name->last_name . ' Submitted a Task submission to your job ' . $job->title;
            $Notification = new NotificationService();
            $Notification->sendNotification($message, $user_id,$receiver_id);
        return back()->with('success','Order task has been uploaded');
        }
        else{

        return back()->with('error','Order task has not been uploaded');
        }


    }
    public function postOrderAttemptStatus(Request $request)
    {
//        dd($request->id);

//        $id = $request->input('order_id');
            $status = OrderAttempt::find($request->id);
        if($request->accepted)
        {
           $status->accepted = 1;
            $status->rejected = 0;

            $status->save();

            $completed = Order::find($request->id);
            $completed->status = 'completed';
            $completed->save();

            return  back()->with('accepted','Order Task submission accepted Successfully');
        }
        if($request->rejected)
        {
            $status->accepted = 0;
            $status->rejected = 1;
        $status->save();
            return  back()->with('rejected','Order Task submission rejected Successfully');
        }

    }

    public function submitReview(Request $request)
    {
//        dd($request);
        // Validate the form data
//        $validatedData = $request->validate([
//            'order_id' => 'required',
//            'sender_id' => 'required',
//            'receiver_id' => 'required',
//            'rating' => 'required|numeric',
//            'review' => 'required',
//        ]);

        // Create a new review instance
        $review = new Review();
        $review->order_id = $request->input('order_id');
        $review->sender_id = $request->input('sender_id');
        $review->receiver_id = $request->input('receiver_id');
        $review->rating = $request->input('rating');
        $review->review = $request->input('review');

        // Save the review
        $check = $review->save();
        if ($check) {
            $user_id = $review->receiver_id;
            $User_Name = User::find($review->receiver_id)->select('users.first_name', 'users.last_name')->first();
            $job = Order::find($review->order_id)
                ->join('offers', 'offers.id', '=', 'orders.offer_id')
                ->join('jobs', 'jobs.id', '=', 'offers.job_id')
                ->first();
//            dd($job);
            $receiver_id= $job->user_id;
            $message = $User_Name->first_name . '' . $User_Name->last_name . ' Submitted a Review to your job ' . $job->title;
            $Notification = new NotificationService();
            $Notification->sendNotification($message, $user_id,$receiver_id);
            return redirect()->back()->with('success', 'Review submitted successfully!');
        } else {
            return redirect()->back()->with('error', 'Review not submitted successfully!');
        }
    }
}
