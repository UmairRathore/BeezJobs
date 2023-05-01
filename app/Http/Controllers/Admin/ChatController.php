<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ChatController extends Controller
{
    //


    protected $_viewPath;
    protected $data = array();

    public function __construct()
    {
        $this->_model = new Chat();
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
                ->orWhere('receiver_id',Auth()->user()->id)
                ->orderby('id', 'desc')
                ->get()
                ->unique('sender_id')
                ->pluck('sender_id')
                ->toArray();

                $messages2 = $this->_model::
            where('sender_id', Auth()->user()->id)
                ->orWhere('receiver_id',Auth()->user()->id)
                ->orderby('id', 'desc')
                ->get()
                ->unique('receiver_id')
                ->pluck('receiver_id')
                ->toArray();
                $result1 = array_merge($messages1, $messages2);
                $result = array_unique($result1);

        $this->data['latestMessage']=  $this->_model::where('sender_id', Auth()->user()->id)
            ->orWhere('receiver_id',Auth()->user()->id)
            ->orderby('id', 'desc')
            ->pluck('message')
            ->first();

            $user = User::whereIn('id',$result)
                ->where('id','!=',Auth()->user()->id)
                ->get();

            $this->data['leftwallmessages'] = $user;



            return view('frontend.freelancer.messages.my_freelancer_messages', $this->data);

    }


    public function store(Request $request)
    {

        $this->data['messages'] = new Chat();
        $this->data['messages']->sender_id = $request->sender_id;
        $this->data['messages']->receiver_id = $request->receiver_id;
        $this->data['messages']->message = $request->message;
        $this->data['messages']->save();

        return 1;
    }

    public function makeOffer(Request $request)
    {

        $this->data['messages'] = new Chat();
        $this->data['messages']->sender_id = $request->sender_id;
        $this->data['messages']->receiver_id = $request->receiver_id;
        $this->data['messages']->description = $request->description;
        $this->data['messages']->price = $request->price;
        $this->data['messages']->time_of_job = $request->time_of_job;
        $this->data['messages']->save();

        return 1;
    }


    public function rejectOffer(Request $request)
    {

//        dd($request);
        $offerId = $request->input('offer_id');
        $this->data['messages'] = Chat::find($offerId);
        $this->data['messages']->reject = '1';
        $this->data['messages']->message = 'rejected';
        $this->data['messages']->save();

        return 1;
    }

    public function acceptOffer(Request $request)
    {

//        dd($request);
        $offerId = $request->input('offer_id');
        $this->data['messages'] = Chat::find($offerId);
        $this->data['messages']->accept = '1';
        $this->data['messages']->save();

        return 1;
    }






    public function texting($reciever_id)
    {

            $this->data['reciever_id'] = $reciever_id;

            $messages1 = $this->_model::
            where('sender_id', Auth()->user()->id)
                ->orWhere('receiver_id',Auth()->user()->id)
                ->orderby('id', 'desc')
                ->get()
                ->unique('sender_id')
                ->pluck('sender_id')
                ->toArray();

                $messages2 = $this->_model::
            where('sender_id', Auth()->user()->id)
                ->orWhere('receiver_id',Auth()->user()->id)
                ->orderby('id', 'desc')
                ->get()
                ->unique('receiver_id')
                ->pluck('receiver_id')
                ->toArray();
                $result1 = array_merge($messages1, $messages2);
                $result = array_unique($result1);
        $this->data['latestMessage']=  $this->_model::where('sender_id', Auth()->user()->id)
                ->orWhere('receiver_id',Auth()->user()->id)
                ->orderby('id', 'desc')
                ->pluck('message')
                ->first();

            $user = User::whereIn('id',$result)
                ->where('id','!=',Auth()->user()->id)
                ->get();
            $this->data['leftwallmessages'] = $user;

            $user_id = Auth::user()->id;
            $this->data['messages'] = chat::whereIn('receiver_id', [$reciever_id, $user_id])
                ->whereIn('sender_id', [$reciever_id, $user_id])->get();

            return view('frontend.freelancer.messages.freelancer_texting', $this->data);

    }

}
