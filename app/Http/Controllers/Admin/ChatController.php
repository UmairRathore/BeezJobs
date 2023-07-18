<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\Message;
use App\Models\Offer;
use App\Models\Order;
use App\Models\TransactionHistory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Stripe\PaymentIntent;
use Stripe\Stripe;

class ChatController extends Controller
{
    //


    protected $_viewPath;
    protected $data = array();

    public function __construct()
    {
        $this->_model = new Message();
        $this->_model_user = new User();
        $this->setDefaultData();
    }

    private function setDefaultData()
    {
        $this->_viewPath = 'backend.pages.';
        $this->data['moduleName'] = 'Messages';
    }





    public function my_freelancer_messages()
    {

        $messages1 = $this->_model::
        where('sender_id', Auth()->user()->id)
            ->orWhere('receiver_id', Auth()->user()->id)
            ->orderby('id', 'desc')
            ->get()
            ->unique('sender_id')
            ->pluck('sender_id')
            ->toArray();

        $messages2 = $this->_model::
        where('sender_id', Auth()->user()->id)
            ->orWhere('receiver_id', Auth()->user()->id)
            ->orderby('id', 'desc')
            ->get()
            ->unique('receiver_id')
            ->pluck('receiver_id')
            ->toArray();
        $result1 = array_merge($messages1, $messages2);
        $result = array_unique($result1);
        $this->data['latestMessage'] = $this->_model::where('sender_id', Auth()->user()->id)
            ->orWhere('receiver_id', Auth()->user()->id)
            ->orderby('id', 'desc')
            ->pluck('message')
            ->first();

        $user = User::whereIn('id', $result)
            ->where('id', '!=', Auth()->user()->id)
            ->get();
        $this->data['leftwallmessages'] = $user;

//            $this->data['leftwallmessages'] = $user;


        return view('frontend.freelancer.messages.my_freelancer_messages', $this->data);

    }


    public function store(Request $request)
    {

        $this->data['messages'] = new Message();
        $this->data['messages']->sender_id = $request->sender_id;
        $this->data['messages']->receiver_id = $request->receiver_id;
        $this->data['messages']->message = $request->message;
        $this->data['messages']->save();

        return 1;
    }


    public function texting($reciever_id)
    {

        $this->data['reciever_id'] = $reciever_id;

        $messages1 = $this->_model::
        where('sender_id', Auth()->user()->id)
            ->orWhere('receiver_id', Auth()->user()->id)
            ->orderby('id', 'desc')
            ->get()
            ->unique('sender_id')
            ->pluck('sender_id')
            ->toArray();

        $messages2 = $this->_model::
        where('sender_id', Auth()->user()->id)
            ->orWhere('receiver_id', Auth()->user()->id)
            ->orderby('id', 'desc')
            ->get()
            ->unique('receiver_id')
            ->pluck('receiver_id')
            ->toArray();
        $result1 = array_merge($messages1, $messages2);
        $result = array_unique($result1);
        $this->data['latestMessage'] = $this->_model::where('sender_id', Auth()->user()->id)
            ->orWhere('receiver_id', Auth()->user()->id)
            ->orderby('id', 'desc')
            ->pluck('message')
            ->first();

        $user = User::whereIn('id', $result)
            ->where('id', '!=', Auth()->user()->id)
            ->get();
        $this->data['leftwallmessages'] = $user;

        $user_id = Auth::user()->id;
//            $this->data['messages'] = Message::whereIn('receiver_id', [$reciever_id, $user_id])
//                ->whereIn('sender_id', [$reciever_id, $user_id])->get();


        $this->data['messages'] = Message::select('messages.id as Messages_ID', 'messages.sender_id',
            'messages.receiver_id', 'messages.message', 'messages.offer_id', 'messages.status as MessageStatus',
            'messages.created_at as MessageCreatedAt', 'messages.updated_at as MessageUpdatedAt',

            'offer.id as Offer_ID', 'offer.job_id as Offer_Job_ID', 'offer.negotiated_price', 'offer.negotiated_duration', 'offer.negotiated_description',
            'offer.rejected', 'offer.accepted', 'offer.status as OfferStatus',

            'job.*')
            ->whereIn('receiver_id', [$reciever_id, $user_id])
            ->whereIn('sender_id', [$reciever_id, $user_id])
            ->leftjoin('offers as offer', 'offer.id', '=', 'messages.offer_id')
            ->leftjoin('jobs as job', 'job.id', '=', 'offer.job_id')
            ->orderBy('Messages_ID', 'asc')
            ->get();
//            dd($this->data['messages']);


        return view('frontend.freelancer.messages.freelancer_texting', $this->data);

    }

