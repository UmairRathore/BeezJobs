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


            $messages = $this->_model::
            where('sender_id', Auth()->user()->id)
                ->orWhere('receiver_id',Auth()->user()->id)
//                ->leftjoin('users as u', 'u.id', '=', 'messagings.receiver_id')
                ->orderby('id', 'desc')
                ->get()
                ->unique('sender_id')
                ->pluck('sender_id');
//            dd($messages);
//return $messages;

            $user = User::whereIn('id',$messages)
                ->where('id','!=',Auth()->user()->id)
                ->get();

            $this->data['leftwallmessages'] = $user;



            return view('frontend.freelancer.messages.my_freelancer_messages', $this->data);

    }


    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'sender_id' => 'required',
                'receiver_id' => 'required',
                'message' => 'required',
            ]
        );
        //         'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        if ($validator->fails()) {
            return back()->with('required_fields_empty', 'FIll all the required fields!')
                ->withErrors($validator)
                ->withInput();
        }
        $this->data['messages'] = new Chat();
        $this->data['messages']->sender_id = $request->sender_id;
        $this->data['messages']->receiver_id = $request->receiver_id;
        $this->data['messages']->message = $request->message;
        $this->data['messages']->save();

        return 1;
    }






    public function texting($reciever_id)
    {

            $this->data['reciever_id'] = $reciever_id;

            $messages = $this->_model::
            where('sender_id', Auth()->user()->id)
                ->orWhere('receiver_id',Auth()->user()->id)

                ->orderby('id', 'desc')
                ->get()
                ->unique('sender_id')
                ->pluck('sender_id');


            $user = User::whereIn('id',$messages)
                ->where('id','!=',Auth()->user()->id)
                ->get();
            $this->data['leftwallmessages'] = $user;

            $user_id = Auth::user()->id;
            $this->data['messages'] = chat::whereIn('receiver_id', [$reciever_id, $user_id])
                ->whereIn('sender_id', [$reciever_id, $user_id])->get();



            return view('frontend.freelancer.messages.freelancer_texting', $this->data);

    }

}
