<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\Message;
use App\Models\Notification;
use App\Models\Offer;
use App\Models\Order;
use App\Models\OrderAttempt;
use App\Models\Profession;
use App\Models\Review;
use App\Models\TransactionHistory;
use App\Models\UserCards;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\Portfolio;
use App\Service\NotificationService;

use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Stmt\Return_;
use GuzzleHttp\Client;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Stripe\Transfer;
use Stripe\Account;
use Stripe\AccountLink;


class FreelancerDashboardController extends Controller
{

    public function my_freelancer_dashboard()
    {
        return view('frontend.freelancer.my_freelancer.my_freelancer_dashboard');
    }
    public function my_freelancer_settings()
    {
        $this->data['card'] = UserCards::where('user_id', \auth()->user()->id)->first();
        if ($this->data['card']) {
            // Decrypt the card information
            $decryptedCardNumber = decrypt($this->data['card']->card_number);
            $decryptedExpiring = decrypt($this->data['card']->expiring);
            $decryptedCvv = decrypt($this->data['card']->cvv);

            // Update the card information with the decrypted values
            $this->data['card']->card_number = $decryptedCardNumber;
            $this->data['card']->expiring = $decryptedExpiring;
            $this->data['card']->cvv = $decryptedCvv;
        } else {
            // Card not found
            $this->data['card'] = null;
        }
//        dd($this->data['card']);
        return view('frontend.freelancer.my_freelancer.my_freelancer_settings',$this->data);
    }