    public function makeAvailableJobOffer(Request $request)
    {

        $this->data['offers'] = new Offer();
        $this->data['offers']->job_id = $request->job_id;
        $this->data['offers']->negotiated_price = $request->negotiated_price;
        $this->data['offers']->negotiated_description = $request->negotiated_description;
        $this->data['offers']->negotiated_duration = $request->negotiated_duration;
        $this->data['offers']->save();

        $offer_id = $this->data['offers']->id;
        $job_id = $this->data['offers']->job_id;
        $this->data['jobs'] = Job::find($job_id);
        $this->data['jobs']->offer_id = $offer_id;
        $this->data['jobs']->save();

        $offer_id = $this->data['offers']->id;

        $this->data['messages'] = new Message();
        $this->data['messages']->offer_id = $offer_id;
        $this->data['messages']->sender_id = $request->sender_id;
        $this->data['messages']->receiver_id = $request->receiver_id;
        $this->data['messages']->save();

        $message_id = $this->data['messages']->id;


        $this->data['offerInMessage'] = Offer::find($offer_id);
        $this->data['offerInMessage']->message_id = $message_id;
        $this->data['offerInMessage']->save();

        return 1;
    }

    public function makeCustomJobOffer(Request $request)
    {
        $this->data['jobs'] = new Job();
        $this->data['jobs']->user_id = $request->receiver_id;
        $this->data['jobs']->title = $request->title;
        $this->data['jobs']->date = $request->date;
        $this->data['jobs']->online_or_in_person = $request->job_meeting;
        $this->data['jobs']->time_of_day = $request->time_of_day;
        $this->data['jobs']->location = $request->location;
        $this->data['jobs']->description = $request->description;
        $this->data['jobs']->budget = $request->budget;
        $this->data['jobs']->save();

        $this->data['offers'] = new Offer();
        $this->data['offers']->job_id = $this->data['jobs']->id;
        $this->data['offers']->negotiated_price = $this->data['jobs']->budget;
        $this->data['offers']->negotiated_description = $this->data['jobs']->description;
        $this->data['offers']->negotiated_duration = $this->data['jobs']->time_of_day;
        $this->data['offers']->save();

        $offer_id = $this->data['offers']->id;

        $this->data['messages'] = new Message();
        $this->data['messages']->offer_id = $offer_id;
        $this->data['messages']->sender_id = $request->sender_id;
        $this->data['messages']->receiver_id = $request->receiver_id;
        $this->data['messages']->save();

        $message_id = $this->data['messages']->id;

        $this->data['offerInMessage'] = Offer::find($offer_id);
        $this->data['offerInMessage']->message_id = $message_id;
        $this->data['offerInMessage']->save();

        $job_id = $this->data['jobs']->id;
        $this->data['jobs'] = Job::find($job_id);
        $this->data['jobs']->offer_id = $offer_id;
        $this->data['jobs']->save();

        return 1;
    }

    public function Offerjobs($job_id)
    {
        $job = Job::find($job_id);
        $response = [
            'title' => $job->title,
            'time_of_job' => $job->time_of_day,
        ];

        return response()->json($response);

    }

    public function rejectOffer(Request $request)
    {

//        dd($request);
        $offerId = $request->input('offer_id');
        $this->data['messages'] = Offer::find($offerId);
        $this->data['messages']->rejected = '1';
//        $this->data['messages']->message = 'rejected';
        $this->data['messages']->save();

//        sleep(3);

        return 1;
    }

    public function acceptOffer(Request $request)
    {
        $offerId = $request->input('offer_id');
        $offerJobID = Offer::find($offerId)->first();

//        dd($offerJobID->negotiated_price);
        $offer = Offer::find($offerId);



        if (!$offer) {
            // Handle the case when the offer is not found
            return response()->json(['error' => 'Offer not found'], 404);
        }

        // Perform any necessary validation and authorization checks here

        // Create a hold on payment using Stripe
        Stripe::setApiKey('sk_test_51N2idRBKx4V0XOuhKr3M6HX0oIuewI4MgWBzAjEOTErra8eEK6beRyumfsGmbD2J4Waq3DB4wxD0OpZLriHBRXgi00HvChlG3J');

        $paymentIntent = PaymentIntent::create([
            'amount' => $offerJobID->negotiated_price * 100, // Replace with the actual amount
            'currency' => 'usd', // Replace with the appropriate currency
            'payment_method_types' => ['card'], // Replace with the actual payment method ID
            'capture_method' => 'manual',
        ]);

        $paymentIntentId = $paymentIntent->id;

        try {
//            $paymentIntent->capture();

            // Store the paymentIntentId in your order or database for future reference

            // Update the offer status to accepted
            $offer->accepted = true;
            $offer->save();

            $transaction = new TransactionHistory();
            $transaction->user_id = auth()->user()->id;
            $transaction->offer_id = $offerId;
            $transaction->amount = $paymentIntent->amount / 100;
            $transaction->type = 'sent'; // Set the transaction type as 'received' for received amount
            $transaction->captured_at = now();
            $transaction->save();

            // Create a new order and associate the offer ID and payment intent ID
            $order = new Order();
            $order->status = 'active';
            $order->offer_id = $offerId;
            $order->payment_intent_id = $paymentIntentId;
            $order->save();

            return response()->json(['success' => true]);
        } catch (Exception $e) {
            return response()->json(['error' => 'Payment capture failed. Please try again.']);
        }
    }

    public function searchUsers(Request $request)
    {
        $searchTerm = $request->input('searchTerm');
        $users = User::where('first_name', 'LIKE', '%' . $searchTerm . '%')
            ->orWhere('last_name', 'LIKE', '%' . $searchTerm . '%')
            ->get();
        return response()->json($users);
    }


}
