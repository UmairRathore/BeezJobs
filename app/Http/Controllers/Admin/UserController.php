<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gender;
use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
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
    //
    public function createRandomUsers()
    {
//        User::createRandomUsers(11);

        $jobs = Job::all();
        $users = User::all();

// Shuffle the users to randomize the order
        $shuffledUsers = $users->shuffle();

// Update each job with a different user_id
        foreach ($jobs as $index => $job) {
            $user = $shuffledUsers[$index % count($shuffledUsers)];
            $job->user_id = $user->id;
            $job->save();
        }
       //        $minLatitude = 24.396308;
//        $maxLatitude = 49.384358;
//        $minLongitude = -125.000000;
//        $maxLongitude = -66.934570;
//
//        $users = User::all();
//        foreach ($users as $user) {
//            $location = User::find($user->id);
//
//            // Generate unique latitude and longitude for each user within the USA boundaries
//            $uniqueLatitude = null;
//            $uniqueLongitude = null;
//            do {
//                $uniqueLatitude = mt_rand($minLatitude * 1000000, $maxLatitude * 1000000) / 1000000;
//                $uniqueLongitude = mt_rand($minLongitude * 1000000, $maxLongitude * 1000000) / 1000000;
//
//                // Check if the generated coordinates already exist in the database
//                $existingUser = User::where('latitude', '=', $uniqueLatitude)
//                    ->where('longitude', '=', $uniqueLongitude)
//                    ->first();
//            } while ($existingUser);
//
//            $location->longitude = $uniqueLongitude;
//            $location->latitude = $uniqueLatitude;
//            $check = $location->save();
//
//            if ($check) {
//                echo 'Latitude and longitude added for user ID: ' . $user->id . PHP_EOL;
//            }
//        }


//        User::createRandomUsers(11);
        return redirect()->back();
    }

    public function index()

    {
        $show = User::all();
        return view('backend.user.user-list', compact('show'));

    }


    //EDIT_USERS-(page)
    public function edit($id)
    {

        $show = User::where('id', $id)->first();
        return view('backend.user.update-user', compact('show'));
    }

    public function update(Request $request, $id)
    {



        $this->data['user'] = User::find($id);
        $this->data['user']->first_name = $request->input('first_name');
        $this->data['user']->last_name = $request->input('last_name');
        $this->data['user']->email = $request->input('email');
        $this->data['user']->tagline = $request->input('tagline');
        if (!empty($request->password)) {
            $this->data['user']->password = Hash::make($request->password);
        }

        $this->data['user']->save();
        return back()->with('info_updated', 'User Info has been updated successfuly!');


    }

    public function destroy($id)
    {
        $show = User::find($id);
        $show->delete();
        return back()->with('info_deleted', 'User Info has been deleted successfully!');
    }

    public function changeStatus(Request $request, $id)
    {
        $user = User::find($id);
        $user->status = $request->status;

        $check = $user->save();
        if ($check) {
            $msg = "Status updated successfully";
            return json_encode(array('statusCode' => 200, 'message' => $msg));

        } else {
            $msg = trans('lang_data.error');
            return json_encode(array('statusCode' => 302, 'message' => $msg));
        }

    }
}