    public function my_freelancer_service()
    {
        $user_id = auth()->user()->id;
//        dd($user_id);
        $data['service'] = Job::where('user_id',$user_id)->whereNotNull('job_type')->first();
//        dd($data['service']);
        return view('frontend.freelancer.my_freelancer.my_freelancer_service', $data);
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

        $user_id = auth()->user()->id;

        $this->data['user'] = User::where('id',$user_id)->select('wallet_amount')->first();
        // Fetch the transaction details for the user
        $this->data['transactions'] = TransactionHistory::where('user_id', $user_id)->get();

        // Calculate the wallet balance based on transaction types
        $this->data['sentAmount'] = $this->data['transactions']->where('type', 'sent')->sum('amount');
        $this->data['receivedAmount'] = $this->data['transactions']->where('type', 'received')->sum('amount');

        return view('frontend.freelancer.my_freelancer.my_freelancer_payments',$this->data);
    }
    public function my_freelancer_profile()
    {
        return view('frontend.freelancer.my_freelancer.my_freelancer_profile');
    }
    public function my_freelancer_notifications()
    {

        $this->data['Notification'] = Notification::where('receiver_id', auth()->user()->id)
            ->join('users', 'users.id', '=', 'notifications.user_id')
            ->join('professions', 'professions.id', '=', 'users.profession_id')
            ->get();
//             dd($this->data['Notification']);
        return view('frontend.freelancer.my_freelancer.my_freelancer_notifications',$this->data);
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

    private function calculateDistance($lat1, $lng1, $lat2, $lng2)
    {
        // Implementation of the Haversine formula to calculate distance between two points

        $earthRadius = 6371; // Radius of the earth in kilometers

        $latDiff = deg2rad($lat2 - $lat1);
        $lngDiff = deg2rad($lng2 - $lng1);

        $a = sin($latDiff / 2) * sin($latDiff / 2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($lngDiff / 2) * sin($lngDiff / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        $distance = $earthRadius * $c; // Distance in kilometers

        return $distance;
    }

    public function browse_freelancers(Request $request, $lat = null, $lng = null)
    {
//        dd($request->lat);
//        dd(User::all());
        $lat = $request->lat;
        $lng = $request->lng;
        $this->data['categories'] = Profession::get();

        $this->data['users'] = User::select('users.*', 'professions.profession as profession_name')
            ->where('status', 1)
            ->where('role_id', 2)
            ->join('professions', 'users.profession_id', '=', 'professions.id');
        if ($lat && $lng) {
            $users = User::select('users.*', 'professions.profession as profession_name')
                ->where('status', 1)
                ->where('role_id', 2)
                ->join('professions', 'users.profession_id', '=', 'professions.id')
                ->whereNotNull('latitude')
                ->whereNotNull('longitude')
                ->get();

            $nearbyUsers = [];

            foreach ($users as $user) {
                $distance = $this->calculateDistance($lat, $lng, $user->latitude, $user->longitude);
                if ($distance <= 100) { // Modify the distance threshold as needed
                    $nearbyUsers[] = $user;
                }
            }
//            dd($distance);

            $this->data['users'] = $nearbyUsers;
//            dd($this->data['users']);
            $userIds = collect($this->data['users'])->pluck('id');
            $user = User::whereIn('id', $userIds)
                ->paginate(10);


//            dd($jobs);
            if ($user->isEmpty()) {
                $this->data['users'] = $this->data['users']->orderBy('jobs.created_at', 'desc')->paginate(10);
            } else {
                $this->data['users'] = $user;
            }

        }
        else {
            $category = $request->input('category');
            $pay_rate_max = $request->pay_rate_max;
            $pay_rate_min = $request->pay_rate_min;
            $location = $request->input('location');
            $search = $request->input('search');
            $rating = $request->input('rating');
            $onlineStatus = $request->input('online_status');
            if (!empty($search)) {
                $this->data['users']->where('professions.id', $search)
                    ->orwhere('users.location', 'like', '%' . $search . '%')->first();
            }

            if (!empty($category)) {
                if (is_array($category)) {
                    $this->data['users']->whereIn('professions.id', $category);
                } else {
                    $this->data['users']->where('professions.id', $category);
                }
            }
            if (!empty($rating)) {
                $this->data['users']->where('users.rating', '<>', $rating);
            }
            if (!empty($onlineStatus)) {
                $this->data['users']->where('users.online_status', '=', $onlineStatus);
            }
            if (!empty($onlineStatus)) {
                if ($onlineStatus == 1) {
                    $this->data['users']->Where('online_status', 1);
                } elseif ($onlineStatus == 0) {
                    $this->data['users']->Where('online_status', 0);
                }
            }

            if (!empty($pay_rate_min)) {
                if ($pay_rate_min == 0) {
                    $pay_rate_min = null;
                } else {
                    $this->data['users']->where('users.pay_rate', '>=', $pay_rate_min);
                }
            }

            if (!empty($pay_rate_max)) {
                if ($pay_rate_max == 0) {
                    $pay_rate_max = null;
                } else {
                    $this->data['users']->where('users.pay_rate', '<=', $pay_rate_max);
                }
            }

            if (!empty($location)) {
                $this->data['users']->where('users.location', 'LIKE', "%{$location}%");
            }
            $this->data['users'] = $this->data['users']->orderBy('created_at', 'desc')->paginate(10);
        }


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

    public function other_freelancer_service($id)
    {
        $this->data['users']= User::where('users.id',$id)
            ->select('users.*','p.profession as profession')
            ->join('professions as p', 'users.profession_id', '=', 'p.id')
            ->first();
        $this->data['service']= job::where('user_id',$id)
            ->whereNotNull('job_type')
            ->first();

        return view('frontend.freelancer.other_freelancer.other_freelancer_service',$this->data);
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
        $this->data['Reviews'] = Review::where('receiver_id',$id)
            ->join('users','users.id','=','reviews.receiver_id')
            ->join('professions','professions.id','=','users.profession_id')->get();


//        return view('frontend.freelancer.my_freelancer.my_freelancer_reviews',$this->data);
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

        $this->data['order'] = Order::where('orders.id',$id)
            ->select('orders.id as order_id','orders.offer_id as order_offer_id','orders.status as order_status','orders.duration as order_duration',
                'orders.payment_status as order_payment_status','orders.created_at as order_created_at','orders.updated_at as order_updated_at',

                'offers.id as offer_id','offers.job_id as offer_job_id','offers.negotiated_duration as offer_negotiated_duration',
                'offers.negotiated_description as offer_negotiated_description','offers.negotiated_price as offer_negotiated_price',
                'offers.rejected as offer_rejected','offers.accepted as offer_accepted','offers.created_at as offer_created_at',
                'offers.updated_at as offer_updated_at','offers.message_id as offer_message_id',

//                'jobs.id as job_id','jobs.user_id as job_user_id','jobs.title as job_title','jobs.date as job_date','jobs.time_of_day as job_time_of_day',
//                'jobs.online_or_in_person as job_online_or_in_person','jobs.location as job_location','jobs.description as job_description','jobs.budget as job_budget',
                'sender.id as user_sender_id','sender.first_name as sender_first_name','sender.last_name as sender_last_name','sender.profile_image as sender_profile_image','sender.profession_id as sender_profession',
                'receiver.id as user_receiver_id','receiver.first_name as receiver_first_name','receiver.last_name as receiver_last_name','receiver.profile_image as receiver_profile_image','receiver.profession_id as receiver_profession',



            )
            ->leftJoin('offers', 'offers.id', '=', 'orders.offer_id')
            ->leftJoin('messages', 'messages.offer_id', '=', 'offers.id')
//            ->leftJoin('jobs', 'jobs.id', '=', 'offers.job_id')
            ->leftJoin('users AS sender', 'sender.id', '=', 'messages.sender_id')
            ->leftJoin('users AS receiver', 'receiver.id', '=', 'messages.receiver_id')
            ->where('messages.message',Null)
            ->first();
        $offers= Offer::select('offers.*','jobs.id as job_id', 'jobs.user_id as job_user_id', 'jobs.title as job_title', 'jobs.date as job_date', 'jobs.time_of_day as job_time_of_day',
            'jobs.online_or_in_person as job_online_or_in_person', 'jobs.location as job_location', 'jobs.description as job_description', 'jobs.budget as job_budget')
        ->where('offers.id',$this->data['order']->offer_id)
            ->join('jobs','jobs.id','=','offers.job_id')
        ->first();

        $this->data['order']['offers'] = $offers;
//        dd($this->data['order']);


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

    public function updateOrderStatus(Request $request)
    {
//dd($request);
        $orderId = $request->orderId;

        $order = Order::find($orderId);

        if ($order) {

            $order->status = 'pending';
            $order->save();
            return response()->json(['status' => 'success']);
        } else {
            return response()->json(['status' => 'failure']);
        }
    }
    public function  postOrderAttempt(Request $request)
    {
        $order = new OrderAttempt();
        $order->order_id=$request->input('order_id');
        $order->description = $request->input('description');
        if ($request->hasFile('order_attempt_file')) {
            $file = $request->file('order_attempt_file');

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

            // Retrieve the offer and payment details
            $offer = Offer::find($request->id);
            $paymentIntentId = $offer->payment_intent_id;
            $offerId = $offer->id;

            // Retrieve the seller_id from the messages table
            $message = Message::where('offer_id', $offerId)->first();
            $sellerId = $message->sender_id;

            if ($paymentIntentId) {
                // Retrieve the payment intent
                Stripe::setApiKey('sk_test_51N2idRBKx4V0XOuhKr3M6HX0oIuewI4MgWBzAjEOTErra8eEK6beRyumfsGmbD2J4Waq3DB4wxD0OpZLriHBRXgi00HvChlG3J');
                $paymentIntent = PaymentIntent::retrieve($paymentIntentId);

                // Get the captured amount from the payment intent
                $capturedAmount = $paymentIntent->amount / 100; // Convert amount from cents to dollars

                // Calculate the amounts for admin and seller
                $adminAmount = $capturedAmount * 0.05; // 20% for admin
                $sellerAmount = $capturedAmount - $adminAmount; // Remaining for seller

                // Transfer amount to admin's account
                $adminTransfer = Transfer::create([
                    'amount' => $adminAmount * 100, // Convert amount to cents
                    'currency' => 'usd',
                    'destination' => 'ADMIN_STRIPE_ACCOUNT_ID', // Replace with the actual admin's Stripe account ID
                    'transfer_group' => $offerId,
                ]);

                // Handle any errors during transfer to admin
                if ($adminTransfer->status !== 'succeeded') {
                    return back()->with('error', 'Payment transfer to admin failed. Please try again.');
                }

                // Transfer amount to seller's account
                $sellerTransfer = Transfer::create([
                    'amount' => $sellerAmount * 100, // Convert amount to cents
                    'currency' => 'usd',
                    'destination' => 'SELLER_STRIPE_ACCOUNT_ID', // Replace with the actual seller's Stripe account ID
                    'transfer_group' => $offerId,
                ]);

                // Handle any errors during transfer to seller
                if ($sellerTransfer->status !== 'succeeded') {
                    return back()->with('error', 'Payment transfer to seller failed. Please try again.');
                }

                // Record the transaction history for seller
                $sellerTransaction = new TransactionHistory();
                $sellerTransaction->user_id = $sellerId;
                $sellerTransaction->amount = $sellerAmount;
                $sellerTransaction->type = 'received';
                $sellerTransaction->offer_id = $offerId;
                $sellerTransaction->save();

                // Record the transaction history for admin
                $adminTransaction = new TransactionHistory();
                $adminTransaction->user_id = 1; // Replace with the actual admin's user ID
                $adminTransaction->amount = $adminAmount;
                $adminTransaction->type = 'received';
                $adminTransaction->offer_id = $offerId;
                $adminTransaction->save();

                // Update the seller's wallet amount
                $seller = User::find($sellerId);
                $seller->wallet_amount += $sellerAmount;
                $seller->save();
            }

            return back()->with('accepted', 'Order Task submission accepted Successfully');
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
        $validatedData = $request->validate([
            'order_id' => 'required',
            'sender_id' => 'required',
            'receiver_id' => 'required',
            'rating' => 'required|numeric',
            'review' => 'required',
        ]);

        $review = new Review();
        $review->order_id = $request->input('order_id');
        $review->sender_id = $request->input('sender_id');
        $review->receiver_id = $request->input('receiver_id');
        $review->rating = $request->input('rating');
        $review->review = $request->input('review');
        $check = $review->save();
        if ($check) {
            $rating =  Review::where('receiver_id',$review->receiver_id)->pluck('rating');
//            dd($rating);
            $totalRatings = $rating->sum();
            $ratingCount = $rating->count();
//            dd($ratingCount);

            if ($ratingCount > 0) {
                $averageRating = $totalRatings / $ratingCount;
                $averageRating = round($averageRating, 2);

                $NewRating =  User::find($review->receiver_id);
                $NewRating->rating=$averageRating;
                $NewRating->save();
            } else {
                $averageRating = $rating;
            }

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
