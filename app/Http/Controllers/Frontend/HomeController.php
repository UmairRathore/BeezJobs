<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Job;
use App\Models\Profession;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //

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
    public function index()
    {
        $this->data['cities'] = City::all();
        $this->data['professions'] = Profession::all();
        $this->data['jobs']=Job::select('jobs.*','u.first_name as fname','u.last_name as lname','u.profile_image','p.profession as profession')
            ->join('users as u','u.id','=','jobs.user_id')
            ->join('professions as p', 'u.profession_id', '=', 'p.id')
        ->orderByRaw('RAND()')->take(6)->latest()->get();

        $this->data['users']= User::select('users.*','p.profession as profession','jobs.basic_price')
            ->where('users.status',1)
            ->where('role_id',2)
            ->join('professions as p', 'users.profession_id', '=', 'p.id')
            ->join('jobs','users.id','=','jobs.user_id')
            ->whereNotNull('job_type')
            ->orderByRaw('RAND()')->take(6)->get();
//dd($this->data['users']);
//        $user_id = auth()->user()->id;
//        $data['service'] = Job::where('user_id',$user_id)->whereNotNull('job_type')->first();

        return view('frontend.index', $this->data);
    }



    public function contactUs()
    {
        return view('frontend.pages.contact-us');
    }



}
